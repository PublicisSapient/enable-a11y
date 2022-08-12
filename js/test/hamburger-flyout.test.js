'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import puppeteer from 'puppeteer';

describe('Hamburger Menu Tests', () => {
  beforeAll(async () => {
  });

  async function loadPage(isDesktop) {
    try {
      let domInfo;


      const browser = isDesktop ? await testHelpers.getDesktopBrowser() : await testHelpers.getMobileBrowser();
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

      console.log('domInfo', domInfo);

      await browser.close();
      return domInfo;

    } catch (ex) {
      console.log('ex', ex);
      return ex;
    }
  }

  // Put code here that should execute before starting tests.

  it('Desktop - ensure hamburger menu icon is not visisble', async () => {
    let domInfo;
    
    console.log('here');
    domInfo = await loadPage(true);
    console.log('outside', domInfo);
    // Step 4: Do Tests
    expect(domInfo.isMobileMenuButtonHidden).toBe(true)

  });

  it('Mobile - ensure hamburger menu icon is visisble', async () => {
    let domInfo;
    
    console.log('here');
    domInfo = await loadPage(false);
    console.log('outside', domInfo);
    // Step 4: Do Tests
    expect(domInfo.isMobileMenuButtonHidden).toBe(false)

  });
});