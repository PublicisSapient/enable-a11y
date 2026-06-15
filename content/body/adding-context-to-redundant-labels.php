<p> A common problem on a lot of e-commerce sites is having a many different product tiles on the page that have an "Add to cart" CTA. For sighted users, users know what product will be added to the cart since the product name is inside the card that the button is. For screen reader users, this is not the case. Screen readers won't read the context near the button when focus is applied to it. The context has to be connected with the CTA somehow.</p>
<div id="native-html-label" class="enable-example">
    <div class="product-tile ">
        <a href="https://www.useragentman.com/blog/2022/06/16/r-i-p-internet-explorer-a-hate-filled-love-letter/" class="product-tile--link">
            <div class="product-tile__badge">
                <div class="badge-product"> Clearance Sale </div>
            </div>
            <div class="product-tile__image-container">
                <img class="product-tile__image" src="https://www.useragentman.com/blog/wp-content/uploads/2022/06/good-bad-thumb.jpg" alt="" role="presentation">
            </div>
            <div class="product-tile__name"> Internet Explorer<br>T-Shirt </div>
            <div class="product-tile__price">
                <mark class="del"><span class="sr-only">Old Price: </span>$30.00</mark>
                <mark class="ins"><span class="sr-only">New Price: </span>$10.00</mark>
            </div>
        </a>
        <button class="product-tile__button">Add to cart</button>
    </div>
</div>
<p>There are several ways to give screen reader users that context. Let's explore them and list their pros and cons.</p>
<h2>Using <code>aria-labelledby</code></h2>
<p> A developer can add the product name and the pricing information to the "Add to Cart" button using the existing DOM with <code>aria-labelledby</code>:</p>
<div id="aria-labelledby-label" class="enable-example">
    <div class="product-tile ">
        <a href="https://en.wikipedia.org/wiki/Netscape_Navigator" class="product-tile--link" id="aria-labelledby-link" >
            <div  class="product-tile__badge">
                <div class="badge-product"> Clearance Sale </div>
            </div>
            <div class="product-tile__image-container">
                <img class="product-tile__image" src="/images/adding-context-to-redundant-labels/netscape.jpg" alt="" role="presentation">
            </div>
            <div class="product-tile__name"> Netscape Navigator Compass </div>
            <div class="product-tile__price">
                <mark class="del"><span class="sr-only">Old Price: </span>$500.00</mark>
                <mark class="ins"><span class="sr-only">New Price: </span>$0.50</mark>
            </div>
        </a>
        <button id="aria-labelledby-button" class="product-tile__button" aria-labelledby="aria-labelledby-button aria-labelledby-link">Add to cart</button>
    </div>
</div>
<?php includeShowcode("aria-labelledby-label")?>
<script type="application/json" id="aria-labelledby-label-props">
    {
        "replaceHtmlRules": {
        },
        "steps": [
        {
            "label": "Add aria-labelledby to CTA",
            "highlight": "aria-labelledby",
            "notes": "Note that the aria-labelledby in the CTA at the end of the code points to two different DOM nodes: itself, and the context.  This allows you to use the existing DOM to give context to screen reader users"
        }
    ]}
</script>
<h3>Pros</h3>
<ol>
    <li>
        <strong>Reuses visible text:</strong>
        <span>You can use what is in the DOM already, if the visual data changes, so will the screen reader label.</span>
    </li>
    <li>
        <strong>Supports multiple sources:</strong>
        <span>You can add multiple parts of the DOM that are not connected. </span>
    </li>
    <li>
        <strong>Keeps visible and accessible labels aligned:</strong>
        <span>Since <code>aria-labelledby</code> can contain multiple IDs, we recommend you always have the first ID the <code>aria-describedby</code> points to be itself in order to comply with <a href="https://www.w3.org/WAI/WCAG21/Understanding/label-in-name.html">WCAG 2.5.3 - Label in Name</a>.</span>
    </li>
</ol>
<h3>Cons</h3>
<ol>
    <li>
        <strong>Fragile to DOM changes:</strong>
        <span>If you accidentally code an ID that doesn't exist, it means the label is broken</span>
    </li>
    <li>
        <strong>Refactoring can silently break accessibility:</strong>
        <span>We strongly suggest using automated tools to ensure you don't acciedentally break the label by accident.</span>
    </li>
</ol>
<h2>Using <code>aria-label</code></h2>
<p>A developer can override the visual label with a label only assistive technology will announce using <code>aria-label</code>.</p>
<div id="aria-label-label" class="enable-example">
    <div class="product-tile ">
        <div class="product-tile__badge">
            <div class="badge-product"> Clearance Sale </div>
        </div>
        <a href="https://en.wikipedia.org/wiki/Netcom_(United_States)" class="product-tile--link">
            <div class="product-tile__image-container">
                <img class="product-tile__image" src="/images/adding-context-to-redundant-labels/netcruiser.jpg" alt="" role="presentation">
            </div>
            <div class="product-tile__name"> Netcruiser Install Disk </div>
            <div class="product-tile__price">
                <mark class="del"><span class="sr-only">Old Price: </span>$35.99</mark>
                <mark class="ins"><span class="sr-only">New Price: </span>$4.00</mark>
            </div>
        </a>
        <button class="product-tile__button" aria-label="Add to cart - Netcruiser Install Disk, Old Price: $35.99, New Price: $4.00">Add to cart</button>
    </div>
