#!/bin/bash

PAGES=`bin/getPages.js | awk -F"/" '{printf("http://localhost:8888/enable/%s\n", $4)}'`

rm tmp/*

for i in $PAGES
do
	FILE_SLUG=`echo $i| awk -F'/' '{print $NF}'`
	TEMP_FILE="tmp/$FILE_SLUG"

	printf "."
	
	wget $i -O $TEMP_FILE
done

cd tmp

for i in *
do
    FILE_SLUG=`echo $i| awk -F'/' '{print $NF}' | awk -F'.' '{print $1}'`
    htmltoPDF $i $FILE_SLUG.pdf 
done

