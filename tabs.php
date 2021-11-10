<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    <title>Accessible Tabs Examples</title>
    <?php include "includes/common-head-tags.php";?>

    <link class="example-stylesheet" rel="stylesheet" type="text/css" href="css/tabs.css" />
    

</head>

<body>

    <?php include "includes/documentation-header.php";?>

    <main>

        <h1>Accessible Tabs Examples</h1>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The style of this page was stolen from <a
                        href="http://simplyaccessible.com/article/danger-aria-tabs/">Danger! ARIA tabs</a>, written by
                    <a href="http://simplyaccessible.com/article/author/jeffsmith/">Jeff Smith</a>.  However, that article
                    describes a very different method for a tab interface which is not based on ARIA at all.</li>
                <li>When keyboard users focus to the tablist, they will tab into the active tab. They can then use the arrow keys to cycle through the tabs.</li>
                <li>Only keyboard users will see keyboard instructions when they focus into the tablist. Mouse users will
                    not.</li>
                <li>Screen reader users will hear the instructions when they focus on the tabs as well.</li>
            </ul>
        </aside>




        <h2>ARIA Tab Example</h2>

        <div id="example1" class="enable-example">

            <div id="tabs">

                <!-- Instructions for keyboard users -->
                <div class="sr-only tabs__instructions" id="tabs-keyboard-only-instructions">
                    Use arrow keys to choose tabs. Content for the chosen tab will be revealed below.
                </div>
                <!-- Here are the tabs -->
                <ul 
                    class="enable-tablist"
                    data-keyboard-only-instructions="tabs-keyboard-only-instructions">
                    <li>
                        <a
                            href="#heading__jamaican-ska"
                            class="enable-tab"
                            data-owns="tabpanel__jamaican-ska"
                        >
                            Jamaican Ska
                        </a>
                    </li>
                    <li>
                        <a 
                            href="#heading__two-tone"
                            class="enable-tab"
                            data-owns="tabpanel__two-tone"
                        >
                            2 Tone
                        </a>
                    </li>
                    <li>
                        <a
                            href="#heading__third-wave"
                            class="enable-tab"
                            data-owns="tabpanel__third-wave"
                        >
                            Third Wave
                        </a>
                    </li>
                </ul>
                <div
                    class="enable-tabpanel"
                    id="tabpanel__jamaican-ska"
                >
                    <h2 tabindex="-1" id="heading__jamaican-ska">Jamaican Ska</h2>

                    <div class="tab__content">
                        <p>Ska's origins are from 1960s Jamaica. One theory about the origin of ska is that Prince
                        Buster created it during the inaugural recording session for his new record label Wild Bells.</p>

                        <p>Artists include:</p>
                        <ol>
                            <li>The Skatellites</li>
                            <li>Prince Buster</li>
                            <li>Desmond Dekker</li>
                            <li>Millie Small</li>
                            <li>Byron Lee and the Dragonaires</li>
                            <li>Laurel Aitken</li>
                            <li>The Wailers</li>
                            <li>Jimmy Cliff</li>
                            <li>Eric "Monty" Morris</li>
                        </ol>

                        <a href="https://jamaicansmusic.com/learn/origins/ska">More information about Jamaican Ska</a>
                    </div>
                </div>
                <div
                    class="enable-tabpanel"
                    id="tabpanel__two-tone"
                >
                  <h2 tabindex="-1" id="heading__two-tone">2 Tone Ska</h2>
                    <div class="tab__content">

                        <p>The 2 Tone genre, which began in the late 1970s in the Coventry area of UK, was a fusion of Jamaican ska rhythms and melodies with punk rock's more aggressive guitar chords and lyrics.[24] Compared to 1960s ska, 2 Tone music had faster tempos, fuller instrumentation, and a harder edge. The genre was named after 2 Tone Records, a record label founded by Jerry Dammers of The Specials.</p>

                        <p>Artists include:</p>
                        <ol>
                            <li>The Specials</li>
                            <li>Madness</li>
                            <li>Bad Manners</li>
                            <li>The Selector</li>
                            <li>The Beat (a.k.a. "The English Beat" in the U.S.)</li>
                            <li>The Body Snatchers</li>
                            <li>Akrylykz</li>
                        </ol>

                        <a href="https://www.theguardian.com/music/2021/apr/30/a-blur-of-legs-arms-and-adrenaline-the-astonishing-history-of-two-tone">More information about 2 Tone Ska</a>
                    </div>
                </div>
                <div
                    class="enable-tabpanel"
                    id="tabpanel__third-wave"
                >
                    <h2 tabindex="-1" id="heading__third-wave">Third Wave</h2>
                    <div class="tab__content">

                        <p>Third-wave ska originated in the punk scene in the late 1980s and became commercially successful in the 1990s. Although some third-wave ska has a traditional 1960s sound, most third-wave ska is characterized by dominating guitar riffs and large horn sections.</p>

                        <ol>
                            <li>The Toasters</li>
                            <li>Fishbone</li>
                            <li>No Doubt</li>
                            <li>The Mighty Mighty Bosstones</li>
                            <li>Streetlight Manifesto</li>
                            <li>The Hotknives</li>
                            <li>Hepcat</li>
                            <li>The Slackers</li>
                            <li>Sublime</li>
                            <li>Suicide Machines</li>
                            <li>Voodoo Glow Skulls</li>
                            <li>Reel Big Fish</li>
                            <li>Less Than Jake</li>
                            <li>Bim Skala Bim</li>
                        </ol>

                        <a href="https://en.wikipedia.org/wiki/Ska#Third_wave_ska">More information about Third Wave Ska</a>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            const originalHTMLExample1 = document.getElementById('example1').innerHTML;
        </script>       

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {
                ".tab__content": "<!-- insert tab panel content here -->",
                "[role=\"tab\"]": "<!-- insert tab label here -->"
            },
            "steps": [
                {
                    "label": "Create basic DOM for users without JavaScript",
                    "highlight": "%JSHTML%originalHTMLExample1~href",
                    "notes": "This is a basic list of links that answer to the headings of what will be the tabpanels when the Javascript is executed.  Users who don't load the JavaScript (because of a network error or because they elected not to load it) will get this usable HTML.  Note that these links will "
                },
                {
                    "label": "Ensure classes are set up so roles will be assigned for JavaScript users",
                    "highlight": "%JSHTML%originalHTMLExample1~class=\"enable-tablist\" ||| class=\"enable-tab\" ||| class=\"enable-tabpanel\"",
                    "notes": "This is a basic list of links that answer to the headings of what will be the tabpanels when the Javascript is executed.  Users who don't load the JavaScript (because of a network error or because they elected not to load it) will get this usable HTML.  Note that these links will "
                },
                {
                    "label": "Use data-owns to connect tabs with their tabpanel",
                    "highlight": "%JSHTML%originalHTMLExample1~data-owns",
                    "notes": "This will be used by the JavaScript code to connect the tab with the tabpanel using aria-owns"
                },
                {
                    "label": "Your JavaScript should place ARIA roles in document",
                    "highlight": "role=\"tablist\" ||| role=\"presentation\" ||| role=\"tab\" ||| role=\"tabpanel\"",
                    "notes": "JavaScript should assign these roles to non-JavaScript users that user screen readers don't get these roles.  Note that <strong>tabs</strong> should be a direct child of the <strong>tablist</strong>. If this is not possible, then all the nodes in between them should have a role of <strong>presentation</strong>."
                },
                {
                    "label": "Your JavaScript should connect tabs to tabpanels",
                    "highlight": "aria-owns",
                    "notes": "Each <strong>tab</strong> must have an <strong>aria-owns</strong> attribute that corresponds to its <strong>tabpanel</strong>."
                },
                {
                    "label": "Your JavaScript should apply aria-selected values are set correctly",
                    "highlight": "aria-selected",
                    "notes": "When a tab is selected, its <strong>aria-selected</strong> attribute must be set to <strong>true</strong>, while all the other tabs must have it set to <strong>false</strong>"
                },
                {
                    "label": "Your JavaScript should ensure only the selected tab is accessible via tab key",
                    "highlight": "tabindex=\"-1\"",
                    "notes": "In order switch tabs with the arrow keys, all tabs that have <strong>aria-selected=\"false\"</strong> must also have <strong>tabindex=\"-1\"</strong> set as well."
                },
                {
                    "label": "Your JavaScript should use aria-describedby to give keyboard instructions when user focuses on tabs",
                    "highlight": "aria-describedby",
                    "notes": "This gives screen reader users instructions how to use the tabs when they navigate into them via keyboard"
                },
                {
                    "label": "Set up JavaScript that activates the tabs when they have keyboard focus",
                    "highlight": "%JS% tabgroup",
                    "notes": ""
                }
            ]
        }
        </script>



        
    </main>

    <div id="scripts">
        <script src="js/accessibility.js"></script>
        <script src="js/tabs.js"></script>
    </div>

    <?php include "includes/example-footer.php"?>
</body>

</html>