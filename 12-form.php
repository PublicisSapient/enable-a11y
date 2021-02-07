<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ARIA form role examples</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/group.css" />

</head>

<body>

    <?php include("includes/example-header.php"); ?>

    <main>

        <aside class="notes">
            <h2>Notes</h2>
            <ul>

                <li>These examples are from
                    <a href="https://www.w3.org/TR/2017/NOTE-wai-aria-practices-1.1-20171214/examples/landmarks/form.html">the W3C's ARIA Form Landmarks Example</a>.</li>

               <!-- <li>NVDA doesn't recognize a
                    <code>form</code> element by itself as a landmark. In order to do this, we must add the ARIA form role.</li> -->
                <li>Use the HTML5 form tag whenever you can. You will make your application
                    a lot more usable for things beyond accessibility:
                    <ol>
                        <li>JavaScript
                            <code>document.forms</code> support.</li>
                        <li>Progressive enhancement.</li>
                        <li>Built in HTML5 validation and pattern checking.</li>
                        <li>
                            <a href="https://en.wikipedia.org/wiki/Tim_Berners-Lee">The God of the Web</a> built it the right way the first time.</li>
                    </ol>
                </li>
            </ul>
        </aside>


        <h1>ARIA form role examples</h1>



        <h2>HTML5 example</h2>

        <div id="example1">
            <form>
                <fieldset>
                    <legend id="contact_html5">Contact Information</legend>

                    <label for="name_html5">Name</label>
                    <input id="name_html5" size="25" type="text">

                    <label for="email_html5">E-mail</label>
                    <input id="email_html5" size="25" type="text">

                    <label for="phone_html5">Phone</label>
                    <input id="phone_html5" size="25" type="text">

                    <input value="Add Contact" type="submit">

                </fieldset>
            </form>
        </div>

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {},
            "steps": [
                {
                    "label": "Insert form tag",
                    "hilite": "\\s*&lt;[\/]?form&gt;",
                    "notes": "Whenever you have form elements, include this tag.  It does a lot of things for you that you may not even be aware of."
                },
                {
                    "label": "Insert fieldset and legend",
                    "hilite": "\\s*&lt;[\/]?fieldset&gt;,\\s*&lt;legend[\\s\\S]*&gt;[\\s\\S]*&lt;/legend&gt;",
                    "notes": "The <strong>legend</strong> tag must be a direct child of the <strong>fieldset</strong> tag in order for it to work across screen readers."
                }
            ]
        }
        </script>

        <h2>ARIA form role example (with ARIA used to replace fieldset and legend as well)</h2>

        <div id="example2">
            <div role="form">
                <div role="group" aria-labelledby="contact-aria" class="fieldset">
                    <div id="contact-aria" class="legend">Contact Information</div>

                    <label for="name">Name</label>
                    <input id="name" size="25" type="text">

                    <label for="email">E-mail</label>
                    <input id="email" size="25" type="text">

                    <label for="phone">Phone</label>
                    <input id="phone" size="25" type="text">

                    <input value="Add Contact" type="submit">

                        </div>
            </div>
        </div>

        <?php includeShowcode("example2")?>

        <script type="application/json" id="example2-props">
        {
            "replaceHTMLRules": {},
            "steps": [
                {
                    "label": "Insert form tag",
                    "hilite": "\\s*&lt;[\/]?div role=\"form\"&gt;",
                    "notes": "Whenever you have form elements, include this tag.  It does a lot of things for you that you may not even be aware of."
                },
                {
                    "label": "Insert group role to minic native HTML fieldset",
                    "hilite": "role=\"group\"",
                    "notes": ""
                },
                {
                    "label": "Add aria-labelledby to element with group role",
                    "hilite": "aria-labelledby",
                    "notes": [
                        "This ensures that what the aria-labelledby attribute points to acts as a legend for the fieldset.",
                        "Unlike a HTML example, the label does not have to be a direct child to the group element (which acts as a fieldset)."
                    ]
                }
            ]
        }
        </script>

        <h2>Search Test</h2>

        <form>
            <fieldset>
                    <legend id="contact">Search</legend>
                    <label for="search">Search this awesome site:</label><input role="search" id="search" type="text" />
            </fieldset>
        </form>

        <?php include "includes/example-footer.php" ?>


    </main>
</body>

</html>