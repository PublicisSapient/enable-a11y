'use strict'

import config from './test-config.js';
import enableTestHelpers from './enable-test-helpers.js';
let parser = require('parse5');


// let el = await page.evaluateHandle(() => document.activeElement);

/* const result = await page.evaluate(() => {
  return document.activeElement.outerHTML;
}); */


describe('ARIA Listbox', () => {
  beforeAll(async () => {
  });
  
  /* async function cycleThroughItems() {
    let el, listboxValues;


    // focus on the listbox button and check attributes;
    await page.waitForSelector('#exp_button');
    await page.focus('#exp_button');

    // get all the listbox possible values
    listboxValues = await page.evaluate(() => {
      const { activeElement } = document;
      const { parentNode } = activeElement;
      const listboxOptions = parentNode.querySelectorAll('[role="option"]');
      const listboxValues = [];

      for (let i=0; i<listboxOptions.length; i++) {
        listboxValues.push(listboxOptions[i].innerText.trim());
      }
 
      return listboxValues;
    });

    console.log('all values', listboxValues);

    for (let i=0; i<listboxValues.length; i++) {
      // Press down arrow and make sure new Element gets focus.
      page.keyboard.press('ArrowDown');
      // await 100ms before continuing further
      await new Promise(res => setTimeout(res, 100));


      // now, let's press enter and cycle through all the elements with the down arrow.
      el = await page.evaluate(() => {
        const { activeElement } = document;

        return {
          value: activeElement.innerText.trim()
        };
      });
      
      expect(el.value).toBe(listboxValues[i]);
      console.log('value selected:', el.value);
      
    }

    // one more down arrow should go to the first element.
    page.keyboard.press('ArrowDown');
    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));


    // now, let's press enter and cycle through all the elements with the down arrow.
    el = await page.evaluate(() => {
      const { activeElement } = document;

      return {
        value: activeElement.innerText.trim()
      };
    });
    
    expect(el.value).toBe(listboxValues[0]);
    console.log('value selected 1:', el.value);

    // one more up arrow should go to the last element.
    page.keyboard.press('ArrowUp');
    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));


    // now, let's press enter and cycle through all the elements with the down arrow.
    el = await page.evaluate(() => {
      const { activeElement } = document;

      return {
        value: activeElement.innerText.trim()
      };
    });
    
    expect(el.value).toBe(listboxValues[listboxValues.length - 1]);

    return listboxValues;
  } */
  

  it('Try keyboard tabbing and picking 2nd value with the Enter key', async () => {
    let el, buttonEl;

    await page.goto(`${config.BASE_URL}/listbox.php`);
    // focus on the listbox button and check attributes;
    await page.waitForSelector('#exp_button');
    await page.focus('#exp_button');
    el = parser.parse(await enableTestHelpers.getClonedActiveEl(page));
    
    console.log('b', el);
    console.log('first clone', el);
    expect(el.getAttribute('aria-haspopup')).toBe('listbox');
    expect(el.getAttribute('aria-expanded')).toBe('false');

    // press the space key and check if the component has aria-expanded to be true.
    page.keyboard.press('Space');
    await enableTestHelpers.pause();

    el = await enableTestHelpers.getClonedActiveEl(page);
    buttonEl = await enableTestHelpers.getClonedSelectorEl('#exp_button');

    expect(buttonEl.getAttribute('aria-expanded')).toBe('true');
    expect(el.innerText.trim()).toBe('Neptunium');
    expect(el.getAttribute('role')).toBe('option'),
    expect(el.getAttribute('aria-selected')).toBe('false');


    // Press down arrow and make sure new Element gets focus.
    page.keyboard.press('ArrowDown');
    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));

    el = await page.evaluate(() => {
      const { activeElement } = document;
      const button = document.getElementById('exp_button');

      return {
        buttonAriaExpanded: button.getAttribute('aria-expanded'),
        role: activeElement.getAttribute('role'),
        value: activeElement.innerText.trim(),
        html: activeElement.outerHTML,
        ariaSelected: activeElement.getAttribute('aria-selected')

      };
    });
    expect(el.buttonAriaExpanded).toBe('true');
    expect(el.value).toBe('Plutonium');
    expect(el.role).toBe('option'),
    expect(el.ariaSelected).toBe('false')



    // Press Enter to see if the new value gets populated in the button.
    page.keyboard.press('Enter');
    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));

    el = await page.evaluate(() => {
      const { activeElement } = document;
      let ariaExpanded = activeElement.getAttribute('aria-expanded');
      
      if (ariaExpanded === 'false' || ariaExpanded === null) {
        ariaExpanded = 'false'
      }
      return {
        html: activeElement.outerHTML,
        value: activeElement.innerHTML.trim(),
        ariaHaspopup: activeElement.getAttribute('aria-haspopup'),
        ariaExpanded
      };
    });


    expect(el.ariaHaspopup).toBe('listbox');
    expect(el.ariaExpanded).toBe('false');
    expect(el.value).toBe('Plutonium');
  });

  /* it('Try keyboard tabbing and picking 2nd value with the tab key', async () => {
    let el;

    await page.goto(`${config.BASE_URL}/listbox.php`);
    // focus on the listbox button and check attributes;
    await page.waitForSelector('#exp_button');
    await page.focus('#exp_button');

    // need page.evaluate to find aria attributes.
    el = await page.evaluate(() => {
      const { activeElement } = document;
      let ariaExpanded = activeElement.getAttribute('aria-expanded');

      if (ariaExpanded === 'false' || ariaExpanded === null) {
        ariaExpanded = 'false'
      }

      return {
        html: activeElement.outerHTML,
        ariaHaspopup: activeElement.getAttribute('aria-haspopup'),
        ariaExpanded
      };
    });

    expect(el.ariaHaspopup).toBe('listbox');
    expect(el.ariaExpanded).toBe('false');

    // press the space key and check if the component has aria-expanded to be true.
    page.keyboard.press('Space');

    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));

    el = await page.evaluate(() => {
      const { activeElement } = document;
      const button = document.getElementById('exp_button');

      return {
        buttonAriaExpanded: button.getAttribute('aria-expanded'),
        role: activeElement.getAttribute('role'),
        value: activeElement.innerText.trim(),
        html: activeElement.outerHTML,
        ariaSelected: activeElement.getAttribute('aria-selected')

      };
    });
    expect(el.buttonAriaExpanded).toBe('true');
    expect(el.value).toBe('Neptunium');
    expect(el.role).toBe('option'),
    expect(el.ariaSelected).toBe('false');


    // Press down arrow and make sure new Element gets focus.
    page.keyboard.press('ArrowDown');
    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));

    el = await page.evaluate(() => {
      const { activeElement } = document;
      const button = document.getElementById('exp_button');

      return {
        buttonAriaExpanded: button.getAttribute('aria-expanded'),
        role: activeElement.getAttribute('role'),
        value: activeElement.innerText.trim(),
        html: activeElement.outerHTML,
        ariaSelected: activeElement.getAttribute('aria-selected')

      };
    });
    expect(el.buttonAriaExpanded).toBe('true');
    expect(el.value).toBe('Plutonium');
    expect(el.role).toBe('option'),
    expect(el.ariaSelected).toBe('false')



    // Press Enter to see if the new value gets populated in the button.
    page.keyboard.press('Tab');
    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));

    el = await page.evaluate(() => {
      const { activeElement } = document;
      let ariaExpanded = activeElement.getAttribute('aria-expanded');
      
      if (ariaExpanded === 'false' || ariaExpanded === null) {
        ariaExpanded = 'false'
      }
      return {
        html: activeElement.outerHTML,
        value: activeElement.innerHTML.trim(),
        ariaHaspopup: activeElement.getAttribute('aria-haspopup'),
        ariaExpanded
      };
    });


    console.log('html', el.html);

    expect(el.ariaHaspopup).toBe('listbox');
    expect(el.ariaExpanded).toBe('false');
    expect(el.value).toBe('Plutonium');
  });

  it('Iterate through all values and click ENTER to choose value', async () => {
    let el, listboxValues;

    await page.goto(`${config.BASE_URL}/listbox.php`);

    listboxValues = await cycleThroughItems();

    // Now let's press ENTER to check if the correct value is set.
    page.keyboard.press('Enter');
    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));

    el = await page.evaluate(() => {
      const { activeElement } = document;

      return {
        value: activeElement.innerText.trim(),
        ariaHaspopup: activeElement.getAttribute('aria-haspopup')
      };
    });

    expect(el.value).toBe(listboxValues[listboxValues.length - 1]);
    expect(el.ariaHaspopup).toBe('listbox');

  });

  it('Iterate through all values and click ESCAPE to choose value', async () => {
    let el, listboxValues;

    await page.goto(`${config.BASE_URL}/listbox.php`);

    listboxValues = await cycleThroughItems();

    // Now let's press ESCAPE to check if the correct value is set.
    page.keyboard.press('Escape');

    // await 100ms before continuing further
    await new Promise(res => setTimeout(res, 100));

    el = await page.evaluate(() => {
      const { activeElement } = document;

      return {
        value: activeElement.innerText.trim(),
        ariaHaspopup: activeElement.getAttribute('aria-haspopup'),
        html: activeElement.outerHTML
      };
    });
    console.log('html', el.html);

    expect(el.value).toBe('');
    expect(el.ariaHaspopup).toBe('listbox');
  });
*/

  
});