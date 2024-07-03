'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

describe('Combobox Test', () => {
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
    });

    it('HTML5 Native combobox is not completely keyboard accessible', async () => {
        //select the Input box of the HTM5 Combobox
        await page.waitForSelector('#html5-fruit');
        const comboBoxCount = Array.from(await page.$$('#html5-fruit')).length;
        // to add focus on the input element
        await page.focus('#html5-fruit');
        const activeElement = await page.evaluate(() => {
            const id = document.activeElement.id;
            const ariaDescribedBy =
                document.activeElement.getAttribute('aria-describedby');
            return {
                id,
                ariaDescribedBy,
            };
        });
        expect(comboBoxCount).toBe(1);
        expect(activeElement.id).toBe('html5-fruit');
        // Verify aria attribute
        expect(activeElement.ariaDescribedBy).toBe('html5-fruit__desc');

        //set the input value to apple and test the Combo box selection using keys
        await page.type('#html5-fruit', 'apple');
        await testHelpers.pauseFor(100);
        await testHelpers.keyDownAndUp(page, 'ArrowDown');
        await page.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        // Enter not supported using Keyboard, value is not selected
        const valueAfterEnter = await page.evaluate(
            () => document.getElementById('html5-fruit')?.value,
        );

        await page.waitForSelector('#languages');
        const datalistCount = Array.from(await page.$$('#languages')).length;
        expect(valueAfterEnter).toBe('');
        expect(datalistCount).toBe(1);
    });

    it('ARIA Combobox  is completely keyboard accessible', async () => {
        let domInfo = {};
        await page.waitForSelector('#aria-fruit');
        await page.focus('#aria-fruit');
        // type some characters in the combobox
        await page.type('#aria-fruit', 'app', { delay: 100 });
        const expectedScreenReaderText =
            '2 items. <span class="sr-only">As you type, press the enter key or use the up and down arrow keys to choose the autocomplete items.</span>';
        domInfo = await page.evaluate(() => {
            const { activeElement } = document;
            const ariaDescribedBy =
                activeElement.getAttribute('aria-describedby');
            const ariaExpanded = activeElement.getAttribute('aria-expanded');
            const sceenReaderText = document.querySelector(
                '#aria-fruit+div[role="alert"]',
            ).innerHTML;

            return {
                ariaDescribedBy,
                ariaExpanded,
                sceenReaderText,
            };
        });
        expect(domInfo.ariaDescribedBy).toBe('aria-fruit__desc');
        expect(domInfo.ariaExpanded).toBe('true');
        // Test the screen reader is having the count of options and assistant in selecting the options.
        expect(domInfo.sceenReaderText).toBe(expectedScreenReaderText);

        //Test the value selection work using the keyboard
        testHelpers.keyDownAndUp(page, 'ArrowDown');
        await page.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        domInfo = await page.evaluate(() => {
            const focusedElementType = document?.activeElement?.type;
            const inputElement = document.getElementById('aria-fruit');
            const ariaExpanded = inputElement.getAttribute('aria-expanded');
            const selectedValue = inputElement.value;

            return {
                ariaExpanded,
                selectedValue,
                focusedElementType,
            };
        });
        expect(domInfo.ariaExpanded).toBe('false');
        expect(domInfo.selectedValue).toBe('Apple');
        expect(domInfo.focusedElementType).toBe('reset');

        // Test the reset button functionality using the keyboard
        await page.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        const valueAfterReset = await page.evaluate(
            () => document?.activeElement?.value,
        );

        expect(valueAfterReset).toBe('');
    });

    afterAll(async () => {});
});
