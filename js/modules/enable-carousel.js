'use strict'

/*******************************************************************************
 * enable-carousel.js - Accessible shim over the Glider carousel
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released December 27, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/carousel.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

import '../../enable-node-libs/glider-js/glider.js';

const EnableCarouselList = [];

const EnableCarousel = function (container, options) {
  let glider;
  let lastSetupHTML = "";
  let $previousButton;
  let $nextButton;

  this.container = container;
  this.options = options || {};
  this.useArrowButtons = this.options.useArrowButtons || false;
  this.slidePanelSelector = '.enable-carousel__slide';
  this.slidePanels = [];

  const supportsInertNatively = HTMLElement.prototype.hasOwnProperty('inert');
  const $parentNode = this.container.parentNode; // This should be .glider-contain
  
  const $showAll = $parentNode.querySelector('.enable-carousel__show-all');
  const $putInCarouselButton = $parentNode.querySelector('.enable-carousel__put-in-carousel');

  const DESTROYED_COOKIE_NAME = 'enable-carousel__is-destroyed';
  const NO_JS_CLASS = 'enable-carousel--no-js';

  this.$alert = $parentNode.querySelector('.enable-carousel__alert');

  let accessibility; // for the accessibility library, if it is needed.

  this.polyfillURL = this.options.polyfillURL;
  if (this.polyfillURL) {
    if (this.polyfillURL.substring(0, 1) !== '/') {
      // set this as a URL relative to the document.
      const currentDir = getCurrentDir();
      this.polyfillURL =  `${currentDir}${this.options.polyfillURL}`
    }
  } else {
    this.polyfillURL = '../../enable-node-libs/wicg-inert/dist/inert.min.js';
  }

  function getCurrentDir () {
      const link = document.createElement('a');
      link.href = '.';
      return link.pathname;
  }

  this.init = function () {
    const destroyedCookie = getCookie(DESTROYED_COOKIE_NAME);
    const isDestroyedCookieSet = (destroyedCookie === 'true');

    console.log('a', isDestroyedCookieSet, isDestroyable())
    if (isDestroyedCookieSet && isDestroyable()) {
      console.log('x', isDestroyable());
      this.destroyCarousel();
    } else {
      console.log('y');
      this.setUpCarousel();
    }

    // Will destroy the carousel when the "Show All" button is clicked
    if ($showAll) {
      $showAll.addEventListener('click', this.showAll);
    }

    if ($putInCarouselButton) {
      $putInCarouselButton.addEventListener('click', this.putInCarousel);
    }

    EnableCarouselList.push(this);
    console.log('list', EnableCarouselList);
  }

  this.setUpCarousel = () => {
    $previousButton = $parentNode.querySelector('.glider-prev');
    $nextButton = $parentNode.querySelector(".glider-next");
    this.container = $parentNode.querySelector('.enable-carousel');

    // initializes Glider. We ensure that the carousel
    // is set to not have any animations by default.
    // eslint-disable-next-line no-undef
    glider = new Glider(this.container, {
      slidesToShow: 1,
      dots: "#dots",
      duration: 0,
      arrows: {
        prev: $previousButton,
        next: $nextButton,
      },
      draggable: true,
      scrollLock: true,
      animationDuration: 0
    });

    this.slidePanels = this.container.querySelectorAll(this.slidePanelSelector);
    $parentNode.classList.remove(NO_JS_CLASS);

    if (isDestroyable()) {
      setCookie(DESTROYED_COOKIE_NAME, 'false');
    }

    this.container.addEventListener('glider-destroy', this.destroyHandler);

    // If useArrowButtons is set as an option, we apply the inert attribute
    // to the panels that are not visible so keyboard focus won't be applied
    // to them (and load the inert polyfill if it is needed).
    // We also initialize event handling routines.
    // 
    // Note the accessibility library is loaded as well since it is used to
    // discover if there are any interactive elements inside a newly visible
    // panel. If there is, we apply focus on that instead of the panel itself.
    if (this.useArrowButtons) {
      import('../../enable-node-libs/accessibility-js-routines/dist/accessibility.module.js')
      .then((accessibilityObj) => { 

        accessibility = accessibilityObj.default;
        
        // If the inert attribute is not supported by this browser, then load
        // the polyfill before using it.
        if (!supportsInertNatively) {
          import(this.polyfillURL)
          .then((inertPolyfill) => {
            this.setArrowButtonEvents();
          })
          .catch((error) => {
            console.error(`Inert polyfill failed to load, url: ${this.polyfillURL}`);
            console.error(error);
          });
        } else {
          this.setArrowButtonEvents();
        }

      });
    // If userArrowButtons is *not* set as an option, just initialize the event
    // handler routines. 
    } else {
      this.setTabthroughEvents();
    }
  }

  this.preventSpaceFromScrolling = (e) => {
    // Because Safari/Voiceover sometimes scroll the page
    // when Enter or Space is pressed, we ensure that
    // the carousel comes back into the browser view when
    // those buttons are pressed.
    if (e.key === ' ' || e.key === 'Enter') {
      setTimeout(() => {
        this.container.scrollIntoView(true);
      }, 100);
    }
  }

  this.showAll = () => {
    glider.destroy();
  }

  this.putInCarousel = () => {
    this.setUpCarousel();
  }

  // Sets events for the "List of Controls" variation of the carousel.
  this.setTabthroughEvents = () => {
    // when keyboard focus is applied to a slide's CTA.
    this.container.addEventListener("focus", this.focusCTAHandler, true);

    // When the mouse is clicked, we will allow animations.
    document.body.addEventListener("mousedown", this.clickHandler, true);

    // When a keyboard is used and the key released is the TAB key,
    // we turn the animations off. 
    document.body.addEventListener("keyup", this.keyUpHandler, true);
  }

  // Sets events for the "List of Content" variation of the carousel.
  this.setArrowButtonEvents = () => {
    // Let's make all the carousel panels inert except the first one.
    this.setSlidesInert(true, 0);

    // This ensures when the slide comes into view, that focus is applied to it
    // (or inside of it if it has an interactive element).
    this.container.addEventListener("glider-slide-visible", this.slideVisibleEvent);
    this.container.addEventListener("glider-slide-hidden", this.slideHiddenEvent);

    // when buttons are clicked with a Enter key, prevent the page from scrolling
    $previousButton.addEventListener('keypress', this.preventSpaceFromScrolling);
    $nextButton.addEventListener('keypress', this.preventSpaceFromScrolling);

    this.container.parentNode.addEventListener('focusin', this.announceCurrentSlide);
  };

  this.removeCarouselEvents = () => {
        // remove all event listeners set in this script
    // from setArrowButtonEvents()
    this.container.removeEventListener("glider-slide-visible", this.slideVisibleEvent);
    this.container.removeEventListener("glider-slide-hidden", this.slideHiddenEvent);
    $previousButton.removeEventListener('keypress', this.preventSpaceFromScrolling);
    $nextButton.removeEventListener('keypress', this.preventSpaceFromScrolling);
    $parentNode.removeEventListener('focusin', this.announceCurrentSlide);

    // from setTabthroughEvents()
    this.container.removeEventListener("focus", this.focusCTAHandler, true);
    document.body.removeEventListener("mousedown", this.clickHandler, true);
    document.body.removeEventListener("keyup", this.keyUpHandler, true);

    // remove the destroy event
    this.container.removeEventListener('glider-destroy', this.destroyHandler);
  }


  this.setSlidesInert = (value, exceptionIndex) => {
    this.slidePanels.forEach((el, i) => {
      if (i !== exceptionIndex) {
        el.inert = value;
      }

      el.setAttribute('tabindex', '-1');
    })
  }
  

  this.slideHiddenEvent = (e) => {
    const hiddenSlideIndex = e.detail.slide;
    const hiddenSlide = this.container.querySelectorAll(this.slidePanelSelector)[hiddenSlideIndex];
    hiddenSlide.inert = true;
  }

  this.slideVisibleEvent = (e) => {
    const visibleSlideIndex = e.detail.slide;
    const visibleSlide = this.container.querySelectorAll(this.slidePanelSelector)[visibleSlideIndex];
    const { pageXOffset, pageYOffset } = window;
    visibleSlide.inert = false;

    // Find what to apply focus to.
    // If there are interactive elements in the slide, focus the first one,
    // otherwise, focus the slide itself (assuming it has tabindex="-1")
    const focusableEls = accessibility.getAlTabbableEls(visibleSlide);
    if (focusableEls.length > 0) {
      focusableEls[0].focus();
    } else {
      visibleSlide.focus();
    }

    /* We do the set timeout since some browsers will change the
     * scroll value so that the focused item is hiding behind a
     * sticky part of the screen. This fixes that.
     */
    window.setTimeout(() => {
      window.scrollTo(pageXOffset, pageYOffset);
    },100);
    
  }

  this.announceCurrentSlide = (e) => {
    const { relatedTarget } = e;
    const { parentNode } = this.container;
    const $currentSlide = parentNode.querySelector('.enable-carousel__slide.visible');

    if (this.$alert && $currentSlide && !parentNode.contains(relatedTarget)) {
      this.$alert.innerHTML=$currentSlide.innerHTML;
    }

  }

  this.focusCTAHandler = (e) => {
    // When keyboard focus is applied to a CTA in a slide,
    // we make the carousel display that slide.
    const { target } = e;
    this.slideToTarget(target);
  };

  this.slideToTarget = function(target) {
    // Figures out what slide the target element is in.
    // The carousel then displays that slide.
    const slide = target.closest(".enable-carousel__slide");

    if (slide) {
      const slideParent = slide.parentNode;
      const slideIndex = Array.prototype.indexOf.call(
        slideParent.children,
        slide
      );

      glider.scrollItem(slideIndex);
    }
  };

  this.clickHandler = () => {
    // this is a mouse user, so let's make the carousel animated.
    glider.setOption({
      duration: 0.5,
    });
  };

  this.keyUpHandler = (e) => {
    const { key } = e;

    if (key === "Tab") {
      // this is a keyboard user, so remove the carousel animation.
      glider.setOption({
        duration: 0,
      });
    }
  };

  function isDestroyable() {
    return ($parentNode.querySelector('.enable-carousel__show-all'));
  }

  this.destroyHandler = (e) => {
    for (let i=0; i<EnableCarouselList.length; i++) {
      console.log('destroying ', i);
      EnableCarouselList[i].destroyCarousel(e);
    }
  }

  this.destroyCarousel = (e) => {
    // We will only destroy carousels that have a "Show All Slides" button.
    if (!isDestroyable()) {
      console.log('does not have Show All Slides button. Bailing');
      return;
    }
    console.log('continue');


    const $enableCarousel = $parentNode.querySelector('.enable-carousel');
    cloneArrows();

    // only remove events if this has been called as an event
    // handler (i.e. not because )
    if (e) {
      this.removeCarouselEvents();
    }

    // now destroy the carousel
    $parentNode.classList.add(NO_JS_CLASS);
    setCookie(DESTROYED_COOKIE_NAME, 'true');
    this.slidePanels = [];
    this.container = $parentNode.querySelector('.enable-carousel');

    lastSetupHTML = this.container.outerHTML;
  }

  // We do this because there is a bug in Glider that prevents
  // us from reusing the arrow buttons if a carousel is destroyed
  // and recreated.  
  function cloneArrows() {
    if ($previousButton && $nextButton) {
      const $newPreviousButton = $previousButton.cloneNode(true);
      const $newNextButton = $nextButton.cloneNode(true);
      $previousButton.replaceWith($newPreviousButton);
      $nextButton.replaceWith($newNextButton);
      $previousButton = $newPreviousButton;
      $nextButton = $newNextButton;
    }
  }


  // Getting and setting cookies.  Why do we need these in 2023?
  // can't we have document.cookie.set() and document.cookie.get() ?
  function setCookie(name, value, options = {}) {

    options = {
      path: '/',
      // add other defaults here if necessary
      ...options
    };
  
    if (options.expires instanceof Date) {
      options.expires = options.expires.toUTCString();
    }
  
    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
  
    for (let optionKey in options) {
      updatedCookie += "; " + optionKey;
      let optionValue = options[optionKey];
      if (optionValue !== true) {
        updatedCookie += "=" + optionValue;
      }
    }
  
    document.cookie = updatedCookie;
  }
  // returns the cookie with the given name,
  // or undefined if not found
  function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }
}

export default EnableCarousel;
