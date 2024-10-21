
<p>Since I have seen search boxes on a lot of sites not coded optimally, I include notes on how to do so here.</p>

<div id="search-example" class="enable-example">
  <form role="search" tabindex="-1">
    <div class="search">
      <label for="search-input" class="sr-only">Search:</label>
      <input id="search-input" type="text" class="search__term" >
      <button type="submit" class="search__button">
        <img class="search__icon" src="images/search.svg" alt="Search">
      </button>
    </div>
  </form>
</div>
<?php includeShowcode("search-example", "", "", "", true, 2); ?>

<script type="application/json" id="search-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Add role of search to the form tag",
      "highlight": "role=\"search\"",
      "notes": "Adding this role makes this form easily found by screen reader users who skim through the page (e.g. via the Rotor in VoiceOver, or the Elements List of NVDA)"
    },
    {
      "label": "Add label for screen reader users",
      "highlight": "%OPENCLOSECONTENTTAG%label",
      "notes": "Since there is a search icon on this form, it can be argued that this label can be hidden visually with the <a href=\"screen-reader-only-text.php\"><code>sr-only</code></a>."
    },
    {
      "label": "Ensure sizing of the form elements and the icons use relative units",
      "highlight": "%CSS%search-css~",
      "notes": "In order for the input fields and the icon to grow when using the browsers \"Resize Text\" functionality, it is important to use relative units, such as <code>rem</code> or <code>em</code>, when setting their widths and heights instead of absolute units, such as <code>px</code>.  In Enable, we <a href=\"https://codepen.io/janogarcia/pen/bNrKEP\">use LESS to convert px units to rem using this very simple method by Jano Garcia</a>."
    }
  ]
}
</script>