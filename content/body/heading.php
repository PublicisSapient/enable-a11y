<p>
  Many users use headings to visually skim through a web page.  They usually give (and should give) a brief summary of the more detailed content below them.  If you are sighted, you can find the headings in the image of the newspaper below quite easily:
</p>


<div class="enable-example">
<figure>
                
  <img src="images/newspaper-headings.jpg" alt="" />
 
    <figcaption>The front page of the Toronto Star Newspaper. Note that the headings are significantly bigger and have a different typographic treatment than the body copy underneath it.  Because of these features, sighted users can skim through these headings very quickly.</figcaption>


</figure>
</div>


<p>
  Screen reader users also use headings to skim through a web page quickly, and are used by screen-reader users as a table of contents. For example, using NVDA, this is done via the Elements List, and for Voiceover, this is done via The Rotor.  The following video shows how screen reader users use these tools.
</p>

<div class="enable-example">
  Insert video here
</div>

<h2>HTML5 Headings</h2>

<?php includeStats(["isForNewBuilds" => true]); ?>

<p>
  Most developers are familiar HTML5 heading tags (<code>&lt;h1&gt;</code> to <code>&lt;h6&gt;</code>)
  Note that lower heading levels (e.g. h1) don't necessarily have to be visually larger than higher ones (e.g. H4), bit it is a common convention. The following are HTML headings. The styling was originally derived from
      <a
        href="https://tympanus.net/codrops/2012/11/02/heading-set-styling-with-css/">Heading
        Set Styling
        with CSS </a>
      by
      <a href="https://kittygiraudel.com">Kitty Giraudel</a>
</p>


<div id="html-example" class="heading-example enable-example">
    <h1>This is an h1</h1>
    <h2>This is an h2</h2>
    <h3>This is an h3</h3>
    <h4>This is an h4</h4>
    <h5>This is an h5</h5>
    <h6>This is an h6</h6>
</div>

<?php includeShowcode("html-example"); ?>
<script type="application/json"
  id="html-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Add heading HTML tags",
    "highlight": "%OPENCLOSETAG%h1 ||| %OPENCLOSETAG% h2 ||| %OPENCLOSETAG% h3 ||| %OPENCLOSETAG% h4 ||| %OPENCLOSETAG% h5 ||| %OPENCLOSETAG% h6",
    "notes": ""
  },
  {
    "label": "Optional: Add tabindex=\"-1\" to all headings",
    "highlight": "%JS% initEnable ||| document.querySelectorAll[\\s\\S]*\\}\\)",
    "notes": "This makes it easier for users of screen readers like Voiceover to skip over headings."
  }]
}
</script>

<h2>ARIA Headings</h2>

<?php includeStats([
    "isForNewBuilds" => false,
    "comment" =>
        "You can fix existing markup this way, but really, why not just change the markup to the HTML5 ones?",
]); ?>

<p>The following are ARIA headings. Note that ARIA supports
  heading levels 1-10.
</p>

<p>
  Besides <a href="https://www.w3.org/TR/using-aria/#rule1">The First Rule of ARIA</a>, you should use real HTML5 headings since they affect how a web pages is indexed by search engines.
</p>

<div id="aria-example"
  class="heading-example enable-example">
  <div role="heading"
    aria-level="1">This in an ARIA heading level 1</div>
  <div role="heading"
    aria-level="2">This in an ARIA heading level 2</div>
  <div role="heading"
    aria-level="3">This in an ARIA heading level 3</div>
  <div role="heading"
    aria-level="4">This in an ARIA heading level 4</div>
  <div role="heading"
    aria-level="5">This in an ARIA heading level 5</div>
  <div role="heading"
    aria-level="6">This in an ARIA heading level 6</div>
  <div role="heading"
    aria-level="7">This in an ARIA heading level 7 (there is no HTML5
    equivalent)</div>
</div>

<?php includeShowcode("aria-example"); ?>
<script type="application/json"
  id="aria-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Add heading roles",
      "highlight": "role",
      "notes": ""
    },
    {
      "label": "Add aria-level",
      "highlight": "aria-level",
      "notes": "Note with aria-level, you can have heading levels greater than 6."
    },
    {
      "label": "Optional: Add tabindex=\"-1\" to all headings",
      "highlight": "%JS% initEnable ||| \\s\\sdocument\\.querySelectorAll[\\s\\S]*\\}\\)",
      "notes": "Just like for HTML headings, This makes it easier for users of screen readers like Voiceover to skip over headings."
    }
  ]
}
</script>