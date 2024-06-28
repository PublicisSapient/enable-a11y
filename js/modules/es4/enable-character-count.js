
const enableCharacterCount = new function() {
  'use strict';

  const defaultReadCharacterCountKey = 'Escape';
  let announcementTimeout;
  let idIndex = 0;

  this.init = () => { 
    const charCountEls = document.querySelectorAll("[data-has-character-count='true']");
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
    if (!target.id) {
      target.id = `enable-character-counter-${idIndex++}`;
    }
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
    const keyToPress = readCountKey ?? defaultReadCharacterCountKey;
    const instructionsToInterpolate = instructions ?? 'Press ${keyToPress} to find out how many more characters are allowed.';
    return interpolate(instructionsToInterpolate, { keyToPress });
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
    const liveRegionId = `${target.id}-live-region`;
    liveRegion.id = liveRegionId;
    liveRegion.className="sr-only";
    liveRegion.role = 'region';
    liveRegion.ariaLive = 'polite';
    liveRegion.ariaLabel = `${liveRegionId}-aria-label`;
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
    writeCharCount(target);
    if (isReadCharacterCountKeyPressed(key, dataset.readCountKey)) {
      announceCharacterCount(target);
    }
    if (isWithinWarningThreshold(target) && !wasArrowPressed(key)) {
      announceCharacterCountWithDelay(target, 1000);
    }
  }

  function isWithinWarningThreshold(target) {
    const { dataset, maxLength } = target;
    const inputLength = target.value.length;
    const warningThreshold = dataset.warningThreshold ?? 20;
    return inputLength > (maxLength - warningThreshold);
  }

  function onKeyDown(event) {
    const { target, key } = event;
    const { dataset } = target;
    if (isReadCharacterCountKeyPressed(key, dataset.readCountKey)) {
      getScreenReaderCharacterCount(target).textContent = '';
    }
  }

  function isReadCharacterCountKeyPressed(keyPressed, readCountKey) {
    if (readCountKey)
      return keyPressed === readCountKey;
    return keyPressed === defaultReadCharacterCountKey;
  }

  function onFocus(event) {
    const { target } = event;
    announceCharacterCount(target);
  }

  function announceCharacterCount(target) {
    announceCharacterCountWithDelay(target, 200);
  }

  function announceCharacterCountWithDelay(target, delay) {
    if (typeof announcementTimeout === 'number') {
      clearTimeout(announcementTimeout);
    }
    announcementTimeout = setTimeout(() => {
      setContentsForScreenReader(target)
    }, delay);
  }

  function setContentsForScreenReader(target) {
    const maxLength = target.maxLength;
    const numChars = target.value.length;
    const charsRemaining = maxLength - numChars;
    const characterCountText = target.dataset.characterCountText ?? 'Character Count: ${numChars} out of ${maxLength}. ${charsRemaining} characters remaining.'
    const counterForScreenReader = getScreenReaderCharacterCount(target);
    counterForScreenReader.textContent = interpolate(characterCountText, { numChars, maxLength, charsRemaining });
  }

  function getScreenReaderCharacterCount(target) {
    const liveRegion = document.getElementById(`${target.id}-live-region`);
    return document.getElementById(`${liveRegion.id}-character-count-status`);
  }
})