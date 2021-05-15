<!DOCTYPE html>
<html lang="en">

<head>
    <title>HTML5 and ARIA Accessible Drawer Examples</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/dropdown.css" />
    <meta charset="utf-8" />
</head>

<body>
    <?php include("includes/example-header.php"); ?>

    <main>
        <h1>Accessible Drawer/Expando</h1>

        <aside class="notes">
            <h2>Notes:</h2>

            <p>The HTML5 version does not update its state on all browser/screen-reader combinations
                reliably. For example:</p>
            <ul>
                <li>
                    Safari with Voiceover doesn't update the state when the
                    drawer is opened.
                </li>
                <li>
                    Chromevox doesn't indicate that the <code>summary</code> is
                    expandable when it gains keyboard focus
                </li>
            </ul>

            <p>For now, it is advisable to use the ARIA version.</p>
        </aside>

        <h2>HTML5 version using details and summary tags</h2>

        <div id="example1">
            <details class="enable-drawer">
                <summary class="enable-drawer__button">
                    Information on the HTML5 <code>details</code> tag.
                </summary>
                <div class="content">
                    <p>
                        This is the contents of the dropdown. For more information about
                        the HTML5 details and summary tags, read the following documents:</p>

                    <ul>
                        <li><a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details">
                                MDM documentation</li>
                        <li><a
                                href="https://css-tricks.com/quick-reminder-that-details-summary-is-the-easiest-way-ever-to-make-an-accordion/">
                                Quick Reminder that Details/Summary is the Easiest Way Ever to Make an Accordion
                            </a></li>
                        <li>
                            <a href="https://freefrontend.com/html-details-summary-css/">
                                30 HTML details & summary with CSS</a>
                        </li>
                    </ul>
                </div>

            </details>
        </div>

        <h3 class="showcode__heading">Example code explanation</h3>

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {
                "summary": "<!-- Insert dropdown button label here -->",
                ".content": "<!-- Insert dropdown content here. Doesn't have to wrapped in a div  -->"
            },
            "steps": [{
                "label": "Set up the details and summary tags",
                "highlight": "\\s*&lt;summary[^;]*&gt;[\\s\\S]*&lt;/summary&gt; ||| &lt;details[^;]*&gt; ||| &lt;\/details&gt;",
                "notes": "It's really this easy.  Everything else is done for you."
            }]
        }
        </script>


        <div id="example1a" >
            <form>
                <details class="enable-multiselect">
                    <summary class="enable-multiselect__button">
                        Products
                    </summary>
                    <div class="enable-multiselect__contents">
                        <fieldset>
                            <legend class="sr-only">
                                Products
                            </legend>
                                <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="product1">
                                <label class="enable-multiselect__label" for="product1">Cars</label>
                                <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="product2">
                                <label class="enable-multiselect__label" for="product2">Trucks</label>
                                <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="product3">
                                <label class="enable-multiselect__label" for="product3">SUVs</label>
                                <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="product4">
                                <label class="enable-multiselect__label" for="product4">Motorcycles</label>
                                
                        </fieldset>
                    </div>

                </details>
            </form>

            <h2>ARIA version</h2>

            <div id="example2">
                <div class="enable-drawer">
                    <button id="enable-drawer1" class="enable-drawer__button" aria-controls="enable-drawer1__content"
                        aria-expanded="false">
                        Information on the aria-expanded version.
                    </button>
                    <div id="enable-drawer1__content" class="enable-drawer__content" role="region">

                        <p>
                            This is the contents of the dropdown. For more information about
                            the aria-expanded, read the following documents:</p>

                        <ul>
                            <li>
                                <a
                                    href="https://www.w3.org/WAI/GL/wiki/Using_aria-expanded_to_indicate_the_state_of_a_collapsible_element">
                                    Using aria-expanded to indicate the state of a collapsible element
                                </a>
                            </li>
                            <li>
                                <a
                                    href="https://www.accessibility-developer-guide.com/examples/sensible-aria-usage/expanded/">
                                    Marking elements expandable using aria-expanded</a>
                            </li>
                            <li>
                                <a href="https://www.marcozehe.de/easy-aria-tip-5-aria-expanded-and-aria-controls/">
                                    Easy ARIA Tip #5: aria-expanded and aria-controls
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php includeShowcode("example2")?>

            <script type="application/json" id="example2-props">
            {
                "replaceHTMLRules": {
                    "[aria-expanded]": "<!-- Insert dropdown button label here -->",
                    "[role=\"region\"]": "<!-- Insert dropdown content here -->"
                },
                "steps": [{
                        "label": "Set up the dropdown state on button with aria-expanded",
                        "highlight": [
                            "aria-expanded"
                        ],
                        "notes": "It should be set to false if the drawer is closed, true if open."
                    },
                    {
                        "label": "Link up the button to the expanded content using aria-controls",
                        "highlight": [
                            "aria-controls"
                        ],
                        "notes": ""
                    },
                    {
                        "label": "Set the aria roles",
                        "highlight": "role=\"region\""
                    }
                ]
            }
            </script>


            <?php include "includes/example-footer.php" ?>
    </main>

    <script>
    document.body.addEventListener("click", function(e) {
        var target = e.target;

        if (target.classList.contains('enable-drawer__button')) {
            const contentEl = document.getElementById(target.getAttribute('aria-controls'));
            if (target.getAttribute('aria-expanded') !== 'true') {
                target.setAttribute('aria-expanded', 'true');
            } else {
                target.setAttribute('aria-expanded', 'false');
            }
        }
    });
    </script>
</body>

</html>