<!-- <aside class="notes">
      <h2>Notes:</h2>

      <ul>
        <li>The first example is simply a
          <code>div</code> with its
          <code>contenteditable</code> attribute set to
          <code>"true"</code>.
          Textareas can be simulated using <code>aria-multiline="true"</code> and using CSS
          <code>resize: both</code> to make them resizable.
        </li>
        <li>No JavaScript was involved in making these.</li>
        <li>The first example shows up as a form field in Voiceover's rotor and NVDA's Element Dialogue.</li>
        <li>The element will not submit its data to the server like a real form field.</li>
        <li>Coding
          <code>&lt;input type="number" role="textbox" /></code> doesn't do anything useful in any
          screenreader.
        </li>
      </ul>

    </aside> -->

<p>
  It may surprise a lot of people that you can make editable textboxes without JavaScript and without using
  <code>&lt;input type="text"&gt;</code> or <code>&lt;textarea&gt;</code> tags.
</p>

<p>
  Why would you use the ARIA method? I can see two reasons:
</p>

<ol>
  <li><em>Maybe</em> because you can't use <code>::before</code> or <code>::after</code> pseudo-elements to style form
    elements, although there are <a href="https://www.scottohara.me/blog/2014/06/24/pseudo-element-input.html">other
      ways around this without using ARIA</a>.</li>
  <li>If you wanted to create a WYSIWYG editor then you would have to do this, since form elements don't allow the
    editing of formatted text.</li>
</ol>

<p>This last use case we do not cover, since creating an accessible WYSIWYG editor would involve quite a bit of
  JavaScript (I will be adding a page in Enable about WYSIWYG editors in the future).
</p>


<h2>HTML example</h2>
<?php includeStats(array('isForNewBuilds' => true)) ?>



<div id="html-example" class="enable-example">
  <form class="enable-form-example">
    <fieldset>
      <legend>Payment information</legend>

      <div class="enable-form-example__fieldset-inner-container">
        <div>
          <label for="ccinfo">Billing Address:</label>
          <input type="text" name="ccinfo" id="ccinfo">
        </div>

        <div>
          <label for="notes" class="textarea-label">Notes:</label>
          <textarea id="notes"  name="notes"></textarea>
          
        </div>
      </div>
    </fieldset>

    <button type="submit">Submit</button>
  </form>

</div>

<?php includeShowcode("html-example")?>

<script type="application/json" id="html-example-props">
{
  "replaceHtmlRules": {},
  "steps": [

    {
      "label": "All form fields need labels",
      "highlight": "for",
      "notes": "Each form field have a <strong>label</strong> tag whose <strong>for</strong> element connects it to the form field via the form field's <strong>id</strong>."
    },
    {
      "label": "Use <code>&lt;input type=\"text\"&gt;</code> for single line text inputs.",
      "highlight": "%OPENTAG%input"
    },
    {
      "label": "Use <code>&lt;textarea&gt;</code> for multiline text inputs",
      "highlight": "%OPENCLOSETAG%textarea"
    }
  ]
}
</script>


<h2>HTML version with character count</h2>

<?php includeStats(array('isForNewBuilds' => true)) ?>



<div id="html-example" class="enable-example">
  <form class="enable-form-example">
    <fieldset>
      <legend>Payment information</legend>

      <div class="enable-form-example__fieldset-inner-container">
        <div>
          <label for="ccinfo--example2">Billing Address:</label>
          <input type="text" name="ccinfo--example2" id="ccinfo--example2">
        </div>

        <div>
          <label for="notes--example2" class="textarea-label">Notes:</label>
          <textarea id="notes--example2" data-has-character-count="true" name="notes--example2" maxlength="100" data-screen-reader-text="${numChars} characters remaining."></textarea>
        </div>
      </div>
    </fieldset>

    <button type="submit">Submit</button>
  </form>

  <template id="enable-character-count__template">
    <!-- This is for screen readers only -->
    <span class="sr-only">
      ${screenReaderText}
    </span>

    <!-- This is for sighted users -->
    <span aria-hidden="true">
      ${visualText}
    </span>
  </template>

  <template id="enable-character-count-template__screen-reader">
  Character count: ${numChars} out of ${maxLength}
  </template>

  <template id="enable-character-count-template__visual">
  ${numChars}/${maxLength}
  </template>
