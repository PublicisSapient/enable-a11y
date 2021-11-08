<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Heading Role Examples</title>
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



    <link href="https://fonts.googleapis.com/css?family=Ultra%7COrienta" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/heading.css" />

</head>

<body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>Heading levels have nothing to do with their physical size
                    (i.e. an H1 doesn't have to be larger than an H2)
                </li>
                <li>
                    Headings are used by screen-reader users as a table of contents.
                </li>
                <li>The following are HTML headings. The styling was originally derived from
                    <a href="https://tympanus.net/codrops/2012/11/02/heading-set-styling-with-css/">Heading Set Styling
                        with CSS </a>
                    by
                    <a href="https://hugogiraudel.com/">Hugo Giraudel</a>
                </li>
            </ul>
        </aside>

        <h1>
            HTML5 and ARIA Headings
        </h1>


        <h2>HTML5 Headings</h2>

        <p>HTML supports heading levels 1-6</p>


        <div id="html-example" class="enable-example">
            <h1>This is a heading level 1</h1>
            <h2>This is an h2</h2>
            <h3>This is an h3</h3>
            <h4>This is an h4</h4>
            <h5>This is an h5</h5>
            <h6>This is an h6</h6>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="html-example__steps" class="showcode__steps"></div>
                                        <div id="html-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html-example"
                        data-showcode-props="html-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="html-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
            {
                "label": "Add heading HTML tags",
                "highlight": "%OPENCLOSETAG%h1 ||| %OPENCLOSETAG% h2 ||| %OPENCLOSETAG% h3 ||| %OPENCLOSETAG% h4 ||| %OPENCLOSETAG% h5 ||| %OPENCLOSETAG% h6",
                "notes": ""
            }
        ]}
        </script>

        <h2>ARIA Headings</h2>

        <p>The following are ARIA headings. Note that ARIA supports
            heading levels 1-10.
        </p>

        <div id="aria-example" class="enable-example">
            <div role="heading" aria-level="1">This in an ARIA heading level 1</div>
            <div role="heading" aria-level="2">This in an ARIA heading level 2</div>
            <div role="heading" aria-level="3">This in an ARIA heading level 3</div>
            <div role="heading" aria-level="4">This in an ARIA heading level 4</div>
            <div role="heading" aria-level="5">This in an ARIA heading level 5</div>
            <div role="heading" aria-level="6">This in an ARIA heading level 6</div>
            <div role="heading" aria-level="7">This in an ARIA heading level 7 (there is no HTML5 equivalent)</div>
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
                "label": "Add heading roles",
                "highlight": "role",
                "notes": ""
            },
            {
                "label": "Add aria-level",
                "highlight": "aria-level",
                "notes": "Note with aria-level, you can have heading levels greater than 6."
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
    <script src="js/hamburger.js"></script></body>

</html>