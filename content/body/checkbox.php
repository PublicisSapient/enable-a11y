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

            <div id="html-checkbox__error" class="error" tabindex="-1">You must choose at least one of the following.
            </div>

            <div class="checkbox-container enable-checkbox">
                <label class="form-control">
                    <input id="html-checkbox-multi1" type="checkbox" aria-invalid="true"
                        aria-describedby="html-checkbox__error">

                    Zoltan</label>
            </div>
            <div class="checkbox-container enable-checkbox">
                <label class="form-control">
                    <input id="html-checkbox-multi2" type="checkbox" aria-invalid="true"
                        aria-describedby="html-checkbox__error">

                    Noel</label>
            </div>
            <div class="checkbox-container enable-checkbox">
                <label class="form-control">

                    <input id="html-checkbox-multi3" type="checkbox" aria-invalid="true"
                        aria-describedby="html-checkbox__error">
                    Alison</label>
            </div>
            <div class="checkbox-container enable-checkbox">

                <label class="form-control">
                    <input id="html-checkbox-multi4" type="checkbox" aria-invalid="true"
                        aria-describedby="html-checkbox__error">
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

<h2>Indeterminate Checkboxes Using Native HTML</h2>

<?php includeStats(array('isNPM' => true, 'comment' => 'The parent/child heirarchy of this example has been done via an NPM module.')) ?>


<p>
    We usually think of checkboxes being either <strong>checked</strong> or <strong>unchecked</strong>. There is a third
    possible state: <strong>indeterminate</strong>. The most common use-case for this, as outlined in <a
        href="https://css-tricks.com/indeterminate-checkboxes/">the CSS Tricks article about Indeterminate
        Checkboxes</a>, is for nested checkboxes. Consider you have a group of related attributes, like toppings in an
    ice-cream cone, that you can select with a group of checkboxes. It would be great to be able to have a "select all"
    checkbox that can choose all of them &mdash; because who doesn't want all the things on their ice-cream cone?!?! The
    problem is, what is this "select all" checkbox set to when some of the ingredients are checked but not all of them?
    While I have seen select all checkboxes not checked in this case, it can be argued that we give the indeterminate
    state for the checkbox.
</p>

<p><strong>Note that this indeterminate state can be set via JavaScript.</strong> There is no <code>indeterminate</code>
    HTML attribute. It is set like this:</p>

<figure class="wide">
    <?php includeShowcode("indeterminate-js", "", "", "", false)?>

    <figcaption>How to use the indeterminate property in JavaScript</figcaption>
</figure>

<template id="indeterminate-js" data-showcode-is-js="true">
// Let's assume <input id="my-checkbox" type="checkbox">
// is in the page.
const checkboxEl = document.getElementById("my-checkbox");

// Setting the indeterminate attribute
checkboxEl.indeterminate = true;

// We should also set the checked value to false.
// This is for progressive enhancement.
checkboxEl.checked = false;

</template>

<p>Note the last bit in the code above where we set the <code>.checked</code> property to <code>false</code>.  This is done for progressive enhancement. While <a
        href="https://developer.mozilla.org/en-US/docs/Web/CSS/:indeterminate#browser_compatibility">MDN reports that
        indeterminate is supported in all major browsers</a>, <strong>we should still consider that not all
        browser/screen reader pairs (e.g. Firefox/NVDA, Firefox/Voiceover at the time of this writing) will announce the indeterminate
        state</strong>. For this reason, we should set the checked attribute to something that makes sense for screen reader users who
    use those browser/screen-reader pairs. Setting the checkbox to unchecked does make the most sense in this "Select
    All" scenario.
</p>

<p>Now that we got the basics out of the way, let's see an example of this in action:</p>

<div id="indeterminate-example" class="enable-example">
    <form  onsubmit="alert('Your desert choice has been submitted.'); return false;">
        <fieldset>
            <legend>What toppings would you like on your ice-cream cone?</legend>
            <div>
                <div class="checkbox-container enable-checkbox">
                    <label for="select-all" class="form-control">
                        <input type="checkbox" id="select-all" name="select-all" aria-describedby="select-all__desc"
                            data-select-all-for="option-1 option-2 option-3">
                        Select All</label>
                    <span id="select-all__desc" class="sr-only">Checking this will automatically check the ingredient
                        checkboxes below.</span>
                </div>
                <ul>
                    <li class="checkbox-container enable-checkbox">
                        <label for="option-1" class="form-control">
                            <input type="checkbox" id="option-1" name="ingredient" value="option-1">
                            Chocolate Syrup</label>
                    </li>
                    <li class="checkbox-container enable-checkbox">
                        <label for="option-2" class="form-control">
                            <input type="checkbox" id="option-2" name="ingredient" value="option-2">
                            Strawberry Sauce</label>
                    </li>
                    <li class="checkbox-container enable-checkbox">
                        <label for="option-3" class="form-control">
                            <input type="checkbox" id="option-3" name="ingredient" value="option-3">
                            Bran Flakes</label>
                    </li>
                </ul>
            </div>
            <button type="submit">Submit</button>
        </fieldset>
        
    </form>
</div>

<p>This example uses a library we developed to set up the heirarchical structure for the select all button to work.
    Below are the developer notes on how the library does it. If you are interested in using the library, please <a
        href="#npm-instructions">read the instructions on how to use the library in your own projects</a>.</p>

