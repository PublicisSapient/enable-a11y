'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = testHelpers.getPageList();

describe('Showcode highlight markup - sr-only wrappers present around highlighted code', () => {
  beforeAll(async () => {});
  afterAll(async () => {});

  async function testPage(filename) {
    await page.goto(`${config.BASE_URL}/${filename}`, { waitUntil: 'domcontentloaded' });
    await page.waitForSelector('footer');

    const domInfo = await page.evaluate(() => {
      const marks = Array.from(document.querySelectorAll('mark.showcode__highlight'));
      let hasMissingBeginningContent = false;
      let hasMissingEndContent = false;
      const offenders = [];

      for (let i = 0; i < marks.length; i++) {
        const m = marks[i];
        const { firstElementChild, lastElementChild } = m;
        const badBegin = !firstElementChild || !firstElementChild.classList.contains('sr-only');
        const badEnd = !lastElementChild || !lastElementChild.classList.contains('sr-only');
        if (badBegin) {
          hasMissingBeginningContent = true;
        }
        if (badEnd) {
          hasMissingEndContent = true;
        }
        if (badBegin || badEnd) {
          offenders.push({
            html: m.outerHTML.slice(0, 300),
            badBegin,
            badEnd,
          });
        }
      }

      return {
        numTests: marks.length,
        hasMissingBeginningContent,
        hasMissingEndContent,
        offenders,
      };
    });

    if (domInfo.numTests > 0 && (domInfo.hasMissingBeginningContent || domInfo.hasMissingEndContent)) {
      console.log(
        `Showcode highlight issues on ${filename}:\n` +
          domInfo.offenders.slice(0, 20).map((o, i) => `#${i + 1} badBegin=${o.badBegin} badEnd=${o.badEnd} html=${JSON.stringify(o.html)}`).join('\n')
      );
    }

    // Only enforce correctness when highlights are present on the page.
    if (domInfo.numTests > 0) {
      expect(domInfo.hasMissingBeginningContent).toBe(false);
      expect(domInfo.hasMissingEndContent).toBe(false);
    }
  }

  for (let i = 0; i < fileList.length; i++) {
    const file = fileList[i];
    it(`Showcode sr-only wrappers on ${file}`, async () => {
      await testPage(file);
    });
  }
});
