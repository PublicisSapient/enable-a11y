'use-strict'

const cookieBanner = new (function() {
  let cookieBanner;
  let cookieBannerAside;

  this.init = function() {
    cookieBanner = document.getElementById('cookie-banner');
    setUpModalButton();
    setUpNonModalCookieBanner();
  }

  function setUpModalButton() {
    const showModalButton = document.getElementById('show-modal-button');
    showModalButton.addEventListener('click', () => {
      cookieBanner.showModal();
    });
  }
  
  function setUpNonModalCookieBanner() {
    cookieBannerAside = document.getElementById('non-modal-cookie-banner');
    setUpShowNonModalButton();
    setUpNonModalActionButtons();
  }

  function setUpShowNonModalButton() {
    const showNonModalButton = document.getElementById('show-non-modal-button');
    showNonModalButton.addEventListener('click', (event) => {
      cookieBannerAside.classList.add('non-modal-cookie-banner__show');
    })
  }
  
  function setUpNonModalActionButtons() {
    const close = document.getElementById('non-modal-cookie-banner-close-button');
    close.addEventListener('click', onNonModalActionButtonClicked);
    
    const accept = document.getElementById('non-modal-cookie-banner-accept-button');
    accept.addEventListener('click', onNonModalActionButtonClicked);
    
    const reject = document.getElementById('non-modal-cookie-banner-reject-button')
    reject.addEventListener('click', onNonModalActionButtonClicked);
  }
  
  function onNonModalActionButtonClicked() {
    cookieBannerAside.classList.remove('non-modal-cookie-banner__show');
  }
})
