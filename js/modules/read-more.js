'use strict'

/*******************************************************************************
* read-more.js - An accessible "Read More" widget
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/read-more.php
* 
* Released under the MIT License.
******************************************************************************/
let readMore;
// Only run if this is being run client side.
if (typeof window !== 'undefined' && typeof document !== 'undefined') {

readMore = new function () {

    this.clickEvent = (e) => {
        const { target, currentTarget } = e;
        console.log('target', target, currentTarget);

        if (target.classList.contains('read-more__button')) {
            const isExpanded = target.getAttribute('aria-expanded') === 'true';
            const wrapper = target.closest('.read-more__wrapper');
            const container = wrapper ? wrapper.querySelector('.read-more__container') : null;
            const overflowContent = wrapper ? wrapper.querySelector('.read-more__overflow-content') : null;
            const focusPoint = wrapper ? wrapper.querySelector('.read-more__focus-point') : null;
            
            if (wrapper && container && overflowContent && focusPoint) {
                if (isExpanded) {
                    target.setAttribute('aria-expanded', 'false');
                    overflowContent.classList.remove('read-more__overflow-content--visible');
                    target.innerHTML = "Show more";
                } else {
                    target.setAttribute('aria-expanded', 'true');
                    overflowContent.classList.add('read-more__overflow-content--visible');
                    focusPoint.focus();
                    target.innerHTML = "Show less";
                }
            }
        }
    }

    document.body.addEventListener('click', this.clickEvent)
}

}

if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
  module.exports = (readMore || new function () {});
}

export default readMore;

