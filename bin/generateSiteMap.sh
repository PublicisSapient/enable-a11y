#!/bin/bash
echo "Generating sitemap..."
bin/getPages.js | awk -F"/" '{printf("https://www.useragentman.com/enable/%s\n", $4)}' > sitemap.txt
