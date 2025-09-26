<p>Enscribe reads <abbr title="Web Video Text Tracks">WebVTT</abbr> cues and speaks them as audio descriptions (AD) in
  sync with video playback. This guide explains how to implement a plugin so Enscribe can control and sync with
  <strong>any</strong> video provider (custom players, iframes, SDKs, canvases, etc.).</p>
<p>The contract below is derived from the existing <code>enscribe-html5.js</code>, <code>enscribe-youtube.js</code>, and
  <code>enscribe-vimeo.js</code> plugins and the core <code>enscribe.js</code>.</p>


<h2>What properties and methods does enscribe.js provide</h2>


    <table>
      <caption>Enscribe.js exposes these helpers to plugins:</caption>
      <thead>
        <tr>
          <th scope="col">Function</th>
          <th scope="col">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">register(type, mod)</th><td>register your plugin object under a <code>type</code>.</td></tr>
        <tr>
          <th scope="row">speak(content, pause, play, player)</th><td>speaks text; optionally pauses/ducks the underlying player
        during the AD, then resumes.</td></tr>
        <tr>
          <th scope="row">getCueData(cue)</th><td>returns <code>{ content, pause, play }</code> derived from the cue’s HTML
        (<code>&lt;span class="pause"&gt;</code> or <code>play</code> toggles).</td></tr>
        <tr>
          <th scope="row">sanatizeTrack(track)</th><td>ensures each cue is at least ~300 ms long (Safari quirk fix).</td></tr>
      </tbody>
    </table>
    
    <table>
      <caption><strong>player object</strong> for each media element marked with <code>data-enscribe</code></caption>
      <thead>
        <tr>
          <th scope="col">property</th>
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
          <code>"youtube"</code>, or your custom type).</td>
        <tr>
          <th scope="row">player.standardSource</th>
          <td>Main video identifier/URL inferred from the element.</td>
        <tr>
          <th scope="row">player.ADSource</th>
          <td>Optional alternate source from <code>data-enscribe-ad-video-source</code> used when AD is enabled.</td>
        <tr>
          <th scope="row">player.enabled</th>
          <td>Whether AD is currently on. Toggled by a control with
          <code>data-enscribe-ad-control-for="{element.id}"</code>.</td>
        <tr>
          <th scope="row">player.ADPlaying</th>
          <td>Internal flag set while an AD utterance is in progress.</td>
</tbody>
</table>

<div class="tip"><strong>UI wiring:</strong> Core finds buttons or checkboxes with
  <code>data-enscribe-ad-control-for</code> and keeps their state in sync with <code>player.enabled</code>. Your plugin
  doesn’t need to handle the UI.</div>

<h2>Minimal DOM required</h2>

<figure class="wide">


  <?php includeShowcode("dom-required", "", "", "", false); ?>

  <figcaption>Figure 1. Basic DOM for a video player that supports enscribe.js.</figcaption>


</figure>

<script type="application/json" id="dom-required-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Basic DOM for a video player that supports enscribe.js",
    "highlight": "%INLINE%dom-required",
    "notes": ""
  }]
}
</script>

<template id="dom-required" data-type="html">
<!-- Your media element must have an id and a type -->
<iframe id="myVid" data-enscribe="myplayer" src="…"></iframe>

<!-- AD toggle control (button or checkbox) -->
<button type="button" data-enscribe-ad-control-for="myVid" aria-pressed="false" aria-checked="false">
  Audio description
</button>

<!-- Optional: alternate video source when AD is ON -->
<iframe id="myVid" data-enscribe="myplayer" data-enscribe-ad-video-source="…ad version…"></iframe>
</template>

<p>Optional attributes on the media element:</p>
<ul>
  <li><code>data-enscribe-global-pause</code> — always pause the video during AD (unless a cue has
    <code>&lt;span class="play"&gt;</code>).</li>
  <li><code>data-enscribe-ducking="0.25"</code> — lower the video volume during AD instead of pausing (value is the
    temporary volume).</li>
  <li><code>data-enscribe-use-readium="true"</code> — use Readium voice integration when available.</li>
</ul>


<h2>The <em>plugin object</em> API</h2>

<p>Register a single object with methods below. Only <code>setup</code> is strictly required, but implementing them all
  gives best UX.</p>
