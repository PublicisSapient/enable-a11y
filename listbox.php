<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA listbox role example</title>
    <?php include "includes/common-head-tags.php";?>
    <link rel="stylesheet" type="text/css" href="css/enable-listbox.css" />

    <link rel="stylesheet" type="text/css" href="css/select-css.css" />

</head>

<body>

    <?php include "includes/documentation-header.php";?>

    <main>

        <aside class="notes">
            <h2>Notes</h2>
            <ul>
                <li>tl;dr: Both versions are accessible, with slight differences in how they are reported to users.</li>

                <li>Screen reader interactions are as follows:

                    <ol>
                        <li>Tabbing into the widget:
                            <ul>
                                <li>
                                    <strong>Voiceover:</strong> The ARIA and native HTML versions state that they are
                                    "popup buttons"
                                    as well as the selected value.
                                </li>
                                <li>
                                    <strong>NVDA:</strong> The ARIA version is a "button" with "submenu", while the HTML
                                    version
                                    is a "combo box, collapsed"
                                </li>
                            </ul>
                        </li>
                    </ol>
                </li>
                <li>
                    Opening the widget:
                    <ul>
                        <li>
                            <strong>Voiceover:</strong> Reads out the selected value. The HTML version also reads how many
                            other
                            options there are (e.g. menu 26 items)
                        </li>
                        <li>
                            <strong>NVDA:</strong> Both versions reads out the amount in the list as well as the selected
                            value.
                            The ARIA version is described as a list and the HTML version is a "combo box, expanded".
                        </li>
                    </ul>
                </li>
                <li>
                    Selecting a value:
                <li>
                    <strong>Voiceover:</strong> ARIA version read out value as well as its place in the order in the list
                    (e.g.
                    Californium, text, 2 of 26). Native version just reads the just the value
                    <strong>NVDA: ARIA and HTML versions read of the value and its place in the order in the list.</strong>

                </li>
            </ul>
        </aside>

        <h1>ARIA listbox role example</h1>



        <h2>HTML5 native select element example</h2>


        <div id="html5-example">
            <form>
                <fieldset>
                    <legend>Choose your favorite transuranic element (actinide or transactinide).</legend>

                    <label for="form1-element">
                        Choose an element:
                    </label>

                    <select id="form1-element" name="element">
                        <option value="Np">
                            Neptunium
                        </option>
                        <option value="Pu">
                            Plutonium
                        </option>
                        <option value="Am">
                            Americium
                        </option>
                        <option value="Cm">
                            Curium
                        </option>
                        <option value="Bk">
                            Berkelium
                        </option>
                        <option value="Cf">
                            Californium
                        </option>
                        <option value="Es">
                            Einsteinium
                        </option>
                        <option value="Fm">
                            Fermium
                        </option>
                        <option value="Md">
                            Mendelevium
                        </option>
                        <option value="No">
                            Nobelium
                        </option>
                        <option value="Lr">
                            Lawrencium
                        </option>
                        <option value="Rf">
                            Rutherfordium
                        </option>
                        <option value="Db">
                            Dubnium
                        </option>
                        <option value="Sg">
                            Seaborgium
                        </option>
                        <option value="Bh">
                            Bohrium
                        </option>
                        <option value="Hs">
                            Hassium
                        </option>
                        <option value="Mt">
                            Meitnerium
                        </option>
                        <option value="Ds">
                            Darmstadtium
                        </option>
                        <option value="Rg">
                            Roentgenium
                        </option>
                        <option value="Cn">
                            Copernicium
                        </option>
                        <option value="Nh">
                            Nihonium
                        </option>
                        <option value="Fl">
                            Flerovium
                        </option>
                        <option value="Mc">
                            Moscovium
                        </option>
                        <option value="Lv">
                            Livermorium
                        </option>
                        <option value="Ts">
                            Tennessine
                        </option>
                        <option value="Og">
                            Oganesson
                        </option>
                    </select>
                </fieldset>
            </form>
        </div>

        <?php includeShowcode("html5-example")?>

        <script type="application/json" id="html5-example-props">
        {
            "replaceHTMLRules": {

            },
            "steps": [{
                    "label": "Mark up the component with a select tag",
                    "highlight": "%OPENCLOSETAG%select",
                    "notes": ""
                }, {
                    "label": "Mark up all the options with the option tag",
                    "highlight": "%OPENCLOSECONTENTTAG%option",
                    "notes": ""
                },
                {
                    "label": "Ensure the label is associated with the select tag",
                    "highlight": "for",
                    "notes": ""
                }
            ]
        }
        </script>

        <h2>Custom select CSS</h2>

        <p>What follows is an excellent customly styled native HTML5 select box.  It uses code from <a href="https://twitter.com/scottjehl">Scott Jehl</a>'s <a href="https://github.com/filamentgroup/select-css">cross browser CSS demo</a> that you can download via NPM.
        Instead of putting my usual notes as an explantion, visit their blog post <a href="https://www.filamentgroup.com/lab/select-css.html">Styling a Select Like It’s 2019</a>.

        <label class="select-css__label" for="fave-fruit">
            Favourite fruit:
        </label>
        <select id="fave-fruit" class="select-css">
            <option value="">Choose one ...</option>
            <option>Apples</option>
            <option>Bananas</option>
            <option>Grapes</option>
            <option>Oranges</option>
        </select>



        <h2>ARIA listbox example</h2>

        <p>
            Choose your favorite transuranic element (actinide or transactinide).
        </p>
        <div id="aria-example">
            <div class="enable-listbox listbox-area">
                <div class="left-area">
                    <span id="exp_elem" class="enable-listbox__exp_elem">
                        Choose an element:
                    </span>
                    <div id="exp_wrapper" class="enable-listbox__wrapper">
                        <button aria-haspopup="listbox" aria-expanded="false" aria-labelledby="exp_elem exp_button"
                            id="exp_button" class="enable-listbox__button">
                            Neptunium
                        </button>
                        <ul id="exp_elem_list" class="hidden" tabindex="-1" role="listbox" aria-labelledby="exp_elem">
                            <li id="exp_elem_Np" role="option">
                                Neptunium
                            </li>
                            <li id="exp_elem_Pu" role="option">
                                Plutonium
                            </li>
                            <li id="exp_elem_Am" role="option">
                                Americium
                            </li>
                            <li id="exp_elem_Cm" role="option">
                                Curium
                            </li>
                            <li id="exp_elem_Bk" role="option">
                                Berkelium
                            </li>
                            <li id="exp_elem_Cf" role="option">
                                Californium
                            </li>
                            <li id="exp_elem_Es" role="option">
                                Einsteinium
                            </li>
                            <li id="exp_elem_Fm" role="option">
                                Fermium
                            </li>
                            <li id="exp_elem_Md" role="option">
                                Mendelevium
                            </li>
                            <li id="exp_elem_No" role="option">
                                Nobelium
                            </li>
                            <li id="exp_elem_Lr" role="option">
                                Lawrencium
                            </li>
                            <li id="exp_elem_Rf" role="option">
                                Rutherfordium
                            </li>
                            <li id="exp_elem_Db" role="option">
                                Dubnium
                            </li>
                            <li id="exp_elem_Sg" role="option">
                                Seaborgium
                            </li>
                            <li id="exp_elem_Bh" role="option">
                                Bohrium
                            </li>
                            <li id="exp_elem_Hs" role="option">
                                Hassium
                            </li>
                            <li id="exp_elem_Mt" role="option">
                                Meitnerium
                            </li>
                            <li id="exp_elem_Ds" role="option">
                                Darmstadtium
                            </li>
                            <li id="exp_elem_Rg" role="option">
                                Roentgenium
                            </li>
                            <li id="exp_elem_Cn" role="option">
                                Copernicium
                            </li>
                            <li id="exp_elem_Nh" role="option">
                                Nihonium
                            </li>
                            <li id="exp_elem_Fl" role="option">
                                Flerovium
                            </li>
                            <li id="exp_elem_Mc" role="option">
                                Moscovium
                            </li>
                            <li id="exp_elem_Lv" role="option">
                                Livermorium
                            </li>
                            <li id="exp_elem_Ts" role="option">
                                Tennessine
                            </li>
                            <li id="exp_elem_Og" role="option">
                                Oganesson
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        

        <?php includeShowcode("aria-example")?>

        <script type="application/json" id="aria-example-props">
        {
            "replaceHTMLRules": {
                "[role=\"listbox\"]": "<!-- This is a the selected item in the dropdown --><li id=\"exp_elem_Np\" role=\"option\" aria-selected=\"true\">Neptunium</li><!-- This is an unselected item --><li id=\"exp_elem_Pu\" role=\"option\" aria-selected=\"false\">Plutonium</li>..."
            },
            "steps": [{
                    "label": "Place ARIA roles in document",
                    "highlight": "role",
                    "notes": "The <strong>option</strong> elements must be direct children of the <strong>listbox</strong> elements"
                },
                {
                    "label": "Place <strong>aria-haspopup</strong> attribute on button that activates dropdown functionality.",
                    "highlight": "aria-haspopup",
                    "notes": ""
                },
                {
                    "label": "Markup labels of listbox using aria-labelledby",
                    "highlight": "aria-labelledby ||| id=\"exp_button\"",
                    "notes": "Please ensure these ids are unique in your document.  If you have multiple dropdowns, the id from them must be unique."
                },
                {
                    "label": "When listbox is closed, hide listbox list with CSS <code>display: none</strong>.",
                    "highlight": "class=\"hidden\"",
                    "notes": "This prevents the screenreader from reading the contents of the hidden information in reading mode."
                },
                {
                    "label": "Place aria-selected attributes on options",
                    "highlight": "aria-selected",
                    "notes": "<strong>aria-selected=\"true\"</strong> for the selected option, <strong>aria-selected=\"false\"</strong> otherwise."
                },
                {
                    "label": "Place aria-expanded attribute on button element",
                    "highlight": "aria-expanded",
                    "notes": [
                        "<ul>",
                        "  <li>This is set to <strong>false</strong> when the options are hidden, <strong>true</strong> when the are visible.</li>",
                        "  <li>When expanded, focus goes to the selected element of the list. The user can change the value with the arrow keys",
                        "  <li>",
                        "    When expanded, mobile users should not be able to access elements outside of the list.  This is done by setting <strong>aria-hidden=\"true\"</strong> to all siblings, as well as the siblings of the list's parents.",
                        "    This can be done efficiently using the <strong>setMobileFocusLoop()</strong> of Enable's accessibility library.</li>",
                        "  </li>",
                        "  <li>",
                        "    When not closed, focus should go back to the button that opened it.",
                        "    Mobile users should be able to access elements outside of the list again.",
                        "    This can be done using <strong>accessibility.removeFocusLoop()</strong>",
                        "  </li>",
                        "  <li>When the keyboard focus is removed from the list, the listbox closes and <strong>aria-expanded</strong> is set to <strong>false</strong>.</li>",
                        "</ul>"
                    ]
                }

            ]
        }
        </script>


    </main>


    <script src="js/shared/enable-listbox.js"></script>
    <script src="js/accessibility.js"></script>

    <?php include "includes/example-footer.php"?>

</body>

</html>