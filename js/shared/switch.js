const Switch = new function () {

    this.init = () => {
        document.body.addEventListener('click', onClick);
    }

    const onClick = (evt) => {
        const el = evt.target;
        const id = el.id;
        const alertEl = document.getElementById(id + '__alert');
        const labelEl = document.getElementById(id + '__label');
        let ariaDescribedByEl;

        if (el.getAttribute('role', 'switch')) {
            if (el.getAttribute('aria-checked') === 'true') {
                el.setAttribute('aria-checked', 'false');
                ariaDescribedBy = id + '-unchecked'
            } else {
                el.setAttribute('aria-checked', 'true');
                ariaDescribedBy =  id + '-checked';
            }
            el.setAttribute('aria-describedby', ariaDescribedBy);

            // set the alert if it exists.
            const ariaDescribedByEl = document.getElementById(ariaDescribedBy);
            const description = ariaDescribedByEl.getAttribute('aria-label') || ariaDescribedByEl.innerText;
            const label = (labelEl ? (labelEl.getAttribute('aria-label') || labelEl.innerText) : "");
            console.log(labelEl, label);
            if (alertEl && ariaDescribedByEl) {
                alertEl.innerHTML = description;
            }
        }        
    }
}

Switch.init();