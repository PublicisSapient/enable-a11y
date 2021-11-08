<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    <title>Description Lists</title>
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



    <link rel="stylesheet" type="text/css" href="css/definition-term.css" />
</head>

<body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>
        <h1>Accessible Definition Lists</h1>

        <aside class="notes">

            <h2>Notes:</h2>
            <ul>
                <li>that the roles of
                    <code>definition</code> and
                    <code>term</code> and their relationship to the HTML
                    <code>dt</code>,
                    <code>dd</code>,
                    <code>dl</code> and
                    <code>dfn</code> tags
                    <a href="https://github.com/w3c/aria/issues/504">are being questioned</a>
                </li>
                <li>The screen reader user experience is better if you surround your <code>dt</code>/<code>dd</code> pairs with a <code>div</code>.</li>
            </ul>
        </aside>

        <h2>A HTML example</h2>

        
        <div id="html5-def-list-example" class="enable-example">
            <dl>
                <dt>Gojira:</dt>
                <dd>A japanese kaiju monster created in the 1960s.</dd>

                <dt>Frankenstein:</dt>
                <dd>A fictional doctor that created a fictional being out of the spare parts of dead people.</dd>

                <dt>8-man:</dt>
                <dd>A manga featuring a robot whose brain is filled of the memories of a cop gunned down in action. Predates Robocop
                    by at least 20 years.</dd>
            </dl>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="html5-def-list-example__steps" class="showcode__steps"></div>
                                        <div id="html5-def-list-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html5-def-list-example"
                        data-showcode-props="html5-def-list-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="html5-def-list-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [{
                "label": "Use <code>dl</code> tag to encapsulate the whole list",
                "highlight": "%OPENCLOSETAG%dl",
                "notes": "The <code>dl</code> stands for <strong>description list</strong>.  It was changed from <a href=\"http://html5doctor.com/the-dl-element/\">its previous name of definiton list in HTML4</a>"
            },
            {
                "label": "Each description term is encapsulated in a <code>dt</code> ",
                "highlight": "%OPENCLOSECONTENTTAG%dt",
                "notes": ""
            },
            {
                "label": "All of a description term's detail is encapsulated in the <code>dd</code> tag.",
                "highlight": "%OPENCLOSECONTENTTAG%dd",
                "notes": ""                
            }]
        }
        </script>

        <h2>Aria Roles example</h2>

        <div id="aria-def-list-example" class="enable-example">
            <div class="dl" role="list">
                <div role="listitem">
                    <div role="term">Gojira:</div>
                    <div role="definition">A japanese kaiju monster created in the 1960s.</div>
                </div>

                <div role="listitem">
                    <div role="term">Frankenstein:</div>
                    <div role="definition">A fictional doctor that created a fictional being out of the spare parts of dead people.</div>
                </div>

                <div role="listitem">
                    <div role="term">8-man:</div>
                    <div role="definition">A manga featuring a robot whose brain is filled of the memories of a cop gunned down in action. Predates
                        Robocop by at least 20 years.</div>
                </div>
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
                <form class="showcode__ui">                                        <div id="aria-def-list-example__steps" class="showcode__steps"></div>
                                        <div id="aria-def-list-example__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-def-list-example"
                        data-showcode-props="aria-def-list-example-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="aria-def-list-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [{
                "label": "Use <code>list</code> role to encapsulate the whole list",
                "highlight": "role=\"list\"",
                "notes": ""
            },
            {
                "label": "Each description term is encapsulated in a tag with the <code>term</code> role",
                "highlight": "role=\"term\"",
                "notes": ""
            },
            {
                "label": "All of a description term's detail is encapsulated in a tag with the role of <code>definition</code>.",
                "highlight": "role=\"definition\"",
                "notes": ""                
            }]
        }
        </script>
    </main>

    <script src="js/role-checkbox.js"></script>
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