'use strict'
/*******************************************************************************
 * input-mask.js - Accessible input masking library
 * 
 * Coded by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released August 25, 2023
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/input-mask.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

const inputMask = new function () {
    this.bemPrefix = 'enable-input-mask';

    const inputClass = `${this.bemPrefix}__input`;
    const maskClass = `${this.bemPrefix}__mask`;
    const alertClass = `${this.bemPrefix}__alert`;
    const isLetterRe = new RegExp(/^\p{L}/, 'u');
    const formatCharacterRe = /[ \-\(\)]/g;
    const beepAudio = new Audio("data:audio/mp3;base64,//MkxAAHAAL1uUAAAv0inbbAIgBAMNLh+IAfqOKDEuD+D4f+D5/wfB/cauxXeK9C//MkxAcI+JbcAZg4AJRI0LVZ3HZdPWsbXiMNhWtOE5aokvip8nX9bN3WgL4OSQUW//MkxAYIeHrNmdAQAtZiTJMgmCjlZ0WRSSROP6T4V3880GP4iET9n9Ew+CC3bDqW//MkxAcJGRrFuIAFAmFjYZ4Fo+VTZrd/2OHzpLfy3r+/UqPQyjGfG1uyyv+7u3GH//MkxAUIoIJkAMbQRFzQEIqDVc5uAGAF6pLWmH9f/2YsFIV61f/////+2r9yheJn//MkxAUHOH5YAAbEDODhUwx1PgFRodbaKzwxmTp/CuNK/R+/O+UMw7+FroGRJPtX//MkxAsHCDpEAB6SJF8DagsfjzsGVkt+lq/I/+z0qkSRoo8x6V4CwRj1H7kUPNRk//MkxBEGwEosADZMKFOjkaCqyLrLv+oAwPiQeFJEVUTGSj59EQYSBkE1MGqhquqr//MkxBkGwF2wAEmCaVXcTEFNRTMuMTAwqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq//MkxCEAAANIAAAAAKqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq");  
       
    let isMouseDown = false;
    let mouseDownX = -1;
    let announcementTimeout = null;
    let hasPastedValue = false;

    /*
     * Find the index of the character clicked in a text node.
     * From https://stackoverflow.com/a/55430151
     */
    const hitCharBinSearch = function (mClientX, inmostHitEl) {
        const originalInmost = inmostHitEl;
        let textNode = inmostHitEl.firstChild;

        if (!textNode) {
            return 0;
        }

        const bareText = textNode.textContent;
        
        let textLengthBeforeHit = 0;
        do {
            let textNodeR = textNode.splitText(textNode.length / 2);
            let textNodeL = textNode;
    
            let spanL = document.createElement('span');
            spanL.appendChild(textNodeL);
            let spanR = document.createElement('span');
            spanR.appendChild(textNodeR);

    
            inmostHitEl.appendChild(spanL);
            inmostHitEl.appendChild(spanR);
    
            if (mClientX >= spanR.getBoundingClientRect().left) {
                textNode = textNodeR;
                inmostHitEl = spanR;
                textLengthBeforeHit += textNodeL.length;
            }
            else {
                textNode = textNodeL;
                inmostHitEl = spanL;
            }
        } while (textNode.length > 1);
    
        /* This is for proper caret simulation. Can be omitted */
        var rect = inmostHitEl.getBoundingClientRect()
        if (mClientX >= (rect.left + rect.width / 2)) {
            textLengthBeforeHit++;
        }
        /*******************************************************/
    
        originalInmost.innerHTML = bareText;
        return textLengthBeforeHit;
    }

    const clickEvent = (e) => {
        const { target } = e;
        
        // The script should never be able to click
        // in the input field under the mask, since the 
        // mask should be directly on top of it and have
        // a higher z-index.  It should be a able to see
        // what letter was clicked on the masked input
        // and put the cursor for the real input in the
        // appropriate place.
        if (isMaskedInput(target)) {
            const maskedValue = getMaskedValue(target);
            const maskedValueHTML = getFormattedMaskedValue(maskedValue, target);
            const maskEl = getMaskForInput(target);
            maskEl.innerHTML = maskedValueHTML;
        }
    }

    const passMaskSelectionToInput = (maskEl, startX, endX) => {
        const minX = Math.min(startX, endX);
        const maxX = Math.max(startX, endX);

        maskEl.innerHTML = getNormalizedMaskedValue(maskEl);
        const inputEl = getInputForMask(maskEl);
        const startCharClickIndex = hitCharBinSearch(minX, maskEl);
        const endCharClickIndex = hitCharBinSearch(maxX, maskEl);
        const startInputCharClickIndex = maskIndexToInputIndex(startCharClickIndex, maskEl.innerText);
        const endInputCharClickIndex = maskIndexToInputIndex(endCharClickIndex, maskEl.innerText);
        
        inputEl.focus();
        inputEl.selectionStart = startInputCharClickIndex;
        inputEl.selectionEnd = endInputCharClickIndex;
        selectTarget(getInputForMask(maskEl));
    }

    const maskIndexToInputIndex = (maskIndex, maskValue) => {
        const maskValBeforeIndex = maskValue.substring(0, maskIndex);
        const matches = maskValBeforeIndex.match(formatCharacterRe)
        const numberOfFormatChars = matches ? matches.length : 0 ;
        const inputIndex = maskIndex - numberOfFormatChars;
        return inputIndex;

    }
    
    const inputEvent = (e) => {
        const { target } = e;

        if (hasPastedValue) {
            hasPastedValue = false;
            return;
        }

        if (isMaskedInput(target)) {
            const maskEl = getMaskForInput(target);

            if (maskEl === null) {
                throw `Missing mask for target: ${target.outerHTML}`
            }

            setMaskValue(target);

        }
    }


    const selectEvent = (e) => {
        const { target } = e;
        if (isMaskedInput(target)) {
            selectTarget(target);
        }
    }

    const selectTarget = (target) => {
        if (isMaskedInput(target)) {
            const { selectionStart, selectionEnd } = target;
            target.dataset[getDatasetAttr('SelectionStart')] = selectionStart;
            target.dataset[getDatasetAttr('SelectionEnd')] = selectionEnd;
            clickEvent({
                target
            });
        }
    }

    const pasteEvent = (e) => {
        const { target } = e;

        if (isMaskedInput(target)) {
            e.preventDefault();
            const { selectionStart, selectionEnd, value, maxLength } = target;
            let pastedText = (e.clipboardData || window.clipboardData).getData("text");
            pastedText = pastedText.replace(formatCharacterRe, '');

            const pre = value.substring(0, selectionStart);
            const post = value.substring(selectionEnd);
            const newValue = `${pre}${pastedText}${post}`;

            if (maxLength === -1) {
                target.value = newValue;
                target.selectionStart = selectionStart + newValue.length;
                target.selectionEnd = selectionStart + newValue.length;
            } else {
                target.value = newValue.substring(0, maxLength);
                target.selectionStart = Math.min(selectionStart + pastedText.length, maxLength);
                target.selectionEnd = Math.min(selectionStart + pastedText.length, maxLength);
            }
            setMaskValue(target);
        }
        
        
    }

    const keydownEvent = (e) => {
        const { target, key } = e;
        const { selectionStart, selectionEnd } = target;
        if (isMaskedInput(target)) {
            switch (key) {
                case 'ArrowUp':
                case 'ArrowDown':
                case 'ArrowLeft':
                case 'ArrowRight':

                    window.requestAnimationFrame(()=> {
                        clickEvent(e);
                    });
                    
                    break;
            }


            target.dataset[getDatasetAttr('SelectionStart')] = selectionStart;
            target.dataset[getDatasetAttr('SelectionEnd')] = selectionEnd;
        }
    }

    const mousedownEvent = (e) => {
        const { target } = e;
        if (isInMask(target)) {
            isMouseDown=true;
            mouseDownX=e.clientX;
        }
    }

    const mousemoveEvent = (e) => {
        const { target } = e;
        if (isInMask(target) && isMouseDown) {
            selectEvent(e);
        }
    }

    const mouseupEvent = (e) => {
        const { target } = e;

        if (isInMask(target)) {
            const maskEl = target.closest(`.${maskClass}`);
            passMaskSelectionToInput(maskEl, mouseDownX, e.clientX);
            isMouseDown = false;
            mouseDownX = -1;
        }
    }

    function beep() {
        beepAudio.play();
    }

    const toCamelCase = (myString) => {
        return myString.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase(); });
    }

    const isMaskedInput = (target) => {
        return target.nodeType === Node.ELEMENT_NODE && target.classList.contains(inputClass)
    }

    const isInMask = (target) => {
        return target.nodeType === Node.ELEMENT_NODE && (
            target.classList.contains(maskClass) || 
            (target?.parentNode?.classList && target.parentNode.classList.contains(maskClass)
        ));
    }

    const getMaskedSelectionStartEnd = (inputEl) => {
        const { dataset, value, selectionStart, selectionEnd } = inputEl;
        const { mask } = dataset;
        const valueArr = value.split('');
        const maskArr = mask.split('');
        let maskSelectionStart = -1, maskSelectionEnd = -1;

        for (let maskIndex = -1, valueIndex = 0; maskIndex < maskArr.length && valueIndex <= valueArr.length; valueIndex++) {
            const maskChar = maskArr[maskIndex];

            switch (maskChar) {
                case ' ':
                case '-':
                case '(':
                case ')':
                    maskIndex+=2;
                    break;
                default:
                    maskIndex++;
            }

            if (valueIndex === selectionStart) {
                maskSelectionStart = maskIndex;
            }
            
            if (valueIndex === selectionEnd) {
                maskSelectionEnd = maskIndex;
            }
        }

        if (maskSelectionStart === -1 || maskSelectionEnd === -1) {
            maskSelectionStart = valueArr.length;
            maskSelectionEnd = valueArr.length;
        }

        return {
            selectionStart: maskSelectionStart,
            selectionEnd: maskSelectionEnd
        }
    }
    
    const isNumber = (valueChar) => {
        return !isNaN(parseInt(valueChar))
    }

    const getMaskedValue = (inputEl) => {
        const { dataset, value = '' } = inputEl;
        const { mask } = dataset;
        const valueArr = value.split('');
        const maskArr = mask.split('');
        const maskedValArr = [];
        let isValid = true;
        

        for (let maskIndex = 0, valueIndex = 0; maskIndex < maskArr.length && valueIndex < valueArr.length; maskIndex++) {
            const maskChar = maskArr[maskIndex];
            const valueChar = valueArr[valueIndex]

            switch (maskChar) {
                // any non-space character
                case '_':
                    if (valueChar !== ' ') {
                        maskedValArr.push(valueChar)
                        valueIndex++;
                    } else {
                        isValid = false;
                    }
                    break;
                // any non-numeric character that we want to change to uppercase, if possible.
                case 'U':
                    if (valueChar !== ' ' && !isNumber(valueChar) && !valueChar.match(formatCharacterRe)) {
                        maskedValArr.push(valueChar.toUpperCase())
                        valueIndex++;
                    } else {
                        isValid = false;
                    }
                    break;
                // any character that we want to change to uppercase, if possible.
                case 'C':
                    if (valueChar !== ' ' && !valueChar.match(formatCharacterRe)) {
                        maskedValArr.push(valueChar.toUpperCase())
                        valueIndex++;
                    } else {
                        isValid = false;
                    }
                    break;
                // any number
                case '9':
                    if (isNumber(valueChar)) {
                        maskedValArr.push(valueChar);
                        valueIndex++;
                    } else {
                        isValid = false;
                    }
                    break;
                // any letter
                case 'X':
                    if (isLetterRe.test(valueChar)) {
                        maskedValArr.push(valueChar);
                        valueIndex++;
                    } else {
                        isValid = false;
                    }
                    break;
                // any format character supported by this library
                case ' ':
                case '-':
                case '(':
                case ')':
                    maskedValArr.push(maskChar);
                    break;
                default:
                    throw `Invalid mask: ${mask}`;
            }
        }

        if (isValid) {
            const r = maskedValArr.join('');
            return r;
        } else {
            return null;
        }
    }

    const announceValue = (inputEl, formattedValue) => {
        // Originally, this was
        //    const srValue = formattedValue.replace(formatCharacterRe, '&nbsp;');
        // We changed this so that the script would announce all elements letter
        // by letter.  This is because of the assumption that anyone who is using
        // this on an input field would want the input value to be read out one
        // character at a time.  If there is a use case not to do this, we may make
        // this feature configurable.
        const srValue = formattedValue.split('').join(' ').replace(formatCharacterRe, '&nbsp;');
        if (announcementTimeout) {
            clearTimeout(announcementTimeout);
        }

        announcementTimeout = setTimeout(() => {
            const alertEl = inputEl.parentNode.querySelector(`.${alertClass}`);
            let alertMsg = `Formatted input: ${srValue}`;

            // This will force screen readers to reannounce the value
            // in aria-live region if the new alert message is the same
            // text as the old.
            if (alertMsg === alertEl.innerHTML) {
                alertMsg += '.';
            }

            alertEl.innerHTML = alertMsg;

        // We use a timeout of 1000 so that it will speak over the
        // input's unformatted value (necessary for Voiceover OSX)
        }, 1000);
    }

    const getMaskForInput = (inputEl) => {
        return inputEl.parentNode.querySelector(`.${maskClass}`);
    }

    const getInputForMask = (maskEl) => {
        return maskEl.closest(`.${this.bemPrefix}`).querySelector(`.${inputClass}`);
    }

    const getFormattedMaskedValue = (maskedValue, inputEl) => {
        const maskSelection = getMaskedSelectionStartEnd(inputEl);
        const { selectionStart, selectionEnd } = maskSelection;
        const preVal = maskedValue.substring(0, selectionStart);
        const postVal = maskedValue.substring(selectionEnd);
        const midVal = maskedValue.substring(selectionStart, selectionEnd);
        const { bemPrefix } = this;

        return `<span class="${bemPrefix}__mask-pre-val">${preVal}</span><span class="${bemPrefix}__mask-mid-val">${midVal}</span><span class="${bemPrefix}__mask-post-val">${postVal}</span>`
    }

    const getNormalizedMaskedValue = (maskEl) => {
        return maskEl.innerText;
    }

    const setMaskValue = (inputEl) => {
        let { selectionStart, selectionEnd } = inputEl;
        const maskEl = getMaskForInput(inputEl);

        const maskedValue = getMaskedValue(inputEl);

        if (maskedValue !== null) {
            const maskedValueHTML = getFormattedMaskedValue(maskedValue, inputEl);
            maskEl.innerHTML = maskedValueHTML;
            setPreviousValue(inputEl);
            announceValue(inputEl, maskedValue);
        } else {
            inputEl.value = getPreviousValue(inputEl);
            selectionStart = inputEl.dataset[getDatasetAttr('SelectionStart')];
            selectionEnd = inputEl.dataset[getDatasetAttr('SelectionEnd')];
            beep();
        }

        inputEl.setSelectionRange(selectionStart, selectionEnd);
    }

    const getDatasetAttr = (attrName) => {
        const datasetPrefix = toCamelCase(this.bemPrefix);
        const datasetAttr = `${datasetPrefix}${attrName}`;
        return datasetAttr;
    }

    const setPreviousValue = (el) => {
        el.dataset[getDatasetAttr('PreVal')] = el.value;
    }

    const getPreviousValue = (el) => {
        return el.dataset[getDatasetAttr('PreVal')] || '';
    }

    const populateMasks = () => {
        const inputEls = document.querySelectorAll(`.${inputClass}`);

        inputEls.forEach((el) => {
            setPreviousValue(el, el.value);
            setMaskValue(el);
        })
    }

    this.init = () => {
        document.addEventListener('select', selectEvent, true);
        document.addEventListener('mouseup', mouseupEvent, true);
        document.addEventListener('mousedown', mousedownEvent, true);
        document.addEventListener('mousemove', mousemoveEvent)
        document.addEventListener('input', inputEvent, true);
        document.addEventListener('click', clickEvent, true);
        document.addEventListener('paste', pasteEvent, true);
        document.addEventListener('keydown', keydownEvent, true);
        populateMasks();
    }

    this.init();

}

export default inputMask;