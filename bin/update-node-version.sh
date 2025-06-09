#!/bin/bash

set -e

# Read versions
nvm_version=$(cat .nvmrc | tr -d 'v')
package_version=$(jq -r '.engines.node' package.json | tr -d 'v')
workflow_version=$(grep -E 'node-version:' .github/workflows/push-actions.yml | head -1 | awk '{print $2}' | tr -d 'v' | tr -d "\"")


# Read package.json engine range
engine_range=$(jq -r '.engines.node' package.json)
engine_min=$(echo "$engine_range" | sed -n 's/.*>=\([0-9.]*\).*/\1/p')
engine_max=$(echo "$engine_range" | sed -n 's/.*<=\([0-9.]*\).*/\1/p')



# Report
echo "Checking Node.js version consistency..."
echo "  .nvmrc:        $nvm_version"
echo "  package.json:   $engine_range"
echo "  GitHub Actions: $workflow_version"

# Compare all versions to .nvmrc
all_match=true


if [[ "$nvm_version" != "$workflow_version" ]]; then
     echo "❌ GitHub Actions version does not match .nvmrc"
     all_match=false
fi
# Compare .nvmrc version to engine range
version_check=$(awk -v v="$nvm_version" -v min="$engine_min" -v max="$engine_max" '
     function vercmp(a,b) {
          split(a,va,"."); split(b,vb,".");
          for (i=1; i<=3; i++) {
               if (va[i]+0 < vb[i]+0) return -1;
               if (va[i]+0 > vb[i]+0) return 1;
          }
          return 0;
     }
     BEGIN {
          if (vercmp(v, min) >= 0 && vercmp(v, max) <= 0) exit 0;
          else exit 1;
     }
')

if [[ $? -ne 0 ]]; then
     echo "❌ .nvmrc version is outside the range specified in package.json engines.node"
     all_match=false
fi

if [[ "$all_match" == true ]]; then
     echo "✅ All Node.js versions are consistent and within the allowed range."
     exit 0
else
     echo "❌ Version mismatch detected."
     exit 1
fi

