<p>Enscribe is designed to be modular so that developers can make plugins that can easily implement machine-read, WebVTT
  generated audio descriptions for any video platform that has a JavaScript API. This document will summarize what
  developers need to know to achieve that goal.</p>

<h2>What markup your plugin will support</h2>

<p>Enscribe assumes that all video embeds follow the following HTML code. Use the dropdown to go highlight each of the
  HTML attributes that Enscribe uses. </p>

<?php includeShowcode("dom-required", "", "", "", true, headingLevel: 0); ?>


<script type="application/json" id="dom-required-props">
{
  "replaceHtmlRules": {},
  "steps": [
    {
      "label": "Basic DOM for a video player that supports enscribe.js",
      "highlight": "data-enscribe=\\\"videoProviderName\\\"",
      "notes": "Note that <code>videoProviderName</code> must be replaced with the name of your video provider.  For example, when this is set to <code>youtube</code>, Enscribe knows that it must load the <code>enscribe-youtube.js</code> script in the same directory as <code>enscribe.js</code>."
    },
    {
      "label": "Connecting audio description button with the player.",
      "highlight": "data-enscribe-ad-control-for",
      "notes": "Setting a button's <code>data-enscribe-ad-control-for</code> to the video player's <code>id</code> ensures it will be able to turn audio descriptions on and off."
    },
    {
      "label": "Markup to support videos that already have audio described renditions",
      "highlight": "data-enscribe-ad-video-source",
      "notes": "Instead of having WebVTT based audio descriptions, it may be desirable to have Enscribe load a video that already has audio descriptions inside the default audio track.  The <code>data-enscribe-ad-video-source</code> allows support for this.  For example, for <code>enscribe-html.js</code>, this is set to the full URL of the alternate audio-described video; for <code>enscribe-youtube.js</code> it is set to the <a href='https://gist.github.com/jakebellacera/d81bbf12b99448188f183141e6696817'>YouTube Video ID</a> of the audio-described video.  It is up to the developer to figure out what they need here to perform this function."
    }
  ]
}
</script>


<template id="dom-required" data-type="html">
  <!-- Your media element must have an id and a type -->
  <iframe id="myVid" data-enscribe="videoProviderName" src="…"></iframe>

  <!-- AD toggle control (button or checkbox) -->
  <button type="button" data-enscribe-ad-control-for="myVid" aria-pressed="false" aria-checked="false">
    Audio description
  </button>

  <!-- Optional: alternate video source when AD is ON -->
  <iframe id="myVid" data-enscribe="videoProviderName" data-enscribe-ad-video-source="…ad version…"></iframe>
</template>


<h2>What do you need to build a plugin</h2>

<p>Register a single object with methods below. Only <code>setup</code> is strictly required, but implementing them all
  gives best UX.</p>

<table class="api-table">
  <caption>Functions needed to be implemented in an Enscribe plugin.</caption>
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">async setup(player, helpers)</th>
      <td>
        Called once after the module is dynamically loaded. Typical responsibilities:
        <ul>
          <li>Load your provider’s SDK if required.</li>
          <li>Create or obtain a <strong>TextTrack</strong> containing the AD cues and store it on
            <code>player.ADTrack</code> (plus keep a reference to the <code>&lt;track&gt;</code> element as
            <code>player.trackEl</code> if you create one).
          </li>
          <li>Call <code>sanatizeTrack(player.ADTrack)</code> once the track is loaded.</li>
          <li>Subscribe to playback-time updates and, when AD is enabled and the current time enters a cue window, call
            <code>speak(...Object.values(getCueData(cue)), player)</code>.
          </li>
        </ul>
        <p class="tip">If your provider doesn’t support TextTracks, emulate them by creating a hidden
          <code>&lt;video&gt;</code> with a <code>&lt;track&gt;</code> pointing at your WebVTT. Let the browser parse
          VTT to
          a <code>TextTrack</code>; read cues from there. This is how the Vimeo plugin works.
        </p>
      </td>

    <tr>
      <th scope="row">control(player, action)</th>
      <td>Handle <code>"play"</code> and <code>"pause"</code>. Core uses this when it needs to pause/resume during an
        utterance.</td>

    <tr>
      <th scope="row">getVolume(player) → Promise&lt;number&gt;</th>
      <td>Return the current volume in the provider’s 0–1 range. Used for ducking.</td>

    <tr>
      <th scope="row">setVolume(player, value)</th>
      <td>Set provider volume (0–1). Core restores the original value when AD finishes.</td>

    <tr>
      <th scope="row">async updateSource(player, which)</th>
      <td>When <code>player.ADSource</code> is present, core calls this with <code>"AD"</code> or
        <code>"standard"</code>
        whenever AD is toggled. Implement seamless source swapping that preserves current time and play/pause state.
        (See
        <code>html5</code> plugin for a reference.)
      </td>
    </tr>
  </tbody>
</table>

<p>To see how these functions are implemented in our existing plugins, it would be useful to look at the source of
  <code>enscribe-html.js</code>, <code>enscribe-vimeo.js</code> and <code>enscribe-youtube.js</code> in <a
    href="https://github.com/PublicisSapient/enable-a11y/tree/main/js/modules/enscribe">the Enscribe directory of the
    Enable github repository</a>.</p>

<div class="warn"><strong>Important:</strong> Don’t call <code>speak()</code> repeatedly for the same cue. Track the
  “currently active” cue and only fire on transitions (e.g., when <code>prevCue !== activeCue</code>).</div>

<h2>What To Do If Your Video Provider Doesn't Have a cuechange event</h2>

