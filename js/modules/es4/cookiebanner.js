'use-strict'

const cookieBanner = new (function() {
  let modalCookieBanner;

  this.init = function() {
    modalCookieBanner = document.getElementById('cookie-banner');
    setUpModalButton();
    setUpNonModalButton();
  }

  function setUpModalButton() {
    const showModalButton = document.getElementById('show-modal-button');
    showModalButton.addEventListener('click', () => {
      modalCookieBanner.showModal();
    });
  }

  function setUpNonModalButton() {
    const showNonModalButton = document.getElementById('show-non-modal-button');
    showNonModalButton.addEventListener('click', () => {
      modalCookieBanner.show();
    })
  }
})
