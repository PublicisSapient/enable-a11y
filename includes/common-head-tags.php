<meta name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta charset="utf-8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet"
  type="text/css"
  href="css/showcode.css">

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



<?php
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

    function findMeta() {
        $uri =  $_SERVER['REQUEST_URI'];
        $tokenToFind = trim(preg_replace('/^\//', '', $uri));
        $metaFile = './data/meta-info.json';
        $myFile  = fopen($metaFile, "r") or die("Unable to open the file !");
        $content = json_decode(fread($myFile, filesize($metaFile)));
        fclose($myFile);

        echo "T: " . $tokenToFind . "!!!!";
          
        foreach( $content as $file => $fileProps ) {
            $title = "";
            $desc = "";
            //This loop allows me to work around with the keys 
            if (strcmp($tokenToFind, $file) == 0) {
                echo "Got data for file ". $file;
            
                if ($fileProps -> title && $fileProps -> desc && $fileProps -> posterImg) {
                    includeMetaInfo($fileProps -> title, $fileProps -> desc, $fileProps -> posterImg);
                }
                break;
            }  
        }
    }

?>