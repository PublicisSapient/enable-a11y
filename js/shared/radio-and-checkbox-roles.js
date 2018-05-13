const ariaRadioCheckboxShim = new function () {
    const sap = {ui:{keycodes:{SPACE:32, ENTER:13 }}};

    this.navigate = (evt) => {
        if (evt.type=="click" ||
            evt.keyCode == sap.ui.keycodes.SPACE ||
            evt.keyCode == sap.ui.keycodes.ENTER) {
            const ref = evt.target != null ? evt.target : evt.srcElement;
            const role = ref.getAttribute('role');
            if (ref)
            
            switch(role) {
                case 'radio':
                    // First, grab all other radios with the same name and uncheck them
                    const name = ref.getAttribute('data-name');
                    const allRadios = document.querySelectorAll(`[role="radio"][data-name=${name}]`);

                    for (let i=0; i<allRadios.length; i++) {
                        const radio = allRadios[i];
                        if (radio !== ref) {
                            radio.setAttribute('aria-checked', 'false');
                        }
                    }

                    ref.setAttribute(
                        'aria-checked', 
                        'true'
                    );
                    break;
                case 'checkbox':
                    ref.setAttribute(
                        'aria-checked', 
                        ref.getAttribute('aria-checked') === 'true' ? 'false' : 'true'
                    );
                    break;
            }
        }
    }

    document.addEventListener('click', this.navigate);
    document.addEventListener('keydown', this.navigate);
}