<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        "All the examples here are useful for new and existing work where you want to pause animated GIFs in the most straightforward way.",
]); ?>

<div class="pausable-animated-gif__warning-message">
  <?php includeStats([
      "isForNewBuilds" => false,
      "comment" =>
          'Warning: All animations are currently paused because of the <a href="pause-anim-control.php">Pause Animations Control</a> at the top of the page being checked.',
  ]); ?>
</div>

<p>If you are going to have animated GIFs that are longer than 5 seconds on your page, you really should have a pause
  button on them. Not only do users with ADHD find them distracting, but the vast majority of users find them annoying.</p>

<p>I am one of them. Don't get me wrong: I love GIF memes as much as anyone. But when I'm trying to read the content on
  an e-commerce site, I will leave if some baby is dancing all over the place elsewhere on the screen. I find it annoying.</p>

<p>Animated GIFs also use up unnecessary battery power.</p>

<p>All users should be able to pause animated GIFs. What follows is a simple way to implement this feature, since it is
  not built-in functionality with the <code>&lt;img&gt;</code> tag (although, you think it would be right now, given
  animated GIFs have been around since <a href="https://en.wikipedia.org/wiki/Netscape_Navigator_2">Netscape Navigator
    2.0</a>).</p>


<p>The ideas in this demo were stolen from <a href="https://codepen.io/stevef/pen/ExPdNMM">this CodePen by Steven
    Faulkner</a>.
  The pause first example was from <a href="https://css-tricks.com/pause-gif-details-summary/">Chris
    Coyier</a>.
</p>


<h2>Animation off by default</h2>


<p>This is the preferred and simplest way of embedding animated GIFs: only have them animate if the user explicitly wants to see them.</p>

<div id="example1" class="enable-example">

  <div class="pausable-animated-gif">
    <img src="images/running-man-anim__still.jpg" alt="A drawing of a man running" loading="lazy">
    <details>

      <summary role="button" class="pausable-animated-gif__play-pause-button" aria-label="play">
      </summary>

      <div class="pausable-animated-gif__animated-image">
        <img src="images/running-man-anim.gif" alt="Animated: A drawing of a man running" loading="lazy">
      </div>
    </details>
  </div>
</div>



<?php includeShowcode("example1"); ?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Put in details and summary tag structure in HTML",
      "highlight": "%OPENCLOSETAG%details ||| %OPENCLOSECONTENTTAG%summary",
      "notes": ""
    },
    {
      "label": "Place role of button inside the summary",
      "highlight": "role",
      "notes": "This is to ensure iOS reports this correctly to VoiceOver"
    },
    {
      "label": "Put animated GIF after the summary tag and the poster image of the animation just before the details tag",
      "highlight": "%OPENTAG%img",
      "notes": "Note that the div surrounding the animated GIF is there for styling purposes.  It ensures that, when the summary widget is expanded, the animated image is placed over the still poster"
    },
    {
      "label": "Don't forget the alternative text for the images!",
      "highlight": "alt",
      "notes": "Alternative text describes these images to screen reader users in reading mode."
    },
    {
      "label": "Add lazy attributes to images",
      "highlight": "loading",
      "notes": "This adds a performance boost by only showing the image when it is visible in the browser viewport."
    },
    {
      "label": "Put aria label inside of summary tag",
      "highlight": "aria-label",
      "notes": "Note that when the summary is opened, this aria-label must be changed to <strong>'pause'</strong> and <strong>'play'</strong> when it is closed again."
    },
    {
      "label": "Add small accessibility extras via JavaScript",
      "highlight": "%FILE% js/modules/enable-animatedGif.js",
      "notes": "I added extra JavaScript to the original example to handle: <ul><li>the state of the pause/play button to be reported to screen readers.</li><li>to ensure this component respects the user's <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/@media/prefers-reduced-motion\"><code>prefers-reduced-motion</code> settings</a></li></ul>"
    },
    {
      "label": "Add support for Enable's Pause Animation Control",
      "highlight": "%FILE% js/modules/enable-animatedGif.js ~ document.addEventListener\\('enable-play-animations'[^\\)]*\\);",
      "notes": "I added extra JavaScript to the original example to handle: <ul><li>the state of the pause/play button to be reported to screen readers.</li><li>to ensure this component respects the user's <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/@media/prefers-reduced-motion\"><code>prefers-reduced-motion</code> settings</a></li></ul>"
    }
  ]
}
</script>

<h2>Animation on by default</h2>


<p>When you implement this way, you are presuming the user loading this webpage is okay with the extra battery power being used to animate this image.  It is not a very nice thing to assume.  I hope your mom is proud of you.</p>

<div id="example2" class="enable-example">
  <div class="pausable-animated-gif">
    <img src="images/running-man-anim__still.jpg" alt="A drawing of a man running" loading="lazy">
    <details open>



      <summary role="button" class="pausable-animated-gif__play-pause-button" aria-label="pause">
      </summary>

      <div class="pausable-animated-gif__animated-image">
        <img src="images/running-man-anim.gif" alt="Animated: A drawing of a man running" loading="lazy">
      </div>
    </details>
  </div>
</div>

<?php includeShowcode("example2"); ?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Ensure details has open attribute set",
      "highlight": "open",
      "notes": "This ensures the animated version is shown by default."
    },
    {
      "label": "Ensure the summary tag has the correct aria-label",
      "highlight": "aria-label",
      "notes": "After doing this step, make sure all other steps in example 1 above are followed."
    }
  ]
}
</script>

<h2>Animation is off when OS prefers reduced motion.</h2>

<p>
  This is the only example on this page that does require JavaScript. It
  detects whether the OS
  has "reduced motion" turned on by default. If it is, then it keeps the
  details widget closed.
</p>

<div id="example3" class="enable-example">
  <div class="pausable-animated-gif pausable-animated-gif--respects-os-motion-settings">
    <img src="images/running-man-anim__still.jpg" alt="A drawing of a man running" loading="lazy">
    <details>



      <summary role="button" class="pausable-animated-gif__play-pause-button"></summary>

      <div class="pausable-animated-gif__animated-image">
        <img src="images/running-man-anim.gif" alt="Animated: A drawing of a man running" loading="lazy">
      </div>
    </details>
  </div>
</div>

<?php includeShowcode("example3"); ?>

<script type="application/json" id="example3-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Put CSS class on container to configure the player",
      "highlight": "pausable-animated-gif--respects-os-motion-settings",
      "notes": "This class will be used in step 3."
    },
    {
      "label": "Use CSS variables to store prefers motion settings",
      "highlight": "%CSS%pausable-animated-gif-style1~ :root;@media (prefers-reduced-motion)",
      "notes": "This sets the CSS variable <strong>--prefers-reduced-motion</strong> to 1 if the user has asked the OS to reduce animations, and 0 otherwise."
    },
    {
      "label": "Use JavaScript to find out if it should show the animation or not",
      "highlight": "%FILE% js/modules/enable-animatedGif.js ~ this.respectReduceMotionSettings",
      "notes": "This function, if run at load time, will initially show the animation if the OS prefers-reduced-motion setting is not on."
    }
  ]
}
</script>