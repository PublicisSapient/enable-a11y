#!/bin/bash

FILE_LIST=`git diff --name-only origin/main...HEAD`

PHP_LIST=`echo "$FILE_LIST" | egrep ".php$"`
JS_LIST=`echo "$FILE_LIST" | grep ".js$"`
CSS_LIST=`echo "$FILE_LIST" | grep ".css$"`

BASE_PHP_LIST=`echo "$PHP_LIST" | awk -F"/" '{print $NF}' `

MYIP=`bin/my-ip.sh`




PHP_FILES_AFFECTED=`node bin/find-affected-pages.js \
  --dir ./tmp/vnu/ \
  --exts ".php" \
  --quiet --just-pages --results-relative \
  --match basename \
  --files "$(git diff --name-only origin/main...HEAD | paste -sd, -)"
  --add-prefix= `



LIST="$BASE_PHP_LIST
$PHP_FILES_AFFECTED"

echo "$LIST" | sort -u | awk -v myip="$MYIP" '{printf ("http://%s:8888/%s\n", myip, $1)}'