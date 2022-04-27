import showcode from "../enable-libs/showcode.js";

const alert = new (function () {
  const sayTimeEl = document.getElementById("say-time");
  const assertiveAlertEl = document.getElementById("assertive-alert");

  this.sayTimeClickHandler = () => {
    assertiveAlertEl.innerHTML = `The time now is ${new Date().toLocaleTimeString()}`;
  };

  this.checkboxChangeHandler = (e) => {
    assertiveAlertEl.setAttribute(
      "aria-expanded",
      checkboxEl.checked ? "true" : "false"
    );
  };

  this.init = () => {
    sayTimeEl.addEventListener("click", this.sayTimeClickHandler);
  };
})();

showcode.addJsObj('alert', alert);

alert.init();

