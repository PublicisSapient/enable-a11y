<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="generator" content=
  "HTML Tidy for HTML5 for Windows version 5.4.0">
  <title>ARIA Alert Demo</title>
		<?php include("includes/common-head-tags.php"); ?>
  <meta charset="utf-8" >
  <link rel="stylesheet" type="text/css" href="css/alert.css" />
</head>
<body>

    <?php include("includes/example-header.php"); ?>

    <main>
        
        <h1>ARIA Alert Demo</h1>

        <aside class="notes">
                <h2>Notes:</h2>

                <ul>
                    <li>
                        An assertive alert will be spoken immediately by a screen reader, and will
                        interrupt what the screen reader was saying at that moment. For example, if
                        the user tabs into a button and the screen reader is describing it, triggering
                        an asserive alert will interrupt that description in order
                        to give the alert to the user immediately.
                    </li>
                    <li>A polite alert will be spoken when the screenreader finishes what it
                        currently saying to the user.  Using the same example above, if
                        the user tabs into a button and the screen reader is describing it,
                        a polite alert wait until it has finished describing that button before
                        saying the alert to the user.
                    </li>
                </ul>
            </aside>

        <h2>Example 1:Assertive alert</h2>

        <div id="assertive-alert" role="alert" aria-live="assertive" aria-expanded="true">This is an aria live region alert.</div>
        
        <button id="say-time">Tell me the time.</button>



        <h2> Example 2: Polite Alert</h2> 

        <p>This example is only to illustrate how an aria-live="polite" works.
            If you want to make an accessible expando, please look at
            <a href="33-dropdown.php">accessible drawer example</a>.

        <div id="polite-alert" role="alert" aria-live="polite" class="visually-hidden"></div>


        <div class="expando">
            <h2><button id="say-expanded-state" class="expando__button" data-section="table of contents">Expand table of contents</button></h2>
            <section class="expando__contents expando__contents--collapsed">
                <ul>
                    <li><a href="#intro">Introduction</a></li>
                    <li><a href="#thesis">Thesis</a></li>
                    <li><a href="#conclusion">Conclusion</a></li>   
                </ul>
            </section>
        </div>

    </main>


    <script src="js/shared/polyfills.js"></script>
    <script src="js/alert.js"></script>
</body>
</html>
