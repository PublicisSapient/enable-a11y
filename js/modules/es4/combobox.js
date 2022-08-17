'use strict'

/*******************************************************************************
 * enable-combobox.js - Implementation of the ARIA combobox UI
 *
 * Script based on combobox example on the Webkit Blog:
 * https://webkit.org/blog-files/aria1.0/combobox_with_live_region_status.html
 * 
 * Refactored by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 27, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/combobox.php
 *
 * Released under the MIT License.
 ******************************************************************************/



const EnableCombobox = function(componentRoot) {
  let root = null,
    form = null,
    field = null,
    status = null,
    list = null,
    options = null,
    selectedOption = null,
    hideAll = false,
    itemCount = -1,
    visibleOptions,
    controlsContainer = null,
    ariaDescriptionEl = null,
    resetButton,
    listGroups = [],
    clearMessage = 'Cleared form field.',
    groups,
    groupAlert,
    labelEl,
    groupSelectAlertTemplateStr;

  const spaceRe = /\s+/g,
    kRETURN = "Enter",
    kESC = "Escape",
    kUP = "ArrowUp",
    kDOWN = "ArrowDown",
    firstVisibleOptionSelector = '[role="option"]:not([hidden])',
    chooseEvent = new CustomEvent('enable-combobox-change', {
      bubbles: true,
      detail: {
        value: () => field && field.value
      }
    });

  function submitHandler(e) {
    updateMenuDisplay();
    e.preventDefault();
  }

  function keyUpHandler(e) {
    switch (e.key) {
      case kRETURN:
        return;
      case kESC:
        handleEscape(e);
        break;
      case kUP:
        return;
      case kDOWN:
        return;
    }
    updateMenuDisplay();
    
  }

  function keyDownHandler(e) {
    switch (e.key) {
      case kRETURN:
        handleReturn(e);
        break; // Catch Return on keyDown, b/c keyUp fires after submit.
      case kUP:
        handleUpArrow(e);
        break;
      case kDOWN:
        handleDownArrow(e);
        break;
    }
  }

  function handleEscape(e) {
    e.preventDefault();
    clearField();
  }

  function handleUpArrow(e) {
    e.preventDefault();
    selectPreviousOption();
  }

  function handleDownArrow(e) {
    e.preventDefault();
    selectNextOption();
  }

  function handleReturn(e) {
    e.preventDefault();
    if (e.target === resetButton) {
      handleEscape(e);
    } else {
      insertValue();
      focusOnFirstOption();
    }
  }

  function focusOnFirstOption() {
    const validOptions = list.querySelectorAll(firstVisibleOptionSelector);
    const so = shownOptions();
    if (validOptions.length > 0) {
      // We can't just focus on the option, since iOS will refocus back
      // to the input field.  In order to work around this, we must
      // blur the field (which will get rid of the virtual keyboard)
      // and then focus the option after 1200 ms.
      field.blur();
      setTimeout(() => {
        updateSelectedOption(so, 0);
      }, 1200);
    } else {
      field.blur();
    }
  }


  function focusHandler() {
    if (field.value) {
      updateMenuDisplay();
    } else {
      hideMenu();
    }

    // ensure this doesn't result is a page zoom in iOS
    resetPageZoom();
  }

  const resetPageZoom = () => {
    const viewportmeta = document.querySelector('meta[name=viewport]');
    if (viewportmeta) {
      accessibility.resetZoom();
    }
  }

  function listMouseDownHandler(e) {
    const { target } = e;
    const so = shownOptions();
    let index = -1;
    for (var i = 0, c = so.length; i < c; i++) {
      var o = so[i];
      if (o === target) {
        index = i;
        break;
      }
    }

    if (index === -1) {
      console.error('Mouse chose option not in list', target);
      throw "Error in listMouseDownHandler";
    }

    updateSelectedOption(shownOptions(), index);
    e.target.focus();
    insertValue();
    field.dispatchEvent(chooseEvent);
  }

  function listClickHandler(e) {
    if (e.target.getAttribute('role').toLowerCase() === "option") {
      listMouseDownHandler(e);
    }
  }

  function containerBlurHandler() {
    requestAnimationFrame(() => {
      const { activeElement, body } = document;

      // we want to hide the menu if the user blurs outside of the container.
      // we don't want to hide the menu if focus is on the <body> tag.  This is
      // because when we the user hits the ENTER key, focus goes to the <body> tag
      // because we programmatically use el.blur().

      if (activeElement !== body && !controlsContainer.contains(activeElement)) {
        hideMenu();
      }
    })

  }

  function updateMenuDisplay() {
    filter();
    if (hideAll) {
      hideMenu();
    } else {
      showMenu();
    }
    field.setAttribute("aria-expanded", hideAll ? "false" : "true");
    updateStatus();
  }

  function showMenu() {
    if (!list.hidden) {
      return;
    }

    if (!enableComboboxes.isKeyboardUser) {
      console.log('setting loop');
      accessibility.setMobileFocusLoop(controlsContainer);
    }
    
    list.hidden = false;
    field.dispatchEvent(
      new CustomEvent(
        'enable-combobox-show',
        {
          'bubbles': true
        }
      )
    );
  }

  function displayNone(elem) {
    elem.style.display = 'none';
  }

  function removeDisplayNone(elem) {
    elem.style.display = 'block';
  }

  function hideMenu(message) {
    if (list.hidden) {
      return;
    }
    list.hidden = true;
    field.setAttribute("aria-expanded", "false");

    // Chrome Desktop has a bug regarding aria-hidden on surrounding
    // DOM elements, so we will only implement the mobile focus loop
    // for keyboard users.
    if (!enableComboboxes.isKeyboardUser) {
      accessibility.removeMobileFocusLoop();
      requestAnimationFrame(() => {
        // executing here due to a bug in VoiceOver iOS
        accessibility.removeMobileFocusLoop();
      });
    }

    updateStatus(message, true);
    field.dispatchEvent(
      new CustomEvent(
        'enable-combobox-hide',
        {
          'bubbles': true
        }
      )
    );
  }

  function clearField() {
    if (field.value) {
      field.value = "";
    } else if (field.textContent) {
      field.textContent = "";
    }
    clearSelectedOption(clearMessage);
    field.focus();
  }

  function clearSelectedOption(statusMessage) {
    if (selectedOption) {
      field.removeAttribute("aria-activedescendant");
      list.removeAttribute("data-selection");
      selectedOption.removeAttribute("aria-selected");
    }
    selectedOption = null;
    hideMenu(statusMessage);
  }

  function updateSelectedOption(so, index) {
    const el = so[index];
    
    if (!el) {
      return;
    }

    if (selectedOption) {
      selectedOption.removeAttribute("aria-selected");
    }

    selectedOption = el;
    list.setAttribute("data-selection", el.id);
    el.setAttribute("aria-selected", "true");
    field.setAttribute("aria-activedescendant", el.id);

    selectedOption.focus();
    

    if (groups.length > 0) {
      // we need to announce the group and option using ARIA live.
      try {
        const groupEl = el.closest('[role="group"]');
        const descId = groupEl.getAttribute('aria-describedby');
        const descEl = document.getElementById(descId);
        const desc = descEl.innerText;
        const value = el.innerText;
        const label = labelEl.innerText;
        groupAlert.innerHTML = interpolate(
          groupSelectAlertTemplateStr,
          {
            value: value,
            desc: desc,
            label: label,
            index: index + 1,
            length: so.length
          }
        );
      } catch (ex) {
        console.error(`Option ${el.innerText} is not in a proper group`);
      }
    }
  }

  function selectNextOption() {
    const so = shownOptions();
    for (var i = 0, c = so.length; i < c; i++) {
      var o = so[i];
      if (o == selectedOption) {
        if (so[i + 1]) updateSelectedOption(so, i + 1);
        return;
      }
    }
    // otherwise, select the first option
    if (!selectedOption && so.length) {
      updateSelectedOption(so, 0);
    }
  }

  function selectPreviousOption() {
    const so = shownOptions();
    for (let i = so.length - 1; i > 0; i--) {
      const o = so[i];
      if (o == selectedOption) {
        if (so[i - 1]) updateSelectedOption(so, i - 1);
        return;
      }
    }
    // otherwise, select the last option
    if (!selectedOption && so.length) {
      updateSelectedOption(so, so.length - 1);
    }
  }

  function shownOptions() {
    return list.querySelectorAll(firstVisibleOptionSelector);
  }

  function updateStatus(message, isHidden) {
    let statusContent = message || "";

    if (isHidden) {
      statusContent = '<span class="sr-only">' + message + '<span>';
    }

    itemCount = shownOptions().length;

    if (!list.hidden && itemCount) {
      if (itemCount === 1) {
        statusContent = "%@ item".replace("%@", itemCount);
      } else {
        statusContent = "%@ items".replace("%@", itemCount);
      }
      statusContent +=
        ". <span class='sr-only'>" +
        ariaDescriptionEl.innerText +
        "</span>";
    }

    status.innerHTML = statusContent;
  }

  function insertValue() {
    const value = (selectedOption && selectedOption.textContent) ? selectedOption.textContent.trim().replace(spaceRe, ' ') : null;
    if (selectedOption) {
      if (field.value) {
        field.value = value;
      } else if (field.textContent) {
        field.textContent = value;
      }
      clearSelectedOption();
      requestAnimationFrame(() => {
        resetButton.focus();
        status.innerHTML = `<span class='sr-only'>Selected ${value}.</span>`;
      })

      // hideMenu();
      // fire the `onchange` event.
      field.dispatchEvent(chooseEvent);
    }
  }

  function filter() {
    const s = (field.value || field.textContent).toUpperCase();
    hideAll = true;
    if (s == "") return;
    visibleOptions = [];
    for (let i = 0, c = options.length; i < c; i++) {
      const o = options[i];
      const t = o.textContent.toUpperCase();
      // If typed string is not substring of state name or code (case insensitive).
      // (The original code also removed if there was an exact match for state, but
      // we didn't think that made sense).
      if ((t.indexOf(s) == -1 && o.id.indexOf(s) == -1)) {
        o.hidden = true;
      } else {
        o.hidden = false;
        o.tabIndex = -1;
        hideAll = false;
        visibleOptions.push(o.textContent);
      }
    }

    // remove headers if there are no elements in a group
    for (let i = 0; i < listGroups.length; i++) {
      const group = listGroups[i];
      const visibleValues = group.querySelectorAll(firstVisibleOptionSelector);
      if (visibleValues.length === 0) {
        group.hidden = true;
      } else {
        group.hidden = false;
      }
    }

    // if there are no options visible after filtering, hide the menu.
    // otherwise, show the menu.
    if (list.querySelector(firstVisibleOptionSelector)) {
      showMenu();
    } else {
      hideMenu();
    }
    clearSelectedOption();
  }

  this.initCombo = function(componentRoot) {
    const groupSelectAlertTemplate = document.getElementById('enable_combobox__group-select-alert-template');

    // TODO: If time allows, update example to account for multiple comboboxes.
    root = componentRoot;
    field = root.querySelector('[role="combobox"]');
    form = field.form;
    status = root.querySelector('[role="alert"]');
    list = document.getElementById(field.getAttribute("aria-owns"));
    options = list.querySelectorAll('[role="option"]');
    listGroups = list.querySelectorAll('.enable-combobox__group'); // xxxxxx
    resetButton = root.querySelector('.enable-combobox__reset-button');
    controlsContainer = root.querySelector('.enable-combobox__controls-container');
    groups = root.querySelectorAll('[role="listbox"] [role="group"]');
    groupAlert = root.querySelector('.enable-combobox__category-alert');
    labelEl = root.querySelector('label');

    if (groups.length > 0 && !groupAlert) {
      console.error('Grouped listbox does not have an alert. Treating as a non-grouped listbox.', root.querySelector('[role="listbox"] [role="group"]'));
      groups = false;
    }

    if (groupSelectAlertTemplate) {
      groupSelectAlertTemplateStr = groupSelectAlertTemplate.innerHTML.trim();
    } else {
      console.info('Group template not in DOM. Default to English');
      groupSelectAlertTemplateStr = '${value}, Group ${desc}, ${label}, selected, item ${index} of ${length}';
    }

    const resetAriaDesc = resetButton.getAttribute('aria-describedby');

    // Events
    form.addEventListener("submit", submitHandler); // Search on iOS "Go" button.

    controlsContainer.addEventListener("keyup", keyUpHandler, true);
    controlsContainer.addEventListener("keydown", keyDownHandler, true);

    field.addEventListener("focus", focusHandler);

    list.addEventListener("mousedown", listMouseDownHandler);
    list.addEventListener("click", listClickHandler);

    resetButton.addEventListener("click", handleEscape);
    controlsContainer.addEventListener("blur", containerBlurHandler, true);

    // get aria-describedby element;
    var ariaDescribedBy = field.getAttribute('aria-describedby');
    ariaDescriptionEl = ariaDescribedBy ? document.getElementById(ariaDescribedBy) : null;

    // put ids on all the options
    for (var i = 0; i < options.length; i++) {
      var option = options[i];
      var optionNum = i + 1;
      option.setAttribute('id', field.id + '__field-' + optionNum);
    }

    // Apply aria-describedby for close button on all the options.
    if (resetAriaDesc) {
      options.forEach((el) => {
        el.setAttribute('aria-describedby', resetAriaDesc);
      });
    }

  };

  this.initCombo(componentRoot);
};

const enableComboboxes = new function() {
  this.isKeyboardUser = false;

  this.list = [];

  const keyUpEvent = (e) => {
    const { key } = e;
    if (key === 'Tab') {
      // we assume this is a keyboard user
      this.isKeyboardUser = true;
      document.removeEventListener('keyup', keyUpEvent);
    }
  }

  this.add = ($el) => {
    this.list.push(new EnableCombobox($el))
  }

  this.init = () => {
    const $roots = document.querySelectorAll('.enable-combobox');

    for (let i = 0; i < $roots.length; i++) {
      this.add($roots[i]);
    }

    document.addEventListener('keyup', keyUpEvent);
  }
}


