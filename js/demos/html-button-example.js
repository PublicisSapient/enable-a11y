var htmlButtonExample = new (function () {
    const activate = (e) => {
        const { target } = e;
        if (target.tagName === 'BUTTON' && target.closest('main')) {
            alert('this HTML button has been triggered');
        }
    };

    document.addEventListener('click', activate);
})();
