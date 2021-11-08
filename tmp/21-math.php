<!DOCTYPE html>
<html lang="en">

<head>
    <title>Math Aria Role Examples</title>
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



    <link rel="stylesheet" type="text/css" href="css/math.css" />

</head>

<body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>



        <h1>Math Aria Role Examples</h1>
        <aside class="notes">
            <h2>Notes</h2>
            <ul>
                <li>This page uses MathJax to implement
                    <a href="https://www.mathjax.org/">MathML</a> in browsers that don't support it.</li>
                <li>There are browser compatibility issues:
                    <ul>
                        <li>Safari with Voiceover:
                            <ul>
                                <li>reads this (but apparently there are some bugs)</li>
                                <li>allows the user to interact with the equation.</li>
                            </ul>
                        </li>
                        <li>NVDA with Firefox ignores the equation.</li>
                    </ul>
                </li>
            </ul>
        </aside>

        <h2>Polynomial (MathML)</h2>
        <div id="equation" class="enable-example">
            <math display="block" xmlns="http://www.w3.org/1998/Math/MathML">
                <mrow>
                    <mi>E</mi>
                    <mo>=</mo>
                    <mfrac>
                        <mrow>
                            <mn>2</mn>
                            <mi>π</mi>
                            <mi>h</mi>
                            <msup>
                                <mi>c</mi>
                                <mn>2</mn>
                            </msup>
                        </mrow>
                        <mrow>
                            <msup>
                                <mi>λ</mi>
                                <mn>5</mn>
                            </msup>
                            <mrow>
                                <mo>(</mo>
                                <mrow>
                                    <msup>
                                        <mi>e</mi>
                                        <mrow>
                                            <mi>h</mi>
                                            <mi>c</mi>
                                            <mo>−</mo>
                                            <mi>λ</mi>
                                            <msub>
                                                <mi>k</mi>
                                                <mi>b</mi>
                                            </msub>
                                            <mi>T</mi>
                                        </mrow>
                                    </msup>
                                    <mo>−</mo>
                                    <mn>1</mn>
                                </mrow>
                                <mo>)</mo>
                            </mrow>
                        </mrow>
                    </mfrac>
                </mrow>
            </math>


        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="equation__steps" class="showcode__steps"></div>
                                        <div id="equation__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="equation"
                        data-showcode-props="equation-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="equation-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
            {
                "label": "",
                "highlight": "",
                "notes": ""
            }
        ]}
        </script>
    </main>
    <script>
        MathJax = {
            options: {
                menuOptions: {
                settings: {
                    assistiveMml: true;   // true to enable assitive MathML
                    collapsible: true;   // true to enable collapsible math
                    explorer: true;      // true to enable the expression explorer
                }
                }
            }
        };
    </script>
    <script src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
    <script>
        document.getElementById('MathJax_Message').setAttribute('role', 'complementary');
    </script>
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