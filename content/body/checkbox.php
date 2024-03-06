<p>This page shows different ways a checkbox can be marked up to see how screen readers will describe them to
  users.</p>

<h2>A real styled HTML5 checkbox</h2>

<?php includeStats(array('isForNewBuilds' => true)) ?>

You can style an HTML5 checkbox using CSS easily. You don't need to make faux chekcboxe
using <code>&lt;div&gt;</code> tags.

<div id="example2" class="enable-example">
  <div class="enable-checkbox">
    <label class="form-control">
      <input type="checkbox" checked id="checkbox_1">
      I agree to sell my soul to Zoltan
    </label>
  </div>
</div>

<?php includeShowcode("example2")?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use label tags to label form element",
      "highlight": "%OPENCLOSECONTENTTAG%label",
      "notes": "Like any other form element, it needs a label.  Unlike some of the other examples in Enable, we are using an implicit label (i.e. a <code>label</code> tag that is wrapped around the <code>input</code>)."
    },
    {
      "label": "Add custom styles",
      "highlight": "%CSS%checkbox-css~ .enable-checkbox",
      "notes": "There are many tutorials to do this that you can find on the web.  The CSS used below is based on <a href=\"https://twitter.com/5t3ph/\">Stephanie Eckles'</a> excellent article <a href=\"https://moderncss.dev/pure-css-custom-checkbox-style/\">Pure CSS Custom Checkbox Style</a>."
    }
  ]
}
</script>


<h2>A DIV with a role of checkbox</h2>

<?php includeStats(array('isForNewBuilds' => false)) ?>

<p>
  If you come across a <code>&lt;div&gt;</code> in existing code that is marked up like a checkbox,
  you can fix it this way. It is preferable to use the HTML5 version instead, if you can implement
  it quickly.
</p>

<div id="example-role-checkbox" class="enable-example">
  <div class="checkbox-container">
    <label id="div-checkbox-label-1">I agree to sell my soul to Zoltan:</label>
    <div aria-labelledby="div-checkbox-label-1" role="checkbox" tabindex="0" aria-checked="true">
    </div>
  </div>

  <div class="checkbox-container">
    <label id="div-checkbox-label-2">I will not fight Zoltan in a lawsuit about this matter:</label>
    <div aria-labelledby="div-checkbox-label-2" role="checkbox" tabindex="0" aria-checked="false">
    </div>
  </div>
</div>

<?php includeShowcode("example-role-checkbox")?>

<script type="application/json" id="example-role-checkbox-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use label tags with id",
      "highlight": "id",
      "notes": "Like a real form element, it needs a label. Unlike a real form element, it doesn't use for to connect with the faux checkbox.  We'll cover what it does need in the next step."
    },
    {
      "label": "Create faux checkbox connect to label with aria-labelledby",
      "highlight": "aria-labelledby",
      "notes": "This is how the faux checkbox gets its label."
    },
    {
      "label": "Add custom styles",
      "highlight": "%CSS%checkbox-css~ [role=\"checkbox\"] ; [role=\"checkbox\"][aria-checked=\"true\"]::after",
      "notes": "Note that the checked state is styled with the <code>::after</code> pseudo-element."
    },
    {
      "label": "Add JavaScript to make the checkbox functional",
      "highlight": "%FILE% js/modules/checkbox.js"
    }
  ]
}
</script>




<h2>HTML checkbox group</h2>

<?php includeStats(array('isForNewBuilds' => true)) ?>

<p>
  If you have a group of checkboxes, this is the proper way to style them. Instead of fieldsets,
  you could use <code>&lt;role="group"&gt;</code>, which is described in the
  <a href="form.php#aria">ARIA form role example</a>.
</p>

<div id="group-example" class="enable-example">
  <form id="group-example__form">
    <fieldset>
      <legend>
        The following people will have my soul when I die:
      </legend>

      <div id="html-checkbox__error" class="error" tabindex="-1">You must choose at least one of the following.</div>

      <div class="checkbox-container enable-checkbox">
        <label class="form-control">
          <input id="html-checkbox-multi1" type="checkbox" aria-invalid="true" aria-describedby="html-checkbox__error">

          Zoltan</label>
      </div>
      <div class="checkbox-container enable-checkbox">
        <label class="form-control">
          <input id="html-checkbox-multi2" type="checkbox" aria-invalid="true" aria-describedby="html-checkbox__error">

          Noel</label>
      </div>
      <div class="checkbox-container enable-checkbox">
        <label class="form-control">

          <input id="html-checkbox-multi3" type="checkbox" aria-invalid="true" aria-describedby="html-checkbox__error">
          Alison</label>
      </div>
      <div class="checkbox-container enable-checkbox">

        <label class="form-control">
          <input id="html-checkbox-multi4" type="checkbox" aria-invalid="true" aria-describedby="html-checkbox__error">
          That guy who looks like Gandalf who smokes in the alleyway at the office</label>
      </div>

      <button type="submit">Submit</button>

    </fieldset>
  </form>
</div>
<?php includeShowcode("group-example")?>

<script type="application/json" id="group-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Use label tags to label form element",
      "highlight": "%OPENCLOSECONTENTTAG%label",
      "notes": "Note we are using <a href=\"https://discourse.wicg.io/t/implicit-labels/1542\">implicit labels</a> here.  We don't need to use <code>for</code> to associate the form element with a label as long as the label surrounds the form field and the label text together."
    },
    {
      "label": "Surround the whole checkbox with a fieldset",
      "highlight": "%OPENCLOSETAG%fieldset ||| %OPENCLOSECONTENTTAG%legend",
      "notes": "This will let the browser know these checkboxes are related. The legend is used as the group's label"
    },
    {
      "label": "Errors must be marked up with aria-describedby",
      "highlight": "aria-describedby",
      "notes": "You must always ensure what the aria-describedby is pointing to exists in the DOM."
    },
    {
      "label": "Make sure you have aria-invalid set on the checkboxes if necessary",
      "highlight": "aria-invalid",
      "notes": "Just like any other form, aria-invalid must be set on the form elements that are invalid."
    }
  ]
}
</script>