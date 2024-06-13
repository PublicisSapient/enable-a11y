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

function addMissingIDToHeading(headingElement, headingIndex = 0) {
    if (!headingElement.id) {
        const innerTextId = headingElement.innerText.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-') + '--heading';

        if (document.querySelectorAll(`#${innerTextId}`).length >= 1) {
            headingIndex++;
            headingElement.id = `${innerTextId}-${headingIndex}`;
        } else {
            headingElement.id = `${innerTextId}`;
        }
    }
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

