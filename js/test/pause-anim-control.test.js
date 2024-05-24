'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('Pause Anim Control Page Tests', () => {
  beforeAll(async () => {
  });

  // TODO: Mock the Able Player code with a random value
  it.skip('Initial page load HTML matches snapshot', async () => {
    await page.goto(`${config.BASE_URL}/pause-anim-control.php`);
    await testHelpers.testPageSnapshot(page);
  });

  it.todo('Test functionality');
});
