<?php
    $pattern = '/[0-9][0-9][a-z]*-([\S]+)$/';
    $replace = '$1';
    $path = preg_replace($pattern, $replace, $_SERVER['PHP_SELF']);
    // 301 Moved Permanently
    header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $path, true, 301);;
    exit();
?>


