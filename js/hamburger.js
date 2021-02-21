const EnableFlyoutMenu = new function() {
  const menuSel = '.enable-flyout__open-menu-button';
  const topNavSel = '.enable-flyout__top-level';
  const $root = document.querySelector(topNavSel);
  const openLevelSel = '.enable-flyout__open-level-button';
  const $openLevel = document.querySelectorAll(openLevelSel);
  const closeLevelSel = '.enable-flyout__close-level-button';
  const closeLevelTopSel = '.enable-flyout__close-top-level';
  const navLevelSel = '.enable-flyout__level';
  const enableFlyoutOpenClass = 'enable-flyout__body--is-open';
  const isOpenClass = 'enable-flyout--is-open';
  const $body = document.body;
  const $screen = document.querySelector('.enable-flyout__overlay-screen');
  const mobileOpenMenuAnim = 'enable-flyout__anim--mobile-open';
  const mobileCloseMenuAnim = 'enable-flyout__anim--mobile-close';
  const dropdownSel = '.enable-flyout__dropdown';
  const desktopMq = window.getComputedStyle($root).getPropertyValue('--enable-flyout__desktop-media-query');
  const desktopMql = window.matchMedia(desktopMq);


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

  function getController($el) {
    const $controller = document.querySelector('[aria-controls="' + $el.id + '"]');
    if (!$controller) {
      throw "Error: There is no element that has aria-controls set to " + $el.id;
    }
    return $controller;
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
    let $controller  = getController($flyoutMenu);
    $flyoutMenu.classList.remove(isOpenClass);
    $controller.setAttribute('aria-expanded', 'false');

    forEach.call($openLevel, function ($el) {
      const siblings = getSiblings($el);
      
      forEach.call(siblings, function (sibling) {
        sibling.classList.remove(isOpenClass);
        
        $controller = getController(sibling);
        $controller.setAttribute('aria-expanded', 'false');
      })
    });
    
    $body.classList.remove(enableFlyoutOpenClass);
  }

  function closeAllFlyouts () {
    const $flyouts = document.querySelectorAll(topNavSel);
    forEach.call($flyouts, closeFlyout);
  }

  function closeSiblingFlyouts($level) {
    const $parentLevel = $level.parentNode.closest(navLevelSel);
    const $flyouts = $parentLevel.querySelectorAll(navLevelSel);

    // this is not right.
    forEach.call($flyouts, closeFlyout);
  }

  function onHamburgerIconClick(e) {
    e.preventDefault();
    const $flyoutMenu = getAriaControlsEl(this);
    if ($flyoutMenu.classList.contains(isOpenClass)) {
      this.setAttribute('aria-expanded', 'false');
      closeFlyout($flyoutMenu);
    } else {
      this.setAttribute('aria-expanded', 'true');
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


  function openMenuAnimationEnd(e) {
    const { target, animationName } = e;
    const $root = target.closest(topNavSel);

    if (animationName === mobileOpenMenuAnim) {
      const $closeLevelButton = $root.querySelector(closeLevelTopSel);
      const { classList } = target;

      if (target === $root) {
          setKeepFocusInside(target, true);
          $closeLevelButton.focus();
      } else if (target.matches(navLevelSel)) {
          target.querySelector(closeLevelSel).focus();
          setKeepFocusInside(target, true);
      }

    } else if (animationName === mobileCloseMenuAnim) {
      const $menuEl = document.querySelector('[aria-controls="' + $root.id + '"]');
      
      if (target === $root) {
          setKeepFocusInside(target, false);
          $menuEl.focus();
      } else if (target.matches(navLevelSel)) {
          const $upperLevel = target.parentNode.closest(navLevelSel);
          setKeepFocusInside($upperLevel, true);
          const $elToFocus = document.querySelector('[aria-controls="' + target.id + '"]');
          $elToFocus.focus();
      }

    }
  }


  function openLevel(e){
    const { target } = e;
    e.preventDefault();


    const $flyoutMenu = getAriaControlsEl(target);

    closeSiblingFlyouts($flyoutMenu);
    target.setAttribute('aria-expanded', 'true');
    if ($flyoutMenu) {
      const { classList } = $flyoutMenu;
      if ($flyoutMenu.matches(dropdownSel)) {
        $flyoutMenu.addEventListener(
          'blur', blurEvent, true
        );
      }
      $flyoutMenu.classList.add(isOpenClass);
    }
  }

  function closeLevel(e) {
    const { target } = e;

    if (target.classList.contains('enable-flyout__open-level-button')) {
      e.preventDefault();
      const $flyoutMenu = getAriaControlsEl(target);
      target.setAttribute('aria-expanded', 'false');
      if ($flyoutMenu) {
        $flyoutMenu.classList.remove(isOpenClass);
      }
    } else {
      
      const $navLevel = this.closest(navLevelSel);
      const { id } = $navLevel;
      const $button = document.querySelector('[aria-controls="' + id + '"]');

      console.log('brrr');
        if ($navLevel.matches(dropdownSel)) {
          $navLevel.removeEventListener(
            'blur', blurEvent, true
          );
        }
      $navLevel.classList.remove(isOpenClass);
      $button.setAttribute('aria-expanded', 'false');
    }
  }

  function toggleLevel(e) {
    const { target } = e;
    const isExpanded = (target.getAttribute('aria-expanded') === 'true');

    if (isExpanded){
      closeLevel(e);
    } else {
      openLevel(e);
    }
  }

  const blurEvent = (e) => {
    accessibility.doIfBlurred(e, () => {
      closeAllFlyouts();
    });
  }

  const onBreakpointChange = (e) => {
    // we will close all flyouts, just in case
    closeAllFlyouts();
  }

  this.init = function () {
    // main menu open
    delegate('click', menuSel, onHamburgerIconClick);

    // level open
    delegate('click', openLevelSel, toggleLevel);

    // level close
    delegate('click', closeLevelSel, closeLevel);

    // main menu close
    delegate('click', closeLevelTopSel, onHamburgerCloseClick);

    document.addEventListener('animationend', openMenuAnimationEnd);

    /* document.querySelector('.enable-flyout__dropdown').addEventListener(
      'blur', blurEvent, true
    );*/ 

    $screen.addEventListener('click', closeAllFlyouts);

    desktopMql.addEventListener('change', onBreakpointChange)
  }
}

EnableFlyoutMenu.init();
