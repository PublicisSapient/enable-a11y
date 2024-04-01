<!-- File WIP -->

<div id="example1">
    <div class="enable-visible-on-focus__container enable-skip-link--begin">
        <a href="#main-nav-link" id="top-of-page" class="enable-visible-on-focus enable-skip-link">
            Skip to main navigation at the bottom of page
        </a>
    </div>
</div>

            <!-- <aside class="notes">
                <p>
                    Instagram's main navigation menu is at the bottom of the screen.  It is 
                    extremely hard for screen reader users to discover it when just swiping through
                    interactive elements. To solve this, I have used my
                    <a href="38-visible-on-focus">mobile friendly skip links</a> to address this
                    issue by making it discoverable at the very beginning of the page.
                </p>
            </aside> -->

            


            <?php includeShowcode("example1"); ?>

            <script type="application/json" id="example1-props">
            {
                "replaceHtmlRules": {
                    "main": "<!-- main content here -->",
                    ".bottom-fixed-nav__list": "<!-- navigation list HTML here -->"
                },
                "steps": [{
                    "label": "Make the two skip links point to each other",
                    "highlight": "%OPENCLOSECONTENTTAG%div",
                    "notes": "These two skip links point to each other.  In order to understand how the CSS and JS works, please take a look at our <a href=\"38-visible-on-focus.php\">Visible of Focus skip link example</a>"
                }]
            }
            </script>



        