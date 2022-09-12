'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import fs from 'fs';

const fileList =  testHelpers.getPageList();
let mobileBrowser, mobilePage, desktopBrowser, desktopPage;

describe('Test Focus States on all pages on Enable', () => {
  beforeAll(async () => {
    // Put code here that should execute before starting tests.
    mobileBrowser = await testHelpers.getMobileBrowser();
    mobilePage = await mobileBrowser.newPage();
    desktopBrowser = await testHelpers.getDesktopBrowser();
    desktopPage = await desktopBrowser.newPage();
  });

  afterAll(async () => {
    await mobileBrowser.close();
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


      return {
        openGraphPosterURL,
        twitterGraphPosterURL,
      }

    });

    const { openGraphPosterURL, twitterGraphPosterURL } = domInfo;

    expect(openGraphPosterURL).toBe(twitterGraphPosterURL);
    expect(fs.existsSync(`./${openGraphPosterURL}`)).toBe(true);


  }

  

  for (let i=0; i<fileList.length; i++) {
    const file = fileList[i];
      it(`Desktop Breakpoint: Test page setup on ${fileList[i]}`, async () => {
        await testPage(fileList[i], desktopPage);
      });

      /*
      it(`Mobile Breakpoint: Test page setup on ${fileList[i]}`, async () => {
        await testPage(fileList[i], mobilePage);
      });
      */
  }

});