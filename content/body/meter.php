<p>
  The meter component is used to show a scalar measurement within a known range or a fractional value. 
  For example, meter could be used to display a device's current battery or a car's remaining fuel level. 
  In cases where there is no fixed maxium, it is preferable to utilize the <a href="/progress.php">progress bar</a> component.
</p>

<p>
  This page provides examples of both HTML and aria based solutions for creating accessible meter components.
</p>

<h2>HTML5 Meter Example</h2>
<?php includeStats(["isForNewBuilds" => true]); ?>

<p>
  Use of the HTML5 meter element is supported in most browsers. As defined in the 
  <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meter#technical_summary">MDN docs</a>, 
  this will utilize the meter role which will read out the current percentage of the meter.
</p>

<div id="html5-example" class="enable-example">
  <strong>Storage Space</strong>

  <div class="container">
    <label id="disk-c-meter-html5" aria-hidden="true">Disk C:</label>
    <meter aria-labelledby="disk-c-meter-html5" class="enable-custom-meter" value="0.2" min="0" max="1" optimum="0" low="0.2" high="0.8"></meter>
  
    <label id="disk-d-meter-html5" aria-hidden="true">Disk D:</label>
    <meter aria-labelledby="disk-d-meter-html5" class="enable-custom-meter" value="0.9" min="0" max="1" optimum="0" low="0.2" high="0.8"></meter>

    <label id="disk-e-meter-html5" aria-hidden="true">Disk E:</label>
    <meter aria-labelledby="disk-e-meter-html5" class="enable-custom-meter" value="0.6" min="0" max="1" optimum="0" low="0.2" high="0.8"></meter>
  </div>
</div>

<?php includeShowcode("html5-example"); ?>
<script type="application/json" id="html5-example-props">
{
    "replaceHtmlRules": {},
    "steps": [{
            "label": "Use the HTML5 meter tag to create your meter component.",
            "highlight": "%OPENCLOSECONTENTTAG%meter",
            "notes": "Set the <code>min</code> and <code>max</code> values to the min and max values of what your meter bar is measuring. <code>value</code> is the current value. Setting the <code>low</code>, <code>high</code>, and <code>optimum</code> fields will result in browser specific colors."
        },
        {
          "label": "Add the <code>aria-label</code> attribute to announce the name of each meter.",
          "highlight": "aria-label",
            "notes": ""
        },
        {
            "label": "Apply <code>aria-hidden</code> to any visual labels to prevent redundant items being read out.",
            "highlight": "%OPENCLOSECONTENTTAG%p",
            "notes": ""
        }
    ]
}
</script>

<h2>ARIA role="meter" Example</h2>

<p>
  Should a case arise where there HTML5 meter component is not accessible for a given browser, the following can be used as an alternative.
</p>

<p>
  If you are using VNU for validation, there is a <a href="https://github.com/validator/validator/issues/1380">known issue</a> with <code>role="meter"</code>.
  This gets flagged as an invalid role despite being defined in <a href="https://www.w3.org/TR/wai-aria-1.2/#meter">Aria 1.2</a>.
</p>

<div id="aria-example" class="enable-example">
  <strong>Storage Space</strong>

  <div class="container">
    <label id="disk-c-meter-aria" aria-hidden="true">Disk C:</label>
    <div
      aria-labelledby="disk-c-meter-aria"
      class="enable-custom-meter"
      role="meter"
      aria-label="Disk C"
      aria-valuenow="0.2"
      aria-valuemin="0"
      aria-valuemax="1"
      data-low="0.5"
      data-high="0.75"
      data-optimum="0"
    >
    </div>
  
    <label id="disk-d-meter-aria" aria-hidden="true">Disk D:</label>
    <div
      aria-labelledby="disk-d-meter-aria"
      class="enable-custom-meter"
      role="meter"
      aria-label="Disk D"
      aria-valuenow="0.9"
      aria-valuemin="0"
      aria-valuemax="1"
      data-low="0.5"
      data-high="0.75"
      data-optimum="0"
    >
    </div>

    <label id="disk-e-meter-aria" aria-hidden="true">Disk E:</label>
    <div
      aria-labelledby="disk-e-meter-aria"
      class="enable-custom-meter"
      role="meter"
      aria-label="Disk E"
      aria-valuenow="0.6"
      aria-valuemin="0"
      aria-valuemax="1"
      data-low="0.5"
      data-high="0.75"
      data-optimum="0"
    >
    </div>
  </div>
</div>

<?php includeShowcode("aria-example"); ?>
<script type="application/json" id="aria-example-props">
{
    "replaceHtmlRules": {},
    "steps": [{
            "label": "Use the div tag with <code>role=\"meter\"</code>.",
            "highlight": "role",
            "notes": ""
        },
        {
            "label": "Set the associated aria values for min, max, and value.",
            "highlight": "aria-valuenow ||| aria-valuemin ||| aria-valuemax",
            "notes": "These will be <code>aria-valuemin</code>, <code>aria-valuemax</code>, and <code>aria-valuenow</code>. Using aria values will ensure the screen reader announces these correctly."
        },
        {
          "label": "Add the <code>aria-label</code> attribute to announce the name of each meter.",
          "highlight": "aria-label",
          "notes": ""
        },
        {
          "label": "Apply <code>aria-hidden</code> to any visual labels to prevent redundant items being read out.",
          "highlight": "%OPENCLOSECONTENTTAG%p",
          "notes": ""
        },
        {
          "label": "Use JS to calculate and pass meter percentage/state to CSS via style variables.",
          "highlight": "%JS% meter.init",
          "notes": "Pass calculated values to CSS with <code>element.setAttribute('style', `--meter-percentage: ${percentage}%;`)</code> and <code>element.setAttribute('meter-state', state)</code>."
        },
        {
          "label": "Create CSS psuedo element using passed style variables.",
          "highlight": "%CSS% meter-css~",
          "notes": "If you prefer not to use JS, you can alternatively do this with <a href='https://developer.mozilla.org/en-US/docs/Web/CSS/Attribute_selectors'>CSS Attribute Selectors</a>. However, this will limit certain functionality with meter state/percentage."
        }
    ]
}
</script>