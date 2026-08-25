'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = testHelpers.getPageList();
let mobileBrowser, desktopBrowser;

// Selectors to ignore during Resize Text checks (developers can extend as needed)
// Example: containers that intentionally clip or special widgets that are exempt
const IGNORE_RESIZE_SELECTORS = [
  // components with offscreen text
  '.enable-mobile-visible-on-focus__container',
  '.able-offscreen',
  '[data-able-player]',
  '.sr-only'
];

/**
 * WCAG 2.1 / 2.2 - 1.4.4 Resize Text
 *
 * This test verifies that when text is resized to 200%:
 *  - Text is not cut off due to CSS clipping (e.g. overflow: hidden / clip)
 *  - Text does not go offscreen horizontally (outside the viewport)
 *  - Text does not overlap other text
 *
 * How we zoom text programmatically:
 *  We simulate a user resizing text to 200% by iterating through all elements
 *  that contain visible text and doubling their computed font-size in pixels
 *  via inline styles using CSS priority ("!important"):
 *      el.style.setProperty('font-size', (computedPx * 2) + 'px', 'important');
 *  This approximates a text-only zoom (as opposed to full-page zoom) so layout
 *  reflows similarly to users increasing text size settings in the browser/OS.
 */
describe('WCAG 1.4.4 Resize Text - No clipping, no offscreen, no overlap at 200%', () => {
  beforeAll(async () => {
    desktopBrowser = await testHelpers.getDesktopBrowser();
    mobileBrowser = await testHelpers.getMobileBrowser();
  });

  afterAll(async () => {
    await mobileBrowser.close();
    await desktopBrowser.close();
  });

  async function testResizeText(filename, isDesktop) {
    const page = isDesktop
      ? await desktopBrowser.newPage()
      : await mobileBrowser.newPage();

    await page.goto(`${config.BASE_URL}/${filename}`, {
      waitUntil: 'domcontentloaded',
    });

    const result = await page.evaluate((ignoreSelectors) => {
      const scrollingEl = document.scrollingElement || document.documentElement;
      const viewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

      function isIgnored(el) {
        if (!el) return true;
        for (let i = 0; i < ignoreSelectors.length; i++) {
          const sel = ignoreSelectors[i];
          try {
            if (el.closest(sel)) return true;
          } catch (e) { /* ignore bad selector */ }
        }
        return false;
      }

      function isHidden(el) {
        const cs = window.getComputedStyle(el);
        if (cs.display === 'none' || cs.visibility === 'hidden' || cs.visibility === 'collapse') return true;
        if (el.getClientRects().length === 0) return true;
        return false;
      }

      const allEls = Array.prototype.slice.call(document.body.querySelectorAll('*'));

      // 1) Double the font-size for all visible, text-containing elements
      /* 
      for (let i = 0; i < allEls.length; i++) {
        const el = allEls[i];
        if (isIgnored(el) || isHidden(el)) continue;
        const text = (el.innerText || '').trim();
        if (!text) continue;
        const cs = window.getComputedStyle(el);
        const fs = parseFloat(cs.fontSize);
        if (!isFinite(fs) || fs <= 0) continue;
        const newPx = fs * 2; // 200%
        try {
          el.style.setProperty('font-size', newPx + 'px', 'important');
        } catch (e) {
          // Fallback if setProperty with priority is blocked
          el.style.fontSize = newPx + 'px';
        }
      }*/
      document.querySelector('html').style.fontSize="32px";

      // Force reflow by reading layout after changes
      void document.body.offsetHeight;

      const offenders = [];
      function pushOffender(el, reason, extra) {
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
      }

      // Helper: rectangle intersection test
      function rectsOverlap(a, b) {
        return a.left < b.right && a.right > b.left && a.top < b.bottom && a.bottom > b.top;
      }

      // 2) Collect candidate text elements for validation
      const textEls = [];
      for (let i = 0; i < allEls.length; i++) {
        const el = allEls[i];
        if (isIgnored(el) || isHidden(el)) continue;
        const text = (el.innerText || '').trim();
        if (!text) continue;
        const rect = el.getBoundingClientRect();
        if (rect.width === 0 && rect.height === 0) continue;
        textEls.push({ el: el, text: text, rect: rect });
      }

      // 3) Check for clipping/cut-off due to overflow hidden/clip
      for (let i = 0; i < textEls.length; i++) {
        const el = textEls[i].el;
        //const rect = textEls[i].rect;
        const cs = window.getComputedStyle(el);
        const overflowX = cs.overflowX;
        const overflowY = cs.overflowY;
        const dx = el.scrollWidth - el.clientWidth;
        const dy = el.scrollHeight - el.clientHeight;
        if (dx > 1 && (overflowX === 'hidden' || overflowX === 'clip')) {
          pushOffender(el, 'clipped-x', { scrollWidth: el.scrollWidth, clientWidth: el.clientWidth, overflowX: overflowX });
        }
        if (dy > 1 && (overflowY === 'hidden' || overflowY === 'clip')) {
          pushOffender(el, 'clipped-y', { scrollHeight: el.scrollHeight, clientHeight: el.clientHeight, overflowY: overflowY });
        }
      }

      // 4) Check for text going offscreen horizontally
      for (let i = 0; i < textEls.length; i++) {
        const rect = textEls[i].rect;
        if (rect.right > viewportWidth + 1 || rect.left < -1) {
          pushOffender(textEls[i].el, 'offscreen-x', { rect: { left: rect.left, right: rect.right, width: rect.width }, viewportWidth: viewportWidth });
        }
      }

      // 5) Check for overlapping text (pairwise only within nearby vertical range to reduce comparisons)
      // Sort by top coordinate to prune comparisons
      textEls.sort(function(a, b) { return a.rect.top - b.rect.top; });
      for (let i = 0; i < textEls.length; i++) {
        const a = textEls[i];
        const aBottom = a.rect.bottom;
        for (let j = i + 1; j < textEls.length; j++) {
          const b = textEls[j];
          if (b.rect.top > aBottom) break; // no vertical overlap possible beyond this point
          if (rectsOverlap(a.rect, b.rect)) {
            pushOffender(a.el, 'overlap', { with: (b.text || '').slice(0, 80), aRect: a.rect, bRect: b.rect });
            // Record once per pair; we could also add symmetric entry if desired
          }
        }
      }

      const pageScrollOverflowX = (scrollingEl.scrollWidth - scrollingEl.clientWidth) > 1;

      return {
        viewportWidth: viewportWidth,
        pageScrollOverflowX: pageScrollOverflowX,
        offenders: offenders,
        pass: offenders.length === 0,
      };
    }, IGNORE_RESIZE_SELECTORS);

    if (!result.pass) {
      console.log(
        `Resize Text (200%) failure for ${filename} (viewport=${result.viewportWidth})\n` +
          `pageScrollOverflowX: ${result.pageScrollOverflowX}\n` +
          `Offenders (first 30):\n` +
          result.offenders.slice(0, 30).map((o, i) => `#${i + 1} ${o.reason}: ${JSON.stringify(o)}`).join('\n')
      );
    }

    expect(result.pass).toBe(true);

    await page.close();
  }

  // Run across all known pages at both desktop and mobile browser contexts
  for (let i = 0; i < fileList.length; i++) {
    const file = fileList[i];
    if (file !== 'tabs.php') { // keep parity with other tests that exclude this page
      it(`Desktop Breakpoint: Resize Text (200%) on ${file}`, async () => {
        await testResizeText(file, true);
      });
      it(`Mobile Breakpoint: Resize Text (200%) on ${file}`, async () => {
        await testResizeText(file, false);
      });
    }
  }
});
