
<p>
  Many users, myself included, use the text-resizing functionality offered by their browser and/or operating system. 
  This functionality is not only used by people who are partially sighted but also by those who wear glasses and those who want to see text on their mobile devices in the sunlight.
</p>

<p>
  This page will discuss how to code font sizes that will respect how the user has configured their browser and
  operating system font magnification settings. It will also show developers how developers can test their work in all of the modern web browsers (Note that Firefox is by far the easiest one to test in).
</p>

<p>
    <strong>If you are looking at how to alter the design slightly when font resizing is triggered, you may want to check out our page on <a href="hero-image-text-resize.php">Accessible Text in Hero Images</a>.</strong>  The article demos a lightweight JavaScript library that can treat text-resizing almost like another breakpoint.
</p>

<h2>Replace Pixels With Rems</h2>

<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        'This is easy to use for new and existing work if you are using a CSS pre-compiler like <a href="https://lesscss.org/">Less</a> or <a href="https://sass-lang.com/">Sass</a>.',
]); ?>

<p>
  Developers should use relative units like rems for the majority of their text:
</p>

<ol>
  <li>Pixels are an absolute unit.</li>
  <li>Rems are responsive in that they are relative to the font size of a parent that is sized in pixels. If the pixel font size of the parent of an element sized in rems changes, then the font size of the element changes. 
  </li>
</ol>



<p>
  In most browsers, users who use their browser functionality to resize text will not be able to resize text measured in
  pixels,
  since pixels are absolute (except in Firefox, see below). Text sized in rems, however, will resize, because the browsers' text resize
  functionality
  <strong>should</strong> change the base font of the document (please see the note on Chrome for Android below).
</p>

<p>
  All the pages on the Enable project are designed to resize by using rems, but we use a dead-simple LESS mixin to convert pixels to rems.
</p>

<div id="less-px-to-rem">

</div>

<?php includeShowcode("less-px-to-rem", "", "", "", false); ?>
<script type="application/json" id="less-px-to-rem-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "LESS markup",
    "highlight": "%INLINE%px-to-rem__less",
    "notes": ""
  }]
}
</script>

<template id="px-to-rem__less" data-type="text">
// 1. Define a base font size. For example,
// 16px for the html root would translate to @px: 16rem;

@px: 16rem;

// 2. set the base font-size of the body tag to the same
// amount in pixels.
body {
  font-size: 16px;
}

// 3. Set your pixel values as fractions. For example,
// 16px would be 16/@px, 200px would be 200/@px, and so on.

.example {
  font-size: 16/@px;
  margin: 20/@px 0;
  padding: 20/@px 10/@px;
}

// Compiled output

// .example {
//   font-size: 1rem;
//   margin: 1.25rem 0;
//   padding: 1.25rem 0.625rem;
// }

// http://lesscss.org/features/#features-overview-feature-operations

</template>


<p>(<a href="https://blog.logrocket.com/using-em-vs-rem-css/">You could also use ems</a> as well to ensure font-resizing/text-zoom happens, but they are harder to convert to pixels programmatically).</p>


<h2>Use Unitless Line Heights</h2>

<p>
  This is something that a lot of seasoned front-end developers still get wrong: using units with the <code>line-height</code> CSS attribute.  Using units in <code>line-height</code> is bad because:

  <ul>
    <li>Using absolute units in <code>line-height</code> means they don't grow when text-zoom is activated in most browsers.</li>
    <li>Using relative units (e.g. <code>rem</code>) in line-height is better (in that it will increase when text is zoomed), but if a developer decides to change the font-size, the line-height will also have to be changed.  Using unitless line-heights means that if the developer changes the <code>font-size</code> attribute, the 
    <code>line-height</code> will be automatically adjusted since it represents the <code>font-size</code> multiplied by that value.
  </ul>

  <p>
    For example, let's take the following LESS:
</p>

<div id="unitless-line-height"></div>

<?php includeShowcode("unitless-line-height", "", "", "", false); ?>
<script type="application/json" id="unitless-line-height-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "LESS markup",
    "highlight": "%INLINE%unitless-line-height__less",
    "notes": ""
  }]
}
</script>

