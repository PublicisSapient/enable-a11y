new (function () {
    const activate = (e) => {
        const { target } = e;
        if (
            (target.tagName === 'BUTTON' || target.tagName === 'A') &&
            target.closest('.click-example') 
        ) {
            e.preventDefault();
            e.stopPropagation();
            alert('A button has been triggered');
        }
    };

    document.addEventListener('click', activate);
})();
