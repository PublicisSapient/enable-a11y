"use strict";

import config from "./test-config.js";
import testHelpers from "./test-helpers.js";
const { installMouseHelper } = require("./install-helper.js");

let desktopBrowser;

const robot = require("robotjs");

async function captureCursorPosition() {
  const { x, y } = robot.getMousePos();
  return { x, y };
}

describe("Input mask test suite", () => {
  beforeAll(async () => {
    desktopBrowser = await testHelpers.getDesktopBrowser();
  });
  afterAll(async () => {
    await testHelpers.pause();
    desktopBrowser.close();
  });
  // Masking functionality tests
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

  //Test keyboard interaction
  it("should render formatted value correctly post keyboard interaction", async () => {
    const page = await desktopBrowser.newPage();
    await page.goto(`${config.BASE_URL}/input-mask.php`, {
      waitUntil: "domcontentloaded",
    });

    const telInput = "#tel";
    await page.focus(telInput);
    await page.keyboard.type("1234567890");
    await page.keyboard.press("Backspace");
    await page.keyboard.press("ArrowLeft");
    await page.keyboard.type("1");
    const maskedTelephone = await page.$eval(
      "span.enable-input-mask__mask-pre-val",
      (span) => span.textContent
    );
    expect(maskedTelephone).toBe("123-456-781");
  });

  // Test mouse interaction
  it("should correctly render visual cursor and the input cursor on mouse Interactions", async () => {
    const page = await desktopBrowser.newPage();
    await page.goto(`${config.BASE_URL}/input-mask.php`, {
      waitUntil: "domcontentloaded",
    });

    const telephoneInput = "#tel";

    // bounding box of input
    const inputBoundingBox = await page.$eval(telephoneInput, (input) => {
      const { x, y, width, height } = input.getBoundingClientRect();
      return { x, y, width, height };
    });

    // Calculate the middle of the span
    const middleX = inputBoundingBox.x + inputBoundingBox.width / 2;
    const middleY = inputBoundingBox.y + inputBoundingBox.height / 2;

    //Initial cursor position, before mouse Interaction
    const initialCursorPosition = await captureCursorPosition();

    //explicitly move the mouse and click
    await page.mouse.move(middleX, middleY);
    await page.mouse.click(middleX, middleY);

    // get the cursor position ofter click, the assumption is after mouse move, an onclick the cursor doesn't Move
    const cursorPosition = await captureCursorPosition();

    expect(cursorPosition.x).toBeCloseTo(initialCursorPosition.x, 2);
    expect(cursorPosition.y).toBeCloseTo(initialCursorPosition.y, 2);
  });

  // Mouse Selection
  it("should select characters in the Tel Input field - Mouse", async () => {
    const page = await desktopBrowser.newPage();
    await installMouseHelper(page);
    await page.goto(`${config.BASE_URL}/input-mask.php`, {
      waitUntil: "domcontentloaded",
    });
    const telephoneInput = "#tel";
    const expectedSelection = "12345";
    await page.type(telephoneInput, "1234567890");
    // bounding box of input
    const inputBoundingBox = await page.$eval(telephoneInput, (input) => {
      const { x, y, width, height } = input.getBoundingClientRect();
      return { x, y, width, height };
    });
    //Click the input and move to the start of the field
    await page.click(telephoneInput);
    await page.mouse.move(inputBoundingBox.x, inputBoundingBox.y);
    // Select using
    await page.mouse.down();
    await page.mouse.move(inputBoundingBox.x + 50, inputBoundingBox.y);
    await page.mouse.up();
    //get the selection
    const selectedText = await page.$eval(
      "span.enable-input-mask__mask-pre-val",
      (span) => {
        return window.getSelection().toString();
      }
    );
    // check screenshot for the selection, should match up - "123-45"
    await page.screenshot({ path: "mouseSelection.png" });
    expect(expectedSelection).toBe(selectedText);
  });

  // Keyboard Selection
  it("should select characters in the Tel Input field - Keyboard", async () => {
    const page = await desktopBrowser.newPage();
    await installMouseHelper(page);
    await page.goto(`${config.BASE_URL}/input-mask.php`, {
      waitUntil: "domcontentloaded",
    });
    const telephoneInput = "#tel";
    const expectedSelection = "67890";
    //Focus on the  input and type
    await page.focus(telephoneInput);
    await page.type(telephoneInput, "1234567890");
    await page.keyboard.down("Shift");
    // Select using keyboard
    await page.keyboard.press("ArrowLeft", { shift: true });
    await page.keyboard.press("ArrowLeft", { shift: true });
    await page.keyboard.press("ArrowLeft", { shift: true });
    await page.keyboard.press("ArrowLeft", { shift: true });
    await page.keyboard.press("ArrowLeft", { shift: true });
    await page.keyboard.up("Shift");
    //get the selection
    const selectedText = await page.$eval(
      "span.enable-input-mask__mask-pre-val",
      (span) => {
        return window.getSelection().toString();
      }
    );
    // check screenshot for the selection, should match up - "6-7890"
    await page.screenshot({ path: "keyBoardSelection.png" });
    expect(expectedSelection).toBe(selectedText);
  });

  // Input Validation
  it("should not render letters in telephone input", async () => {
    const page = await desktopBrowser.newPage();
    await page.goto(`${config.BASE_URL}/input-mask.php`, {
      waitUntil: "domcontentloaded",
    });

    await page.type("#tel", "abscded");
    const maskedTelephone = await page.$eval(
      "span.enable-input-mask__mask-pre-val",
      (span) => span.textContent
    );
    expect(maskedTelephone).toBe("");
  });
});
