<p>Making an audio player accessible entails meeting a number of different requirements. 
  As defined by the <a href="https://www.w3.org/WAI/media/av/player/">WCAG</a>, it is recommended that a media player do the following:</p>

<ul>
  <li>Provide full keyboard support with proper label for screen readers.</li>
  <li>Ensure all controls have proper contrast and clear focus indicators.</li>
  <li>Include playback speed controls for those with cognitive disabilities.</li>
  <li>Support for captions/subtitles (see our breakdown of this on the <a href="/video-player.php">Accessible Video Player</a> page).</li>
</ul>

<p>
  Due to the general complexity of this issue, it is recommended to use our custom build of <a href="https://ableplayer.github.io/ableplayer/">Able Player</a> to display the captions.  The nice thing about AblePlayer is that it also generates a caption for those who cannot hear the video but want to read the content contained within it.  Our build of Able Player includes code to ensure that it plays correctly across various browsers/devices (installation instructions are at the bottom of this page).  Providing a WebVTT caption file ensures that Able Player reads these captions at the correct timestamp. 
</p>


<h2>Accessible Audio Player using Able Player</h2>


<div id="example1">
  <div class="enable-media-player">
    <audio id="audio1" preload="auto" data-able-player data-skin="2020" data-root-path="./js/enable-libs/ableplayer/" data-heading-level="3">
      <source type="audio/mpeg" src="audio/audio.mp3" />
      <track kind="captions" src="vtt/audio.vtt" srclang="en" label="English Captions" />
    </audio>
  </div>
</div>

<?php includeShowcode("example1"); ?>
<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [
    {
      "label": "Add the data-able-player attribute to the audio tag.",
      "highlight": "data-able-player",
      "notes": "This tells the AblePlayer script that this media should be displayed with AblePlayer"
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
      "label": "Include the source tag with audio content",
      "highlight": "%OPENTAG%source",
      "notes": "The <code>src</code> attribute can either point to a local file or the URL of an audio file"
    },
    {
      "label": "Add the caption vtt file URL",
      "highlight": "%OPENTAG%track",
      "notes": "Note that <code>kind</code> attribute should be set to <code>captions</code> for closed captions."
    },
    {
      "label": "Write the captions track",
      "highlight": "%FILE%vtt/audio.vtt ",
      "notes": "WebVTT is the web standard format that all media should use for captions.  We used <a href=\"https://github.com/ggerganov/whisper.cpp\">Whisper.cpp</a>, an AI that can create captions, to do the initial work on the captions."
    },
    {
      "label": "Add speaker information to the caption file.",
      "highlight": "%FILE%vtt/audio.vtt ~ &lt;v[^;]*;",
      "notes": "All AI generated content needs to be remediated. We used <a href=\"https://nikse.dk/SubtitleEdit/\">Subtitle Edit</a> to correct any errors in the WebVTT file and add the speaker and sound effect information to it.  Although it is a Windows program, there are <a href=\"https://www.nikse.dk/SubtitleEdit/Help#linux\">instructions on how to run Subtitle Edit on Linux</a>."
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
