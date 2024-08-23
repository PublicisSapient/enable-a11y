<?php
$walkthroughIndex = 1;

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

function getCgiVar($name)
{
    $isVarSet = isset($_GET[$name]);
    if ($isVarSet) {
        $r = $_GET[$name];
    } else {
        $r = "";
    }

    return $r;
}

function includeFileWithVariables($fileName, $variables = [])
{
    extract($variables);
    include $fileName;
}

function includeShowcode(
    $id,
    $cssId = "",
    $jsId = "",
    $extra = "",
    $isInteractive = true,
    $headingLevel = 3,
    $prologue = "",
    $displayOuterHTML = false,
) {
    includeFileWithVariables("includes/showcode-template.php", [
        "id" => $id,
        "cssId" => $cssId,
        "jsId" => $jsId,
        "extra" => $extra,
        "isInteractive" => $isInteractive,
        "headingLevel" => $headingLevel,
        "prologue" => $prologue,
        "displayOuterHTML" => $displayOuterHTML,
    ]);
}

function includeMobileIframe(
    $url,
    $queryString = "",
    $copy = "",
    $title = "Reflow Example",
    $heading = "",
) {
    includeFileWithVariables("includes/mobile-iframe.php", [
        "url" => $url,
        "queryString" => $queryString,
        "copy" => $copy,
        "title" => $title,
        "heading" => $heading,
    ]);
}

function pictureWebpPng($src, $alt = "", $otherAttrs = "")
{
    includeFileWithVariables("includes/picture-webp-png.php", [
        "src" => $src,
        "alt" => $alt,
        "otherAttrs" => $otherAttrs,
    ]);
}

function includeSvgSprite($id, $alt)
{
    includeFileWithVariables("includes/svg-sprite.php", [
        "id" => $id,
        "alt" => $alt,
    ]);
}

function includeMetaInfo(
    $title = "ERROR",
    $desc = "ERROR",
    $posterImg = "ERROR",
    $mainClass = "",
) {
    includeFileWithVariables("includes/meta-info.php", [
        "title" => $title,
        "desc" => $desc,
        "posterImg" => $posterImg,
        "mainClass" => $mainClass,
    ]);
}

// From https://stackoverflow.com/questions/2791998/convert-string-with-dashes-to-camelcase
function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
{
    $str = str_replace(" ", "", ucwords(str_replace("-", " ", $string)));

    if (!$capitalizeFirstCharacter) {
        $str[0] = strtolower($str[0]);
    }

    return $str;
}

/*
 *  $moduleName:           (string) The name of JS module, without the .js suffix (e.g. 'enable-flyout')
 *  $supportingModule:     (array) contains the paths to other Enable JS modules
 *                         (outside modules don't belong here)
 *  $bemPrefix:            (string) The BEM prefix used for CSS classes in this library. For example
 *                         the Enable Hamburger menu uses `enable-flyout` for it's CSS classes
 *                         (enable-flyout__container, enable-flyout__secondary-navigation, etc)
 *  $isPolyfill:           (boolean) Set to true or false, depending if this is a polyfill or not.  Right now,
 *                         it is exclusively used for the HTML dialog polyfill
 *  $other:                (array) contains other properties. Current ones are:
 *                             - needsAccessibilityLib: (boolean) if we need accessibility.js
 *                             - needsGlider: (boolean) if we need the Glider.js carousel library
 *                             - needsAblePlayerLibs: (boolean) if we need the AblePlayer library
 *                             - otherImports: (string) JS code used to import 3rd party libraries
 *                             - noCSS: (boolean) true if the module doesn't have any CSS included in Enable
 *                             - customInit: (string) relative path to an initialization JS file (e.g.
 *                               "../content/code-fragments/carousel-init.js")
 *                             - es6Notes: Any special notes you may need for es6 projects.
 *                             - otherSampleCode: What other same code is needed to make the component
 *                               initialized.
 *
 *  $doesHaveAddMethod     (boolean) Set to true if there is a method for this module, like .add(),
 *                         that is needed to initialize other instances of the component after page
 *                         load.  This is needed for the Enable Tabs component.
 *  $willWorkAfterPageLoad (boolean) Doesn't need an .add() method.  I think we should check to see
 *                         if we really need this.
 *  $noInit                (boolean) True if this library doesn't have an .init() method.
 */
