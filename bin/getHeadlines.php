<?php
    header('Content-Type: application/json; charset=utf-8');

    //https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=d25934a07be84a96a22d882d5d91075b
    $response = file_get_contents("https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=d25934a07be84a96a22d882d5d91075b");
    echo $response;
?>
