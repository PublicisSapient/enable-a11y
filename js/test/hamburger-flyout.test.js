'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import puppeteer from 'puppeteer';

let mobileBrowser, desktopBrowser;

describe('Hamburger Menu Tests', () => {
    beforeAll(async () => {
        mobileBrowser = await testHelpers.getMobileBrowser();
        desktopBrowser = await testHelpers.getDesktopBrowser();
    });

    afterAll(async () => {
        await testHelpers.pause();

        mobileBrowser.close();
        desktopBrowser.close();
    });

    it('Desktop - ensure menu closes when focus goes outside submenus', async () => {
        let domInfo;

        const page = await desktopBrowser.newPage();

        await page.goto(`${config.BASE_URL}/multi-level-hamburger-menu.php`);

        // Test on initial load.
        // Step 1: Wait for element to load on page.
        await page.waitForSelector('.enable-flyout--initialized');

        // This is one component where DOM structure is necessary: we need to find
        // all the dropdowns on the top level only.
        const ariaControlsSelector = '[aria-controls]';

        // find how many aria-controls elements there are
        const ariaControlsEls = Array.from(page.$$(ariaControlsSelector));

        for (let i = 0; i < ariaControlsEls.length; i++) {
            domInfo = await page.evaluate((i) => {
                // Check to make sure the item has focus
                const ariaControlsEls =
                    document.querySelectorAll(ariaControlsSelector)[i];
                ariaControlsEls[i].focus();

                const { activeElement } = document;
                const ariaExpanded =
                    activeElement.getAttribute('aria-expanded');

                return {
                    html: activeElement.outerHTML,
                    innerText: activeElement.innerText.trim(),
                    isExpanded: ariaExpanded === 'true',
                    wasFocusAppliedCorrectly:
                        ariaControlsEls[i] === activeElement,
                };
            }, i);

            expect(domInfo.wasFocusAppliedCorrectly).toBe(true);
            expect(domInfo.isExpanded).toBe(false);

            await page.keyboard.press('Space');
            await testHelpers.fastPause();

            domInfo = await page.evaluate(() => {
                const { activeElement } = document;
                const ariaControls =
                    activeElement.getAttribute('aria-controls');
                const controlledEl = document.getElementById(ariaControls);

                return {
                    isMenuExpanded:
                        activeElement.getAttribute('aria-expanded') === 'true',
                    hasControlledEl: controlledEl !== null,
                    ariaControls,
                };
            });

            expect(domInfo.ariaControls).not.toBe(null);
            expect(domInfo.ariaControls).not.toBe('');
            expect(domInfo.hasControlledEl).toBe(true);
            expect(domInfo.isMenuExpanded).toBe(true);

            const { ariaControls } = domInfo;

            // now, let's tab all the way through the document until we tab out of the
            // open menu
            do {
                expect(domInfo.isMenuExpanded).toBe(true);

                page.keyboard.press('Tab');

                domInfo = await page.evaluate((ariaControls) => {
                    const { activeElement } = document;
                    const controlledEl = document.getElementById(ariaControls);
                    const menuButton = document.querySelector(
                        `[aria-controls="${ariaControls}"]`,
                    );

                    return {
                        html: controlledEl.outerHTML,
                        activeElementText: activeElement.innerText,
                        isFocusedInsideMenu:
                            controlledEl.contains(activeElement),
                        isMenuExpanded:
                            menuButton.getAttribute('aria-expanded') === 'true',
                    };
                }, ariaControls);
            } while (domInfo.isFocusedInsideMenu);

            // We are now focused outside of the Controls flyout menu.  The menu
            // should be closed now, so let's check.
            expect(domInfo.isMenuExpanded).toBe(false);
        }

        await page.focus('[aria-controls="controls-section"]');
    });

    async function loadPage(isDesktop) {
        try {
            let domInfo;

            browser = isDesktop ? desktopBrowser : mobileBrowser;
            const page = await browser.newPage();
            await page.goto(
                `${config.BASE_URL}/multi-level-hamburger-menu.php`,
            );

            // Test on initial load.

            // Step 1: Wait for element to load on page.
            await page.waitForSelector('.enable-flyout--initialized');

            // Step 2: Focus on appropriate element
            await page.focus('.enable-flyout__open-menu-button');
            // Step 3: Check the DOM

            domInfo = await page.evaluate(() => {
                const mobileMenuButton = document.querySelector(
                    '.enable-flyout__open-menu-button',
                );
                const { activeElement } = document;

                const buttonStyle = window.getComputedStyle(
                    mobileMenuButton,
                    null,
                );

                return {
                    isMobileMenuButtonHidden: buttonStyle.display === 'none',
                    width: window.innerWidth,
                };
            });

            //await browser.close();
            return domInfo;
        } catch (ex) {
            console.log('ex!', isDesktop);
            return ex;
        }
    }

    // Put code here that should execute before starting tests.
    it('Desktop - ensure hamburger menu icon is not visible', async () => {
        let domInfo;

        domInfo = await loadPage(true);
        // Step 4: Do Tests
        expect(domInfo.isMobileMenuButtonHidden).toBe(true);
        expect(domInfo.width).toBe(config.DESKTOP_WIDTH);
    });

    it('Mobile - ensure hamburger menu icon is visible', async () => {
        let domInfo;

        domInfo = await loadPage(false);

        // Step 4: Do Tests
        expect(domInfo.isMobileMenuButtonHidden).toBe(false);
        expect(domInfo.width).toBe(config.MOBILE_WIDTH);
    });
});
