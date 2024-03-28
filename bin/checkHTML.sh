#!/bin/bash

#######################################################################
# checkHTML: runs automated testing on generated HTML in Enable
#
# Possible error codes returned by this script:
#
# Tool installation errors:
# 1 - chromedriver error
# 2 - axe not installed
# 3 - pa11y not installed
# 4 - PHP not installed
# 5 - OS based tool not installed (e.g. java or lynx)
# 6 - Java not installed
# 7 - VNU not installed
# 8 - need to run `npm run server` before running this script
#
# Runtime errors:
# 100 - VNU checks returns errors
# 101 - aXe returned errors
# 102 - pa11y returned errors
#######################################################################

VNU_JAR="node_modules/vnu-jar/build/dist/vnu.jar"
VNU_CMD="java -jar $VNU_JAR"
MYIP=`ifconfig -a | grep inet | grep -v inet6 | awk '{print $2}' | head -2 | tail -1`
PROJECT_URL="http://$MYIP:8888/index.php"
SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
PHP=`bin/findPHP.sh`
export PATH="$PATH:./bin"
AXE="axe --chromedriver-path=node_modules/chromedriver/bin/chromedriver "

showChromedriverError() {
	echo 
	echo "-----------------------------------------------------------------"
	echo "It seems that you do not have the correct Chromedriver installed."
	echo '
If there is a problem with running Chromedriver, then you should
ensure your chromedriver is installed with the right version 
of Chrome (check the version number inside the "About Chrome"
dialog in Chrome).  

You can change the Chromedriver version installed with this project by using 
`npm install -D chromedriver@XXX`, and replacing XXX with the same major 
version as your current Chrome browser.

Alternatively, you can download a version of the Chromedriver from
https://chromedriver.storage.googleapis.com/index.html
(if you are using MAC OS, you can download the mac64 version)
and install it like this (the filename may vary):

npm install -D chromedriver --chromedriver_filepath=/path/to/chromedriver_mac64.zip

You can also download a version of Google Chrome For Testing 
in order for the Chromedriver to work:

https://googlechromelabs.github.io/chrome-for-testing/


If (and only if) your computer can only run Google Chrome < 115, please read 
the file old-google-chrome.txt for instructions on how to install chromedriver
for your version of Chrome.

If that does not work, you may need to do a global update of @axe-core/cli:

sudo npm update -g @axe-core/cli


' 1>&2
	exit 1;
}

checkDependencies() {
	echo "PHP is $PHP"

	echo "Checking if dependencies are installed ..."

	for i in lynx java $PHP axe pa11y-ci
	do
		which $i > /dev/null 2> /dev/null
		if [ "$?" != "0" ]
		then
			echo "Need to install $i." 1>&2
			if [ "$i" = "axe" ]
			then
				echo "Install axe using:" 1>&2
				echo "  npm install axe-cli -g" 1>&2
				exit 2
			elif [ "$i" = "pa11y-ci" ]
			then
				echo "Install pa11y using:" 1>&2
				echo "  npm install pa11y-ci -g"
				exit 3
			elif [ "$i" = "$PHP" ]
			then
				echo "PHP 8.1 is not installed.  Trying PHP ..."
				which php > /dev/null 2> /dev/null

				if [ "$?" != "0" ]
				then
					echo "PHP is not installed.  Bailing"
					exit 4
				else
					echo "A lower version of PHP than 8.1 is being used.  This may have unexpected results."
				fi
			else
				echo "Please install this software using your operating system's package management" 1>&2
				exit 5
			fi 
			
		fi


		#.. Special case with java -- if it returns 0, it still may not be installed
		#   and the command is giving a message to install the runtime (happens on OSX)
		if [ "$i" == "java" ]
		then
			OUT=`java 2>&1`
			CHECK=`echo "$OUT" | grep "Unable to locate a Java Runtime." | wc -l`
			
			if [ $CHECK = "1" ]
			then
				echo 1>&2
				echo "$OUT" 1>&2
				echo 1>&2
				exit 6
			fi
		fi

	done

	#.. checking connection to remote
	if ping -c1 -W1 $MYIP &> /dev/null
	then
		echo "Server at $MYIP is up"
	else 
		echo "Unable to connect to $MYIP, likely due to a firewall somewhere in between."
		echo "Retrying with localhost"
		MYIP="localhost"
		PROJECT_URL="http://$MYIP:8888/index.php"

		if ping -c1 -W1 $MYIP &> /dev/null
		then
			echo "Server at $MYIP is up."
		else
			echo "Unable to connect to $MYIP"
			exit 1
		fi
	fi

	#.. let's ensure axe has the right chromedriver installed
	echo "Verifying if aXe is installed correctly..."
	AXE_ERR=`$AXE $PROJECT_URL 2>&1`

	echo "$AXE_ERR" | egrep "(This version of ChromeDriver only supports|The specified executable path does not exist: node_modules/chromedriver/bin/chromedriver)" 1>&2
	if [ "$?" = "0" ]
	then
		echo "$AXE_ERR" 1>&2
		showChromedriverError
	fi


	echo "Verifying Chrome is where I think it is..."
	echo "$AXE_ERR" | egrep "[cC]annot find Chrome binary" > /dev/null 

	if [ "$?" = "0" ]
	then
		echo "$AXE_ERR" 1>&2
		echo "
		
		aXe can't find Chrome.  Please put it in your PATH and try again.
		Please read the following doc for more information:

		https://github.com/SeleniumHQ/selenium/wiki/ChromeDriver/01fde32d0ed245141e24151f83b7c2db31d596a4#requirements
		" 1>&2

		showChromedriverError
	fi



	if [ ! -f "$VNU_JAR" ]
	then
		echo "Need to install VNU.  Please run 'npm install'." 1>&2
		exit 7
	fi


	A=`lynx -dump $PROJECT_URL`
	if [ "$?" != "0" ]
	then
		echo "You need to do a `npm run server` in another shell before you run this target."
		exit 8
	fi
}



