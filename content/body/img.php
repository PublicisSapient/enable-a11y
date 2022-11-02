<!-- <aside class="notes">

            <h2>Notes</h2>

            <ul>
                <li>Both HTML and ARIA role work that same in NVDA and Voiceover.</li>
            </ul>
        </aside> -->


<p>
  When the HTML <code>&lt;img&gt;</code> tag was first supported the NCSA Mosaic web browser by Marc Andreeson in 1993,
  it changed the World Wide Web from a text-only to a multimedia platform. Other browsers that couldn't render images
  (like the terminal based Lynx web browser) needed a fallback so that users of their browsers could show something
  meaningful instead of images. Tony Johnson, the creator of the Midas web browser, requested a text altenative that
  could be used, and eventually that became the <code>alt</code> attribute.
</p>

<p>
  "Alt text" not only is great for accessibility, it's also good to make your images come up in search engines. Good
  "alt text" handles both use cases well.
</p>

<p>
  Creating accessible alternative text is a discussion on itself. <a href="https://webaim.org">WebAIM</a> has a great
  introductory article about <a href="https://webaim.org/techniques/alttext/">Alternative Text</a> that is highly
  recommended. I also recommend <a href="https://www.scottohara.me/">Scott O'Hara's</a> in depth article <a
    href="https://www.scottohara.me/blog/2019/05/22/contextual-images-svgs-and-a11y.html">Contextually Marking up
    accessible images and SVGs</a>.
</p>


<h2>HTML5 img tag</h2>

<?php includeStats(array('isForNewBuilds' => true)) ?>

<p>
  The easiest way to add images to a web page.
</p>

<div id="html5-example" class="enable-example">
  <img src="images/card_icons.png" width="100" height="94"
    alt="Debit, Visa, MasterCard, American Express, Discover Network">
</div>

<?php includeShowcode("html5-example")?>
<script type="application/json" id="html5-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Add an alt attribute",
    "highlight": "alt",
    "notes": "You must <strong>always</strong> have an alt attribute that is meaningful. If your image is decorative, see the next example."
  }]
}
</script>

<h2>Decorative Image</h2>

<?php includeStats(array('isStyle' => false, 'comment' => 'Important if the image has the same information available in the surrounding text.')) ?>

<p>
  A decorative image is an image that is used to enhance an idea presented in text,
  but is not necessary to understand it. Icons around navigation items and error icons,
  around error text are perfect examples.
</p>

<div id="decorative-example" class="enable-example decorative-example">
  <img class="decorative-example__icon" src="images/bomb.png" alt="">
  <p><strong>You made an error.</strong></p>
  <p>Please back away from the keyboard to avoid any further damage.</p>
</div>

<?php includeShowcode("decorative-example")?>
<script type="application/json" id="decorative-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Use a blank alt attribute",
    "highlight": "alt",
    "notes": "Note that not including an alt attribute is not an alternative to a blank alt attribute. The alt attribute must always be included."
  }]
}
</script>


<h2>ARIA Example</h2>

<p>There are many sites that include images using the CSS <code>background-image</code> or <code>background</code>
  properties. Unless these images are decorative, we need to include alternative text as a fallback for these images as
  well. This can be done using <code>aria-label</code> with the <code>img</code> role.
</p>

<p>Note that developers should use <code>&lt;img&gt;</code> tags wherever possible instead of this method. Not only is
  it better for SEO, but also for text based browsers as well.</p>

<p>The code in this example is based on that from
  <a href="http://pauljadam.com/demos/img.html">Paul J Adam's img role demo</a>.
</p>




<div id="aria-example" class="enable-example clearfix">
  <div class="sprite card_icons amex" role="img" aria-label="American Express"></div>
  <div class="sprite card_icons discover" role="img" aria-label="Discover Network"></div>
  <div class="sprite card_icons visa" role="img" aria-label="Visa"></div>
  <div class="sprite card_icons master" role="img" aria-label="MasterCard"></div>
</div>
<?php includeShowcode("aria-example")?>
<script type="application/json" id="aria-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use role of img",
      "highlight": "role",
      "notes": "This is perfect when you are using background images and image sprites."
    },
    {
      "label": "Put alt text inside the aria-label of the img element",
      "highlight": "aria-label",
      "notes": "Does the same thing as <code>alt</code> in the HTML5 version.  If decorative, use <code>aria-label=\"\"</code>"
    }
  ]
}
</script>



<h2>Inline SVG example with text markup</h2>

<?php includeStats(array('isForNewBuilds' => true, 'comment' => 'These rules should always be applied to all inline SVG images.')) ?>

<p>
  Although using the <code>&lt;img&gt;</code> tag is the best way to include an SVG into your web page (it's cachable,
  the markup is less heavy, etc.), it is sometimes desirable to include the image inline (especially if you are making
  it interactive via JavaScript). Follow the instructions below if you want your inline SVGs to be accessible.
</p>

<div id="inline-svg-example" class="enable-example">
  <svg width="200" height="163" role="img" aria-labelledby="circle-alt svg-text" focusable="false">
    <title id="circle-alt">A dark blue circle with text inside</title>

    <rect x="0" y="0" width="200" height="163" fill="#ffffff" fill-opacity="1"></rect>
    <circle cx="81" cy="85" r="75" fill="#00a" stroke="#000" stroke-width="1"></circle>
    <text id="svg-text" x="81" y="85" font-size="14px" text-anchor="middle" fill="#fff">
      I am text in a circle
    </text>
  </svg>
</div>