<template id="unitless-line-height__less" data-type="text">
  ul {
    font-size: (15/@px);

    /* 1 * 15px = 15px line-height */
    line-height: 1;  
  }

  li {
    font-size: (20/@px);

    /*
     * Even thought it's not declared here, the
     * line-height is 20px.  This is because 
     * the font-size is 20px, so the line-height
     * will also be 20px because the parent's
     * line-height is 1, and 1 * 20px = 20px.
     */
  }

</template>

<p>
  These two articles are really good at explaining this in detail:
</p>

<ul>
  <li><a href="https://meyerweb.com/eric/thoughts/2006/02/08/unitless-line-heights/">Unitless line-heights</a>
  by <a href="https://meyerweb.com">Eric Meyer</a>.</li>
  <li><a href="https://css-tricks.com/almanac/properties/l/line-height/">Line-height</a> by <a href="https://www.sara.io">Sara Cope</a>.</li>
</ul>

<h2 id="text-resize-instructions" tabindex="-1">How to Resize Text in Modern Browsers</h2>

<p>
  There is a lot of confusion on how to test <a href="https://www.w3.org/WAI/WCAG21/Understanding/resize-text.html">the WCAG Success Criterion 1.4.4: Resize text</a>.  The requirement states that users should be able to resize text (and only text) up to 200% without any loss of information.  It is possible to test this in all browsers, but you should be familiar with all the caveats, which are listed below.
</p>

<h3>Safari:</h3>
<ol>
  <li><strong>Desktop (OSX):</strong> To increase the font size, press Option-Command-Plus sign (+). To
    decrease the font size, press Option-Command-Minus sign (-)</li>
  <li><strong>Mobile (iOS):</strong> When first writing this article, it looked like there was no way to
    actually resize text in iOS Safari natively. The only way to resize text is at the operating system
    level (by opening the iOS <strong>Settings</strong> app and under <strong>Accessibility</strong>
    choosing <strong>Larger Text</strong> and using the slider). By default, however, most web pages
    don't
    respect the size that is set. However, after doing a lot of research for this article, I found that
    if
    you put the following CSS into your page, you can get Safari to resize the text according to the
    system
    settings:<br>

    <div id="apple-css">
    </div>

    <?php includeShowcode("apple-css", "", "", "", false); ?>
    <script type="application/json" id="apple-css-props">
    {
      "replaceHtmlRules": {},
      "steps": [{
        "label": "CSS markup",
        "highlight": "%INLINE%apple-css__code",
        "notes": ""
      }]
    }
    </script>

    <template id="apple-css__code" data-type="text">
body {
  /*
   * This tells Safari to use the OS's base font and
   * the size set in the iOS Accessibility settings.
   */
  font: -apple-system-body;

  /*
   * Put whatever font you want to use here. The font
   * size will still be grabbed by the iOS Accessibility
   * settings.
   */
  font-family: "Times New Roman", serif;
}

    </template>
    <p> I encourage everyone to put these styles in their base styles. It will make visually impaired
      iOS
      users happy. The only caveat here is that the font resize will not happen until after the user
      refreshes the browser. Thanks to the user "clshortf…@gmail.com" in <a
        href="https://bugs.chromium.org/p/chromium/issues/detail?id=779409">this Chromium bug
        report</a>
      for sharing this info.
    </p>
  </li>
</ol>

