<!-- <aside class="notes">

            <h2>Notes</h2>

            <ul>
                <li>Both HTML and ARIA role work that same in NVDA and Voiceover.</li>
            </ul>
        </aside> -->


<p>
  When the HTML <code>&lt;img&gt;</code> tag was first supported by the NCSA Mosaic web browser by Marc Andreeson in 1993,
  it changed the World Wide Web from a text-only to a multimedia platform. Other browsers that couldn't render images
  (like the terminal-based Lynx web browser) needed a fallback so that users of their browsers could show something
  meaningful instead of images. Tony Johnson, the creator of the Midas web browser, requested a text alternative that
  could be used, and eventually, that became the <code>alt</code> attribute.
</p>

<p>
  "Alt text" is not only great for accessibility, but it's also good for making your images come up in search engines. Good
  "alt text" handles both use cases well.
</p>

<p>
  Creating accessible alternative text is a discussion in itself. <a href="https://webaim.org">WebAIM</a> has a great
  introductory article about <a href="https://webaim.org/techniques/alttext/">Alternative Text</a> that is highly
  recommended. I also recommend <a href="https://www.scottohara.me/">Scott O'Hara's</a> in-depth article on<a
    href="https://www.scottohara.me/blog/2019/05/22/contextual-images-svgs-and-a11y.html">Contextually Marking up
    accessible images and SVGs</a>.
</p>


<h2>HTML5 img tag</h2>

<?php includeStats(["isForNewBuilds" => true]); ?>

<p>
  The easiest way to add images to a web page.
</p>

<div id="html5-example" class="enable-example">
  <img src="images/card_icons.png" width="100" height="94"
    alt="Debit, Visa, MasterCard, American Express, Discover Network">
</div>

<?php includeShowcode("html5-example"); ?>
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

<?php includeStats([
    "isStyle" => false,
    "comment" =>
        "Important if the image has the same information available in the surrounding text.",
]); ?>

<p>
  A decorative image is an image that is used to enhance an idea presented in text
  but is not necessary to understand it. Icons around navigation items and error icons,
  around error text are perfect examples.
</p>

<div id="decorative-example" class="enable-example decorative-example">
  <img class="decorative-example__icon" src="images/bomb.png" alt="">
  <p><strong>You made an error.</strong></p>
  <p>Please back away from the keyboard to avoid any further damage.</p>
</div>

<?php includeShowcode("decorative-example"); ?>
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

<p>Many sites include images using the CSS <code>background-image</code> or <code>background</code>
  properties. Unless these images are decorative, we need to include alternative text as a fallback for these images as
  well. This can be done using <code>aria-label</code> with the <code>img</code> role.
</p>

<p>Note that developers should use <code>&lt;img&gt;</code> tags wherever possible instead of this method. Not only is
  it better for SEO, but also for text-based browsers as well.</p>

<p>The code in this example is based on that from
  <a href="http://pauljadam.com/demos/img.html">Paul J Adam's img role demo</a>.
</p>




<div id="aria-example" class="enable-example clearfix">
  <div class="sprite card_icons amex" role="img" aria-label="American Express"></div>
  <div class="sprite card_icons discover" role="img" aria-label="Discover Network"></div>
  <div class="sprite card_icons visa" role="img" aria-label="Visa"></div>
  <div class="sprite card_icons master" role="img" aria-label="MasterCard"></div>
</div>
<?php includeShowcode("aria-example"); ?>
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

<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        "These rules should always be applied to all inline SVG images.",
]); ?>

<p>
  Although using the <code>&lt;img&gt;</code> tag is the best way to include an SVG into your web page (it's cachable,
  the markup is less heavy, etc.), it is sometimes desirable to include the image inline (especially if you are making
  it interactive via JavaScript). Follow the instructions below if you want your inline SVGs to be accessible.
</p>

<div id="inline-svg-example" class="enable-example">
  <svg width="200" height="163" role="img" aria-labelledby="circle-alt svg-text" focusable="false">
    <title id="circle-alt">A dark blue circle with text inside</title>

    <rect x="0" y="0" width="200" height="163" fill="none" fill-opacity="1"></rect>
    <circle cx="81" cy="85" r="75" fill="#00a" stroke="#000" stroke-width="1"></circle>
    <text id="svg-text" x="81" y="85" font-size="14px" text-anchor="middle" fill="#fff">
      I am text in a circle
    </text>
  </svg>
</div>

<?php includeShowcode("inline-svg-example"); ?>
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

<h2>Using SVG Sprites</h2>

