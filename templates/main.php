<?php
include "includes/functions.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

$isIframe = $_GET["isIframe"] ?? "";

if ($isIframe == "yes") {
    $mainContentTag = "div";
} else {
    $mainContentTag = "main";
}

give404IfNotValid();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/common-head-tags.php"; ?>
    <?php getHeadTags(); ?>
</head>

<body class="<?= isset($fileProps->bodyClass) ? $fileProps->bodyClass : "" ?>">
<!-- <div class="themed-layout-xxx"> -->
  <?php include "includes/documentation-header.php"; ?>

  <?php include "includes/pause-anim-control.php"; ?>

  <?php getAsideContent(); ?>

    <!-- <div class="layout-wrapper"> -->
        <!-- <div>
            <div class="sub-component-navigation">
                <nav >
                    <h2><a href="/components.php">Components</a></h2>
                    <ul>
                        <li><a href="/button.php">Button</a></li>
                        <li><a href="">Checkbox</a></li>
                    </ul>
                </nav>
            </div>
        </div> -->
        <<?= $mainContentTag ?> id="main" class="<?= $fileProps->mainClass ?>" tabindex="-1">

        <?php
        if (
            property_exists($fileProps, "mainClass") &&
            $fileProps->mainClass != "with-full-bleed-hero" &&
            isset($fileProps->title) &&
            !isset($fileProps->hideTitle)
        ) {
            print "<h1>" . $fileProps->title . "</h1>";
        }

        if (isset($fileProps->title)) {
            getContent($fileProps->title);
        } else {
            getContent("");
        }
        ?>

        </<?= $mainContentTag ?>>
    </div>

    <?php getPreBottomBodyTags(); ?>

    <?php include "includes/example-footer.php"; ?>

    <?php getBottomBodyTags(); ?>
<!-- </div> -->
</body>

</html>