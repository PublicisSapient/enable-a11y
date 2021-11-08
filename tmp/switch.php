<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ARIA Switch Role Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta charset="utf-8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet" type="text/css" href="css/showcode.css">
<link href="css/libs/prism.css" rel="stylesheet" />

<!-- This is the global stylesheet -->
<link id="all-css" rel="stylesheet" href="css/shared/all.css" />
<link id="read-all-css" rel="stylesheet" href="css/shared/read-more.css" />

<!-- hamburger menu -->
<link id="hamburger-style" rel="stylesheet" type="text/css" href="css/hamburger-menu.css" />


<link id="site-css" rel="stylesheet" href="css/site.css" />



    <link rel="stylesheet" type="text/css" href="css/switch.css" />
    
  </head>

  <body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>
      <h1>ARIA Switch Role Example</h1>
      <aside class="notes">
        <h2>Notes:</h2>

        <ul>
          <li>
            This code is based on code from the
            <a href="https://developer.mozilla.org/en-US/">MDN</a> article on
            <a
              href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_switch_role"
              >Using the switch role</a
            >
          </li>
          <li>
            The switch must have an <code>aria-checked</code> value associated
            with it.
          </li>
          <li>
            The switch reports the checked state as "on" or "off" in VoiceOver
            and "checked" or "unchecked" in NVDA and ChromeVox.
          </li>
          <li>
            Putting an <code>aria-describedby</code> on the switch can give
            supplementary info to the state of the switch
          </li>
        </ul>
      </aside>

      <h2>A simple switch coded with ARIA.</h2>

      <div id="example1">
        <button
          type="button"
          aria-labelledby="speakerPower__label"
          role="switch"
          aria-checked="true"
          id="speakerPower"
          class="switch"
          aria-describedby="speakerPower-checked"
        >
          <span id="speakerPower-unchecked">off</span>
          <span id="speakerPower-checked">on</span>
        </button>
        <label id="speakerPower__label" class="switch--label"
          >Speaker power</label
        >
      </div>


              <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="example1__steps" class="showcode__steps"></div>
                                        <div id="example1__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example1"
                        data-showcode-props="example1-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
      <script type="application/json" id="example1-props">
      {
        "replaceHTMLRules": {},
        "steps": [{
            "label": "Put in roles",
            "highlight": "role",
            "notes": "Needed to ensure screen readers can announce that this component is a switch and not just a button."
          },
          {
            "label": "Use aria-checked to report the switch's state",
            "highlight": "aria-checked",
            "notes": "Should be true when the switch is on, false otherwise."
          },
          {
            "label": "Set the aria-describedby attribute to the label on the switch",
            "highlight": "aria-describedby",
            "notes": "This is a progressive enhancement technique, in case the browser and/or screen reader cannot interpret the <code>switch</code> role with the <code>aria-checked</code> attribute"
          },
          {
            "label": "Use Javascript to allow users to turn the switch on and off",
            "highlight": "%JS%Switch",
            "notes": "Note that the switch changes state when the button is clicked.  This will work for both mice and keyboard since click fires using both devices when attached to buttons.  Note as well we set a custom event, <code>switch-change</code>, so developers can set event handler when the switch changes value."
          },
          {
            "label": "Put in the label for the button element",
            "highlight": "aria-labelledby",
            "notes": "Just like any other interactive element, a switch needs a label."
          }
        ]
      }
      </script>

    </main>

        <footer aria-label="Copyright Information">
            
        Enable is a labour of love originally by
        <a href="https://useragentman.com">Zoltan Hawryluk</a>, released as open
        source so hopefully others can learn from it.  This content is covered by the the <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International Licence</a>

    </footer> 
        

    <!-- These three script tags are for the code samples -->
    <script src="node_modules/indent.js/lib/indent.min.js"></script>
    <script src="js/libs/prism.js" data-manual></script>
    <script src="js/showcode.js"></script>

    <!-- Hamburger Menu -->
    <script src="js/accessibility.js"></script>
    <script src="js/hamburger.js"></script>    <script src="js/shared/switch.js"></script>
  </body>
</html>
