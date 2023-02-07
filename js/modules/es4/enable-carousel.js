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


const EnableCarousel = function (container, options) {
  let glider;
  this.container = container;
  this.options = options || {};
  this.useArrowButtons = this.options.useArrowButtons || false;

  const supportsInertNatively = HTMLElement.prototype.hasOwnProperty('inert');
  const $previousButton = this.container.parentNode.querySelector('.glider-prev');
  const $nextButton = this.container.parentNode.querySelector(".glider-next");
  this.$alert = this.container.parentNode.querySelector('.enable-carousel__alert');

  console.log('alert', this.$alert);
  let accessibility; // for the accessibility library, if it is needed.

  this.init = function () {
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
          import('../../enable-node-libs/wicg-inert/dist/inert.min.js')
          .then((inertPolyfill) => {
            this.setArrowButtonEvents();
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
      console.log('alerted');
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
}

