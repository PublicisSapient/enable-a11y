const detailsAccordion = new (function () {
  this.init = function () {
    document.body.addEventListener("click", function (e) {
      requestAnimationFrame(() => {
        var target = e.target;

        if (target.classList.contains("details-accordion__button")) {
          const accordionEl = target.closest(".details-accordion");


          if (target.nodeName === "SUMMARY") {
            
            if (accordionEl) {
              const drawers = accordionEl.querySelectorAll("summary");
              drawers.forEach((drawer) => {
                const detailsEl = drawer.closest("details");
                if (drawer === target) {
                    console.log('x', drawer.getAttribute('aria-disabled'));
                  if (drawer.getAttribute('aria-disabled') === 'true') {
                    detailsEl.open = true;
                  } else {
                    drawer.setAttribute("aria-disabled", "true");
                  }
                } else {
                  drawer.removeAttribute("aria-disabled");
                  detailsEl.open = false;
                }
              });
            }
          } 
        }
      });
    });
  };

  this.init();
})();
