<p>
    An <code>alert</code> is an ARIA live region is meant for error or warning messages that appear on the screen.  It is usally implied to have a <code>aria-live</code> value of <code>assertive</code>
</p>
    

        

        <!-- <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>
                    An assertive alert will be spoken immediately by a screen reader, and will
                    interrupt what the screen reader was saying at that moment. For example, if
                    the user tabs into a button and the screen reader is describing it, triggering
                    an asserive alert will interrupt that description in order
                    to give the alert to the user immediately.
                </li>
                <li>A polite alert will be spoken when the screenreader finishes what it
                    currently saying to the user. Using the same example above, if
                    the user tabs into a button and the screen reader is describing it,
                    a polite alert wait until it has finished describing that button before
                    saying the alert to the user.
                </li>
            </ul>
        </aside> -->

        <h2>Example 1: Visual alert</h2>

        <?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This solution works well for new and existing work.')) ?>

        <p>
            Clicking the button below will show the current time on the screen.  Since the current time text is inside an div with <code>role="alert"</code> and <code>aria-live="assertive"</code>, the text will be announced immediately by screen readers.
        </p>

        <div id="visual-alert-example" class="enable-example">

            <div id="assertive-alert" role="alert" aria-live="assertive">This is an aria live region
                alert.</div>

            <button id="say-time">Tell me the time.</button>

        </div>

        <?php includeShowcode("visual-alert-example")?>

        <script type="application/json" id="visual-alert-example-props">
        {
            "replaceHtmlRules": {
                "this": "that"
            },
            "steps": [{
                    "label": "Add role of alert",
                    "highlight": "role",
                    "notes": "This and the <code>aria-live</code> attribute in the next step should be in the DOM <em>before</em> you change its content with JavaScript, preferably when the page loads.  <strong>Never insert an ARIA live region with JavaScript with the content you want to announce at the same time</strong> &mdash; it won't work."
                },
                {
                    "label": "Add aria-live level",
                    "highlight": "aria-live",
                    "notes": "This should be set to <strong>polite</strong> if you want it to be announced after the screen reader is finished announcing other things, or <strong>assertive</strong> if you want the screen reader to interrupt what it is currently saying to state the message inside.  The latter should only be used sparingly."
                },
                {
                    "label": "Inject what you want alerted by screen readers into the aria-live region",
                    "highlight": "%JS%alert.sayTimeClickHandler ||| assertiveAlertEl.innerHTML[^;]*;",
                    "notes": "Note that <code>assertiveAlertEl = document.getElementById('assertive-alert')</code> (from the previous step).  Just using <code>innerHTML</code> on the aria-live region is enough to have screen readers announce the content."
                }
            ]
        }
        </script>

    