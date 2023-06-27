<p>
  When Reflow was first introduced into WCAG 2.1, the wording of the requirement was a little to understand. Basically, content should be understandable without the user having to scroll in two dimensions. Exceptions to this is content which requires the given layout in order to preserve meetings in items, including:
</p>

<ul>
  <li>Maps</li>
  <li>Data Tables</li>
  <li>Graphics</li>
  <li>Video</li>
  <li>Toolbars for content editors</li>
</ul>

<p>
  <a href="https://www.w3.org/WAI/WCAG21/Understanding/reflow.html">The actual WCAG guideline for Reflow</a> states two dimension scrolling should not happen for:
  </p>

<ol>
  <li>Vertical scrolling content at a width equivalent to 320 CSS pixels</li>
  <li>Horizontal scrolling content at a height equivalent to 256 CSS pixels.</li>
</ol>

<p>
  These numbers were used in the requirement because, at the time, 1280x1024 resolution displays were considered the average size of a desktop computer display, and if you zoomed a website at that resolution by 400%, it would be the same as looking at the website at a 320x256 pixel resolution.  While testing your work at such a display, reflow issues at other resolutions are probably going to occur at this resolution as well.
</p>


<h2>Have Offscreen Content Appear Below Onscreen Content</h2>

<p>
  Consider a piece of horizontally-scrolling navigation like this (which doesn't reflow) that has a lot of vertically scrolling content underneath:
</p>

<!--
<?php ob_start(); ?>
<p>The toolbar in this iframe scrolls in two directions.  It violates the <a href="https://www.w3.org/WAI/WCAG21/Understanding/reflow.html">WCAG Reflow guidline</a>.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->

<iframe class="reflow-example__frame" src="reflow__example-of-issue.php?copy=<?= $copy ?>" title="Example of a Reflow Issue with a piece of navigation">
</iframe>

<p>This is obviously a Reflow violation.  The easiest way to fix this is to just turn off the horizontal scrolling (usually done by CSS: overflow-x: scroll) and let the content stack on top of each other.</p>


<!--
<?php ob_start(); ?>
<p>The toolbar in this iframe differs from the previous one in that it doesn't scroll in two directions, thus avoiding the WCAG reflow violation.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->
<iframe class="reflow-example__frame" src="reflow__example-of-issue.php?className=reflow-examples__remove-overflow" title="Example of a Reflow Issue fixed by removing overflow scroll CSS">
</iframe>


<h2>Use Arrow Buttons to Access Offscreen Content</h2>

<p>
  I can hear the voices of some designers that I worked with in the past not liking the look of the previous example.  Another easy way to mitigate this issue is to use arrow buttons to provide an alternative method to expose the off-screen content without resorting to using a scrollbar or to swipe the content back and forth on a touch device:
</p>

<!--
<?php ob_start(); ?>
<p>The toolbar in this iframe scrolls in two directions, but it also has arrow buttons.  Since there is an alternative to scrolling in two dimensions, it is not considered a violation of WCAG 2.1.</p>
<?php $copy = urlencode(ob_get_contents()); ?>
-->

<iframe class="reflow-example__frame" src="reflow__example-of-issue.php?className=reflow-examples__show-arrow-buttons&copy=<?= $copy ?>" title="Example of a Reflow Issue fixed by putting in arrow buttons">
</iframe>

<h2>Use a Dropdown to Expose Offscreen Content</h2>

<p>On other projects, designers decided to put the offscreen content in a dropdown.</p>

<!-- INSERT nav-example--offscreen-dropdown -->


<h2>Use a Dropdown to Expose All Content</h2>




<h2>Use a Modal to Show All the Content</h2>

<p>
  This is a common strategy I've seen on Product Listing Pages on e-commence sites. 