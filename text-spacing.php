<!DOCTYPE html>
<html lang="en">

<head>

    <title>Accessible Text Spacing</title>
    <?php include "includes/common-head-tags.php";?>
    <link id="text-resize-css" rel="stylesheet" type="text/css" href="css/text-spacing.css" />
</head>

<body>
    <?php include "includes/documentation-header.php";?>

    <main>



        <h1>Responsive Text Spacing</h1>

        <p>
            Many developers may not be aware of the new <a
                href="https://www.w3.org/WAI/WCAG21/Understanding/text-spacing.html">text spacing requirement in WCAG
                2.1</a>. In order to satisfy this requirement, it is important to:
        </p>

        <ol>
            <li>Test for issues when text-spacing is altered in a document.</li>
            <li>Fix the issues that come up.</li>
        </ol>

        <h2>How To Test</h2>

        <p>
            The best way to test for this requirement is by using <a
                href="http://www.html5accessibility.com/tests/tsbookmarklet.html">the text resizing bookmarklet on
                HTML5Accessibility.com</a>. I have included this bookmarklet on this page to
            illustrate how it works. Click on it and you will see that:
        </p>

        <a class="bookmarklet"
            href="javascript:(function(){var d=document,id='phltsbkmklt',el=d.getElementById(id),f=d.querySelectorAll('iframe'),i=0,l=f.length;if(el){function removeFromShadows(root){for(var el of root.querySelectorAll('*')){if(el.shadowRoot){el.shadowRoot.getElementById(id).remove();removeFromShadows(el.shadowRoot);}}}el.remove();if(l){for(i=0;i<l;i++){try{f[i].contentWindow.document.getElementById(id).remove();removeFromShadows(f[i].contentWindow.document);}catch(e){console.log(e)}}}removeFromShadows(d);}else{s=d.createElement('style');s.id=id;s.appendChild(d.createTextNode('*{line-height:1.5 !important;letter-spacing:0.12em !important;word-spacing:0.16em !important;}p{margin-bottom:2em !important;}'));function applyToShadows(root){for(var el of root.querySelectorAll('*')){if(el.shadowRoot){el.shadowRoot.appendChild(s.cloneNode(true));applyToShadows(el.shadowRoot);}}}d.getElementsByTagName('head')[0].appendChild(s);for(i=0;i<l;i++){try{f[i].contentWindow.document.getElementsByTagName('head')[0].appendChild(s.cloneNode(true));applyToShadows(f[i].contentWindow.document);}catch(e){console.log(e)}}applyToShadows(d);}})();">
            Change the text spacing on this page
        </a>

        <h2>Fixing Text Spacing Issues</h2>

        <div class="text-spacing-demo">
            <div id="text-spacing-demo__shape-container">
                <svg id="text-spacing-demo__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0,0,1024,481">
                    <defs>

                        <!-- This is a path with two curves fused together -->
                        <path id="text-spacing-demo__path1" fill="none" stroke="black" stroke-width="1" d="M 1, 281 
				           C 479, 74, 502, 65, 779, 200
				        	   834, 236, 915, 343, 1023, 468">
                        </path>
                    </defs>
                    <text id="text-spacing-demo__text">
                        <textpath id="text-spacing-demo__svgTextPath" class="textpath" xlink:href="#text-spacing-demo__path1" startOffset="1%">
                            <tspan dy="0.3em">Type Doesn't Have To Be Flat!</tspan>
                            <animate
                                attributeName="startOffset"
                                to="100%"
                                begin="indefinite"
                                dur="1s"
                                repeatCount="1"
                                id="rollout"
                                fill="freeze"
                            />
                            <animate
                                attributeName="startOffset"
                                to="1%"
                                begin="indefinite"
                                dur="1s"
                                id="rollin"
                                fill="freeze"
                            />
                            
                        </textpath>
                    </text>

                </svg>

                <img id="text-spacing-demo__roller-coaster-image" src="images/text-spacing/roller-coaster.jpg" alt="Rollercoaster" />

                <button id="text-spacing-demo__control">Animate Text</button>
            </div>
        </div>




    </main>

    <?php include "includes/example-footer.php"?>

    <script src="js/text-spacing.js"></script>

    <script id="text-zoom-event-js" src="https://useragentman.com/examples/text-zoom-event/dist/textZoomEvent-es4.js"></script>
    <script>
    const svgTextSpacingDemo = new function () {
        const body = document.body;

        function setTextZoomFactor() {
            const zoomFactor = textZoomEvent.resizeFactor();
            document.body.style.setProperty("--text-zoom-factor", zoomFactor);
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

</body>

</html>