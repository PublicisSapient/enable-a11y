'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = testHelpers.getPageList();
let mobileBrowser, desktopBrowser;

// Selectors to ignore during reflow checks (developers can add more as needed)
const IGNORE_REFLOW_SELECTORS = [

  // global ignore data attribute
  '[data-ignore-reflow="true"]', 
  
  // general elements to ignore according to the guidelines.
  'svg',
  '.sticky-table__container',
  '.showcode__example--code',

  // components with offscreen text
  '.enable-mobile-visible-on-focus__container',
  '.able-offscreen',
  '[data-able-player]',

  // components that we have worked around with
  // arrow buttons (e.g. carousels)
  '.enable-carousel__example',
  '.glider-contain',
  '.product-tile-carousel__example'
];

/**
 * WCAG 2.1 / 2.2 - 1.4.10 Reflow
 * Verify that pages do not require horizontal scrolling for text/content at 320 CSS px width.
 * Developers can opt-out specific regions by adding data-ignore-reflow="true" on a container.
 */
describe('WCAG 1.4.10 Reflow - No horizontal scrolling for content', () => {
  beforeAll(async () => {
    desktopBrowser = await testHelpers.getDesktopBrowser();
    mobileBrowser = await testHelpers.getMobileBrowser();
  });

  afterAll(async () => {
    await mobileBrowser.close();
    await desktopBrowser.close();
  });

  async function testReflow(filename, isDesktop) {
    const page = isDesktop
      ? await desktopBrowser.newPage()
      : await mobileBrowser.newPage();

    // Load the page
    await page.goto(`${config.BASE_URL}/${filename}`, {
      waitUntil: 'domcontentloaded',
    });

    // Force a 320px viewport width to simulate 400% zoom on common desktops
    // and minimum viewport for mobile. Height is generous to reduce vertical scrolling effects.
    // await page.setViewport({ width: 320, height: 1400 });

    const reflowInfo = await page.evaluate((ignoreSelectors) => {
      const scrollingEl = document.scrollingElement || document.documentElement;
      const viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

      const isIgnored = (el) => !!(el && ignoreSelectors.some((sel) => el.closest(sel)));

      const isHidden = (el) => {
        const cs = window.getComputedStyle(el);
        if (cs.display === 'none' || cs.visibility === 'hidden' || cs.visibility === 'collapse') return true;
        if (el.getClientRects().length === 0) return true;
        return false;
      };

      const offenders = [];
      const pushOffender = (el, reason, extra) => {
        // Avoid object spread to prevent Babel injecting helpers that are undefined in page context
        const html = el && el.outerHTML ? el.outerHTML.slice(0, 300) : String(el);
        const obj = { reason: reason, html: html };
        if (extra) {
          for (const key in extra) {
            if (Object.prototype.hasOwnProperty.call(extra, key)) {
              obj[key] = extra[key];
            }
          }
        }
        offenders.push(obj);
      };

      // 1) Find horizontally scrollable containers (overflow-x causes scrolling)
      const allEls = Array.from(document.body.querySelectorAll('*'));
      for (const el of allEls) {
        if (isIgnored(el) || isHidden(el)) continue;
        const cs = window.getComputedStyle(el);
        const overflowX = cs.overflowX;
        // Elements with scrollable overflow-x
        if ((overflowX === 'auto' || overflowX === 'scroll') && (el.scrollWidth - el.clientWidth) > 1) {
          pushOffender(el, 'scrollable-x', {
            scrollWidth: el.scrollWidth,
            clientWidth: el.clientWidth,
            overflowX,
          });
        }
      }

      // 2) Find elements that render beyond the viewport horizontally (may cause page-level horizontal scroll)
      for (const el of allEls) {
        if (isIgnored(el) || isHidden(el)) continue;
        const rect = el.getBoundingClientRect();
        if ((rect.width > 0 || rect.height > 0) && (rect.right > viewportWidth + 1 || rect.left < -1)) {
          pushOffender(el, 'out-of-viewport-x', {
            rect: { left: rect.left, right: rect.right, width: rect.width },
            viewportWidth,
          });
        }
      }

      // 3) Page-level horizontal scrollbar (root overflow)
      const pageScrollOverflow = offenders.length > 0 && (scrollingEl.scrollWidth - scrollingEl.clientWidth) > 1;

      return {
        viewportWidth,
        pageScrollOverflow,
        offenders,
        pass: !pageScrollOverflow && offenders.length === 0,
      };
    }, IGNORE_REFLOW_SELECTORS);

    if (!reflowInfo.pass) {
      console.log(
        `Reflow failure for ${filename} at viewport=${reflowInfo.viewportWidth}\n` +
          `pageScrollOverflow: ${reflowInfo.pageScrollOverflow}\n` +
          `Offenders (showing up to first 20):\n` +
          reflowInfo.offenders.slice(0, 20).map((o, i) => `#${i + 1} ${o.reason}: ${JSON.stringify(o)}`).join('\n')
      );
    }

    expect(reflowInfo.pass).toBe(true);

    await page.close();
  }

  // Run across all known pages at both desktop and mobile browser contexts
  for (let i = 0; i < fileList.length; i++) {
    const file = fileList[i];
    if (file !== 'reflow__example-of-issue.php') { 
      it(`Desktop Breakpoint: Reflow (no horizontal scroll) on ${file}`, async () => {
        await testReflow(file, true);
      });
      it(`Mobile Breakpoint: Reflow (no horizontal scroll) on ${file}`, async () => {
        await testReflow(file, false);
      });
    }
  }
});
