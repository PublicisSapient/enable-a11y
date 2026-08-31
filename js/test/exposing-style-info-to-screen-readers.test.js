'use strict';

import config from './test-config.js';

describe('Styled Elements Tests', () => {
    it('Detect if there is sr-only content in the del or ins tags in the visually hidden text example', async () => {
        let domInfo;

        await page.goto(
            `${config.BASE_URL}/exposing-style-info-to-screen-readers.php`,
        );

        // The area of the page that has the product tile
        await page.waitForSelector('#sr-only-text-example');

        // check the DOM to see if the visually hidden CSS generated content is there.
        domInfo = await page.evaluate(() => {
            const markEls = document.querySelectorAll(
                '#sr-only-text-example del, #sr-only-text-example ins',
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

});
