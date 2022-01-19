'use strict'

/*******************************************************************************
* tooltip.js - Accessible Tooltip Module
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec. 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/tooltip.php
* 
* Released under the MIT License.
******************************************************************************/

const tooltip = new function () {
    // global constants
    const { body } = document;
    const tooltipEl = document.createElement('div');
    const tooltipStyle = tooltipEl.style;

    let isTooltipVisible;
    let tooltipBelongsTo;

    this.init = () => {
        this.create();

        // mouse events
        body.addEventListener('mouseover', this.show);
        body.addEventListener('mouseleave', this.hide);

        // equivalent keyboard events
        body.addEventListener('focus', this.show, true);
        body.addEventListener('blur', this.hide, true);
        
        // used to make tooltip disappear when ESC key 
        // is pressed.
        body.addEventListener('keyup', this.onKeyup);

    }

    this.create = () => {
        tooltipEl.className = 'tooltip';
        tooltipEl.id = 'tooltip';
        tooltipEl.setAttribute('role', 'tooltip');
        tooltipEl.classList.add('tooltip--hidden');
        tooltipEl.innerHTML = 'Loading ...';
        tooltipEl.setAttribute('aria-hidden', 'true');
        body.appendChild(tooltipEl);
    }

    this.onKeyup = (e) => {
        // check if escape is pressed
        if (e.which === 27)  {
            this.hide();
            e.preventDefault(); 
        }
    }
    this.show = (e) => {
        // This is the element that needs the tooltip
        const target = e.target;
        
        // The text the tooltip contains is in the
        // data-tooltip attribute
        const text = target.dataset.tooltip;

        // don't do this if the tooltip is visible for this element already
        if (!text || (isTooltipVisible && tooltipBelongsTo === target)) {
            return;
        }

        // If this is an element with a tooltip,
        if (text) {
            // the coordinates of the target
            const targetRect = target.getBoundingClientRect();

            target.setAttribute('aria-describedby', 'tooltip');

            // show the tool tip
            tooltipEl.innerHTML = text;
            tooltipEl.setAttribute('aria-hidden', "false");
            tooltipEl.classList.remove('tooltip--hidden');

            // position the tooltip below the target
            tooltipStyle.top = 'calc(' + (targetRect.bottom + window.pageYOffset) + 'px + 1em)';
            tooltipStyle.left = (targetRect.left + window.pageXOffset) + 'px';
            isTooltipVisible = true;
            tooltipBelongsTo = target;
        }
        target.dispatchEvent(
            new CustomEvent(
                'enable-show',
                {
                    'bubbles': true,
                }
            )
        );
    }

    this.hide = () => {
        tooltipEl.classList.add('tooltip--hidden');
        tooltipEl.setAttribute('aria-hidden', 'true');
        isTooltipVisible = false;
        tooltipBelongsTo = null;

        tooltipEl.dispatchEvent(
            new CustomEvent(
                'enable-hide',
                {
                    'bubbles': true,
                }
            )
        );
    }
}


export default tooltip;