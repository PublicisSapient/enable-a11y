'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('Animated GIF with Pause Button Page Tests', () => {
  beforeAll(async () => {
  });

  // TODO: Fix inconsistent results
  it.skip('Initial page load HTML matches snapshot', async () => {
    await page.goto(`${config.BASE_URL}/animated-gif-with-pause-button.php`);
    await testHelpers.testPageSnapshot(page);
  });

  it.todo('Test functionality');
});
