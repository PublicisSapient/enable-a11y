
    

        <aside class="notes">

            <h2>Notes</h2>

            <ul>
                <li>Both HTML and ARIA role work that same in NVDA and Voiceover.</li>
            </ul>
        </aside>

        


        <p>Code based on that from
            <a href="http://pauljadam.com/demos/img.html">Paul J Adam's img role demo</a>.</p>


        <h2>HTML5 img tag</h2>
        <div id="html5-example" class="enable-example">
            <img src="images/card_icons.png" width="100" height="94" alt="Debit, Visa, MasterCard, American Express, Discover Network"
            >
        </div>

        <?php includeShowcode("html5-example")?>
        <script type="application/json" id="html5-example-props">
        {
            "replaceHtmlRules": {
            },
            "steps": [
            {
             "label": "Add an alt attribute",
             "highlight": "alt",
             "notes": "You must <strong>always</strong> have an alt attribute that is meaningful. If your image is decorative, see the next example."
            } 
        ]}
        </script>

        <h2>Decorative Image</h2>

        <p>
            A decorative image is an image that is used to enhance an idea presented in text,
            but is not necessary to understand it.  Icons around navigation items and error icons,
            around error text are perfect examples.
        </p>

        <div id="decorative-example" class="enable-example decorative-example">
            <img class="decorative-example__icon" src="images/bomb.png" alt="" >
            <p><strong>You made an error.</strong></p>
            <p>Please back away from the keyboard to avoid any further damage.</p>
        </div>

        <?php includeShowcode("decorative-example")?>
        <script type="application/json" id="decorative-example-props">
        {
            "replaceHtmlRules": {
            },
            "steps": [
            {
             "label": "Use a blank alt attribute",
             "highlight": "alt",
             "notes": "Note that not including an alt attribute is not an alternative to a blank alt attribute. The alt attribute must always be included."
            }
        ]}
        </script>


        <h2>ARIA Example</h2>
        <div id="aria-example" class="enable-example clearfix">
            <div class="sprite card_icons amex" role="img" aria-label="American Express"></div>
            <div class="sprite card_icons discover" role="img" aria-label="Discover Network"></div>
            <div class="sprite card_icons visa" role="img" aria-label="Visa"></div>
            <div class="sprite card_icons master" role="img" aria-label="MasterCard"></div>
        </div>
        <?php includeShowcode("aria-example")?>
        <script type="application/json" id="aria-example-props">
        {
            "replaceHtmlRules": {
            },
            "steps": [
            {
                "label": "Use role of img",
                "highlight": "role",
                "notes": "This is perfect when you are using background images and image sprites."
            },
            {
                "label": "Put alt text inside the aria-label of the img element",
                "highlight": "aria-label",
                "notes": "Does the same thing as <code>alt</code> in the HTML5 version.  If decorative, use <code>aria-label=\"\"</code>"
            }
        ]}
        </script>

       

        <h2>Inline SVG example with text markup</h2>
        <div id="inline-svg-example" class="enable-example">
            <svg width="200" height="163" role="img" aria-labelledby="circle-alt svg-text">
                <title id="circle-alt">A dark blue circle with text inside</title>
                
                <rect x="0" y="0" width="200" height="163" fill="#ffffff" fill-opacity="1"></rect>
                <circle cx="81" cy="85" r="75" fill="#00a" stroke="#000" stroke-width="1"></circle>
                <text id="svg-text" x="81" y="85" font-size="14px" text-anchor="middle" fill="#fff">
                    I am text in a circle
                </text>
            </svg>
        </div>

        <?php includeShowcode("inline-svg-example")?>
        <script type="application/json" id="inline-svg-example-props">
        {
            "replaceHtmlRules": {
            },
            "steps": [
            {
                "label": "Add a role of img",
                "highlight": "role",
                "notes": "Just like the previous example"
            },
            {
                "label": "Add aria-labelledby",
                "highlight": "aria-labelledby",
                "notes": "Note that aria-labelledby points to both the <code>title</code> and <code>text</code> tags. Screen readers will read both."
            }
        ]}
        </script>
    