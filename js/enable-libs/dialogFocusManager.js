import accessibility from '../../enable-node-libs/accessibility-js-routines/dist/accessibility.module.js';

export class DialogFocusManager {
  previousFocus;
  registeredDialogs;
  
  constructor() {
    this.previousFocus = null;
    this.registeredDialogs = new WeakMap();
    this.initFocusOutListener();
  }
  
  initFocusOutListener() {
    document.addEventListener('focusout', (ev) => {
      this.previousFocus = ev.target;
    }, true);
  }
  
  focusOn(dialog) {
    if (!window.WeakMap || !window.MutationObserver) {
      return;
    }
    
    if (dialog.localName !== 'dialog') {
      throw new Error('Failed to upgrade focus on dialog: The element is not a dialog.');
    }
    
    if (this.registeredDialogs.has(dialog)) {
      return;
    }
    
    this.registeredDialogs.set(dialog, null);
    this.overrideShowModal(dialog);
    this.observeDialogAttributes(dialog);
    this.addCloseEventListener(dialog);
  }
  
  overrideShowModal(dialog) {
    const realShowModal = dialog.showModal;
    dialog.showModal = () => {
      let savedFocus = document.activeElement;
      if (savedFocus === document || savedFocus === document.body) {
        savedFocus = this.previousFocus;
      }
      this.registeredDialogs.set(dialog, savedFocus);
      realShowModal.call(dialog);
    };
  }
  
  observeDialogAttributes(dialog) {
    const mo = new MutationObserver(() => {
      if (dialog.hasAttribute('open')) {
        accessibility.setKeepFocusInside(dialog, true);
      } else {
        accessibility.setKeepFocusInside(dialog, false);
      }
    });
    mo.observe(dialog, { attributes: true, attributeFilter: ['open'] });
  }
  
  addCloseEventListener(dialog) {
    dialog.addEventListener('close', () => {
      if (dialog.hasAttribute('open')) {
        return;
      }
      const savedFocus = this.registeredDialogs.get(dialog);
      if (document.contains(savedFocus)) {
        const wasFocus = document.activeElement;
        savedFocus.focus();
        if (document.activeElement !== savedFocus) {
          wasFocus.focus();
        }
      }
      this.registeredDialogs.set(dialog, null);
    });
  }
}
