'use strict'

/*******************************************************************************
 * enable-toc.js - UI for the Table of Contents
 * 
 * Written by Alison Hall <alisonh0101@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released July 2024
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/
 * 
 * Released under the MIT License.
 ******************************************************************************/

// import tooltip from './tooltip.js'; // Temp: disable init of tooltip since it causes unexpected behavior
import { addMissingIDToHeading, getCookie, setCookie } from "./helpers.js";

/**
 * Represents the table of contents.
 */
const tableOfContents = new function() {
    this.toc;

    /**
     * Retrieves common selectors used across the Table of Contents functionalities.
     * @returns {Object} An object containing DOM elements for the sidebar, toggle, and toggle button.
     */
    const commonSelectors = () => {
        return {
            sidebarTOCSelector: document.getElementById('enable-toc--sidebar'),
            toggleTOCSelector: document.getElementById('enable-toc--toggle'),
            toggleButtonSelector: document.querySelector('.enable-toc__toggle-button'),
        }
    }

    /**
     * Creates the content for the Table of Contents based on specified parameters.
     * @param {boolean} numberFirstLevelHeadings - Whether to number the first level headings (ol vs ul elements)
     * @param {string} selectorToSkipHeadingsWithin - Selector defining areas to skip headings within.
     * @param {number} ignoreHeadersDeeperThan - Level of headers to ignore (e.g., deeper than 3 for h4 to h6).
     * @param {number} collapseNestedHeadingsAfterLevel - Level after which nested headings should be collapsible.
     * @returns {HTMLElement} The constructed TOC list element.
     */
    this.createContent = (numberFirstLevelHeadings, selectorToSkipHeadingsWithin, ignoreHeadersDeeperThan, collapseNestedHeadingsAfterLevel) => {
        // Table of Contents container setup
        const tocList = document.createElement(numberFirstLevelHeadings ? 'ol' : 'ul');
        tocList.classList.add('enable-toc__level-1-content');
        collapseNestedHeadingsAfterLevel && tocList.classList.add('enable-drawer');

        let prevHeadingLevel = 0;
        let tocNode = tocList;
        let elementCount = 0;

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
                elementCount++;
                let expandButton;

                // Skip headings that are within the selector or deeper than the specified level
                if (selectorToSkipHeadingsWithin && el.closest(selectorToSkipHeadingsWithin) !== null || ignoreHeadersDeeperThan && headingLevel > ignoreHeadersDeeperThan) {
                    // Do not add ignored headings to the TOC
                    return;
                } else if (headingLevel === 1 || prevHeadingLevel === 0) {
                    prevHeadingLevel = headingLevel;
                    // Do not add the H1 heading to the TOC
                    return;
                } else if (headingLevel > prevHeadingLevel && prevHeadingLevel !== 1) {

                    // Create a new list for the subheadings
                    const subList = document.createElement('ul');
                    subList.classList.add(`enable-toc__level-${headingLevel - 1}-content`);

                    // Show the collapse/expand button if the heading level is greater than the specified level
                    if (collapseNestedHeadingsAfterLevel && headingLevel > collapseNestedHeadingsAfterLevel + 1) {
                        // Create a button to expand/collapse the subheadings
                        expandButton = document.createElement('button');
                        expandButton.classList.add('enable-drawer__button');
                        expandButton.setAttribute('aria-expanded', 'false');
                        expandButton.setAttribute('aria-label', `Links for the content under the heading`);
                        expandButton.setAttribute('aria-controls', `enable-drawer${elementCount}__content`);
                        expandButton.innerHTML = '<img src="/images/plus.svg" alt="" />';
                        expandButton.addEventListener('click', this.expandButtonClick);
                        tocNode.appendChild(expandButton);

                        // Set attributes for expanding/collapsing subheadings
                        subList.setAttribute('id', `enable-drawer${elementCount}__content`);
                        subList.classList.add(`enable-drawer__content`);
                        subList.setAttribute('role', `group`);
                        subList.setAttribute('aria-label', 'Expanded content');
                        subList.style.display = 'none';
                    }

                    // Append the subList to the current tocNode
                    tocNode.appendChild(subList);
                    tocNode = subList;
                }

                tocNode = tocNode.closest(`.enable-toc__level-${headingLevel - 1}-content`);
                
                // Create the TOC item for the heading
                const tocItem = document.createElement('li');
                tocItem.classList.add(`enable-toc__item-${el.tagName.toLowerCase()}`);

                // Add the heading content to the TOC item
                el.childNodes && el.childNodes.forEach((child) => {
                    if (child.nodeName === 'IMG') {
                        // Clone an image within a heading and add it to the TOC
                        const clonedImage = child.cloneNode(true);
                        clonedImage.classList.add('enable-toc__image');
                        tocItem.appendChild(clonedImage);
                    } else if (el.textContent) {
                        // Add the heading text content to the TOC
                        const tocLink = document.createElement('a');
                        tocLink.setAttribute('href', `#${el.id}`);
                        tocLink.textContent = el.textContent;
                        tocLink.classList.add('enable-toc__link');
                        tocItem.appendChild(tocLink);
                    }
                });

                // Add the TOC item to the TOC list
                tocNode.appendChild(tocItem);
                tocNode = tocItem;
                prevHeadingLevel = headingLevel;
                return;
            })

        return tocList;
    }

    /**
     * Handles click events on expand/collapse buttons within the Table of Contents (TOC).
     * This function toggles the expanded state of subheading lists in the TOC, showing or hiding
     * the content under headings based on the current state.
     *
     * @param {Event} event - The event object associated with the click event on the expand/collapse button.
     */
    this.expandButtonClick = (event) => {
        const expandButton = event.target.closest('.enable-drawer__button');
        const isExpanded = expandButton.getAttribute('aria-expanded') === 'true';
        expandButton.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
        expandButton.innerHTML = `<img src="/images/${isExpanded ? 'plus' : 'minus'}.svg" alt="" />`;
        const subList = expandButton.nextElementSibling;
        subList.style.display = isExpanded ? 'none' : 'block';
    }

    /**
     * Opens and displays the "Toggle TOC" content, making it visible and accessible to users.
     * This function sets the appropriate aria-expanded attribute, changes the display style to make the TOC visible,
     * sets focus to the toggle button, and adds event listeners to handle closing the TOC when clicking outside
     * or pressing the Escape key.
     */
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

    /**
     * Closes and hides the "Toggle TOC" content, making it invisible and inaccessible to users.
     * This function resets the aria-expanded attribute, changes the display style to hide the TOC,
     * sets focus back to the toggle button for accessibility, and removes event listeners that handle
     * closing the TOC when clicking outside or pressing the Escape key.
     */
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

    /**
     * Handles events to close the "Toggle TOC" when specific conditions are met, such as clicking outside the TOC
     * or pressing the Escape key. This function ensures that the TOC is closed in appropriate scenarios to enhance
     * usability and accessibility.
     *
     * @param {Event} event - The event object that triggered this function, which could be a click or keyup event.
     */
    this.closeToggleTOCOnEvent = (event) => {
        const { toggleButtonSelector, toggleTOCSelector } = commonSelectors();
        if (
            (event.type === 'keyup' && event.key === 'Escape') ||
            (event.target.parentNode && !toggleButtonSelector?.contains(event.target) && !toggleTOCSelector?.contains(event.target))
        ) {
            event.preventDefault();
            this.closeToggleTOC();
        }
    }

    /**
     * Toggles the visibility of the "Toggle TOC" content by checking its current state and either opening or closing it.
     * This function is triggered when the toggle TOC button is clicked. It removes any tooltip attributes, checks the
     * current expanded state of the TOC, and calls the appropriate function to either open or close the TOC.
     */
    this.toggleTOC = () => {
        const { toggleButtonSelector } = commonSelectors();
        toggleButtonSelector?.removeAttribute('data-tooltip'); // Remove any tooltip attributes that might be set on the toggle button.
        const isExpanded = toggleButtonSelector?.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
            this.closeToggleTOC();
        } else {
            this.openToggleTOC();
        }
    }

    /**
     * Appends the Table of Contents (TOC) as a sidebar to the main content area of the page.
     * This function creates a navigation container, sets up the necessary elements for the sidebar TOC,
     * and inserts it before the main content of the page. It also includes a button to hide the sidebar TOC,
     * enhancing the interactivity and accessibility of the page layout.
     */
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

    /**
     * Appends the Table of Contents (TOC) as a toggle button beside the page header, allowing users to toggle the visibility of the TOC.
     * This function sets up a navigation container specifically for toggling the TOC, adds a button to potentially move the TOC to the sidebar,
     * and ensures all elements are properly labeled and accessible. It also handles the dynamic creation of a cloned TOC for toggling purposes.
     */
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

        // Update the unique IDs for the expanded content
        const expandedContent = clonedToc.querySelectorAll('.enable-drawer__content');
        expandedContent?.forEach((content) => {
            const originalId = content.getAttribute('id');
            content.setAttribute('id', `${originalId}-toggle`);
        });

        // Add the event listener to the cloned TOC, and update the unique aria-controls attribute
        const expandButtons = clonedToc.querySelectorAll('.enable-drawer__button');
        expandButtons?.forEach((button) => {
            button.addEventListener('click', this.expandButtonClick);
            const originalControlId = button.getAttribute('aria-controls');
            button.setAttribute('aria-controls', `${originalControlId}-toggle`);
        });

        // Create the button to toggle the TOC
        const toggleButton = document.createElement('button');
        toggleButton.classList.add('enable-toc__toggle-button');
        toggleButton.setAttribute('aria-label', 'Toggle the Table of Contents');
        toggleButton.setAttribute('aria-controls', 'enable-toc--toggle');
        toggleButton.setAttribute('aria-expanded', 'false');
        toggleButton.setAttribute('title', 'Open or close the Table of Contents');
        toggleButton.innerHTML = '<img src="images/icons/toc.svg" alt="" />';
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

    /**
     * Transitions the display of the Table of Contents (TOC) from a toggleable overlay to a permanent sidebar.
     * This function updates the body class to reflect the sidebar state, hides the toggleable TOC, and sets a cookie
     * to remember the user's preference for displaying the TOC as a sidebar. It also focuses on the hide button
     * for accessibility purposes.
     */
    this.moveToSidebar = () => {
        // Update the body class to show the TOC as a sidebar
        document.getElementsByTagName('body')[0].classList.add('enable-toc-as-sidebar');

        // Hide the "Toggle TOC" toggle button and content
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

    /**
     * Transitions the display of the Table of Contents (TOC) from a sidebar to a toggleable button.
     * This function updates the body class to remove the sidebar display, updates the tooltip for the toggle button,
     * sets a cookie to remember the user's preference for not displaying the TOC as a sidebar, and focuses on the toggle button
     * for improved accessibility and user interaction.
     */
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

    /**
     * Initializes the Table of Contents (TOC) on a page based on various configuration options.
     * This function checks if the TOC should be skipped on certain pages, creates the TOC with specified options,
     * appends it as both a sidebar and a toggle button, and sets up the necessary state based on cookies and default settings.
     * 
     * @param {Object} config - Configuration options for initializing the TOC.
     * @param {Array<string>} config.skipPages - Pages where the TOC should not be initialized.
     * @param {boolean} config.showAsSidebarDefault - Whether to show the TOC as a sidebar by default when first initialized on desktop.
     * @param {boolean} config.numberFirstLevelHeadings - Whether the first level headings should be numbered or be bullets.
     * @param {string} config.selectorToSkipHeadingsWithin - Selector to identify areas within which headings should not be included in the TOC.
     * @param {number} config.ignoreHeadersDeeperThan - Level of headers to not include in the TOC (e.g., deeper than 3 for h4 to h6).
     * @param {number} config.collapseNestedHeadingsAfterLevel - Level after which nested headings should be collapsible.
     */
    this.init = ({
        skipPages = [],
        showAsSidebarDefault = true,
        numberFirstLevelHeadings = true,
        selectorToSkipHeadingsWithin,
        ignoreHeadersDeeperThan,
        collapseNestedHeadingsAfterLevel,
    }) => {
        // Skip the Table of Contents on certain pages
        if (skipPages.includes(location.pathname)) {
            return;
        }

        // Create the Table of Contents
        this.toc = this.createContent(numberFirstLevelHeadings, selectorToSkipHeadingsWithin, ignoreHeadersDeeperThan, collapseNestedHeadingsAfterLevel);

        // Insert the TOC beside the main content and beside the H1 ("Toggle TOC" and "Sidebar TOC")
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
        // tooltip.init(); // Temp: disable init of tooltip since it causes unexpected behavior
    }
}

export default tableOfContents;
