'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';
let domInfo;

//Utility function to write assertions
async function verifyActiveElementAttributes(page, expectedAttributes) {
    const results = await page.evaluate(() => {
        const { activeElement } = document;
        return {
            ariaDescribedBy: activeElement.getAttribute('aria-describedby'),
            ariaExpanded: activeElement.getAttribute('aria-expanded'),
            role: activeElement.getAttribute('role'),
            ariaOwns: activeElement.getAttribute('aria-owns'),
            ariaAutocomplete: activeElement.getAttribute('aria-autocomplete'),
        };
    });
    // Perform assertions based on expected attributes
    expect(results.ariaDescribedBy).toBe(expectedAttributes.ariaDescribedBy);
    expect(results.ariaExpanded).toBe(expectedAttributes.ariaExpanded);
    expect(results.role).toBe(expectedAttributes.role);
    expect(results.ariaOwns).toBe(expectedAttributes.ariaOwns);
    expect(results.ariaAutocomplete).toBe(expectedAttributes.ariaAutocomplete);
}

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
        // Enter not behave as expected using Keyboard, value is not selected
        const valueAfterEnter = await page.evaluate(
            () => document.getElementById('html5-fruit')?.value,
        );

        await page.waitForSelector('#languages');
        const datalistCount = Array.from(await page.$$('#languages')).length;
        expect(valueAfterEnter).toBe('');
        expect(datalistCount).toBe(1);
    });

    it('ARIA Combobox  is completely keyboard accessible', async () => {
        await page.waitForSelector('#aria-fruit');
        await page.focus('#aria-fruit');
        // Type some characters in the combobox
        await page.type('#aria-fruit', 'app', { delay: 100 });
        // Testing Attributes of the Active Combobox
        const expectedAttributes = {
            ariaDescribedBy: 'aria-fruit__desc',
            ariaExpanded: 'true',
            role: 'combobox',
            ariaOwns: 'aria-fruit__list',
            ariaAutocomplete: 'list',
        };
        await verifyActiveElementAttributes(page, expectedAttributes);

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

    it('AutoSubmit using the aria combobox is completely keyboard accessible', async () => {
        await page.waitForSelector('#video-games');
        await page.focus('#video-games');
        await page.type('#video-games', 'a', { delay: 100 });

        // Testing Attributes of the Active Combobox
        const expectedAttributes = {
            ariaDescribedBy: 'video-games__desc',
            ariaExpanded: 'true',
            role: 'combobox',
            ariaOwns: 'video-games__list',
            ariaAutocomplete: 'list',
        };
        await verifyActiveElementAttributes(page, expectedAttributes);

        testHelpers.keyDownAndUp(page, 'ArrowDown');
        await page.keyboard.press('Enter');
        // Testing Redirection on submission
        await page.waitForNavigation();
        const currentUrl = await page.url();
        expect(currentUrl.includes('google.com')).toBe(true);
    });

    it('Selection in different categories using the aria combobox is completely keyboard accessible', async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
        await page.waitForSelector('#aria-example-2');
        await page.focus('#aria-example-2');
        await page.type('#aria-example-2', 'can', { delay: 100 });
        const expectedAttributes = {
            ariaDescribedBy: 'aria-example-2__desc',
            ariaExpanded: 'true',
            role: 'combobox',
            ariaOwns: 'aria-example-2__list',
            ariaAutocomplete: 'list',
        };
        await verifyActiveElementAttributes(page, expectedAttributes);

        testHelpers.keyDownAndUp(page, 'ArrowDown');
        await page.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        //Testing the category and value selection
        const selected = await page.$eval(
            '.enable-combobox__category-alert',
            (el) => {
                const arr = el.value.split(',').map((item) => item.trim());
                return { value: arr[0], category: arr[1] }; // containing value and category
            },
        );
        expect(selected.value).toBe('Canada');
        expect(selected.category).toBe('Other States group');
    });

    afterAll(async () => {});
});
