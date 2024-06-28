'use strict';

import config from './test-config.js';

describe('Meter Tests', () => {
    it('Should apply meter state/percentage attribute for HTML5 example', async () => {
        let domInfo;

        await page.goto(`${config.BASE_URL}/meter.php`);

        // wait until all content loads
        await page.waitForSelector('#html5-example');

        domInfo = await page.evaluate(() => {
            const example = document.querySelector('#html5-example');
            const meterElements = Array.from(
                example.getElementsByClassName('enable-custom-meter'),
            );

            return {
                meters: meterElements?.map((el) => ({
                    state: el.getAttribute('meter-state'),
                    fill: el.getAttribute('style'),
                    valuetext: el.getAttribute('aria-valuetext'),
                })),
            };
        });

        // HTML5 example meters
        expect(domInfo.meters[0].state).toBe('positive');
        expect(domInfo.meters[0].fill).toBe('--meter-percentage: 20%');
        expect(domInfo.meters[0].valuetext).toBe('20%');

        expect(domInfo.meters[1].state).toBe('negative');
        expect(domInfo.meters[1].fill).toBe('--meter-percentage: 90%');
        expect(domInfo.meters[1].valuetext).toBe('90%');

        expect(domInfo.meters[2].state).toBe('neutral');
        expect(domInfo.meters[2].fill).toBe('--meter-percentage: 60%');
        expect(domInfo.meters[2].valuetext).toBe('60%');
    });

    it('Should apply meter state/percentage attribute for ARIA example', async () => {
        let domInfo;

        await page.goto(`${config.BASE_URL}/meter.php`);

        // wait until all content loads
        await page.waitForSelector('#aria-example');

        // check to see if the button that opened the modal is now focused.
        domInfo = await page.evaluate(() => {
            const example = document.querySelector('#aria-example');
            const meterElements = Array.from(
                example.getElementsByClassName('enable-custom-meter'),
            );

            return {
                meters: meterElements?.map((el) => ({
                    state: el.getAttribute('meter-state'),
                    fill: el.getAttribute('style'),
                    valuetext: el.getAttribute('aria-valuetext'),
                })),
            };
        });

        // HTML5 example meters
        expect(domInfo.meters[0].state).toBe('positive');
        expect(domInfo.meters[0].fill).toBe('--meter-percentage: 20%');
        expect(domInfo.meters[0].valuetext).toBe('20%');

        expect(domInfo.meters[1].state).toBe('negative');
        expect(domInfo.meters[1].fill).toBe('--meter-percentage: 90%');
        expect(domInfo.meters[1].valuetext).toBe('90%');

        expect(domInfo.meters[2].state).toBe('neutral');
        expect(domInfo.meters[2].fill).toBe('--meter-percentage: 60%');
        expect(domInfo.meters[2].valuetext).toBe('60%');
    });
});
