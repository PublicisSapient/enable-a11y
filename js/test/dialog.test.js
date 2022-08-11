'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';




describe('Dialog Tests', () => {
  beforeAll(async () => {
  });

  async function areElementsOutsideDialogSwipable() {
    let r;

    r = await page.evaluate(() => {
      const dialogEl = document.querySelector('#favDialog');
      const { body } = document;
      let r = false;
      let currentEl = dialogEl;

      do {
        const siblings = currentEl.parentNode.childNodes;
        for (let i = 0; i < siblings.length; i++) {
          const sibling = siblings[i];
          if (sibling !== currentEl && sibling.getAttribute && sibling.getAttribute('aria-hidden') !== 'true') {
            return true;
          }
        }
  
        // we then set the currentEl to be the parent node
        // and repeat (unless the currentNode is the body tag).
        currentEl = currentEl.parentNode;
      } while (currentEl !== body);

      return false;
    });

    return r;

  }
  
  it('Focus on open and close tests', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/dialog.php`);
    // focus on button that opens modal;
    await page.waitForSelector('#updateDetails');
    await page.focus('#updateDetails');

    // check to see if the modal is visible
    domInfo = await page.evaluate(() => {
      const dialogEl = document.querySelector('#favDialog');
      
      return {
        isOpen: (dialogEl.getAttribute('open') !== null)
      };
    });

    expect(domInfo.isOpen).toBe(false);



    page.keyboard.press('Space');

    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, config.KEYPRESS_FAST_TIMEOUT));

    // check to see if the close button has focus and the dialog is visible.
    domInfo = await page.evaluate(() => {
      const { activeElement } = document;
      const dialogEl = document.querySelector('#favDialog');
      
      return {
        html: activeElement.outerHTML,
        isProperClass: activeElement.classList.contains('a11y-modal__button--close'),
        isOpen: (dialogEl.getAttribute('open') !== null)
      };
    });

   
    expect(domInfo.isProperClass).toBe(true);
    expect(domInfo.isOpen).toBe(true);

    // Click close button
    page.keyboard.press('Space');

    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, config.KEYPRESS_FAST_TIMEOUT));

    // check to see if the button that opened the modal is now focused.
    domInfo = await page.evaluate(() => {
      const { activeElement } = document;
      const dialogEl = document.querySelector('#favDialog');

      return {
        isProperId: activeElement.getAttribute('id') === 'updateDetails',
        isOpen: (dialogEl.getAttribute('open') !== null)
      };
    });
    expect(domInfo.isProperId).toBe(true);
    expect(domInfo.isOpen).toBe(false);

  });

  it('Check Focus Loop', async () => {
    let domInfo, focusedNodes = [];

    await page.goto(`${config.BASE_URL}/dialog.php`);
    // focus on button that opens modal;
    await page.waitForSelector('#updateDetails');
    await page.focus('#updateDetails');
    page.keyboard.press('Space');

    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, config.KEYPRESS_FAST_TIMEOUT));

    // need page.evaluate to find aria attributes.
    domInfo = await page.evaluate(() => {
      const { activeElement } = document;
      
      return {
        html: activeElement.outerHTML,
        isProperClass: activeElement.classList.contains('a11y-modal__button--close')
      };
    });


    expect(domInfo.isProperClass).toBe(true);

    domInfo = {};

    // Lets tab through the modal and see if there is a loop.
    do {
      if (domInfo.html) {
        focusedNodes.push(domInfo.html);
      }
      page.keyboard.press('Tab');

      // await 100ms before continuing further
      await new Promise(res => setTimeout(res, config.KEYPRESS_FAST_TIMEOUT));

      // grab HTML of activeElement and make sure it is in dialog
      domInfo = await page.evaluate(() => {
        const { activeElement } = document;
        
        return {
          html: activeElement.outerHTML,
          isInsideModal: (activeElement.closest('dialog') !== null)
        };
      });

      expect(domInfo.isInsideModal).toBe(true);
    } while (!focusedNodes.includes(domInfo.html));
  });

  it('Check To Ensure Nodes Outside Dialog are hidden with aria-hidden', async () => {
    let el, r;

    await page.goto(`${config.BASE_URL}/dialog.php`);
    // focus on button that opens modal;
    await page.waitForSelector('#updateDetails');
    await page.focus('#updateDetails');


    page.keyboard.press('Space');

    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, config.KEYPRESS_FAST_TIMEOUT));
    r = await areElementsOutsideDialogSwipable();
    expect(r).toBe(false);

    page.keyboard.press('Space');
    await new Promise(res => setTimeout(res, config.KEYPRESS_FAST_TIMEOUT));
    r = await areElementsOutsideDialogSwipable();
    expect(r).toBe(true);
  });

  it('Ensure dialog has proper label and description', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/dialog.php`);
    // focus on button that opens modal;
    await page.waitForSelector('#updateDetails');
    await page.focus('#updateDetails');

    // Ensure dialog has aria-labelledby and aria-describedby
    domInfo = await page.evaluate(() => {
      const dialog = document.querySelector('#favDialog');
      const ariaLabelledby = dialog.getAttribute('aria-labelledby');
      const ariaDescribedby = dialog.getAttribute('aria-describedby');
      const labelEl = document.getElementById(ariaLabelledby);
      const descEl = document.getElementById(ariaDescribedby);
      
      return {
        label: labelEl.innerText,
        desc: descEl.innerText
      };
    });

    console.log('info', domInfo.label, domInfo.desc);

    expect(domInfo.label.trim()).not.toBe('');
    expect(domInfo.desc.trim()).not.toBe('');

  });
  
});