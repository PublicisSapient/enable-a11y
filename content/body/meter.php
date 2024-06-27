<p>
  The meter component is used to show a scalar measurement within a known range or a fractional value. 
  For example, meter could be used to display a device's current battery or a car's remaining fuel level. 
  In cases where there is no fixed maximum, it is preferable to utilize the <a href="/progress.php">progress bar</a> component.
</p>

<p>
  This page provides examples of both HTML and ARIA based solutions for creating accessible meter components.
</p>

<h2>HTML5 Meter Example</h2>
<?php includeStats(["isForNewBuilds" => true]); ?>

<p>
  Use of the HTML5 meter element is supported in most browsers. As defined in the 
  <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meter#technical_summary">MDN docs</a>, 
  this will utilize the meter role which will read out the current percentage of the meter.
</p>

<figure>
  <figcaption id="screen-reader-table__caption" class="caption">
    Screen reader announcements of the HTML5 meter component by platform
  </figcaption>

    <div class="sticky-table__container">
      <table class="screen-reader-table" tabindex="0">
        <thead>
          <tr>
            <th scope="col">Chrome (Android, Talkback)</th>
            <th scope="col">Firefox (Windows, NVDA)</th>
            <th scope="col">Safari (OSX, Voiceover)</th>
            <th scope="col">Safari (iOS, Voiceover)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><p>
              Reads the meter value. <hr/>
              <em>0,2, Disk C</em> <br/>
              <em>0.9, Disk D</em> <br/>
              <em>0.6, Disk E</em>
            </p></td>
            <td><p>
              Reads the meter value. <hr/>
              <em>Disk C, Progress Bar, 0.2</em> <br/>
              <em>Disk D, Progress Bar, 0.9</em> <br/>
              <em>Disk E, Progress Bar, 0.6</em>
            </p></td>
            <td><p>
              Reads the meter condition. <hr/>
              <em>Optimal value, Disk C, Level Indicator</em> <br/>
              <em>Critical value, Disk D, Level Indicator</em> <br/>
              <em>Suboptimal value, Disk E, Level Indicator</em>
            </p></td>
            <td><p>
              Reads the meter condition. <hr/>
              <em>Disk C, Optimal value</em> <br/>
              <em>Disk D, Critical value</em> <br/>
              <em>Disk E, Suboptimal value</em>
            </p></td>
          </tr>
        </tbody>
      </table>
    </div>
</figure>

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
          "label": "Add the <code>aria-labelledby</code> attribute to announce the name of each meter.",
          "highlight": "aria-labelledby",
          "notes": "This should point to the <code>id</code> of the associated label tag."
        },
        {
            "label": "Apply <code>aria-hidden</code> to any visual labels to prevent redundant items being read out.",
            "highlight": "aria-hidden",
            "notes": ""
        }
    ]
}
</script>

<h2>ARIA role="meter" Example</h2>

<p>
  Should a case arise where the HTML5 meter component is not accessible for a given browser, the following can be used as an alternative.
</p>

<p>
  Hint: If you are using v.Nu for validation, there is a <a href="https://github.com/validator/validator/issues/1380">known issue</a> with <code>role="meter"</code>.
  This gets flagged as an invalid role despite being defined in <a href="https://www.w3.org/TR/wai-aria-1.2/#meter">Aria 1.2</a>.
</p>

<figure>
  <figcaption id="screen-reader-table__caption" class="caption">
    Screen reader announcements of the ARIA meter component by platform
  </figcaption>

    <div class="sticky-table__container">
      <table class="screen-reader-table" tabindex="0">
        <thead>
          <tr>
            <th scope="col">Chrome (Android, Talkback)</th>
            <th scope="col">Firefox (Windows, NVDA)</th>
            <th scope="col">Safari (OSX, Voiceover)</th>
            <th scope="col">Safari (iOS, Voiceover)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><p>
              Reads the meter value. <hr/>
              <em>0,2, Disk C</em> <br/>
              <em>0.9, Disk D</em> <br/>
              <em>0.6, Disk E</em>
            </p></td>
            <td><p>
              Reads the meter value. <hr/>
              <em>Disk C, Progress Bar, 0.2</em> <br/>
              <em>Disk D, Progress Bar, 0.9</em> <br/>
              <em>Disk E, Progress Bar, 0.6</em>
            </p></td>
            <td><p>
              Reads the meter condition. <hr/>
              <em>Disk C, Optimal, Level Indicator</em> <br/>
              <em>Disk D, Critical, Level Indicator</em> <br/>
              <em>Disk E, Suboptimal, Level Indicator</em>
            </p></td>
            <td><p>
              Reads the meter value <hr/>
              <em>Disk C, 0.2</em> <br/>
              <em>Disk D, 0.9</em> <br/>
              <em>Disk E, 0.6</em> <br/>
            </p></td>
          </tr>
        </tbody>
      </table>
    </div>
</figure>

<div id="aria-example" class="enable-example">
  <strong>Storage Space</strong>

  <div class="container">
    <label id="disk-c-meter-aria" aria-hidden="true">Disk C:</label>
    <div
      aria-labelledby="disk-c-meter-aria"
      class="enable-custom-meter"
      role="meter"
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
          "label": "Add the <code>aria-labelledby</code> attribute to announce the name of each meter.",
          "highlight": "aria-labelledby",
          "notes": "This should point to the <code>id</code> of the associated label tag."
        },
        {
            "label": "Apply <code>aria-hidden</code> to any visual labels to prevent redundant items being read out.",
            "highlight": "aria-hidden",
            "notes": ""
        },
        {
          "label": "Use JS to calculate and pass meter percentage/state.",
          "highlight": "%JS% meter.init ||| element.setAttribute\\('style', `--meter-percentage: \\${percentage}%`\\); ||| element.setAttribute\\('meter-state', state\\);",
          "notes": "By setting these new attributes on the element, we can access them from the CSS."
        },
        {
          "label": "Use new attributes in CSS to style the meter element and it's psuedo elements.",
          "highlight": "%CSS% meter-css~ ||| meter-state ||| var\\(--meter-percentage\\)",
          "notes": "To support Firefox, be sure to set these attributes for both <code>::before</code> and <code>::-moz-meter-bar</code>. Lastly to avoid styling issues with Safari, be sure to hide <code>::-webkit-meter-bar</code>."
        }
    ]
}
</script>