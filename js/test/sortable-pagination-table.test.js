'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('Sortable Pagination Table Page Tests', () => {
  beforeAll(async () => {
  });

  // TODO: Uncomment this unit test once the JS error of "Cannot read properties of null (reading 'innerHTML') has been fixed on the page"
  it.skip('Initial page load HTML matches snapshot', async () => {
    await page.goto(`${config.BASE_URL}/sortable-pagination-table.php`);
    await testHelpers.testPageSnapshot(page);
  });

  it.todo('Test functionality');
});
