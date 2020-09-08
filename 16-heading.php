<!DOCTYPE html>
<html>

<head>
    <title>ARIA Heading Role Examples</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link href="https://fonts.googleapis.com/css?family=Ultra|Orienta" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/heading.css" />

</head>

<body>
    <?php include("includes/example-header.php"); ?>

    <main>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>Heading levels have nothing to do with their physical size
                    (i.e. an H1 doesn't have to be larger than an H2)
                </li>
                <li>
                    Headings are used by screen-reader users as a table of contents.
                </li>
                <li>The following are HTML headings. The styling was originally derived from
                    <a href="https://tympanus.net/codrops/2012/11/02/heading-set-styling-with-css/">Heading Set Styling with CSS </a>
                    by
                    <a href="https://hugogiraudel.com/">Hugo Giraudel</a>
                </li>
            </ul>
        </aside>

        <h1>
            HTML5 and ARIA Headings
        </h1>


        <h2>HTML5 Headings</h2>

        <p>HTML supports heading levels 1-6</p>

        <div class="heading-example">
            

            <h1>This is a heading level 1</h1>
            <h2>This is an h2</h2>
            <h3>This is an h3</h3>
            <h4>This is an h4</h4>
            <h5>This is an h5</h5>
            <h6>This is an h6</h6>
        </div>

        

            <h2>ARIA Headings</h2>

            <p>The following are ARIA headings.  Note that ARIA supports
                heading levels 1-10.
            </p>
        
        <div class="heading-example">
            <div role="heading" aria-level="1">This in an ARIA heading level 1</div>
            <div role="heading" aria-level="2">This in an ARIA heading level 2</div>
            <div role="heading" aria-level="3">This in an ARIA heading level 3</div>
            <div role="heading" aria-level="4">This in an ARIA heading level 4</div>
            <div role="heading" aria-level="5">This in an ARIA heading level 5</div>
            <div role="heading" aria-level="6">This in an ARIA heading level 6</div>
            <div role="heading" aria-level="7">This in an ARIA heading level 7 (there is no HTML5 equivalent)</div>
        </div>
    </main>

</body>

</html>