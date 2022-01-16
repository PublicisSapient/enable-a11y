'use strict'

/*******************************************************************************
* tabs.js - UI for Accessible tabs
* 
* Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
* Part of the Enable accessible component library.
* Version 1.0 released Dec. 27, 2021
*
* More information about this script available at:
* https://www.useragentman.com/enable/tabs.php
* 
* Released under the MIT License.
******************************************************************************/
import accessibility from '../libs/accessibility-js-routines/dist/accessibility.module.js';

const tabgroup = new (function () {
  let lastMouseDownEl = null;

  this.init = function () {
    const activeHash = location.hash;
    let activeTab = null;

    this.addRoles();

    this.tabgroupEls = document.querySelectorAll('[role="tablist"]');

    // For each of the tabgroups ...
    for (let i = 0; i < this.tabgroupEls.length; i++) {
      const tabgroupEl = this.tabgroupEls[i];
      const { keyboardOnlyInstructions } = tabgroupEl.dataset;

      if (keyboardOnlyInstructions) {
        const tabEls = tabgroupEl.querySelectorAll('[role="tab"]');

        tabEls.forEach((el) =>
          el.setAttribute("aria-describedby", keyboardOnlyInstructions)
        );
      }

      // remove no-js from parent
      tabgroupEl.parentNode.classList.add("tabs--has-js");

      // When keyboard users click on tab button, focus goes to heading.
      tabgroupEl.addEventListener("keyup", this.keyUpEvent);

      // ... use accessibility.initGroup() to allow the use of arrow keys
      // to choose each tab one at a time.
      accessibility.initGroup(tabgroupEl, {
        // prevents clicking on tab to jump down to the content.
        preventClickDefault: true,

        // This selects the first tab by default.
        doSelectFirstOnInit: true,

        // This sets what the sr-only class is (default is .sr-only)
        visuallyHiddenClass: "sr-only",

        // When the user uses the arrow key to select on of the tabs,
        // this method is called afterwards.  It hides all the tabpanels
        // except for the one that checked tab is supposed to show (the
        // one with the ID on the tab's aria-owns attribute).
        ariaCheckedCallback: function (
          e,
          currentlyCheckedEl
        ) {
          if (!currentlyCheckedEl) {
            return;
          }

          const groupEl = currentlyCheckedEl.closest('[role="tablist"]');
          const activePanelId = currentlyCheckedEl.getAttribute("aria-owns");
          const panelEls =
            groupEl.parentNode.querySelectorAll('[role="tabpanel"]');

          for (let i = 0; i < panelEls.length; i++) {
            var panel = panelEls[i];
            if (panel.id === activePanelId) {
              panel.classList.add("visible");
            } else {
              panel.classList.remove("visible");
            }
          }
        },
        activatedEventName: 'enable-selected'
      });

      // If the tabs are links with hashed href's, this code will
      // allow the deep linking of the tabbed content.
      const tabEls = tabgroupEl.querySelectorAll('[role="tab"]');
      for (let j = 0; j < tabEls.length; j++) {
        const tabEl = tabEls[j];
        const { href } = tabEl;
        const split = href && href.split("#");
        const hash = split && split[1];

        if (activeHash === "#" + hash) {
          activeTab = tabEl;
          break;
        }
      }
    }

    if (activeTab) {
      activeTab.click();
    }
  };

  this.addRoles = function () {
    const tabListEls = document.querySelectorAll(".enable-tablist");

    tabListEls.forEach((tabListEl) => {
      // If the role has been set here, we assume the structure is okay
      // and don't add the roles.
      if (tabListEl.getAttribute("role") !== "tablist") {
        console.info('Roles do not exist. Adding');
        const tabEls = tabListEl.querySelectorAll(".enable-tab");
        tabListEl.setAttribute("role", "tablist");
        tabEls.forEach((tabEl) => {
          this.addTabRole(tabEl);
          this.addPresentationRoles(tabListEl, tabEl);
        });
      }
    });
  };

  this.addTabRole = (tabEl) => {
    const { owns } = tabEl.dataset
    const ownsEl = owns && document.getElementById(owns);
    tabEl.setAttribute("role", "tab");
    if (ownsEl) {
      tabEl.setAttribute('aria-owns', owns);
      ownsEl.setAttribute("role", "tabpanel");
    }
  };

  this.addPresentationRoles = (tabListEl, tabEl) => {
    let parentNode = tabEl.parentNode;

    while (parentNode !== tabListEl) {
      parentNode.setAttribute('role', 'presentation');
      parentNode = parentNode.parentNode;
    }
  }

  // If the user fully clicked on a tab with a keyboard,
  // we ensure that focus goes to the heading of the tabpanel it is
  // connected to.  This does not happen for mouse users.
  this.keyUpEvent = (e) => {
    const { target, key } = e;
    const role = target.getAttribute("role");

    if (role === "tab" && key === "Enter") {
      const { href } = target;
      const splitHref = href.split("#");
      if (splitHref.length === 2) {
        const toFocus = document.querySelector(`#${splitHref[1]}`);
        if (toFocus) {
          requestAnimationFrame(() => {
            toFocus.focus();
          });
        }
      }
    }

    lastMouseDownEl = null;
  };
})();
tabgroup.init();

export default tabgroup;