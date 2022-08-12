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
      await page.waitForSelector('footer');

      // Step 2: Focus on appropriate element
      await page.focus('.enable-flyout__open-menu-button');

      // Step 3: Check the DOM
      domInfo = await page.evaluate(() => {
        const mobileMenuButton = document.querySelector('.enable-flyout__open-menu-button');
        const { activeElement } = document;

        const buttonStyle = window.getComputedStyle(mobileMenuButton, null);

        return {
          isMobileMenuButtonHidden: ( buttonStyle.display === 'none'),
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
    
    domInfo = await loadPage(true);
    // Step 4: Do Tests
    expect(domInfo.isMobileMenuButtonHidden).toBe(true)
    expect(domInfo.width).toBe(config.DESKTOP_WIDTH);

  });

  it('Desktop - ensure menu closes when focus goes outside submenu', async () => {
    let domInfo;
    
    domInfo = await loadPage(true);

    await page.focus('[aria-controls="controls-section"]');
    await page.keyboard.press('Space');
    await new Promise(res => setTimeout(res, config.KEYPRESS_TIMEOUT));

    domInfo = await page.evaluate(() => {
      const { activeElement } = document;
      const ariaControls = activeElement.getAttribute('aria-controls');
      const controlledEl = document.getElementById(ariaControls);

      return {
        isMenuExpanded: activeElement.getAttribute('aria-expanded') === 'true',
        hasControlledEl: controlledEl !== null,
        ariaControls,
      };
    });

    expect(domInfo.ariaControls).not.toBe(null);
    expect(domInfo.ariaControls).not.toBe('');

    const { ariaControls } = domInfo;

    // now, let's tab all the way through the document until we tab out of the
    // open menu
    do {
      expect(domInfo.isMenuExpanded).toBe(true);

      page.keyboard.press('Tab');
      await new Promise(res => setTimeout(res, config.KEYPRESS_TIMEOUT));
      
      domInfo = await page.evaluate((ariaControls) => {
        const {activeElement} = document;
        const controlledEl = document.getElementById(ariaControls);
        const menuButton = document.querySelector(`[aria-controls="${ariaControls}"]`);

        return {
          isFocusedInsideMenu: (conrolledEl.contains(activeEement)),
          isMenuExpanded: menuButton.getAttribute('aria-expanded', 'true')
        }

      })(ariaControls);

    } while (!domInfo.isFocusedInsideMenu);

    expect(domInfo.isMenuExpanded).toBe(false);
    

  });



  it('Mobile - ensure hamburger menu icon is visisble', async () => {
    let domInfo;
    
    domInfo = await loadPage(false);
    // Step 4: Do Tests
    expect(domInfo.isMobileMenuButtonHidden).toBe(false);
    expect(domInfo.width).toBe(config.MOBILE_WIDTH);
  });




});