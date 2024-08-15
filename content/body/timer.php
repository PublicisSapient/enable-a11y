<p>
    The <code>timer</code> role is to be used on any timer or clock, including stopwatch readouts and countdown timers.  Because of the immediate nature of the information given, it is recommended you use <code>aria-live="assertive"</code> to announce the value of the timer.
</p>

<h2>Timer Example</h2>

<?php includeStats([
    "isForNewBuilds" => true,
    "comment" => "This solution is good for new as well as existing work.",
]); ?>

<p>This demo is based on code from
  <a href="https://css-tricks.com/how-to-create-an-animated-countdown-timer-with-html-css-and-javascript/">this
    article</a> by
  <a href="https://css-tricks.com/author/mateuszrybczonek/">
    Mateusz Rybczonek</a>.

  It has been modified to add accessibility features to it.
</p>

<div id="timer-example" class="enable-example">
  <div id="app" role="timer" aria-live="assertive"></div>


  <button class="base-timer__start-timer">Start Timer</button>
</div>


<?php includeShowcode("timer-example"); ?>
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
      "highlight": "aria-live ||| id=\"base-timer-label\"",
      "notes": "<p>Only put this in if you want this timer to be read aloud by screen readers when it updates.  If it updates a lot (like once a second), it will make the screen reader rather noisy and be really annoying.</p><p>Note the <code>span</code> with <code>base-timer-label</code>.  We will be using that in the next step.</p>"
    },
    {
      "label": "Use .innerHTML to update the timer",
      "highlight": "%JS% startTimer ||| \\s*document.[^.]*.innerHTML[^;]*;",
      "notes": "We update the node mentioned in the previous step.  Since its parent is an ARIA live region, it will be announced by screen readers."
    },
    {
      "label": "Ensure any images inside the timer have the appropriate alt text",
      "highlight": "%OPENCLOSECONTENTTAG%title",
      "notes": "Note that since this SVG image is decorative, we make the <code>title</code> tag blank."
    }
  ]
}
</script>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "ARIA Timer Guide",
    "description": "Learn about the ARIA Timer role, see a live example, and explore the code implementation for enhanced web accessibility.",
    "url": "https://www.useragentman.com/enable/timer.php",
    "mainEntity": {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "What is the ARIA role for a timer?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "The ARIA role for a timer is `role='timer'`, used to convey time-based information to assistive technologies."
          }
        },
        {
          "@type": "CreativeWork",
          "name": "Live Example of ARIA Timer",
          "description": "A live demonstration of an ARIA Timer with real-time timer example.",
          "exampleOfWork": {
              "@type": "WebPage",
              "name": "ARIA Timer Code Sample",
              "url": "https://www.useragentman.com/enable/timer.php#timer-example--heading"
          }
        }
      ]
    }
  }
</script>