const ToggleButton = new function () {

    this.init = () => {
        document.body.addEventListener('click', onClick);
    }

    const onClick = (evt) => {
        const el = evt.target.closest('[role="switch"]');
        const id = el.id;
        const valueEl = document.getElementById(id + '__value');
        const labelEl = document.getElementById(id + '__label');
        const ariaLabelValueEls = el.querySelectorAll('span[aria-label]');
        let ariaDescribedBy = el.getAttribute('aria-describedby');
        console.log(el, ariaDescribedBy);

        let ariaDescribedByEl;

        if (el.getAttribute('role', 'switch') && el.getAttribute('aria-checked') != null) {
            /* if (el.getAttribute('aria-checked') === 'true') {
                el.setAttribute('aria-checked', 'false');
                ariaDescribedBy = id + '-unchecked';
            } else {
                el.setAttribute('aria-checked', 'true');
                ariaDescribedBy =  id + '-checked';
            }*/
            if (ariaDescribedBy === id + '-checked') {
                const ariaLabelEl = ariaLabelValueEls[1];
                el.setAttribute('aria-label', ariaLabelEl.getAttribute('aria-label') || ariaLabelEl.innerText);
                ariaDescribedBy = id + '-unchecked';
            } else {
                const ariaLabelEl = ariaLabelValueEls[0];
                el.setAttribute('aria-label', ariaLabelEl.getAttribute('aria-label') || ariaLabelEl.innerText);
                ariaDescribedBy = id + '-checked';
            }

            el.setAttribute('aria-describedby', ariaDescribedBy);

            // set the alert if it exists.
            const ariaDescribedByEl = document.getElementById(ariaDescribedBy);
            const description = ariaDescribedByEl.getAttribute('aria-label') || ariaDescribedByEl.innerText;
            const label = (labelEl ? (labelEl.getAttribute('aria-label') || labelEl.innerText) : "");
            
            // if valueEl exists, set it to the checked value
            if (valueEl) {
                valueEl.innerHTML = document.getElementById(ariaDescribedBy).innerHTML;
            }
            
        }        
    }
}

ToggleButton.init();