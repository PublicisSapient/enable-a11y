<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Tooltip Example</title>
    <?php include "includes/common-head-tags.php";?>
    <link id="tooltip-css" rel="stylesheet" type="text/css" href="css/accessible-text-svg.css" />
    <link rel="stylesheet" type="text/css" href="css/figure.css" />

</head>

<body>
    <?php include "includes/documentation-header.php";?>

    <main class="with-full-bleed-hero">

        <div id="svg-textpath-example" class="accessible-text-svg-demo">
            <div id="accessible-text-svg-demo__shape-container">
                <svg id="accessible-text-svg-demo__svg" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,1024,681">
                    <defs>

                        <!-- This is a path with two curves fused together -->
                        <path id="accessible-text-svg-demo__path1" fill="none" stroke="black" stroke-width="1"
                            d="M 1, 481 C 479, 274, 502, 265, 779, 400 834, 436, 915, 543, 1023, 668">
                        </path>
                    </defs>


                    <text id="accessible-text-svg-demo__intro-text" x="50" y="70">Good type …</text>
                    <text id="accessible-text-svg-demo__text">


                        <textpath id="accessible-text-svg-demo__svgTextPath" class="textpath"
                            xlink:href="#accessible-text-svg-demo__path1" startOffset="20%">
                            <tspan dy="0.1em">… needn't be flat!</tspan>
                            <animate attributeName="startOffset" to="100%" begin="indefinite" dur="1s" repeatCount="1"
                                id="rollout" fill="freeze"></animate>
                            <animate attributeName="startOffset" to="1%" begin="indefinite" dur="1s" id="rollin"
                                fill="freeze"></animate>

                        </textpath>
                    </text>

                </svg>

                <img id="accessible-text-svg-demo__roller-coaster-image" src="images/text-spacing/roller-coaster.jpg"
                    alt="Rollercoaster" />
            </div>


        </div>

        <button id="accessible-text-svg-demo__control">Animate Text</button>

        <div class="with-full-bleed-hero__content">
            <h1>Using SVG to Style Text Overlaying Images</h2>

                <p>
                    Consider the text that is overlaying the image below. You will notice that
                    clicking the "Animate Text" button moves the text along the path of the roller
                    coaster it overlays.
                </p>

                <p>
                    This text complies with text spacing and text resizing requirements. If you use the
                    text-spacing bookmarklet above, the text spaces out and doesn't get cut off.
                </p>

                <figure>
                    <?php pictureWebpPng("images/text-spacing/roller-coaster__example--text-spacing", "A screen shot of the above demo showing the letter and word spacing increased.")?>
                    <figcaption>
                        Figure 1: The above demo with the text-spacing adjusted with the bookmarklet.
                    </figcaption>
                </figure>

                <p>
                    Using a couple of cross-browser tricks, this text also resizes well using the browser text-zooming
                    functionality:
                </p>

                <figure>
                    <?php pictureWebpPng("images/text-spacing/roller-coaster__example--text-zoom", "A screen shot of the above demo with the text zoomed to a factor of 200%")?>
                    <figcaption>
                        Figure 2: The above demo with the text zoomed to 200%.
                    </figcaption>
                </figure>

                <p>
                    The design also ensures that when text spacing is adjusted and text zoom to 200% is applied, the
                    text is still fully visible.
                </p>

                <figure>
                    <?php pictureWebpPng("images/text-spacing/roller-coaster__example--text-zoom-and-spacing", "A scrren shot of the above demo with both increased text spacing and text zoom of 200% being applied.")?>
                    <figcaption>
                        Figure 3: The same demo with both text spacing and text zooming applied.
                    </figcaption>
                </figure>

                <?php includeShowcode("svg-textpath-example")?>
                <script type="application/json" id="svg-textpath-example-props">
                {
                    "replaceHtmlRules": {},
                    "steps": [{
                            "label": "Markup the SVG textpath",
                            "highlight": "%OPENCLOSECONTENTTAG%svg ||| %OPENTAG%img",
                            "notes": "The <code>img</code> tag is the photo of the roller coaster. The SVG has the curved text in it."
                        },
                        {
                            "label": "Put the text inside a textpath tag",
                            "highlight": "%OPENCLOSECONTENTTAG%textPath",
                            "notes": "This is the text that will be sitting on top of the roller coaster track."
                        },
                        {
                            "label": "Create the path the text should sit on top of.",
                            "highlight": "%OPENCLOSECONTENTTAG%path",
                            "notes": "The <code>d</code> attribute contains a bezier curve of the roller coaster's tracks. The curve was genearted by <a href=\"https://www.useragentman.com/tests/textpath/bezier-curve-construction-set.html\">The SVG/VML Bézier Curve Construction Set</a> on my blog."
                        },
                        {
                            "label": "Link the textpath and path elements together",
                            "highlight": "xlink:href",
                            "notes": "Becuase the two elements are linked this way, the text sits on top of the curve described by the <code>d</code> attribute of the <code>path</code> element."
                        },
                        {
                            "label": "Ensure the CSS allows the text in the SVG to be resized",
                            "highlight": "%CSS%text-resize-css~ body ||| --text-zoom-factor:[^;]*; ||| %CSS%text-resize-css~ #accessible-text-svg-demo__text ||| font-size:[^;]*;",
                            "notes": [
                                "<ul>",
                                "  <li>You may think that, given the formula in the <code>calc</code> statement, that the text will not be zoomed at all, since the pixel value will always be multiplied by 1.  You'll see how this variable will change in the next step.</li>",
                                "  <li>We usually use <code>rem</code> values for typography, but Firefox and Safari don't zoom text inside of SVGs, so we have to work around this using the JavaScript in the next step</li>",
                                "</ul>"
                            ]
                        },
                        {
                            "label": "Insert text-zoom-event.js at the end of the document",
                            "highlight": "%OUTERHTML% text-zoom-event-js",
                            "notes": ""
                        },
                        {
                            "label": "Use JavaScript to scale the text when uses the browser to zoom the text",
                            "highlight": "%JS%svgTextSpacingDemo ||| document.addEventListener[^;]*; ||| document.body.style.setProperty[^;]*;",
                            "notes": "On textzoom, we ensure the font scales by the zoom factor calculated by the JavaScript library."
                        },
                        {
                            "label": "Use JavaScript to alter other relevent parts of the SVG when text zoom is applied.",
                            "highlight": "%JS%svgTextSpacingDemo ||| pathEl.setAttribute[^;]*;",
                            "notes": "If the text zoom is less than or equal to 1, we push the text a bit into the text path, so users can see the text curving over the roller coaster's \"hump\".  If the text zoom is greater than 1, we ensure that the text starts right at the beginning of the textpath, since we want to make sure there is enough room for the text when the text is scaled up."
                        }
                    ]
                }
                </script>
        </div>
    </main>

    <?php include "includes/example-footer.php"?>

    <script src="js/text-spacing.js"></script>

    <script id="text-zoom-event-js" src="https://useragentman.com/examples/text-zoom-event/dist/textZoomEvent-es4.js">
    </script>
    <script>
    const svgTextSpacingDemo = new function() {
        const body = document.body;
        const pathEl = document.getElementById('accessible-text-svg-demo__svgTextPath');
        const rollinEl = document.getElementById('rollin');

        function setTextZoomFactor() {
            const zoomFactor = textZoomEvent.resizeFactor();
            document.body.style.setProperty("--text-zoom-factor", zoomFactor);

            if (zoomFactor > 1) {
                pathEl.setAttribute('startOffset', '3%');
                rollinEl.setAttribute('to', '3%')
            } else {
                pathEl.setAttribute('startOffset', '20%');
                rollinEl.setAttribute('to', '20%');
            }
        }

        function init() {
            // It is better if you give this the value of
            // parseFloat(getComputedStyle(document.documentElement).fontSize
            // when the doc is not zoomed.
            textZoomEvent.init(16);
            setTextZoomFactor();
            document.addEventListener('textzoom', setTextZoomFactor);
        }

        init();
    }
    </script>

    <?php include "includes/example-footer.php"?>
</body>

</html>