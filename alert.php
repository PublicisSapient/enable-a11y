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
            "replaceHTMLRules": {
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


        <h2> Example 2: Visually Hidden Alert</h2>

        <p>This example is based on <a href="https://gist.github.com/nichtich/674522">this wiktionary lookup gist</a> by <a lang="de" href="https://gist.github.com/nichtich">Jakob Voß</a>,
        modified to add accessibility features, including an <code>alert</code> that will tell screen reader users that content has changed on the page.</p>


        <div id="visually-hidden-example" class="enable-example">
            <form class="wiktionary-lookup__form">
                <label for="wiktionary-lookup__word">
                    Lookup a word:
                </label>
                <input type="text" class="wiktionary-lookup__word" />
                <button type="submit">Find word</button>
            </form>
            <h1 class="wiktionary-lookup__page-title"></h1>
            <div class="wiktionary-lookup__page-alert sr-only" role="alert" aria-live="polite">

            </div>
            <div class="wiktionary-lookup__content"></div>
            <div class="wiktionary-lookup__license-info" style="font-size: small; display: none">
                Modified original content <a class="wiktionary-lookup__source-url">from Wiktionary</a>. Content is available
                under the
                <a href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution/Share-Alike
                    License</a>.
            </div>
        </div>


        <?php includeShowcode("visually-hidden-example")?>

        <script type="application/json" id="visually-hidden-example-props">
        {
            "replaceHTMLRules": {
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
                    "label": "Hide the alert with <code>sr-only</code> class",
                    "highlight": "class=\"sr-only\"",
                    "notes": "This is a standard class that hides items visually but allows screen readers to access them."
                },
                {
                    "label": "CSS for sr-only",
                    "highlight": "%CSS%all-css ~ .sr-only",
                    "notes": "This is the sr-only class we use in the Enable project. There are several variations of this available on the web."
                },
                {
                    "label": "use .innerHTML to update the live region",
                    "highlight": "%JS% dictLookup ||| const \\$pageAlert[^;]*; ||| \\$pageAlert.innerHTML[^;]*;" ,
                    "notes": ""
                }

            ]
        }
        </script>

    </main>


    <script src="js/shared/polyfills.js"></script>
    <script src="js/alert.js"></script>


    <?php include "includes/example-footer.php"?>
</body>

</html>