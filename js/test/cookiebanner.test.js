import config from './test-config';

let cookieBanner;

beforeAll(async () => {
  await page.goto(`${config.BASE_URL}/cookiebanner.php`);
  cookieBanner = await page.$('.cookie-banner');
});

describe('Tests for cookie banner', () => {
  it('Contains div with a document role', async () => {
    let result = await cookieBanner.$('div[role="document"]');
    expect(result).not.toBeNull();
  });

  it('Contains close button', async () => {
    let result = await getCloseButton();
    console.log(result);
    expect(result).not.toBeNull();
  });

  it('Has autofocus set to the close button', async () => {
    let closeButton = await getCloseButton();
    let result = await page.evaluate((closeButton) => closeButton.hasAttribute('autofocus'), closeButton);
    expect(result).toBe(true);
  });

  async function getCloseButton() {
    return await cookieBanner.$('button[id$="close-button"]');
  }

  it('Contains form with method of dialog', async () => {
    let result = await getForm();
    expect(result).not.toBeNull();
  });

  it('Has aria-labelledby set for form', async () => {
    let form = await getForm();
    let result = await page.evaluate((form) => form.hasAttribute('aria-labelledby'), form);
    expect(result).toBe(true);
  });

  it('Contains element for aria-labelledby', async () => {
    let form = await getForm();
    let ariaLabelledBy = await page.evaluate((el) => el.getAttribute('aria-labelledby'), form);
    let result = await cookieBanner.$(`[id$="${ariaLabelledBy}"]`);
    expect(result).not.toBeNull();
  });

  async function getForm() {
    return await cookieBanner.$('form[method="dialog"]');
  }
});
