import os
import sys
import fnmatch

def concatenate_files(pattern, output_file, dry_run=False):
    if not pattern or not output_file:
        print("Usage: python concat_files.py <filename_pattern> <output_file> [--dry-run]")
        sys.exit(1)

    # Find all files matching the pattern
    matching_files = []
    for root, dirnames, filenames in os.walk('.'):
        for filename in fnmatch.filter(filenames, pattern):
            matching_files.append(os.path.join(root, filename))

    if dry_run:
        print("Dry run: The following files would be concatenated:")
        for file in matching_files:
            print(file)
    else:
        print(f"Concatenating files to {output_file}...")
        with open(output_file, 'w') as outfile:
            for file in matching_files:
                print(f"Processing {file}")
                outfile.write(f"\n# File: {file}\n")
                with open(file, 'r') as infile:
                    outfile.write(infile.read())
        print("Concatenation complete.")

if __name__ == "__main__":
    if len(sys.argv) < 3:
        print("Usage: python concat_files.py <filename_pattern> <output_file> [--dry-run]")
        sys.exit(1)

    pattern = sys.argv[1]
    output_file = sys.argv[2]
    dry_run = '--dry-run' in sys.argv

    concatenate_files(pattern, output_file, dry_run)
