<!DOCTYPE html>
<html lang="en-US">
  <head>

    <title>
      An Accessible Modal Dialog using the HTML5 &lt;dialog&gt; Tag.
    </title>
    <?php include "includes/common-head-tags.php";?>
    <link media="all" rel="stylesheet" href="css/dialog-html5.css" />

    <link media="all" id="dialog-polyfill" rel="stylesheet" href="css/shared/dialog-polyfill.css" />


    <script>
      function onModalButtonClick() {
        alert("This is a mockup, so this button doesn't actually work");
        return false;
      }
    </script>
  </head>

  <body>
    <?php include "includes/documentation-header.php";?>

    <main>
      <h1>Modal Dialog Example</h1>
      <aside class="notes">
        <h2>Notes:</h2>

        <ul>
          <li>
            This example uses the HTML5 <code>&lt;dialog&gt;</code> tag. For
            browsers that don't support it, a modified version of Google's
            dialog polyfill has been used.
          </li>
          <li>
            If you don't want to use the polyfill, simply use
            <code>role="dialog"</code>.
          </li>
          <li>
            Making modal dialogs accessible for the first time can be tricky.
            Full notes on how the accessibility features of this example can be
            found on my blog post,
            <a href="https://www.useragentman.com/blog/?p=7603"
              >Creating Accessible HTML5 Modal Dialogs For Desktop and Mobile</a
            >
          </li>
        </ul>
      </aside>

      <div id="example1">
        <!-- This is the dialog -->
        <dialog
          id="favDialog"
          aria-labelledby="favDialog__label"
          aria-describedby="favDialog__description"
        >
          <div role="document">
            <button id="cancel" class="a11y-modal__button--close">
              <img
                class="a11y-modal__button--close-image"
                src="images/close-window.svg"
                alt="close this dialog"
              />
            </button>
            <h2 id="favDialog__label">Login</h2>
            <p id="favDialog__description">
              In order to continue, please log into the application
            </p>
            <form method="dialog">
              <div>
                <div>
                  <label for="username">Username:</label>
                  <input id="username" type="text" name="u" />
                </div>
                <div>
                  <label for="password">Password:</label>
                  <input id="password" type="password" name="p" />
                </div>
              </div>
              <div>
                <button type="reset" id="cancel_bottom" onClick="onModalButtonClick();">
                  Cancel
                </button>
                <button type="submit" onClick="onModalButtonClick();">
                  Confirm
                </button>
              </div>
            </form>
          </div>
        </dialog>

        <!-- This is the markup that has the button that opens the dialog -->
        <div class="image__container">
          <button id="updateDetails" class="modal__opener">
            Log in to our website
          </button>

          <!-- Decorative image has role of presentation -->
          <img
            alt=""
            role="presentation"
            class="image"
            src="images/point-to-dialog.svg"
          />
        </div>
      </div>

      <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHtmlRules": {
            },
            "steps": [
                {
                  "label": "Mark up your dialog with the dialog tag",
                  "highlight": "%OPENTAG%dialog ||| %OPENCLOSETAG%dialog",
                  "notes": "Not all browsers support this natively still, so I am using a polyfill that implements it like Chrome's implementation (it also inserts the <code>role=\"dialog\"</code>)"
                },
                {
                  "label": "Use aria-labelledby to point to the title of the modal",
                  "highlight": "aria-labelledby",
                  "notes": "If there is no visible label in the dialog, use <code>aria-label</code> to set a screen-reader only label that describes the purpose of the modal.  This will be read by the screen reader when the modal is first opened"
                },
                {
                  "label": "Use aria-describedby to point to a summary description of the modal",
                  "highlight": "aria-describedby",
                  "notes": "This will give screen-reader users supplementary information about this modal.  In this case, the user must login in order to continue."
                },
                {
                  "label": "Use proper roles inside the modal",
                  "highlight": "role=\"document\"",
                  "notes": "A modal contains a document that is standalone to the rest of the document, so it should be given that content should be given that role"
                },
                {
                  "label": "Ensure close button image has appropriate alt text",
                  "highlight": "alt",
                  "notes": "Just like any image, the close button's must have appropriate alt text.  In this case, it must describe the action it performs when pressed (since it is inside a button"
                },
                {
                  "label": "Ensure the dialog's form has the right method set",
                  "highlight": "method=\"dialog\"",
                  "notes": "Browsers that support <code>&lt;dialog&gt;</code> will close the dialog upon successul submission of this form."
                },
                {
                  "label": "Ensure the CTA that opens the dialog, as well as the one that closes it, are buttons",
                  "highlight": "\\s*&lt;button[^&]*class=\"(a11y-modal__button--close|modal__opener)\"[^&]*&gt;",
                  "notes": ""
                },
                {
                  "label": "Include the polyfill's CSS",
                  "highlight": "%CSS%dialog-polyfill~ ",
                  "notes": "The polyfill won't work without it."
                },
                {
                  "label": "Add the accessibility fixes for the polyfill and native implementations",
                  "highlight": "%JS% registerFocusRestoreDialog ||| // watch for 'open' change and clear saved[\\s\\S]*\\['open'\\]}\\);",
                  "notes": "<p>This script adds some small bits of extra accessibility goodness:</p> <ol><li>When the dialog is closed, focus goes back to the button that opened it</li><li>This adds a mobile focus loop via the <code>accessibility.setKeepFocusInside()</code> routines (highlighted below)</li></ol><p>This code based on <a href=\"https://gist.github.com/samthor/babe9fad4a65625b301ba482dad284d1\">this Gist by Sam Thorogood </a></p>"
                }
            ]
        }
      </script>


    </main>


    <script src="js/dialog-example.js" type="module"></script>

    <?php include "includes/example-footer.php"?>
  </body>
</html>
