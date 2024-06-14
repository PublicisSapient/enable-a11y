'use strict'

const radiogroups = new (function() {

  this.init = function() {
    this.radioGroupEls = document.querySelectorAll('.enable-custom-radiogroup');

    for (let i = 0; i < this.radioGroupEls.length; i++) {
      this.add(this.radioGroupEls[i]);
    }

  }

  this.add = ($radioGroupEl) => {
    accessibility.initGroup(
      $radioGroupEl, {
        doKeyChecking: true,
        activatedEventName: 'enable-checked',
        deactivatedEventName: 'enable-unchecked'
      }
    );
  }
})