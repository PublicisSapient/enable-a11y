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
    let timeout = null;
    let tooltipTarget = null;
    let isTooltipVisible = false;
    let tooltipBelongsTo = null;
    let tabbedIn = false;

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

        // Button click events
        body.addEventListener('click', this.handleClick);

        // Hover events for inputs and other elements
        body.addEventListener('mouseover', this.handleHover);
        body.addEventListener('focus', this.show, true);
        body.addEventListener('blur', this.hide, true);

        // Check for tabbing
        body.addEventListener('keydown', this.onKeydown);
        body.addEventListener('mousedown', this.mousedown);

        // Escape key to hide tooltip
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

    this.mousedown = (e) => {
        tabbedIn = false;
    }

    this.onKeydown = (e) => {
        if (e.key === 'Tab'){
            tabbedIn = true;
        }
    }

    this.onKeyup = (e) => {
        // check if escape is pressed
        if (e.which === 27) {
            this.hide();
            e.preventDefault();
        }
    }
    
    this.show = (e) => {
        tooltipTarget = e.target;

        //Hide tooltip on initial focus
        if (tooltipTarget.tagName.toLowerCase() === 'button' && tabbedIn) {
            return;
        }
        timeout = setTimeout(() => this.showTimeout(e), tooltipDelay);
    }

    this.handleClick = (e) => {
        tooltipTarget = e.target;

        if (tooltipTarget.tagName.toLowerCase() === 'button' && tabbedIn) {
            if (!isTooltipVisible) {
                timeout = setTimeout(() => this.showTimeout(e), tooltipDelay);
            } else {
                this.hide(e);
            }
        } else {
            if (tooltipTarget !== tooltipEl){
                this.show(e);
            }          
        }
        
    }

    this.showTimeout = (e) => {
        tooltipTarget = e.target;
        const text = tooltipTarget.dataset.tooltip;

        // don't do this if the tooltip is visible for this element already
        if (!text || (isTooltipVisible && tooltipBelongsTo === tooltipTarget)) {
            return;
        }

        const tooltipTargetRect = tooltipTarget.getBoundingClientRect();

        tooltipTarget.setAttribute('aria-describedby', 'tooltip');
        tooltipEl.innerHTML = text;
        tooltipEl.setAttribute('aria-hidden', "false");
        tooltipEl.classList.remove('tooltip--hidden');
        tooltipStyle.top = 'calc(' + (tooltipTargetRect.bottom + window.scrollY) + 'px + 1em)';
        tooltipStyle.left = (tooltipTargetRect.left + window.pageXOffset) + 'px';
        tooltipEl.classList.remove('tooltip--bottom');
        tooltipEl.classList.add('tooltip--top');

        isTooltipVisible = true;
        tooltipBelongsTo = tooltipTarget;

        // Position the tooltip
        if (!isInViewport(tooltipEl)) {
            const tooltipHeight = tooltipEl.offsetHeight;
            tooltipEl.classList.add('tooltip--bottom');
            tooltipEl.classList.remove('tooltip--top');

            tooltipStyle.top = 'calc(' + (tooltipTargetRect.top + window.scrollY - tooltipHeight) + 'px - 1em)';
        }

        tooltipTarget.addEventListener('mouseleave', this.hide);
        tooltipEl.addEventListener('mouseleave', this.hide);

        tooltipTarget.dispatchEvent(
            new CustomEvent('enable-show', { bubbles: true })
        );
    }

    this.hide = (e) => {
        if (e && e.type === 'click') {
            const clickedElement = document.elementFromPoint(e.clientX, e.clientY);
            if (clickedElement === tooltipEl) {
                return;
            }
        }

        if (tooltipTarget) {
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
            new CustomEvent('enable-hide', { bubbles: true })
        );
    }
}

export default tooltip;
