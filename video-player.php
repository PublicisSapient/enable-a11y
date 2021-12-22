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
                <video
                    data-able-player
                    id="video1"
                    data-youtube-id="NINogq4BS68"
                    preload="auto"
                    data-skin="2020"
                    data-include-transcript
                >
                    <track kind="captions" src="vtt/dialog-document__html5.vtt" srclang="en" label="English" />
                    <track kind="descriptions" src="vtt/dialog-document__html5--desc.vtt" srclang="en"
                        label="English Audio Descriptions" />
                </video>

                <div id="example1-transcript" class="enable-video-player__transcript"></div>
            </div>
            <template id="enable-video-player__transcript-button-template">
                <div
                    role="button"
                    tabindex="0"
                    aria-label="Hide transcript"
                    class="able-button-handler-transcript"
                >
                    <svg focusable="false" aria-hidden="true" viewBox="${viewBox}">
                        <path d="${path}"></path>
                    </svg>
                    <span class="able-clipped">Hide transcript</span>
                </div>
            </template>
        </div>

    </main>

    <?php include "includes/example-footer.php"?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/libs/ableplayer/thirdparty/js.cookie.js"></script>
    <script src="js/libs/ableplayer/build/ableplayer.js"></script>
    <script src="js/shared/interpolate.js"></script>
    <script src="js/videoPlayer.js"></script>

    <script>



    </script>

</body>

</html>