<!-- <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The styling on the ARIA version was refactored from
                    <a                         href="http://code.iamkate.com/html-and-css/styling-checkboxes-and-radio-buttons/">Styling checkboxes and radio buttons using CSS</a>
                    by
                    <a href="http://code.iamkate.com/">Kate Morley</a>.
                </li>

            </ul>
        </aside> -->

<p>
  Radio buttons are the easiest way to get users to choose one of a <em>small</em> set of choices. Many developers forget that
  a radio button has <strong>two</strong> labels: one unique to each radio button, and one for the entire group.
</p>

<p>
  The examples below are from
  <a href="https://www.w3.org/WAI/GL/wiki/Using_grouping_roles_to_identify_related_form_controls">Using
    Grouping Roles to Identify Related Form Controls</a>
  from the <a href="https://www.w3.org/">W3C</a>.
</p>

<h2>Radio Buttons grouped with fieldsets</h2>

<?php includeStats(["isForNewBuilds" => true]); ?>

<p>This is the recommended way of grouping radio buttons. If you need them to be styled a different way, please
  look at the next few examples.</p>


<div id="example1" class="enable-example">
  <h3 class="form-heading">Set Alerts for your Account</h3>


  <fieldset>
    <legend>Send an alert when balance exceeds $ 3,000</legend>
    <div>
      <input type="radio" id="radio1-1" name="a1radio">
      <label for="radio1-1">Yes</label>
    </div>
    <div>
      <input type="radio" id="radio1-2" name="a1radio">
      <label for="radio1-2">No</label>
    </div>
  </fieldset>


  <fieldset>
    <legend>Send an alert when a charge exceeds $ 250</legend>
    <div>
      <input type="radio" id="radio2-1" name="a2radio">
      <label for="radio2-1">Yes</label>
    </div>
    <div>
      <input type="radio" id="radio2-2" name="a2radio">
      <label for="radio2-2">No</label>
    </div>
  </fieldset>
  <div>
    <input type="submit" value="Continue">
  </div>
</div>

<?php includeShowcode("example1"); ?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use a fieldset to group the related radio buttons",
      "highlight": "%OPENCLOSECONTENTTAG%fieldset",
      "notes": "Fieldsets are the recommended way to group HTML5 radio buttons"
    },
    {
      "label": "Use a legend to label the fieldset",
      "highlight": "%OPENCLOSECONTENTTAG%legend",
      "notes": "Legends will label the entire fieldset and will be announced when screen reader users apply focus to the any of the radio buttons for the first time"
    },
    {
      "label": "Connect the radio buttons with a label",
      "highlight": "for",
      "notes": "Just like any form element, labels should be linked up with the radio button using the HTML for attribute in the label tag."
    }
  ]
}
</script>


<h2>HTML5 radio buttons that have custom styling</h2>

<?php includeStats([
    "isStyle" => true,
    "comment" => "Read this to style native radio buttons like a Jedi Master",
]); ?>

<p>
    Radio buttons can be styled using a bit of careful CSS-fu.  I styled these by refactoring
    the basic CSS from the <a href="https://codepen.io/manabox/pen/raQmpL">Custom Radio Button CSS Only Codepen</a>
  by <a href="http://webcreatormana.com">Mana</a>. I added focus states as well <a
    href="https://www.sarasoueidan.com/blog/inclusively-hiding-and-styling-checkboxes-and-radio-buttons/">ensuring
    that these styled facades will be discoverable to users navigating by touch</a>.
</p>

<div id="example1-styled" class="enable-example">
  <div class="enable-radio">
    <h3 class="form-heading">Set Alerts for your Account</h3>


    <fieldset>
      <legend>Send an alert when balance exceeds $ 3,000</legend>
      <div>
        <input type="radio" id="enable-radio1-1" name="enable-a1radio">
        <label for="enable-radio1-1">Yes</label>
      </div>
      <div>
        <input type="radio" id="enable-radio1-2" name="enable-a1radio">
        <label for="enable-radio1-2">No</label>
      </div>
    </fieldset>


    <fieldset>
      <legend>Send an alert when a charge exceeds $ 250</legend>
      <div>
        <input type="radio" id="enable-radio2-1" name="enable-a2radio">
        <label for="enable-radio2-1">Yes</label>
      </div>
      <div>
        <input type="radio" id="enable-radio2-2" name="enable-a2radio">
        <label for="enable-radio2-2">No</label>
      </div>
    </fieldset>
    <div>
      <input type="submit" value="Continue">
    </div>
  </div>
</div>

<?php includeShowcode("example1-styled"); ?>

