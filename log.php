<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aria Log Role Examples</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/log.css" />
    
</head>

<body>
    <?php include("includes/documentation-header.php"); ?>

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