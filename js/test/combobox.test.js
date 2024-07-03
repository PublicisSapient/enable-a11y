'use strict';

const puppeteer = require('puppeteer'); // v22.0.0 or later
import config from './test-config.js';
import testHelpers from './test-helpers.js';
let targetPage = '';
let browser;

describe('Combobox Test', () => {
    beforeAll(async () => {
        browser = await puppeteer.launch({ headless: false });
        const page = await browser.newPage();
        targetPage = page;

        await targetPage.goto(`${config.BASE_URL}/combobox.php`);
    });

    it('HTML5 Native combobox is not completely keyboard accessible', async () => {
        //select the Input box of the HTM5 Combobox
        await targetPage.waitForSelector('#html5-fruit');
        const comboBoxCount = Array.from(
            await targetPage.$$('#html5-fruit'),
        ).length;
        // to add focus on the input element
        await targetPage.focus('#html5-fruit');
        const activeElement = await targetPage.evaluate(() => {
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
        await targetPage.type('#html5-fruit', 'apple');
        await testHelpers.pauseFor(100);
        await testHelpers.keyDownAndUp(targetPage, 'ArrowDown');
        await targetPage.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        // Enter not supported using Keyboard, value is not selected
        const valueAfterEnter = await targetPage.evaluate(
            () => document.getElementById('html5-fruit')?.value,
        );

        await targetPage.waitForSelector('#languages');
        const datalistCount = Array.from(
            await targetPage.$$('#languages'),
        ).length;
        expect(valueAfterEnter).toBe('');
        expect(datalistCount).toBe(1);
    });

    it('ARIA Combobox  is completely keyboard accessible', async () => {
        let domInfo = {};
        await targetPage.waitForSelector('#aria-fruit');
        await targetPage.focus('#aria-fruit');
        // type some characters in the combobox
        await targetPage.type('#aria-fruit', 'app', { delay: 100 });
        const expectedScreenReaderText =
            '2 items. <span class="sr-only">As you type, press the enter key or use the up and down arrow keys to choose the autocomplete items.</span>';
        domInfo = await targetPage.evaluate(() => {
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
        testHelpers.keyDownAndUp(targetPage, 'ArrowDown');
        await targetPage.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        domInfo = await targetPage.evaluate(() => {
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
        await targetPage.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        const valueAfterReset = await targetPage.evaluate(
            () => document?.activeElement?.value,
        );

        expect(valueAfterReset).toBe('');
    });

    afterAll(async () => await browser.close());
});
