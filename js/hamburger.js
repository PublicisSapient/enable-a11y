const EnableFlyoutMenu = new function() {
  // cache all the queries, classes, node lists and media queries.
  const menuSel = '.enable-flyout__open-menu-button';
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

  function openFlyout() {
    $root.classList.add(willAnimate);

    requestAnimationFrame(() => {
      $root.classList.add(isOpenClass);
      $body.classList.add(enableFlyoutOpenClass);
      
      accessibility.setKeepFocusInside($container, true);

      requestAnimationFrame(() => { $rootCloseMenuButton.focus() });
    })
  }

  function closeFlyout($flyoutMenu) {
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

  function closeAllFlyouts () {
    const $flyouts = document.querySelectorAll(topNavSel);
    forEach.call($flyouts, closeLevel);

    const $openFlyouts = document.querySelectorAll(isOpenSel);
    forEach.call($openFlyouts, closeFlyout);

    $body.classList.remove(enableFlyoutOpenClass);
    
    accessibility.setKeepFocusInside($container, false);
    $root.classList.remove(willAnimate);
    
  }

  function closeSiblingFlyouts($level) {
    const $parentLevel = $level.parentNode.closest(navLevelSel);
    const $flyouts = $parentLevel.querySelectorAll(navLevelSel);

    forEach.call($flyouts, closeLevel);
  }

  const onHamburgerIconClick = (e) => {
    const { target } = e;
    const $menuButton = target.closest(menuSel);
    e.preventDefault();
    const $flyoutMenu = accessibility.getAriaControlsEl($menuButton);
    if ($flyoutMenu.classList.contains(isOpenClass)) {
      $menuButton.setAttribute('aria-expanded', 'false');
      closeAllFlyouts();
    } else {
      $menuButton.setAttribute('aria-expanded', 'true');
      openFlyout();
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
          'blur', blurEvent, true
        );
      }
      $flyoutMenu.classList.add(isOpenClass);
    }
  }

  const closeLevelEvent = (e) => {
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
          'blur', blurEvent, true
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

  function toggleLevelEvent(e) {
    const { target } = e;
    const isExpanded = (target.getAttribute('aria-expanded') === 'true');

    if (isExpanded){
      closeLevelEvent(e);
    } else {
      openLevelEvent(e);
    }
  }

  const blurEvent = (e) => {
    if (!isHamburger()) {
      accessibility.doIfBlurred(e, () => {
        closeAllFlyouts();
      });
    }
  }

  const onBreakpointChange = (e) => {
    // we will close all flyouts, just in case
    closeAllFlyouts();
  }

  function keyPressEvent(e) {
    const { key } = e;
    
    if (key === 'Esc' || key === 'Escape') {
      closeAllFlyouts();
    }
  }

  this.init = function () {
    // main menu open
    delegate('click', menuSel, onHamburgerIconClick);

    // level open
    delegate('click', openLevelSel, toggleLevelEvent);

    // level close
    delegate('click', closeLevelSel, closeLevelEvent);

    // main menu close
    delegate('click', closeLevelTopSel, onHamburgerCloseClick);

    // close on close menu facade 
    delegate('click', hamburgerIconFacadeSel, closeAllFlyouts);

    document.addEventListener('animationend', openMenuAnimationEnd);

    /* document.querySelector('.enable-flyout__dropdown').addEventListener(
      'blur', blurEvent, true
    );*/ 

    
    $screen.addEventListener('click', closeAllFlyouts);
    
    if (desktopMql.addEventListener) {
      desktopMql.addEventListener('change', onBreakpointChange);
    }
    
    // This is supposed to be deprecated, but I don't know what its replacement is.
    $body.addEventListener("orientationchange", onBreakpointChange);


    document.addEventListener('keyup', keyPressEvent);
  }
}

const getStackTrace = function () {
  var callstack = [];
  var isCallstackPopulated = false;
  try {
    i.dont.exist+=0; //doesn't exist- that's the point
  } catch(e) {
    if (e.stack) { //Firefox
      console.log('ff', e.stack);
      var lines = e.stack.split('\n');
      for (var i=0, len=lines.length; i<len; i++) {
        if (lines[i].match(/^\s*[A-Za-z0-9\-_\$]+\(/)) {
          callstack.push(lines[i]);
        }
      }
      //Remove call to printStackTrace()
      callstack.shift();
      isCallstackPopulated = true;
    }
    else if (window.opera && e.message) { //Opera
      console.log('??');
      var lines = e.message.split('\n');
      for (var i=0, len=lines.length; i<len; i++) {
        if (lines[i].match(/^\s*[A-Za-z0-9\-_\$]+\(/)) {
          var entry = lines[i];
          //Append next line also since it has the file info
          if (lines[i+1]) {
            entry += "&quot; at &quot;" + lines[i+1];
            i++;
          }
          callstack.push(entry);
        }
      }
      //Remove call to printStackTrace()
      callstack.shift();
      isCallstackPopulated = true;
    }
  }
  if (!isCallstackPopulated) { //IE and Safari
    console.log('sssss');
    var currentFunction = arguments.callee.caller;
    while (currentFunction) {
      var fn = currentFunction.toString();
      var fname = fn.substring(fn.indexOf("&quot;function&quot;") + 8, fn.indexOf('')) || 'anonymous';
      callstack.push(fname);
      currentFunction = currentFunction.caller;
    }
  }
  return (callstack);
}

/* 
HTMLElement.prototype.oldFocus = HTMLElement.prototype.focus;

HTMLElement.prototype.focus = function () {
  console.log('focusing', getStackTrace());
  this.oldFocus();
}
*/

EnableFlyoutMenu.init();