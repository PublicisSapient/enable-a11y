#!/bin/sh

echo "Running convert-modules-to-libs.sh";

# Remove the original ES4 files
rm js/modules/es4/*.js

# Duplicate the ES6 files into the ES4 folder
cp js/modules/*.js js/modules/es4/

# Convert the ES6 files to ES4 using jscodeshift
npx jscodeshift -t bin/remove-imports-exports.js js/modules/es4/*.js
