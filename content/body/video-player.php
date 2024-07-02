<p>What makes a video accessible is widely misunderstood. Many web professionals know about closed captions.
  What many don't know is that they need audio descriptions in order to be WCAG AA compliant.</p>

<?php include "includes/wcag-video-table.php"; ?>

<p>
  For a lot of companies and organizations, re-cutting an alternative cut of each video on their website is
  cost-prohibitive:
</p>

<ol>
  <li>It requires a voice actor to recite the audio descriptions.</li>
  <li>It requires a video editor to re-edit the video.</li>
  <li>Sometimes, other footage needs to be shot to accommodate the amount of time needed to insert the audio
    descriptions into the video.</li>
</ol>

<p>
  Because of this, I have recommended using our custom build of <a href="https://ableplayer.github.io/ableplayer/">Able Player</a>
  and having the browser insert the audio descriptions. We have added some extra code to our build to ensure that Able Player 
  plays the audio descriptions correctly on all devices (the official build has some issues in iOS &mdash; we will be submitting 
  a PR to the official AblePlayer code so they can be incorporated in the official build).   Able Player requires a separate caption file (in WebVTT format)
  so the player knows at what time the captions should be read out. In many instances, I also set the player
  to pause the video when the audio descriptions are recited, so the browser doesn't talk over the existing
  audio in the video.
</p>

<p>
  One of the great side effects is that if you implement audio descriptions this way, the caption file + the audio
  descriptions file will produce a transcript for free, so your video player will meet a WCAG AAA guideline.
</p>






<h2>Video Player With Text-To-Speech Audio Descriptions</h2>


<?php includeStats(["isForNewBuilds" => true]); ?>
<?php includeStats(["isNPM" => true]); ?>


<div id="example1">
  <div class="enable-video-player">
    <video data-able-player id="video1" data-youtube-id="NINogq4BS68" preload="auto" data-skin="2020"
      data-root-path="./js/enable-libs/ableplayer/" data-heading-level="3">
      <track kind="captions" src="vtt/dialog-document__html5.vtt" srclang="en" label="English">
      <track kind="descriptions" src="vtt/dialog-document__html5--desc.vtt" srclang="en"
        label="English Audio Descriptions">
    </video>
  </div>
</div>

<?php includeShowcode("example1"); ?>
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
      "label": "Add appropriate heading level",
      "highlight": "data-heading-level",
      "notes": [
        "<p>This dictates the (visually-hidden) heading level that is produced by JavaScript for the media player.",
        "According to the code comments:</p>",
        "<blockquote><em>By default, an off-screen heading is automatically added to the top of the media player",
        "It is intelligently assigned a heading level based on context, via misc.js &gt; ",
        "<code>getNextHeadingLevel()</code>.",
        "Authors can override this behavior by manually assigning a heading level using ",
        "<code>data-heading-level</code>",
        "Accepted values are 1-6, or 0 which indicates \"no heading\"",
        "(i.e., author has already hard-coded a heading before the media player; Able Player doesn't ",
        "need to do this)</em></blockquote>"
      ]
    },
    {
      "label": "Add the caption and audio description vtt file URLs",
      "highlight": "%OPENTAG%track",
      "notes": "Note that <code>kind</code> attribute should be set to <code>captions</code> if they are closed captions, and <code>descriptions</code> if they are audio descriptions.  If you have both of these files (which allows you to be WCAG AA compliant) then you get the transcript functionality for free (a WCAG AAA requirement)."
    },
    {
      "label": "Write the captions track",
      "highlight": "%FILE%vtt/dialog-document__html5.vtt",
      "notes": "WebVTT is the web standard format that all videos should use for video captions.  <a href=\"https://nikse.dk/SubtitleEdit/\">Subtitle Edit</a> was the tool used to create all the WebVTT files on this page.  Although it is a Windows program, there are <a href=\"https://www.nikse.dk/SubtitleEdit/Help#linux\">instructions on how to run Subtitle Edit on Linux</a>."
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


<?= includeNPMInstructions(
    "ablePlayerCustomizations",
    [],
    "",
    false,
    [
        "otherImports" =>
            "// AblePlayer uses this module, available via NPM<br/>import Cookies from 'js-cookie';",
    ],
    null,
    false,
    true,
) ?>

