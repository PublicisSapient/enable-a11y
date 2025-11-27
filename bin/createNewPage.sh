#!/bin/bash

CMD=$(basename $0);
JSON_FILE="templates/data/meta-info.json"

if [ "$#" != "1" ]
then
    echo "Usage: $CMD <page-name>" 1>&2
    exit 1
fi

echo -n "Title of $1: "
read TITLE

echo -n "Description: "
read DESC


touch content/body/$1 content/head/$i content/bottom/$1

VAL="
{
  \"sectionPages\": [ { \"content\": \"Static Content\" } ],
  \"title\": \"$TITLE\",
  \"desc\": \"$DESC\"
}"

jq --argjson v "$VAL" ". + { \"$1\": $v }" \
  $JSON_FILE > $JSON_FILE.tmp && mv $JSON_FILE.tmp $JSON_FILE