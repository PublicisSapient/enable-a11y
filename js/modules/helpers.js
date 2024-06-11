'use strict'

function scrollToEl(el) {
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
            top: elTop - 200,
            left: elLeft,
        });
    }, 100);
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

export { scrollToEl, addMissingIDToHeading, splitCookies, getCookie, setCookie, deleteCookie }
