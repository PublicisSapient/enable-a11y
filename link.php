<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ARIA Link Role Demo</title>
		<?php include "includes/common-head-tags.php";?>
    <link id="link-css" rel="stylesheet" type="text/css" href="css/link.css" />
  </head>

  <body>
    <?php include "includes/documentation-header.php";?>

    <main>
      <aside class="notes">
        <h2>Notes:</h2>

        <ul>
          <li>HTML and ARIA links work the same way</li>
        </ul>
      </aside>

      <h1>Enable Link Examples.</h1>

      <h2>Native HTML5</h2>

      <div id="html5-examples">
        <p>
          This paragraph has a few native
          <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a"
            >HTML5 links</a
          >
          in it. It is best to use native, non-ARIA links because they are
          guarenteed to be used in
          <a href="https://en.wikipedia.org/wiki/Netscape_Navigator"
            >older browsers</a
          >
          and <a href="https://en.wikipedia.org/wiki/Wget">other user agents</a>.
        </p>

        <p>
          This paragraph has a
          <a aria-current="page" href="18-link.html">self-referring link</a>
          (i.e. a page that links to itself). It is marked up with
          <code>aria-current="page"</code>.
        </p>
      </div>

      <?php includeShowcode("html5-examples")?>

      <script type="application/json" id="html5-examples-props">
      {
        "replaceHTMLRules": {
        },
        "steps": [
          {
            "label": "Use a tags",
            "highlight": "%OPENCLOSECONTENTTAG%a",
            "notes": "As long as the <code>a</code> tag has an <code>href</code> attribute, it is keyboard accessible by default."
          },
          {
            "label": "Use aria-current for self referring links",
            "highlight": "aria-current",
            "notes": "Screen readers will announce that a link points the current page if this attribute is set."
          }
        ]
      }
      </script>

      <h2>Using ARIA</h2>

      <div id="aria-examples">
        <p>
          This paragraph has a few
          <span
            data-href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_link_role"
            tabindex="0"
            role="link"
            >ARIA link tags</span
          >
          in it. They are coded as <code>span</code> tags with the following
          attributes set:
        </p>
        <ul>
          <li>
            <code>tabindex="0"</code> set (to make them keyboard accessible)
          </li>
          <li>
            <code>role="link"</code>, so that a screen reader reports them
            correctly.
          </li>
        </ul>

        <p>
          In order for them to be functional, they need to have
          <span
            data-href="https://en.wikipedia.org/wiki/JavaScript"
            tabindex="0"
            role="link"
            >JavaScript</span
          >
          added to them to make them functional. Feel free to use
          <span data-href="js/link.js" tabindex="0" role="link"
            >the script we use in this demo</span
          >
          if you need to use it.
        </p>
      </div>

      <?php includeShowcode("aria-examples")?>

      <script type="application/json" id="aria-examples-props">
      {
        "replaceHTMLRules": {
        },
        "steps": [
          {
            "label": "Use role=\"link\" on elements you want to be fake tags",
            "highlight": "role=\"link\"",
            "notes": "Screen readers will now report these as links"
          },
          {
            "label": "Make sure you remember to add tabindex=\"0\" on fake links",
            "highlight": "tabindex=\"0\"",
            "notes": "This makes the fake links accessible."
          },
          {
            "label": "Create Javascript events",
            "highlight": "%JS% ariaLinkShim",
            "notes": "This code will activate the links using mouse clicks or hitting the ENTER key"
          },
          {
            "label": "Create CSS",
            "highlight": "%CSS%link-css~ [role=\"link\"]",
            "notes": "Make sure the CSS makes a link look like a link"
          }
        ]
      }
      </script>

    </main>

    <script src="js/link.js"></script>

    <?php include "includes/example-footer.php"?>
  </body>
</html>
