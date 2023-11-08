'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import fs from 'fs';

const fileList = testHelpers.getPageList();
let mobileBrowser, mobilePage, desktopBrowser, desktopPage;

describe('Test reflow on all pages', () => {
  beforeAll(async() => {
    mobileBrowser = await testHelpers.getMobileBrowser();
    desktopBrowser = await testHelpers.getDesktopBrowser();

    mobilePage = await mobileBrowser.newPage();
    desktopPage = await desktopBrowser.newPage();
  });

  afterAll(async() => {
    await mobileBrowser.close();
    await desktopBrowser.close();
  });

  async function testPage(filename, isDesktop) {
    let domInfo;
    const browser = isDesktop ? desktopBrowser : mobileBrowser;
    const page = isDesktop ? desktopPage : mobilePage;
    await page.goto(`${config.BASE_URL}/${filename}`);

    // Test on initial load.

    // Step 1: Wait for whole page to load (this is so scripts
    // like `enable-visible-on-focus` can initialize)
    await page.waitForSelector('footer');


    domInfo = await page.evaluate(() => {
      const { innerWidth } = window;
      const { scrollWidth } = document.body;

      return {
        innerWidth,
        scrollWidth
      }
    });
    const { innerWidth, scrollWidth } = domInfo;

    if (scrollWidth !== innerWidth) {
      console.log(`Issue with page ${filename}: innerWidth: ${innerWidth}, scrollWidth: ${scrollWidth}, isDesktop: ${isDesktop}.`);
    }
    expect(scrollWidth).toBe(innerWidth);

    //expect(badLinkHTML.length).toBe(0);

  }



  for (let i = 0; i < fileList.length; i++) {
    const file = fileList[i];
    it(`Test links on ${file}`, async() => {
      await testPage(file, true);  // test desktop
      await testPage(file, false); // test mobile
    });
  }

});