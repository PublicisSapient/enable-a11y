'use strict';

import config from './test-config.js';

describe('Meter Tests', () => {
    it('Should apply meter state and percentage based on attributes', async () => {
        let domInfo;

        await page.goto(`${config.BASE_URL}/meter.php`);

        // wait until all content loads
        await page.waitForSelector('#html5-example');
        await page.waitForSelector('#aria-example');

        // check to see if the button that opened the modal is now focused.
        domInfo = await page.evaluate(() => {
            const meterElements = Array.from(
                document.querySelectorAll('[class="enable-custom-meter"]'),
            );

            return {
                meters: meterElements?.map((el) => ({
                    state: el.getAttribute('meter-state'),
                    fill: el.getAttribute('style'),
                })),
            };
        });

        // HTML5 example meters
        expect(domInfo.meters[0].state).toBe('positive');
        expect(domInfo.meters[0].fill).toBe('--meter-percentage: 20%');

        expect(domInfo.meters[1].state).toBe('negative');
        expect(domInfo.meters[1].fill).toBe('--meter-percentage: 90%');

        expect(domInfo.meters[2].state).toBe('neutral');
        expect(domInfo.meters[2].fill).toBe('--meter-percentage: 60%');

        // ARIA example meters
        expect(domInfo.meters[3].state).toBe('positive');
        expect(domInfo.meters[3].fill).toBe('--meter-percentage: 20%');

        expect(domInfo.meters[4].state).toBe('negative');
        expect(domInfo.meters[4].fill).toBe('--meter-percentage: 90%');

        expect(domInfo.meters[5].state).toBe('neutral');
        expect(domInfo.meters[5].fill).toBe('--meter-percentage: 60%');
    });
});
