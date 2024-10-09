'use strict'

/*******************************************************************************
 * interpolate.js - Use ES6 template string syntax inside regular
 * JavaScript strings.
 * 
 * Based on code from https://stackoverflow.com/questions/29182244/convert-a-string-to-a-template-string
 * with XSS prevention advice added, which was taken from: 
 * https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html
 * 
 * Refactored by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 27, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/template.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

const interpolateDomParser = new DOMParser();

const entities = [
  { re: /&/g, ent: '&amp;' },
  { re: /</g, ent: '&lt;' },
  { re: />/g, ent: '&gt;' },
  { re: /"/g, ent: '&quot' },
  { re: /'/g, ent: '&#x27' },
  { re: /=/g, ent: '&#61;' },
  { re: /javscript:/g, ent: '' },
  { re: /\son[a-z]*=/g, ent: '' }, // for inline events, like onclick, etc.
];

const disallowedInHTMLTemplate = [
  /<script/gi,
  /<style/gi,
  /<iframe/gi
]



/**
 * @description A function that will make strings not be prone to XSS attacks when they are placed inside of HTML.
 * @param {string} s - The input string
 * @returns {string} - The entified version of the input string s.
 */
const entify = function(s) {
  let result = s;

  entities.forEach((entity) => {
    result = result.replace(entity.re, entity.ent)
  });

  return result;
}

/**
 * @description A function that will do the same this as ES6 template strings.  This is useful when we are passing Template-like Strings as Props.  It is safe to use from XSS attacks, since it cannot run arbitrary code. Code from https://stackoverflow.com/questions/29182244/convert-a-string-to-a-template-string
 * @param {string} [str] - The template-like string.
 * @param {object} obj - The object that contains all the variables used in the template string
 * @returns {string} - The constructed string that results putting `string` and `params` together
 * @example interpolate("Showing ${searchNum} results for '${searchTerm}'", { searchNum: 10, searchTerm: "zoltan" }) = 'Showing 10 results for 'zoltan'
 */
const interpolate = function(template, params) {
  let r = template;

  for (let i = 0; i < disallowedInHTMLTemplate.length; i++) {
    const disallowed = disallowedInHTMLTemplate[i];
    if (template.indexOf(disallowed) > -1) {
      console.error(`Error in template: ${template}`);
      throw `Disallowed string in template: ${disallowed}`;
    }
  }

  try {
    for (const key in params) {
      const value = entify(params[key] + '');

      if ({}.hasOwnProperty.call(params, key)) {
        r = r.replace(new RegExp("\\$\\{" + key + "\\}", "g"), value);
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
const htmlToDomNode = function(html) {
  const doc = interpolateDomParser.parseFromString(html, "text/html");
  return doc.body.firstChild;
};
