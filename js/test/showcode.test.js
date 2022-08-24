'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import fs from 'fs';

const fileList = [ 'code-quality.php' ]; //testHelpers.getPageList();
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
    const showcodeSelectSel = '.showcode__select'

    await page.goto(`${config.BASE_URL}/${filename}`);
    
    // Test on initial load.
    
    // Step 1: Wait for whole page to load (this is so scripts
    // like `enable-visible-on-focus` can initialize)
    await page.waitForSelector('footer');
    page.focus(showcodeSelectSel);

    domInfo = await page.evaluate((showcodeSelectSel) => {
      const selectEls = document.querySelectorAll(showcodeSelectSel);

      return {
        numOfSelects: selectEls.length
      }
    }, showcodeSelectSel);

    const { numOfSelects } = domInfo;

    if (numOfSelects > 0) {
      for (let i=0; i<numOfSelects; i++) {
        domInfo = await page.evaluate((showcodeSelectSel, i) => {
          const selectEls = document.querySelectorAll(showcodeSelectSel);
          const selectEl = selectEls[i];
          const containerEl = selectEl.closest('.showcode__container');
          const optionEls = selectEl.getElementsByTagName('option');
          
          const codeEl = containerEl.querySelector('.showcode__example--code');
          const hasCodeEl = (codeEl !== null);
          const onChangeResults = [];
            

          selectEl.focus();

          if (hasCodeEl) {
            for (let j=0; j<optionEls.length; j++) {
              const optionEl = optionEls[i];
              const value = optionEl.getAttribute('value');

              selectEl.value = value;

              onChangeResults.push({
                codeHTML: codeEl.innerHTML,
                numOfHighlights: codeEl.querySelectorAll('mark').length
              })
            }
          }

          return {
            hasCodeEl,
            onChangeResults
          }
        }, showcodeSelectSel, i);

        expect(domInfo.hasCodeEl).toBe(true);
        console.log(domInfo.onChangeResults);

      }
    }
  }

  

  for (let i=0; i<fileList.length; i++) {
    const file = fileList[i];
    
    it(`Desktop Breakpoint: Test focus states on ${fileList[i]}`, async () => {
      await testPage(fileList[i], desktopPage);
    });
    /* it(`Mobile Breakpoint: Test focus states on ${fileList[i]}`, async () => {
      await testPage(fileList[i], mobilePage);
    }); */
  }

});