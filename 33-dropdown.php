<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HTML5 and ARIA Accessible Drawer Examples</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/dropdown.css" />
    <meta charset="utf-8" />
  </head>

  <body>
    <?php include("includes/example-header.php"); ?>

    <main>
      <h1>Accessible Drawer/Expando</h1>

      <aside class="notes">
        <h2>Notes:</h2>
        
        <p>The HTML5 version does not update its state on all browser/screen-reader combinations
        reliably. For example:</p>
        <ul>
            <li>
                Safari with Voiceover doesn't update the state when the 
                drawer is opened.
            </li>
            <li>
                Chromevox doesn't indicate that the <code>summary</code> is
                expandable when it gains keyboard focus
            </li>
        </ul>

        <p>For now, it is advisable to use the ARIA version.</p>
      </aside>

      <h2>HTML5 version using details and summary tags</h2>
      <details>
        <summary>
            Instructions on how to use the HTML5 <code>details</code> tag.
        </summary>
        <p>The code looks like this:</p>
        <code>
&lt;details&gt;
  &lt;summary&gt;
      &lt;!-- Insert button content here --&gt;
  &lt;/summary&gt;
  &lt;p&gt;
    &lt;!-- Insert expanded content here --&gt;
  &lt;/p&gt;
&lt;/details&gt;
        </code>
    
        </p>
      </details>

      <h2>ARIA version</h2>
      <div class="enable-drawer">
        <button
          id="enable-drawer1"
          class="enable-drawer__button"
          aria-controls="enable-drawer1__content"
          aria-expanded="false"
        >
        Instructions on how to use the aria-expanded version.
        </button>
        <div id="enable-drawer1__content" class="enable-drawer__content" role="region">
        <p>The code looks like this (with <code>aria-expanded</code> set to be the expanded/collapsed state of the widget via JavaScript).</p>

        <code>
&lt;div class="enable-drawer"&gt;
   &lt;button
     aria-controls="enable-drawer1__content"
     aria-expanded="false"
   &gt;
     &lt;!-- Insert button text here --&gt;
   &lt;/button&gt;
   &lt;div id="enable-drawer1__content" class="enable-drawer__content" role="region"&gt;
    &lt;!-- Insert expanded content here --&gt;
   &lt;/div&gt;
 &lt;/div&gt;

        </code>
        </div>
      </div>
    </main>

    <script>
      
      document.body.addEventListener("click", function (e) {
        var target = e.target;

        if (target.classList.contains('enable-drawer__button')) {
            const contentEl = document.getElementById(target.getAttribute('aria-controls'));
            if (target.getAttribute('aria-expanded') !== 'true') {
                target.setAttribute('aria-expanded', 'true');
            } else {
                target.setAttribute('aria-expanded', 'false');
            }
        }
      });
    </script>
  </body>
</html>
