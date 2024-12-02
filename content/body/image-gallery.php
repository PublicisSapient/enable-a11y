<h2>ARIA Image Gallery Example</h2>

<p>This component is an image carousel designed to showcase images with a smooth scrolling feature. Users can navigate through the images using the next and previous buttons. The active image is highlighted, providing a clear visual focus. Ideal for displaying product galleries, it enhances user interaction with dynamic image transitions.</p>

<?php includeStats(["isForNewBuilds" => true]); ?>
<?php includeStats([
    "isForNewBuilds" => false,
]); ?>
<?php includeStats(["isNPM" => true]); ?>

<div id="example1" class="enable-example">
    <div class="gallery">
        <div class="slides">
            <img src="images/image-gallery/01-laser-disc.jpg" alt="A close-up of a CD reflecting colorful light patterns." class="slide">
            <img src="images/image-gallery/02-laser-disc.jpg" alt="A CD with colorful reflections on its surface, resting on a black case." class="slide">
            <img src="images/image-gallery/03-laser-disc.jpg" alt="A large disc with rainbow reflections on its surface, placed on a cluttered table." class="slide">
            <img src="images/image-gallery/04-laser-disc.jpg" alt="A person holding a large disc with rainbow reflections on its surface." class="slide">
            <img src="images/image-gallery/05-laser-disc.jpg" alt="Two discs with rainbow reflections, one large and one small, on a white background." class="slide">
        </div>
        <div class="thumbnail-slider">
            <button class="prev" id="prevBtn">
                <img src="images/prev.svg" alt="Display Previous Image"/>
            </button>
            <nav class="thumbnails" id="thumbnailContainer" role="navigation" aria-label="Thumbnail Navigation">
                <button class="thumbnail-button" data-index="0">
                    <img src="images/image-gallery/01-laser-disc.jpg" class="thumbnail active" alt="Display Image 1">
                </button>
                <button class="thumbnail-button" data-index="1">
                    <img src="images/image-gallery/02-laser-disc.jpg" alt="Display Image 2" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="2">
                    <img src="images/image-gallery/03-laser-disc.jpg" alt="Display Image 3" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="3">
                    <img src="images/image-gallery/04-laser-disc.jpg" alt="Display Image 4" class="thumbnail">
                </button>
                <button class="thumbnail-button" data-index="4">
                    <img src="images/image-gallery/05-laser-disc.jpg" alt="Display Image 5" class="thumbnail">
                </button>
            </nav>
            <button class="next" id="nextBtn">
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
      "notes": "This aria-live status will be updated with information for screen reader users on what has changed in the gallery"
    },
    {
      "label": "Hide the gallery alert with sr-only CSS class",
      "highlight": "sr-only",
      "notes": "This is <a href=\"screen-reader-only-text.php\">a standard class that hides items visually but allows screen readers to access them</a>."
    },
    {
      "label": "CSS for sr-only",
      "highlight": "%CSS%all-css ~ .sr-only",
      "notes": "This is the  <a href=\"screen-reader-only-text.php\"><code>sr-only</code></a>   we use in the Enable project. There are several variations of this available on the web."
    },
    {
        "label": "Add aria-hidden to slide image",
        "highlight": "%FILE% ./js/modules/image-gallery.js ~ aria-hidden",
        "notes": "Ensure only one active thumbnail display on slide other gets hide and add aira-hidden"
    },
    {
        "label": "Create JavaScript that ensure active image get update when any changes occurs",
        "highlight": "%FILE% ./js/modules/image-gallery.js ~ this.showSlide",
        "notes": "This function add shows active image in gallery and updates gallery alert message."
    },
    {
        "label": "Create JavaScript that should be triggered when pressed",
        "highlight": "%FILE% ./js/modules/image-gallery.js ~ this.changeSlide",
        "notes": ""
    }
  ]
}
</script>
<?= includeNPMInstructions("image-gallery", [], "", false, [], ".gallery") ?>