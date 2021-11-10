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


const dictLookup = new (function () {
  const baseURL = "./bin/lookupWord.php?word=";

  const $pageTitle = document.querySelector(".wiktionary-lookup__page-title");
  const $wikiInfo = document.querySelector(".wiktionary-lookup__content");
  const $sourceURL = document.querySelector(".wiktionary-lookup__source-url");
  const $licenceInfo = document.querySelector(
    ".wiktionary-lookup__license-info"
  );
  const $lookupForm = document.querySelector(".wiktionary-lookup__form");
  const $word = document.querySelector(".wiktionary-lookup__word");
  const $pageAlert = document.querySelector(".wiktionary-lookup__page-alert");

  function showPage(page, text) {
    const sourceurl = baseURL + "/wiki/" + page;
    $pageTitle.innerHTML = page;
    $wikiInfo.innerHTML = text;
    $sourceURL.setAttribute("href", sourceurl);
    $licenceInfo.style.display = "block";
    $pageAlert.innerHTML = `Now displaying information about the word "${page}".`;

    // now you can modify content of #wikiInfo as you like
    document
      .querySelectorAll(
        '#wikiInfo a:not(.references a):not(.extiw):not([href^="#"])'
      )
      .forEach((el) => {
        el.setAttribute("href", baseURL + el.getAttribute("href"));
      });
    // ...
  }

  this.init = () => {
    $pageTitle.style.display = "none";
    $lookupForm.addEventListener("submit", function (e) {
      const word = $word.value;
      const $msg = `<p>Please wait .. looking up "${word}".</p>`;
      e.preventDefault();
      $wikiInfo.innerHTML = $msg;
      $pageAlert.innerHTML = $msg;
      fetch(baseURL + word).then((response) => {
        if (response.status === 200) {
          response.json().then((json) => {
            const msg = `<p>Unable to find any information about "${word}".</p>`;
            if (json && json.parse && json.parse.revid > 0) {
              showPage(word, json.parse.text["*"]);
            } else {
              $wikiInfo.innerHTML = msg;
              $pageAlert.innerHTML = msg;
              $licenceInfo.style.display = "block";
            }
          });
        }
      });
    });
  }

})();

alert.init();
dictLookup.init();
