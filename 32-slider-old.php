<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Slider Examples</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/slider.css" />
    
</head>

<body>

    <?php include("includes/example-header.php"); ?>

    

    <main>
            <h1>ARIA Slider Examples</h1>

            <aside class="notes">
                <h2>Notes:</h2>
    
                <ul>
                    <li>This example is originally from Open Ajax Alliance's <a href="https://web.archive.org/web/20170715191225/http://oaa-accessibility.org/example/32/">Slider Example</a></li>
                    <li>It does not work on mobile.  We are currently looking into updating this example to correct this flaw.</li>
                    <li>For now, please use <code>&lt;input type="range"&gt;</code> instead.</li>
                </ul>
            </aside>

            

            <h2>A Simple ARIA Slider</h2>
            
            <div id="sr1_label" >JPEG compression factor:</div>
            <div class="hslider" id="sr1"></div>  
                
            <h2>An ARIA Slider With Min and Max Values</h2>

            <div id="sr2_global_label">Approximately how much money would you be willing to invest in your RRSPs in the next years</div>
            
            <div id="sr2_label1" class="hidden">Minimum investment amount</div>
            <div id="sr2_label2" class="hidden">Maximum investment amount</div>
            <div class="hslider" id="sr2"></div>  
            
            <h2>A Vertical ARIA Slider</h2>
            
            <div id="sr3_global_label">Approximately how much money would you be willing to invest in your RRSPs in the next years</div>
            
            <div id="sr3_label1" class="hidden">Minimum investment amount</div>
            <div id="sr3_label2" class="hidden">Maximum investment amount   </div>
            <div class="vslider" id="sr3"></div> 

            <h2>A Simple HTML Slider (i.e. an <code>input</code> with <code>type="range"</code>)</h2>

            <form oninput="document.getElementById('myOutput').innerHTML = parseFloat(this.elements.donationAmount.value);">
            <label for="horizontal-slider">Amount you want to donate to the Zoltan Hawryluk Developer Fund: </label>
            <input type="range" id="horizontal-slider" name="donationAmount" value="500" min="0" max="1000" step="50" />
            <output id="myOutput" role="alert" aria-live="assertive">500</output>
            </form>

            
                 

    </main>
    
    <script src="js/shared/jquery-1.4.2.min.js"></script>
    <script src="js/slider.js"></script>
</body>

</html>