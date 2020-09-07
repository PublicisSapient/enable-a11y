dyslexiaSwitch = new function () {
  const el = document.getElementById('dyslexia-switch');
  const { body } = document;
  this.init = function () {
    document.addEventListener('switch-change', this.changeEvent);
  }

  this.changeEvent = (e) => {
    const { target } = e;
    if (el.getAttribute('aria-checked') === 'true') {
      body.classList.add('with-open-dyslexia');
    } else {
      body.classList.remove('with-open-dyslexia');
    }
  }
}

dyslexiaSwitch.init();