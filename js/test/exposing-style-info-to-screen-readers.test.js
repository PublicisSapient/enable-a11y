'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';




describe('Styled Elements Tests', () => {
  beforeAll(async () => {
  });

  it('Detect if there are ::before rules on del tags', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/exposing-style-info-to-screen-readers.php`);

    // focus on button that opens modal;
    await page.waitForSelector('#example2');

    // check to see if the modal is visible
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

    // focus on button that opens modal;
    await page.waitForSelector('#highlight-example');

    // check to see if the modal is visible
    domInfo = await page.evaluate(() => {
      const markEls = document.querySelectorAll('#highlight-example mark');
      let hasMissingContent = false;

      for (let i=0; i<markEls.length; i++) {
        const beforeStyle = window.getComputedStyle(markEls[i], '::before');
        const afterStyle = window.getComputedStyle(markEls[i], '::after');

        if (beforeStyle.content === "\"Start of highlighted code2.\"" && afterStyle.content === "\"End of highlighted code3.\"") {
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

  

});
