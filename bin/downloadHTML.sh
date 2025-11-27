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
AXE_DELAYED_FILES="math.php pause-anim-control.php video-player.php multimedia-content.php"


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