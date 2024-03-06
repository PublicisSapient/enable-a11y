'use strict';

const highlightCode = () => {
  if (highlightString !== null) {
    highlightString = highlightString.replace(space, nbspStr);
    const attribute = highlightString.split('=')[0];
    const hasValue = (highlightString.indexOf('=') >= 0)

    if (hasValue) {
      replaceRegex = new RegExp(highlightString, 'g');
    } else {

      if (command === '%FILE%') {
        replaceRegex = new RegExp(highlightString);
        // 'for' is a special case -- we don't want it to match <form>.
      } else if (highlightString === 'for') {
        replaceRegex = new RegExp(highlightString + '="[^=]*"', 'g');
      } else {
        replaceRegex = new RegExp(highlightString + '(="[^=]*")*', 'g');
      }

      // get all the unique matches
      const matches = [...new Set(code.match(replaceRegex))];
      console.log('matches', code, replaceRegex, matches);

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
}