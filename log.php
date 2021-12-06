<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aria Log Role Examples</title>
	<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/log.css" />
    
</head>

<body>
    <?php include("includes/documentation-header.php"); ?>

    <main>


        <h1>Aria Log Role Examples</h1>
        <aside class="notes">

            <h2>Notes:</h2>

            <ul>
                <li>By default, Chromevox is the only browser will only say the updates in the log. All other screenreaders will
                    read the whole log like an alert.
                </li>
                <li>
                    NVDA does not just read the differences, even when hitting NVDA+5
                </li>
            </ul>
        </aside>
        <h2>Example 1: </h2>

        <p>
            The following example is a log that will announce the CPU usage of the webserver every five seconds.

        <div id="log-example" class="enable-example">
        <pre id="syslog" role="log" aria-atomic="false">
<span>Initializing.  Please wait …</span>
        </pre>
</div>

        <?php includeShowcode("log-example")?>
        <script type="application/json" id="log-example-props">
        {
            "replaceHtmlRules": {
                "#syslog": [
                    "<span>Initializing.  Please wait …</span>",
                    "<span>CPU load at 4:00:08 pm: 2%</span>",
                    "<span>CPU load at 4:00:13 pm: 2%</span>",
                    "..."
                ]
            },
            "steps": [
            {
                "label": "Add role of log",
                "highlight": "role",
                "notes": ""
            },
            {
                "label": "Add aria-atomic=\"false\"",
                "highlight": "aria-atomic",
                "notes": "Doing this will ensure that only the updates are read out by screen readers."
            },
            {
                "label": "Ensure new information are encapsulated in separate DOM nodes.",
                "highlight": "%OPENCLOSECONTENTTAG%span",
                "notes": "The aria-atomic attribute will ensure only new DOM elements will be announced.  If you don't add the information in separate DOM nodes, screen readers will read the entire contents of the log."
            }
        ]}
        </script>

    </main>
    <script src="js/log.js"></script>
    <?php include "includes/example-footer.php"?>
</body>

</html>