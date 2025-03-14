'use strict'

/*******************************************************************************
* tooltip.js - Accessible Tooltip Module
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com> and Jessie Cai.
* Part of the Enable accessible component library.
* Version 1.0 released Dec. 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/tooltip.php
* 
* Released under the MIT License.
******************************************************************************/

const tooltip = new (function() {
    // global constants
    const { body } = document;
    const tooltipEl = document.createElement('div');
    const tooltipStyle = tooltipEl.style;
    const escapeKey = 'Escape';
    const tabKey = 'Tab';
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
        body.addEventListener('focus', this.onFocus, true);
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
        tooltipEl.innerHTML = '<div class="tooltip__content">Loading…</div>';
        tooltipEl.setAttribute('aria-live', 'assertive');
        body.appendChild(tooltipEl);
    }

    this.mousedown = (e) => {
        tabbedIn = false;
    }

    this.onKeydown = (e) => {
        if (e.key === tabKey){
            tabbedIn = true;
        }
    }

    this.onKeyup = (e) => {
        // check if escape is pressed
        if (e.key === escapeKey) {
            this.hide();
            e.preventDefault();
        }
    }

    this.onFocus = (e) => {
        tooltipTarget = e.target;

        //Hide tooltip on initial focus if tabbed in 
        if (tooltipTarget.tagName === 'BUTTON' && tabbedIn) {
            if (tooltipBelongsTo !== tooltipTarget){
                return;
            }
        }

        this.show(e);
    }
    
    this.show = (e) => {
        tooltipTarget = e.target;

        const closestTooltipEl = tooltipTarget.closest('[data-tooltip]');

        if (closestTooltipEl !== null) {
            tooltipTarget = closestTooltipEl;
        }

        const text = tooltipTarget.dataset.tooltip;
        if (!text || (isTooltipVisible && tooltipBelongsTo === tooltipTarget)) {
            return;
        }
        
        //Set aria attribute only for onFocus (input) elements
        if (tooltipTarget.tagName === 'INPUT'){
            tooltipTarget.setAttribute('aria-describedby', 'tooltip');
        }
    
        const tooltipTargetRect = tooltipTarget.getBoundingClientRect();
        tooltipEl.classList.remove('tooltip--hidden');
        
        tooltipEl.innerHTML = text;
        tooltipStyle.top = `calc(${tooltipTargetRect.bottom + window.scrollY}px + 1em)`
        tooltipStyle.left = `${tooltipTargetRect.left + window.scrollX}px`;
        tooltipEl.classList.remove('tooltip--bottom');
        tooltipEl.classList.add('tooltip--top');

        isTooltipVisible = true;
        tooltipBelongsTo = tooltipTarget;

        // Position the tooltip
        if (!isInViewport(tooltipEl)) {
            const tooltipHeight = tooltipEl.offsetHeight;
            tooltipEl.classList.add('tooltip--bottom');
            tooltipEl.classList.remove('tooltip--top');

            tooltipStyle.top = `calc(${tooltipTargetRect.top + window.scrollY - tooltipHeight}px - 1em)`
        }

        tooltipEl.dispatchEvent(
            new CustomEvent('enable-show', { bubbles: true })
        );
    }

    this.handleClick = (e) => {
        tooltipTarget = e.target;

        if (tooltipTarget.tagName === 'BUTTON' && tabbedIn) {
            if (!isTooltipVisible) {
                this.show(e);
            } else {
                this.hide(e);
            }
        } else {
            if (!isTooltipVisible){
                this.show(e);
            }
                
        }
        
    }

    this.hide = (e) => {
        if (e && e.type === 'click') {
            const clickedElement = document.elementFromPoint(e.clientX, e.clientY);
            if (clickedElement === tooltipEl) {
                return;
            }
        }

        if (tooltipTarget) {
            if (tooltipTarget.tagName === 'INPUT'){
                tooltipTarget.removeAttribute('aria-describedby');
            }
            tooltipTarget = null;
        }

        tooltipEl.classList.add('tooltip--hidden');
        tooltipEl.innerHTML = '';
        isTooltipVisible = false;
        tooltipBelongsTo = null;

        tooltipEl.dispatchEvent(
            new CustomEvent('enable-hide', { bubbles: true })
        );
    }
})
