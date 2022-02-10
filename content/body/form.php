
    

        <!-- <aside class="notes">
            <h2>Notes</h2>
            <ul>

                <li>These examples are from
                    <a                         href="https://www.w3.org/TR/2017/NOTE-wai-aria-practices-1.1-20171214/examples/landmarks/form.html">the
                        W3C's ARIA Form Landmarks Example</a>.
                </li>

                
                <li>Use the HTML5 form tag whenever you can. You will make your application
                    a lot more usable for things beyond accessibility:
                    <ol>
                        <li>JavaScript
                            <code>document.forms</code> support.
                        </li>
                        <li>Progressive enhancement.</li>
                        <li>Built in HTML5 validation and pattern checking.</li>
                        <li>
                            <a href="https://en.wikipedia.org/wiki/Tim_Berners-Lee">The God of the Web</a> built it the
                            right way the first time.
                        </li>
                    </ol>
                </li>
            </ul>
        </aside> -->


        



        <h2 id="html5" tabindex="-1">HTML5 example</h2>

        <div id="example1">
            <form>
                <fieldset>
                    <legend id="contact_html5">Contact Information</legend>

                    <label for="name_html5">Name: </label>
                    <input id="name_html5" size="25" type="text">

                    <label for="email_html5">E-mail: </label>
                    <input id="email_html5" size="25" type="text">

                    <label for="phone_html5">Phone: </label>
                    <input id="phone_html5" size="25" type="text">

                    <input value="Add Contact" type="submit">

                </fieldset>
            </form>
        </div>

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Insert form tag",
                    "highlight": "\\s*&lt;[\/]?form&gt;",
                    "notes": "Whenever you have form elements, include this tag.  It does a lot of things for you that you may not even be aware of."
                },
                {
                    "label": "Insert fieldset and legend",
                    "highlight": "\\s*&lt;[\/]?fieldset&gt; ||| \\s*&lt;legend[\\s\\S]*&gt;[\\s\\S]*&lt;/legend&gt;",
                    "notes": "The <strong>legend</strong> tag must be a direct child of the <strong>fieldset</strong> tag in order for it to work across screen readers."
                }
            ]
        }
        </script>

        <h2 id="aria" tabindex="-1">ARIA form role example (with ARIA used to replace fieldset and legend as well)</h2>

        <div id="example2">
            <div role="form">
                <div role="group" aria-labelledby="contact-aria" class="fieldset aria-form-group">
                    <div id="contact-aria" class="legend">Contact Information</div>

                    <label for="name">Name: </label>
                    <input id="name" size="25" type="text">

                    <label for="email">E-mail: </label>
                    <input id="email" size="25" type="text">

                    <label for="phone">Phone: </label>
                    <input id="phone" size="25" type="text">

                    <input value="Add Contact" type="submit">

                </div>
            </div>
        </div>

        <?php includeShowcode("example2")?>

        <script type="application/json" id="example2-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Insert form tag",
                    "highlight": "\\s*&lt;[\/]?div role=\"form\"&gt;",
                    "notes": "Whenever you have form elements, include this tag.  It does a lot of things for you that you may not even be aware of."
                },
                {
                    "label": "Insert group role to minic native HTML fieldset",
                    "highlight": "role=\"group\"",
                    "notes": ""
                },
                {
                    "label": "Add aria-labelledby to element with group role",
                    "highlight": "aria-labelledby",
                    "notes": [
                        "This ensures that what the aria-labelledby attribute points to acts as a legend for the fieldset.",
                        "Unlike a HTML example, the label does not have to be a direct child to the group element (which acts as a fieldset)."
                    ]
                }
            ]
        }
        </script>

        <h2>Search Form</h2>

        <div id="search-example">
        <form role="search" >
            <div class="search">
                <label for="search-input" class="sr-only">Search:</label>
                <input id="search-input" type="text" class="search__term" placeholder="What are you looking for?">
                <button type="submit" class="search__button">
                    <img class="search__icon" src="images/search.svg" alt="Search" >
                </button>
            </div>
        </form>
    </div>

        <?php includeShowcode("search-example")?>

        <script type="application/json" id="search-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [
                {
                    "label": "Add role of search to the form tag",
                    "highlight": "role=\"search\"",
                    "notes": "Adding this role makes this form easily found by screen reader users who skim through the page (e.g. via the Rotor in VoiceOver, or the Elements List of NVDA)"
                },
                {
                    "label": "Add label for screen reader users",
                    "highlight": "%OPENCLOSECONTENTTAG%label",
                    "notes": "Since there is a search icon on this form, it can be argued that this label can be hidden visually with the <code>sr-only</code>."
                },
                {
                    "label": "Ensure sizing of the form elements and the icons use relative units",
                    "highlight": "%CSS%search-css~",
                    "notes": "In order for the input fields and the icon to grow when using the browsers \"Resize Text\" functionality, it is important to use relative units, such as <code>rem</code> or <code>em</code>, when setting their widths and heights instead of absolute units, such as <code>px</code>.  In Enable, we <a href=\"https://codepen.io/janogarcia/pen/bNrKEP\">use LESS to convert px units to rem using this very simple method by Jano Garcia</a>."
                }
            ]
        }
    </script>



    