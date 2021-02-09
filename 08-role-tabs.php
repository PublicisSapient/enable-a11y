<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Accessible Tabs Examples</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/role-tabs.css" />

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
</head>

<body>

    <?php include("includes/example-header.php"); ?>

    <main>

        <aside class="notes">

            <h2>Notes:</h2>

            <ul>
                <li>This example is originally from
                    <a href="http://simplyaccessible.com/article/danger-aria-tabs/">Danger! ARIA tabs</a>, written by
                    <a href="http://simplyaccessible.com/article/author/jeffsmith/">Jeff Smith</a>.</li>
                <li>To change tabs, use the arrow keys to change tabs (for Safari, you will need to do CONTROL-COMMAND with the arrrow keys)</li>
            </ul>
        </aside>

        <h1>Accessible Tabs Examples</h1>



        <h2>Top rated craft beers</h2>
        <div id="tabs">
            <ul>
                <li>
                    <a href="#ipa">India Pale Ale (IPA)</a>
                </li>
                <li>
                    <a href="#gueuze">Gueuze</a>
                </li>
                <li>
                    <a href="#imperial-stout">Imperial Stout</a>
                </li>
            </ul>
            <div>
                <h2 id="ipa">India Pale Ale (IPA)</h2>
                <ol>
                    <li>
                        <strong>Hill Farmstead:</strong> Susan</li>
                    <li>
                        <strong>Trillium:</strong> Melcher Street - Double Dry Hopped</li>
                    <li>
                        <strong>Tree House:</strong> Julius</li>
                    <li>
                        <strong>AleSmith:</strong> IPA</li>
                    <li>
                        <strong>Alchemist:</strong> Focal Banger</li>
                    <li>
                        <strong>Grassroots:</strong> Legitimacy</li>
                    <li>
                        <strong>Tree House:</strong> Alter Ego</li>
                    <li>
                        <strong>Bells:</strong> Two Hearted Ale</li>
                    <li>
                        <strong>New England:</strong> Fuzzy Baby Ducks IPA</li>
                    <li>
                        <strong>Ballast Point:</strong> Sculpin IPA</li>
                </ol>
            </div>
            <div>
                <h2 id="gueuze">Gueuze</h2>
                <ol>
                    <li>
                        <strong>3 Fonteinen:</strong> Zenne y Frontera</li>
                    <li>
                        <strong>3 Fonteinen:</strong> Oude Geuze Vintage</li>
                    <li>
                        <strong>3 Fonteinen:</strong> Oude Geuze Golden Blend</li>
                    <li>
                        <strong>Bullfrog:</strong> Le Roar Grrrz</li>
                    <li>
                        <strong>Oude (Gueuze Tilquin):</strong> à l’Ancienne</li>
                    <li>
                        <strong>Girardin:</strong> Gueuze Black Label</li>
                    <li>
                        <strong>Cantillon:</strong> 50°N-4°E</li>
                    <li>
                        <strong>3 Fonteinen:</strong> Oude Geuze</li>
                    <li>
                        <strong>Cantillon:</strong> Lou Pepe Gueuze</li>
                    <li>
                        <strong>Lindemans:</strong> Oude Gueuze Cuvée René Special Blend 2010</li>
                </ol>
            </div>
            <div>
                <h2 id="imperial-stout">Imperial Stout</h2>
                <ol>
                    <li>
                        <strong>Toppling Goliath:</strong> Mornin’ Delight</li>
                    <li>
                        <strong>Three Floyds:</strong> Dark Lord Russian Imperial Stout (Bourbon Barrel Aged)</li>
                    <li>
                        <strong>AleSmith:</strong> Speedway Stout - Bourbon Barrel Aged</li>
                    <li>
                        <strong>Three Floyds:</strong> Dark Lord Russian Imperial Stout (Bourbon Vanilla Bean)</li>
                    <li>
                        <strong>Founders:</strong> Backstage Series # 2: CBS (Canadian Breakfast Stout)</li>
                    <li>
                        <strong>AleSmith:</strong> Speedway Stout</li>
                    <li>
                        <strong>Cigar City:</strong> Hunahpu’s Imperial Stout</li>
                    <li>
                        <strong>Bells:</strong> Expedition Stout</li>
                    <li>
                        <strong>Three Floyds:</strong> Dark Lord Russian Imperial Stout</li>
                    <li>
                        <strong>Founders:</strong> KBS (Kentucky Breakfast Stout)</li>
                </ol>
            </div>
        </div>
    </main>

    <script src="js/role-tabs.js"></script>
</body>

</html>