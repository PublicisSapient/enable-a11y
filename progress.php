<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Progress Role Example</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/progress.css" />

</head>

<body>

    <?php include("includes/documentation-header.php"); ?>

    <main>



        <h1>ARIA Progress Bar Examples</h1>
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

        <h2>Overview</h2>

        <p>
            Progress bars show the completion status of a current task.  It may be something that is fairly static 
            for the page (e.g. A page with a progress bar indicating the delivery status of a package is unlikely 
            to be updated in real time after the page is loaded), then you won't need an aria-live region that 
            announces the status value.  However, if it is a task that is being reported in real time (e.g. 
            how log it will take to upload a movie file to a web server), then you will want that information 
            updated to the user in real time as it happens.  In the latter case, the developer and UX designer should
            think how immediate this information should be given to screen reader users, since this information cause
            a bit of noise, and set the aria-live level appropriately. If the user is not going to be doing anything
            else on the screen while the action is happening and needs immediate updates, use <code>aria-live="assertive"</code>.
            If the user is going to be doing other things on the page while the progress bar is updating, use <code>"polite"</code>
            instead.
        </p>



        <h2>HTML5 progress bar</h2>

        <p>
            This progress bar uses aria-live regions to update the status of the progress bar. It works in for all
            screen
            readers. It is the most bulletproof way to implement a progress bar if you need to ensure that screen reader
            users are updated as soon as the progress bar value changes.

        </p>

        <div id="html5-example" class="enable-example">
            <progress aria-label="Loading progress" id="html1" class="uam" max="100" value="0" data-timeout="1000" data-alert="html1-alert">
            </progress>
            <strong class="sr-only" id="html1-alert" aria-live="assertive" aria-atomic="true" role="alert">0%</strong>
        </div>
        <?php includeShowcode("html5-example")?>
        <script type="application/json" id="html5-example-props">
        {
            "replaceHtmlRules": {},
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
            <strong>This doesn't announce updates on Mac OSX Voiceover with Safari.</strong>
        </p>

        <div id="html5-focus-example" class="enable-example">
            <progress id="html2" class="uam" max="100" value="0" data-timeout="1000" tabindex="-1"
                aria-label="Loading Data">
            </progress>
        </div>

        <?php includeShowcode("html5-focus-example")?>
        <script type="application/json" id="html5-focus-example-props">
        {
            "replaceHtmlRules": {},
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
        </p>

        <div id="aria-example1" class="enable-example">
            <div id="aria1" role="progressbar" class="uam" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
                data-alert="aria1-alert" data-timeout="1000" aria-label="Loading Data">
            </div>
            <strong class="sr-only" id="aria1-alert" aria-live="assertive" aria-atomic="true" role="alert">0%</strong>
        </div>
        <?php includeShowcode("aria-example1")?>
        <script type="application/json" id="aria-example1-props">
        {
            "replaceHtmlRules": {},
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
            <div id="ex2" role="progressbar" aria-label="Loading progress" class="uam" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"
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

        <?php includeShowcode("aria-valuetext-example")?>
        <script type="application/json" id="aria-valuetext-example-props">
        {
            "replaceHtmlRules": {},
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
    <?php include "includes/example-footer.php"?>
</body>

</html>