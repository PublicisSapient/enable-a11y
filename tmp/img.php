<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Img Role</title>
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



        <link rel="stylesheet" type="text/css" href="css/img.css" />

</head>

<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>

        <aside class="notes">

            <h2>Notes</h2>

            <ul>
                <li>Both HTML and ARIA role work that same in NVDA and Voiceover.</li>
            </ul>
        </aside>

        <h1>ARIA Img Role</h1>


        <p>Code based on that from
            <a href="http://pauljadam.com/demos/img.html">Paul J Adam's img role demo</a>.</p>


        <h2>HTML5 img tag</h2>
        <div id="html5-example" class="enable-example">
            <img src="images/card_icons.png" width="100" height="94" alt="Debit, Visa, MasterCard, American Express, Discover Network"
            />
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="html5-example__steps" class="showcode__steps"></div>
                                        <div id="html5-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html5-example"
                        data-showcode-props="html5-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="html5-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
            {
             "label": "Add an alt attribute",
             "highlight": "alt",
             "notes": "You must <strong>always</strong> have an alt attribute that is meaningful. If your image is decorative, see the next example."
            } 
        ]}
        </script>

        <h2>Decorative Image</h2>

        <p>
            A decorative image is an image that is used to enhance an idea presented in text,
            but is not necessary to understand it.  Icons around navigation items and error icons,
            around error text are perfect examples.
        </p>

        <div id="decorative-example" class="enable-example decorative-example">
            <img class="decorative-example__icon" src="images/bomb.png" alt="" />
            <p><strong>You made an error.</strong></p>
            <p>Please back away from the keyboard to avoid any further damage.</p>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="decorative-example__steps" class="showcode__steps"></div>
                                        <div id="decorative-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="decorative-example"
                        data-showcode-props="decorative-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="decorative-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
            {
             "label": "Use a blank alt attribute",
             "highlight": "alt",
             "notes": "Note that not including an alt attribute is not an alternative to a blank alt attribute. The alt attribute must always be included."
            }
        ]}
        </script>


        <h2>ARIA Example</h2>
        <div id="aria-example" class="enable-example clearfix">
            <div class="sprite card_icons amex" role="img" aria-label="American Express"></div>
            <div class="sprite card_icons discover" role="img" aria-label="Discover Network"></div>
            <div class="sprite card_icons visa" role="img" aria-label="Visa"></div>
            <div class="sprite card_icons master" role="img" aria-label="MasterCard"></div>
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
        </div>        <script type="application/json" id="aria-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
            {
                "label": "Use role of img",
                "highlight": "role",
                "notes": "This is perfect when you are using background images and image sprites."
            },
            {
                "label": "Put alt text inside the aria-label of the img element",
                "highlight": "aria-label",
                "notes": "Does the same thing as <code>alt</code> in the HTML5 version.  If decorative, use <code>aria-label=\"\"</code>"
            }
        ]}
        </script>

       

        <h2>Inline SVG example with text markup</h2>
        <div id="inline-svg-example" class="enable-example">
            <svg width="200" height="163" role="img" aria-labelledby="circle-alt svg-text">
                <title id="circle-alt">A dark blue circle with text inside</title>
                <!-- 
                    it is a good idea to put a background color for the image so any text without 
                    a background is still legible.
                -->
                <rect x="0" y="0" width="200" height="163" fill="#ffffff" fill-opacity="1"></rect>
                <circle cx="81" cy="85" r="75" fill="#00a" stroke="#000" stroke-width="1"/>
                <text id="svg-text" x="81" y="85" font-size="14px" text-anchor="middle" fill="#fff">
                    I am text in a circle
                </text>
            </svg>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="inline-svg-example__steps" class="showcode__steps"></div>
                                        <div id="inline-svg-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="inline-svg-example"
                        data-showcode-props="inline-svg-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="inline-svg-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
            {
                "label": "Add a role of img",
                "highlight": "role",
                "notes": "Just like the previous example"
            },
            {
                "label": "Add aria-labelledby",
                "highlight": "aria-labelledby",
                "notes": "Note that aria-labelledby points to both the <code>title</code> and <code>text</code> tags. Screen readers will read both."
            }
        ]}
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
    <script src="js/hamburger.js"></script></body>

</html>