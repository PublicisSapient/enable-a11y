<p>On many websites, I have come across situations were text has been crossed out using the <code>&lt;del&gt;</code> or
  <code>&lt;strike&gt;</code> tags. Unfortunately, most browsers don't expose the role of these tags to screen readers,
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
      Internet Explorer<br />T-Shirt
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

<h2>Solution: Use Visually Hidden Text</h2>

<?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This is the best way to implement style information to screen readers.')) ?>

<p>
  The most bulletproof way to fix this today that I know of is using visually hidden text to ensure that screen readers know it is old information. <strong>Notice that I am not using <code>del</code>
  or <code>ins</code> tags here: this is because some screenreaders do not read text inside <code>del</code>
  and <code>ins</code> reliably</strong>.  Some web browsers, like Voiceover with Safari, don't even read the content at all.  When the user tabs into the product tile below, screen
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
      Internet Explorer<br />T-Shirt<div class="sr-only">.</div>
    </div>

    <div class="product-tile__price">
      <mark class="del"><span class="sr-only">Old Price: </span>$30.00</mark> <mark class="ins"><span class="sr-only">New Price: </span>$10.00</mark>
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
      "label": "Use the mark tags to markup the old and new prices.",
      "highlight": "%OPENCLOSECONTENTTAG%mark",
      "notes": "Note that we use <code>.del</code> and <code>.ins</code> classes to denote deleted and inserted content respectively. We also don't use <code>&lt;s&gt;</code> or <code>&lt;strike&gt;</code>.  This is because <code>&lt;mark&gt;</code> is a semantic tag, and <code>&lt;s&gt;</code> or <code>&lt;strike&gt;</code> are not, in the same way <a href=\"https://stackoverflow.com/questions/271743/whats-the-difference-between-b-and-strong-i-and-em\">developers should use strong tags instead of the b tag in HTML</a>"
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





