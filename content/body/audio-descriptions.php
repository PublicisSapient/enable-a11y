<p>Audio descriptions (AD) make on-screen visuals accessible to blind and low-vision viewers.  The traditional workflow of scripting, voice talent, re-editing, and re-rendering makes creation and updates slow and costly, so audio-descriptions are often not implemented on websites.  Enscribe removes that barrier: if you write time-coded descriptions in a simple WebVTT file, Enscribe will use the browser’s SpeechSynthesis API to say them at the right moments in the video. </p>

<p>We would like to thank Jeremy Burr, who kindly donated the original code that Enscribe is based on. </p>


<p>If you are unfamilar with how to create a WebVTT file, please read <a
        href="/multimedia-content.php#how-to-edit-and-create-caption-files--heading">the "How to Edit and Create Caption
        Files" section of the Enable multimedia page</a>.</p>



<h2>Examples</h2>

<h3>HTML5 Video</h3>

<p>Use the code walkthrough component below this simple HTML5 video example. It's just five easy steps to add audio
    descriptions to any video using Enscribe.</p>

<div id="enscribe-html5-example" class="enable-example">
    <div class="enscribe-video-container">
        <button type="button" data-enscribe-ad-control-for="html5-example-video" class="icon-audio-descriptions" role="switch" aria-checked="true" aria-label="Activate audio descriptions">
        </button>
    
        <video id="html5-example-video" class="enable-video" data-enscribe="html5" controls data-enscribe-global-pause="true" playsinline>
            <source src="videos/plan-9-trailer-enscribe--av1.mp4" type='video/mp4; codecs="av01.0.05M.08, mp4a.40.2"'>
            <source src="videos/plan-9-trailer-enscribe.mp4" 
                type="video/mp4">
            <track src="vtt/plan-9-trailer.en.vtt" kind="captions" srclang="en" label="English">
            <track src="vtt/plan-9-trailer--ad.en.vtt" kind="descriptions" srclang="en" label="Audio Descriptions">
        </video>
    </div>
    

</div>

<?php includeShowcode("enscribe-html5-example", headingLevel: 4) ?>
<script type="application/json" id="enscribe-html5-example-props">
{
    "replaceHtmlRules": {
        "string:id=": ""
    },
    "steps": [
    {
        "label": "Include Enscribe into you project",
        "highlight": "%OUTERHTML%enscribe-js ||| type=\\\"module\\\"",
        "notes": "Note that it must be of type module"
    },
    {
        "label": "Ensure data-enscribe is set to the right video type",
        "highlight": "data-enscribe=\\\"html5\\\"",
        "notes": "Currently, valid values are <code>html5</code>, <code>youtube</code> and <code>vimeo</code>.  When the enscribe script encounters these, it will dynamically load <code>enscribe-html5.js</code>, <code>enscribe-youtube.js</code> and <code>enscribe-vimeo.js</code>, respectively.  It only loads the modules it needs."
    },
    {
        "label": "Load the audio description VTT file",
        "highlight": "%OPENTAG%track kind=\"descriptions\"",
        "notes": "The <code>kind</code> must be set to <code>descriptions</code> in order for the Enscribe script to pick it up."
    },
    {
        "label": "Create the UI for an audio description button",
        "highlight": "%OPENCLOSECONTENTTAG%button data-enscribe-ad-control-for",
        "notes": "There are many types of controls you can use to turn on and off audio descriptions.  For the HTML5 version, I decided to use a <code>button</code> with <code>role=\"switch\"</code>, but you can use <a href=\"#controls\">any of the controls to turn Enscribe audio descriptions on and off</a> listed below."
    },
    {
        "label": "Create the audio description file.",
        "highlight": "%FILE% vtt/blind-angels-descriptions.vtt",
        "notes": "This is in the standard WebVTT format. The <code>&lt;c.pause&gt; ... &lt;/c&gt</code> markup ensures the player pauses for the particular audio-description.  This is a useful feature when the description is long and you don't want it to overlap with the existing audio.  If you want Enscribe to pause the video on every description, you can just set <code>data-enscribe-global-pause=\"true\"</code> to the <code>video</code> tag instead."
    }
]}
</script>




