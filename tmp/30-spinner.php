<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ARIA Spinner Role Example</title>
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



    <link rel="stylesheet" type="text/css" href="css/spinner.css" />
    
  </head>

  <body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>
      <h1>Numeric Input Examples</h1>

      <aside class="notes">
        <h2>Notes:</h2>

        <ul>
          <li>
            This ARIA spinner examples were originally in the article
            <a
            href="https://web.archive.org/web/20170424171217/http://oaa-accessibility.org/examplep/spinbutton1/"
              >Example - Spinbutton using IMG elements for buttons</a
            >
            by the
            <a href="http://oaa-accessibility.org/">Open Ajax Alliance</a> (now
            currently offline).
          </li>
          <li>
            ChromeVox makes the really odd choice of converting an
            <code>&lt;input type="number"&gt;</code> tag to an
            <code>&lt;input type="text" &gt;</code> onFocus. It does, however,
            report to the user that it is "Edit Text, Numeric Only", and will
            remove any numeric value within the input onBlur.
          </li>
          <li>
            NVDA reports both the ARIA spinner and the native HTML
            <code>&lt;input type="number"&gt;</code> tags as a "spinbutton".
          </li>
          <li>
            Voiceover reports the ARIA version as a "stepper" and the HTML
            <code>&lt;input type="number"&gt;</code> tag as "incrementable edit
            text".
          </li>
          <li>
            It is possible to have a numeric input without the spinner by using
            <code
              >&lt;input type="text" inputmode="numeric"
              pattern="[0-9]*"&gt;</code
            >. This is currently what the
            <a
              href="https://technology.blog.gov.uk/2020/02/24/why-the-gov-uk-design-system-team-changed-the-input-type-for-numbers/"
              >recommendation of the UK government when dealing with numeric
              information that isn't a quantity</a
            >.
          </li>
        </ul>
      </aside>

      <h2>ARIA example</h2>


      <div id="example1">
        <label id="sb1_label" class="sbLabel"
          >Choose a number between 0 and 100</label
        >

      <div class="spinbutton__instructions" id="sb1_instructions">
        Use the arrow keys or use the stepper buttons after this element to increase and decrease the values
      </div>

        <div class="enable-spinner">
          <div
            id="sb1"
            class="spinbutton"
            role="spinbutton"
            aria-labelledby="sb1_label"
            aria-describedby="sb1_instructions"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-valuenow="50"
            data-increment="10"
            tabindex="0"
          >
            50
          </div>
          <div id="sb1__up" class="enable-spinner__button enable-spinner__button--up" role="button">
            <img src="images/button-arrow-up.png" alt="Increase Value" />
          </div>
          <div id="sb1__down" class="enable-spinner__button enable-spinner__button--down" role="button">
            <img src="images/button-arrow-down.png" alt="Decrease Value" />
          </div>

          <!-- This alert is needed for mobile screen readers to announce the value correctly -->
          <div class="sr-only" id="sb1__live" role="alert" aria-live="assertive">50</div>
        </div>
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
        "replaceHTMLRules": {
        },
        "steps": [
          {
            "label": "Place ARIA roles in document",
            "highlight": "role",
            "notes": "The DOM node that contains the editable number that gains focus has the <strong>spinbutton</strong> role.  The up and down arrows are <strong>buttons</strong>. We didn't mark them up with the HTML button tag so they <strong>wouldn't</strong> gain keyboard focus.  They are usable on a mobile device (since they ignore the <strong>tabindex</strong> attribute."
          },
          {
            "label": "Make editable element focusable",
            "highlight": "tabindex",
            "notes": ""
          },
          {
            "label": "Label the spinbuttons with aria-labelledby",
            "highlight": "aria-labelledby",
            "notes": ""
          },
          {
            "label": "Code instructions for screen reader users.",
            "highlight": "aria-describedby",
            "notes": "Note the <code>sr-only</code> class that ensures the instructions are not visible to sighted users."
          },
          {
            "label": "Explose min, max and current values via ARIA so screen readers can report them",
            "highlight": "aria-valuemin ||| aria-valuemax ||| aria-valuenow ||| data-increment",
            "notes": [
              "The spinbutton.js script uses these values in the script, as well as the <strong>data-increment</strong> attribtute so that it can do the right thing when the arrow keys are pressed.",
              "When the up or right keys are pressed, 1 is added to the value.",
              "When the down or left keys are pressed, 1 is subtracted from it.",
              "The <strong>Home</strong> and <strong>End</strong> keys set the value to the <strong>aria-maxvalue</strong> and <strong>aria-min-value</strong> respectively.",
              "The <strong>Page Up</strong> and <strong>Page Down</strong> keys increases and decreases the amount given by <strong>data-increment</strong>"
            ]
          },
          {
            "label": "Set alt text on controls",
            "highlight": "alt",
            "notes": "Note that the height of these controls are expressed in rem units.  This ensures that when we resize the text only with browser controls, the controls grow with the text."
          }
        ]
      }
      </script>

      <label id="sb2_label" class="sbLabel"
        >Choose a number between 500 and 1000</label>
      <div class="enable-spinner">
        <div
          id="sb2"
          class="spinbutton"
          role="spinbutton"
          aria-labelledby="sb2_label"
          aria-valuemin="500"
          aria-valuemax="1000"
          aria-valuenow="750"
          data-increment="50"
          tabindex="0"
        >
          750
        </div>
        <div id="sb2__up" class="enable-spinner__button enable-spinner__button--up" role="button" title="Increase Value">
          <img src="images/button-arrow-up.png" alt="" role="presentation" />
        </div>
        <div id="sb2__down" class="enable-spinner__button enable-spinner__button--down" role="button" title="Decrease Value">
          <img src="images/button-arrow-down.png" alt="" role="presentation" />
        </div>

          <!-- This alert is needed for mobile screen readers to announce the value correctly -->
          <div class="sr-only" id="sb2__live" role="alert" aria-live="assertive">50</div>
      </div>

      <h2>HTML input type="number" example</h2>

      <label id="html_number" class="sbLabel" for="type-number"
        >Quantity between 500 and 1000</label
      >
      <input id="type-number" type="number" min="500" max="1000" value="500" />

      <h2>HTML numeric value that isn't a quanity</h2>

      <label for="non-quantity">Zip Code:</label>
      <input id="non-quantity" type="text" inputmode="numeric" pattern="[0-9]*">
      
    </main>


    <script src="js/spinbutton.js"></script>
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
    <script src="js/hamburger.js"></script>  </body>
</html>
