const playPauseAnimationButton = new function () {
    let cachedRAF = window.requestAnimationFrame;

    this.dummyRAF =  (func) => {
        setTimeout(() => {
            window.requestAnimationFrame(func);
        }, 500);
        return;
    }

    this.pause = () => {
        const { body } = document;

        // For CSS animations
        body.classList.add(this.pauseClass);
        body.classList.remove(this.playClass);

        // For JS animations
        window.requestAnimationFrame = this.dummyRAF;

        // for SVG animations
        document.querySelectorAll('svg').forEach((el) => {
            el.pauseAnimations();
        });

        localStorage.setItem(this.reduceMotionKey, true);
    }

    this.play = () => {
        const { body } = document;

        // For CSS animations
        body.classList.remove(this.pauseClass);
        body.classList.add(this.playClass);

        // For JS animations
        window.requestAnimationFrame = cachedRAF;

        // for SVG animations
        document.querySelectorAll('svg').forEach((el) => {
            el.unpauseAnimations();
        });
        localStorage.removeItem(this.reduceMotionKey);
    }

    this.clickEvent = (e) => {
        if (this.$checkbox.classList.contains(this.checkboxClass)) {
            if (this.$checkbox.checked) {
                this.pause();
            } else {
                this.play();
            }
        } 
    }
    

    this.init = function () {
        this.rootClass = 'play-pause-animation-button';
        this.pauseClass = `${this.rootClass}__prefers-reduced-motion`;
        this.playClass = `${this.rootClass}__prefers-motion`;
        this.checkboxClass = `${this.rootClass}__checkbox`;
        this.$checkbox = document.querySelector(`.${this.checkboxClass}`);
        this.prefersReducedMotionMq = window.matchMedia('(prefers-reduced-motion: reduce)');
        this.reduceMotionKey = `${this.rootClass}__prefers-reduced-motion`;
        this.wasSetByUser = localStorage.getItem(this.reduceMotionKey) || false;

        

        // Click event for the checkbox
        document.addEventListener('change', this.clickEvent);

        // Safari will restart SVG animations when the browser tab becomes visible
        // after being pushed in the background, so we do this to work around it.
        document.addEventListener('visibilitychange', this.clickEvent);

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
    }

    this.init();
}