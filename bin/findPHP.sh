#!/bin/sh

X="80"

#.. First, let's try just `php`
PHP=`which php`
if [ "$?" = "0" ]
then
    echo "$PHP xxx"
    exit 0
fi

#.. If that didn't work, try `php80`, `php81`, etc.
while [ "$X" -lt "90" ]
do
    PHP="php$X"
    PHP=`which $PHP`

    if [ "$?" = "0" ]
    then
        break
    else
        X=`expr $X + 1`
    fi
done

if [ "$X" = "90" ]
then
    exit 1
else 
    echo "$PHP"
    exit 0
fi