downloadHTML() {
	checkDependencies

	URLS=`bin/getPages.js $MYIP`;
	DOWNLOADED_URLS=""
	TEMP_FILES=""



	#First, test non-existant file
	echo "Testing aXe set up to see if Chromedriver installed correctly in node_modules"
	if [ ! -x "node_modules/chromedriver/bin/chromedriver" ]
	then
		showChromedriverError
	fi


	#.. This is the list of files that are to be tested with aXe after a delay of 2000 ms.
	AXE_DELAYED_FILES="math.php pause-anim-control.php video-player.php"


	echo "Downloading rendered HTML..."

	if [ ! -d tmp ]
	then
		mkdir tmp
	fi

	for i in $URLS
	do
		FILE_SLUG=`echo $i| awk -F'/' '{print $NF}'`
		TEMP_FILE="tmp/$FILE_SLUG"

		
		printf "."
		
		wget $i -O $TEMP_FILE 2> /dev/null
		DOWNLOADED_URLS=`echo -e "$DOWNLOADED_URLS\n$i"`
		TEMP_FILES="$TEMP_FILES $TEMP_FILE"
	done
	echo

	printf "%s\n" $DOWNLOADED_URLS > tmp/downloaded-urls.txt
	echo -n $TEMP_FILES > tmp/temp-files.txt
	echo -n $AXE_DELAYED_FILES > tmp/axe-delayed-files.txt
}


runVNUTests() {
	#. Download the HTML files if they have not already been downloaded
	if ! [ -f tmp/temp-files.txt ]
	then
		bin/generateSiteMap.sh
		downloadHTML
	else
		: "${TEMP_FILES:=`cat tmp/temp-files.txt`}"
	fi
	numTempFiles=$(echo "${TEMP_FILES}" | awk -F" " '{print NF}')

	echo "Checking HTML..."
	OUTPUT=`$VNU_CMD --filterfile $SCRIPT_DIR/../data/vnu-filters --errors-only $TEMP_FILES 2>&1 `
	VNU_ERR_CODE="$?"

	if [ $VNU_ERR_CODE != "0" ]
	then
		echo "ERROR CODE: $VNU_ERR_CODE"
	else
		echo "HTML is valid for $numTempFiles files"
	fi
	echo

	# trim output
	OUTPUT="${OUTPUT##*( )}"

	#.. Let's see if we can get the PHP output into each error to give the dev some context.
	READ_RETURN="0"


	echo "$OUTPUT" | (
		while [ "$READ_RETURN" = "0" ]
		do
			read LINE
			READ_RETURN="$?"
			
			if [ "$READ_RETURN" = "0" -a "$LINE" != "" ]
			then
				LINES_INFO=`echo $LINE | awk -F':' '{print $3}'`
				BEGIN=`echo $LINES_INFO | awk -F'-' '{print $1}'`
				END=`echo $LINES_INFO | awk -F'-' '{print $2}'`

				BEGIN_LINE_NUM=`echo $BEGIN | awk -F'.' '{print $1}'`
				END_LINE_NUM=`echo $END | awk -F'.' '{print $1}'`

				# echo "TEST: $BEGIN $END"

				if [ "$BEGIN" != "error" ]
				then
					DIFF_NUM=`expr $END_LINE_NUM - $BEGIN_LINE_NUM + 1`

					FILE=`echo $LINE | awk -F':' '{print $2}' | sed 's/"//g'`
					CONTEXT=`cat $FILE | head -$END_LINE_NUM | tail -$DIFF_NUM`


					# echo "LINES_INFO: $LINES_INFO"
					# echo "LINE_NUM: $BEGIN_LINE_NUM $END_LINE_NUM"
					echo -e "$LINE\n\n$CONTEXT\n\n"
				else
					echo -e "GLOBAL ERROR: $LINE\n\n"
				fi
			fi
		done
	)


	# echo "$OUTPUT"


	OUTPUT_LEN=`echo "$OUTPUT" | wc -c`

	if [ "$OUTPUT_LEN" -gt "1" ]
	then
		# echo "$OUTPUT"
		# rm $TEMP_FILES
		echo "The generated html from the PHP files are in tmp/" 1>&2
		echo "Please use them to debug in order to fix the above issues." 1>&2
		exit 100
	fi
}



