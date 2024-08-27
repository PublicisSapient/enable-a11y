<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        "This is the best solution to use, especially when building from scratch.",
]); ?>

<p>In a world of everything online and always connected, companies are on a mission to keep you browsing their content for as
   long as they possibly can. Many patterns have come about for how to handle paginated content. Since the introduction of 
  social media one pattern in particular has been a mainstay for wasting a users time. The infinite scroll pattern. While it's good 
to keep folks endlessly scrolling content on a page it's not very accessible, it may be hampering the user experience and even hurting
the ultimate goal of your website.</p>

<p>Consider reading this article by Nieman Norman Group <a href="https://www.nngroup.com/articles/infinite-scrolling/">https://www.nngroup.com/articles/infinite-scrolling/</a> 
which talks about the detriments of a user experience that features infinite scroll.</p>

<h2>The Load More Button</h2>

<p>This is the preferred way of implementing loading more content in an accessible way that aids goal-oriented finding tasks.</p>

<p>The following demo makes use of placeholder assets pulled from <a href="https://dev.me/products/image-placeholder">https://dev.me/products/image-placeholder</a></p>

<div id="example1" class="enable-example">
    <div id="product-grid">
      <a href="/" class="product-grid-tile">
        <img src="https://via.assets.so/furniture.png?id=1&q=95&w=360&h=360&fit=fill" alt="Go to Modern Tufted Armless Lounge Chair details." />
      </a>
      <a href="/" class="product-grid-tile">
        <img src="https://via.assets.so/furniture.png?id=2&q=95&w=360&h=360&fit=fill" alt="Go to Minimalist Felt Lounge Chair details." />
      </a>
      <a href="/" class="product-grid-tile">
        <img src="https://via.assets.so/furniture.png?id=3&q=95&w=360&h=360&fit=fill" alt="Go to Classic Tufted Leather Wingback Chair details." />
      </a>
    </div>
    <p id="product-count" aria-live="polite">Showing 3 of 9 products</p>
    <button id="load-more-btn" type="button">Load More Products</button>
    <button id="reset-btn" type="button">Reset Product Grid Demo</button>
</div>



<?php includeShowcode("example1"); ?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Put in details and summary tag structure in HTML",
      "highlight": "%OPENCLOSETAG%details ||| %OPENCLOSECONTENTTAG%summary",
      "notes": ""
    },
    {
      "label": "Place role of button inside the summary",
      "highlight": "role",
      "notes": "This is to ensure iOS reports this correctly to VoiceOver"
    },
    {
      "label": "Put animated GIF after the summary tag and the poster image of the animation just before the details tag",
      "highlight": "%OPENTAG%img",
      "notes": "Note that the div surrounding the animated GIF is there for styling purposes.  It ensures that, when the summary widget is expanded, the animated image is placed over the still poster"
    },
    {
      "label": "Don't forget the alternative text for the images!",
      "highlight": "alt",
      "notes": "Alternative text describes these images to screen reader users in reading mode."
    },
    {
      "label": "Add lazy attributes to images",
      "highlight": "loading",
      "notes": "This adds a performance boost by only showing the image when it is visible in the browser viewport."
    },
    {
      "label": "Put aria label inside of summary tag",
      "highlight": "aria-label",
      "notes": "Note that when the summary is opened, this aria-label must be changed to <strong>'pause'</strong> and <strong>'play'</strong> when it is closed again."
    },
    {
      "label": "Add small accessibility extras via JavaScript",
      "highlight": "%FILE% js/modules/enable-animatedGif.js",
      "notes": "I added extra JavaScript to the original example to handle: <ul><li>the state of the pause/play button to be reported to screen readers.</li><li>to ensure this component respects the user's <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/@media/prefers-reduced-motion\"><code>prefers-reduced-motion</code> settings</a></li></ul>"
    },
    {
      "label": "Add support for Enable's Pause Animation Control",
      "highlight": "%FILE% js/modules/enable-animatedGif.js ~ document.addEventListener\\('enable-play-animations'[^\\)]*\\);",
      "notes": "I added extra JavaScript to the original example to handle: <ul><li>the state of the pause/play button to be reported to screen readers.</li><li>to ensure this component respects the user's <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/@media/prefers-reduced-motion\"><code>prefers-reduced-motion</code> settings</a></li></ul>"
    }
  ]
}
</script>

<h2>Animation on by default</h2>


<p>When you implement this way, you are presuming the user loading this webpage is okay with the extra battery power being used to animate this image.  It is not a very nice thing to assume.  I hope your mom is proud of you.</p>

<div id="example2" class="enable-example">
  <div class="pausable-animated-gif">
    <img src="images/running-man-anim__still.jpg" alt="A drawing of a man running" loading="lazy">
    <details open>



      <summary role="button" class="pausable-animated-gif__play-pause-button" aria-label="pause">
      </summary>

      <div class="pausable-animated-gif__animated-image">
        <img src="images/running-man-anim.gif" alt="Animated: A drawing of a man running" loading="lazy">
      </div>
    </details>
  </div>
</div>

<?php includeShowcode("example2"); ?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Ensure details has open attribute set",
      "highlight": "open",
      "notes": "This ensures the animated version is shown by default."
    },
    {
      "label": "Ensure the summary tag has the correct aria-label",
      "highlight": "aria-label",
      "notes": "After doing this step, make sure all other steps in example 1 above are followed."
    }
  ]
}
</script>

<h2>Animation is off when OS prefers reduced motion.</h2>

<p>
  This is the only example on this page that does require JavaScript. It
  detects whether the OS
  has "reduced motion" turned on by default. If it is, then it keeps the
  details widget closed.
</p>

<div id="example3" class="enable-example">
  <div class="pausable-animated-gif pausable-animated-gif--respects-os-motion-settings">
    <img src="images/running-man-anim__still.jpg" alt="A drawing of a man running" loading="lazy">
    <details>



      <summary role="button" class="pausable-animated-gif__play-pause-button"></summary>

      <div class="pausable-animated-gif__animated-image">
        <img src="images/running-man-anim.gif" alt="Animated: A drawing of a man running" loading="lazy">
      </div>
    </details>
  </div>
</div>

<?php includeShowcode("example3"); ?>

<script type="application/json" id="example3-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Put CSS class on container to configure the player",
      "highlight": "pausable-animated-gif--respects-os-motion-settings",
      "notes": "This class will be used in step 3."
    },
    {
      "label": "Use CSS variables to store prefers motion settings",
      "highlight": "%CSS%pausable-animated-gif-style1~ :root;@media (prefers-reduced-motion)",
      "notes": "This sets the CSS variable <strong>--prefers-reduced-motion</strong> to 1 if the user has asked the OS to reduce animations, and 0 otherwise."
    },
    {
      "label": "Use JavaScript to find out if it should show the animation or not",
      "highlight": "%FILE% js/modules/enable-animatedGif.js ~ this.respectReduceMotionSettings",
      "notes": "This function, if run at load time, will initially show the animation if the OS prefers-reduced-motion setting is not on."
    }
  ]
}
</script>