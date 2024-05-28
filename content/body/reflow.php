<p>
  When Reflow was first introduced into WCAG 2.1, the wording of the requirement was a little hard for some people to understand. <strong>Basically,
  content should be understandable without the user having to scroll in two dimensions (or, in developer terms, make your layout responsive).</strong> Exceptions to this is content
  which requires the given layout in order to preserve the content's meaning, including:
</p>

<ul>
  <li>Maps</li>
  <li>Data Tables</li>
  <li>Graphics</li>
  <li>Video</li>
  <li>Toolbars for content editors</li>
</ul>

<p>
  <a href="https://www.w3.org/WAI/WCAG21/Understanding/reflow.html">The actual WCAG guideline for Reflow</a> states users should not have to scroll in two
  dimensions to read content in the following scenarios:
</p>

<ol>
  <li>Vertical scrolling content at a width equivalent to 320 CSS pixels</li>
  <li>Horizontal scrolling content at a height equivalent to 256 CSS pixels.</li>
</ol>

<p>
  Why were these numbers chosen?  At the time this WCAG requirement was written, 1280x1024 resolution displays were considered the average size of a desktop computer display, and if you zoomed a website at that resolution by 400%, it would be the same as looking at the website at a 320x256 pixel resolution.  While some may think this viewport view is smaller than any user will actually use, it's how the guideline is written.  Besides, if you don't have any reflow issues at this viewport, its very likely you won't have any at any other viewport size larger than that.
</p>

<p>
  Here are a list of common scenarios we have had to fix.  If you have any others you may want to add, please feel free to go to the <a href="https://github.com/PublicisSapient/enable-a11y/issues">Enable Github issue page</a> to report one your would like to add.
</p>    


<h2>Common Reflow Problem #1: Horizontally Scrolling Navigation</h2>

<p>
  Consider the horizontally-scrolling navigation in the iframe below <strong>which doesn't reflow in the mobile breakpoint.</strong> The navigation, instead, requires the user to vertically scroll to access the content:
</p>

<!--
<?php ob_start(); ?>
<p>The navigation in this iframe scrolls vertically, while the rest of the page scrolls horizontally.  It violates the <a href="https://www.w3.org/WAI/WCAG21/Understanding/reflow.html">WCAG Reflow guideline</a>.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->
<?php includeMobileIframe(
    "reflow__example-of-issue.php",
    "isIframe=yes",
    $copy,
    "Example of a Reflow Issue in horizontal navigation",
    "Reflow Problem",
); ?>

<p>This is obviously a Reflow violation.  But how do we fix this?</p>

<h3>Solution #1: Just Let the Browser Reflow the Content!</h3>

<p>The easiest way to fix this is to just turn off the horizontal scrolling
  (usually done by CSS: overflow-x: scroll) and let the content stack on top of each other.</p>


<!--
<?php ob_start(); ?>
<p>The navigation in this iframe differs from the previous one in that it doesn't scroll in two directions, thus avoiding the WCAG reflow violation.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->
<?php includeMobileIframe(
    "reflow__example-of-issue.php",
    "isIframe=yes&className=reflow-examples__remove-overflow",
    $copy,
    "Example of a Reflow Issue fixed by removing overflow scroll CSS",
    "Solution 1: Let The Browser Do The Work",
); ?>

<h3>Solution #2: Use Arrow Buttons to Access Offscreen Content</h3>

<p>
  I can hear the voices of some designers that I worked with in the past not liking the look of the previous example.
  Another easy way to mitigate this issue is to use arrow buttons to provide an alternative method to expose the
  off-screen content without resorting to using a scrollbar or to swipe the content back and forth on a touch device:
</p>

<!--
<?php ob_start(); ?>
<p>The navigation in this iframe scrolls vertically, but it also has arrow buttons.  Since there is an alternative to scrolling in two dimensions, it is not considered a violation of WCAG 2.1.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->

<?php includeMobileIframe(
    "reflow__example-of-issue.php",
    "isIframe=yes&hasArrows=true&className=reflow-examples__show-arrow-buttons",
    $copy,
    "Example of a Reflow Issue fixed by putting in arrow buttons",
    "Solution 2: Use Arrow Buttons",
); ?>

<p>Note that we made put set <code>tabindex="-1"</code> on the arrow buttons, since they are not needed for keyboard users.</p>


<h3 id="drawer-fix">Solution #3: Use a Drawer to Expose Content</h3>

<p>Using <a href="dropdown.php">an accessible drawer component</a>, we can hide the navigation until it is really needed. This solves the issue of the
  navigation taking up too much space.</p>

