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
                    style: el.getAttribute('style'),
                    valuetext: el.getAttribute('aria-valuetext'),
                })),
            };
        });

        // Verify that values are set for all HTML meter components
        domInfo.meters.forEach((meter) => {
            expect(['positive', 'neutral', 'negative']).toContain(meter.state);
            expect(meter.style).toContain('--meter-percentage:');
            expect(meter.valuetext).toContain('%');
        });
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
                    style: el.getAttribute('style'),
                    valuetext: el.getAttribute('aria-valuetext'),
                })),
            };
        });

        // Verify that values are set for all ARIA meter components
        domInfo.meters.forEach((meter) => {
            expect(['positive', 'neutral', 'negative']).toContain(meter.state);
            expect(meter.style).toContain('--meter-percentage:');
            expect(meter.valuetext).toContain('%');
        });
    });
});
