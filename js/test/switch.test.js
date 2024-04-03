'use strict'

import config from './test-config.js';

describe('ARIA Switch Tests', () => {
  // This is a function used by the tests below to grab the aria-checked value
  // of the nth ARIA switch on the page
  async function getSwitchValue(n) {
    return await page.evaluate((n) => {
      const switchEls = document.querySelectorAll('[role="switch"]');
      const switchEl = switchEls[n];

      return switchEl.getAttribute('aria-checked');
    }, n);
  } // end getSwitchValue()
   

  // Test #1
  it('Check if all ARIA switches on page are keyboard and screen reader accessible', async () => {
    let ariaChecked, domInfo;

    await page.goto(`${config.BASE_URL}/switch.php`);

    // wait until all content loads
    await page.waitForSelector('#example1');

    const switchesInPage = Array.from(await page.$$('[role="switch"]')).length;
    expect(switchesInPage).toBeGreaterThan(0);
    
    for (let i=0; i <switchesInPage; i++) {
      //focus the switch 
      domInfo = await page.evaluate((i) => {
        const switchEls = document.querySelectorAll('[role="switch"]');
        const switchEl = switchEls[i];
        const ariaLabelledby = switchEl.getAttribute('aria-labelledby');
        const ariaLabel = switchEl.getAttribute('aria-label');
        const ariaChecked = switchEl.getAttribute('aria-checked');
        const { id } = switchEl;
        let label = null;
        const labelTag = document.querySelector(`label[for="${id}"`);

        if (ariaLabelledby !== null) {
          const ariaLabelledbyEl = document.getElementById(ariaLabelledby);

          if (ariaLabelledbyEl !== null) {
            label = ariaLabelledbyEl.innerText.trim();
          }
        } else if (ariaLabel !== null) {
          label = ariaLabel.trim();
        } else if (labelTag !== null) {
          label = labelTag.innerText.trim();
        }

        switchEl.focus();

        return {
          isTabbable: document.activeElement === switchEl,
          hasLabel: label !== null && label !== '',
          isAriaCheckedSet: ariaChecked === 'true' || ariaChecked == 'false',
          ariaChecked
        }
      }, i);

      expect(domInfo.isTabbable).toBe(true);
      expect(domInfo.hasLabel).toBe(true);
      expect(domInfo.isAriaCheckedSet).toBe(true);

      const origAriaChecked = domInfo.ariaChecked;
      const notOrigAriaChecked = (domInfo.ariaChecked === 'true' ? 'false' : 'true');

  
      // press space and check if it's unchecked.
      await page.keyboard.press('Space');
      
      ariaChecked = await getSwitchValue(i);
      expect(ariaChecked).toBe(notOrigAriaChecked);
  
      // press space again and check if it's unchecked.
      await page.keyboard.press('Space');
      
      ariaChecked = await getSwitchValue(i);
      expect(ariaChecked).toBe(origAriaChecked);
    }
  });
});