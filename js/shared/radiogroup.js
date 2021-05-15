var radiogroup = new function () {

    this.init = function () {
        this.radioGroupEls = document.querySelectorAll('.enable-custom-radiogroup');

        for (let i=0; i<this.radioGroupEls.length; i++) {
            accessibility.initGroup(this.radioGroupEls[i], {doKeyChecking: true});
        }

    }
}
radiogroup.init();