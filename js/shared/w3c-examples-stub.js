// This file needed for list-combobox.js



/**
 * @namespace aria
 */

var aria = aria || {};

/* ---------------------------------------------------------------- */
/*                  ARIA Widget Namespace                        */
/* ---------------------------------------------------------------- */

aria.widget = aria.widget || {};

/* ---------------------------------------------------------------- */
/*                  Source code generators                          */
/* ---------------------------------------------------------------- */

/**
 * @constructor SourceCode
 *
 * @memberOf aria.Widget
 *
 * @desc  Creates a slider widget using ARIA
 *
 * @property  location      Array  -  Object containing the keyCodes used by the slider widget
 * @property  code          Array  -  JQuery node object
 */

aria.widget.SourceCode = function () {
  this.location = new Array();
  this.code = new Array();
};

/**
 * @method add
 *
 * @memberOf aria.widget.SourceCode
 *
 * @desc  Adds source code
 */

aria.widget.SourceCode.prototype.add = function (locationId, codeId) {
  this.location[this.location.length] = locationId;
  this.code[this.code.length] = codeId;
};

/**
 * @method make
 *
 * @memberOf aria.widget.SourceCode
 *
 * @desc  Generates HTML content for source code
 */

aria.widget.SourceCode.prototype.make = function () {

  var nodeCode;
  var nodeLocation;

  for (var i = 0; i < this.location.length; i++) {

    nodeLocation = document.getElementById(this.location[i]);
    nodeCode = document.getElementById(this.code[i]);

    nodeLocation.className = 'sourcecode';
    this.createCode(nodeLocation, '', nodeCode, true);

  } // endfor

};

/**
 * @method createCode
 *
 * @memberOf aria.widget.SourceCode
 *
 * @desc  Specify the source code and the location of the source code
 *
 * @param  location   String   - id of element to put the source code
 * @param  spaces     String   - Any spaces to precede the source code
 * @param  node       Object   - DOM Element node to use to generate the source code
 */

aria.widget.SourceCode.prototype.createCode = function (location, spaces, node, first) {

  function hasText (s) {
    if (typeof s !== 'string') {return false;}

    for (var i = 0; i < s.length; i++) {
      var c = s[i];
      if (c !== ' ' && c !== '\n' && c !== '\r') {return true;}
    }
    return false;
  }

  function cleanText (s) {
    if (typeof s !== 'string') {return '';}

    s1 = '';
    for (var i = 0; i < s.length; i++) {
      var c = s[i];

      if (c === '<') {
        c = '&lt;';
      }

      if (c === '>') {
        c = '&gt;';
      }

      s1 += c;
    }
    return s1;
  }

  var i, s;
  var count = 0;

  if (typeof first !== 'boolean') {
    first = false;
  }

  if (!first) {
    var nodeNameStr = node.nodeName.toLowerCase();

    location.innerHTML = location.innerHTML + '<br/>' + spaces + '&lt;' + nodeNameStr;

    for (i = 0; i < node.attributes.length; i++) {

      location.innerHTML = location.innerHTML + '&nbsp;' + node.attributes[i].nodeName + '="';
      location.innerHTML = location.innerHTML + node.attributes[i].value + '"';

      if (((i + 1) != node.attributes.length) && (node.attributes.length > 2)) {

        location.innerHTML = location.innerHTML + '<br/>' + spaces;

        for (var j = 2; j <= nodeNameStr.length; j++) {
          location.innerHTML = location.innerHTML + '&nbsp;';
        }

      } // endif

    } // endfor

    location.innerHTML = location.innerHTML + '&gt;';
  }

  for (i = 0; i < node.childNodes.length; i++) {

    var n = node.childNodes[i];

    switch (n.nodeType) {

      case Node.ELEMENT_NODE:
        this.createCode(location, spaces + '&nbsp;&nbsp;', n);
        count++;
        break;

      case Node.TEXT_NODE:
        if (hasText(n.nodeValue)) {
          s = cleanText(n.nodeValue);
          location.innerHTML = location.innerHTML + '<br/>' + spaces + '&nbsp;&nbsp;' + s;
        }
        count++;
        break;

      case Node.COMMENT_NODE:

        if (hasText(n.nodeValue)) {
          location.innerHTML = location.innerHTML  + '<br/>' + spaces + '&nbsp;&nbsp;' + '&lt;--&nbsp;&nbsp;' + n.nodeValue + '--&gt;';
        }
        count++;
        break;

    } // end switch

  } // end for

  if (!first) {
    if (count > 0) {
      location.innerHTML = location.innerHTML + '<br/>' + spaces + '&lt;/' + node.nodeName.toLowerCase();
      location.innerHTML = location.innerHTML + '&gt;';
    } // end if
  }

};

