#!/bin/bash

i=`find css -name '*.css' -print`

# echo $i
OUTPUT=`grep -n 'font-size:[^\s\S]*[^@]px;' $i`
# grep -b 'line-height:[^\s\S]*[^0-9];' $i
RET="$?"

if [ "$RET" = "0" ]
then
    echo "The following CSS files must be changed so they don't use px units."
    echo "Please ensure you change the corresponding LESS files to use the @px mixin."
    echo "(e.g. instead of using 'font-size: 12px;', use 'font-size: 12 / @px;')."
    echo
    echo "$OUTPUT"
    echo
    exit 1;
fi

exit 0