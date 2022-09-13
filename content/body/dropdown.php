<!-- <aside class="notes">
            <h2>Notes:</h2>

            <p>The HTML5 version does not update its state on all browser/screen-reader combinations
                reliably. For example:</p>
            <ul>
                <li>
                    Safari with Voiceover doesn't update the state when the
                    drawer is opened.
                </li>
                <li>
                    Chrome with Voiceover report "Disclosure triangle" as the role, which is odd.
                <li>
                    Chromevox doesn't indicate that the <code>summary</code> is
                    expandable when it gains keyboard focus
                </li>
            </ul>

            <p>For now, it is advisable to use the ARIA version.</p>
        </aside> -->

<h2>HTML5 version using details and summary tags</h2>

<?php includeStats(array('doNot' => true, 'comment' => 'There are small bugs with this solution with some screen reader/browser combinations.')) ?>

<p>
  <strong>This should be the ideal solution</strong>, since it is a native HTML5 control that doesn't require
  JavaScript. However, there
  are some issues:
</p>

<ul>
  <li>
    Safari with Voiceover <strong>occasionally</strong> doesn't announce the state when the
    drawer is opened (most of the time it does, but I have noticed it enough to make mention of it here).
  </li>
  <li>
    Chrome with Voiceover report "Disclosure triangle" as the role, which is a quite odd and misleading.
  <li>
    Chromevox doesn't indicate that the <code>summary</code> is
    expandable when it gains keyboard focus
  </li>
</ul>

<p>
  These issues have been around for a while (see <a
    href="https://www.hassellinclusion.com/blog/accessible-accordions-part-2-using-details-summary/">Graham Armfield's
    article about the details tag from 2019</a>). I hope that browser manufacturers can fix their accessibility APIs so
  this can work correctly in all platforms.
</p>


<div id="example1" class="enable-example">
  <details class="enable-drawer">
    <summary class="enable-drawer__button">
      Information on the HTML5 <code>details</code> tag.
    </summary>
    <div class="content">
      <p>
        This is the contents of the dropdown. For more information about
        the HTML5 details and summary tags, read the following documents:</p>

      <ul>
        <li><a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details">
            MDM documentation</a></li>
        <li><a
            href="https://css-tricks.com/quick-reminder-that-details-summary-is-the-easiest-way-ever-to-make-an-accordion/">
            Quick Reminder that Details/Summary is the Easiest Way Ever to Make an Accordion
          </a></li>
        <li>
          <a href="https://freefrontend.com/html-details-summary-css/">
            30 HTML details & summary with CSS</a>
        </li>
      </ul>
    </div>

  </details>
</div>



<?php includeShowcode("example1")?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {
    "summary": "<!-- Insert dropdown button label here -->",
    ".content": "<!-- Insert dropdown content here. Doesn't have to wrapped in a div  -->"
  },
  "steps": [{
    "label": "Set up the details and summary tags",
    "highlight": "\\s*&lt;summary[^;]*&gt;[\\s\\S]*&lt;/summary&gt; ||| \\s*&lt;details[^;]*&gt; ||| \\s*&lt;\/details&gt;",
    "notes": "The markup is <strong>really</strong> easy."
  },
  {
    "label": "set up the optional CSS",
    "highlight": "%CSS%enable-dropdown~ .enable-drawer",
    "notes": ""
  }
  
  ]
}
</script>

<h2>HTML5 dropdown with checkboxes</h2>

<p>Frequently, there is a requirement to create a "multi-select selectbox". It is possible to do this with the
  <code>&lt;select&gt;</code> tag, but many users (sighted and blind)
  have difficulty using them and don't even know they are multi-selectable. I have found making dropdowns with
  checkboxes inside is a better solution, and can be done easily with native HTML5 components without ARIA.
</p>


