<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    <title>Description Lists</title>
		<?php include "includes/common-head-tags.php";?>
    <link rel="stylesheet" type="text/css" href="css/definition-term.css" />
</head>

<body>
    <?php include "includes/documentation-header.php";?>

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

        <?php includeShowcode("html5-def-list-example")?>

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

        <?php includeShowcode("aria-def-list-example")?>

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
    <?php include "includes/example-footer.php"?>
</body>

</html>