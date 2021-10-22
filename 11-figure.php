<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aria Figure/Figcaption role examples</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/figure.css" />

</head>

<body>

    <?php include("includes/example-header.php"); ?>

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

        <?php includeShowcode("html5-example")?>
        <script type="application/json" id="html5-example-props">
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

        <?php includeShowcode("aria-example")?>
        <script type="application/json" id="aria-example-props">
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
    <?php include "includes/example-footer.php"?> 
</body>

</html>