</div>

<?php includeShowcode("html-example")?>

<script type="application/json" id="html-example-props">
{
  "replaceHtmlRules": {},
  "steps": [

    {
      "label": "All form fields need labels",
      "highlight": "for",
      "notes": "Each form field have a <strong>label</strong> tag whose <strong>for</strong> element connects it to the form field via the form field's <strong>id</strong>."
    },
    {
      "label": "Use <code>&lt;input type=\"text\"&gt;</code> for single line text inputs.",
      "highlight": "%OPENTAG%input"
    },
    {
      "label": "Use <code>&lt;textarea&gt;</code> for multiline text inputs",
      "highlight": "%OPENCLOSETAG%textarea"
    }
  ]
}
</script>



<h2>ARIA example</h2>

<?php includeStats(array('isForNewBuilds' => false, 'comment' => "Recommended only if you needed to create a JavaScript WYSIWYG editor.")) ?>

<p>
  Keep in mind that if you use this in a form, none of the nice free form functionality (e.g.: HTML5 validation,
  inclusion of data when submitting a form in an HTTP request, etc), won't work. These example do, however, show up in
  Voiceover's Rotor and NVDA's Element Dialogue.
</p>

<ul>
  <li>No JavaScript was involved in making these (you would need to use JavaScript, though, to make a true WYSIWYG
    editor).</li>
  <li>The first example is simply a
    <code>div</code> with its
    <code>contenteditable</code> attribute set to
    <code>"true"</code>.
    Textareas can be simulated using <code>aria-multiline="true"</code> and using CSS
    <code>resize: both</code> to make them resizable.
  </li>

  <li>The element will not submit its data to the server like a real form field.</li>
</ul>

<div id="aria-example" class="enable-example">
  <div class="enable-form-example">
    <div role="group" aria-labelledby="aria-payment-info-label" class="fieldset">
      <div id="aria-payment-info-label" class="legend">Payment Information</div>

      <div class="enable-form-example__fieldset-inner-container">
        <div>
          <label id="address-label" class="textarea-label">Address to deliver to:</label>
          <div aria-labelledby="address-label" role="textbox" contenteditable="true"></div>
        </div>

        <div>
          <label id="notes-label" class="textarea-label">Delivery Notes:</label>
          <div aria-labelledby="notes-label" role="textbox" contenteditable="true" aria-multiline="true">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<?php includeShowcode("aria-example")?>

<script type="application/json" id="aria-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Insert roles to ensure they are reported correctly by screen readers",
      "highlight": "role",
      "notes": ""
    },
    {
      "label": "Make the content of the ARIA textbox editable using contenteditable attribute.",
      "highlight": "contenteditable",
      "notes": "If you do this, you don't need to set <strong>tabindex=\"0\"</strong>, since content editable elements get keyboard focus by default"
    },
    {
      "label": "All ARIA textboxes need labels using aria-labelledby",
      "highlight": "aria-labelledby",
      "notes": "Each form field have a label."
    },
    {
      "label": "Use aria-multiline if you are simulating a textarea element.",
      "highlight": "aria-multiline",
      "notes": ""
    },
    {
      "label": "Use CSS to style multiline textboxes differently",
      "highlight": "%CSS%textbox-css~ [role=\"textbox\"]; textarea, [aria-multiline=\"true\"] ||| resize:\\sboth;",
      "notes": "Note the <code>resize: both</code> CSS on the multiline textbox.  Browsers that support it will allow the user to resize the textbox with a mouse (but not with a keyboard, as far as I'm aware).  <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/resize\">More information about this CSS property</a>."
    }
  ]
}
</script>