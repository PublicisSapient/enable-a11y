document.querySelectorAll('.bottom-fixed-nav__link').forEach((el) => {
    el.addEventListener('click', (e) => {
        e.preventDefault();
        alert('This is a demo, so this link is for display purposes only.');
    });
});
