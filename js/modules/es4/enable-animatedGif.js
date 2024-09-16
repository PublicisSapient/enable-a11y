'use strict'

/*******************************************************************************
* enable-animatedGif.js - Pausable Animated GIF library
* 
* Code originally written by Steve Faulkner:
* available https://codepen.io/stevef/pen/ExPdNMM
* and ideas added by Chris Coyier:
* https://css-tricks.com/pause-gif-details-summary/
*
* Refactored by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/animated-gif-with-pause-button.php
* 
* Released under the MIT License.
******************************************************************************/

const animatedGifPause = new function () {
    const detailsQuery = '.pausable-animated-gif details';
    let summaryPauseClass;

    this.setSummaryAriaLabel = function (summaryEl) {

        // We run this inside a requestAnimationFrame to ensure
        // <summary> tag has a change to open after it is 
        // clicked.
        requestAnimationFrame(() => {
            const detailsEl = summaryEl.parentNode;

            if (detailsEl.open) {
                detailsEl.dataset.hasPlayed = 'true';
                summaryEl.setAttribute('aria-label', 'pause');
            } else {
                summaryEl.setAttribute('aria-label', 'play');
            }
        }) 
    }

    this.summaryClickHandler = (e) => {
        const { target } = e;

        // if we clicked on the pause button, let's run this.setSummaryAriaLabel().
        if (target.classList.contains('pausable-animated-gif__play-pause-button')) {
            this.setSummaryAriaLabel(target)
        }
    }

    this.respectReduceMotionSettings = function () {

        // Detect via CSS whether the user set the OS to 
        // reduce motion animations where possible
        const cssVal = getComputedStyle(document.body)
          .getPropertyValue('--prefers-reduced-motion').trim();

        const prefersReducedMotion = ( cssVal === '1');

        // Show animated version by default is this value
        // is false
        if (!prefersReducedMotion) {
            const affectedDetailsButton = document.querySelector(
              '.pausable-animated-gif--respects-os-motion-settings details'
            );
            affectedDetailsButton.setAttribute('open', true);
        }
    }

    const pauseAll = (e) => {
        document.querySelectorAll(detailsQuery).forEach((el) => {
            el.open = false;
        })
    }

    const playAll = (e) => {
        document.querySelectorAll(detailsQuery).forEach((el) => {
            if (el.dataset.hasPlayed) {
                el.open = true;
            }
        })
    }

    this.init = function() {
        this.respectReduceMotionSettings();

        document.addEventListener('click', this.summaryClickHandler, true);

        summaryPauseClass = 'pausable-animated-gif__play-pause-button';
        const summaryPauseEls = document.getElementsByClassName(summaryPauseClass);
        for (let i=0; i<summaryPauseEls.length; i++) {
            this.setSummaryAriaLabel(summaryPauseEls[i]);
        }

        // ensure the global pauseAnimControl can pause all playing animations
        document.addEventListener('enable-pause-animations', pauseAll);

        // ensure the global pauseAnimControl can replay all animations that were playing before
        document.addEventListener('enable-play-animations', playAll);
    }

    this.init();
}


export default animatedGifPause;