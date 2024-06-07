'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const tabListContainerSelector = '#example1 .enable-tablist';
const tabSelector = `${tabListContainerSelector} .enable-tab`;
const tabPanel = '#example1 .enable-tabpanel';

describe('Tablist Tests', () => {
    it('Should focus tab with default active attribute', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.waitForSelector('#example1');

        let domInfo = await page.evaluate((tabSelector) => {
            const focusTab =
                document.querySelector(
                    `${tabSelector}[data-tab-selected-on-load=true]`,
                ) || Array.from(document.querySelectorAll(`${tabSelector}`))[0];

            focusTab.focus();

            return {
                focusDefaultTab: document.activeElement === focusTab,
            };
        }, tabSelector);

        expect(domInfo.focusDefaultTab).toBe(true);
    });

    it('Should have appropriate ARIA attributes', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.waitForSelector('#example1');

        const domInfo = await page.evaluate(
            (tabListContainerSelector, tabSelector) => {
                const tabContainerEl = document.querySelector(
                    tabListContainerSelector,
                );

                const tabEls = Array.from(document.querySelector(tabSelector));

                return {
                    tabContainerHasRole:
                        tabContainerEl.getAttribute('role') === 'tablist',
                    tabChildrenHaveRole: tabEls.every(
                        (tabEl) =>
                            tabEl.getAttribute('role') === 'tab' &&
                            tabEl.hasAttribute('data-owns') &&
                            tabEl.hasAttribute('aria-controls') &&
                            tabEl.hasAttribute('aria-describedby'),
                    ),
                    tabChildrenHaveLinkedPanels: tabEls.every((tabEl) => {
                        const controlsEl = tabEl.getAttribute('aria-controls');

                        const panelEl = document.querySelector(
                            `#${controlsEl}`,
                        );

                        return panelEl instanceof HTMLElement;
                    }),
                };
            },
            tabListContainerSelector,
            tabSelector,
        );
        expect(domInfo.tabContainerHasRole).toBe(true);

        expect(domInfo.tabChildrenHaveRole).toBe(true);

        expect(domInfo.tabChildrenHaveLinkedPanels).toBe(true);
    });

    it('Should cycle through focusable tabs', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.waitForSelector('#example1');

        const tabsEl = await page.$$(tabSelector);

        // focus the first tab item in the tab group
        tabsEl[0].click();

        await testHelpers.pauseFor();

        // remove the already focused tab item(first one)
        for (let tabItemIndex in Array.from(tabsEl).splice(1)) {
            page.keyboard.press('ArrowRight');

            await testHelpers.fastPause();

            const domInfo = await page.evaluate(
                (index, tabSelector) => {
                    const activeElement = document.activeElement;

                    const unFocusedTabEls = Array.from(
                        document.querySelectorAll(
                            `${tabSelector}[aria-selected=false]`,
                        ),
                    );

                    const currentTabItem = Array.from(
                        document.querySelectorAll(tabSelector),
                    ).splice(1)[index];

                    const isTabItemActive = activeElement === currentTabItem;

                    const focusedTabHasAriaAttrbutes =
                        currentTabItem.getAttribute('tabindex') === '0' &&
                        currentTabItem.getAttribute('aria-selected') === 'true';

                    const unFocusedTabsHaveRightAria = unFocusedTabEls.every(
                        (tabEl) =>
                            tabEl.getAttribute('tabindex') === '-1' &&
                            tabEl.getAttribute('aria-selected') === 'false',
                    );

                    return {
                        isTabItemActive,
                        focusedTabHasAriaAttrbutes,
                        unFocusedTabsHaveRightAria,
                    };
                },
                tabItemIndex,
                tabSelector,
            );

            expect(domInfo.isTabItemActive).toBe(true);
            expect(domInfo.focusedTabHasAriaAttrbutes).toBe(true);
            expect(domInfo.unFocusedTabsHaveRightAria).toBe(true);
        }

        // tabbing on the last tab item should take the focus back to the first one
        page.keyboard.press('ArrowRight');

        const domInfo = await page.evaluate((tabSelector) => {
            const activeElement = document.activeElement;

            const tabsEl = Array.from(document.querySelectorAll(tabSelector));

            const firstTabItem = tabsEl[0];

            return {
                isTabItemActive: activeElement === firstTabItem,
            };
        }, tabSelector);

        expect(domInfo.isTabItemActive).toBe(true);
    });

    it('Should shift focus to active tab panel', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.waitForSelector('#example1');

        const tabsEl = await page.$$(tabSelector);

        // focus the first tab item in the tab group
        tabsEl[0].click();

        await page.waitForSelector(tabPanel);

        await testHelpers.pauseFor();

        // tab to next focusable element in the DOM
        page.keyboard.press('Tab');

        const tabPanelDomInfo = await page.evaluate((tabPanel) => {
            const activeElement = document.activeElement;

            const tabPanelVisibleEl = document.querySelector(tabPanel);

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
        }, tabPanel);

        if (tabPanelDomInfo.focusableElements.length > 0) {
            expect(tabPanelDomInfo.isActiveElementInCurrentTabPanel).toBe(true);
        }
    });
});
