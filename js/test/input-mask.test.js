"use strict";

import config from "./test-config.js";
import testHelpers from "./test-helpers.js";
let mobileBrowser, desktopBrowser;

describe("Input mask test suite", () => {
  beforeAll(async () => {
    mobileBrowser = await testHelpers.getMobileBrowser();
    desktopBrowser = await testHelpers.getDesktopBrowser();
  });
  afterAll(async () => {
    await testHelpers.pause();
    mobileBrowser.close();
    desktopBrowser.close();
  });

  it("Testing the masking functionality", async () => {
    const page = await desktopBrowser.newPage();
    await page.goto(`${config.BASE_URL}/input-mask.php`);
    await page.type("#tel", "1234567890");
    const maskedTelephone = await page.$eval(
      "span.enable-input-mask__mask-pre-val",
      (span) => span.textContent
    );
    expect(maskedTelephone).toBe("123-456-7890");
  });
  it("should render winkey masked correctly", async () => {
    const page = await desktopBrowser.newPage();
    await page.goto(`${config.BASE_URL}/input-mask.php`);
    await page.type("#winkey", "abcdefghijklmnopqrstuvwxy");
    const maskedWinKey = await page.$$eval(
      "span.enable-input-mask__mask-pre-val",
      (spans) => spans[1].textContent
    );
    expect(maskedWinKey).toBe("ABCDE-FGHIJ-KLMNO-PQRST-UVWXY");
  });
  it("should render cc masked correctly (non Amex)", async () => {
    const page = await desktopBrowser.newPage();
    await page.goto(`${config.BASE_URL}/input-mask.php`);
    await page.type("#cc", "5555555555555555");
    const maskedWinKey = await page.$$eval(
      "span.enable-input-mask__mask-pre-val",
      (spans) => spans[2].textContent
    );
    expect(maskedWinKey).toBe("5555 5555 5555 5555");
  });
  it("should render cc masked correctly (Amex)", async () => {
    const page = await desktopBrowser.newPage();
    await page.goto(`${config.BASE_URL}/input-mask.php`);
    await page.type("#cc", "3455555555555555");
    const maskedWinKey = await page.$$eval(
      "span.enable-input-mask__mask-pre-val",
      (spans) => spans[2].textContent
    );
    expect(maskedWinKey).toBe("3455 555555 55555");
  });
});
