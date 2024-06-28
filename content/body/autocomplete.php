<!--
// v0 by Vercel.
// https://v0.dev/t/x487VW4mqN8
-->
<div id="html5-example" class="enable-example">
  <form class="form form--autocomplete" id="autocomplete">
    <fieldset class="form__fieldset">
      <legend class="form__legend">Checkout</legend>
      <div class="form__header">
        <h2 class="form__title">Checkout</h2>
        <p class="form__subtitle">Enter your information to complete your purchase.</p>
      </div>
      <div class="form__body">
        <fieldset class="form__group">
          <legend class="form__group-legend">Personal Information</legend>
          <div class="form__row form__row--two-cols">
            <div class="form__field">
              <label class="form__label" for="first-name" id="first-name-label">First name</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="text"
                  id="first-name"
                  placeholder="John"
                  autocomplete="given-name"
                  required
                  name="first-name"
                  aria-labelledby="first-name-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </div>
              </div>
            </div>
            <div class="form__field">
              <label class="form__label" for="last-name" id="last-name-label">Last name</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="text"
                  id="last-name"
                  placeholder="Doe"
                  autocomplete="family-name"
                  required
                  name="last-name"
                  aria-labelledby="last-name-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="form__group">
          <legend class="form__group-legend">Contact Information</legend>
          <div class="form__row">
            <div class="form__field">
              <label class="form__label" for="email" id="email-label">Email</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="email"
                  id="email"
                  placeholder="john@example.com"
                  autocomplete="email"
                  required
                  name="email"
                  aria-labelledby="email-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="form__row">
            <div class="form__field">
              <label class="form__label" for="address" id="address-label">Street address</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="text"
                  id="address"
                  placeholder="123 Main St"
                  autocomplete="address-line1"
                  required
                  name="address"
                  aria-labelledby="address-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="form__row form__row--three-cols">
            <div class="form__field">
              <label class="form__label" for="city" id="city-label">City</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="text"
                  id="city"
                  placeholder="New York"
                  autocomplete="address-level2"
                  required
                  name="city"
                  aria-labelledby="city-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                </div>
              </div>
            </div>
            <div class="form__field">
              <label class="form__label" for="state" id="state-label">State</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="text"
                  id="state"
                  placeholder="NY"
                  autocomplete="address-level1"
                  required
                  name="state"
                  aria-labelledby="state-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                </div>
              </div>
            </div>
            <div class="form__field">
              <label class="form__label" for="zip" id="zip-label">Zip</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="text"
                  id="zip"
                  placeholder="10001"
                  autocomplete="postal-code"
                  required
                  name="zip"
                  aria-labelledby="zip-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="form__row">
            <div class="form__field">
              <label class="form__label" for="country" id="country-label">Country</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="text"
                  id="country"
                  placeholder="United States"
                  autocomplete="country-name"
                  required
                  name="country"
                  aria-labelledby="country-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <div class="form__row">
            <div class="form__field">
              <label class="form__label" for="phone" id="phone-label">Phone</label>
              <div class="form__input-container">
                <input
                  class="form__input"
                  type="tel"
                  id="phone"
                  placeholder="(123) 456-7890"
                  autocomplete="tel"
                  required
                  name="phone"
                  aria-labelledby="phone-label"
                />
                <div class="form__input-icon" aria-hidden="true">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="form__icon"
                  >
                    <path
                      d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      <button class="form__button" type="submit">Place order</button>
    </fieldset>
  </form>
</div>




<?php includeShowcode("html5-example"); ?>
<script type="application/json" id="html5-example-props">
{
    "replaceHtmlRules": {},
    "steps": [
        {
        "label": "Insert form tag",
        "highlight": "\\s*&lt;[\/]?form&gt;",
        "notes": "Whenever you have form elements, include this tag.  It does a lot of things for you that you may not even be aware of."
        },
        {
        "label": "Insert fieldset and legend",
        "highlight": "\\s*&lt;[\/]?fieldset&gt; ||| \\s*&lt;legend[\\s\\S]*&gt;[\\s\\S]*&lt;/legend&gt;",
        "notes": "The <strong>legend</strong> tag must be a direct child of the <strong>fieldset</strong> tag in order for it to work across screen readers."
        },
        {
          "label": "Add the <code>aria-labelledby</code> attribute to announce the name of each form field.",
          "highlight": "aria-labelledby",
          "notes": "This should point to the <code>id</code> of the associated label tag."
        },
        {
          "label": "Use the <code>required</code> attribute to make a field required.",
          "highlight": "required",
          "notes": "This will prevent the form from being submitted if the field is empty."
        },
        {
          "label": "Use the <code>placeholder</code> attribute to provide a hint to the user.",
          "highlight": "placeholder",
          "notes": "This will help users understand what information is expected in the field."
        },
        {
          "label": "Use the <code>type</code> attribute to specify the type of input.",
          "highlight": "type",
          "notes": "This will help users understand what information is expected in the field."
        },
        {
          "label": "Use the <code>name</code> attribute to provide a name for the field.",
          "highlight": "name",
          "notes": "This will help you identify the field when the form is submitted."
        },
        {
          "label": "Use the <code>autocomplete</code> attribute to enable autocomplete on your input.",
          "highlight": "autocomplete",
          "notes": "This will help users fill out forms more quickly and accurately."
        },
        {
          "label": "Use the <code>id</code> attribute to provide a unique identifier for the field.",
          "highlight": "id",
          "notes": "This will help you associate the field with its label."
        },
        {
          "label": "Use the <code>class</code> attribute to style the input field.",
          "highlight": "class",
            "notes": "This will help you apply styles to the field."
        },
        {
          "label": "Use the <code>label</code> tag to provide a label for the field.",
          "highlight": "label",
          "notes": "This will help users understand what information is expected in the field."
        },
        {
          "label": "Use the <code>for</code> attribute to associate the label with the input field.",
          "highlight": "for",
          "notes": "This will help users understand what information is expected in the field."
        },
        {
          "label": "Use the <code>div</code> tag to group the label and input field.",
          "highlight": "div",
          "notes": "This will help you style the label and input field together."
        },
        {
          "label": "Use the <code>button</code> tag to create a submit button.",
          "highlight": "button",
          "notes": "This will allow users to submit the form."
        }
    ]
}
</script>