const playPauseAnimationButton = new function () {
    let cachedRAF = window.requestAnimationFrame;
    this.init = function () {
        this.rootClass = 'play-pause-animation-button';
        this.pauseClass = `${this.rootClass}__prefers-reduced-motion`;
        this.playClass = `${this.rootClass}__prefers-motion`;
        this.checkboxClass = `${this.rootClass}__checkbox`;
        this.$checkbox = document.querySelector(`.${this.checkboxClass}`);
        this.prefersReducedMotionMq = window.matchMedia('(prefers-reduced-motion: reduce)');
        document.addEventListener('change', this.clickEvent);

        // Safari will restart SVG animations when the browser tab becomes visible
        // after being pushed in the background, so we do this to work around it.
        document.addEventListener('visibilitychange', this.clickEvent);

        if (this.prefersReducedMotionMq.matches) {
            this.$checkbox.checked = true;
            this.pause();
        } else {
            this.$checkbox.checked = false;
            this.play();
        }


        this.prefersReducedMotionMq.addEventListener('change', (e) => {
            if (e.matches) {
                console.log('match!');
                this.$checkbox.checked = true;
                this.pause();
            } else {

                console.log('not match!');
                this.$checkbox.checked = false;
                this.play();
            }
        });
    }

    this.dummyRAF =  (func) => {
        setTimeout(() => {
            window.requestAnimationFrame(func);
        }, 100);
        return;
    }

    this.pause = () => {
        const { body } = document;
        body.classList.add(this.pauseClass);
        body.classList.remove(this.playClass);
        window.requestAnimationFrame = this.dummyRAF;

        // SVGS
        document.querySelectorAll('svg').forEach((el) => {
            el.pauseAnimations();
        });
    }

    this.play = () => {
        const { body } = document;

        body.classList.remove(this.pauseClass);
        body.classList.add(this.playClass);

        window.requestAnimationFrame = cachedRAF;

        // SVGS
        document.querySelectorAll('svg').forEach((el) => {
            el.unpauseAnimations();
        });
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

    this.init();
}