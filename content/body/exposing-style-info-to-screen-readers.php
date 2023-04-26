<p>On many websites, I have come across situations were text has been crossed out using the <code>&lt;del&gt;</code> or
  <code>&lt;strike&gt;</code> tags. Unforunately, most browsers don't expose the role of these tags to screen readers,
  so text coded with these tags can be confusing. Take for example, the product tile below.

<div id="example1" class="enable-example">
  <a class="product-tile product-tile__bad-example"
    href="https://www.useragentman.com/blog/2022/06/16/r-i-p-internet-explorer-a-hate-filled-love-letter/">
    <div class="product-tile__badge">
      <div class="badge-product">
        Clearance Sale
</div>
    </div>

    <div class="product-tile__image-container">
      <img class="product-tile__image" src="https://www.useragentman.com/blog/wp-content/uploads/2022/06/good-bad-thumb.jpg" alt=""
        role="presentation" >
    </div>

    <div class="product-tile__name">
      Internet Explorer T-Shirt
    </div>

    <div class="product-tile__price">
      <del>$30.00</del> <ins>$10.00</ins>
    </div>
  </a>
</div>


<p>
  If you use a screen reader and tab into the product tile, more likely or not, your screen reader will announce
  something like "Link, Clearance Sale. Internet Explorer T-Shirt
  $30.00 $10.00". Screen reader users would not know that the $30.00 is crossed out to denote that the price has dropped to
  $10.00.
</p>


<p>So how can we fix this so screen readers announce the text as deleted or as strike-through text?</p>

<h2>Solution 1: Use Visually Hidden Text</h2>

<?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This is the best way to implement style information to screen readers.')) ?>

<p>
  The most bulletproof way to fix this today that I know of is using visually hidden text inside to the <code>del</code>
  tag to ensure that screen readers know it is old information.  When the user tabs into the product tile below, screen
  readers will announce something like "Link, Clearance Sale. Internet Explorer T-Shirt
  <strong>Old Price:</strong> $30.00 <strong>New Price:</strong> $10.00"
</p>


<div id="sr-only-text-example" class="enable-example">
  <a class="product-tile product-tile--good-example"
    href="https://www.useragentman.com/blog/2022/06/16/r-i-p-internet-explorer-a-hate-filled-love-letter/">
    <div class="product-tile__badge">
      <div class="badge-product">
        Clearance Sale
</div>
    </div>

    <div class="product-tile__image-container">
      <img class="product-tile__image" src="https://www.useragentman.com/blog/wp-content/uploads/2022/06/good-bad-thumb.jpg" alt=""
        role="presentation" >
    </div>

    <div class="product-tile__name">
      Internet Explorer T-Shirt
    </div>

    <div class="product-tile__price">
      <del><span class="sr-only">Old Price: </span>$30.00</del> <ins><span class="sr-only">New Price: </span>$10.00</ins>
    </div>
  </a>
</div>

<p>Let's walk through how we ensure this stricken text is read correctly by screen readers and other assistive
  technologies.</p>

<?php includeShowcode("sr-only-text-example")?>
<script type="application/json" id="sr-only-text-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use the del and ins tags to markup the old and new prices.",
      "highlight": "%OPENCLOSECONTENTTAG%ins ||| %OPENCLOSECONTENTTAG%del",
      "notes": "Note that we use <code>&lt;del&gt;</code> instead of <code>&lt;s&gt;</code> or <code>&lt;strike&gt;</code>.  This is because <code>&lt;del&gt;</code> are semantic tags, and <code>&lt;s&gt;</code> is not, in the same way <a href=\"https://stackoverflow.com/questions/271743/whats-the-difference-between-b-and-strong-i-and-em\">developers should use  strong tags instead of the b tag in HTML</a>"
    },
    {
      "label": "Use the sr-only class to generate screen-reader only text",
      "highlight": "%OPENCLOSECONTENTTAG%span",
      "notes": ""
    }
  ]
}
</script>


<h3>How we use this in Enable</h3>

<p>
  Highlighted text can also be marked up in a similar way to emphasize that it is highlighted. Take this example (which
  is same markup we use in the code walkthroughs to highlight text).  It has visually hidden text to tell screen reader users where the highlighted code begins and ends (e.g. in Voiceover's reading mode, the highlighted code will read "Start of highlighted code" and "End of Highlighted code" at the beginning and end of the code that is highlighted)
</p>

<div id="highlight-example" class="enable-example">
  <pre class="showcode__example"><code>
&lt;div&gt;
  <mark class="showcode__highlight"><span class="sr-only">Start of highlighted code.</span>&lt;del&gt;
  $30.00
&lt;/del&gt;<span class="sr-only">End of highlighted code.</span></mark>
&lt;/div&gt;
  </code></pre>
</div>

<?php includeShowcode("highlight-example", "", "", "", true, 2)?>
<script type="application/json" id="highlight-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use the mark tag to highlight the text",
      "highlight": "%OPENCLOSECONTENTTAG%mark",
      "notes": "The <a href=\"https://developer.mozilla.org/en-US/docs/Web/HTML/Element/mark\">HTML <code>mark</code> tag</a> is the standard HTML tag you should use to highlight text."
    },
    {
      "label": "Use the sr-only class to generate screen-reader only text",
      "highlight": "%OPENCLOSECONTENTTAG%span",
      "notes": ""
    }
  ]
}
</script>



