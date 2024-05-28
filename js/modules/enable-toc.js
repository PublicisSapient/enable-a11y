'use strict'

/*******************************************************************************
 * enable-toc.js - UI for the Table of Contents
 * 
 * Written by Alison Hall <alisonh0101@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released June 2024
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/
 * 
 * Released under the MIT License.
 ******************************************************************************/

const tableOfContents = new function() {
    this.init = (skipPages = []) => {
        // Table of Contents container setup
        const toc = document.createElement('aside');
        toc.setAttribute('id', 'toc');
        const tocHeading = document.createElement('h2');
        tocHeading.textContent = 'Page Overview';
        const tocList = document.createElement('ol');
        tocList.setAttribute('class', 'toc-level-1');
        let prevHeadingLevel = 0;
        let tocNode = tocList;

        // Skip the Table of Contents on certain pages
        if (skipPages.includes(location.pathname)) {
            return;
        }

        document
            .querySelectorAll('h1, h2, h3, h4, h5, h6, [role="heading"]')
            .forEach((el) => {
                /**
                 * Generates a table of contents for your document based on the headings
                 *  present. Anchors are injected into the document and the
                 *  entries in the table of contents are linked to them.
                 */
                const headingLevel = Number(el.nodeName?.toLowerCase()?.split('h')?.[1] || 0);
                if (headingLevel === 1) {
                    prevHeadingLevel = headingLevel;
                    return;
                } else if (headingLevel > prevHeadingLevel && prevHeadingLevel !== 1) {
                    const subList = document.createElement('ul');
                    subList.setAttribute('class', `toc-level-${headingLevel - 1}`);
                    tocNode.appendChild(subList);
                    tocNode = subList;
                }

                tocNode = tocNode.closest(`.toc-level-${headingLevel - 1}`);
                
                const tocItem = document.createElement('li');
                tocItem.setAttribute('class', `toc-item-${el.tagName.toLowerCase()}`);

                const tocLink = el.id ? document.createElement('a') : document.createElement('p');
                el.id && tocLink.setAttribute('href', `#${el.id}`);
                tocLink.textContent = el.textContent;
            
                tocItem.appendChild(tocLink);
                tocNode.appendChild(tocItem);
                tocNode = tocItem;
                prevHeadingLevel = headingLevel;
                return;
            })

        // Add the generated Table of Contents to the top of pages
        toc.appendChild(tocHeading);
        toc.appendChild(tocList);
        const h1 = document.getElementsByTagName('h1')?.[0];
        const main = document.getElementsByTagName('main')?.[0];

        // Insert the TOC after the H1, or just inside the main element
        if (h1) {
            h1.after(toc);
        } else {
            main.insertAdjacentElement('afterbegin', toc);
        }
    }
}

export default tableOfContents;
