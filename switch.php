<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ARIA Switch Role Example</title>
    <?php include "includes/common-head-tags.php";?>
    <link rel="stylesheet" type="text/css" href="css/switch.css" />
    
  </head>

  <body>
    <?php include "includes/documentation-header.php";?>

    <main>
      <h1>ARIA Switch Role Example</h1>
      <aside class="notes">
        <h2>Notes:</h2>

        <ul>
          <li>
            This code is based on code from the
            <a href="https://developer.mozilla.org/en-US/">MDN</a> article on
            <a
              href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_switch_role"
              >Using the switch role</a
            >
          </li>
          <li>
            The switch must have an <code>aria-checked</code> value associated
            with it.
          </li>
          <li>
            The switch reports the checked state as "on" or "off" in VoiceOver
            and "checked" or "unchecked" in NVDA and ChromeVox.
          </li>
          <li>
            Putting an <code>aria-describedby</code> on the switch can give
            supplementary info to the state of the switch
          </li>
        </ul>
      </aside>

      <h2>A simple switch coded with ARIA.</h2>

      <div id="example1">
        <button
          type="button"
          aria-labelledby="speakerPower__label"
          role="switch"
          aria-checked="true"
          id="speakerPower"
          class="switch"
          aria-describedby="speakerPower-checked"
        >
          <span id="speakerPower-unchecked">off</span>
          <span id="speakerPower-checked">on</span>
        </button>
        <label id="speakerPower__label" class="switch--label"
          >Speaker power</label
        >
      </div>


      <?php includeShowcode("example1")?>

      <script type="application/json" id="example1-props">
      {
        "replaceHTMLRules": {},
        "steps": [{
            "label": "Put in roles",
            "highlight": "role",
            "notes": "Needed to ensure screen readers can announce that this component is a switch and not just a button."
          },
          {
            "label": "Use aria-checked to report the switch's state",
            "highlight": "aria-checked",
            "notes": "Should be true when the switch is on, false otherwise."
          },
          {
            "label": "Set the aria-describedby attribute to the label on the switch",
            "highlight": "aria-describedby",
            "notes": "This is a progressive enhancement technique, in case the browser and/or screen reader cannot interpret the <code>switch</code> role with the <code>aria-checked</code> attribute"
          },
          {
            "label": "Use Javascript to allow users to turn the switch on and off",
            "highlight": "%JS%Switch",
            "notes": "Note that the switch changes state when the button is clicked.  This will work for both mice and keyboard since click fires using both devices when attached to buttons.  Note as well we set a custom event, <code>switch-change</code>, so developers can set event handler when the switch changes value."
          },
          {
            "label": "Put in the label for the button element",
            "highlight": "aria-labelledby",
            "notes": "Just like any other interactive element, a switch needs a label."
          }
        ]
      }
      </script>

    </main>

    <?php include "includes/example-footer.php" ?>
    <script src="js/shared/switch.js"></script>
  </body>
</html>
