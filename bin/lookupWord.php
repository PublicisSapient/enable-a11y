<?php

    header('Content-Type: application/json; charset=utf-8');

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );

    $response = file_get_contents("https://en.wiktionary.org/w/api.php?action=parse&format=json&prop=text|revid|displaytitle&page=" . $_GET["word"], false, stream_context_create($arrContextOptions));
    echo $response;
?>  


