<p>
  When Reflow was first introduced into WCAG 2.1, the wording of the requirement was a little to understand. Basically,
  content should be understandable without the user having to scroll in two dimensions. Exceptions to this is content
  which requires the given layout in order to preserve meetings in items, including:
</p>

<ul>
  <li>Maps</li>
  <li>Data Tables</li>
  <li>Graphics</li>
  <li>Video</li>
  <li>Toolbars for content editors</li>
</ul>

<p>
  <a href="https://www.w3.org/WAI/WCAG21/Understanding/reflow.html">The actual WCAG guideline for Reflow</a> states two
  dimension scrolling should not happen for:
</p>

<ol>
  <li>Vertical scrolling content at a width equivalent to 320 CSS pixels</li>
  <li>Horizontal scrolling content at a height equivalent to 256 CSS pixels.</li>
</ol>

<p>
  These numbers were used in the requirement because, at the time, 1280x1024 resolution displays were considered the
  average size of a desktop computer display, and if you zoomed a website at that resolution by 400%, it would be the
  same as looking at the website at a 320x256 pixel resolution. While testing your work at such a display, reflow issues
  at other resolutions are probably going to occur at this resolution as well.
</p>


<h2>Have Offscreen Content Appear Below Onscreen Content</h2>

<p>
  Consider a piece of horizontally-scrolling navigation like this (which doesn't reflow) that has a lot of vertically
  scrolling content underneath:
</p>

<!--
<?php ob_start(); ?>
<p>The navigation in this iframe scrolls in two directions.  It violates the <a href="https://www.w3.org/WAI/WCAG21/Understanding/reflow.html">WCAG Reflow guidline</a>.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->

<iframe class="reflow-example__frame" src="reflow__example-of-issue.php?copy=<?= $copy ?>"
  title="Example of a Reflow Issue with a piece of navigation">
</iframe>

<p>This is obviously a Reflow violation. The easiest way to fix this is to just turn off the horizontal scrolling
  (usually done by CSS: overflow-x: scroll) and let the content stack on top of each other.</p>


<!--
<?php ob_start(); ?>
<p>The navigation in this iframe differs from the previous one in that it doesn't scroll in two directions, thus avoiding the WCAG reflow violation.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->
<iframe class="reflow-example__frame"
  src="reflow__example-of-issue.php?className=reflow-examples__remove-overflow&copy=<?= $copy ?>"
  title="Example of a Reflow Issue fixed by removing overflow scroll CSS">
</iframe>


<h2>Use Arrow Buttons to Access Offscreen Content</h2>

<p>
  I can hear the voices of some designers that I worked with in the past not liking the look of the previous example.
  Another easy way to mitigate this issue is to use arrow buttons to provide an alternative method to expose the
  off-screen content without resorting to using a scrollbar or to swipe the content back and forth on a touch device:
</p>

<!--
<?php ob_start(); ?>
<p>The navigation in this iframe scrolls in two directions, but it also has arrow buttons.  Since there is an alternative to scrolling in two dimensions, it is not considered a violation of WCAG 2.1.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->

<iframe class="reflow-example__frame"
  src="reflow__example-of-issue.php?hasArrows=true&className=reflow-examples__show-arrow-buttons&copy=<?= $copy ?>"
  title="Example of a Reflow Issue fixed by putting in arrow buttons">
</iframe>

<h2 id="dropdown-fix" tabindex="-1">Use a Dropdown to Expose Offscreen Content</h2>

<p>On other projects, designers decided to put the offscreen content in a dropdown.</p>

<!-- INSERT nav-example--offscreen-dropdown -->


<h2>Use a Dropdown to Expose Content</h2>

Using a dropdown component, we can hide the navigation until it is really needed. This solves the issue of the
navigation taking up too much space.

<!--
<?php ob_start(); ?>
<p>The navigation in this iframe differs from the previous ones in that it only appears when users click the dropdown, thereby avoiding reflow issues.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->
<iframe class="reflow-example__frame"
  src="reflow__example-of-issue.php?className=reflow-examples__remove-overflow+reflow-examples__dropdown&hasDropdown=true&copy=<?= $copy ?>"
  title="Example of a Reflow Issue fixed by removing horizontal scrolling and putting it in a dropdown.">
</iframe>

<h2>Use a Modal to Show All the Content</h2>

<p>
  A common design problem on many e-commerce sites is on PLPs (product listing pages).  Consider the screenshot below that shows a desktop PLP with a list of product tiles that follow a list of filters:  
</p>

<figure>

  <?php pictureWebpPng("images/reflow/plp", "")?>

  <figcaption>Figure 1. Screenshot of the desktop view of a typical product listing page.  On the left-hand side, there is a list of checkboxes. On the right-hand is a list of product tiles (in this case, showing a list of product tiles of movies on physical media such as DVD, Blu-ray and VHS.</figcaption>
</figure>

<p>
  This UI works well on wide screens, but obviously won't fit on a small mobile phone without causing a reflow issue.  So how do we fix this?
</p>

<p>
  You could use the <a href="#dropdown-fix">dropdown fix</a> described earlier, but doing this would cause a lot of scrolling up and down.  Also since the product files are not on the screen at the same time, sighted users may not understand what the filters are actually doing (since clicking the checkboxes in the filter list would immediately update the product tile section with the filtered results).
  </p>

  <p>
    To address these issues, most project I have worked on (and many e-commerce sites I have used) have implemented putting the filters in a modal.  The modal should appear when the user clicks on a button labelled something like "Filter Results":
  </p> 

</p>

<figure>

  <?php pictureWebpPng("images/reflow/plp--mobile", "")?>

  <figcaption>Figure 2. Screenshot of the mobile view of the same product listing page.  The list of filter checkboxes is replaced with a "Filter Results" button above the product tiles</figcaption>
</figure>

  <p>
    When opened, it should work like all accessible modals should and should have a submit button that will close the modal and apply the filters (thus ensuring the user knows the filters will be applied.
  </p>
<figure>

  <?php pictureWebpPng("images/reflow/plp--mobile--filter-modal", "")?>

  <figcaption>Figure 3. Screenshot of the same mobile view of the same product listing page, showing a modal containing the list of filter checkboxes in the desktop view.  This modal appears when the "Filter Results" checkboxes is pressed.</figcaption>
</figure>