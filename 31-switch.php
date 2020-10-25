<!DOCTYPE html>
<html>
  <head>
    <title>ARIA Switch Role Example</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/switch.css" />
    <meta charset="utf-8" />
  </head>

  <body>
    <?php include("includes/example-header.php"); ?>

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

      <button
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
    </main>
    <script src="js/shared/switch.js"></script>
  </body>
</html>
