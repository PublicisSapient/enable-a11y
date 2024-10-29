<p>
  Before we dive into making focus outlines accessible, let's first understand what a focus outline is and why it’s important for web accessibility, particularly for screen readers. 
  If you're already familiar with focus outlines, feel free to skip to the next section. For those who aren’t, here's a brief definition.
</p>

<h2>What is a Focus Outline?</h2>

<p>
  Simply put, when a specific HTML element is ready to accept keyboard input, it is considered to be "in focus." 
  As users navigate a webpage using the keyboard (typically via the Tab key), different elements receive focus, allowing screen readers to read their content. 
  According to accessibility standards, any element in focus should have a visible border around it, known as the focus outline. This helps users, especially those relying on screen readers or keyboard navigation, to know which element is currently active.
</p>


<p>
  Focus states are used by keyboard users to know what interactive element they can currently manipulate. They are easily
  styled with the <code>outline</code> CSS property and the <code>:focus</code> and <code>:focus-visible</code> pseudo-classes.
  Unfortunately, many designers hate them and try to get focus-styles removed from a website.  This page discussed 
  in detail why this should be avoided and how to keep designers happy by having focus-styles appear for keyboard users only. 
</p>

<h2>Focus Styling For Keyboard Users Only</h2>


<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        "This is recommended for use in both new and existing projects.  It ",
]); ?>


<p>
  When I am auditing a website for accessibility issues for the first time, a lack of focus indicators is usually one of
  the first things I see. This is usually because a lot of designers and/or developers will think that focus indicators
  look ugly and will put in the following CSS to get rid of them:
</p>
<figure class="wide">


  <?php includeShowcode("focus-remove", "", "", "", false); ?>

  <figcaption>Figure 1. Horrible code a lot of developers use to turn off focus states. Never do this.</figcaption>


</figure>
<script type="application/json" id="focus-remove-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Remove focus indicator CSS",
    "highlight": "%INLINE%focus-remove",
    "notes": ""
  }]
}
</script>

<template id="focus-remove" data-type="css">
  *:focus { outline: none; }
</template>

<p>
  <strong>This is a bad idea.</strong> Keyboard users need focus states need these focus indicators to know what
  interactive element currently has focus. "But VoiceOver has its own focus indicator!" is what I hear some of you say.
  Not everyone who uses a keyboard uses VoiceOver. <strong>You absolutely need a visible focus indicator on all your
    interactive elements in order to pass <a href="https://www.w3.org/WAI/WCAG21/Understanding/focus-visible.html">WCAG
      2.4.7</a></strong>.
</p>
<p>
  <strong>What can you do to make focus indicators only appear for keyboard users?</strong> This can be done using the
  <code>:focus-visible</code> CSS pseudo-class. Here is how the Enable site codes them globally using <a
    href="https://www.tpgi.com/focus-visible-and-backwards-compatibility/">TPGI's excellent method to use
    <code>:focus-visible</code> while ensuring browsers that don't support it fallback to using <code>:focus</code>
    gracefully</a>:
</p>

<figure class="wide">
  <?php includeShowcode("css-focus-visible", "", "", "", false); ?>

  <figcaption>Figure 2. Much better code that styles focus states for keyboard users while minimizing its visibility
    for mouse users.</figcaption>
</figure>

<script type="application/json" id="css-focus-visible-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Focus Visible CSS recipe",
    "highlight": "%INLINE%css-focus-visible",
    "notes": ""
  }]
}
</script>

