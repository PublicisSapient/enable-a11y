<!DOCTYPE html>
<html lang="en">

<head>
    <title>Play and Pause CSS, Canvas SVG SMIL and GIF animations with Javascript</title>
    <?php include "includes/common-head-tags.php";?>
    
    <!-- For AblePlayer -->
    <link id="able-player-css" href="js/libs/ableplayer/styles/ableplayer.css" rel="stylesheet" />
    <link id="enable-video-player-css" href="css/video-player.css" rel="stylesheet" />

    <!-- for the elastic collision demo -->
    <style>
    #elastic-collision-demo__canvas {
        width: 100%;
        height: 400px;
        background: #000;
    }
    </style>
</head>

<body>
    <?php include "includes/documentation-header.php";?>
    
   
    <main class="with-full-bleed-hero">
        <?php include "includes/pause-anim-control.php" ?>
        <div id="css-anim-example">
            <div class="play-pause-anim__full-bleed-image-demo">
                
                <picture>
                    <source
                        srcset="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320.jxr 320w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-600.jxr 600w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-640.jxr 640w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1024.jxr 1024w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1200.jxr 1200w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-2016.jxr 2016w"
                        type="image/vnd.ms-photo">
                    <source
                        srcset="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320.jp2 320w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-600.jp2 600w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-640.jp2 640w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1024.jp2 1024w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1200.jp2 1200w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-2016.jp2 2016w"
                        type="image/jp2">
                    <source
                        srcset="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320.webp 320w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-600.webp 600w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-640.webp 640w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1024.webp 1024w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1200.webp 1200w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-2016.webp 2016w"
                        type="image/webp">
                    <img class="play-pause-anim__full-bleed-image-demo--image"
                        alt="The planet saturn in front of an animated starfield"
                        src="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320-quant.png"
                        srcset="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320-quant.png 320w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-600-quant.png 600w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-640-quant.png 640w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1024-quant.png 1024w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1200-quant.png 1200w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-2016-quant.png 2016w" />
                </picture>
            </div> 
        </div>
        <div class="with-full-bleed-hero__content">
            <h1>Pausing animations</h1>
            <p>
                Pause all the CSS, Canvas, SVG SMIL and GIF
                animations on this page with the checkbox at the top of this page.
                The CSS, Canvas and SVG SMIL animations don't know
                anything about the checkbox. The GIF animations only require
                a small amount of set up to work.
            </p>

            <p>
                (Note: if you have set your operating system to Reduce Motion,
                it will be checked by default)
            </p>

            <h2>Quick Start guide</h2>

            <p>
                Just <a href="js/pause-anim-control.js">download the script</a> and include it at the end of the
                <code>body</code>:
            </p>

            <?php includeShowcode("document", "", "", "", "", false)?>
            <script type="application/json" id="document-props">
            {
                "replaceHtmlRules": {
                    "head": "... <link rel=\"stylesheet\" href=\"css/pause-animations-demo.css\" /> ...",
                    "body": "...<script src=\"js/pause-anim-control.js\"><\/script>"
                },
                "steps": [{
                    "label": "",
                    "highlight": "src=\"js/pause-anim-control.js\"",
                    "notes": ""
                }]
            }
            </script>


            <p>After that, just include it in the bottom of your page.
                The control to pause the animations must be structured the following way:
            </p>

            <?php includeShowcode("checkbox-container", "", "", "", "", false)?>
            <script type="application/json" id="checkbox-container-props">
            {
                "replaceHtmlRules": {},
                "steps": [{
                    "label": "",
                    "highlight": "for",
                    "notes": ""
                }]
            }
            </script>

            <p>For animated GIFs or WEBP, you will have to structure your HTML a certain way
                (see the <a href="#animated-gif">animated GIF example below</a> for details).</p>

            <h2>How Does It Work</h2>

            <p>The TL;DR:</p>

            <ul>
                <li>When the page loads, the script checks to see what the OS setting for animations (via the <a
                        href="">prefers-reduced-motion media query</a>).</li>
                <li>If <code>prefers-reduced-motion</code> media-query is set to "reduce", the script turns off the
                    animations and checks the checkbox by default.</li>
                <li>If the checkmark is checked, the class <code>pause-anim-control__prefers-reduced-motion</code>
                    is set on the <code>body</code> tag. Otherwise, the <code>body</code> tag has the
                    <code>pause-anim-control__prefers-motion</code> class set. These classes are used to pause and
                    play CSS and GIF/WEBP animations.
                </li>
                <li>The script does some extra magic to turn off the other animations (see below).</li>
            </ul>

            <h2>Code walkthroughs</h2>

            <p>This section will show how the script stops the different type of animations.</p>

            <h3>CSS Animations</h3>

            <p>
                The animation of Saturn from <a
                    href="https://www.useragentman.com/blog/2015/01/14/using-webp-jpeg2000-jpegxr-apng-now-with-picturefill-and-modernizr/">one
                    of my previous blog posts</a> that appears above is animated via CSS.
            </p>




            <?php includeShowcode("css-anim-example", "", "", "", true, 4)?>
            <script type="application/json" id="css-anim-example-props">
            {
                "replaceHtmlRules": {
                    "picture": "<!-- code for image of saturn -->"
                },
                "steps": [{
                        "label": "Set up CSS animation",
                        "highlight": "%CSS% pause-anim-css ~ .play-pause-anim__full-bleed-image-demo--image ||| animation[^;]*; ||| background-position[^;]*; ||| %CSS% pause-anim-css ~ @keyframes animatedBackground ||| animatedBackground ||| background-position[^;]*;",
                        "notes": "Standard CSS code to start the CSS animation of the stars in the background of the hero image."
                    },
                    {
                        "label": "Add CSS that will stop all CSS animations",
                        "highlight": "%CSS% pause-anim-css ~ @media (prefers-reduced-motion: reduce) ||| [ ]*animation-delay[^}]*transition-delay[^;]*; ||| %CSS% pause-anim-css ~ body.pause-anim-control__prefers-reduced-motion ||| [ ]*animation-delay[^}]*transition-delay[^;]*;",
                        "notes": [
                            "The highlighted code will activate if:",
                            "<ul>",
                            "  <li>The user has configured the operating system to reduce motion animations, <strong>or</strong></li>",
                            "  <li>The <code>.pause-anim-control__prefers-reduced-motion</code> is set to the <code>body</code> tag.",
                            "</ul>",
                            "<p>This code was provided in Bruce's Lawson's awesome blog post <a href=\"https://brucelawson.co.uk/2021/prefers-reduced-motion-and-browser-defaults/\">prefers-reduced-motion and browser defaults</a>."
                        ]
                    },
                    {
                        "label": "Mark up checkbox",
                        "highlight": "for",
                        "notes": "Standard checkbox markup.  Just make sure the id is set as shown."
                    },
                    {
                        "label": "Set up the checkbox click event",
                        "highlight": "%JS%pauseAnimControl ||| document.addEventListener\\('change'[^\\)]*\\); ||| this.clickEvent =",
                        "notes": ""
                    },
                    {
                        "label": "Call the appropriate method when the checkbox is clicked and unclicked",
                        "highlight": "%JS%pauseAnimControl ||| this.play\\(\\); ||| this.pause\\(\\);",
                        "notes": "You will also notice that the pause and play methods are fired when in and out of the <code>prefers-reduced-motion</code> breakpoint."
                    },
                    {
                        "label": "In the pause and play methods, add the appropriate classes to the body",
                        "highlight": "%JS%pauseAnimControl ||| body.classList[^\\)]*\\);",
                        "notes": "This adds the <code>pause-anim-control__prefers-reduced-motion</code> to the body (this was the class that stops the CSS animation in one of the previous steps)."
                    }
                ]
            }
            </script>

            <h3>Pausing requestAnimationFrame Animations</h3>

            <p>Most Canvas Animations (like <a href="https://codepen.io/thebabydino/pen/gbJwMQ">this great elastic collision demo</a> from
                <a href="https://codepen.io/thebabydino">Ana Tudor</a>) rely on code using
                <code>requestAnimationFrame()</code> to produces a frame of
                animation.
                When the checkbox is checked, we just set window.requestAnimationFrame to a dummy function, and set it back
                when the checkbox
                is unchecked. <strong>The animation below wasn't made with pausing in mind ... my pause script "just made it
                    work".</strong>
            </p>

            <div id="elastic-collision-demo" class="enable-example">
                <canvas id="elastic-collision-demo__canvas"></canvas>
            </div>

            <?php includeShowcode("elastic-collision-demo", "", "", "", true, 4)?>
            <script type="application/json" id="elastic-collision-demo-props">
            {
                "replaceHtmlRules": {},
                "steps": [{
                        "label": "Cache the browser requestAnimationFrame method in the script",
                        "highlight": "%JS% pauseAnimControl ||| this.realRAF =[^;]*;",
                        "notes": ""
                    },
                    {
                        "label": "Create a dummy function that calls itself one every 100 ms",
                        "highlight": "%JS% pauseAnimControl ||| this.dummyRAF =",
                        "notes": ""
                    },
                    {
                        "label": "When pause method is executed, set object's requestAnimationFrame to dummy function",
                        "highlight": "%JS% pauseAnimControl ||| this.requestAnimationFrame = this.dummyRAF;",
                        "notes": "Since most canvas animation rely on requestAnimationFrame to produce and animation frame, this should stop any animations from executing."
                    },
                    {
                        "label": "When play method is executed, set requestAnimationFrame back to the browser default",
                        "highlight": "%JS% pauseAnimControl ||| this.requestAnimationFrame = this.realRAF;",
                        "notes": ""
                    }
                ]
            }
            </script>

            <h3>SMIL Animation Demo</h3>
            <p>
                The animation below (made by the talented <a href="https://codepen.io/madetoday">Lenka</a> from
                <a href="https://codepen.io/madetoday/pen/MYxYeo">their CodePen of this demo</a>)
                uses <a href="https://developer.mozilla.org/en-US/docs/Web/SVG/SVG_animation_with_SMIL">SMIL</a>
                to animate the SVG. Note that although there was a lot of noise about
                SMIL being deprecated in Chrome, this
                <a href="https://groups.google.com/a/chromium.org/g/blink-dev/c/5o0yiO440LM/m/YGEJBsjUAwAJ?pli=1">deprecation
                    was suspended</a>
                (i.e. it is still a web standard and will continue to be in the forseeable future, due to pushback from the
                web development community).
            </p>
            <!-- SMIL demo from  by Lenka (codepen @madetoday) -->

            <div id="svg-smil-demo" class="enable-example">
                <svg id="wrap" width="300" height="300">

                    <!-- background -->
                    <svg>
                        <circle cx="150" cy="150" r="130" style="stroke: lightblue; stroke-width:18; fill:transparent" />
                        <circle cx="150" cy="150" r="115" style="fill:#2c3e50" />
                        <path
                            style="stroke: #2c3e50; stroke-dasharray:820; stroke-dashoffset:820; stroke-width:18; fill:transparent"
                            d="M150,150 m0,-130 a 130,130 0 0,1 0,260 a 130,130 0 0,1 0,-260">
                            <animate attributeName="stroke-dashoffset" dur="6s" to="-820" repeatCount="indefinite" />
                        </path>
                    </svg>

                    <!-- image -->
                    <svg>
                        <path id="hourglass" d="M150,150 C60,85 240,85 150,150 C60,215 240,215 150,150 Z"
                            style="stroke: white; stroke-width:5; fill:white;" />

                        <path id="frame"
                            d="M100,97 L200, 97 M100,203 L200,203 M110,97 L110,142 M110,158 L110,200 M190,97 L190,142 M190,158 L190,200 M110,150 L110,150 M190,150 L190,150"
                            style="stroke:lightblue; stroke-width:6; stroke-linecap:round" />

                        <animateTransform xlink:href="#frame" attributeName="transform" type="rotate" begin="0s" dur="3s"
                            values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1" repeatCount="indefinite" />
                        <animateTransform xlink:href="#hourglass" attributeName="transform" type="rotate" begin="0s"
                            dur="3s" values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1"
                            repeatCount="indefinite" />
                    </svg>

                    <!-- sand -->
                    <svg>
                        <!-- upper part -->
                        <polygon id="upper" points="120,125 180,125 150,147" style="fill:#2c3e50;">
                            <animate attributeName="points" dur="3s" keyTimes="0; 0.8; 1"
                                values="120,125 180,125 150,147; 150,150 150,150 150,150; 150,150 150,150 150,150"
                                repeatCount="indefinite" />
                        </polygon>

                        <!-- falling sand -->
                        <path id="line" stroke-linecap="round" stroke-dasharray="1,4" stroke-dashoffset="200.00"
                            stroke="#2c3e50" stroke-width="2" d="M150,150 L150,198">
                            <!-- running sand -->
                            <animate attributeName="stroke-dashoffset" dur="3s" to="1.00" repeatCount="indefinite" />
                            <!-- emptied upper -->
                            <animate attributeName="d" dur="3s" to="M150,195 L150,195"
                                values="M150,150 L150,198; M150,150 L150,198; M150,198 L150,198; M150,195 L150,195"
                                keyTimes="0; 0.65; 0.9; 1" repeatCount="indefinite" />
                            <!-- last drop -->
                            <animate attributeName="stroke" dur="3s" keyTimes="0; 0.65; 0.8; 1"
                                values="#2c3e50;#2c3e50;transparent;transparent" to="transparent"
                                repeatCount="indefinite" />
                        </path>

                        <!-- lower part -->
                        <g id="lower">
                            <path d="M150,180 L180,190 A28,10 0 1,1 120,190 L150,180 Z"
                                style="stroke: transparent; stroke-width:5; fill:#2c3e50;">
                                <animateTransform attributeName="transform" type="translate" keyTimes="0; 0.65; 1"
                                    values="0 15; 0 0; 0 0" dur="3s" repeatCount="indefinite" />
                            </path>
                            <animateTransform xlink:href="#lower" attributeName="transform" type="rotate" begin="0s"
                                dur="3s" values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1"
                                repeatCount="indefinite" />
                        </g>

                        <!-- lower overlay - hourglass -->
                        <path d="M150,150 C60,85 240,85 150,150 C60,215 240,215 150,150 Z"
                            style="stroke: white; stroke-width:5; fill:transparent;">
                            <animateTransform attributeName="transform" type="rotate" begin="0s" dur="3s"
                                values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1" repeatCount="indefinite" />
                        </path>

                        <!-- lower overlay - frame2 -->
                        <path id="frame2" d="M100,97 L200, 97 M100,203 L200,203"
                            style="stroke:lightblue; stroke-width:6; stroke-linecap:round">
                            <animateTransform attributeName="transform" type="rotate" begin="0s" dur="3s"
                                values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1" repeatCount="indefinite" />
                        </path>
                    </svg>

                </svg>
            </div>

            <?php includeShowcode("svg-smil-demo", "", "", "", true, 4)?>
            <script type="application/json" id="svg-smil-demo-props">
            {
                "replaceHtmlRules": {},
                "steps": [{
                        "label": "Add SMIL animation tags in the original SVG",
                        "highlight": "%OPENCLOSECONTENTTAG%animateTransform ||| %OPENCLOSECONTENTTAG%animate ||| %OPENCLOSECONTENTTAG%animateMotion",
                        "notes": "The <code>animate</code>, <code>animateTransform</code> and <code>animationTransform</code> tags are responsible for the animation in the SVG. More infomation is available at <a href=\"https://developer.mozilla.org/en-US/docs/Web/SVG/SVG_animation_with_SMIL\">the MDN SVG Animation With SMIL reference page</a>."
                    },
                    {
                        "label": "Use the SVG <code>pauseAnimations</code> and <code>playAnimations</code> methods",
                        "highlight": "%JS% pauseAnimControl ||| document.querySelectorAll\\('svg'\\) ||| el.pauseAnimations\\(\\);  ||| el.unpauseAnimations\\(\\);",
                        "notes": "Every SVG object has these methods."
                    }
                ]
            }
            </script>


            <h3 id="animated-gif" tabindex="-1">Animated GIF/WEBP Example</h3>

            <p>Unlike SVG SMIL animations, there is no browser API to pause GIF/WEBP animations.
                This script works around this by allowing the developer to include two different
                renditions of the image: one animated, the other not. CSS is then used to hide
                and show each rendition according the user's preference.</p>

            <p>(If you are looking for a way to add pause buttons on GIF animations, please
                take a look at <a href="http://localhost:8888/aria-role-demos/36-animated-gif-with-pause-button.php">
                    the animated gif pause button</a> examples).
            </p>

            <div id="anim-gif-demo" class="enable-example">
                <div class="pause-anim-control__gif">
                    <img class="pause-anim-control__gif--animated" src="images/running-man-anim.gif"
                        alt="Animated drawing of a man running" />
                    <img class="pause-anim-control__gif--still" src="images/running-man-anim__still.jpg"
                        alt="A drawing of a man running" />
                </div>
            </div>

            <?php includeShowcode("anim-gif-demo", "", "", "", true, 4)?>
            <script type="application/json" id="anim-gif-demo-props">
            {
                "replaceHtmlRules": {},
                "steps": [{
                        "label": "Put the animated and unanimated images inside the DOM",
                        "highlight": "class",
                        "notes": "Note the classes being used.  These will be referred to in the next few steps."
                    },
                    {
                        "label": "Make the animated GIF visible and the still variation hidden by default",
                        "highlight": "%CSS% pause-anim-css ~ .pause-anim-control__gif--animated ||| %CSS% pause-anim-css ~ .pause-anim-control__gif--still",
                        "notes": ""
                    },
                    {
                        "label": "When the user wants the animation to be hidden, show only the still variation.",
                        "highlight": "%CSS% pause-anim-css ~ @media (prefers-reduced-motion: reduce) ||| [^\\n]*body:not\\(.pause-anim-control__prefers-motion\\)\\s.pause-anim-control__gif-[^}]*} ||| %CSS% pause-anim-css ~ body.pause-anim-control__prefers-reduced-motion ||| body.pause-anim-control__prefers-reduced-motion\\s.pause-anim-control__gif-[^}]*}",
                        "notes": ""
                    }
                ]
            }
            </script>

            <h3>Vanilla HTML5 Video</h3>

            <p>
                Videos embedded by the video tag can be paused automatically by the script as well.
                Note that when the user unchecks the "Pause animations" checkbox, 
                the videos will only start playing if they were playing when the checkbox was 
                originally checked.
            </p> 

            <div id="html5-video-example">
                <video controls="" preload="metadata" data-root-path="./js/libs/ableplayer/" autoplay muted loop>
                    <source src="videos/test-pattern.mp4" type="video/mp4">
                    Video not supported.
                </video>
            </div>

            <?php includeShowcode("html5-video-example")?>
            <script type="application/json" id="html5-video-example-props">
            {
                "replaceHtmlRules": {
                },
                "steps": [
                {
                    "label": "Insert the video tag.",
                    "highlight": "%OPENCLOSECONTENTTAG%video",
                    "notes": "Note that if you are going to autoplay, most browsers also require that you also mute the video as well.  Autoplaying videos can be annoying to many users, so avoid when possible.  Please read <a href=\"https://developer.mozilla.org/en-US/docs/Web/Media/Autoplay_guide\">Autoplay guide for media and Web Audio APIs</a> from <a href=\"https://developer.mozilla.org/\">MDN</a> for more information."
                },
                {
                    "label": "The script will use the standard <code>.pause()</code> and <code>play()</code> methods for the video element when the checkbox is checked/unchecked",
                    "highlight": "%JS%pauseAnimControl ||| el.play\\(\\); ||| el.pause\\(\\)",
                    "notes": ""
                }
            ]}
            </script>

            <h3>AblePlayer</h3>

            <p>
                Since AblePlayer plays videos 
                Note that when the user unchecks the "Pause animations" checkbox, 
                the videos will only start playing if they were playing when the checkbox was 
                originally checked. <strong><em>(Since this video does not autoplay, you must play it first and then check the "Pause Animations" checkbox in order to test it properly)</em></strong>
            </p>
                
        
            <div id="ableplayer-example">
                <div class="enable-video-player">
                    <video data-able-player id="video1" data-youtube-id="NINogq4BS68" preload="auto" data-skin="2020" data-root-path="./js/libs/ableplayer/" >
                        <track kind="captions" src="vtt/dialog-document__html5.vtt" srclang="en" label="English" />
                        <track kind="descriptions" src="vtt/dialog-document__html5--desc.vtt" srclang="en"
                            label="English Audio Descriptions" />
                    </video>
                </div>
            </div>

            <?php includeShowcode("ableplayer-example")?>
            <script type="application/json" id="ableplayer-example-props">
            {
                "replaceHtmlRules": {
                },
                "steps": [
                {
                    "label": "As usual, make sure the Able player video tag is marked up correctly.",
                    "highlight": "data-able-player ||| data-youtube-id ||| data-skin",
                    "notes": "Please read the documentation for <a href=\"https://ableplayer.github.io/ableplayer/\">AblePlayer</a> as well as <a href=\"video-player.php\">our video player</a> page for more information on how to mark up AblePlayer videos."
                },
                {
                    "label": "The script will use the AblePlayer's <code>.pauseMedia()</code> and <code>playMedia()</code> methods for all the videos when the checkbox is checked/unchecked",
                    "highlight": "%JS%pauseAnimControl ||| el.playMedia\\(\\); ||| el.pauseMedia\\(\\)",
                    "notes": ""
                }
            ]}
            </script>

            <h3>Making scrollIntoView() Respect the Pause Control</h3>

            <p>
                It is possible to make the a DOM element's <code>scrollIntoView()</code> method respect the setting of the pause control.  You will notice that all the code walkthroughs will not animate when changing steps and the "Pause animations" control is checked.  This part of the code shows you how this works:
            </p>

            <div id="empty-example"></div>

            <?php includeShowcode("empty-example")?>
            <script type="application/json" id="empty-example-props">
            {
                "replaceHtmlRules": {
                },
                "steps": [
                {
                    "label": "Set the behavior value correctly in the scrollIntoView() call",
                    "highlight": "%JS%showcode.scrollToHighlightedText ||| const behavior[^;]*; ||| firstHighlightdElement.scrollIntoView[^;]*;",
                    "notes": ""
                }
            ]}
            </script>

        </div>
    </main>

    <?php include "includes/example-footer.php"?>


    <script src="js/demos/pause-anim-control.js" type="module"></script>
</body>

</html>