var sourceCode = new aria.widget.SourceCode();



/**
 * @desc
 *  Key code constants
 */
aria.KeyCode = {
  BACKSPACE: 8,
  TAB: 9,
  RETURN: 13,
  ESC: 27,
  SPACE: 32,
  PAGE_UP: 33,
  PAGE_DOWN: 34,
  END: 35,
  HOME: 36,
  LEFT: 37,
  UP: 38,
  RIGHT: 39,
  DOWN: 40,
  DELETE: 46
};

aria.Utils = aria.Utils || {};

// Polyfill src https://developer.mozilla.org/en-US/docs/Web/API/Element/matches
aria.Utils.matches = function (element, selector) {
  if (!Element.prototype.matches) {
    Element.prototype.matches =
      Element.prototype.matchesSelector ||
      Element.prototype.mozMatchesSelector ||
      Element.prototype.msMatchesSelector ||
      Element.prototype.oMatchesSelector ||
      Element.prototype.webkitMatchesSelector ||
      function (s) {
        var matches = element.parentNode.querySelectorAll(s);
        var i = matches.length;
        while (--i >= 0 && matches.item(i) !== this) {}
        return i > -1;
      };
  }

  return element.matches(selector);
};

aria.Utils.remove = function (item) {
  if (item.remove && typeof item.remove === 'function') {
    return item.remove();
  }
  if (item.parentNode &&
      item.parentNode.removeChild &&
      typeof item.parentNode.removeChild === 'function') {
    return item.parentNode.removeChild(item);
  }
  return false;
};

aria.Utils.isFocusable = function (element) {
  if (element.tabIndex > 0 || (element.tabIndex === 0 && element.getAttribute('tabIndex') !== null)) {
    return true;
  }

  if (element.disabled) {
    return false;
  }

  switch (element.nodeName) {
    case 'A':
      return !!element.href && element.rel != 'ignore';
    case 'INPUT':
      return element.type != 'hidden' && element.type != 'file';
    case 'BUTTON':
    case 'SELECT':
    case 'TEXTAREA':
      return true;
    default:
      return false;
  }
};

aria.Utils.getAncestorBySelector = function (element, selector) {
  if (!aria.Utils.matches(element, selector + ' ' + element.tagName)) {
    // Element is not inside an element that matches selector
    return null;
  }

  // Move up the DOM tree until a parent matching the selector is found
  var currentNode = element;
  var ancestor = null;
  while (ancestor === null) {
    if (aria.Utils.matches(currentNode.parentNode, selector)) {
      ancestor = currentNode.parentNode;
    }
    else {
      currentNode = currentNode.parentNode;
    }
  }

  return ancestor;
};

aria.Utils.hasClass = function (element, className) {
  return (new RegExp('(\\s|^)' + className + '(\\s|$)')).test(element.className);
};

aria.Utils.addClass = function (element, className) {
  if (!aria.Utils.hasClass(element, className)) {
    element.className += ' ' + className;
  }
};

aria.Utils.removeClass = function (element, className) {
  var classRegex = new RegExp('(\\s|^)' + className + '(\\s|$)');
  element.className = element.className.replace(classRegex, ' ').trim();
};

