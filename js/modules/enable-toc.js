'use strict'
import tooltip from './tooltip.js';
import { addMissingIDToHeading, getCookie, setCookie } from "./helpers.js";

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
    this.toc;

    const commonSelectors = () => {
        return {
            sidebarTOCSelector: document.getElementById('enable-toc--sidebar'),
            toggleTOCSelector: document.getElementById('enable-toc--toggle'),
            toggleButtonSelector: document.querySelector('.enable-toc__toggle-button'),
        }
    }

    this.createContent = (numberFirstLevelHeadings, selectorToSkipHeadingsWithin, ignoreHeadersDeeperThan) => {
        // Table of Contents container setup
        const tocList = document.createElement(numberFirstLevelHeadings ? 'ol' : 'ul');
        tocList.classList.add('enable-toc__level-1-content');

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
                addMissingIDToHeading(el);

                // Skip headings that are within the selector or deeper than the specified level
                if (selectorToSkipHeadingsWithin && el.closest(selectorToSkipHeadingsWithin) !== null || ignoreHeadersDeeperThan && headingLevel > ignoreHeadersDeeperThan) {
                    // Do not add headings to the TOC
                    return;
                } else if (headingLevel === 1 || prevHeadingLevel === 0) {
                    prevHeadingLevel = headingLevel;
                    return;
                } else if (headingLevel > prevHeadingLevel && prevHeadingLevel !== 1) {
                    const subList = document.createElement('ul');
                    subList.classList.add(`enable-toc__level-${headingLevel - 1}-content`);
                    tocNode.appendChild(subList);
                    tocNode = subList;
                }

                tocNode = tocNode.closest(`.enable-toc__level-${headingLevel - 1}-content`);
                
                const tocItem = document.createElement('li');
                tocItem.classList.add(`enable-toc__item-${el.tagName.toLowerCase()}`);

                el.childNodes && el.childNodes.forEach((child) => {
                    if (child.nodeName === 'IMG') {
                        const clonedImage = child.cloneNode(true);
                        clonedImage.classList.add('enable-toc__image');
                        tocItem.appendChild(clonedImage);
                    } else if (el.textContent) {
                        const tocLink = document.createElement('a');
                        tocLink.setAttribute('href', `#${el.id}`);
                        tocLink.textContent = el.textContent;
                        tocLink.classList.add('enable-toc__link');
                        tocItem.appendChild(tocLink);
                    }
                });

                tocNode.appendChild(tocItem);
                tocNode = tocItem;
                prevHeadingLevel = headingLevel;
                return;
            })

        return tocList;
    }

    this.openToggleTOC = () => {
        const { toggleButtonSelector, toggleTOCSelector } = commonSelectors();
        toggleButtonSelector?.setAttribute('aria-expanded', 'true');
        if (toggleTOCSelector) {
            toggleTOCSelector.style.display = 'grid';
        }
        toggleButtonSelector?.focus();
        window.addEventListener('click', this.closeToggleTOCOnEvent);
        window.addEventListener('keyup', this.closeToggleTOCOnEvent);
    }

    this.closeToggleTOC = () => {
        const { toggleButtonSelector, toggleTOCSelector } = commonSelectors();
        toggleButtonSelector?.setAttribute('aria-expanded', 'false');
        if (toggleTOCSelector) {
            toggleTOCSelector.style.display = 'none';
        }
        toggleButtonSelector?.focus();
        window.removeEventListener('click', this.closeToggleTOCOnEvent);
        window.removeEventListener('keyup', this.closeToggleTOCOnEvent);
    }

    this.closeToggleTOCOnEvent = (event) => {
        const { toggleButtonSelector, toggleTOCSelector } = commonSelectors();
        if (
            (event.type === 'keyup' && event.key === 'Escape') ||
            (!toggleButtonSelector?.contains(event.target) && !toggleTOCSelector?.contains(event.target))
        ) {
            event.preventDefault();
            this.closeToggleTOC();
        }
    }

    /* Action when clicking the toggle TOC button */
    this.toggleTOC = () => {
        const { toggleButtonSelector } = commonSelectors();
        toggleButtonSelector?.setAttribute('data-tooltip', 'Open or close the Table of Contents');
        const isExpanded = toggleButtonSelector?.getAttribute('aria-expanded') === 'true';
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
        nav.classList.add('enable-toc');
        nav.classList.add('enable-toc--sidebar');
        const tocHeading = document.createElement('h2');
        tocHeading.textContent = 'Contents';

        // Create the button to hide the TOC and move it to the toggle button
        const hideSidebarButton = document.createElement('button');
        hideSidebarButton.textContent = 'Hide';
        hideSidebarButton.classList.add('enable-toc__hide-sidebar-button');
        hideSidebarButton.setAttribute('aria-label', 'Hide Table of Contents sidebar');
        hideSidebarButton.addEventListener('click', this.moveToToggleButton);

        // Append the elements to the nav
        nav.appendChild(tocHeading);
        nav.appendChild(hideSidebarButton);
        nav.appendChild(this.toc);

        // Insert the nav and button elements
        const main = document.getElementsByTagName('main')?.[0];
        main?.insertAdjacentElement('beforebegin', nav);
    }

    /* Initial code to add the TOC as a toggle button beside the header */
    this.appendAsToggleButton = () => {
        // Create the nav and heading elements
        const nav = document.createElement('nav');
        nav.setAttribute('id', 'enable-toc--toggle');
        nav.classList.add('enable-toc');
        nav.classList.add('enable-toc--toggle');
        const tocHeading = document.createElement('h2');
        tocHeading.textContent = 'Contents';

        // Create the button to move the TOC to the sidebar
        const moveToSidebarButton = document.createElement('button');
        moveToSidebarButton.textContent = 'Move to Sidebar';
        moveToSidebarButton.classList.add('enable-toc__move-to-sidebar-button');
        moveToSidebarButton.setAttribute('aria-label', 'Move Table of Contents to Sidebar');
        moveToSidebarButton.addEventListener('click', this.moveToSidebar);

        // Append the elements to the nav
        nav.appendChild(tocHeading);
        nav.appendChild(moveToSidebarButton);
        const clonedToc = this.toc.cloneNode(true);
        nav.appendChild(clonedToc);

        // Create the button to toggle the TOC
        const toggleButton = document.createElement('button');
        toggleButton.classList.add('enable-toc__toggle-button');
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
        const { toggleButtonSelector, toggleTOCSelector } = commonSelectors();
        toggleButtonSelector?.setAttribute('aria-expanded', 'false');
        if (toggleTOCSelector) {
            toggleTOCSelector.style.display = 'none';
        }

        // Set the cookie to remember the sidebar state
        setCookie('enable-toc-as-sidebar', 'true');

        // Focus on the Hide button
        document.querySelector('.enable-toc__hide-sidebar-button').focus();
    }

    this.moveToToggleButton = () => {
        // Update the body class to not show the TOC as a sidebar
        document.getElementsByTagName('body')[0].classList.remove('enable-toc-as-sidebar');

        // Update the toggle button tooltip
        const { toggleButtonSelector } = commonSelectors();
        toggleButtonSelector?.setAttribute('data-tooltip', 'The Table of Contents has moved here. Click to open or close.');

        // Set the cookie to remember the sidebar state
        setCookie('enable-toc-as-sidebar', 'false');

        // Focus on the TOC toggle button
        toggleButtonSelector.focus();
    }

    this.init = ({
        skipPages = [],
        showAsSidebarDefault = true,
        numberFirstLevelHeadings = true,
        selectorToSkipHeadingsWithin,
        ignoreHeadersDeeperThan,
    }) => {
        // Skip the Table of Contents on certain pages
        if (skipPages.includes(location.pathname)) {
            return;
        }

        // Create the Table of Contents
        this.toc = this.createContent(numberFirstLevelHeadings, selectorToSkipHeadingsWithin, ignoreHeadersDeeperThan);

        // Insert the TOC beside the main content and beside the H1
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

        // Add the tooltip component
        tooltip.init();
    }
}

export default tableOfContents;
