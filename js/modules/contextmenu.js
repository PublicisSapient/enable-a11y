'use-strict'

export default function ContextMenu() {
  this.init = new function () {
    const menu = document.getElementById("context-menu-list");
    for (let child of menu.children) {
      if (child.nodeName === "LI") {
        child.addEventListener("click", onContextMenuItemClicked);
        child.addEventListener("mouseover", onMouseOverItem);
        child.addEventListener("mouseout", onMouseOutItem);
      }
    }
    
    document.addEventListener("contextmenu", (event) => {
      const link = event.target.closest(".link-context-menu");
      if (link) {
        event.preventDefault();
        
        const menu = document.getElementById("context-menu");
        menu.style.display = 'block';
        menu.style.left = `${event.x}px`;
        menu.style.top = `${event.y}px`;
        document.addEventListener('click', hideCustomMenu);
      }
    })
  }
  
  function hideCustomMenu() {
    const menu = document.getElementById('context-menu');
    menu.style.display = 'none';
    document.removeEventListener('click', hideCustomMenu);
  }
  
  function onContextMenuItemClicked(event) {
    const {target} = event;
    console.log(target.textContent);
  }
  
  function onMouseOverItem(event) {
    const {currentTarget} = event;
    const img = currentTarget.querySelector('img');
    if (img) {
      img.setAttribute("src", "images/contextmenu/check_24dp_white.png");
    }
  }
  
  function onMouseOutItem(event) {
    const {currentTarget} = event;
    const img = currentTarget.querySelector('img');
    if (img) {
      img.setAttribute("src", "images/contextmenu/check_24dp_color.png");
    }
  }
}
