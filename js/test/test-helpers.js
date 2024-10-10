'use strict';

import config from './test-config.js';
import puppeteer from 'puppeteer';
import fs from 'fs';

const testHelpers = new (function () {
    this.isElementHidden = function (el) {
        return el.offsetParent === null;
    };

    this.isElementFocused = async function (tooltipButtonInputId) {

        const isButtonFocused = await page.evaluate((tooltipIconButtonId) => {
            const button = document.querySelector(tooltipIconButtonId);
            return button === document.activeElement;
        }, tooltipButtonInputId);

        return isButtonFocused;
    }

    this.getDesktopBrowser = async function (isBrowserVisible) {
        try {
            const browser = await puppeteer.launch({
                headless: !isBrowserVisible, // The browser is visible
                ignoreHTTPSErrors: true,
                args: [
                    `--window-size=${config.DESKTOP_WIDTH},${config.DESKTOP_HEIGHT}`,
                ],
                defaultViewport: {
                    width: config.DESKTOP_WIDTH,
                    height: config.DESKTOP_HEIGHT,
                },
            });

            return browser;
        } catch (ex) {
            console.log('ex', ex);
            return ex;
        }
    };

    this.getMobileBrowser = async function (isBrowserVisible) {
        try {
            const browser = await puppeteer.launch({
                headless: !isBrowserVisible, // The browser is visible
                ignoreHTTPSErrors: true,
                args: [
                    `--window-size=${config.MOBILE_WIDTH},${config.MOBILE_HEIGHT}`,
                ],
                defaultViewport: {
                    width: config.MOBILE_WIDTH,
                    height: config.MOBILE_HEIGHT,
                },
            });

            return browser;
        } catch (ex) {
            console.log('ex', ex);
            return ex;
        }
    };

    this.fastPause = async function () {
        return await new Promise((res) =>
            setTimeout(res, config.KEYPRESS_FAST_TIMEOUT),
        );
    };

    this.pause = async function () {
        return await new Promise((res) =>
            setTimeout(res, config.KEYPRESS_TIMEOUT),
        );
    };

    this.pauseFor = async function () {
        return await new Promise((res) =>
            setTimeout(res, config.KEYPRESS_TIMEOUT),
        );
    };

    this.keyDownAndUp = function (page, key) {
        page.keyboard.press(key, {
            delay: config.KEYPRESS_FAST_TIMEOUT - 10,
        });
    };

    this.waitTillHTMLRendered = async (page, timeout = 30000) => {
        const checkDurationMsecs = 1000;
        const maxChecks = timeout / checkDurationMsecs;
        let lastHTMLSize = 0;
        let checkCounts = 1;
        let countStableSizeIterations = 0;
        const minStableSizeIterations = 1;

        while (checkCounts++ <= maxChecks) {
            let html = await page.content();
            let currentHTMLSize = html.length;

            let bodyHTMLSize = await page.evaluate(
                () => document.body.innerHTML.length,
            );

            console.log(
                'last: ',
                lastHTMLSize,
                ' <> curr: ',
                currentHTMLSize,
                ' body html size: ',
                bodyHTMLSize,
            );

            if (lastHTMLSize !== 0 && currentHTMLSize === lastHTMLSize)
                countStableSizeIterations++;
            else countStableSizeIterations = 0; //reset the counter

            if (countStableSizeIterations >= minStableSizeIterations) {
                console.log('Page rendered fully..');
                break;
            }

            lastHTMLSize = currentHTMLSize;
            await page.waitForTimeout(checkDurationMsecs);
        }
    };

    this.getPageList = () => {
        const r = [];
        let rawData = fs.readFileSync('templates/data/meta-info.json');
        let pageListJSON = JSON.parse(rawData);

        for (let name in pageListJSON) {
            const value = pageListJSON[name];

            if (!value.wip && !value.hasIframes) {
                r.push(name);
            }
        }

        return r;
    };

    this.redirectPuppeteerConsole = (page) => {
        page.on('console', (msg) => console.log('PAGE LOG:', msg.text()));
        /* page.on('pageerror', error => {
      console.log(error.message);
    }); */
        /* page.on('response', response => {
      console.log(response.status, response.url());
    });
    page.on('requestfailed', request => {
      console.log(request.failure().errorText, request.url());
    }); */
    };
})();

export default testHelpers;
