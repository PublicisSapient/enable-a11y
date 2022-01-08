<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    <title>ARIA Alert Demo</title>
    <?php include "includes/common-head-tags.php";?>

    <link rel="stylesheet" type="text/css" href="css/alert.css" />
</head>

<body>

    <?php include "includes/documentation-header.php";?>

    <main>
    <?php include "includes/pause-anim-control.php" ?>

        <h1>ARIA Alert Demo</h1>

        <aside class="notes">
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
        </aside>

        <h2>Example 1: Visual alert</h2>

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
                    "notes": ""
                },
                {
                    "label": "Add aria-live level",
                    "highlight": "aria-live",
                    "notes": "This should be set to <strong>polite</strong> if you want it to be announced after the screen reader is finished announcing other things, or <strong>assertive</strong> if you want the screen reader to interrupt what it is currently saying to state the message inside.  The latter should only be used sparingly."
                },
                {
                    "label": "Inject what you want alerted by screen readers into the aria-live region",
                    "highlight": "%JS%alert.sayTimeClickHandler",
                    "notes": "Just using <code>innerHTML</code> on the aria-live region is enough."
                }
            ]
        }
        </script>

    </main>


    <script src="js/demos/alert.js"></script>


    <?php include "includes/example-footer.php"?>
</body>

</html>