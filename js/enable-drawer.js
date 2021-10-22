const enableAriaDrawer = new function () {
    this.init = function () {
        document.body.addEventListener("click", function(e) {
            var target = e.target;


                const accordionEl = target.closest('.enable-accordion');

                if (target.nodeName !== 'SUMMARY') {
                    
                    const contentEl = document.getElementById(target.getAttribute('aria-controls'));
                    if (target.getAttribute('aria-expanded') !== 'true') {
                        target.setAttribute('aria-expanded', 'true');
                    } else {
                        target.setAttribute('aria-expanded', 'false');
                    }
                }
        });
    }

    this.init();
}