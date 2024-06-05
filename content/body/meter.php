<p>
  The meter component is used to show a scalar measurement within a known range or a fractional value. 
  For example, meter could be used to display a device's current battery or a car's remaining fuel level. 
  In cases where there is no fixed maxium, it is preferable to utilize the <a href="/progress.php">progress bar</a> component.
</p>

<p>
  This page provides examples of both HTML and aria based solutions for creating accessible meter components.
</p>

<h2>HTML5 meter component</h2>
<?php includeStats(["isForNewBuilds" => true]); ?>

<p>
    This progress bar uses aria-live regions to update the status of the progress bar. It works in for all
    screen
    readers. It is the most bulletproof way to implement a progress bar if you need to ensure that screen reader
    users are updated as soon as the progress bar value changes.  Be mindful of how often the ARIA live region updates, so it
    doesn't cause unnecessary noise for screen readers users.
</p>

<div id="html5-example" class="enable-example">
  <div class="meter-container">
    <strong aria-hidden="true">Volume:</strong>
    <meter aria-label="Current volume" min="0" max="100" optimum="100" low="20" high="80"  value="10"></meter>
  
    <strong aria-hidden="true">Brightness:</strong>
    <meter aria-label="Current brightness" min="0" max="100" optimum="0" low="20" high="80" value="25"></meter>

    <strong aria-hidden="true">Battery:</strong>
    <meter aria-label="Remaining battery" min="0" max="100" optimum="100" low="20" high="50" value="10"></meter>
  </div>
</div>

<?php includeShowcode("html5-example"); ?>
<script type="application/json" id="html5-example-props">
{
    "replaceHtmlRules": {},
    "steps": [{
            "label": "Use the HTML5 meter tag to create your meter component.",
            "highlight": "%OPENCLOSECONTENTTAG%meter",
            "notes": "Set the <code>min</code> and <code>max</code> values to the min and max values of what your meter bar is measuring. <code>value</code> is the current value."
        },
        {
            "label": "Use <code>aria-label</code> field to announce the name of each meter.",
            "highlight": "%OPENCLOSECONTENTTAG%meter",
            "notes": ""
        },
        {
            "label": "Use <code>aria-hidden</code> field on any visual labels to prevent redundant items being read out.",
            "highlight": "%OPENCLOSECONTENTTAG%strong",
            "notes": ""
        }
    ]
}
</script>