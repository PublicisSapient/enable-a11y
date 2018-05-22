const progressTest = new function () {

    let counter = 1;

    this.init = function () {
        const progressEls = document.querySelectorAll('progress, [role="progressbar"]');
        progressEls.forEach(function (el, index) {
            const next = el.nextElementSibling;
            const nextClassList = next && next.classList;

            if (nextClassList && (nextClassList.contains('arrow') || nextClassList.contains('after'))) {
                el = next;
            }

            if (!el.id) {
                el.id = 'id' + counter;
                counter++;
            }

            const submitEl = document.createElement('input');
            submitEl.className = 'progressTest';
            submitEl.dataset.for = el.id;
            submitEl.setAttribute('type', 'submit');
            submitEl.value = 'Test Progress Bar';

            el.parentNode.insertBefore(submitEl, el.nextSibling);
            submitEl.addEventListener('click', progressTestClickEvent);
        });



    }

    function progressTestClickEvent(e) {
        e.preventDefault();
        const id = e.target.dataset.for;

        const el = document.getElementById(id);
        const arrowEl = document.querySelector('[data-arrow-for="' + id + '"]');
        const isAria = (el.getAttribute('role') === 'progressbar');

        if (arrowEl) {
            arrowEl.classList.add('noTransition');
        }

        if (isAria) {
            el.setAttribute('aria-valuenow', 0);
        } else {
            el.value = 0;
        }
        setTimeout(function () {
            startHelper(arrowEl, el, isAria);
        }, 200);
    }

    function startHelper(arrowEl, el, isAria) {
        
        const start = parseFloat(isAria ? el.getAttribute('aria-valuemin') : 0);
        const max = parseFloat(isAria ? el.getAttribute('aria-valuemax') : el.max);
        const timeout = parseInt(el.dataset.timeout || 100);
        const step = parseInt(el.dataset.step || 10);
        

        if (arrowEl) {
            arrowEl.classList.remove('noTransition');
        }

        startTimeout(start, el, step, max, timeout, isAria);


    }

    function startTimeout(n, el, step, max, ms, isAria) {
        
        if (isAria) {
            el.setAttribute('aria-valuenow', n);

        } else {
            el.value = n;
        }


        if (el.dataset.setValuetext) {
            const stepLabelEl = el.querySelector('li:nth-child(' + n + ')');

            if (stepLabelEl) {
                el.setAttribute('aria-valuetext', 'Step ' + n + ' of ' + max + ': ' + stepLabelEl.innerHTML );
            }
        }

        if (n < max) {
            setTimeout(function () {
                startTimeout(n + step, el, step, max, ms, isAria)
            }, ms);
        }
    }
}


progressTest.init();
