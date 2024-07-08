<p>

  <strong>A "tooltip" is a non-modal (or non-blocking) overlay containing text-only content that provides supplemental
  information about an existing UI control. It is hidden by default, and becomes available on hover or focus of the
  control it describes.</strong> <a href="https://sarahmhigley.com/">Sarah M. Higley</a> came up with this definition for what a
  tooltip is in her article <a href="https://sarahmhigley.com/writing/tooltips-in-wcag-21/">Tooltips in the time of WCAG
    2.1</a>, and its better than anything I could write, so I hope she doesn't mind me stealing it.
</p>


<h2>JavaScript tooltips</h2>

<?php includeStats([
    "isForNewBuilds" => true,
    "comment" => "Recommended for new and existing work.",
]); ?>
<?php includeStats([
    "isNPM" => true,
]); ?>

<p>
  This solution can be styled exactly the want, appears on focus, and uses the maximum value of a z-index in the document.  It will disappear when keyboard users press the Escape key.  <strong>It doesn't work in mobile,</strong> which while consistent with other tooltip solutions, is something that I am still looking to fix.  If anyone has any ideas, please feel to <a href="https://twitter.com/zoltandulac">reach out to me on Twitter</a>.
</p>

<div id="example1" class="enable-example">
  <form class="enable-form-example">
    <fieldset>
      <legend>Vehicle Inspection Form</legend>
      <div class="enable-form-example__fieldset-inner-container">
          <div class="field-block">
            <label for="tooltip_example_1" class="form-label">
              <span>VIN</span>
              <button role="button" type="button" class="text-button" aria-label="Clickable tooltip information" 
                data-tooltip="VIN (Vehicle Identification Number) is a 17 character (digits/capital letters) unique identifier for a vehicle.">
                <span>What's this?</span>
              </button>
              </label>
            <input id="tooltip_example_1" size="25" type="text">
          </div>
          <div class="field-block">
            <label for="tooltip_example_2" class="form-label">Make</label>
            <input id="tooltip_example_2" size="25" type="text" data-tooltip="The brand or company that produced the vehicle.">
          </div>
          <div class="field-block">
            <label for="tooltip_example_3" class="form-label">
              <span>Body style</span>
            </label>
            <input id="tooltip_example_3" size="25" type="text">
            <button id="icon-button" type="button" class="icon-button" aria-label="Clickable tooltip information" 
                data-tooltip="Categorization of a car based on its shape, style, and space. Examples include sedan, SUV, convertible, etc.">
                <span class="icon" aria-hidden="true">i</span>
              </button>
          </div>
      </div>
    </fieldset>
  </form>
</div>


<?php includeShowcode("example1"); ?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Create markup",
      "highlight": "data-tooltip",
      "notes": "Our script uses the <code>data-tooltip</code> attribute instead of the <code>title</code> attribute, since <strong>title</strong> is rendered by user agents by default and cannot be styled."
    },
    {
      "label": "Create JavaScript events for tooltip script",
      "highlight": "%JS% tooltip.create; tooltip.init",
      "notes": "When the page is loaded, create the tooltip DOM object and initialize the mouse and keyboard events that will display the tooltips. <strong>Note the role of tooltip being added to the tooltip DOM object</strong>."
    },
    {
      "label": "Create the show and hide methods for the tooltip",
      "highlight": "%JS% tooltip.show; tooltip.hide",
      "notes": "We make sure the element that triggered the tooltip's <code>show</code> method will be connected to it with the aria-describedby attribute, which points to the tooltip.  This ensures screen readers announce the tooltip on focus."
    },
    {
      "label": "Ensure tooltip disappears when Escape key is pressed",
      "highlight": "%JS% tooltip.onKeyup",
      "notes": "This is to ensure keyboard users can make the tooltip disappear without tabbing out of the component."
    },
    {
      "label": "Set up the CSS",
      "highlight": "%CSS%tooltip-css~ .tooltip; .tooltip::before; .tooltip--hidden ||| border[^:]*: 1px solid transparent; ",
      "notes": "The arrow that points to this tooltip is CSS generated content. We hide the content ensuring it is still read by screen readers. <strong>Note the highlighted properties</strong>.  <a href=\"https://piccalil.li/quick-tip/use-transparent-borders-and-outlines-to-assist-with-high-contrast-mode\">These ensure the tooltips appear in Windows High Contrast Mode</a>."
    }
  ]
}
</script>



<h2>Native HTML Tooltips</h2>

<?php includeStats([
    "doNot" => true,
    "comment" =>
        "Although this is a common method to make tooltips, I would advise using the JavaScript method instead.",
]); ?>


<p>
  This solution requires no JavaScript and is dead simple to implement. <strong>However, in general, you should be
    careful when using it:</strong>
</p>

<ul>
  <li><strong>It only works for mouse users.</strong> Keyboard users don't see the tooltip.</li>
  <li><strong>There is no way to style the tooltips with CSS or anything else.</strong> You are stuck with what the
    browser decides looks good.</li>
  <li><strong>There is a small delay</strong> between the time the user hovers the item with the tooltip and when the
    tooltip appears. There isn't a way to adjust this delay.</li>
  <li><strong>The tooltip inherits the z-index of element being hovered.</strong> If there are elements close by that
    have a higher
    stacking order, it will not appear as intended.</li>
</ul>

<p>
  So should you not use <code>title</code> at all?  There are places where developers may use it:
</p>

<ul>
  <li>For <a href="https://www.w3.org/TR/2014/NOTE-WCAG20-TECHS-20140311/H28">providing definitions to abbreviations</a> using the <code>&lt;abbr&gt;</code> tag (However, <a href="https://twitter.com/stevefaulkner">Steve Faulkner</a> suggests <a href="https://www.tpgi.com/short-note-the-abbreviation-appreciation-society/">other methods for expanding abbreviations in a more user friendly way</a>.</li>
  <li>For <a href="https://dequeuniversity.com/tips/provide-iframe-titles">providing titles to iFrames</a> (which has nothing to do with its tooltip functionality).</li>
</ul> 

<p>
  A really good round up of how the <code>title</code> attribute works, its history, and where it is appropriate to
  use it is in
  <a href="https://www.24a11y.com/2017/the-trials-and-tribulations-of-the-title-attribute/">The Trials and
    Tribulations of the Title Attribute</a> by <a href="https://www.scottohara.me/">Scott O'Hara</a>
</p>

<p>All of that said, here is a demo on how to make tooltips using <code>title</code>.  It is not advised to use it.</p>


<div id="native-example" class="enable-example">

  <p>
    <strong>Hover over the link and the text field to see the tooltips.</strong>
  </p>


  <p>
    <a href="/" title="This tooltip is accessible!">This link has a tooltip</a>
    <label for="input-tooltip-example1">and so does this input field:</label>
    <input id="input-tooltip-example1" type="text" title="You can put tooltips on any focusable item.">
  </p>

</div>

<?php includeShowcode("native-example"); ?>
<script type="application/json" id="native-example-props">
{
  "replaceHtmlRules": {
  },
  "steps": [
  {
    "label": "Add title attribute to elements that need tooltips.",
    "highlight": "title",
    "notes": "It doesn't get easier than this."
  }
]}
</script>



<?= includeNPMInstructions("tooltip", [], "tooltip", false, [], null, true) ?>


