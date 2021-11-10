<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Timer Role Examples</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/timer.css" />

</head>

<body>

    <?php include("includes/documentation-header.php"); ?>

    <main>



        <h1>ARIA Timer Role Examples</h1>



        <aside class="notes">
            <h2>Notes:</h2>

            <p>This page uses code from
                <a href="http://pauljadam.com/demos/ariacountdown.html">this demo</a> by
                <a href="http://pauljadam.com/">Paul J. Adam</a>.
            </p>
        </aside>

        <h2>Timer Example</h2>

        <div id="timer-example" class="enable-example">
            <div id="clock" role="timer" aria-live="polite"></div>
        </div>

        <?php includeShowcode("timer-example")?>
        <script type="application/json" id="timer-example-props">
        {
            "replaceHTMLRules": {},
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
                }
            ]
        }
        </script>

    </main>


    <script src="js/timer.js"></script>
    <?php include "includes/example-footer.php"?>
</body>

</html>