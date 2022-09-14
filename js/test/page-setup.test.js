'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import fs from 'fs';

const fileList =  testHelpers.getPageList();
let desktopBrowser, desktopPage;

describe('Test all pages on Enable to Ensure the information is written correctly', () => {
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

    // testHelpers.redirectPuppeteerConsole(page);
    await page.goto(`${config.BASE_URL}/${filename}`);
    // Test on initial load.
    
    // Step 1: Wait for whole page to load (this is so scripts
    // like `enable-visible-on-focus` can initialize)
    await page.waitForSelector('footer');

    
    //await testHelpers.fastPause();
    domInfo = await page.evaluate(() => {
      //const { querySelector } = document;
      
      // get meta info posters.
      const openGraphPoster = document.querySelector('meta[property="og:image"]');
      const twitterGraphPoster = document.querySelector('meta[name="twitter:image"]');

      const openGraphPosterContent = openGraphPoster.getAttribute('content');
      const twitterGraphPosterContent = twitterGraphPoster.getAttribute('content');
      const openGraphPosterURL = openGraphPosterContent.split('?')[0];
      const twitterGraphPosterURL = twitterGraphPosterContent;
      const areTherePHPJestErrors = (document.querySelector('.jest-error') !== null);


      return {
        openGraphPosterURL,
        twitterGraphPosterURL,
        areTherePHPJestErrors
      }

    });

    const { openGraphPosterURL, twitterGraphPosterURL, areTherePHPJestErrors } = domInfo;

    expect(openGraphPosterURL).toBe(twitterGraphPosterURL);
    expect(fs.existsSync(`./${openGraphPosterURL}`)).toBe(true);
    expect(areTherePHPJestErrors).toBe(false);

  }

  

  for (let i=0; i<fileList.length; i++) {
    const file = fileList[i];
      it(`Desktop Breakpoint: Test page setup on ${file}`, async () => {
        await testPage(fileList[i], desktopPage);
      });

  }

});