<!DOCTYPE html>
<html>

<head>
    <title>ARIA listbox role example</title>
		<?php include("includes/common-head-tags.php"); ?>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes, minimum-scale=0.25, maximum-scale=5.0, width=device-width"/>
    <link rel="stylesheet" type="text/css" href="css/enable-listbox.css" />
    <meta charset="utf-8">
</head>

<body>

    <?php include("includes/example-header.php"); ?>

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
                                    <strong>Voiceover:</strong> The ARIA and native HTML versions state that they are "popup buttons"
                                    as well as the selected value. </li>
                                <li>
                                    <strong>NVDA:</strong> The ARIA version is a "button" with "submenu", while the HTML version
                                    is a "combo box, collapsed"
                                </li>
                        </li>
                        </ul>
                </li>
                <li>
                    Opening the widget:
                    <ul>
                        <li>
                            <strong>Voiceover:</strong> Reads out the selected value. The HTML version also reads how many other
                            options there are (e.g. menu 26 items)
                        </li>
                        <li>
                            <strong>NVDA:</strong> Both versions reads out the amount in the list as well as the selected value.
                            The ARIA version is described as a list and the HTML version is a "combo box, expanded".
                        </li>
                    </ul>
                </li>
                <li>
                    Selecting a value:
                    <li>
                        <strong>Voiceover:</strong> ARIA version read out value as well as its place in the order in the list (e.g.
                        Californium, text, 2 of 26). Native version just reads the just the value
                        <strong>NVDA: ARIA and HTML versions read of the value and its place in the order in the list.</strong>
                    </li>
                </li>
                </ol>
            </ul>
        </aside>

        <h1>ARIA listbox role example</h1>



        <h2>Example 1: ARIA listbox</h2>

        <p>
            Choose your favorite transuranic element (actinide or transactinide).
        </p>
        <div class="enable-listbox listbox-area">
            <div class="left-area">
                <span id="exp_elem" class="enable-listbox__exp_elem">
                    Choose an element:
                </span>
                <div id="exp_wrapper">
                    <button aria-haspopup="listbox" aria-labelledby="exp_elem exp_button" id="exp_button" class="enable-listbox__button">
                        Neptunium
                    </button>
                    <ul id="exp_elem_list" class="hidden" tabindex="-1" role="listbox" aria-labelledby="exp_elem" class="hidden">
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

        <h2>Example 2: HTML5 native select element</h2>


        <form>
            <p>Choose your favorite transuranic element (actinide or transactinide).</p>

            <label for="my-select">
                Choose an element:
            </label>

            <select id="my-select">
                <option>
                    Neptunium
                </option>
                <option>
                    Plutonium
                </option>
                <option>
                    Americium
                </option>
                <option>
                    Curium
                </option>
                <option>
                    Berkelium
                </option>
                <option>
                    Californium
                </option>
                <option>
                    Einsteinium
                </option>
                <option>
                    Fermium
                </option>
                <option>
                    Mendelevium
                </option>
                <option>
                    Nobelium
                </option>
                <option>
                    Lawrencium
                </option>
                <option>
                    Rutherfordium
                </option>
                <option>
                    Dubnium
                </option>
                <option>
                    Seaborgium
                </option>
                <option>
                    Bohrium
                </option>
                <option>
                    Hassium
                </option>
                <option>
                    Meitnerium
                </option>
                <option>
                    Darmstadtium
                </option>
                <option>
                    Roentgenium
                </option>
                <option>
                    Copernicium
                </option>
                <option>
                    Nihonium
                </option>
                <option>
                    Flerovium
                </option>
                <option>
                    Moscovium
                </option>
                <option>
                    Livermorium
                </option>
                <option>
                    Tennessine
                </option>
                <option>
                    Oganesson
                </option>
            </select>

        </form>

    </main>

    
    <script src="js/shared/enable-listbox.js"></script>
    <script src="js/accessibility.js"></script>
</body>

</html>