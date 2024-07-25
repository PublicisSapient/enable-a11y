/* eslint-disable no-undef */
'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = testHelpers.getPageList();
let desktopBrowser, desktopPage;

describe('Test Code Walkthroughs on all pages on Enable', () => {
    beforeAll(async () => {
        // Put code here that should execute before starting tests.
        desktopBrowser = await testHelpers.getDesktopBrowser();
        desktopPage = await desktopBrowser.newPage();

        jest.setTimeout(10000);
    });

    afterAll(async () => {
        await desktopBrowser.close();
    });

    async function testPage(filename, page) {
        let domInfo;
        const showcodeSelectSel = '.showcode__select';

        await page.goto(`${config.BASE_URL}/${filename}`);

        // Test on initial load.

        // Step 1: Wait for whole page to load (this is so scripts
        // like `enable-visible-on-focus` can initialize)
        await page.waitForSelector('footer');

        domInfo = await page.evaluate((showcodeSelectSel) => {
            const selectEls = document.querySelectorAll(showcodeSelectSel);
            const jsonBlocks = document.querySelectorAll(
                'script[type="application/json"]'
            );
            let jsonErrorID = '';
            let allJsonBlocksHaveIDs = true;

            // let's parse these JSON blocks to see if they are valid.
            for (let i = 0; i < jsonBlocks.length; i++) {
                const jsonBlock = jsonBlocks[i];
                const json = jsonBlock.innerHTML;

                if (jsonBlock.id === '') {
                    allJsonBlocksHaveIDs = false;
                }

                try {
                    JSON.parse(json);
                } catch (ex) {
                    jsonErrorID = jsonBlock.id;
                }
            }

            return {
                numOfSelects: selectEls.length,
                allJsonBlocksHaveIDs,
                jsonErrorID,
            };
        }, showcodeSelectSel);

        expect(domInfo.allJsonBlocksHaveIDs).toBe(true);

        if (domInfo.jsonErrorID !== '') {
            console.error(
                `You must fix the JSON inside the script with id="${domInfo.jsonErrorID}".`
            );
        }

        expect(domInfo.jsonErrorID).toBe('');

        const { numOfSelects } = domInfo;

        if (numOfSelects > 0) {
            for (let i = 0; i < numOfSelects; i++) {
                domInfo = await page.evaluate(
                    (showcodeSelectSel, i) => {
                        const selectEls =
                            document.querySelectorAll(showcodeSelectSel);
                        const selectEl = selectEls[i];
                        const containerEl = selectEl.closest(
                            '.showcode__container'
                        );
                        const optionEls =
                            selectEl.getElementsByTagName('option');

                        const codeEl = containerEl.querySelector(
                            '.showcode__example--code'
                        );
                        const hasCodeEl = codeEl !== null;
                        function findNearestHeading(el) {
                            let currentNode = el;

                            currentNode = currentNode.closest(
                                '.showcode__container'
                            );
                            do {
                                currentNode =
                                    currentNode.previousElementSibling;
                                if (
                                    currentNode &&
                                    currentNode.matches(
                                        'h1, h2, h3, h4, h5, h6'
                                    )
                                ) {
                                    break;
                                }
                            } while (currentNode);

                            return currentNode;
                        }

                        selectEl.focus();
                        const nearestHeading = findNearestHeading(selectEl);

                        return {
                            hasCodeEl,
                            numOptions: optionEls.length,
                            originalCodeHTML: codeEl.innerHTML.trim(),
                            nearestHeading:
                                (nearestHeading && nearestHeading.innerText) ||
                                'none',
                        };
                    },
                    showcodeSelectSel,
                    i
                );

                const { hasCodeEl, originalCodeHTML, numOptions } = domInfo;

                if (originalCodeHTML === '') {
                    console.error(
                        `There code tag is blank.  Select index: ${i}\nUnder heading "${domInfo.nearestHeading}"`
                    );
                }

                expect(hasCodeEl).toBe(true);
                expect(originalCodeHTML).not.toBe('');

                if (numOptions <= 1) {
                    for (let j = 0; j < numOptions - 1; j++) {
                        domInfo = await page.evaluate(
                            (showcodeSelectSel, i, j, numOptions) => {
                                const selectEls =
                                    document.querySelectorAll(
                                        showcodeSelectSel
                                    );
                                const selectEl = selectEls[i];
                                const optionEls =
                                    selectEl.getElementsByTagName('option');
                                const origSelectValue = selectEl.value;
                                const origSelectedIndex =
                                    selectEl.selectedIndex;

                                if (j + 1 < numOptions) {
                                    const newSelectValue =
                                        optionEls[j + 1].getAttribute('value');
                                    selectEl.value = newSelectValue;
                                    const evt =
                                        document.createEvent('HTMLEvents');
                                    evt.initEvent('change', false, true);
                                    selectEl.dispatchEvent(evt);
                                }

                                return {
                                    origSelectValue,
                                    newSelectValue: selectEl.value,
                                    origSelectedIndex,
                                    selectedIndex: selectEl.selectedIndex,
                                };
                            },
                            showcodeSelectSel,
                            i,
                            j,
                            numOptions
                        );

                        const { origSelectValue, newSelectValue } = domInfo;

                        // make sure value is set to something.
                        expect(newSelectValue).not.toBe(origSelectValue);
                        expect(newSelectValue).not.toBe(null);

                        await testHelpers.pause();
                        domInfo = await page.evaluate(
                            (showcodeSelectSel, i) => {
                                const selectEls =
                                    document.querySelectorAll(
                                        showcodeSelectSel
                                    );
                                const selectEl = selectEls[i];
                                const containerEl = selectEl.closest(
                                    '.showcode__container'
                                );
                                const codeEl = containerEl.querySelector(
                                    '.showcode__example--code'
                                );
                                const value = selectEl.value;

                                function findNearestHeading(el) {
                                    let currentNode = el;

                                    currentNode = currentNode.closest(
                                        '.showcode__container'
                                    );
                                    do {
                                        currentNode =
                                            currentNode.previousElementSibling;
                                        if (
                                            currentNode &&
                                            currentNode.matches(
                                                'h1, h2, h3, h4, h5, h6'
                                            )
                                        ) {
                                            break;
                                        }
                                    } while (currentNode);

                                    return currentNode;
                                }

                                const nearestHeading =
                                    findNearestHeading(selectEl);

                                return {
                                    selectValue: value,
                                    newCodeHTML: codeEl.innerHTML.trim(),
                                    selectedIndex: selectEl.selectedIndex,
                                    nearestHeading:
                                        (nearestHeading &&
                                            nearestHeading.innerText) ||
                                        'none',
                                };
                            },
                            showcodeSelectSel,
                            i,
                            j
                        );

                        if (
                            domInfo.newCodeHTML === originalCodeHTML ||
                            domInfo.newCodeHTML === ''
                        ) {
                            console.error(
                                `Code walkthrough did not update on ${filename}.  Select index: ${i}, option index: ${j}\nSelected value: ${domInfo.selectValue}.\nUnder heading "${domInfo.nearestHeading}"`
                            );
                        }
                        expect(domInfo.selectValue).toBe(newSelectValue);
                        expect(domInfo.newCodeHTML).not.toBe('');
                        expect(domInfo.newCodeHTML).not.toBe(originalCodeHTML);
                    }
                }
            }
        }
    }

    for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];

        it(`Desktop Breakpoint: Test showcode JSON blocks on ${file}`, async () => {
            await testPage(fileList[i], desktopPage);
        });
    }
});
