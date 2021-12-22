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

    <main>

        <h1>Accessible Video Player</h1>

        <p>Able Player is yada yada yada</p>

        <div id="example1">
            <div class="enable-video-player">
                <video data-able-player id="video1" data-youtube-id="NINogq4BS68" preload="auto"  data-skin="2020">
                    <track kind="captions" src="vtt/dialog-document__html5.vtt" srclang="en" label="English" />
                    <track kind="descriptions" src="vtt/dialog-document__html5--desc.vtt" srclang="en"
                        label="English Audio Descriptions" />
                </video>
            </div>
        </div>

    </main>

    <?php include "includes/example-footer.php"?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/libs/ableplayer/thirdparty/js.cookie.js"></script>
    <script src="js/libs/ableplayer/build/ableplayer.js"></script>
    <script src="js/videoPlayer.js"></script>

    <script>



    </script>

</body>

</html>