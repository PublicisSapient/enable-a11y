<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta charset="utf-8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet" type="text/css" href="css/showcode.css">
<link href="css/libs/prism.css" rel="stylesheet" />

<!-- This is the global stylesheet -->
<link id="all-css" rel="stylesheet" href="css/shared/all.css" />
<link id="read-all-css" rel="stylesheet" href="css/shared/read-more.css" />

<!-- hamburger menu -->
<link id="hamburger-style" rel="stylesheet" type="text/css" href="css/hamburger-menu.css" />


<link id="site-css" rel="stylesheet" href="css/site.css" />


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
?>

