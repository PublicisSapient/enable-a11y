'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = testHelpers.getPageList();

describe('Test link targets on all pages on Enable', () => {
    beforeAll(async () => {});

    afterAll(async () => {});

    async function testPage(filename) {
        let domInfo;

        await page.goto(`${config.BASE_URL}/${filename}`);

        // Test on initial load.

        // Step 1: Wait for whole page to load (this is so scripts
        // like `enable-visible-on-focus` can initialize)
        await page.waitForSelector('footer');

        domInfo = await page.evaluate(() => {
            const linkEls = document.querySelectorAll('a');
            const badLinkHTML = [];
            for (let i = 0; i < linkEls.length; i++) {
                const linkEl = linkEls[i];
                const href = linkEl.getAttribute('href');

                if (href === null || href.indexOf('//localhost') !== -1) {
                    badLinkHTML.push(linkEl.outerHTML);
                }
            }

            return {
                badLinkHTML,
            };
        });
        const { badLinkHTML } = domInfo;

        if (badLinkHTML.length > 0) {
            console.log('Bad HTML:', badLinkHTML);
        }
        //expect(badLinkHTML.length).toBe(0);
    }

    for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];
        it(`Test links on ${file}`, async () => {
            await testPage(file);
            // console.log('tested', file)
        });
    }
});
