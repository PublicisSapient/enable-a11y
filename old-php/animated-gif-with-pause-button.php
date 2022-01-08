<!DOCTYPE html>
<html lang="en">

<head>
  <title>Accessible Animated GIF</title>
  <?php include("includes/common-head-tags.php"); ?>
  <link id="pauseable-animated-gif-style1"
    rel="stylesheet"
    type="text/css"
    href="css/pauseable-animated-gif.css" />
</head>

<body>
  <main>
    <?php include "includes/pause-anim-control.php" ?>

    <aside class="notes">

      <p>This idea was stolen from <a
          href="https://codepen.io/stevef/pen/ExPdNMM">this CodePen by Steven
          Faulkner</a>.
        The pause first example was from <a
          href="https://css-tricks.com/pause-gif-details-summary/">Chris
          Coyier</a>.
</p>
    </aside>

    <h1>Animated GIF With Pause Button Without JavaScript</h1>


    <h2>Animation off by default</h2>

    <div id="example1"
      class="enable-example">

      <div class="pauseable-animated-gif">
        <img src="images/running-man-anim__still.jpg"
          alt="A drawing of a man running"
          loading="lazy">
        <details>

          <summary role="button"
            class="pauseable-animated-gif__play-pause-button"
            aria-label="play">
          </summary>

          <div class="pausable-animated-gif__animated-image">
            <img src="images/running-man-anim.gif"
              alt="Animated: A drawing of a man running"
              loading="lazy">
          </div>
        </details>
      </div>
    </div>



    <?php includeShowcode("example1")?>

    <script type="application/json"
      id="example1-props">
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
          "label": "Change the summary tag's aria-label onclick",
          "highlight": "%JS% 'const animatedGifPause = new function () {'; animatedGifPause.setSummaryAriaLabel; animatedGifPause.summaryClickHandler; animatedGifPause.init#document.addEventListener; '}'; '// Initialize the object.\nanimatedGifPause.init();'",
          "notes": "This is the only JavaScript really needed for this example.  Without it, the state of the pause/play button would not be reported to screen readers."
        }
      ]
    }
    </script>

    <h2>Animation on by default</h2>

    <div id="example2"
      class="enable-example">
      <div class="pauseable-animated-gif">
        <img src="images/running-man-anim__still.jpg"
          alt="A drawing of a man running"
          loading="lazy">
        <details open>

          <!-- added role=button to summary to resolve iOS funkiness -->

          <summary role="button"
            class="pauseable-animated-gif__play-pause-button"
            aria-label="pause">
          </summary>

          <div class="pausable-animated-gif__animated-image">
            <img src="images/running-man-anim.gif"
              alt="Animated: A drawing of a man running"
              loading="lazy">
          </div>
        </details>
      </div>
    </div>

    <?php includeShowcode("example2")?>

    <script type="application/json"
      id="example2-props">
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

    <h2>Animation off when OS prefers reduced motion.</h2>

    <p>
      This is the only example on this page that does require JavaScript. It
      detect whether the OS
      has "reduced motion" turned on by default. If it is, then it keeps the
      details widget closed.
    </p>

    <div id="example3"
      class="enable-example">
      <div
        class="pauseable-animated-gif pauseable-animated-gif--respects-os-motion-settings">
        <img src="images/running-man-anim__still.jpg"
          alt="A drawing of a man running"
          loading="lazy">
        <details>

          <!-- added role=button to summary to resolve iOS funkiness -->

          <summary role="button"
            class="pauseable-animated-gif__play-pause-button"></summary>

          <div class="pausable-animated-gif__animated-image">
            <img src="images/running-man-anim.gif"
              alt="Animated: A drawing of a man running"
              loading="lazy">
          </div>
        </details>
      </div>
    </div>

    <?php includeShowcode("example3")?>

    <script type="application/json"
      id="example3-props">
    {
      "replaceHtmlRules": {},
      "steps": [{
          "label": "Put CSS class on container to configure the player",
          "highlight": "pauseable-animated-gif--respects-os-motion-settings",
          "notes": "This class will be used in step 3."
        },
        {
          "label": "Use CSS variables to store prefers motion settings",
          "highlight": "%CSS%pauseable-animated-gif-style1~ :root;@media (prefers-reduced-motion)",
          "notes": "This sets the CSS variable <strong>--prefers-reduced-motion</strong> to 1 if the user has asked the OS to reduce animations, and 0 otherwise."
        },
        {
          "label": "Use JS to find out if it should show the animation ot not",
          "highlight": "%JS%animatedGifPause.respectReduceMotionSettings",
          "notes": "This function, if run at load time, will initially show the animation if the OS prefers-reduced-motion setting is not on."
        }
      ]
    }
    </script>


  </main>

  <script src="js/modules/enable-animatedGif.js"
    type="module"></script>

  <?php include "includes/example-footer.php" ?>
</body>

</html>