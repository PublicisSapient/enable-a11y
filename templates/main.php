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
  <main class="<?= $fileProps->mainClass ?>">
    <?php include "includes/pause-anim-control.php" ?>

    <?php 
      if ( property_exists($fileProps, 'mainClass') && $fileProps->mainClass != 'with-full-bleed-hero') {
        print '<h1>' . $fileProps->title . '</h1>';
        getContent($fileProps->title);
      } else { 
        getContent();
      }
    ?>
  </main>

    <?php getBottomBodyTags() ?>
    <?php include "includes/example-footer.php"?>
</body>

</html>