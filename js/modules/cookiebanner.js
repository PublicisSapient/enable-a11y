'use-strict'

import { DialogFocusManager } from "../enable-libs/dialogFocusManager.js";

const cookieBanner = new function () {
  this.init = function () {
    setUpShowModalButton();
    setUpShowNonModalButton();

    const dialog = document.getElementById(`cookie-banner`);
    const manager = new DialogFocusManager();
    manager.focusOn(dialog);
  }

  function setUpShowModalButton() {
    const showModalButton = document.getElementById('show-modal-button');
    showModalButton.addEventListener('click', () => {
      const cookieBanner = document.getElementById('cookie-banner');
      cookieBanner.showModal();
    });
  }

  function setUpShowNonModalButton() {
    const showNonModalButton = document.getElementById('show-non-modal-button');
    showNonModalButton.addEventListener('click', (event) => {
      appendAside();
      setUpNonModalActionButtons();
    })
  }

  function appendAside() {
    const closeButton = createCloseButton();
    const documentDiv = createDocumentDiv();
    const actionButtonsDiv = createActionButtons();

    const aside = createElement('aside', {
      id: 'non-modal-cookie-banner',
      class: 'non-modal-cookie-banner',
      'aria-labelledby': 'non-modal-cookie-banner-title'
    }, [closeButton, documentDiv, actionButtonsDiv]);

    document.body.appendChild(aside);
  }

  function createCloseButton() {
    const closeIcon = createElement('img', {
      class: 'cookie-banner__close-button__icon',
      src: 'images/close-window.svg',
      alt: 'close cookie notice'
    });
    
    return createElement('button', {
      id: 'non-modal-cookie-banner-close-button',
      class: 'cookie-banner__close-button',
      autofocus: 'true'
    }, [closeIcon]);
  }
  
  function createDocumentDiv() {
    const title = createTitle();
    const message = createMessage();
    
    return createElement('div', {
      role: 'document'
    }, [title, message]);
  }
  
  function createTitle() {
    return createElement('h2', {
      id: 'non-modal-cookie-banner-title',
      class: 'cookie-banner__title',
      textContent: 'Cookie Notice'
    });
  }
  
  function createMessage() {
    return createElement('p', {
      id: 'non-modal-cookie-banner-message',
      textContent: 'We use strictly necessary cookies to make our Sites work. In addition, if you consent, we will use optional functional, performance and targeting cookies to help us understand how people use our website, to improve your user experience and to provide you with targeted advertisements. You can accept all cookies, or click to review your cookie preferences.'
    });
  }
  
  function createActionButtons() {
    const acceptButton = createElement('button', {
      id: 'non-modal-cookie-banner-accept-button',
      class: 'cookie-banner__accept-button',
      textContent: 'Accept'
    });
    
    const rejectButton = createElement('button', {
      id: 'non-modal-cookie-banner-reject-button',
      class: 'cookie-banner__reject-button',
      textContent: 'Reject'
    });
    
    return createElement('div', {
      class: 'cookie-banner__action-buttons'
    }, [acceptButton, rejectButton]);
  }
  
  function createElement(tag, attributes = {}, children = []) {
    const element = document.createElement(tag);
    Object.keys(attributes).forEach(key => {
      if (key === 'textContent') {
        element.textContent = attributes[key];
      } else {
        element.setAttribute(key, attributes[key]);
      }
    });
    children.forEach(child => element.appendChild(child));
    return element;
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
    cleanUpNonModalActionButtons();
    const aside = document.getElementById(`non-modal-cookie-banner`);
    aside.remove();
  }

  function cleanUpNonModalActionButtons() {
    const close = document.getElementById('non-modal-cookie-banner-close-button');
    close.removeEventListener('click', onNonModalActionButtonClicked);
  
    const accept = document.getElementById('non-modal-cookie-banner-accept-button');
    accept.removeEventListener('click', onNonModalActionButtonClicked);
  
    const reject = document.getElementById('non-modal-cookie-banner-reject-button')
    reject.removeEventListener('click', onNonModalActionButtonClicked);
  }
}

export default cookieBanner;
