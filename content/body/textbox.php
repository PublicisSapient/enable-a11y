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
          screen reader.
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
  <li>If you wanted to create a WYSIWYG editor, then you would have to do this, since form elements don't allow the
    editing of formatted text.</li>
</ol>

<p>This last use case we do not cover since creating an accessible WYSIWYG editor would involve quite a bit of
  JavaScript (I will be adding a page in Enable about WYSIWYG editors in the future).
</p>


<h2>HTML example</h2>
<?php includeStats(["isForNewBuilds" => true]); ?>



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
   

    <button type="submit">Submit</button>
    </fieldset>
  </form>

</div>

<?php includeShowcode("html-example"); ?>

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

<?php includeStats([
    "isForNewBuilds" => false,
    "comment" =>
        "It is recommended only if you need to create a JavaScript WYSIWYG editor.",
]); ?>

<p>
  Keep in mind that if you use this in a form, the nice free-form functionality (e.g. HTML5 validation,
  inclusion of data when submitting a form in an HTTP request, etc.) won't work. These examples do, however, show up in
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
      <button type="submit">Submit</button>
      
    </div>
  </div>
</div>




<?php includeShowcode("aria-example"); ?>

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




<h2>Textbox with Character Counter</h2>

<p>A character counter is something that shows users how many characters they can type into a textbox.  It is visible at all times.  Our implementation has the character count information announced to screen reader users in the following scenarios:</p>

<ol>
  <li><strong>When the screen reader user uses the keyboard to access the textbox</strong> (e.g. by using the TAB key or swiping into the textbox on a mobile device)</li>
  <li><strong>When there are 20 characters left before the textbox is filled.</strong>  This value can be changed by the developer by setting the <code>data-warning-threshold</code> attribute.</li>
  <li><strong>When they use the keyboard to press the Escape key.</strong> This key can be changed by the developer by setting the <code>data-read-count-key</code> attribute</li>
</ol>

<p>Note that the code walkthrough below is specific to our implemtation.</p> 

<div id="charcount-simple" class="enable-example">
  <form class="enable-form-example">
    <fieldset>
      <legend>Payment Information</legend>
      <div class="enable-form-example__fieldset-inner-container">
        <div>
          <label for="textarea-characount-simple" class="textarea-label">Delivery Notes:</label>
          <textarea
            id="textarea-characount-simple"
            maxlength="100"
            data-has-character-count="true"
          ></textarea>
        </div>
      </div>

    <button type="submit">Submit</button>
    </fieldset>
  </form>
</div>

<?php includeShowcode("charcount-simple"); ?>

<script type="application/json" id="charcount-simple-props">
  {
    "replaceHtmlRules": {},
    "steps": [
      {
        "label": "Set the 'maxlength' attribute of the textarea element.",
        "highlight": "%INLINE%charcount-simple ||| maxlength",
        "notes": "This stores the maximum amount of character that can be input into the textbox"
      },
      {
        "label": "Set the custom data-has-character-count attribute for the textarea element.",
        "highlight": "%INLINE%charcount-simple ||| data-has-character-count",
        "notes": "This is specific to the Enable implementation. Our JavaScript library ensures that only textboxes with this attribute set update the character count below it."
      }
    ]
  }
</script>

<p>When <code>data-has-character-count</code> is set, the character counter will be created for the textbox and ARIA regions will be appended below the textbox. These ARIA regions will not be visible to sighted users but will provide the information needed for screen readers to announce the character count:</p>