<script type="application/json" id="example1-styled-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Set enable-radio class on the section that will have the custom radio buttons",
      "highlight": "class=\"enable-radio\"",
      "notes": ""
    },
    {
      "label": "Ensure the radio button is before the label",
      "highlight": "%OPENTAG%input ||| %OPENCLOSECONTENTTAG%label",
      "notes": "If you want the label to be <strong>before</strong> the radio, you can do this if you also put a blank label after the input.  The label after the input is going to have styling for the custom radio button."
    },
    {
      "label": "Hide the native radio button",
      "highlight": "%CSS% radiogroup-css~ .enable-radio [type=\"radio\"] { ||| opacity:[^;]*; ||| pointer-events[^;]*;",
      "notes": "We hide the native radio button with <strong>opacity: 0</strong>. This is because this the native radio button will be underneath the custom one.  If we do it this way, these components will be discoverable to users navigating by touch. For more information about being inclusive of users navigating by touch, please read <a href=\"https://www.sarasoueidan.com/blog/inclusively-hiding-and-styling-checkboxes-and-radio-buttons/\">Inclusively Hiding & Styling Checkboxes and Radio Buttons</a> by Sara Soueidan."
    },
    {
      "label": "Use the label's ::before and ::after pseudo-elements to style the custom radio button",
      "highlight": "%CSS% radiogroup-css~ .enable-radio [type=\"radio\"] + label::before, .enable-radio [type=\"radio\"] + label::after { ||| width:[^;]*; ||| height:[^;]*;",
      "notes": "The label's <strong>::before</strong> pseudo-element will be the radio buttons outer border.  The label's <strong>::after</strong> pseudo-element will have the styles for the inner circle when the radio button is checked.  Both have the same width and height as the hidden native radio button.  We have used <code>rem</code> units on the width and height so they grow when the user zooms text (see <a href=\"text-resize.php\">our text resize page</a> for more information on how we do this in a pixel perfect way)."
    },
    {
      "label": "Show the inner circle when the radio button is checked",
      "highlight": "%CSS% radiogroup-css~ .enable-radio [type=\"radio\"]:checked + label::after { ||| transform:[^;]*;",
      "notes": "When the native radio button is checked, we show the custom inner circle. Since it is exactly the same size as the outer ring, we just scale it to be slightly smaller."
    },
    {
      "label": "Show a focus state on the custom radio button when the native one has focus.",
      "highlight": "%CSS% radiogroup-css~ .enable-radio [type=\"radio\"]:focus + label::before {",
      "notes": "If we don't add this, users won't know when this custom element has focus."
    }

  ]
}
</script>


<h2>Custom radio buttons using ARIA</h2>
<?php includeStats(["isForNewBuilds" => false]); ?>

<p>
    Use when some developer before you decided that making <code>&lt;div&gt;</code> tags look like radio buttons was a good use of time.
    Even though it wasn't.  Bad, developer! Bad!
</p>

<div id="example2" class="enable-example">
  <h3 class="form-heading">Set Alerts for your Account</h3>



  <div role="radiogroup" aria-labelledby="alert1" class="enable-custom-radiogroup aria-form-group">
    <p id="alert1" class="legend">Send an alert when balance exceeds $ 3,000</p>
    <div>
      <span role="radio" aria-checked="false" tabindex="0" aria-labelledby="a1r1" data-name="a1radio"></span>
      <span id="a1r1" class="aria-radio-label">Yes</span>
    </div>
    <div>
      <span role="radio" aria-checked="false" tabindex="0" aria-labelledby="a1r2" data-name="a1radio"></span>
      <span id="a1r2" class="aria-radio-label">No</span>
    </div>
  </div>



  <div role="radiogroup" aria-labelledby="alert2" class="enable-custom-radiogroup aria-form-group">
    <p id="alert2" class="legend">Send an alert when a charge exceeds $ 250</p>
    <div>
      <span role="radio" aria-checked="false" tabindex="0" aria-labelledby="a2r1" data-name="a2radio"></span>
      <span id="a2r1" class="aria-radio-label">Yes</span>
    </div>
    <div>
      <span role="radio" aria-checked="false" tabindex="0" aria-labelledby="a2r2" data-name="a2radio"></span>
      <span id="a2r2" class="aria-radio-label">No</span>
    </div>
  </div>
  <div>
    <input type="submit" value="Continue">
  </div>
</div>

