'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import accessibility from '../../enable-node-libs/accessibility-js-routines/dist/accessibility.module.js';

const tabListContainerSelector = '#example1 .enable-tablist';
const tabSelector = `${tabListContainerSelector} .enable-tab`;
const tabPanel = '#example1 .enable-tabpanel';

describe('Tablist Tests', () => {
    beforeEach(async () => {
        await page.setJavaScriptEnabled(true);
    });

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

        const tabPanelDomInfo = await page.evaluate(
            (tabPanel, tabbableSelector) => {
                const activeElement = document.activeElement;

                const tabPanelVisibleEl = document.querySelector(tabPanel);

                const getFocusableElements = (container) => {
                    // Use querySelectorAll to find all matching elements within the container
                    const focusableElements =
                        container.querySelectorAll(tabbableSelector);

                    // Convert the NodeList to an Array (if needed) and return it
                    return Array.from(focusableElements);
                };

                let focusableElements = [];

                if (tabPanelVisibleEl.contains(activeElement)) {
                    focusableElements = getFocusableElements(tabPanelVisibleEl);
                }

                return {
                    focusableElements,
                    isActiveElementInCurrentTabPanel:
                        focusableElements[0] === activeElement,
                };
            },
            tabPanel,
            accessibility.tabbableSelector,
        );

        if (tabPanelDomInfo.focusableElements.length > 0) {
            expect(tabPanelDomInfo.isActiveElementInCurrentTabPanel).toBe(true);
        }
    });
    it('Should jump to target element when JS is off', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.setJavaScriptEnabled(false);

        await page.waitForSelector('#example1');

        const tabPanelDomInfo = await page.evaluate((tabSelector) => {
            const tabEls = Array.from(document.querySelector(tabSelector));

            const tabChildrenHaveLinkedPanels = tabEls.every((tabEl) => {
                const href = tabEl.getAttribute('href').toString();

                const identifier = href.includes('#') ? href.slice(1) : href;

                const panelEl = document.querySelector(`#${identifier}`);

                return panelEl instanceof HTMLElement;
            });

            return {
                tabChildrenHaveLinkedPanels,
            };
        }, tabSelector);

        const tabsEl = await page.$$(tabSelector);

        // focus target tab
        const targetElement = tabsEl[2];

        targetElement.focus();

        await testHelpers.pauseFor();

        // simulate click on target tab
        page.keyboard.press('Enter');

        const domInfo = await page.evaluate((tabEl) => {
            const activeElement = document.activeElement;

            const activeELementId = activeElement.getAttribute('id');

            const tabElHref = tabEl.getAttribute('href');

            const tabElementId = tabElHref.includes('#')
                ? tabElHref.slice(1)
                : tabElHref;

            return {
                activeELementId,
                tabElementId,
            };
        }, targetElement);

        // check if each tab has associated panel
        expect(tabPanelDomInfo.tabChildrenHaveLinkedPanels).toBe(true);

        // check if upon clicking a tab focus shifts to associated panel
        expect(domInfo.activeELementId).toEqual(domInfo.tabElementId);
    });

    it('Should focus selected tab when using keyboard and display instructions', async () => {
        await page.goto(`${config.BASE_URL}/tabs.php`);

        await page.waitForSelector('#example1');

        // tab index to set the focus
        const targetTabIndex = 1;

        const tabsEl = await page.$$(tabSelector);

        tabsEl[targetTabIndex].click();

        await testHelpers.pauseFor();

        // shift focus to the interactive element before the tab component on the page
        await page.keyboard.down('Shift');
        await page.keyboard.press('Tab');
        await page.keyboard.up('Shift');

        // bring focus back to the tab component
        page.keyboard.press('Tab');

        const getSelectedTab = (tabSelector) => {
            const tabEls = Array.from(document.querySelectorAll(tabSelector));

            const selectedTabIndex = tabEls.findIndex(
                (element) => element.getAttribute('aria-selected') === 'true',
            );
            return {
                selectedTabIndex,
            };
        };

        const getKeyboardInstructionElVisibility = () => {
            const element = document.querySelector(
                '#tabs-keyboard-only-instructions',
            );
            if (!element) {
                return false;
            }

            return !element.classList.contains('sr-only');
        };

        const topToBottomFocusDomInfo = await page.evaluate(
            getSelectedTab,
            tabSelector,
        );

        const kbInstructionVisible = await page.evaluate(
            getKeyboardInstructionElVisibility,
        );
        expect(topToBottomFocusDomInfo.selectedTabIndex).toBe(targetTabIndex);

        expect(kbInstructionVisible).toBe(true);

        // shift focus to the interactive element after the tab component on the page
        page.keyboard.press('Tab');

        await testHelpers.pauseFor();

        const kbInstructionNotVisible = !(await page.evaluate(
            getKeyboardInstructionElVisibility,
        ));

        expect(kbInstructionNotVisible).toBe(true);

        // bring focus back to the tab component
        await page.keyboard.down('Shift');
        await page.keyboard.press('Tab');
        await page.keyboard.up('Shift');

        const bottomToTopFocusDomInfo = await page.evaluate(
            getSelectedTab,
            tabSelector,
        );

        expect(bottomToTopFocusDomInfo.selectedTabIndex).toBe(targetTabIndex);
    });
});
