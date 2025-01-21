<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        "This is the best solution to use, especially when building from scratch.",
]); ?>

<p>In today's digital age, where everything is online and always connected, companies strive to keep users engaged with their content for as long as possible. Various patterns have emerged for managing paginated content, and since the advent of social media, one particular pattern has become prevalent: infinite scroll. While this approach may be beneficial for companies looking to increase user engagement by encouraging endless scrolling, it is not always the most accessible or user-friendly option. In some cases, it can even undermine the primary objectives of a website.</p>

<p>In the following demos, we will focus on an alternative to infinite scroll: the "load more" button. This method prevents users from becoming trapped in an endless loop of content, allowing them to easily navigate the rest of the site. It's worth noting that other alternatives, such as traditional pagination, also exist, but for the purposes of these demos, our emphasis will be on the load more button.</p>

<p>For a deeper understanding of the drawbacks of infinite scrolling on user experience, consider reading this insightful article by the Nielsen Norman Group: <a href="https://www.nngroup.com/articles/infinite-scrolling/">Infinite Scrolling Is Not for Every Website</a></p>

<p>The following demonstrations use placeholder assets sourced from <a href="https://dev.me/products/image-placeholder">The Dev.me Image Placeholder API</a>.</p>

<h2>Category Grid Load More Example</h2>

<p>Category grids are typically straightforward components. However, incorporating a "load more" button introduces additional complexity, particularly when ensuring that these components remain accessible. The key takeaway from this example is understanding how the "load more" functionality operates. Notably, when additional category tiles are loaded, the user's focus is returned to the first tile in the newly loaded set. This approach allows users to seamlessly continue from where they left off before clicking the "load more" button.</p>

<div id="example1" class="enable-example">
  <p id="category-count" aria-live="polite">Showing 3 of 9 Categories</p>

  <section id="view-grid">
    <div class="view-tile">
      <div class="tile-relative">
        <img src="images/load-more/chair1.png" alt="Modern Tufted Armless Lounge Chair" />
        <a href="/" class="view-details-link">
          Shop Modern Chairs
        </a>
      </div>
    </div>

    <div class="view-tile">
      <div class="tile-relative">
        <img src="images/load-more/chair2.png" alt="Minimalist Felt Lounge Chair" />
        <a href="/" class="view-details-link">
          Shop Simple Chairs
        </a>
      </div>
    </div>

    <div class="view-tile">
      <div class="tile-relative">
        <img src="images/load-more/chair3.png" alt="Classic Tufted Leather Wingback Chair" />
        <a href="/" class="view-details-link">
          Shop Leather Chairs
        </a>
      </div>
    </div>
  </section>

  <button id="display-more-btn" type="button">Display More Categories</button>
  <button id="display-reset-btn" class="hide-btn" type="button">Reset Category Grid Demo</button>
</div>

<?php includeShowcode("example1"); ?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Add a product counter and add the aria-live attribute",
      "highlight": "%OPENCLOSECONTENTTAG%p id=\"category-count\"",
      "notes": "It's a good idea to tell users how many products they're viewing out of the total number of products. We add the aria-live attribute set to polite to ensure that when it updates, it will be read out by the screen reader after the focused element is read."
    },
    {
      "label": "Ensure all images have alt tags",
      "highlight": "alt",
      "notes": "It's important to make sure that all images have a descriptive alt tag."
    },
    {
      "label": "Ensure anchor tags contain both the action and the category name",
      "highlight": "%OPENCLOSETAG%a ||| %OPENCLOSECONTENTTAG%a",
      "notes": "It's important that the user knows what action the anchor tags will perform by clicking on them. In our case we've inlcuded the word \"Shop\" in front of the category name. This tells the user they'll be linked to a shops page for the category. For this example we're linking to \"/\", in a real world application this should go to the category page."
    },
    {
      "label": "Ensure buttons contain the action and the descriptor",
      "highlight": "%OPENCLOSECONTENTTAG%button id=\"display-more-btn\"",
      "notes": "Make sure that you're including both the action and a descriptor for buttons. This tells the user what they can expect by clicking the button."
    },
    {
      "label": "Ensure the focus goes to the proper tile after clicking Display More Categories button.",
      "highlight": "%FILE% ./js/demos/load-more/load-more.js ~ \\s*const productTiles[\\s\\S]*?\\}\\)\\;",
      "notes": "It's important to move the users focus state to the first item in the newly loaded products. For demo purposes we're including a reset button. In the real world this data would likely come from an API request. By setting the users focus to the first item in the new batch of products a user can keep browsing through the tiles where they left off."
    },
    {
      "label": "Update the product counter when loading more",
      "highlight": "%FILE% ./js/demos/load-more/load-more.js ~ \\s*this.setCount[\\s\\S]*?\\)\\;",
      "notes": "We're calling a counter update function in the demo to change the text of the \"Showing X of X Categories\" text to update the product count the user is viewing. Remember that we added aria-live=\"polite\" to this text in step 1. This will announce the update to the user. In a real application this data would likely come from an API."
    }
  ]
}
</script>

<h2>Product Listing Page Load More Example</h2>

<p>Product listing pages with "load more" functionality can become quite complex. Typically, each product tile not only provides a clickable link to a detailed product page but also includes several other interactive elements. For example, you may have product ratings, an "add to favorites" button, an "add to cart" button, and other interactive features, all of which need to be made accessible.</p>

