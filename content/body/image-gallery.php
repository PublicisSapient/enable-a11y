<h2>ARIA Image Gallery Example</h2>

<p>Image galleries are used in a lot of e-commerce sites to show off the products the site is selling. Images are a great way for sighted users to know what the product looks like and if it is the one that they want. But how about blind and partially-sighted users? They want to know what kind of pictures are in the image gallery as well so they can understand if the product is right for them as well. The following example is accessible and will announce to screen reader users when a new image is displayed and describe the image via the image's alt text set in the code</p>

<?php includeStats(["isForNewBuilds" => true]); ?>
<?php includeStats([
    "isForNewBuilds" => false,
]); ?>
<?php includeStats(["isNPM" => true]); ?>

<div id="example1" class="enable-example">
<div id="gallery1" class="gallery" role="group" aria-label="Product Gallery">
        <div class="slides">
            <img src="images/image-gallery/001-product.jpg" alt="Miniature Space Invaders arcade game machine with a red joystick, yellow buttons, and retro branding. There are four switches on the panel, labelled: On/Off, Mute, Pause and Start/Fire." class="slide">
            <img src="images/image-gallery/002-product.jpg" alt="Right side view of a miniature Space Invaders arcade machine showing colorful alien graphics and logo on a blue casing. There is a logo on the bottom that reads 'Excalibur Electronics Inc.'" class="slide">
            <img src="images/image-gallery/003-product.jpg" alt="Close-up of a white sticker on the back of a blue Space Invaders arcade machine. The sticker reads: 'Excalibur Electronics, Inc. Miami, FL (305) 477-8080. WWW.ExcaliburElectronics.com. Battery: Size C x4 (not included). Model: 402-A. Space Invaders Arcade, copyright Taito corporation, 1978. Space Invader is the trademark of Taito. Made in China." class="slide">
            <img src="images/image-gallery/004-product.jpg" alt="Left side of a miniature Space Invaders arcade machine featuring alien-themed artwork and logo on a blue plastic body." class="slide">
        </div>
        <div class="thumbnail-slider" data-gallery="gallery1">
            <button class="thumb-nav-button">
                <img src="images/prev.svg" alt="Display Previous Image"/>
            </button>
            <nav class="thumbnails" role="navigation" aria-label="Gallery 2 Thumbnail Navigation">
                <button class="thumbnail-button" data-index="0">
                    <img src="images/image-gallery/001-product.jpg" class="thumbnail active" alt="Display Image 1">
                </button>
                <button class="thumbnail-button" data-index="1">
                    <img src="images/image-gallery/002-product.jpg" alt="Display Image 2" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="2">
                    <img src="images/image-gallery/003-product.jpg" alt="Display Image 3" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="3">
                    <img src="images/image-gallery/004-product.jpg" alt="Display Image 4" class="thumbnail">
                </button>
            </nav>
            <button class="thumb-nav-button">
            <img src="images/next.svg" alt="Display Next Image"/>
            </button>
        </div>
        <div class="gallery-alert sr-only" role="status" aria-live="polite">
        </div>
    </div>
</div>

