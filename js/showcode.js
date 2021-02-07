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

  function hiliteFunc 
  (s) {
    return '<span class="showcode__hilite">' + s + '</span>'; 
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

    const hiliteStrings = value.split(',');

    for (let i=0; i<hiliteStrings.length; i++) {
      const hiliteString = hiliteStrings[i];
      const attribute = hiliteString.split('=')[0];
      const hasValue = (hiliteString.indexOf('=') >= 0)

      if (hasValue) {
        replaceRegex = new RegExp(hiliteString, 'g');
      } else {
        replaceRegex = new RegExp(hiliteString + '(="[^=]*")*', 'g');

        // get all the unique matches
        const matches = [...new Set(code.match(replaceRegex))];
        
        // if the hiliteString is one of the relationship attributes,
        // hilite the ids these matches points to.
        if (relationshipAttributes.indexOf(attribute) >= 0 ) {
          for (let j=0; j<matches.length; j++) {
            const id= matches[j].split('"')[1];
            const idReplaceRegex = new RegExp('id="' + id + '"');

            code = code.replace(idReplaceRegex, hiliteFunc);
          }  
        
        }
      }

      
      code = code.replace(replaceRegex, hiliteFunc);

     
    }


    codeEl.innerHTML = code;
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

  function indentAttrs(line) {
    const isComment = (line.indexOf('<!--') >= 0);

    if (line.search(tagLine) >= 0 && !isComment && line.length > 30) {
      const begin = line.match(beginningSpaces)[0];
      const trimmedLine = line.trim();
      const explodedLine = trimmedLine.split(' ');
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
        const formattedHTML = insertEllipses(removeBlankLines(indent.html(seperateTags(unformattedHTML), {tabString: '  '})));
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
    labelEl.className = 'showcode__select';
    labelEl.innerHTML = 'Code to hilite:'

    defaultOptionEl.innerHTML = '';
    defaultOptionEl.value='';
    selectEl.appendChild(defaultOptionEl);



    if (stepsJson) {
      try {

        for (let i in stepsJson) {
          const optionEl = document.createElement('OPTION');
          const step = stepsJson[i];
          const { label, hilite, notes } = step;

          optionEl.value = hilite;

          switch(typeof notes) {
            case "object":
              // assume it's an array.  Make it into a string
              optionEl.dataset.showcodeNotes = notes.join(' ');
              break;
            default:
              optionEl.dataset.showcodeNotes = notes;
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
  }
})();

showcode.init();
