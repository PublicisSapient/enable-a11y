#!/bin/bash


for i in sass npx
do
    if ! command -v $i &> /dev/null
    then
        echo "Error: Need to install $i in order for this to work" 1>&2
        echo 1>&2
        echo "Execute the following command and try again: " 1>&2
        echo 1>&2
        echo "   npm install -g $i " 1>&2
        echo 1>&2
        exit 1
    fi
done

echo "Building USWDS JS files ..."
npx webpack build --config webpack.config.js
if [ "$?" != "0" ]
then
    echo "Error compiling USWDS JS. Bailing" 1>&2
    exit 2;
fi

echo
echo "Building USWDS CSS files...."

for package in usa-input-mask
do
    echo "$package"
    sass -I node_modules/@uswds/uswds/packages/ -I node_modules/@uswds/uswds/src/stylesheets/packages/ node_modules/@uswds/uswds/packages/$package/_index.scss --style=compressed enable-node-libs/uswds/css/input-mask.css
    if [ "$?" != "0" ]
    then
        echo "Error compiling USWDS CSS. Bailing" 1>&2
        exit 3;
    fi
done