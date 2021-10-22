const readMore = new function () {

    this.clickEvent = (e) => {
        const { target, currentTarget } = e;
        console.log('target', target, currentTarget);

        if (target.classList.contains('read-more__button')) {
            const isExpanded = target.getAttribute('aria-expanded') === 'true';
            const wrapper = target.closest('.read-more__wrapper');
            const container = wrapper ? wrapper.querySelector('.read-more__container') : null;
            const overflowContent = wrapper ? wrapper.querySelector('.read-more__overflow-content') : null;
            const focusPoint = wrapper ? wrapper.querySelector('.read-more__focus-point') : null;
            const alert = wrapper ? wrapper.querySelector('.read-more__alert') : null;

            if (wrapper && container && overflowContent && focusPoint) {
                if (isExpanded) {
                    target.setAttribute('aria-expanded', 'false');
                    overflowContent.classList.remove('read-more__overflow-content--visible');
                    target.innerHTML = "Show more";
                } else {
                    target.setAttribute('aria-expanded', 'true');
                    overflowContent.classList.add('read-more__overflow-content--visible');
                    focusPoint.focus();
                    target.innerHTML = "Show less";
                }
            }
        }
    }

    document.body.addEventListener('click', this.clickEvent)
}

