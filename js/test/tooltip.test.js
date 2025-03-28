'use strict';

import config from './test-config.js';
import testHelpers from './test-helpers.js';

const tooltipTextButtonId = '#tooltip_button_1';
const tooltipIconButtonId = '#tooltip_button_2';
const tooltipInputId = '#focusable_example_2';
const tooltipButtonInputId = '#body-style';
const tooltipId = '#tooltip';

describe('Tooltip tests', () => {
    /* Get attributes from tooltip target and tooltip after click/focus/keyboard event */
    async function getTooltipAttributes(tooltipTargetId) {

        const tooltipTarget = await page.evaluate((tooltipTargetId) => {
            const el = document.querySelector(tooltipTargetId);
            return {
                ariaDescribedBy: el.getAttribute('aria-describedby'),
                type: el.getAttribute('type'),
                dataTooltip: el.getAttribute('data-tooltip'),
            };
        }, tooltipTargetId);

        const tooltipEle = await page.evaluate((tooltipId) => {
            const el = document.querySelector(tooltipId);
            const isVisible = document.defaultView.getComputedStyle(el, null).clip !== 'rect(1px, 1px, 1px, 1px)';
            return {
                ariaLive: el.getAttribute('aria-live'),
                role: el.getAttribute('role'),
                isVisible: isVisible,
                innerHTML: el.innerHTML,
            };
        }, tooltipId);

        return [tooltipTarget, tooltipEle];
    }

    beforeEach(async () => {
        await page.setJavaScriptEnabled(true);
        await page.goto(`${config.BASE_URL}/tooltip.php`, {
            waitUntil: 'domcontentloaded',
        });
        await page.waitForSelector('#example1');
    });

    it('Tooltip is initially created with correct attributes and hidden on page load. There is only one tooltip', async () => {
        const tooltipEle = await page.evaluate((tooltipId) => {
            const el = document.querySelector(tooltipId);
            const tooltipCount = document.querySelectorAll('[role="tooltip"]').length;
            const isVisible = document.defaultView.getComputedStyle(el, null).clip !== 'rect(1px, 1px, 1px, 1px)';
            return {
                role: el.getAttribute('role'),
                ariaLive: el.getAttribute('aria-live'),
                isVisible: isVisible,
                tooltipCount: tooltipCount
            };
        }, tooltipId);

        expect(tooltipEle.role).toBe('tooltip');
        expect(tooltipEle.ariaLive).toBe('assertive');
        expect(tooltipEle.isVisible).toBe(false);
        expect(tooltipEle.tooltipCount).toBe(1);
    });

    it('Tooltip is displayed and show correct ARIA when button is clicked', async () => {
        await page.click(tooltipTextButtonId);

        const [tooltipTarget, tooltipEle] =
            await getTooltipAttributes(tooltipTextButtonId);

        expect(tooltipTarget.type).toBe('button');
        expect(tooltipEle.role).toBe('tooltip');
        expect(tooltipEle.ariaLive).toBe('assertive');
        expect(tooltipEle.isVisible).toBe(true);
        expect(tooltipEle.innerHTML).toBe(tooltipTarget.dataTooltip);
    });

    it('Tooltip is displayed and show correct ARIA when input is clicked', async () => {
        await page.click(tooltipInputId);

        const [tooltipTarget, tooltipEle] =
            await getTooltipAttributes(tooltipInputId);

        expect(tooltipTarget.ariaDescribedBy).toBe('tooltip');
        expect(tooltipTarget.type).toBe('text');
        expect(tooltipEle.role).toBe('tooltip');
        expect(tooltipEle.ariaLive).toBe('assertive');
        expect(tooltipEle.isVisible).toBe(true);
        expect(tooltipEle.innerHTML).toBe(tooltipTarget.dataTooltip);
    });

    it('When tabbing, tooltip does not initially show until enter is pressed', async () => {
        await page.waitForSelector(tooltipButtonInputId);
        await page.focus(tooltipButtonInputId);
        await page.keyboard.press('Tab');
        
        const isButtonFocused = await testHelpers.isElementFocused(tooltipIconButtonId);
        expect(isButtonFocused).toBe(true);

        const tooltipEleHidden = await page.evaluate((tooltipId) => {
            const el = document.querySelector(tooltipId);
            const isVisible = document.defaultView.getComputedStyle(el, null).clip !== 'rect(1px, 1px, 1px, 1px)';
            return {
                role: el.getAttribute('role'),
                ariaLive: el.getAttribute('aria-live'),
                isVisible: isVisible,
            };
        }, tooltipId);

        expect(tooltipEleHidden.role).toBe('tooltip');
        expect(tooltipEleHidden.ariaLive).toBe('assertive');
        expect(tooltipEleHidden.isVisible).toBe(false);

        await page.keyboard.press('Enter');
        const [tooltipTarget, tooltipEleShown] =
            await getTooltipAttributes(tooltipIconButtonId);

        expect(tooltipTarget.type).toBe('button');
        expect(tooltipEleShown.role).toBe('tooltip');
        expect(tooltipEleShown.ariaLive).toBe('assertive');
        expect(tooltipEleShown.isVisible).toBe(true);
        expect(tooltipEleShown.innerHTML).toBe(tooltipTarget.dataTooltip);
    });

    it('Tooltips will disappear when escape key is pressed', async () => {
        /* Button */
        await page.waitForSelector(tooltipIconButtonId);
        await page.click(tooltipIconButtonId);
        const [tooltipTargetBtn, tooltipEleBtn] =
            await getTooltipAttributes(tooltipIconButtonId);
            
        expect(tooltipTargetBtn.type).toBe('button');
        expect(tooltipEleBtn.role).toBe('tooltip');
        expect(tooltipEleBtn.isVisible).toBe(true);

        await page.keyboard.press('Escape');

        const [tooltipTargetBtnHidden, tooltipEleBtnHidden] =
            await getTooltipAttributes(tooltipIconButtonId);

        expect(tooltipEleBtnHidden.role).toBe('tooltip');
        expect(tooltipEleBtnHidden.isVisible).toBe(false);
        expect(tooltipTargetBtnHidden.type).toBe('button');

        /* Input */
        await page.click(tooltipInputId);
        const [tooltipTargetInput, tooltipEleInput] =
            await getTooltipAttributes(tooltipInputId);
            
        expect(tooltipTargetInput.type).toBe('text');
        expect(tooltipEleInput.role).toBe('tooltip');
        expect(tooltipEleInput.isVisible).toBe(true);

        await page.keyboard.press('Escape');

        const [tooltipTargetInputHidden, tooltipEleInputHidden] =
            await getTooltipAttributes(tooltipInputId);

        expect(tooltipEleInputHidden.isVisible).toBe(false);
        expect(tooltipEleInputHidden.role).toBe('tooltip');
        expect(tooltipTargetInputHidden.type).toBe('text');
    })
});
