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

function splitCookies() {
    const list = {};
    document?.cookie?.split(';')?.forEach((cookie) => {
        const parts = cookie.split('=');
        list[parts.shift().trim()] = decodeURI(parts.join('='));
    });
    return list;
}

function getCookie(name) {
    return splitCookies()[name];
}

function setCookie(name, value) {
    document.cookie = `${name}=${value}; path=/;`;
}

function deleteCookie(name) {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

const tableOfContents = new function() {
    let toc;

    this.createContent = (numberFirstLevelHeadings) => {
        // Table of Contents container setup
        const tocList = document.createElement(numberFirstLevelHeadings ? 'ol' : 'ul');
        tocList.setAttribute('class', 'enable-toc__level-1-content');

        let prevHeadingLevel = 0;
        let tocNode = tocList;

        document
            .querySelectorAll('h1, h2, h3, h4, h5, h6, [role="heading"]')
            .forEach((el) => {
                /**
                 * Generates a table of contents for your document based on the headings
                 *  present. The
                 *  entries in the table of contents are linked to the headings.
                 */
                const headingLevel = Number(el.nodeName?.toLowerCase()?.split('h')?.[1] || 0);
                if (headingLevel === 1 || prevHeadingLevel === 0) {
                    prevHeadingLevel = headingLevel;
                    return;
                } else if (headingLevel > prevHeadingLevel && prevHeadingLevel !== 1) {
                    const subList = document.createElement('ul');
                    subList.setAttribute('class', `enable-toc__level-${headingLevel - 1}-content`);
                    tocNode.appendChild(subList);
                    tocNode = subList;
                }

                tocNode = tocNode.closest(`.enable-toc__level-${headingLevel - 1}-content`);
                
                const tocItem = document.createElement('li');
                tocItem.setAttribute('class', `enable-toc__item-${el.tagName.toLowerCase()}`);

                const tocLink = el.id ? document.createElement('a') : document.createElement('p');
                el.id && tocLink.setAttribute('href', `#${el.id}`);
                tocLink.textContent = el.textContent;
            
                tocItem.appendChild(tocLink);
                tocNode.appendChild(tocItem);
                tocNode = tocItem;
                prevHeadingLevel = headingLevel;
                return;
            })

        return tocList;
    }

    this.openToggleTOC = () => {
        const toc = document.getElementById('enable-toc--toggle');
        const toggleButton = document.querySelector('.enable-toc__toggle-button');
        toggleButton?.setAttribute('aria-expanded', 'true');
        toc.style.display = 'grid';
        toggleButton.focus();
        window.addEventListener('click', this.closeToggleTOCOnEvent);
        window.addEventListener('keyup', this.closeToggleTOCOnEvent);
    }

    this.closeToggleTOC = () => {
        const toc = document.getElementById('enable-toc--toggle');
        const toggleButton = document.querySelector('.enable-toc__toggle-button');
        toggleButton.setAttribute('aria-expanded', 'false');
        toc.style.display = 'none';
        toggleButton.focus();
        window.removeEventListener('click', this.closeToggleTOCOnEvent);
        window.removeEventListener('keyup', this.closeToggleTOCOnEvent);
    }

    this.closeToggleTOCOnEvent = (event) => {
        const toc = document.getElementById('enable-toc--toggle');
        const toggleButton = document.querySelector('.enable-toc__toggle-button');
        if ((event.type === 'keyup' && event.key === 'Escape') || (!toggleButton.contains(event.target) && !toc.contains(event.target))) {
            this.closeToggleTOC();
        }
    }

    /* Action when clicking the toggle TOC button */
    this.toggleTOC = () => {
        const toggleButton = document.querySelector('.enable-toc__toggle-button');
        toggleButton.setAttribute('data-tooltip', 'Open or close the Table of Contents');
        const isExpanded = toggleButton?.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
            this.closeToggleTOC();
        } else {
            this.openToggleTOC();
        }
    }

    /* Initial code to add the TOC as a sidebar */
    this.appendAsSidebar = () => {
        // Create the nav and heading elements
        const nav = document.createElement('nav');
        nav.setAttribute('id', 'enable-toc--sidebar');
        nav.setAttribute('class', 'enable-toc enable-toc--sidebar');
        const tocHeading = document.createElement('h2');
        tocHeading.textContent = 'Contents';

        // Create the button to hide the TOC and move it to the toggle button
        const hideSidebarButton = document.createElement('button');
        hideSidebarButton.textContent = 'Hide';
        hideSidebarButton.setAttribute('class', 'enable-toc__hide-sidebar-button');
        hideSidebarButton.setAttribute('aria-label', 'Hide Table of Contents sidebar');
        hideSidebarButton.addEventListener('click', this.moveToToggleButton);

        // Append the elements to the nav
        nav.appendChild(tocHeading);
        nav.appendChild(hideSidebarButton);
        nav.appendChild(toc);

        // Insert the nav and button elements
        const main = document.getElementsByTagName('main')?.[0];
        main?.insertAdjacentElement('beforebegin', nav);
    }

    /* Initial code to add the TOC as a toggle button beside the header */
    this.appendAsToggleButton = () => {
        // Create the nav and heading elements
        const nav = document.createElement('nav');
        nav.setAttribute('id', 'enable-toc--toggle');
        nav.setAttribute('class', 'enable-toc enable-toc--toggle');
        const tocHeading = document.createElement('h2');
        tocHeading.textContent = 'Contents';

        // Create the button to move the TOC to the sidebar
        const moveToSidebarButton = document.createElement('button');
        moveToSidebarButton.textContent = 'Move to Sidebar';
        moveToSidebarButton.setAttribute('class', 'enable-toc__move-to-sidebar-button');
        moveToSidebarButton.setAttribute('aria-label', 'Move Table of Contents to Sidebar');
        moveToSidebarButton.addEventListener('click', this.moveToSidebar);

        // Append the elements to the nav
        nav.appendChild(tocHeading);
        nav.appendChild(moveToSidebarButton);
        const clonedToc = toc.cloneNode(true);
        nav.appendChild(clonedToc);

        // Create the button to toggle the TOC
        const toggleButton = document.createElement('button');
        toggleButton.setAttribute('class', 'enable-toc__toggle-button');
        toggleButton.setAttribute('aria-label', 'Toggle the Table of Contents');
        toggleButton.setAttribute('aria-controls', 'enable-toc--toggle');
        toggleButton.setAttribute('aria-expanded', 'false');
        toggleButton.setAttribute('data-tooltip', 'Open or close the Table of Contents');
        toggleButton.innerHTML = '<img src="/images/icons/toc.svg" alt="" />';
        toggleButton.addEventListener('click', this.toggleTOC);

        // Insert the nav and button elements
        const h1 = document.getElementsByTagName('h1')?.[0];
        if (h1) {
            h1.before(toggleButton);
            h1.after(nav);
        } else {
            const main = document.getElementsByTagName('main')?.[0];
            main.insertAdjacentElement('beforebegin', toggleButton);
            main.insertAdjacentElement('beforebegin', nav);
        }
    }

    this.moveToSidebar = () => {
        // Update the body class to show the TOC as a sidebar
        document.getElementsByTagName('body')[0].classList.add('enable-toc-as-sidebar');

        // Hide the TOC toggle button and content
        const toc = document.getElementById('enable-toc--toggle');
        const toggleButton = document.querySelector('.enable-toc__toggle-button');
        toggleButton.setAttribute('aria-expanded', 'false');
        toc.style.display = 'none';

        // Set the cookie to remember the sidebar state
        setCookie('enable-toc-as-sidebar', 'true');

        // Focus on the Hide button
        document.querySelector('.enable-toc__hide-sidebar-button').focus();
    }

    this.moveToToggleButton = () => {
        // Update the body class to not show the TOC as a sidebar
        document.getElementsByTagName('body')[0].classList.remove('enable-toc-as-sidebar');

        // Update the toggle button tooltip
        const toggleButton = document.querySelector('.enable-toc__toggle-button');
        toggleButton.setAttribute('data-tooltip', 'The Table of Contents has moved here. Click to open or close.');

        // Set the cookie to remember the sidebar state
        setCookie('enable-toc-as-sidebar', 'false');

        // Focus on the TOC toggle button
        document.querySelector('.enable-toc__toggle-button').focus();
    }

    this.init = (skipPages = [], showAsSidebarDefault = true, numberFirstLevelHeadings = true) => {
        // Skip the Table of Contents on certain pages
        if (skipPages.includes(location.pathname)) {
            return;
        }

        // Create the Table of Contents
        toc = this.createContent(numberFirstLevelHeadings);

        // Insert the TOC beside the main content and/or beside the H1
        this.appendAsSidebar();
        this.appendAsToggleButton();

        // Check if the TOC should be shown as a sidebar, and update the body class
        const sidebarCookieValue = getCookie('enable-toc-as-sidebar');
        if (sidebarCookieValue === 'true' || (!sidebarCookieValue && showAsSidebarDefault)) {
            document.getElementsByTagName('body')[0].classList.add('enable-toc-as-sidebar');
        }

        // Set the default enable-toc-as-sidebar cookie if it doesn't exist
        if (!sidebarCookieValue) {
            setCookie('enable-toc-as-sidebar', `${showAsSidebarDefault}`);
        }
    }
}

export default tableOfContents;
