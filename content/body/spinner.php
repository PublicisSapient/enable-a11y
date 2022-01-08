
    
        

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>
                    This ARIA spinner examples were originally in the article
                    <a                         href="https://web.archive.org/web/20170424171217/http://oaa-accessibility.org/examplep/spinbutton1/">Example
                        - Spinbutton using IMG elements for buttons</a>
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
                    <code>&lt;input type="text" inputmode="numeric"
              pattern="[0-9]*"&gt;</code>. This is currently what the
                    <a                         href="https://technology.blog.gov.uk/2020/02/24/why-the-gov-uk-design-system-team-changed-the-input-type-for-numbers/">recommendation
                        of the UK government when dealing with numeric
                        information that isn't a quantity</a>.
                </li>
            </ul>
        </aside>



        <h2>HTML input type="number" example</h2>

        <div id="html-example" class="enable-example">
            <label id="html_number" class="sbLabel" for="type-number">Quantity between 500 and 1000</label>
            <input id="type-number" type="number" min="500" max="1000" value="500" >
        </div>


        <?php includeShowcode("html-example")?>
        <script type="application/json" id="html-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Attach label to input",
                    "highlight": "for",
                    "notes": "This is just like any other form element."
                },
                {
                    "label": "Insert type=\"number\"",
                    "highlight": "type=\"number\"",
                    "notes": ""
                },
                {
                    "label": "Add min, max and current value attributes",
                    "highlight": "min ||| max ||| value",
                    "notes": ""
                }
            ]
        }
        </script>

        <h2>HTML numeric value that isn't a quanity</h2>

        <div id="non-quantity-example" class="enable-example">

            <label for="non-quantity">Zip Code:</label>
            <input id="non-quantity" type="text" inputmode="numeric" pattern="[0-9]*">
        </div>

        <?php includeShowcode("non-quantity-example")?>
        <script type="application/json" id="non-quantity-example-props">
        {
          "replaceHtmlRules": {
          },
          "steps": [
          {
            "label": "Use type=\"text\" instead of type=\"number\"",
            "highlight": "type=\"text\"",
            "notes": "<code>&lt;input type=\"number\"&gt;</code> is only meant for numeric quantities (like a count of objects, measurements, etc), and not for items that are not quantities that just happen to be numbers (e.g. zip codes, user IDs, account numbers, etc).  Using <code>&lt;input type=\"number\"&gt;</code> will show a \"spinner\" control in many browsers by default, announce that control to screen reader users, and give keyboard users a UI using the arrow keys &mdash; all of which are inappropriate for non-quantified data."
          },
          {
            "label": "Add inputmode attribute to text input",
            "highlight": "inputmode",
            "notes": "This will cause mobile users to receive a numeric keyboard instead of the full querty keyboard."
          },
          {
            "label": "Add pattern attribute to text input",
            "highlight": "pattern",
            "notes": "This ensures that physical keyboard users (as well as users who cut-and-paste data into the form) the input a numeric value in this form field before the form can be successfully submitted."
          }
        ]}
        </script>



        <h2>ARIA example</h2>


        <div id="example1" class="enable-example">
            <label id="sb1_label" class="sbLabel">Choose a number between 0 and 100</label>

            <div class="spinbutton__instructions" id="sb1_instructions">
                Use the arrow keys or use the stepper buttons after this element to increase and decrease the values
            </div>

            <div class="enable-spinner">
                <div id="sb1" class="spinbutton" role="spinbutton" aria-labelledby="sb1_label"
                    aria-describedby="sb1_instructions" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50"
                    data-increment="10" tabindex="0">
                    50
                </div>
                <div id="sb1__up" class="enable-spinner__button enable-spinner__button--up" role="button">
                    <img src="images/button-arrow-up.png" alt="Increase Value" >
                </div>
                <div id="sb1__down" class="enable-spinner__button enable-spinner__button--down" role="button">
                    <img src="images/button-arrow-down.png" alt="Decrease Value" >
                </div>

                
                <div class="sr-only" id="sb1__live" role="alert" aria-live="assertive">50</div>
            </div>
        </div>



        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
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

        
    