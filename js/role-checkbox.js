const RoleCheckbox = new function () {

    this.clickHandler = (e) => {
        const target = e.type === "keydown" ? document.activeElement : e.target;

        console.log('target is ', target.getAttribute('role'), `char is '${e.key}'`);

        if (target.getAttribute('role') === 'checkbox' && 
            ((e.type==="keydown" && e.key === ' ') || (e.type==="click"))) {
            const isChecked = (target.getAttribute('aria-checked') === 'true');
            target.setAttribute('aria-checked', `${!isChecked}`);
        }
    }

    this.init = () => {
        const fakeCheckboxesEls = document.querySelectorAll('[role="checkbox"]');
        
        document.addEventListener('keydown', this.clickHandler);
        document.addEventListener('click', this.clickHandler);
        
    }

}

RoleCheckbox.init();

