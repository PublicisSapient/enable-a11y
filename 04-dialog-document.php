<!doctype html>
<html lang="en-US">

<head>
    
    <title>The Incredible Accessible Modal Window, Version 4</title>
		<?php include("includes/common-head-tags.php"); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link media="all" rel="stylesheet" href="css/dialog.css" />
</head>

<body>
    <div id="a11y-modal__non-modal-content">
        <?php include("includes/example-header.php"); ?>

        <main>

            <aside class="notes">
                <h2>Notes:</h2>


            </aside>
            <div id="mainPage" aria-hidden="false">
                <h1>The Incredible Accessible Modal Window, Version 4</h1>
                <p>
                    <a href="https://github.com/gdkraus/accessible-modal-dialog">Get the code on GitHub</a>
                </p>
                <p>This page demonstrates how to make a modal window as accessible as possible to assistive technology users.
                    Modal windows are especially problematic for screen reader users. Often times the user is able to &quot;escape&quot;
                    the window and interact with other parts of the page when they should not be able to. This is partially
                    due to the way screen reader software interacts with the Web browser.</p>
                <h2>The Accessible Modal Window in Action</h2>
                <p>To see this in action, you just need to
                    <button data-modal-function="show" data-modal-button-for="modal-form">view the modal window</button>. If the modal window works as planned, once the modal window is visible
                    you should not be able to interact with other links on the main page like
                    <a href="https://github.com/">going to the main GitHub page</a>. If you can interact with the page behind the modal window, guidance
                    is given for how to get back to the modal window.</p>
            </div>

        </main>
    </div>

    <div
        aria-modal="true"
        aria-hidden="true"
        role="dialog"
        aria-labelledby="modalTitle"
        aria-describedby="modalDescription"
    >
        ...
    </div>
        <div id="modalDescription" class="sr-only">Beginning of dialog window. It begins with a heading 1 called &quot;Registration Form&quot;. Escape will cancel
                and close the window. This form does not collect any actual information.</div>
        <div role="document">
            <button class="a11y-modal__button--close" data-modal-function="hide">
                <img class="a11y-modal__button--close-image" src="images/close-window.svg" alt="close the registration form">
            </button>

            
            <h2 id="modalTitle">Registration Form</h2>
            <p>These are the onscreen instructions that are not attached explicitly to a focusable element. Can screen reader
                users read this text with the virtual cursor?</p>
            <form  name="form1" autocomplete="off" target="/">
                <div>
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" autocomplete="off" />
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


            </form>
        </div>
    </div>

    <div id="a11y-modal__overlay"></div>
    <script src="js/shared/modal-window.js"></script>
</body>

</html>