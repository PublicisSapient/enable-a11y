<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for HTML5 for Windows version 5.4.0">
  <title>ARIA Alert Demo</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta charset="utf-8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet" type="text/css" href="css/showcode.css">
<link href="css/libs/prism.css" rel="stylesheet" />

<!-- This is the global stylesheet -->
<link id="all-css" rel="stylesheet" href="css/shared/all.css" />
<link id="read-all-css" rel="stylesheet" href="css/shared/read-more.css" />

<!-- hamburger menu -->
<link id="hamburger-style" rel="stylesheet" type="text/css" href="css/hamburger-menu.css" />


<link id="site-css" rel="stylesheet" href="css/site.css" />



  
  <link rel="stylesheet" type="text/css" href="css/alert.css" />
</head>
<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
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
                        currently saying to the user.  Using the same example above, if
                        the user tabs into a button and the screen reader is describing it,
                        a polite alert wait until it has finished describing that button before
                        saying the alert to the user.
                    </li>
                </ul>
            </aside>

        <h2>Example 1: Visual alert</h2>

        <div id="visual-alert-example">

            <div id="visual-alert" role="alert" aria-live="assertive" aria-expanded="true">This is an aria live region alert.</div>
            
            <button id="say-time">Tell me the time.</button>

        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="visual-alert-example__steps" class="showcode__steps"></div>
                                        <div id="visual-alert-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="visual-alert-example"
                        data-showcode-props="visual-alert-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="visual-alert-example-props">
        {
            "replaceHTMLRules": {
                "this": "that"
            },
            "steps": [
                {
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

        <p>This example is only to illustrate how an aria-live="polite" works.
            If you want to make an accessible expando, please look at
            <a href="33-dropdown.php">accessible drawer example</a>.

        <div id="visually-hidden-example">
            <div id="polite-alert" role="alert" aria-live="polite" class="sr-only"></div>


            <div class="expando">
                <h2><button id="say-expanded-state" class="expando__button" data-section="table of contents">Expand table of contents</button></h2>
                <section class="expando__contents expando__contents--collapsed">
                    <h3>Table of Contents</h3>
                    <ul>
                        <li><a href="#intro">Introduction</a></li>
                        <li><a href="#thesis">Thesis</a></li>
                        <li><a href="#conclusion">Conclusion</a></li>   
                    </ul>
                </section>
            </div>
        </div>


                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="visually-hidden-example__steps" class="showcode__steps"></div>
                                        <div id="visually-hidden-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="visually-hidden-example"
                        data-showcode-props="visually-hidden-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="visually-hidden-example-props">
        {
            "replaceHTMLRules": {
                "this": "that"
            },
            "steps": [
                {
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
                }

            ]
        }
        </script>

    </main>


    <script src="js/shared/polyfills.js"></script>
    <script src="js/alert.js"></script>


        <footer aria-label="Copyright Information">
            
        Enable is a labour of love originally by
        <a href="https://useragentman.com">Zoltan Hawryluk</a>, released as open
        source so hopefully others can learn from it.  This content is covered by the the <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International Licence</a>

    </footer> 
        

    <!-- These three script tags are for the code samples -->
    <script src="node_modules/indent.js/lib/indent.min.js"></script>
    <script src="js/libs/prism.js" data-manual></script>
    <script src="js/showcode.js"></script>

    <!-- Hamburger Menu -->
    <script src="js/accessibility.js"></script>
    <script src="js/hamburger.js"></script></body>
</html>
