'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = testHelpers.getPageList();
let mobileBrowser, desktopBrowser;

describe('Test Focus States on all pages on Enable', () => {
    beforeAll(async () => {
        // Put code here that should execute before starting tests.
        desktopBrowser = await testHelpers.getDesktopBrowser();
        mobileBrowser = await testHelpers.getMobileBrowser();
    });

    afterAll(async () => {
        await mobileBrowser.close();
        await desktopBrowser.close();
    });

    async function testFocusStates(filename, isDesktop) {
        let domInfo,
            tabStops = 0,
            page;

        if (isDesktop) {
            page = await desktopBrowser.newPage();
        } else {
            page = await mobileBrowser.newPage();
        }

        // Wait until the DOM is fully loaded.
        await page.goto(`${config.BASE_URL}/${filename}`, {
            waitUntil: 'domcontentloaded',
        });

        // Let's loop through all the tabstops on the page.
        do {
            // Let's simulate a tab press
            await page.keyboard.press('Tab');

            // Now let's see if there is a focus ring around the
            // focused element.
            domInfo = await page.evaluate(() => {
                const { activeElement } = document;

                // grab outline CSS style property
                const style = window.getComputedStyle(activeElement, null);
                let { outline, outlineColor, outlineWidth, outlineStyle } =
                    style;
                let hasFocusRing =
                    outlineStyle !== 'none' &&
                    parseInt(outlineWidth) !== 0 &&
                    outlineColor !== 'transparent';
                let checkedPseudoEl = false;

                const isIframe = activeElement.nodeName === 'IFRAME';
                const isVideo = activeElement.nodeName === 'VIDEO';

                // Special tests for range element
                const isRangeInput =
                    activeElement.nodeName === 'INPUT' &&
                    activeElement.getAttribute('type') === 'range';

                if (isRangeInput && !hasFocusRing) {
                    let rangeThumbSlideStyle = window.getComputedStyle(
                        activeElement,
                        '::-webkit-slider-thumb',
                    );
                    checkedPseudoEl = true;
                    outline = rangeThumbSlideStyle.outline;
                    outlineColor = rangeThumbSlideStyle.outlineColor;
                    outlineWidth = rangeThumbSlideStyle.outlineWidth;
                    outlineStyle = rangeThumbSlideStyle.outlineStyle;
                    hasFocusRing =
                        outlineStyle !== 'none' && parseInt(outlineWidth) !== 0;
                }
                // end of special tests.

                return {
                    html: activeElement.outerHTML,
                    hasFocusRing,
                    outline,
                    outlineColor,
                    outlineWidth,
                    outlineStyle,
                    isEnableSkipLink: activeElement.classList.contains(
                        'enable-mobile-visible-on-focus',
                    ),
                    isBody: activeElement === document.body,
                    isIframe,
                    isVideo,
                    isRangeInput,
                    checkedPseudoEl,
                };
            });

            // If this is not a skip link (which has its own test suite),
            // and not a body, video or iframe tag (which don't report their
            // valid focus states in puppeteer for some reason).
            if (
                !domInfo.isEnableSkipLink &&
                !domInfo.isBody &&
                !domInfo.isVideo &&
                !domInfo.isIframe
            ) {
                // If the focused element doesn't have a focus ring, output why.
                if (!domInfo.hasFocusRing) {
                    console.log('Bad focus on: ', domInfo.html);
                    console.log(
                        'Checked Pseudo element',
                        domInfo.checkedPseudoEl,
                    );
                    console.log(
                        `outlineColor: ${domInfo.outlineColor}\noutline: ${domInfo.outline}\noutlineWidth: ${domInfo.outlineWidth}\noutlineStyle: ${domInfo.outlineStyle}`,
                    );
                }

                // The expect test so jest logs it as an error.
                expect(domInfo.hasFocusRing).toBe(true);
            }
        } while (!domInfo.isBody);

        page.close();
    }
    // end testFocusStates()

    // This goes through all the URLs in the site and
    // runs testFocusStates() on it twice, one in the desktop
    // browser and one in the mobile.
    for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];
        it(`Desktop Breakpoint: Test focus states on ${file}`, async () => {
            await testPageWidth(file, true);
        });
        it(`Mobile Breakpoint: Test focus states on ${file}`, async () => {
            await testPageWidth(file, false);
        });
    }
});
