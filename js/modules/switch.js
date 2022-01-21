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

    this.init = () => {
        document.body.addEventListener('click', this.onClick);
    }

    this.onClick = (evt) => {
        let el = evt.target;
        const id = el.id;
        const switchEl = el.closest('[role="switch"]');
        let ariaDescribedBy;
        let isChecked;

        if (switchEl) {
            el = switchEl;
        } else {
            // Element clicked was not a switch. Bailing.
            return;
        }

        if (el.getAttribute('role', 'switch')) {
            if (el.getAttribute('aria-checked') === 'true') {
                el.setAttribute('aria-checked', 'false');
                ariaDescribedBy = id + '-unchecked'
                isChecked = false;
            } else {
                el.setAttribute('aria-checked', 'true');
                ariaDescribedBy =  id + '-checked';
                isChecked = true;
            }
            el.setAttribute('aria-describedby', ariaDescribedBy);
            el.dispatchEvent(
                new CustomEvent(
                    'enable-switch-change',
                    {
                        bubbles: true,
                        detail: {
                            isChecked: () => isChecked
                        }
                    }
                )
            );
        }    
    }
}


export default Switch;