<?php includeShowcode("example1"); ?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Ensure all images have alt attributes",
      "highlight": "alt",
      "notes": "The content of all the carousel panels must follow accessibility guidelines as well as the carousel itself"
    },
    {
      "label": "Add aria-label on neccessary tags",
      "highlight": "aria-label",
      "notes": "This aria-label on button and nav helps user to understand the purpose of the tags."
    },
    {
      "label": "Use an ARIA live status to give update information to screen reader users",
      "highlight": "aria-live ||| role=\"status\"",
      "notes": "This aria-live status will be updated when new image is displayed in the gallery that describe what is being shown display (e.g Now displaying an image of)"
    },  
    {
        "label": "Updated a aria-live using javascript",
        "highlight": "%FILE% ./js/modules/image-gallery.js ~ slideAlert",
        "notes": "When the image gallery displays a new image, this is the code that announces the change to screen reader users."
    },
    {
      "label": "Hide the gallery alert with sr-only CSS class",
      "highlight": "sr-only",
      "notes": "This is <a href=\"screen-reader-only-text.php\">a standard class that hides items visually but allows screen readers to access them</a>."
    },
    {
        "label": "Add aria-hidden to slide image",
        "highlight": "%FILE% ./js/modules/image-gallery.js ~ aria-hidden",
        "notes": "Ensure only one active thumbnail display on slide other gets hide and add aria-hidden"
    },
    {
        "label": "Allow screen readers to know which element is active",
        "highlight": "%FILE% ./js/modules/image-gallery.js ~ aria-pressed",
        "notes": ""
    },
    {
        "label": "Create JavaScript that should be triggered when pressed",
        "highlight": "%FILE% ./js/modules/image-gallery.js ~ changeSlide",
        "notes": ""
    }
  ]
}
</script>

<h2>Solution 2: Image Gallery with Caption</h2>
<p>This is an example of a image gallery where there are captions underneath the image. Note that in some image galleries on the web, captions don't always describe what is inside the image completely and may just have some additional information (a great example of this is Instagram). For this reason, it is usually a great idea for screen readers to announce both the image alt text and the caption together when the user elects to display a new image in the gallery.</p>
<?php includeStats(["isForNewBuilds" => true]); ?>
<?php includeStats(["isForNewBuilds" => false]); ?>
<?php includeStats(["isNPM" => true]); ?>

