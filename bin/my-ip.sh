#!/bin/bash

which ifconfig 1> /dev/null 2> /dev/null
if [ "$?" = "0" ]
then
	MYIP=`ifconfig -a | grep inet | grep -v inet6 | awk '{print $2}' | head -2 | tail -1`
else
	id=$(netsh interface show interface | grep "Connected" | awk '{print $4}')
	MYIP=$(ipconfig | awk -v desc="$id" '
		BEGIN {found=0}
		{
			if ($0 ~ desc) {
			found=1
			} else if ($0 ~ /^[^ ]/ && found) {
				found=0
			}
			if (found && /IPv4 Address/) {
				gsub(/.*: /, "", $0)
				print $0
				exit
			}
		}')
fi

echo $MYIP