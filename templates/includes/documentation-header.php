<link rel="stylesheet" type="text/css" href="css/form.css" >
<link rel="stylesheet" type="text/css" href="css/site-search.css" >
<header id="header" data-is-sticky="top">
    <!-- Skip Link -->
    <div class="enable-mobile-visible-on-focus__container enable-skip-link--begin">
        <a href="#main" id="beginning-of-nav" class="enable-mobile-visible-on-focus enable-skip-link">
            Skip to Main Content
        </a>



    </div>

    <div class="nav-container">
        <!-- Enable Logo (link to homepage) -->
        <div class="enable-logo">
            <a href="index.php">
                <img src="images/ENABLE.svg" alt="Enable Home Page" class="enable-logo--mobile">
                <img src="images/accessible-text-svg/logo-enable-white.svg" alt="Enable Home Page" class="enable-logo--desktop" />
            </a>
        </div>
        <!-- Here is the main menu will be placed by our global.js Javascript -->
        <div id="enable-flyout-menu" data-component="EnableFlyout" data-props-id="flyout-props">
        </div>
        <?php include "includes/pause-anim-control.php"; ?>
    </div>

    <!-- Main search bar -->
    <form role="search" aria-label="site wide search" tabindex="-1" class="combobox-example">
        <div class="enable-combobox site-search">
            <div class="site-search__inner-container">
                <div id="home-search__close-desc" class="sr-only">
                Please choose a value using the arrow keys or clear the combobox by either pressing the escape key or activating the
                clear button.  Pressing enter will search for the item on Google.
                </div>

                <div class="enable-combobox__controls-container site-search__controls-container">
                    <div class="sr-only" id="home-search__desc">
                        As you type, use the up and down arrow keys or press ENTER and swipe to choose the autocomplete
                        search terms.
                    </div>

                    <div role="alert" aria-atomic="true" aria-live="polite">
                    </div>

                    <button type="submit" class="combobox-example__button site-search__button">
                    <img
                        class="site-search__icon"
                        src="images/search-dark.svg"
                        alt="Search"
                    >
                    </button>
                    <input class="site-search__term" type="text" tabindex="0" id="home-search" role="combobox" aria-autocomplete="list"
                        aria-owns="home-search__list" aria-expanded="false" autocomplete="off" autocorrect="off" autocapitalize="off"
                        aria-describedby="home-search__desc" placeholder="Search for specific knowledge articles...">

                    <button class="enable-combobox__reset-button site-search__reset-button" aria-controls="home-search__list" type="reset"
                        aria-describedby="home-search__label">
                        <img class="enable-combobox__reset-button-image" src="images/close-window.svg" alt="Clear"
                        aria-describedby="home-search__label">
                    </button>
                    <ul role="listbox" id="home-search__list" tabindex="-1" hidden></ul>
                </div>
            </div>
        </div>
    </form>
    
  </div>

    <!--  HTML Templates that the Flyout menu uses  -->
    <template id="flyout__root">
        <ul class="enable-flyout__list">
            ${html:content}
        </ul>
    </template>

    <template id="flyout__button">
        <li class="enable-flyout__menu-item">
            <!-- Begin section ${sectionName} -->
            <button aria-expanded="false" aria-controls="${id}-section" class="enable-flyout__open-level-button">
                ${sectionName}
            </button>
            <div id="${id}-section" aria-label="${sectionName}" role="group"
                class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                <button class="enable-flyout__hamburger-icon-facade">
                    <span class="sr-only">
                        close mobile flyout
                    </span>
                </button>
                <ul class="enable-flyout__list ${classes}">
                    <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                        <button class="enable-flyout__close-level-button">
                            Go Back
                        </button>
                    </li>

                    <!-- Start menu items for section ${sectionName} -->
                    ${html:content}
                </ul>
            </div>
        </li>
    </template>

    <template id="flyout__home-mobile-only">
        <li class="enable-flyout__menu-item">
            <a href="index.php" class="enable-flyout__link enable-flyout__with-home-icon mobile-and-tablet">
                Home
            </a>
        </li>
    </template>

    <template id="flyout__link-mobile-only">
        <li class="enable-flyout__menu-item ${listItemClasses} mobile-and-tablet">
            <a href="${url}" class="enable-flyout__link">
                ${label}
            </a>
        </li>
    </template>

    <template id="flyout__link--no-image">
        <li class="enable-flyout__menu-item ${listItemClasses}">
            <a href="${url}" class="enable-flyout__link">${label}</a>
        </li>
    </template>  

    <template id="flyout__container">
        <nav class="enable-flyout__container" aria-label="main">
            <button aria-label="main menu" class="enable-flyout__open-menu-button" aria-expanded="false"
                aria-controls="mobile-menu">

                <!-- This is the hamburger menu icon -->
                <span class="enable-flyout__hamburger-icon">
                    <span>
                    </span>
                    <span>
                    </span>
                    <span>
                    </span>
                    <span>
                    </span>
                </span>
            </button>
            <div id="mobile-menu" class="enable-flyout enable-flyout__top-level enable-flyout__level">
                <button class="enable-flyout__hamburger-icon-facade">
                    <span class="sr-only">
                        close mobile flyout
                    </span>
                </button>

                <!-- Here is where the content is placed -->
                ${html:content}
            </div>
        </nav>
        <span class="enable-flyout__overlay-screen">
        </span>
    </template>

    <script src="https://cdn.jsdelivr.net/npm/minisearch@7.1.0/dist/umd/index.min.js"></script>
    <script type="module">
        import search from '../../js/modules/site-search.js';
        search.init();
    </script>

    <!-- id, props, content -->
    <script id="flyout-props" type="application/json">
        {
            "content": [{
                "id": "flyout__container",
                "content": [{
                    "id": "flyout__root",
                    "content": [{
                            "id": "flyout__home-mobile-only"
                        },
                        {
                            "id": "flyout__button",
                            "props": {
                                "id": "components",
                                "sectionName": "Components"
                            },
                            "content": [{
                                    "id": "flyout__link--no-image",
                                    "props": {
                                        "label": "Forms",
                                        "url": "forms-section.php",
                                        "alt": ""
                                    }
                                },
                                {
                                    "id": "flyout__link--no-image",
                                    "props": {
                                        "label": "Controls",
                                        "url": "controls-section.php",
                                        "alt": ""
                                    }
                                },
                                {
                                    "id": "flyout__link--no-image",
                                    "props": {
                                        "label": "Content",
                                        "url": "content-section.php",
                                        "alt": ""
                                    }
                                },
                                {
                                    "id": "flyout__link--no-image",
                                    "props": {
                                        "label": "Code Patterns",
                                        "url": "code-patterns-section.php",
                                        "alt": ""
                                    }
                                }
                            ]
                        },
                        {
                            "id": "flyout__button",
                            "props": {
                                "id": "tools",
                                "sectionName": "Tools"
                            },
                            "content": [{
                                    "id": "flyout__link--no-image",
                                    "props": {
                                        "label": "Accessible Code Quality",
                                        "url": "code-quality.php",
                                        "alt": ""
                                    }
                                },
                                {
                                    "id": "flyout__link--no-image",
                                    "props": {
                                        "label": "Bookmarklets",
                                        "url": "bookmarklets.php",
                                        "alt": ""
                                    }
                                }
                            ]
                        },
                        {
                            "id": "flyout__link--no-image",
                            "props": {
                                "label": "FAQ",
                                "url": "faq.php"
                            }
                        },
                        {
                            "id": "flyout__link--no-image",
                            "props": {
                                "label": "Shout Outs",
                                "url": "acknowledgements.php"
                            }
                        }
                    ]
                }]
            }]
        }
    </script>
</header>