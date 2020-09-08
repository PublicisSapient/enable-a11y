<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <title>
      An Accessible Modal Dialog using the HTML5 &lt;dialog&gt; Tag.
    </title>
    <?php include("includes/common-head-tags.php"); ?>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0"
    />
    <link media="all" rel="stylesheet" href="css/dialog-html5.css" />

    <style>
      .a11y-modal__button--close:focus {
        outline: none !important;
      }
      .a11y-modal__button--close:focus img {
        filter: drop-shadow(0px 2px 0 orange) drop-shadow(0px -2px 0 orange)
          drop-shadow(-2px 0px 0 orange) drop-shadow(2px 0px 0 orange);
      }
    </style>

    <script>
      function onModalButtonClick() {
        alert("This is a mockup, so this button doesn't actually work");
        return false;
      }
    </script>
  </head>

  <body>
    <!--
        <?php include("includes/example-header.php"); ?>
    -->

    <main>
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
      <!-- Simple pop-up dialog box, containing a form -->
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
            <section>
              <div>
                <label for="username">Username:</label>
                <input id="username" type="text" name="u" />
              </div>
              <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="p" />
              </div>
            </section>
            <menu>
              <button id="cancel" type="reset" onClick="onModalButtonClick();">
                Cancel
              </button>
              <button type="submit" onClick="onModalButtonClick();">
                Confirm
              </button>
            </menu>
          </form>
        </div>
      </dialog>

      <menu class="image__container">
        <button class="modal__opener" id="updateDetails">
          Log in to our website
        </button>
        <!--
                This is a decorative image, so there we set the role to 
                "presentation" and blank the alt attribute.
            -->
        <img
          alt=""
          role="presentation"
          class="image"
          src="images/point-to-dialog.svg"
        />
      </menu>
    </main>

    <script src="js/accessibility-es4.js"></script>
    <script src="js/shared/dialog-polyfill.js"></script>
    <script src="js/shared/dialog-polyfill-a11y-fixes.js"></script>
    <script src="js/dialog-example.js"></script>
  </body>
</html>
