'use strict';

/*******************************************************************************
 * native-form-example.js - Demo of accessible native HTML5 form validation.
 *
 * Released under the MIT License.
 ******************************************************************************/

const nativeForm = new (function () {
    const colonRe = /:$/;

    /**
     * invalidEvent(): Event handler for the `invalid` event on a form field.
     * @param {Event} e
     *
     * When a form field is invalid, we should ensure the message bubble:
     * 1) Has the word "Error: " at the beginning (so all screen reader users)
     *    know that it is an error.
     * 2) Has the name of the form field that has the error (since not all
     *    browsers will say the label of the form field when the error bubble
     *    appears).
     */
    function invalidEvent(e) {
        const { target } = e;
        const { id } = target;
        const $labelEl = document.querySelector(`label[for="${id}"]`);
        const label = $labelEl.innerText.replace(colonRe, '');
        target.setCustomValidity(`Error: ${label} is not valid.`);
        target.setAttribute('aria-invalid', 'true');

        console.log(id);
    }

    /**
     * changeEvent(): Change event on a form field.
     * @param {Event} e
     *
     * When a form field value has changed, we should ensure that the
     * message bubble is cleared.  If we don't do this, and the form is
     * submitted, the form field will be focused on and an error will
     * appear even though the field was filled out correctly.
     */
    function changeEvent(e) {
        const { target } = e;
        const { form } = target;

        if (form) {
            target.setCustomValidity('');
            target.removeAttribute('aria-invalid');
        }
    }

    /**
     * init(): Initialization routine of this object.
     */
    this.init = () => {
        document.body.addEventListener('invalid', invalidEvent, true);
        document.body.addEventListener('change', changeEvent, true);
    };
})();

nativeForm.init();
