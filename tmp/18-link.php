<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ARIA Link Role Demo</title>
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



    <link id="link-css" rel="stylesheet" type="text/css" href="css/link.css" />
  </head>

  <body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
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

              <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="html5-examples__steps" class="showcode__steps"></div>
                                        <div id="html5-examples__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html5-examples"
                        data-showcode-props="html5-examples-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
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

              <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="aria-examples__steps" class="showcode__steps"></div>
                                        <div id="aria-examples__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-examples"
                        data-showcode-props="aria-examples-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
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
