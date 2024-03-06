
    

        <!-- <aside class="notes">

            <h2>Notes</h2>

            <ul>
                <li>Both HTML and ARIA role work that same in NVDA and Voiceover.</li>
            </ul>
        </aside> -->

        
        <p>
            When the HTML <code>&lt;img&gt;</code> tag was first supported the NCSA Mosaic web browser by Marc Andreeson in 1993, it changed the World Wide Web from a text-only to a multimedia platform.  Other browsers that couldn't render images (like the terminal based Lynx web browser) needed a fallback so that users of their browsers could show something meaningful instead of images. Tony Johnson, the creator of the Midas web browser, requested a text altenative that could be used, and eventually that became the <code>alt</code> attribute.
        </p>

        <p>
            "Alt text" not only is great for accessibility, it's also good to make your images come up in search engines.  Good "alt text" handles both use cases well.
        </p>

        <p>
            Creating accessible alternative text is a discussion on itself.  <a href="https://webaim.org">WebAIM</a> has a great introductory article about <a href="https://webaim.org/techniques/alttext/">Alternative Text</a> that is highly recommended.  I also recommend <a href="https://www.scottohara.me/">Scott O'Hara's</a> in depth article <a href="https://www.scottohara.me/blog/2019/05/22/contextual-images-svgs-and-a11y.html">Contextually Marking up accessible images and SVGs</a>.
        </p>


        <h2>HTML5 img tag</h2>

        <?php includeStats(array('isForNewBuilds' => true)) ?>

        <p>
            The easiest way to add images to a web page.
        </p>

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

        <?php includeStats(array('isStyle' => false, 'comment' => 'Important if the image has the same information available in the surrounding text.')) ?>

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

        <p>There are many sites that include images using the CSS <code>background-image</code> or <code>background</code> properties.  Unless these images are decorative, we need to include alternative text as a fallback for these images as well.  This can be done using <code>aria-label</code> with the <code>img</code> role.
        </p>

        <p>Note that developers should use <code>&lt;img&gt;</code> tags wherever possible instead of this method.  Not only is it better for SEO, but also for text based browsers as well.</p>

        <p>The code in this example is based on that from
            <a href="http://pauljadam.com/demos/img.html">Paul J Adam's img role demo</a>.</p>




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

        <?php includeStats(array('isForNewBuilds' => true, 'comment' => 'These rules should always be applied to all inline SVG images.')) ?>

        <p>
            Although using the <code>&lt;img&gt;</code> tag is the best way to include an SVG into your web page (it's cachable, the markup is less heavy, etc.), it is sometimes desirable to include the image inline (especially if you are making it interactive via JavaScript).  Follow the instructions below if you want your inline SVGs to be accessible.
        </p>

        <div id="inline-svg-example" class="enable-example">
            <svg width="200" height="163" role="img" aria-labelledby="circle-alt svg-text" focusable="false">
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
                "label": "Add focusable=\"false\" to the SVG tag",
                "highlight": "focusable",
                "notes": "This is so some browsers (e.g. Internet Explorer) don't add the image to the focus order of the document."
            },
            {
                "label": "Add aria-labelledby",
                "highlight": "aria-labelledby",
                "notes": "Note that aria-labelledby points to both the <code>title</code> and <code>text</code> tags. Screen readers will read both."
            }
        ]}
        </script>
    