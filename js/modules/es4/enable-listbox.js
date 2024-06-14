'use strict'

const enableListbox = new (function() {

  const showEvent = new CustomEvent('enable-listbox-show', {
    bubbles: true
  });

  const hideEvent = new CustomEvent('enable-listbox-hide', {
    bubbles: true
  });

  this.init = function() {
    const { body } = document;

    document.addEventListener('click', this.onClick);
    body.addEventListener('keyup', this.onKeyup);
    body.addEventListener('keydown', this.onKeydown);
    body.addEventListener('mousedown', this.onMousedown)
  }

  this.onMousedown = (e) => {
    const { target } = e;

    if (target.classList.contains('enable-listbox__button')) {

      const root = target.closest('.enable-listbox');
      const listboxEl = root.querySelector('[role="listbox"]');

      listboxEl.removeEventListener('blur', this.blurEvent, true);
      // ensure this gets focus
      target.focus();

      listboxEl.addEventListener('blur', this.blurEvent, true);
    }
  }

  this.onKeydown = (e) => {
    this.lastKeydownEl = document.activeElement;


    // If the down arrow is pressed when the listbox is collapsed, fire a click event
    const { target, key } = e;
    const root = target.closest('.enable-listbox');

    if (root) {
      const normalizedKey = accessibility.normalizedKey(key);
      const listboxEl = root.querySelector('[role="listbox"]');
      if ((normalizedKey === 'ArrowDown' || normalizedKey === 'ArrowUp') && this.isCollapsed(listboxEl)) {
        e.preventDefault();
        this.onClick(e);
      }
    }

  }

  this.onKeyup = (e) => {
    const { key, target } = e;
    const normalizedKey = accessibility.normalizedKey(key);

    if (this.lastKeydownEl !== target || (normalizedKey !== 'Enter' && normalizedKey !== ' ' && normalizedKey !== 'Escape' && normalizedKey !== 'ArrowDown')) {
      return;
    }

    const { activeElement } = document;
    const root = activeElement.closest('.enable-listbox');

    if (root) {

      const listboxEl = root.querySelector('[role="listbox"]');
      const buttonEl = root.querySelector('[aria-haspopup="listbox"]');
      if (activeElement.getAttribute('role') === 'option') {


        if (normalizedKey === 'Escape') {
          listboxEl.removeEventListener('blur', this.blurEvent, true);
        }

        this.collapse(buttonEl, listboxEl, true)

        if (normalizedKey === 'Escape') {
          listboxEl.addEventListener('blur', this.blurEvent, true);
        }
      }
    }
  }

  this.onClick = (e) => {
    const { target } = e;
    const root = target.closest('.enable-listbox');
    let hasValueChanged = false;

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
          this.expand(buttonEl, listboxEl);
        }
      }


      if (target !== buttonEl || listboxEl.contains(target)) {
        // the user clicked outside of the control (but inside the root).
        // We assume the must want to close all dropdowns on the page.
        this.collapseAllListboxes();
      }
    } else {
      // same as above, except outside the whole root.
      this.collapseAllListboxes();
    }


  }

  this.collapseAllListboxes = function() {
    const roots = document.querySelectorAll('.enable-listbox');

    for (let i = 0; i < roots.length; i++) {
      const root = roots[i];
      const buttonEl = root.querySelector('[aria-haspopup="listbox"]');
      const ariaExpanded = buttonEl.getAttribute('aria-expanded');

      if (ariaExpanded === 'true') {
        const listboxEl = root.querySelector('[role="listbox"]');
        this.collapse(buttonEl, listboxEl, false);
      }
    }
  }

  this.isCollapsed = (listboxEl) => {
    return listboxEl.classList.contains('hidden');
  }

  this.collapse = (buttonEl, listboxEl, doFocus) => {
    if (this.isCollapsed(listboxEl)) {
      return;
    }
    listboxEl.classList.add('hidden');
    accessibility.removeMobileFocusLoop();
    buttonEl.removeAttribute('aria-expanded');

    if (doFocus) {
      buttonEl.focus();
    }
    listboxEl.classList.add('hidden');
    listboxEl.dispatchEvent(hideEvent);
  }

  this.expand = (buttonEl, listboxEl) => {
    const optionEls = listboxEl.querySelectorAll('[role="option"]');

    console.log('target', buttonEl);
    buttonEl.setAttribute('aria-expanded', 'true');
    listboxEl.classList.remove('hidden');
    // set focus on appropriate option
    requestAnimationFrame(() => {
      const itemToFocus = listboxEl.querySelector('[aria-selected="true"]') || optionEls[0];

      itemToFocus.focus();
      accessibility.setMobileFocusLoop(listboxEl);
      // make the arrow keyup events happen if needed
      if (listboxEl.dataset.enableListboxInit !== 'true') {
        this.initListbox(listboxEl, buttonEl);
      }
    });
  }

  this.initListbox = (listboxEl, buttonEl) => {
    accessibility.initGroup(
      listboxEl, {
        doKeyChecking: true,
        ariaCheckedCallback: (e, currentlyCheckedEl) => {
          const { previousValue, previousId } = listboxEl.dataset;
          const eventValue = currentlyCheckedEl.innerText;
          const eventId = currentlyCheckedEl.id;

          if (previousValue !== eventValue && previousId !== eventId) {
            buttonEl.innerHTML = currentlyCheckedEl.innerHTML;
            this.collapse(buttonEl, listboxEl, true);
            accessibility.removeMobileFocusLoop();

            const changeEvent = new CustomEvent('enable-listbox-change', {
              bubbles: true,
              detail: {
                value: () => eventValue,
                id: () => eventId
              }
            });
            listboxEl.dataset.previousValue = eventValue;
            listboxEl.dataset.previousId = eventId;
            listboxEl.dispatchEvent(changeEvent);
          }
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
})