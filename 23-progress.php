<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Progress Role Example</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/progress.css" />
    
</head>

<body>

    <?php include("includes/example-header.php"); ?>

    <main>



        <h1>ARIA Progress Role Example</h1>
        <aside class="notes">
            <h2>Notes:</h2>

            <p>The most bulletproof of the methods below to use is the ARIA version, without changing focus to the progress bar as it's changing, since
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
                                <li>Speak: This option tells NVDA to speak the progress bar in percentages. Each time the progress
                                    bar changes, NVDA will speak the new value.
                                </li>
                                <li>Beep: This tells NVDA to beep each time the progress bar changes. The higher the beep, the
                                    closer the progress bar is to completion.
                                </li>
                                <li>Beep and speak: This option tells NVDA to both beep and speak when a progress bar updates.
                                </li>
                            </ul>
                        </li>

                        <li>For the ARIA
                            <code>progressbar</code> role (but not the HTML5
                            <code>progress</code> tag) NVDA will intepret the value of
                            <code>aria-valuenow</code> as a percentage value, regardless of the value of
                            <code>aria-valuemax</code>. It will also not read out the values correctly "live" when incrementing.</li>
                        <li>NVDA does read the
                            <code>aria-valuetext</code> value correctly.</li>
                    </ul>
                </li>
                <li>Voiceover and Chromevox doesn't correctly read the
                    <code>aria-valuetext</code> of the ARIA progressbar.</li>
                <li>For ARIA progress bars (not HTML ones), Voiceover will tick when the progress bar updates.</li>
            </ul>
        </aside>

        <h2>HTML5 progress bar</h2>

        <p>This progress bar uses aria-live regions to update the status of the progress bar.</p>

        <div class="progress__example">
            <progress id="html1" class="uam" max="100" value="0" data-timeout="1000" data-alert="html1-alert" >
            </progress>
            <strong class="sr-only" id="html1-alert" aria-live="assertive" aria-atomic="true" role="alert">0%</strong>
        </div>

        <p>This progress bar uses the screen reader's native functionality to read the progress bar by setting keyboard focus on the bar when incrementing.</p>

        <div class="progress__example">
            <progress id="html2" class="uam" max="100" value="0" data-timeout="1000" tabindex="-1">
            </progress>
        </div>

        <h2>ARIA role="progressbar" Example</h2>

        <p>This progress bar uses aria-live regions to update the status of the progress bar.</p>

        <div class="progress__example">
            <div id="aria1" role="progressbar" class="uam" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-alert="aria1-alert" data-timeout="1000">
            </div>
            <strong class="sr-only" id="aria1-alert" aria-live="assertive" aria-atomic="true" role="alert">0%</strong>
        </div>

        <p>This progress bar uses the screen reader's native functionality to read the progress bar by setting keyboard focus on the bar when incrementing.</p>

        <div class="progress__example">
            <div id="ex2" role="progressbar" class="uam" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-alert="ex2-alert" tabindex="-1" data-timeout="1000">
            </div>
        </div>

        <h2>Advanced ARIA progressbar role example</h2>

        <p>This uses the <code>aria-valuetext</code> to update the progress bar.</p>

        <div>
            <div id="ex3" class="verbose" role="progressbar" aria-valuemin="0" aria-valuemax="7" aria-valuenow="0" data-timeout="1000"
                data-step="1" data-set-valuetext="true" >
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

    </main>

    <script src="js/progress.js"></script>
</body>

</html>