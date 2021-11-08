<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accessible Video Player</title>
    <?php include "includes/common-head-tags.php";?>
    <link id="able-player-css" href="js/libs/ableplayer/styles/ableplayer.css" rel="stylesheet" />
    <link id="enable-video-player-css" href="css/video-player.css" rel="stylesheet" />

</head>

<body>

    <?php include "includes/documentation-header.php";?>

    <div id="example1">
        <div class="enable-video-player">
            <video id="video1" data-vimeo-id="478201141" preload="auto" width="834" data-skin="2020">
                <track kind="captions" src="video-assets/a_safety_captions_en.vtt" srclang="en"/>
                <track kind="descriptions" src="video-assets/safety_descriptions_en.vtt" srclang="en"/>
            </video>
        </div>
    </div>

    <?php include "includes/example-footer.php"?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/libs/ableplayer/thirdparty/js.cookie.js"></script>
    <script src="js/libs/ableplayer/build/ableplayer.js"></script>
    <script src="js/libs/vimeoPlayer.js"></script>
    <script src="js/videoPlayer.js"></script>
</body>

</html>