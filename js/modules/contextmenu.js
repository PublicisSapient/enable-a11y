'use-strict'

export default function ContextMenu() {
  let previousFocus;

  this.init = new function () {
    document.addEventListener('contextmenu', (event) => {
      previousFocus = event.target;

      const link = event.target.closest('.link-context-menu');
      if (link) {
        event.preventDefault();
        showContextMenu(event.x, event.y);
      }

      const opener = event.target.closest('.opener');
      if (opener) {
        event.preventDefault();
        showContextMenu(event.x, event.y);
      }
    });
  }
  
  function showContextMenu(eventX, eventY) {
    let isMenuShowing = document.getElementById('context-menu-list') !== null;
    if (isMenuShowing) {
      hideContextMenu();
    }
    const menu = createContextMenu();
    addMenuItemEventListeners(menu);
    menu.style.left = `${eventX}px`;
    menu.style.top = `${eventY}px`;
    document.getElementById('main').append(menu);
    menu.addEventListener('keydown', onMenuKeyDown);
    menu.focus();
    document.addEventListener('click', hideContextMenu);
  }
  
  function addMenuItemEventListeners(menu) {
    const items = menu.querySelectorAll('li');
    for (let item of items) {
      item.addEventListener('click', onContextMenuItemClicked);
      item.addEventListener('mouseover', onMouseOverItem);
      item.addEventListener('mouseout', onMouseOutItem);
    }
  }

  function hideContextMenu() {
    const menu = document.getElementById('context-menu-list');
    if (!menu) {
      return;
    }
    removeMenuItemEventListeners(menu);
    menu.removeEventListener('keydown', onMenuKeyDown);
    menu.remove();
    document.removeEventListener('click', hideContextMenu);
    if (previousFocus) {
      previousFocus.focus()
    }
  }
  
  function removeMenuItemEventListeners(menu) {
    const items = menu.querySelectorAll('li');
    for (let item of items) {
      item.removeEventListener('click', onContextMenuItemClicked);
      item.removeEventListener('mouseover', onMouseOverItem);
      item.removeEventListener('mouseout', onMouseOutItem);
    }
  }

  function onMenuKeyDown(event) {
    if (event.key === 'Escape') {
      hideContextMenu();
    }
  }

  function createContextMenu() {
    const ul = createElement('ul', { id: 'context-menu-list', class: 'context-menu__list', role: 'menu', tabindex: '0' });
    getMenuItems().forEach(item => {
      const li = createListItem(item);
      ul.append(li);
    });
    return ul;
  }

  function getMenuItems() {
    return [
      {text: 'Back', className: 'context-menu__list__item', role: 'menuitem', tabindex: '0'},
      {text: 'Forward', className: 'context-menu__list__item__disabled', role: 'menuitem', tabindex: '0'},
      {text: 'Reload', className: 'context-menu__list__item', role: 'menuitem', tabindex: '0'},
      {text: 'More Tools', className: 'context-menu__list__item', role: 'menuitem', tabindex: '0'},
      {className: 'context-menu__list__item__divider', ariaHidden: 'true'},
      {
        text: 'Show Bookmarks',
        className: 'context-menu__list__item__withIcon',
        role: 'menuitem',
        tabindex: '0',
        iconSrc: 'images/contextmenu/check_24dp_color.png',
        iconAlt: 'selected',
        iconClass: 'context-menu__list__item__withIcon__icon'
      },
      {text: 'Show Full URLs', className: 'context-menu__list__item', role: 'menuitem', tabindex: '0'}
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