<h2>Solution 2: Using CSS Generated Content</h2>

<?php includeStats(array('doNot' => true, 'comment' => 'Although this works with the majority of screen readers out there, <strong>we do not recommend using this solution in production.</strong> While this seems to be a common way to fix this issue (since it does not require changing the HTML markup), this violates <a href="https://www.w3.org/TR/WCAG20-TECHS/F87.html">Failure of Success Criterion 1.3.1 due to inserting non-decorative content by using ::before and ::after pseudo-elements and the "content" property in CSS</a>.  The main issue with using this is that if a user uses a custom stylesheet to navigate the web, the code in this solution may be removed.   While some may say this is an edge case, it is still technically a violation, which is why we warn against using it.  We do, however, present this solution for informational purposes, and point to some blog posts arguing to using it below.' )) ?>

<p>Another (flawed) way to tell screen readers about styled content is use visually hidden CSS generated content to insert
  visually hidden text before
  the striken price so screen reader users can understand that this was the old price.
  For most screen reader users that tab into the product tile below, screen
  readers will announce something like "Link, Clearance Sale. Internet Explorer T-Shirt
  <strong>Old Price:</strong> $30.00 <strong>New Price:</strong> $10.00"</p>


<div id="css-generated-content-example" class="enable-example">
  <a class="product-tile product-tile--not-as-good-example"
    href="https://www.useragentman.com/blog/2022/06/16/r-i-p-internet-explorer-a-hate-filled-love-letter/">
    <div class="product-tile__badge">
      <div class="badge-product">
        Clearance Sale
</div>
    </div>

    <div class="product-tile__image-container">
      <img class="product-tile__image" src="https://www.useragentman.com/blog/wp-content/uploads/2022/06/good-bad-thumb.jpg" alt=""
        role="presentation" >
    </div>

    <div class="product-tile__name">
      Internet Explorer T-Shirt
    </div>

    <div class="product-tile__price">
      <del>$30.00</del> <ins>$10.00</ins>
    </div>
  </a>
</div>

<p>When you go through the code walkthrough below, you can see we use <code>::before</code> and <code>::after</code> rules to insert the added text into the accessibility tree.
While <a href="https://www.w3.org/TR/WCAG20-TECHS/F87.html">using CSS generated content for non-decorative content is a failure of WCAG 1.3.1</a> because this information will be lost of the user turns off CSS in their browser, <a href="https://adrianroselli.com/2019/02/f87-css-generated-content-and-wcag-conformance.html">Adrian Rosselli has a great article that questions its inclusion as a strict violation</a>.  Because it is considered a failure in the WCAG documentation, we cannot really recommend the use of this code pattern.  That said, we include the following code walkthrough to explain its use in case you see it in the wild (and we are pretty sure this discussion will be an ongoing one).</p>

<p>Here is how the example above is coded:</p>

<?php includeShowcode("css-generated-content-example")?>
<script type="application/json" id="css-generated-content-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use the del and ins tags to markup the old and new prices.",
      "highlight": "%OPENCLOSECONTENTTAG%ins ||| %OPENCLOSECONTENTTAG%del",
      "notes": "Note that we use <code>&lt;del&gt;</code> instead of <code>&lt;s&gt;</code> or <code>&lt;strike&gt;</code>.  This is because <code>&lt;del&gt;</code> are semantic tags, and <code>&lt;s&gt;</code> is not, in the same way <a href=\"https://stackoverflow.com/questions/271743/whats-the-difference-between-b-and-strong-i-and-em\">developers should use  strong tags instead of the b tag in HTML</a>"
    },
    {
      "label": "Use ::before and ::after pseudo-elements to generate screen-reader only text",
      "highlight": "%CSS%product-tile-css~ .product-tile--good-example del::before ||| %CSS%product-tile-css~ .product-tile--good-example ins::before",
      "notes": ""
    },
    {
      "label": "Visually hide the text generated in the previous step to ensure only screen readers can read the text",
      "highlight": "%CSS%product-tile-css~ .product-tile--good-example del::before, .product-tile--good-example ins::before",
      "notes": "Note that this uses similar CSS as the <a href=\"screen-reader-only-text.php\"><code>sr-only</code> class</a> to hide the CSS generated content visually.  Note we also use <code>user-select: none</code> so users can't select the text when they are copying and pasting the content into, say, a word document.  You may decide to leave that part out, if you wish."
    }
  ]
}
</script>



