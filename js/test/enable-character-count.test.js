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
  await resetCharacterCountText();
});

async function resetCharacterCountText() {
  await page.evaluate((textarea) => (textarea.value = ''), textArea);
  await page.keyboard.press('ArrowDown');
}

async function keyboardType(text) {
  await page.keyboard.type(text, { delay: 1 });
}

describe('Tests for the ARIA live region', () => {
  const liveRegionSuffix = '-live-region';
  let liveRegion;

  beforeAll(async () => {
    liveRegion = await page.$(`[id$="${liveRegionSuffix}"]`);
  });

  it('Is created for data-has-character-count="true"', async () => {
    expect(liveRegion).not.toBeNull();
  });

  it('Is created with correct suffix appended', async () => {
    const id = await page.evaluate((p) => p.id, liveRegion);
    const textAreaId = await page.evaluate((textarea) => textarea.id, textArea);
    expect(id).toBe(`${textAreaId}${liveRegionSuffix}`);
  });

  it('Has correct character count when outside warning threshold', async () => {
    await keyboardType('This sentence has 32 characters.');
    await announce();
    const result = await evaluateStatus();
    expect(result).toContain('Character Count: 32 out of 100. 68 characters remaining.');
  });

  it('Has correct character count when within warning threshold', async () => {
    await keyboardType('This sentence will be within the default threshold set for the character counter.');
    await announce();
    const result = await evaluateStatus();
    expect(result).toContain('Character Count: 81 out of 100. 19 characters remaining.');
  });

  it('Has max character count when too much is typed', async () => {
    await keyboardType('This sentence contains more than the allotted one hundred max characters that is allowed by default for this textarea.');
    await announce();
    const result = await evaluateStatus();
    expect(result).toContain('Character Count: 100 out of 100. 0 characters remaining.');
  });

  async function announce() {
    await page.keyboard.press('Escape');
  }

  async function evaluateStatus() {
    return await page.evaluate((p) => p.textContent, liveRegion);
  }
});

describe('Tests for the displayed character count', () => {
  const characterCountContainerSuffix = '-counter-container';
  let divCharacterCount;

  beforeAll(async () => {
    divCharacterCount = await page.$(`[id$="${characterCountContainerSuffix}"]`);
  });

  it('Is created for data-has-character-count="true"', async () => {
    expect(divCharacterCount).not.toBeNull();
  });

  it('Is created with correct suffix appended', async () => {
    const id = await page.evaluate((p) => p.id, divCharacterCount);
    const textAreaId = await page.evaluate((textarea) => textarea.id, textArea);
    expect(id).toBe(`${textAreaId}${characterCountContainerSuffix}`);
  });

  it('Is created with correct default value', async () => {
    const result = await getCharacterCount();
    expect(result).toBe('0/100');
  });

  it('Has correct character count when outside warning threshold', async () => {
    await keyboardType('This sentence has 32 characters.');
    const result = await getCharacterCount();
    expect(result).toBe('32/100');
  });

  it('Has correct character count when within warning threshold', async () => {
    await keyboardType('This sentence will be within the default threshold set for the character counter.');
    const result = await getCharacterCount();
    expect(result).toBe('81/100');
  });

  it('Has max character count when too much is typed', async () => {
    await keyboardType('This sentence contains more than the allotted one hundred max characters that is allowed by default for this textarea.');
    const result = await getCharacterCount();
    expect(result).toBe('100/100');
  });

  async function getCharacterCount() {
    const selector = `div[id$="${characterCountContainerSuffix}"] span:first-child`;
    return await page.$eval(selector, (span) => span.textContent);
  }
});

describe('Tests for the ARIA described-by', () => {
  const ariaDescribedBySuffix = '-aria-describedby';
  let describedBy;

  beforeAll(async () => {
    describedBy = await page.$(`[id$="${ariaDescribedBySuffix}"]`);
  });

  it('Is created for data-has-character-count="true"', async () => {
    expect(describedBy).not.toBeNull();
  });

  it('Is created with correct suffix appended', async () => {
    const id = await page.evaluate((p) => p.id, describedBy);
    const textAreaId = await page.evaluate((textarea) => textarea.id, textArea);
    expect(id).toBe(`${textAreaId}${ariaDescribedBySuffix}`);
  });

  it('Is created with correct default value', async () => {
    const result = await page.evaluate((p) => p.innerHTML, describedBy);
    expect(result).toBe('In edit text area with a 100 character limit. Press Escape to find out how many more characters are allowed.');
  });
});
