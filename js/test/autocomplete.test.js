'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

describe('Form Accessibility Tests', () => {
    beforeAll(async () => {});

    // Test #1
    it('See if all input fields in the form are keyboard accessible', async () => {
        let domInfo;

        await page.goto(`${config.BASE_URL}/autocomplete.php`);

        // wait until all content loads
        await page.waitForSelector('#autocomplete');

        const inputsInForm = Array.from(
            await page.$$('#autocomplete input'),
        ).length;
        expect(inputsInForm).toBeGreaterThan(0);

        for (let i = 0; i < inputsInForm; i++) {
            //focus the input
            domInfo = await page.evaluate((i) => {
                const inputEls = document.querySelectorAll(
                    '#autocomplete input',
                );
                const inputEl = inputEls[i];
                const ariaLabelledby = inputEl.getAttribute('aria-labelledby');
                const ariaLabel = inputEl.getAttribute('aria-label');
                let label = null;

                if (ariaLabelledby !== null) {
                    const ariaLabelledbyEl =
                        document.getElementById(ariaLabelledby);

                    if (ariaLabelledbyEl !== null) {
                        label = ariaLabelledbyEl.innerText.trim();
                    }
                } else {
                    label = ariaLabel.innerText.trim();
                }

                inputEl.focus();

                return {
                    isFocused: document.activeElement === inputEl,
                    hasLabel: label !== null && label !== '',
                };
            }, i);

            expect(domInfo.isFocused).toBe(true);
            expect(domInfo.hasLabel).toBe(true);
        }
    });
});
