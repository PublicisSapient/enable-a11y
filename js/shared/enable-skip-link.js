const enableSkipLink = new (function (e) {
  const containerSelector = ".enable-skip-link__container";

  this.init = function () {
    document.addEventListener("click", this.clickEvent, true);
    document.addEventListener("scroll", this.scrollEvent, true);
    window.addEventListener("resize", this.hideAll);
    window.addEventListener("orientationchange", this.hideAll);

    // Firefox will cache the scroll location of all scrollable
    // containers, so we want to reset our skip links onload.
    this.hideAll();
  };

  this.scrollEvent = e => {
    const { target } = e;

    if (!target.closest) {
      return;
    }
    const skipLinkContainer = target.closest(containerSelector);

    if (skipLinkContainer) {
      if (skipLinkContainer.scrollLeft !== 0) {
        skipLinkContainer.classList.add("enable-skip-link__container--visible");
        const destinationLink = skipLinkContainer.querySelector(
          ".enable-skip-link"
        );
        const top = destinationLink.getBoundingClientRect().top;
        const htmlEl = document.querySelector("html");

        console.log(target, destinationLink, htmlEl.scrollTop, top);
        if (htmlEl.scrollTop > top) {
          htmlEl.scrollTop = top - 100;
        } else if (htmlEl.scrollTop + window.innerHeight < top) {
          htmlEl.scrollTop = top - 100;
        }
      }
    }
  };

  this.hideAll = el => {
    const containers = document.querySelectorAll(containerSelector);
    for (let i = 0; i < containers.length; i++) {
      this.hide(containers[i]);
    }
  };

  this.hide = function (el) {
    el.scrollLeft = 0;
    el.scrollTop = 0;
    el.classList.remove("enable-skip-link__container--visible");
  };

  this.clickEvent = e => {
    // Since Firefox doesn't focus the <a>'s target,
    // we need to do so in JavaScript.
    const { target } = e;

    if (target.classList.contains("enable-skip-link")) {
      e.preventDefault();
      let { href } = target;
      href = href.split("#");
      const destinationLink = document.getElementById(href[href.length - 1]);
      destinationLink.focus();
    }
  };

  this.init();
})();
