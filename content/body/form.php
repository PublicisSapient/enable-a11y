<!-- <aside class="notes">
            <h2>Notes</h2>
            <ul>

                <li>These examples are from
                    <a                         href="https://www.w3.org/TR/2017/NOTE-wai-aria-practices-1.1-20171214/examples/landmarks/form.html">the
                        W3C's ARIA Form Landmarks Example</a>.
                </li>

                
                <li>Use the HTML5 form tag whenever you can. You will make your application
                    a lot more usable for things beyond accessibility:
                    <ol>
                        <li>JavaScript
                            <code>document.forms</code> support.
                        </li>
                        <li>Progressive enhancement.</li>
                        <li>Built in HTML5 validation and pattern checking.</li>
                        <li>
                            <a href="https://en.wikipedia.org/wiki/Tim_Berners-Lee">The God of the Web</a> built it the
                            right way the first time.
                        </li>
                    </ol>
                </li>
            </ul>
        </aside> -->


<p>
  Forms must be marked up correctly in order for screen reader users to be able to use them correctly. Please ensure all
  your forms are marked up like in the following examples.
</p>



<h2 id="html5" tabindex="-1">HTML5 example</h2>
<?php includeStats(array('isForNewBuilds' => true)) ?>

<p>
  If you are marking up a form from scratch, use the HTML5 <code>fieldset</code> and <code>legend</code> tags to
  describe groups of elements. This makes the forms more understandable to screen reader users since they understand the
  context of the information they will be filling out as they tab through the form.
</p>

<p>
  <strong>Note that these tags can be difficult to style.</strong> I would suggest reading the following articles to go
  over how this is done. <a href="https://thatemil.com/">Emil Björklund</a> has a great article on how to <a
    href="https://thatemil.com/blog/2015/01/03/reset-your-fieldset/">Reset your fieldset</a> that should help.
</p>

<div id="example1" class="enable-example">
  <form class="enable-form-example">
    <fieldset>
      <legend id="contact_html5">Contact Information</legend>
      <div class="enable-form-example__fieldset-inner-container">
        <div class="field-block">
          <label for="name_html5">Name: </label>
          <input id="name_html5" size="25" type="text">
        </div>

        <div class="field-block">
          <label for="email_html5">E-mail: </label>
          <input id="email_html5" size="25" type="text">
        </div>
        <div class="field-block">
          <label for="phone_html5">Phone: </label>
          <input id="phone_html5" size="25" type="text">
        </div>
        <input value="Add Contact" type="submit">
      </div>
    </fieldset>
  </form>
</div>

<?php includeShowcode("example1")?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Insert form tag",
      "highlight": "\\s*&lt;[\/]?form&gt;",
      "notes": "Whenever you have form elements, include this tag.  It does a lot of things for you that you may not even be aware of."
    },
    {
      "label": "Insert fieldset and legend",
      "highlight": "\\s*&lt;[\/]?fieldset&gt; ||| \\s*&lt;legend[\\s\\S]*&gt;[\\s\\S]*&lt;/legend&gt;",
      "notes": "The <strong>legend</strong> tag must be a direct child of the <strong>fieldset</strong> tag in order for it to work across screen readers."
    }
  ]
}
</script>

<h2 id="aria" tabindex="-1">ARIA form role example (with ARIA used to replace fieldset and legend as well)</h2>

<?php includeStats(array('isForNewBuilds' => false)) ?>

<p>
  Unfortunately, there will be times when you will come across a bit of code that is supposed to be a form but is not
  marked up correctly and unusable to screen reader users. Recoding it with <code>fieldset</code> and
  <code>legend</code> tags may be prohibitive due to:
</p>

<ul>
  <li>The <code>legend</code> tag must always be the first child of the <code>fieldset</code> tag.</li>
  <li>The issues that devs have with styling <code>fieldset</code> and <code>legend</code> tags, as mentioned in the
    section above.</li>
  <li>The amount of JavaScript rework that would be needed to make the application work with <code>fieldset</code> and
    <code>legend</code> tags.
  </li>
</ul>

<p>
  While I would still endeavour to advise to code forms correctly, the following code should reduce the amount of coding
  time on existing work to fix accessibility issues for screen reader users.</p>

<div id="example2" class="enable-example">
  <div role="form" class="enable-form-example">
    <div role="group" aria-labelledby="contact-aria" class="fieldset aria-form-group">
      <div id="contact-aria" class="legend">Contact Information</div>
      <div class="enable-form-example__fieldset-inner-container">

        <div class="field-block">
          <label for="name">Name: </label>
          <input id="name" size="25" type="text">
        </div>

        <div class="field-block">
          <label for="email">E-mail: </label>
          <input id="email" size="25" type="text">
        </div>

        <div class="field-block">
          <label for="phone">Phone: </label>
          <input id="phone" size="25" type="text">
        </div>

        <input value="Add Contact" type="submit">

      </div>
    </div>
  </div>
</div>

<?php includeShowcode("example2")?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Insert form role",
      "highlight": "role=\"form\"",
      "notes": ""
    },
    {
      "label": "Insert group role to mimic native HTML fieldset",
      "highlight": "role=\"group\"",
      "notes": ""
    },
    {
      "label": "Add aria-labelledby to element with group role",
      "highlight": "aria-labelledby",
      "notes": [
        "This ensures that what the aria-labelledby attribute points to acts as a legend for the fieldset.",
        "Unlike a HTML example, the label does not have to be a direct child to the group element (which acts as a fieldset)."
      ]
    }
  ]
}
</script>

