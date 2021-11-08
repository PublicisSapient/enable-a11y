<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>ARIA form role examples</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta charset="utf-8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet" type="text/css" href="css/showcode.css">
<link href="css/libs/prism.css" rel="stylesheet" />

<!-- This is the global stylesheet -->
<link id="all-css" rel="stylesheet" href="css/shared/all.css" />
<link id="read-all-css" rel="stylesheet" href="css/shared/read-more.css" />

<!-- hamburger menu -->
<link id="hamburger-style" rel="stylesheet" type="text/css" href="css/hamburger-menu.css" />


<link id="site-css" rel="stylesheet" href="css/site.css" />



    <link id="form-error-css" rel="stylesheet" type="text/css" href="css/form-error.css" />
  </head>

  <body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>
      <aside class="notes">
        <h2>Notes</h2>
        <ul>
          <li>Use these forms with a screen reader to understand why they are
              accessible.
          </li>
        </ul>
      </aside>

      <h1>ARIA form role examples</h1>

      <h2>Using native HTML5 validation</h2>

      <p>
        You can use just <code>required</code> and
        <code>pattern</code> attributes on HTML forms to do client side
        validation <strong>without JavaScript</strong>.
      </p>

      <div id="example1">
        <form
          onSubmit="alert('form submitted'); return false;"
        >
          <fieldset>
            <legend>Contact Information</legend>

            <p class="form-instructions"><span class="required-symbol">*</span> denotes a required field.</p>

            <div class="field-block">
              <label class="required" for="name_html5">Full Name:</label>
              <input id="name_html5" size="25" type="text" required  autocomplete="name" />
            </div>

            <div class="field-block">
              <label class="required" for="email_html5">E-mail address:</label>
              <input id="email_html5" size="25" type="email" required autocomplete="email" />
            </div>

            <div class="field-block">
              <label class="required" for="phone_html5">Phone Number:</label>
              <input
                id="phone_html5"
                size="25"
                type="text"
                required
                pattern="[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}"
                aria-describedby="phone-desc"
                autocomplete="tel"
              />
              <div id="phone-desc" class="desc">
                Format is xxx-xxx-xxxx<br />
                (where x is a digit)
              </div>
            </div>

            <input value="Add Contact" type="submit" />
          </fieldset>
        </form>
      </div>

      

              <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="example1__steps" class="showcode__steps"></div>
                                        <div id="example1__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example1"
                        data-showcode-props="example1-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
      <script type="application/json" id="example1-props">
      {
        "replaceHTMLRules": {
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
          }
        ]
      }
      </script>

      <h2>Using custom validation</h2>

      <p>
        You can do the custom validation as well, but you have to ensure that
        when the form submits and there is an error, the first input value with
        an error receives focus so that keyboard and/or screen reader users can
        correct mistakes easily.
      </p>

      <p>
        The following example used
        <a href="https://jqueryvalidation.org">jQuery.validate()</a> which is
        not accessible. We do not recommend to use this library for new projects
        ... it is just used as an example of how we can take existing code and
        make it accessible. If you want information about how to make forms
        accessible with JavaScript in the general sense, please read
        <a
          href="https://medium.com/@lsnrae/accessible-form-validation-9fa637ddb0fc"
          >Alison Walden's excellent article on form validation</a
        >.
      </p>

      <div id="example2">
        <form novalidate class="js-form-validation">
          <fieldset>
            <legend id="contact_js">Contact Information</legend>

            <p class="form-instructions"><span class="required-symbol">*</span> denotes a required field.</p>

            <div class="field-block">
              <label class="required" for="name_js">Full Name:</label>
              <input id="name_js" name="name_js" size="25" type="text" required />
            </div>

            <div class="field-block">
              <label class="required" for="email_js">E-mail address:</label>
              <input
                id="email_js"
                name="email_js"
                size="25"
                type="email"
                required
              />
            </div>

            <div class="field-block">
              <label class="required" for="phone_js">Phone Number:</label>
              <input
                id="phone_js"
                name="phone_js"
                size="25"
                type="text"
                required
                pattern="[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}"
                aria-describedby="phone-desc2"
              />
              <div id="phone-desc2" class="desc">
                Format is xxx-xxx-xxxx<br />
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

            <input value="Add Contact" type="submit" />
          </fieldset>
        </form>
      </div>

      

              <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="example2__steps" class="showcode__steps"></div>
                                        <div id="example2__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example2"
                        data-showcode-props="example2-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
      <script type="application/json" id="example2-props">
      {
        "replaceHTMLRules": {
        },
        "steps": [
          {
            "label": "Set your form's novalidate attribute",
            "highlight": "novalidate",
            "notes": "Putting this in the <strong>form</strong> element turns off native form validation (i.e. the validation bubbles built into the browser)"
          },
          {
            "label": "Set your form up so that jQuery validate knows that it needs to initialize it onload",
            "highlight": "class=\"js-form-validation\"",
            "notes": "In this example, we set a class named <strong>js-form-validation</strong>.  Take a look at <a href='js/shared/form.js'>the script we are using on this page for this form</a>.  It is commented so you can use this as a model for your own implemtation."
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
            "highlight": "%JS% formValidator.init ||| [ ]*messages: {[^}]*}[^}]",
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

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
      <script src="js/accessibility.js"></script>
      <script src="js/shared/form.js"></script>


    </main>

        <footer aria-label="Copyright Information">
            
        Enable is a labour of love originally by
        <a href="https://useragentman.com">Zoltan Hawryluk</a>, released as open
        source so hopefully others can learn from it.  This content is covered by the the <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International Licence</a>

    </footer> 
        

    <!-- These three script tags are for the code samples -->
    <script src="node_modules/indent.js/lib/indent.min.js"></script>
    <script src="js/libs/prism.js" data-manual></script>
    <script src="js/showcode.js"></script>

    <!-- Hamburger Menu -->
    <script src="js/accessibility.js"></script>
    <script src="js/hamburger.js"></script>  </body>
</html>
