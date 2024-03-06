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
    const tooltipDelay = parseInt(body.dataset.tooltipDelay || '0');
    let timeout;
    let tooltipTarget = null;


    let isTooltipVisible;
    let tooltipBelongsTo;

    /*!
    * Determine if an element is in the viewport
    * (c) 2017 Chris Ferdinandi, MIT License, https://gomakethings.com
    * @param  {Node}    elem The element
    * @return {Boolean}      Returns true if element is in the viewport
    */
    function isInViewport(elem) {
        var distance = elem.getBoundingClientRect();
        return (
        distance.top >= 0 &&
        distance.left >= 0 &&
        distance.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        distance.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    this.init = () => {
        this.create();

        // mouse events
        body.addEventListener('mouseover', this.show);

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
        tooltipEl.innerHTML = '<div class="tooltip__content">Loading ...</div>';
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
        timeout = setTimeout(() => this.showTimeout(e), tooltipDelay);
    }

    this.showTimeout = (e) => {
        // This is the element that needs the tooltip
        tooltipTarget = e.target;
        
        // The text the tooltip contains is in the
        // data-tooltip attribute
        const text = tooltipTarget.dataset.tooltip;

        // don't do this if the tooltip is visible for this element already
        if (!text || (isTooltipVisible && tooltipBelongsTo === tooltipTarget)) {
            return;
        }

        // If this is an element with a tooltip,
        if (text) {
            // the coordinates of the tooltipTarget
            const tooltipTargetRect = tooltipTarget.getBoundingClientRect();

            tooltipTarget.setAttribute('aria-describedby', 'tooltip');

            // show the tool tip
            tooltipEl.innerHTML = text;
            tooltipEl.setAttribute('aria-hidden', "false");
            tooltipEl.classList.remove('tooltip--hidden');

            // position the tooltip below the tooltipTarget
            tooltipStyle.top = 'calc(' + (tooltipTargetRect.bottom + window.pageYOffset) + 'px + 1em)';
            tooltipStyle.left = (tooltipTargetRect.left + window.pageXOffset) + 'px';
            isTooltipVisible = true;
            tooltipBelongsTo = tooltipTarget;

            // if the tooltip element is not in the viewport, we should scroll the page down so the user can see it.
            // Note that this always assumes that the tooltip is below the focused element.
            if (!isInViewport(tooltipEl)) {
                const afterStyle = window.getComputedStyle(tooltipEl, '::after');
                const afterHeight = parseInt(afterStyle.height);
                const tooltipY = element.getBoundingClientRect().top;

                if (window.scrollY < tooltipY) {
                    window.scrollTo(window.scrollX, tooltipY);
                }

                
            }
        }

        tooltipTarget.addEventListener('mouseleave', this.hide);

        tooltipEl.addEventListener('mouseleave', this.hide);


        tooltipTarget.dispatchEvent(
            new CustomEvent(
                'enable-show',
                {
                    'bubbles': true,
                }
            )
        );
    }

    this.hide = (e) => {
        if (e && e.type === 'mouseleave') {
            const hoveredElement = document.elementFromPoint(e.clientX, e.clientY);
            if (hoveredElement === tooltipEl) {
                return;
            }
        }


        if (tooltipTarget) {
            console.log("cancelling");
            tooltipTarget.removeEventListener('mouseleave', this.hide);
            tooltipEl.removeEventListener('mouseleave', this.hide);
            tooltipTarget = null;
        }
        clearTimeout(timeout);
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


