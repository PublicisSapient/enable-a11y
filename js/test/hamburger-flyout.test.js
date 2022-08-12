'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const puppeteer = require('puppeteer');

describe('Hamburger Menu Tests', () => {
  beforeAll(async () => {
  });


  // Put code here that should execute before starting tests.

  it('Desktop - ensure hamburger menu icon is not visisble', async () => {
    let domInfo;
    
    const browser = await puppeteer.launch({
      //headless: false, // The browser is visible
      ignoreHTTPSErrors: true,
      args: [`--window-size=${config.DESKTOP_WIDTH},${config.DESKTOP_HEIGHT}`],
      defaultViewport: {
        width: config.DESKTOP_WIDTH,
        height: config.DESKTOP_HEIGHT
      }
    });
    const page = await browser.newPage();

    await page.goto(`${config.BASE_URL}/multi-level-hamburger-menu.php`);

    // Test on initial load.

    // Step 1: Wait for element to load on page.
    await page.waitForSelector('.enable-flyout__open-menu-button');

    // Step 2: Focus on appropriate element
    await page.focus('.enable-flyout__open-menu-button');

    // Step 3: Check the DOM
    domInfo = await page.evaluate(() => {
      const mobileMenuButton = document.querySelector('.enable-flyout__open-menu-button');
      const { activeElement } = document;

      const buttonStyle = window.getComputedStyle(mobileMenuButton, null);

      return {
        isMobileMenuButtonHidden: ( buttonStyle.display === 'none'),
        style: buttonStyle.display,
        html: mobileMenuButton.outerHTML,
        width: window.innerWidth
      };
    });

    // Step 4: Do Tests
    expect(domInfo.isMobileMenuButtonHidden).toBe(true)

    await browser.close();
  });
});