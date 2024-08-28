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
    <section id="product-grid">
      <div class="product-tile">
        <a href="/" class="product-details-link">
          <span class="sr-only">Modern Tufted Armless Lounge Chair</span>
        </a>
        <img src="images/load-more/chair1.png" alt="Modern Tufted Armless Lounge Chair" />
        <p class="product-name">Modern Tufted Armless Lounge Chair</p>
        <p class="product-price">$399.99</p>
        <button type="button" class="add-to-cart-btn" aria-label="Add Modern Tufted Armless Lounge Chair to cart.">Add to Cart</button>
      </div>

      <div class="product-tile">
        <a href="/" class="product-details-link">
          <span class="sr-only">Minimalist Felt Lounge Chair</span>
        </a>
        <img src="images/load-more/chair2.png" alt="Minimalist Felt Lounge Chair" />
        <p class="product-name">Minimalist Felt Lounge Chair</p>
        <p class="product-price">$199.99</p>
        <button type="button" class="add-to-cart-btn" aria-label="Add Minimalist Felt Lounge Chair to cart.">Add to Cart</button>
      </div>

      <div class="product-tile">
        <a href="/" class="product-details-link">
          <span class="sr-only">Classic Tufted Leather Wingback Chair</span>
        </a>
        <img src="images/load-more/chair3.png" alt="Classic Tufted Leather Wingback Chair" />
        <p class="product-name">Classic Tufted Leather Wingback Chair</p>
        <p class="product-price">$799.99</p>
        <button type="button" class="add-to-cart-btn" aria-label="Add Classic Tufted Leather Wingback Chair to cart.">Add to Cart</button>
      </div>
    </section>
    <p id="product-count" aria-live="polite">Showing 3 of 9 products</p>
    <button id="load-more-btn" type="button">Load More Products</button>
    <button id="product-reset-btn" class="hide-btn" type="button">Reset Product Grid Demo</button>
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
  <section id="view-grid">
    <div class="view-tile">
      <div class="tile-relative">
        <img src="images/load-more/chair1.png" alt="Modern Tufted Armless Lounge Chair" />
        <button type="button" class="view-details-link">
          Shop Modern Chairs
        </button>
      </div>
    </div>

    <div class="view-tile">
      <div class="tile-relative">
        <img src="images/load-more/chair2.png" alt="Minimalist Felt Lounge Chair" />
        <button type="button" class="view-details-link">
          Shop Simple Chairs
        </button>
      </div>
    </div>

    <div class="view-tile">
      <div class="tile-relative">
        <img src="images/load-more/chair3.png" alt="Classic Tufted Leather Wingback Chair" />
        <button type="button" class="view-details-link">
          Shop Leather Chairs
        </button>
      </div>
    </div>
  </section>
  <p id="view-count" aria-live="polite">Showing 3 of 9 categories</p>
  <button id="view-more-btn" type="button">View More Categories</button>
  <button id="view-reset-btn" class="hide-btn" type="button">Reset Category Grid Demo</button>
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