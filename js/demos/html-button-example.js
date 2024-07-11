var htmlButtonExample = new (function () {
    const activate = (e) => {
        const { target } = e;
        if (
            target.tagName === 'BUTTON' &&
            target.closest('main') &&
            target.closest('.enable-example') &&
            target.id !== 'aria-js-disabled-button'
        ) {
            alert('this HTML button has been triggered');
        }
    };

    document.addEventListener('click', activate);
})();
