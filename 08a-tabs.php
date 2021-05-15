<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    <title>Accessible Tabs Examples</title>
    <?php include "includes/common-head-tags.php";?>

    <link class="example-stylesheet" rel="stylesheet" type="text/css" href="css/tabs.css" />
    <meta charset="utf-8" />

</head>

<body>

    <?php include "includes/example-header.php";?>

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




        <h2>Top rated craft beers</h2>

        <div id="example1">

            <!-- Instructions for keyboard users -->
            <div class="sr-only tabs__instructions" id="tabs-keyboard-only-instructions">
                Use arrow keys to choose tabs. Content will be displayed below.
            </div>
            <div id="tabs">

                <!-- Here are the tabs -->
                <ul role="tablist" aria-describedby="tabs-keyboard-only-instructions"
                    data-keyboard-only-instructions="tabs-keyboard-only-instructions">
                    <li role="presentation">
                        <a
                            href="#"
                            role="tab"
                            aria-owns="jamaican-ska-tabpanel"
                            aria-describedby="tabs-keyboard-only-instructions"
                        >
                            Jamaican Ska
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#" role="tab" aria-owns="two-tone-tabpanel"
                            aria-describedby="tabs-keyboard-only-instructions">2 Tone</a>
                    </li>
                    <li role="presentation">
                        <a href="#" role="tab" aria-owns="third-wave-tabpanel"
                            aria-describedby="tabs-keyboard-only-instructions">Third Wave</a>
                    </li>
                </ul>
                <div role="tabpanel" id="jamaican-ska-tabpanel">
                    <h2 id="ipa">Jamaican Ska</h2>

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
                <div role="tabpanel" id="two-tone-tabpanel">
                    <h2 id="gueuze">2 Tone Ska</h2>

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
                <div role="tabpanel" id="third-wave-tabpanel">
                    <h2 id="imperial-stout">Third Wave</h2>

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

                    <a href="https://en.wikipedia.org/wiki/imperial_stout">More information about Imperial Stouts</a>
                </div>
            </div>
        </div>

        <h3 class="showcode__heading">Example code explanation</h3>

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {
                "[role=\"tabpanel\"]": "<!-- insert tab panel content here -->",
                "[role=\"tab\"]": "<!-- insert tab label here -->"
            },
            "steps": [
                {
                    "label": "Place ARIA roles in document",
                    "highlight": "role=\"tablist\" ||| role=\"presentation\" ||| role=\"tab\" ||| role=\"tabpanel\"",
                    "notes": "Note that <strong>tabs</strong> should be a direct child of the <strong>tablist</strong>. If this is not possible, then all the nodes in between them should have a role of <strong>presentation</strong>."
                },
                {
                    "label": "Connect tabs to tabpanels",
                    "highlight": "aria-owns",
                    "notes": "Each <strong>tab</strong> must have an <strong>aria-owns</strong> attribute that corresponds to its <strong>tabpanel</strong>."
                },
                {
                    "label": "Ensure aria-selected values are set correctly",
                    "highlight": "aria-selected",
                    "notes": "When a tab is selected, its <strong>aria-selected</strong> attribute must be set to <strong>true</strong>, while all the other tabs must have it set to <strong>false</strong>"
                },
                {
                    "label": "Ensure only the selected tab is accessible via tab key",
                    "highlight": "tabindex=\"-1\"",
                    "notes": "In order switch tabs with the arrow keys, all tabs that have <strong>aria-selected=\"false\"</strong> must also have <strong>tabindex=\"-1\"</strong> set as well."
                },
                {
                    "label": "Code keyboard instructions when user focuses on tabs",
                    "highlight": "aria-describedby",
                    "notes": "This gives screen reader users instructions how to use the tabs when they navigate into them via keyboard"
                },
                {
                    "label": "Set up JavaScript that activates the tabs onclick",
                    "highlight": "%JS% tabgroup",
                    "notes": ""
                }
            ]
        }
        </script>



        <div id="scripts">
            <script src="js/accessibility-es4.js"></script>
            <script src="js/tabs.js"></script>
        </div>

        <?php include "includes/example-footer.php"?>
    </main>
</body>

</html>