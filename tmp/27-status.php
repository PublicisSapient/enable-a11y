<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Status Role Example</title>
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



    <link rel="stylesheet" type="text/css" href="css/status.css" />
    
</head>

<body>

    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    

    <main>
            <h1>ARIA Status Role Example</h1>

            <aside class="notes">
                <h2>Notes:</h2>
    
                <ul>
                    <li>NVDA and Chromevox will update the status everytime the innerHTML property is updated.  Voiceover only
                        updates the user the string inside that innerHTML property is changed.
                    </li>
                </ul>
            </aside>

            <h2>CPU Usage Status Example</h2>

            <div id="myStatus" class="neutral" role="status">

            </div>

    </main>
    
    
    <script src="js/status.js"></script>
</body>

</html>