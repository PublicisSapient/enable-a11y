'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('FAQ Page Tests', () => {
  beforeAll(async () => {
  });

  it('Initial page load HTML matches snapshot', async () => {
    await page.goto(`${config.BASE_URL}/faq.php`);
    await testHelpers.testPageSnapshot(page);
  });
});
