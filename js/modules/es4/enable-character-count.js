
const enableCharacterCount = new function() {
  let charCountInitEl,
    globalVisualTemplate,
    charCountTemplate,
    globalWarningThreshold,
    announcementTimeout;

  let idIndex = 0;

  this.init = () => { 
    const charCountEls = document.querySelectorAll('[data-has-character-count]');
    charCountInitEl = charCountEls.length > 0 ? charCountEls[0] : null;
    const charCountTemplateEl = document.getElementById('enable-character-count__template');
    const dataset = charCountInitEl ? charCountInitEl.dataset : {};

    charCountTemplate = charCountTemplateEl ? charCountTemplateEl.innerHTML : '<span aria-hidden="true">${visualText}</span>';

    globalVisualTemplate = dataset.visualText || '${numChars}/${maxLength}';
    globalWarningThreshold = dataset.warningThreshold || 20;

    charCountEls.forEach((target) => {
      setUpEventsFor(target);
      setIdIfNullFor(target);
      setUpAriaDescribedByFor(target);
      addLiveRegion(target);
      createCounterFor(target);
      writeCharCount(target);
    });
  }

  function setUpEventsFor(target) {
    target.addEventListener('keyup', onKeyUp);
    target.addEventListener('keydown', onKeyDown);
    target.addEventListener('focus', onFocus);
  }

  function setIdIfNullFor(target) {
    if (target.id == null)
      target.id = `enable-character-counter-${idIndex++}`;
  }

  function setUpAriaDescribedByFor(target) {
    const maxCharacterCount = target.maxLength;
    const readCharacterCountKey = target.dataset.readCharacterCountWithKey;
    const description = `In edit text area with a ${maxCharacterCount} character limit.`;
    const instructions = `Press ${readCharacterCountKey} to find out how many more characters are allowed.`;
    const ariaDescribedByElement = document.createElement('p');
    ariaDescribedByElement.id = `${target.id}-aria-describedby`;
    ariaDescribedByElement.className="sr-only";
    ariaDescribedByElement.textContent = `${description} ${instructions}`;
    target.insertAdjacentElement('afterend', ariaDescribedByElement);
    target.setAttribute('aria-describedby', ariaDescribedByElement.id);
  }

  function createCounterFor(target) {
    const counterEl = document.createElement('output');
    counterEl.id = `${target.id}__counter`;
    counterEl.className = "enable-character-count";
    counterEl.setAttribute('aria-live', 'off')
    target.setAttribute('data-character-count-label', counterEl.id);
    target.insertAdjacentElement('afterend', counterEl);
  }

  function addLiveRegion(target) {
    const liveRegion = document.createElement('div');
    liveRegion.id = `${target.id}-live-region`
    liveRegion.className="sr-only";
    liveRegion.role = 'region';
    liveRegion.ariaLive = 'polite';
    target.insertAdjacentElement('afterend', liveRegion);
    liveRegion.appendChild(createCounterForScreenReader(liveRegion));
  }

  function createCounterForScreenReader(parent) {
    const result = document.createElement('p');
    result.id = `${parent.id}-character-count-status`;
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

  function onKeyUp(event) {
    const { target, key } = event;
    const { dataset } = target;

    if (dataset.hasCharacterCount) {
      const inputLength = target.value.length;
      const { maxLength } = target;
    
      writeCharCount(target);

      if (inputLength > maxLength - globalWarningThreshold && !wasArrowPressed(key)) {
          announceCharacterCountWithDelay(target, 1000);
      }
    }
  }

  function onKeyDown(event) {
    const keyPressed = event.key;
    if (isReadCharacterCountKeyPressed(event, keyPressed) || isReadCharacterCountCtrlAndKeyPressed(event, keyPressed))
      announceCharacterCount(event.target);
  }

  function isReadCharacterCountKeyPressed(event, keyPressed) {
    const readCharacterCountWithKey = event.target.dataset.readCharacterCountWithKey;
    return readCharacterCountWithKey && keyPressed === readCharacterCountWithKey;
  }

  function isReadCharacterCountCtrlAndKeyPressed(event, keyPressed) {
    const readCharacterCountWithCtrlAndKey = event.target.dataset.readCharacterCountWithCtrlAndKey;
    return readCharacterCountWithCtrlAndKey && event.ctrlKey && keyPressed === readCharacterCountWithCtrlAndKey;
  }

  function onFocus(event) {
    const { target } = event;
    const { dataset } = target;
    if (dataset.hasCharacterCount)
      announceCharacterCount(target);
  }

  const writeCharCount = (target) => {
    const { maxLength, dataset, value } = target;
    const { characterCountLabel } = dataset;
    const characterCountLabelEl = document.getElementById(characterCountLabel);
    if (characterCountLabelEl) {
      characterCountLabelEl.innerHTML = getCounterHTML(value.length, parseInt(maxLength));
    }
  }

  function getCounterHTML(numChars, maxLength) {
    const charsRemaining = maxLength - numChars;
    const visualText = interpolate(globalVisualTemplate, { numChars, maxLength, charsRemaining });
    return interpolate(charCountTemplate, { visualText });
  }

  function announceCharacterCount(target) {
    announceCharacterCountWithDelay(target, 150)
  }
  
  function announceCharacterCountWithDelay(target, delay) {
    const counterForScreenReader = getScreenReaderCharacterCount(target);

    if (typeof announcementTimeout === 'number') {
      counterForScreenReader.textContent = '';
      clearTimeout(announcementTimeout);
    }

    announcementTimeout = setTimeout(() => {
      const maxLength = target.maxLength;
      const numChars = target.value.length;
      const charsRemaining = parseInt(maxLength) - numChars;
      const screenReaderText = target.dataset.screenReaderText ?? 'Character Count: ${numChars} out of ${maxLength}. ${charsRemaining} characters remaining.'
      counterForScreenReader.textContent = interpolate(screenReaderText, { numChars, maxLength, charsRemaining });
    }, delay);
  }

  function getScreenReaderCharacterCount(target) {
    const liveRegion = document.getElementById(`${target.id}-live-region`);
    return document.getElementById(`${liveRegion.id}-character-count-status`);
  }
}

