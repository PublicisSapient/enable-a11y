<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<link rel="stylesheet" type="text/css" href="css/showcode.css">

<?php
    function includeFileWithVariables($fileName, $variables) {
        extract($variables);
        include($fileName);
    }

    function includeShowcode($id) {
        includeFileWithVariables('includes/showcode-template.php', array(
            'id' => $id
        ));
    }
?>

