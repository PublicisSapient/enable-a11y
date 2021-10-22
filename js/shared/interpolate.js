const interpolateDomParser = new DOMParser();

/**
 * @description A function that will do the same this as ES6 template strings.  This is useful when we are passing Template-like Strings as Props.  It is safe to use from XSS attacks, since it cannot run arbitrary code. Code from https://stackoverflow.com/questions/29182244/convert-a-string-to-a-template-string
 * @param {string} [str] - The template-like string.
 * @param {object} obj - The object that contains all the variables used in the template string
 * @returns {string} - The constructed string that results putting `string` and `params` together
 * @example interpolate("Showing ${searchNum} results for '${searchTerm}'", { searchNum: 10, searchTerm: "grand cherokee" }) = 'Showing 10 results for 'grand cherokee'
 */
const interpolate = function (template, params) {
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
const htmlToDomNode = function (html) {
  const doc = interpolateDomParser.parseFromString(html, "text/html");
  return doc.body.firstChild;
};
