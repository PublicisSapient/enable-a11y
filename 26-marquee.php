<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Marquee Role</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/marquee.css" />
    
</head>

<body>

    <?php include("includes/example-header.php"); ?>

    <h1>ARIA Marquee Role</h1>
    <main>

            <aside class="notes">
                <h2>Notes:</h2>
    
                <ul>
                    <li>Marquees have an default <code>aria-live</code> value of <code>"off"</code></li>
                    <li>When setting <code>aria-live</code> to another value, NVDA and ChromeVox will read the value, but Voiceover will not.</li>
                    <li>The role is not reported in any of the screen readers tested in reading mode.</li>
                </ul>
            </aside>

            <h2>Example 1 - News Ticker</h2>
            <div id="myMarquee" role="marquee" aria-live="assertive">
                Loading News Articles.
            </div>

    </main>
    
    
    <script src="js/marquee.js"></script>
</body>

</html>