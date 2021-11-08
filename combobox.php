<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA combobox role examples</title>
    <?php include "includes/common-head-tags.php";?>
    <link rel="stylesheet" type="text/css" href="css/combobox__improved.css" />
</head>

<body>
    <?php include "includes/documentation-header.php";?>

    <main>
        <aside class="notes">
            <p>
                Example 1 is heavily refactored version of
                <a href="https://webkit.org/blog-files/aria1.0/combobox_with_live_region_status.html">the combobox
                    example
                    at webkit.org</a>. Added was a few extra instructions and UX features for screen reader users so
                they could use the autocomplete features in this widget.
                Note that it works way better than the native HTML5 <code>&lt;datalist&gt;</code> version. It
                is a huge exception to the rule that native works better than
                ARIA-based code.
            </p>
        </aside>

        <h1>ARIA combobox role examples</h1>

        <h2>Example 1:</h2>

        <p>Here is a standard autocomplete example using ARIA.</p>

        <form>
            <div id="example1" class="enable-combobox">
                <label id="aria-fruit__label" for="aria-fruit"> Enter a fruit or vegetable </label>
                <div class="enable-combobox__inner-container">
                    <div class="enable-combobox__controls-container">
                        <div role="status" aria-atomic="true"></div>
                        <input type="text" id="aria-fruit" aria-describedby="aria-fruit__desc" role="combobox"
                            aria-autocomplete="list" aria-owns="aria-fruit__list" aria-expanded="false"
                            autocomplete="off" autocorrect="off" autocapitalize="off" required />
                        <button class="enable-combobox__reset-button" aria-controls="aria-fruit" type="reset"
                            aria-describedby="aria-fruit__label">
                            <img class="enable-combobox__reset-button-image" src="images/close-window.svg"
                                alt="Clear" />
                        </button>

                        <!-- The dropdown (a.k.a. "listbox") -->
                        <ul role="listbox" id="aria-fruit__list" tabindex="-1" hidden>
                            <li tabindex="-1" role="option" >Apple</li>
                            <li tabindex="-1" role="option" >Artichoke</li>
                            <li tabindex="-1" role="option" >Asparagus</li>
                            <li tabindex="-1" role="option" >Banana</li>
                            <li tabindex="-1" role="option" >Beets</li>
                            <li tabindex="-1" role="option" >Bell pepper</li>
                            <li tabindex="-1" role="option" >Broccoli</li>
                            <li tabindex="-1" role="option" >Brussels sprout</li>
                            <li tabindex="-1" role="option" >Cabbage</li>
                            <li tabindex="-1" role="option" >Carrot</li>
                            <li tabindex="-1" role="option" >Cauliflower</li>
                            <li tabindex="-1" role="option" >Celery</li>
                            <li tabindex="-1" role="option" >Chard</li>
                            <li tabindex="-1" role="option" >Chicory</li>
                            <li tabindex="-1" role="option" >Corn</li>
                            <li tabindex="-1" role="option" >Cucumber</li>
                            <li tabindex="-1" role="option" >Daikon</li>
                            <li tabindex="-1" role="option" >Date</li>
                            <li tabindex="-1" role="option" >Edamame</li>
                            <li tabindex="-1" role="option" >Eggplant</li>
                            <li tabindex="-1" role="option" >Elderberry</li>
                            <li tabindex="-1" role="option" >Fennel</li>
                            <li tabindex="-1" role="option" >Fig</li>
                            <li tabindex="-1" role="option" >Garlic</li>
                            <li tabindex="-1" role="option" >Grape</li>
                            <li tabindex="-1" role="option" >Honeydew melon</li>
                            <li tabindex="-1" role="option" >Iceberg lettuce</li>
                            <li tabindex="-1" role="option" >
                                Jerusalem artichoke
                            </li>
                            <li tabindex="-1" role="option" >Kale</li>
                            <li tabindex="-1" role="option" >Kiwi</li>
                            <li tabindex="-1" role="option" >Leek</li>
                            <li tabindex="-1" role="option" >Lemon</li>
                            <li tabindex="-1" role="option" >Mango</li>
                            <li tabindex="-1" role="option" >Mangosteen</li>
                            <li tabindex="-1" role="option" >Melon</li>
                            <li tabindex="-1" role="option" >Mushroom</li>
                            <li tabindex="-1" role="option" >Nectarine</li>
                            <li tabindex="-1" role="option" >Okra</li>
                            <li tabindex="-1" role="option" >Olive</li>
                            <li tabindex="-1" role="option" >Onion</li>
                            <li tabindex="-1" role="option" >Orange</li>
                            <li tabindex="-1" role="option" >Parship</li>
                            <li tabindex="-1" role="option" >Pea</li>
                            <li tabindex="-1" role="option" >Pear</li>
                            <li tabindex="-1" role="option" >Pineapple</li>
                            <li tabindex="-1" role="option" >Potato</li>
                            <li tabindex="-1" role="option" >Pumpkin</li>
                            <li tabindex="-1" role="option" >Quince</li>
                            <li tabindex="-1" role="option" >Radish</li>
                            <li tabindex="-1" role="option" >Rhubarb</li>
                            <li tabindex="-1" role="option" >Shallot</li>
                            <li tabindex="-1" role="option" >Spinach</li>
                            <li tabindex="-1" role="option" >Squash</li>
                            <li tabindex="-1" role="option" >Strawberry</li>
                            <li tabindex="-1" role="option" >Sweet potato</li>
                            <li tabindex="-1" role="option" >Tomato</li>
                            <li tabindex="-1" role="option" >Turnip</li>
                            <li tabindex="-1" role="option" >Ugli fruit</li>
                            <li tabindex="-1" role="option" >Victoria plum</li>
                            <li tabindex="-1" role="option" >Watercress</li>
                            <li tabindex="-1" role="option" >Watermelon</li>
                            <li tabindex="-1" role="option" >Yam</li>
                            <li tabindex="-1" role="option" >Zucchi</li>
                        </ul>
                    </div>
                    <div class="sr-only" id="aria-fruit__desc">
                        As you type, press the enter key or use the up and down arrow keys to choose the autocomplete items.
                    </div>
                </div>
            </div>
        </form>

        

        <?php includeShowcode("example1")?>
        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {
                "[role=\"listbox\"]": "<li role=\"option\" value=\"Apple\">Apple</li><li role=\"option\" value=\"Artichoke\">Artichoke</li> ..."
            },
            "steps": [{
                    "label": "Place ARIA roles in document",
                    "highlight": "role=\"combobox\"",
                    "notes": "The input field must have a role of combobox in order for it to be announced correctly by the screen reader."
                },
                {
                    "label": "Code label to be associated with input",
                    "highlight": "for",
                    "notes": "Ensure the label is properly lababelled"
                },
                {
                    "label": "Component instructions for the component using aria-describedby",
                    "highlight": "aria-describedby",
                    "notes": "These instructions are visibly hidden, since they are only for screen reader users."
                },
                {
                    "label": "Associate the dropdown data with the input field",
                    "highlight": "aria-owns",
                    "notes": "This ensures the two elements are linked"
                },
                {
                    "label": "Set aria-autocomplete attribute",
                    "highlight": "aria-autocomplete",
                    "notes": "This tells the screen reader the type of autocompletion that is being done.  Possible values are <strong>list</strong> and <strong>inline</strong>."
                },
                {
                    "label": "Expose state of the dropdown",
                    "highlight": "aria-expanded",
                    "notes": "<p>When the menu is expanded, this should be set to <strong>\"true\"</strong>. Otherwise, it is set to <strong>\"false\"</strong>.</p><p>Note that when the dropdown is expanded, focus should go to the first element in the dropdown. The user should be able to cycle through the elements in the dropdown using the arrow keys.</p><p>When the user picks an element with the ENTER key, the dropdown should close and the element should be selected."
                },
                {
                    "label": "Turn off autocorrect and autocomplete",
                    "highlight": "autocomplete=\"off\" ||| autocorrect ||| autocapitalize=\"off\"",
                    "notes": "If we want to ensure the user can only pick the items in the dropdown, we have to make sure these items are shut off."
                },
                {
                    "label": "Insert roles for autocomplete list",
                    "highlight": "role=\"listbox\" ||| role=\"option\"",
                    "notes": "Options must be direct children of listbox"
                }
            ]
        }
        </script>




        <h2>Example 2:</h2>

        <p>Another ARIA combobox example. Note the special formatting in the dropdown. This is common
            in a lot of modern searchboxes in the headings of a lot of e-commerce sites.</p>

        <div id="example2">
        <form>
            <div class="enable-combobox">
                <label for="aria-example-2"> Enter a name of a country or de jure sovereign state</label>
                <div class="enable-combobox__inner-container">
                    <div class="enable-combobox__controls-container">
                        <!--
                        This announces instructions to screen reader users when
                        they focus into the widget
                        -->
                        <div class="sr-only" id="aria-example-2__desc">
                            As you type, use the up and down arrow keys (or swipe left and
                            right) to choose the autocomplete items.
                        </div>

                        <!--
                        This live region will announce how many items are visible
                        in the dropdown after the user types in characters into the
                        input. (e.g. 4 items).
                        -->
                        <div role="status" aria-atomic="true">
                            <!-- This is the list status live region: e.g. "4 items." -->
                        </div>

                        <!--
                        The focusable part of the widget.
                        -->
                        <input type="text" tabindex="0" id="aria-example-2" role="combobox" aria-autocomplete="list"
                            aria-owns="aria-example-2__list" aria-expanded="false" autocomplete="off" autocorrect="off"
                            autocapitalize="off" aria-describedby="aria-example-2__desc" />
                        <button class="enable-combobox__reset-button" aria-controls="aria-fruit" type="reset">
                            <img class="enable-combobox__reset-button-image" src="images/close-window.svg" alt="Clear"
                                aria-describedby="aria-fruit__label" />
                        </button>
                        <!--
                        The dropdown (a.k.a. "listbox")
                    -->
                        <div role="listbox" id="aria-example-2__list" hidden>
                            <div class="enable-combobox__group" role="presentation">
                                <h2 class="enable-combobox__group-header">Communist States</h2>

                                <div role="option" >People's Republic of China</div>
                                <div role="option" >
                                    Democratic
                                    People's Republic of Korea (North Korea)</div>
                                <div role="option" >Socialist Republic of Vietnam
                                </div>
                                <div role="option" >Lao People's
                                    Democratic
                                    Republic (Laos)</div>
                                <div role="option" >Republic of Cuba</div>
                            </div>
                            <div class="enable-combobox__group" role="presentation">
                                <h2 class="enable-combobox__group-header">Other States</h2>
                                <div role="option" >Afghanistan</div>
                                <div role="option" >Albania</div>
                                <div role="option" >Algeria</div>
                                <div role="option" >Andorra</div>
                                <div role="option" >Angola</div>
                                <div role="option" >Antigua and Barbuda</div>
                                <div role="option" >Argentina</div>
                                <div role="option" >Armenia</div>
                                <div role="option" >Australia</div>
                                <div role="option" >Austria</div>
                                <div role="option" >Azerbaijan</div>
                                <div role="option" >Bahamas</div>
                                <div role="option" >Bahrain</div>
                                <div role="option" >Bangladesh</div>
                                <div role="option" >Barbados</div>
                                <div role="option" >Belarus</div>
                                <div role="option" >Belgium</div>
                                <div role="option" >Belize</div>
                                <div role="option" >Benin</div>
                                <div role="option" >Bhutan</div>
                                <div role="option" >Bolivia</div>
                                <div role="option" >Bosnia and Herzegovina</div>
                                <div role="option" >Botswana</div>
                                <div role="option" >Brazil</div>
                                <div role="option" >Brunei </div>
                                <div role="option" >Bulgaria</div>
                                <div role="option" >Burkina Faso</div>
                                <div role="option" >Burundi</div>
                                <div role="option" >Cabo Verde</div>
                                <div role="option" >Cambodia</div>
                                <div role="option" >Cameroon</div>
                                <div role="option" >Canada</div>
                                <div role="option" >Central African Republic</div>
                                <div role="option" >Chad</div>
                                <div role="option" >Chile</div>
                                <div role="option" >Colombia</div>
                                <div role="option" >Comoros</div>
                                <div role="option" >Congo</div>
                                <div role="option" >Costa Rica</div>
                                <div role="option" >Croatia</div>
                                <div role="option" >Cyprus</div>
                                <div role="option" >Czech Republic (Czechia)</div>
                                <div role="option" >Côte d'Ivoire</div>
                                <div role="option" >DR Congo</div>
                                <div role="option" >Denmark</div>
                                <div role="option" >Djibouti</div>
                                <div role="option" >Dominica</div>
                                <div role="option" >Dominican Republic</div>
                                <div role="option" >Ecuador</div>
                                <div role="option" >Egypt</div>
                                <div role="option" >El Salvador</div>
                                <div role="option" >Equatorial Guinea</div>
                                <div role="option" >Eritrea</div>
                                <div role="option" >Estonia</div>
                                <div role="option" >Eswatini</div>
                                <div role="option" >Ethiopia</div>
                                <div role="option" >Fiji</div>
                                <div role="option" >Finland</div>
                                <div role="option" >France</div>
                                <div role="option" >Gabon</div>
                                <div role="option" >Gambia</div>
                                <div role="option" >Georgia</div>
                                <div role="option" >Germany</div>
                                <div role="option" >Ghana</div>
                                <div role="option" >Greece</div>
                                <div role="option" >Grenada</div>
                                <div role="option" >Guatemala</div>
                                <div role="option" >Guinea</div>
                                <div role="option" >Guinea-Bissau</div>
                                <div role="option" >Guyana</div>
                                <div role="option" >Haiti</div>
                                <div role="option" >Holy See</div>
                                <div role="option" >Honduras</div>
                                <div role="option" >Hungary</div>
                                <div role="option" >Iceland</div>
                                <div role="option" >India</div>
                                <div role="option" >Indonesia</div>
                                <div role="option" >Iran</div>
                                <div role="option" >Iraq</div>
                                <div role="option" >Ireland</div>
                                <div role="option" >Israel</div>
                                <div role="option" >Italy</div>
                                <div role="option" >Jamaica</div>
                                <div role="option" >Japan</div>
                                <div role="option" >Jordan</div>
                                <div role="option" >Kazakhstan</div>
                                <div role="option" >Kenya</div>
                                <div role="option" >Kiribati</div>
                                <div role="option" >Kuwait</div>
                                <div role="option" >Kyrgyzstan</div>
                                <div role="option" >Latvia</div>
                                <div role="option" >Lebanon</div>
                                <div role="option" >Lesotho</div>
                                <div role="option" >Liberia</div>
                                <div role="option" >Libya</div>
                                <div role="option" >Liechtenstein</div>
                                <div role="option" >Lithuania</div>
                                <div role="option" >Luxembourg</div>
                                <div role="option" >Madagascar</div>
                                <div role="option" >Malawi</div>
                                <div role="option" >Malaysia</div>
                                <div role="option" >Maldives</div>
                                <div role="option" >Mali</div>
                                <div role="option" >Malta</div>
                                <div role="option" >Marshall Islands</div>
                                <div role="option" >Mauritania</div>
                                <div role="option" >Mauritius</div>
                                <div role="option" >Mexico</div>
                                <div role="option" >Micronesia</div>
                                <div role="option" >Moldova</div>
                                <div role="option" >Monaco</div>
                                <div role="option" >Mongolia</div>
                                <div role="option" >Montenegro</div>
                                <div role="option" >Morocco</div>
                                <div role="option" >Mozambique</div>
                                <div role="option" >Myanmar</div>
                                <div role="option" >Namibia</div>
                                <div role="option" >Nauru</div>
                                <div role="option" >Nepal</div>
                                <div role="option" >Netherlands</div>
                                <div role="option" >New Zealand</div>
                                <div role="option" >Nicaragua</div>
                                <div role="option" >Niger</div>
                                <div role="option" >Nigeria</div>
                                <div role="option" >North Macedonia</div>
                                <div role="option" >Norway</div>
                                <div role="option" >Oman</div>
                                <div role="option" >Pakistan</div>
                                <div role="option" >Palau</div>
                                <div role="option" >Panama</div>
                                <div role="option" >Papua New Guinea</div>
                                <div role="option" >Paraguay</div>
                                <div role="option" >Peru</div>
                                <div role="option" >Philippines</div>
                                <div role="option" >Poland</div>
                                <div role="option" >Portugal</div>
                                <div role="option" >Qatar</div>
                                <div role="option" >Romania</div>
                                <div role="option" >Russia</div>
                                <div role="option" >Rwanda</div>
                                <div role="option" >Saint Kitts &amp; Nevis</div>
                                <div role="option" >Saint Lucia</div>
                                <div role="option" >Samoa</div>
                                <div role="option" >San Marino</div>
                                <div role="option" >Sao Tome &amp; Principe</div>
                                <div role="option" >Saudi Arabia</div>
                                <div role="option" >Senegal</div>
                                <div role="option" >Serbia</div>
                                <div role="option" >Seychelles</div>
                                <div role="option" >Sierra Leone</div>
                                <div role="option" >Singapore</div>
                                <div role="option" >Slovakia</div>
                                <div role="option" >Slovenia</div>
                                <div role="option" >Solomon Islands</div>
                                <div role="option" >Somalia</div>
                                <div role="option" >South Africa</div>
                                <div role="option" >South Korea</div>
                                <div role="option" >South Sudan</div>
                                <div role="option" >Spain</div>
                                <div role="option" >Sri Lanka</div>
                                <div role="option" >St. Vincent &amp; Grenadines
                                </div>
                                <div role="option" >State of Palestine</div>
                                <div role="option" >Sudan</div>
                                <div role="option" >Suriname</div>
                                <div role="option" >Sweden</div>
                                <div role="option" >Switzerland</div>
                                <div role="option" >Syria</div>
                                <div role="option" >Tajikistan</div>
                                <div role="option" >Tanzania</div>
                                <div role="option" >Thailand</div>
                                <div role="option" >Timor-Leste</div>
                                <div role="option" >Togo</div>
                                <div role="option" >Tonga</div>
                                <div role="option" >Trinidad and Tobago</div>
                                <div role="option" >Tunisia</div>
                                <div role="option" >Turkey</div>
                                <div role="option" >Turkmenistan</div>
                                <div role="option" >Tuvalu</div>
                                <div role="option" >Uganda</div>
                                <div role="option" >Ukraine</div>
                                <div role="option" >United Arab Emirates</div>
                                <div role="option" >United Kingdom</div>
                                <div role="option" >United States</div>
                                <div role="option" >Uruguay</div>
                                <div role="option" >Uzbekistan</div>
                                <div role="option" >Vanuatu</div>
                                <div role="option" >Venezuela</div>
                                <div role="option" >Yemen</div>
                                <div role="option" >Zambia</div>
                                <div role="option" >Zimbabwe</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>


        <?php includeShowcode("example2", "", "", "
            <p><strong>Note: since it is very similar, please follow all the steps in the previous example first before
            implementing the following steps.</strong></p>
        ")?>

        <script type="application/json" id="example2-props">
        {
            "replaceHTMLRules": {
                "[role=\"listbox\"]":  [
                    "<div class=\"enable-combobox__group\" role=\"presentation\">",
                        "<h2 class=\"enable-combobox__group-header\">Communist States</h2>",
                        "",
                        "<div role=\"option\" >People's Republic of China</div>",
                        "",
                        "...",
                        "",
                    "</div>",
                    "<div class=\"enable-combobox__group\" role=\"presentation\">",
                        "<h2 class=\"enable-combobox__group-header\">Other States</h2>",
                        "<div role=\"option\" >Afghanistan</div>",
                        "",
                        "...",
                    "</div>"
                ]
            },
            "steps": [
                {
                    "label": "Set up group roles",
                    "highlight": "role=\"presentation\"",
                    "notes": "This is because the option elements are not direct children of the listbox."
                },
                {
                    "label": "Set up headings for the groups",
                    "highlight": "%OPENCLOSETAG%~ h2",
                    "notes": "The heading for each group"
                }
            ]
        }
        </script>

        <h2>Example 2a: Autosubmitting when choosing an element</h2>

        <div id="example2-submit-on-select">
            <form role="search" aria-label="Example 2a combobox example" tabindex="-1">
                <div class="enable-combobox">
                    <label for="aria-example-2a">Country:</label>
                    <div class="enable-combobox__inner-container">
                        <div id="aria-example-2a__close-desc" class="sr-only">
                            Please choose a value or clear the combobox by either pressing the escape key or activating the clear button.
                        </div>

                        <div class="enable-combobox__controls-container">
                            <!--
                            This announces instructions to screen reader users when
                            they focus into the widget
                            -->
                            <div class="sr-only" id="aria-example-2a__desc">
                                As you type, use the up and down arrow keys or press ENTER and swipe to choose the autocomplete items.
                            </div>

                            <!--
                            This live region will announce how many items are visible
                            in the dropdown after the user types in characters into the
                            input. (e.g. 4 items).
                            -->
                            <div role="status" aria-atomic="true">
                                <!-- This is the list status live region: e.g. "4 items." -->
                            </div>

                            <!--
                            The focusable part of the widget.
                            -->
                            <input type="text" tabindex="0" id="aria-example-2a" role="combobox" aria-autocomplete="list"
                                aria-owns="aria-example-2a__list" aria-expanded="false" autocomplete="off" autocorrect="off"
                                autocapitalize="off" aria-describedby="aria-example-2a__desc" />
                            <button class="enable-combobox__reset-button" aria-controls="aria-fruit" type="reset" aria-describedby="aria-example-2a__close-desc">
                                <img class="enable-combobox__reset-button-image" src="images/close-window.svg" alt="Clear"
                                    aria-describedby="aria-fruit__label" />
                            </button>
                            <!--
                            The dropdown (a.k.a. "listbox")
                        -->
                            <div role="listbox" id="aria-example-2a__list" hidden >
                                <div class="enable-combobox__group" role="presentation">
                                    <h2 class="enable-combobox__group-header">Communist States</h2>

                                    <div role="option" >People's Republic of China</div>
                                    <div role="option" >
                                        Democratic
                                        People's Republic of Korea (North Korea)</div>
                                    <div role="option" >Socialist Republic of Vietnam
                                    </div>
                                    <div role="option" >Lao People's
                                        Democratic
                                        Republic (Laos)</div>
                                    <div role="option" >Republic of Cuba</div>
                                </div>
                                <div class="enable-combobox__group" role="presentation">
                                    <h2 class="enable-combobox__group-header">Other States</h2>
                                    <div role="option" >Afghanistan</div>
                                    <div role="option" >Albania</div>
                                    <div role="option" >Algeria</div>
                                    <div role="option" >Andorra</div>
                                    <div role="option" >Angola</div>
                                    <div role="option" >Antigua and Barbuda</div>
                                    <div role="option" >Argentina</div>
                                    <div role="option" >Armenia</div>
                                    <div role="option" >Australia</div>
                                    <div role="option" >Austria</div>
                                    <div role="option" >Azerbaijan</div>
                                    <div role="option" >Bahamas</div>
                                    <div role="option" >Bahrain</div>
                                    <div role="option" >Bangladesh</div>
                                    <div role="option" >Barbados</div>
                                    <div role="option" >Belarus</div>
                                    <div role="option" >Belgium</div>
                                    <div role="option" >Belize</div>
                                    <div role="option" >Benin</div>
                                    <div role="option" >Bhutan</div>
                                    <div role="option" >Bolivia</div>
                                    <div role="option" >Bosnia and Herzegovina</div>
                                    <div role="option" >Botswana</div>
                                    <div role="option" >Brazil</div>
                                    <div role="option" >Brunei </div>
                                    <div role="option" >Bulgaria</div>
                                    <div role="option" >Burkina Faso</div>
                                    <div role="option" >Burundi</div>
                                    <div role="option" >Cabo Verde</div>
                                    <div role="option" >Cambodia</div>
                                    <div role="option" >Cameroon</div>
                                    <div role="option" >Canada</div>
                                    <div role="option" >Central African Republic</div>
                                    <div role="option" >Chad</div>
                                    <div role="option" >Chile</div>
                                    <div role="option" >Colombia</div>
                                    <div role="option" >Comoros</div>
                                    <div role="option" >Congo</div>
                                    <div role="option" >Costa Rica</div>
                                    <div role="option" >Croatia</div>
                                    <div role="option" >Cyprus</div>
                                    <div role="option" >Czech Republic (Czechia)</div>
                                    <div role="option" >Côte d'Ivoire</div>
                                    <div role="option" >DR Congo</div>
                                    <div role="option" >Denmark</div>
                                    <div role="option" >Djibouti</div>
                                    <div role="option" >Dominica</div>
                                    <div role="option" >Dominican Republic</div>
                                    <div role="option" >Ecuador</div>
                                    <div role="option" >Egypt</div>
                                    <div role="option" >El Salvador</div>
                                    <div role="option" >Equatorial Guinea</div>
                                    <div role="option" >Eritrea</div>
                                    <div role="option" >Estonia</div>
                                    <div role="option" >Eswatini</div>
                                    <div role="option" >Ethiopia</div>
                                    <div role="option" >Fiji</div>
                                    <div role="option" >Finland</div>
                                    <div role="option" >France</div>
                                    <div role="option" >Gabon</div>
                                    <div role="option" >Gambia</div>
                                    <div role="option" >Georgia</div>
                                    <div role="option" >Germany</div>
                                    <div role="option" >Ghana</div>
                                    <div role="option" >Greece</div>
                                    <div role="option" >Grenada</div>
                                    <div role="option" >Guatemala</div>
                                    <div role="option" >Guinea</div>
                                    <div role="option" >Guinea-Bissau</div>
                                    <div role="option" >Guyana</div>
                                    <div role="option" >Haiti</div>
                                    <div role="option" >Holy See</div>
                                    <div role="option" >Honduras</div>
                                    <div role="option" >Hungary</div>
                                    <div role="option" >Iceland</div>
                                    <div role="option" >India</div>
                                    <div role="option" >Indonesia</div>
                                    <div role="option" >Iran</div>
                                    <div role="option" >Iraq</div>
                                    <div role="option" >Ireland</div>
                                    <div role="option" >Israel</div>
                                    <div role="option" >Italy</div>
                                    <div role="option" >Jamaica</div>
                                    <div role="option" >Japan</div>
                                    <div role="option" >Jordan</div>
                                    <div role="option" >Kazakhstan</div>
                                    <div role="option" >Kenya</div>
                                    <div role="option" >Kiribati</div>
                                    <div role="option" >Kuwait</div>
                                    <div role="option" >Kyrgyzstan</div>
                                    <div role="option" >Latvia</div>
                                    <div role="option" >Lebanon</div>
                                    <div role="option" >Lesotho</div>
                                    <div role="option" >Liberia</div>
                                    <div role="option" >Libya</div>
                                    <div role="option" >Liechtenstein</div>
                                    <div role="option" >Lithuania</div>
                                    <div role="option" >Luxembourg</div>
                                    <div role="option" >Madagascar</div>
                                    <div role="option" >Malawi</div>
                                    <div role="option" >Malaysia</div>
                                    <div role="option" >Maldives</div>
                                    <div role="option" >Mali</div>
                                    <div role="option" >Malta</div>
                                    <div role="option" >Marshall Islands</div>
                                    <div role="option" >Mauritania</div>
                                    <div role="option" >Mauritius</div>
                                    <div role="option" >Mexico</div>
                                    <div role="option" >Micronesia</div>
                                    <div role="option" >Moldova</div>
                                    <div role="option" >Monaco</div>
                                    <div role="option" >Mongolia</div>
                                    <div role="option" >Montenegro</div>
                                    <div role="option" >Morocco</div>
                                    <div role="option" >Mozambique</div>
                                    <div role="option" >Myanmar</div>
                                    <div role="option" >Namibia</div>
                                    <div role="option" >Nauru</div>
                                    <div role="option" >Nepal</div>
                                    <div role="option" >Netherlands</div>
                                    <div role="option" >New Zealand</div>
                                    <div role="option" >Nicaragua</div>
                                    <div role="option" >Niger</div>
                                    <div role="option" >Nigeria</div>
                                    <div role="option" >North Macedonia</div>
                                    <div role="option" >Norway</div>
                                    <div role="option" >Oman</div>
                                    <div role="option" >Pakistan</div>
                                    <div role="option" >Palau</div>
                                    <div role="option" >Panama</div>
                                    <div role="option" >Papua New Guinea</div>
                                    <div role="option" >Paraguay</div>
                                    <div role="option" >Peru</div>
                                    <div role="option" >Philippines</div>
                                    <div role="option" >Poland</div>
                                    <div role="option" >Portugal</div>
                                    <div role="option" >Qatar</div>
                                    <div role="option" >Romania</div>
                                    <div role="option" >Russia</div>
                                    <div role="option" >Rwanda</div>
                                    <div role="option" >Saint Kitts &amp; Nevis</div>
                                    <div role="option" >Saint Lucia</div>
                                    <div role="option" >Samoa</div>
                                    <div role="option" >San Marino</div>
                                    <div role="option" >Sao Tome &amp; Principe</div>
                                    <div role="option" >Saudi Arabia</div>
                                    <div role="option" >Senegal</div>
                                    <div role="option" >Serbia</div>
                                    <div role="option" >Seychelles</div>
                                    <div role="option" >Sierra Leone</div>
                                    <div role="option" >Singapore</div>
                                    <div role="option" >Slovakia</div>
                                    <div role="option" >Slovenia</div>
                                    <div role="option" >Solomon Islands</div>
                                    <div role="option" >Somalia</div>
                                    <div role="option" >South Africa</div>
                                    <div role="option" >South Korea</div>
                                    <div role="option" >South Sudan</div>
                                    <div role="option" >Spain</div>
                                    <div role="option" >Sri Lanka</div>
                                    <div role="option" >St. Vincent &amp; Grenadines
                                    </div>
                                    <div role="option" >State of Palestine</div>
                                    <div role="option" >Sudan</div>
                                    <div role="option" >Suriname</div>
                                    <div role="option" >Sweden</div>
                                    <div role="option" >Switzerland</div>
                                    <div role="option" >Syria</div>
                                    <div role="option" >Tajikistan</div>
                                    <div role="option" >Tanzania</div>
                                    <div role="option" >Thailand</div>
                                    <div role="option" >Timor-Leste</div>
                                    <div role="option" >Togo</div>
                                    <div role="option" >Tonga</div>
                                    <div role="option" >Trinidad and Tobago</div>
                                    <div role="option" >Tunisia</div>
                                    <div role="option" >Turkey</div>
                                    <div role="option" >Turkmenistan</div>
                                    <div role="option" >Tuvalu</div>
                                    <div role="option" >Uganda</div>
                                    <div role="option" >Ukraine</div>
                                    <div role="option" >United Arab Emirates</div>
                                    <div role="option" >United Kingdom</div>
                                    <div role="option" >United States</div>
                                    <div role="option" >Uruguay</div>
                                    <div role="option" >Uzbekistan</div>
                                    <div role="option" >Vanuatu</div>
                                    <div role="option" >Venezuela</div>
                                    <div role="option" >Yemen</div>
                                    <div role="option" >Zambia</div>
                                    <div role="option" >Zimbabwe</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <?php includeShowcode("example2-submit-on-select", "", "", "
            <p><strong>Note: since it is very similar, please follow all the steps in the two previous examples first before
            implementing the following steps.</strong></p>
        ")?>

        <script type="application/json" id="example2-submit-on-select-props">
        {
            "replaceHTMLRules": {
                "[role=\"listbox\"]":  [
                    "<div class=\"enable-combobox__group\" role=\"presentation\">",
                        "<h2 class=\"enable-combobox__group-header\">Communist States</h2>",
                        "",
                        "<div role=\"option\" >People's Republic of China</div>",
                        "",
                        "...",
                        "",
                    "</div>",
                    "<div class=\"enable-combobox__group\" role=\"presentation\">",
                        "<h2 class=\"enable-combobox__group-header\">Other States</h2>",
                        "<div role=\"option\" >Afghanistan</div>",
                        "",
                        "...",
                    "</div>"
                ]
            },
            "steps": [
                {
                    "label": "Create JS code to submit query when clicking the option elements.",
                    "highlight": "%JS% autocompleteSubmit",
                    "notes": "Note that custom event <code>combobox-change</code> that this event handler uses. This fires when an option is chosen from the list.  It takes the value chosen and puts it inside a Google Search URL, using URLSearchParams and a template string."
                }
            ]
        }
        </script>


        <h2>Example 3: Using HTML5 datalist</h2>

        <p>
            Ironically, this seems to be inaccessible compared to the ARIA version:
        </p>

        <ul>
            <li>
                The autocomplete features are available to mobile screen reader users.
                I was not able to figure out how to gain access to the datalist values
                using either Talkback/Chrome on Android or VoiceOver/Safari for iOS.
            <li>
                When a user types in values, the screen reader doesn't report that
                is a suggestion list visible in some browsers (e.g. Firefox 86 with NVDA).
            </li>
            <li>
                If the user uses the up and down arrow keys, some browsers doesn't read
                these values out (e.g. older versions of Safari with VoiceOver).
            </li>
            <li>
                Because of the above reasons, it is one of the cases where ARIA works
                better.
            </li>
        </ul>

        <div id="dataset-example">
            <form>
                <label id="html5-fruit__label" for="html5-fruit" class="combobox-label">
                    Enter a Fruit or Vegetable
                </label>
                <input id="html5-fruit" name="friuit" type="text" list="languages" aria-describedby="html5-fruit__desc" />
                <div class="sr-only" id="html5-fruit__desc">
                    As you type, use the up and down arrow keys to choose the autocomplete
                    items.
                </div>
                <div id="html5-fruit__statys" role="status" aria-atomic="true">
                    <!-- This is the list status live region: e.g. "4 items." -->
                </div>
                <datalist id="languages">
                    <option id="Apple" value="Apple">Apple</option>
                    <option id="Artichoke" value="Artichoke">Artichoke</option>
                    <option id="Asparagus" value="Asparagus">Asparagus</option>
                    <option id="Banana" value="Banana">Banana</option>
                    <option id="Beets" value="Beets">Beets</option>
                    <option id="Bell-pepper" value="Bell pepper">Bell pepper</option>
                    <option id="Broccoli" value="Broccoli">Broccoli</option>
                    <option id="Brussels-sprout" value="Brussels sprout">
                        Brussels sprout
                    </option>
                    <option id="Cabbage" value="Cabbage">Cabbage</option>
                    <option id="Carrot" value="Carrot">Carrot</option>
                    <option id="Cauliflower" value="Cauliflower">Cauliflower</option>
                    <option id="Celery" value="Celery">Celery</option>
                    <option id="Chard" value="Chard">Chard</option>
                    <option id="Chicory" value="Chicory">Chicory</option>
                    <option id="Corn" value="Corn">Corn</option>
                    <option id="Cucumber" value="Cucumber">Cucumber</option>
                    <option id="Daikon" value="Daikon">Daikon</option>
                    <option id="Date" value="Date">Date</option>
                    <option id="Edamame" value="Edamame">Edamame</option>
                    <option id="Eggplant" value="Eggplant">Eggplant</option>
                    <option id="Elderberry" value="Elderberry">Elderberry</option>
                    <option id="Fennel" value="Fennel">Fennel</option>
                    <option id="Fig" value="Fig">Fig</option>
                    <option id="Garlic" value="Garlic">Garlic</option>
                    <option id="Grape" value="Grape">Grape</option>
                    <option id="Honeydew-melon" value="Honeydew melon">
                        Honeydew melon
                    </option>
                    <option id="Iceberg-lettuce" value="Iceberg lettuce">
                        Iceberg lettuce
                    </option>
                    <option id="Jerusalem-artichoke" value="Jerusalem artichoke">
                        Jerusalem artichoke
                    </option>
                    <option id="Kale" value="Kale">Kale</option>
                    <option id="Kiwi" value="Kiwi">Kiwi</option>
                    <option id="Leek" value="Leek">Leek</option>
                    <option id="Lemon" value="Lemon">Lemon</option>
                    <option id="Mango" value="Mango">Mango</option>
                    <option id="Mangosteen" value="Mangosteen">Mangosteen</option>
                    <option id="Melon" value="Melon">Melon</option>
                    <option id="Mushroom" value="Mushroom">Mushroom</option>
                    <option id="Nectarine" value="Nectarine">Nectarine</option>
                    <option id="Okra" value="Okra">Okra</option>
                    <option id="Olive" value="Olive">Olive</option>
                    <option id="Onion" value="Onion">Onion</option>
                    <option id="Orange" value="Orange">Orange</option>
                    <option id="Parship" value="Parship">Parship</option>
                    <option id="Pea" value="Pea">Pea</option>
                    <option id="Pear" value="Pear">Pear</option>
                    <option id="Pineapple" value="Pineapple">Pineapple</option>
                    <option id="Potato" value="Potato">Potato</option>
                    <option id="Pumpkin" value="Pumpkin">Pumpkin</option>
                    <option id="Quince" value="Quince">Quince</option>
                    <option id="Radish" value="Radish">Radish</option>
                    <option id="Rhubarb" value="Rhubarb">Rhubarb</option>
                    <option id="Shallot" value="Shallot">Shallot</option>
                    <option id="Spinach" value="Spinach">Spinach</option>
                    <option id="Squash" value="Squash">Squash</option>
                    <option id="Strawberry" value="Strawberry">Strawberry</option>
                    <option id="Sweet-potato" value="Sweet potato">Sweet potato</option>
                    <option id="Tomato" value="Tomato">Tomato</option>
                    <option id="Turnip" value="Turnip">Turnip</option>
                    <option id="Ugli-fruit" value="Ugli fruit">Ugli fruit</option>
                    <option id="Victoria-plum" value="Victoria plum">
                        Victoria plum
                    </option>
                    <option id="Watercress" value="Watercress">Watercress</option>
                    <option id="Watermelon" value="Watermelon">Watermelon</option>
                    <option id="Yam" value="Yam">Yam</option>
                    <option id="Zucchi" value="Zucchi">Zucchi</option>
                </datalist>
            </form>
        </div>

        <?php includeShowcode("dataset-example")?>

        <script type="application/json" id="dataset-example-props">
        {
            "replaceHTMLRules": {
                "datalist":  [
                    "<option id=\"Apple\" value=\"Apple\">Apple</option>",
                    "<option id=\"Artichoke\" value=\"Artichoke\">Artichoke</option>",
                    "",
                    "...",
                    ""
                ]
            },
            "steps": [
                {
                    "label": "Create label for input tag.",
                    "highlight": "for",
                    "notes": "Just like any other form element, this needs a proper label."
                },
                {
                    "label": "Give keyboard instructions using aria-describedby.",
                    "highlight": "aria-describedby",
                    "notes": "Since accessibility API support is a little sketchy right now, these instructions may help some screen reader users use this component properly."
                },
                {
                    "label": "Set up the datalist options",
                    "highlight": "%OPENCLOSECONTENTTAG%datalist",
                    "notes": "Note that the content of this is similar to the <code>select</code> tag.  It's basically a list of options."
                }
            ]
        }
        </script>


    </main>

    <script src="js/accessibility.js"></script>
    <script src="js/combobox__improved.js"></script>

    <!-- This is the submit handler for example 2a -->
    <script>
        const autocompleteSubmit = new function () {
            this.init = () => {
                document.getElementById('aria-example-2a').addEventListener('combobox-change', (e) => {
                    const { currentTarget } = e;
                    const { value } = currentTarget;
                    const q = `https://www.google.com/search?${new URLSearchParams(`q=${value}`).toString()}`
                    location.href=q;
                });
            }
            this.init();
        }
    </script>
    <?php include "includes/example-footer.php"?>

</body>

</html>