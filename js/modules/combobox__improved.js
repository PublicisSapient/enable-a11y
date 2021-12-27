'use strict'

/*******************************************************************************
* enable-combobox.js - Implementation of the ARIA combobox UI
*
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/combobox.php
*
* Released under the MIT License.
******************************************************************************/

import accessibility from "../accessibility.js";

let enableComboboxes;


// Only run if this is being run client side.
if (typeof window !== 'undefined' && typeof document !== 'undefined') {

  const EnableCombobox = function (componentRoot) {
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
      clearMessage = 'Cleared form field.';

    const spaceRe = /\s+/g,
      kRETURN = "Enter",
      kESC = "Escape",
      kUP = "ArrowUp",
      kDOWN = "ArrowDown",
      firstVisibleOptionSelector = '[role="option"]:not([hidden])',
      chooseEvent = document.createEvent('Event');

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
          updateSelectedOption(so[0]);
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
    }

    function listMouseDownHandler(e) {
      updateSelectedOption(e.target);
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
      accessibility.setMobileFocusLoop(controlsContainer);
      list.hidden = false;
    }

    function hideMenu(message) {
      list.hidden = true;
      field.setAttribute("aria-expanded", "false");
      accessibility.removeMobileFocusLoop();
      updateStatus(message, true);
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

    function updateSelectedOption(el) {
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
    }

    function selectNextOption() {
      const so = shownOptions();
      for (var i = 0, c = so.length; i < c; i++) {
        var o = so[i];
        if (o == selectedOption) {
          if (so[i + 1]) updateSelectedOption(so[i + 1]);
          return;
        }
      }
      // otherwise, select the first option
      if (!selectedOption && so.length) {
        updateSelectedOption(so[0]);
      }
    }

    function selectPreviousOption() {
      const so = shownOptions();
      for (let i = so.length - 1; i > 0; i--) {
        const o = so[i];
        if (o == selectedOption) {
          if (so[i - 1]) updateSelectedOption(so[i - 1]);
          return;
        }
      }
      // otherwise, select the last option
      if (!selectedOption && so.length) {
        updateSelectedOption(so[so.length - 1]);
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
          status.innerHTML = "<span class='sr-only'>Selected " + value + ".</span>";
        })

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
        // if typed string is not substring of state name or code (case insensitive), and is not exact match for state
        if ((t.indexOf(s) == -1 && o.id.indexOf(s) == -1) || t == s) {
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

    this.initCombo = function (componentRoot) {
      // TODO: If time allows, update example to account for multiple comboboxes.
      root = componentRoot;
      field = root.querySelector('[role="combobox"]');
      form = field.form;
      status = root.querySelector('[role="status"]');
      list = document.getElementById(field.getAttribute("aria-owns"));
      options = list.querySelectorAll('[role="option"]');
      listGroups = list.querySelectorAll('.enable-combobox__group');
      resetButton = root.querySelector('.enable-combobox__reset-button');
      controlsContainer = root.querySelector('.enable-combobox__controls-container');

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

      chooseEvent.initEvent('combobox-change', true, true);
      field.addEventListener('combobox-change', (e) => {
        console.log('choose', e);
      })

      // Apply aria-describedby for close button on all the options.
      if (resetAriaDesc) {
        options.forEach((el) => {
          el.setAttribute('aria-describedby', resetAriaDesc);
        });
      }
    };

    this.initCombo(componentRoot);
  };

  enableComboboxes = new function () {
    this.list = [];

    this.init = () => {
      const $roots = document.querySelectorAll('.enable-combobox');

      for (let i = 0; i < $roots.length; i++) {
        this.list.push(new EnableCombobox($roots[i]));
      }
    }
  }

  enableComboboxes.init();

}

if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
  module.exports = (enableComboboxes || new function () { });
}

export default enableComboboxes;
