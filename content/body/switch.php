<p>
  A switch is like a checkbox, in that is designed to be an input control that has a binary value
  (either <strong>checked</strong> and <strong>unchecked</strong> or <strong>on</strong> or <strong>off</strong>,
  depending on the screenreader).
  Like <a href="tabs.php">tablists.php</a>, switches do not have a native HTML5 tag, so we implement custom code using
  the
  <code>switch</code> role in JavaScript.
</p>

<p>
  Many developers will implement switches using the <code>&lt;input type="checkbox"&gt;</code>, since the native HTML5
  checkbox control is already accessible. While you could do this, I would argue this is semantically dishonest: partially
  sighted users who use a screen reader hear that the control is a checkbox, but there is no checkmark involved.
</p>

<p>
  My father, who is partially sighted, has fallen in this trap on a website once on his tablet. He was afraid of
  submitting an order form because he felt that the screen reader was lying to him, and he afraid of making a mistake
  because he didn't know what the control really did (he wasn't sure what it was, but it certainly didn't look like a
  checkbox). He tried to explain to me this issue over the phone, and after quite a few minutes not understanding what
  the trouble was, I went over to his house to see what he was talking about. After looking at his tablet, I learned a
  valuable lesson: developers shouldn't be dishonest to users to make things easier for themselves.
</p>

<p>


<h2>A simple switch coded with ARIA.</h2>

<?php includeStats(array('isForNewBuilds' => true)) ?>
<?php includeStats(array('isForNewBuilds' => false)) ?>
<?php includeStats(array('isNPM' => true)) ?>


<p>This code is based on information from the
    <a href="https://developer.mozilla.org/en-US/">MDN</a> article on
    <a href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_switch_role">Using
      the switch role</a>.  The switch reports the checked state as "on" or "off" in VoiceOver
    and "checked" or "unchecked" in NVDA and ChromeVox.  In order to make some consistancy among user agents, an <code>aria-describedby</code> on the switch can state the "on/off" state to all screen readers. This description is also given visually, to make it obvious what the state is for sighted users.  Developers could hide this text with the <code>sr-only</code>, and put "off" and "on" labels on sides of the right and left sides of the component if they wish instead. 
</p>

<div id="example1" class="enable-example">
  <button type="button" aria-labelledby="speakerPower__label" role="switch" aria-checked="true" id="speakerPower"
    class="switch" aria-describedby="speakerPower-checked">
    <span id="speakerPower-unchecked">off</span>
    <span id="speakerPower-checked">on</span>
  </button>
  <label id="speakerPower__label" class="switch--label">Speaker power</label>
</div>


<?php includeShowcode("example1")?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
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
      "highlight": "%FILE%./js/modules/switch.js ||| switch-change",
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

<?= includeNPMInstructions(
  'switch',
  array(),
  false,
  array(),
  null,
  true
) ?>