


const enableTestHelpers = new function () {
  this.findFocusedNode = function (node) {
    if (node.focused) {
        return node;
    }

    for (const child of node.children || []) {
        const focusedNode = this.findFocusedNode(child);
        if (focusedNode) {
            return focusedNode;
        }
    }
  }

 
  this.getClonedActiveEl = function(page) {
    return page.evaluate(() => {
      const { activeElement } = document;
      return activeElement.outerHTML;
    });
  }

  this.getClonedSelectorEl = function(page, selector) {
    return page.evaluate(() => {
      const el = document.querySelector(selector).outerHTML;
      return el.outerHTML;
    });
  }

  this.pause = function () {
    // await 100ms before continuing further
    new Promise(res => setTimeout(res, 100));
  }
}

export default enableTestHelpers;