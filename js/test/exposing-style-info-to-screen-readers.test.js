'use strict';

import config from './test-config.js';

describe('Styled Elements Tests', () => {
    it('Detect if there is sr-only content in the mark tags in the visually hidden text example', async () => {
        let domInfo;

        await page.goto(
            `${config.BASE_URL}/exposing-style-info-to-screen-readers.php`
        );

        // The area of the page that has the product tile
        await page.waitForSelector('#sr-only-text-example');

        // check the DOM to see if the visually hidden CSS generated content is there.
        domInfo = await page.evaluate(() => {
            const markEls = document.querySelectorAll(
                '#sr-only-text-example mark'
            );
            let hasMissingMarkContent = false;

            for (let i = 0; i < markEls.length; i++) {
                const firstElementChild = markEls[i].firstElementChild;

                if (!firstElementChild.classList.contains('sr-only')) {
                    hasMissingMarkContent = true;
                }
            }

            return {
                numMarkTests: markEls.length,
                hasMissingMarkContent,
            };
        });

        expect(domInfo.numMarkTests).toBeGreaterThan(0);
        expect(domInfo.hasMissingMarkContent).toBe(false);
    });

    it('Detect if there are sr-only content inside the highlighted text of the Enable code walkthroughs', async () => {
        let domInfo;

        await page.goto(
            `${config.BASE_URL}/exposing-style-info-to-screen-readers.php`
        );

        // The area of the page that has the highlighted code
        await page.waitForSelector('#highlight-example');

        // check the DOM to see if the visually hidden CSS generated content is there.
        domInfo = await page.evaluate(() => {
            const markEls = document.querySelectorAll(
                '#highlight-example mark'
            );
            let hasMissingBeginningContent = false;
            let hasMissingEndContent = false;

            for (let i = 0; i < markEls.length; i++) {
                const { firstElementChild, lastElementChild } = markEls[i];

                if (!firstElementChild.classList.contains('sr-only')) {
                    hasMissingBeginningContent = true;
                }

                if (!lastElementChild.classList.contains('sr-only')) {
                    hasMissingEndContent = true;
                }
            }

            return {
                numTests: markEls.length,
                hasMissingBeginningContent,
                hasMissingEndContent,
            };
        });

        expect(domInfo.numTests).toBeGreaterThan(0);
        expect(domInfo.hasMissingBeginningContent).toBe(false);
        expect(domInfo.hasMissingEndContent).toBe(false);
    });
});
