<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accessible Animated GIF</title>
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



    <link id="pauseable-animated-gif-style1" rel="stylesheet" type="text/css" href="css/pauseable-animated-gif.css" />

</head>

<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>

        <aside class="notes">

            <p>This idea was stolen from <a href="https://codepen.io/stevef/pen/ExPdNMM">this CodePen by Steven Faulkner</a>.
            The pause first example was from <a href="https://css-tricks.com/pause-gif-details-summary/">Chris Coyier</a>.
        </aside>

        <h1>Animated GIF With Pause Button Without JavaScript</h1>
        

        <h2>Animation off by default</h2>

        <div id="example1" class="pauseable-animated-gif">
            <img src="images/running-man-anim__still.jpg" alt="A drawing of a man running" loading="lazy">
            <details>

                <summary role="button" class="pauseable-animated-gif__play-pause-button" aria-label="play"></summary>

                <div class="pausable-animated-gif__animated-image">
                    <img src="images/running-man-anim.gif" alt="Animated: A drawing of a man running" loading="lazy">
                </div>
            </details>
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

        <div id="example2" class="pauseable-animated-gif">
            <img src="images/running-man-anim__still.jpg" alt="A drawing of a man running" loading="lazy">
            <details open>

                <!-- added role=button to summary to resolve iOS funkiness -->

                <summary role="button" class="pauseable-animated-gif__play-pause-button" aria-label="pause"></summary>

                <div class="pausable-animated-gif__animated-image">
                    <img src="images/running-man-anim.gif" alt="Animated: A drawing of a man running" loading="lazy">
                </div>
            </details>
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
            "replaceHTMLRules": {
            },
            "steps": [
                {
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
            This is the only example on this page that does require JavaScript.  It detect whether the OS
            has "reduced motion" turned on by default.  If it is, then it keeps the details widget closed.
        </p>

        <div id="example3">
            <div class="pauseable-animated-gif pauseable-animated-gif--respects-os-motion-settings">
                <img src="images/running-man-anim__still.jpg" alt="A drawing of a man running" loading="lazy">
                <details>

                    <!-- added role=button to summary to resolve iOS funkiness -->

                    <summary role="button" class="pauseable-animated-gif__play-pause-button"></summary>

                    <div class="pausable-animated-gif__animated-image">
                        <img src="images/running-man-anim.gif" alt="Animated: A drawing of a man running" loading="lazy">
                    </div>
                </details>
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
                <form class="showcode__ui">                                        <div id="example3__steps" class="showcode__steps"></div>
                                        <div id="example3__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example3"
                        data-showcode-props="example3-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="example3-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
                {
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

    <script src="js/shared/enable-animatedGif.js"></script>

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