<template id="css-focus-visible" data-type="css">
  /* Initial focus style for all browsers (keyboard and mouse users). */
  *:focus { outline: solid 2px #3b99fc; }

  /* Turn off focus style above if browser supports :focus-visible. */
  *:focus:not(:focus-visible) { outline: none; }

  /*
  * For browsers that support :focus-visible, use it to show focus
  * indicators to keyboard users only.
  */
  *:focus-visible { outline: solid 2px #3b99fc; }

</template>

<p>
  Is it just keyboard users that will see focus states styled with <code>focus-visible</code>? Kind of, but there are a
  few subtleties. <a href="https://andyadams.org/">Andy Adams</a> has written <a
    href="https://css-tricks.com/almanac/selectors/f/focus-visible/">a great article for CSS Tricks about
    :focus-visible</a> that goes into detail.
</p>

<h2>Increase Hit Areas Inside Focusable Elements</h2>

<p>
  If you use a keyboard to navigate through the main navigation, 
  you will notice the clickable hit area of the top-level navigation items are a lot bigger than they take up in the layout:
</p>


<figure class="wide centered-image">

  <?php pictureWebpPng(
      "images/focus/clickable-hit-state",
      "Screenshot of the Enable website's main navigation, with keyboard focus applied to the 'controls' navigation drawer.",
  ); ?>

  <figcaption>Figure 3. The focus state of the "Controls" navigation button. Note the large hit area.</figcaption>
</figure>

<p>We increased the hit area to conform to <a href="https://www.w3.org/WAI/WCAG21/Understanding/target-size.html">WCAG
    2.5.5: Target Size</a> (we made it larger than 44 pixels x 44 pixels). Even though this is a AAA requirement, it is so easy to implement by increasing the padding
  and compensating visually with an equivalent negative margin, so why just conform to 
  <a href="https://www.w3.org/WAI/WCAG22/Understanding/target-size-minimum.html">WCAG 2.5.8: Target Size (Minimum).</a> (which only asks 24 pixels x 24 pixels)?</p>

  <figure class="wide centered-image">
<?php includeShowcode("css-focus-hitarea", "", "", "", false); ?>
<script type="application/json" id="css-focus-hitarea-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Focus Visible CSS recipe",
    "highlight": "%INLINE%css-focus-hitarea",
    "notes": ""
  }]
}
</script>
<figcaption>Figure 3a. Code pattern that increases the hit area around navigation buttons.</figcaption>

</figure>

<template id="css-focus-hitarea" data-type="css">
  .enable-flyout__open-level-button { padding: 27px 0; margin: -27px 0; }

</template>


<p>I encourage everyone reading this to implement this on all the websites they code. From a UX perspective, it just
  makes it easier for everyone to use the websites you code.</p>

<h2>Issues with CSS Transitions and CSS outline in Safari</h2>

<p>
  On a few projects, I have noticed that Safari focus states don't appear correctly when the element that is focused has
  the following CSS applied to it:
</p>

<figure class="wide">
  <?php includeShowcode("transition-all-code", "", "", "", false); ?>

  <figcaption>Figure 4. CSS <strong>transition: all</strong> code that should be avoided.</figcaption>
</figure>

<script type="application/json" id="transition-all-code-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Bad transition all CSS code that should be avoided.",
    "highlight": "%INLINE%transition-all-code",
    "notes": ""
  }]
}
</script>

<template id="transition-all-code" data-type="css">
  a {
  transition: all 0.3s ease-in-out;
  }
</template>

<p>
  The above CSS can mess up Safari focus states: they may appear cut off or may not appear at all in Safari, while they
  may appear fine in other web browsers. <strong>The correct way to fix this is to <em>never</em> use
    <code> transition: all</code> in your CSS.</strong> Using <code>all</code>. There are many reasons why you should
  never use not use the <code>all</code> keyword for transitions (in this case, because of unwanted side-effects, but
  also for performance reasons). <a href="https://www.pno.dev/">Philipp Nowinski</a> has written a great write-up on <a
    href="https://www.pno.dev/articles/dont-use-the-all-keyword-in-css-transitions/">why you shouldn't use the 'all'
    keyword in CSS transitions</a>, and I suggest all developers read this.
</p>

<p>
  If removing the <code>all</code> transition code will cause problems in your project, you can use the following hack
  to fix the code in Safari:
</p>

<figure class="wide">
  <?php includeShowcode("fix-transition-all-code", "", "", "", false); ?>

  <figcaption>Figure 5. Fix for Safari to work around <strong>transition: all</strong> code issue.</figcaption>
</figure>

<script type="application/json" id="fix-transition-all-code-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Fix for Safari.",
    "highlight": "%INLINE%fix-transition-all-code",
    "notes": ""
  }]
}
</script>

<template id="fix-transition-all-code" data-type="css">
  @media screen and (-webkit-min-device-pixel-ratio:0) {

  /* Safari only*/
  *:focus { transition: none !important; }

  }
