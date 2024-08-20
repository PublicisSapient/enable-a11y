const $form = document.getElementById('group-example__form');
const $checkboxes = $form.querySelectorAll('input[type="checkbox"]');
const $error = document.getElementById('html-checkbox__error');

$form.addEventListener('submit', (e) => {
    e.preventDefault();
    let isFormValid = false;
    for (let i = 0; i < $checkboxes.length; i++) {
        if ($checkboxes[i].checked) {
            isFormValid = true;
            break;
        }
    }

    if (isFormValid) {
        $error.classList.remove('visible');
        alert(
            'The lord of the underworld has been informed. He respects your wishes.',
        );
        e.stopPropagation();
    } else {
        $error.classList.add('visible');
        $error.focus();
    }
});
