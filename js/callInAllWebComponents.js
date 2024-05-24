var inAllWebComponents = new (function () {
  // Where el is the DOM element you'd like to test for visibility
  function isNodeHidden(el) {
    return el.offsetParent === null;
  }

  function getVisibleEls(list) {
    const filteredList = [];
    list.forEach((el) => {
      if (!isNodeHidden(el)) {
        filteredList.push(el);
      }
    });

    return filteredList;
  }

  this.getComponentNodes = function (root) {
    const docTags = root.querySelectorAll("*");
    const webComponentTags = [];

    docTags.forEach((el) => {
      if (el === root) {
        return;
      } else if (el.nodeName.indexOf("-") > 0) {
        webComponentTags.push(el);

        const subTags = this.getComponentNodes(el);
        webComponentTags.concat(subTags);
      }
    });

    return webComponentTags;
  };

  this.call = (funcName, ...args) => {
    const webComponentNodes = this.getComponentNodes(document);
    let returnValue = [];

    webComponentNodes.forEach((el) => {
      let r = el[funcName](...args);

      if (r && r.length !== 0) {
        returnValue = returnValue.concat(Array.from(r));
      }
    });

    return getVisibleEls(returnValue);
  };

  const onKeyUp = (e) => {
    const { key } = e;

    if (key === "q") {
      console.log("h1s: ", inAllWebComponents.call("querySelectorAll", "h1"));
    }
  };

  this.init = () => {
    console.log("init!");
    document.addEventListener("keyup", onKeyUp);
  };
})();

console.log("script loaded. inAllWebComponents is ", inAllWebComponents);
inAllWebComponents.init();
