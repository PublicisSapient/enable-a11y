'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import fs from 'fs';

const fileList = testHelpers.getPageList();
let mobileBrowser, mobilePage, desktopBrowser, desktopPage;

describe('Test for PHP errors on all pages on Enable', () => {
  beforeAll(async () => {
    // Put code here that should execute before starting tests.
    desktopBrowser = await testHelpers.getDesktopBrowser();
    desktopPage = await desktopBrowser.newPage();
  });

  afterAll(async () => {
    await desktopBrowser.close();
  });

  async function testPage(filename, page) {
    let domInfo;

    await page.goto(`${config.BASE_URL}/${filename}`);
    
    // Test on initial load.
    
    // Step 1: Wait for whole page to load (this is so scripts
    // like `enable-visible-on-focus` can initialize)
    await page.waitForSelector('footer');

      
    //await testHelpers.fastPause();
    domInfo = await page.evaluate(() => {
      const { body } = document;
      const { innerHTML } = body;
      let PHPErrors = innerHTML.match(/Warning:[^<]* on line [0-9]+/);

      if (PHPErrors === null) {
        PHPErrors = [];
      }

      return {
        PHPErrors
      }

    });

    //console.log(`checking `, domInfo.html, domInfo.parentClass);
    // Step 4: Do Tests ... but not on enable skip link (we'll handle that
    // someplace else)
    if (domInfo.PHPErrors.length > 0) {
      console.log(`PHP Errors in ${filename}:`, domInfo.PHPErrors);
    }

    expect(domInfo.PHPErrors.length).toBe(0);
  }

  

  for (let i=0; i<fileList.length; i++) {
    const file = fileList[i];
    it(`Desktop Breakpoint: Test PHP errors on ${fileList[i]}`, async () => {
      await testPage(fileList[i], desktopPage);
    });
  }

});