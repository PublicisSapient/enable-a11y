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
const pauseAnimControl = new function() {
  let timePausePressed = null;
  const pauseEvent = new Event('enable-pause');
  const playEvent = new Event('enable-play');

  this.cachedRAF = window.requestAnimationFrame;

  this.dummyRAF = (func, ignoreTime) => {
    const millisecs = Date.now() - timePausePressed;

    if (ignoreTime || millisecs <= 500) {
      setTimeout(() => {
        window.requestAnimationFrame(func, true);
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
      window.requestAnimationFrame = this.dummyRAF;

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

      // fire play event
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
    window.requestAnimationFrame = this.cachedRAF;

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

  this.clickEvent = () => {
    if (this.$checkbox.classList.contains(this.checkboxClass)) {
      if (this.$checkbox.checked) {
        this.pause();
      } else {
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

    // Safari will restart SVG animations when the browser tab becomes visible
    // after being pushed in the background, so we do this to work around it.
    document.addEventListener('visibilitychange', this.clickEvent);

  }

  this.init();
}



export default pauseAnimControl;