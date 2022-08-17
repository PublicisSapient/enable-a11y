'use strict'

/*******************************************************************************
* offscreen-observer.js - Script to style things differently when the header of
* a page is on or offscreen
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released December 31, 2021
* 
* Released under the MIT License.
******************************************************************************/


const offscreenObserver = new function () {
  const { body } = document;
  const isHeaderOffscreenClass = 'offscreen-observer__is-header-offscreen' ;

  function respondToVisibility(element, callback) {
    var options = {
      root: null
    };
  
    var observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        callback(entry.intersectionRatio > 0);
      });
    }, options);
  
    observer.observe(element);
  }

  this.setOffscreenStyle = function (isMenuOffscreen) {
    if (isMenuOffscreen) {
      body.classList.remove(isHeaderOffscreenClass)
    } else {
      body.classList.add(isHeaderOffscreenClass);
    } 
  }

  this.init = function (el) {
    respondToVisibility(el, this.setOffscreenStyle);
  }
}


