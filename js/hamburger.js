const EnableFlyoutMenu = new function() {
  // cache all the queries, classes, node lists and media queries.
  const menuSel = '.enable-flyout__open-menu-button';
  const $mainMenuButton = document.querySelectorAll(menuSel);
  const topNavSel = '.enable-flyout__top-level';
  const $root = document.querySelector(topNavSel);
  const containerSel = '.enable-flyout__container';
  const $container = document.querySelector(containerSel);
  const openLevelSel = '.enable-flyout__open-level-button';
  const $openLevel = document.querySelectorAll(openLevelSel);
  const closeLevelSel = '.enable-flyout__close-level-button';
  const closeLevelTopSel = '.enable-flyout__close-top-level';
  const navLevelSel = '.enable-flyout__level';
  const willAnimate = '.enable-flyout--will-animate';
  const enableFlyoutOpenClass = 'enable-flyout__body--is-open';
  const isOpenClass = 'enable-flyout--is-open';
  const isOpenSel = '.' + isOpenClass;
  const $body = document.body;
  const $screen = document.querySelector('.enable-flyout__overlay-screen');
  const mobileOpenMenuAnim = 'enable-flyout__anim--mobile-open';
  const mobileCloseMenuAnim = 'enable-flyout__anim--mobile-close';
  const dropdownSel = '.enable-flyout__dropdown';
  const hamburgerIconFacadeSel = '.enable-flyout__hamburger-icon-facade';
  const $rootCloseMenuButton = document.querySelector(hamburgerIconFacadeSel);
  const desktopMq = window.getComputedStyle($root).getPropertyValue('--enable-flyout__desktop-media-query');
  const desktopMql = window.matchMedia(desktopMq);

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

  // I think this should be done for all projects.
  const forEach = Array.prototype.forEach;

  function isHamburger() {
    // needs to be trimmed since it had leading spaces.
    return window.getComputedStyle($root).getPropertyValue('--enable-flyout__is-hamburger').trim() === '1';
  }


  function getSiblings (el) {
    return Array.prototype.filter.call(el.parentNode.children, function(child){
      return child !== el;
    });
  }

  this.openFlyout = () => {
    $root.classList.add(willAnimate);

    requestAnimationFrame(() => {
      $root.classList.add(isOpenClass);
      $body.classList.add(enableFlyoutOpenClass);
      
      accessibility.setKeepFocusInside($container, true);

      forEach.call($mainMenuButton, function ($el) {
        $el.setAttribute('aria-expanded', 'true');
        $el.setAttribute('tabindex', '-1');
        $el.setAttribute('aria-hidden', 'true');
      });
      
      // requestAnimationFrame(() => { $rootCloseMenuButton.focus() });
    })
  }

  this.closeFlyout = ($flyoutMenu) => {
    const $openLevel = $flyoutMenu.querySelectorAll(openLevelSel)
    let $controller  = accessibility.getAriaControllerEl($flyoutMenu);
    $flyoutMenu.classList.remove(isOpenClass);
    $controller.setAttribute('aria-expanded', 'false');

    forEach.call($openLevel, function ($el) {
      const siblings = getSiblings($el);
      
      forEach.call(siblings, function (sibling) {
        sibling.classList.remove(isOpenClass);
        
        $controller = accessibility.getAriaControllerEl(sibling);
        $controller.setAttribute('aria-expanded', 'false');
      })
    });
    
  }

  this.closeAllFlyouts = () => {
    const $flyouts = document.querySelectorAll(topNavSel);
    forEach.call($flyouts, closeLevel);

    const $openFlyouts = document.querySelectorAll(isOpenSel);
    forEach.call($openFlyouts, this.closeFlyout);

    $body.classList.remove(enableFlyoutOpenClass);
    
    accessibility.setKeepFocusInside($container, false);
    $root.classList.remove(willAnimate);

    forEach.call($mainMenuButton, function ($el) {
      $el.setAttribute('aria-expanded', 'false');
      $el.removeAttribute('tabindex');
      $el.removeAttribute('aria-hidden');
    });
    
  }
  

  function closeSiblingFlyouts($level) {
    const $parentLevel = $level.parentNode.closest(navLevelSel);
    const $flyouts = $parentLevel.querySelectorAll(navLevelSel);

    forEach.call($flyouts, closeLevel);
  }

  this.onHamburgerIconClick = (e) => {
    const { target } = e;
    const $menuButton = target.closest(menuSel);

    e.preventDefault();
    const $flyoutMenu = accessibility.getAriaControlsEl($menuButton);
    if ($flyoutMenu.classList.contains(isOpenClass)) {
      this.closeAllFlyouts();
    } else {
      this.openFlyout();
    }
  }

  this.onHamburgerCloseClick = (e) => {
    e.preventDefault();
    const $flyoutMenu = document.getElementById(this.getAttribute('aria-controls'));
    if (!$flyoutMenu) {
      throw "Error: aria-controls on button must be set to id of flyout menu.";
    }
    this.closeFlyout($flyoutMenu)
  }


  this.openMenuAnimationEnd = (e) => {
    const { target, animationName } = e;
    const $root = target.closest(topNavSel);

    if (target === $root) {
      requestAnimationFrame(() => { $rootCloseMenuButton.focus() });
    } else if (animationName === mobileOpenMenuAnim) {
      const $closeLevelButton = $root.querySelector(closeLevelTopSel);
      const { classList } = target;

      if (target.matches(navLevelSel)) {
          target.querySelector(closeLevelSel).focus();
          
          accessibility.setKeepFocusInside(target, true);
      }

    } else if (animationName === mobileCloseMenuAnim) {
      const $menuEl = document.querySelector('[aria-controls="' + $root.id + '"]');
      
      if (target === $root) {
          
          accessibility.setKeepFocusInside(target, false);
          $menuEl.focus();
      } else if (target.matches(navLevelSel)) {
          const $upperLevel = target.parentNode.closest(navLevelSel);
          
          accessibility.setKeepFocusInside($upperLevel, true);
          const $elToFocus = document.querySelector('[aria-controls="' + target.id + '"]');
          $elToFocus.focus();
      }

    }
  }


  const openLevelEvent = (e) => {
    const { target } = e;

    e.preventDefault();
    openLevel(target);
  }

  function openLevel($el) {
    const $flyoutMenu = accessibility.getAriaControlsEl($el);

    // if this is not the hamburger variant (i.e. the dropdowns
    // common on desktop menu systems), we want to close the 
    // sibling flyouts.
    if (!isHamburger()) {
      closeSiblingFlyouts($flyoutMenu);
    }
    $el.setAttribute('aria-expanded', 'true');
    if ($flyoutMenu) {
      const { classList } = $flyoutMenu;
      if ($flyoutMenu.matches(dropdownSel)) {
        $flyoutMenu.addEventListener(
          'blur', this.blurEvent, true
        );
      }
      $flyoutMenu.classList.add(isOpenClass);
    }
  }

  this.closeLevelEvent = (e) => {
    const { target } = e;
    e.preventDefault();

    closeLevel(target);
  }

  function closeLevel($el) {
    
    if ($el.classList.contains('enable-flyout__open-level-button')) {
      const $flyoutMenu = accessibility.getAriaControlsEl($el);
      $el.setAttribute('aria-expanded', 'false');
      if ($flyoutMenu) {
        $flyoutMenu.classList.remove(isOpenClass);
      }
      
      accessibility.setKeepFocusInside($el.parentNode.closest(navLevelSel), true);
      $el.focus();
    } else {
      const $navLevel = $el.closest(navLevelSel);
      const { id } = $navLevel;
      const $button = document.querySelector('[aria-controls="' + id + '"]');

      if ($navLevel.matches(dropdownSel)) {
        $navLevel.removeEventListener(
          'blur', this.blurEvent, true
        );
      }
      $navLevel.classList.remove(isOpenClass);
      $button.setAttribute('aria-expanded', 'false');
      
      const $panel = $button.parentNode.closest(navLevelSel);
      if ($panel) {
        accessibility.setKeepFocusInside($panel, true);
      }

      if (isHamburger()) {
        $button.focus();
      }
    }
  }

  this.toggleLevelEvent = (e) => {
    const { target } = e;
    const isExpanded = (target.getAttribute('aria-expanded') === 'true');

    if (isExpanded){
      this.closeLevelEvent(e);
    } else {
      openLevelEvent(e);
    }
  }

  this.blurEvent = (e) => {
    if (!isHamburger()) {
      accessibility.doIfBlurred(e, () => {
        this.closeAllFlyouts();
      });
    }
  }

  this.onBreakpointChange = (e) => {
    // we will close all flyouts, just in case
    this.closeAllFlyouts();
  }

  this.keyPressEvent = (e) => {
    const { key } = e;
    
    if (key === 'Esc' || key === 'Escape') {
      this.closeAllFlyouts();
    }
  }

  this.init = function () {
    // main menu open
    delegate('click', menuSel, this.onHamburgerIconClick);

    // level open
    delegate('click', openLevelSel, this.toggleLevelEvent);

    // level close
    delegate('click', closeLevelSel, this.closeLevelEvent);

    // main menu close
    delegate('click', closeLevelTopSel, this.onHamburgerCloseClick);

    // close on close menu facade 
    delegate('click', hamburgerIconFacadeSel, this.closeAllFlyouts);

    document.addEventListener('animationend', this.openMenuAnimationEnd);

    /* document.querySelector('.enable-flyout__dropdown').addEventListener(
      'blur', this.blurEvent, true
    );*/ 

    
    $screen.addEventListener('click', this.closeAllFlyouts);
    
    if (desktopMql.addEventListener) {
      desktopMql.addEventListener('change', this.onBreakpointChange);
    }
    
    // This is supposed to be deprecated, but I don't know what its replacement is.
    $body.addEventListener("orientationchange", this.onBreakpointChange);


    document.addEventListener('keyup', this.keyPressEvent);
  }
}


EnableFlyoutMenu.init();