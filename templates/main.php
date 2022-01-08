<?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1); 
  
  global $fileProps;  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/common-head-tags.php";?>
    <?php getHeadTags(); ?>
</head>

<body>
    <?php include "includes/documentation-header.php";?>

    <main>
    <?php include "includes/pause-anim-control.php" ?>
        <h1><?= $fileProps->title ?></h1>
        <?= getContent() ?>
      </main>

    <?php getBottomBodyTags() ?>
    <?php include "includes/example-footer.php"?>
</body>

</html>