'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

describe('Tabs Tests', () => {
    it('Should focus tab with default active attribute', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.waitForSelector('#example1');

        let domInfo = await page.evaluate(() => {
            const focusTab =
                document.querySelector(
                    '#example1 .enable-tablist .enable-tab[data-tab-selected-on-load=true]',
                ) ||
                Array.from(
                    document.querySelector(
                        '#example1 .enable-tablist .enable-tab',
                    ),
                )[0];

            focusTab.focus();

            return {
                focusDefaultTab: document.activeElement === focusTab,
            };
        });

        expect(domInfo.focusDefaultTab).toBe(true);
    });

    it('Should cycle through focusable tabs', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.waitForSelector('#example1');

        const tabsEl = await page.$$('#example1 .enable-tablist .enable-tab');

        // focus the first tab item in the tab group
        tabsEl[0].click();

        await testHelpers.pauseFor();

        // remove the already focused tab item(first one)
        for (let tabItemIndex in Array.from(tabsEl).splice(1)) {
            page.keyboard.press('ArrowRight');

            await testHelpers.fastPause();

            const domInfo = await page.evaluate((index) => {
                const activeElement = document.activeElement;

                const currentTabItem = Array.from(
                    document.querySelectorAll(
                        '#example1 .enable-tablist .enable-tab',
                    ),
                ).splice(1)[index];

                return {
                    isTabItemActive: activeElement === currentTabItem,
                };
            }, tabItemIndex);

            expect(domInfo.isTabItemActive).toBe(true);
        }

        // tabbing on the last tab item should take the focus back to the first one
        page.keyboard.press('ArrowRight');

        const domInfo = await page.evaluate(() => {
            const activeElement = document.activeElement;

            const tabsEl = Array.from(
                document.querySelectorAll(
                    '#example1 .enable-tablist .enable-tab',
                ),
            );

            const firstTabItem = tabsEl[0];

            return {
                isTabItemActive: activeElement === firstTabItem,
            };
        });

        expect(domInfo.isTabItemActive).toBe(true);
    });

    it('Should shift focus to active tab panel', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.waitForSelector('#example1');

        const tabsEl = await page.$$('#example1 .enable-tablist .enable-tab');

        // focus the first tab item in the tab group
        tabsEl[0].click();

        await page.waitForSelector('.enable-tabpanel.visible');

        await testHelpers.pauseFor();

        // tab to next focusable element in the DOM
        page.keyboard.press('Tab');

        const tabPanelDomInfo = await page.evaluate(() => {
            const activeElement = document.activeElement;

            const tabPanelVisibleEl = document.querySelector(
                '#example1 .enable-tabpanel.visible',
            );

            const getFocusableElements = (container) => {
                // Define a list of selectors for focusable elements
                const focusableSelectors = [
                    'a[href]',
                    'button',
                    'textarea',
                    'input',
                    'select',
                    '[tabindex]:not([tabindex="-1"])',
                    '[contenteditable]',
                ];

                // Combine the selectors into a single selector string
                const combinedSelector = focusableSelectors.join(',');

                // Use querySelectorAll to find all matching elements within the container
                const focusableElements =
                    container.querySelectorAll(combinedSelector);

                // Convert the NodeList to an Array (if needed) and return it
                return Array.prototype.slice.call(focusableElements);
            };

            let focusableElements = [];

            if (tabPanelVisibleEl) {
                focusableElements = getFocusableElements(tabPanelVisibleEl);
            }

            return {
                focusableElements,
                isActiveElementInCurrentTabPanel:
                    focusableElements[0] === activeElement,
            };
        });

        if (tabPanelDomInfo.focusableElements.length > 0) {
            expect(tabPanelDomInfo.isActiveElementInCurrentTabPanel).toBe(true);
        }
    });
});