<div id="example2" class="enable-example">
<div id="gallery2" class="gallery" role="group" aria-label="Gallery with Calligraphy Photos">
        <div class="slides">
          <figure class="fig-slide">
            <img class="slide" src="images/image-gallery/01-calligraphy.jpg" alt="My heart belongs to you written in an Italic script to the outline of a heart">
            <figcaption>
            This is the cover of a valentine's day card I wrote for my now wife when we first started dating.  Given we are now married, I guess I did a good job.
            </figcaption>
          </figure>
            
          <figure class="fig-slide">
            <img class="slide" src="images/image-gallery/02-calligraphy.jpg" alt="A chalkboard sign with a green border with a picture of a green bottle and Italic and Roman calligraphy written on it. The text reads: The Central Proudly Presents Lizzie Violet's Cabaret Noir. Starts at 8:00. PWYC - $5 suggested. Burger + House Pint: $7.95, Pilsner: $3.50, Jameson Shot: $3.50, 3 oz. Mini Pitcher Cocktail: $10.75.">
            <figcaption>
            My wife used to have a monthly caberet at The Central in Toronto.  Here is a publicity sign I created for one of her shows.
            </figcaption>
          </figure>
          <figure class="fig-slide">
            <img class="slide" src="images/image-gallery/03-calligraphy.jpg" alt="The image features a chalkboard with gold handwritten text on a dark background. The text reads: 'If punk songs were any longer, you wouldn't have any instruments left.' —Dame Alexander. The text has a decorative and artistic style, with certain words like 'punk songs,' 'longer,' and 'instruments' written in larger, more elaborate letters. The overall aesthetic is bold and expressive, complementing the punk theme." >
            <figcaption>
            This was a quote from a Toronto musician I met at my wife's cabaret.  I thought it was hilarious, so I wrote it on my blackboard at home and posted it on social media
            </figcaption>
          </figure>
          <figure class="fig-slide">
            <img class="slide" src="images/image-gallery/04-calligraphy.jpg" alt="A blackboard with white Italic and foundational calligraphy on it.  The text reads 'Things I Hate' followed by a numbered list: ‘1. Blackboard Calligraphy, 2. Lists, 3. Irony, and IV. Inconsistencies’.">
            <figcaption>
            I saw this quote on what used to be Twitter in 2014.  I thought it was hilarious, so I posted my take on it on Instagram.
            </figcaption>
          </figure>
          <figure class="fig-slide">
            <img class="slide" src="images/image-gallery/05-calligraphy.jpg" alt="Calligraphy written in marker on a whiteboard.  The title is ‘Ten Commandments of Webdev’, which is written in a Gothic script.  The rest of the content is written in a Foundational script and reads ‘Thou shalt not use the nbsp entity for layout. Thou shalt not use the br tag for layout. Thou shalt not use the table tag for layout. Thou shalt not use inline styles. Thou shali not use Microsoft Office html. Thou shalt not use event attributes in html. Thou shalt not indent using tabs + spaces together. Thou wilst always validate your html. Thou must be careful using javascript eval(). Thou shalt always make your code accessible.">
            <figcaption>
            I wrote this in a meeting whiteboard in 2015 when I wanted to establish a baseline for a project codebase.  I hope you think it is as funny as I did.
            </figcaption>
          </figure>
          <figure class="fig-slide">
            <img class="slide" src="images/image-gallery/06-calligraphy.jpg" alt="A filthy dirt-covered car with text written in the dirt by two people .  The first bit of text are the words 'Wash Me!' witten in calligraphy.  Another person hastily wrote the words 'No' right after it.  The words 'Please?' are written in calligraphy after that, followed by 'No Dammit' written in capital letters.  After that, the words Awww ... c'mon' are written again in Roman calligraphy with the response 'LMAO' written in a large capital letters.  Finally, the words 'So dirty' is written in Gothic calligraphy.">
            <figcaption>
            This conversation between me and some anonymous rando happened in my friends' parking garage over the span of a month.  I wonder whose car this was.
            </figcaption>
          </figure>
        </div>
        <div class="thumbnail-slider" data-gallery="gallery2">
            <button class="thumb-nav-button">
                <img src="images/prev.svg" alt="Display Previous Image"/>
            </button>
            <nav class="thumbnails" role="navigation" aria-label="Gallery 3 Thumbnail Navigation">
                <button class="thumbnail-button" data-index="0">
                    <img src="images/image-gallery/01-calligraphy.jpg" class="thumbnail active" alt="Display Image 1">
                </button>
                <button class="thumbnail-button" data-index="1">
                    <img src="images/image-gallery/02-calligraphy.jpg" alt="Display Image 2" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="2">
                    <img src="images/image-gallery/03-calligraphy.jpg" alt="Display Image 3" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="3">
                    <img src="images/image-gallery/04-calligraphy.jpg" alt="Display Image 4" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="4">
                    <img src="images/image-gallery/05-calligraphy.jpg" alt="Display Image 4" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="5">
                    <img src="images/image-gallery/06-calligraphy.jpg" alt="Display Image 4" class="thumbnail">
                </button>
            </nav>
            <button class="thumb-nav-button">
            <img src="images/next.svg" alt="Display Next Image"/>
            </button>
        </div>
        <div class="gallery-alert sr-only" role="status" aria-live="polite">
        </div>
    </div>
</div>

<?php includeShowcode("example2"); ?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Ensure all images have alt attributes",
      "highlight": "alt",
      "notes": "The content of all the slider panels must follow accessibility guidelines as well as the carousel itself"
    },
    {
      "label": "Add figure and figure caption",
      "highlight": "%OPENCLOSETAG%figure ||| %OPENCLOSECONTENTTAG%figcaption",
      "notes": ""
    },
    {
      "label": "Use an ARIA live status to give update information to screen reader users",
      "highlight": "aria-live ||| role=\"status\"",
      "notes": "This aria-live status will be updated with information for screen reader users on what has changed in the gallery"
    },  
    {
        "label": "Updated a aria-live using javascript",
        "highlight": "%FILE% ./js/modules/image-gallery.js ~ slideAlert",
        "notes": "When the image gallery displays a new image, this is the code that announces the change to screen reader users."
    }
  ]
}
</script>

<?= includeNPMInstructions("image-gallery", [], "", false, [], ".gallery") ?>
