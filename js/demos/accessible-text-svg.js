import showcode from '../enable-libs/showcode.js';
import textZoomEvent from '../../enable-node-libs/text-zoom-event/dist/textZoomEvent.module.js';

const svgTextSpacingDemo = new (function () {
    const pathEl = document.getElementById(
        'accessible-text-svg-demo__svgTextPath',
    );
    const rollinEl = document.getElementById('rollin');

    function setTextZoomFactor() {
        const zoomFactor = textZoomEvent.resizeFactor();
        document.body.style.setProperty('--text-zoom-factor', zoomFactor);

        if (zoomFactor > 1) {
            pathEl.setAttribute('startOffset', '3%');
            rollinEl.setAttribute('to', '3%');
        } else {
            pathEl.setAttribute('startOffset', '20%');
            rollinEl.setAttribute('to', '20%');
        }
    }

    this.init = function () {
        // It is better if you give this the value of
        // parseFloat(getComputedStyle(document.documentElement).fontSize
        // when the doc is not zoomed.
        textZoomEvent.init(16);
        setTextZoomFactor();
        document.addEventListener('textzoom', setTextZoomFactor);
    };
})();

// This is the bit that does the animation.
const textpathAnimation = new (function () {
    const buttonEl = document.getElementById(
        'accessible-text-svg-demo__control',
    );
    let state = 'rollout';

    const clickEvent = () => {
        const animEl = document.getElementById(state);
        state = state == 'rollout' ? 'rollin' : 'rollout';
        animEl.beginElement();
    };

    this.init = function () {
        buttonEl.addEventListener('click', clickEvent);
    };
})();

showcode.addJsObj('svgTextSpacingDemo', svgTextSpacingDemo);
svgTextSpacingDemo.init();
textpathAnimation.init();
