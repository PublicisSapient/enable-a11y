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


const EnableCarousel = function (container, options) {
  
  let glider;
  this.container = container;
  this.options = options || {};
  this.useArrowButtons = this.options.useArrowButtons || false;

  const supportsInertNatively = HTMLElement.prototype.hasOwnProperty('inert');
  const $previousButton = this.container.parentNode.querySelector('.glider-prev');
  const $nextButton = this.container.parentNode.querySelector(".glider-next");

  this.init = function () {

    if (! this.container) {
      console.error("Error: No container for carousel. Bailing");
      return;
    } else {
      console.log('Initializing.  options:', options)
    }
    
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

    this.slidePanelSelector = '.enable-carousel__slide';
    this.slidePanels = this.container.querySelectorAll(this.slidePanelSelector);

    if (this.useArrowButtons) {
      
      if (!supportsInertNatively) {
        console.log('incuding polyfill');
        import('../../enable-node-libs/inert-polyfill/inert-polyfill.js')
        .then((dialogPolyfill) => {
          this.setSlidesInert(true, 0);
          this.setEvents();
        });
      } else {
        console.log('not including polyfill');
        this.setSlidesInert(true, 0);
        this.setEvents();
      }
    } else {
      this.setEvents();
    }
  }

  this.preventSpaceFromScrolling = (e) => {
    if (e.key === ' ') {
      console.log('hey');
      e.stopPropagation();
    }
  }

  this.setEvents = () => {
    // when keyboard focus is applied to a slide's CTA.
    this.container.addEventListener("focus", this.focusCTAHandler, true);

    // When the mouse is clicked, we will allow animations.
    document.body.addEventListener("mousedown", this.clickHandler, true);

    // When a keyboard is used and the key released is the TAB key,
    // we turn the animations off. 
    document.body.addEventListener("keyup", this.keyUpHandler, true);

    
    if (this.useArrowButtons) {
      // when `useArrowButtons` option is set, we should ensure the first
      // CTA inside the visible panel gains focus when it first comes into view.
      this.container.addEventListener("glider-slide-visible", this.slideVisibleEvent);
      this.container.addEventListener("glider-slide-hidden", this.slideHiddenEvent);

      // when buttons are clicked with a Enter key, prevent the page from scrolling
      $previousButton.addEventListener('keypress', this.preventSpaceFromScrolling);
      $nextButton.addEventListener('keypress', this.preventSpaceFromScrolling);
      $previousButton.addEventListener('keyup', this.preventSpaceFromScrolling);
      $nextButton.addEventListener('keyup', this.preventSpaceFromScrolling);
    }
  };

  this.setSlidesInert = (value, exceptionIndex) => {
    this.slidePanels.forEach((el, i) => {
      if (i !== exceptionIndex) {
        el.inert = value;
      }

      el.setAttribute('tabindex', '-1');
    })
  }
  

  this.slideHiddenEvent = (e) => {
    
    console.log('slideHiddenEvent', e.detail.slide);
    const hiddenSlideIndex = e.detail.slide;
    const hiddenSlide = this.container.querySelectorAll(this.slidePanelSelector)[hiddenSlideIndex];
    hiddenSlide.inert = true;
  }

  this.slideVisibleEvent = (e) => {
    
    console.log('slideVisibleEvent', e.detail.slide);
    const visibleSlideIndex = e.detail.slide;
    const visibleSlide = this.container.querySelectorAll(this.slidePanelSelector)[visibleSlideIndex];
    visibleSlide.inert = false;
    visibleSlide.focus();
  }

  this.focusCTAHandler = (e) => {
    // When keyboard focus is applied to a CTA in a slide,
    // we make the carousel display that slide.
    const { target } = e;
    this.slideToTarget(target);
  };

  this.slideToTarget = function (target) {
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
}

export default EnableCarousel;
