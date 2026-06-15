'use strict'

/* eslint-disable no-undef */

/*******************************************************************************
 * pause-anim-control.js - A global pause button for client side motion graphics
 * and videos.
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 27, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/pause-anim-control.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

let accessibility; // for the accessibility library, if it is needed.

 function PauseAnimControlDef() {
  let timePausePressed = null;
  const pauseEvent = new CustomEvent('enable-pause-animations', { bubbles: true } );
  const playEvent = new CustomEvent('enable-play-animations', { bubbles: true } );
  
  // Default path for accessibility module (can be overridden via data attribute)
  this.defaultAccessibilityPath = '../../enable-node-libs/accessibility-js-routines/dist/accessibility.module.js';

  // we store this globally so other components can use 
  // this without having to load this module.
  this.realRAF = window.requestAnimationFrame.bind(window);
  this.requestAnimationFrame = this.realRAF;

  /**
   * This will replace the real requestAnimationFrame method when the "Pause Animations"
   * checkbox is checked.  It basically does two things:
   * 
   * 1) For requestAnimationFrame calls done right after the checkbox is checked, 
   * this method will "hold on to them" until the checked box is unchecked.
   * 2) requestAnimationFrame calls after 500 ms will be dropped.
   * 
   * @param {func} func - A JavaScript function to be executed when a frame is available   
   * @param {Object} options - A JavaScript object with the following properties:
   *   - ignoreTime: this is used internally by dummyRAF to ensure that
   *     requestAnimationFrame calls that call itself will continute to do so until the 
   *     "Pause Animations" checkbox is unchecked.
   *   - useRealRAF: this can be used by developers to tell this method that 
   *     what they are doing is not an actual animation, but they want to do something
   *     at the next repaint.
   *   - isDelayed:  
   */
  this.dummyRAF = (func, options) => {
    const millisecs = Date.now() - timePausePressed;
    const { ignoreTime, useRealRAF } = options || {};
    const isAnimation = (func.toString().indexOf('requestAnimationFrame') > -1);

    if (!isAnimation || useRealRAF) {
      window.requestAnimationFrame(func);
    } else if (ignoreTime || millisecs <= 500) {
      setTimeout(() => {
        this.requestAnimationFrame(func, {
          ignoreTime: true
        });
      }, 500);
    }
    return;
  }

  this.pause = () => {
    const { body } = document;

    if (body.classList.contains(this.pauseClass)) {
      return;
    } else {
      // For CSS animations
      body.classList.add(this.pauseClass);
      body.classList.remove(this.playClass);

      // For JS animations
      this.requestAnimationFrame = this.dummyRAF;

      // for SVG animations
      document.querySelectorAll('svg').forEach((el) => {
        el.pauseAnimations();
      });

      // for AblePlayer videos
      if (typeof(AblePlayerInstances) !== 'undefined') {
        AblePlayerInstances.forEach(el => {
          if (el.playing) {
            el.pausedWithEnableControl = true;
            el.pauseMedia();
          }
        });
      }

      // for vanilla HTML5 Videos
      document.querySelectorAll('video').forEach((el) => {
        const { dataset } = el;
        if (!dataset.ablePlayer && !dataset.notPausableByEnable && !el.paused) {
          dataset.pausedWithEnableControl = true;
          el.pause();
        }
      });

      // Update button controls
      this.syncAllControls(true);

      // fire pause event
      document.dispatchEvent(pauseEvent);

      localStorage.setItem(this.reduceMotionKey, true);

      timePausePressed = Date.now();
    }
  }

  this.play = () => {
    const { body } = document;

    // For CSS animations
    body.classList.remove(this.pauseClass);
    body.classList.add(this.playClass);

    // For JS animations
    this.requestAnimationFrame = this.realRAF;

    // for SVG animations
    document.querySelectorAll('svg').forEach((el) => {
      el.unpauseAnimations();
    });

    // for AblePlayer videos
    if (typeof(AblePlayerInstances) !== 'undefined') {
      AblePlayerInstances.forEach(el => {
        if (el.pausedWithEnableControl) {
          el.pausedWithEnableControl = false;
          el.playMedia();
        }
      });
    }

    // for vanilla HTML5 Videos
    document.querySelectorAll('video').forEach((el) => {
      const { dataset } = el;

      if (dataset.pausedWithEnableControl) {
        dataset.pausedWithEnableControl = false;
        el.play();
      }
    });

    // Update button controls
    this.syncAllControls(false);

    // fire pause event.
    document.dispatchEvent(playEvent);

    localStorage.removeItem(this.reduceMotionKey);
  }

  this.pauseSMIL = (el) => {
    const svgEl = el.closest('svg');

    // Check if any checkbox is checked
    const anyChecked = Array.from(this.$checkboxes).some(checkbox => checkbox.checked);
    if (anyChecked) {
      svgEl.pauseAnimations();
    }
  }

  this.clickEvent = (e) => {
    // Check if the changed element is one of our pause checkboxes
    if (e.target && e.target.classList.contains(this.checkboxClass)) {
      const isChecked = e.target.checked;
      
      // Synchronize all controls to the same state
      this.syncAllControls(isChecked);
      
      if (isChecked) {
        this.pause();
      } else {
        this.play();
      }
    }
    // Check if the clicked element is one of our pause buttons
    else if (e.target && e.target.classList.contains(this.buttonClass)) {
      const currentState = e.target.dataset.pauseAnimControlChecked === 'true';
      const newState = !currentState;
      
      // Synchronize all controls to the new state
      this.syncAllControls(newState);
      
      if (newState) {
        this.pause();
      } else {
        this.play();
      }

      // After all state changes are complete, refocus the current element
      // so screen readers will announce the change of label on the button
      if (accessibility) {
        accessibility.refocusCurrentElement();
      }
    }
  }

  this.syncAllCheckboxes = (checked) => {
    this.$checkboxes.forEach((checkbox) => {
      checkbox.checked = checked;
    });
  }

  this.syncAllButtons = (checked) => {
    this.$buttons.forEach((button) => {
      button.dataset.pauseAnimControlChecked = checked ? 'true' : 'false';
      this.updateButtonLabel(button, checked);
    });
  }

  this.updateButtonLabel = (button, isPaused) => {
    const pauseLabel = button.dataset.pauseAnimControlPauseLabel;
    const playLabel = button.dataset.pauseAnimControlPlayLabel;
    const changeVisualLabel = button.dataset.pauseAnimControlChangeVisualLabel !== undefined;

    // Determine which label to use based on the state
    const labelToUse = isPaused ? playLabel : pauseLabel;

    if (!labelToUse) {
      return; // No labels defined, skip update
    }

    if (changeVisualLabel) {
      // Change the innerHTML to the appropriate label
      button.innerHTML = labelToUse;
    } else {
      // Change the aria-label to the appropriate value
      button.setAttribute('aria-label', labelToUse);
    }
  }

  this.syncAllControls = (checked) => {
    this.syncAllCheckboxes(checked);
    this.syncAllButtons(checked);
  }


  this.init = function() {
    this.rootClass = 'pause-anim-control';
    this.pauseClass = `${this.rootClass}__prefers-reduced-motion`;
    this.playClass = `${this.rootClass}__prefers-motion`;
    this.checkboxClass = `${this.rootClass}__checkbox`;
    this.buttonClass = `${this.rootClass}__button`;
    this.$checkboxes = document.querySelectorAll(`.${this.checkboxClass}`);
    this.$buttons = document.querySelectorAll(`button.${this.buttonClass}`);
    this.prefersReducedMotionMq = window.matchMedia('(prefers-reduced-motion: reduce)');
    this.reduceMotionKey = `${this.rootClass}__prefers-reduced-motion`;
    this.wasSetByUser = localStorage.getItem(this.reduceMotionKey) || false;

    if ((!this.$checkboxes || this.$checkboxes.length === 0) && (!this.$buttons || this.$buttons.length === 0)) {
      console.warn('Pause controls (checkboxes or buttons) are not in DOM. Bailing');
      return;
    }

    // Load the accessibility library if there are button controls on the page
    if (this.$buttons && this.$buttons.length > 0) {
      // Check if any button has a custom accessibility path configured
      let accessibilityPath = '../../enable-node-libs/accessibility-js-routines/dist/accessibility.module.js';
      
      // Look for custom path in any of the pause control buttons or checkboxes
      const allControls = [...this.$checkboxes, ...this.$buttons];
      for (const control of allControls) {
        const customPath = control.dataset.pauseAnimControlAccessibilityPath;
        if (customPath) {
          accessibilityPath = customPath;
          break; // Use the first custom path found
        }
      }
      
      import(accessibilityPath)
      .then((accessibilityObj) => { 
        accessibility = accessibilityObj.default;
      })
      .catch((error) => {
        console.error('Accessibility module failed to load');
        console.error(error);
      });
    }

    if (this.prefersReducedMotionMq.matches || this.wasSetByUser) {
      this.syncAllControls(true);
      this.pause();
    } else {
      this.syncAllControls(false);
      this.play();
    }

    this.prefersReducedMotionMq.addEventListener('change', (e) => {
      if (e.matches) {
        this.syncAllControls(true);
        this.pause();
      } else {
        this.syncAllControls(false);
        this.play();
      }
    });


    // Click event for the checkbox
    document.addEventListener('change', this.clickEvent);

    // Click event for the buttons
    document.addEventListener('click', this.clickEvent);

    document.addEventListener('load', this.clickEvent);
    window.addEventListener('focus', this.clickEvent);
    document.querySelectorAll('animateMotion, animate').forEach((el) => {
      this.pauseSMIL(el);
    });

    // Safari will restart SVG animations when the browser tab becomes visible
    // after being pushed in the background, so we do this to work around it.
    document.addEventListener('visibilitychange', this.clickEvent);

  }

}

const pauseAnimControl = new PauseAnimControlDef();


export {pauseAnimControl as default, PauseAnimControlDef};