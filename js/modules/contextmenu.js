'use-strict'

export default function ContextMenu() {
  this.init = new function () {
    document.addEventListener("contextmenu", (event) => {
      const link = event.target.closest(".link-context-menu");
      if (link) {
        event.preventDefault();
        openCustomMenuForLink(event)
      }
    })
  }
  
  function openCustomMenuForLink(event) {
    const list = document.getElementById("context-menu-list");
    for (let i = 0; i < list.children.length; i++) {
      let child = list.children[i];
      if (child.nodeName === "LI") {
        child.addEventListener("click", onContextMenuItemClicked);
        child.addEventListener("mouseover", onMouseOverItem);
        child.addEventListener("mouseout", onMouseOutItem);
      }
    }

    list.style.display = 'block';
    list.style.left = `${event.x}px`;
    list.style.top = `${event.y}px`;
    list.querySelector("li").focus(); // Focus first menu item

    document.addEventListener('click', hideCustomMenu);
  }
  
  function hideCustomMenu() {
    const list = document.getElementById("context-menu-list");
    for (let child of list.children) {
      if (child.nodeName === "LI") {
        child.removeEventListener("click", onContextMenuItemClicked);
        child.removeEventListener("mouseover", onMouseOverItem);
        child.removeEventListener("mouseout", onMouseOutItem);
      }
    }

    list.style.display = 'none';
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
