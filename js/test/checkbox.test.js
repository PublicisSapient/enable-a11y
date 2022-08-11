'use strict'

import e from 'express';
import config from './test-config.js';
import testHelpers from './test-helpers.js';




describe('ARIA Checkbox Tests', () => {
  beforeAll(async () => {
  });

  async function getCheckboxValue(el) {
    return await page.evaluate(() => {
      const checkboxEl = document.querySelector('#example-role-checkbox [role="checkbox"]');
      let r;

      return checkboxEl.getAttribute('aria-checked');
    });
  }

  it('See if checkbox is keyboard accessible', async () => {
    let ariaChecked;

    await page.goto(`${config.BASE_URL}/checkbox.php`);

    // wait until all content loads
    await page.waitForSelector('#example-role-checkbox');
    await page.focus('#example-role-checkbox [role="checkbox"]')

    // check to see if checked by default
    ariaChecked = await getCheckboxValue();
    expect(ariaChecked).toBe('true');

    // press space and check if it's unchecked.
    await page.keyboard.press('Space');
    await new Promise(res => setTimeout(res, config.KEYPRESS_FAST_TIMEOUT));
    ariaChecked = await getCheckboxValue();
    expect(ariaChecked).toBe('false')

    // press space again and check if it's unchecked.
    await page.keyboard.press('Space');
    await new Promise(res => setTimeout(res, config.KEYPRESS_FAST_TIMEOUT));
    ariaChecked = await getCheckboxValue();
    expect(ariaChecked).toBe('true')
  });

  it('Ensure checkbox has proper label', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/checkbox.php`);

    // wait until all content loads
    await page.waitForSelector('#example-role-checkbox');
    domInfo = await page.evaluate(() => {
      const checkboxEl = document.querySelector('#example-role-checkbox [role="checkbox"]');
      let ariaLabel;

      if (checkboxEl) {
        const ariaLabelledby = checkboxEl.getAttribute('aria-labelledby');
        const ariaLabelledByEl = document.getElementById(ariaLabelledby);
                
        if (ariaLabelledByEl !== null) {
          ariaLabel = ariaLabelledByEl.innerText;
        } else {
          ariaLabel = checkboxEl.getAttribute('aria-label');
        }
      } else {
        ariaLabel = '';
      }
      
      return {
        ariaLabel: ariaLabel.trim()
      }
    });

    expect(domInfo.ariaLabel).not.toBe('');

  });

  it('Ensure checkbox ::after element that has content set (i.e. visible)', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/checkbox.php`);

    // wait until all content loads
    await page.waitForSelector('#example-role-checkbox');
    domInfo = await page.evaluate(() => {
      const checkboxEl = document.querySelector('#example-role-checkbox [role="checkbox"]');
      
      const afterStyle = window.getComputedStyle(checkboxEl, '::after');
      const content = afterStyle.content;
      
      return {
        hasContent: (content !== null) && (typeof(content) === 'string') && (content.trim() !== '')
      }
    });

    expect(domInfo.hasContent).toBe(true);

  });

});
