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
  `

POSSIBLE_TEST_FILES=`echo "$PHP_FILES_AFFECTED" | sed "s/.php/.test.js/"`
TEST_FILES=""

for i in $POSSIBLE_TEST_FILES
do
    if [ -f "js/test/$i" ]
    then
        TEST_FILES="$TEST_FILES $i"
    fi
done

node  node_modules/jest/bin/jest.js   --runInBand $TEST_FILES