

'use strict'

/*******************************************************************************
* radiogroup.js - Enable Custom Radiogroup
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released December 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/radiogroup.php
* 
* Released under the MIT License.
******************************************************************************/


const radiogroups = new function () {

    this.init = function () {
        this.radioGroupEls = document.querySelectorAll('.enable-custom-radiogroup');

        for (let i=0; i<this.radioGroupEls.length; i++) {
            this.add(this.radioGroupEls[i]);
        }

    }

    this.add = ($radioGroupEl) => {
        accessibility.initGroup(
            $radioGroupEl,
            {
                doKeyChecking: true,
                activatedEventName: 'enable-checked',
                deactivatedEventName: 'enable-unchecked'
            }
        );
    }
}

