<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accessible Video Player</title>
    <?php include "includes/common-head-tags.php";?>
    <link id="able-player-css" href="js/libs/ableplayer/styles/ableplayer.css" rel="stylesheet" />
    <link id="enable-video-player-css" href="css/video-player.css" rel="stylesheet" />
    <link href="css/table.css" rel="stylesheet">

</head>

<body>

    <?php include "includes/documentation-header.php";?>

    <main>

        <h1>Accessible Video Player</h1>

        <p>What makes a video accessible is widely misunderstood. Many web professionals know about closed captions.
            What many don't know is that they absolutely need audio descriptions in order to be WCAG AA compliant.</p>

        <table class="compliance-table">
            <caption>WCAG video compliance guidelines</caption>
            <thead>
                <tr>
                    <th scope="col"><span class="sr-only">Requirement</span></th>
                    <th scope="col">A</th>
                    <th scope="col">AA</th>
                    <th scope="col">AAA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Closed Captions</th>
                    <td>
                        <img class="compliance-table__icon" src="images/checkmark.svg" alt="required" />
                    </td>
                    <td>
                        <img class="compliance-table__icon" src="images/checkmark.svg" alt="required" />
                    </td>
                    <td>
                        <img class="compliance-table__icon" src="images/checkmark.svg" alt="required" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Audio Descriptions</th>
                    <td rowspan="2">
                        One or the other
                    </td>
                    <td>
                        <img class="compliance-table__icon" src="images/checkmark.svg" alt="required" />
                    </td>
                    <td>
                        <img class="compliance-table__icon" src="images/checkmark.svg" alt="required" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Transcripts</th>
                    <td>
                        <span class="sr-only">Not required</span>
                    </td>
                    <td>
                        <img class="compliance-table__icon" src="images/checkmark.svg" alt="required" />
                    </td>
                </tr>
            </tbody>
        </table>

        <p>
            For a lot of companies and organizations, re-cutting a alternative cut of each video on their website is
            cost prohibitive:
        </p>

        <ol>
            <li>It requires a voice-actor to recite the audio descriptions.</li>
            <li>It requires a video editor to re-edit the video.</li>
            <li>Sometimes, other footage needs to be shot to accomodate the amount of time needed to insert the audio
                descriptions into the video.</li>
        </ol>

        <p>
            Because of this, I have recommended using <a href="https://ableplayer.github.io/ableplayer/">Able Player</a>
            and have the browser insert the audio descriptions. It requires a separate caption file (in WebVTT format)
            so the player knows at what time the captions should be read out. In many instances, I also set the player
            to pause the video when the audio descriptions are recited, so the browser doesn't talk over the existing
            audio in the video.
        </p>

        <p>
            One of the great side-effects is that if you implement audio-descriptions this way, the caption file + the audio descriptions file will produce a transcript for free, so your video player will meet a WCAG AAA guideline.
        </p>

        <h2>Video Player With Text-To-Speech Audio Descriptions</h2>
        <div id="example1">
            <div class="enable-video-player">
                <video data-able-player id="video1" data-youtube-id="NINogq4BS68" preload="auto" data-skin="2020" data-root-path="./js/libs/ableplayer/">
                    <track kind="captions" src="vtt/dialog-document__html5.vtt" srclang="en" label="English" />
                    <track kind="descriptions" src="vtt/dialog-document__html5--desc.vtt" srclang="en"
                        label="English Audio Descriptions" />
                </video>
            </div>
        </div>

        <?php includeShowcode("example1")?>
        <script type="application/json" id="example1-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Add the data-able-player attribute to the video tag.",
                    "highlight": "data-able-player",
                    "notes": "This tells the AblePlayer script that this video should be displayed with AblePlayer"
                },
                {
                    "label": "Include YouTube video ID",
                    "highlight": "data-youtube-id",
                    "notes": "If you video is already on you tube, it is the one that appears as the <code>v</code> variable in the URL (e.g. <code>https://www.youtube.com/watch?v=<strong>NINogq4BS68</strong></code>)"
                },
                {
                    "label": "Add the caption and audio description vtt file URLs",
                    "highlight": "%OPENTAG%track",
                    "notes": "Note that <code>kind</code> attribute should be set to <code>captions</code> if they are closed captions, and <code>descriptions</code> if they are audio descriptions.  If you have both of these files (which allows you to be WCAG AA compliant) then you get the transcript functionality for free (a WCAG AAA requirement)."
                },
                {
                    "label": "Write the captions track",
                    "highlight": "%FILE%vtt/dialog-document__html5.vtt",
                    "notes": "WebVTT is the web standard format that all videos should use for video captions.  <a href=\"https://nikse.dk/SubtitleEdit/\">Subtitle Edit</a> was the tool used to create all the WebVTT files on this page.  Althought it is a Windows program, there are <a href=\"https://www.nikse.dk/SubtitleEdit/Help#linux\">instructions on how to run Subtitle Edit on Linux</a>."
                },
                {
                    "label": "Write the audio descriptions captions track",
                    "highlight": "%FILE%vtt/dialog-document__html5--desc.vtt",
                    "notes": "When the audio descriptions button is activated, the browser will announce them using the <a href=\"https://developer.mozilla.org/en-US/docs/Web/API/Web_Speech_API\">Web Speech API</a>.  For older browsers that don't support it, AblePlayer will use an aria-live region as a fallback."
                },
                {
                    "label": "Add AblePlayer customizations",
                    "highlight": "%JS%ablePlayerCustomizations ||| //[^<]*",
                    "notes": ""
                }
            ]
        }
        </script>

    </main>

    <?php include "includes/example-footer.php"?>

    
    <script src="js/modules/ablePlayerCustomizations.js" type="module"></script>

</body>

</html>