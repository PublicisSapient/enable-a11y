'use strict';

const testHelpers = new function () {
  this.isElementHidden = function (el) {
    return (el.offsetParent === null)
  }
}

export default testHelpers;