
const testHelpers = new function () {
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
}

export default testHelpers;