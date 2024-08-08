'use strict'

/*******************************************************************************
 * enable-dialog.js - Fixes for the HTML5 dialog (both native
 * and polyfill)
 * 
 * Based on this gist:
 * https://gist.github.com/samthor/babe9fad4a65625b301ba482dad284d1
 *
 * Written by Sam Thorogood.
 * Updated by Zoltan Hawryluk to implement focus loop in open dialog.
 * 
 * Released under the MIT License.
 ******************************************************************************/

const enableDialog = new (function() {
  this.init = () => {
    const focusManager = new DialogFocusManager();
    const supportsDialog = !!document.createElement('dialog').show;
    // If we are using the polyfill, then load it as well
    // as the polyfill accessibility fixes.
    if (!supportsDialog) {
      import('../../enable-node-libs/dialog-polyfill/index.js')
      .then((dialogPolyfill) => {
        dialogPolyfill.default.registerDialog(favDialog);
        focusManager.focusOn(favDialog);
      });
    } else {
      // We load the accessibility fixes since they work even
      // when the polyfill is loaded.  Chrome needs this to 
      // have a focus loop like polyfilled versions.
      focusManager.focusOn(favDialog);
    }
  }
});
