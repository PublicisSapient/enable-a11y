import showcode from '../enable-libs/showcode.js';

const progressTest = new (function () {
    let counter = 1;
    let timeout = null;

    this.init = function () {
        const progressEls = document.querySelectorAll(
            'progress, [role="progressbar"]',
        );
        progressEls.forEach((el) => {
            const next = el.nextElementSibling;
            const nextClassList = next && next.classList;

            if (
                nextClassList &&
                (nextClassList.contains('arrow') ||
                    nextClassList.contains('after'))
            ) {
                el = next;
            }

            if (!el.id) {
                el.id = 'id' + counter;
                counter++;
            }

            const submitEl = document.createElement('input');
            submitEl.className = 'progress-test__button';
            submitEl.dataset.for = el.id;
            submitEl.setAttribute('type', 'submit');
            submitEl.value = 'Test Progress Bar';

            el.parentNode.insertBefore(submitEl, el.nextSibling);
            submitEl.addEventListener('click', this.progressTestClickEvent);
        });
    };

    this.progressTestClickEvent = (e) => {
        if (timeout) {
            clearTimeout(timeout);
        }

        e.preventDefault();
        const id = e.target.dataset.for;

        const el = document.getElementById(id);
        const arrowEl = document.querySelector('[data-arrow-for="' + id + '"]');
        const isAria = el.getAttribute('role') === 'progressbar';
        const isFocusable = el.getAttribute('tabIndex') === '-1';

        if (arrowEl) {
            arrowEl.classList.add('noTransition');
        }

        if (isAria) {
            el.setAttribute('aria-valuenow', 0);
        } else {
            el.value = 0;
        }

        if (isFocusable) {
            el.focus();
        }

        el.setAttribute('aria-busy', 'true');

        timeout = setTimeout(function () {
            startHelper(arrowEl, el, isAria);
        }, 200);
    };

    function startHelper(arrowEl, el, isAria) {
        const start = parseFloat(isAria ? el.getAttribute('aria-valuemin') : 0);
        const max = parseFloat(
            isAria ? el.getAttribute('aria-valuemax') : el.max,
        );
        const timeout = parseInt(el.dataset.timeout || 100);
        const step = parseInt(el.dataset.step || 10);

        if (arrowEl) {
            arrowEl.classList.remove('noTransition');
        }

        startTimeout(start, el, step, max, timeout, isAria);
    }

    function startTimeout(n, el, step, max, ms, isAria) {
        const alertId = el.dataset.alert;
        const alertEl = alertId && document.getElementById(alertId);
        if (isAria) {
            el.setAttribute('aria-valuenow', n);
        } else {
            el.value = n;
        }

        if (el.dataset.setValuetext) {
            const stepLabelEl = el.querySelector('li:nth-child(' + n + ')');

            if (stepLabelEl) {
                el.setAttribute(
                    'aria-valuetext',
                    `Step ${n} of ${max}: ${stepLabelEl.innerHTML}`,
                );
            }
        }

        if (alertEl) {
            alertEl.innerHTML = `${(n * 100) / max}%`;
        }

        if (n < max) {
            timeout = setTimeout(function () {
                startTimeout(n + step, el, step, max, ms, isAria);
            }, ms);
        } else {
            el.setAttribute('aria-busy', 'false');
        }
    }
})();

showcode.addJsObj('progressTest', progressTest);
progressTest.init();
