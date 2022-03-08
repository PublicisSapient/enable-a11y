<p>
  Focus states are used by keyboard users to know what interactive element they can currently manipulate. They are usually styled with 

<h2>Focus Styling For Keyboard Users Only</h2>


<?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This is recommended for use in both new and existing projects.  It ')) ?>


<p>
  When I am auditing a website for accessibility issues for the first time, lack of focus indicators is usually one of
  the first things I see. This is usually because a lot of designers and/or developers will think that focus indicators
  look ugly and will put in the following CSS to get rid of them:
</p>

<?php includeShowcode("focus-remove", "", "", "", false)?>
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

<template id="focus-remove">
  *:focus {
  outline: none;
  }

</template>

<p>
  <strong>This is a bad idea.</strong> Keyboard users need focus states need these focus indicators to know what
  interactive element currently has focus. "But VoiceOver has it's own focus indicator!" is what I hear some of you say.
  Not everyone who uses a keyboard uses VoiceOver. <strong>You absolutely need a visible focus indicator on all your
    interactive elements in order to pass <a href="https://www.w3.org/WAI/WCAG21/Understanding/focus-visible.html">WCAG
      2.4.7</a></strong>.
</p>
<p>
  <strong>What you can do is make focus indicators only appear for keyboard users.</strong> This can be done using the
  <code>:focus-visible</code> CSS pseudo-class. Here is how the Enable site codes them globally using <a href="https://www.tpgi.com/focus-visible-and-backwards-compatibility/">TPGI's excellent method to use <code>:focus-visible</code> while ensuring browsers that don't support it fallback to using <code>:focus</code> gracefully</a>:
</p>

<?php includeShowcode("css-focus-visible", "", "", "", false)?>
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

<template id="css-focus-visible">
  /* Initial focus style for all browsers (keyboard and mouse users). */
  *:focus {
    outline: solid 2px #3b99fc;
  }

  /* Turn off focus style above if browser supports :focus-visible. */
  *:focus:not(:focus-visible) {
    outline: none;
  }

  /*
  * For browsers that support :focus-visible, use it to show focus
  * indicators to keyboard users only.
  */
  *:focus-visible {
    outline: solid 2px #3b99fc;
  }

</template>

<p>
  Is it just keyboard users that will see focus states styled with <code>focus-visible</code>.  Kind of, but there are a few subtleties.  <a href="https://andyadams.org/">Andy Adams</a> has written <a href="https://css-tricks.com/almanac/selectors/f/focus-visible/">a great article for CSS Tricks about :focus-visible</a> that really goes into detail.
</p>

<h2>Increase Hit Areas Inside Focusable Elements</h2>

<p>
  If you use a keyboard to navigate through the main navigation, you will notice the clickable hit-area of the top level navigation items are a lot bigger than they actually take up in the layout:
</p>


<figure>

  <?php pictureWebpPng("images/focus/clickable-hit-state", "Screenshot of the Enable website's main navigation, with keyboard focus applied to the 'controls' navigation drawer.")?>

  <figcaption>Figure 1. The focus state of the "Contols" navigation button.  Note that the hit area is a lot larger than the visual height of the thin horizontal gray strip where the drawer sits inside.</figcaption>
</figure>

<p>We increased the hit area to conform to <a href="https://www.w3.org/WAI/WCAG21/Understanding/target-size.html">WCAG 2.5.5: Target Size</a>.  Even though this is a AAA requirement, it is so easiy to implement by increasing the padding and componsating visually with an equivalent negative margin:</p>

<?php includeShowcode("css-focus-hitarea", "", "", "", false)?>
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

<template id="css-focus-hitarea">
.enable-flyout__open-level-button {
  padding: 27px 0;
  margin: -27px 0;
}

</template>

<p>I encourage everyone reading this to implement this on all the websites they code.  From a UX perspective, it just makes it easier for everyone to use the websites you code.</p>

<!--
<h2>Don't Forget Windows High Contrast Mode Users.</h2>

Sometimes, you will want to style focus states without the CSS <code>outline</code> property.  If you do this, consider also using outline with the <code>transparent</code> colour:
-->