<?php includeShowcode("indeterminate-example")?>

<script type="application/json" id="indeterminate-example-props">
{
    "replaceHtmlRules": {},
    "steps": [{
            "label": "Use aria-describedby on the select all checkbox to give instructions to screen reader users.",
            "highlight": "aria-describedby",
            "notes": "Screenreader users are warned that when this is checked, it will affect the other checkboxes below.  Note that it points to <a href=\"http://localhost:8888/screen-reader-only-text.php\">screen reader only text</a>. You may want to consider having this text visible to all users, but sighted users will easily discover that it affects the other checkboxes a lot more easily than screen reader users without the instructions."
        },
        {
            "label": "Use data-select-all-for attribute to connect the select all checkbox with the ones it should have control over",
            "highlight": "data-select-all-for",
            "notes": "This is used by the library. The data-select-all-for attribute is set on the \"select-all\" checkbox with list of space delimited IDs of checkboxes it controls.  Also, if one of the checkboxes it controls is checked and the others aren't, the library will set the \"select-all\" checkbox to the indeterminate state."
        }
    ]
}
</script>


<h2>Indeterminate Checkboxes Using ARIA</h2>

<p>
    Just like two-state checkboxes, we can use ARIA to create faux-checkboxes.  At the time of this writing, there is one advantage of doing so: Firefox using Voiceover and NVDA will report an indeterminate checkbox's state as mixed using ARIA.
</p>


<figure class="wide">
    <?php includeShowcode("aria-indeterminate-js", "", "", "", false)?>

    <figcaption>How to use the indeterminate property in JavaScript</figcaption>
</figure>

<template id="aria-indeterminate-js" data-showcode-is-js="true">
// Let's assume <div role="checkbox" id="my-aria-checkbox" type="checkbox">...</div>
// is in the page.
const checkboxEl = document.getElementById("my-aria-checkbox");

// Setting the aria-checked attribute to mixed.
checkboxEl.setAttribute('aria-checked', 'mixed');

</template>

<div id="aria-indeterminate-example" class="enable-example">
    <form  onsubmit="alert('Your desert choice has been submitted.'); return false;">
        <fieldset>
            <legend>What toppings would you like on your ice-cream cone?</legend>
            <div>
                <div class="checkbox-container enable-checkbox">

                    <div role="checkbox" aria-checked="false" tabindex="0" aria-labelledby="aria-select-all__label"
                        data-select-all-for="aria-option-1 aria-option-2 aria-option-3"
                        aria-describedby="aria-select-all__desc"></div>
                    <label id="aria-select-all__label" class="form-control">Select All
                    </label>
                    <span id="aria-select-all__desc" class="sr-only">Checking this will automatically check the
                        ingredient checkboxes below.</span>
                </div>
                <ul>
                    <li class="checkbox-container enable-checkbox">

                        <div id="aria-option-1" role="checkbox" aria-checked="false" tabindex="0" aria-labelledby="aria-option-1__label">
                        </div>
                        <label id="aria-option-1__label" class="form-control">Chocolate Syrup
                        </label>
                    </li>
                    <li class="checkbox-container enable-checkbox">

                        <div id="aria-option-2" role="checkbox" aria-checked="false" tabindex="0" aria-labelledby="aria-option-2__label">
                        </div>
                        <label id="aria-option-2__label" class="form-control">Strawberry Sauce
                        </label>
                    </li>
                    <li class="checkbox-container enable-checkbox">

                        <div id="aria-option-3" role="checkbox" aria-checked="false" tabindex="0" aria-labelledby="aria-option-3__label">
                        </div>
                        <label id="aria-option-3__label" class="form-control">Bran Flakes
                        </label>
                    </li>
                </ul>
            </div>

            <button type="submit">Submit</button>
        </fieldset>
    </form>
</div>


<p>This example uses the same library we used in the native HTML5 example to set up the heirarchical structure for the select all button to work. As you compare the developer notes below to that of the HTML5 example, you will see the way to implement is similar.  Please <a
        href="#npm-instructions">read the instructions on how to use the library in your own projects</a>.</p> 

<?php includeShowcode("aria-indeterminate-example")?>

<script type="application/json" id="aria-indeterminate-example-props">
{
    "replaceHtmlRules": {},
    "steps": [{
            "label": "Use aria-describedby on the select all checkbox to give instructions to screen reader users.",
            "highlight": "aria-describedby",
            "notes": "Screenreader users are warned that when this is checked, it will affect the other checkboxes below.  Note that it points to <a href=\"http://localhost:8888/screen-reader-only-text.php\">screen reader only text</a>. You may want to consider having this text visible to all users, but sighted users will easily discover that it affects the other checkboxes a lot more easily than screen reader users without the instructions."
        },
        {
            "label": "Use data-select-all-for attribute to connect the select all checkbox with the ones it should have control over",
            "highlight": "data-select-all-for",
            "notes": "This is used by the library. The data-select-all-for attribute is set on the \"select-all\" checkbox with list of space delimited IDs of checkboxes it controls.  Also, if one of the checkboxes it controls is checked and the others aren't, the library will set the \"select-all\" checkbox to the indeterminate state."
        }
    ]
}
</script>

<h2>How to Install the Heirarchical Checkbox library Into Your Projects</h2>

<?= includeNPMInstructions('hierarchical-checkboxes', array(''), '', false , array(
    'noCSS' => true
)) ?>