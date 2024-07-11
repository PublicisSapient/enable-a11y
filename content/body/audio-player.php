<p>Making an audio player accessible entails meeting a number of different requirements. 
  As defined by the <a href="https://www.w3.org/WAI/media/av/player/">WCAG</a>, it is recommended that a media player do the following:</p>

<ul>
  <li>Provide full keyboard support with proper label for screen readers.</li>
  <li>Ensure all controls have proper contrast and clear focus indicators.</li>
  <li>Include playback speed controls for those with cognitive disabilities.</li>
  <li>Support for captions/subtitles (see our breakdown of this on the <a href="/video-player.php">Accessible Video Player</a> page).</li>
</ul>

<p>
  Due to the general complexity of this issue, it is recommended to use our custom build of <a href="https://ableplayer.github.io/ableplayer/">Able Player</a> and have the browser the audio descriptions.
  This build includes code to ensure that Able Player plays correctly across various browsers/devices. 
  Providing a WebVTT caption file ensures that Able Player reads these captions at the correct timestamp. 
</p>


<h2>Accessible Audio Player using Able Player</h2>


<div id="example1">
  <div class="enable-audio-player">
    <audio id="audio1" preload="auto" data-able-player data-skin="2020" data-root-path="./js/enable-libs/ableplayer/" data-heading-level="3">
      <source type="audio/mpeg" src="audio/example.mp3"/>
      <track kind="captions" src="vtt/dialog-document__html5.vtt" srclang="en" label="English Captions">
    </audio>
  </div>
</div>

<?php includeShowcode("example1"); ?>
<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [
    {
      "label": "TBD",
      "highlight": "",
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