<p>The <code>enscribe-html5.js</code> plugin relies on the <a
    href="https://developer.mozilla.org/en-US/docs/Web/API/HTMLTrackElement/cuechange_event">cuechange event</a> to know
  when it should be reading out certain audio descriptions at certain times. Similarly, <code>enscribe-vimeo.js</code>
  uses <a href="https://developer.vimeo.com/player/sdk/reference#events-for-cue-points">Vimeo's cuechange event to do
    the same thing</a>. But what if the video provider you are making a plugin for doesn't have such an event.</p>

<p>This is different than how it works for the YouTube plugin. For the <code>enscribe-youtube.js</code> plugin, When the
  YouTube Iframe API is ready and playback has started, the plugin starts a 100 ms interval. Each tick:</p>

<ul>
  <li>Reads the current playback time with p.youtube.getCurrentTime().</li>
  <li>Skips if AD is disabled or an AD utterance is already playing.</li>
  <li>Detects quick backwards seeks (if now < lastTime - 0.2) and clears the “recent cue” guard.</li>
  <li>Scans the
      p.ADTrack.cues list and fires exactly when |now - cue.startTime| ≤ 0.1s.</li>
  <li>Dedupes by remembering the last fired startTime so the same cue won’t trigger twice.</li>
</ul>


<figure class="wide">


  <?php includeShowcode("cue-code", "", "", "", true); ?>

  <figcaption>Figure 1. Workaround code for YouTube's lack of a cuepoint/cuechange event.</figcaption>


</figure>

<script type="application/json" id="cue-code-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "The relevant code",
    "highlight": "%FILE%js/modules/enscribe/enscribe-youtube.js ~ [\\s]*const tick = ([\\s\\S]*\\s\\s\\});",
    "notes": ""
  }]
}
</script>


<h2>What properties and methods does enscribe.js provide</h2>


<table>
  <caption>Enscribe.js exposes these helpers to plugins:</caption>
  <thead>
    <tr>
      <th scope="col"><span class="sr-only">Function</span></th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">register(type, mod)</th>
      <td>register your plugin object under a <code>type</code>.</td>
    </tr>
    <tr>
      <th scope="row">speak(content, pause, play, player)</th>
      <td>speaks text; optionally pauses/ducks the underlying player
        during the AD, then resumes.</td>
    </tr>
    <tr>
      <th scope="row">getCueData(cue)</th>
      <td>returns <code>{ content, pause, play }</code> derived from the cue’s HTML
        (<code>&lt;span class="pause"&gt;</code> or <code>play</code> toggles).</td>
    </tr>
    <tr>
      <th scope="row">sanatizeTrack(track)</th>
      <td>ensures each cue is at least ~300 ms long (Safari quirk fix).</td>
    </tr>
  </tbody>
</table>

<table>
  <caption><strong>player object</strong> for each media element marked with <code>data-enscribe</code></caption>
  <thead>
    <tr>
      <th scope="col"><span class="sr-only">property</span></th>
      <th scope="col">value description</th>
    </tr>
  </thead>
  <tbody>


    <tr>
      <th scope="row">player.element</th>
      <td>The DOM element for your provider (e.g., &lt;video&gt;, &lt;iframe&gt;, or container).</td>
    <tr>
      <th scope="row">player.type</th>
      <td>The string used in <code>data-enscribe</code> and in <code>register()</code> (e.g., <code>"html5"</code>,
        <code>"youtube"</code>, or your custom type).
      </td>
    <tr>
      <th scope="row">player.standardSource</th>
      <td>Main video identifier/URL inferred from the element.</td>
    <tr>
      <th scope="row">player.ADSource</th>
      <td>Optional alternate source from <code>data-enscribe-ad-video-source</code> used when AD is enabled.</td>
    <tr>
      <th scope="row">player.enabled</th>
      <td>Whether AD is currently on. Toggled by a control with
        <code>data-enscribe-ad-control-for="{element.id}"</code>.
      </td>
    <tr>
      <th scope="row">player.ADPlaying</th>
      <td>Internal flag set while an AD utterance is in progress.</td>
  </tbody>
</table>

<div class="tip"><strong>UI wiring:</strong> Core finds buttons or checkboxes with
  <code>data-enscribe-ad-control-for</code> and keeps their state in sync with <code>player.enabled</code>. Your plugin
  doesn’t need to handle the UI.
</div>





<h2>Where do the cues come from?</h2>
<p>Enscribe expects cues to be real <a href="https://developer.mozilla.org/en-US/docs/Web/API/VTTCue">HTML5  VTTCues</a>a> so <code>getCueData(cue)</code> can call
  <code>cue.getCueAsHTML()</code>, so you will need to do the same for your plugin.  This is how we handled it in the existing plugins' <code>setup()</code> code:
</p>

<ol>
  <li>For <code>enscribe-html5.js</code>, we have access to the player's native VTTCue.  <strong>If the provider you are writing a plugin for exposes a <code>TextTrackList</code>,</stong> pick the right track (e.g., type="descriptions") and assign it to <code>player.ADTrack</code>.</li>
  <li><strong>When a video provider lacks tracks:</strong> Create a hidden HTML5 <code>&lt;video muted&gt;</code> element with a
    child <code>&lt;track src="/path/to/descriptions.vtt" kind="descriptions" default&gt;</code>. Read
    <code>video.textTracks[0]</code> once the track <code>load</code> event fires; store it as
    <code>player.ADTrack</code>. Then call <code>sanatizeTrack(player.ADTrack)</code>.
  </li>
</ol>
