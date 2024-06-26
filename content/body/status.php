<p>
  Status messages allow screen readers and other assistive technology to tell users that content has changed on the page. It does this without interrupting what the user is doing by changing which interactive element has focus.  
  A perfect example of this use-case is in a search component like in the example below.
</p>


<h2>Visually Hidden Status Message</h2>

<p>This example is based on <a href="https://gist.github.com/nichtich/674522">this wiktionary lookup gist</a> by
  <a lang="de" href="https://gist.github.com/nichtich">Jakob Voß</a>,
  modified to add accessibility features, including a visually hidden <code>status</code> message that will tell screen reader users
  that content has changed on the page.
</p>


<div id="visually-hidden-example" class="enable-example">
  <form class="wiktionary-lookup__form">
    <label for="wiktionary-lookup__word-input">
      Lookup a word:
    </label>
    <input type="text" id="wiktionary-lookup__word-input" class="wiktionary-lookup__word">
    <button type="submit">Find word</button>
  </form>
  <div class="wiktionary-lookup__content-container">
    <h3 class="wiktionary-lookup__page-title">Not found.</h3>
    <div class="wiktionary-lookup__page-alert sr-only" role="status" aria-live="polite">

    </div>
    <div class="wiktionary-lookup__content"></div>
    <div class="wiktionary-lookup__license-info" style="font-size: small; display: none">
      Modified original content <a href="https://en.wiktionary.com" class="wiktionary-lookup__source-url">from Wiktionary</a>. Content is
      available
      under the
      <a href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution/Share-Alike
        License</a>.
    </div>
  </div>
</div>


<?php includeShowcode("visually-hidden-example"); ?>

<script type="application/json" id="visually-hidden-example-props">
{
  "replaceHtmlRules": {
    "this": "that"
  },
  "steps": [{
      "label": "Add role of alert",
      "highlight": "role",
      "notes": ""
    },
    {
      "label": "Add aria-live level",
      "highlight": "aria-live",
      "notes": "This should be set to <strong>polite</strong> if you want it to be announced after the screen reader is finished announcing other things, or <strong>assertive</strong> if you want the screen reader to interrupt what it is currently saying to state the message inside.  The latter should only be used sparingly."
    },
    {
      "label": "Hide the alert with sr-only CSS class",
      "highlight": "sr-only",
      "notes": "This is <a href=\"screen-reader-only-text.php\">a standard class that hides items visually but allows screen readers to access them</a>."
    },
    {
      "label": "CSS for sr-only",
      "highlight": "%CSS%all-css ~ .sr-only",
      "notes": "This is the  <a href=\"screen-reader-only-text.php\"><code>sr-only</code></a>   we use in the Enable project. There are several variations of this available on the web."
    },
    {
      "label": "use .innerHTML to update the live region",
      "highlight": "%JS% dictLookup.init ||| const \\$pageAlert[^;]*; ||| \\$pageAlert.innerHTML[^;]*;",
      "notes": "The <code>$pageAlert</code> variable is set to the ARIA live region in the previous steps."
    }

  ]
}
</script>