<div id="example1a">
  <details class="enable-multiselect">
    <summary class="enable-multiselect__button">
      Products
    </summary>
    <div class="enable-multiselect__contents">
      <fieldset>
        <legend class="sr-only">
          Products
        </legend>
        <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="product1">
        <label class="enable-multiselect__label" for="product1">Cars</label>
        <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="product2">
        <label class="enable-multiselect__label" for="product2">Trucks</label>
        <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="product3">
        <label class="enable-multiselect__label" for="product3">SUVs</label>
        <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="product4">
        <label class="enable-multiselect__label" for="product4">Motorcycles</label>

      </fieldset>
    </div>

  </details>
</div>


<!-- <?php includeShowcode("example1a")?> -->

<script type="application/json" id="example1a-props">
{
  "replaceHtmlRules": {
    "summary": "<!-- Insert dropdown button label here -->",
    ".content": "<!-- Insert dropdown content here. Doesn't have to wrapped in a div  -->"
  },
  "steps": [{
      "label": "Set up the details and summary tags",
      "highlight": "\\s*&lt;summary[^;]*&gt;[\\s\\S]*&lt;/summary&gt; ||| \\s*&lt;details[^;]*&gt; ||| \\s*&lt;\/details&gt;",
      "notes": "It's really this easy.  Everything else is done for you."
    },
    {
      "label": "Create a fieldset with a legend so the checkboxes can be treated as a group.",
      "highlight": "\\s*&lt;legend[^;]*&gt;[\\s\\S]*&lt;/legend&gt; ||| \\s*&lt;fieldset[^;]*&gt; ||| \\s*&lt;\/fieldset&gt;",
      "notes": "Note the legend is visally-hidden with the `sr-only` class."
    },
    {
      "label": "Create the checkboxes",
      "highlight": "\\s*&lt;input[^;]*&gt;",
      "notes": "The checkboxes here are custom styles.  To learn how to do this, please check <a href=\"06-checkbox.php\">the Enable custom checkbox page</a>."
    },
    {
      "label": "Ensure you have labels for each input",
      "highlight": "for",
      "notes": "This ensures that each checkbox has a proper label associated with it"
    }
  ]
}
</script>


<h2>ARIA version</h2>

<?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This is best solution for both new and existing work.')) ?>
<?php includeStats(array('isNPM' => true)) ?>

<p>
  Even though this is not native, it is pretty easy to set up. There is really one HTML attribute that you have to
  change with JavaScript when the drawer opens or closes: <code>aria-expanded</code>. I just use CSS to style it
  depending what that attribute is set to, and everything just works.
</p>

<div id="example2" class="enable-example">
  <div class="enable-drawer">
    <button id="enable-drawer1" class="enable-drawer__button" aria-controls="enable-drawer1__content"
      aria-expanded="false">
      Information on the aria-expanded version.
    </button>
    <div id="enable-drawer1__content" class="enable-drawer__content" role="group" aria-label="Expanded content">

      <p>
        This is the contents of the dropdown. For more information about
        the aria-expanded, read the following documents:</p>

      <ul>
        <li>
          <a href="https://www.w3.org/WAI/GL/wiki/Using_aria-expanded_to_indicate_the_state_of_a_collapsible_element">
            Using aria-expanded to indicate the state of a collapsible element
          </a>
        </li>
        <li>
          <a href="https://www.accessibility-developer-guide.com/examples/sensible-aria-usage/expanded/">
            Marking elements expandable using aria-expanded</a>
        </li>
        <li>
          <a href="https://www.marcozehe.de/easy-aria-tip-5-aria-expanded-and-aria-controls/">
            Easy ARIA Tip #5: aria-expanded and aria-controls
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<?php includeShowcode("example2")?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {
    "[aria-expanded]": "<!-- Insert dropdown button label here -->",
    "[role=\"group\"]": "<!-- Insert dropdown content here -->"
  },
  "steps": [{
      "label": "Set up the dropdown state on button with aria-expanded",
      "highlight": [
        "aria-expanded"
      ],
      "notes": "It should be set to false if the drawer is closed, true if open."
    },
    {
      "label": "Link up the button to the expanded content using aria-controls",
      "highlight": [
        "aria-controls"
      ],
      "notes": ""
    },
    {
      "label": "Set the aria roles",
      "highlight": "role=\"group\""
    }
  ]
}
</script>

