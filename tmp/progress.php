<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Progress Role Example</title>
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



    <link rel="stylesheet" type="text/css" href="css/progress.css" />

</head>

<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>



        <h1>ARIA Progress Role Example</h1>
        <aside class="notes">
            <h2>Notes:</h2>

            <p>The most bulletproof of the methods below to use is the ARIA version, without changing focus to the
                progress bar as it's changing, since
                it works with the majority of screen-readers.
            </p>

            <p>Screen reader specific information:</p>
            <ul>
                <li>NVDA has special functionality regarding progress bars:
                    <ul>
                        <li>hitting NVDA+u controls how NVDA reports progress bar updates to you.
                            <ul>
                                <li>Off: Progress bars will not be reported as they change.
                                </li>
                                <li>Speak: This option tells NVDA to speak the progress bar in percentages. Each time
                                    the progress
                                    bar changes, NVDA will speak the new value.
                                </li>
                                <li>Beep: This tells NVDA to beep each time the progress bar changes. The higher the
                                    beep, the
                                    closer the progress bar is to completion.
                                </li>
                                <li>Beep and speak: This option tells NVDA to both beep and speak when a progress bar
                                    updates.
                                </li>
                            </ul>
                        </li>

                        <li>For the ARIA
                            <code>progressbar</code> role (but not the HTML5
                            <code>progress</code> tag) NVDA will intepret the value of
                            <code>aria-valuenow</code> as a percentage value, regardless of the value of
                            <code>aria-valuemax</code>. It will also not read out the values correctly "live" when
                            incrementing.
                        </li>
                        <li>NVDA does read the
                            <code>aria-valuetext</code> value correctly.
                        </li>
                    </ul>
                </li>
                <li>Voiceover and Chromevox doesn't correctly read the
                    <code>aria-valuetext</code> of the ARIA progressbar.
                </li>
                <li>For ARIA progress bars (not HTML ones), Voiceover will tick when the progress bar updates.</li>
            </ul>
        </aside>

        <h2>HTML5 progress bar</h2>

        <p>This progress bar uses aria-live regions to update the status of the progress bar. It works in for all screen
            readers.</p>

        <div id="html5-example" class="enable-example">
            <progress id="html1" class="uam" max="100" value="0" data-timeout="1000" data-alert="html1-alert">
            </progress>
            <strong class="sr-only" id="html1-alert" aria-live="assertive" aria-atomic="true" role="alert">0%</strong>
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
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "Use the HTML5 progress tag to make your progress bar",
                    "highlight": "%OPENCLOSECONTENTTAG%progress",
                    "notes": "Set the <code>min</code> and <code>max</code> values are the min and max values of what the progress bar is measuring. <code>value</code> is the current value."
                },
                {
                    "label": "Use an <code>aria-live</code> region to announce value changes.",
                    "highlight": "%OPENCLOSECONTENTTAG%strong",
                    "notes": "When the value is incremented in the progress bar, this DOM node is also updated. This ensures the progress values are announced by all screen readers, since how they are announced without it varies (and depends on how the screen reader is configured"
                }
            ]
        }
        </script>


        <p>
            This progress bar uses the screen reader's native functionality to read the
            progress bar by setting keyboard focus on the bar when incrementing.
        </p>

        <div id="html5-focus-example" class="enable-example">
            <progress id="html2" class="uam" max="100" value="0" data-timeout="1000" tabindex="-1"
                aria-label="Loading Data">
            </progress>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="html5-focus-example__steps" class="showcode__steps"></div>
                                        <div id="html5-focus-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html5-focus-example"
                        data-showcode-props="html5-focus-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="html5-focus-example-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "Ensure tabindex=\"-1\" is set on progress bar",
                    "highlight": "tabindex=\"-1\"",
                    "notes": "This allows the progress bar to be focusable via JavaScript only"
                },
                {
                    "label": "Focus element using Javascript when progress starts progressing",
                    "highlight": "%JS% progressTest.progressTestClickEvent ||| el.focus\\(\\);",
                    "notes": ""
                }
            ]
        }
        </script>


        <h2>ARIA role="progressbar" Example</h2>

        <p>This progress bar uses aria-live regions to update the status of the progress bar. It is the safest way to
            ensure your progress bars are accessible.

            <strong>Note: this doesn't do anything in VoiceOver for OSX</strong>


        </p>

        <div id="aria-example1" class="enable-example">
            <div id="aria1" role="progressbar" class="uam" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                data-alert="aria1-alert" data-timeout="1000" aria-label="Loading Data">
            </div>
            <strong class="sr-only" id="aria1-alert" aria-live="assertive" aria-atomic="true" role="alert">0%</strong>
        </div>
                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="aria-example1__steps" class="showcode__steps"></div>
                                        <div id="aria-example1__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-example1"
                        data-showcode-props="aria-example1-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="aria-example1-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "Mark up your progress bar with role=\"progressbar\".",
                    "highlight": "role=\"progressbar\"",
                    "notes": ""
                },
                {
                    "label": "Set min, max and current values",
                    "highlight": "aria-valuemin |||  aria-valuemax |||  aria-valuenow",
                    "notes": ""
                },
                {
                    "label": "Use an <code>aria-live</code> region to announce value changes.",
                    "highlight": "%OPENCLOSECONTENTTAG%strong",
                    "notes": "When the value is incremented in the progress bar, this DOM node is also updated. This ensures the progress values are announced by all screen readers, since how they are announced without it varies (and depends on how the screen reader is configured"
                }
            ]
        }
        </script>

        <p>This progress bar uses the screen reader's native functionality to read the progress bar by setting keyboard
            focus on the bar when incrementing.
            <strong>At the time of this writing, this doesn't work in Voiceover on OSX &lt;= 10.15.7</strong>
        </p>

        <div class="enable-example">
            <div id="ex2" role="progressbar" class="uam" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                data-alert="ex2-alert" tabindex="-1" data-timeout="1000">
            </div>
        </div>

        <h2>Advanced ARIA progressbar role example</h2>

        <p>
            This uses the <code>aria-valuetext</code> to update the progress bar.
            <strong>At the time of this writing, this doesn't work in Voiceover on OSX &lt;= 10.15.7</strong>
        </p>

        <div id="aria-valuetext-example" class="enable-example">
            <div id="ex3" class="verbose" role="progressbar" aria-valuemin="0" aria-valuemax="7" aria-valuenow="0"
                data-timeout="4000" data-step="1" data-set-valuetext="true" aria-label="Attempting to fulfill order"
                tabindex="-1">
                <ol>
                    <li aria-hidden="true">Checking Credit Card Validity</li>
                    <li aria-hidden="true">Charging Card</li>
                    <li aria-hidden="true">Giving Card Information To Local Mafia</li>
                    <li aria-hidden="true">Creating Account</li>
                    <li aria-hidden="true">Sending Welcome E-mail</li>
                    <li aria-hidden="true">Sending E-mail Address To Business Partners</li>
                    <li aria-hidden="true">Complete!</li>
                </ol>
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
                <form class="showcode__ui">                                        <div id="aria-valuetext-example__steps" class="showcode__steps"></div>
                                        <div id="aria-valuetext-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-valuetext-example"
                        data-showcode-props="aria-valuetext-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="aria-valuetext-example-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "First add the progressbar role",
                    "highlight": "role=\"progressbar\"",
                    "notes": ""
                },
                {
                    "label": "Next add the min, max and current values",
                    "highlight": "aria-valuemin ||| aria-valuemax ||| aria-valuenow",
                    "notes": ""
                },
                {
                    "label": "Use aria-valuetext with a user friendly message when you update the aria-valuenow",
                    "highlight": "%JS% progressTest ||| el.setAttribute\\('aria-valuetext'[^\\s]*;",
                    "notes": "You can use <code>aria-valuetext</code> with any message. It will announce this instead of just the value."
                }

            ]
        }
        </script>

    </main>

    <script src="js/progress.js"></script>
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