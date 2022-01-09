
    
        


        <!-- <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The ARIA example is based off of code from Open Ajax Alliance's <a                         href="https://web.archive.org/web/20170715191225/http://oaa-accessibility.org/example/32/">Slider
                        Example</a> (link goes to a Way Back Machine link, since the original site is long gone). It was
                    heavily modified
                    by the Enable project to be accessible, for both desktop and mobile users.</li>
                <li>Since both of the method changing the native <code>&lt;input type="range"&gt;</code> slider values
                    cannot be implemented via JS for both Voiceover and Talkback, an alternative UI was made using
                    <a href="38-visible-on-focus.php">visible on focus</a> components. <strong>This alternative UI is
                        only visible when using a mobile screen reader.</strong>
                </li>
            </ul>
        </aside> -->

        <h2>A Simple HTML5 Slider (i.e. an <code>input</code> with <code>type="range"</code>)</h2>

        <p>
            <strong>This is by the preferred method of implementing a slider.</strong>
            It "just works" with a keyboard and/or screen reader on all devices (The
            First Rule of ARIA applies). Note that the UI for mobile screen reader users is very different
            between the two major operating systems:
        </p>

        <ul>
            <li>Under iOS/Voiceover: when the slider is focused, users must do a small swipe up and down to
                increase and decrease the slider values.</li>
            <li>Under Android/Talkback: when the slider is focused, users must use the device's
                <strong>volume keys</strong> to manipulate the slider.
            </li>
        </ul>

        <p>
            In the notes below, we do basic information cover how to style HTML5 Sliders, but note that
            we do gloss over some minor cross-browser styling issues. More information on making them
            look super pretty can be found here:
        </p>

        <ul>
            <li><a href="https://www.cssportal.com/style-input-range/">Style Input Range</a> on-line generator tool can
                get you up and running quickly.</li>
            <li><a href="https://css-tricks.com/sliding-nightmare-understanding-range-input/">A Sliding Nightmare:
                    Understanding the Range Input</a>
                by <a href="https://twitter.com/anatudor?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">Ana
                    Tudor</a> is probably the most
                complete deep-dive I have seen on how to style HTML5 sliders (the old Microsoft Edge code is something
                we didn't implement here, since
                Microsoft Edge now relies on the same rendering engine Google Chrome uses). Recommended if you are
                trying to work out the cross-browser quirks between the two implementations.</li>
        </ul>


        <div id="html-example" class="enable-example">
            <form oninput="this.elements.myOutput.innerHTML = parseFloat(this.elements.donationAmount.value);">
                <label for="horizontal-slider" class="html-slider__label enable-slider__label">Amount you want
                    to donate to the Zoltan Hawryluk Developer Fund: </label>
                <div>
                    <div class="html-slider__container">
                        <input type="range" id="horizontal-slider" name="donationAmount" value="500" min="0" max="1000"
                            step="50" >
                    </div>
                    <output class="html-slider__output" name="myOutput" role="presentation">500</output>
                </div>
            </form>
        </div>



        <?php includeShowcode("html-example")?>
        <script type="application/json" id="html-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Use an input of type range",
                    "highlight": "type=\"range\"",
                    "notes": "This can receive keyboard focus for free, since its a form element.  No JS required."
                },
                {
                    "label": "Add the min, max, step, and default value of the slider",
                    "highlight": "min ||| max ||| value=\"500\" ||| step",
                    "notes": "The min, max and current values are represented by the <strong>min</strong>, <strong>max</strong> and <strong>now</strong> attributes, respectively"
                },
                {
                    "label": "Set the slider's label",
                    "highlight": "for",
                    "notes": "Just like any inteactive component, it needs a label"
                },
                {
                    "label": "Set an oninput event to display current value.",
                    "highlight": "oninput=\"[^\"]*\" ||| id=\"myOutput\"",
                    "notes": "This is so sighted users can see the value of the slider."
                },
                {
                    "label": "Set the output tag's role to presentation",
                    "highlight": "role=\"presentation\"",
                    "notes": "Since this is the value of the range element and it is already announced when screen reader users inteact with it, setting the <strong>output</strong> tag's role of <strong>presentation</strong> will prevent this value from being announced twice.  (the <strong>output</strong> tag is, my default, an ARIA live region).  "
                },
                {
                    "label": "Style the slider's track",
                    "highlight": "%CSS% enable-slider-style~ input[type=\"range\"]::-webkit-slider-runnable-track ||| %CSS% enable-slider-style~ input[type=\"range\"]::-moz-range-track ",
                    "notes": "Note that there are two selectors that have the same CSS properties (you may see certain syntax differences in WebKit and Blink based browsers due to the way it parses CSS for the <code>-webkit-*</code> based code).  The first is for WebKit and Blink based browsers (i.e. Chrome, Safari, Opera, Edge), while the second is for Firefox.  <a href=\"https://stackoverflow.com/questions/16982449/why-isnt-it-possible-to-combine-vendor-specific-pseudo-elements-classes-into-on\">We cannot merge these two CSS rules into one, due to the way CSS works."
                },
                {
                    "label": "Style the slider's control",
                    "highlight": "%CSS% enable-slider-style~ input[type=\"range\"]::-webkit-slider-thumb ||| %CSS% enable-slider-style~ input[type=\"range\"]::-moz-range-thumb",
                    "notes": "Again, different selectors for WebKit and Blink based browsers vs. Firefox"
                },
                {
                    "label": "Style specfic browser implementations",
                    "highlight": "%CSS% enable-slider-style~ @supports selector(input[type=\"range\"]::-moz-range-thumb)",
                    "notes": "There are certain layout differences between Firefox and Blink/WebKit based browsers.  To work around this, I have used a <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/@supports#selector\">@supports selector()</a> to give specific styles to the Firefox implementation.  This is supported by all browsers except Safari right now, so it is best to target Firefox when adding differing styles."

                }
            ]
        }
        </script>

        <h2>An HTML5 Slider With Min and Max Values</h2>

        <div id="html-multi-example" class="enable-example">
            <form class="html-slider__multi--form" oninput="" autocomplete="off">
                <fieldset>
                    <legend class="enable-slider__label">
                        Amount you are willing to bid on an Atari 2600
                    </legend>
                    <div>
                        <div role="group" class="html-slider__container html-slider__multi--container"
                            style="--a: 200; --b: 800; --min: 0; --max: 1000">

                            <label class="sr-only" for="a">
                                Amount A
                            </label>
                            <input id="a" type="range" name="multiSlider1" value="200" min="0" max="1000" step="50" >
                            <output class="html-slider__multi--output" id="output_a" for="a" role="presentation"
                                style="--val: var(--a)">
                                $200
                            </output>

                            <label class="sr-only" for="b">
                                Amount B
                            </label>
                            <input id="b" type="range" name="multiSlider2" value="800" min="0" max="1000" step="50" >
                            <output class="html-slider__multi--output" id="output_b" for="b" role="presentation"
                                style="--val: var(--b)">
                                $800
                            </output>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>



        <?php includeShowcode("html-multi-example")?>
        <script type="application/json" id="html-multi-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Use two range inputs",
                    "highlight": "%OPENTAG%input",
                    "notes": "These will be stacked on top of each other via CSS."
                },
                {
                    "label": "Add the min, max, step, and default value of the slider",
                    "highlight": "min=\"0\" ||| max=\"1000\" ||| value ||| step",
                    "notes": "The min, max and current values are represented by the <strong>min</strong>, <strong>max</strong> and <strong>now</strong> attributes, respectively"
                },
                {
                    "label": "Set CSS variables up that match the min, max of the sliders",
                    "highlight": "min=\"0\" ||| max=\"1000\" |||  --min: 0 ||| --max: 1000 ",
                    "notes": ""
                },
                {
                    "label": "Set CSS variables that match the slider values",
                    "highlight": "value=\"200\" ||| value=\"800\" ||| --a: 200 ||| --b: 800 ",
                    "notes": ""
                },
                {
                    "label": "Wrap the sliders inside a fieldset with a legend",
                    "highlight": "%OPENCLOSETAG%fieldset ||| %OPENCLOSECONTENTTAG%legend",
                    "notes": "This acts as a label to all the sliders in the group.  Screen reader users will be told what the purpose of all the sliders in this section are for \"choosing the amount they are willing to bid on an Atari 2600\""
                },

                {
                    "label": "Link each slider with its label and output tag using the for attribute",
                    "highlight": "for",
                    "notes": "Labels for each individual slider. Note that Amount A can be smaller or larger than B, so we can't call any of the slider elements \"the minimum\" or \"the maximum\" value here."
                },
                {
                    "label": "Set the form's autocomplete attribute to off",
                    "highlight": "autocomplete=\"off\"",
                    "notes": "We do this to ensure onload, the values are reset to the default values we set in the two previous steps.  If we didn't do this, <a href=\"https://stackoverflow.com/questions/2486474/preventing-firefox-from-remembering-the-input-value-on-refresh-with-a-meta-tag\">Firefox will remember the values of the sliders when refreshing the page</a>, no matter what the <code>value</code> attributes from the previous step are set to.  "
                },
                {
                    "label": "Set the output tag's role to presentation",
                    "highlight": "role=\"presentation\"",
                    "notes": "Since this is the value of the range element and it is already announced when screen reader users inteact with it, setting the <strong>output</strong> tag's role of <strong>presentation</strong> will prevent this value from being announced twice.  (the <strong>output</strong> tag is, my default, an ARIA live region).  "
                },
                {
                    "label": "Style the slider's control",
                    "highlight": "%CSS% enable-slider-style~ input[type=\"range\"]::-webkit-slider-thumb ||| %CSS% enable-slider-style~ input[type=\"range\"]::-moz-range-thumb",
                    "notes": "This is the same as in the previous example."
                },
                {
                    "label": "Hide the tracks of both sliders",
                    "highlight": "%CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"]::-webkit-slider-runnable-track ||| visibility: hidden ||| %CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"]::-moz-range-track ||| visibility: hidden",
                    "notes": ""
                },
                {
                    "label": "Set pointer-events CSS properties on the slider and the slider thumb",
                    "highlight": "%CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"] ||| pointer-events: none; ||| %CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"]::-webkit-slider-thumb ||| pointer-events: auto; ||| %CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"]::-moz-range-thumb ||| pointer-events: auto; ",
                    "notes": "The <code>pointer-events: none</code> on each of the slider tracks will ensure mouse clicks go through the hidden track.  The <code>pointer-events: auto</code> ensures that pointer events can be captured by the slider control."
                },
                {
                    "label": "Replace the tracks of both of the sliders with the container's ::before pseudo-element.",
                    "highlight": "%CSS% enable-slider-style~ .html-slider__multi--container::before",
                    "notes": "We use a lot of the same styles that we used to style the real track in the first example."
                },
                {
                    "label": "Ensure each of the output elements display their respective slider values.",
                    "highlight": "%JS% rangeInputEvent.init ||| [\\S]*\\.innerHTML[^;]*;",
                    "notes": "These values will be used the CSS code shown in the next step."
                },
                {
                    "label": "Ensure CSS variables containing the slider values are set when the sliders are used.",
                    "highlight": "%JS% rangeInputEvent.init ||| [\\S]*.setProperty[^;]*;",
                    "notes": "These values will be used the CSS code shown in the next step."
                },
                {
                    "label": "Style area on track between the two slider controls using the container's ::after pseudo-element",
                    "highlight": "%CSS% enable-slider-style~ .html-slider__multi--container { ||| --minValue ||| --maxValue ||| --dif ||| %CSS% enable-slider-style~ .html-slider__multi--container::after { ||| --minValue ||| --maxValue ||| --dif ||| --a ||| --b",
                    "notes": "This CSS ensures that the container's <code>::after</code> pseudo-element acts as the area of the track that is in between the two slider controls.  For a detailed explanation as to why, see <a href=\"https://css-tricks.com/multi-thumb-sliders-particular-two-thumb-case/#the-tricky-part\">The Tricky Part</a> of Ana Tudor's article <a href=\"https://css-tricks.com/multi-thumb-sliders-particular-two-thumb-case/\">Multi-Thumb Sliders: Particular Two-Thumb Case</a>."
                },
                {
                    "label": "Style specfic browser implementations",
                    "highlight": "%CSS% enable-slider-style~ @supports selector(input[type=\"range\"]::-moz-range-thumb)",
                    "notes": "There are small layout differences between Firefox and Blink/WebKit based browsers.  To work around this, I have used a <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/@supports#selector\">@supports selector()</a> to give specific styles to the Firefox implementation.  This is supported by all browsers except Safari right now, so it is best to target Firefox when adding differing styles."

                }
            ]
        }
        </script>

        <h2>ARIA Sliders</h2>


        <h3>A note on all ARIA sliders on this page:</h3>

        <p>
            Note that all the ARIA sliders use the <code>&lt;template&gt;</code> tag that the
            JavaScript library will use to create the DOM elements:
        </p>

        <?php includeShowcode("template-code")?>
        <script type="application/json" id="template-code-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Insert dynamic values placeholders in the template",
                    "highlight": "\\$\\{[^}]+\\}",
                    "notes": "These are the dymamic parts of the template. These values will be populated by the JavaScript.  Note the format is similar to that of <a href=\"https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals\">JavaScript template strings</a>"
                },
                {
                    "label": "Create an interpolation function",
                    "highlight": "%JS% interpolate",
                    "notes": "This code will make a regular Javascript string act like a template string.  It is used in the next step."
                },
                {
                    "label": "Insert dymanic values into the template using the interpolation function.",
                    "highlight": "%JS% enableSliders.list[0].createHandle ||| const handle =[^;]*;",
                    "notes": "This takes the <code>innerHTML</code> of the template element and runs it through the interpolation function of the last step.   The result is then injected into the DOM of page."
                }
            ]
        }
        </script>

        <h3>A Simple ARIA Slider</h3>

        <div id="aria-example1" class="enable-example">
            <div id="sr1_label" class="enable-slider__label">JPEG compression factor:</div>

            <div class="enable-slider enable-slider--horizontal" id="sr1" data-min="0" data-max="100" data-inc="5"
                data-jump="10" data-show-vals="true" data-range="false" data-val1="30">
            </div>
        </div>



        <?php includeShowcode("aria-example1")?>
        <script type="application/json" id="aria-example1-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Place ARIA slider roles in document",
                    "highlight": "role=\"slider\"",
                    "notes": "We used a <strong>button</strong> tag to ensure it gets keyboard focus for free.  If you use a <strong>div</strong>, you would need to add a <strong>tabindex=\"0\"</strong> and some JS routines to ensure it worked correctly.  It's definitely worth using a <strong>button</strong> instead."
                },
                {
                    "label": "Add the min, max and current values that the slider can be set to, as well as the current value",
                    "highlight": "aria-valuemin ||| aria-valuemax ||| aria-valuenow",
                    "notes": "The min, max and current values are represented by the <strong>aria-valuemin</strong>, <strong>aria-valuemax</strong> and <strong>aria-valuenow</strong> attributes, respectively"
                },
                {
                    "label": "Set the slider's label",
                    "highlight": "aria-labelledby=\"sr1_label sr1_handle_val\" ||| id=\"sr1_label\" ||| id=\"sr1_handle_val\"",
                    "notes": "The label is the visual label of slider along with its visual value.  The value is needed since some screen readers report the value as a percentage, as opposed to the actual numeric value visible on the component."
                },
                {
                    "label": "Set the slider instructions",
                    "highlight": "aria-describedby=\"sr1_desc\" ||| id=\"sr1_desc\"",
                    "notes": "Note that the instructions are not just for keyboard users, but also for those who use mobile screen readers."
                },
                {
                    "label": "Surround the visual numeric value of the slider with an aria-live region",
                    "highlight": "role=\"alert\" ||| aria-live=\"assertive\"",
                    "notes": ""
                },
                {
                    "label": "Create alternative UI for mobile screen readers",
                    "highlight": "%OPENCLOSECONTENTTAG%span",
                    "notes": "Since the slider elements can be only change values when swiping them, mobile screen reader users will not be able to manipulate them, since swiping is (roughly) equivalent to tabbing through the elements on the page (the difference being it an theoretically go all the elements on the page, not just the interactive ones).  To work around this limitation, we create an alternative UI with elements that are only visible when the button inside gains focus.  Because the button has <strong>tabindex=\"-1\"</strong>, mobile screen readers are the only devices that can make them visible."
                },
                {
                    "label": "Ensure the mobile screen reader UI buttons only appear for mobile screen reader users.",
                    "highlight": "tabindex=\"-1\"",
                    "notes": "See previous step for details."
                },
                {
                    "label": "Create labels for mobile screen reader UI buttons",
                    "highlight": "aria-labelledby=\"sr1_label sr1_handle_val sr1_handle__decrease-label\" ||| id=\"sr1_label\" ||| id=\"sr1_handle_val\" ||| id=\"sr1_handle__decrease-label\" ||| aria-labelledby=\"sr1_label sr1_handle_val sr1_handle__increase-label\" ||| id=\"sr1_handle__increase-label\"",
                    "notes": "The \"decrementor\" will have a label of \"JPEG compression factor: 30, decrease value\". The \"incrementor\" will have a similar label, except for the \"increase value\" at the end."
                }
            ]
        }
        </script>




        <h2>An ARIA Slider With Min and Max Values</h2>


        <div id="aria-example2" class="enable-example">
            <div id="sr2_global_label" class="enable-slider__label">Approximately how much money would you be willing to
                invest in your RRSPs in the next
                years</div>

            <div id="sr2_label1" class="enable-slider__hidden-label">Minimum investment amount</div>
            <div id="sr2_label2" class="enable-slider__hidden-label">Maximum investment amount</div>
            <div class="enable-slider enable-slider--horizontal" id="sr2" data-min="1900" data-max="2008" data-inc="1"
                data-jump="10" data-show-vals="true" data-range="true" data-val1="1950" data-val2="2000">
            </div>
        </div>



        <?php includeShowcode("aria-example2")?>
        <script type="application/json" id="aria-example2-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Place ARIA slider roles in document",
                    "highlight": "role=\"slider\"",
                    "notes": "Note, unlike the previous example, there are two of these now."
                },
                {
                    "label": "Add the min, max and current values that the slider can be set to, as well as the current value",
                    "highlight": "aria-valuemin ||| aria-valuemax ||| aria-valuenow",
                    "notes": "The min, max and current values are represented by the <strong>aria-valuemin</strong>, <strong>aria-valuemax</strong> and <strong>aria-valuenow</strong> attributes, respectively"
                },
                {
                    "label": "Set the labels for both slider handles",
                    "highlight": "aria-labelledby=\"sr[0-9]_label[0-9] sr[0-9]_handle[0-9]_val\" ||| id=\"sr[0-9]_label[0-9]\" ||| id=\"sr[0-9]_handle[0-9]_val\"",
                    "notes": "The label is the visual label of slider along with its visual value.  The value is needed since some screen readers report the value as a percentage, as opposed to the actual numeric value visible on the component."
                },
                {
                    "label": "Set the instructions for both sliders",
                    "highlight": "aria-describedby=\"sr[0-9]_desc[0-9]\" ||| id=\"sr[0-9]_desc[0-9]\"",
                    "notes": "Note that the instructions are not just for keyboard users, but also for those who use mobile screen readers."
                },
                {
                    "label": "Surround the visual numeric value of the slider with an aria-live region",
                    "highlight": "role=\"alert\" ||| aria-live=\"assertive\"",
                    "notes": ""
                },
                {
                    "label": "Create alternative UI for mobile screen readers",
                    "highlight": "%OPENCLOSECONTENTTAG%span",
                    "notes": "Since the slider elements can be only change values when swiping them, mobile screen reader users will not be able to manipulate them, since swiping is (roughly) equivalent to tabbing through the elements on the page (the difference being it an theoretically go all the elements on the page, not just the interactive ones).  To work around this limitation, we create an alternative UI with elements that are only visible when the button inside gains focus.  Because the button has <strong>tabindex=\"-1\"</strong>, mobile screen readers are the only devices that can make them visible."
                },
                {
                    "label": "Ensure the mobile screen reader UI buttons only appear for mobile screen reader users.",
                    "highlight": "tabindex=\"-1\"",
                    "notes": "See previous step for details."
                },
                {
                    "label": "Create labels for mobile screen reader UI buttons",
                    "highlight": "aria-labelledby=\"sr[0-9]_label[0-9] sr[0-9]_handle[0-9]_val sr[0-9]_handle[0-9]__decrease-label\" ||| id=\"sr[0-9]_label[0-9]\" ||| id=\"sr[0-9]_handle[0-9]_val\" ||| id=\"sr[0-9]_handle[0-9]__decrease-label\" ||| aria-labelledby=\"sr[0-9]_label sr[0-9]_handle[0-9]_val sr[0-9]_handle[0-9]__increase-label\" ||| id=\"sr[0-9]_handle[0-9]__increase-label\"",
                    "notes": "The \"decrementor\" will have a label of \"JPEG compression factor: 30, decrease value\". The \"incrementor\" will have a similar label, except for the \"increase value\" at the end."
                }
            ]
        }
        </script>


        <h2>A Vertical ARIA Slider</h2>

        <div id="vertical-example" class="enable-example">
            <div id="sr3_global_label" class="enable-slider__label">Approximately how much money would you be willing to
                invest in your RRSPs in the next
                years</div>

            <div id="sr3_label1" class="enable-slider__hidden-label">Minimum investment amount</div>
            <div id="sr3_label2" class="enable-slider__hidden-label">Maximum investment amount </div>
            <div class="enable-slider enable-slider--vertical" id="sr3" data-min="1900" data-max="2008" data-inc="1"
                data-jump="10" data-show-vals="true" data-range="true" data-val1="1950" data-val2="2008">
            </div>
        </div>

        <?php includeShowcode("vertical-example")?>
        <script type="application/json" id="vertical-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [
                {
                    "label": "Insert class in root element to make this slider vertical",
                    "highlight": "enable-slider--vertical",
                    "notes": "All the other steps are the same as the previous example."
                }
            ]
        }
        </script>

        
        <div id="template-code">
            <template id="enable-slider__handle--template">
                <div>
                    <div id="${id}" class="${classNameRoot}__handle">
                        <div role="slider" tabindex="0" class="${classNameRoot}__handle-button" aria-valuemin="${valuemin}"
                            aria-valuemax="${valuemax}" aria-valuenow="${valuenow}"
                            aria-labelledby="${arialabelledby} ${id}_val" aria-describedby="${ariadescribedby}"></div>

                        <div id="${ariadescribedby}" class="${classNameRoot}__hidden-label">
                            Use arrow keys to adjust the slider value. Touch devices will need to swipe right to access controls to adjust
                            the slider value.
                        </div>
                        <span                             class="enable-mobile-visible-on-focus__container ${classNameRoot}__button-container ${classNameRoot}__button-container--decrease">
                            <div id="${id}__decrease-label" class="${classNameRoot}__hidden-label">Decrease Value</div>
                            <button aria-labelledby="${arialabelledby} ${id}_val ${id}__decrease-label"
                                class="enable-mobile-visible-on-focus ${classNameRoot}__decrease ${classNameRoot}__button"
                                tabindex="-1">
                                ‹
                            </button>
                        </span>
                        <span                             class="enable-mobile-visible-on-focus__container ${classNameRoot}__button-container ${classNameRoot}__button-container--increase">
                            <div id="${id}__increase-label" class="${classNameRoot}__hidden-label">Increase Value</div>
                            <button aria-labelledby="${arialabelledby} ${id}_val ${id}__increase-label"
                                class="enable-mobile-visible-on-focus ${classNameRoot}__increase ${classNameRoot}__button"
                                tabindex="-1">
                                ›
                            </button>
                        </span>
                    </div>
                    <div id="${id}_val" class="${classNameRoot}__value" role="alert" aria-live="assertive">
                        ${valuenow}
                    </div>
                </div>
            </template>
        </div>
    