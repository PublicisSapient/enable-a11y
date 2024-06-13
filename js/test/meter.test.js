'use strict';

import config from './test-config.js';

describe('Meter Tests', () => {
    beforeAll(async () => {});

    it('Should apply meter state and percentage based on attributes', async () => {
        let domInfo;

        await page.goto(`${config.BASE_URL}/meter.php`);

        // wait until all content loads
        await page.waitForSelector('#html5-example');

        // check to see if the button that opened the modal is now focused.
        domInfo = await page.evaluate(() => {
            const meterElements = Array.from(
                document.querySelectorAll('[role="meter"]'),
            );

            return {
                meters: meterElements?.map((el) => ({
                    state: el.getAttribute('meter-state'),
                    fill: el.getAttribute('style'),
                })),
            };
        });

        expect(domInfo.meters[0].state).toBe('positive');
        expect(domInfo.meters[0].fill).toBe('--meter-percentage: 20%');

        expect(domInfo.meters[1].state).toBe('negative');
        expect(domInfo.meters[1].fill).toBe('--meter-percentage: 90%');

        expect(domInfo.meters[2].state).toBe('neutral');
        expect(domInfo.meters[2].fill).toBe('--meter-percentage: 60%');
    });
});
