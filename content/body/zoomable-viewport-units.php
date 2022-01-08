<main>
    
      

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

      <div id="example1" class="enable-example">
        <p>
          <a href="/" data-tooltip="This tooltip is accessible!"
            >This link has a tooltip</a>
          <label for="input-tooltip-example">and so does this input field:</label>
          <input             id="input-tooltip-example"
            type="text"
            data-tooltip="You can put tooltips on any focusable item."
          >
        </p>
      </div>


      <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
          "replaceHtmlRules": {
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