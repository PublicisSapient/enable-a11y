'use strict';
import config from './test-config.js';
import testHelpers from './test-helpers.js';

//Utility function to write assertions for checking combo box's input aria-attributes
async function verifyActiveElementAttributes(page, expectedAttributes) {
    const results = await page.evaluate(() => {
        const { activeElement } = document;
        const ariaOwns = activeElement.getAttribute('aria-owns');
        const domElementForAriaOwns = Array.from(
            document.querySelectorAll(`#${ariaOwns}`),
        );
        const roleForAriaOwnsId = domElementForAriaOwns[0].getAttribute('role');
        return {
            ariaDescribedBy: activeElement.getAttribute('aria-describedby'),
            ariaExpanded: activeElement.getAttribute('aria-expanded'),
            role: activeElement.getAttribute('role'),
            ariaOwns: activeElement.getAttribute('aria-owns'),
            ariaAutocomplete: activeElement.getAttribute('aria-autocomplete'),
            domElementForAriaOwns,
            roleForAriaOwnsId,
        };
    });

    // Perform assertions based on expected attributes
    expect(results.ariaDescribedBy).toBe(expectedAttributes.ariaDescribedBy);
    expect(results.ariaExpanded).toBe(expectedAttributes.ariaExpanded);
    expect(results.role).toBe(expectedAttributes.role);
    expect(results.ariaOwns).toBe(expectedAttributes.ariaOwns);
    expect(results.ariaAutocomplete).toBe(expectedAttributes.ariaAutocomplete);
    // Testing aria-owns id exist in dom
    expect(results.domElementForAriaOwns.length).toBe(1);
    expect(results.roleForAriaOwnsId).toBe('listbox');
}
//Utility function to write assertions for checking aria-describedBy id exist in the dom
async function verifyAriaDescribedById(page, id) {
    const domElementForAriaDescribedby = await page.$(`#${id}`);
    testHelpers.pauseFor(100);
    expect(domElementForAriaDescribedby).not.toBeNull();
}
//Utility function to write assertions for checking aria-owns id exist in the dom
/*async function verifyAriaOwnsId(page, id) {
    console.log(id);
    const results = await page.evaluate((id) => {
        const domElementForAriaOwns = Array.from(document.querySelectorAll(id));
        console.log(domElementForAriaOwns);
         return {
            domElementForAriaOwns,
            role: domElementForAriaOwns[0]?.getAttribute('role'),
         }          
    });
    expect(results.domElementForAriaOwns.length).toBe(1); 
    expect(results.role).toBe('listbox');   
}*/

describe('Combobox1 Test', () => {
    let domInfo;
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
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
        //  await verifyAriaOwnsId(page, "#aria-fruit__list");
        await verifyAriaDescribedById(page, 'aria-fruit__desc');

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
describe('Combobox2 Test', () => {
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
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
        await verifyAriaDescribedById(page, 'video-games__desc');

        testHelpers.keyDownAndUp(page, 'ArrowDown');
        await page.keyboard.press('Enter');
        // Testing Redirection on submission
        await page.waitForNavigation();
        const currentUrl = await page.url();
        expect(currentUrl.includes('google.com')).toBe(true);
    });
    afterAll(async () => {});
});
describe('Combobox3 Test', () => {
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
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
        await verifyAriaDescribedById(page, 'aria-example-2__desc');

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
