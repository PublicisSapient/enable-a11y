'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('Code Quality Page Tests', () => {
  beforeAll(async () => {
  });

  it('Initial page load HTML matches snapshot', async () => {
    await page.goto(`${config.BASE_URL}/code-quality.php`);
    await testHelpers.testPageSnapshot(page);
  });
});
