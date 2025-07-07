'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = ['code-quality.php']; //testHelpers.getPageList();
let mobileBrowser, desktopBrowser;

describe('Test Horizontal Scrolling on all pages on Enable', () => {
    beforeAll(async () => {
        // Put code here that should execute before starting tests.
        desktopBrowser = await testHelpers.getDesktopBrowser();
        mobileBrowser = await testHelpers.getMobileBrowser();
    });

    afterAll(async () => {
        await mobileBrowser.close();
        await desktopBrowser.close();
    });

    async function checkViewportWidth() {
        const domInfo = await page.evaluate(() => {
            const { clientWidth, scrollWidth } = document.body;
            const firstWrapTextCheckbox = document.querySelector(
                '.showcode__wrap-text',
            );

            return {
                doesPageHorizontallyScroll: scrollWidth > clientWidth,
                clientWidth,
                scrollWidth,
                isWrapChecked: firstWrapTextCheckbox
                    ? firstWrapTextCheckbox.checked
                    : 'no checkbox',
            };
        });

        expect(domInfo.doesPageHorizontallyScroll).toBe(false);
    }

    async function testPageWidth(filename, isDesktop) {
        let page;

        if (isDesktop) {
            page = await desktopBrowser.newPage();
        } else {
            page = await mobileBrowser.newPage();
        }

        // Wait until the DOM is fully loaded.
        await page.goto(`${config.BASE_URL}/${filename}`, {
            waitUntil: 'load',
        });

        await checkViewportWidth();

        const hasCheckbox = await page.evaluate(() => {
            const firstWrapTextCheckbox = document.querySelector(
                '.showcode__wrap-text',
            );
            if (firstWrapTextCheckbox) {
                firstWrapTextCheckbox.focus();
                return true;
            } else {
                return false;
            }
        });

        if (hasCheckbox) {
            // press space and check if it's unchecked.
            await page.keyboard.press('Space');

            testHelpers.fastPause();

            await checkViewportWidth();
        }
    }

    // This goes through all the URLs in the site and
    // runs testFocusStates() on it twice, one in the desktop
    // browser and one in the mobile.
    for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];
        it(`Desktop Breakpoint: Test horizontal on ${file}`, async () => {
            await testPageWidth(file, true);
        });
        it(`Mobile Breakpoint: Test horizontal on ${file}`, async () => {
            await testPageWidth(file, false);
        });
    }
});
