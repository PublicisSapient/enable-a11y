<!doctype html>
<html lang="en-US">

<head>
    
    <title>Alert Dialog Example</title>
		<?php include("includes/common-head-tags.php"); ?>
    <link media="all" rel="stylesheet" href="css/dialog.css" />
</head>

<body>
    <div id="a11y-modal__non-modal-content">


        <h1>Dialog Examples</h1>

        <?php include("includes/documentation-header.php"); ?>

        <main>
            <aside class="notes">
                <h2>Notes:</h2>
                <ul>
                    <li>This page uses is an example of how to use the <code>dialog</code> and <code>alertdialog</code> ARIA roles.</li>
                    
                    <li>When opened:
                        <ul>
                            <li>
                                Focus should go to the first element in the modal (usually the close button). If the modal is marked up like in this example,
                                the screen reader will anounce that the user is inside a modal.
                            </li>
                            <li>Focus can never be tabbed into anything outside the modal</li>
                        </ul>
                    </li>
                    <li>When closed:
                        <ul>
                            <li>Focus should go back to the element that opened the modal.</li>
                        </ul>
                    </li>
                </ul>
            </aside>


            <p>We have two examples of dialogs on this page:</p>

            <ul>
                <li>A
                    <a href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_dialog_role">dialog</a> is used to mark up an HTML based application dialog or window that separates content or UI
                    from the rest of the web application or page.
                    <button data-modal-function="show" data-modal-button-for="dialog-example">Show me an example of a dialog</button>
                </li>
                <li>An
                    <a href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_alertdialog_role">alertdialog</a> is like a dialog, except it is used to notify the user of urgent information that demands
                    the user's immediate attention.
                    <button data-modal-function="show" data-modal-button-for="alertdialog-example">Show me an example of an alertdialog</button></li>
            </ul>
            
        </main>
    </div>
    <div id="alertdialog-example" class="a11y-modal" aria-modal="true" aria-hidden="true" aria-labelledby="alertdialog-example__label"
        aria-describedby="alertdialog-example__desc" role="alertdialog">
        <div role="document">
            <button class="a11y-modal__button--close" data-modal-function="hide">
                <img class="a11y-modal__button--close-image" src="images/close-window.svg" alt="Close the session expiry modal.">
            </button>
            <h2 id="alertdialog-example__label">Your login session is about to expire</h2>
            <p id="alertdialog-example__desc">To extend your session, click the OK button.  Escape will cancel and close this dialog.</p>
            <button data-modal-function="hide">OK</button>
        </div>
    </div>

    <div id="dialog-example" class="a11y-modal" aria-modal="true" aria-hidden="true" role="dialog" aria-labelledby="dialog-example__label"
        aria-describedby="dialog-example__desc">
        <div id="dialog-example__desc" class="sr-only">Escape will cancel and close this dialog.</div>
        <div role="document">
            <button class="a11y-modal__button--close" data-modal-function="hide">
                <img class="a11y-modal__button--close-image" src="images/close-window.svg" alt="close the registration form">
            </button>


            <h2 id="dialog-example__label">Registration Form</h2>
            <p>These are the onscreen instructions that are not attached explicitly to a focusable element. Can screen reader
                users read this text with the virtual cursor?</p>
            <form name="form1" autocomplete="off" action="/bin/submit" method="get">
                <fieldset>
                    <legend>User Information</legend>
                
                    <div>
                        <label for="input-firstName">First Name</label>
                        <input type="text" name="firstName" id="input-firstName" autocomplete="off" />
                    </div>
                    <div>
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" />
                    </div>
                    <div>
                        <label for="email">Email Address</label>
                        <input type="text" name="email" id="email" />
                    </div>
                    <div>
                        <input type="button" name="button" id="enter" value="Submit" />
                        <input type="button" name="cancelButton" id="cancelButton" value="Cancel" />
                    </div>
                </fieldset>
            </form>
        </div>
    </div>


    <div id="a11y-modal__overlay"></div>

    <script src="js/shared/modal-window.js"></script>
</body>

</html>