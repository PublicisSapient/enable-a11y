'use strict'

/*******************************************************************************
* interpolate.js - Use ES6 template string syntax inside regular
* JavaScript strings.
* 
* Based on code from https://stackoverflow.com/questions/29182244/convert-a-string-to-a-template-string
* Refactored by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/template.php
* 
* Released under the MIT License.
******************************************************************************/

let interpolate, htmlToDomNode;

// Only run if this is being run client side.
if (typeof window !== 'undefined' && typeof document !== 'undefined') {

  const interpolateDomParser = new DOMParser();

  /**
   * @description A function that will do the same this as ES6 template strings.  This is useful when we are passing Template-like Strings as Props.  It is safe to use from XSS attacks, since it cannot run arbitrary code. Code from https://stackoverflow.com/questions/29182244/convert-a-string-to-a-template-string
   * @param {string} [str] - The template-like string.
   * @param {object} obj - The object that contains all the variables used in the template string
   * @returns {string} - The constructed string that results putting `string` and `params` together
   * @example interpolate("Showing ${searchNum} results for '${searchTerm}'", { searchNum: 10, searchTerm: "zoltan" }) = 'Showing 10 results for 'zoltan'
   */
  interpolate = function (template, params) {
    let r = template;

    try {
      for (const key in params) {
        if ({}.hasOwnProperty.call(params, key)) {
          r = r.replace(new RegExp("\\$\\{" + key + "\\}", "g"), params[key]);
        }
      }
    } catch (ex) {
      /* eslint-disable no-console */
      console.error(`interpolate() failed for string '${template}'. Reason:`, ex);
      /* eslint-enable no-console */
      return template;
    }
    return r;
  };

  /**
     *
     * @param { String } html - A string of HTML code
     * @returns { HTMLElement } - a DOM element representation of the HTML code.
     */
  htmlToDomNode = function (html) {
    const doc = interpolateDomParser.parseFromString(html, "text/html");
    return doc.body.firstChild;
  };

}

if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
  module.exports = ({ interpolate, htmlToDomNode } || new function () { });
}

export { interpolate, htmlToDomNode };