'use strict'

/*******************************************************************************
 * global.js - The global js file for all Enable pages.
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 29, 2021
 *
 ******************************************************************************/

import showcode from "./enable-libs/showcode.js";
import pauseAnimControl from "./modules/pause-anim-control.js";
import EnableFlyoutHamburger from "./modules/enable-hamburger.js";
import enableVisibleOnFocus from "./modules/enable-visible-on-focus.js";
import offscreenObserver from "./modules/offscreen-observer.js"

function initEnable() {

  offscreenObserver.init(document.querySelector('[role="banner"]'));

  enableVisibleOnFocus.init();
  EnableFlyoutHamburger.init();
  pauseAnimControl.init();

  // So screen reader users, like VoiceOver users, can navigate via heading and have focus
  // applied to the heading.
  document.querySelectorAll('h1, h2, h3, h4, h5, h6, [role="heading"]').forEach((el) => {
    if (el.getAttribute('tabIndex') === null) {
      el.setAttribute('tabIndex', '-1');
    }
  })

}

initEnable();


showcode.addJsObj('enableVisibleOnFocus', enableVisibleOnFocus);
showcode.addJsObj('EnableFlyoutHamburger', EnableFlyoutHamburger);
showcode.addJsObj('initEnable', initEnable);


console.log('x', document.location.hash);

if (document.location.hash === '#debug') {
  console.log('logging enable events (debug mode)')

  // debug on event handlers 
  const events = {
    'enable-listbox-change': 'value, id',
    'enable-listbox-show': '',
    'enable-listbox-hide': '',
    'enable-combobox-change': 'value',
    'enable-combobox-show': '',
    'enable-combobox-hide': '',
    'enable-focus-show': '',
    'enable-focus-hide': '',
    'enable-paginate-render': 'page',
    'enable-pause-animations': '',
    'enable-play-animations': '',
    'enable-checked': 'group',
    'enable-unchecked': 'group',
    'enable-expanded': '',
    'enable-collapsed': '',
    'enable-table-sort': 'index',
    'enable-switch-change': 'isChecked',
    'enable-selected': '',
    'enable-show': '',
    'enable-hide': '',
    'enable-spinbutton-change': 'value'
  };

  for (let eventName in events) {
    const properties = events[eventName].split(',')
    document.addEventListener(eventName, (event) => {
      for (var i=0; i<properties.length; i++) {
        const property = properties[i].trim();
        console.log(
          `${eventName} fired. ${property}:`, 
          event.detail && event.detail[property] ? event.detail[property]() : '',
          'target:',
          event.target
        );
      }
    }, true);
  }
}
