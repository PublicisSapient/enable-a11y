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
  <strong>Disk Space:</strong>

  <div class="meter-container">
    <p aria-hidden="true">C:</p>
    <meter aria-label="Disk C" min="0" max="100" optimum="0" low="20" high="80"  value="20"></meter>
  
    <p aria-hidden="true">D:</p>
    <meter aria-label="Disk D" min="0" max="100" optimum="0" low="20" high="80" value="90"></meter>

    <p aria-hidden="true">E:</p>
    <meter aria-label="Disk E" min="0" max="100" optimum="0" low="20" high="80" value="60"></meter>
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
            "label": "Use <code>aria-label</code> field to announce the name of each meter.",
            "highlight": "aria-label",
            "notes": ""
        },
        {
            "label": "Use <code>aria-hidden</code> field on any visual labels to prevent redundant items being read out.",
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

<div id="aria-example" class="enable-example">
  <strong>Disk Space:</strong>

  <div class="meter-container">
    <p aria-hidden="true">C:</p>
    <div
      class="meter"
      role="meter" 
      aria-label="Disk C"
      aria-valuenow="20"
      value="20"
      aria-valuemin="0"
      min="0" 
      aria-valuemax="100"
      max="100" 
      optimum="0" 
      low="20" 
      high="80"  
    >
    </div>
  
    <p aria-hidden="true">D:</p>
    <div
      class="meter"
      role="meter" 
      aria-label="Disk D"
      aria-valuenow="90"
      value="90"
      aria-valuemin="0"
      min="0" 
      aria-valuemax="100"
      max="100" 
      optimum="0" 
      low="20" 
      high="80"  
    >
    </div>

    <p aria-hidden="true">E:</p>
    <div
      class="meter"
      role="meter" 
      aria-label="Disk E"
      aria-valuenow="60"
      value="60"
      aria-valuemin="0"
      min="0" 
      aria-valuemax="100"
      max="100" 
      optimum="0" 
      low="20" 
      high="80"  
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
            "label": "Set the associated values for min, max, and value. You will also want to set the associated aria values.",
            "highlight": "aria-valuenow ||| aria-valuemin ||| aria-valuemax ||| value ||| min ||| max ",
            "notes": "These will be <code>aria-valuemin</code>, <code>aria-valuemax</code>, and <code>aria-valuenow</code>."
        }
    ]
}
</script>