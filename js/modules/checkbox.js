'use strict'

/*******************************************************************************
* checkbox.js - UI for the ARIA radio and checkbox roles 
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

const checkbox = new function () {

  this.navigate = (evt) => {
    // ref is the element that fired the event.
    const ref = evt.target != null ? evt.target : evt.srcElement;
    const role = ref.getAttribute("role");

    if (role === 'checkbox') {
      if (
        evt.type === "click" ||
        evt.key === ' ' ||
        evt.keyCode === 'Enter'
      ) {

        if (ref) {
          let newState;
          const ariaChecked = ref.getAttribute("aria-checked")
          newState = ariaChecked === "true" ? 'enable-unchecked': 'enable-checked';
          ref.setAttribute(
            "aria-checked",
              ariaChecked === "true" ? "false" : "true"
          );
          
          // Ensure we don't fire any other event handler, including
          // browser defaults (e.g. pressing SPACE may cause the
          // page to scroll if we don't put this in.
          evt.preventDefault();
          evt.stopPropagation();

          ref.dispatchEvent(new CustomEvent(
            newState,
            {
              'bubbles': true
            }
          ))
        }
      }
    }
  };

  this.init = () => {
    document.addEventListener("click", this.navigate);
    document.addEventListener("keydown", this.navigate);
  }

  this.init();

};

console.log(checkbox);

export default checkbox;