</div>
<?php includeShowcode("aria-label-label")?>
<script type="application/json" id="aria-label-label-props">
    {
        "replaceHtmlRules": {
        },
        "steps": [
        {
            "label": "Set the aria label for the element",
            "highlight": "aria-label",
            "notes": "This aria label gives context by overriding the accessible label with content that is not in the DOM."
        }
    ]}
</script>
<h3>Pros</h3>
<ol>
    <li>
        <strong>No DOM dependencies:</strong>
        <span>No IDs or structure required.</span>
    </li>
    <li>
        <strong>Useful when no visible label exists:</strong>
        <span> This is an ideal solution if you have to make an icon-only buttons accessible and you can't use the alt text of the image to do so.</span>
    </li>
</ol>
<h3>Cons</h3>
<ol>
    <li>
        <strong>Overrides visible text:</strong>
        <span>Can create mismatch between what users see vs hear. Your labels can fails WCAG 2.5.3 (Label in Name) easily if visible text doesn't begin with the aria-label text.</span>
    </li>
    <li>
        <strong>Localization risk:</strong>
        <span>If you are using a external localization framework to translate your website like <a href="https://www.motionpoint.com/">MotionPoint</a>, it may not translate text inside of aria-labels (Note: we are not claiming that Motionpoint doesn't do this, but we have noticed services like it have trouble with this sometimes). </span>
    </li>
    <li>
        <strong>They are often forgotten by developers and content owners:</strong>
        <span>Out of sight often means out of mind. Aria-labels are often forgotten and can drift away from the visual text after a number of code revisions.</span>
    </li>
</ol>
<h2>Using sr-only text</h2>
<p>A developer can augment the existing visual label with visually hidden text using <a href="screen-reader-only-text.php">screen reader only text</a>.</p>
<div id="sr-only-label" class="enable-example">
    <div class="product-tile ">
        <div class="product-tile__badge">
            <div class="badge-product">A Real Steal!</div>
        </div>
        <a href="https://en.wikipedia.org/wiki/Napster" class="product-tile--link">
            <div class="product-tile__image-container">
                <img class="product-tile__image" src="/images/adding-context-to-redundant-labels/napster.jpg" alt="" role="presentation">
            </div>
            <div class="product-tile__name"> Napster Headphones </div>
            <div class="product-tile__price">
                <mark class="del"><span class="sr-only">Old Price: </span>$55.00</mark>
                <mark class="ins"><span class="sr-only">New Price: </span>Free</mark>
            </div>
        </a>
        <button class="product-tile__button">Add to cart <span class="sr-only"> - Napster Headphones, Old price $55.00, now Free</span></button>
    </div>
</div>
<?php includeShowcode("sr-only-label")?>
<script type="application/json" id="sr-only-label-props">
    {
        "replaceHtmlRules": {
        },
        "steps": [
        {
            "label": "Add screen reader only text to the end of a label",
            "highlight": "%OPENCLOSECONTENTTAG%button class=\"product-tile__button\"",
            "notes": "Note the sr-only text after the \"Add to Cart\" literal."
        }
    ]}
</script>
<h3>Pros</h3>
<ol>
    <li>
        <strong>Keeps visible + accessible text aligned:</strong>
        <span>Just add the screen reader only text after the visual name.</span>
    </li>
</ol>
<h3>Cons</h3>
<ol>
    <li>
        <strong>Like <code>aria-label</code>, they are often forgotten by developers and content owners:</strong>
        <span>Out of sight often means out of mind. Aria-labels are often forgotten and can drift away from the visual text after a number of code revisions.</span>
    </li>
</ol>
<h2>Using <code>aria-labelledby</code> or <code>aria-label</code> on a group element</h2>
<p>A developer can use ARIA to label the group element of many CTAs at once.</p>
<div id="group-aria-label-label" class="enable-example" >
    <div class="product-tile " role="group" aria-labelledby="group-arial-label__product-name" >
        <div class="product-tile__badge">
            <div class="badge-product">It Can Belong To You!</div>
        </div>
        <a href="https://en.wikipedia.org/wiki/All_your_base_are_belong_to_us" class="product-tile--link" id="group-arial-label__product-name">
            <div class="product-tile__image-container">
                <img class="product-tile__image" src="/images/adding-context-to-redundant-labels/all-your-base.jpg" alt="" role="presentation">
            </div>
            <div class="product-tile__name"> All Your Bass Base Guitar </div>
            <div class="product-tile__price">
                <mark class="del"><span class="sr-only">Old Price: </span>$55.00</mark>
                <mark class="ins"><span class="sr-only">New Price: </span>$12.00</mark>
            </div>
        </a>
        <button class="product-tile__button">Add to cart </button>
    </div>
</div>
<?php includeShowcode("group-aria-label-label")?>
<script type="application/json" id="group-aria-label-label-props">
    {
        "replaceHtmlRules": {
        },
        "steps": [
        {
            "label": "Add an aria-labelledby to the group element surrounding your CTAs",
            "highlight": "aria-labelledby",
            "notes": "You can also use aria-label here instead, but this example uses the existing DOM, which is always better."
        }
    ]}
</script>
<h3>Pros</h3>
<ol>
    <li>
        <strong>It can give context to a group of controls:</strong>
        <span>No need to add context to each individual control means less code.</span>
    </li>
</ol>
<h3>Cons</h3>
<ol>
    <li>
        <strong>Doesn't help when user uses screen readers to list CTAs on page.</strong>
        <span>Doesn't give context when using NVDA's Elements List or Voiceover's Rotor.</span>
    </li>
</ol>