function includeNPMInstructions(
    $moduleName,
    $supportingModuleNames = ["js/modules/accessibility.module.js"],
    $bemPrefix = null,
    $isPolyfill = false,
    $other = [],
    $doesHaveAddMethod = null,
    $willWorkAfterPageLoad = false,
    $noInit = false,
) {
    includeFileWithVariables("includes/npm.php", [
        "moduleName" => $moduleName,
        "moduleVar" => dashesToCamelCase($moduleName),
        "supportingModuleNames" => $supportingModuleNames,
        "isPolyfill" => $isPolyfill,
        "other" => $other,
        "doesHaveAddMethod" => $doesHaveAddMethod,
        "willWorkAfterPageLoad" => $willWorkAfterPageLoad,
        "noInit" => $noInit,
        "bemPrefix" => $bemPrefix,
    ]);
}

function includeStats($props)
{
    unset($isForNewBuilds, $doNot, $isNPM, $isStyle, $isExperimental, $comment);
    extract($props);
    global $walkthroughIndex;

    $npmLink =
        '(<a href="#npm-instructions">Module installation instructions</a>)';

    if (!isset($comment)) {
        if (isset($isForNewBuilds)) {
            if ($isForNewBuilds == true) {
                $comment =
                    "This is the best solution to use, especially when building from scratch.";
            } elseif ($isForNewBuilds == false) {
                $comment =
                    'If you are already using a component similar to this in existing work that is not accessible, go to the <a href="#developer-walkthrough-' .
                    $walkthroughIndex .
                    '">developer walkthrough</a> in this section to see how we made our implementation accessible.';
            }
        } elseif (isset($doNot)) {
            $comment =
                'This works, but <em>For the Love of God and All That is Holy, don\'t do this.</em>';
        } elseif (isset($isNPM)) {
            $comment =
                "This solution described below is available as an NPM module. " .
                $npmLink;
        } elseif (isset($isStyle)) {
            $comment =
                "This is a great solution to make CSS styling easier for developers.";
        }
    } else {
        if (isset($isNPM)) {
            $comment = $comment . " " . $npmLink;
        }
    }

    includeFileWithVariables("includes/stats.php", [
        "isForNewBuilds" => isset($isForNewBuilds) ? $isForNewBuilds : null,
        "doNot" => isset($doNot),
        "isNPM" => isset($isNPM),
        "isStyle" => isset($isStyle),
        "comment" => $comment,
    ]);
}

function includeShowcodeStaticBegin()
{
    global $walkthroughIndex;

    includeFileWithVariables("includes/showcode-static-begin.php", [
        "id" => "showcode-static__" . $walkthroughIndex,
    ]);

    $walkthroughIndex++;
}

function includeShowcodeStaticEnd()
{
    includeFileWithVariables("includes/showcode-static-end.php");
}

function getURIFilename()
{
    $uri = $_SERVER["REQUEST_URI"];

    $uriFile = explode("/", $uri);

    $lastIndex = count($uriFile) - 1;
    $dirSlug = $uriFile[$lastIndex - 1];
    $endSlug = $uriFile[$lastIndex];
    $fileSlug = explode("?", $endSlug)[0];

    if ($dirSlug === "info") {
        return $dirSlug . "/" . $fileSlug;
    } else {
        return $fileSlug;
    }
}

