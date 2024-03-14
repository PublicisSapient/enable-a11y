'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('Hero Image Text Resize Page Tests', () => {
  beforeAll(async () => {
  });

  it('Initial page load HTML matches snapshot', async () => {
    await page.goto(`${config.BASE_URL}/hero-image-text-resize.php`);
    await testHelpers.testPageSnapshot(page);
  });

  it.todo('Test functionality');
});
