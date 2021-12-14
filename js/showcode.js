const showcode = new (function () {
  const htmlBlocks = document.querySelectorAll("[data-showcode-props]");
  const htmlCache = {};
  const codeblockCache = {};
  const debug = false;

  // Needed by entify()
  const amp = /&/g;
  const lt = /</g;
  const gt = />/g;
  const tab = /\t/g;
  const space = / /g;
  const cr = /\n/g; // UNIX carriage return
  const mscr = /\r\n/g; // Microsoft carriage return
  const nbspStr = '\u00a0';
  const nbsp = /\u00a0/g;
  const beginningSpaces = /^\s*/g;
  const tagLine = /^\s*</;
  const blankString = /^\s*$/;
  const comment = /<\!--/;
  const ellipsesRe = /(\s*\.\.\.)/g;
  const blankAttrValueRe = /(required|novalidate|open|disabled)=\"\"/g;
  const commandsRe = /^%[A-Z]*?%/;
  

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
    'href'
  ]

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
    return '<span class="showcode__highlight">' + s + '</span>'; 
  }

  function formatCSS(localCode) {
    //localCode = localCode.replace(/\}/g, '\n}').replace(/([\{;])/g, '$1\n').replace(/\n\s*\n/, '\n\n');
    localCode = localCode.replace(/([\{\,;])/g, '$1\n').replace(/\n\s*\n/, '\n\n');
    localCode = indent.css(localCode, {tabString: '  '});
    return localCode + '\n\n';
  }

  const getRawCSSData = async (el) => {
    const response = await fetch(el.href).then(response => {
      
      return response.clone().text();
    });

    return response;
  } 

  const getInnerCSS = (el, selectorPropertyPairs, codeEl) => {

    const showAllCSS = (selectorPropertyPairs.length === 1 && selectorPropertyPairs[0] === '');
    
    const cssTextBuffer = [];
    const { cssRules } = el.sheet;
    for (let i=0; i<cssRules.length; i++) {

      if (debug) { console.log('x', showAllCSS); }
      const cssRule = cssRules[i].cssText.trim();

      for (let j=0; j<selectorPropertyPairs.length; j++) {
        const selectorPropertyPair = selectorPropertyPairs[j].trim();
        const properties = selectorPropertyPair.split('|');
        const selector = properties[0];

        properties.shift();

        if (debug) { console.log(cssRule, selector); }

        if (showAllCSS || cssRule.indexOf(selector + ' ') === 0) {
          // Now we must highlight the properties.
          let code = cssRule;
          //code = code.replace(/\}/g, '\n}').replace(/([\{;])/g, '$1\n').replace(/\n\s*\n/, '\n\n');
          //code = indent.css(code, {tabString: '  '});



          for (let k=0; k<properties.length; k++) {
            let propertyRegEx = new RegExp(`${properties[k]}\:[^;]*\\;`);
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
      const r = (async () => {
        getRawCSSData(el).then((css) => {
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
    lines[lines.length - 1] +='\n';

    let hasEllipsesAlready = false;

    for (let i=1; i<lines.length - 1; i++) {
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
    const optionValue = 'option[value=\''+ value + '\']'
    const { showcodeFor, replaceHtmlRules } = dataset;
    const optionEl = target.getElementsByTagName('option')[target.selectedIndex];
    const { showcodeNotes } = optionEl.dataset;
    const { body } = document;

    const codeEl = document.querySelector('[data-showcode-id="'+ showcodeFor + '"]');

    displayStep(value, showcodeNotes, showcodeFor, codeEl, replaceHtmlRules, true);

    

    requestAnimationFrame(() => {
      target.focus();
    },2000);
  }

  const toggleClickEvent = (e) => {
    const { id } = e.currentTarget;
    e.preventDefault();
    const notesId = id.replace('-view-toggle', '');
    const notesEl = document.getElementById(notesId);
    notesEl.classList.toggle('is-expanded');
  }

  function setReadMoreCSSVar(notesEl) {
    const overflowEl = notesEl.querySelector('div');

    if (overflowEl && overflowEl.scrollHeight > overflowEl.clientHeight) {
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


    notesEl.innerHTML = showcodeNotes ? `<div>${showcodeNotes}</div>` : '';

    setReadMoreCSSVar(notesEl);

    const highlightStrings = value.split('|||');
    let command;

    for (let i=0; i<highlightStrings.length; i++) {
      let highlightString = highlightStrings[i].trim();

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
        //    Highlight all the fieldset content as well as the open and close tags. Note that
        // "%OPENCLOSECONTENTTAG%fieldset highlghtstring attribute"
        // "%CSS%.foo .bar"
        //    Will show all CSS selectors that match the rule given (in this case, `.foo .bar`).
        //    You can seperate multiple selectors with a semi-colon.
        // "%JS% functionName"
        //    Will show the JS function that matches the string given (in this case, `functionName()`) 
        // "%INLINE% id"
        //    Will show HTML comment encased in div with given id

        command = highlightString.match(commandsRe);

        
        if (command && command.length > 0) {
          let stringSplit, attribute;
          
          command = command[0];
          highlightString = highlightString.split('%')[2];
          
          
          
          switch(command) {
            case '%OPENTAG%':
            case '%OPENCLOSETAG%':
            case '%OPENCLOSECONTENTTAG%':
              stringSplit = highlightString.split(/\s+/);
              
              highlightString = stringSplit[0];
              attribute = (stringSplit[1] ? `[^&]*${stringSplit[1]}` : '');
              
              
          }
          
          switch (command) {
            case '%OPENTAG%':
              highlightString = `\\s*&lt;${highlightString}${attribute}[\\s\\S]*?&gt;`
              break;
            case '%OPENCLOSETAG%':
              // The [^&] will give false positives if there is a & in the tag before
              // the tag closes. 
              highlightString = `\\s*&lt;[\/]?${highlightString}[^&]*&gt;`;
              break;
            case '%OPENCLOSECONTENTTAG%':
              highlightString = `\\s*&lt;${highlightString}${attribute}[\\s\\S]*?\/${highlightString}&gt;`
              break;
            case '%CSS%':
              const splitHighlightString = highlightString.split('~');
              const cssID = splitHighlightString[0].trim();
              let localCode;

              if (code === htmlCache[showcodeFor]) {
                code = '';
              }

              highlightString = splitHighlightString[1].trim();
              localCode = getInnerCSS(document.getElementById(cssID), highlightString.split(';'), codeEl);
              code += formatCSS(localCode);
              //code = Prism.highlight(code, Prism.languages.css, 'css');
              break;
            case '%JS%':
            case '%JSHTML%':
              const funcNames = highlightString.split(';');
              code = '';

              for (let j=0; j<funcNames.length; j++) {
                if (debug) { console.log('j', j, funcNames, funcNames[j]) }

                // see animatedGIF example on how this works.
                const funcNameSplit = funcNames[j].split('#');
                let funcName = funcNameSplit[0].trim();
                const grep = funcNameSplit.length === 2 ? funcNameSplit[1].trim() : null;
                let funcCode;
                let funcObjectCode;

                const toHighlightSplit = funcName.split('~');
                if (toHighlightSplit.length === 2) {
                  funcName = toHighlightSplit[0];
                  highlightString = toHighlightSplit[1];
                }

                if (funcName.indexOf('\'') === 0) {
                  // print out the funcName literally
                  funcCode = funcName.replace(/'/g, '');
                } else {
                  const evalFuncName = eval(funcName);
                  const evalFuncString = evalFuncName.toString();
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
                    const replaceRulesJson = JSON.parse(this.unentify(replaceHtmlRules));
                    const showcodeProps = `${showcodeFor}-props`;
                    const json = JSON.parse(document.getElementById(showcodeProps).innerHTML);
                    const {steps} = json;
                    const tmpNode = document.createElement('div');
                    tmpNode.innerHTML = funcCode;
                    formatHTMLInBlock(tmpNode, );
                    code = this.entify(formatHTML(funcCode));
                    funcCode = '';
                  } else if (funcName.indexOf('.') > -1) {
                    const propertyName = funcName.split('.')[1];
                    funcCode = `this.${propertyName} = ${funcCode}`;
                  } else {
                    funcCode = `const ${funcName} = ${funcCode}`;
                  }
                }

                funcCode = this.entify(funcCode);

                code = code + funcCode + '\n\n';
              }

              code = indent.js(code, {tabString: '  '});

              //code = Prism.highlight(code, Prism.languages.javascript, 'javascript');
              break;
            case "%INLINE%":
              console.log(`-${highlightString}-`);
              const codeTemplateEl = document.getElementById(highlightString.trim());
              if (codeTemplateEl) {
                if (codeTemplateEl.dataset.type === 'less') {
                  code = formatCSS(codeTemplateEl.innerHTML);
                } else {
                  code = codeTemplateEl.innerHTML;
                }
              }
              
              break;
            default: 
              console.warn('Invalid command used', command);
          }
        }

        highlightString=highlightString.replace(space, nbspStr);
        const attribute = highlightString.split('=')[0];
        const hasValue = (highlightString.indexOf('=') >= 0)

        if (hasValue) {
          replaceRegex = new RegExp(highlightString, 'g');
        } else {

          // 'for' is a special case -- we don't want it to match <form>.
          if (highlightString === 'for') {
            replaceRegex = new RegExp(highlightString + '="[^=]*"', 'g');
          } else {
            replaceRegex = new RegExp(highlightString + '(="[^=]*")*', 'g');
          }

          // get all the unique matches
          const matches = [...new Set(code.match(replaceRegex))];
          
          // if the highlightString is one of the relationship attributes,
          // highlight the ids these matches points to.
          if (relationshipAttributes.indexOf(attribute) >= 0 ) {
            for (let j=0; j<matches.length; j++) {
              let ids = matches[j].split('"')[1];

              if (attribute === 'href' && ids.indexOf('#') === 0) {
                ids = ids.substring(1);
              }

              ids = ids.split(/\s+/);

              for (let k=0; k<ids.length; k++) {
                const id = ids[k];
                const idReplaceRegex = new RegExp(`id="${id}"`);
                code = code.replace(idReplaceRegex, highlightFunc);
              }

            }  
          
          }
        }
      }

      if (command !== '%CSS%' && command !== '%JS%') {
        code = code.replace(replaceRegex, highlightFunc);
      }

     
    }


    codeEl.innerHTML = code;

    if (doScroll) {
      // now ... let's see if we can scroll the page to the first highlighted part
      const firstHighlightdElement = codeEl.querySelector('.showcode__highlight');
      

      if (firstHighlightdElement) {
        const { body } = document;
        const componentRoot = codeEl.closest('.showcode');
        const uiEl = componentRoot.querySelector('.showcode__ui');
        const highlightRect = firstHighlightdElement.getBoundingClientRect();
        const uiRect = uiEl.getBoundingClientRect();
        const behavior = body.classList.contains('play-pause-animation-button__prefers-reduced-motion') ? 'auto' : 'smooth';

        firstHighlightdElement.scrollIntoView({ behavior: behavior, block: 'center', left: 0 });
      }
    }
  }

  function removeBlankLines(almostFormatted) {
    let lines = almostFormatted.split('\n');
    let fixedLines = [];

    for (var i=0; i<lines.length; i++) {
      const line = lines[i];
      const nextLine = lines[i+1]
      if (line.search(blankString) < 0 ) {
        fixedLines.push(indentAttrs(line));
      }
    }

    return fixedLines.join('\n');
  }

  function explodeLine(s) {
    const explodedLine = s.split(' ');

    for (let i=0; i<explodedLine.length; ) {
      const line = explodedLine[i];
      // number of strings is odd, then join with next line;
      if (line.split('"').length % 2 === 0) {
        explodedLine[i] = line + ' ' + explodedLine[i+1];
        explodedLine.splice(i+1, 1);
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

  function insertEllipses(html){
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
    const isWholeDoc = (originalHTMLId === 'document');
    let block;
    
    if (isWholeDoc) {
      block = document.querySelector('html').cloneNode(true);
    } else {
      block = document.getElementById(originalHTMLId).cloneNode(true);
    }

    if (block) {
      formatHTMLInBlock(block, replaceRulesJson)
      // let's do search and replace here
      const unformattedHTML = isWholeDoc ? block.outerHTML : block.innerHTML;
      const formattedHTML = formatHTML(unformattedHTML)
      //indent.html(unformattedHTML, {tabString: ' '});
      const entifiedHTML = this.entify(formattedHTML, {ignoreSpace: true});
      htmlCache[originalHTMLId] = entifiedHTML;
      codeblockCache[originalHTMLId] = block;
      htmlBlock.innerHTML = entifiedHTML.trim();
    }
  }

  function formatHTMLInBlock(block, replaceRulesJson) {
    try {

      for (let i in replaceRulesJson) {
        const nodesToReplace = block.querySelectorAll(i);

        for (let j in nodesToReplace) {
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
      console.log(ex);
    }
  }
  

  function formatHTML(unformattedHTML) {
    let s = removeBlankAttrValues(
      insertEllipses(
        removeBlankLines(
          indent.html(
            seperateTags(unformattedHTML), {tabString: '  '}
          )
        )
      )
    );

    // now, let's ensure <title></title> always appears on one line.
    s = s.replace(/<title>[\s]*<\/title>/, '<title></title>');
    return s;
  }

  const displayStepsWidget = (codeblockId, stepsJson, replaceHtmlRules) => {
    const widgetId =  codeblockId + '__steps';
    const notesId = codeblockId + '__notes';
    const toggleId = codeblockId + '__notes-view-toggle';
    const selectEl = document.createElement('SELECT');
    const labelEl = document.createElement('LABEL');
    const defaultOptionEl = document.createElement('OPTION');
    const widgetContainerEl = document.getElementById(widgetId);
    const notesEl = document.getElementById(notesId);
    const toggleEl = document.getElementById(toggleId);
    const codeEl = document.querySelector('[data-showcode-id="'+ codeblockId + '"]');


    if (widgetContainerEl) {

      selectEl.id = widgetId + '--select';
      selectEl.dataset.showcodeFor = codeblockId;
      labelEl.htmlFor = selectEl.id;
      labelEl.className = 'showcode__select-label';
      labelEl.innerHTML = 'Code to highlight:'

      defaultOptionEl.innerHTML = '';
      defaultOptionEl.value='';
      selectEl.appendChild(defaultOptionEl);
      selectEl.dataset.replaceHtmlRules = this.entify(JSON.stringify(replaceHtmlRules), {
        ignoreReturns: true,
        ignoreSpace: true
      });

      if (stepsJson) {
        try {
          console.log('whoah!');
          if (stepsJson.length > 1) {
            for (let i in stepsJson) {
              const optionEl = document.createElement('OPTION');
              const step = stepsJson[i];
              const { label, highlight, notes } = step;

              optionEl.value = highlight;

              switch(typeof notes) {
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
          console.log(ex);
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
        console.error('Block ' + i + ' does not have any props');
      } else {
        try {
          const json = JSON.parse(document.getElementById(showcodeProps).innerHTML);
          const {replaceHtmlRules, steps} = json;
          const { showcodeId } = dataset;
          
          displayCode(htmlBlock, showcodeId, replaceHtmlRules);
          displayStepsWidget(showcodeId, steps, replaceHtmlRules);
        } catch (ex) {
          console.error(ex);
        }
      }
    }
  }

  function debounce(func, wait, immediate) {
    var timeout;

    return function () {
        var context = this,
            args = arguments;

        var later = function () {
            timeout = null;

            if (!immediate) {
                func.apply(context, args);
            }
        };

        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait || 200);

        if (callNow) {
            func.apply(context, args);
        }
    };
  }

  // Returns a function, that, when invoked, will only be triggered at most once
  // during a given window of time. Normally, the throttled function will run
  // as much as it can, without ever going more than once per `wait` duration;
  // but if you'd like to disable the execution on the leading edge, pass
  // `{leading: false}`. To disable execution on the trailing edge, ditto.
  function throttle(func, wait, options) {
    var context, args, result;
    var timeout = null;
    var previous = 0;
    if (!options) options = {};
    var later = function() {
      previous = options.leading === false ? 0 : Date.now();
      timeout = null;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    };
    return function() {
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

  const handleResize = (e) => {
    const notesEls = document.querySelectorAll('.showcode__notes');
    notesEls.forEach((el) => {
      el.classList.remove('is-expanded');
      setReadMoreCSSVar(el);
    })
  }

  const scrollEvent = (e) => {
    const { target } = e;

    if (target.dataset.showcodeId) {
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
  }

  this.init = () => {
    showCodeBlocks();
    setEvents();
    //smoothscroll.polyfill();
  }
})();

showcode.init();
