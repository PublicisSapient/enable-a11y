'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('Bottom Fixed Navigation Page Tests', () => {
  beforeAll(async () => {
  });

  it('Initial page load HTML matches snapshot', async () => {
    await page.goto(`${config.BASE_URL}/bottom-fixed-navigation.php`);
    await testHelpers.testPageSnapshot(page);
  });

  it.todo('Test functionality');
});