<?php includeShowcode("example2"); ?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use an HTML element with role=\"radiogroup\" set to group the related radio buttons",
      "highlight": "role=\"radiogroup\"",
      "notes": "This is the ARIA method to group ARIA radio buttons"
    },
    {
      "label": "Set role=\"radio\" and tabindex=\"0\" to all the custom radio buttons",
      "highlight": "role=\"radio\" ||| tabindex",
      "notes": "The <strong>role=\"radio\"</strong> ensures screen readers announce the component as a radio button when it gets keyboard focus.  The <strong>tabindex=\"0\"</strong> ensures the elements get keyboard focus."
    },
    {
      "label": "Set aria-checked to the appropriate value for all checkboxes",
      "highlight": "aria-checked",
      "notes": ""
    },
    {
      "label": "Use aria-labelledby on the radiogroup to label the group",
      "highlight": "aria-labelledby=\"alert[^\"]*\" ||| id=\"alert[^\"]*\"",
      "notes": "The DOM elements that the aria-labelledby attribute points will act like the <strong>legend</strong> tag in the HTML5 example (i.e. it will label the entire fieldset and will be announced when screen reader users apply focus to the any of the radio buttons for the first time)."
    },
    {
      "label": "Label the custom radio buttons with the aria-labelledby attribute",
      "highlight": "aria-labelledby=\"a1[^\"]*\" ||| id=\"a1[^\"]*\" ||| aria-labelledby=\"a2[^\"]*\" ||| id=\"a2[^\"]*\"",
      "notes": "Just like any form element, labels should be linked up with the radio button using the HTML for attribute in the label tag."
    },
    {
      "label": "Ensure the arrow keys can be used to cycle through the radio buttons after they receive keyboard focus",
      "highlight": "%FILE% js/modules/radiogroup.js ~ accessibility.initGroup",
      "notes": "The <strong>accessibility.initGroup()</strong> method does the heavy lifting here.  It is also used to do the same thing in the <a href=\"08a-tabs.php\">Enable Tabs example</a>.  The <strong>doKeyChecking</strong> option passed to it ensures that the Space and Enter keys can be used to check the radio buttons when pressed."
    },
    {
      "label": "Set up the CSS for the custom styles",
      "highlight": "%CSS% radiogroup-css~ [role=\"radio\"] ||| width[^;]*; ||| height[^;]*;",
      "notes": "This is the radio button's outer circle.  Note the width and height here are measured in <strong>rem</strong> units.  This is so they resize when you use the browser's text resizing/zooming feature."
    },
    {
      "label": "Set up the CSS for the custom styles",
      "highlight": "%CSS% radiogroup-css~ [role=\"radio\"][aria-checked=\"true\"]::after ||| top[^;]*; ||| left[^;]*; ||| width[^;]*; ||| height[^;]*; ||| transform[^;]*;",
      "notes": "The <strong>::after</strong> pseudo-element is the colored inner circle of the checked radio button. The width and height is the size of the radio button minus the border width, and then scaled down using CSS transforms. It is then positioned on top of the radio button's outer circle."
    },
    {
      "label": "Set up the CSS so the inner and outer circles are really circles",
      "highlight": "%CSS% radiogroup-css~ [role=\"radio\"], [role=\"radio\"]::after",
      "notes": "A <strong>border-radius: 50%</strong> makes square elements a circle."
    }
  ]
}
</script>




<h2>HTML5 version that uses radiogroup roles.</h2>
<?php includeStats([
    "isStyle" => false,
    "comment" =>
        "Since fieldsets are a CSS nightmare to fix sometimes, this is nice alternative.",
]); ?>

<p>
    When it comes to styling fieldsets, they can sometimes be as stubborn as my Mom when I tell her it's time for a medical
    checkup.  Unlike my Mom, who is absolutely irreplaceable to me, I can replace fieldsets with an ARIA <code>radiogroup</code> role.
</p>


<div id="example4" class="enable-example">
  <h3 class="form-heading">Set Alerts for your Account</h3>
  <div role="radiogroup" class="aria-form-group" aria-labelledby="html2-alert1">
    <p id="html2-alert1" class="legend">Send an alert when balance exceeds $ 3,000</p>
    <div>
      <input type="radio" id="desc-radio1-1" name="a1e3radio">
      <label for="desc-radio1-1">Yes</label>
    </div>
    <div>
      <input type="radio" id="desc-radio1-2" name="a1e3radio">
      <label for="desc-radio1-2">No</label>
    </div>
  </div>
  <div role="radiogroup" class="aria-form-group" aria-labelledby="html2-alert2">
    <p id="html2-alert2" class="legend">Send an alert when a charge exceeds $ 250</p>
    <div>
      <input type="radio" id="desc-radio2-1" name="a2e3radio">
      <label for="desc-radio2-1">Yes</label>
    </div>
    <div>
      <input type="radio" id="desc-radio2-2" name="a2e3radio">
      <label for="desc-radio2-2">No</label>
    </div>
  </div>
  <div>
    <input type="submit" value="Continue">
  </div>
</div>

<?php includeShowcode("example4"); ?>

<script type="application/json" id="example4-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Set group elements aria-labelledby elements",
    "highlight": "aria-labelledby ||| role=\"radiogroup\"",
    "notes": "The radiogroup is like the <strong>fieldset</strong> tag. It should use the <strong>aria-labelledby</strong> to point to the element that labels the radiogroup (which acts as the legend tag)."
  }]
}
</script>