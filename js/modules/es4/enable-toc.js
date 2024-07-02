'use strict'
// import tooltip from './tooltip.js'; // Temp: disable init of tooltip since it causes unexpected behavior
const tableOfContents = new (function() {
    this.toc;

    /* Common selectors used in the Table of Contents code */
    const commonSelectors = () => {
        return {
            sidebarTOCSelector: document.getElementById('enable-toc--sidebar'),
            toggleTOCSelector: document.getElementById('enable-toc--toggle'),
            toggleButtonSelector: document.querySelector('.enable-toc__toggle-button'),
        }
    }

    /* Create the Table of Contents content */
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
                        expandButton.setAttribute('id', `enable-drawer${elementCount}`);
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

    /* Action to expand or collapse the subheadings */
    this.expandButtonClick = (event) => {
        const expandButton = event.target.closest('.enable-drawer__button');
        const isExpanded = expandButton.getAttribute('aria-expanded') === 'true';
        expandButton.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
        expandButton.innerHTML = `<img src="/images/${isExpanded ? 'plus' : 'minus'}.svg" alt="" />`;
        const subList = expandButton.nextElementSibling;
        subList.style.display = isExpanded ? 'none' : 'block';
    }

    /* Action to open/show the "Toggle TOC" content */
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

    /* Action to close/hide the "Toggle TOC" content */
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

    /* Trigger the action to close/hide the "Toggle TOC" when clicking outside of the TOC or hitting the Escape key */
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

    /* Action when clicking the toggle TOC button for the "Toggle TOC" */
    this.toggleTOC = () => {
        const { toggleButtonSelector } = commonSelectors();
        toggleButtonSelector?.removeAttribute('data-tooltip');
        const isExpanded = toggleButtonSelector?.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
            this.closeToggleTOC();
        } else {
            this.openToggleTOC();
        }
    }

    /* Initial code to add the TOC as a sidebar ("Sidebar TOC") */
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

    /* Initial code to add the TOC as a toggle button beside the header ("Toggle TOC") */
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

        // Add the event listener to the cloned TOC
        const expandButtons = clonedToc.querySelectorAll('.enable-drawer__button');
        expandButtons?.forEach((button) => {
            button.addEventListener('click', this.expandButtonClick);
        });

        // Create the button to toggle the TOC
        const toggleButton = document.createElement('button');
        toggleButton.classList.add('enable-toc__toggle-button');
        toggleButton.setAttribute('aria-label', 'Toggle the Table of Contents');
        toggleButton.setAttribute('aria-controls', 'enable-toc--toggle');
        toggleButton.setAttribute('aria-expanded', 'false');
        toggleButton.setAttribute('title', 'Open or close the Table of Contents');
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

    /* Action for showing the "Sidebar TOC" and hiding the "Toggle TOC" */
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

    /* Action for showing the "Toggle TOC" and hiding the "Sidebar TOC" */
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

    /* Initialize the Table of Contents on a page */
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
});
