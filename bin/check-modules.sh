#!/bin/bash

for i in js/modules/*
do      
        echo "Checking $i"
        node $i
        if [ "$?" != "0" ]
        then    
                echo "$i doesn't parse correctly on node" 2>&1
                exit 1
        fi
done
