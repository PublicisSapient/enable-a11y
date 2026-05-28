// eslint-disable-next-line no-unused-vars
const ariaButtonExample = new (function () {
    const activate = (e) => {
        const { target } = e;

        if (
            (target.role === 'button' && target.nodeName === 'DIV') &&
            (e.type === 'click' || e.key === ' ' || e.key === 'Enter')
        ) {
            e.preventDefault();
            e.stopPropagation();
            alert('An ARIA Button has been triggered');
        }
    };

    document.addEventListener('click', activate);

    // This is only needed when the button is a <DIV> or some other
    // element that isn't natively keyboard accessible.
    document.addEventListener('keyup', activate);
})();
