var ariaButtonExample = new (function () {
    const activate = (e) => {
        const { target } = e;
        if (
            target.classList.contains('aria-button') &&
            (e.type == 'click' || e.key === ' ' || e.key === 'Enter')
        ) {
            e.preventDefault();
            e.stopPropagation();
            alert('this ARIA button has been triggered');
        }
    };

    document.addEventListener('click', activate);

    // This is only needed when the button is a <DIV> or some other
    // element that isn't natively keyboard accessible.
    document.addEventListener('keyup', activate);
})();
