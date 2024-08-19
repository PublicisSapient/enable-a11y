'use-strict'

export default function ContextMenu() {
  let previousFocus;
  let longPressTimeout;
  
  this.init = new function () {
    const link = document.getElementById('link-context-menu');
    if (link) {
      addContextMenuListener(link);
      addLongTapListener(link);
    }
    
    const area = document.getElementById('specific-area');
    if (area) {
      addContextMenuListener(area);
      addLongTapListener(area);
    }
  }
  
  function addContextMenuListener(element) {
    element.addEventListener('contextmenu', (event) => {
      previousFocus = event.target;
      event.preventDefault();
      showContextMenu(event.x, event.y);
    })
  }
  
  function addLongTapListener(element) {
    const iOSLongPressTime = 500;
    element.addEventListener('touchstart', (event) => {
      previousFocus = event.target;
      if (longPressTimeout) {
        clearTimeout(longPressTimeout);
      }
      event.preventDefault();
      const touch = event.touches[0];
      longPressTimeout = setTimeout(() => {
        showContextMenu(touch.pageX, touch.pageY);
      }, iOSLongPressTime);
    })
  }
  
  function showContextMenu(eventX, eventY) {
    let isMenuShowing = document.getElementById('context-menu-list') !== null;
    if (isMenuShowing) {
      hideContextMenu();
    }
    const menu = createContextMenu();
    menu.style.left = `${eventX}px`;
    menu.style.top = `${eventY}px`;
    document.getElementById('main').append(menu);
    addContextMenuListeners(menu);
    focusOn(menu);
    document.addEventListener('click', hideContextMenu);
  }
  
  function addContextMenuListeners(menu) {
    const items = menu.querySelectorAll('li');
    for (let item of items) {
      item.addEventListener('click', onContextMenuItemClicked);
      item.addEventListener('mouseover', onMouseOverItem);
      item.addEventListener('mouseout', onMouseOutItem);
    }
    menu.addEventListener('keydown', onMenuKeyDown);
  }
  
  function focusOn(menu) {
    // longPressTimeout is assigned when a 'touchstart' event fires.
    if (longPressTimeout) {
      // On iOS, wait for long-tap animation to end before focusing.
      setTimeout(() => {
        menu.focus();
      }, 200);
      longPressTimeout = null;
    } else {
      menu.focus();
    }
  }

  function hideContextMenu() {
    const menu = document.getElementById('context-menu-list');
    if (!menu) {
      return;
    }
    removeContextMenuListeners(menu);
    menu.remove();
    document.removeEventListener('click', hideContextMenu);
    if (previousFocus) {
      previousFocus.focus()
    }
  }
  
  function removeContextMenuListeners(menu) {
    const items = menu.querySelectorAll('li');
    for (let item of items) {
      item.removeEventListener('click', onContextMenuItemClicked);
      item.removeEventListener('mouseover', onMouseOverItem);
      item.removeEventListener('mouseout', onMouseOutItem);
    }
    menu.removeEventListener('keydown', onMenuKeyDown);
  }

  function onMenuKeyDown(event) {
    if (event.key === 'Escape') {
      hideContextMenu();
    }
  }

  function createContextMenu() {
    const ul = createElement('ul', { id: 'context-menu-list', class: 'context-menu', role: 'menu', tabindex: '0' });
    getMenuItems().forEach(item => {
      const li = createListItem(item);
      ul.append(li);
    });
    return ul;
  }

  function getMenuItems() {
    return [
      {text: 'Back', className: 'context-menu__item', role: 'menuitem', tabindex: '0'},
      {text: 'Forward', className: 'context-menu__item__disabled', role: 'menuitem', tabindex: '0'},
      {text: 'Reload', className: 'context-menu__item', role: 'menuitem', tabindex: '0'},
      {text: 'More Tools', className: 'context-menu__item', role: 'menuitem', tabindex: '0'},
      {className: 'context-menu__item__divider', ariaHidden: 'true'},
      {
        text: 'Show Bookmarks',
        className: 'context-menu__item__withIcon',
        role: 'menuitem',
        tabindex: '0',
        iconSrc: 'images/contextmenu/check_24dp_color.png',
        iconAlt: 'selected',
        iconClass: 'context-menu__item__withIcon__icon'
      },
      {text: 'Show Full URLs', className: 'context-menu__item', role: 'menuitem', tabindex: '0'}
    ];
  }

  function createListItem(data) {
    const { text, className, role, tabindex, ariaHidden, iconSrc, iconAlt, iconClass } = data;
    const children = [];
    if (iconSrc) {
      const icon = createElement('img', { src: iconSrc, alt: iconAlt, class: iconClass });
      children.push(icon);
    }
    if (text) {
      const textNode = document.createTextNode(text);
      children.push(textNode);
    }
    return createElement('li', { class: className, role, tabindex, 'aria-hidden': ariaHidden }, children);
  }

  function createElement(tag, attributes = {}, children = []) {
    const element = document.createElement(tag);
    for (const [key, value] of Object.entries(attributes)) {
      element.setAttribute(key, value);
    }
    children.forEach(child => element.append(child));
    return element;
  }

  function onContextMenuItemClicked(event) {
    const { target } = event;
    console.log(target.textContent);
  }

  function onMouseOverItem(event) {
    const {currentTarget} = event;
    const img = currentTarget.querySelector('img');
    if (img) {
      img.setAttribute('src', 'images/contextmenu/check_24dp_white.png');
    }
  }
  
  function onMouseOutItem(event) {
    const {currentTarget} = event;
    const img = currentTarget.querySelector('img');
    if (img) {
      img.setAttribute('src', 'images/contextmenu/check_24dp_color.png');
    }
  }
}
