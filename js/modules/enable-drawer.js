'use strict'

/*******************************************************************************
* enable-drawer.js - UI implementation of an ARIA based drawer.
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec. 29, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/dropdown.php
* 
* Released under the MIT License.
******************************************************************************/


const enableDrawer = new function() {
  const changeEventName = 'enable-drawer-change';

  const getState = () => {

  }

  this.init = function() {
    document.body.addEventListener("click", function(e) {
      var target = e.target;

      if (target.classList.contains('enable-drawer__button')) {
        if (target.getAttribute('aria-expanded') !== 'true') {
          target.setAttribute('aria-expanded', 'true');
          target.dispatchEvent(new CustomEvent(
            changeEventName,
            {
              bubbles: true,
              detail: {
                isExpanded: () => true
              }
            }
          ));
        } else {
          target.setAttribute('aria-expanded', 'false');
          target.dispatchEvent(new CustomEvent(
            changeEventName,
            {
              bubbles: true,
              detail: {
                isExpanded: () => false
              }
            }
          ));
        }
      }
    });
  }
}

enableDrawer.init();