<h3>Vimeo</h3>

<div id="vimeo-example" class="enable-example">


    <iframe title="Vimeo Video Example" id="vimeo-example-video" class="enable-video" data-enscribe="vimeo" data-enscribe-global-pause="true"
        data-enscribe-vtt-path="../vtt/bela-ad.en.vtt"
        src="https://player.vimeo.com/video/1115565292?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" 
        allowfullscreen allow="autoplay; encrypted-media"></iframe>
    
    <label>
        <input type="checkbox" data-enscribe-ad-control-for="vimeo-example-video" class="icon-audio-descriptions" checked>
        Turn on audio descriptions
    </label>
</div>

<?php includeShowcode("vimeo-example", headingLevel: 4) ?>
<script type="application/json" id="vimeo-example-props">
{
    "replaceHtmlRules": {
        "string:id=": ""
    },
    "steps": [
    {
        "label": "Include Enscribe into you project",
        "highlight": "%OUTERHTML%enscribe-js ||| type=\\\"module\\\"",
        "notes": "While this just file just contains the base code without Vimeo support, it will dynamically load the <code>enscribe-vimeo.js</code> when it detects a Vimeo video that is set up for Enscribe on the page. Enscribe will also load the Vimeo API itself, so developers don't need to do this."
    },
    {
        "label": "Ensure data-enscribe is set to the right video type",
        "highlight": "data-enscribe=\\\"vimeo\\\"",
        "notes": "This is how we tell Enscribe this <code>iframe</code> is a Vimeo video player. Other than the <code>data-enscribe-</code> elements, the <code>iframe</code> is set up just like any other Vimeo video."
    },
    {
        "label": "Set up Enscribe to pause the video when any audio description is spoken.",
        "highlight": "data-enscribe-global-pause=\\\"true\\\"",
        "notes": "Instead of using <code>c.pause</code> tags to indicate when an audio description should pause the video when spoken, we have set this globally for all audio descriptions here."
    },
    {
        "label": "Load the audio description VTT file",
        "highlight": "data-enscribe-vtt-path",
        "notes": "Since Vimeo doesn't use the <code>track</code> element, we need to use the <code>data-enscribe-vtt-path</code> attribute instead."
    },
    {
        "label": "Create the UI for an audio description button",
        "highlight": "%OPENTAG%input data-enscribe-ad-control-for",
        "notes": "There are many types of controls you can use to turn on and off audio descriptions.  For this Vimeo example, I decided to use an <code>input</code> with <code>type=\"radio\"</code> below the video, since Vimeo video players have default controls in all corners of the compoent. You can use <a href=\"#controls\">any of the controls to turn Enscribe audio descriptions on and off</a> listed below."
    },
    {
        "label": "Create the audio description file.",
        "highlight": "%FILE% vtt/vimeo-audio-descriptions.vtt",
        "notes": ""
    }
]}
</script>


<h3>YouTube</h3>

<div id="youtube-example" class="enable-example">
    <iframe title="Youtube Video Example" id="youtube-example-video" class="enable-video" data-enscribe="youtube"
        data-enscribe-VTT-path="../vtt/the-light-that-burned--ad.en.vtt" data-enscribe-global-pause="true"
        src="https://www.youtube.com/embed/Rju8qyPwngM?enablejsapi=1&rel=0"  allowfullscreen></iframe>
    <button type="button" data-enscribe-ad-control-for="youtube-example-video" class="icon-audio-descriptions" role="switch" aria-label="Activate audio descriptions" aria-checked="false"></button>
</div>

