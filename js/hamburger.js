const EnableFlyoutMenu = new function() {
  const menuSel = '.enable-flyout__open-menu-button';
  const topNavSel = '.enable-flyout__top-level';
  const openLevelSel = '.enable-flyout__open-level-button';
  const $openLevel = document.querySelectorAll(openLevelSel);
  const closeLevelSel = '.enable-flyout__close-level-button';
  const closeLevelTopSel = '.enable-flyout__close-top-level';
  const navLevelSel = '.enable-flyout_level';
  const enableFlyoutOpenClass = 'enable-flyout__body--is-open';
  const isOpenClass = 'enable-flyout--is-open';
  const $body = document.body;
  const $screen = document.querySelector('.enable-flyout__overlay-screen');

  // keeps track of what element currently has a focus loop
  let $focusLoopEl = null;

  function delegate(eventName, elementSelector, handler) { 
    document.body.addEventListener(eventName, function(e) {
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
    $flyoutMenu.classList.add(isOpenClass);
    $body.classList.add(enableFlyoutOpenClass);
  }

  function closeFlyout($flyoutMenu) {
    const $openLevel = $flyoutMenu.querySelectorAll(openLevelSel)
    $flyoutMenu.classList.remove(isOpenClass);

    forEach.call($openLevel, function ($el) {
      const siblings = getSiblings($el);
      
      forEach.call(siblings, function (sibling) {
        sibling.classList.remove(isOpenClass);
      })
    });
    
    $body.classList.remove(enableFlyoutOpenClass);
  }

  function closeAllFlyouts () {
    const $flyouts = document.querySelectorAll(topNavSel);
    forEach.call($flyouts, closeFlyout);
  }

  function onHamburgerIconClick(e) {
    e.preventDefault();
    const $flyoutMenu = getAriaControlsEl(this);
    if ($flyoutMenu.classList.contains(isOpenClass)) {
      closeFlyout($flyoutMenu);
    } else {
      openFlyout($flyoutMenu);
    }
  }

  function onHamburgerCloseClick(e) {
    e.preventDefault();
    const $flyoutMenu = document.getElementById(this.getAttribute('aria-controls'));
    if (!$flyoutMenu) {
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
        if (classList.contains(isOpenClass)) { 
          setKeepFocusInside(target, true);
          $closeLevelButton.focus();
        } else {
          setKeepFocusInside(target, false);
          $menuEl.focus();
        }
      } else if (target.matches(navLevelSel)) {
        if (classList.contains(isOpenClass)) {
          target.querySelector(closeLevelSel).focus();
          setKeepFocusInside(target, true);
        } else {
          console.log('this is the problem', target.id);
          const $upperLevel = target.parentNode.closest(navLevelSel);
          setKeepFocusInside($upperLevel, true);
          const $elToFocus = document.querySelector('[aria-controls="' + target.id + '"]');
          $elToFocus.focus();
        }
      }
    }
  }


  function openLevel(e){
    e.preventDefault();
    const $flyoutMenu = getAriaControlsEl(this);

    if ($flyoutMenu) {
      $flyoutMenu.classList.add(isOpenClass);
    }
  }

  function closeLevel () {
    this.closest(navLevelSel).classList.remove(isOpenClass);
  }

  this.init = function () {
    // main menu open
    delegate('click', menuSel, onHamburgerIconClick);

    // level open
    delegate('click', openLevelSel, openLevel);

    // level close
    delegate('click', closeLevelSel, closeLevel);

    // main menu close
    delegate('click', closeLevelTopSel, onHamburgerCloseClick);

    document.addEventListener('transitionend', openMenuTransitionEnd);

    $screen.addEventListener('click', closeAllFlyouts);
  }
}

EnableFlyoutMenu.init();
