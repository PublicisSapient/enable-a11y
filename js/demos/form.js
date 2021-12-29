'use strict'

/*******************************************************************************
* form.js - Demo of accessible forms with jquery. 
* 
* Released under the MIT License.
******************************************************************************/

/* global $ */
import '../../node_modules/jquery/dist/jquery.min.js';
import '../../node_modules/jquery-validation/dist/jquery.validate.min.js';
import accessibility from '../../node_modules/accessibility-js-routines/dist/accessibility.module.js';

const formValidator = new (function () {
  this.init = () => {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form.js-form-validation").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        name_js: "required",
        email_js: {
          required: true,
          // Specify that email should be validated
          // by the built-in "email" rule
          email: true
        },
        phone_js: {
          required: true,
          phoneNumber: true
        }
      },
      // Specify validation error messages
      messages: {
        name_js: "Error: Please enter your first name",
        email_js: "Error: Please enter a valid email address",
        phone_js: "Error: Phone number invalid"
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function (form) {
        window.alert("form submitted");
        form.clear();
        //form.submit();
      },
      invalidHandler: function (form) {
        // make required fields that are not filled out have their aria-invalid="true"
        const formFields = form.target.elements;
        for (let i = 0; i < formFields.length; i += 1) {
          const formField = formFields[i];

          // If the form is invalid, we must focus the first invalid one (or
          // the first valid one if option.firstValue === true). Since fieldsets
          // are part of the elements array, we must exclude those.
          const isValid = formField.validity.valid;
          console.log(formField.validity.valid);
          if (
            formField.nodeName !== "FIELDSET" &&
            formField.required &&
            !isValid
          ) {
            const ariaDesc = formField.getAttribute("aria-describedby");
            const newAriaDesc = formField.id + "-error";
            formField.setAttribute("aria-invalid", "true");
            if (ariaDesc !== null && ariaDesc.indexOf(newAriaDesc) >= 0) {
              //formField.setAttribute('aria-describedby', newAriaDesc);
            } else {
              formField.dataset.origAriaDesc = ariaDesc;
              formField.setAttribute(
                "aria-describedby",
                ariaDesc + " " + formField.id + "-error"
              );
            }
          } else {
            const ariaDesc = formField.dataset.origAriaDesc;
            if (ariaDesc) {
              formField.setAttribute("aria-describedby", ariaDesc);
            } else {
              formField.removeAttribute("aria-describedby");
            }
            formField.removeAttribute("aria-invalid");
          }
        }

        accessibility.applyFormFocus(form.target);
      }
    });

    $.validator.methods.phoneNumber = function (value, element) {
      return (
        this.optional(element) ||
        /^[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}$/.test(value)
      );
    };

    // expose this module to showcode if it is on the page
    if (document.querySelector('.showcode')) {
      window.formValidator = this;
    }
  };
})();

formValidator.init();
