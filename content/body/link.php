<!-- <aside class="notes">
        <h2>Notes:</h2>

        <ul>
          <li>HTML and ARIA links work the same way</li>
        </ul>
      </aside> -->

<p>
  Don't be fooled -- even if they look like buttons, they are links and should be marked up like links,
  so screen reader users know what will happen when the press it. In fact, I would argue that
  <a
    href="https://medium.com/simple-human/but-sometimes-links-look-like-buttons-and-buttons-look-like-links-9b371c57b3d2">
    links should visually
    look like links and not buttons</a> (kudos to <a href="https://medium.com/@adambsilver">Adam Silver</a> for
  articulating this point
  extremely well).
</p>

<p>
  This page will go through several different types of links, how to code them, and how to add visual cues so users can
  know what kind
  of links they are.
</p>

<h2>Native HTML5</h2>

<?php includeStats(array('isForNewBuilds' => true)) ?>

<p>
  Everyone who took basic HTML knows how to code these, but there are a few things below that you may have never known
  about (like how to code a self-referring link). In order to pass WCAG:
</p>

<ol>
  <li>they must have a 3:1 contrast ratio from the surrounding non-link text.</li>
  <li>they must present a "non-color designator" (typically the introduction of the underline)
    on both mouse hover and keyboard focus</li>
</ol>

<div id="html5-examples" class="enable-example">
  <p>
    This paragraph has a few native
    <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a">HTML5 links</a>
    in it. It is best to use native, non-ARIA links because they are
    guarenteed to be used in
    <a href="https://en.wikipedia.org/wiki/Netscape_Navigator">older browsers</a>
    and <a href="https://en.wikipedia.org/wiki/Wget">other user agents</a>.
  </p>

</div>

<?php includeShowcode("html5-examples")?>

<script type="application/json" id="html5-examples-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Use a tags",
    "highlight": "%OPENCLOSECONTENTTAG%a",
    "notes": "As long as the <code>a</code> tag has an <code>href</code> attribute, it is keyboard accessible by default."
  }]
}
</script>

<h2>Links That "Look Like Buttons"</h2>

<p>
  There are many times where you want a CTA to stick out from the rest of the text, maybe even covering a more prominent
  and bigger area on the screen. If you make the CTA look like a button, you are being dishonest: it <em>looks</em> like
  a button, but its not since it has a URL associated with it. In order to distinguish this from other buttons, we
  should make a small change to it, like adding a right pointing chevron to the CTA like the example below:
</p>

<?php
    include 'includes/hero-example.php';
?>

<?php includeShowcode("hero-example")?>
<script type="application/json" id="hero-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Mark up CTA as a link",
      "highlight": "%OPENCLOSECONTENTTAG%a",
      "notes": ""
    },
    {
      "label": "Use an aria-label to give context to screen reader users",
      "highlight": "aria-label",
      "notes": "Using the label \"Learn More\" doesn't give screen reader users a lot of context about what they are going to learn about, especially when the are tabbing around the user interface with their keyboard.  In order to work around this, we add an <code>aria-label</code> to give that context.  There are other ways to solve this issue - <a href=\"https://www.visionaustralia.org/\">Vision Austrailia</a> has a great rundown of these options in their article, <a href=\"https://www.visionaustralia.org/services/digital-access/blog/how-to-make-read-more-links-accessible\">How to make \"Read more\" links accessible</a>."
    },
    {
      "label": "Add chevron via CSS",
      "highlight": "%CSS% figure-css~ a.tile-cta::after ||| content:[^;]*;",
      "notes": ""
    }
  ]
}
</script>


<h2>Breadcrumbs</h2>

<p>
  Breadcrumbs are usually at the top of the page after the main nav. Users can use them to navigate the heirarchy that
  the current page resides.
</p>

<p>
  The styling of this example comes from the <a
    href="https://www.w3.org/TR/wai-aria-practices/examples/breadcrumb/index.html">W3C WAI-ARIA Authoring Practices page
    on Breadcrumbs</a>.
</p>

