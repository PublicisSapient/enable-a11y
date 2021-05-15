<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Slider Examples</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link id="enable-skip-link-style" href="css/enable-skip-link.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/slider.css" />
    <meta charset="utf-8">
</head>

<body>

    <?php include("includes/example-header.php"); ?>



    <main>
        <h1>ARIA Slider Examples</h1>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>This example is originally from Open Ajax Alliance's <a
                        href="https://web.archive.org/web/20170715191225/http://oaa-accessibility.org/example/32/">Slider
                        Example</a></li>
                <li>It does not work on mobile. We are currently looking into updating this example to correct this
                    flaw.</li>
                <li>For now, please use <code>&lt;input type="range"&gt;</code> instead.</li>
            </ul>
        </aside>



        <h2>A Simple ARIA Slider</h2>

        <div id="example1">
            <div id="sr1_label">JPEG compression factor:</div>
            <div id="sr1_desc" class="sr-only">
                Use arrow keys to increase and decrease the value of the slider.
            </div>

            <div class="enable-slider enable-slider--horizontal" id="sr1" data-min="0" data-max="500" data-inc="5"
                data-jump="10" data-show-vals="true" data-range="false" data-val1="30">
            </div>
        </div>

        <h3 class="showcode__heading">Example code explanation</h3>

        <?php includeShowcode("example1")?>
        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                "label": "Place ARIA slider roles in document",
                "highlight": "role=\"slider\"",
                "notes": "Make sure you put a blank alt attribute!"
            },
            {
                "label": "Make the slider draggable",
                "highlight": "draggable",
                "notes": ""
            },
            {
                "label": "Add the min, max and current values that the slider can be set to, as well as the current value",
                "highlight": "aria-valuemin ||| aria-valuemax ||| aria-valuenow",
                "notes": "The min, max and current values are represented by the <strong>aria-valuemin</strong>, <strong>aria-valuemax</strong> and <strong>aria-valuenow</strong> attributes, respectively"
            },
            {
                "label": "Set the components label",
                "highlight": "aria-labelledby",
                "notes": "Just like all components, set the label using aria-labelledby"
            },
            {
                "label": "Set the component instructions",
                "highlight": "aria-describedby ||| arrow keys",
                "notes": "Note that the instructions are keyboard centric.  There is no equivalent way of setting the slider for mobile screen reader users."
            },
            {
                "label": "Make the component keyboard accessible",
                "highlight": "tabindex",
                "notes": ""
            },
            {
                "label": "Make the visual output have a presentation role",
                "highlight": "role=\"presentation\"",
                "notes": "We don't want to use a role of <strong>alert</strong>, <strong>status</strong> or any other ARIA live region role, since the value is already given to screen readers when the slider is used via the <strong>aria-valuenow</strong> attribute value."
            }
            ]
        }
        </script>




        <h2>An ARIA Slider With Min and Max Values</h2>

        <div id="sr2_global_label">Approximately how much money would you be willing to invest in your RRSPs in the next
            years</div>

        <div id="sr2_label1" class="sr-only">Minimum investment amount</div>
        <div id="sr2_label2" class="sr-only">Maximum investment amount</div>
        <div class="enable-slider enable-slider--horizontal" id="sr2" data-min="1900" data-max="2008" data-inc="1"
            data-jump="10" data-show-vals="true" data-range="true" data-val1="1950" data-val2="2000">
        </div>

        <h2>A Vertical ARIA Slider</h2>

        <div id="sr3_global_label">Approximately how much money would you be willing to invest in your RRSPs in the next
            years</div>

        <div id="sr3_label1" class="sr-only">Minimum investment amount</div>
        <div id="sr3_label2" class="sr-only">Maximum investment amount </div>
        <div class="enable-slider enable-slider--vertical" id="sr3" data-min="1900" data-max="2008" data-inc="1"
            data-jump="10" data-show-vals="true" data-range="true" data-val1="1950" data-val2="2008">
        </div>

        <h2>A Simple HTML Slider (i.e. an <code>input</code> with <code>type="range"</code>)</h2>

        <form oninput="document.getElementById('myOutput').innerHTML = parseFloat(this.elements.donationAmount.value);">
            <label for="horizontal-slider">Amount you want to donate to the Zoltan Hawryluk Developer Fund: </label>
            <input type="range" id="horizontal-slider" name="donationAmount" value="500" min="0" max="1000" step="50" />
            <output id="myOutput" aria-live="assertive">500</output>
        </form>

    </main>
    <script src="js/slider-no-jquery.js"></script>
    <script src="js/shared/enable-skip-link.js"></script>
    <?php include "includes/example-footer.php" ?>
</body>

</html>