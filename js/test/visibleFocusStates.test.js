'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';
import fs from 'fs';

const fileList = testHelpers.getPageList();
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

    await page.goto(`${config.BASE_URL}/${filename}`);
    
    // Test on initial load.
    
    // Step 1: Wait for whole page to load (this is so scripts
    // like `enable-visible-on-focus` can initialize)
    await page.waitForSelector('footer');

    do {
      
      await page.keyboard.press('Tab');

      //await testHelpers.fastPause();
      domInfo = await page.evaluate(() => {
        const { activeElement } = document;

        // grab outline CSS style property
        const style = window.getComputedStyle(activeElement, null);
        let { outline, outlineColor, outlineWidth, outlineStyle } = style;
        let hasFocusRing = (outlineStyle !== 'none' && parseInt(outlineWidth) !== 0);
        let checkedPseudoEl = false;

        const isYoutubeIframe = (activeElement.nodeName === 'IFRAME' && activeElement.src.indexOf('https://www.youtube.com/') === 0);

        const isRangeInput = (activeElement.nodeName === 'INPUT' && activeElement.getAttribute('type') === 'range');
        
        if (isRangeInput && !hasFocusRing) {
          let rangeThumbSlideStyle = window.getComputedStyle(activeElement, '::-webkit-slider-thumb');
          checkedPseudoEl = true;
          outline = rangeThumbSlideStyle.outline;
          outlineColor = rangeThumbSlideStyle.outlineColor;
          outlineWidth = rangeThumbSlideStyle.outlineWidth;
          outlineStyle = rangeThumbSlideStyle.outlineStyle;
          hasFocusRing = (outlineStyle !== 'none' && parseInt(outlineWidth) !== 0);
        }

        return {
          html: activeElement.outerHTML,
          hasFocusRing,
          outline,
          outlineColor,
          outlineWidth,
          outlineStyle,
          isEnableSkipLink: activeElement.classList.contains('enable-mobile-visible-on-focus'),
          isBody: activeElement === document.body,
          isYoutubeIframe,
          isRangeInput,
          checkedPseudoEl
        }

      });

      //console.log(`checking `, domInfo.html, domInfo.parentClass);
      // Step 4: Do Tests ... but not on enable skip link (we'll handle that
      // someplace else)
      if (!domInfo.isEnableSkipLink && !domInfo.isBody && !domInfo.isYoutubeIframe) {
        
        if (!domInfo.hasFocusRing) {
          console.log('Bad focus on: ', domInfo.html);
          console.log('Checked Pseudo element', domInfo.checkedPseudoEl);
          console.log(`outlineColor: ${domInfo.outlineColor}\noutline: ${domInfo.outline}\noutlineWidth: ${domInfo.outlineWidth}\noutlineStyle: ${domInfo.outlineStyle}`);
        }

        expect(domInfo.hasFocusRing).toBe(true);
      } 
    } while (!domInfo.isBody);
  }

  

  for (let i=0; i<fileList.length; i++) {
    const file = fileList[i];
    it(`Desktop Breakpoint: Test focus states on ${fileList[i]}`, async () => {
      await testPage(fileList[i], desktopPage);
    });
    it(`Mobile Breakpoint: Test focus states on ${fileList[i]}`, async () => {
      await testPage(fileList[i], mobilePage);
    });
  }

});