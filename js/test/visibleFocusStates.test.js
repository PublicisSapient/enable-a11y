'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = testHelpers.getPageList();
let mobileBrowser, desktopBrowser;

describe('Test Focus States on all pages on Enable', () => {
    beforeAll(async () => {
        // Put code here that should execute before starting tests.
        desktopBrowser = await testHelpers.getDesktopBrowser();
        mobileBrowser = await testHelpers.getMobileBrowser();
    });

    afterAll(async () => {
        await mobileBrowser.close();
        await desktopBrowser.close();
    });

    /**
     * Converts a CSS rgb() colour to a six-digit hexadecimal colour.
     *
     * Supports:
     *   rgb(255, 0, 128)
     *   rgb(255 0 128)
     *   rgb(100%, 0%, 50%)
     *
     * @param {string} rgbColour
     * @returns {string} A colour such as "#ff0080"
     * @throws {TypeError} When the value is not valid rgb() notation.
     */
    function toHex(rgbColour) {
        if (!rgbColour.trim) {
            return 'undefined';
        }
        const match = rgbColour.trim().match(
            /^rgb\(\s*([+-]?(?:\d+\.?\d*|\.\d+)%?)\s*(?:,\s*|\s+)([+-]?(?:\d+\.?\d*|\.\d+)%?)\s*(?:,\s*|\s+)([+-]?(?:\d+\.?\d*|\.\d+)%?)\s*\)$/i
        );

        if (!match) {
            throw new TypeError(`Invalid rgb() colour: ${rgbColour}`);
        }

        const channelToHex = channel => {
            const value = channel.endsWith('%')
                ? Number.parseFloat(channel) * 2.55
                : Number.parseFloat(channel);

            if (!Number.isFinite(value) || value < 0 || value > 255) {
                throw new TypeError(`Invalid RGB channel: ${channel}`);
            }

            return Math.round(value)
                .toString(16)
                .padStart(2, '0');
        };

        const [, red, green, blue] = match;

        return `#${channelToHex(red)}${channelToHex(green)}${channelToHex(blue)}`;
    }

    async function testFocusStates(filename, isDesktop, isDarkMode) {
        let domInfo, page;

        if (isDesktop) {
            page = await desktopBrowser.newPage();
        } else {
            page = await mobileBrowser.newPage();
        }

        // Wait until the DOM is fully loaded.
        await page.goto(`${config.BASE_URL}/${filename}`, {
            waitUntil: 'domcontentloaded',
        });

        // Let's set the page to the right dark mode setting
        domInfo = await page.evaluate((isDarkMode) => {
            const darkModeClass = 'enable__is-dark-mode';
            const htmlEl = document.querySelector('html');

            if (isDarkMode) {
                htmlEl.classList.add(darkModeClass);
            } else {
                htmlEl.classList.remove(darkModeClass);
            }

            return {
                htmlClass: htmlEl.className
            }
        }, isDarkMode);

        let numTabStops = 0;
        // Let's loop through all the tabstops on the page.
        do {
            // Let's simulate a tab press
            await page.keyboard.press('Tab');
            numTabStops++;
            // Now let's see if there is a focus ring around the
            // focused element.
            domInfo = await page.evaluate(() => {
                const { activeElement } = document;

                // grab outline CSS style property
                const style = window.getComputedStyle(activeElement, null);
                let { outline, outlineColor, outlineWidth, outlineStyle, boxShadow, outlineOffset } =
                    style;
                let hasFocusRing =
                    outlineStyle !== 'none' &&
                    parseInt(outlineWidth) !== 0 &&
                    outlineColor !== 'transparent';
                let checkedPseudoEl = false;
                let boxShadowColors = cc_extractColoursFromCSSValue(boxShadow)
                let boxShadowColor = (boxShadowColors.length > 0) ? boxShadowColors[0] : '';

                const isIframe = activeElement.nodeName === 'IFRAME';
                const isVideo = activeElement.nodeName === 'VIDEO';

                // Special tests for range element
                const isRangeInput =
                    activeElement.nodeName === 'INPUT' &&
                    activeElement.getAttribute('type') === 'range';

                if (isRangeInput && !hasFocusRing) {
                    let rangeThumbSlideStyle = window.getComputedStyle(
                        activeElement,
                        '::-webkit-slider-thumb',
                    );
                    checkedPseudoEl = true;
                    outline = rangeThumbSlideStyle.outline;
                    outlineColor = rangeThumbSlideStyle.outlineColor;
                    outlineWidth = rangeThumbSlideStyle.outlineWidth;
                    outlineStyle = rangeThumbSlideStyle.outlineStyle;
                    hasFocusRing =
                        outlineStyle !== 'none' && parseInt(outlineWidth) !== 0;
                }
                // end of special tests.

                // COLOUR CONTRAST: Helper to detect transparent colors
                // COLOUR CONTRAST:
                function cc_isTransparent(colorStr) {
                    if (!colorStr) return true;
                    const s = colorStr.trim().toLowerCase();
                    if (s === 'transparent') return true;
                    const m = s.match(/rgba\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*,\s*([0-9]*\.?[0-9]+)\s*\)/);
                    return m ? parseFloat(m[1]) === 0 : false;
                }

                // COLOUR CONTRAST: Parse CSS color strings (#rgb, #rrggbb, rgb[a]) to {r,g,b}
                // COLOUR CONTRAST:
                function cc_parseColorToRGB(str) {
                    if (!str) return null;
                    const s = str.trim().toLowerCase();
                    if (s.startsWith('rgb')) {
                        const m = s.match(/rgba?\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)/);
                        if (m) return { r: +m[1], g: +m[2], b: +m[3] };
                        return null;
                    }
                    if (s[0] === '#') {
                        if (s.length === 4) {
                            const r = parseInt(s[1] + s[1], 16);
                            const g = parseInt(s[2] + s[2], 16);
                            const b = parseInt(s[3] + s[3], 16);
                            return { r, g, b };
                        }
                        if (s.length === 7) {
                            const r = parseInt(s.slice(1, 3), 16);
                            const g = parseInt(s.slice(3, 5), 16);
                            const b = parseInt(s.slice(5, 7), 16);
                            return { r, g, b };
                        }
                    }
                    return null;
                }

                function cc_extractColoursFromCSSValue(value) {

                    if (!value || value === 'none') {
                        return [];
                    }

                    return value.match(/rgba?\([^)]+\)/g) ?? [];
                }

                // COLOUR CONTRAST: Compute relative luminance per WCAG
                // COLOUR CONTRAST:
                function cc_srgbToLinear(c) {
                    const cs = c / 255;
                    return cs <= 0.03928 ? cs / 12.92 : Math.pow((cs + 0.055) / 1.055, 2.4);
                }
                // COLOUR CONTRAST:
                function cc_relativeLuminance(rgb) {
                    const R = cc_srgbToLinear(rgb.r);
                    const G = cc_srgbToLinear(rgb.g);
                    const B = cc_srgbToLinear(rgb.b);
                    return 0.2126 * R + 0.7152 * G + 0.0722 * B;
                }
                // COLOUR CONTRAST:
                function cc_contrastRatio(rgb1, rgb2) {
                    const L1 = cc_relativeLuminance(rgb1);
                    const L2 = cc_relativeLuminance(rgb2);
                    const lighter = Math.max(L1, L2);
                    const darker = Math.min(L1, L2);
                    return (lighter + 0.05) / (darker + 0.05);
                }

                // COLOUR CONTRAST: Resolve the effective background color behind the focused element
                // COLOUR CONTRAST:
                function cc_getEffectiveBackgroundColor(el) {
                    let node = el;
                    while (node) {
                        const cs = window.getComputedStyle(node);
                        const bg = cs.backgroundColor;
                        if (bg && !cc_isTransparent(bg)) return bg;
                        node = node.parentElement;
                    }
                    return 'rgb(255, 255, 255)'; // default to white if nothing found
                }

                // COLOUR CONTRAST: Use the FIRST ANCESTOR with a non-transparent background (skip the element itself)
                // COLOUR CONTRAST:
                function cc_getAncestorBackgroundColor(el) {
                    let node = el ? el.parentElement : null; // start at parent to avoid the element's own background
                    while (node) {
                        const cs = window.getComputedStyle(node);
                        const bg = cs.backgroundColor;
                        if (bg && !cc_isTransparent(bg)) return bg;
                        node = node.parentElement;
                    }
                    return 'rgb(255, 255, 255)'; // fallback if no ancestor has solid background
                }

                // COLOUR CONTRAST: Determine backgrounds and compute contrast (outline vs element bg; box-shadow vs ancestor bg)
                // COLOUR CONTRAST:
                const cc_effectiveBg = cc_getEffectiveBackgroundColor(activeElement);
                const cc_ancestorBg = cc_getAncestorBackgroundColor(activeElement);
                // COLOUR CONTRAST:
                const cc_bgRGB = cc_parseColorToRGB(cc_effectiveBg);
                const cc_ancestorBgRGB = cc_parseColorToRGB(cc_ancestorBg);
                // COLOUR CONTRAST:
                const cc_outlineRGB = cc_parseColorToRGB(outlineColor);
                const cc_boxShadowRGB = cc_parseColorToRGB(boxShadowColor);

                // COLOUR CONTRAST:
                const cc_outlineRatio = cc_bgRGB && cc_outlineRGB ? cc_contrastRatio(cc_bgRGB, cc_outlineRGB) : null;
                const cc_outlineBgRatio = cc_ancestorBgRGB && cc_outlineRGB ? cc_contrastRatio(cc_ancestorBgRGB, cc_outlineRGB) : null;
                const cc_boxShadowRatio = cc_ancestorBgRGB && cc_boxShadowRGB ? cc_contrastRatio(cc_ancestorBgRGB, cc_boxShadowRGB) : null;
                const cc_factorOutlineBgRatio = (parseInt(outlineOffset) > 1);

                return {
                    html: activeElement.outerHTML,
                    hasFocusRing,
                    outline,
                    outlineColor,
                    outlineWidth,
                    outlineStyle,
                    // COLOUR CONTRAST: background color used for contrast calculation
                    backgroundColor: cc_effectiveBg,
                    boxShadowColor,
                    // COLOUR CONTRAST: computed WCAG contrast ratio between outline and background
                    contrastRatio: cc_outlineRatio,
                    boxShadowContrastRadio: cc_boxShadowRatio,
                    ancestorBg: cc_ancestorBg,
                    outlineBgRatio: cc_outlineBgRatio,
                    factorOutlineBgRatio: cc_factorOutlineBgRatio,
                    isEnableSkipLink: activeElement.classList.contains(
                        'enable-mobile-visible-on-focus',
                    ),
                    isBody: activeElement === document.body,
                    isIframe,
                    isVideo,
                    isRangeInput,
                    checkedPseudoEl,
                    tabIndex: activeElement.tabIndex
                };
            });

            // If this is not a skip link (which has its own test suite),
            // and not a body, video or iframe tag (which don't report their
            // valid focus states in puppeteer for some reason).
            if (
                !domInfo.isEnableSkipLink &&
                !domInfo.isBody &&
                !domInfo.isVideo &&
                !domInfo.isIframe
            ) {
                // If the focused element doesn't have a focus ring, output why.
                if (!domInfo.hasFocusRing) {
                    console.log('Bad focus on: ', domInfo.html);
                    console.log(
                        'Checked Pseudo element',
                        domInfo.checkedPseudoEl,
                    );
                    console.log(
                        `outlineColor: ${domInfo.outlineColor}\noutline: ${domInfo.outline}\noutlineWidth: ${domInfo.outlineWidth}\noutlineStyle: ${domInfo.outlineStyle}`,
                    );
                }

                // The expect test so jest logs it as an error.
                expect(domInfo.hasFocusRing).toBe(true);

                /* function check(prop) {
                    if (domInfo[prop].trim() === '') {
                        console.log(`problem: ${filename} ${numTabStops} ${domInfo.html}, ${prop} ${domInfo.boxShadowContrastRadio}`);
                    }
                }

                check('outlineColor');
                check('backgroundColor');
                check('boxShadowColor');
                check('ancestorBg'); */

                // COLOUR CONTRAST: Assert WCAG contrast (>= 3:1) using outline and/or box-shadow
                if (
                    domInfo.hasFocusRing 
                ) {
                    // COLOUR CONTRAST: Determine compliance when either outline or box-shadow meets threshold
                    let outlineOK =
                        typeof domInfo.contrastRatio === 'number' ? domInfo.contrastRatio >= 3 : false;

                    if (!outlineOK && domInfo.factorOutlineBgRatio) {
                        outlineOK = typeof domInfo.outlineBgRatio === 'number' ? domInfo.outlineBgRatio >= 3 : false;
                    }

                    const shadowOK =
                        (typeof domInfo.boxShadowContrastRadio === 'number' ? domInfo.boxShadowContrastRadio >= 3 : false);

                    const nonCompliantFocusState = !(outlineOK || shadowOK);

                    if (nonCompliantFocusState && domInfo.tabIndex !== -1) {

                        console.log(
                            // COLOUR CONTRAST: diagnostic output when contrast is insufficient
                            `File: ${filename}, tabStop: ${numTabStops}, isDesktop: ${isDesktop}, isDarkMode: ${isDarkMode}\n` +
                            `Focus contrast too low: outline=${String(domInfo.contrastRatio)}; outlineOuterBgRatio: ${String(domInfo.outlineBgRatio)};  boxShadow=${String(domInfo.boxShadowContrastRadio)} on element ${domInfo.html}\n` +
                            `outlineColor: ${domInfo.outlineColor} (${toHex(domInfo.outlineColor)}),  backgroundColor: ${domInfo.backgroundColor} (${toHex(domInfo.backgroundColor)})\n` +
                            `boxShadowColor: ${domInfo.boxShadowColor} (${toHex(domInfo.boxShadowColor)}), ancestorBgColor: ${domInfo.ancestorBg} ${toHex(domInfo.ancestorBg)}\n` + 
                            `factorOutlineBgRatio ${domInfo.factorOutlineBgRatio}, tabIndex: ${domInfo.tabIndex}\n`
                        );
                    }
                    // COLOUR CONTRAST: WCAG 2.2 Focus Appearance (Minimum) requires >= 3:1 for the indicator
                    if (domInfo.html.indexOf('data-contrast-false-positive') <= -1) {
                        expect(nonCompliantFocusState).toBe(false);
                    }
                    
                } else {
                    // COLOUR CONTRAST: If we cannot compute contrast, log context for investigation
                    console.log(
                        'COLOUR CONTRAST: Unable to compute contrast for element',
                        domInfo.html,
                        'outlineColor:',
                        domInfo.outlineColor,
                        'backgroundColor:',
                        domInfo.backgroundColor,
                    );
                }
            }
        } while (!domInfo.isBody);
        // console.log(`Number of tabstops for ${filename} with HTML Class '${htmlClass}': ${numTabStops} `);
        numTabStops = 0;
        page.close();
    }
    // end testFocusStates()

    // This goes through all the URLs in the site and
    // runs testFocusStates() on it twice, one in the desktop
    // browser and one in the mobile.
    for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];
        it(`Desktop Breakpoint: Test focus states on ${file} (light mode)`, async () => {
            await testFocusStates(file, true, false);
        });
        it(`Mobile Breakpoint: Test focus states on ${file}  (light mode)`, async () => {
            await testFocusStates(file, false, false);
        });
        it(`Desktop Breakpoint: Test focus states on ${file} (dark mode)`, async () => {
            await testFocusStates(file, true, true);
        });
        it(`Mobile Breakpoint: Test focus states on ${file} (dark mode)`, async () => {
            await testFocusStates(file, false, true);
        });
    }
});
