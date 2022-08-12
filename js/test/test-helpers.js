'use strict';

import config from './test-config.js';
import puppeteer from 'puppeteer';

const testHelpers = new function () {
  this.isElementHidden = function (el) {
    return (el.offsetParent === null)
  }

  this.getDesktopBrowser = async function () {
    try {
      const browser = await puppeteer.launch({
        //headless: false, // The browser is visible
        ignoreHTTPSErrors: true,
        args: [`--window-size=${config.DESKTOP_WIDTH},${config.DESKTOP_HEIGHT}`],
        defaultViewport: {
          width: config.DESKTOP_WIDTH,
          height: config.DESKTOP_HEIGHT
        }
      });

      return browser;
    } catch (ex) {
      console.log('ex', ex);
      return ex;
    }

    
  }


  this.getMobileBrowser = async function () {
    try {
      const browser = await puppeteer.launch({
        //headless: false, // The browser is visible
        ignoreHTTPSErrors: true,
        args: [`--window-size=${config.MOBILE_WIDTH},${config.MOBILE_HEIGHT}`],
        defaultViewport: {
          width: config.MOBILE_WIDTH,
          height: config.MOBILE_HEIGHT
        }
      });

      return browser;
    } catch (ex) {
      console.log('ex', ex);
      return ex;
    }
  }
}

export default testHelpers;