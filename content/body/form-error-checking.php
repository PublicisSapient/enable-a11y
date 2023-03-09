
    
     

      <p>
        There are two ways to make accessible forms: the native HTML5 way, or using JavaScript.  You would think 
        it would be a no-brainer to just code things the HTML5 way and call it a day instead of creating custom 
        code.  However, many designers don't like the design of native HTML5 error message "bubbles", and want/demand 
        that flexibility.  Since there doesn't seem to be any easy cross-browser workaround for this, I have laballed
        both of the solution below good for new and existing work: the HTML5 one is good if you want to implement 
        validation quickly, and the custom JavaScript implementation is good if you want design flexibility.</p>


      

      <h2>Using native HTML5 validation</h2>

      <?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This is great if you want to implement validation quickly and don\'t care about the styling restrictions of native HTML5 validation.' )) ?>

      <p>
        You can use just <code>required</code> and
        <code>pattern</code> attributes on HTML forms to do client side
        validation <strong>without JavaScript</strong>.  However, in order to make the messaging
        more accessible, we have added a tiny bit of JS code in order to ensure the error messages
        themselves are more accessible to screen reader users (see the last step in the code
        walkthrough for details)
      </p>

      <div id="example1" class="enable-example">
        <form class="enable-form-example"
          onSubmit="alert('form submitted'); return false;"
        >
          <fieldset>
            <legend>Contact Information</legend>

            <p class="form-instructions"><span class="required-symbol">*</span> denotes a required field.</p>

            <div class="enable-form-example__fieldset-inner-container">
              <div class="field-block">
                <label class="required" for="name_html5">Full Name:</label>
                <input id="name_html5" size="25" type="text" required  autocomplete="name" >
              </div>

              <div class="field-block">
                <label class="required" for="email_html5">E-mail address:</label>
                <input id="email_html5" size="25" type="email" required autocomplete="email" >
              </div>

              <div class="field-block">
                <label class="required" for="phone_html5">Phone Number:</label>
                <input                   id="phone_html5"
                  size="25"
                  type="text"
                  required
                  pattern="[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}"
                  aria-describedby="phone-desc"
                  autocomplete="tel"
                >
                <div id="phone-desc" class="desc">
                  Format is xxx-xxx-xxxx<br>
                  (where x is a digit)
                </div>
              </div>

              <input value="Add Contact" type="submit" >
            </div>
          </fieldset>
        </form>
      </div>

      

      <?php includeShowcode("example1")?>

      <script type="application/json" id="example1-props">
      {
        "replaceHtmlRules": {
        },
        "steps": [
          {
            "label": "Put in fieldsets and legends",
            "highlight": "[\\s]*&lt;legend[\\s\\S]*&gt;[\\s\\S]*&lt;/legend&gt; ||| \\s*&lt;fieldset&gt; ||| &lt;/fieldset&gt;",
            "notes": "Grouping form fields in fieldsets give screen reader users context in how the fields are related. Note that the <strong>legend</strong> must be the first child of the <strong>fieldset</strong> in order for the legend to be announced correctly across different screen reader brands."
          },
          {
            "label": "All form fields need labels",
            "highlight": "for",
            "notes": "Each form field have a <strong>label</strong> tag whose <strong>for</strong> element connects it to the form field via the form field's <strong>id</strong>."
          },
          {
            "label": "All form fields that are required need the required attribute",
            "highlight": "class=\"required\" ||| required ||| [\\s]*&lt;p[\\s\\S]*&gt;[\\s\\S]*&lt;/p&gt;",
            "notes": "All required form fields should also have a visual cue for sighted users (a star is used in this example)"
          },
          {
            "label": "CSS for the required field labels",
            "highlight": "%CSS% form-error-css~ form label.required::after",
            "notes": "Note that the star is put into the labels via CSS"
          },
          {
            "label": "Use regular expression patterns to ensure the data being submitted is in the right format",
            "highlight": "pattern",
            "notes": [
              "The pattern must be a valid JavaScript regular expression.  When the form is submitted, the browser checks if all the form field values match the regexs.",
              "If they don't, focus is applied to the first invalid one.  The user can then correct their mistake immediately, and attempt to submit until all form fields are valid"
            ]
          },
          {
            "label": "Hint text should be marked up using aria-describedby",
            "highlight": "aria-describedby",
            "notes": ""
          },
          {
            "label": "Use Javascript to make the error message text more accessible",
            "highlight": "%FILE% js/demos/native-form-example.js",
            "notes": "When a form with errors is submitted, focus goes to the first invalid form field.  Unfortunately, some browser/screen reader pairs don't read out the form field label that the error belongs to, so screen reader users may not know what currently has focus.  This script below ensures the form field label is in the error message to tell screen reader users what currently has focus."
          }
        ]
      }
      </script>

      <h2>Using custom validation</h2>

      <?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This solution is good if you want custom styling of the error messages')); ?>
      <?php includeStats(array('isNPM' => true, 'comment' => 'The solution below involves using Enable\'s accessibility.js library to make it easier to code.')) ?>

      <p>
        You can do the custom validation as well, but you have to ensure that
        when the form submits and there is an error, the first input value with
        an error receives focus so that keyboard and/or screen reader users can
        correct mistakes easily.  You also have to ensure that form errors are marked
        up as <code>&lt;label&gt;</code> tags for the form fields they are associated with.
      </p>

      <p>
        The following example used
        <a href="https://jqueryvalidation.org">jQuery.validate()</a> which is
        not accessible. We do not recommend to use this library for new projects
        ... it is just used as an example of how we can take existing code and
        make it accessible. If you want information about how to make forms
        accessible with JavaScript in the general sense, please read
        <a           href="https://medium.com/@lsnrae/accessible-form-validation-9fa637ddb0fc"
          >Alison Walden's excellent article on form validation</a>.
      </p>

      <div id="example2" class="enable-example">
        <form novalidate class="js-form-validation enable-form-example">
          <fieldset>
            <legend id="contact_js">Contact Information</legend>

            <div class="enable-form-example__fieldset-inner-container">

              <p class="form-instructions"><span class="required-symbol">*</span> denotes a required field.</p>

              <div class="field-block">
                <label class="required" for="name_js">Full Name:</label>
                <input id="name_js" name="name_js" size="25" type="text" required >
              </div>

              <div class="field-block">
                <label class="required" for="email_js">E-mail address:</label>
                <input                   id="email_js"
                  name="email_js"
                  size="25"
                  type="email"
                  required
                >
              </div>

              <div class="field-block">
                <label class="required" for="phone_js">Phone Number:</label>
                <input                   id="phone_js"
                  name="phone_js"
                  size="25"
                  type="text"
                  required
                  pattern="[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}"
                  aria-describedby="phone-desc2"
                >
                <div id="phone-desc2" class="desc">
                  Format is xxx-xxx-xxxx<br>
                  (where x is a digit).
                </div>
              </div>

              <div class="field-block">
                <label for="age-range">Age Range:</label>
                <select id="age-range">
                  <option>Choose one</option>
                  <option value="a">0 to 18 years old</option>
                  <option value="b">19 - 50 years old</option>
                  <option value="c">51 - 150 years old</option>
                </select>
              </div>

              <input value="Add Contact" type="submit" >
            </div>
          </fieldset>
        </form>
      </div>

      

      <?php includeShowcode("example2")?>

      <script type="application/json" id="example2-props">
      {
        "replaceHtmlRules": {
        },
        "steps": [
          {
            "label": "Set your form's novalidate attribute",
            "highlight": "novalidate",
            "notes": "Putting this in the <strong>form</strong> element turns off native form validation (i.e. the validation bubbles built into the browser)"
          },
          {
            "label": "Set your form up so that jQuery validate knows that it needs to initialize it onload",
            "highlight": "js-form-validation",
            "notes": "In this example, we set a class named <strong>js-form-validation</strong>.  Take a look at <a href='js/demos/custom-form-example.js'>the script we are using on this page for this form</a>.  It is commented so you can use this as a model for your own implemtation."
          },
          {
            "label": "Put in fieldsets and legends",
            "highlight": "[\\s]*&lt;legend[\\s\\S]*&gt;[\\s\\S]*&lt;/legend&gt; ||| \\s*&lt;fieldset&gt; ||| &lt;/fieldset&gt;",
            "notes": "Grouping form fields in fieldsets give screen reader users context in how the fields are related. Note that the <strong>legend</strong> must be the first child of the <strong>fieldset</strong> in order for the legend to be announced correctly across different screen reader brands."
          },
          {
            "label": "All form fields need labels",
            "highlight": "for",
            "notes": "Each form field have a <strong>label</strong> tag whose <strong>for</strong> element connects it to the form field via the form field's <strong>id</strong>."
          },
          {
            "label": "All form fields that are required need the required attribute",
            "highlight": "required ||| [\\s]*&lt;p[\\s\\S]*&gt;[\\s\\S]*&lt;/p&gt;",
            "notes": "All required form fields should also have a visual cue for sighted users (in this case, we just have some copy stating all fields are required."
          },
          {
            "label": "CSS for the required field labels",
            "highlight": "%CSS% form-error-css~ form label.required::after",
            "notes": "Note that the star is put into the labels via CSS"
          },
          {
            "label": "Use regular expression patterns to ensure the data being submitted is in the right format",
            "highlight": "pattern",
            "notes": [
              "The pattern must be a valid JavaScript regular expression.  When the form is submitted, the browser checks if all the form field values match the regexs.",
              "If they don't, focus is applied to the first invalid one.  The user can then correct their mistake immediately, and attempt to submit until all form fields are valid"
            ]
          },
          {
            "label": "Hint text should be marked up using aria-describedby",
            "highlight": "aria-describedby",
            "notes": ""
          },
          {
            "label": "Ensure error messages are prefixed with the word \"Error\"",
            "highlight": "%JS% formValidator.init ||| (&nbsp;)*messages:[^\\}]*\\},",
            "notes": "This is best practice to ensure screen reader users know easily that what is being read is an error"
          },
          {
            "label": "Ensure the invalidHandler sets all the invalid fields with aria-invalid attributes",
            "highlight": "%JS% formValidator.init ||| formField.setAttribute\\(\"aria-invalid\"[^)]*\\)\\;",
            "notes": ""
          },
          {
            "label": "Use Javascript to ensure the, when a form with an error is submitted, focus is applied to the first form element with an error",
            "highlight": "%JS% formValidator.init ||| accessibility[^)]*\\)\\;",
            "notes": "In order to do this easily, we use <code>accessibility.applyFormFocus(), which is part of my <a href=\"https://github.com/zoltan-dulac/accessibility.js\">accessibility.js</a> library.  As long as the invalid elements are marked up with <code>aria-invalid</code> after the form is submitted, focus will go to the first invalid element."
          }
        ]
      }
      </script>

      
<?= includeNPMInstructions('accessibility', array(
    ),
    null,
    false, 
    array(
      'needsAccessibilityLib' => true
    )) ?>

    