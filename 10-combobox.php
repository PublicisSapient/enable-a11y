<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA combobox role examples</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/combobox__improved.css" />
</head>

<body>
    <?php include("includes/example-header.php"); ?>

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
                    <span class="enable-combobox__controls-container">
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
                            <li tabindex="-1" role="option" value="Apple">Apple</li>
                            <li tabindex="-1" role="option" value="Artichoke">Artichoke</li>
                            <li tabindex="-1" role="option" value="Asparagus">Asparagus</li>
                            <li tabindex="-1" role="option" value="Banana">Banana</li>
                            <li tabindex="-1" role="option" value="Beets">Beets</li>
                            <li tabindex="-1" role="option" value="Bell pepper">Bell pepper</li>
                            <li tabindex="-1" role="option" value="Broccoli">Broccoli</li>
                            <li tabindex="-1" role="option" value="Brussels sprout">Brussels sprout</li>
                            <li tabindex="-1" role="option" value="Cabbage">Cabbage</li>
                            <li tabindex="-1" role="option" value="Carrot">Carrot</li>
                            <li tabindex="-1" role="option" value="Cauliflower">Cauliflower</li>
                            <li tabindex="-1" role="option" value="Celery">Celery</li>
                            <li tabindex="-1" role="option" value="Chard">Chard</li>
                            <li tabindex="-1" role="option" value="Chicory">Chicory</li>
                            <li tabindex="-1" role="option" value="Corn">Corn</li>
                            <li tabindex="-1" role="option" value="Cucumber">Cucumber</li>
                            <li tabindex="-1" role="option" value="Daikon">Daikon</li>
                            <li tabindex="-1" role="option" value="Date">Date</li>
                            <li tabindex="-1" role="option" value="Edamame">Edamame</li>
                            <li tabindex="-1" role="option" value="Eggplant">Eggplant</li>
                            <li tabindex="-1" role="option" value="Elderberry">Elderberry</li>
                            <li tabindex="-1" role="option" value="Fennel">Fennel</li>
                            <li tabindex="-1" role="option" value="Fig">Fig</li>
                            <li tabindex="-1" role="option" value="Garlic">Garlic</li>
                            <li tabindex="-1" role="option" value="Grape">Grape</li>
                            <li tabindex="-1" role="option" value="Honeydew melon">Honeydew melon</li>
                            <li tabindex="-1" role="option" value="Iceberg lettuce">Iceberg lettuce</li>
                            <li tabindex="-1" role="option" value="Jerusalem artichoke">
                                Jerusalem artichoke
                            </li>
                            <li tabindex="-1" role="option" value="Kale">Kale</li>
                            <li tabindex="-1" role="option" value="Kiwi">Kiwi</li>
                            <li tabindex="-1" role="option" value="Leek">Leek</li>
                            <li tabindex="-1" role="option" value="Lemon">Lemon</li>
                            <li tabindex="-1" role="option" value="Mango">Mango</li>
                            <li tabindex="-1" role="option" value="Mangosteen">Mangosteen</li>
                            <li tabindex="-1" role="option" value="Melon">Melon</li>
                            <li tabindex="-1" role="option" value="Mushroom">Mushroom</li>
                            <li tabindex="-1" role="option" value="Nectarine">Nectarine</li>
                            <li tabindex="-1" role="option" value="Okra">Okra</li>
                            <li tabindex="-1" role="option" value="Olive">Olive</li>
                            <li tabindex="-1" role="option" value="Onion">Onion</li>
                            <li tabindex="-1" role="option" value="Orange">Orange</li>
                            <li tabindex="-1" role="option" value="Parship">Parship</li>
                            <li tabindex="-1" role="option" value="Pea">Pea</li>
                            <li tabindex="-1" role="option" value="Pear">Pear</li>
                            <li tabindex="-1" role="option" value="Pineapple">Pineapple</li>
                            <li tabindex="-1" role="option" value="Potato">Potato</li>
                            <li tabindex="-1" role="option" value="Pumpkin">Pumpkin</li>
                            <li tabindex="-1" role="option" value="Quince">Quince</li>
                            <li tabindex="-1" role="option" value="Radish">Radish</li>
                            <li tabindex="-1" role="option" value="Rhubarb">Rhubarb</li>
                            <li tabindex="-1" role="option" value="Shallot">Shallot</li>
                            <li tabindex="-1" role="option" value="Spinach">Spinach</li>
                            <li tabindex="-1" role="option" value="Squash">Squash</li>
                            <li tabindex="-1" role="option" value="Strawberry">Strawberry</li>
                            <li tabindex="-1" role="option" value="Sweet potato">Sweet potato</li>
                            <li tabindex="-1" role="option" value="Tomato">Tomato</li>
                            <li tabindex="-1" role="option" value="Turnip">Turnip</li>
                            <li tabindex="-1" role="option" value="Ugli fruit">Ugli fruit</li>
                            <li tabindex="-1" role="option" value="Victoria plum">Victoria plum</li>
                            <li tabindex="-1" role="option" value="Watercress">Watercress</li>
                            <li tabindex="-1" role="option" value="Watermelon">Watermelon</li>
                            <li tabindex="-1" role="option" value="Yam">Yam</li>
                            <li tabindex="-1" role="option" value="Zucchi">Zucchi</li>
                        </ul>
                    </span>
                    <div class="sr-only" id="aria-fruit__desc">
                        As you type, press the enter key or use the up and down arrow keys to choose the autocomplete items.
                    </div>
                </div>
            </div>
        </form>

        <h3 class="showcode__heading">Example code explanation</h3>

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

        <form>
            <div class="enable-combobox">
                <label for="aria-example-2"> Enter a name of a country or de jure sovereign state</label>
                <div class="enable-combobox__inner-container">
                    <span class="enable-combobox__controls-container">
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

                                <div role="option" value="People's Republic of China">People's Republic of China</div>
                                <div role="option" value="Democratic People's Republic of Korea (North Korea)">
                                    Democratic
                                    People's Republic of Korea (North Korea)</div>
                                <div role="option" value="Socialist Republic of Vietnam">Socialist Republic of Vietnam
                                </div>
                                <div role="option" value="Lao People's Democratic Republic (Laos)">Lao People's
                                    Democratic
                                    Republic (Laos)</div>
                                <div role="option" value="Republic of Cuba">Republic of Cuba</div>
                            </div>
                            <div class="enable-combobox__group" role="presentation">
                                <h2 class="enable-combobox__group-header">Other States</h2>
                                <div role="option" value="Afghanistan">Afghanistan</div>
                                <div role="option" value="Albania">Albania</div>
                                <div role="option" value="Algeria">Algeria</div>
                                <div role="option" value="Andorra">Andorra</div>
                                <div role="option" value="Angola">Angola</div>
                                <div role="option" value="Antigua and Barbuda">Antigua and Barbuda</div>
                                <div role="option" value="Argentina">Argentina</div>
                                <div role="option" value="Armenia">Armenia</div>
                                <div role="option" value="Australia">Australia</div>
                                <div role="option" value="Austria">Austria</div>
                                <div role="option" value="Azerbaijan">Azerbaijan</div>
                                <div role="option" value="Bahamas">Bahamas</div>
                                <div role="option" value="Bahrain">Bahrain</div>
                                <div role="option" value="Bangladesh">Bangladesh</div>
                                <div role="option" value="Barbados">Barbados</div>
                                <div role="option" value="Belarus">Belarus</div>
                                <div role="option" value="Belgium">Belgium</div>
                                <div role="option" value="Belize">Belize</div>
                                <div role="option" value="Benin">Benin</div>
                                <div role="option" value="Bhutan">Bhutan</div>
                                <div role="option" value="Bolivia">Bolivia</div>
                                <div role="option" value="Bosnia and Herzegovina">Bosnia and Herzegovina</div>
                                <div role="option" value="Botswana">Botswana</div>
                                <div role="option" value="Brazil">Brazil</div>
                                <div role="option" value="Brunei ">Brunei </div>
                                <div role="option" value="Bulgaria">Bulgaria</div>
                                <div role="option" value="Burkina Faso">Burkina Faso</div>
                                <div role="option" value="Burundi">Burundi</div>
                                <div role="option" value="Cabo Verde">Cabo Verde</div>
                                <div role="option" value="Cambodia">Cambodia</div>
                                <div role="option" value="Cameroon">Cameroon</div>
                                <div role="option" value="Canada">Canada</div>
                                <div role="option" value="Central African Republic">Central African Republic</div>
                                <div role="option" value="Chad">Chad</div>
                                <div role="option" value="Chile">Chile</div>
                                <div role="option" value="Colombia">Colombia</div>
                                <div role="option" value="Comoros">Comoros</div>
                                <div role="option" value="Congo">Congo</div>
                                <div role="option" value="Costa Rica">Costa Rica</div>
                                <div role="option" value="Croatia">Croatia</div>
                                <div role="option" value="Cyprus">Cyprus</div>
                                <div role="option" value="Czech Republic (Czechia)">Czech Republic (Czechia)</div>
                                <div role="option" value="Côte d'Ivoire">Côte d'Ivoire</div>
                                <div role="option" value="DR Congo">DR Congo</div>
                                <div role="option" value="Denmark">Denmark</div>
                                <div role="option" value="Djibouti">Djibouti</div>
                                <div role="option" value="Dominica">Dominica</div>
                                <div role="option" value="Dominican Republic">Dominican Republic</div>
                                <div role="option" value="Ecuador">Ecuador</div>
                                <div role="option" value="Egypt">Egypt</div>
                                <div role="option" value="El Salvador">El Salvador</div>
                                <div role="option" value="Equatorial Guinea">Equatorial Guinea</div>
                                <div role="option" value="Eritrea">Eritrea</div>
                                <div role="option" value="Estonia">Estonia</div>
                                <div role="option" value="Eswatini">Eswatini</div>
                                <div role="option" value="Ethiopia">Ethiopia</div>
                                <div role="option" value="Fiji">Fiji</div>
                                <div role="option" value="Finland">Finland</div>
                                <div role="option" value="France">France</div>
                                <div role="option" value="Gabon">Gabon</div>
                                <div role="option" value="Gambia">Gambia</div>
                                <div role="option" value="Georgia">Georgia</div>
                                <div role="option" value="Germany">Germany</div>
                                <div role="option" value="Ghana">Ghana</div>
                                <div role="option" value="Greece">Greece</div>
                                <div role="option" value="Grenada">Grenada</div>
                                <div role="option" value="Guatemala">Guatemala</div>
                                <div role="option" value="Guinea">Guinea</div>
                                <div role="option" value="Guinea-Bissau">Guinea-Bissau</div>
                                <div role="option" value="Guyana">Guyana</div>
                                <div role="option" value="Haiti">Haiti</div>
                                <div role="option" value="Holy See">Holy See</div>
                                <div role="option" value="Honduras">Honduras</div>
                                <div role="option" value="Hungary">Hungary</div>
                                <div role="option" value="Iceland">Iceland</div>
                                <div role="option" value="India">India</div>
                                <div role="option" value="Indonesia">Indonesia</div>
                                <div role="option" value="Iran">Iran</div>
                                <div role="option" value="Iraq">Iraq</div>
                                <div role="option" value="Ireland">Ireland</div>
                                <div role="option" value="Israel">Israel</div>
                                <div role="option" value="Italy">Italy</div>
                                <div role="option" value="Jamaica">Jamaica</div>
                                <div role="option" value="Japan">Japan</div>
                                <div role="option" value="Jordan">Jordan</div>
                                <div role="option" value="Kazakhstan">Kazakhstan</div>
                                <div role="option" value="Kenya">Kenya</div>
                                <div role="option" value="Kiribati">Kiribati</div>
                                <div role="option" value="Kuwait">Kuwait</div>
                                <div role="option" value="Kyrgyzstan">Kyrgyzstan</div>
                                <div role="option" value="Latvia">Latvia</div>
                                <div role="option" value="Lebanon">Lebanon</div>
                                <div role="option" value="Lesotho">Lesotho</div>
                                <div role="option" value="Liberia">Liberia</div>
                                <div role="option" value="Libya">Libya</div>
                                <div role="option" value="Liechtenstein">Liechtenstein</div>
                                <div role="option" value="Lithuania">Lithuania</div>
                                <div role="option" value="Luxembourg">Luxembourg</div>
                                <div role="option" value="Madagascar">Madagascar</div>
                                <div role="option" value="Malawi">Malawi</div>
                                <div role="option" value="Malaysia">Malaysia</div>
                                <div role="option" value="Maldives">Maldives</div>
                                <div role="option" value="Mali">Mali</div>
                                <div role="option" value="Malta">Malta</div>
                                <div role="option" value="Marshall Islands">Marshall Islands</div>
                                <div role="option" value="Mauritania">Mauritania</div>
                                <div role="option" value="Mauritius">Mauritius</div>
                                <div role="option" value="Mexico">Mexico</div>
                                <div role="option" value="Micronesia">Micronesia</div>
                                <div role="option" value="Moldova">Moldova</div>
                                <div role="option" value="Monaco">Monaco</div>
                                <div role="option" value="Mongolia">Mongolia</div>
                                <div role="option" value="Montenegro">Montenegro</div>
                                <div role="option" value="Morocco">Morocco</div>
                                <div role="option" value="Mozambique">Mozambique</div>
                                <div role="option" value="Myanmar">Myanmar</div>
                                <div role="option" value="Namibia">Namibia</div>
                                <div role="option" value="Nauru">Nauru</div>
                                <div role="option" value="Nepal">Nepal</div>
                                <div role="option" value="Netherlands">Netherlands</div>
                                <div role="option" value="New Zealand">New Zealand</div>
                                <div role="option" value="Nicaragua">Nicaragua</div>
                                <div role="option" value="Niger">Niger</div>
                                <div role="option" value="Nigeria">Nigeria</div>
                                <div role="option" value="North Macedonia">North Macedonia</div>
                                <div role="option" value="Norway">Norway</div>
                                <div role="option" value="Oman">Oman</div>
                                <div role="option" value="Pakistan">Pakistan</div>
                                <div role="option" value="Palau">Palau</div>
                                <div role="option" value="Panama">Panama</div>
                                <div role="option" value="Papua New Guinea">Papua New Guinea</div>
                                <div role="option" value="Paraguay">Paraguay</div>
                                <div role="option" value="Peru">Peru</div>
                                <div role="option" value="Philippines">Philippines</div>
                                <div role="option" value="Poland">Poland</div>
                                <div role="option" value="Portugal">Portugal</div>
                                <div role="option" value="Qatar">Qatar</div>
                                <div role="option" value="Romania">Romania</div>
                                <div role="option" value="Russia">Russia</div>
                                <div role="option" value="Rwanda">Rwanda</div>
                                <div role="option" value="Saint Kitts &amp; Nevis">Saint Kitts &amp; Nevis</div>
                                <div role="option" value="Saint Lucia">Saint Lucia</div>
                                <div role="option" value="Samoa">Samoa</div>
                                <div role="option" value="San Marino">San Marino</div>
                                <div role="option" value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</div>
                                <div role="option" value="Saudi Arabia">Saudi Arabia</div>
                                <div role="option" value="Senegal">Senegal</div>
                                <div role="option" value="Serbia">Serbia</div>
                                <div role="option" value="Seychelles">Seychelles</div>
                                <div role="option" value="Sierra Leone">Sierra Leone</div>
                                <div role="option" value="Singapore">Singapore</div>
                                <div role="option" value="Slovakia">Slovakia</div>
                                <div role="option" value="Slovenia">Slovenia</div>
                                <div role="option" value="Solomon Islands">Solomon Islands</div>
                                <div role="option" value="Somalia">Somalia</div>
                                <div role="option" value="South Africa">South Africa</div>
                                <div role="option" value="South Korea">South Korea</div>
                                <div role="option" value="South Sudan">South Sudan</div>
                                <div role="option" value="Spain">Spain</div>
                                <div role="option" value="Sri Lanka">Sri Lanka</div>
                                <div role="option" value="St. Vincent &amp; Grenadines">St. Vincent &amp; Grenadines
                                </div>
                                <div role="option" value="State of Palestine">State of Palestine</div>
                                <div role="option" value="Sudan">Sudan</div>
                                <div role="option" value="Suriname">Suriname</div>
                                <div role="option" value="Sweden">Sweden</div>
                                <div role="option" value="Switzerland">Switzerland</div>
                                <div role="option" value="Syria">Syria</div>
                                <div role="option" value="Tajikistan">Tajikistan</div>
                                <div role="option" value="Tanzania">Tanzania</div>
                                <div role="option" value="Thailand">Thailand</div>
                                <div role="option" value="Timor-Leste">Timor-Leste</div>
                                <div role="option" value="Togo">Togo</div>
                                <div role="option" value="Tonga">Tonga</div>
                                <div role="option" value="Trinidad and Tobago">Trinidad and Tobago</div>
                                <div role="option" value="Tunisia">Tunisia</div>
                                <div role="option" value="Turkey">Turkey</div>
                                <div role="option" value="Turkmenistan">Turkmenistan</div>
                                <div role="option" value="Tuvalu">Tuvalu</div>
                                <div role="option" value="Uganda">Uganda</div>
                                <div role="option" value="Ukraine">Ukraine</div>
                                <div role="option" value="United Arab Emirates">United Arab Emirates</div>
                                <div role="option" value="United Kingdom">United Kingdom</div>
                                <div role="option" value="United States">United States</div>
                                <div role="option" value="Uruguay">Uruguay</div>
                                <div role="option" value="Uzbekistan">Uzbekistan</div>
                                <div role="option" value="Vanuatu">Vanuatu</div>
                                <div role="option" value="Venezuela">Venezuela</div>
                                <div role="option" value="Yemen">Yemen</div>
                                <div role="option" value="Zambia">Zambia</div>
                                <div role="option" value="Zimbabwe">Zimbabwe</div>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </form>

        <h2>Example 2: Using HTML5 datalist</h2>

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
            <datalist role="listbox" id="languages">
                <option id="Apple" value="Apple">Apple</option>
                <option id="Artichoke" value="Artichoke">Artichoke</option>
                <option id="Asparagus" value="Asparagus">Asparagus</option>
                <option id="Banana" value="Banana">Banana</option>
                <option id="Beets" value="Beets">Beets</option>
                <option id="Bell pepper" value="Bell pepper">Bell pepper</option>
                <option id="Broccoli" value="Broccoli">Broccoli</option>
                <option id="Brussels sprout" value="Brussels sprout">
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
                <option id="Honeydew melon" value="Honeydew melon">
                    Honeydew melon
                </option>
                <option id="Iceberg lettuce" value="Iceberg lettuce">
                    Iceberg lettuce
                </option>
                <option id="Jerusalem artichoke" value="Jerusalem artichoke">
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
                <option id="Sweet potato" value="Sweet potato">Sweet potato</option>
                <option id="Tomato" value="Tomato">Tomato</option>
                <option id="Turnip" value="Turnip">Turnip</option>
                <option id="Ugli fruit" value="Ugli fruit">Ugli fruit</option>
                <option id="Victoria plum" value="Victoria plum">
                    Victoria plum
                </option>
                <option id="Watercress" value="Watercress">Watercress</option>
                <option id="Watermelon" value="Watermelon">Watermelon</option>
                <option id="Yam" value="Yam">Yam</option>
                <option id="Zucchi" value="Zucchi">Zucchi</option>
            </datalist>
        </form>


        <script src="js/accessibility.js"></script>
        <script src="js/combobox__improved.js"></script>
        <?php include "includes/example-footer.php" ?>
    </main>

</body>

</html>