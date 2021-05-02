<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta charset="utf8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet" type="text/css" href="css/showcode.css">
<link href="css/libs/prism.css" rel="stylesheet" />

<!-- This is the global stylesheet -->
<link rel="stylesheet" href="css/shared/all.css" />


<?php
    function includeFileWithVariables($fileName, $variables) {
        extract($variables);
        include($fileName);
    }

    function includeShowcode($id, $cssId = "", $jsId = "") {
        includeFileWithVariables('includes/showcode-template.php', array(
            'id' => $id,
            'cssId' => $cssId,
            'jsId' => $jsId
        ));
    }
?>

