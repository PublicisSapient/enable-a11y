/*
 
 ============================================
 License for Application
 ============================================
 
 This license is governed by United States copyright law, and with respect to matters
 of tort, contract, and other causes of action it is governed by North Carolina law,
 without regard to North Carolina choice of law provisions.  The forum for any dispute
 resolution shall be in Wake County, North Carolina.
 
 Redistribution and use in source and binary forms, with or without modification, are
 permitted provided that the following conditions are met:
 
 1. Redistributions of source code must retain the above copyright notice, this list
 of conditions and the following disclaimer.
 
 2. Redistributions in binary form must reproduce the above copyright notice, this
 list of conditions and the following disclaimer in the documentation and/or other
 materials provided with the distribution.
 
 3. The name of the author may not be used to endorse or promote products derived from
 this software without specific prior written permission.
 
 THIS SOFTWARE IS PROVIDED BY THE AUTHOR "AS IS" AND ANY EXPRESS OR IMPLIED
 WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE
 LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 
 */

const a11yModal = new function () {

    let modalEl;
    const mainEl = document.getElementById('a11y-modal__non-modal-content');
    const overlayEl = document.getElementById('a11y-modal__overlay');

    // jQuery formatted selector to search for focusable items
    const focusableElementsString = "a[href], \
        area[href], \
        details, \
        iframe, \
        [contentEditable=true], \
        :enabled, \
        object, \
        embed, \
        [tabindex]";

    // store the item that has focus before opening the modal window
    let focusedElementBeforeModal;


    this.init = function () {
        if (overlayEl) {
            document.addEventListener('click', clickEventHandler, true);
            document.addEventListener('keydown', keydownEventHandler);
        } else {
            return;
        }
    }

    function clickEventHandler(e) {
        let target = e.target;

        if (!target) {
            return;
        }

        let modalFunction = target.dataset.modalFunction;
        
        // in case we clicked in an element whose parent has data-modal-function set.
        if (!modalFunction) {
            target = target.closest('[data-modal-function]');

            if (!target ) {
                return;
            } else {
                modalFunction = target.dataset.modalFunction;
            }
        }

        modalDataset = target.dataset;
        modalFunction = modalDataset.modalFunction;

        let buttonFor, modalEl;
        switch(modalFunction) {

            case "show":
                if ((buttonFor = modalDataset.modalButtonFor) && (modalEl = document.getElementById(buttonFor))) {
                    showModal(modalEl);
                } else {
                    console.error('Buttons that open modals must have a `data-button-for` attribute set to the `id` of the modal it should open', modalDataset);
                }
                
                break;
            case "hide":
                hideModal();
                break;
            case "enter":
                enterButtonModal();
                break;
        }
    }

    function keydownEventHandler (e) {
        if (e.which == 27) {
            hideModal();
        }
    }

    function isVisible(elem) {
        return elem.offsetWidth > 0 || elem.offsetHeight > 0 || elem.getClientRects().length > 0;
    }

    function getFocusableItemInElement(el) {
        const focusableElements = el.querySelectorAll(focusableElementsString);

        for (let i=0; i <= focusableElements.length; i++) {
            const focusableEl = focusableElements[i];
            if (isVisible(focusableEl)) {
                return focusableEl;
            }
        }
       
        return null;
    }

    function setFocusOnModal(el) {
        const itemToFocus = getFocusableItemInElement(el);
        console.log(itemToFocus);
        if (itemToFocus) {
            itemToFocus.focus();
        }
    }

    function enterButtonModal() {
        // BEGIN logic for executing the Enter button action for the modal window
        alert('form submitted');
        // END logic for executing the Enter button action for the modal window
        hideModal();
    }

    function setFocusabilityOutsideModals(isFocusableOutsideModal) {
        const focusableElsOutsideModal = mainEl.querySelectorAll(focusableElementsString);
        console.log('focusableElsOutsideModal', focusableElsOutsideModal);

        for (let i = 0; i < focusableElsOutsideModal.length; i++ ) {
            const el  = focusableElsOutsideModal[i];
            if (isFocusableOutsideModal) {
                const oldTabIndex = el.dataset.modalOldTabIndex
                if (oldTabIndex) {
                    el.setAttribute('tabIndex', oldTabIndex);
                } else {
                    el.removeAttribute('tabIndex');
                }
            } else {
                const tabIndex = el.getAttribute('tabIndex');
                if (tabIndex !== null) {
                    el.dataset.modalOldTabIndex = tabIndex;
                }
                el.setAttribute('tabIndex', '-1');
            }
        }
    }

    function showModal(obj) {
        modalEl = obj;
        mainEl.setAttribute('aria-hidden', 'true'); // mark the main page as hidden
        overlayEl.classList.add('visible'); // insert an overlay to prevent clicking and make a visual change to indicate the main apge is not available
        modalEl.classList.add('visible');
        modalEl.setAttribute('aria-hidden', 'false'); // mark the modal window as visible
        modalEl.setAttribute('aria-expanded', 'true'); // mark the modal as expanded


        // save current focus
        focusedElementBeforeModal = document.activeElement;
        console.log('focusing', obj)
        setFocusOnModal(obj);
        
        // ensure things outside the modal are not tabbable.
        setFocusabilityOutsideModals(false);
        

    }

    function hideModal() {
        
        overlayEl.classList.remove('visible'); // remove the overlay in order to make the main screen available again
        modalEl.classList.remove('visible'); // hide the modal window
        modalEl.setAttribute('aria-hidden', 'true'); // mark the modal window as hidden
        mainEl.setAttribute('aria-hidden', 'false'); // mark the main page as visible
        modalEl.setAttribute('aria-expanded', 'false'); // mark the modal window as not expanded.

        // ensure things outside the modal are tabbable again.
        setFocusabilityOutsideModals(true);

        // set focus back to element that had it before the modal was opened
        focusedElementBeforeModal.focus();
    }
}

/*
 * .closest() polyfill for IE9+ (and other browsers that don't support it)
 * from https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
 */
if (!Element.prototype.matches)
    Element.prototype.matches = Element.prototype.msMatchesSelector || 
                                Element.prototype.webkitMatchesSelector;

if (!Element.prototype.closest)
    Element.prototype.closest = function(s) {
        var el = this;
        if (!document.documentElement.contains(el)) return null;
        do {
            if (el.matches(s)) return el;
            el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1); 
        return null;
    };

a11yModal.init();