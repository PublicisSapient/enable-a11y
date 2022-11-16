/*********************************************************
 * textResizeEvent.js - a library to capture text resize events
 * 
 * This library is to be used to help fix problems when trying
 * to comply with WCAG AA 1.4.4
 * 
 * https://www.w3.org/TR/UNDERSTANDING-WCAG20/visual-audio-contrast-scale.html
 * 
 * by Zoltan Hawryluk (zoltan.dulac@gmail.com)
 * based on ideas by Hedgerwow, from a blog post retrieved from
 * The Wayback Machine:
 * 
 * https://web.archive.org/web/20061031093917/http://www.hedgerwow.com/360/dhtml/js-onfontresize.html
 * 
 * Code has been updated for modern web browsers, and is in the Public Domain.
 * 
 ********************************************************/

let textZoomEvent;

if (typeof document !== 'undefined') {
    (function () {
        if ( typeof window.CustomEvent === "function" ) return false;
      
        function CustomEvent ( event, params ) {
          params = params || { bubbles: false, cancelable: false, detail: null };
          var evt = document.createEvent( 'CustomEvent' );
          evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
          return evt;
         }
      
        CustomEvent.prototype = window.Event.prototype;
      
        window.CustomEvent = CustomEvent;
    })();


    textZoomEvent = new function () {
        let dFrame;
        let fontSizeChangeEvent;
        let isInitialized = false;

        // pixel to rem conversion from https://tzi.fr/js/convert-em-in-px/ 
        function getRootElementFontSize() {
            // Returns a number
            return parseFloat(
            // of the computed font-size, so in px
            getComputedStyle(
                // for the root <html> element
                document.documentElement
            ).fontSize
            );
        }

        function convertRem(value) {
            return value * getRootElementFontSize();
        }

        this.resizeFactor = function () {
            return dFrame.offsetWidth / textZoomEvent.unzoomPixelValue;
        }

        const onFontSizeChangeHandler = function () {
            const r = dFrame.offsetWidth / 100;

            return !document.dispatchEvent(fontSizeChangeEvent);
        }

        this.init = function (unzoomPixelValue) {
            if (isInitialized) {
                return;
            }
            const b = document.body && document.body.firstChild;

            fontSizeChangeEvent = new CustomEvent('textzoom', {
                detail: {
                    resizeFactor: this.resizeFactor
                }
            });
            this.unzoomPixelValue = unzoomPixelValue || convertRem(1);

            // Create IFRAME that we will attache resize event to.
            dFrame = document.createElement('IFRAME');
            dFrame.setAttribute('aria-hidden', 'true');
            dFrame.setAttribute('tabindex', '-1');
            dFrame.setAttribute('title', 'Text Zoom Event Iframe');

            document.body.insertBefore(dFrame, b);

            const dS = dFrame.style;
            dS.width = '1em';
            dS.height = '1px';
            dS.borderWidth = 0;
            dS.position = 'absolute';
            dS.overflow = 'hidden';
            dS.whiteSpace = 'nowrap';
            dS.margin = '-1px';

            const dWin = dFrame.contentWindow;
            
            let doc = dFrame.contentWindow || dFrame.contentDocument || dFrame.document;
            doc = doc.document || doc;

            const s = 'style="width:100%;height:100%;padding:0;margin:0;overflow:hidden;"';

            doc.open();
            doc.write('<!DOCTYPE html><html ' + s + '><body ' + s + '></body></html>');
            doc.close();

            dWin.addEventListener('resize', onFontSizeChangeHandler);
            isInitialized = true;
        }

    }
}

if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
	module.exports = (textZoomEvent || new function () {});
}
export default textZoomEvent;
