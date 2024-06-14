import { interpolate } from "./interpolate.js";

const enableCharacterCount = new function() {
  let globalWarningThreshold,
    readCountKey,
    announcementTimeout;

  let idIndex = 0;

  this.init = () => { 
    const charCountEls = document.querySelectorAll('[data-has-character-count]');
    const charCountInitEl = charCountEls.length > 0 ? charCountEls[0] : null;
    const dataset = charCountInitEl ? charCountInitEl.dataset : {};

    readCountKey = 'Escape';
    globalWarningThreshold = dataset.warningThreshold || 20;

    charCountEls.forEach((target) => {
      setUpEventsFor(target);
      setIdIfNullFor(target);
      setUpAriaDescribedByFor(target);
      addLiveRegion(target);
      createCounterContainerFor(target);
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
    const describedByContent = `${getScreenReaderDescription(target)} ${getScreenReaderInstructions(target)}`;
    const ariaDescribedByElement = document.createElement('p');
    ariaDescribedByElement.id = `${target.id}-aria-describedby`;
    ariaDescribedByElement.className="sr-only";
    ariaDescribedByElement.textContent = describedByContent;
    target.insertAdjacentElement('afterend', ariaDescribedByElement);
    target.setAttribute('aria-describedby', ariaDescribedByElement.id);
  }

  function getScreenReaderDescription(target) {
    const { maxLength, dataset } = target;
    const description = dataset.description ?? 'In edit text area with a ${maxLength} character limit.';
    return interpolate(description, { maxLength });
  }

  function getScreenReaderInstructions(target) {
    const { readCountKey, instructions } = target.dataset;
    const defaultInstructions = 'Press ${readCountKey} to find out how many more characters are allowed.';
    const instructionsToInterpolate = instructions ?? defaultInstructions;
    return interpolate(instructionsToInterpolate, { readCountKey });
  }

  function createCounterContainerFor(target) {
    const container= document.createElement('div');
    container.id = `${target.id}-counter-container`;
    container.className = "enable-character-count";
    target.setAttribute('data-character-count-container', container.id);
    target.insertAdjacentElement('afterend', container);
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

  function writeCharCount(target) {
    const { dataset } = target;
    const { characterCountContainer } = dataset;
    const container = document.getElementById(characterCountContainer);
    if (container) {
      container.innerHTML = getCounterHTML(target);
    }
  }

  function getCounterHTML(target) {
    const { maxLength, dataset, value } = target;
    const numChars = value.length;
    const charsRemaining = maxLength - numChars;
    const visualTextTemplate = dataset.visualText ?? '${numChars}/${maxLength}';
    const visualText = interpolate(visualTextTemplate, { numChars, maxLength, charsRemaining });
    const counterElementTemplate = document.getElementById('enable-character-count__template');
    const counterElement = counterElementTemplate ?? '<span aria-hidden="true">${visualText}</span>'
    return interpolate(counterElement, { visualText });
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

  function announceCharacterCount(target) {
    announceCharacterCountWithDelay(target, 250)
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
      const charsRemaining = maxLength - numChars;
      const screenReaderText = target.dataset.screenReaderText ?? 'Character Count: ${numChars} out of ${maxLength}. ${charsRemaining} characters remaining.'
      counterForScreenReader.textContent = interpolate(screenReaderText, { numChars, maxLength, charsRemaining });
    }, delay);
  }

  function getScreenReaderCharacterCount(target) {
    const liveRegion = document.getElementById(`${target.id}-live-region`);
    return document.getElementById(`${liveRegion.id}-character-count-status`);
  }
}

export default enableCharacterCount;
