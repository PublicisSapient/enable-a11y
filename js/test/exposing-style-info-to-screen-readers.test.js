'use strict'

import config from './test-config.js';

describe('Styled Elements Tests', () => {
  it('Detect if there are sr-only content on del and ins tags for visually hidden text example', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/exposing-style-info-to-screen-readers.php`);

    // The area of the page that has the product tile
    await page.waitForSelector('#sr-only-text-example');

   // check the DOM to see if the visually hidden CSS generated content is there.    
    domInfo = await page.evaluate(() => {
      const delEls = document.querySelectorAll('#sr-only-text-example del');
      const insEls = document.querySelectorAll('#sr-only-text-example ins');
      let hasMissingDelContent = false;
      let hasMissingInsContent = false;
      

      for (let i=0; i<delEls.length; i++) {
        const firstElementChild = delEls[i].firstElementChild;

        if (!firstElementChild.classList.contains('sr-only')) {
          hasMissingDelContent = true;
        }
      }

      for (let i=0; i<insEls.length; i++) {
        const firstElementChild = insEls[i].firstElementChild;

        if (!firstElementChild.classList.contains('sr-only')) {
          hasMissingDelContent = true;
        }
      }
      return {
        numDelTests: delEls.length,
        numInsTests: insEls.length,
        hasMissingDelContent,
        hasMissingInsContent
      };
    });

    expect(domInfo.numDelTests).toBeGreaterThan(0);
    expect(domInfo.numInsTests).toBeGreaterThan(0);
    expect(domInfo.hasMissingDelContent).toBe(false);
    expect(domInfo.hasMissingInsContent).toBe(false);
  });
  
  it('Detect if there are ::before rules on del tags for CSS content example', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/exposing-style-info-to-screen-readers.php`);

    // The area of the page that has the product tile
    await page.waitForSelector('#css-generated-content-example');

   // check the DOM to see if the visually hidden CSS generated content is there.    
    domInfo = await page.evaluate(() => {
      const delEls = document.querySelectorAll('#css-generated-content-example del');
      let hasMissingContent = false;

      for (let i=0; i<delEls.length; i++) {
        const style = window.getComputedStyle(delEls[i], '::before');

        if (style.content !== "\"Old price: \"") {
          hasMissingContent = true;
          break;
        }
      }

      return {
        numTests: delEls.length,
        hasMissingContent
      };
    });

    expect(domInfo.numTests).toBeGreaterThan(0);
    expect(domInfo.hasMissingContent).toBe(false);
  });

  it('Detect if there are sr-only content on mark tags in the highlight example', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/exposing-style-info-to-screen-readers.php`);

    // The area of the page that has the highlighted code
    await page.waitForSelector('#highlight-example');

    // check the DOM to see if the visually hidden CSS generated content is there.    
    domInfo = await page.evaluate(() => {
      const markEls = document.querySelectorAll('#highlight-example mark');
      let hasMissingBeginningContent = false;
      let hasMissingEndContent = false;

      for (let i=0; i<markEls.length; i++) {
        const { firstElementChild, lastElementChild } = markEls[i];

        if (!firstElementChild.classList.contains('sr-only')) {
          hasMissingBeginningContent = true;
        }

        if (!lastElementChild.classList.contains('sr-only')) {
          hasMissingEndContent = true;
        }
      }

      return {
        numTests: markEls.length,
        hasMissingBeginningContent,
        hasMissingEndContent
      };
    });

    expect(domInfo.numTests).toBeGreaterThan(0);
    expect(domInfo.hasMissingBeginningContent).toBe(false);
    expect(domInfo.hasMissingEndContent).toBe(false);
  });

  

});