<?php includeShowcode("inline-svg-example")?>
<script type="application/json" id="inline-svg-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Add a role of img",
      "highlight": "role",
      "notes": "Just like the previous example"
    },
    {
      "label": "Add focusable=\"false\" to the SVG tag",
      "highlight": "focusable",
      "notes": "This is so some browsers (e.g. Internet Explorer) don't add the image to the focus order of the document."
    },
    {
      "label": "Add aria-labelledby",
      "highlight": "aria-labelledby",
      "notes": "Note that aria-labelledby points to both the <code>title</code> and <code>text</code> tags. Screen readers will read both."
    }
  ]
}
</script>

<h2>Using Icon Fonts</h2>

<?php includeStats(array('isForNewBuilds' => false)) ?>

<p>
  Font icons are a popular way to embed simple mono-coloured fonts into a webpage using a custom font
  to contain the icon shapes. I don't like using font-icons to embed icons into a webpage for a number of reasons:
</p>

<ol>
  <li>Font icons don't have any semantic information. When you embed an SVG
    (either inline or using the &lt;img&gt; tag), then the accessibility API and
    the browser knows they are images, and report that correctly to screen readers. You can
    use <code>role="img"</code> but
    it is better to use native HTML5 markup and not ARIA (which the <code>role</code>&nbsp;attribute is),
    because of <a href="https://www.w3.org/TR/using-aria/#rule1">The First Rule of ARIA</a>.</li>

  <li>From a rendering standpoint, fonts use a different rendering engine that
    vector images, and that engine varies from operating system to operating
    system. Windows uses ClearType (which emphasizes detail) while OSX renders
    fonts as close to the printed page as possible (a great explanation about this is in the Hacker News thread for
    <a href="https://news.ycombinator.com/item?id=28028781">MacType: Better Font Rendering for Windows</a>). Also, these
    technologies can
    (and are) tweaked by users to ensure they are legible to them. Unfortunately,
    what makes text legible don't result in good icon rendering (because what makes
    typography readable doesn't make vector graphics necessarily look good). It
    also results in cross browser (and cross OS) rendering issues sometimes.
  </li>

  <li>If you need to use CSS transforms on font icons, the rendering suffers
    because of #2, and is really apparent in the Windows OS. I have written about
    this a while ago, but it looks like it is still is an issue. My blog post, <a
      href="https://www.useragentman.com/blog/2014/05/04/fixing-typography-inside-of-2-d-css-transforms/">
      Fixing Typography Inside of 2D Transforms</a> has a work around for this, but it does affect performance.
    If you are using HTML5 Canvas in Windows, then there are other issues (although
    I admittedly haven't tested this in awhile); you can read my other blog post, <a
      href="https://www.useragentman.com/blog/2016/05/10/how-to-fix-small-transformed-text-in-html5-canvas-in-firefox-for-windows/">How
      to Fix Small Transformed Text in HTML5 Canvas in Firefox for Windows</a> for more information about that.
  </li>

  <li>You are (sort of) stuck with solid colours. Yes, there is tech for multicolour
    fonts, but I am not sure that is critical mass and should be used yet.</li>

  <li>You do a lot of cooler things with SVG (animation, CSS styling, etc)
    that you can't do with font icons.</li>

  <li>As illustrated in <a href="https://www.lambdatest.com/blog/its-2019-lets-end-the-debate-on-icon-fonts-vs-svg-icons/">Icon Fonts vs SVG – Clash of the Icons</a> by <a href="https://www.linkedin.com/in/nikhil-tyagi-735374179/">Nihil Tyagi</a>, SVG are more performant and can be positioned more easily.</li>
</ol>

<p>Font icons come from the time when IE6 was still a thing, which didn't support
  SVG. It was a hack that suited a purpose, but we should move on, since SVG is
  everywhere now.</p>

<p>(<a href="https://www.instagram.com/p/B-m0rnagYwn/">I am also a calligrapher</a>
  and love typography, so the idea of using font technology to render images just
  seems wrong to me ... the above just emphasizes that point-of-view.</p>

<p>That said, there are plenty of legacy code out there that use icon fonts.  
    Here is how you code font icons in an accessible way. This code is refactored from <a
    href="https://codepen.io/SitePoint/pen/xxyQMP">a Codepen demo by George Martsoukos</a> (modified to add the
  accessibility features in it).</p>


<div class="enable-example" id="icon-font-example">
  <section>
    <div class="container">
      <p class="center">Feel free to connect with Killer B Cinema on Social Media!</p>
      <ul class="list-inline">
        <li>
          <a href="https://www.facebook.com/killerbcinema/" aria-label="The Killer B Cinema Facebook page">
            <i class="fa fa-facebook fa-2x"></i>
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/killerbcinema/?hl=en">
            <i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
            <small>Killer B's Instagram Page</small>
          </a>
        </li>
      </ul>
    </div>
  </section>
</div>

<?php includeShowcode("icon-font-example")?>
<script type="application/json" id="icon-font-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Embed the font using the &lt;i&gt; tag.",
      "highlight": "%OPENCLOSECONTENTTAG%i",
      "notes": "This is the usual way to embed fonts using Font Awesome.  More information can be read in the article <a href=\"https://www.sitepoint.com/introduction-icon-fonts-font-awesome-icomoon/\">An Introduction to Icon Fonts with Font Awesome and IcoMoon</a>"
    },
    {
      "label": "Code an ARIA-Label if it's interactive and needs context",
      "highlight": "aria-label",
      "notes": "As mentioned in on <a href=\"/screen-reader-only-text.php#when-should-i-use-aria-labels-instead---heading\">Enable's screen reader only text page</a>, we should use an aria-label when an accessible label is missing from a control."
    },
    {
      "label": "Make the decorative icons hidden from screen readers",
      "highlight": "aria-hidden",
      "notes": "Note that this link already has text inside, so we don't need an aria-label.  We should hide the icon from screen readers, though, in order to prevent the font information from being read."
    }
  ]
}
</script>