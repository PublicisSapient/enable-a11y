'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const fileList = ['sortable-table.php']; // testHelpers.getPageList();
let mobileBrowser,
	desktopBrowser;

describe('Test that all focusable elements have target area greater than 24 x 24 pixels', () => {
	beforeAll(async () => { // Put code here that should execute before starting tests.
		desktopBrowser = await testHelpers.getDesktopBrowser();
		mobileBrowser = await testHelpers.getMobileBrowser();
	});

	afterAll(async () => {
		await mobileBrowser.close();
		await desktopBrowser.close();
	});

	function truncString(s) {
		
		const maxLength = 60;
		let r;
		if (s.length > maxLength) {
			r = s.substring(0, maxLength) + '...';
		} else {
			r = s;
		}

		return r;
	}

	async function testTargets(filename, isDesktop) {
		//console.log(`testing ${filename}, Is desktop: ${isDesktop}`);
		let domInfo,
			page;

		if (isDesktop) {
			page = await desktopBrowser.newPage();
		} else {
			page = await mobileBrowser.newPage();
		}

		// Wait until the DOM is fully loaded.
		await page.goto(`${
			config.BASE_URL
		}/${filename}`, {waitUntil: 'domcontentloaded'});

		// Let's loop through all the tabstops on the page.
		do { // Let's simulate a tab press
			await page.keyboard.press('Tab');

			// Now let's see if there is a focus ring around the
			// focused element.
			domInfo = await page.evaluate(() => {
				function getTargetBoxImplicit(el) {
					if (!(el instanceof Element)) 
						return null;
					

					const isVisible = (node) => {
						const cs = getComputedStyle(node);
						if (cs.display === 'none' || cs.visibility === 'hidden' || cs.pointerEvents === 'none') 
							return false;
						
						const r = node.getBoundingClientRect();
						return r.width > 0 && r.height > 0;
					};

					const rects = [];
					if (isVisible(el)) 
						rects.push(el.getBoundingClientRect());
					

					// Only implicit label: <label> ... <input> ... </label>
					const wrapLabel = el.closest('label');
					if (wrapLabel && isVisible(wrapLabel)) 
						rects.push(wrapLabel.getBoundingClientRect());
					

					if (! rects.length) 
						return null;
					

					let left = rects[0].left,
						top = rects[0].top;
					let right = rects[0].right,
						bottom = rects[0].bottom;
					for (let i = 1; i < rects.length; i++) {
						const r = rects[i];
						left = Math.min(left, r.left);
						top = Math.min(top, r.top);
						right = Math.max(right, r.right);
						bottom = Math.max(bottom, r.bottom);
					}

					const width = Math.max(0, right - left);
					const height = Math.max(0, bottom - top);
					return {
						left,
						top,
						right,
						bottom,
						width,
						height,
						x: left,
						y: top
					};
				}

				/** Convenience: just the size 
				function getTargetSizeImplicit(el) {
					const box = getTargetBoxImplicit(el);
					return box ? {
						width: Math.round(box.width),
						height: Math.round(box.height)
					} : {
						width: 0,
						height: 0
					};
				}*/


				const {activeElement} = document;
				const display = document.defaultView.getComputedStyle(activeElement, null).display;
                const {width, height} = getTargetBoxImplicit(activeElement);
				const r = {
					offsetWidth: width,
					offsetHeight: height,
					display,
					isInline: display === 'inline',
					html: activeElement.outerHTML,
					isBody: activeElement === document.body
				}

				return r;
			});
			if (! domInfo.isInline) {

				if (domInfo.offsetWidth < 24) {
					console.log(`Bad target width ${
						domInfo.offsetWidth
					} for:\n\n ${
						truncString(domInfo.html)
					}\n\n Display is ${
						domInfo.display
					}`);
				}

				if (domInfo.offsetHeight < 24) {
					console.log(`Bad target height ${
						domInfo.offsetHeight
					} for:\n\n ${
						truncString(domInfo.html)
					}\n\n Display is ${
						domInfo.display
					}`);
				}

				expect(domInfo.offsetWidth).toBeGreaterThan(24);
				expect(domInfo.offsetHeight).toBeGreaterThan(24);
			}

		} while (! domInfo.isBody);

		page.close();
	}
	// end testFocusStates()

	// This goes through all the URLs in the site and
	// runs testFocusStates() on it twice, one in the desktop
	// browser and one in the mobile.
	for (let i = 0; i < fileList.length; i++) {
		const file = fileList[i];
		it(`Desktop Breakpoint: Test focus states on ${file}`, async () => {
			await testTargets(file, true);
		});
		it(`Mobile Breakpoint: Test focus states on ${file}`, async () => {
			await testTargets(file, false);
		});
	}
});
