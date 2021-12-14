<!DOCTYPE html>
<html lang="en">

<head>

    <title>Accessible Typeography</title>
    <?php include "includes/common-head-tags.php";?>
    <link id="text-resize-css" rel="stylesheet" type="text/css" href="css/text-resize.css" />
    <link rel="stylesheet" type="text/css" href="css/figure.css" />
</head>

<body>
    <?php include "includes/documentation-header.php";?>

    <main>



        <h2>Adjusting Layout on Text Resize</h2>

        <p>
            For text inside hero images to be considered accessible, they must conform to the following guidelines:
        </p>


        <ol>
            <li>They must not be "hard-coded" into the image in order to conform to <a
                    href="https://www.w3.org/WAI/WCAG21/Understanding/images-of-text">WCAG 1.4.5 - Images of Text</a>.
            </li>
            <li>They must adhere to contrast requirements of <a
                    href="https://www.w3.org/WAI/WCAG21/Understanding/contrast-minimum">WCAG 1.4.3 - Contrast
                    (Minimum)</a>
            <li>They must accomodate the adjustable text-spacing guidelines of <a
                    href="https://www.w3.org/WAI/WCAG21/Understanding/text-spacing.html">WCAG 1.4.12 - Text Spacing</a>.
            </li>
            <li>They must be resizeable via a browser's text zooming feature to conform to <a
                    href="https://www.w3.org/WAI/WCAG21/Understanding/resize-text">WCAG 1.4.4 - Text Resize</a>.</li>
        </ol>

        <p>The first item is easily resolved: just use "live" HTML text. Checking contrast is covered in the <a
                href="text-contrast.php">Text Contrast Strategies</a> section of Enable. The final two requirements,
            though, can bring up some hard-numbing issues that I have seen over and over again, so I thought I'd show
            how I've fixed these.
        </p>

        <h2>Text Spacing Issues</h2>

        <p>Consider this screenshot of a typical desktop-sized hero image:</p>


        <div class="text-resize__hero">
            <div class="text-resize__container">
                <div class="text-resize__hero--text">
                    <div class="text-resize__hero--main-text" lang="tr">Cüneyt Arkın</div>
                    <p class="text-resize__hero--sub-text">is a Turkish film actor, director, producer and martial
                        artist. He is widely considered one of the most prominent Turkish actors of all
                        time. Arkın's films have ranged from
                        well-received dramas to mockbusters throughout his career spanning four decades. </p>
                </div>
                <picture>
                    <source srcset="images/text-resize/cuneyt-1024.webp 1024w, images/text-resize/cuneyt-960.webp 960w"
                        media="(min-width: 720px)" type="image/webp">
                    <source
                        srcset="images/text-resize/cuneyt-portrait-729.webp 729w, images/text-resize/cuneyt-portrait-375.webp 375w"
                        type="image/webp">
                    <source srcset="images/text-resize/cuneyt-1024.jpg 1024w, images/text-resize/cuneyt-960.jpg 960w"
                        media="(min-width: 720px)">
                    <img class="text-resize__hero--image"
                        alt="Portrait shot of Cüneyt Arkın in front of a starry background"
                        srcset="images/text-resize/cuneyt-portrait-729.jpg 729w, images/text-resize/cuneyt-portrait-375.jpg 375w"
                        sizes="100vw" />

                </picture>
            </div>
        </div>

        <figure>

            <?php pictureWebpPng("images/hero-image-text-resize/hero-image-example", "Screenshot of a black and white hero image. Turkish actor Cüneyt Arkın is on the right with text describing who he is on the left.")?>

            <figcaption>
                Figure 1. A typical desktop hero image.
            </figcaption>
        </figure>

        <p>It is easy to render this text via HTML. The design even accomodates text spacing requirements: when I apply
            <a href="http://www.html5accessibility.com/tests/tsbookmarklet.html">Steve Faulkner's text spacing
                bookmarklet</a>, the text fills the hero image.
        </p>


        <figure>

            <?php pictureWebpPng("images/hero-image-text-resize/hero-image-example__text-spacing", "Screenshot of the above hero image with text-spacing stylesheet applied.  The text on the left of the hero image is still contained by the image container and is still legable")?>

            <figcaption>
                Figure 2. Hero image with text-spacing stylesheet applied.
            </figcaption>
        </figure>

        <p>
            However, things break down when I try to resize the text. Here is what the hero image looked like when I
            applied 150% text zoom on the page:
        </p>

        <figure>

            <?php pictureWebpPng("images/hero-image-text-resize/hero-image-example__text-resize", "Screenshot of the above hero image with the browser's text-zoom set to 150%.  Note that the text bleeds outside of the hero image, and Cüneyt Arkın's first name is cut off by the text's container element.")?>

            <figcaption>
                Figure 3. Hero image with text zoom set to 150%. Not all the text is legable.
            </figcaption>
        </figure>

        <p>
            This is typical of a lot of hero images on the web. It's so common, I created a JavaScript library to work
            around this issue. When the text is resized using the
            browser's text zooming feature, the layout changes to accomodate the larger text:
        </p>

        <figure>

            <?php pictureWebpPng("images/hero-image-text-resize/hero-image-example__text-spacing--fixed", "Screenshot of the above hero image with the browser's text-zoom set to 150% with JavaScript solution applied.  The layout has been altered so now the text is above the hero image instead of inside of it.")?>

            <figcaption>
                Figure 3. Hero image with text zoom set to 150% and JavaScript solution applied.
            </figcaption>
        </figure>

        


        <p>
        <p>
        <p>
    </main>

    <?php include "includes/example-footer.php"?>

    <script src="https://useragentman.com/examples/text-zoom-event/dist/textZoomEvent-es4.js"></script><br />
    <script>
    const body = document.body;

    function setCssTextZoomFactor() {
        console.log(textZoomEvent.resizeFactor());
        if (textZoomEvent.resizeFactor() > 1) {
            body.classList.add('text-zoom');
        } else {
            body.classList.remove('text-zoom');
        }
    }
    // It is better if you give this the value of 
    // parseFloat(getComputedStyle(document.documentElement).fontSize
    // when the doc is not zoomed.
    textZoomEvent.init(16);
    setCssTextZoomFactor();
    document.addEventListener('textzoom', setCssTextZoomFactor);
    </script>
</body>

</html>