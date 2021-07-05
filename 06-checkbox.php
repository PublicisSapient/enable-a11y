<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    
    <title>Checkbox demo</title>
	<?php include("includes/common-head-tags.php"); ?>

    <link rel="stylesheet" type="text/css" href="css/shared/visibleIf.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <link rel="stylesheet" type="text/css" href="css/checkbox.css" />
</head>

<body>
    <?php include("includes/example-header.php"); ?>

    <main>

        <aside class="notes">
            <h2>Notes:</h2>

            <p>All screenreaders seem to read both HTML and ARIA version the same way.</p>
        </aside>

        <h1>Accessible Checkbox Demo</h1>

        <p>This page shows different ways a checkbox can be marked up to see how screen readers will describe them to users.</p>

        <h2>A real HTML checkbox</h2>

        <p>The following is an
            <code>&lt;input&gt;</code> tag with a
            <code>&lt;label&gt;</code> tag describing what it is for.</p>
        <div class="checkbox-container">
            <label for="html-checkbox">I agree to sell my soul to Zoltan:</label>
            <input id="html-checkbox" type="checkbox" />
        </div>

        <h2>A real styled HTML5 checkbox</h2>
        <div class="enable-checkbox">
            <label for="checkbox_1">I agree to sell my soul to Zoltan:</label>
            <input type="checkbox" id="checkbox_1">
            <label for="checkbox_1"></label>
        </div>


        <h2>A DIV with a role of checkbox</h2>
        <p>This is a
            <code>&lt;div&gt;</code> tag that has its role attribute set to
            <code>checkbox</code>.</p>

        <div class="checkbox-container">
            <label id="div-checkbox-label">I agree to sell my soul to Zoltan:</label>
            <div aria-labelledby="div-checkbox-label" role="checkbox" tabindex="0" aria-checked="true">
            </div>
        </div>

        <h2>A Checkbox with content that only appears when it is checked.</h2>

        <p>
            If the checkbox below is checked, content appears.
        </p>
            <div class="checkbox-container">
                <form>
                    <label for="html-checkbox-with-visibleif">I want to subscribe to the Zoltanic Foundation's newsletter 
                        <span class="sr-only visibleIf" data-visibleif-rule="iAgree != 'yes'">
                            (checking this will add mailing information fields below)
                        </span>
                        <span class="sr-only visibleIf" data-visibleif-rule="iAgree == 'yes'">
                            (unchecking this will remove the mailing information fields below)
                            </span>
                        :
                    </label>
                    <input id="html-checkbox-with-visibleif" name="iAgree" type="checkbox" value="yes" />

                    <div class="visibleIf" data-visibleif-rule="iAgree == 'yes'">
                            <div>
                            <label for="name">Your name:</label>
                            <input type="text" name="name" id="name" />
                            </div>

                            <div>
                            <label for="address">Your address:</label>
                            <input type="text" name="address" id="address" />
                            </div>

                            <div>
                            <label for="emailaddress">Your email address:</label>
                            <input type="text" name="emailaddress" id="emailaddress" />
                            </div>
                    </div>
                </form>
            </div>
        </p>

        <h2>HTML checkbox group</h2>

        <div id="html5-example">
            <div role="group" aria-labelledby="html-checkbox-multi-label">
                <p id="html-checkbox-multi-label">
                    The following people will have my soul when I die:
                </p>


                <div id="html-checkbox__error" class="error">You must choose at least one of the following.</div>
                
                <div class="checkbox-container">
                    <label for="html-checkbox-multi1">Zoltan:</label>
                    <input id="html-checkbox-multi1" type="checkbox" aria-invalid="true" aria-describedby="html-checkbox__error" />
                </div>
                <div class="checkbox-container">
                    <label for="html-checkbox-multi2">Noel:</label>
                    <input id="html-checkbox-multi2" type="checkbox" aria-invalid="true" aria-describedby="html-checkbox__error" />
                </div>
                <div class="checkbox-container">
                    <label for="html-checkbox-multi3">Alison:</label>
                    <input id="html-checkbox-multi3" type="checkbox" aria-invalid="true" aria-describedby="html-checkbox__error" />
                </div>
                <div class="checkbox-container">
                    <label for="html-checkbox-multi4">That guy who smokes in the alleyway at work:</label>
                    <input id="html-checkbox-multi4" type="checkbox" aria-invalid="true" aria-describedby="html-checkbox__error" />
                </div>

            </div>
        </div>
        <?php includeShowcode("html5-example")?>

        <script type="application/json" id="html5-example-props">
        {
            "replaceHTMLRules": {},
            "steps": [
                {
                    "label": "Use label tags to label form element",
                    "highlight": "for",
                    "notes": "This is just like any other form element"
                },
                {
                    "label": "Surround the whole checkbox group, with instructions, in a div with group role assigned",
                    "highlight": "role=\"group\"",
                    "notes": "This will let the browser know these checkboxes are related."
                },
                {
                    "label": "Ensure the whole group is labelled correctly",
                    "highlight": "aria-labelledby",
                    "notes": "Setting the aria-labelledby on the group will tell screen readers to announce the instructions for the whole group when users tab into the first checkbox in the group (sometimes all).  If there is an error that pertains to the whole group, it can be encapsulated in this label."
                },
                {
                    "label": "Errors must be marked up with aria-describedby",
                    "highlight": "aria-describedby",
                    "notes": "You must always ensure what the aria-describedby is pointing to exists in the DOM."
                },
                {
                    "label": "Make sure you have aria-invalid set on the checkboxes if necessary",
                    "highlight": "aria-invalid",
                    "notes": "Just like any other form, aria-invalid must be set on the form elements that are invalid."
                }
            ]
        }
        </script>


        <script src="js/shared/radio-and-checkbox-roles.js"></script>
        <script src="js/shared/visibleIf.js"></script>

        <?php include "includes/example-footer.php"?>

    </main>
</body>

</html>