<!DOCTYPE html>
<html lang="en">
<head>
    <title>Accessible Multilevel Hamburger Menu</title>
    <link rel="stylesheet" type="text/css" href="css/home.css" />
    <?php include "includes/common-head-tags.php";?>
    
    <link id="hamburger-style" rel="stylesheet" type="text/css" href="css/hamburger-menu.css" />
    <link rel="stylesheet" type="text/css" href="css/figure.css" />
</head>

<body>

    <div role="banner" tabindex="0">
        <?php include "includes/logo-link.php";?>
    </div>

    <div id="example1">
        <nav class="enable-flyout__container" aria-label="main menu">
            <button class="enable-flyout__open-menu-button" aria-expanded="false" aria-controls="mobile-menu">

                <!-- This is the hamburger menu icon -->
                <span class="enable-flyout__hamburger-icon" role="img" aria-label="main menu">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
            </span>

            </button>
            <div id="mobile-menu" class="enable-flyout enable-flyout__top-level enable-flyout__level">
                <button class="enable-flyout__hamburger-icon-facade">
                    <span class="sr-only">close mobile flyout</span>
                </button>
                <ul class="enable-flyout__list">
                    <li class="enable-flyout__menu-item">
                        <a href="/enable" class="enable-flyout__link enable-flyout__with-home-icon">
                            Home
                        </a>
                    </li>

                    <li class="enable-flyout__menu-item">
                        <!-- Begin section 1 -->
                        <button aria-expanded="false" aria-controls="section1"
                            class="enable-flyout__open-level-button">
                            Game Consoles

                        </button>
                        <div id="section1" aria-label="Game Consoles" role="group"
                            class="enable-flyout enable-flyout__level  enable-flyout__dropdown">
                            <button class="enable-flyout__hamburger-icon-facade"><span class="sr-only">close
                                    mobile flyout</span></button>
                            <ul class="enable-flyout__list">
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                    <button class="enable-flyout__close-level-button">
                                        Go Back
                                    </button>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <button aria-expanded="false" aria-controls="section1-1"
                                        class="enable-flyout__open-level-button">
                                        Atari
                                    </button>
                                    <div role="group" aria-label="Atari" id="section1-1" class="enable-flyout enable-flyout__level ">
                                        <button class="enable-flyout__hamburger-icon-facade"><span
                                                class="sr-only">close mobile flyout</span></button>
                                        <div class="enable-flyout__level-heading">Atari</div>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                                <button
                                                    class="enable-flyout__close-level-button">
                                                    Go Back
                                                </button>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="https://atariage.com/software_page.php?SoftwareLabelID=459"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/space-invaders.png" alt=""
                                                        />
                                                    Space Invaders
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://atariage.com/software_page.php?SoftwareLabelID=1007"
                                                    class="enable-flyout__link"><img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/asteroids.png" alt=""
                                                        /> Asteroids</a></li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://atariage.com/software_page.php?SoftwareLabelID=342"
                                                    class="enable-flyout__link"><img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/pac-man.png" alt=""
                                                        /> Pac-Man</a></li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://atariage.com/software_page.php?SoftwareLabelID=2718"
                                                    class="enable-flyout__link"><img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/yars-revenge.png" alt=""
                                                        />
                                                    Yars' Revenge</a></li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://atariage.com/software_page.php?SoftwareID=1380"
                                                    class="enable-flyout__link"><img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/superman.png" alt=""
                                                        /> Superman</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <button aria-expanded="false" aria-controls="section1-2"
                                        class="enable-flyout__open-level-button">
                                        Intellivision

                                    </button>
                                    <div role="group" id="section1-2" aria-label="Intellivision"
                                        class="enable-flyout enable-flyout__level">
                                        <button class="enable-flyout__hamburger-icon-facade"><span
                                                class="sr-only">close mobile flyout</span></button>
                                        <div class="enable-flyout__level-heading">Intellivision</div>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close"><button
                                                    class="enable-flyout__close-level-button">

                                                    Go Back
                                                </button></li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://history.blueskyrangers.com/mattelelectronics/games/spacearmada.html"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/space-armada.png" alt=""
                                                        />
                                                    Space Armada
                                                </a></li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://history.blueskyrangers.com/mattelelectronics/games/astrosmash.html"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/astrosmash.png" alt=""
                                                        />
                                                    Astrosmash
                                                </a></li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://history.blueskyrangers.com/mattelelectronics/games/locknchase.html"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/lock-n-chase.png" alt=""
                                                        />
                                                    Lock 'n Chase
                                                </a></li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://history.blueskyrangers.com/mattelelectronics/games/addcloudy.html"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/dnd.png" alt=""
                                                        />
                                                    Advanced Dungeons and Dragons</a></li>
                                            <li class="enable-flyout__menu-item"><a
                                                    href="https://history.blueskyrangers.com/mattelelectronics/games/masters.html"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/he-man.png" alt=""
                                                        />
                                                    He-Man</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="enable-flyout__menu-item "><a href="#"
                                        class="enable-flyout__link">
                                        ColecoVision
                                    </a></li>
                                <li class="enable-flyout__menu-item "><a href="#"
                                        class="enable-flyout__link">
                                        Nintendo Entertainment System
                                    </a></li>
                            </ul>
                        </div>
                    </li><!-- End section 1 -->

                    <li class="enable-flyout__menu-item">
                        <button aria-expanded="false" aria-controls="section2"
                            class="enable-flyout__open-level-button">
                            Handheld Game Devices

                        </button>
                        <div role="group" aria-label="Handheld Game Machines" id="section2"
                            class="enable-flyout enable-flyout__level enable-flyout__dropdown ">
                            <div class="enable-flyout__level-heading">Handheld Game Machines</div>
                            <button class="enable-flyout__hamburger-icon-facade"><span class="sr-only">close
                                    mobile flyout</span></button>
                            <ul class="enable-flyout__list">
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--close"><button
                                        class="enable-flyout__close-level-button">
                                        Go Back
                                    </button></li>
                                <li class="enable-flyout__menu-item "><a href="#"
                                        class="enable-flyout__link">
                                        Milton Bradley Microvision
                                    </a></li>
                                <li class="enable-flyout__menu-item "><a href="#"
                                        class="enable-flyout__link">
                                        Entex Select A Game
                                    </a></li>
                                <li class="enable-flyout__menu-item "><a href="#"
                                        class="enable-flyout__link">
                                        Entex Adventure Vision
                                    </a></li>
                                <li class="enable-flyout__menu-item "><a href="#"
                                        class="enable-flyout__link">
                                        Atari Lynx
                                    </a></li>
                                <li class="enable-flyout__menu-item "><a href="#"
                                        class="enable-flyout__link">
                                        Game Boy
                                    </a></li>
                                <li class="enable-flyout__menu-item "><a href="#"
                                        class="enable-flyout__link">
                                        Playstation Portable
                                    </a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="enable-flyout__menu-item">
                        <a href="https://atariage.com/" class="enable-flyout__link">Atari Age</a>
                    </li>
                    <li class="enable-flyout__menu-item">
                        <a href="https://history.blueskyrangers.com/index.html" class="enable-flyout__link">Blue Sky
                            Rangers</a>
                    </li>
                </ul>
            </div>
        </nav>

        <span class="enable-flyout__overlay-screen"></span>
    </div>


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

        <h1>The Enable Mobile Hamburger/Desktop Mega Menu</h1>

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

            <img src="images/hamburger-menu-copy/hamburger-menu-icon-screenshot.jpg"
                alt="Screenshot of the banner on the top of this page in the mobile breakpoint" />

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

            <img src="images/hamburger-menu-copy/hamburger-menu-opened.jpg"
                alt="Screenshot of the hamburger menu when opened." />

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

            <img src="images/hamburger-menu-copy/mega-menu-onload.jpg"
                alt="Screenshot of the mega menu when the page is first loaded." />

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

            <img src="images/hamburger-menu-copy/mega-menu-open.jpg"
                alt="Screenshot of the mega menu when one of the submenus opened." />

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

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {},
            "steps": [
            {
                "label": "Use the nav HTML5 tag",
                "highlight": "%OPENTAG%nav ||| %OPENCLOSETAG% nav",
                "notes": "This whole component should be wrapped up in a <code>nav</code> tag, since it is a navigation widget"
            },
            {
                "label": "Set an aria-label on the nav tag",
                "highlight": "aria-label=\"main menu\"",
                "notes": "This aria-label is useful when using NVDAs element list or VoiceOver's rotor when looking at all the landmarks, since it helps distinguish it from other pieces of navigation on the page."
            },
            {
                "label": "Mark up the hamburger menu icon as expandable",
                "highlight": "\\s*aria-expanded=\"false\"[\\s\\S]*aria-controls=\"mobile-menu\" ||| id=\"mobile-menu\"",
                "notes": "This should be set to false when the hamburger menu is hidden, true when it is visible.  Note the aria-controls is pointing to the element that it is opening."
            },
            {
                "label": "Give the hamburger icon a role of image.",
                "highlight": "role=\"image\"",
                "notes": "Since we used <a href=\"https://codepen.io/designcouch/pen/Atyop\">the third CSS animation example in this codepen</a> to create the hamburger icon, we want to ensure screenreaders interpret this as an image by adding the role of image to it"
            },
            {
                "label": "Set screen reader text for the hamburger icon and close button icons",
                "highlight": "%OPENCLOSECONTENTTAG%span sr-only",
                "notes": ""
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
                "highlight": "%JS% EnableFlyoutMenu.onHamburgerIconClick ; EnableFlyoutMenu.openFlyout; EnableFlyoutMenu.openMenuAnimationEnd ||| [ ]*forEach[^}]*\\}\\)\\; ||| this\\.openFlyout(\\(\\)\\;){0,1} ||| [ ]*accessibility\\.setKeepFocusInside\\(\\$container\\, true\\)\\;  ||| requestAnimationFrame[^}]*\\}\\)\\;",
                "notes": "Note that when the user click on the hamburger menu, we call <code>accessibility.setKeepFocusInside($container, true);</code>. This ensures keyboard focus (and mobile accessibility focus) stays inside the open menu, and not on the content outside of it.  We also make the button that opened it inaccessible to screen readers and keyboards, since focus will be applied to the close button, as seen in the openMenuAnimationEnd method at the bottom."
            },
            {
                "label": "Ensure focus restrictions are removed when hamburger menu is closed",
                "highlight": "%JS% EnableFlyoutMenu.closeAllFlyouts ; EnableFlyoutMenu.openMenuAnimationEnd ||| [ ]*forEach\\.call\\(\\$mainMenuButton[^}]*\\}\\)\\; ||| this\\.openFlyout(\\(\\)\\;){0,1} ||| [ ]*accessibility\\.setKeepFocusInside\\(\\$container\\, false\\)\\; ||| \\$menuEl\\.focus\\(\\)\\;",
                "notes": "When the close button is clicked, all cancel the focus loop by calling <code>accessibility.setKeepFocusInside($container, false);</code>.  We also ensure that keyboard focus can be applied to the hamburger menu icon before we apply focus to it in the openMenuAnimationEnd method at the bottom."
            },
            {
                "label": "Ensure hamburger item is visible in Windows High Contrast Mode.",
                "highlight": "%CSS%hamburger-style~ .enable-flyout__hamburger-icon span |||  border[^:]*: 1px solid transparent;",
                "notes": "We have a transparent <code>border</code> on the <code>div</code> elements that make up the hamburger menu icon by default. Even though this is normally invisible, <a href=\"https://piccalil.li/quick-tip/use-transparent-borders-and-outlines-to-assist-with-high-contrast-mode\">transparent borders show up in Windows High Contrast Mode</a>. If we didn't have this included, the icon would be invisible."
            }
          ]
        }
        </script>


    </main>

    <!-- This is just to populate the explanation text with the breakpoint information from the stylesheet. -->
    <script>
    const breakpointWidth = window.getComputedStyle(document.querySelector('.enable-flyout')).getPropertyValue(
        '--enable-flyout__desktop-min');
    Array.prototype.forEach.call(document.querySelectorAll('.breakpoint-width'), (el, i) => {
        el.innerHTML = breakpointWidth;
    });
    console.log('bw', breakpointWidth);
    </script>

    <script src="js/accessibility.js"></script>
    <script src="js/hamburger.js"></script>

    <?php include "includes/example-footer.php"?>
</body>

</html>