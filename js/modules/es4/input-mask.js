'use strict'



const inputMask = new function () {
    this.bemPrefix = 'enable-input-mask';

    const inputClass = `${this.bemPrefix}__input`;
    const maskClass = `${this.bemPrefix}__mask`;
    const isLetterRe = new RegExp(/^\p{L}/, 'u');

    const toCamelCase = (myString) => {
        return myString.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase(); });
    }

    const getMaskedSelectionStartEnd = (inputEl) => {
        const { dataset, value, selectionStart, selectionValue } = inputEl;
        const { mask } = dataset;
        const valueArr = value.split('');
        const maskArr = mask.split('');

        for (let maskIndex = 0, valueIndex = 0; maskIndex < maskArr.length && valueIndex < valueArr.length; valueIndex++) {
            const maskChar = maskArr[maskIndex];
            const valueChar = valueArr[valueIndex]

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
        }
    }

    const getMaskedValue = (inputEl) => {
        const { dataset, value } = inputEl;
        const { mask } = dataset;
        const valueArr = value.split('');
        const maskArr = mask.split('');
        const maskedValArr = [];
        let isValid = true;

        for (let maskIndex = 0, valueIndex = 0; maskIndex < maskArr.length && valueIndex < valueArr.length; maskIndex++) {
            const maskChar = maskArr[maskIndex];
            const valueChar = valueArr[valueIndex]

            switch (maskChar) {
                case '_':
                    if (valueChar !== ' ') {
                        maskedValArr.push(valueChar)
                        valueIndex++;
                    } else {
                        isValid = false;
                    }
                    break;
                case '9':
                    if (!isNaN(parseInt(valueChar))) {
                        maskedValArr.push(valueChar);
                        valueIndex++;
                    } else {
                        isValid = false;
                    }
                    break;
                case 'X':
                    if (isLetterRe.test(valueChar)) {
                        maskedValArr.push(valueChar);
                        valueIndex++;
                    } else {
                        isValid = false;
                    }
                    break;
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

    const getMaskForInput = (inputEl) => {
        return inputEl.parentNode.querySelector(`.${this.bemPrefix}__mask`);
    }

    const getFormattedMaskedValue = (maskedValue, selectionStart, selectionEnd) => {
        const preVal = maskedValue.substring(0, selectionStart);
        const postVal = maskedValue.substring(selectionEnd);
        const midVal = maskedValue.substring(selectionStart, selectionEnd);
        const { bemPrefix } = this;

        return `<span class="${bemPrefix}__mask-pre-val">${preVal}</span><span class="${bemPrefix}__mask-mid-val">${midVal}</span><span class="${bemPrefix}__mask-post-val">${postVal}</span>`
    }

    const setMaskValue = (inputEl) => {
        let { selectionStart, selectionEnd } = inputEl;
        const maskEl = getMaskForInput(inputEl);

        const maskedValue = getMaskedValue(inputEl);

        if (maskedValue !== null) {
            const maskedValueHTML = getFormattedMaskedValue(maskedValue, selectionStart, selectionEnd);
            maskEl.innerHTML = maskedValueHTML;
            setPreviousValue(inputEl);
        } else {
            console.log('xxxx');
            inputEl.value = getPreviousValue(inputEl);
            selectionStart = inputEl.dataset[getDatasetAttr('SelectionStart')];
            selectionEnd = inputEl.dataset[getDatasetAttr('SelectionEnd')];
            console.log(`selection: ${selectionStart}, ${selectionEnd}`);
        }

        inputEl.setSelectionRange(selectionStart, selectionEnd);
    }

    const clickEvent = (e) => {
        const { target } = e;

        if (target.classList.contains(inputClass)) {
            const { selectionStart, selectionEnd } = target;
            const maskedValue = getMaskedValue(target);
            const maskedValueHTML = getFormattedMaskedValue(maskedValue, selectionStart, selectionEnd);
            const maskEl = getMaskForInput(target);
            maskEl.innerHTML = maskedValueHTML;
        }
    }

    const inputEvent = (e) => {
        const { target } = e;

        if (target.classList.contains(inputClass)) {
            const maskEl = getMaskForInput(target);
            const { value } = target;

            if (maskEl === null) {
                throw `Missing mask for target: ${target.outerHTML}`
            }

            setMaskValue(target);

        }
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
        return el.dataset[getDatasetAttr('PreVal')];
    }

    const populateMasks = () => {
        const inputEls = document.querySelectorAll(`.${inputClass}`);

        inputEls.forEach((el) => {
            console.log(el.outerHTML);
            setPreviousValue(el, el.value);
            setMaskValue(el);
        })
    }

    const selectEvent = (e) => {
        const { target } = e;

        if (target.classList.contains(inputClass)) {
            console.log('select fired on', target.outerHTML);
            const { selectionStart, selectionEnd } = target;
            target.dataset[getDatasetAttr('SelectionStart')] = selectionStart;
            target.dataset[getDatasetAttr('SelectionEnd')] = selectionEnd;
            clickEvent(e);
        }
    }

    const keypressEvent = (e) => {
        const { target, key } = e;
        const { selectionStart, selectionEnd } = target;
        if (target.classList.contains(inputClass)) {
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


    this.init = () => {
        document.addEventListener('select', selectEvent, true);
        document.addEventListener('input', inputEvent, true);
        document.addEventListener('click', clickEvent, true);
        document.addEventListener('keydown', keypressEvent, true);
        populateMasks();
    }

    this.init();

}

