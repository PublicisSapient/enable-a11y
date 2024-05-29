'use strict';

/*******************************************************************************
 * global.js - The global js file for all Enable pages.
 *
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 29, 2021
 *
 ******************************************************************************/

import showcode from './enable-libs/showcode.js';
import pauseAnimControl from './modules/pause-anim-control.js';
import Templify from './modules/templify.js';
import EnableFlyout from './modules/enable-flyout.js';
import enableVisibleOnFocus from './modules/enable-visible-on-focus.js';
import offscreenObserver from './modules/offscreen-observer.js';
import textZoom from './demos/hero-image-text-resize.js';
import tableOfContents from './modules/enable-toc.js';

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

function focusDeepLink() {
    const { hash } = window.location;

    if (hash !== '') {
        const elToFocus = document.querySelector(hash);
        if (elToFocus) {
            elToFocus.focus();
            scrollToEl(elToFocus);
        }
    }
}

function buildFlyoutMenuHTML() {
    // This is the DOM element where the hamburger menu will be inserted into.
    const hamburgerMenuEl = document.getElementById('enable-flyout-menu');

    // This is where the structure of the hamburger menu is stored (in JSON format).
    const hamburgerMenuJSONEl = document.getElementById('flyout-props');
    const hamburgerMenuJSON = JSON.parse(hamburgerMenuJSONEl.innerHTML);

    // Now, let's use Templify to convert the JSON into HTML.
    const hamburgerMenu = new Templify(hamburgerMenuEl, hamburgerMenuJSON);

    // Initialize the hamburger menu.
    EnableFlyout.init();
}

function initEnable() {
    offscreenObserver.init(document.querySelector('[role="banner"]'));

    enableVisibleOnFocus.init();
    buildFlyoutMenuHTML();

    // This is so we can use the breakpoint widths inside the documentation.
    const breakpointWidth = window
        .getComputedStyle(document.querySelector('.enable-flyout'))
        .getPropertyValue('--enable-flyout__desktop-min');
    Array.prototype.forEach.call(
        document.querySelectorAll('.breakpoint-width'),
        (el, i) => {
            el.innerHTML = breakpointWidth;
        },
    );



    pauseAnimControl.init();

    // So screen reader users, like VoiceOver users, can navigate via heading and have focus
    // applied to the heading.
    let headingIndex = 0;

    if (location.href.indexOf('index.php') === -1) {
        document
            .querySelectorAll('h1, h2, h3, h4, h5, h6, [role="heading"]')
            .forEach((el) => {
                // Only do this if:
                // 1) the heading doesn't have an ID
                // 2) it is not part of an example
                // 3) it has an ancestor with class no-permalink-headings.
                if (
                    el.closest('.enable-example') === null &&
                    el.closest('.no-permalink-headings') === null
                ) {
                    if (!el.id) {
                        const innerTextId =
                            el.innerText
                                .toLowerCase()
                                .replace(/[^a-zA-Z0-9]+/g, '-') + '--heading';

                        //console.log(innerTextId, document.querySelectorAll(`#${innerTextId}`).length);
                        if (
                            document.querySelectorAll(`#${innerTextId}`)
                                .length >= 1
                        ) {
                            headingIndex++;
                            el.id = `${innerTextId}-${headingIndex}`;
                        } else {
                            el.id = `${innerTextId}`;
                        }
                    }

                    if (el.getAttribute('tabIndex') === null) {
                        el.setAttribute('tabIndex', '-1');
                    }

                    // now, let's put a link tag inside the heading so we can deeplink to it easily
                    if (
                        el.nodeName !== 'H1' &&
                        el.getAttribute('role') !== 'heading'
                    ) {
                        el.innerHTML = `<a class="heading__deeplink" href="#${el.id}" title="Permalink to ${el.innerText}" aria-label="Permalink to ${el.innerText}">${el.innerHTML}</a>`;
                    }
                }

                if (el.getAttribute('tabIndex') === null) {
                    el.setAttribute('tabIndex', '-1');
                }

                // now, let's put a link tag inside the heading so we can deeplink to it easily
                if (el.nodeName !== 'H1' && el.getAttribute('role') !== 'heading') {
                    el.innerHTML = `<a class="heading__deeplink" href="#${el.id}" title="Permalink to ${el.innerText}" aria-label="Permalink to ${el.innerText}">${el.innerHTML}</a>`
                }

                return;
            })
        };


    focusDeepLink();

    tableOfContents.init(['/index.php', '/faq.php'], true, true);
}

initEnable();

// This is so our code walkthroughs can display the code in this file.
showcode.addJsObj('enableVisibleOnFocus', enableVisibleOnFocus);
showcode.addJsObj('EnableFlyout', EnableFlyout);
showcode.addJsObj('initEnable', initEnable);
showcode.addJsObj('buildFlyoutMenuHTML', buildFlyoutMenuHTML);

if (document.location.hash === '#debug') {
    console.log('logging enable events (debug mode)');

    // debug on event handlers
    const events = {
        'enable-listbox-change': 'value, id',
        'enable-listbox-show': '',
        'enable-listbox-hide': '',
        'enable-combobox-change': 'value',
        'enable-combobox-show': '',
        'enable-combobox-hide': '',
        'enable-focus-show': '',
        'enable-focus-hide': '',
        'enable-paginate-render': 'page',
        'enable-pause-animations': '',
        'enable-play-animations': '',
        'enable-checked': 'group',
        'enable-unchecked': 'group',
        'enable-expanded': '',
        'enable-collapsed': '',
        'enable-table-sort': 'index',
        'enable-switch-change': 'isChecked',
        'enable-selected': '',
        'enable-show': '',
        'enable-hide': '',
        'enable-spinbutton-change': 'value',
    };

    for (let eventName in events) {
        const properties = events[eventName].split(',');
        document.addEventListener(
            eventName,
            (event) => {
                for (var i = 0; i < properties.length; i++) {
                    const property = properties[i].trim();
                    console.log(
                        `${eventName} fired. ${property}:`,
                        event.detail && event.detail[property]
                            ? event.detail[property]()
                            : '',
                        'target:',
                        event.target,
                    );
                }
            },
            true,
        );
    }
}
