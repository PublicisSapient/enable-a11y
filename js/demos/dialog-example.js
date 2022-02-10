'use strict'

import registerFocusRestoreDialog from "../libs/dialog-focus-restore.js";
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

import showcode from "../libs/showcode.js";


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

function importA11yFixes() {
  import ('../libs/dialog-focus-restore.js').then((registerFocusRestoreDialog) => {

    if (registerFocusRestoreDialog) {
      registerFocusRestoreDialog.default(favDialog);

      // expose this module to showcode if it is on the page
      showcode.addJsObj('registerFocusRestoreDialog', registerFocusRestoreDialog.default);
    }

  });  
}


const supportsDialog = !!document.createElement('dialog').show;
// If we are using the polyfill, then load it as well
// as the polyfill accessibility fixes.
if (!supportsDialog) {
  console.log('loading polyfill')
  import ('../../libs/dialog-polyfill/index.js')
  .then((dialogPolyfill) => {
    dialogPolyfill.default.registerDialog(favDialog);
    importA11yFixes();
  });
} else {
  // We load the accessibility fixes since they work even
  // when the polyfill is loaded.  Chrome needs this to 
  // have a focus loop like polyfilled versions.
  importA11yFixes();
}