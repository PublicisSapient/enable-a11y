<?php

$pattern = '/[0-9][0-9][a-z]*-([\S]+)$/';
$replace = 'skip-link.php';
$path = preg_replace($pattern, $replace, $_SERVER['PHP_SELF']);
// 301 Moved Permanently
function getProtocol()
{
    if (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443
    ) {
        return "https";
    } else {
        return "http";
    }
}

header("Location: " . getProtocol() . "://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $path, true, 301);
exit();