<?php includeShowcode("youtube-example", headingLevel: 4) ?>
<script type="application/json" id="youtube-example-props">
{
    "replaceHtmlRules": {
        "string:id=": ""
    },
    "steps": [
    {
        "label": "Include Enscribe into you project",
        "highlight": "%OUTERHTML%enscribe-js ||| type=\\\"module\\\"",
        "notes": "While this just file just contains the base code without YouTube support, it will dynamically load the <code>enscribe-youtube.js</code> when it detects a YouTube video that is set up for Enscribe on the page. Enscribe will also load the YouTube API itself, so developers don't need to do this."
    },
    {
        "label": "Ensure data-enscribe is set to the right video type",
        "highlight": "data-enscribe=\\\"youtube\\\"",
        "notes": "This is how we tell Enscribe this <code>iframe</code> is a YouTube video player. Other than the <code>data-enscribe-</code> elements, the <code>iframe</code> is set up just like any other YouTube video."
    },
    {
        "label": "Load the audio description VTT file",
        "highlight": "data-enscribe-vtt-path",
        "notes": "Since YouTube doesn't use the <code>track</code> element, we need to use the <code>data-enscribe-vtt-path</code> attribute instead."
    },
    {
        "label": "Create the UI for an audio description button",
        "highlight": "%OPENCLOSECONTENTTAG%button data-enscribe-ad-control-for",
        "notes": "Note that the aria-label must be set to screen reader label for the control if the content is an icon."
    },
    {
        "label": "Create the audio description file.",
        "highlight": "%FILE% vtt/youtube-audio-descriptions.vtt",
        "notes": ""
    }
]}
</script>


<h2>Support For Traditional Audio Descriptions with Human Voice Actors</h2>
<div id="youtube-human-ad-example" class="enable-example">
    <iframe title="Youtube Video Example" id="youtube-human-ad-example-video" class="enable-video" data-enscribe="youtube"
        data-enscribe-ad-video-source="eGwCYWSCnyY"
        src="https://www.youtube.com/embed/Rju8qyPwngM?enablejsapi=1&rel=0"  allowfullscreen></iframe>
    <button type="button" data-enscribe-ad-control-for="youtube-human-ad-example-video" class="icon-audio-descriptions" role="switch" aria-label="Activate audio descriptions" aria-checked="false"></button>
</div>

<?php includeShowcode("youtube-human-ad-example", headingLevel: 3) ?>
<script type="application/json" id="youtube-human-ad-example-props">
{
    "replaceHtmlRules": {
        "string:id=": ""
    },
    "steps": [
    {
        "label": "Include Enscribe into you project",
        "highlight": "%OUTERHTML%enscribe-js ||| type=\\\"module\\\"",
        "notes": "While this just file just contains the base code without YouTube support, it will dynamically load the <code>enscribe-youtube.js</code> when it detects a YouTube video that is set up for Enscribe on the page. Enscribe will also load the YouTube API itself, so developers don't need to do this."
    },
    {
        "label": "Ensure data-enscribe is set to the right video type",
        "highlight": "data-enscribe=\\\"youtube\\\"",
        "notes": "This is how we tell Enscribe this <code>iframe</code> is a YouTube video player. Other than the <code>data-enscribe-</code> elements, the <code>iframe</code> is set up just like any other YouTube video."
    },
    {
        "label": "Give Enscribe information about the audio described version of the video",
        "highlight": "data-enscribe-ad-video-source",
        "notes": "This tells enscribe the YouTube Video ID of the video source with the audio description. (<a href=\"https://gist.github.com/jakebellacera/d81bbf12b99448188f183141e6696817\">Lean more about YouTube Video IDs</a>).  If you were using any other video platform (e.g. HTML5 or Vimeo), then this would have the full URL of the audio described version of the video."
    },
    {
        "label": "Create the UI for an audio description button",
        "highlight": "%OPENCLOSECONTENTTAG%button data-enscribe-ad-control-for",
        "notes": "Note that the aria-label must be set to screen reader label for the control if the content is an icon."
    },
    {
        "label": "Create the audio description file.",
        "highlight": "%FILE% vtt/youtube-audio-descriptions.vtt",
        "notes": ""
    }
]}
</script>


