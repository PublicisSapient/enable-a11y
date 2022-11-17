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

    document.body.addEventListener('keyup', this.onKeyUp, true);
    document.body.addEventListener('focus', this.onFocus, true);

    addLiveRegion();

    charCountEls.forEach((target, i) => {
      setAriaDesc(target);
      createCounterFor(target);
      writeCharCount(target);
    });
  }

  function setAriaDesc(target) {
    const { dataset } = target;

    if (dataset.announceAfterEscape === 'true') {
      const desc = target.getAttribute('aria-describedby') || '';
      console.log('setting desc', target, desc);
      target.setAttribute('aria-describedby', `${desc} character-count__desc`.trim())
    }
  }

  function getNewId() {
    const id = `enable-character-counter-${idIndex}`;
    id++;
  }

  function getCounterHTML(target, numChars, maxLength) {
    const charsRemaining = maxLength - numChars;
    const { dataset } = target;
    const screenReaderTemplate = dataset.screenReaderTemplate || globalScreenReaderTemplate;
    const visualTemplate = dataset.visualTemplate || globalVisualTemplate;
    const screenReaderText = interpolate(screenReaderTemplate, { numChars, maxLength, charsRemaining });
    const visualText = interpolate(visualTemplate, { numChars, maxLength, charsRemaining });
    const screenReaderCount = interpolate(charCountTemplate, { screenReaderText, visualText });

    return screenReaderCount;
  }

  function createCounterFor(target) {
    let ariaDescBy = target.getAttribute('aria-describedby');
    ariaDescBy = ariaDescBy ? ariaDescBy.replace('character-count__desc', '') : '';
    ariaDescBy = ariaDescBy.split(/\s+/)[0];

    const ariaDescByEl = ariaDescBy && document.getElementById(ariaDescBy);
    console.log('desc', ariaDescBy, ariaDescByEl);
    const counterEl = document.createElement('output');
    const targetId = target.id || getNewId();
    counterEl.className = "enable-character-count";
    counterEl.id = `${targetId}__counter`;
    counterEl.setAttribute('aria-live', 'off')
    target.setAttribute('data-character-count-label', counterEl.id);
    
    if (ariaDescByEl) {
      ariaDescByEl.insertAdjacentElement('afterend', counterEl);
    } else {
      target.insertAdjacentElement('afterend', counterEl);
    }

    console.log(counterEl.parentNode);
  }

  function addLiveRegion() {
    const lastBodyEl = document.body.lastElementChild;

    const asideEl = document.createElement('aside');
    asideEl.setAttribute('id', 'enable-character-count__global')

    liveRegion = document.createElement('output');
    liveRegion.className = 'sr-only';
    liveRegion.id = 'character-count__status';
    /* liveRegion.setAttribute('role', 'status');
    liveRegion.setAttribute('aria-live', 'polite'); */
    lastBodyEl.insertAdjacentElement('afterend', asideEl);
    asideEl.appendChild(liveRegion);
    liveRegion.insertAdjacentHTML('afterend', `<span id="character-count__desc" class="sr-only">${globalCounterInstructions}</span>`);
  }

  this.onKeyUp = (e) => {
    const { target, key } = e;
    const { dataset } = target;

    if (dataset.hasCharacterCount) {
      const inputLength = target.value.length;
      const { maxLength } = target;

      timeout && clearTimeout(timeout);

      switch (key) {
        case 'Escape':
          if (dataset.announceAfterEscape) {
            e.stopPropagation();
            announceCharCount(target);
          }
          break;
        default:
          writeCharCount(target);
          liveRegion.innerHTML = '';

          if (inputLength > maxLength - globalWarningThreshold || (inputLength % 5) === 0 || (dataset.announceAfterSpace === 'true' && key === ' ')) {
            timeout = setTimeout(() => {
              announceCharCount(target);
            }, 1500);
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
      characterCountLabelEl.innerHTML = getCounterHTML(target, value.length, parseInt(maxLength));
    }
  }

  const announceCharCount = (target) => {
    const { maxLength, dataset } = target;
    const screenReaderTemplate = dataset.screenReaderTemplate || globalScreenReaderTemplate;
    const numChars = target.value.length;
    if (maxLength) {
      const charsRemaining = parseInt(maxLength) - numChars;
      liveRegion.innerHTML = '';
      liveRegion.innerHTML = interpolate(screenReaderTemplate, { numChars, maxLength, charsRemaining });
      
    }
  }
}

enableCharacterCount.init();