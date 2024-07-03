'use strict'

function scrollToEl(el, offset = 0) {
    /*
     * The setTimeout is here to ensure the focused elements coordinates are accurate
     */
    window.setTimeout(() => {
        const rect = el.getBoundingClientRect(),
            scrollTop =
                window.pageYOffset || document.documentElement.scrollTop,
            scrollLeft =
                window.pageXOffset || document.documentElement.scrollLeft,
            elTop = rect.top + scrollTop,
            elLeft = rect.left + scrollLeft;
        window.scrollTo({
            top: elTop - offset,
            left: elLeft,
        });
    }, 100);
}

function focusDeepLink() {
    const { hash } = window.location;

    if (hash !== '') {
        const elToFocus = document.querySelector(hash);
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

export { scrollToEl, focusDeepLink, addMissingIDToHeading, createPermalinksForHeading, splitCookies, getCookie, setCookie, deleteCookie }
