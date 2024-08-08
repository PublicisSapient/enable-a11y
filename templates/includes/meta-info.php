<title><?php
global $fileProps;

if ($fileProps->title != "") {
    printf("%s - The Enable Project", $fileProps->title);
}
?></title>

<meta property="og:title" content="<?= $fileProps->title ?>" />
<meta property="og:description" content="<?= $fileProps->desc ?>" />
<meta property="og:image" content="<?= $fileProps->posterImg ?>?<?= $fileProps->cacheBuster ?>" />
<meta property="og:url" content="<?= $fileProps->uri ?>" />
<meta property="og:type" content="<?= $fileProps->type ?>" />
<meta property="og:alt" content="" />
<meta property="article:author" content="Zoltan Hawryluk" />

<meta name="description" content="<?= $fileProps->desc ?>" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:description" content="<?= $fileProps->desc ?>" />
<meta name="twitter:title" content="<?= $fileProps->title ?>" />
<meta name="twitter:image" content="<?= $fileProps->posterImg ?>" />

<link rel="icon" type="image/x-icon" href="images/ENABLE.svg">


