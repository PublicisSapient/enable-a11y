var tabgroup = new (function () {
  this.init = function () {
    const activeHash = location.hash;
    let activeTab = null;
    this.tabgroupEls = document.querySelectorAll('[role="tablist"]');

    // For each of the tabgroups ...
    for (let i = 0; i < this.tabgroupEls.length; i++) {
      const tabgroupEl = this.tabgroupEls[i];

      // ... use accessibility.initGroup() to allow the use of arrow keys
      // to choose each tab one at a time.
      accessibility.initGroup(tabgroupEl, {
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
          currentlyCheckedEl,
          currentlyCheckedIndex,
          previouslyCheckedEl,
          groupEls
        ) {
          if (!currentlyCheckedEl) {
            return;
          }

          const groupEl = currentlyCheckedEl.closest('[role="tablist"]');
          const activePanelId = currentlyCheckedEl.getAttribute("aria-owns");
          const panelEls = groupEl.parentNode.querySelectorAll(
            '[role="tabpanel"]'
          );
          const { href } = currentlyCheckedEl;
          const split = href && href.split("#");
          const hash = split && split[1];

          for (let i = 0; i < panelEls.length; i++) {
            var panel = panelEls[i];
            if (panel.id === activePanelId) {
              panel.classList.add("visible");
            } else {
              panel.classList.remove("visible");
            }
          }
        }
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
})();
tabgroup.init();
