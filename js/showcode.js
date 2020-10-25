const showcode = new (function () {
  const htmlBlocks = document.querySelectorAll("[data-showcode-html]");
  const htmlCache = {};

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
    const isComment = (line.indexOf('<!--') > 0);

    if (line.search(tagLine) >= 0 && !isComment && line.length > 100) {
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

  this.init = () => {
    for (let i = 0; i < htmlBlocks.length; i++) {
      const htmlBlock = htmlBlocks[i];
      const { dataset } = htmlBlock;
      const {showcodeHtml, showcodeReplaceHtml} = dataset;
      const block = document.getElementById(showcodeHtml).cloneNode(true);

      if (showcodeHtml) {
        try {
          console.log(showcodeReplaceHtml)
          const replaceHTMLJson = JSON.parse(showcodeReplaceHtml.trim());

          for (let i in replaceHTMLJson) {
            console.log(i);
            const nodesToReplace = block.querySelectorAll(i);

            for (let j in nodesToReplace) {
              const node = nodesToReplace[j];
              node.innerHTML = replaceHTMLJson[i];
            }
          }
        } catch (ex) {
          console.log(ex);
        }
        // let's do search and replace here
      }
      

      if (block) {
        const unformattedHTML = block.innerHTML;
        const formattedHTML = removeBlankLines(indent.html(seperateTags(unformattedHTML), {tabString: '  '}));
        //indent.html(unformattedHTML, {tabString: ' '});
        const entifiedHTML = this.entify(formattedHTML);
        htmlCache[showcodeHtml] = entifiedHTML
        htmlBlock.innerHTML = entifiedHTML;
      }
    }
  };
})();

showcode.init();