<dl>
  <dt><code>async setup(player, helpers)</code></dt>
  <dd>
    Called once after the module is dynamically loaded. Typical responsibilities:
    <ul>
      <li>Load your provider’s SDK if required.</li>
      <li>Create or obtain a <strong>TextTrack</strong> containing the AD cues and store it on
        <code>player.ADTrack</code> (plus keep a reference to the <code>&lt;track&gt;</code> element as
        <code>player.trackEl</code> if you create one).</li>
      <li>Call <code>sanatizeTrack(player.ADTrack)</code> once the track is loaded.</li>
      <li>Subscribe to playback-time updates and, when AD is enabled and the current time enters a cue window, call
        <code>speak(...Object.values(getCueData(cue)), player)</code>.</li>
    </ul>
    <p class="tip">If your provider doesn’t support TextTracks, emulate them by creating a hidden
      <code>&lt;video&gt;</code> with a <code>&lt;track&gt;</code> pointing at your WebVTT. Let the browser parse VTT to
      a <code>TextTrack</code>; read cues from there. This is how the Vimeo plugin works.</p>
  </dd>

  <dt><code>control(player, action)</code></dt>
  <dd>Handle <code>"play"</code> and <code>"pause"</code>. Core uses this when it needs to pause/resume during an
    utterance.</dd>

  <dt><code>getVolume(player) → Promise&lt;number&gt;</code></dt>
  <dd>Return the current volume in the provider’s 0–1 range. Used for ducking.</dd>

  <dt><code>setVolume(player, value)</code></dt>
  <dd>Set provider volume (0–1). Core restores the original value when AD finishes.</dd>

  <dt><code>async updateSource(player, which)</code></dt>
  <dd>When <code>player.ADSource</code> is present, core calls this with <code>"AD"</code> or <code>"standard"</code>
    whenever AD is toggled. Implement seamless source swapping that preserves current time and play/pause state. (See
    <code>html5</code> plugin for a reference.)</dd>
</dl>

<div class="warn"><strong>Important:</strong> Don’t call <code>speak()</code> repeatedly for the same cue. Track the
  “currently active” cue and only fire on transitions (e.g., when <code>prevCue !== activeCue</code>).</div>

<h2>Cue detection loop (reference implementation)</h2>

<figure class="wide">


  <?php includeShowcode("cue-code", "", "", "", false); ?>

  <figcaption>Figure 1. Basic DOM for a video player that supports enscribe.js.</figcaption>


</figure>

<script type="application/json" id="cue-code-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Basic DOM for a player",
    "highlight": "%INLINE%cue-code",
    "notes": ""
  }]
}
</script>

<template id="cue-code" data-type="js">
/** Example inside your setup() */
let lastCue = null;

function findActiveCue(track, t) {
  if (!track || !track.cues) return null;
  for (const cue of track.cues) {
    if (t >= cue.startTime && t < cue.endTime) return cue;
  }
  return null;
}

function onTick(currentTime) {
  if (!player.enabled || player.ADPlaying) return;
  const cue = findActiveCue(player.ADTrack, currentTime);
  if (cue && cue !== lastCue) {
    lastCue = cue;
    const {content, pause, play} = getCueData(cue);
    speak(content, pause, play, player); // handles pause/ducking internally
  } else if (!cue) {
    lastCue = null;
  }
}

// Wire provider time updates → onTick()
// Strategy A: SDK event
// provider.on('timeupdate', (t) => onTick(t.seconds));
// Strategy B: Polling
// player._interval = setInterval(async () => {
//   const t = await provider.getCurrentTime();
//   onTick(t);
// }, 100);
</template>

<h2>Where do the cues come from?</h2>
<p>Enscribe expects cues to be real <code>VTTCue</code>s so <code>getCueData(cue)</code> can call
  <code>cue.getCueAsHTML()</code>. Use one of these patterns in <code>setup()</code>:</p>
<ol>
  <li><strong>Provider supports tracks:</strong> If your provider exposes a <code>TextTrackList</code>, pick the right
    track (e.g., metadata or captions) and assign it to <code>player.ADTrack</code>.</li>
  <li><strong>Provider lacks tracks:</strong> Create a hidden HTML5 <code>&lt;video muted&gt;</code> element with a
    child <code>&lt;track src="/path/to/descriptions.vtt" kind="metadata" default&gt;</code>. Read
    <code>video.textTracks[0]</code> once the track <code>load</code> event fires; store it as
    <code>player.ADTrack</code>. Then call <code>sanatizeTrack(player.ADTrack)</code>.</li>
</ol>

<figure class="wide">


  <?php includeShowcode("cue-source", "", "", "", false); ?>

  <figcaption>Figure 1. Basic DOM for a video player that supports enscribe.js.</figcaption>


</figure>

<script type="application/json" id="cue-source-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Basic DOM for a player",
    "highlight": "%INLINE%cue-source",
    "notes": ""
  }]
}
</script>

<template id="cue-source" data-type="js">
// Hidden parser example
const v = document.createElement('video');
v.muted = true; v.preload = 'metadata'; v.style.display = 'none';
const track = document.createElement('track');
track.kind = 'metadata';
track.src = player.element.getAttribute('data-enscribe-vtt'); // define your own attribute
track.addEventListener('load', () =>; {
  player.ADTrack = track.track;
  sanatizeTrack(player.ADTrack);
});
v.appendChild(track);
document.body.appendChild(v);
</template>

<h2>Full plugin template</h2>

<figure class="wide">


  <?php includeShowcode("plugin-template", "", "", "", false); ?>

  <figcaption>Figure 1. Basic DOM for a video player that supports enscribe.js.</figcaption>


</figure>

<script type="application/json" id="plugin-template-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Basic DOM for a player",
    "highlight": "%INLINE%plugin-template",
    "notes": ""
  }]
}
</script>

