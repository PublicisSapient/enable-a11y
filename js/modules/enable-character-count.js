import { interpolate } from "./interpolate.js";

const enableCharacterCount = new function() {
    let charCountInitEl,
        globalScreenReaderTemplate,
        globalVisualTemplate,
        globalCounterInstructions,
        charCountTemplate,
        liveRegion,
        globalWarningThreshold,
        timeout;

    let idIndex = '0';

    this.init = () => {
        const charCountEls = document.querySelectorAll('[data-has-character-count]');
        charCountInitEl = charCountEls.length > 0 ? charCountEls[0] : null;
        const charCountTemplateEl = document.getElementById('enable-character-count__template');
        const dataset = charCountInitEl ? charCountInitEl.dataset : {};

        charCountTemplate = charCountTemplateEl ? charCountTemplateEl.innerHTML : '<span class="sr-only">${screenReaderText}</span><span aria-hidden="true">${visualText}</span>';

        globalScreenReaderTemplate = dataset.screenReaderText || 'Character Count: ${numChars} out of ${maxLength}';
        globalVisualTemplate = dataset.visualText || '${numChars}/${maxLength}';
        globalCounterInstructions = dataset.counterInstructions || 'Press Escape to find out how many more characters you can type.';
        globalWarningThreshold = dataset.warningThreshold || 20;

        document.addEventListener('keyup', this.onKeyUp, true);
        document.addEventListener('focus', this.onFocus, true);

        addLiveRegion();

        charCountEls.forEach((target, i) => {
            setAriaDesc(target);
            createCounterFor(target);
            writeCharCount(target);
        });
    }

    function setAriaDesc(target) {
        const desc = target.getAttribute('aria-describedby') || '';
        target.setAttribute('aria-describedby', `${desc} character-count__desc`.trim())
    }

    function getNewId() {
        const id = `enable-character-counter-${idIndex}`;
        id++;
    }

    function getCounterHTML(target, numChars, maxLength) {
        const { dataset } = target;
        const screenReaderTemplate = dataset.screenReaderTemplate || globalScreenReaderTemplate;
        const visualTemplate = dataset.visualTemplate || globalVisualTemplate;
        const screenReaderText = interpolate(screenReaderTemplate, { numChars, maxLength });
        const visualText = interpolate(visualTemplate, { numChars, maxLength });
        const screenReaderCount = interpolate(charCountTemplate, { screenReaderText, visualText });

        return screenReaderCount;
    }

    function createCounterFor(target) {
        const counterEl = document.createElement('output');
        const targetId = target.id || getNewId();
        counterEl.className = "enable-character-count";
        counterEl.id = `${targetId}__counter`;
        counterEl.setAttribute('aria-live', 'off')
        target.setAttribute('data-character-count-label', counterEl.id);

        target.insertAdjacentElement('afterend', counterEl);
    }

    function addLiveRegion() {
        const lastBodyEl = document.body.lastElementChild;
        liveRegion = document.createElement('output');
        liveRegion.className = 'sr-only';
        liveRegion.id = 'character-count__status';
        /* liveRegion.setAttribute('role', 'status');
        liveRegion.setAttribute('aria-live', 'polite'); */
        lastBodyEl.insertAdjacentElement('afterend', liveRegion);
        lastBodyEl.insertAdjacentHTML('afterend', `<div id="character-count__desc" class="sr-only">${globalCounterInstructions}</div>`)

    }

    this.onKeyUp = (e) => {
        const { target, key } = e;
        const { dataset } = target;

        if (dataset.hasCharacterCount) {
            timeout && clearTimeout(timeout);

            switch (key) {
                case 'Escape':
                case 'Tab':
                    announceCharCount(target);
                    break;
                default:
                    writeCharCount(target);
                    liveRegion.innerHTML = '';

                    if (target.value.length > target.maxLength - globalWarningThreshold) {

                        timeout = setTimeout(() => {
                            announceCharCount(target);
                        }, 100);

                    }
            }

        }
    }

    this.onFocus = (e) => {
        const { target } = e;
        const { dataset } = target;

        if (dataset.hasCharacterCount) {
            announceCharCount(target);
        }
    }

    const writeCharCount = (target) => {
        const { maxLength, dataset, value } = target;
        const { characterCountLabel, characterCountDelta } = dataset;
        const characterCountLabelEl = document.getElementById(characterCountLabel);

        if (maxLength && characterCountLabelEl) {
            characterCountLabelEl.innerHTML = getCounterHTML(target, value.length, maxLength);
        }
    }

    const announceCharCount = (target) => {
        const { maxLength, dataset } = target;
        const screenReaderTemplate = dataset.screenReaderTemplate || globalScreenReaderTemplate;
        const numChars = target.value.length;
        if (maxLength) {
            liveRegion.innerHTML = '';
            setTimeout(() => {
                liveRegion.innerHTML = interpolate(screenReaderTemplate, { numChars, maxLength });
            }, 250);
        }
    }
}

enableCharacterCount.init();