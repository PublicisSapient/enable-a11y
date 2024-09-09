'use strict';
import config from './test-config.js';
import testHelpers from './test-helpers.js';

//Utility function to get current value
const getActiveElementValue = async () => {
    return page.evaluate(() => document?.activeElement?.value);
};
//Utility function is added to test autosuggestion functionality of all comboboxes
const testAutosuggestions = async (
    listSelector,
    typeText,
    expectedSubstring,
    expectedCount,
) => {
    await page.waitForSelector(`${listSelector}`);
    // Getting all the visible option elements
    const suggestions = await page.evaluate((selector) => {
        const parent = document.querySelector(selector);
        const items = Array.from(parent.querySelectorAll('[role="option"]'));
        return items
            .filter((item) => !item.hasAttribute('hidden'))
            .map((item) => item.textContent?.toLowerCase()?.trim());
    }, `${listSelector}`);

    const allContainSubstring = suggestions.every((suggestion) =>
        suggestion.includes(expectedSubstring),
    );
    // Assertions to test the autosuggestion options
    expect(allContainSubstring).toBeTruthy();
    expect(suggestions.length).toBe(expectedCount);
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
        // Test all aria attributes of the combobox
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
        await page.type('#aria-fruit', 'ap', { delay: 100 });
        await testHelpers.pauseFor(100);
    });
    it('ARIA Combobox  is able to suggest the correct autosuggestion', async () => {
        await testAutosuggestions('#aria-fruit__list', 'ap', 'ap', 3);
    });

    it('ARIA Combobox  is able to update the autosuggestion on typing', async () => {
        // Updating the typing string from "ap -> app"
        await page.type('#aria-fruit', 'p', { delay: 100 });
        await testHelpers.pauseFor(100);

        await testAutosuggestions('#aria-fruit__list', 'app', 'app', 2);
    });
    it('ARIA Combobox  is able to alert the matching count updates using aria-live', async () => {
        // Getting the alert element
        const ariaInfoOfCount = await page.evaluate(() => {
            const alertElem = document.querySelector(
                '#example1 [role="alert"]',
            );
            const ariaLive = alertElem.getAttribute('aria-live');
            return {
                alertElemValue: alertElem?.textContent,
                ariaLive,
            };
        });
        // Testing the aria-live attribute
        expect(ariaInfoOfCount.alertElemValue).toContain('2 items');
        expect(ariaInfoOfCount.ariaLive).toBe('assertive');
    });

    it('ARIA Combobox select value using keyboard', async () => {
        // Using keyboard to go through the List
        testHelpers.keyDownAndUp(page, 'ArrowDown');
        // Enter
        await page.keyboard.press('Enter');
        // Pause for 100 ms
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
        await page.type('#video-games', 'ap', { delay: 100 });
    });
    it('ARIA Combobox  is able to suggest the correct autosuggestion', async () => {
        await testAutosuggestions('#video-games__list', 'ap', 'ap', 3);
    });

    it('ARIA Combobox  is able to update the autosuggestion on typing', async () => {
        // Updating the typing string from "ap -> app"
        await page.type('#video-games', 'p', { delay: 100 });
        await testHelpers.pauseFor(100);

        await testAutosuggestions('#video-games__list', 'app', 'app', 2);
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
        expect(ariaInfoOfCount.alertElemValue).toContain('2 items');
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
    });
    it('ARIA Combobox  is able to suggest the correct autosuggestion', async () => {
        await page.type('#aria-example-2', 'ch', { delay: 100 });
        await testAutosuggestions('#aria-example-2__list', 'ch', 'ch', 6);
    });
    it('ARIA Combobox  is able to update the autosuggestion on typing', async () => {
        // Updating the typing string from "ch -> chi"
        await page.type('#aria-example-2', 'i', { delay: 100 });
        await testHelpers.pauseFor(100);

        await testAutosuggestions('#aria-example-2__list', 'chi', 'chi', 3);
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
    it('ARIA Combobox  is able to reset using the escape key', async () => {
        // Now let's press ESCAPE to check if the value is reset.
        page.keyboard.press('Escape');
        // await 100ms before continuing further
        await testHelpers.fastPause();
        const valueAfterEscapeButton = await getActiveElementValue();

        expect(valueAfterEscapeButton).toBe('');
    });
    it('Selection in different categories using the aria combobox is completely keyboard accessible', async () => {
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
    it('ARIA Combobox is able to reset using the reset button', async () => {
        // Focus will be on the Reset button
        await page.keyboard.press('Enter');
        await testHelpers.pauseFor(100);
        const valueAfterReset = await getActiveElementValue();
        expect(valueAfterReset).toBe('');
    });

    afterAll(async () => {});
});
