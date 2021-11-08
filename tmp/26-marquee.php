<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Marquee Role</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta charset="utf-8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet" type="text/css" href="css/showcode.css">
<link href="css/libs/prism.css" rel="stylesheet" />

<!-- This is the global stylesheet -->
<link id="all-css" rel="stylesheet" href="css/shared/all.css" />
<link id="read-all-css" rel="stylesheet" href="css/shared/read-more.css" />

<!-- hamburger menu -->
<link id="hamburger-style" rel="stylesheet" type="text/css" href="css/hamburger-menu.css" />


<link id="site-css" rel="stylesheet" href="css/site.css" />



    <link rel="stylesheet" type="text/css" href="css/marquee.css" />
    
</head>

<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>
    <h1>ARIA Marquee Role</h1>

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