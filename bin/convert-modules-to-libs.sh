#!/bin/sh

echo "Running convert-modules-to-libs.sh";

if [ "$*" = "" ]
then
  FILES="*.js"
else
  FILES="$*"
fi

cd js/modules/

if [ ! -d "es4" ]
then
  mkdir es4
fi

for i in $FILES
do
  echo "Converting $i"
  grep -v ^import $i | grep -v ^export > es4/$i
done