<template id="plugin-template" data-type="js">
// enscribe-myplayer.js (ES module)
import { register, getCueData, speak, sanatizeTrack } from './enscribe.js';

let sdkReady;
function loadSDK() {
  if (sdkReady) return sdkReady;
  sdkReady = new Promise((res) => {
    const s = document.createElement('script');
    s.onload = res;
    s.src = 'https://example.com/player-sdk.js';
    document.head.appendChild(s);
  });
  return sdkReady;
}

const mod = {
  async setup(player /*, { speak, getCueData } */) {
    await loadSDK();

    // 1) Acquire or synthesize a TextTrack of AD cues
    if (!player.ADTrack) {
      const vtt = player.element.getAttribute('data-enscribe-vtt');
      if (vtt) {
        const v = document.createElement('video');
        v.muted = true; v.preload = 'metadata'; v.style.display = 'none';
        const t = document.createElement('track');
        t.kind = 'metadata'; t.src = vtt; t.default = true;
        t.addEventListener('load', () => { sanatizeTrack(player.ADTrack); }, { once: true });
        v.appendChild(t);
        document.body.appendChild(v);
        player.trackEl = t;
        player.ADTrack = t.track;
      }
    }

    // 2) Wire time updates → speak()
    let lastCue = null;
    const onTick = (currentTime) => {
      if (!player.enabled || player.ADPlaying || !player.ADTrack) return;
      const cues = player.ADTrack.cues || [];
      let active = null;
      for (const cue of cues) if (currentTime >= cue.startTime && currentTime &lt; cue.endTime) { active = cue; break; }
      if (active && active !== lastCue) {
        lastCue = active;
        const { content, pause, play } = getCueData(active);
        speak(content, pause, play, player);
      } else if (!active) {
        lastCue = null;
      }
    };

    // Replace these with your provider’s APIs
    if (player.element.provider) {
      player.element.provider.on('timeupdate', (t) => onTick(t.seconds));
    } else {
      player._interval = setInterval(() => {
        const t = /* obtain currentTime from your SDK */ 0;
        onTick(t);
      }, 100);
    }
  },

  // Required for pause/resume during AD
  control(player, action) {
    if (action === 'pause') {/* provider.pause() */}
    if (action === 'play')  {/* provider.play()  */}
  },

  // Required for ducking support
  async getVolume(player) { return 1; /* provider.getVolume() 0–1 */ },
  async setVolume(player, v) { /* provider.setVolume(v) */ },

  // Optional: swap to an alternate source when AD is enabled
  async updateSource(player, which) {
    if (!player.ADSource) return;
    const wasPaused = /* read state */ false;
    const t = /* read currentTime */ 0;
    const src = which === 'AD' ? player.ADSource : player.standardSource;
    /* load src */
    /* seek to t */
    if (!wasPaused) {/* resume */}
  }
};

register('myplayer', mod);
export default mod;
</template>

<h2>Provider-specific notes</h2>
<ul>
  <li><strong>HTML5:</strong> Use native <code>video.textTracks</code>. Implement <code>setHTML5TrackMode(player)</code>
    (enable/disable the AD track) for best UX.</li>
  <li><strong>YouTube iframe API:</strong> Poll with <code>setInterval(..., 100ms)</code> to read
    <code>getCurrentTime()</code>; fire <code>speak()</code> on cue transitions; clear the interval when destroyed.</li>
  <li><strong>Vimeo Player API:</strong> If you can’t attach a real track to the Vimeo iframe, parse cues via a hidden
    HTML5 <code>&lt;video&gt;</code> + <code>&lt;track&gt;</code> element, then use Vimeo’s <code>timeupdate</code> to
    drive the detection loop.</li>
</ul>

<h2>Testing checklist</h2>
<ul>
  <li>Cues speak exactly once when entering the cue window.</li>
  <li>Global pause (<code>data-enscribe-global-pause</code>) pauses video during AD unless the cue contains
    <code>&lt;span class="play"&gt;</code>.</li>
  <li>Ducking (<code>data-enscribe-ducking</code>) lowers volume then restores it after AD completes.</li>
  <li>Toggling AD updates both playback (via <code>updateSource</code> or track mode) and the button/checkbox state.
  </li>
  <li>AD timing remains stable across browsers; <code>sanatizeTrack()</code> has been applied.</li>
</ul>

<h2>FAQ</h2>

<dl>
  <dt>How do I parse custom markup inside cues?</dt>
  <dd>Use <code>getCueData(cue)</code>. It calls <code>cue.getCueAsHTML()</code> and extracts text and flags for
    <code>&lt;span class="pause"&gt;</code>/<code>play</code>. You can extend this by looking for your own class names
    inside that HTML.</dd>

  <dt>Can I provide synthesized voices?</dt>
  <dd>Yes. If the media element has <code>data-enscribe-use-readium="true"</code>, the core lazily imports
    <code>enscribe-voice.js</code> to build a more advanced <code>SpeechSynthesisUtterance</code>. Otherwise the web
    platform’s Speech Synthesis voices are used.</dd>
</dl>