<p>
  Many developers use SVG Sprites so they can put all their SVG icons in one place and have their <code>svg</code> tags point to a shape in the sprite inside their HTML code.  This can make your webpage more efficient when there are a lot of icons on a page, as described in the article <a href="https://cloudfour.com/thinks/svg-icon-stress-test/">Which SVG technique performs best for way too many icons?</a> by <a href="https://tylersticka.com/">Tyler Sticka</a>.  Here, we show you how to embed them in an accessible way like the other SVG examples on this page.
</p>

<p>
  For more information about SVG Sprites, I would suggest <a href="https://www.24a11y.com/2018/accessible-svg-icons-with-inline-sprites/">Accessible SVG Icons with Inline Sprites</a> by <a href="https://home.social/@nice2meatu">Marco Hengstenberg</a>.
</p>

<div id="svg-sprite-example" class="enable-example">
  <?php include "includes/os-spritesheet.svg"; ?>

  <p >Read more about the history of your operating system.</p>

  <ul class="svg-sprite-example__list list--inline">
    <li><a href="https://en.wikipedia.org/wiki/IOS" class="svg-sprite-example__scaled-icon"><?php includeSvgSprite(
        "ios",
        "iOS",
    ); ?></a></li>
    <li><a href="https://en.wikipedia.org/wiki/Android_(operating_system)"><?php includeSvgSprite(
        "android",
        "Android",
    ); ?></a></li>
    <li><a href="https://en.wikipedia.org/wiki/Microsoft_Windows"><?php includeSvgSprite(
        "windows",
        "Windows",
    ); ?></a></li>
    <li><a href="https://en.wikipedia.org/wiki/MacOS"><?php includeSvgSprite(
        "osx",
        "OSX",
    ); ?></a></li>
    <li><a href=""><?php includeSvgSprite("linux", "Linux"); ?></a></li>
  </ul>
  
</div>

<?php includeShowcode("svg-sprite-example"); ?>
<script type="application/json" id="svg-sprite-example-props">
{
  "replaceHtmlRules": {
    "svg symbol": "<!-- insert svg render code here -->"
  },
  "steps": [
    {
      "label": "Add sprite sheet",
      "highlight": "%OPENCLOSECONTENTTAG%svg xmlns",
      "notes": "Inside the <code>symbol</code> tags are the svg code for each individual SVG image inside the sprite."
    },
    {
      "label": "Hide the spritesheet",
      "highlight": "class=\"sr-only\" ||| style",
      "notes": "The tutorials linked above tell developer to hide the sprite sheet with <code>display: none</code> via CSS.  This works most of the time, but I have found that when inserting code to display the sprites in the spritesheet on some versions of Safari on OSX (e.g. 16.1), some of the sprites, such as the OSX and Linux icons, are only displayed in black and white:<br /><img src=\"images/bad-safari-svg-sprites.png\" class=\"centered-block\" alt=\"A screenshot of the icon fonts in the example below rendered by Safari 16.1 with the sprite sheet SVG hidden on the page using CSS display: none.  The iOS and Linux logos are rendered in black and white and are missing color information.\" />   Therefore, I use CSS <code>visibility: hidden</code> along with the <a href=\"http://localhost:8888/screen-reader-only-text.php#show-me-the-css-that-i-can-use-to-make-screen-reader-only-text--heading\">sr-only class to generate screen reader only text</a> to hide the image."
    },
    {
      "label": "Embed SVG sprites into the HTML",
      "highlight": "xlink:href",
      "notes": "Note that the <code>id</code> attributes for each symbol in the sprite sheet matches the <code>xlink:href</code> attributes inside the <code>use</code> tag of the SVG where the image appears on the page."
    },
    {
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
      "label": "Add aria-labelledby to the SVG tags",
      "highlight": "aria-labelledby",
      "notes": "Note that aria-labelledby points to the <code>title</code> tag. Usually the <code>title</code> tag is sufficient on its own, but we put the <code>aria-labelledby</code> in for older browser/screen reader pairs."
    }
  ]
}
</script>

<h2>Using Icon Fonts</h2>

<?php includeStats(["isForNewBuilds" => false]); ?>

<p>
  Font icons are a popular way to embed simple mono-colored fonts into a webpage using a custom font
  to contain the icon shapes. I don't like using font icons to embed icons into a webpage for several reasons:
</p>