</template>


<p>
  Note that <strong>it is much better to remove the <code>all</code> keyword and just transition what you need
    instead.</strong> This solution should only be a band-aid solution until you can fix the issue properly.
</p>


<h2>Don't Forget Windows High Contrast Mode Users.</h2>

Sometimes, you will want to style focus states without the CSS <code>outline</code> property. If you do this, but
instead of using <code>outline: none</code> to remove the default focus ring, developers should use outline with the
<code>transparent</code> color:


<figure class="wide">
  <?php includeShowcode("transparent-outline-code", "", "", "", false); ?>

  <figcaption>Figure 6. Adding a transparent outline along with your custom focus state that doesn't have an outline
  </figcaption>
</figure>

<script type="application/json" id="transparent-outline-code-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Transparent outline fix",
    "highlight": "%INLINE%transparent-outline-code",
    "notes": ""
  }]
}
</script>

<template id="transparent-outline-code" data-type="css">
  button.special-style:focus { outline: transparent 2px solid; border-bottom: 2px solid #00f; }
</template>

<h2>Guaranteed Contrast on Focus Rings, Regardless of Background</h2>

<p>
  If you don't know what color background your focus rings will be on top of, there is a simple way of ensuring your
  focus rings will follow contrast rules: using <code>outline</code> and <code>box-shadow</code> at the same time.
</p>

<p>
  Here is an example you can tab into to see this combo in action:
</p>

<div id="double-focus-ring-example" class="enable-example">
  <p>
    <a href="#">This is a dummy link</a>
    <a href="#">This is a dummy link</a>
    <a href="#">This is a dummy link</a>
    <a href="#">This is a dummy link</a>
    <a href="#">This is a dummy link</a>
    <a href="#">This is a dummy link</a>
    <a href="#">This is a dummy link</a>
  </p>
</div>

<p>
  If you are using a mobile device, here are some screenshots you can look at to show how it looks:
</p>


<figure class="wide centered-image">
  <table class="screenshot-table" aria-labelledby="double-focus-screenshot-table-caption">
    
    <thead>
      <tr>
        <th scope="col">
          Focus State
        </th>
        <th scope="col">
          Screenshot
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">No Element is Focused</th>
        <td>
          <?php pictureWebpPng(
              "images/focus/double-focus-ring__initial-state",
              "Two yellow blocky interactive elements on a gradient background. The gradient is starts on a light yellow on the left and ends with a darker red on the right.",
              "",
          ); ?>
        </td>
      </tr>
      <tr>
        <th scope="row">Focus on Lighter Area of Gradient</th>
        <td>
          <?php pictureWebpPng(
              "images/focus/double-focus-ring__light-bg",
              "The same interactive elements on the same gradient background.  The interactive element on the left is focused, and the blue focus outline around it is easily seen in contrast with the light background.",
              "",
          ); ?>
        </td>
      </tr>
      <tr>
        <th scope="row">Focus on Darker Area of Gradient</th>
        <td>
          <?php pictureWebpPng(
              "images/focus/double-focus-ring__darker-bg",
              "The same interactive elements on the same gradient background.  The interactive element on the right is now focused, and the white box shadow that appears outside the darker blue focus outline ensures the focus ring has enough contrast with the dark background.",
              "",
          ); ?>
        </td>

      </tr>
    </tbody>
  </table>

  <figcaption id="double-focus-screenshot-table-caption">Figure 7. Dual-Colored Focus States on a Gradient Background</figcaption>
</figure>

<p>Here is the markup that implements the double focus ring.  Notice the use of both <code>outline</code> and <code>box-shadow</code> to create this effect (the box-shadow offsets must be greater than the outline thickness in order for this to work):</p>

<?php includeShowcode("double-focus-ring-example", "", "", "", false); ?>
<script type="application/json" id="double-focus-ring-example-props">
{
  "replaceHtmlRules": {
  },
  "steps": [
  {
    "label": "Implement the double focus ring",
    "highlight": "%CSS%focus-styling-css~ #double-focus-ring-example *:focus-visible",
    "notes": ""
  }
]}
</script>