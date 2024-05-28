'use strict';

/*******************************************************************************
 * hero-image-text-resize.js - Resizable text overlayed on a hero image example
 *
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 28, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/hero-image-text-resize.php
 *
 * Released under the MIT License.
 ******************************************************************************/
import textZoomEvent from '../../enable-node-libs/text-zoom-event/dist/textZoomEvent.module.js';

const textZoomDemo = new (function () {
    const body = document.body;

    function setCssTextZoomFactor() {
        if (textZoomEvent.resizeFactor() > 1) {
            body.classList.add('text-zoom');
        } else {
            body.classList.remove('text-zoom');
        }
    }

    this.init = function () {
        // It is better if you give this the value of
        // parseFloat(getComputedStyle(document.documentElement).fontSize
        // when the doc is not zoomed.
        textZoomEvent.init(16);
        setCssTextZoomFactor();
        document.addEventListener('textzoom', setCssTextZoomFactor);
    };
})();

textZoomDemo.init();

export default textZoomDemo;