<ol>
  <li>ARIA-describedby Region: this area will be populated when the textbox comes into focus so that screen readers can read the description (i.e. that this is a textbox with a character limit) and instructions on how to use it (i.e. use the Escape key to report how many characters have been used up).</li> 
  <li>ARIA-live Region: this area will be updated when the textbox comes into focus as well as whenever the user presses the Escape key (i.e. the instructions outlined in point #1)
    <ul>
      <li>Note: Chrome only announces the character count when there's a change to the text. In order to have Chrome announce on each key press—to align with other browsers—the JavaScript toggles between appending and removing an exclamation mark to the end of the announcement text.</li>
    </ul>
  </li>
</ol>

<p>The character counter can also be customized using additional data attributes. The character counter below shows the available data attributes and their default values.</p>

<div id="charcount-example" class="enable-example">
  <form class="enable-form-example">
    <fieldset>
      <legend>Payment information</legend>

      <div class="enable-form-example__fieldset-inner-container">


        <div>
          <label for="notes--example2" class="textarea-label">Delivery Notes:</label>
          <textarea
            id="notes--example2"
            name="notes--example2"
            maxlength="100"
            data-has-character-count="true"
            data-read-count-key="Escape"
            data-warning-threshold="20"
            data-visual-text="${numChars}/${maxLength}"
            data-description="In edit text area with a ${maxLength} character limit."
            data-instructions="Press ${keyToPress} to find out how many more characters are allowed."
            data-character-count-text="Character Count: ${numChars} out of ${maxLength}. ${charsRemaining} characters remaining."></textarea>
        </div>

      </div>
    </fieldset>

    <button type="submit">Submit</button>

    <!--
      Help:
         VO/OSX: CAPSLOCK+SHIFT+H
    -->

  </form>

</div>

<p>Below is the HTML markup needed to add the character counter to a textarea element, as well as instructions on how to use it in your own projects.</p>

<?php includeShowcode("charcount-example"); ?>

<script type="application/json" id="charcount-example-props">
{
  "replaceHtmlRules": {},
  "steps": [
    {
      "label": "Set the 'maxlength' attribute of the textarea element.",
      "highlight": "%INLINE%charcount-example ||| maxlength"
    },
    {
      "label": "Set the custom data-has-character-count attribute for the textarea element.",
      "highlight": "%INLINE%charcount-example ||| data-has-character-count"
    },
    {
      "label": "Optional: Provide a key for the user to press to read out the character count.",
      "highlight": "%INLINE%charcount-example ||| data-read-count-key",
      "notes": "The default is the Escape key. For information regarding which keypress events are recognized visit <a href=\"https://developer.mozilla.org/en-US/docs/Web/API/UI_Events/Keyboard_event_key_values\">MDN docs</a>."
    },
    {
      "label": "Optional: Change how many characters are left before announcing after each keypress.",
      "highlight": "%INLINE%charcount-example ||| data-warning-threshold",
      "notes": "The default is 20 characters before the limit is reached."
    },
    {
      "label": "Optional: Visually change how the character count looks.",
      "highlight": "%INLINE%charcount-example ||| data-visual-text",
      "notes": "<strong>${numChars}</strong> and <strong>${maxLength}</strong> are used to string interpolate the values. Make sure they're present. The default is <code>${numChars}/${maxLength}</code> which looks like: <code>11/100</code>."
    },
    {
      "label": "Optional—Internationalization: Change the description.",
      "highlight": "%INLINE%charcount-example ||| data-description",
      "notes": "<strong>${maxLength}</strong> is required to string interpolate the value set in Step #1 so that the screen reader can let the user know the maximum character limit. The description text highlighted below is the default."
    },
    {
      "label": "Optional—Internationalization: Change the keypress instructions.",
      "highlight": "%INLINE%charcount-example ||| data-instructions",
      "notes": "<strong>${keyToPress}</strong> is required to string interpolate the value set in Step #3 so that the screen reader can let the user know which key to press. The instructions text highlighted below is the default."
    },
    {
      "label": "Optional—Internationalization: Change the announcement for character count.",
      "highlight": "%INLINE%charcount-example ||| data-character-count-text",
      "notes": "Provide both <strong>${numChars}</strong> and <strong>${maxLength}</strong> together to provide an informative announcement. <strong>${charsRemaining}</strong> may or may not be beneficial and can be omitted. The text value highlighted below is the default."
    }
  ]
}
</script>



<?= includeNPMInstructions("enable-character-count", [], "", false, [
    "noCSS" => true,
])
?>