<!--
<?php ob_start(); ?>
<p>The navigation in this iframe differs from the previous ones in that it only appears when users click the dropdown, thereby avoiding reflow issues.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->
<?php includeMobileIframe(
    "reflow__example-of-issue.php",
    "isIframe=yes&hasDropdown=true&className=reflow-examples__remove-overflow",
    $copy,
    "Example of a Reflow Issue fixed by using a dropdown to display the navigation bar",
    "Solution 3: Use a Drawer",
); ?>

<p>Alternatively, you can put the content in a <a href="multi-level-hamburger-menu.php">Flyout Hamburger Menu</a>.</p>

<h2>Common Reflow Problem #2: Filters on Product Listing Pages</h2> 

<p>
  A common design problem on many e-commerce sites is on PLPs (product listing pages). Consider the screenshot below
  that shows a desktop PLP with a list of product tiles that follow a list of filters:
</p>

<figure>

  <?php pictureWebpPng("images/reflow/plp", ""); ?>

  <figcaption>Figure 1. Screenshot of the desktop view of a typical product listing page. On the left-hand side, there
    is a list of checkboxes. On the right-hand is a list of product tiles (in this case, showing a list of movies on physical media such as DVD, Blu-ray and VHS.</figcaption>
</figure>

<p>
  This UI works well on wide screens, but obviously won't fit on a small mobile phone without causing a reflow issue. So
  how do we fix this?
</p>

<h3>Solution: Use a Modal</h3>
<p>
  You could use the <a href="#drawer-fix">Drawer Reflow Fix</a> described earlier, but doing this would cause a lot of
  scrolling up and down. Also, since implementing the dropdown solution would mean the product tiles would not appear on the screen at the same time and the filters due to the small screen size, sighted users may not
  understand what the filters are actually doing (since, in the desktop view, clicking the checkboxes in the filter list would immediately
  update the product tile section with the filtered results).
</p>

<p>
  To address these issues, most projects I have worked on (and many e-commerce sites I have used) have implemented
  putting the filters in a modal. The modal should appear when the user clicks on a button labelled something like
  "Filter Results":
</p>

<figure>

  <?php pictureWebpPng("images/reflow/plp--mobile", ""); ?>

  <figcaption>Figure 2. Screenshot of the mobile view of the same product listing page. The list of filter checkboxes is
    replaced with a "Filter Results" button above the product tiles.</figcaption>
</figure>

<p>
  When opened, it should work like all accessible modals should and should have a submit button that will close the
  modal and apply the filters (thus ensuring the user knows the filters will be applied.
</p>
<figure>

  <?php pictureWebpPng("images/reflow/plp--mobile--filter-modal", ""); ?>

  <figcaption>Figure 3. Screenshot of the same mobile view of the same product listing page, showing a modal containing
    the list of filter checkboxes in the desktop view. This modal appears when the "Filter Results" button is
    pressed.</figcaption>
</figure>

<p>You could also put the filter UI in a the mobile version of the <a href="multi-level-hamburger-menu.php">Flyout Hamburger Menu</a> if you like that look better.</p>

<h2>Common Reflow Problem #3: Using a Carousel</h2>

<p>
  Consider a list of items that take up the full width of the browser in the desktop view, such as the example below:
</p>

<figure>

  <?php pictureWebpPng("images/reflow/product-tile-list--desktop", ""); ?>

  <figcaption>Figure 4: Screenshot of a list of four product tiles that use up the full width of the browser viewport.</figcaption>
</figure>

<p>
  Note that there we could shrink the product tiles to fit the width of the viewport, but there is a point where the text can become illegible.  We could stack the tiles, but some designers may not want to use that much vertical space on the page.
</p> 

<p>
  While developers could use any of the above solutions to fix this issue, another possible way is to use a carousel to solve reflow issues, as long as your carousel is accessible <strong>(but please read the <a href="carousel.php">Enable Carousel Page</a> first to understand why carousels may not the best UX choice).</strong>
</p>


<!--
<?php ob_start(); ?>
<p>The navigation in this iframe scrolls vertically, while the rest of the page scrolls horizontally.  It violates the <a href="https://www.w3.org/WAI/WCAG21/Understanding/reflow.html">WCAG Reflow guidline</a>.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->
<?php includeMobileIframe(
    "reflow__example-of-product-tile-carousel.php",
    "isIframe=yes",
    $copy,
    "Example of using Indicators in a carousel to resolve reflow issues",
    "Using a Carousel",
);
?>
