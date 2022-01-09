
    

        <!-- <aside class="notes">
            <h2>Notes:</h2>

            <p>All screenreaders seem to read both HTML and ARIA version the same way.</p>
        </aside> -->

        

        <p>This page shows different ways a checkbox can be marked up to see how screen readers will describe them to
            users.</p>

        <h2>A real HTML checkbox</h2>

        <p>The following is an
            <code>&lt;input&gt;</code> tag with a
            <code>&lt;label&gt;</code> tag describing what it is for.
        </p>

        <div id="example1" class="enable-example">
            <div class="checkbox-container">
                <label for="html-checkbox">I agree to sell my soul to Zoltan:</label>
                <input id="html-checkbox" type="checkbox" >
            </div>
        </div>
        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                "label": "Use label tags to label form element",
                "highlight": "for",
                "notes": "This is just like any other form element"
            }]
        }
        </script>

        <h2>A real styled HTML5 checkbox</h2>

        <div id="example2" class="enable-example">
            <div class="enable-checkbox">
                <label for="checkbox_1">I agree to sell my soul to Zoltan:</label>
                <input type="checkbox" id="checkbox_1">
                <label for="checkbox_1"></label>
            </div>
        </div>

        <?php includeShowcode("example2")?>

        <script type="application/json" id="example2-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Use label tags to label form element",
                    "highlight": "for",
                    "notes": "Like any other form element, it needs a label. However, since we want to add custom styles, we need an additional empty label to apply the custom style \"façade\" to, since we cannot apply them directly to the checkbox itself."
                },
                {
                    "label": "Add custom styles",
                    "highlight": "%CSS%checkbox-css~ .enable-checkbox"
                }
            ]
        }
        </script>


        <h2>A DIV with a role of checkbox</h2>
        <p>This is a
            <code>&lt;div&gt;</code> tag that has its role attribute set to
            <code>checkbox</code>.
        </p>

        <div id="example-role-checkbox" class="enable-example">
            <div class="checkbox-container">
                <label id="div-checkbox-label">I agree to sell my soul to Zoltan:</label>
                <div aria-labelledby="div-checkbox-label" role="checkbox" tabindex="0" aria-checked="true">
                </div>
            </div>
        </div>

        <?php includeShowcode("example-role-checkbox")?>

        <script type="application/json" id="example-role-checkbox-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Use label tags with id",
                    "highlight": "id",
                    "notes": "Like a real form element, it needs a label. Unlike a real form element, it doesn't use for to connect with the faux checkbox.  We'll cover what it does need in the next step."
                },
                {
                    "label": "Create faux checkbox connect to label with aria-labelledby",
                    "highlight": "aria-labelledby",
                    "notes": "This is how the faux checkbox gets its label."
                },
                {
                    "label": "Add custom styles",
                    "highlight": "%CSS%checkbox-css~ [role=\"checkbox\"] ; [role=\"checkbox\"][aria-checked=\"true\"]::after",
                    "notes": "Note that the checked state is styled with the <code>::after</code> pseudo-element."
                },
                {
                    "label": "Add JavaScript to make the checkbox functional",
                    "highlight": "%FILE% js/modules/radio-and-checkbox-roles.js"
                }
            ]
        }
        </script>


       

        <h2>HTML checkbox group</h2>

        <div id="html5-example" class="enable-example">
            <div role="group" aria-labelledby="html-checkbox-multi-label">
                <p id="html-checkbox-multi-label">
                    The following people will have my soul when I die:
                </p>


                <div id="html-checkbox__error" class="error">You must choose at least one of the following.</div>

                <div class="checkbox-container">
                    <label for="html-checkbox-multi1">Zoltan:</label>
                    <input id="html-checkbox-multi1" type="checkbox" aria-invalid="true"
                        aria-describedby="html-checkbox__error" >
                </div>
                <div class="checkbox-container">
                    <label for="html-checkbox-multi2">Noel:</label>
                    <input id="html-checkbox-multi2" type="checkbox" aria-invalid="true"
                        aria-describedby="html-checkbox__error" >
                </div>
                <div class="checkbox-container">
                    <label for="html-checkbox-multi3">Alison:</label>
                    <input id="html-checkbox-multi3" type="checkbox" aria-invalid="true"
                        aria-describedby="html-checkbox__error" >
                </div>
                <div class="checkbox-container">
                    <label for="html-checkbox-multi4">That guy who smokes in the alleyway at work:</label>
                    <input id="html-checkbox-multi4" type="checkbox" aria-invalid="true"
                        aria-describedby="html-checkbox__error" >
                </div>

            </div>
        </div>
        <?php includeShowcode("html5-example")?>

        <script type="application/json" id="html5-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
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


    