<div id="breadcrumb-example" class="enable-example">

  <nav class="breadcrumb" aria-label="breadcrumb">
    <ol>
      <li><a href="index.php">Enable</a></li>
      <li><a href="form.php">Form Elements</a></li>
      <li><a href="link.php" aria-current="page">Links</a></li>
    </ol>
  </nav>
</div>

<?php includeShowcode("breadcrumb-example")?>

<script type="application/json" id="breadcrumb-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Make the breadcrumb a nav",
    "highlight": "%OPENCLOSETAG%nav",
    "notes": ""
  },
  {
    "label": "Add an aria label to the nav",
    "highlight": "aria-label",
    "notes": "This will make it easy for screen reader users to differentiate the breadcrumb navigation from other bits of navigation on the page, espeecially if they would like to jump to it using NVDA's Element List, VoiceOver's rotor, or anything similar in any other screen reader being used."
  },
  {
    "label": "Use aria-current for self referring links",
    "highlight": "aria-current",
    "notes": "Screen readers will announce that a link points the current page if this attribute is set.  This is very useful when implementing breadcrumbs."
  }]
}
</script>

<h2>Links That Open a New Window</h2>

<div id="open-new-window-example" class="enable-example">
  <p>
    To find out more information about this subject, read <a target="_blank"
      href="https://equalizedigital.com/accessibility-checker/link-opens-new-window-or-tab/">Equalized Digital's page on
      Links That Open a New Window or Tab

      <img class="new-window-icon" src="images/icons/new-window.svg" alt="(Opens in a new window)" />

    </a>
  </p>
</div>

<?php includeShowcode("open-new-window-example")?>

<script type="application/json" id="open-new-window-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Add an image icon to denote that a new window will open when the user click on the link",
    "highlight": "%OPENTAG%img",
    "notes": "This image, which is in the <a href=\"https://commons.wikimedia.org/wiki/File:OOjs_UI_icon_newWindow-ltr.svg\">Wikimedia Commons</a> was originally made by <a href=\"https://commons.wikimedia.org/wiki/User:MGalloway_(WMF)\">Mun May Tee-Galloway</a>, a User Experience/Visual Designer of the Wikimedia Foundation."
  }]
}
</script>

<h2>Using ARIA</h2>

<?php includeStats(array('isForNewBuilds' => false)) ?>

<p>
  I am not sure why anyone would code a link with anything but an <code>&lt;a&gt;</code> tag, but
  then again, I am not sure <a
    href="https://www.denofgeek.com/movies/what-went-wrong-with-highlander-ii-the-quickening/">why someone would think
    Highlander II
    was a good idea either</a>, so I guess anything's possible.
</p>

<div id="aria-examples" class="enable-example">
  <p>
    This paragraph has a few
    <span
      data-href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_link_role"
      tabindex="0" role="link">ARIA link tags</span>
    in it. They are coded as <code>span</code> tags with the following
    attributes set:
  </p>
  <ul>
    <li>
      <code>tabindex="0"</code> set (to make them keyboard accessible)
    </li>
    <li>
      <code>role="link"</code>, so that a screen reader reports them
      correctly.
    </li>
  </ul>

  <p>
    In order for them to be functional, they need to have
    <span data-href="https://en.wikipedia.org/wiki/JavaScript" tabindex="0" role="link">JavaScript</span>
    added to them to make them functional. Feel free to use
    <span data-href="js/link.js" tabindex="0" role="link">the script we use in this demo</span>
    if you need to use it.
  </p>
</div>

<?php includeShowcode("aria-examples")?>

<script type="application/json" id="aria-examples-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use role=\"link\" on elements you want to be fake tags",
      "highlight": "role=\"link\"",
      "notes": "Screen readers will now report these as links"
    },
    {
      "label": "Make sure you remember to add tabindex=\"0\" on fake links",
      "highlight": "tabindex=\"0\"",
      "notes": "This makes the fake links accessible."
    },
    {
      "label": "Create Javascript events",
      "highlight": "%JS% ariaLinkShim",
      "notes": "This code will activate the links using mouse clicks or hitting the ENTER key"
    },
    {
      "label": "Create CSS",
      "highlight": "%CSS%link-css~ [role=\"link\"]",
      "notes": "Make sure the CSS makes a link look like a link"
    }
  ]
}
</script>