'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = testHelpers.getPageList();
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

    async function testPageWidth(filename, isDesktop) {
        let domInfo, page;

        if (isDesktop) {
            page = await desktopBrowser.newPage();
        } else {
            page = await mobileBrowser.newPage();
        }

        // Wait until the DOM is fully loaded.
        await page.goto(`${config.BASE_URL}/${filename}`, {
            waitUntil: 'load',
        });

        domInfo = await page.evaluate(() => {
            const { clientWidth, scrollWidth } = document.body;
            const { innerWidth } = window;
            const domInfo = {};

            return {
                doesPageHorizontallScroll: scrollWidth > clientWidth,
                clientWidth,
                scrollWidth,
                innerWidth,
            };
        });

        if (domInfo.doesPageHorizontallScroll) {
            console.log(
                `Page ${filename} - scrollWidth: ${domInfo.scrollWidth}, clientWidth: ${domInfo.clientWidth}.`,
            );
        }

        expect(domInfo.doesPageHorizontallScroll).toBe(false);
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
