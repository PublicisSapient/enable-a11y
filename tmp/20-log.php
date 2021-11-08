<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aria Log Role Examples</title>
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



    <link rel="stylesheet" type="text/css" href="css/log.css" />
    
</head>

<body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>


        <h1>Aria Log Role Examples</h1>
        <aside class="notes">

            <h2>Notes:</h2>

            <ul>
                <li>By default, Chromevox is the only browser will only say the updates in the log. All other screenreaders will
                    read the whole log like an alert.
                </li>
                <li>
                    NVDA does not just read the differences, even when hitting NVDA+5
                </li>
            </ul>
        </aside>
        <h2>Example 1: </h2>

        <pre id="syslog" role="log" aria-atomic="false"></pre>

    </main>
    <script src="js/log.js"></script>
</body>

</html>