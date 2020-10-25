const Switch = new function () {
    const customEvent = document.createEvent('Event');

    this.init = () => {
        customEvent.initEvent('switch-change', true, true);
        document.body.addEventListener('click', onClick);
    }

    const onClick = (evt) => {
        let el = evt.target;
        const id = el.id;
        const alertEl = document.getElementById(id + '__alert');
        const labelEl = document.getElementById(id + '__label');
        let ariaDescribedByEl;
        const switchEl = el.closest('[role="switch"]');

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