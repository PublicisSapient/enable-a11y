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

let counter = 0;

const EnableCarousel = function (container, options, gliderOptions) {
  let glider;

  this.container = container;
  this.options = options || {};
  this.gliderOptions = gliderOptions || {};
  this.useArrowButtons = this.options.useArrowButtons || false;
  this.id = null;
  this.indicatorsId = null;

  const supportsInertNatively = HTMLElement.prototype.hasOwnProperty('inert');
  const $previousButton = this.container.parentNode.querySelector('.glider-prev');
  const $nextButton = this.container.parentNode.querySelector(".glider-next");
  this.$alert = this.container.parentNode.querySelector('.enable-carousel__alert');

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
    // check if there is an id for the container. If not, we make one.
    this.id = this.container.id || `enable-carousel-${counter}`;
    counter++;
    if (!this.container.id) {
      this.container.setAttribute('id', this.id);
    }

    this.indicatorsSelector = `#${this.id}__indicators`;
    this.indicatorsRoot = document.querySelector(this.indicatorsSelector);

    const defaultGliderOptions = {
      slidesToShow: 1,
      dots: this.indicatorsSelector,
      duration: 0,
      arrows: {
        prev: $previousButton,
        next: $nextButton,
      },
      draggable: true,
      scrollLock: true,
      animationDuration: 0
    };
    
    const mergedGliderOptions = { ... defaultGliderOptions, ... this.gliderOptions};

    // initializes Glider. We ensure that the carousel
    // is set to not have any animations by default.
    // eslint-disable-next-line no-undef
    glider = new Glider(this.container, mergedGliderOptions);

    this.removeBadAria();
    this.blockBadAria();

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

  this.removeBadAria = () => {
    if (this.indicatorsRoot) {
      const indicatorList = this.indicatorsRoot.querySelectorAll('[role]');
      this.indicatorsRoot.removeAttribute('role');
      indicatorList.forEach((el, i) => {
        this.fixIndicator(el, i);
      });
    }
    
  }

  this.blockBadAria = () => {
    if (this.indicatorsRoot) {

      const attributeObserver = new MutationObserver(this.removeTabListRoleObserver);
      attributeObserver.observe(this.indicatorsRoot, { attributeFilter: [ 'role' ]});

      const addDotObserver = new MutationObserver(this.fixIndicatorsObserver);
      addDotObserver.observe(this.indicatorsRoot, { childList: true });
    }
  }

  this.removeTabListRoleObserver = (mutationList) => {
    this.indicatorsRoot.removeAttribute('role');
    this.indicatorsRoot.classList.add('enable-carousel__dots')
  }

  this.fixIndicatorsObserver = (mutationList) => {
    mutationList.forEach((mutation, i) => {
      const { addedNodes } = mutation;

      if (addedNodes.length > 0) {
        addedNodes.forEach((el) => {
          var { parentNode } = el;
          // The equivalent of parent.children.indexOf(child)
          var i = Array.prototype.indexOf.call(parentNode.children, el);

          this.fixIndicator(el, i);
        });
      }
      
    });
  }

  this.fixIndicator = (el, i) => {
    el.removeAttribute('role');
    el.setAttribute('aria-label', `Display Slide ${i+1}.`);
    el.setAttribute('tabindex', '-1');
    el.setAttribute('aria-hidden', 'true');
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