runAXETests() {
	#. Download the HTML files if they have not already been downloaded
	if ! [ -f tmp/downloaded-urls.txt ] || ! [ -f tmp/axe-delayed-files.txt ]
	then
		bin/generateSiteMap.sh
		downloadHTML
	else
		: "${DOWNLOADED_URLS:=`cat tmp/downloaded-urls.txt`}"
		: "${AXE_DELAYED_FILES:=`cat tmp/axe-delayed-files.txt`}"
	fi

	echo "Running aXe tests..."

	#.. Make a list of the delayed URLS
	AXE_DELAYED_URLS=""
	AXE_UNDELAYED_URLS="$DOWNLOADED_URLS"
	for delayed_file in $AXE_DELAYED_FILES
	do
		GREP=`echo "$DOWNLOADED_URLS" | grep $delayed_file`
		AXE_DELAYED_URLS="$AXE_DELAYED_URLS $GREP"
		AXE_UNDELAYED_URLS=`echo "$AXE_UNDELAYED_URLS" | grep -v $delayed_file`
	done

	echo "Running delayed tests"
	$AXE --exit --load-delay=2000 --exclude "iframe" $AXE_DELAYED_URLS
	AXE_DELAY_RETURN="$?"
	echo "Result: $AXE_DELAY_RETURN errors"

	echo "Running immediate tests"
	$AXE --exit --verbose --exclude ".enable-logo__text" $AXE_UNDELAYED_URLS 
	AXE_UNDELAY_RETURN="$?"
	echo "Result: $AXE_UNDELAY_RETURN errors"

	if [ "$AXE_DELAY_RETURN" != "0" -o "$AXE_UNDELAY_RETURN" != "0" ]
	then
		echo "aXe failed. See information above."
		exit 101
	else
		echo "aXe passed"
	fi
}



function runPa11yTests() {
	#. Download the HTML files if they have not already been downloaded
	if ! [ -f tmp/downloaded-urls.txt ]
	then
		bin/generateSiteMap.sh
		downloadHTML
	else
		: "${DOWNLOADED_URLS:=`cat tmp/downloaded-urls.txt`}"
	fi

	echo "Running pa11y-ci tests ..."

	DID_PALLY_SUCCEED="0"

    #. Set a key-value pair, only populated with the Chrome application path for Linux systems
    CHROME_PATH='"": "",'
    if [ $(uname) == "Linux" ]
    then
        CHROME_PATH='"executablePath": "/usr/bin/google-chrome"'
    fi

	# <<comment
	( 
		echo '{
		"urls": [ '

		echo $DOWNLOADED_URLS | awk '
			{ 
				for (i=1; i<=NF; i++) {
					if (i == NF) {
						comma = "";
					} else {
						comma = ",";
					}
					printf("\"%s\"%s\n", $i, comma);
				} 
			}
		'
		
		echo "],
            \"defaults\": {
                \"chromeLaunchConfig\": {
                    $CHROME_PATH
                    \"args\": [
                        \"--no-sandbox\",
                        \"--disable-setuid-sandbox\",
                        \"--disable-dev-shm-usage\"
                    ]
                }
            }
        }"
	) > tmp/pa11y-config.txt 

	# comment

	pa11y-ci --config tmp/pa11y-config.txt 
	DID_PALLY_SUCCEED="$?"

	if [ $DID_PALLY_SUCCEED != "0" ]
	then
		echo "Pa11y failed.  See information above."
		exit 102;
	fi
}

#.. let's wipe the tmp directory if it exists
if [ -z "$(ls -A tmp)" ]
then
	rm tmp/*
fi

#.. Run specific tests based on the argument passed in when running this script
if [ "$1" = "vnu" ]
then
	runVNUTests
elif [ "$1" = "axe" ]
then
	runAXETests
elif [ "$1" = "pa11y" ]
then
	runPa11yTests
else
	#.. Run checks and preparation for tests
	bin/generateSiteMap.sh
	downloadHTML

	#.. Run all tests
	runVNUTests
	runAXETests
	runPa11yTests

	#.. Remove temporary files on success
	rm tmp/* 2> /dev/null
fi
