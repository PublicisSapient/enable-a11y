<title><?php
global $fileProps;

if ($fileProps->title != '') {
  printf("%s | The Enable Project", $fileProps->title);
} ?></title>

<meta property="og:title" content="<?= $fileProps->title ?>" />
<meta property="og:description" content="<?= $fileProps->desc ?>" />
<meta property="og:image" content="<?= $fileProps->posterImg ?>" />

<meta name="twitter:card" content="photo">
<meta name="twitter:title" content="<?= $fileProps->title ?>" />
<meta name="twitter:image" content="<?= $fileProps->posterImg ?>" />

