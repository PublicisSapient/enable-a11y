'use strict'

/*******************************************************************************
 * dialog-example.js - An example of an accessible dialog.
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 28, 2021
 *
 * More information about this script available at:
 * http://www.useragentman.com/enable/dialog.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

const supportsDialog = !!document.createElement('dialog').show;

// Button that opens the dialog
const updateButton = document.getElementById('updateDetails');

// Clicking this button opens the dialog
updateButton.addEventListener('click', function() {
  favDialog.showModal();
});

// The modal's cancel button
const cancelButton = document.getElementById('cancel');

// Clicking the cancel button will close the dialog
cancelButton.addEventListener('click', function() {
  favDialog.close();
});

// The <dialog> element itself
const favDialog = document.getElementById('favDialog');

// If we are using the polyfill, then load it as well
// as the polyfill accessibility fixes.
if (!supportsDialog) {
  console.log('loading polyfill')
  import ('../../node_modules/dialog-polyfill/index.js')
  .then((dialogPolyfill) => {
    dialogPolyfill.default.registerDialog(favDialog);
    import ('../libs/dialog-focus-restore.js')
    .then((registerFocusRestoreDialog) => {
      registerFocusRestoreDialog.default(favDialog);

      // expose this module to showcode if it is on the page
      if (document.querySelector('.showcode')) {
        window.registerFocusRestoreDialog = registerFocusRestoreDialog.default;
      }
    });
  });
}