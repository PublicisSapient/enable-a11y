<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Radiogroup Role Example</title>
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




    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <link id="radiogroup-css" rel="stylesheet" type="text/css" href="css/radiogroup.css" />

</head>

<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The examples below are from
                    <a href="https://www.w3.org/WAI/GL/wiki/Using_grouping_roles_to_identify_related_form_controls">Using
                        Grouping Roles to Identify Related Form Controls</a>
                    from the W3C. The styling on the ARIA version was refactored from
                    <a
                        href="https://webdesign.tutsplus.com/tutorials/making-gradients-easier-with-less-mixins--cms-24072">http://code.iamkate.com/html-and-css/styling-checkboxes-and-radio-buttons/</a>
                    by
                    <a href="http://code.iamkate.com/">Kate Morley</a>.
                </li>

            </ul>
        </aside>

        <h1>Radiogroups and Radio Buttons, native and ARIA.</h1>



        <h2>Example 1: Radio Buttons grouped with fieldsets</h2>

        <p>This is the recommended way of grouping radio buttons. If you need them to be styled a different way, please
            look at the next example.</p>


        <div id="example1">
            <h3 class="form-heading">Set Alerts for your Account</h3>

            <!-- This groups the first two radio buttons -->
            <fieldset>
                <legend>Send an alert when balance exceeds $ 3,000</legend>
                <div>
                    <input type="radio" id="radio1-1" name="a1radio" />
                    <label for="radio1-1">Yes</label>
                </div>
                <div>
                    <input type="radio" id="radio1-2" name="a1radio" />
                    <label for="radio1-2">No</label>
                </div>
            </fieldset>

            <!-- This groups the next two radio buttons -->
            <fieldset>
                <legend>Send an alert when a charge exceeds $ 250</legend>
                <div>
                    <input type="radio" id="radio2-1" name="a2radio" />
                    <label for="radio2-1">Yes</label>
                </div>
                <div>
                    <input type="radio" id="radio2-2" name="a2radio" />
                    <label for="radio2-2">No</label>
                </div>
            </fieldset>
            <div>
                <input type="submit" value="Continue" />
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
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "Use a fieldset to group the related radio buttons",
                    "highlight": "%OPENCLOSECONTENTTAG%fieldset",
                    "notes": "Fieldsets are the recommended way to group HTML5 radio buttons"
                },
                {
                    "label": "Use a legend to label the fieldset",
                    "highlight": "%OPENCLOSECONTENTTAG%legend",
                    "notes": "Legends will label the entire fieldset and will be announced when screen reader users apply focus to the any of the radio buttons for the first time"
                },
                {
                    "label": "Connect the radio buttons with a label",
                    "highlight": "for",
                    "notes": "Just like any form element, labels should be linked up with the radio button using the HTML for attribute in the label tag."
                }
            ]
        }
        </script>


        <h2>Example 2: HTML5 radio butons that have custom styling</h2>

        <p>I refactored the basic CSS from this <a href="https://codepen.io/manabox/pen/raQmpL">codepen</a>
            by <a href="webcreatormana.com">Mana</a>. I added focus states as well <a
                href="https://www.sarasoueidan.com/blog/inclusively-hiding-and-styling-checkboxes-and-radio-buttons/">ensuring
                that these styled facades will be discoverable to users navigating by touch</a>.
        </p>

        <div id="example1-styled">
            <div class="enable-radio">
                <h3 class="form-heading">Set Alerts for your Account</h3>

                <!-- This groups the first two radio buttons -->
                <fieldset>
                    <legend>Send an alert when balance exceeds $ 3,000</legend>
                    <div>
                        <input type="radio" id="enable-radio1-1" name="enable-a1radio" />
                        <label for="enable-radio1-1">Yes</label>
                    </div>
                    <div>
                        <input type="radio" id="enable-radio1-2" name="enable-a1radio" />
                        <label for="enable-radio1-2">No</label>
                    </div>
                </fieldset>

                <!-- This groups the next two radio buttons -->
                <fieldset>
                    <legend>Send an alert when a charge exceeds $ 250</legend>
                    <div>
                        <input type="radio" id="enable-radio2-1" name="enable-a2radio" />
                        <label for="enable-radio2-1">Yes</label>
                    </div>
                    <div>
                        <input type="radio" id="enable-radio2-2" name="enable-a2radio" />
                        <label for="enable-radio2-2">No</label>
                    </div>
                </fieldset>
                <div>
                    <input type="submit" value="Continue" />
                </div>
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
                <form class="showcode__ui">                                        <div id="example1-styled__steps" class="showcode__steps"></div>
                                        <div id="example1-styled__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example1-styled"
                        data-showcode-props="example1-styled-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="example1-styled-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "Set enable-radio class on the section that will have the custom radio buttons",
                    "highlight": "class=\"enable-radio\"",
                    "notes": ""
                },
                {
                    "label": "Ensure the radio button is before the label",
                    "highlight": "%OPENTAG%input ||| %OPENCLOSECONTENTTAG%label",
                    "notes": "If you want the label to be <strong>before</strong> the radio, you can do this if you also put a blank label after the input.  The label after the input is going to have styling for the custom radio button."
                },
                {
                    "label": "Hide the native radio button",
                    "highlight": "%CSS% radiogroup-css~ .enable-radio [type=\"radio\"] { ||| opacity:[^;]*; ||| pointer-events[^;]*;",
                    "notes": "We hide the native radio button with <strong>opacity: 0</strong>. This is because this the native radio button will be underneath the custom one.  If we do it this way, these components will be discoverable to users navigating by touch. For more information about being inclusive of users navigating by touch, please read <a href=\"https://www.sarasoueidan.com/blog/inclusively-hiding-and-styling-checkboxes-and-radio-buttons/\">Inclusively Hiding & Styling Checkboxes and Radio Buttons</a> by Sara Soueidan."
                },
                {
                    "label": "Use the label's ::before and ::after pseudo-elements to style the custom radio button",
                    "highlight": "%CSS% radiogroup-css~ .enable-radio [type=\"radio\"] + label::before, .enable-radio [type=\"radio\"] + label::after { ||| width:[^;]*; ||| height:[^;]*;",
                    "notes": "The label's <strong>::before</strong> pseudo-element will be the radio buttons outer border.  The label's <strong>::after</strong> pseudo-element will have the styles for the inner circle when the radio button is checked.  Both have the same width and height as the hidden native radio button."
                },
                {
                    "label": "Show the inner circle when the radio button is checked",
                    "highlight": "%CSS% radiogroup-css~ .enable-radio [type=\"radio\"]:checked + label::after { ||| transform:[^;]*;",
                    "notes": "When the native radio button is checked, we show the custom inner circle. Since it is exactly the same size as the outer ring, we just scale it to be slightly smaller."
                },
                {
                    "label": "Show a focus state on the custom radio button when the native one has focus.",
                    "highlight": "%CSS% radiogroup-css~ .enable-radio [type=\"radio\"]:focus + label::before {",
                    "notes": "If we don't add this, users won't know when this custom element has focus."
                }

            ]
        }
        </script>


        <h2>Example 3: Custom radio buttons using ARIA</h2>

        <p>Note that this example uses radiogroup and radio roles.</p>

        <div id="example2">
            <h3 class="form-heading">Set Alerts for your Account</h3>

            <!-- This groups the first two custom radio buttons -->

            <div role="radiogroup" aria-labelledby="alert1" class="enable-custom-radiogroup aria-form-group">
                <p id="alert1" class="legend">Send an alert when balance exceeds $ 3,000</p>
                <div>
                    <span role="radio" aria-checked="false" tabindex="0" aria-labelledby="a1r1" data-name="a1radio"></span>
                    <span id="a1r1" class="aria-radio-label">Yes</span>
                </div>
                <div>
                    <span role="radio" aria-checked="false" tabindex="0" aria-labelledby="a1r2" data-name="a1radio"></span>
                    <span id="a1r2" class="aria-radio-label">No</span>
                </div>
            </div>

            <!-- This groups the next two custom radio buttons -->

            <div role="radiogroup" aria-labelledby="alert2" class="enable-custom-radiogroup aria-form-group">
                <p id="alert2" class="legend">Send an alert when a charge exceeds $ 250</p>
                <div>
                    <span role="radio" aria-checked="false" tabindex="0" aria-labelledby="a2r1" data-name="a2radio"></span>
                    <span id="a2r1" class="aria-radio-label">Yes</span>
                </div>
                <div>
                    <span role="radio" aria-checked="false" tabindex="0" aria-labelledby="a2r2" data-name="a2radio"></span>
                    <span id="a2r2" class="aria-radio-label">No</span>
                </div>
            </div>
            <div>
                <input type="submit" value="Continue" />
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
                <form class="showcode__ui">                                        <div id="example2__steps" class="showcode__steps"></div>
                                        <div id="example2__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example2"
                        data-showcode-props="example2-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="example2-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "Use an HTML element with role=\"radiogroup\" set to group the related radio buttons",
                    "highlight": "role=\"radiogroup\"",
                    "notes": "This is the ARIA method to group ARIA radio buttons"
                },
                {
                    "label": "Set role=\"radio\" and tabindex=\"0\" to all the custom radio buttons",
                    "highlight": "role=\"radio\" ||| tabindex",
                    "notes": "The <strong>role=\"radio\"</strong> ensures screen readers announce the component as a radio button when it gets keyboard focus.  The <strong>tabindex=\"0\"</strong> ensures the elements get keyboard focus."
                },
                {
                    "label": "Set aria-checked to the appropriate value for all checkboxes",
                    "highlight": "aria-checked",
                    "notes": ""
                },
                {
                    "label": "Use aria-labelledby on the radiogroup to label the group",
                    "highlight": "aria-labelledby=\"alert[^\"]*\" ||| id=\"alert[^\"]*\"",
                    "notes": "The DOM elements that the aria-labelledby attribute points will act like the <strong>legend</strong> tag in the HTML5 example (i.e. it will label the entire fieldset and will be announced when screen reader users apply focus to the any of the radio buttons for the first time)."
                },
                {
                    "label": "Label the custom radio buttons with the aria-labelledby attribute",
                    "highlight": "aria-labelledby=\"a1[^\"]*\" ||| id=\"a1[^\"]*\" ||| aria-labelledby=\"a2[^\"]*\" ||| id=\"a2[^\"]*\"",
                    "notes": "Just like any form element, labels should be linked up with the radio button using the HTML for attribute in the label tag."
                },
                {
                    "label": "Ensure the arrow keys can be used to cycle through the radio buttons after they receive keyboard focus",
                    "highlight": "%JS% radiogroup",
                    "notes": "The <strong>accessibility.initGroup()</strong> method does the heavy lifting here.  It is also used to do the same thing in the <a href=\"08a-tabs.php\">Enable Tabs example</a>.  The <strong>doKeyChecking</strong> option passed to it ensures that the Space and Enter keys can be used to check the radio buttons when pressed."
                },
                {
                    "label": "Set up the CSS for the custom styles",
                    "highlight": "%CSS% radiogroup-css~ [role=\"radio\"] ||| width[^;]*; ||| height[^;]*;",
                    "notes": "This is the radio button's outer circle.  Note the width and height here are measured in <strong>rem</strong> units.  This is so they resize when you use the browser's text resizing/zooming feature."
                },
                {
                    "label": "Set up the CSS for the custom styles",
                    "highlight": "%CSS% radiogroup-css~ [role=\"radio\"][aria-checked=\"true\"]::after ||| top[^;]*; ||| left[^;]*; ||| width[^;]*; ||| height[^;]*; ||| transform[^;]*;",
                    "notes": "The <strong>::after</strong> pseudo-element is the coloured inner circle of the checked radio button. The width and height is the size of the radio button minus the border width, and then scaled down using CSS transforms. It is then positioned on top of the radio button's outer circle."
                },
                {
                    "label": "Set up the CSS so the inner and outer circles are really circles",
                    "highlight": "%CSS% radiogroup-css~ [role=\"radio\"], [role=\"radio\"]::after",
                    "notes": "A <strong>border-radius: 50%</strong> makes square elements a circle."
                }
            ]
        }
        </script>




        <h2>Example 4: HTML5 version that uses radiogroup roles.</h2>

        <div id="example4">
            <h3 class="form-heading">Set Alerts for your Account</h3>
            <div role="radiogroup" class="aria-form-group" aria-labelledby="html2-alert1">
                <p id="html2-alert1" class="legend">Send an alert when balance exceeds $ 3,000</p>
                <div>
                    <input type="radio" id="desc-radio1-1" name="a1e3radio" />
                    <label for="desc-radio1-1">Yes</label>
                </div>
                <div>
                    <input type="radio" id="desc-radio1-2" name="a1e3radio" />
                    <label for="desc-radio1-2">No</label>
                </div>
            </div>
            <div role="radiogroup" class="aria-form-group" aria-labelledby="html2-alert2">
                <p id="html2-alert2" class="legend">Send an alert when a charge exceeds $ 250</p>
                <div>
                    <input type="radio" id="desc-radio2-1" name="a2e3radio" />
                    <label for="desc-radio2-1">Yes</label>
                </div>
                <div>
                    <input type="radio" id="desc-radio2-2" name="a2e3radio" />
                    <label for="desc-radio2-2">No</label>
                </div>
            </div>
            <div>
                <input type="submit" value="Continue" />
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
                <form class="showcode__ui">                                        <div id="example4__steps" class="showcode__steps"></div>
                                        <div id="example4__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example4"
                        data-showcode-props="example4-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="example4-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                "label": "Set group elements aria-labelledby elements",
                "highlight": "aria-labelledby ||| role=\"radiogroup\"",
                "notes": "The radiogroup is like the <strong>fieldset</strong> tag. It should use the <strong>aria-labelledby</strong> to point to the element that labels the radiogroup (which acts as the legend tag)."
            }]
        }
        </script>
    </main>

    <script src="js/accessibility.js"></script>
    <script src="js/shared/radiogroup.js"></script>
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
    <script src="js/hamburger.js"></script></body>

</html>