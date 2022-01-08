<main>
    
        <aside class="notes">
            <p>
                This is a heavily modified version of <a href="https://codepen.io/hayleyt/pen/ZyqBYW">
                    this hamburger menu</a>. I removed jQuery as a dependancy,
                made the markup accessible and added focus management rules, as well as turning
                it into a mega menu at the desktop breakpoint. I
                also made the styles follow the BEM design pattern.
            </p>
        </aside>

        

        <p>
            On this page, you will see one of two things:
        </p>

        <h2>Mobile Hamburger Menu</h2>

        <p>
            If you are in the mobile breakpoint (i.e. a viewport width less than
            <span class="breakpoint-width"></span>), then a hamburger menu icon will
            appear in the upper right-hand corner of this page.
        </p>

        <figure>

            <?php pictureWebpPng("images/hamburger-menu-copy/hamburger-menu-icon-screenshot", "Screenshot of the banner on the top of this page in the mobile breakpoint")?>

            <figcaption>Figure 1. The hamburger menu icon appears on the upper right hand side of the page. It is
                denoted by three horizontal lines that has become the standard.</figcaption>
        </figure>

        <p>
            Clicking on it
            with either a mouse or keyboard will result in a standard hamburger
            menu appearing on the right hand side of the page, and keyboard focus
            will be applied to the first interactive element inside it (the close
            button).
        </p>

        <figure>

            <?php pictureWebpPng("images/hamburger-menu-copy/hamburger-menu-opened", "Screenshot of the hamburger menu when opened.")?>

            <figcaption>
                Figure 2. When the hamburger menu icon is clicked, the black menu above appears.
                It has a close button (that gains keyboard focus when first opened) and few CTAs
                stacked on top of each other.</figcaption>
        </figure>

        <p>
            The user can choose any item inside that menu with either
            a mouse or keyboard. Menu subcategories are visually indicated
            by a right pointing chevron, and to assistive technologies as
            collapsabe/expandable buttons. Clicking on these subcategory
            buttons will show the subcatagory menu appearing, with keyboard
            focus being applied to the back button that will take users back
            to the previous menu.
        </p>


        <p>
            Keyboard users experiencing a focus loop
            that keeps the current menu panel until the menu is closed.
            If the user either uses a mouse
            to click outside the menu or hits the Escape key, the menu will close.
        </p>

        <h2>Desktop Mega Menu</h2>

        <p>
            If you are in the desktop breakpoint (i.e. a viewport width greater
            then or equal to <span class="breakpoint-width"></span>), then a mega menu
            will appear in across to top of the page underneath the Enable logo in the
            global header.
        </p>

        <figure>

            <?php pictureWebpPng("images/hamburger-menu-copy/mega-menu-onload", "Screenshot of the mega menu when the page is first loaded.")?>

            <figcaption>
                Figure 3. The mega menu is a horizontal bar with the
                top level CTAs appearing inside it next to one another.
            </figcaption>
        </figure>

        <p>
            Users can either click the CTAs in the menu with either a mouse or keyboard.
            Menu subcategories are visually indicated
            by a downwards pointing chevron, and to assistive technologies as
            collapsabe/expandable buttons. Clicking on these subcategory
            buttons will show the subcatagory menu appearing below the button.
            Keyboard users can then tab immediately into the subcatagory menu with
            a keyboard, while mouse users can click on any of the submenu items inside.
        </p>

        <figure>

            <?php pictureWebpPng("images/hamburger-menu-copy/mega-menu-open", "Screenshot of the mega menu when one of the submenus opened.")?>

            <figcaption>
                Figure 3. When a submenu category is clicked with either,
                a mouse or keyboard, the submenu will appear. Clicking again
                makes it disappear.
            </figcaption>
        </figure>

        <p>
            Keyboard users will note that when they apply focus
            to an interactive element outside of the subcatagory menu,
            the menu will close automatically. Mouse users will notice
            this happening if they click anywhere outside the subcatagory
            menu as well. Mobile screenreader users will experience a focus loop
            inside the menu until they close the menu with the CTA that opened it.
        </p>

        <?php includeShowcode("enable-hamburger-menu")?>

        <script type="application/json" id="enable-hamburger-menu-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Use the nav HTML5 tag",
                    "highlight": "%OPENTAG%nav",
                    "notes": "This whole component should be wrapped up in a <code>nav</code> tag, since it is a navigation widget"
                },
                {
                    "label": "Set an aria-label on the nav tag",
                    "highlight": "aria-label=\"main\"",
                    "notes": "This aria-label is useful when using NVDAs element list or VoiceOver's rotor when looking at all the landmarks, since it helps distinguish it from other pieces of navigation on the page."
                },
                {
                    "label": "Mark up the hamburger menu icon as expandable",
                    "highlight": "\\s*aria-expanded=\"false\"[\\s\\S]*aria-controls=\"mobile-menu\" ||| id=\"mobile-menu\"",
                    "notes": "This should be set to false when the hamburger menu is hidden, true when it is visible.  Note the aria-controls is pointing to the element that it is opening."
                },
                {
                    "label": "Give the hamburger icon a role of image.",
                    "highlight": "role=\"img\"",
                    "notes": "Since we used <a href=\"https://codepen.io/designcouch/pen/Atyop\">the third CSS animation example in this codepen</a> to create the hamburger icon, we want to ensure screenreaders interpret this as an image by adding the role of image to it"
                },
                {
                    "label": "Set aria-label for hamburger menu icon",
                    "highlight": "aria-label=\"main\\smenu\"",
                    "notes": ""
                },
                {
                    "label": "Set screen reader text close button icons",
                    "highlight": "%OPENCLOSECONTENTTAG%span sr-only",
                    "notes": "We use screen reader only text instead of an aria-label because buttons should not be empty."
                },
                {
                    "label": "Markup hamburger menu panels",
                    "highlight": "class=\"enable-flyout__list[^\"]*\"",
                    "notes": "If you look at the code, you will notice that all the panels are marked up as unordered lists (using <strong>ul</strong> tags).  This is so screen readers can announce how many items are in the menu panel that is currently shown on-screen."
                },
                {
                    "label": "Mark up the buttons that open up submenus as expandable",
                    "highlight": "\\s*aria-expanded=\"false\"[^a]*aria-controls=\"[^\"]*\"[^c\\&]*class=\"[^\"]*\"",
                    "notes": "This should be set to false when the hamburger menu is hidden, true when it is visible.  Note the aria-controls is pointing to the element that it is opening."
                },
                {
                    "label": "Mark up the menu subsection panels with aria-labels",
                    "highlight": "\\s*aria-label=\"[^\"]*\"[^c]*class=\"enable-flyout\\s[^\"]*\"",
                    "notes": ""
                },
                {
                    "label": "Having close buttons at the beginning of each menu subsection",
                    "highlight": "\\s*&lt;button[^c]*class=\"enable-flyout__hamburger-icon-facade\"[\\s]*",
                    "notes": ""
                },
                {
                    "label": "Set aria-controls attributes",
                    "highlight": "aria-controls",
                    "notes": "Any button that opens up a menu subsection should have an aria-controls pointing to the id of that subsection DOM element."
                },
                {
                    "label": "Set image alt attributes (or make them decorative if applicable)",
                    "highlight": "alt ||| role=\"presentation\"",
                    "notes": "The images in the desktop mega menu are decorative, so we set the attributes <code>alt=\"\"</code> and <code>role=\"presentation\"</code>.  If they actually gave extra information to sighted users, we would have to set the attribute to describe the image.  Since they are just screenshots of the video games that are given in the link labels, we have decided to make them decorative."
                },
                {
                    "label": "Ensure focus stays within hamburger menu when the user clicks on the hamburger menu icon",
                    "highlight": "%JS% EnableFlyoutHamburger.onHamburgerIconClick ; EnableFlyoutHamburger.openFlyout; EnableFlyoutHamburger.openMenuAnimationEnd ||| [ ]*forEach[^}]*\\}\\)\\; ||| this\\.openFlyout(\\(\\)\\;){0,1} ||| [ ]*accessibility\\.setKeepFocusInside\\(\\$container\\, true\\)\\;  ||| requestAnimationFrame\\([^}]*\\}\\)\\;",
                    "notes": "Note that when the user click on the hamburger menu, we call <code>accessibility.setKeepFocusInside($container, true);</code>. This ensures keyboard focus (and mobile accessibility focus) stays inside the open menu, and not on the content outside of it.  We also make the button that opened it inaccessible to screen readers and keyboards, since focus will be applied to the close button, as seen in the openMenuAnimationEnd method at the bottom."
                },
                {
                    "label": "Ensure focus restrictions are removed when hamburger menu is closed",
                    "highlight": "%JS% EnableFlyoutHamburger.closeAllFlyouts ; EnableFlyoutHamburger.openMenuAnimationEnd ||| [ ]*forEach\\.call\\(\\$mainMenuButton[^}]*\\}\\)\\; ||| this\\.openFlyout(\\(\\)\\;){0,1} ||| [ ]*accessibility\\.setKeepFocusInside\\(\\$container\\, false\\)\\; ||| \\$menuEl\\.focus\\(\\)\\;",
                    "notes": "When the close button is clicked, all cancel the focus loop by calling <code>accessibility.setKeepFocusInside($container, false);</code>.  We also ensure that keyboard focus can be applied to the hamburger menu icon before we apply focus to it in the openMenuAnimationEnd method at the bottom."
                },
                {
                    "label": "Ensure hamburger item is visible in Windows High Contrast Mode.",
                    "highlight": "%CSS%hamburger-style~ .enable-flyout__hamburger-icon span |||  border:[^;]*;",
                    "notes": "We have a transparent <code>border</code> on the <code>div</code> elements that make up the hamburger menu icon by default. Even though this is normally invisible, <a href=\"https://piccalil.li/quick-tip/use-transparent-borders-and-outlines-to-assist-with-high-contrast-mode\">transparent borders show up in Windows High Contrast Mode</a>. If we didn't have this included, the icon would be invisible."
                }
            ]
        }
        </script>


    </main>