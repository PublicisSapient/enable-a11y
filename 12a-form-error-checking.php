<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>ARIA form role examples</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/form-error.css" />
  </head>

  <body>
    <?php include("includes/example-header.php"); ?>

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

      <form
        role="form"
        tabindex="-1"
        onSubmit="alert('form submitted'); return false;"
      >
        <fieldset>
          <legend id="contact_html5">Contact Information</legend>

          <div class="field-block">
            <label for="name_html5">Full Name:</label>
            <input id="name_html5" size="25" type="text" required />
          </div>

          <div class="field-block">
            <label for="email_html5">E-mail address:</label>
            <input id="email_html5" size="25" type="email" required />
          </div>

          <div class="field-block">
            <label for="phone_html5">Phone Number:</label>
            <input
              id="phone_html5"
              size="25"
              type="text"
              required
              pattern="[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}"
            />
            <div id="phone-desc" class="desc">
              Format is xxx-xxx-xxxx<br />
              (where x is a digit)
            </div>
          </div>

          <input value="Add Contact" type="submit" />
        </fieldset>
      </form>

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

      <form novalidate role="form" tabindex="-1" class="js-form-validation">
        <fieldset>
          <legend id="contact_js">Contact Information</legend>

          <div class="field-block">
            <label for="name_js">Full Name:</label>
            <input id="name_js" name="name_js" size="25" type="text" required />
          </div>

          <div class="field-block">
            <label for="email_js">E-mail address:</label>
            <input
              id="email_js"
              name="email_js"
              size="25"
              type="email"
              required
            />
          </div>

          <div class="field-block">
            <label for="phone_js">Phone Number:</label>
            <input
              id="phone_js"
              name="phone_js"
              size="25"
              type="text"
              required
              pattern="[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}"
              aria-describedby="phone-desc"
            />
            <div id="phone-desc" class="desc">
              Format is xxx-xxx-xxxx<br />
              (where x is a digit).
            </div>
          </div>

          <input value="Add Contact" type="submit" />
        </fieldset>
      </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/accessibility.js"></script>
    <script src="js/shared/form.js"></script>
    </main>

  </body>
</html>
