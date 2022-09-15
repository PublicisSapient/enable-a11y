<p><strong>Screen reader only text</strong> (also known as <strong>visually hidden text</strong>) is text that cannot be seen visually, but can be read by
  screen readers. It's used to give extra information to screen readers users
  when they need extra information that isn't in the visual text on the screen.
</p>

<p>Example of when we need to use screen reader only text include:</p>

<ul>
  <li><strong>Instructions on how to use a widget that is only needed for screen
      reader users.</strong> For example, in our <a
      href="pagination-table.php">pagination table demo</a>, which shows only 10
    rows of data at a time, we hide the instructions that non-sighted users will
    find useful (i.e. "The buttons inside this control allow you to paginate
    through the data in the table below, 10 columns at a time.") using an
    <code>aria-describedby</code> that points to screen-reader only text.</li>
  <li><strong>Announcing changes to the page that screen readers users may not
      see.</strong> For example, in our <a
      href="status.php#visually-hidden-status-message--heading">Wiktionary
      lookup demo</a>, we use screen reader only text inside of an ARIA-live
    region to announce when a lookup is successful or not.</li>
  <li><strong>Hiding fieldset legends visually.</strong> While you could do the
    same thing with an <code>aria-label</code> inside a group, using a
    <code>legend</code> is better due to the First Rule of ARIA.</li>
  <li><strong>Exposing visual styled information, like strikethrough text to
      screen reader users.</strong> <a
      href="exposing-style-info-to-screen-readers.php#solution-1-use-visually-hidden-text--heading">Our
      product tile demo</a> shows how we use screen reader only text to do this.
  </li>
  <li><strong>Visually hiding headings that are only helpful to screen reader
      users.</strong> The article <a
      href="https://www.accessibility-developer-guide.com/examples/headings/visually-hidden-headings/">Adding
      visually hidden headings to complete a page's outline</a> from <a
      href="https://www.accessibility-developer-guide.com/">Accessibility
      Developer Guide</a> talks about this in depth.</li>
    <li>Text read in your screen reader's reading mode (i.e. using it to read the page, not for reading out the interactive elements that have focus), screen reader only text is guarenteed to work.  ARIA labels might not be read in your screen readers reading mode.</li>
</ul>

<p>
  <strong>The question you really should ask yourself is: "Would the text I am hiding benefit <em>all users</em>?"</strong> If the answer is yes, don't hide the text (you'd be surprised what useful text is visually hidden by developers).  If it doesn't need to be hidden ... consider not hiding it!
</p>

<h2>Show Me The CSS That I Can Use To Make Screen Reader Only Text</h2>

<p>There have been many variations of the CSS that makes up our
  <code>sr-only</code> class in Enable, the earliest reference of which seems to
  come from <a
    href="https://snook.ca/archives/html_and_css/hiding-content-for-accessibility">Hiding
    Content for Accessibility</a> by <a href="https://snook.ca">Jonathan
    Snook</a> (or, at least, there earliest reference I have found that combines
  a few techniques that eventually became the <code>sr-only</code> class we see
  being used in the wild today). Enable uses the following in our
  <code>sr-only</code> class, based on the gist <a href="https://gist.github.com/ffoodd/000b59f431e3e64e4ce1a24d5bb36034">Improved .sr-only</a>
  by Codepen user <a href="https://codepen.io/ffoodd">ffoodd</a>:</p>


<div id="sr-only-code"
  class="enable-example"
  hidden></div>

<?php includeShowcode("sr-only-code", "", "", "", false)?>
<script type="application/json"
  id="sr-only-code-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "The CSS that for the sr-only class",
    "highlight": "%CSS%all-css~ .sr-only",
    "notes": ""
  }]
}
</script>


<h2>When Should I Use ARIA Labels Instead?</h2>

<ol>
  <li><strong>When giving an accessible name or label to a group of elements (using the <code>group</code> role) or a landmark</strong>. A good example is in step #4 of <a href="/multi-level-hamburger-menu.php#developer-walkthrough-2">the code walkthrough for the explanation of what makes the Enable Hamburger Menu accessible</a>.</li>
  <li><strong>To update the semantic meaning of an element coded with an ARIA <code>role</code> attribute</strong>, such as a step #1 of <a href="progress.php#developer-walkthrough-3">Enable ARIA progress bar example</a>.</li>
  <li><strong>When an accessible label is missing from a control.</strong>  For example, if you have a button that just a background image or an icon font (you could use screen reader only text for this too, but all modern screen readers can understand ARIA labels on interactive elements)</li>
</ol>

<p>
  <strong>Be very careful putting ARIA-labels on a <code>div</code> or <code>span</code> tag.</strong>  Sometimes, screen readers like Voiceover will think that those tags with an <code>aria-label</code> imply that the items inside are a group of interactive elements.  Your mileage may vary.
</p>



<h2>Further Reading</h2>

<ul>
  <li><a
      href="https://accessible360.com/accessible360-blog/use-aria-label-screen-reader-text/">Should
      I use an aria-label or screen-reader only text?</a> by <a
      href="https://www.linkedin.com/in/oliverlangmo/">Oliver Langmo</a></li>
  <li><a href="https://webaim.org/techniques/css/invisiblecontent/">Invisible
      Content Just for Screen Reader Users</a> from <a
      href="https://webaim.org/">WebAIM</a></li>
  <li><a
      href="https://www.w3docs.com/snippets/css/why-and-how-the-bootstrap-sr-only-class-is-used.html">Why
      and How the Bootstrap sr-only Class is Used</a> which explains how this
    CSS class is used in <a href="https://getbootstrap.com/">Bootstrap</a></li>
</ul>