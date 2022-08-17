'use strict'

import config from './test-config.js';

describe('Styled Elements Tests', () => {
  
  it('Detect if there are ::before rules on del tags', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/exposing-style-info-to-screen-readers.php`);

    // The area of the page that has the product tile
    await page.waitForSelector('#example2');

   // check the DOM to see if the visually hidden CSS generated content is there.    
    domInfo = await page.evaluate(() => {
      const delEls = document.querySelectorAll('#example2 del');
      let hasMissingContent = false;

      for (let i=0; i<delEls.length; i++) {
        const style = window.getComputedStyle(delEls[i], '::before');

        if (style.content !== "\"Old price: \"") {
          hasMissingContent = true;
          break;
        }
      }

      return {
        hasMissingContent
      };
    });

    expect(domInfo.hasMissingContent).toBe(false);
  });

  it('Detect if there are ::before rules on mark tags in the highlight example', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/exposing-style-info-to-screen-readers.php`);

    // The area of the page that has the highlighted code
    await page.waitForSelector('#highlight-example');

    // check the DOM to see if the visually hidden CSS generated content is there.    
    domInfo = await page.evaluate(() => {
      const markEls = document.querySelectorAll('#highlight-example mark');
      let hasMissingContent = false;

      for (let i=0; i<markEls.length; i++) {
        const beforeStyle = window.getComputedStyle(markEls[i], '::before');
        const afterStyle = window.getComputedStyle(markEls[i], '::after');

        if (beforeStyle.content === "\"Start of highlighted code.\"" && afterStyle.content === "\"End of highlighted code.\"") {
          hasMissingContent = true;
          break;
        }
      }

      return {
        hasMissingContent
      };
    });

    expect(domInfo.hasMissingContent).toBe(true);
  });

  

});
