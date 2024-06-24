
    


<p>
The <code>log</code> role is an ARIA-live region where new information is added in a meaningful order and old information may disappear.  Things that could be considered logs are chat history and server logs (like in the example below).
</p>

<p>
    I have noticed that some screen reader/browser combinations (like NVDA with Firefox) don't read out just the changes: they will read out the contents of the node in its entirety if something is added to the bottom.  If the contents of the region is large, this defeats the 
    purpose of using this region for updates only.  It is for this reason I don't recommend using this role, but if you are an accessibility developer and have a different take on this, please let me know.
</p>
        <!-- <aside class="notes">

            <h2>Notes:</h2>

            <ul>
                <li>By default, Chromevox is the only browser will only say the updates in the log. All other screen readers will
                    read the whole log like an alert.
                </li>
                <li>
                    NVDA does not just read the differences, even when hitting NVDA+5
                </li>
            </ul>
        </aside> -->
        <h2>Example 1: </h2>

        <?php includeStats([
            "doNot" => true,
            "comment" =>
                'This doesn\'t seem to work as intended in many browser/screen reader combinations, so I advise not using it.',
        ]); ?>

        <p>
            The following example is a log that will announce the CPU usage of the web server every five seconds.

        </p><div id="log-example" class="enable-example">
        <pre id="syslog" role="log" aria-atomic="true">
<span>Initializing.  Please wait …</span>
        </pre>
</div>

        <?php includeShowcode("log-example"); ?>
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

    