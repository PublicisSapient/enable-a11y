

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 

function includeFileWithVariables($fileName, $variables)
{
    extract($variables);
    include($fileName);
}

function includeShowcode($id, $cssId = "", $jsId = "", $extra = "", $isInteractive = true, $headingLevel = 3)
{
    includeFileWithVariables('includes/showcode-template.php', array(
        'id' => $id,
        'cssId' => $cssId,
        'jsId' => $jsId,
        'extra' => $extra,
        'isInteractive' => $isInteractive,
        'headingLevel' => $headingLevel
    ));
}

function pictureWebpPng($src, $alt = "", $otherAttrs = "")
{
    includeFileWithVariables('includes/picture-webp-png.php', array(
        'src' => $src,
        'alt' => $alt,
        'otherAttrs' => $otherAttrs
    ));
}

function includeMetaInfo($title = 'ERROR', $desc = 'ERROR', $posterImg = 'ERROR')
{
    includeFileWithVariables('includes/meta-info.php', array(
        'title' => $title,
        'desc' => $desc,
        'posterImg' => $posterImg
    ));
} 

function getMetadata() {
    global $fileProps;
    $uri =  $_SERVER['REQUEST_URI'];
    $tokenToFind = trim(preg_replace('/^\//', '', $uri));
    $metaFile = './data/meta-info.json';

    if (file_exists($metaFile)) {
        $myFile  = fopen($metaFile, "r");
        $content = json_decode(fread($myFile, filesize($metaFile)));
        fclose($myFile);

        foreach( $content as $file => $fileProps ) {
            $title = "";
            $desc = "";
            //This loop allows me to work around with the keys 
            if (strcmp($tokenToFind, $file) == 0) {
                $fileProps->posterImg = '/images/posters/' . preg_replace('/\.php$/', '.jpg', $tokenToFind);
                return;
            }  
        }
    } else {
      die("Unable to open the file !");
    }

    // if we get here, the lookup failed, so set $fileProps to
    // and empty object
    $fileProps = new stdClass();
}

function getContent() {
  includeFileWithVariables('../content/body' . $_SERVER["REQUEST_URI"], array());
}

function getHeadTags() {
  $headFile = '../content/head/' . $_SERVER["REQUEST_URI"];
  if (file_exists($headFile)) {
    includeFileWithVariables($headFile, array());
  }
}

function getBottomBodyTags() {
  $file = '../content/bottom/' . $_SERVER["REQUEST_URI"];
  if (file_exists($file)) {
    includeFileWithVariables($file, array());
  }
}

getMetadata();

includeMetaInfo($fileProps -> title ?? 'ERROR', $fileProps -> desc ?? 'ERROR', $fileProps -> posterImg ?? 'ERROR');

?>



<meta name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta charset="utf-8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet"
  type="text/css"
  href="css/showcode.css" />

<!-- This is the global stylesheet -->
<link id="all-css"
  rel="stylesheet"
  href="css/shared/all.css" />
<link id="read-all-css"
  rel="stylesheet"
  href="css/shared/read-more.css" />

<!-- hamburger menu -->
<link id="hamburger-style"
  rel="stylesheet"
  type="text/css"
  href="css/hamburger-menu.css" />

<!-- Skip links styles -->
<link id="enable-skip-link-style"
  href="css/enable-visible-on-focus.css"
  rel="stylesheet" />

<link id="site-css"
  rel="stylesheet"
  href="css/site.css" />


<link id="pause-anim-css"
  rel="stylesheet"
  href="css/pause-animations-demo.css" />



