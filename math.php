<!DOCTYPE html>
<html lang="en">

<head>
    <title>Math Aria Role Examples</title>
		<?php include "includes/common-head-tags.php";?>
    <link rel="stylesheet" type="text/css" href="css/math.css" />

</head>

<body>
    <?php include "includes/documentation-header.php";?>

    <main>
    <?php include "includes/pause-anim-control.php" ?>



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

        <?php includeShowcode("equation")?>
        <script type="application/json" id="equation-props">
        {
            "replaceHtmlRules": {
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
    <?php include "includes/example-footer.php"?>
</body>

</html>