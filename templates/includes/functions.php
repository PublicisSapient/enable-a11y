<?php
$walkthroughIndex = 1;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 

function includeFileWithVariables($fileName, $variables)
{
    extract($variables);
    include($fileName);
}

function includeShowcode($id, $cssId = "", $jsId = "", $extra = "", $isInteractive = true, $headingLevel = 3, $prologue = '')
{
    includeFileWithVariables('includes/showcode-template.php', array(
        'id' => $id,
        'cssId' => $cssId,
        'jsId' => $jsId,
        'extra' => $extra,
        'isInteractive' => $isInteractive,
        'headingLevel' => $headingLevel,
        'prologue' => $prologue
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

function includeMetaInfo($title = 'ERROR', $desc = 'ERROR', $posterImg = 'ERROR', $mainClass = '')
{
    includeFileWithVariables('includes/meta-info.php', array(
        'title' => $title,
        'desc' => $desc,
        'posterImg' => $posterImg,
        'mainClass' => $mainClass
    ));
}

// From https://stackoverflow.com/questions/2791998/convert-string-with-dashes-to-camelcase
function dashesToCamelCase($string, $capitalizeFirstCharacter = false) 
{

    $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));

    if (!$capitalizeFirstCharacter) {
        $str[0] = strtolower($str[0]);
    }

    return $str;
}


function includeNPMInstructions($moduleName, $supportingModuleNames = array('js/modules/accessibility.module.js'), $isPolyfill = false) {
  includeFileWithVariables('includes/npm.php', array(
    'moduleName' => $moduleName,
    'moduleVar' => dashesToCamelCase($moduleName),
    'supportingModuleNames' => $supportingModuleNames,
    'isPolyfill' => $isPolyfill
  ));
}

function includeStats($props) {
  unset($isForNewBuilds, $doNot, $isNPM, $isStyle, $isExperimental, $comment);
  extract($props);
  global $walkthroughIndex;

  $npmLink = '(<a href="#npm-instructions">Module installation instructions</a>)';

  if (!isset($comment)) {
    if (isset($isForNewBuilds)) {
      if ($isForNewBuilds == true) {
        $comment = 'This is the best solution to use, especially when building from scratch.';
      } else if ($isForNewBuilds == false) {
        $comment = 'If you already are using a component similar to this in existing work that is not accessible, go to the <a href="#developer-walkthrough-' . $walkthroughIndex . '">developer walkthrough</a> of this section to see we made our implementation accessible.';
      }
    } else if (isSet($doNot)) {
      $comment = 'This works, but <em>For the Love of God and All That is Holy, don\'t do this.</em>';
    } else if (isSet($isNPM)) {
      $comment = 'This solution available as an NPM module. ' . $npmLink;
    } else if (isSet($isStyle)) {
      $comment = 'This is a great solution to make CSS styling easier for developers.';
    }
  } else {
    if (isSet($isNPM)) {
      $comment = $comment . ' ' . $npmLink;
    }
  }


  includeFileWithVariables('includes/stats.php', array(
    'isForNewBuilds' => isSet($isForNewBuilds) ? $isForNewBuilds : NULL,
    'doNot' => isset($doNot),
    'isNPM' => isset($isNPM),
    'isStyle' => isSet($isStyle),
    'comment' => $comment
  ));
}

function getURIFilename() {
  $uri =  $_SERVER['REQUEST_URI'];
  $uriFile = explode('/', $uri);
  $uriFile = $uriFile[count($uriFile) - 1];
  return $uriFile;
}

function getMetadata() {
    global $fileProps;
    $uriFile = getURIFilename();
    $tokenToFind = trim(preg_replace('/^\//', '', $uriFile));
    $metaFile = './data/meta-info.json';

    if (file_exists($metaFile)) {
        $myFile  = fopen($metaFile, "r");
        $content = json_decode(fread($myFile, filesize($metaFile)));
        fclose($myFile);

        foreach( $content as $file => $fileProps ) {
            $title = "";
            $desc = "";

            if ( !property_exists($fileProps, 'mainClass')) {
              $fileProps->mainClass = '';
            }

            //This loop allows me to work around with the keys 
            if (strcmp($tokenToFind, $file) == 0) {


                $fileProps->posterImg = '/images/posters/' . preg_replace('/\.php$/', '.jpg', $tokenToFind);

                // Let's ensure these properties are entified.
                foreach($fileProps as $prop => $propValue) {
                  $fileProps->{$prop} = htmlentities($propValue);
                }
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

function give404IfNotValid() {
  if (!file_exists('../content/body/' . getURIFilename())) {
    http_response_code(404);

    echo "";
    echo "<html><h1>404 Not Found</h1></html>";
    exit;
 }
}

function getContent($title = '') {
  includeFileWithVariables('../content/body/' . getURIFilename(), array(
    'title' => $title
  ));
}

function getHeadTags() {
  $headFile = '../content/head/' . getURIFilename();
  if (file_exists($headFile)) {
    includeFileWithVariables($headFile, array());
  }
}

function getBottomBodyTags() {
  $file = '../content/bottom/' . getURIFilename();
  if (file_exists($file)) {
    includeFileWithVariables($file, array());
  }
}

getMetadata();

?>
