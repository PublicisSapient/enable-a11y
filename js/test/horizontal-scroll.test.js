'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

// const fileList = ['audio-descriptions.php'];
const fileList = testHelpers.getPageList().filter(s => s !== 'carousel.php' && !/reflow/i.test(s));

let mobileBrowser, desktopBrowser;

describe('Test Horizontal Scrolling on all pages on Enable', () => {
  beforeAll(async () => {
    desktopBrowser = await testHelpers.getDesktopBrowser();
    mobileBrowser = await testHelpers.getMobileBrowser();
  });

  afterAll(async () => {
    await mobileBrowser.close();
    await desktopBrowser.close();
  });

  async function checkViewportWidth(page, filename) {
    const domInfo = await page.evaluate(() => {
      const root = document.scrollingElement || document.documentElement;
      const clientWidth = root.clientWidth;
      const scrollWidth = root.scrollWidth;
      const checkbox = document.querySelector('.showcode__wrap-text');
  
      return {
        doesPageHorizontallyScroll: scrollWidth > clientWidth,
        clientWidth,
        scrollWidth,
        isWrapChecked: checkbox ? checkbox.checked : 'no checkbox',
      };
    });
  
    if (domInfo.doesPageHorizontallyScroll) {
      console.log(`Horizontal scrolling on page ${filename}: clientWidth: ${domInfo.clientWidth}, scrollWidth: ${domInfo.scrollWidth}`);
    }
    expect(domInfo.doesPageHorizontallyScroll).toBe(false);
  }

  async function toggleWrapCheckbox(page) {
    // Try label click first (if the checkbox is hidden but has a label)
    const clickedViaLabel = await page.evaluate(() => {
      const cb = document.querySelector('.showcode__wrap-text');
      if (!cb) return 'no-checkbox';
      const label = cb.id && document.querySelector(`label[for="${cb.id}"]`);
      if (label) {
        label.click();
        return 'label-click';
      }
      return 'no-label';
    });
  
    if (clickedViaLabel === 'label-click') return true;
    if (clickedViaLabel === 'no-checkbox') return false;
  
    // Fall back to programmatic toggle with events (works for visually-hidden inputs)
    const toggled = await page.evaluate(() => {
      const cb = document.querySelector('.showcode__wrap-text');
      if (!cb) return false;
      cb.checked = !cb.checked;
      cb.dispatchEvent(new Event('input', { bubbles: true }));
      cb.dispatchEvent(new Event('change', { bubbles: true }));
      return true;
    });
  
    return toggled;
  }

  async function testPageWidth(filename, isDesktop) {
    const browser = isDesktop ? desktopBrowser : mobileBrowser;
    const page = await browser.newPage();
    await page.goto(`${config.BASE_URL}/${filename}`, { waitUntil: 'load' });
  
    await checkViewportWidth(page, filename);
  
    const hasCheckbox = (await page.$('.showcode__wrap-text')) !== null;
    if (hasCheckbox) {
      const ok = await toggleWrapCheckbox(page);
  
      // Wait for layout to settle before re-measuring.
      await page.evaluate(
        () => new Promise(r => requestAnimationFrame(() => requestAnimationFrame(r)))
      );
  
      if (ok) {
        await checkViewportWidth(page, filename);
      }
    }
  
    await page.close();
  }

  for (const file of fileList) {
    /* it(`Desktop Breakpoint: Test horizontal on ${file}`, async () => {
      await testPageWidth(file, true);
    }); */
    it(`Mobile Breakpoint: Test horizontal on ${file}`, async () => {
      await testPageWidth(file, false);
    });
  }
});
