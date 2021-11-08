<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ARIA Tooltip Example</title>
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



    <link id="tooltip-css" rel="stylesheet" type="text/css" href="css/tooltip.css" />
    
  </head>

  <body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>
      <h1>ARIA Tooltip Example</h1>

      <h2>JavaScript tooltips</h2>

      <aside class="notes">
        <h2>Notes:</h2>

        <ul>
          <li>Tooltips should be visible onfocus, and be hidden onblur.</li>
          <li>
            The widget that activates the tooltip should have an
            <code>aria-describedby</code> attribute that points to the tooltip
            so the AT can inform the user of it.
          </li>
        </ul>
      </aside>

      <div id="example1">
        <p>
          <a href="/" data-tooltip="This tooltip is accessible!"
            >This link has a tooltip</a
          >
          <label for="input-tooltip-example">and so does this input field:</label>
          <input
            id="input-tooltip-example"
            type="text"
            data-tooltip="You can put tooltips on any focusable item."
          />.
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
              "label": "Create markup",
              "highlight": "data-tooltip",
              "notes": "Our script uses the <code>data-tooltip</code> attribute instead of the <code>title</code> attribute, since <strong>title</strong> is rendered by user agents by default and cannot be styled."
            },
            {
              "label": "Create javascript events for tooltip script",
              "highlight": "%JS% tooltip.create; tooltip.init",
              "notes": "When the page is loaded, create the tooltip DOM object and initialize the mouse and keyboard events that will display the tooltips. <strong>Note the role of tooltip being added to the tooltip DOM object</strong>."
            },
            {
              "label": "Create the show and hide methods for the tooltip",
              "highlight": "%JS% tooltip.show; tooltip.hide",
              "notes": "We make sure the element that triggered the tooltip's <code>show</code> method will be connected to it with he aria-describedby attribute, which points to the tooltip.  This ensures screenreaders announce the tooltip on focus."
            },
            {
              "label": "Ensure tooltip disappears when Escape key is pressed",
              "highlight": "%JS% tooltip.onKeyup",
              "notes": "This is to ensure keyboard users can make the tooltip disappear without tabbing out of the component."
            },
            {
              "label": "Set up the CSS",
              "highlight": "%CSS%tooltip-css~ .tooltip; .tooltip::before; .tooltip--hidden ||| border[^:]*: 1px solid transparent; ",
              "notes": "The arrow that points to this tooltip is CSS generated content. We hide the content ensuring it is still read by screen readers. <strong>Note the highlighted properties</strong>.  <a href=\"https://piccalil.li/quick-tip/use-transparent-borders-and-outlines-to-assist-with-high-contrast-mode\">These ensure the tooltips appear in Windows High Contrast Mode</a>."
            }
          ]
        }
      </script>
    </main>

    <script src="js/shared/tooltip.js"></script>

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
