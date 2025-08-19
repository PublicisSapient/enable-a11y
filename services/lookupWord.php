<?php

header("Content-Type: application/json; charset=utf-8");

// Identify your app clearly per Wikimedia policy
$ua = 'enable-a11y-lookup/1.0 (+https://useragentman.com/enable/services/lookupWord.php; mailto:zoltan.dulac@gmail.com)';

$word = $_GET['word'] ?? '';
if ($word === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Missing "word" query parameter']);
    exit;
}

$error = "";

$arrContextOptions = [
    // Add HTTP context to set a User-Agent (and Accept)
    "http" => [
        "method"        => "GET",
        "header"        => "User-Agent: $ua\r\nAccept: application/json\r\n",
        "timeout"       => 10,
        "ignore_errors" => true, // lets you read body on non-200s if needed
    ],
    "ssl" => [
        // NOTE: for development you had these off; for production set both to true.
        "verify_peer"      => false,
        "verify_peer_name" => false,
    ],
];

set_error_handler(function($severity, $message, $file, $line){
    throw new ErrorException($message, 0, $severity, $file, $line);
});

try {
    $url = "https://en.wiktionary.org/w/api.php?action=parse&format=json&prop=text|revid|displaytitle&page=" .
           rawurlencode($word);

    $response = file_get_contents($url, false, stream_context_create($arrContextOptions));

    if ($response === false) {
        throw new RuntimeException('Request failed');
    }

    echo $response; // (fixed typo: was $reponse)
} catch (Throwable $e) {
    http_response_code(502);

    $other = " You may need to configure PHP to accept https connections. " .
        "If you are using macports, look at the end of this document for a fix: " .
        "https://ports.macports.org/port/php81/details/ ";

    echo json_encode(['error' => $e->getMessage() . $other]);
} finally {
    restore_error_handler();
}

?>