<h3>Chrome:</h3>
<ol>
  <li><strong>Desktop:</strong>
    <ul>
      <li>At the top right, click More <span aria-hidden="true">⋮</span> and then Settings.</li>
      <li>Under "Appearance," next" to "Font size," click the Down arrow <span aria-hidden="true">▾</span>.
          Then select the font size you want (you have a choice of very small, small, medium, large, and very large). 
          You can have a little bit more granular control by clicking "Customize fonts" and moving the "Font Size" range widget.</li>
    </ul>
    <p><em>Note that Chrome will <strong>not</strong> resize text that is sized in <code>px</code>
        units.</em></p>
  </li>
  <li><strong>Mobile (Android):</strong>
    <ul>
      <li>Go to Settings, and then Accessibility. 
          You can change the font size by using the "Text Scaling" slider.</li>
    </ul>
    <p><strong><em>Please note that Chrome for Android has some serious differences from all other browsers. 
      Text is only resized inside HTML elements with more than 217 characters in it, and only if they have a dynamic height. 
      This is not useful as an accessibility feature, since it is not guaranteed to resize all the content on the page. Because of this, text-zoom-resize does not support Chrome for Android.</em></strong></p>
    <p><a href="https://bugs.chromium.org/p/chromium/issues/detail?id=779409">A bug was filed a
        year and a half ago with Google on this issue</a>, and I have submitted my own comments
      to it. Hopefully this will be resolved soon.</p>

    <p>
      <strong>(Update: this was kind of fixed in 2022 <a
          href="https://bugs.chromium.org/p/chromium/issues/detail?id=645717">in this Chromium ticket</a>, but my
        testing has revealed it is not 100% fixed. If you bump up the sizing in Chrome and view this website, you will
        notice that some of the typography, like that inside the hamburger menu, is still not being resized
        correctly).</strong>
    </p>
  </li>
</ol>

<h3>Firefox:</h3>
<ul>
  <li><strong>Desktop:</strong>
    <ol>
      <li>On the menu at the top of your browser, click View, then go to Zoom (if you are using
        Windows or Linux, you may have to press the "Alt" key in order to make this menu
        visible).
      </li>
      <li>Select Zoom Text Only (This makes the controls only change the size of text; not
        images).
      </li>
      <li>Click on the hamburger menu <span aria-hidden="true">☰</span> in the upper top-right
        corner
        of the browser's chrome.</li>
      <li>Click on the plus and minus icons in the "Zoom" option.</li>
    </ol>
  </li>
  <li><strong>Mobile (Android):</strong>
    <ol>
      <li>You first need to set up Firefox to use the operating system text zoom settings. To do
        this,
        click on the More menu, denoted by three vertical dots ⋮, and then Settings. Then go to
        the
        Accessibility Menu. Make sure the "Use System font size" slider is on. Also make sure
        the
        "Always enable zoom" slider is on as well.</li>
      <li>Now, that you have set up Firefox right, you can now zoom the font. Launch Android's
        "Settings" app and choose "Display". Then click on "Font size". Use the slider to change
        the
        text zoom font size value. Click OK and then go back to Firefox (Note: You may need to
        reload the web page in order for the text zoom to take effect).</li>
    </ol>
    <p>(A more visual representation of the second step above can be found at <a
        href="https://www.howtogeek.com/268754/how-to-change-the-size-of-text-icons-and-more-in-android-nougat/">How
        to Change the Size of Text, Icons, and More in Android</a> at the <a href="https://www.howtogeek.com">How To
        Geek</a> website).</p>
  </li>
</ul>

<h3>Internet Explorer:</h3>
<p> Go to the menu bar, click "View" and choose the "Text Size" menu
  item.
  <em>Note that like Chrome, Internet Explorer will <strong>not</strong> resize text that is sized in
    <code>px</code> units.</em>
</p>
<h3>Microsoft Edge:</h3>
<ul>
  <li><strong>For Edge &lt;= 18 (which is based on the EdgeHTML rendering engine):</strong> the only
    information I found about text zooming is outlined in this <a
      href="https://mcmw.abilitynet.org.uk/microsoft-edge-making-text-larger/">article</a>, but I
    couldn't get it to work (I think Microsoft may have removed this feature).</li>
  <li><strong>For Edge &gt; 18 (which is based on the Blink rendering engine):</strong> go to
    Settings, and choose the "Appearance" tab. You can change the "Font size" select box value or have more
    fine-grained control by clicking "Custom fonts" and moving the "Font size" slider.</li>
</ul>

<p>(This list was partially lifted from <a href="https://usability.yale.edu/web-accessibility/articles/zoom-resizing-text">Zoom
    &amp; Resizing
    Text</a> from <a href="https://usability.yale.edu/">Yale University's Usability &amp; Web
    Accessibility
    site</a>). Some of the content has been updated using our own research (most notably, the Mobile Chrome issues stated above).</p>