<h2 id="multiselect">ARIA dropdown with checkboxes</h2>

<?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This is a better solution that using multi-select <code>&lt;select&gt;</code> boxes, in my opinion.')) ?>

<p>Frequently, there is a requirement to create a "multi-select selectbox". It is possible to do this with the
  <code>&lt;select&gt;</code> tag, but many users (sighted, partially sighted and non-sighted)
  have difficulty using them and don't even know they are multi-selectable (the comments in <a
    href="https://twitter.com/JotaEme_R">Juan Manuel Ramallo's</a> blog post, <a
    href="https://dev.to/juanmanuelramallo/does-anyone-else-think-html5-multiple-selects-sucks-36ib">Does anyone else
    think HTML5 multiple select sucks?</a> agrees, and the comments in the post show a lot of developers agree). I have
  found making dropdowns with
  checkboxes inside is a better solution, and this can be done without a lot of effort.
</p>


<div id="example-aria-multiselect" class="enable-example">
  <div class="enable-drawer enable-multiselect">
    <button id="aria-dropdown-multiselect" class="enable-drawer__button enable-multiselect__button"
      aria-controls="aria-dropdown-multiselect__content" aria-expanded="false">
      Products
    </button>
    <div id="aria-dropdown-multiselect__content" class="enable-drawer__content" role="group" aria-label="Expanded content">
      <div class="enable-multiselect__contents">
        <ul aria-label="Products" class="enable-multiselect__list">
          <li class="enable-multiselect__list-item">
            <input class="enable-multiselect__checkbox sr-only" name="product" type="checkbox" id="aria-product1">
            <label class="enable-multiselect__label" for="aria-product1">Cars</label>
          </li>
          <li class="enable-multiselect__list-item">
            <input class="enable-multiselect__checkbox sr-only" name="aria-product" type="checkbox" id="aria-product2">
            <label class="enable-multiselect__label" for="aria-product2">Trucks</label>
          </li>
          <li class="enable-multiselect__list-item">
            <input class="enable-multiselect__checkbox sr-only" name="aria-product" type="checkbox" id="aria-product3">
            <label class="enable-multiselect__label" for="aria-product3">SUVs</label>
          </li>
          <li class="enable-multiselect__list-item">
            <input class="enable-multiselect__checkbox sr-only" name="aria-product" type="checkbox" id="aria-product4">
            <label class="enable-multiselect__label" for="aria-product4">Motorcycles</label>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php includeShowcode("example-aria-multiselect")?>

<script type="application/json" id="example-aria-multiselect-props">
{
  "replaceHtmlRules": {

  },
  "steps": [{
      "label": "Set up the dropdown state on button with aria-expanded",
      "highlight": [
        "aria-expanded"
      ],
      "notes": "It should be set to false if the drawer is closed, true if open."
    },
    {
      "label": "Link up the button to the expanded content using aria-controls",
      "highlight": [
        "aria-controls"
      ],
      "notes": ""
    },
    {
      "label": "All the checkboxes should be part of the same group.",
      "highlight": "role=\"group\""
    },
    {
      "label": "Create the checkboxes",
      "highlight": "\\s*&lt;input[^;]*&gt;",
      "notes": "The checkboxes here are custom styles.  To learn how to do this, please check <a href=\"06-checkbox.php\">the Enable custom checkbox page</a>."
    },
    {
      "label": "Ensure you have labels for each input",
      "highlight": "for",
      "notes": "This ensures that each checkbox has a proper label associated with it"
    }
  ]
}
</script>



<?= includeNPMInstructions(
    'enable-drawer',
    array(),
    'enable-drawer',
    false,
    array(),
    null,
    true
  ) 
?>