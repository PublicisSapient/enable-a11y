(function() {
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

    // If we are using the polyfill, then initialize it
    if (window.dialogPolyfill) {
      dialogPolyfill.registerDialog(favDialog);
    }

    // Remove this for now.
    if (window.registerFocusRestoreDialog) {
      registerFocusRestoreDialog(favDialog);
    }

  })();
  
  