<?php

    header('Content-Type: application/json; charset=utf-8');

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );

    $response = file_get_contents("https://en.wiktionary.org/w/api.php?action=parse&format=json&prop=text|revid|displaytitle&page=" . $_GET["word"], false, stream_context_create($arrContextOptions));
    
    if (!isset($reponse)) {
        echo $response;
    } else {
        echo "You may need to configure PHP to accept https connections. \n";
        echo "If you are using macports, look at the end of this document for a fix: \n";
        echo "https://ports.macports.org/port/php81/details/ \n";
    }
?>