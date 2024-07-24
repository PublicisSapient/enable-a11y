'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import puppeteer from 'puppeteer';

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

describe('Autocomplete Functionality Tests', () => {
    let browser;
    let page;

    beforeAll(async () => {
        browser = await puppeteer.launch();
        page = await browser.newPage();
        await page.goto(`${config.BASE_URL}/autocomplete.php`);
    });

    afterAll(async () => {
        await browser.close();
    });

    it('should have autocomplete attributes set correctly', async () => {
        //first name
        const firstNameAutocomplete = await page.evaluate(() => {
            return document
                .querySelector('#first-name')
                .getAttribute('autocomplete');
        });

        //last name
        const lastNameAutocomplete = await page.evaluate(() => {
            return document
                .querySelector('#last-name')
                .getAttribute('autocomplete');
        });

        //email
        const emailAutocomplete = await page.evaluate(() => {
            return document
                .querySelector('#email')
                .getAttribute('autocomplete');
        });

        //street address
        const addressAutocomplete = await page.evaluate(() => {
            return document
                .querySelector('#address')
                .getAttribute('autocomplete');
        });

        //city
        const cityAutocomplete = await page.evaluate(() => {
            return document.querySelector('#city').getAttribute('autocomplete');
        });

        //state
        const stateAutocomplete = await page.evaluate(() => {
            return document
                .querySelector('#state')
                .getAttribute('autocomplete');
        });

        //zip
        const zipAutocomplete = await page.evaluate(() => {
            return document.querySelector('#zip').getAttribute('autocomplete');
        });

        //country
        const countryAutocomplete = await page.evaluate(() => {
            return document
                .querySelector('#country')
                .getAttribute('autocomplete');
        });

        //phone number
        const phoneAutocomplete = await page.evaluate(() => {
            return document
                .querySelector('#phone')
                .getAttribute('autocomplete');
        });

        expect(firstNameAutocomplete).toBe('given-name');
        expect(lastNameAutocomplete).toBe('family-name');
        expect(emailAutocomplete).toBe('email');
        expect(addressAutocomplete).toBe('address-line1');
        expect(cityAutocomplete).toBe('address-level2');
        expect(stateAutocomplete).toBe('address-level1');
        expect(zipAutocomplete).toBe('postal-code');
        expect(countryAutocomplete).toBe('country-name');
        expect(phoneAutocomplete).toBe('tel');
    });

    it('should mock autocomplete data for given-name and family-name', async () => {
        //await page.goto('https://your-autocomplete-test-page.com');

        // Mocking the autosuggested data
        await page.evaluate(() => {
            const givenNameInput = document.querySelector(
                'input[autocomplete="given-name"]',
            );
            const familyNameInput = document.querySelector(
                'input[autocomplete="family-name"]',
            );
            const emailInput = document.querySelector(
                'input[autocomplete="email"]',
            );
            const addressInput = document.querySelector(
                'input[autocomplete="address-line1"]',
            );
            const cityInput = document.querySelector(
                'input[autocomplete="address-level2"]',
            );
            const stateInput = document.querySelector(
                'input[autocomplete="address-level1"]',
            );
            const zipInput = document.querySelector(
                'input[autocomplete="postal-code"]',
            );
            const countryInput = document.querySelector(
                'input[autocomplete="country-name"]',
            );
            const phoneInput = document.querySelector(
                'input[autocomplete="tel"]',
            );

            if (givenNameInput) {
                givenNameInput.value = 'John';
                givenNameInput.dispatchEvent(
                    new Event('input', { bubbles: true }),
                );
            }

            if (familyNameInput) {
                familyNameInput.value = 'Doe';
                familyNameInput.dispatchEvent(
                    new Event('input', { bubbles: true }),
                );
            }

            if (emailInput) {
                emailInput.value = 'johndoe@email.com';
                emailInput.dispatchEvent(new Event('input', { bubbles: true }));
            }

            if (addressInput) {
                addressInput.value = '123 Main St';
                addressInput.dispatchEvent(
                    new Event('input', { bubbles: true }),
                );
            }

            if (cityInput) {
                cityInput.value = 'Anytown';
                cityInput.dispatchEvent(new Event('input', { bubbles: true }));
            }

            if (stateInput) {
                stateInput.value = 'CA';
                stateInput.dispatchEvent(new Event('input', { bubbles: true }));
            }

            if (zipInput) {
                zipInput.value = '12345';
                zipInput.dispatchEvent(new Event('input', { bubbles: true }));
            }

            if (countryInput) {
                countryInput.value = 'USA';
                countryInput.dispatchEvent(
                    new Event('input', { bubbles: true }),
                );
            }

            if (phoneInput) {
                phoneInput.value = '123-456-7890';
                phoneInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        });

        // Example: Assert the values of the input fields
        const givenNameValue = await page.$eval(
            'input[autocomplete="given-name"]',
            (input) => input.value,
        );
        const familyNameValue = await page.$eval(
            'input[autocomplete="family-name"]',
            (input) => input.value,
        );
        const emailValue = await page.$eval(
            'input[autocomplete="email"]',
            (input) => input.value,
        );
        const addressValue = await page.$eval(
            'input[autocomplete="address-line1"]',
            (input) => input.value,
        );
        const cityValue = await page.$eval(
            'input[autocomplete="address-level2"]',
            (input) => input.value,
        );
        const stateValue = await page.$eval(
            'input[autocomplete="address-level1"]',
            (input) => input.value,
        );
        const zipValue = await page.$eval(
            'input[autocomplete="postal-code"]',
            (input) => input.value,
        );
        const countryValue = await page.$eval(
            'input[autocomplete="country-name"]',
            (input) => input.value,
        );
        const phoneValue = await page.$eval(
            'input[autocomplete="tel"]',
            (input) => input.value,
        );

        expect(givenNameValue).toBe('John');
        expect(familyNameValue).toBe('Doe');
        expect(emailValue).toBe('johndoe@email.com');
        expect(addressValue).toBe('123 Main St');
        expect(cityValue).toBe('Anytown');
        expect(stateValue).toBe('CA');
        expect(zipValue).toBe('12345');
        expect(countryValue).toBe('USA');
        expect(phoneValue).toBe('123-456-7890');
    });
});
