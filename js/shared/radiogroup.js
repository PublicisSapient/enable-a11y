var radiogroup = new function () {

    this.init = function () {
        this.radioGroupEls = document.querySelectorAll('[role="radiogroup"]');

        for (let i=0; i<this.radioGroupEls.length; i++) {
            accessibility.setArrowKeyRadioGroupEvents(this.radioGroupEls[i], {doKeyChecking: true});
        }
    }
}
console.log('loading');
radiogroup.init();