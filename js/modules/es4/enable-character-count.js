const enableCharacterCount = new (function() {
  'use strict';

  const defaultReadCharacterCountKey = 'Escape';
  let announcementTimeout;
  let idIndex = 0;

  this.init = () => { 
    const charCountEls = document.querySelectorAll("[data-has-character-count='true']");
    charCountEls.forEach((target) => {
      setUpEventListeners(target);
      setIdIfNull(target);
      setUpAriaDescribedBy(target);
      addLiveRegion(target);
      createCounterContainer(target);
      writeCharCount(target);
    });
  }

  function setUpEventListeners(target) {
    target.addEventListener('keyup', onKeyUp);
    target.addEventListener('focus', onFocus);
    target.addEventListener('focusout', onFocusOut);
  }

  function setIdIfNull(target) {
    if (!target.id) {
      target.id = `enable-character-counter-${idIndex++}`;
    }
  }

  function setUpAriaDescribedBy(target) {
    const ariaDescribedByElement = document.createElement('p');
    ariaDescribedByElement.id = `${target.id}-aria-describedby`;
    ariaDescribedByElement.className="sr-only";
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

  function createCounterContainer(target) {
    const container= document.createElement('div');
    container.id = `${target.id}-counter-container`;
    container.className = "enable-character-count";
    container.ariaHidden = 'true';
    target.setAttribute('data-character-count-container', container.id);
    target.insertAdjacentElement('afterend', container);
  }

  function addLiveRegion(target) {
    const liveRegion = document.createElement('div');
    const liveRegionId = `${target.id}-live-region`;
    liveRegion.id = liveRegionId;
    liveRegion.className="sr-only";
    liveRegion.role = 'alert';
    liveRegion.ariaLive = 'polite';
    target.insertAdjacentElement('afterend', liveRegion);
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
    const counterElement = counterElementTemplate ?? '<span>${visualText}</span>'
    return interpolate(counterElement, { visualText });
  }

  function onKeyUp(event) {
    const { target, key } = event;
    const { dataset } = target;
    writeCharCount(target);

    const isAlphaKeyPressed = !isModifierPressed(key) && !isWhitespacePressed(key) && !isNavigationPressed(key);
    if (isReadCharacterCountKeyPressed(key, dataset.readCountKey)) {
      announceCharacterCount(target);
    } else if (isWithinWarningThreshold(target) && isAlphaKeyPressed) {
      announceCharacterCountWithDelay(target, 1000);
    }
  }

  function isWithinWarningThreshold(target) {
    const { dataset, maxLength } = target;
    const inputLength = target.value.length;
    const warningThreshold = dataset.warningThreshold ?? 20;
    return inputLength > (maxLength - warningThreshold);
  }

  function isModifierPressed(key) {
    return key === 'Alt' || key === 'Shift' || key === 'Meta'
  }

  function isWhitespacePressed(key) {
    return key === 'Tab' || key === 'Enter'
  }

  function isNavigationPressed(key) {
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

  function isReadCharacterCountKeyPressed(keyPressed, readCountKey) {
    if (readCountKey)
      return keyPressed === readCountKey;
    return keyPressed === defaultReadCharacterCountKey;
  }

  function onFocus(event) {
    const { target } = event;
    setAriaDescribedBy(target);
    announceCharacterCount(target);
  }

  function onFocusOut(event) {
    const { target } = event;
    removeAriaDescribedBy(target);
    removeLiveRegion(target);
  }

  function setAriaDescribedBy(target) {
    const describedBy = getAriaDescribedBy(target);
    if (describedBy) {
      describedBy.textContent = `${getScreenReaderDescription(target)} ${getScreenReaderInstructions(target)}`;
    }
  }

  function removeAriaDescribedBy(target) {
    const describedby = getAriaDescribedBy(target);
    if (describedby) {
      describedby.textContent = '';
    }
  }

  function getAriaDescribedBy(target) {
    return document.getElementById(`${target.id}-aria-describedby`);
  }

  function removeLiveRegion(target) {
      const liveRegion = getLiveRegion(target)
      if (liveRegion) {
          liveRegion.textContent = '';
      }
  }

  function announceCharacterCountWithDelay(target, delay) {
    if (typeof announcementTimeout === 'number') {
      clearTimeout(announcementTimeout);
    }
    announcementTimeout = setTimeout(() => {
      announceCharacterCount(target)
    }, delay);
  }

  function announceCharacterCount(target) {
    const liveRegion = getLiveRegion(target);
    if (liveRegion.textContent.endsWith('!')) {
      liveRegion.textContent = getTextToRead(target);
    } else {
      liveRegion.textContent = `${getTextToRead(target)}!`;
    }
  }

  function getLiveRegion(target) {
    return document.getElementById(`${target.id}-live-region`);
  }

  function getTextToRead(target) {
    const maxLength = target.maxLength;
    const numChars = target.value.length;
    const charsRemaining = maxLength - numChars;
    const characterCountText = target.dataset.characterCountText ?? 'Character Count: ${numChars} out of ${maxLength}. ${charsRemaining} characters remaining.'
    return interpolate(characterCountText, { numChars, maxLength, charsRemaining });
  }
})