function getMetadata()
{
    global $fileProps;
    $uriFile = getURIFilename();
    $uriPrefix = getURIPrefix();
    $tokenToFind = trim(preg_replace("/^\//", "", $uriFile));
    $metaFile = "./data/meta-info.json";

    if (file_exists($metaFile)) {
        $myFile = fopen($metaFile, "r");
        $content = json_decode(fread($myFile, filesize($metaFile)));
        fclose($myFile);

        foreach ($content as $file => $fileProps) {
            $title = "";
            $desc = "";

            if (!property_exists($fileProps, "mainClass")) {
                $fileProps->mainClass = "";
            }

            //This loop allows me to work around with the keys
            if (strcmp($tokenToFind, $file) == 0) {
                $fileProps->posterImg =
                    $uriPrefix .
                    "/images/posters/" .
                    preg_replace('/\.php$/', ".jpg", $tokenToFind);
                $fileProps->uri = $uriPrefix . "/" . $file;
                if (strcmp($file, "index.php") == 0) {
                    $fileProps->type = "website";
                } else {
                    $fileProps->type = "article";
                }

                $fileProps->cacheBuster = 1;

                // Let's ensure these properties are entified.
                foreach ($fileProps as $prop => $propValue) {
                    // Check if the argument is not a string
                    if (!is_string($propValue)) {
                        // Convert the array (or other non-string data types) to a JSON string
                        $propValue = json_encode($propValue);
                    }
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

function give404IfNotValid()
{
    $file = "../content/body/" . getURIFilename();
    if (!file_exists($file)) {
        http_response_code(404);

        echo "";
        echo "<html><h1>404 Not Found</h1><!--" . $file . "--> </html>";
        exit();
    }
}

function getContent($title = "")
{
    includeFileWithVariables("../content/body/" . getURIFilename(), [
        "title" => $title,
    ]);
}

function getHeadTags()
{
    $headFile = "../content/head/" . getURIFilename();
    if (file_exists($headFile)) {
        includeFileWithVariables($headFile, []);
    }
}

function getBottomBodyTags()
{
    $file = "../content/bottom/" . getURIFilename();
    if (file_exists($file)) {
        includeFileWithVariables($file, []);
    }
}

function getPreBottomBodyTags()
{
    $file = "../content/pre-bottom/" . getURIFilename();
    if (file_exists($file)) {
        includeFileWithVariables($file, []);
    }
}

function getAsideContent()
{
    $file = "../content/aside/" . getURIFilename();
    if (file_exists($file)) {
        includeFileWithVariables($file, []);
    }
}

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return substr($haystack, 0, $length) === $needle;
}

function getURIPrefix()
{
    if (startsWith($_SERVER["REQUEST_URI"], "/enable/")) {
        return "https://www.useragentman.com/enable";
    } else {
        return "";
    }
}

getMetadata();

function processJsonFile()
{
    $uriFile = getURIFilename();
    $tokenToFind = trim(preg_replace("/^\//", "", $uriFile));
    $metaFile = "./data/meta-info.json";

    // Check if the file exists
    if (!file_exists($metaFile)) {
        echo "File does not exist: $metaFile\n";
        return;
    }

    // Read the file content
    $jsonContent = file_get_contents($metaFile);

    // Decode the JSON content
    $data = json_decode($jsonContent, true);

    // Check if the JSON was decoded successfully
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error decoding JSON: " . json_last_error_msg() . "\n";
        return;
    }

    // Check if the token exists in the data
    if (!array_key_exists($tokenToFind, $data)) {
        echo "Key '$tokenToFind' does not exist in the JSON data.\n";
        return;
    }

    // Get the item associated with the token
    $item = $data[$tokenToFind];

    $jsonLd = [
        "@context" => "https://schema.org",
        "@type" => "WebPage",
        "name" => isset($item["title"]) ? $item["title"] : "",
        "description" => isset($item["desc"]) ? $item["desc"] : "",
        "url" => isset($item["url"])
            ? str_replace("\/", "/", html_entity_decode($item["url"]))
            : "",
        "mainEntity" => [],
    ];

    // Process 'mainEntity' to generate JSON-LD structure
    if (isset($item["mainEntity"]) && is_array($item["mainEntity"])) {
        foreach ($item["mainEntity"] as $entity) {
            $mainEntity = [
                "@type" => isset($entity["type"]) ? $entity["type"] : "",
                "name" => isset($entity["title"]) ? $entity["title"] : "",
                "articleBody" => isset($entity["desc"]) ? $entity["desc"] : "",
                "url" => isset($entity["url"])
                    ? str_replace("\/", "/", html_entity_decode($entity["url"]))
                    : "",
            ];
            // Rename 'articleBody' to 'text' if type is 'HowTo'
            if (isset($entity["type"]) && $entity["type"] === "HowTo") {
                $mainEntity["text"] = isset($entity["desc"])
                    ? $entity["desc"]
                    : "";
                unset($mainEntity["articleBody"]);
            }
            $jsonLd["mainEntity"][] = $mainEntity;
        }
    }

    // Remove 'mainEntity' if it is an empty array
    if (empty($jsonLd["mainEntity"])) {
        unset($jsonLd["mainEntity"]);
    }

    // Remove empty attributes from the main jsonLd array
    $jsonLd = array_filter($jsonLd, function ($value) {
        return !empty($value);
    });

    // Output JSON-LD with pretty print
    $jsonLdStr = json_encode($jsonLd, JSON_PRETTY_PRINT);

    // Ensure slashes are not escaped in the final output
    $jsonLdStr = str_replace("\\/", "/", $jsonLdStr);

    echo '<script type="application/ld+json">' . $jsonLdStr . "</script>";
}

processJsonFile();

?>
