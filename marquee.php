<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Marquee Role</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/marquee.css" />

</head>

<body>

    <?php include("includes/documentation-header.php"); ?>

    <main>
        <h1>ARIA Marquee Role</h1>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>Marquees have an default <code>aria-live</code> value of <code>"off"</code></li>
                <li>When setting <code>aria-live</code> to another value, NVDA and ChromeVox will read the value, but
                    Voiceover will not.</li>
                <li>The role is not reported in any of the screen readers tested in reading mode.</li>
            </ul>
        </aside>

        <h2>Example 1 - News Ticker</h2>
        <div id="marquee-example" class="enable-example">
            <div id="myMarquee" role="marquee" aria-live="assertive">
                Loading News Articles.
            </div>
        </div>

        <?php includeShowcode("marquee-example")?>
        <script type="application/json" id="marquee-example-props">
        {
            "replaceHTMLRules": {
            },
            "steps": [
                {
                    "label": "Add role",
                    "highlight": "role",
                    "notes": ""
                },
                {
                    "label": "Add aria-live attribute",
                    "highlight": "aria-live",
                    "notes": "Only put this in if you want this timer to be read aloud by screen readers when it updates.  If it updates a lot (like once a second), it will make the screen reader rather noisy and be really annoying."
                },
                {
                    "label": "Use .innerHTML to update the timer",
                    "highlight": "%JS% marqueeExample ||| \\marqueeEl.innerHTML[^;]*;",
                    "notes": ""
                }
        ]}
        </script>

    </main>


    <script src="js/marquee.js"></script>
    <?php include "includes/example-footer.php"?>
</body>

</html>