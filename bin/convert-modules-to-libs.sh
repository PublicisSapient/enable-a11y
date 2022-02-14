#!/bin/sh

cd js/modules/

if [ ! -d "es4" ]
then
  mkdir es4
fi

for i in *.js
do
  grep -v ^import paginate.js | grep -v ^export > es4/$i
done

