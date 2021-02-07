var tabgroup = new function () {

    this.init = function () {
        const activeHash = location.hash;
        let activeTab = null;
        this.tabgroupEls = document.querySelectorAll('[role="tablist"]');


        for (let i=0; i<this.tabgroupEls.length; i++) {
            const tabgroupEl = this.tabgroupEls[i];

            accessibility.initGroup(
                tabgroupEl,
                {
                    doSelectFirstOnInit: true,
                    doKeyChecking: true,
                    visuallyHiddenClass: 'visually-hidden',
                    ariaCheckedCallback: function (e, currentlyCheckedEl, currentlyCheckedIndex, previouslyCheckedEl, groupEls) {
                        if (!currentlyCheckedEl) {
                            return;
                        }

                        const groupEl = currentlyCheckedEl.closest('[role="tablist"]');
                        const activePanelId = currentlyCheckedEl.getAttribute('aria-owns');
                        const panelEls = groupEl.parentNode.querySelectorAll('[role="tabpanel"]');
                        const { href } = currentlyCheckedEl;
                        const split = href && href.split('#');
                        const hash = split && split[1];
                        
                        for (let i=0; i<panelEls.length; i++) {
                            var panel = panelEls[i];
                            if (panel.id === activePanelId) {
                                panel.classList.add('visible');
                            } else {
                                panel.classList.remove('visible');
                            }
                        }
                    }
                }
            );

            const tabEls = tabgroupEl.querySelectorAll('[role="tab"]');
            for (let j = 0; j < tabEls.length; j++) {
                const tabEl = tabEls[j];
                const { href } = tabEl;
                const split = href && href.split('#');
                const hash = split && split[1];


                if (activeHash === '#' + hash) {
                    activeTab = tabEl;
                    break;
                }
            }

        }

        if (activeTab) {
            activeTab.click();
        }
    }
}
tabgroup.init();