<h2>Useful Attributes</h2>

<p>As we alluded to in the YouTube example above, there are a few <code>data-</code> attributes you can add to your
    <code>video</code> or <code>iframe</code> tag to
    configure Enscribe.
</p>


<table class="enable-table enable-table--with-borders">
    <thead>
        <tr>
            <th scope="col">Attribute name</th>
            <th scope="col">Purpose</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row" class="nowrap"><code>data-enscribe-global-pause</code></th>
            <td>Tells Enscribe if the video should pause when it is announcing an audio description. If set to
                <code>"true"</code>, then the video, by default, pauses when reading an audio description. If set to
                <code>"false"</code>, then the video will not pause when reading audio descriptions.
            </td>
        </tr>
        <tr>
            <th scope="row" class="nowrap"><code>data-enscribe-ducking</code></th>
            <td>Tells Enscribe what to set the video volume to when reading audio descriptions. This is useful when
                <code>data-enscribe-global-pause</code> is set to <code>"false"</code> and you want to ensure the audio
                descriptions can be heard above the video's audio stream.
            </td>
        </tr>
        <tr>
            <th scope="row" class="nowrap"><code>data-enscribe-use-readium</code></th>
            <td>Uses the <a href="https://readium.org/speech/">Readium Speech</a> library to pick the best voice
                available in the web browser. Good if you find the default voice used in a some browsers not optimal.
            </td>
        </tr>
        <tr>
            <th scope="row" class="nowrap"><code>data-enscribe-ad-video-source</code></th>
            <td>If you want to use an alternative cut of the video with audio descriptions already populated into the
                video's audio stream, set this attribute to be the path or the ID of this alternative cut.</td>
        </tr>
    </tbody>
</table>



<h2>Useful VTT Classes to Use</h2>

<p>
    You can have more granular control over what happens when certain audio descriptions are read using the <code>c</code> tag inside the WebVTT file.  You can find
<a href="https://developer.mozilla.org/en-US/docs/Web/API/WebVTT_API/Web_Video_Text_Tracks_Format#cue_payload_text_tags">more information about the tags WebVTT supports on MDN</a>.
</p>


<table class="enable-table enable-table--with-borders">
    <thead>
        <tr>
            <th scope="col">Class Name</th>
            <th scope="col">Purpose</th>
            <th scope="col">Example</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"><code>pause</code></th>
            <td>Will pause the video when this audio description is read out, no matter what
                <code>data-enscribe-global-pause</code> is set to.
            </td>
            <td><code>&lt;c.pause&gt;Scene is of a bridge over a river.&lt;/c&gt;</code>
            </td>
        </tr>
        <tr>
            <th scope="row"><code>play</code></th>
            <td>Will play the video when this audio description is read out, no matter what
                <code>data-enscribe-global-pause</code> is set to.
            </td>
            <td><code>&lt;c.play&gt;Scene is of a bridge over a river.&lt;/c&gt;</code>
            </td>
        </tr>

    </tbody>
</table>



<h2>Why Not Just Use AblePlayer?</h2>
<p>AblePlayer does have support for browser generated audio descriptions using WebVTT as well. However, it's a whole
    video player in
    itself. It ships with custom controls, styles, and it requires jQuery, an older JavaScript framework. All this adds
    to the amount of bandwidth needed to load your webpage. If you just want to layer AD on top of the players you
    already use, that's overkill.</p>

<p>Enscribe is quite small (under 15K) and is modular: it will only load the parts that you need. If you just need HTML5
    video support, it only loads the HTML5 module. If it comes across a YouTube video you want to use it with, it will
    download that at that point. </p>
