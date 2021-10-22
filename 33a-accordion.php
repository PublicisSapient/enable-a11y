<!DOCTYPE html>
<html lang="en">

<head>
    <title>HTML5 and ARIA Accessible Accordion Examples</title>
    <?php include "includes/common-head-tags.php";?>
    <link rel="stylesheet" type="text/css" href="css/details-accordion.css" />

</head>

<body>
    <?php include "includes/example-header.php";?>

    <main>
        <h1>Accessible Accordion</h1>

        <aside class="notes">
            <h2>Notes:</h2>

            <p>This component is related to <a href="33-dropdown.php">Dropdowns/Drawers</a>.  </p>
        </aside>

        <h2>HTML5 version using details and summary tags</h2>

        <div id="example1">

            <div role="group" class="details-accordion">
                <details class="details-accordion__drawer">
                    <summary class="details-accordion__button">
                        Personal Information
                    </summary>
                    <div class="content">
                        <p>
                            This is the contents of the dropdown. For more information about
                            the HTML5 details and summary tags, read the following documents:</p>

                        <ul>
                            <li><a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details">
                                    MDM documentation</a></li>
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
                <details class="details-accordion__drawer">
                    <summary class="details-accordion__button">
                        Billing Address
                    </summary>
                    <div class="content">
                        <p>
                            This is the contents of the dropdown. For more information about
                            the HTML5 details and summary tags, read the following documents:</p>

                        <ul>
                            <li><a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details">
                                    MDM documentation</a></li>
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
                <details class="details-accordion__drawer">
                    <summary class="details-accordion__button">
                        Shipping Address
                    </summary>
                    <div class="content">
                        <p>
                            This is the contents of the dropdown. For more information about
                            the HTML5 details and summary tags, read the following documents:</p>

                        <ul>
                            <li><a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details">
                                    MDM documentation</a></li>
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
        </div>

        

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {
                "summary": "<!-- Insert dropdown button label here -->",
                ".content": "<!-- Insert dropdown content here. Doesn't have to wrapped in a div  -->"
            },
            "steps": [
                {
                    "label": "Set up the details and summary tags",
                    "highlight": "\\s*&lt;summary[^;]*&gt;[\\s\\S]*&lt;/summary&gt; ||| \\s*&lt;details[^;]*&gt; ||| \\s*&lt;\/details&gt;",
                    "notes": "It's really, just the previous example"
                }
            ]
        }
        </script>


        <h2>ARIA version</h2>

        <div id="example2">
            <div class="details-accordion__drawer">
                <button id="details-accordion__drawer1" class="details-accordion__drawer__button" aria-controls="details-accordion__drawer1__content"
                    aria-expanded="false">
                    Information on the aria-expanded version.
                </button>
                <div id="details-accordion__drawer1__content" class="details-accordion__drawer__content" role="region">

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


    </main>
    <?php include "includes/example-footer.php"?>

    <script src="js/details-accordion.js"></script>
    
</body>

</html>