#!/usr/bin/env bash

set -euo pipefail

SRC_DIR="less"
OUT_DIR="css"

changed_file="${1:-}"

compile_less_file() {
  local file="$1"

  # Only compile real .less files.
  [[ "$file" == *.less ]] || return 0
  [[ -f "$file" ]] || return 0

  # Do not directly compile partials like _variables.less.
  # They will trigger recompilation of files that import them.
  local filename
  filename="$(basename "$file")"
  if [[ "$filename" == _* ]]; then
    return 0
  fi

  local relative_path="${file#$SRC_DIR/}"
  local output_file="$OUT_DIR/${relative_path%.less}.css"
  local output_dir
  output_dir="$(dirname "$output_file")"

  mkdir -p "$output_dir"

  echo "Compiling $file -> $output_file"
  npx lessc "$file" "$output_file"
}

normalize_path() {
  local path="$1"

  # Remove leading ./ if present.
  path="${path#./}"

  # chokidar should normally pass paths relative to the project root.
  # If someone passes "components/foo.less", assume it means "less/components/foo.less".
  if [[ "$path" != "$SRC_DIR/"* ]]; then
    path="$SRC_DIR/$path"
  fi

  printf '%s\n' "$path"
}


compile_all_less_files() {
  find "$SRC_DIR" -type f -name "*.less" ! -name "_*" | compile_unique_files
}

strip_less_path_variants() {
  local path="$1"

  # Given less/components/_buttons.less, print import strings that might reference it.
  local relative="${path#$SRC_DIR/}"
  local no_ext="${relative%.less}"
  local dir
  local base
  local base_no_underscore

  dir="$(dirname "$relative")"
  base="$(basename "$no_ext")"
  base_no_underscore="${base#_}"

  if [[ "$dir" == "." ]]; then
    printf '%s\n' "$no_ext"
    printf '%s.less\n' "$no_ext"
    printf '%s\n' "$base_no_underscore"
    printf '%s.less\n' "$base_no_underscore"
  else
    printf '%s\n' "$no_ext"
    printf '%s.less\n' "$no_ext"
    printf '%s/%s\n' "$dir" "$base_no_underscore"
    printf '%s/%s.less\n' "$dir" "$base_no_underscore"
  fi
}

file_imports_changed_file() {
  local importer="$1"
  local changed="$2"

  while IFS= read -r import_variant; do
    # Matches common Less imports:
    # @import "components/buttons";
    # @import "components/buttons.less";
    # @import (reference) "components/buttons";
    # @import (less) "components/buttons.less";
    if grep -Eq "@import[[:space:]]*(\([^)]*\)[[:space:]]*)?[\"']${import_variant//\//\\/}[\"']" "$importer"; then
      return 0
    fi
  done < <(strip_less_path_variants "$changed")

  return 1
}

find_importers_of() {
  local changed="$1"

  find "$SRC_DIR" -type f -name "*.less" | while read -r candidate; do
    [[ "$candidate" == "$changed" ]] && continue

    if file_imports_changed_file "$candidate" "$changed"; then
      printf '%s\n' "$candidate"
    fi
  done
}

compile_unique_files() {
  awk '!seen[$0]++' | while read -r file; do
    compile_less_file "$file"
  done
}

if [[ -z "$changed_file" ]]; then
  # No file passed: full build.
  find "$SRC_DIR" -type f -name "*.less" ! -name "_*" | compile_unique_files
  exit 0
fi

changed_file="$(normalize_path "$changed_file")"

# If anything inside less/shared/ changes, rebuild everything.
if [[ "$changed_file" == "$SRC_DIR/shared/"* ]]; then
  echo "Shared LESS changed: $changed_file"
  echo "Rebuilding all LESS files..."
  compile_all_less_files
  exit 0
fi

{
  # Compile the touched file itself, unless it is a partial.
  printf '%s\n' "$changed_file"

  # Compile files that directly import/include the touched file.
  find_importers_of "$changed_file"
} | compile_unique_files