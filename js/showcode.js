const showcode = new (function () {
  const htmlBlocks = document.querySelectorAll("[data-showcode-props]");
  const htmlCache = {};
  const codeblockCache = {};

  // Needed by entify()
  const amp = /&/g;
  const lt = /</g;
  const gt = />/g;
  const tab = /\t/g;
  const space = / /g;
  const cr = /\n/g; // UNIX carriage return
  const mscr = /\r\n/g; // Microsoft carriage return
  const beginningSpaces = /^\s*/g;
  const tagLine = /^\s*</;
  const blankString = /^\s*$/;
  const comment = /<\!--/;
  const ellipsesRe = /(\s*\.\.\.)/g;
  const blankAttrValueRe = /(required|novalidate|open)=\"\"/g;
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
    'for'
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
      result = result.replace(space, "&nbsp;");
    }

    if (!options.ignoreReturns) {
      result = result.replace(mscr, "<br />").replace(cr, "<br />");
    }

    return result;
  };

  function highlightFunc(s) {
    return '<span class="showcode__highlight">' + s + '</span>'; 
  }

  function formatCSS(localCode) {
    //localCode = localCode.replace(/\}/g, '\n}').replace(/([\{;])/g, '$1\n').replace(/\n\s*\n/, '\n\n');
    localCode = localCode.replace(/([\{;])/g, '$1\n').replace(/\n\s*\n/, '\n\n');
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
    
    const cssTextBuffer = [];
    const { cssRules } = el.sheet;
    for (let i=0; i<cssRules.length; i++) {
      const cssRule = cssRules[i].cssText.trim();

      for (let j=0; j<selectorPropertyPairs.length; j++) {
        const selectorPropertyPair = selectorPropertyPairs[j].trim();
        const properties = selectorPropertyPair.split('|');
        const selector = properties[0];

        properties.shift();

        console.log(cssRule, selector);

        if (cssRule.indexOf(selector + ' ') === 0) {
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
    const { showcodeFor } = dataset;
    const codeEl = document.querySelector('[data-showcode-id="'+ showcodeFor + '"]');
    const notesEl = document.getElementById(showcodeFor + '__notes');
    let code = htmlCache[showcodeFor];
    let replaceRegex;
    const optionValue = 'option[value=\''+ value + '\']'

    const optionEl = target.getElementsByTagName('option')[target.selectedIndex];
    const { showcodeNotes } = optionEl.dataset;

    notesEl.innerHTML = showcodeNotes;

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
        // "%JS% functionName"
        //    Will show the JS function that matches the string given (in this case, `functionName()`) 
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
              highlightString = `\\s*&lt;[\/]?${highlightString}&gt;`;
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
              const funcNames = highlightString.split(';');
              code = '';

              for (let j=0; j<funcNames.length; j++) {
                console.log('j', j, funcNames, funcNames[j])
                const funcNameSplit = funcNames[j].split('#');
                const funcName = funcNameSplit[0].trim();
                const grep = funcNameSplit.length === 2 ? funcNameSplit[1].trim() : null;
                let funcCode;
                let funcObjectCode;

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
                  if (funcName.indexOf('.') > -1) {
                    const propertyName = funcName.split('.')[1];
                    funcCode = `this.${propertyName} = ${funcCode}`;
                  } else {
                    funcCode = `const ${funcName} = ${funcCode}`;
                  }
                }

                funcCode = funcCode.replace(lt, '&lt;').replace(gt, '&gt;');

                code = code + funcCode + '\n\n';
              }

              code = indent.js(code, {tabString: '  '});

              //code = Prism.highlight(code, Prism.languages.javascript, 'javascript');
              break;
            default: 
              console.warn('Invalid command used', command);
          }
        }

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
              const id= matches[j].split('"')[1];
              const idReplaceRegex = new RegExp('id="' + id + '"');

              
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

    // now ... let's see if we can scroll the page to the first highlightd part
    const firstHighlightdElement = codeEl.querySelector('.showcode__highlight');
    

    if (firstHighlightdElement) {
      const componentRoot = codeEl.closest('.showcode');
      const uiEl = componentRoot.querySelector('.showcode__ui');
      const highlightRect = firstHighlightdElement.getBoundingClientRect();
      const uiRect = uiEl.getBoundingClientRect();
      /* window.scroll({
        top: highlightRect.top - uiRect.height - 50,
        behavior: 'smooth'
      }); */
      firstHighlightdElement.scrollIntoView({ behavior: 'smooth', block: 'center', left: 0 });
      /* setTimeout(() => {
        window.scrollBy({
          top: - uiRect.height - 50,
          behavior: 'smooth'
        })
      }, 500); */
    }
    

    requestAnimationFrame(() => {
      target.focus();
    },2000);
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

  const displayCode = (htmlBlock, originalHTMLId, replaceRulesJson) => {
    const block = document.getElementById(originalHTMLId).cloneNode(true);

    if (originalHTMLId) {
      try {

        for (let i in replaceRulesJson) {
          const nodesToReplace = block.querySelectorAll(i);

          for (let j in nodesToReplace) {
            const node = nodesToReplace[j];
            node.innerHTML = replaceRulesJson[i];
          }
        }
      } catch (ex) {
        console.log(ex);
      }
      // let's do search and replace here
      if (block) {
        const unformattedHTML = block.innerHTML;
        const formattedHTML = removeBlankAttrValues(insertEllipses(removeBlankLines(indent.html(seperateTags(unformattedHTML), {tabString: '  '}))));
        //indent.html(unformattedHTML, {tabString: ' '});
        const entifiedHTML = this.entify(formattedHTML, {ignoreSpace: true});
        htmlCache[originalHTMLId] = entifiedHTML
        codeblockCache[originalHTMLId] = block;
        htmlBlock.innerHTML = entifiedHTML.trim();
      }
    }
  }

  function displayStepsWidget(codeblockId, stepsJson) {
    const widgetId =  codeblockId + '__steps';
    const notesId = codeblockId + '__notes';
    const selectEl = document.createElement('SELECT');
    const labelEl = document.createElement('LABEL');
    const defaultOptionEl = document.createElement('OPTION');
    const widgetContainerEl = document.getElementById(widgetId);
    const notesEl = document.getElementById(notesId);

    if (!widgetContainerEl) {
      console.error('Missing widget container ' + widgetId + '. Bailing.');
      return;
    }

    selectEl.id = widgetId + '--select';
    selectEl.dataset.showcodeFor = codeblockId;
    labelEl.htmlFor = selectEl.id;
    labelEl.className = 'showcode__select-label';
    labelEl.innerHTML = 'Code to highlight:'

    defaultOptionEl.innerHTML = '';
    defaultOptionEl.value='';
    selectEl.appendChild(defaultOptionEl);



    if (stepsJson) {
      try {

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
          optionEl.innerHTML = 'Step #' + (parseInt(i) + 1) + ': ' + label;

          selectEl.appendChild(optionEl);
                    
        }
        
        widgetContainerEl.appendChild(labelEl)
        widgetContainerEl.appendChild(selectEl);

        selectEl.addEventListener('change', selectChangeEvent)
        


      } catch (ex) {
        console.log(ex);
      }
    }
  }

  function showCodeBlocks() {
    for (let i = 0; i < htmlBlocks.length; i++) {
      const htmlBlock = htmlBlocks[i];
      const { dataset } = htmlBlock;
      const { showcodeProps } = dataset;

      if (!showcodeProps) {
        console.error('Block ' + i + ' does not have any props');
      } else {
        try {
          const json = JSON.parse(document.getElementById(showcodeProps).innerHTML);
          const {replaceHTMLRules, steps} = json;
          const { showcodeId } = dataset;
          
          displayCode(htmlBlock, showcodeId, replaceHTMLRules);
          displayStepsWidget(showcodeId, steps);
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
  }

  this.init = () => {
    showCodeBlocks();
    setEvents();
    //smoothscroll.polyfill();
  }
})();

showcode.init();
