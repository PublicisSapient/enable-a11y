<!DOCTYPE html>
<html>

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    <title>Accessible Tabs Examples</title>
    <?php include("includes/common-head-tags.php"); ?>

    <link class="example-stylesheet" rel="stylesheet" type="text/css" href="css/tabs.css" />
    <meta charset="utf-8" />

</head>

<body>

    <?php include("includes/example-header.php"); ?>

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
            <div class="visually-hidden tabs__instructions" id="tabs-keyboard-only-instructions">
                Use arrow keys to choose tabs. Content will be displayed below.
            </div>
            <div id="tabs">

                <!-- Here are the tabs -->
                <ul role="tablist" aria-describedby="tabs-keyboard-only-instructions"
                    data-keyboard-only-instructions="tabs-keyboard-only-instructions">
                    <li role="presentation">
                        <a
                            href="#ipa"
                            role="tab"
                            aria-owns="ipa-tabpanel"
                            aria-describedby="tabs-keyboard-only-instructions"
                        >
                            IPA
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#gueuze" role="tab" aria-owns="gueuze-tabpanel"
                            aria-describedby="tabs-keyboard-only-instructions">Gueuze</a>
                    </li>
                    <li role="presentation">
                        <a href="#imperial-stout" role="tab" aria-owns="imperial-stout-tabpanel"
                            aria-describedby="tabs-keyboard-only-instructions">Imperial Stout</a>
                    </li>
                </ul>
                <div role="tabpanel" id="ipa-tabpanel">
                    <h2 id="ipa">India Pale Ale (IPA)</h2>
                    <ol>
                        <li><strong>Hill Farmstead:</strong> Susan</li>
                        <li><strong>Trillium:</strong> Melcher Street - Double Dry Hopped</li>
                        <li><strong>Tree House:</strong> Julius</li>
                        <li><strong>AleSmith:</strong> IPA</li>
                        <li><strong>Alchemist:</strong> Focal Banger</li>
                        <li><strong>Grassroots:</strong> Legitimacy</li>
                        <li><strong>Tree House:</strong> Alter Ego</li>
                        <li><strong>Bells:</strong> Two Hearted Ale</li>
                        <li><strong>New England:</strong> Fuzzy Baby Ducks IPA</li>
                        <li><strong>Ballast Point:</strong> Sculpin IPA</li>
                    </ol>

                    <a href="https://en.wikipedia.org/wiki/India_pale_ale">More information about India Pale Ale</a>
                </div>
                <div role="tabpanel" id="gueuze-tabpanel">
                    <h2 id="gueuze">Gueuze</h2>
                    <ol>
                        <li><strong>3 Fonteinen:</strong> Zenne y Frontera</li>
                        <li><strong>3 Fonteinen:</strong> Oude Geuze Vintage</li>
                        <li><strong>3 Fonteinen:</strong> Oude Geuze Golden Blend</li>
                        <li><strong>Bullfrog:</strong> Le Roar Grrrz</li>
                        <li><strong>Oude (Gueuze Tilquin):</strong> à l’Ancienne</li>
                        <li><strong>Girardin:</strong> Gueuze Black Label</li>
                        <li><strong>Cantillon:</strong> 50°N-4°E</li>
                        <li><strong>3 Fonteinen:</strong> Oude Geuze</li>
                        <li><strong>Cantillon:</strong> Lou Pepe Gueuze</li>
                        <li><strong>Lindemans:</strong> Oude Gueuze Cuvée René Special Blend 2010</li>
                    </ol>

                    <a href="https://en.wikipedia.org/wiki/gueuze">More information about Gueuze type beers</a>
                </div>
                <div role="tabpanel" id="imperial-stout-tabpanel">
                    <h2 id="imperial-stout">Imperial Stout</h2>
                    <ol>
                        <li><strong>Toppling Goliath:</strong> Mornin’ Delight</li>
                        <li><strong>Three Floyds:</strong> Dark Lord Russian Imperial Stout (Bourbon Barrel Aged)</li>
                        <li><strong>AleSmith:</strong> Speedway Stout - Bourbon Barrel Aged</li>
                        <li><strong>Three Floyds:</strong> Dark Lord Russian Imperial Stout (Bourbon Vanilla Bean)</li>
                        <li><strong>Founders:</strong> Backstage Series # 2: CBS (Canadian Breakfast Stout)</li>
                        <li><strong>AleSmith:</strong> Speedway Stout</li>
                        <li><strong>Cigar City:</strong> Hunahpu’s Imperial Stout</li>
                        <li><strong>Bells:</strong> Expedition Stout</li>
                        <li><strong>Three Floyds:</strong> Dark Lord Russian Imperial Stout</li>
                        <li><strong>Founders:</strong> KBS (Kentucky Breakfast Stout)</li>
                    </ol>

                    <a href="https://en.wikipedia.org/wiki/imperial_stout">More information about Imperial Stouts</a>
                </div>
            </div>
        </div>

        <h3>Example code explanation</h3>

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
                    "hilite": "role=\"tablist\",role=\"presentation\",role=\"tab\",role=\"tabpanel\"",
                    "notes": "Note that <strong>tabs</strong> should be a direct child of the <strong>tablist</strong>. If this is not possible, then all the nodes in between them should have a role of <strong>presentation</strong>."
                },
                {
                    "label": "Connect tabs to tabpanels",
                    "hilite": "aria-owns",
                    "notes": "Each <strong>tab</strong> must have an <strong>aria-owns</strong> attribute that corresponds to its <strong>tabpanel</strong>."
                },
                {
                    "label": "Ensure aria-selected values are set correctly",
                    "hilite": "aria-selected",
                    "notes": "When a tab is selected, its <strong>aria-selected</strong> attribute must be set to <strong>true</strong>, while all the other tabs must have it set to <strong>false</strong>"
                },
                {
                    "label": "Ensure only the selected tab is accessible via tab key",
                    "hilite": "tabindex=\"-1\"",
                    "notes": "In order switch tabs with the arrow keys, all tabs that have <strong>aria-selected=\"false\"</strong> must also have <strong>tabindex=\"-1\"</strong> set as well."
                },
                {
                    "label": "Code keyboard instructions when user focuses on tabs",
                    "hilite": "aria-describedby",
                    "notes": "This gives screen reader users instructions how to use the tabs when they navigate into them via keyboard"
                }
            ]
        }
        </script>



        <div id="scripts">
            <script src="js/accessibility-es4.js"></script>
            <script src="js/tabs.js"></script>
        </div>

        <?php include "includes/example-footer.php" ?>
    </main>
</body>

</html>