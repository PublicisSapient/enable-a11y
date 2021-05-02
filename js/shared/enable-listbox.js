const enableListbox = new function() {
  
  this.init = function () {
    const { body } = document;
    
    document.addEventListener('click', this.onClick);
    body.addEventListener('keyup', this.onKeyup);
    body.addEventListener('keydown', this.onKeydown);
  }

  this.onKeydown = (e) => {
    this.lastKeydownEl = document.activeElement;
  }

  this.onKeyup = (e) => {
    const { key, target } = e;
    const normalizedKey = accessibility.normalizedKey(key);

    if (this.lastKeydownEl !== target || (normalizedKey !== 'Enter' && normalizedKey !== ' ' && normalizedKey !== 'Escape')) {
      return;
    }

    lastKeydownEl = null; 
    const { activeElement } = document;

    if (activeElement.getAttribute('role') === 'option') {

      const root = activeElement.closest('.enable-listbox');
      const listboxEl = root.querySelector('[role="listbox"]');
      const optionEls = listboxEl.querySelectorAll('[role="option"]');
      const buttonEl = root.querySelector('[aria-haspopup="listbox"]');

      if (normalizedKey === 'Escape') {
        listboxEl.removeEventListener('blur', this.blurEvent, true);
      }

      this.collapse(buttonEl, listboxEl, true)

      if (normalizedKey === 'Escape') {
        listboxEl.addEventListener('blur', this.blurEvent, true);
      }
    }
  }

  this.onClick = (e) => {

    const { target } = e;
    const root = target.closest('.enable-listbox');

    if (root) {
      const listboxEl = root.querySelector('[role="listbox"]');
      const optionEls = listboxEl.querySelectorAll('[role="option"]');
      const buttonEl = root.querySelector('[aria-haspopup="listbox"]');
      const activeId = buttonEl.getAttribute('aria-activedescendant');

      // ensure all options can have programmatic focus
      optionEls.forEach(element => {
        element.setAttribute('tabIndex', '-1');
        if (activeId && element.id === activeId) {
          element.setAttribute('aria-selected', 'true');
        } else if (!element.getAttribute('aria-selected')) {
          element.setAttribute('aria-selected', 'false');
        }
      });

      
      if (target.nodeName === 'BUTTON') {
        const ariaExpanded = target.getAttribute('aria-expanded');

        // if the listbox is already expanded, close it
        if (ariaExpanded === 'true') {
          this.collapse(buttonEl, listboxEl, true);
        // if the listbox is collapsed, expand it.
        } else {
          target.setAttribute('aria-expanded', 'true');
          listboxEl.classList.remove('hidden');
          // set focus on appropriate option
          window.requestAnimationFrame(() => {
            const itemToFocus = listboxEl.querySelector('[aria-selected="true"]') || optionEls[0];
            console.log('1');
            itemToFocus.focus();
            accessibility.setMobileFocusLoop(listboxEl);
            // make the arrow keyup events happen if needed
            if (listboxEl.dataset.enableListboxInit !== 'true') {
              this.initListbox(listboxEl, buttonEl);
            }
          });

        }
      }
    } else {
      // the user clicked outside of the control.  We assume the must want to
      // close all dropdowns on the page.
      this.collapseAllListboxes();
    }

  }

  this.collapseAllListboxes = function(e) {
    const roots = document.querySelectorAll('.enable-listbox');

    for (let i = 0; i < roots.length; i++ ) {
      const root = roots[i];
      const buttonEl = root.querySelector('[aria-haspopup="listbox"]');
      const ariaExpanded = buttonEl.getAttribute('aria-expanded');

      if (ariaExpanded === 'true') {
        const listboxEl = root.querySelector('[role="listbox"]');
        this.collapse(buttonEl, listboxEl, false);
      }
    }
  }

  this.collapse = (buttonEl, listboxEl, doFocus) => {
    listboxEl.classList.add('hidden');
    accessibility.removeMobileFocusLoop();
    buttonEl.removeAttribute('aria-expanded');

    if (doFocus) {
      console.log('2');
      buttonEl.focus();
    }
    listboxEl.classList.add('hidden');
  }

  this.initListbox = (listboxEl, buttonEl) => {
    accessibility.initGroup(
      listboxEl,
      {
          doKeyChecking: false,
          ariaCheckedCallback: (e, currentlyCheckedEl, currentlyCheckedIndex, previouslyCheckedEl, groupEls) => {
              buttonEl.innerHTML = currentlyCheckedEl.innerHTML;
              this.collapse(buttonEl, listboxEl, true);
              accessibility.removeMobileFocusLoop();
          }
      }
    );
    listboxEl.addEventListener('blur', this.blurEvent, true);

    listboxEl.dataset.enableListboxInit = 'true';
  }

  this.blurEvent = (e) => {
    const { target } = e;
    const root = target.closest('.enable-listbox');
    const listboxEl = root.querySelector('[role="listbox"]');
    const buttonEl = root.querySelector('[aria-haspopup="listbox"]');

    accessibility.doIfBlurred(e, () => {
      const { target } = e;
      if (target.getAttribute('role') === 'option') {
        target.click();
      }
      this.collapse(buttonEl, listboxEl, true);
    });
  }
}

enableListbox.init();

console.log('is this thing on?')