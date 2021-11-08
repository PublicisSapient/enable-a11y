<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aria Figure/Figcaption role examples</title>
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



    <link rel="stylesheet" type="text/css" href="css/figure.css" />

</head>

<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>

        <aside class="notes">
            <h2>Notes</h2>
            <ul>
                <li>This is new tech that most assistive technologies don't implement.</li>
                <li>These examples are from
                    <a href="https://developer.paciellogroup.com/blog/2011/08/html5-accessibility-chops-the-figure-and-figcaption-elements/">HTML5 Accessibility Chops: the figure and figcaption elements</a>
                    by
                    <a href="http://www.html5accessibility.com/">Steve Faulkner</a>
                </li>
                <li>The structure of HTML5 example is reported correctly in Voiceover.</li>
                <li>The structure of the ARIA example is
                    <strong>not</strong> reported correctly in Voiceover.</li>
            </ul>
        </aside>

        <h1>Aria Figure/Figcaption role examples</h1>



        <h2>HTML5 Example</h2>
        <div id="html5-example">
            <figure>
                
                <code>
                function warning()
                {alert('Warning!')}
                </code>
 
                <figcaption>Figure 1. JavaScript alert code example</figcaption>


            </figure>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="html5-example__steps" class="showcode__steps"></div>
                                        <div id="html5-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html5-example"
                        data-showcode-props="html5-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="html5-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
            {
                "label": "Add figure and figcapture tags",
                "highlight": "%OPENCLOSETAG%figure ||| %OPENCLOSECONTENTTAG%figcaption",
                "notes": ""
            }
        ]}
        </script>


        <h2>ARIA Example</h2>
        <div id="aria-example" class="enable-example">
            <div role="figure" aria-labelledby="aria-caption">
                <code>
                    function warning()
                    {alert('Warning!')}
                </code>
                <span id="aria-caption">Figure 1. JavaScript alert code example</span>
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
                <form class="showcode__ui">                                        <div id="aria-example__steps" class="showcode__steps"></div>
                                        <div id="aria-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-example"
                        data-showcode-props="aria-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="aria-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
            {
                "label": "Add figure role to whole component",
                "highlight": "role=\"figure\"",
                "notes": "This is the ARIA equivalent of the <code>figure</code> tag"
            },
            {
                "label": "Add the caption",
                "highlight": "aria-labelledby",
                "notes": "Just like other grouped elements, it's given an accessible name via <code>aria-describedby"
            }
        ]}
        </script>
    </main>
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
    <script src="js/hamburger.js"></script> 
</body>

</html>