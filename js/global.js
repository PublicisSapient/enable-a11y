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
import tableOfContents from './modules/enable-toc.js';
import {
    focusDeepLink,
    createPermalinksForHeading,
} from './modules/helpers.js';

const colorSchemeMql = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)');

function buildFlyoutMenuHTML() {
    // This is the DOM element where the hamburger menu will be inserted into.
    const hamburgerMenuEl = document.getElementById('enable-flyout-menu');

    // This is where the structure of the hamburger menu is stored (in JSON format).
    const hamburgerMenuJSONEl = document.getElementById('flyout-props');
    const hamburgerMenuJSON = JSON.parse(hamburgerMenuJSONEl.innerHTML);

    // Now, let's use Templify to convert the JSON into HTML.
    new Templify(hamburgerMenuEl, hamburgerMenuJSON);

    // Initialize the hamburger menu.
    EnableFlyout.init();
}

function includesUrl(string) {
    if (location.href.includes(string)) {
        return true;
    }
    return false;
}

function setColorScheme() {
    if (window.matchMedia) {
        if (colorSchemeMql.matches) {
            document.body.classList.add('enable__is-dark-mode');
        } else {
            document.body.classList.remove('enable__is-dark-mode');
        }
    }
}

function initEnable() {
    // turn on dark mode on the site
    setColorScheme();
    colorSchemeMql.addEventListener('change', setColorScheme);

    offscreenObserver.init(document.getElementById('header'));

    enableVisibleOnFocus.init();
    buildFlyoutMenuHTML();

    // This is so we can use the breakpoint widths inside the documentation.
    const breakpointWidth = window
        .getComputedStyle(document.querySelector('.enable-flyout'))
        .getPropertyValue('--enable-flyout__desktop-min');
    Array.prototype.forEach.call(
        document.querySelectorAll('.breakpoint-width'),
        (el) => {
            el.innerHTML = breakpointWidth;
        },
    );

    pauseAnimControl.init();

    // Add permalinks on all pages except home, so screen reader users, like VoiceOver users, can navigate via heading and have focus applied to the heading.
    let headingIndex = 0;

    const indexPage = includesUrl('index.php')
    const formsMenuPage = includesUrl('forms-menu.php');
    const contentMenuPage = includesUrl('content-menu.php');
    const controlsMenuPage = includesUrl('controls-menu.php');
    const codePatternsMenuPage = includesUrl('code-patterns-menu.php');

    if (!indexPage && !codePatternsMenuPage && !formsMenuPage && !contentMenuPage && !controlsMenuPage) {
        document
            .querySelectorAll('h1, h2, h3, h4, h5, h6, [role="heading"]')
            .forEach((el) => {
                // Only do this if:
                // 1) it is not part of an example
                // 2) it does not have an ancestor with class no-permalink-headings
                if (
                    el.closest('.enable-example') === null &&
                    el.closest('.no-permalink-headings') === null
                ) {
                    createPermalinksForHeading(el, headingIndex, true);
                }

                // If the heading doesn't have a tabindex, add one.
                if (el.getAttribute('tabIndex') === null) {
                    el.setAttribute('tabIndex', '-1');
                }

                return;
            });
    }

    focusDeepLink();

    tableOfContents.init({
        skipPages: [
            '/index.php',
            '/faq.php',
            '/enable/index.php',
            '/enable/faq.php',
            '/forms-menu.php',
            '/content-menu.php',
            '/controls-menu.php',
            '/code-patterns-menu.php'
        ],
        showAsSidebarDefault: true,
        numberFirstLevelHeadings: true,
        selectorToSkipHeadingsWithin: '.enable-example',
        collapseNestedHeadingsAfterLevel: 2,
    });
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
