#!/bin/bash

echo "Content-type: text/plain"
echo

TIME=` date | awk '{print $5" "$6}'`
PROCESSES=`ps -efW  | tail +1 | wc -l` 


echo "Number of processes running at $TIME : $PROCESSES"