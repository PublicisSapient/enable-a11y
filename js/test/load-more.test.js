'use strict';
import config from './test-config.js';
import testHelpers from './test-helpers.js';

const exampleImages1 = '#example1 img';
const exampleImages2 = '#example2 img';

describe('Load More Tests', () => {
    it('Example 1 should have images with non-empty alt tags', async () => {
        await page.goto(`${config.BASE_URL}/load-more.php`);

        await page.waitForSelector('#example1');

        const images = await page.$$eval(exampleImages1, (imgs) =>
            imgs.map((img) => ({
                src: img.src,
                alt: img.alt,
            })),
        );

        images.forEach((image) => {
            expect(image.src).not.toBe('');
            expect(image.alt).not.toBe('');
        });
    });

    it('Example 1 should initalize with "Showing 3 of 9 Categories" and have aria-live polite', async () => {
        await page.goto(`${config.BASE_URL}/load-more.php`);

        await page.waitForSelector('#example1');

        const domInfo = await page.evaluate(() => {
            const categoryCount = document.getElementById('category-count');

            return {
                hasProperCountText:
                    categoryCount.innerText === 'Showing 3 of 9 Categories',
                hasAriaLive:
                    categoryCount.getAttribute('aria-live') === 'polite',
            };
        });

        expect(domInfo.hasProperCountText).toBe(true);
        expect(domInfo.hasAriaLive).toBe(true);
    });

    it('Example 1 keyboard support for "View More Categories" and "Reset Category Grid Demo" buttons', async () => {
        const numTabPress = 3;
        await page.goto(`${config.BASE_URL}/load-more.php`);

        await page.waitForSelector('#example1');

        let domInfo;

        // Start on the first category tile
        domInfo = await page.evaluate(() => {
            const firstTile = document.querySelector('.view-details-link');
            firstTile.focus();
            return {
                isFirstTileFocused: document.activeElement === firstTile,
            };
        });

        expect(domInfo.isFirstTileFocused).toBe(true);

        // Tab to the "View More Categories" button and press it to load the first new set

        // for (let i = 0; i < numTabPress; i++) {
        //     await page.keyboard.press('Tab');
        // }
        testHelpers.keyPressHelper(page, 'Tab', numTabPress);
        await page.keyboard.press('Enter');

        domInfo = await page.evaluate(() => {
            const allTiles = Array.from(
                document.querySelectorAll('.view-details-link'),
            );
            return {
                isFirstTileInNewSetFocused:
                    document.activeElement === allTiles[3],
            };
        });

        expect(domInfo.isFirstTileInNewSetFocused).toBe(true);

        // Expect the counter to update
        domInfo = await page.evaluate(() => {
            const countText = document.querySelector('#category-count');
            return {
                isCountTextUpdated:
                    countText.innerHTML === 'Showing 6 of 9 Categories',
            };
        });

        expect(domInfo.isCountTextUpdated).toBe(true);

        // Tab to the "View More Categories" button and press it to load the second new set
        testHelpers.keyPressHelper(page, 'Tab', numTabPress);
        await page.keyboard.press('Enter');

        // Tab to the "Reset Category Grid Demo"
        testHelpers.keyPressHelper(page, 'Tab', numTabPress);
        await page.keyboard.press('Enter');

        // Expect the first tile to be selected after resetting the demo
        domInfo = await page.evaluate(() => {
            const allTiles = Array.from(
                document.querySelectorAll('.view-details-link'),
            );
            return {
                isFocusReset: document.activeElement === allTiles[0],
            };
        });

        expect(domInfo.isFocusReset).toBe(true);
    });

    it('Example 2 should have images with non-empty alt tags', async () => {
        await page.goto(`${config.BASE_URL}/load-more.php`);

        await page.waitForSelector('#example2');

        const images = await page.$$eval(exampleImages2, (imgs) =>
            imgs.map((img) => ({
                src: img.src,
                alt: img.alt,
            })),
        );

        images.forEach((image) => {
            expect(image.src).not.toBe('');
            expect(image.alt).not.toBe('');
        });
    });

    it('Example 2 should have a proper role and aria-labelledby assigned', async () => {
        await page.goto(`${config.BASE_URL}/load-more.php`);

        await page.waitForSelector('#example2');

        const domInfo = await page.evaluate(() => {
            const tiles = Array.from(
                document.querySelectorAll('.product-tile'),
            );

            return {
                hasGroupRole: tiles.every(
                    (tile) => tile.getAttribute('role') === 'group',
                ),
                hasAriaLabelledBy: tiles.every(
                    (tile) => tile.getAttribute('aria-labelledby') !== '',
                ),
            };
        });

        expect(domInfo.hasGroupRole).toBe(true);
        expect(domInfo.hasAriaLabelledBy).toBe(true);
    });

    it('Example 2 should initalize with "Showing 3 of 9 Products" and have aria-live polite', async () => {
        await page.goto(`${config.BASE_URL}/load-more.php`);

        await page.waitForSelector('#example2');

        const domInfo = await page.evaluate(() => {
            const productCount = document.getElementById('product-count');

            return {
                hasProperCountText:
                    productCount.innerText === 'Showing 3 of 9 Products',
                hasAriaLive:
                    productCount.getAttribute('aria-live') === 'polite',
            };
        });

        expect(domInfo.hasProperCountText).toBe(true);
        expect(domInfo.hasAriaLive).toBe(true);
    });

    it('Example 2 keyboard support for "Load More Products" and "Reset Product Grid Demo" buttons', async () => {
        const numTabPress = 6;

        await page.goto(`${config.BASE_URL}/load-more.php`);

        await page.waitForSelector('#example2');

        let domInfo;

        // Start on the first category tile
        domInfo = await page.evaluate(() => {
            const firstTile = document.querySelector('.product-details-link');
            firstTile.focus();
            return {
                isFirstTileFocused: document.activeElement === firstTile,
            };
        });

        expect(domInfo.isFirstTileFocused).toBe(true);

        // Tab to the "View More Categories" button and press it to load the first new set
        testHelpers.keyPressHelper(page, 'Tab', numTabPress);
        await page.keyboard.press('Enter');

        domInfo = await page.evaluate(() => {
            const allTiles = Array.from(
                document.querySelectorAll('.product-details-link'),
            );
            return {
                isFirstTileInNewSetFocused:
                    document.activeElement === allTiles[3],
            };
        });

        expect(domInfo.isFirstTileInNewSetFocused).toBe(true);

        // Expect the counter to update
        domInfo = await page.evaluate(() => {
            const countText = document.querySelector('#product-count');
            return {
                isCountTextUpdated:
                    countText.innerHTML === 'Showing 6 of 9 Products',
            };
        });

        expect(domInfo.isCountTextUpdated).toBe(true);

        // Tab to the "View More Categories" button and press it to load the second new set
        testHelpers.keyPressHelper(page, 'Tab', numTabPress);
        await page.keyboard.press('Enter');

        // Tab to the "Reset Category Grid Demo"
        testHelpers.keyPressHelper(page, 'Tab', numTabPress);
        await page.keyboard.press('Enter');

        // Expect the first tile to be selected after resetting the demo
        domInfo = await page.evaluate(() => {
            const allTiles = Array.from(
                document.querySelectorAll('.product-details-link'),
            );
            return {
                isFocusReset: document.activeElement === allTiles[0],
            };
        });

        expect(domInfo.isFocusReset).toBe(true);
    });
});
