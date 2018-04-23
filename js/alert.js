
const alert = new function () {
    const sayTimeEl = document.getElementById('say-time');
    const assertiveAlertEl = document.getElementById('assertive-alert');
    const checkboxEl = document.getElementById('is-alert-expanded');
    

    this.sayTimeClickHandler = () => {
        assertiveAlertEl.innerHTML = `The time now is ${new Date().toLocaleTimeString()}`;
    }

    this.checkboxChangeHandler = (e) => {
        assertiveAlertEl.setAttribute('aria-expanded', checkboxEl.checked ? 'true' : 'false');
    }

    this.init = () => {
        sayTimeEl.addEventListener('click', this.sayTimeClickHandler);
        checkboxEl.addEventListener('change', this.checkboxChangeHandler);
    }
}

const expando = new function () {
    const alertEl = document.getElementById('polite-alert');
    const expandoButtonEls = document.getElementsByClassName('expando__button');
    const collapsedClass = 'expando__contents--collapsed';

    this.clickHandler = (e) => {
        const button = e.currentTarget;
        const expandoEl = button.closest('.expando');
        const contentEl = expandoEl.getElementsByClassName('expando__contents')[0];

        if (contentEl) {
            const classList = contentEl.classList;
            classList.toggle(collapsedClass);

            const isCollapsed = classList.contains(collapsedClass);

            const state = isCollapsed ? 'collapsed' : 'expanded';
            button.innerHTML = `${isCollapsed ? 'Expand' : 'Collapse'} Table of Contents`

            alertEl.innerHTML = `The ${button.dataset.section} section is ${state}.`;
        }
    }

    this.init = () => {
        Array.from(expandoButtonEls).forEach( (el) => {
            el.addEventListener('click',this. clickHandler);
        });
    }
}

alert.init();
expando.init();