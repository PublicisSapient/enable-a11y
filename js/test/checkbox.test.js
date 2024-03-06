'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';




describe('ARIA Checkbox Tests', () => {
  beforeAll(async () => {
  });

  // This is a function used by the tests brlow to grab the aria-checked value
  // of the nth ARIA checkbox on the page
  async function getCheckboxValue(n) {
    return await page.evaluate((n) => {
      const checkboxEls = document.querySelectorAll('[role="checkbox"]');
      const checkboxEl = checkboxEls[n];
      let r;

      return checkboxEl.getAttribute('aria-checked');
    }, n);
  }

  // Test #1
  it('See if all ARIA checkboxes on page are keyboard accessible', async () => {
    let ariaChecked, domInfo;

    await page.goto(`${config.BASE_URL}/checkbox.php`);

    
    // wait until all content loads
    await page.waitForSelector('#example-role-checkbox');

    const checkboxesInPage = Array.from(await page.$$('[role="checkbox"]')).length;
    expect(checkboxesInPage).toBeGreaterThan(0);

    for (let i=0; i <checkboxesInPage; i++) {
      //focus the checkbox 
      domInfo = await page.evaluate((i) => {
        const checkboxEls = document.querySelectorAll('[role="checkbox"]');
        const checkboxEl = checkboxEls[i];
        const ariaLabelledby = checkboxEl.getAttribute('aria-labelledby');
        const ariaLabel = checkboxEl.getAttribute('aria-label');
        const ariaChecked = checkboxEl.getAttribute('aria-checked')
        let label = null;

        if (ariaLabelledby !== null) {
          const ariaLabelledbyEl = document.getElementById(ariaLabelledby);

          if (ariaLabelledbyEl !== null) {
            label = ariaLabelledbyEl.innerText.trim();
          }
        } else {
          label = ariaLabel.innerText.trim();
        }

        checkboxEl.focus();

        return {
          isTabbable: checkboxEl.getAttribute('tabIndex') === '0',
          isFocused: document.activeElement === checkboxEl,
          hasLabel: label !== null && label !== '',
          isAriaCheckedSet: ariaChecked === 'true' || ariaChecked == 'false',
          ariaChecked
        }
      }, i);
      expect(domInfo.isTabbable).toBe(true);
      expect(domInfo.isFocused).toBe(true);
      expect(domInfo.hasLabel).toBe(true);
      expect(domInfo.isAriaCheckedSet).toBe(true);

      const origAriaChecked = domInfo.ariaChecked;
      const notOrigAriaChecked = (domInfo.ariaChecked === 'true' ? 'false' : 'true');

  
      // press space and check if it's unchecked.
      await page.keyboard.press('Space');
      
      ariaChecked = await getCheckboxValue(i);
      expect(ariaChecked).toBe(notOrigAriaChecked);
  
      // press space again and check if it's unchecked.
      await page.keyboard.press('Space');
      
      ariaChecked = await getCheckboxValue(i);
      expect(ariaChecked).toBe(origAriaChecked);
    }
    
    
  });

  // Test #2
  it('Ensure checkbox has proper label', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/checkbox.php`);

    // wait until all content loads
    await page.waitForSelector('#example-role-checkbox');

    const checkboxesInPage = Array.from(await page.$$('[role="checkbox"]')).length;
    expect(checkboxesInPage).toBeGreaterThan(0);

    for (let i=0; i <checkboxesInPage; i++) {
    
      domInfo = await page.evaluate((i) => {
        const checkboxEl = document.querySelectorAll('[role="checkbox"]')[i];
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
      }, i);

      expect(domInfo.ariaLabel).not.toBe('');
    }

  });

  // Test #3
  it('Ensure checkbox ::after element that has content set (i.e. visible)', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/checkbox.php`);

    // wait until all content loads
    await page.waitForSelector('#example-role-checkbox');

    const checkboxesInPage = Array.from(await page.$$('[role="checkbox"]')).length;
    expect(checkboxesInPage).toBeGreaterThan(0);

    for (let i=0; i <checkboxesInPage; i++) {
      domInfo = await page.evaluate((i) => {
        const checkboxEl = document.querySelectorAll('[role="checkbox"]')[i];
        
        const afterStyle = window.getComputedStyle(checkboxEl, '::after');
        const content = afterStyle.content;
        
        return {
          hasContent: (content !== null) && (typeof(content) === 'string') && (content.trim() !== '')
        }
      }, i);

      expect(domInfo.hasContent).toBe(true);
    }
  });
});
