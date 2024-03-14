'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('Video Player Page Tests', () => {
  beforeAll(async () => {
  });

  // TODO: Mock the Able Player code with a random value
  it.skip('Initial page load HTML matches snapshot', async () => {
    await page.goto(`${config.BASE_URL}/video-player.php`);
    await testHelpers.testPageSnapshot(page);
  });

  it.todo('Test functionality');
});
