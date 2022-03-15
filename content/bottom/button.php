<script id="ariaButtonExample">
var ariaButtonExample = new function() {

  const activate = (e) => {
    const {
      target
    } = e;
    if (
      target.classList.contains('aria-button') &&
      (e.type == 'click' || e.key === ' ' || e.key === 'Enter')
    ) {
      e.preventDefault();
      e.stopPropagation();
      alert('this ARIA button has been triggered');
    }
  }

  document.addEventListener('click', activate);
  document.addEventListener('keyup', activate);
}

var htmlButtonExample = new function() {

  const activate = (e) => {
    const {
      target
    } = e;
    if (target.tagName === 'BUTTON' && target.closest('main')) {
      alert('this HTML button has been triggered');
    }
  }

  document.addEventListener('click', activate);
}
</script>