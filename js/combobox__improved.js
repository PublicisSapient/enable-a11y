var initComboBoxes = (function () {
  var field = null,
    status = null,
    list = null,
    options = null,
    selectedOption = null,
    hideAll = false,
    kRETURN = 13,
    kESC = 27,
    kUP = 38,
    kDOWN = 40,
    itemCount = -1,
    visibleOptions,
    assertiveLiveRegion,
    ariaDescriptionEl = null,
    isMac = navigator.platform.toUpperCase().indexOf('MAC')>=0;

  var submitHandler = function (e) {
    updateMenuDisplay();
    e.preventDefault();
  };

  var keyUpHandler = function (e) {
    switch (e.keyCode) {
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

  var keyDownHandler = function (e) {
    switch (e.keyCode) {
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

  var handleEscape = function (e) {
    e.preventDefault();
    clearField();
  };

  var handleUpArrow = function (e) {
    selectPreviousOption();
    e.preventDefault();
  };

  var handleDownArrow = function (e) {
    selectNextOption();
    e.preventDefault();
  };

  var handleReturn = function (e) {
    insertValue();
    e.preventDefault();
  };

  var blurHandler = function (e) {
    hideMenu();
  };

  var focusHandler = function (e) {
    if (field.value) {
      updateMenuDisplay();
    } else {
      hideMenu();
    }
  };

  var mouseDownHandler = function (e) {
    if (e.target.tagName.toLowerCase() === "li") {
      updateSelectedOption(e.target);
      field.focus();
      insertValue();
    }
  };

  var updateMenuDisplay = function () {
    filter();
    list.hidden = hideAll ? true : false;
    field.setAttribute("aria-expanded", hideAll ? "false" : "true");
    updateStatus();
  };

  var hideMenu = function () {
    list.hidden = true;
    field.setAttribute("aria-expanded", "false");
    updateStatus();
  };

  var clearField = function () {
    if (field.value) field.value = "";
    else if (field.textContent) field.textContent = "";
    clearSelectedOption();
  };

  var clearSelectedOption = function () {
    if (selectedOption) {
      field.removeAttribute("aria-activedescendant");
      list.removeAttribute("data-selection");
      selectedOption.removeAttribute("aria-selected");
    }
    selectedOption = null;
    hideMenu();
  };

  var updateSelectedOption = function (el) {
    if (!el) {
      return;
    }
    if (selectedOption) selectedOption.removeAttribute("aria-selected");
    selectedOption = el;
    list.setAttribute("data-selection", el.id);
    el.setAttribute("aria-selected", "true");
    field.setAttribute("aria-activedescendant", el.id);


    if (isMac) {
        var elNum = visibleOptions.indexOf(el.innerText) + 1;
        var totalEls = options.length;

        console.log(el);

        assertiveLiveRegion.innerHTML = 
            el.innerText + ', clickable, ' + elNum + ' of ' + itemCount;
    }
  };

  var selectNextOption = function () {
    var so = shownOptions();
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

  var selectPreviousOption = function () {
    var so = shownOptions();
    for (var i = so.length - 1; i > 0; i--) {
      var o = so[i];
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

  var shownOptions = function () {
    // It's possible this selector will fail on some Windows browsers. May need to make it a simple classname.
    return list.querySelectorAll("li:not([hidden])");
  };

  var updateStatus = function () {
    var statusContent = "";

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

  var insertValue = function () {
    if (selectedOption) {
      if (field.value) {
        field.value = selectedOption.textContent;
      } else if (field.textContent) {
        field.textContent = selectedOption.textContent;
      }
      clearSelectedOption();
    }
  };

  var filter = function () {
    var s = field.value || field.textContent;
    s = s.toUpperCase();
    hideAll = true;
    if (s == "") return;
    visibleOptions = [];
    for (var i = 0, c = options.length; i < c; i++) {
      var o = options[i];
      var t = o.textContent.toUpperCase();
      // if typed string is not substring of state name or code (case insensitive), and is not exact match for state
      if ((t.indexOf(s) == -1 && o.id.indexOf(s) == -1) || t == s) {
        o.hidden = true;
      } else {
        o.hidden = false;
        hideAll = false;
        visibleOptions.push(o.textContent);
      }
    }
    clearSelectedOption();
  };

  var initCombo = function () {
    // TODO: If time allows, update example to account for multiple comboboxes.
    form = document.querySelector("form");
    field = document.querySelector('[role="combobox"]');
    status = document.querySelector('[role="status"]');
    list = document.getElementById(field.getAttribute("aria-owns"));
    options = list.getElementsByTagName("li");
    form.addEventListener("submit", submitHandler); // Search on iOS "Go" button.
    field.addEventListener("keyup", keyUpHandler);
    field.addEventListener("keydown", keyDownHandler);
    field.addEventListener("blur", blurHandler);
    field.addEventListener("focus", focusHandler);
    list.addEventListener("mousedown", mouseDownHandler);

    // get aria-describedby element;
    var ariaDescribedBy = field.getAttribute('aria-describedby');
    ariaDescriptionEl = ariaDescribedBy ? document.getElementById(ariaDescribedBy) : null;

    // put ids on all the options
    for (var i=0; i<options.length; i++) {
        var option = options[i];
        var optionNum = i+1;
        option.setAttribute('id', field.id + '__field-' + optionNum);
    }
    
    // This is needed for Chrome/Mac OS and Voiceover to ensure the element
    // is announced correctly.
    assertiveLiveRegion = document.createElement('div');
    assertiveLiveRegion.setAttribute('aria-live', 'assertive');
    assertiveLiveRegion.setAttribute('role', 'alert');
    assertiveLiveRegion.className = 'visually-hidden';
    list.parentElement.appendChild(assertiveLiveRegion);

  };

  return initCombo;
})();

initComboBoxes();
