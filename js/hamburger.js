const EnableFlyoutMenu = new function() {
  const menuSel = '.js-menuToggle';
  const topNavSel = '.js-topPushNav';
  const openLevelSel = '.js-openLevel';
  const $openLevel = document.querySelectorAll(openLevelSel);
  const closeLevelSel = '.js-closeLevel';
  const closeLevelTopSel = '.js-closeLevelTop';
  const navLevelSel = '.js-pushNavLevel';
  const $body = document.body;
  const $screen = document.querySelector('.screen');

  // keeps track of what element currently has a focus loop
  let $focusLoopEl = null;

  function delegate(eventName, elementSelector, handler) { 
    document.body.addEventListener(eventName, function(e) {
      eventName === 'transitionend' && e.propertyName === 'right' && console.log('help', e.target, elementSelector, eventName, e);
      // loop parent nodes from the target to the delegation node
      for (var target = e.target; target && target != this; target = target.parentNode) {
          if (target.matches(elementSelector)) {
              handler.call(target, e);
              break;
          }
      }
    }, false);
  }

  const forEach = Array.prototype.forEach;

  function getAriaControlsEl($el) {
    const $ariaControlsEl = document.getElementById($el.getAttribute('aria-controls'));
    if (!$ariaControlsEl) {
      throw "Error: aria-controls on button must be set to id of flyout menu.";
    }
    return $ariaControlsEl;
  }

  function setKeepFocusInside($el, doKeepFocusInside) {
    if (doKeepFocusInside) {
      if ($focusLoopEl) {
        accessibility.setKeepFocusInside($focusLoopEl, false);
      }
      $focusLoopEl = $el;
    }
    accessibility.setKeepFocusInside($el, doKeepFocusInside);
  }

  function getSiblings (el) {
    return Array.prototype.filter.call(el.parentNode.children, function(child){
      return child !== el;
    });
  }

  function openFlyout($flyoutMenu) {
    $flyoutMenu.classList.add('isOpen');
    $body.classList.add('pushNavIsOpen');
  }

  function closeFlyout($flyoutMenu) {
    const $openLevel = $flyoutMenu.querySelectorAll(openLevelSel)
    $flyoutMenu.classList.remove('isOpen');

    forEach.call($openLevel, function ($el) {
      const siblings = getSiblings($el);
      
      forEach.call(siblings, function (sibling) {
        sibling.classList.remove('isOpen');
      })
    });
    
    $body.classList.remove('pushNavIsOpen');
  }

  function closeAllFlyouts () {
    const $flyouts = document.querySelectorAll(topNavSel);
    forEach.call($flyouts, closeFlyout);
  }

  function onHamburgerIconClick(e) {
    e.preventDefault();
    const $flyoutMenu = getAriaControlsEl(this);
    if ($flyoutMenu.classList.contains('isOpen')) {
      closeFlyout($flyoutMenu);
    } else {
      openFlyout($flyoutMenu);
    }
  }

  function onHamburgerCloseClick(e) {
    e.preventDefault();
    const $flyoutMenu = document.getElementById(this.getAttribute('aria-controls'));
    if (!$flyoutMenu) {
      console.log(this);
      throw "Error: aria-controls on button must be set to id of flyout menu.";
    }
    closeFlyout($flyoutMenu)
  }


  function openMenuTransitionEnd(e) {
    const { target, propertyName } = e;
    if (propertyName === 'right') {
      const $root = target.closest(topNavSel);
      const $closeLevelButton = $root.querySelector(closeLevelTopSel);
      const $menuEl = document.querySelector('[aria-controls="' + $root.id + '"]');
      const { classList } = target;

      if (target == $root) {
        if (classList.contains("isOpen")) { 
          setKeepFocusInside(target, true);
          $closeLevelButton.focus();
        } else {
          setKeepFocusInside(target, false);
          $menuEl.focus();
        }
      } else if (target.matches(navLevelSel)) {
        if (classList.contains('isOpen')) {
          target.querySelector('.js-closeLevel').focus();
          setKeepFocusInside(target, true);
        } else {
          const $upperLevel = target.parentNode.closest(navLevelSel);
          setKeepFocusInside($upperLevel, true);
          $upperLevel.querySelector('.js-openLevel').focus();
        }
      }
    }
  }


  function openLevel(e){
    e.preventDefault();
    const $flyoutMenu = getAriaControlsEl(this);

    if ($flyoutMenu) {
      $flyoutMenu.classList.add('isOpen');
    }
  }

  function closeLevel () {
    this.closest(navLevelSel).classList.remove('isOpen');
  }

  this.init = function () {
    // main menu open
    delegate('click', menuSel, onHamburgerIconClick);
    delegate('touchstart', menuSel, onHamburgerIconClick);

    // level open
    delegate('click', openLevelSel, openLevel);
    delegate('touchstart', openLevelSel, openLevel);

    // level close
    delegate('click', '.js-closeLevel', closeLevel);
    delegate('touchstart', '.js-closeLevel', closeLevel);

    // main menu close
    delegate('click', closeLevelTopSel, onHamburgerCloseClick);
    delegate('touchstart', closeLevelTopSel, onHamburgerCloseClick);

    document.addEventListener('transitionend', openMenuTransitionEnd);

    $screen.addEventListener('click', closeAllFlyouts);
  }
}

EnableFlyoutMenu.init();
