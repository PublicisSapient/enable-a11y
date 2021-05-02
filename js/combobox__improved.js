const EnableCombobox = function (componentRoot) {
  let root = null,
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
    isMobileKeyboard = true,
    clearMessage = 'Cleared form field.';

  const spaceRe = /\s+/g,
    kRETURN = "Enter",
    kESC = "Escape",
    kUP = "ArrowUp",
    kDOWN = "ArrowDown",
    kTAB = "Tab",
    kANDROIDKEYCODE = 229,
    firstVisibleOptionSelector = '[role="option"]:not([hidden])';

  function docKeyDownHandler(e) {
    // if a key is pressed at the document level, we are assuming
    // is not a mobile device
    if (e.key === kTAB)  {
      isMobileKeyboard = false;
    } else if (e.keyCode === kANDROIDKEYCODE) {
      isMobileKeyboard = true;
    }
  }

  function submitHandler(e) {
    updateMenuDisplay();
    e.preventDefault();
  };

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
  };

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
  };

  function handleEscape(e) {
    e.preventDefault();
    clearField();
  };

  function handleUpArrow(e) {
    e.preventDefault();
    selectPreviousOption();
  };

  function handleDownArrow(e) {
    e.preventDefault();
    selectNextOption();
  };

  function handleReturn(e) {
    e.preventDefault();
    insertValue();
    focusOnFirstOption();
  };

  function focusOnFirstOption() {
    const validOptions = list.querySelectorAll(firstVisibleOptionSelector);
    const so = shownOptions();
    if (validOptions.length > 0) {
      const option = validOptions[0];

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


  function focusHandler(e) {
    if (field.value) {
      updateMenuDisplay();
    } else {
      hideMenu();
    }
  };

  function listMouseDownHandler(e) {
    updateSelectedOption(e.target);
    e.target.focus();
    insertValue();
  }

  function listClickHandler(e) {

    if (e.target.getAttribute('role').toLowerCase() === "option") {
      listMouseDownHandler(e);
    }
  };

  function containerBlurHandler(e) {
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
  };

  function showMenu() {
    accessibility.setMobileFocusLoop(controlsContainer);
    list.hidden = false;
  }

  function hideMenu(message) {
    list.hidden = true;
    field.setAttribute("aria-expanded", "false");
    accessibility.removeMobileFocusLoop();
    updateStatus(message);
  };

  function clearField() {
    if (field.value) {
      field.value = "";
    } else if (field.textContent) {
      field.textContent = "";
    }
    clearSelectedOption(clearMessage);
    field.focus();
  };

  function clearSelectedOption(statusMessage) {
    if (selectedOption) {
      field.removeAttribute("aria-activedescendant");
      list.removeAttribute("data-selection");
      selectedOption.removeAttribute("aria-selected");
    }
    selectedOption = null;
    hideMenu(statusMessage);
  };

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
  };

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
  };

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
  };

  function shownOptions() {
    return list.querySelectorAll(firstVisibleOptionSelector);
  };

  function updateStatus(message) {
    let statusContent = message || "";

    itemCount = shownOptions().length;

    if (!list.hidden && itemCount) {
      if (itemCount === 1) {
        statusContent = "%@ item".replace("%@", itemCount);
      } else {
        statusContent = "%@ items".replace("%@", itemCount);
      }
      statusContent +=
        ". <span class='visually-hidden'>" +
        ariaDescriptionEl.innerText +
        "</span>";
    }

    status.innerHTML = statusContent;
  };

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
        status.innerHTML="Selected " + value + ".";
      })
    }
  };

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
    for (let i=0; i<listGroups.length; i++) {
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
  };

  function initCombo(componentRoot) {
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
    for (var i=0; i<options.length; i++) {
        var option = options[i];
        var optionNum = i+1;
        option.setAttribute('id', field.id + '__field-' + optionNum);
    }
  };

  initCombo(componentRoot);
};

const enableComboboxes = new function() {
  this.list=[];
  
  this.init = (e) => {
    const $roots = document.querySelectorAll('.enable-combobox');

    for (let i=0; i<$roots.length; i++) {
      this.list.push(new EnableCombobox($roots[i]));
    }
  }
}

enableComboboxes.init();
