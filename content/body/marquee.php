<p>
Marquees (a.k.a. Auto-Scrolling Content) are meant for content that scrolls or updates consistently, like a stock ticker or a news feed. 
    Although they have a default <code>aria-live</code> value of <code>off</code>, you can use <code>aria-live="polite"</code> to let users hear the information within a marquee in almost real-time.  Do this carefully since it would be a bad user experience to have a screen reader update too often. The rest of your application will become unusable to screen reader users due to too much screen reader noise when there are too many alerts.
</p>

<p>
    <strong>Note:</strong> just like all animations, there should be a pause button to stop the marquee from rotating in order to comply with <a href="https://www.w3.org/WAI/WCAG21/Understanding/pause-stop-hide.html">WCAG 2.2.2: Pause, Stop, Hide</a>.  In this example, the user can use the "Pause All Animations" widget at the top of the page to do this.
</p>
    
        

        <!-- <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>Marquees have an default <code>aria-live</code> value of <code>"off"</code></li>
                <li>When setting <code>aria-live</code> to another value, NVDA and ChromeVox will read the value, but
                    older versions of Voiceover may not.</li>
                <li>The role is not reported in any of the screen readers tested in reading mode.</li>
            </ul>
        </aside> -->

        <h2>Example 1 - News Ticker</h2>
        
        <?php includeStats([
            "isForNewBuilds" => true,
            "This solution is good for new and existing work.",
        ]); ?>

        <p>
            The news headlines in this ticker are provided by <a href="https://newsapi.org">News API</a>.
        </p>

        <div id="marquee-example" class="enable-example">
            <div id="myMarquee" role="marquee" aria-live="polite">
                Loading News Articles.
            </div>
        </div>

        <?php includeShowcode("marquee-example"); ?>
        <script type="application/json" id="marquee-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Add role",
                    "highlight": "role",
                    "notes": ""
                },
                {
                    "label": "Add aria-live attribute",
                    "highlight": "aria-live",
                    "notes": "Only put this in if you want this timer to be read aloud by screen readers when it updates.  If it updates a lot (like once a second), it will make the screen reader rather noisy and be really annoying."
                },
                {
                    "label": "Use .innerHTML to update the timer",
                    "highlight": "%JS% rotateMarquee ||| \\marqueeEl.innerHTML = `[^`]*`;",
                    "notes": ""
                }
            ]
        }
        </script>

    