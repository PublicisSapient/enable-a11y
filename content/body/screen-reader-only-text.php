<p>Screen reader only text that cannot be seen visually, but can be read by screen readers.  It's used to give extra information to screen readers users when they need extra information that isn't in the visual text on the screen.</p>

<p>Example of when we need to use screen reader only text include:</p>

<ul>
  <li><strong>Instructions on how to use a widget that is only needed for screen reader users.</strong>  For example, in our <a href="pagination-table.php">pagination table demo</a>, which shows only 10 rows of data at a time, we hide the instructions that non-sighted users will find useful (i.e. "The buttons inside this control allow you to paginate through the data in the table below, 10 columns at a time.") using an <code>aria-describedby</code> that points to screen-reader only text.</li>
  <li><strong>Announcing changes to the page that screen readers users may not see.</strong>  For example, in our <a href="status.php#visually-hidden-status-message--heading">Wiktionary lookup demo</a>, we use screen reader only text inside of an ARIA-live region to announce when a lookup is successful or not.</li>
  <li><strong>Hiding fieldset legends visually.</strong>  While you could do the same thing with an <code>aria-label</code> inside a group, using a <code>legend</code> is better due to the First Rule of ARIA.</li>
  <li><strong>Exposing visual styled information, like strikethrough text to screen reader users.</strong>  <a href="exposing-style-info-to-screen-readers.php#solution-1-use-visually-hidden-text--heading">Our product tile demo</a> shows how we use screen reader only text to do this.</li>
  <li><strong>Visually hiding headings that are only helpful to screen reader users.</strong>  The article <a href="https://www.accessibility-developer-guide.com/examples/headings/visually-hidden-headings/">Adding visually hidden headings to complete a page's outline</a> from <a href="https://www.accessibility-developer-guide.com/">Accessibility Developer Guide</a> talks about this in depth.</li>
</ul>

<h2>Show Me The CSS That I Can Use To Make Screen Reader Only Text</h2>

<p>There have been many variations of the CSS that makes up our <code>sr-only</code>  class in Enable, the earliest reference of which seems to come from <a href="https://snook.ca/archives/html_and_css/hiding-content-for-accessibility">Hiding Content for Accessibility</a> by <a href="https://snook.ca">Jonathan Snook</a> (or, at least, there earliest reference I have found that combines a few techniques that eventually became the <code>sr-only</code>  class we see being used in the wild today).  Enable uses the following in our <code>sr-only</code>  class:</p>


<div id="sr-only-code" class="enable-example" hidden></div>

<?php includeShowcode("sr-only-code", "", "", "", false)?>
<script type="application/json" id="sr-only-code-props">
{
  "replaceHtmlRules": {
  },
  "steps": [
  {
    "label": "The CSS that for the sr-only class",
    "highlight": "%CSS%all-css~ .sr-only",
    "notes": ""
  }
]}
</script>


<h2>Further Reading</h2>

<ul>
  <li><a href="https://accessible360.com/accessible360-blog/use-aria-label-screen-reader-text/">Should I use an aria-label or screen-reader only text?</a> by <a href="https://www.linkedin.com/in/oliverlangmo/">Oliver Langmo</a></li>
  <li><a href="https://webaim.org/techniques/css/invisiblecontent/">Invisible Content Just for Screen Reader Users</a> from <a href="https://webaim.org/">WebAIMM</a></li>
  <li><a href="https://www.w3docs.com/snippets/css/why-and-how-the-bootstrap-sr-only-class-is-used.html">Why and How the Bootstrap sr-only Class is Used</a> which explains how this CSS class is used in <a href="https://getbootstrap.com/">Bootstrap</a></li>
</ul>