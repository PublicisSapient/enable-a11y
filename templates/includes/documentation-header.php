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
            <a href="/">
                <img src="images/accessible-text-svg/logo-enable-white.svg" alt="Enable Logo" />
            </a>
        </div>
        <!-- Here is the main menu will be placed by our global.js Javascript -->
        <div id="enable-flyout-menu" data-component="EnableFlyout" data-props-id="flyout-props">
        </div>
        <?php include "includes/pause-anim-control.php"; ?>
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
                            "id": "flyout__link--no-image",
                            "props": {
                                "label": "Components",
                                "url": "components.php"
                            }
                        },
                        {
                            "id": "flyout__link--no-image",
                            "props": {
                                "label": "Code Patterns",
                                "url": "code-patterns.php"
                            }
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
                                        "url": "bookmarlets.php",
                                        "alt": ""
                                    }
                                }
                            ]
                        },
                        {
                            "id": "flyout__link-mobile-only",
                            "props": {
                                "label": "FAQ",
                                "url": "faq.php"
                            }
                        },
                        {
                            "id": "flyout__link-mobile-only",
                            "props": {
                                "label": "Acknowledgements",
                                "url": "acknowledgements.php"
                            }
                        }
                    ]
                }]
            }]
        }
    </script>
</header>