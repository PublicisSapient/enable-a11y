'use strict'

/* global indent */

/*******************************************************************************
 * showcode.js - A code walkthrough component
 *
 * This code is used in the Enable accessible component library
 * examples to show developers how and why components work.
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released 
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/showcode.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

const showcode = new function () {
  const htmlBlocks = document.querySelectorAll("[data-showcode-props]");
  const htmlCache = {};
  const codeblockCache = {};
  const debug = false;
  let doesCodeWrap = localStorage.getItem('showcode__wrap-text');

  const jsObjs = [];

  // Needed by entify()
  const amp = /&/g;
  const lt = /</g;
  const gt = />/g;
  const tab = /\t/g;
  const space = / /g;
  const cr = /\n/g; // UNIX carriage return
  const mscr = /\r\n/g; // Microsoft carriage return
  const nbspStr = '\u00a0';
  const beginningSpaces = /^\s*/g;
  const tagLine = /^\s*</;
  const blankString = /^\s*$/;
  const ellipsesRe = /(\s*\.\.\.)/g;
  const blankAttrValueRe = /(required|novalidate|open|disabled|\$\{[^}]*\})=""/g;
  const commandsRe = /^%[A-Z]*?%/;
  const HTMLCommentBegin = /^\s*<!--/;
  const HTMLCommentEnd = /-->\s*$/;


  // Most of this list from
  // https://www.w3.org/TR/wai-aria-1.0/states_and_properties#attrs_relationships
  const relationshipAttributes = [
    'aria-labelledby',
    'aria-describedby',
    'aria-owns',
    'aria-controls',
    'aria-flowto',
    'aria-activedescendant',
    'aria-posinset',
    'aria-setsize',
    'for',
    'href',
    'xlink:href',
    'data-select-all-for'
  ]



  this.addJsObj = (name, value) => {
    jsObjs[name] = value;
  }

  this.entify = function (s, options) {
    if (!options) {
      options = {};
    }

    var result = s
      .replace(amp, "&amp;")
      .replace(lt, "&lt;")
      .replace(gt, "&gt;")
      .replace(tab, "   ");

    if (!options.ignoreSpace) {
      result = result.replace(space, nbspStr);
    }

    if (!options.ignoreReturns) {
      result = result.replace(mscr, "<br />").replace(cr, "<br />");
    }

    return result;
  };

  this.unentify = function (s) {

    return s.replace(/&amp;/g, '&').
      replace(/&lt;/g, '<').
      replace(/&gt;/g, '>');
  }

  function highlightFunc(s) {
    return `<mark class="showcode__highlight" tabindex="-1" ><span class="sr-only">Start of highlighted code. </span>${s}<span class="sr-only">End of highlighted code. </span></mark>`;
  }

  function formatCSS(localCode) {
    //localCode = localCode.replace(/\}/g, '\n}').replace(/([\{;])/g, '$1\n').replace(/\n\s*\n/, '\n\n');
    localCode = localCode.replace(/([{;])/g, '$1\n').replace(/\n\s*\n/, '\n\n');
    localCode = indent.css(localCode, { tabString: '  ' });
    return localCode + '\n\n';
  }

  const getTextFromFile = async (url) => {
    const response = await fetch(url).then(response => {
      return response.clone().text();
    });

    return response;
  }

  const getInnerCSS = (el, selectorPropertyPairs, codeEl) => {

    const showAllCSS = (selectorPropertyPairs.length === 1 && selectorPropertyPairs[0] === '');

    const cssTextBuffer = [];
    const { cssRules } = el.sheet;
    for (let i = 0; i < cssRules.length; i++) {

      if (debug) { console.debug('x', showAllCSS); }
      const cssRule = cssRules[i].cssText.trim();

      for (let j = 0; j < selectorPropertyPairs.length; j++) {
        const selectorPropertyPair = selectorPropertyPairs[j].trim();
        const properties = selectorPropertyPair.split('|');
        const selector = properties[0];

        properties.shift();

        if (debug) { console.debug(cssRule, selector); }

        if (showAllCSS || cssRule.indexOf(selector + ' ') === 0) {
          // Now we must highlight the properties.
          let code = cssRule;
          //code = code.replace(/\}/g, '\n}').replace(/([\{;])/g, '$1\n').replace(/\n\s*\n/, '\n\n');
          //code = indent.css(code, {tabString: '  '});



          for (let k = 0; k < properties.length; k++) {
            let propertyRegEx = new RegExp(`${properties[k]}:[^;]*\\;`);
            code = code.replace(propertyRegEx, highlightFunc);
          }

          cssTextBuffer.push(code);
        }
      }
    }

    if (cssTextBuffer.length === 0) {
      /*
       * Since Chrome doesn't keep rules that are not valid for it but possibly valid
       * for other browsers, let's grab the CSS file via HTTP and check it.
       */
      console.info(`Unable to retrieve selector CSS rule for selector ${selectorPropertyPairs[0]}. This may be because this browser's CSS parser is not storing rules it cannot understand. Attempting to get the information from the CSS file itself.`)

      let returnedSelectorVal;
      (async () => {
        getTextFromFile(el.href).then((css) => {
          const index = css.indexOf(selectorPropertyPairs[0]); //css.match(selectorRegEx);
          returnedSelectorVal = css.substring(index);
          const endBraceIndex = returnedSelectorVal.indexOf('}');
          returnedSelectorVal = returnedSelectorVal.substring(0, endBraceIndex + 1);
          returnedSelectorVal = returnedSelectorVal.replace(/\n/g, '');
          codeEl.innerHTML = codeEl.innerHTML.replace(/\n\n$/, '');
          codeEl.innerHTML += formatCSS(returnedSelectorVal);


          return returnedSelectorVal;
        })
      })();

    }

    return cssTextBuffer.join('\n\n');
  }

  function abbreviateJS(code, grep) {
    let lines = code.split('\n');
    lines[0] += '\n';
    lines[lines.length - 1] += '\n';

    let hasEllipsesAlready = false;

    for (let i = 1; i < lines.length - 1; i++) {
      const line = lines[i];

      if (line.indexOf(grep) === -1) {
        if (hasEllipsesAlready) {
          lines[i] = '';
        } else {
          lines[i] = '…\n';
          hasEllipsesAlready = true;
        }
      } else {
        hasEllipsesAlready = false;
        lines[i] = line + '\n';
      }
    }

    return lines.join('')
  }

  function getConstructorInfo(object) {
    return 'new ' + object.constructor.toString(); // .split(/\n\n/)[0] + '\n\n...\n\n}';
  }

  const selectChangeEvent = (e) => {
    const { target } = e;
    const { value, dataset } = target;
    const { showcodeFor, replaceHtmlRules } = dataset;
    const optionEl = target.getElementsByTagName('option')[target.selectedIndex];
    const { showcodeNotes } = optionEl.dataset;

    const codeEl = document.querySelector('[data-showcode-id="' + showcodeFor + '"]');

    displayStep(value, showcodeNotes, showcodeFor, codeEl, replaceHtmlRules, true);



    requestAnimationFrame(() => {
      target.focus();
    });
  }

  const toggleClickEvent = (e) => {
    e.preventDefault();

    const { id } = e.currentTarget;
    const notesId = id.replace('-view-toggle', '');
    const notesEl = document.getElementById(notesId);
    notesEl.classList.toggle('is-expanded');
  }

  const changeCodeFormattingEvent = (e) => {

    const { currentTarget } = e;
    changeCodeFormatting(currentTarget, true);
  }

  const changeCodeFormatting = (checkboxEl, changeAllCheckboxes) => {
    const wrappedTextClass = 'showcode__has-wrapped-text-in-code';
    let root = checkboxEl.closest('.showcode__container');

    if (root) {
      root = root.querySelector('.showcode');
    } else {
      root = checkboxEl.closest('.showcode');
    }

    if (checkboxEl.checked) {
      root.classList.add(wrappedTextClass);
    } else {
      root.classList.remove(wrappedTextClass);
    }

    if (changeAllCheckboxes) {
      // now check all of these checkboxes
      const wrapTextCheckboxes = document.querySelectorAll('.showcode__wrap-text');
      wrapTextCheckboxes.forEach((el) => {
        el.checked = checkboxEl.checked;
        changeCodeFormatting(el, false);
      })
    }
  }

  function setCodeFormatting(value) {
    const wrapTextCheckboxes = document.querySelectorAll('.showcode__wrap-text');
    wrapTextCheckboxes.forEach((el) => {
      el.checked = value;
      changeCodeFormatting(el, false);
    });
    localStorage.setItem('showcode__wrap-text', value);
    doesCodeWrap = value;
  }

  function setReadMoreCSSVar(notesEl) {
    const overflowEl = notesEl.querySelector('div');


    // The +1 in the formula below is because firefox has rounding errors.
    if (overflowEl && overflowEl.scrollHeight > overflowEl.clientHeight + 1) {
      notesEl.classList.add('showcode__notes--is-overflowed');
    } else {
      notesEl.classList.remove('showcode__notes--is-overflowed');
    }
  }

  /**
   * 
   * @param {String} value - The string containing the `highlight` element in the json package. 
   * @param {(String|Array)} showcodeNotes - HTML containing the notes (the `notes` element in the json package)
   * @param {String} showcodeFor - the ID for the code snippet that will be displayed 
   */
  const displayStep = (value, showcodeNotes, showcodeFor, codeEl, replaceHtmlRules, doScroll) => {

    const notesEl = document.getElementById(showcodeFor + '__notes');
    let code = htmlCache[showcodeFor];
    let replaceRegex;

    codeEl.innerHTML = code;

    setReadMoreCSSVar(notesEl);

    const highlightStrings = value.split('|||');
    let command;

    for (let i = 0; i < highlightStrings.length; i++) {
      const isFinalStep = (i === (highlightStrings.length - 1));
      let highlightString = highlightStrings[i].trim();
      let isFileCommandExecuted = false;

      if (highlightString !== "") {

        // If this is a command, extract it and set highlightString to the remainder.
        // Commands are in the form of:
        // 
        // %COMMAND%
        // 
        // here are some examples
        //
        // "%OPENTAG%fieldset"
        //    Highlight all the fieldset opening tags
        // "%OPENCLOSETAG%fieldset"
        //    Highlight all the fieldset opening and closing tags
        // "%OPENCLOSECONTENTTAG%fieldset"
        //    Highlight all the fieldset content as well as the open and close tags. Note that if
        //    you want to higlight all the fieldsets with a specific ID, you can that with
        //
        //            "%OPENCLOSECONTENTTAG%fieldset id=\"enable-flyout-menu\""
        //
        // "%OPENCLOSECONTENTTAG%fieldset highlghtstring attribute"
        // "%CSS%.foo .bar"
        //    Will show all CSS selectors that match the rule given (in this case, `.foo .bar`).
        //    You can seperate multiple selectors with a semi-colon.
        // "%JS% functionName"
        //    Will show the JS function that matches the string given (in this case, `functionName()`) 
        // "%INLINE% id"
        //    Will show HTML encased in tag with given id
        // "%OUTERHTML% id"
        //    Will show HTML encased in tag with given id (including the tag)

        command = highlightString.match(commandsRe);


        if (command && command.length > 0) {
          let stringSplit, attribute;

          command = command[0];
          highlightString = highlightString.split('%')[2];



          switch (command) {
            case '%OPENTAG%':
            case '%OPENCLOSETAG%':
            case '%OPENCLOSECONTENTTAG%':
              {
                stringSplit = highlightString.split(/\s+/);

                highlightString = stringSplit[0];
                attribute = (stringSplit[1] ? `[^&]*${stringSplit[1]}` : '');

              }
          }
          let splitHighlightString;

          switch (command) {
            case '%OPENTAG%':
              {
                highlightString = `\\s*&lt;${highlightString}${attribute}[\\s\\S]*?&gt;`
                break;
              }
            case '%OPENCLOSETAG%':
              {
                // The [^&] will give false positives if there is a & in the tag before
                // the tag closes. 
                highlightString = `\\s*&lt;[/]?${highlightString}[^&]*&gt;`;
                break;
              }
            case '%OPENCLOSECONTENTTAG%':
              {
                highlightString = `\\s*&lt;${highlightString}${attribute}[\\s\\S]*?/${highlightString}&gt;`
                break;
              }
            case '%BEGINENDCOMMENTTAG%':
              {
                highlightString = highlightString.trim();
                highlightString = `\\s*&lt;!--[^-]*BEGIN-${highlightString}[^-]*--&gt;[\\s\\S]*?&lt;!--[^-]*END-${highlightString}[^-]*--&gt;`;
                break;
              }
            case '%FILE%':
              {
                isFileCommandExecuted = true;
                splitHighlightString = highlightString.split('~');
                const fileName = splitHighlightString[0].trim();
                (async () => {
                  getTextFromFile(fileName).then((text) => {
                    codeEl.innerHTML = this.entify(text.trim());
                    code = this.entify(text.trim());
                    highlightCode(command, highlightString, showcodeFor, notesEl, showcodeNotes, code, codeEl, doScroll, isFinalStep);
                  });
                })();

                highlightString = splitHighlightString[1].trim();

                break;
              }
            case '%CSS%':
              {
                splitHighlightString = highlightString.split('~');
                const cssID = splitHighlightString[0].trim();
                let localCode;

                if (code === htmlCache[showcodeFor]) {
                  code = '';
                }

                highlightString = splitHighlightString[1].trim();
                localCode = getInnerCSS(document.getElementById(cssID), highlightString.split(';'), codeEl);
                localCode = replaceCSSinString(localCode);
                code += formatCSS(localCode);

                //code = Prism.highlight(code, Prism.languages.css, 'css');
                break;
              }
            case '%JS%':
            case '%JSHTML%':
              {
                const funcNames = highlightString.split(';');
                code = '';

                for (let j = 0; j < funcNames.length; j++) {
                  if (debug) { console.debug('j', j, funcNames, funcNames[j]) }

                  // see animatedGIF example on how this works.
                  const funcNameSplit = funcNames[j].split('#');
                  let funcName = funcNameSplit[0].trim();
                  const grep = funcNameSplit.length === 2 ? funcNameSplit[1].trim() : null;
                  let funcCode;

                  const toHighlightSplit = funcName.split('~');
                  if (toHighlightSplit.length === 2) {
                    funcName = toHighlightSplit[0];
                    highlightString = toHighlightSplit[1];
                  }

                  if (funcName.indexOf('\'') === 0) {
                    // print out the funcName literally
                    funcCode = funcName.replace(/'/g, '');
                  } else {
                    const evalFuncName = `jsObjs.${funcName}`;
                    let evalFuncString;
                    try { 
                      evalFuncString = eval(evalFuncName).toString();
                    } catch (ex) {
                      throw (`The function ${funcName}() was not registered to showcode.`);
                    }
                    if (evalFuncString.indexOf('object Object') >= 0) {
                      funcCode = getConstructorInfo(evalFuncName);
                    } else {
                      if (funcName.indexOf('.') >= 0) {
                        // this is inside an object, so let's get the object context
                      }

                      funcCode = evalFuncString;
                    }


                    if (grep) {
                      funcCode = abbreviateJS(funcCode, grep);
                    }

                    //funcCode = indent.js(funcCode, {tabString: '  '});

                    // If funcName is an object property, prefix the funcCode
                    // with `this.propertyName =`.  Otherwise, prefix with
                    // `const funcName =`.
                    if (command === '%JSHTML%') {
                      const tmpNode = document.createElement('div');
                      tmpNode.innerHTML = funcCode;
                      formatHTMLInBlock(tmpNode, replaceHtmlRules);
                      code = this.entify(formatHTML(funcCode));
                      funcCode = '';
                    } else if (funcName.indexOf('.') > -1) {
                      const propertyName = funcName.split('.')[1];
                      funcCode = `this.${propertyName} = ${funcCode}`;
                    } else {
                      funcCode = `const ${funcName} = ${funcCode}`;
                    }
                  }

                  //funcCode = this.entify(funcCode);

                  code = code + funcCode + '\n\n';
                }


                code = indent.js(code, { tabString: '  ' });
                code = this.entify(code);

                //code = Prism.highlight(code, Prism.languages.javascript, 'javascript');
                break;
              }
            case "%INLINE%":
              {
                const codeTemplateEl = document.getElementById(highlightString.trim());
                if (codeTemplateEl) {
                  const { type } = codeTemplateEl.dataset;

                  if (type === 'less' || type === 'css') {
                    code = formatCSS(codeTemplateEl.innerHTML);
                  } else if (type === 'text') {
                    code = this.entify(codeTemplateEl.innerHTML);
                  } else {
                    code = codeTemplateEl.innerHTML;

                    if (codeTemplateEl.nodeName === 'SCRIPT') {
                      code = indent.js(code, { tabString: '  ' });
                      //code = this.entify(code);
                    } else {
                      code = this.entify(formatHTML(code));
                    }

                  }
                }

                break;
              }
            case "%OUTERHTML%":
            case "%INNERHTML%":
              {
                const id = highlightString.trim();
                const HTMLTemplateEl = document.getElementById(id);
                const htmlAttr = (command === '%OUTERHTML%' ? 'outerHTML' : 'innerHTML');
                if (HTMLTemplateEl) {
                  let html = HTMLTemplateEl[htmlAttr];
                  html = html.replace(`id="${id}"`, `id='${id}'`);
                  html = html.replace(/\s{2,}/g, " ");
                  code = this.entify(formatHTML(html));
                  highlightString = null;
                }

                break;
              }
            default:
              {
                console.warn('Invalid command used', command);
              }
          }
          code = highlightCode(command, highlightString, showcodeFor, notesEl, showcodeNotes, code, codeEl, doScroll, isFinalStep && !isFileCommandExecuted);
        } else {
          code = highlightCode(command, highlightString, showcodeFor, notesEl, showcodeNotes, code , codeEl, doScroll, isFinalStep);
        }

      } else if (isFinalStep) {
        notesEl.innerHTML = '';
      }

      if (command !== '%CSS%' && command !== '%JS%') {
        code = code.replace(replaceRegex, highlightFunc);
        // codeEl.innerHTML = code;
      }


    }

    /* if (doScroll) {
      this.scrollToHighlightedText(codeEl);
    } */

    
    setReadMoreCSSVar(notesEl);
  }

  const highlightCode = (command, highlightString, showcodeFor, notesEl, showcodeNotes, code, codeEl, doScroll, isFinalStep) => {
    let replaceRegex;
    if (highlightString !== null) {
      highlightString = highlightString.replace(space, nbspStr);
      const attribute = highlightString.split('=')[0];
      const hasValue = (highlightString.indexOf('=') >= 0)

      if (hasValue) {
        replaceRegex = new RegExp(highlightString, 'g');
      } else {

        if (command === '%FILE%') {
          replaceRegex = new RegExp(highlightString, 'g');
          // 'for' is a special case -- we don't want it to match <form>.
        } else if (highlightString === 'for') {
          replaceRegex = new RegExp(highlightString + '="[^=]*"', 'g');
        } else {
          replaceRegex = new RegExp(highlightString + '(="[^=]*")*', 'g');
        }

        // get all the unique matches
        const matches = [...new Set(code.match(replaceRegex))];

        // if the highlightString is one of the relationship attributes,
        // highlight the ids these matches points to.
        if (relationshipAttributes.indexOf(attribute) >= 0) {
          for (let j = 0; j < matches.length; j++) {
            let ids = matches[j].split('"')[1];

            if ((attribute === 'href' || attribute === 'xlink:href') && ids.indexOf('#') === 0) {
              ids = ids.substring(1);
            }

            ids = ids.split(/\s+/);

            for (let k = 0; k < ids.length; k++) {
              const id = ids[k];
              const idReplaceRegex = new RegExp(`id="${id}"`);
              code = code.replace(idReplaceRegex, highlightFunc);
            }
          }
        }
      }

      if (command !== '%CSS%' && command !== '%JS%') {
        code = code.replace(replaceRegex, highlightFunc);
      }

    }


    codeEl.innerHTML = code;

    this.scrollToHighlightedText(doScroll, codeEl);

    // Set up the ARIA alert to announce changes to screen readers.
    if (isFinalStep) {
      const query = `[data-showcode-id="${showcodeFor}"] > .showcode__highlight`;
      const changesAlertQuery = `#${showcodeFor}__changes-alert`;
      const highlightedItems = document.querySelectorAll(`[data-showcode-id="${showcodeFor}"] > .showcode__highlight`);
      const changesAlertEl = document.querySelector(changesAlertQuery);
      let screenReaderAlert;

      switch (highlightedItems.length) {
        case 0:
          screenReaderAlert = '(Updated code below.)';
          break;
        case 1:
          screenReaderAlert = "(Now highlighting 1 item in the code below.)";
          break;
        default: 
          screenReaderAlert = `(Now highlighting ${highlightedItems.length} items in the code below.)`;    
      }

      notesEl.innerHTML = showcodeNotes || '';
      changesAlertEl.innerHTML = showcodeNotes ? `${showcodeNotes} ${screenReaderAlert}` : ''; 
    }



    return code;

  }

  this.getStickyContainersOffset = (el) => {
    const stickyEls = document.querySelectorAll('[data-is-sticky="top"]');
    let offset = 0;
    
    stickyEls.forEach((stickyEl) => {
      //if (el.contains(stickyEl)) {
        offset += stickyEl.offsetHeight;
      //}
    });

    console.log('offset', offset);
    return offset
  }

  this.scrollToHighlightedText = (doScroll, codeEl) => {
    // now ... let's see if we can scroll the page to the first highlighted part
    const firstHighlightedElement = codeEl.querySelector('.showcode__highlight');
    const containerEl = codeEl.closest('.showcode__container');
    const stepsEl = containerEl.querySelector('.showcode__steps');
    const uiEl = containerEl.querySelector('.showcode__ui');

    // if the code sample does not have a UI, then bail
    if (uiEl === null) {
      return;
    }
 
    const stickyContainersOffset = uiEl.offsetHeight + this.getStickyContainersOffset(codeEl) + 10;
    const { body } = document;
   
    // If the pause animations checkbox is checked, 
    // set behavior to "auto" (no animatied scrolling).
    // Otherwise, set it to "smooth" (animated scrolling).
    const behavior = body.classList.contains('pause-anim-control__prefers-reduced-motion') ? 'auto' : 'smooth';

    
    if (firstHighlightedElement) {

      // set the value correctly in the .scrollIntoView() method.
      firstHighlightedElement.style.scrollMarginTop = stickyContainersOffset + 'px';
      if (doScroll) {
        firstHighlightedElement.scrollIntoView({ behavior: behavior, block: 'start', left: 0 });
      }

      
    }

    this.scrollIntoViewIfOffscreen(containerEl, stepsEl, firstHighlightedElement, behavior);
  }

  this.scrollIntoViewIfOffscreen = (containerEl, stepsEl, firstHighlightedElement, behavior) => {
    if (!elementIsVisibleInViewport(containerEl, true)) { 
      const { top } = stepsEl.getBoundingClientRect();

      if (top < 0) {
        
        window.scrollTo(0, window.scrollY + top);

        if (firstHighlightedElement) {
          firstHighlightedElement.scrollIntoView({ behavior: behavior, block: 'start', left: 0 });

          /* setTimeout(() => {
            firstHighlightedElement.scrollIntoView({ behavior: behavior, block: 'start', left: 0 });
          }, 0.71); */
        } else {
          containerEl.scrollIntoView({ behavior: behavior, block: 'start', left: 0, top: 0 })
        }
        
      
      }
    }
  }
  
  // From https://www.30secondsofcode.org/js/s/element-is-visible-in-viewport/
  // elementIsVisibleInViewport(el); // false - (not fully visible)
  // elementIsVisibleInViewport(el, true); // true - (partially visible)
  const elementIsVisibleInViewport = (el, partiallyVisible = false) => {
    const { top, left, bottom, right } = el.getBoundingClientRect();
    const { innerHeight, innerWidth } = window;
    return partiallyVisible
      ? ((top > 0 && top < innerHeight) ||
          (bottom > 0 && bottom < innerHeight)) &&
          ((left > 0 && left < innerWidth) || (right > 0 && right < innerWidth))
      : top >= 0 && left >= 0 && bottom <= innerHeight && right <= innerWidth;
  };



  this.addJsObj('scrollToHighlightedText', this.scrollToHighlightedText);

  function removeBlankLines(almostFormatted) {
    let lines = almostFormatted.split('\n');
    let fixedLines = [];

    for (var i = 0; i < lines.length; i++) {
      const line = lines[i];
      if (line.search(blankString) < 0) {
        fixedLines.push(indentAttrs(line));
      }
    }

    return fixedLines.join('\n');
  }

  function explodeLine(s) {
    const explodedLine = s.split(' ');

    for (let i = 0; i < explodedLine.length;) {
      const line = explodedLine[i];
      // number of strings is odd, then join with next line;
      if (line.split('"').length % 2 === 0) {
        explodedLine[i] = line + ' ' + explodedLine[i + 1];
        explodedLine.splice(i + 1, 1);
      } else {
        i++;
      }
    }

    return explodedLine;
  }

  function indentAttrs(line) {
    const isComment = (line.indexOf('<!--') >= 0);

    if (line.search(tagLine) >= 0 && !isComment && line.length > 30) {
      const begin = line.match(beginningSpaces)[0];
      const trimmedLine = line.trim();
      const explodedLine = explodeLine(trimmedLine)
      const formattedLine = explodedLine.join('\n' + begin + '  ');

      return (begin + formattedLine).replace(gt, '\n' + begin + '>');
    } else if (isComment) {
      return '\n' + line + '\n';
    } else {
      return line;
    }
  }

  function seperateTags(html) {
    const s = html.replace(gt, '>\n').replace(lt, '\n<');
    return s;
  }

  function insertEllipses(html) {
    const s = html.replace(ellipsesRe, '\n\n$1\n\n');
    return s;
  }

  function removeBlankAttrValues(html) {
    const s = html.replace(blankAttrValueRe, '$1');
    return s;
  }

  /**
   * 
   * @param {Element} htmlBlock - DOM node to put formatted code 
   * @param {String} originalHTMLId - ID of DOM node that contains the code to display. If this is set to document, it's the whole document.
   * @param {JSON} replaceRulesJson - Replace rules.
   */
  const displayCode = (htmlBlock, originalHTMLId, replaceRulesJson) => {
    const showOuterHTML = (htmlBlock.dataset.showcodeDisplayOuterhtml === 'true');

    const isWholeDoc = (originalHTMLId === 'document');
    let block;

    if (isWholeDoc) {
      block = document.querySelector('html').cloneNode(true);
    } else {
      const $originalHTML = document.getElementById(originalHTMLId);
      if ($originalHTML) {
        block = $originalHTML.cloneNode(true);
      } else {
        throw `Showcode cannot display code for element with ID "${originalHTMLId}". That node doesn't exist.`
      }
    }

    if (block) {
      const isJS = (block.dataset.showcodeIsJs === 'true')
      
      formatHTMLInBlock(block, replaceRulesJson)

      // let's do search and replace here
      const unformattedHTML = (isWholeDoc || showOuterHTML) ? block.outerHTML : block.innerHTML;
      let formattedHTML;
      
      if (isJS) {
        formattedHTML = unformattedHTML.replace(HTMLCommentBegin, '').replace(HTMLCommentEnd, '');
      } else {
        formattedHTML = formatHTML(unformattedHTML);
      }
      //indent.html(unformattedHTML, {tabString: ' '});
      const entifiedHTML = this.entify(formattedHTML, { ignoreSpace: true });
      htmlCache[originalHTMLId] = entifiedHTML;
      codeblockCache[originalHTMLId] = block;
      htmlBlock.innerHTML = entifiedHTML.trim();
    }
  }

  function formatHTMLInBlock(block, replaceRulesJson) {
    try {

      for (let i in replaceRulesJson) {
        const nodesToReplace = block.querySelectorAll(i);

        for (let j = 0; j < nodesToReplace.length; j++) {
          const node = nodesToReplace[j];
          const content = replaceRulesJson[i];
          if (Array.isArray(content)) {
            node.innerHTML = content.join('');
          } else {
            node.innerHTML = content;
          }
        }
      }
    } catch (ex) {
      console.error(ex);
    }
  }

  function replaceCSSinString(string) {
    const replaceRulesJson = {
      "content: url[^;]*;": "/* Image URL below obfuscated */\ncontent: url(' ... ');"
    };

    let newString = string;
    try {
      for (let i in replaceRulesJson) {
        const patternToReplace = new RegExp(i, 'g');
        const content = replaceRulesJson[i];
        newString = newString.replace(patternToReplace, content);
      }
    } catch (ex) {
      console.error(ex);
      console.error('string:', string);
      console.error('replaceRulesJson:', replaceRulesJson);
      return 'Error.';
    }
    return newString;
  }


  function formatHTML(unformattedHTML) {
    let s = removeBlankAttrValues(
      insertEllipses(
        removeBlankLines(
          indent.html(
            seperateTags(unformattedHTML), { tabString: '  ' }
          )
        )
      )
    );

    // now, let's ensure <title></title> always appears on one line.
    s = s.replace(/<title>[\s]*<\/title>/, '<title></title>');

    // Now also separate <template> tags;
    s = s.replace(/<\/template>/g, '</template>\n');
    return s;
  }

  const displayStepsWidget = (codeblockId, stepsJson, replaceHtmlRules) => {
    const widgetId = codeblockId + '__steps';
    const toggleId = codeblockId + '__notes-view-toggle';
    const wrapTextId = codeblockId + '__wrap-text';
    const selectEl = document.createElement('SELECT');
    const labelEl = document.createElement('LABEL');
    const defaultOptionEl = document.createElement('OPTION');
    const widgetContainerEl = document.getElementById(widgetId);
    const toggleEl = document.getElementById(toggleId);
    const wrapTextEl = document.getElementById(wrapTextId);
    const codeEl = document.querySelector('[data-showcode-id="' + codeblockId + '"]');


    selectEl.className = 'showcode__select';
    if (widgetContainerEl) {

      selectEl.id = widgetId + '--select';
      selectEl.dataset.showcodeFor = codeblockId;
      labelEl.htmlFor = selectEl.id;
      labelEl.className = 'showcode__select-label';
      labelEl.innerHTML = 'Code to highlight:'

      defaultOptionEl.innerHTML = '';
      defaultOptionEl.value = '';
      selectEl.appendChild(defaultOptionEl);
      selectEl.dataset.replaceHtmlRules = this.entify(JSON.stringify(replaceHtmlRules), {
        ignoreReturns: true,
        ignoreSpace: true
      });

      if (stepsJson) {
        try {
          if (stepsJson.length > 0) {
            for (let i in stepsJson) {
              const optionEl = document.createElement('OPTION');
              const step = stepsJson[i];
              const { label, highlight, notes } = step;

              optionEl.value = highlight;

              switch (typeof notes) {
                case "object":
                  // assume it's an array.  Make it into a string
                  optionEl.dataset.showcodeNotes = notes.join(' ');
                  break;
                default:
                  optionEl.dataset.showcodeNotes = notes || '';
              }
              optionEl.innerHTML = `Step #${parseInt(i) + 1}: ${label}`;


              selectEl.appendChild(optionEl);

            }

            widgetContainerEl.appendChild(labelEl)
            widgetContainerEl.appendChild(selectEl);

            selectEl.addEventListener('change', selectChangeEvent);
            toggleEl.addEventListener('click', toggleClickEvent);
          } else {
            const { label, highlight, notes } = stepsJson[0];
            widgetContainerEl.innerHTML = `<p>${label}</p>`;
            displayStep(highlight, notes, codeblockId, codeEl, replaceHtmlRules, false);
          }

        } catch (ex) {
          console.error(ex);
        }
      }
    } else {
      // This is for a static, non-interactive showcode block.
      const step = stepsJson && stepsJson[0];
      
      displayStep(step.highlight, step.notes, codeblockId, codeEl, replaceHtmlRules, false)
      return;
    }
  }

  const showCodeBlocks = () => {
    for (let i = 0; i < htmlBlocks.length; i++) {
      const htmlBlock = htmlBlocks[i];
      const { dataset } = htmlBlock;
      const { showcodeProps } = dataset;

      if (!showcodeProps) {
        console.info('Block ' + i + ' does not have any props');
      } else {
        try {
          const propsEl = document.getElementById(showcodeProps);
          const { showcodeId } = dataset;

          if (propsEl) {
            const json = JSON.parse(propsEl.innerHTML);
            const { replaceHtmlRules, steps } = json;
            

            displayCode(htmlBlock, showcodeId, replaceHtmlRules);
            displayStepsWidget(showcodeId, steps, replaceHtmlRules);
          } else {
            console.info('No props file: ', showcodeProps);
            displayCode(htmlBlock, showcodeId, {});
          }
        } catch (ex) {
          console.error(ex);
        }
      }
    }
    setCodeFormatting(doesCodeWrap);

  }


  // Returns a function, that, when invoked, will only be triggered at most once
  // during a given window of time. Normally, the throttled function will run
  // as much as it can, without ever going more than once per `wait` duration;
  // but if you'd like to disable the execution on the leading edge, pass
  // `{leading: false}`. To disable execution on the trailing edge, ditto.
  //
  // From: https://stackoverflow.com/questions/63564213/how-to-use-a-function-that-returns-another-function
  function throttle(func, wait, options) {
    var context, args, result;
    var timeout = null;
    var previous = 0;
    if (!options) options = {};
    var later = function () {
      previous = options.leading === false ? 0 : Date.now();
      timeout = null;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    };
    return function () {
      var now = Date.now();
      if (!previous && options.leading === false) previous = now;
      var remaining = wait - (now - previous);
      context = this;
      args = arguments;
      if (remaining <= 0 || remaining > wait) {
        if (timeout) {
          clearTimeout(timeout);
          timeout = null;
        }
        previous = now;
        result = func.apply(context, args);
        if (!timeout) context = args = null;
      } else if (!timeout && options.trailing !== false) {
        timeout = setTimeout(later, remaining);
      }
      return result;
    };
  }

  const handleResize = () => {
    const notesEls = document.querySelectorAll('.showcode__notes');
    notesEls.forEach((el) => {
      el.classList.remove('is-expanded');
      setReadMoreCSSVar(el);
    })
  }

  const scrollEvent = (e) => {
    const { target } = e;

    if (target.dataset.showcodeId || target.classList.contains('showcode--no-js')) {
      const { parentNode } = target;
      const { classList } = parentNode;
      if (target.scrollLeft === 0) {
        classList.remove('fade-both', 'fade-left');
      } else if (target.scrollLeft + target.offsetWidth > target.scrollWidth - 10) {
        classList.add('fade-left');
        classList.remove('fade-both');
      } else {
        classList.add('fade-both');
        classList.remove('fade-left');
      }
    }
  }

  function setEvents() {
    document.body.addEventListener('scroll', throttle(scrollEvent, 100), true)
    window.addEventListener("resize", throttle(handleResize, 100));
    window.addEventListener("orientationchange", throttle(handleResize, 100));

    const wrapTextEls = document.querySelectorAll('.showcode__wrap-text');

    wrapTextEls.forEach((el) => {
      el.addEventListener('click', changeCodeFormattingEvent);
    });
  }

  function jumpToDeepLink() {
    const { hash } = window.location;

    if (hash) {
      const el = document.querySelector(hash);
      if (el) {
        el.scrollIntoView();
      }
    }
  }


  this.init = () => {
    showCodeBlocks();
    setEvents();
    jumpToDeepLink();
  }

}

showcode.init();


export default showcode;