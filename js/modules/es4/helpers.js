'use strict'

/**
 * Scrolls the window to the specified element, with an optional vertical offset.
 * This function is typically used in conjunction with focusing operations to ensure
 * the element is visible in the viewport.
 *
 * @param {HTMLElement} el - The element to which the window should scroll.
 * @param {number} [offset=0] - Optional vertical offset from the element's top position.
 */
function scrollToEl(el, offset = 0) {
    /*
     * The setTimeout is used to delay the execution of the scroll action by 100 milliseconds.
     * This delay ensures that any pending DOM updates affecting the element's position are completed,
     * thus obtaining accurate coordinates for the element.
     */
    window.setTimeout(() => {
        // Calculate the element's position relative to the viewport.
        const rect = el.getBoundingClientRect();
        // Get the current scroll position of the window, accounting for browser compatibility.
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        // Calculate the absolute top and left coordinates of the element.
        const elTop = rect.top + scrollTop;
        const elLeft = rect.left + scrollLeft;
        // Scroll to the element, adjusting for the specified offset.
        window.scrollTo({
            top: elTop - offset,
            left: elLeft,
        });
    }, 100);
}

/**
 * Focuses on and scrolls to the element specified by the URL hash.
 * This function is typically used to handle in-page navigation where a specific
 * section of the page is linked with a URL hash.
 */
function focusDeepLink() {
    // Extract the hash from the current window location.
    const { hash } = window.location;

    if (hash !== '') {
        const elToFocus = document.querySelector(hash);

        // If the element exists, focus on it and scroll to it.
        if (elToFocus) {
            elToFocus.focus();
            scrollToEl(elToFocus, 100);
        }
    }
}

/**
 * Assigns a unique ID to a heading element if it does not already have one.
 * The ID is generated based on the text content of the heading and, if necessary,
 * a numeric suffix to ensure uniqueness within the document.
 *
 * @param {HTMLElement} headingElement - The heading element to which the ID should be assigned.
 * @param {number} [headingIndex=0] - Optional starting index used to help generate a unique ID.
 */
function addMissingIDToHeading(headingElement, headingIndex = 0) {
    if (headingElement.id) {
        return; // Exit if the heading already has an ID
    }

    // Create a base ID from the heading's text content
    const baseId = headingElement.textContent.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-') + '--heading';
    let newId = baseId + (headingIndex ? `-${headingIndex}` : '');

    // Check for uniqueness and adjust if necessary
    while (document.getElementById(newId)) {
        headingIndex++;
        newId = `${baseId}-${headingIndex}`;
    }

    // Assign the unique ID to the heading element
    headingElement.id = newId;
}

/**
 * Finds and constructs a string of HTML <img> tags for images located in sibling elements of a specified heading.
 * These sibling elements must have a specific class name. The function returns a string containing <img> tags
 * with all attributes, modifying the class attribute if present.
 *
 * @param {string} headingId - The ID of the heading element from which to start searching for sibling elements.
 * @param {string} className - The class name that sibling elements must have to be included in the search.
 * @returns {string} A string containing <img> tags constructed from the images found, with all relevant attributes.
 */
function findImagesNextToHeading(headingId, className) {
    const heading = document.getElementById(headingId);
    let images = '';

    if (heading) {
        let nextElement = heading.nextElementSibling;

        // Iterate over siblings with the specified class name
        while (nextElement && nextElement.classList.contains(className)) {
            const imgElements = nextElement.querySelectorAll('img');

            // Append attributes of img elements to the images string
            imgElements.forEach((img) => {
                const attributes = Array.from(img.attributes)
                    .map((attr) => {
                        return attr.name !== 'class'
                            ? `${attr.name}="${attr.value}"`
                            : ((attr.value += ' enable-stats__heading-icon'),
                              `${attr.name}="${attr.value}"`);
                    })
                    .join(' ');
                images += `<img ${attributes}>`;
            });
            // Move to the next sibling
            nextElement = nextElement.nextElementSibling;
        }
    }
    return images;
}

/**
 * Enhances heading elements by adding permalinks for deep linking and optionally prepending images.
 * It ensures that each heading has a unique ID and a tabindex attribute for accessibility.
 * If specified, images from sibling elements with a certain class are also added next to the heading.
 *
 * @param {HTMLElement} headingElement - The heading element to enhance with a permalink.
 * @param {number} headingIndex - The index used for generating a unique ID if the heading lacks one.
 * @param {boolean} includeImages - Determines whether to prepend images to the heading.
 */
function createPermalinksForHeading(headingElement, headingIndex, includeImages) {
    // Make sure the heading has an ID
    addMissingIDToHeading(headingElement, headingIndex);

    // If the heading doesn't have a tabindex, add one.
    if (headingElement.getAttribute('tabIndex') === null) {
        headingElement.setAttribute('tabIndex', '-1');
    }

    // now, let's put a link tag inside the heading so we can deeplink to it easily
    if (
        headingElement.nodeName !== 'H1' &&
        headingElement.getAttribute('role') !== 'heading'
    ) {
        // now, let's put a link tag inside the heading so we can deeplink to it easily
        headingElement.innerHTML = `<a class="heading__deeplink" href="#${headingElement.id}" title="Permalink to ${headingElement.innerText}" aria-label="Permalink to ${headingElement.innerText}">${headingElement.innerHTML}</a>`;

        // Optionally add icons next to the heading if the content below the heading has any images
        if (
            includeImages &&
            headingElement.nextElementSibling?.classList.contains(
                'enable-stats',
            )
        ) {
            const images = findImagesNextToHeading(
                headingElement.id,
                'enable-stats',
            );
            headingElement.innerHTML = images + headingElement.innerHTML;
        }
    }
}

/**
 * Parses the document's cookies and returns an object where each property represents a cookie.
 * Cookie names are the object's keys, and cookie values are the corresponding values.
 *
 * @returns {Object} An object containing all cookies as properties with their decoded values.
 */
function splitCookies() {
    const list = {};
    document?.cookie?.split(';')?.forEach((cookie) => {
        const parts = cookie.split('=');
        list[parts.shift().trim()] = decodeURI(parts.join('='));
    });
    return list;
}

/**
 * Retrieves the value of a specific cookie by name.
 * This function utilizes the `splitCookies` function to parse the document's cookies into an object,
 * and then accesses the value of the specified cookie from this object.
 *
 * @param {string} name - The name of the cookie whose value is to be retrieved.
 * @returns {string|undefined} The value of the specified cookie, or undefined if the cookie does not exist.
 */
function getCookie(name) {
    return splitCookies()[name];
}

/**
 * Sets a cookie with a specified name and value.
 * The cookie is set for the root path ('/') of the domain, making it accessible across the entire website.
 *
 * @param {string} name - The name of the cookie to set.
 * @param {string} value - The value of the cookie.
 */
function setCookie(name, value) {
    document.cookie = `${name}=${value}; path=/;`;
}

/**
 * Deletes a cookie by setting its expiration date to a past date.
 * This effectively removes the cookie from the browser as expired cookies are not retained.
 *
 * @param {string} name - The name of the cookie to delete.
 */
function deleteCookie(name) {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}
