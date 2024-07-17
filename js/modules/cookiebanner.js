'use-strict'

const cookieBanner = new function() {
  let modalCookieBanner;
  let nonModalCookieBanner;

  this.init = function() {
    modalCookieBanner = document.getElementById('modal-cookie-banner');
    nonModalCookieBanner = document.getElementById('non-modal-cookie-banner');
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
      nonModalCookieBanner.show();
    })
  }
}

export default cookieBanner;
