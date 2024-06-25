import config from './test-config';

const textAreaSelector = '[data-has-character-count="true"]';
let textArea;

beforeAll(async () => {
  await page.goto(`${config.BASE_URL}/textbox.php`);
  textArea = await page.$(textAreaSelector);
});

beforeEach(async () => {
  await page.focus(textAreaSelector);
});

afterEach(async () => {
  await page.evaluate((textarea) => (textarea.value = ''), textArea);
});

describe('Tests for the ARIA live region', () => {
  const liveRegionSuffixedBy = '-live-region-character-count-status';
  let characterCountStatus;

  beforeAll(async () => {
    characterCountStatus = await page.$(`[id$="${liveRegionSuffixedBy}"]`);
  });

  it('Is created for data-has-character-count="true"', async () => {
    expect(characterCountStatus).not.toBeNull();
    const id = await page.evaluate((p) => p.id, characterCountStatus);
    const textAreaId = await page.evaluate((textarea) => textarea.id, textArea);
    expect(id).toBe(`${textAreaId}${liveRegionSuffixedBy}`);
  });

  it('Has correct character count when outside warning threshold', async () => {
    await keyboardType('This sentence has 32 characters.');
    await announcementTimeout(200);
    const result = await evaluateStatus();
    expect(result).toBe('Character Count: 32 out of 100. 68 characters remaining.');
  });

  it('Has correct character count when within warning threshold', async () => {
    await keyboardType('This sentence will be within the default threshold set for the character counter.');
    await announcementTimeout(1000);
    const result = await evaluateStatus();
    expect(result).toBe('Character Count: 81 out of 100. 19 characters remaining.');
  });

  it('Has max character count when too much is typed', async () => {
    await keyboardType('This sentence contains more than the allotted one hundred max characters that is allowed by default for this textarea.');
    await announcementTimeout(1000);
    const result = await evaluateStatus();
    expect(result).toBe('Character Count: 100 out of 100. 0 characters remaining.');
  });

  async function keyboardType(text) {
    await page.keyboard.type(text, { delay: 1 });
  }

  async function announcementTimeout(value) {
    await page.keyboard.press('ArrowDown', { delay: value });
  }

  async function evaluateStatus() {
    return await page.evaluate((p) => p.innerHTML, characterCountStatus);
  }
});
