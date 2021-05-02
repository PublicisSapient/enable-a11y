const ariaLinkShim = new (function () {
  this.navigateLink = (e) => {
    
    // We want to activate on click or by pressing either
    // ENTER or SPACE. Why SPACE? To be extra careful, since the
    // W3C recommends both on buttons):
    //
    // https://www.w3.org/TR/using-aria/#third
    if (e.type == 'click' || e.key === ' ' || e.key === 'Enter') {
      const ref = e.target != null ? e.target : e.srcElement;
      if (ref && ref.getAttribute('role') === 'link') {
        window.location.href = ref.getAttribute('href');
      }
    }
  };

  document.addEventListener('click', this.navigateLink);
  document.addEventListener('keydown', this.navigateLink);
})();
