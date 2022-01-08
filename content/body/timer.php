
    



        



        <aside class="notes">
            <h2>Notes:</h2>

            <p>This demo is based on code from
                <a                     href="https://css-tricks.com/how-to-create-an-animated-countdown-timer-with-html-css-and-javascript/">this
                    article</a> by
                <a href="https://css-tricks.com/author/mateuszrybczonek/">
                    Mateusz Rybczonek </a>.

                It has been modified to add accessibility features to it.
            </p>
        </aside>

        <h2>Timer Example</h2>

        <div id="timer-example" class="enable-example">
            <div id="app" role="timer" aria-live="assertive"></div>


            <button class="base-timer__start-timer">Start Timer</button>
        </div>


        <?php includeShowcode("timer-example")?>
        <script type="application/json" id="timer-example-props">
        {
            "replaceHtmlRules": {
                "#app": [
                    "<div class=\"base-timer\">",
                    "    <svg",
                    "        class=\"base-timer__svg\"",
                    "        viewBox=\"0 0 100 100\"",
                    "        xmlns=\"http://www.w3.org/2000/svg\"",
                    "    >",
                    "        <title></title>",
                    "        <g class=\"base-timer__circle\">",
                    "        ...",
                    "        </g>",
                    "    </svg>",
                    "    <span id=\"base-timer-label\" class=\"base-timer__label\">0:05</span>",
                    "    </div>    "
                ]
            },
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
                    "highlight": "%JS% timerExample ||| \\$clock.innerHTML[^;]*;",
                    "notes": ""
                },
                {
                    "label": "Ensure any images inside the timer have the appropriate alt text",
                    "highlight": "%OPENCLOSECONTENTTAG%title",
                    "notes": "Note that since this SVG image is decorative, we make the <code>title</code> tag blank."
                },
                {
                    "label": "Add the dynamic content in the timer",
                    "highlight": "%OPENCLOSECONTENTTAG%span",
                    "notes": "This is part that is read out by the screen reader.  All timers must have some sort of dynamic content to announce."
                }
            ]
        }
        </script>

    