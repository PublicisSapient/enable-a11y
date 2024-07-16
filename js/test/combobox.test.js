'use strict';
import config from './test-config.js';
import testHelpers from './test-helpers.js';

//Utility function to get current value
const getActiveElementValue = async () => {
    return page.evaluate(() => document?.activeElement?.value);
};

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

describe('ARIA Combobox Test for Accessible features', () => {
    let domInfo;
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
        await page.waitForSelector('#aria-fruit');
        await page.focus('#aria-fruit');
        await page.type('#aria-fruit', 'app', { delay: 100 });
        await testHelpers.pauseFor(100);
    });
    it('ARIA Combobox  is able to alert the matching count updates', async () => {
        const ariaLiveValue = await page.evaluate(() => {
            const ariaLiveElem = document.querySelector(
                '#example1 [role="alert"]',
            );
            return ariaLiveElem?.textContent;
        });
        expect(ariaLiveValue).toContain('2 items');
    });

    it('ARIA Combobox select value using keyboard', async () => {
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
    });

    it('ARIA Combobox  is able to reset using the reset button', async () => {
        // Focus will be on the Reset button
        await page.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        const valueAfterReset = await getActiveElementValue();
        expect(valueAfterReset).toBe('');
    });
    it('ARIA Combobox  is able to reset using the escape key', async () => {
        await page.type('#aria-fruit', 'app', { delay: 100 });
        // Now let's press ESCAPE to check if the value is reset.
        page.keyboard.press('Escape');
        // await 100ms before continuing further
        await testHelpers.fastPause();
        const valueAfterEscapeButton = await getActiveElementValue();
        expect(valueAfterEscapeButton).toBe('');
    });
    afterAll(async () => {});
});
describe('AutoSubmit Combobox Test', () => {
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
        await page.waitForSelector('#video-games');
        await page.focus('#video-games');
        await page.type('#video-games', 'a', { delay: 100 });
    });
    it('ARIA Combobox  is able to alert the matching count updates', async () => {
        const ariaInfoOfCount = await page.evaluate(() => {
            const alertElem = document.querySelector(
                '#submit-on-select-example [role="alert"]',
            );
            const ariaLive = alertElem.getAttribute('aria-live');
            return {
                alertElemValue: alertElem?.textContent,
                ariaLive,
            };
        });
        expect(ariaInfoOfCount.alertElemValue).toContain('32 items');
        expect(ariaInfoOfCount.ariaLive).toBe('polite');
    });
    it('ARIA Combobox  is able to reset using the reset button', async () => {
        page.keyboard.press('Tab');
        // We pause to ensure any action due to the keypress has started
        await testHelpers.fastPause();
        // Focus will be on the Reset button
        await page.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        const valueAfterReset = await getActiveElementValue();
        expect(valueAfterReset).toBe('');
    });
    it('ARIA Combobox  is able to reset using the escape key', async () => {
        await page.type('#video-games', 'app', { delay: 100 });
        // Now let's press ESCAPE to check if the value is reset.
        page.keyboard.press('Escape');
        // await 100ms before continuing further
        await testHelpers.fastPause();
        const valueAfterEscapeButton = await getActiveElementValue();
        expect(valueAfterEscapeButton).toBe('');
    });

    it('AutoSubmit using the aria combobox is completely keyboard accessible', async () => {
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
describe('ARIA Combobox with categories Test', () => {
    beforeAll(async () => {
        await page.goto(`${config.BASE_URL}/combobox.php`);
        await page.waitForSelector('#aria-example-2');
        await page.focus('#aria-example-2');
        await page.type('#aria-example-2', 'can', { delay: 100 });
    });
    it('ARIA Combobox  is able to alert the matching count updates', async () => {
        const ariaInfoOfCount = await page.evaluate(() => {
            const alertElem = document.querySelector(
                '#example2 [role="alert"]',
            );
            const ariaLive = alertElem.getAttribute('aria-live');
            return {
                alertElemValue: alertElem?.textContent,
                ariaLive,
            };
        });
        expect(ariaInfoOfCount.alertElemValue).toContain('3 items');
        expect(ariaInfoOfCount.ariaLive).toBe('polite');
    });
    it('Selection in different categories using the aria combobox is completely keyboard accessible', async () => {
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
    it('ARIA Combobox is able to reset using the reset button', async () => {
        // Focus will be on the Reset button
        await page.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        const valueAfterReset = await getActiveElementValue();
        expect(valueAfterReset).toBe('');
    });
    it('ARIA Combobox  is able to reset using the escape key', async () => {
        await page.type('#aria-example-2', 'app', { delay: 100 });
        // Now let's press ESCAPE to check if the value is reset.
        page.keyboard.press('Escape');
        // await 100ms before continuing further
        await testHelpers.fastPause();
        const valueAfterEscapeButton = await getActiveElementValue();

        expect(valueAfterEscapeButton).toBe('');
    });

    afterAll(async () => {});
});
