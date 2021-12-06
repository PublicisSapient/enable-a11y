<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Textbox Role Example</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/group.css" />
    <link rel="stylesheet" type="text/css" href="css/form-error.css" />
    <link id="textbox-css" rel="stylesheet" type="text/css" href="css/textbox.css" />
    
</head>

<body>

    <?php include("includes/documentation-header.php"); ?>



    <main>
        <h1>ARIA Textbox Role Example</h1>
        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The first example is simply a
                    <code>div</code> with its
                    <code>contenteditable</code> attribute set to
                    <code>"true"</code>.
                    Textareas can be simulated using <code>aria-multiline="true"</code> and using CSS
                    <code>resize: both</code> to make them resizable.
                </li>
                <li>No JavaScript was involved in making these.</li>
                <li>The first example shows up as a form field in Voiceover's rotor and NVDA's Element Dialogue.</li>
                <li>The element will not submit its data to the server like a real form field.</li>
                <li>Coding
                    <code>&lt;input type="number" role="textbox" /></code> doesn't do anything useful in any
                    screenreader.
                </li>
            </ul>

        </aside>



        <h2>HTML example</h2>

        <div id="html-example" class="enable-example">
            <form>
                <fieldset>
                    <legend>Payment information</legend>
                    <div>
                        <label for="ccinfo">Billing Address:</label>
                        <input type="text" name="ccinfo" id="ccinfo" />
                    </div>

                    <div>
                        <label for="notes" class="textarea-label">Notes:</label>
                        <textarea id="notes" name="notes"></textarea>
                    </div>
                </fieldset>

            </form>
        </div>

        <?php includeShowcode("html-example")?>

        <script type="application/json" id="html-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [

                {
                    "label": "All form fields need labels",
                    "highlight": "for",
                    "notes": "Each form field have a <strong>label</strong> tag whose <strong>for</strong> element connects it to the form field via the form field's <strong>id</strong>."
                },
                {
                    "label": "Use <code>&lt;input type=\"text\"&gt;</code> for single line text inputs.",
                    "highlight": "%OPENTAG%input"
                },
                {
                    "label": "USe <code>&lt;textarea&gt;</code> for multiline text inputs",
                    "highlight": "%OPENCLOSETAG%textarea"
                }
            ]
        }
        </script>




        <h2>ARIA example</h2>

        <div id="aria-example" class="enable-example">
            <div role="group" aria-labelledby="aria-payment-info-label" class="fieldset">
                <div id="aria-payment-info-label" class="legend">Payment Information</div>

                <div>
                    <label id="address-label"  class="textarea-label">Address to deliver to:</label>
                    <div aria-labelledby="address-label" role="textbox" contenteditable="true"></div>
                </div>

                <div>
                    <label id="notes-label"  class="textarea-label">Delivery Notes:</label>
                    <div aria-labelledby="notes-label" role="textbox" contenteditable="true" aria-multiline="true">
                    </div>
                </div>
            </div>
        </div>


        

        <?php includeShowcode("aria-example")?>

        <script type="application/json" id="aria-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Insert roles to ensure they are reported correctly by screen readers",
                    "highlight": "role",
                    "notes": ""
                },
                {
                    "label": "Make the content of the ARIA textbox editable using contenteditable attribute.",
                    "highlight": "contenteditable",
                    "notes": "If you do this, you don't need to set <strong>tabindex=\"0\"</strong>, since content editable elements get keyboard focus by default"
                },
                {
                    "label": "All ARIA textboxes need labels using aria-labelledby",
                    "highlight": "aria-labelledby",
                    "notes": "Each form field have a label."
                },
                {
                    "label": "Use aria-multiline if you are simulating a textarea element.",
                    "highlight": "aria-multiline",
                    "notes": ""
                },
                {
                    "label": "Use CSS to style multiline textboxes differently",
                    "highlight": "%CSS%textbox-css~ [role=\"textbox\"]; [role=\"textbox\"][aria-multiline=\"true\"]",
                    "notes": "Note the <code>resize: both</code> CSS on the multiline textbox.  This allows the browser to all the user to resize the textbox with a mouse (but not with a keyboard, as far as I'm aware).  <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/resize\">More information about this CSS property</a>."
                }
            ]
        }
        </script>


    </main>
    <?php include "includes/example-footer.php" ?>


    <!-- <script src="js/#STUB#.js"></script> -->
</body>

</html>