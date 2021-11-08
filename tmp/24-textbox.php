<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Textbox Role Example</title>
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



    <link rel="stylesheet" type="text/css" href="css/group.css" />
    <link rel="stylesheet" type="text/css" href="css/form-error.css" />
    <link id="textbox-css" rel="stylesheet" type="text/css" href="css/textbox.css" />
    
</head>

<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>


    <main>
        <h1>ARIA Textbox Role Example</h1>
        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The first example is simply a
                    <code>div</code> with its
                    <code>contenteditable</code> attribute set to
                    <code>"true"</code>.
                    Textareas can be simulated using <code>aria-multiline="true"</code> and using CSS
                    <code>resize: both</code> to make them resizable.
                </li>
                <li>No JavaScript was involved in making these.</li>
                <li>The first example shows up as a form field in Voiceover's rotor and NVDA's Element Dialogue.</li>
                <li>The element will not submit its data to the server like a real form field.</li>
                <li>Coding
                    <code>&lt;input type="number" role="textbox" /></code> doesn't do anything useful in any
                    screenreader.
                </li>
            </ul>

        </aside>



        <h2>HTML example</h2>

        <div id="html-example">
            <form>
                <fieldset>
                    <legend>Payment information</legend>
                    <div>
                        <label for="ccinfo">Billing Address:</label>
                        <input type="text" name="ccinfo" id="ccinfo" />
                    </div>

                    <div>
                        <label for="notes" class="textarea-label">Notes:</label>
                        <textarea id="notes" name="notes"></textarea>
                    </div>
                </fieldset>

            </form>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="html-example__steps" class="showcode__steps"></div>
                                        <div id="html-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html-example"
                        data-showcode-props="html-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="html-example-props">
        {
            "replaceHTMLRules": {},
            "steps": [

                {
                    "label": "All form fields need labels",
                    "highlight": "for",
                    "notes": "Each form field have a <strong>label</strong> tag whose <strong>for</strong> element connects it to the form field via the form field's <strong>id</strong>."
                },
                {
                    "label": "Use <code>&lt;input type=\"text\"&gt;</code> for single line text inputs.",
                    "highlight": "%OPENTAG%input"
                },
                {
                    "label": "USe <code>&lt;textarea&gt;</code> for multiline text inputs",
                    "highlight": "%OPENCLOSETAG%textarea"
                }
            ]
        }
        </script>




        <h2>ARIA example</h2>

        <div id="aria-example">
            <div role="group" aria-labelledby="aria-payment-info-label" class="fieldset">
                <div id="aria-payment-info-label" class="legend">Payment Information</div>

                <div>
                    <label id="address-label"  class="textarea-label">Address to deliver to:</label>
                    <div aria-labelledby="address-label" role="textbox" contenteditable="true"></div>
                </div>

                <div>
                    <label id="notes-label"  class="textarea-label">Delivery Notes:</label>
                    <div aria-labelledby="notes-label" role="textbox" contenteditable="true" aria-multiline="true">
                    </div>
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
                <form class="showcode__ui">                                        <div id="aria-example__steps" class="showcode__steps"></div>
                                        <div id="aria-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-example"
                        data-showcode-props="aria-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="aria-example-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "Insert roles to ensure they are reported correctly by screen readers",
                    "highlight": "role",
                    "notes": ""
                },
                {
                    "label": "Make the content of the ARIA textbox editable using contenteditable attribute.",
                    "highlight": "contenteditable",
                    "notes": "If you do this, you don't need to set <strong>tabindex=\"0\"</strong>, since content editable elements get keyboard focus by default"
                },
                {
                    "label": "All ARIA textboxes need labels using aria-labelledby",
                    "highlight": "aria-labelledby",
                    "notes": "Each form field have a label."
                },
                {
                    "label": "Use aria-multiline if you are simulating a textarea element.",
                    "highlight": "aria-multiline",
                    "notes": ""
                },
                {
                    "label": "Use CSS to style multiline textboxes differently",
                    "highlight": "%CSS%textbox-css~ [role=\"textbox\"]; [role=\"textbox\"][aria-multiline=\"true\"]",
                    "notes": "Note the <code>resize: both</code> CSS on the multiline textbox.  This allows the browser to all the user to resize the textbox with a mouse (but not with a keyboard, as far as I'm aware).  <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/resize\">More information about this CSS property</a>."
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
    <script src="js/hamburger.js"></script>

    <!-- <script src="js/#STUB#.js"></script> -->
</body>

</html>