'use strict'

/*******************************************************************************
* global.js - The global js file for all Enable pages.
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec 29, 2021
*
******************************************************************************/

import showcode from "./libs/showcode.js";
import EnableFlyoutHamburger from "./modules/hamburger.js";
import enableVisibleOnFocus from "./modules/enable-visible-on-focus.js";
import offscreenObserver from "./modules/offscreen-observer.js"

offscreenObserver.init(document.querySelector('[role="banner"]'));


showcode.addJsObj('enableVisibleOnFocus', enableVisibleOnFocus);
showcode.addJsObj('EnableFlyoutHamburger', EnableFlyoutHamburger);

// debug on event handlers 
const events = {
  'combobox-change': 'value',
  'enable-drawer-change': 'isExpanded',
  'enable-slider-change': 'value',
  'enable-focus-show': '',
  'enable-focus-hide': ''
};

for (let eventName in events) {
  const property = events[eventName]
  document.body.addEventListener(eventName, (event) => {
    console.log(
      `${eventName} fired. ${property}:`, 
      event.detail ? event.detail[property]() : '',
      event.target
    );
  }, true);
}

