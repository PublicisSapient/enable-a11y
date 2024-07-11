const hierarchicalCheckboxes = new (function() {
    
    this.init = () => {
        document.addEventListener('change', checkboxClickEvent, true);
        document.addEventListener('enable-change', checkboxClickEvent, true);
    }

    const getOwnedEls = (el) => {
        const selectAllFor = el.getAttribute('data-select-all-for');
        const selectAllForIds = selectAllFor.trim().split(/\s+/g);
        let r = [];
        
        selectAllForIds.forEach((childId) => {
            const childEl = document.getElementById(childId);
            if (childEl) {
                r.push(childEl);
            } else {
                console.warn(`No element with id "${childId}" as referenced in data-select-all-for attribute:`, el);
            }
        })

        return r;
    }

    const getOwnerEl = (el) => {
        const { id } = el;

        if (id) {
            const owner = document.querySelector(`[data-select-all-for~="${id}"]`);
            return owner;
        } else {
            return null;
        }
    } 
    
    const checkboxClickEvent = (e) => {
        const { target } = e;
        const { nodeName, type } = target;
        const selectAllFor = target.getAttribute('data-select-all-for');

        // If it is the "select all" checkbox
        if (selectAllFor) {
            selectAllClickEvent(target);
        // If it is for an HTML5 checkbox child
        } else if (nodeName === 'INPUT' && type === 'checkbox') {
            const ownerEl = getOwnerEl(target);

            if (ownerEl) {
                ownedHTML5CheckboxClickEvent(target, ownerEl);
            }
        
        // If it is for an ARIA checkbox child
        } else if (target.getAttribute('role') === 'checkbox') {
            const ownerEl = getOwnerEl(target);

            if (ownerEl) {
                ownedARIACheckboxClickEvent(target, ownerEl);
            }
        }
    }




    const selectAllClickEvent = (target) => {
        const ownedEls = getOwnedEls(target);
        
        ownedEls.forEach((el) => {
            if (el.nodeName === 'INPUT' && el.type === 'checkbox') {
                el.checked = target.checked;
            } else {
                const targetAriaChecked = target.getAttribute('aria-checked');
                switch (targetAriaChecked) {
                    case 'true':
                    case 'false':
                        el.setAttribute('aria-checked', targetAriaChecked);
                        break;
                    default:
                        el.setAttribute('aria-checked', 'false');
                }
            }
        })
    };


    const ownedHTML5CheckboxClickEvent = (target, ownerEl) => {
        const ownedEls = getOwnedEls(ownerEl);
        let checkedCount = 0;

        for (const ownedEl of ownedEls) {
            if (ownedEl.checked) {
                checkedCount++;
            }
        }

        if (checkedCount === 0) {
            ownerEl.checked = false;
            ownerEl.indeterminate = false;
        } else if (checkedCount === ownedEls.length) {
            ownerEl.checked = true;
            ownerEl.indeterminate = false;
        } else {
            ownerEl.checked = false;
            ownerEl.indeterminate = true;
        }
    }

    const ownedARIACheckboxClickEvent = (target, ownerEl) => {
        const ownedEls = getOwnedEls(ownerEl);
        let checkedCount = 0;

        for (const ownedEl of ownedEls) {
            if (ownedEl.getAttribute('aria-checked') === 'true') {
                checkedCount++;
            }
        }

        if (checkedCount === 0) {
            ownerEl.setAttribute('aria-checked', 'false');
        } else if (checkedCount === ownedEls.length) {
            ownerEl.setAttribute('aria-checked', 'true');
        } else {
            ownerEl.setAttribute('aria-checked', 'mixed');
        }
    }
})