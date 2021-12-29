'use strict'

/*******************************************************************************
* radio-and-checkbox-roles.js - UI for the ARIA radio and checkbox roles 
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released December 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/
* 
* Released under the MIT License.
******************************************************************************/

const ariaRadioCheckboxShim = new (function () {
  const keycodes = { SPACE: 32, ENTER: 13 };

  this.navigate = (evt) => {
    if (
      evt.type == "click" ||
      evt.keyCode == keycodes.SPACE ||
      evt.keyCode == keycodes.ENTER
    ) {
      // ref is the element that fired the event.
      const ref = evt.target != null ? evt.target : evt.srcElement;
      const role = ref.getAttribute("role");

      if (ref)
        switch (role) {

          // For a radio button group, we must ensure only the element that
          // fired the event is checked and the others are unchecked.
          case "radio": {
            // First, grab all other radios with the same name and uncheck them
            const name = ref.getAttribute("data-name");
            const allRadios = document.querySelectorAll(
              `[role="radio"][data-name=${name}]`
            );

            for (let i = 0; i < allRadios.length; i++) {
              const radio = allRadios[i];
              if (radio !== ref) {
                radio.setAttribute("aria-checked", "false");
              }
            }

            // Now, check the element that fired the event.
            ref.setAttribute("aria-checked", "true");

            // Ensure we don't fire any other event handler, including
            // browser defaults (e.g. pressing SPACE may cause the
            // page to scroll if we don't put this in.
            evt.preventDefault();
            evt.stopPropagation();
            break;
          }
          // For checkboxes, we just have to toggle the checked state
          // of the element that fired the event.
          case "checkbox": {
            ref.setAttribute(
              "aria-checked",
              ref.getAttribute("aria-checked") === "true" ? "false" : "true"
            );
            
            // Ensure we don't fire any other event handler, including
            // browser defaults (e.g. pressing SPACE may cause the
            // page to scroll if we don't put this in.
            evt.preventDefault();
            evt.stopPropagation();
            break;
          }
        }
    }
  };

  document.addEventListener("click", this.navigate);
  document.addEventListener("keydown", this.navigate);

  // expose this module to showcode if it is on the page */
  if (document.querySelector('.showcode')) {
    window.ariaRadioCheckboxShim = this;
  }
})();

export default ariaRadioCheckboxShim;
