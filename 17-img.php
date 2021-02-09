<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Img Role</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/img.css" />

</head>

<body>

    <?php include("includes/example-header.php"); ?>

    <main>

        <aside class="notes">

            <h2>Notes</h2>

            <ul>
                <li>Both HTML and ARIA role work that same in NVDA and Voiceover.</li>
            </ul>
        </aside>

        <h1>ARIA Img Role</h1>


        <p>Code based on that from
            <a href="http://pauljadam.com/demos/img.html">Paul J Adam's img role demo</a>.</p>


        <h2>HTML &lt;img&gt; Element &amp; alt attribute</h2>
        <p>
            <img src="images/card_icons.png" width="100" height="94" alt="Debit, Visa, MasterCard, American Express, Discover Network"
            />
        </p>

        <h2>ARIA role=&quot;img&quot; &amp; aria-label=&quot;Accessible Name&quot;</h2>
        <div class="clearfix">
            <div class="sprite card_icons amex" role="img" aria-label="American Express"></div>
            <div class="sprite card_icons discover" role="img" aria-label="Discover Network"></div>
            <div class="sprite card_icons visa" role="img" aria-label="Visa"></div>
            <div class="sprite card_icons master" role="img" aria-label="MasterCard"></div>
        </div>

        <h2>Blank Alt attribute</h2>
        <div>
            <img src="images/bomb.png" alt="" role="presentation" />
        </div>

        <h2>Alt attribute with one space</h2>
        <div>
            <img src="images/bomb.png" alt=" " />
        </div>

        <h2>SVG example</h2>
        <svg width="200" height="163" role="img" aria-labelledby="circle-alt svg-text">
        <title id="circle-alt">A dark blue circle with text inside</title>
		<?php include("includes/common-head-tags.php"); ?>
        <!-- 
            it is a good idea to put a background color for the image so any text without 
            a background is still legible.
        -->
        <rect x="0" y="0" width="200" height="163" fill="#ffffff" fill-opacity="1"></rect>
        <circle cx="81" cy="85" r="75" fill="#00a" stroke="#000" stroke-width="1"/>
        <text id="svg-text" x="81" y="85" font-size="14px" text-anchor="middle" fill="#fff">
            I am text in a circle
        </text>
        </svg>
    </main>
</body>

</html>