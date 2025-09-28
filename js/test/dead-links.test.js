'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

// const fileList = ['audio-descriptions.php']; // for local debugging
const fileList = testHelpers.getPageList();

let desktopBrowser;

// Tune as needed
const CONCURRENCY = 12;
const FETCH_TIMEOUT_MS = 10000;
// If true, only check internal links (same origin as BASE_URL)
const doInternalOnly = true;
// Compute once so we don't recompute per page
const siteOrigin = new URL(config.BASE_URL).origin;

// Per-run cache so we never fetch the same URL twice
const urlCheckCache = new Map();

// Collect dead links per page to print a grouped summary after all tests
const deadLinksByPage = new Map();

async function mapWithConcurrency(items, limit, worker) {
  const results = new Array(items.length);
  let i = 0;
  const workers = Array.from({ length: Math.min(limit, items.length) }, () =>
    (async function run() {
      while (i < items.length) {
        const idx = i++;
        results[idx] = await worker(items[idx], idx);
      }
    })(),
  );
  await Promise.all(workers);
  return results;
}

async function timedFetch(url, options = {}, timeoutMs = FETCH_TIMEOUT_MS) {
  const ac = new AbortController();
  const t = setTimeout(() => ac.abort(), timeoutMs);
  try {
    return await fetch(url, { ...options, signal: ac.signal });
  } finally {
    clearTimeout(t);
  }
}

function normalizeLink(href, pageUrl) {
  if (!href) return null;
  const h = href.trim();
  if (!h || h === '#' || h.startsWith('#')) return null;
  if (/^(mailto:|tel:|sms:|geo:|fax:|callto:|javascript:)/i.test(h)) return null;
  try {
    const u = new URL(h, pageUrl);
    if (!/^https?:$/.test(u.protocol)) return null;
    return u.href;
  } catch {
    return null;
  }
}

async function checkUrlAlive(url) {
  if (urlCheckCache.has(url)) return urlCheckCache.get(url);

  const out = { url, ok: false, status: null, method: 'HEAD', finalUrl: null, error: null };

  try {
    let res = await timedFetch(url, { method: 'HEAD', redirect: 'follow' });
    out.status = res.status;
    out.finalUrl = res.url;
    let ok = res.status >= 200 && res.status < 400;

    if (!ok || res.status === 405 || res.status === 501) {
      res = await timedFetch(url, { method: 'GET', redirect: 'follow' });
      out.method = 'GET';
      out.status = res.status;
      out.finalUrl = res.url;
      ok = res.status >= 200 && res.status < 400;
    }

    out.ok = ok;
  } catch (e) {
    out.error = String(e);
    out.ok = false;
  }

  urlCheckCache.set(url, out);
  return out;
}

describe('Dead link check (site-wide)', () => {
  beforeAll(async () => {
    desktopBrowser = await testHelpers.getDesktopBrowser();
  });

  afterAll(async () => {
    await desktopBrowser?.close();
    let deadLinkSummary = [];

    // Print a single grouped summary of dead links across all pages
    if (deadLinksByPage.size) {
      deadLinkSummary.push('\nDead link summary:\n');
      // Sort by filename for stable output
      const entries = Array.from(deadLinksByPage.entries()).sort(([a],[b]) => a.localeCompare(b));
      for (const [filename, urls] of entries) {
        const count = urls.length;
       deadLinkSummary.push(`\n\nPage ${filename} has ${count} dead link${count === 1 ? '' : 's'}:`);
        for (const u of urls) {
            deadLinkSummary.push(`\n${u}`);
        }
      }
      console.log(deadLinkSummary.join(''));
    }
  });

  async function assertNoDeadLinksOnPage(filename) {
    const page = await desktopBrowser.newPage();
    const pageUrl = `${config.BASE_URL}/${filename}`;

    await page.goto(pageUrl, { waitUntil: 'load' });

    const rawHrefs = await page.evaluate(() =>
      Array.from(document.querySelectorAll('a[href]'), (a) => a.getAttribute('href')),
    );

    await page.close(); // free the tab early

    let urls = Array.from(
      new Set(rawHrefs.map((h) => normalizeLink(h, pageUrl)).filter(Boolean)),
    );

    // If only internal links are desired, filter by origin
    if (doInternalOnly) {
      urls = urls.filter((u) => {
        try { return new URL(u).origin === siteOrigin; }
        catch { return false; }
      });
    }

    const results = await mapWithConcurrency(urls, CONCURRENCY, checkUrlAlive);
    const dead = results.filter((r) => !r.ok);

    if (dead.length) {
      // record just the original URLs (you can switch to r.finalUrl if you prefer)
      deadLinksByPage.set(
        filename,
        dead.map((d) => d.url),
      );
    }

    // Fail this page’s test if it has any dead links
    expect(dead.length).toBe(0);
  }

  for (const file of fileList) {
    it(`Desktop: No dead links — ${file}`, async () => {
      await assertNoDeadLinksOnPage(file);
    });
  }
});
