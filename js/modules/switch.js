'use strict'

/*******************************************************************************
* switch.js - Implements UI for the ARIA switch role
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec. 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/switch.php
* 
* Released under the MIT License.
******************************************************************************/



const Switch = new function () {
    const customEvent = document.createEvent('Event');

    this.init = () => {
        customEvent.initEvent('switch-change', true, true);
        document.body.addEventListener('click', this.onClick);
    }

    this.onClick = (evt) => {
        let el = evt.target;
        const id = el.id;
        const switchEl = el.closest('[role="switch"]');
        let ariaDescribedBy;

        if (switchEl) {
            el = switchEl;
        }

        if (el.getAttribute('role', 'switch')) {
            if (el.getAttribute('aria-checked') === 'true') {
                el.setAttribute('aria-checked', 'false');
                ariaDescribedBy = id + '-unchecked'
            } else {
                el.setAttribute('aria-checked', 'true');
                ariaDescribedBy =  id + '-checked';
            }
            el.setAttribute('aria-describedby', ariaDescribedBy);
            el.dispatchEvent(customEvent);
        }    
    }
}

Switch.init();

export default Switch;