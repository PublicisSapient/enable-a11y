'use strict';
import config from './test-config.js';
import testHelpers from './test-helpers.js';

describe("All combobox's Attributes Test", () => {
    let domInfo;
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
    });

    it('ARIA attributes are set', async () => {
        domInfo = await page.evaluate(() => {
            const comboEls = document.querySelectorAll(
                'input[role="combobox"]',
            );
            return {
                comboBoxList: Array.from(comboEls)?.map((el) => {
                    const ariaDescribedBy = el.getAttribute('aria-describedby');
                    const ariaOwns = el.getAttribute('aria-owns');
                    const domElementForAriaDescribedby =
                        document.getElementById(ariaDescribedBy);
                    const domElementForAriaOwns =
                        document.getElementById(ariaOwns);
                    const roleForAriaOwns =
                        domElementForAriaOwns.getAttribute('role');
                    return {
                        ariaDescribedBy,
                        ariaOwns,
                        ariaExpanded: el.getAttribute('aria-expanded'),
                        ariaAutocomplete: el.getAttribute('aria-autocomplete'),
                        domElementForAriaDescribedby,
                        domElementForAriaOwns,
                        roleForAriaOwns,
                    };
                }),
            };
        });
        domInfo.comboBoxList.forEach((combobox) => {
            expect(combobox.ariaDescribedBy).not.toBeNull();
            expect(combobox.ariaOwns).not.toBeNull();
            expect(combobox.ariaExpanded).toBe('false');
            expect(combobox.ariaAutocomplete).toBe('list');
            expect(combobox.domElementForAriaDescribedby).not.toBeNull();
            // Verify the aria-own dom element
            expect(combobox.domElementForAriaOwns).not.toBeNull();
            expect(combobox.roleForAriaOwns).toBe('listbox');
        });
    });
    afterAll(async () => {});
});

describe('Combobox1 Test for Accessible features', () => {
    let domInfo;
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
    });

    it('ARIA Combobox  is completely keyboard accessible', async () => {
        await page.waitForSelector('#aria-fruit');
        await page.focus('#aria-fruit');
        // Type some characters in the combobox
        await page.type('#aria-fruit', 'app', { delay: 100 });
        // Testing count in aria-live
        /*   const ariaLiveInfo = await page.evaluate(() => {
            const nextSibling = document.activeElement?.nextElementSibling;
            return nextSibling?.getAttribute('aria-live') || null;
        });
        console.log(ariaLiveInfo);*/
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
