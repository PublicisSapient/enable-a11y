const animatedGifPause = new function () {
    let summaryPauseClass;

    this.setSummaryAriaLabel = function (summaryEl) {

        // We run this inside a requestAnimationFrame to ensure
        // <summary> tag has a change to open after it is 
        // clicked.
        requestAnimationFrame(() => {
            const detailsEl = summaryEl.parentNode;

            if (detailsEl.open) {
                summaryEl.setAttribute('aria-label', 'pause');
            } else {
                summaryEl.setAttribute('aria-label', 'play');
            }
        }) 
    }

    this.summaryClickHandler = (e) => {
        const { target } = e;

        // if we clicked on the pause button, let's run this.setSummaryAriaLabel().
        if (target.classList.contains('pauseable-animated-gif__play-pause-button')) {
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
              '.pauseable-animated-gif--respects-os-motion-settings details'
            );
            affectedDetailsButton.setAttribute('open', true);
        }
    }

    this.init = function() {
        this.respectReduceMotionSettings();

        document.addEventListener('click', this.summaryClickHandler, true);

        summaryPauseClass = 'pauseable-animated-gif__play-pause-button';
        const summaryPauseEls = document.getElementsByClassName(summaryPauseClass);
        for (let i=0; i<summaryPauseEls.length; i++) {
            this.setSummaryAriaLabel(summaryPauseEls[i]);
        }
    }
}

animatedGifPause.init();