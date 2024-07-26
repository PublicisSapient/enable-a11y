'use-strict'

export default function ContextMenu() {
  this.init = new function () {
    const menu = document.getElementById("custom-context-menu-list");
    for (let child of menu.children) {
      if (child.nodeName === "LI") {
        child.addEventListener("click", onContextMenuItemClicked)
      }
    }
    
    document.addEventListener("contextmenu", (event) => {
      const link = event.target.closest(".link-context-menu");
      if (link) {
        event.preventDefault();

        const menu = document.getElementById("custom-context-menu");
        menu.style.display = 'block';
        menu.style.left = `${event.clientX}px`;
        menu.style.top = `${event.clientY}px`;
        document.addEventListener('click', hideCustomMenu);
      }
    })
  }

  function hideCustomMenu() {
    const menu = document.getElementById('custom-context-menu');
    menu.style.display = 'none';
    document.removeEventListener('click', hideCustomMenu);
  }
  
  function onContextMenuItemClicked(event) {
    const { target } = event;
    console.log(target.textContent);
  }
}