<p>The following example is relatively basic but demonstrates how you might structure your product tiles. A key consideration is how the tile elements are grouped using role="group" along with aria-labelledby="productNameId", ensuring accessibility and ease of navigation. Additionally, when more product tiles are loaded, the user's focus is returned to the first tile in the newly loaded set. This feature allows users to seamlessly continue their browsing experience from where they left off before clicking the "load more" button.</p>

<div id="example2" class="enable-example">
  <p id="product-count" aria-live="polite">Showing 3 of 9 Products</p>

  <section id="product-grid">
    <div class="product-tile" role="group" aria-labelledby="product-grid-product-1">
      <a href="/" class="product-details-link">
        <span class="sr-only">Modern Tufted Armless Lounge Chair</span>
      </a>
      <img src="images/load-more/chair1.png" alt="Modern Tufted Armless Lounge Chair" />
      <p id="product-grid-product-1" class="product-name">Modern Tufted Armless Lounge Chair</p>
      <p class="product-price">$399.99</p>
      <button type="button" class="add-to-cart-btn">Add to Cart</button>
    </div>

    <div class="product-tile" role="group" aria-labelledby="product-grid-product-2">
      <a href="/" class="product-details-link">
        <span class="sr-only">Minimalist Felt Lounge Chair</span>
      </a>
      <img src="images/load-more/chair2.png" alt="Minimalist Felt Lounge Chair" />
      <p id="product-grid-product-2" class="product-name">Minimalist Felt Lounge Chair</p>
      <p class="product-price">$199.99</p>
      <button type="button" class="add-to-cart-btn">Add to Cart</button>
    </div>

    <div class="product-tile" role="group" aria-labelledby="product-grid-product-3">
      <a href="/" class="product-details-link">
        <span class="sr-only">Classic Tufted Leather Wingback Chair</span>
      </a>
      <img src="images/load-more/chair3.png" alt="Classic Tufted Leather Wingback Chair" />
      <p id="product-grid-product-3" class="product-name">Classic Tufted Leather Wingback Chair</p>
      <p class="product-price">$799.99</p>
      <button type="button" class="add-to-cart-btn">Add to Cart</button>
    </div>
  </section>
  
  <button id="load-more-btn" type="button">Load More Products</button>
  <button id="product-reset-btn" class="hide-btn" type="button">Reset Product Grid Demo</button>
</div>



<?php includeShowcode("example2"); ?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Add a product counter and add the aria-live attribute",
      "highlight": "%OPENCLOSECONTENTTAG%p id=\"product-count\"",
      "notes": "It's a good idea to tell users how many products they're viewing out of the total number of products. We add the aria-live attribute set to polite to ensure that when it updates, it will be read out by the screen reader after the focused element is read."
    },
    {
      "label": "Ensure all images have alt tags",
      "highlight": "alt",
      "notes": "It's important to make sure that all images have a descriptive alt tag."
    },
    {
      "label": "Ensure anchor tags contain both the action and the category name",
      "highlight": "%OPENCLOSETAG%a ||| %OPENCLOSECONTENTTAG%a",
      "notes": "It's important that the user knows what action the anchor tags will perform by clicking on them. In our case we've inlcuded the word \"Shop\" in front of the category name. This tells the user they'll be linked to a shops page for the category. For this example we're linking to \"/\", in a real world application this should go to the category page."
    },
    {
      "label": "Ensure buttons contain the action and the descriptor",
      "highlight": "%OPENCLOSETAG%button ||| %OPENCLOSECONTENTTAG%button",
      "notes": "Make sure that you're including both the action and a descriptor for buttons. This tells the user what they can expect by clicking the button."
    },
    {
      "label": "Ensure the product tile contains the proper role and aria-labelledby",
      "highlight": "%OPENTAG%div class=\"product-tile\"",
      "notes": "Since the product tiles contain more than 1 interactive element, it's important to add a role=\"group\" along with an aria-labelledby which points to the ID of the product name. This will ensure that when a user focuses one of the interactive elements, the screen reading will announce that these elements are apart of the group labelled by the product name. This is helpful for when a user tabs past the Add to Cart button and then shift tabs backwords. Without this the user may not know what they are adding to cart."
    },
    {
      "label": "Ensure the focus goes to the proper tile after clicking Load More Products button",
      "highlight": "%FILE% ./js/demos/load-more/load-more.js ~ \\s*const productTiles[\\s\\S]*?\\}\\)\\;",
      "notes": "It's important to move the users focus state to the first item in the newly loaded products. For demo purposes we're including a reset button. In the real world this data would likely come from an API request. By setting the users focus to the first item in the new batch of products a user can keep browsing through the tiles where they left off."
    },
    {
      "label": "Update the product counter when loading more",
      "highlight": "%FILE% ./js/demos/load-more/load-more.js ~ \\s*this.setCount[\\s\\S]*?\\)\\;",
      "notes": "We're calling a counter update function in the demo to change the text of the \"Showing X of X Products\" text to update the product count the user is viewing. Remember that we added aria-live=\"polite\" to this text in step 1. This will announce the update to the user. In a real application this data would likely come from an API."
    }
  ]
}
</script>