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
 function PauseAnimControlDef() {
  let timePausePressed = null;
  const pauseEvent = new CustomEvent('enable-pause-animations', { bubbles: true } );
  const playEvent = new CustomEvent('enable-play-animations', { bubbles: true } );

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

    // fire pause event.
    document.dispatchEvent(playEvent);

    localStorage.removeItem(this.reduceMotionKey);
  }

  this.pauseSMIL = (el) => {
    console.log('PAUSE', el.outerHTML);
    const svgEl = el.closest('svg');

    if (this.$checkbox.checked) {
      svgEl.pauseAnimations();
    }
  }

  this.clickEvent = () => {
    console.log('huh');
    if (this.$checkbox.classList.contains(this.checkboxClass)) {
      if (this.$checkbox.checked) {
        console.log('pausing');
        this.pause();
      } else {
        console.log('playing');
        this.play();
      }
    }
  }


  this.init = function() {
    this.rootClass = 'pause-anim-control';
    this.pauseClass = `${this.rootClass}__prefers-reduced-motion`;
    this.playClass = `${this.rootClass}__prefers-motion`;
    this.checkboxClass = `${this.rootClass}__checkbox`;
    this.$checkbox = document.querySelector(`.${this.checkboxClass}`);
    this.prefersReducedMotionMq = window.matchMedia('(prefers-reduced-motion: reduce)');
    this.reduceMotionKey = `${this.rootClass}__prefers-reduced-motion`;
    this.wasSetByUser = localStorage.getItem(this.reduceMotionKey) || false;

    if (!this.$checkbox) {
      console.warn('Pause checkbox is not in DOM. Bailing');
      return;
    }

    if (this.prefersReducedMotionMq.matches || this.wasSetByUser) {
      this.$checkbox.checked = true;
      this.pause();
    } else {
      this.$checkbox.checked = false;
      this.play();
    }

    this.prefersReducedMotionMq.addEventListener('change', (e) => {
      if (e.matches) {
        this.$checkbox.checked = true;
        this.pause();
      } else {
        this.$checkbox.checked = false;
        this.play();
      }
    });


    // Click event for the checkbox
    document.addEventListener('change', this.clickEvent);

    document.addEventListener('load', this.clickEvent);
    window.addEventListener('focus', this.clickEvent);
    document.querySelectorAll('animateMotion, animate').forEach((el) => {
      this.pauseSMIL(el);
    });

    // Safari will restart SVG animations when the browser tab becomes visible
    // after being pushed in the background, so we do this to work around it.
    document.addEventListener('visibilitychange', this.clickEvent);

  }

  this.init();
}

const pauseAnimControl = new PauseAnimControlDef();


export {pauseAnimControl as default, PauseAnimControlDef};