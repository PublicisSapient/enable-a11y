<p>On many websites, I have come across situations were text has been crossed out using the <code>&lt;del&gt;</code> or
  <code>&lt;strike&gt;</code> tags. Unforunately, most browsers don't expose the role of these tags to screen readers,
  so text coded with these tags can be confusing. Take for example, the product tile below.

<div id="example1" class="enable-example">
  <a class="product-tile product-tile__bad-example"
    href="https://www.useragentman.com/blog/2022/06/16/r-i-p-internet-explorer-a-hate-filled-love-letter/">
    <div class="product-tile__badge">
      <span class="badge-product">
        Clearance Sale
      </span>
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

<h2>CSS Generated Content To The Rescue</h2>

<p>
  If you use a screen reader and tab into the product tile, more likely or not, your screen reader will announce
  something like "Link, Clearance Sale. Internet Explorer T-Shirt
  $30.00 $10.00". Screen reader users would not know that the $30.00 is crossed out to denote that the price has dropped to
  $10.00. In order to fix this, developers can use CSS generated content as well as screen reader only text to insert
  visually hidden text before
  the striken price so screen reader users can understand that this was the old price.
</p>

<div id="example2" class="enable-example">
  <a class="product-tile product-tile--good-example"
    href="https://www.useragentman.com/blog/2022/06/16/r-i-p-internet-explorer-a-hate-filled-love-letter/">
    <div class="product-tile__badge">
      <span class="badge-product">
        Clearance Sale
      </span>
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

<p>Let's walk through how we ensure this stricken text is read correctly by screen readers and other assistive
  technologies.</p>

<?php includeShowcode("example2")?>
<script type="application/json" id="example2-props">
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
      "notes": "Note that this uses similar CSS as the <a href=\"https://www.w3docs.com/snippets/css/why-and-how-the-bootstrap-sr-only-class-is-used.html\"><code>sr-only</code> class</a> to hide the CSS generated content visually.  Note we also use <code>user-select: none</code> so users can't select the text when they are copying and pasting the content into, say, a word document.  You may decide to leave that part out, if you wish."
    }
  ]
}
</script>

<h2>How we use this in Enable</h2>

<p>
  Highlighted text can also be marked up in a similar way to emphasize that it is highlighted. Take this example (which
  is same markup we use in the code walkthroughs to highlight text):
</p>

<div id="highlight-example" class="enable-example">
  <pre class="showcode__example"><code>
&lt;div&gt;
  <mark class="showcode__highlight">&lt;del&gt;
    $30.00
&lt;/del&gt;</mark>
&lt;/div&gt;
  </code></pre>
</div>

<p>The code to generate the highlighted text is very similar to the one used for the stikethrough text example, except
  we use both a <code>::before</code> and a <code>::after</code> rule:</p>

<?php includeShowcode("highlight-example")?>
<script type="application/json" id="highlight-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use the mark tag to highlight the text",
      "highlight": "%OPENCLOSECONTENTTAG%mark",
      "notes": "The <a href=\"https://developer.mozilla.org/en-US/docs/Web/HTML/Element/mark\">HTML <code>mark</code> tag</a> is the standard HTML tag you should use to highlight text."
    },
    {
      "label": "Use ::before and ::after rules to have screen readers announce the text as highlighted",
      "highlight": "%CSS%showcode-css~ .showcode__highlight::before ||| %CSS%showcode-css~ .showcode__highlight::after",
      "notes": "Note we use <strong>both</strong> the <code>::before</code> and <code>::after</code> rules here.  This is to ensure screen reader users know where the highlighted text begin and end, since it can be quite long."
    },
    {
      "label": "Hide the CSS generated content from screen readers.",
      "highlight": "%CSS%showcode-css~ .showcode__highlight::before, .showcode__highlight::after",
      "notes": "Just like in the previous example, we hide the CSS generated content visually so only screen readers will read the content."
    }
  ]
}
</script>