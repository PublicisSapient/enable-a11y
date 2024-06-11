import { interpolate } from "./interpolate.js";

const enableCharacterCount = new function() {
  let charCountInitEl,
    globalScreenReaderTemplate,
    globalVisualTemplate,
    globalCounterInstructions,
    charCountTemplate,
    counterForScreenReader,
    counterInstructionsForScreenReader,
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

    charCountInitEl.addEventListener('keyup', this.onKeyUp, true);
    charCountInitEl.addEventListener('focus', this.onFocus, true);
    charCountInitEl.addEventListener('focusout', onFocusOut)

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
      target.setAttribute('aria-describedby', `${desc} character-count__desc`.trim());

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
    const counterEl = document.createElement('output');
    const targetId = target.id || getNewId();
    counterEl.className = "enable-character-count";
    counterEl.id = `${targetId}__counter`;
    counterEl.setAttribute('aria-live', 'off')
    target.setAttribute('data-character-count-label', counterEl.id);

    // adds the character counter to the textarea's aria-describedby
    target.setAttribute('aria-describedby', `${ariaDescBy} ${counterEl.id}`)
    
    if (ariaDescByEl) {
      ariaDescByEl.insertAdjacentElement('afterend', counterEl);
    } else {
      target.insertAdjacentElement('afterend', counterEl);
    }

  }

  function addLiveRegion() {
    const lastBodyEl = document.body.lastElementChild;

    const asideEl = document.createElement('aside');
    asideEl.setAttribute('id', 'enable-character-count__global');
    asideEl.className="sr-only";
    lastBodyEl.insertAdjacentElement('afterend', asideEl);

    // <output> causes VoiceOver to speak the character count twice.
    // Using <div> as an aria-live region resolves this issue.
    counterForScreenReader = createCounterForScreenReader()
    asideEl.appendChild(counterForScreenReader);
    counterInstructionsForScreenReader = createCounterInstructionsForScreenReader()
    counterForScreenReader.insertAdjacentElement('afterend', counterInstructionsForScreenReader);
  }

  function createCounterForScreenReader() {
      const result = document.createElement('div');
      result.className = 'sr-only';
      result.id = 'character-count__status';
      result.role = 'region';
      result.ariaLive = 'polite';
      return result;
  }

  function createCounterInstructionsForScreenReader() {
      const result = document.createElement('div');
      result.className = 'sr-only';
      result.id = 'character-count__instructions';
      result.role = 'region';
      result.ariaLive = 'polite';
      return result;
  }

  function wasArrowPressed(key) {
    switch(key) {
      case 'ArrowUp':
      case 'ArrowDown':
      case 'ArrowLeft':
      case 'ArrowRight':
        return true;
      default:
        return false;
    }
  }

  this.onKeyUp = (e) => {
    const { target, key } = e;
    const { dataset } = target;

    if (dataset.hasCharacterCount) {
      const inputLength = target.value.length;
      const { maxLength } = target;

      timeout && clearTimeout(timeout);


    
      writeCharCount(target);

      if (inputLength > maxLength - globalWarningThreshold && !wasArrowPressed(key)) {
        timeout = setTimeout(() => {
          announceCharCount(target);
        }, 1000);
      }


    }
  }

  this.onFocus = (e) => {
    const { target } = e;
    const { dataset } = target;

    if (dataset.hasCharacterCount) {
      announceCharCount(target);
    }
    announceInstructions();
  }

  function onFocusOut(event) {
    counterInstructionsForScreenReader.innerHTML = '';
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
      counterForScreenReader.innerHTML = interpolate(screenReaderTemplate, { numChars, maxLength, charsRemaining });
    }
  }

  function announceInstructions() {
    counterInstructionsForScreenReader.innerHTML = globalCounterInstructions;
  }
}

export default enableCharacterCount;
