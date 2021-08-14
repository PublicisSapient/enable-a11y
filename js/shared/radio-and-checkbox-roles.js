const ariaRadioCheckboxShim = new (function () {
  const keycodes = { SPACE: 32, ENTER: 13 };

  this.navigate = (evt) => {
    if (
      evt.type == "click" ||
      evt.keyCode == keycodes.SPACE ||
      evt.keyCode == keycodes.ENTER
    ) {
      // ref is the element that fired the event.
      const ref = evt.target != null ? evt.target : evt.srcElement;
      const role = ref.getAttribute("role");

      if (ref)
        switch (role) {

          // For a radio button group, we must ensure only the element that
          // fired the event is checked and the others are unchecked.
          case "radio":
            // First, grab all other radios with the same name and uncheck them
            const name = ref.getAttribute("data-name");
            const allRadios = document.querySelectorAll(
              `[role="radio"][data-name=${name}]`
            );

            for (let i = 0; i < allRadios.length; i++) {
              const radio = allRadios[i];
              if (radio !== ref) {
                radio.setAttribute("aria-checked", "false");
              }
            }

            // Now, check the element that fired the event.
            ref.setAttribute("aria-checked", "true");

            // Ensure we don't fire any other event handler, including
            // browser defaults (e.g. pressing SPACE may cause the
            // page to scroll if we don't put this in.
            evt.preventDefault();
            evt.stopPropogation();
            break;

          // For checkboxes, we just have to toggle the checked state
          // of the element that fired the event.
          case "checkbox":
            ref.setAttribute(
              "aria-checked",
              ref.getAttribute("aria-checked") === "true" ? "false" : "true"
            );
            
            // Ensure we don't fire any other event handler, including
            // browser defaults (e.g. pressing SPACE may cause the
            // page to scroll if we don't put this in.
            evt.preventDefault();
            evt.stopPropogation();
            break;
        }
    }
  };

  document.addEventListener("click", this.navigate);
  document.addEventListener("keydown", this.navigate);
})();