<ol>
  <li>Font icons don't have any semantic information. When you embed an SVG
    (either inline or using the &lt;img&gt; tag), then the accessibility API and
    the browser know they are images, and report that correctly to screen readers. You can
    use <code>role="img"</code> but
    it is better to use native HTML5 markup and not ARIA (which the <code>role</code>&nbsp;attribute is),
    because of <a href="https://www.w3.org/TR/using-aria/#rule1">The First Rule of ARIA</a>.</li>

  <li>From a rendering standpoint, fonts use a different rendering engine than
    vector images, and that engine varies from operating system to operating
    system. Windows uses ClearType (which emphasizes detail) while OSX renders
    fonts as close to the printed page as possible (a great explanation about this is in the Hacker News thread for
    <a href="https://news.ycombinator.com/item?id=28028781">MacType: Better Font Rendering for Windows</a>). Also, these
    technologies can
    (and are) tweaked by users to ensure they are legible to them. Unfortunately,
    what makes text legible doesn't result in good icon rendering (because what makes
    typography readable doesn't make vector graphics necessarily look good). It
    also results in cross-browser (and cross-OS) rendering issues sometimes.
  </li>

  <li>If you need to use CSS transforms on font icons, the rendering suffers
    because of #2 and is apparent in the Windows OS. I wrote about
    this a while ago, but it looks like it is still an issue. My blog post, <a
      href="https://www.useragentman.com/blog/2014/05/04/fixing-typography-inside-of-2-d-css-transforms/">
      Fixing Typography Inside of 2D Transforms</a> has a workaround for this, but it does affect performance.
    If you are using HTML5 Canvas in Windows, then there are other issues (although
    I admittedly haven't tested this in a while); you can read my other blog post, <a
      href="https://www.useragentman.com/blog/2016/05/10/how-to-fix-small-transformed-text-in-html5-canvas-in-firefox-for-windows/">How
      to Fix Small Transformed Text in HTML5 Canvas in Firefox for Windows</a> for more information about that.
  </li>

  <li>You are (sort of) stuck with solid colors. Yes, there is tech for multicolor
    fonts, but I am not sure that is critical mass and should be used yet.</li>

  <li>You do a lot of cooler things with SVG (animation, CSS styling, etc)
    that you can't do with font icons.</li>

  <li>As illustrated in <a href="https://www.lambdatest.com/blog/its-2019-lets-end-the-debate-on-icon-fonts-vs-svg-icons/">Icon Fonts vs SVG – Clash of the Icons</a> by <a href="https://www.linkedin.com/in/nikhil-tyagi-735374179/">Nihil Tyagi</a>, SVG are more performant and can be positioned more easily.</li>
</ol>

<p>Font icons come from the time when IE6 was still a thing, which didn't support
  SVG. It was a hack that suited a purpose, but we should move on since SVG is
  everywhere now.</p>

<p>(<a href="https://www.instagram.com/p/B-m0rnagYwn/">I am also a calligrapher</a>
  and love typography, so the idea of using font technology to render images just
  seems wrong to me ... the above just emphasizes that point of view.</p>

<p>That said, there are plenty of legacy code out there that use icon fonts.  
    Here is how you code font icons in an accessible way. This code is refactored from <a
    href="https://codepen.io/SitePoint/pen/xxyQMP">a Codepen demo by George Martsoukos</a> (modified to add the
  accessibility features in it).</p>


<div class="enable-example" id="icon-font-example">
  <section>
    <div class="container">
      <p class="center">Feel free to connect with Killer B Cinema on Social Media!</p>
      <ul class="list--inline">
        <li>
          <a href="https://www.facebook.com/killerbcinema/" >
            <i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
            <span class="sr-only">The Killer B Cinema Facebook page</span>
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

<?php includeShowcode("icon-font-example"); ?>
<script type="application/json" id="icon-font-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Embed the font using the &lt;i&gt; tag.",
      "highlight": "%OPENCLOSECONTENTTAG%i",
      "notes": "This is the usual way to embed fonts using Font Awesome.  More information can be read in the article <a href=\"https://www.sitepoint.com/introduction-icon-fonts-font-awesome-icomoon/\">An Introduction to Icon Fonts with Font Awesome and IcoMoon</a>."
    },
    {
      "label": "Code screen reader text near the icon font",
      "highlight": "%OPENCLOSECONTENTTAG%span",
      "notes": "As mentioned in on <a href=\"/screen-reader-only-text.php\">Enable's screen reader only text page</a>, this text will be read out by screen readers, but will be hidden from sighted users.  This acts as the alt text for the first icon font example."
    },
    {
      "label": "Make the decorative icons hidden from screen readers",
      "highlight": "aria-hidden",
      "notes": "Note the <code>aria-hidden=\"true\"</code> ensures the icon will not read out by screen readers.  The second example doesn't need any alt text, since it is decorative due to the supporting text near the icon."
    }
  ]
}
</script>