'use-strict'

const cookieBanner = new function() {
  let cookieBanner;

  this.init = function() {
    cookieBanner = document.getElementById('cookie-banner');
    setUpModalButton();
    setUpNonModalButton();
  }

  function setUpModalButton() {
    const showModalButton = document.getElementById('show-modal-button');
    showModalButton.addEventListener('click', () => {
      cookieBanner.showModal();
    });
  }

  function setUpNonModalButton() {
    const showNonModalButton = document.getElementById('show-non-modal-button');
    showNonModalButton.addEventListener('click', () => {
      cookieBanner.show();
    })
  }
}

export default cookieBanner;
