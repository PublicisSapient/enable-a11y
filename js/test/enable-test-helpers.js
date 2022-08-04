
const toJSON =(node) =>{
  node = node || this;
  let obj = {
      nodeType: node.nodeType
  };
  if (node.tagName) {
      obj.tagName = node.tagName.toLowerCase();
  } else
  if (node.nodeName) {
      obj.nodeName = node.nodeName;
  }
  if (node.nodeValue) {
      obj.nodeValue = node.nodeValue;
  }
  let attrs = node.attributes;
  let childNodes = node.childNodes;
  let length;
  let arr;
  if (attrs) {
      length = attrs.length;
      arr = obj.attributes = new Array(length);
      for (let i = 0; i < length; i++) {
          const attr = attrs[i];
          arr[i] = [attr.nodeName, attr.nodeValue];
      }
  }
  if (childNodes) {
      length = childNodes.length;
      arr = obj.childNodes = new Array(length);
      for (let i = 0; i < length; i++) {
          arr[i] = toJSON(childNodes[i]);
      }
  }
  return obj;
}

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
    page.exposeFunction('toJSON', toJSON);
    return page.evaluate(() => {
      const { activeElement } = document;
      const s = toJSON(activeElement);
      return JSON.stringify(s);
    });
  }

  this.getClonedSelectorEl = function(page, selector) {
    page.exposeFunction('toJSON', toJSON);
    return page.evaluate(() => {
      const el = document.querySelector(selector);
      return toJSON(el);
    });
  }

  this.pause = function () {
    // await 100ms before continuing further
    new Promise(res => setTimeout(res, 100));
  }
}

export default enableTestHelpers;