<!DOCTYPE html>
<html lang="en">

<head>
    <title>Improved Skip Links</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta charset="utf-8" />

<!-- These two stylesheets are for the code walkthroughs -->
<link rel="stylesheet" type="text/css" href="css/showcode.css">
<link href="css/libs/prism.css" rel="stylesheet" />

<!-- This is the global stylesheet -->
<link id="all-css" rel="stylesheet" href="css/shared/all.css" />
<link id="read-all-css" rel="stylesheet" href="css/shared/read-more.css" />

<!-- hamburger menu -->
<link id="hamburger-style" rel="stylesheet" type="text/css" href="css/hamburger-menu.css" />

<!-- Skip links styles -->
<link id="enable-skip-link-style" href="css/enable-visible-on-focus.css" rel="stylesheet" />

<link id="site-css" rel="stylesheet" href="css/site.css" />





    <!-- We include the css/enable-visible-on-focus.css file inside the common-head-tags.php because it is used by the main navigation. -->
</head>

<body>

    

<div role="banner">
    <div class="enable-mobile-visible-on-focus__container enable-skip-link--begin">
        <a href="#end-of-nav" id="beginning-of-nav" class="enable-mobile-visible-on-focus enable-skip-link">
            Skip to Main Content
        </a>
    </div>
    <div class="enable-logo__container">
    <a class="enable-logo__link" href="index.php">
        <img class="enable-logo" src="images/ENABLE.svg" alt="" role="presentation" />
        <span class="enable-logo__text">Enable</span>
    </a>
    <span class="enable-logo__sub-text">Modern Web Code Examples Accessible To Everyone</span>
</div>

    <!-- Here is the main menu -->
    <div id="enable-hamburger-menu">
        <nav class="site__nav enable-flyout__container" aria-label="main">
            <button class="enable-flyout__open-menu-button" aria-expanded="false" aria-controls="mobile-menu">

                <!-- This is the hamburger menu icon -->

                <span aria-label="main menu" class="enable-flyout__hamburger-icon" role="img">
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
                <ul class="enable-flyout__list">
                    <li class="enable-flyout__menu-item">
                        <a href="index.php" class="enable-flyout__link enable-flyout__with-home-icon mobile-and-tablet">
                            Home
                        </a>
                    </li>
                    <li class="enable-flyout__menu-item">
                        <!-- Begin section Interactive Elements -->
                        <button aria-expanded="false" aria-controls="interactive-elements-section"
                            class="enable-flyout__open-level-button">
                            Interactive Elements
                        </button>
                        <div id="interactive-elements-section" aria-label="Interactive Elements" role="group"
                            class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                            <button class="enable-flyout__hamburger-icon-facade">
                                <span class="sr-only">
                                    close mobile flyout
                                </span>
                            </button>
                            <ul class="enable-flyout__list ">
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                    <button class="enable-flyout__close-level-button">
                                        Go Back
                                    </button>
                                </li>


                                <li class="enable-flyout__menu-item">
                                    <!-- Begin section Form Elements -->
                                    <button aria-expanded="false" aria-controls="form-element-section"
                                        class="enable-flyout__open-level-button">
                                        Form Elements
                                    </button>
                                    <div class="enable-flyout__level-heading">Form Elements</div>
                                    <div id="form-element-section" aria-label="Form Elements" role="group"
                                        class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                                        <button class="enable-flyout__hamburger-icon-facade">
                                            <span class="sr-only">
                                                close mobile flyout
                                            </span>
                                        </button>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                                <button class="enable-flyout__close-level-button">
                                                    Go Back
                                                </button>
                                            </li>

                                            <!-- Start menu items for section Form Elements -->

                                            <li class="enable-flyout__menu-item">
                                                <a href="button.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/button.webp" type="image/webp">
  <img src="images/main-menu/button.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Button
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="checkbox.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/checkbox.webp" type="image/webp">
  <img src="images/main-menu/checkbox.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Checkboxes
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="radiogroup.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/radiogroup.webp" type="image/webp">
  <img src="images/main-menu/radiogroup.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Radio Button Group
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="listbox.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/listbox.webp" type="image/webp">
  <img src="images/main-menu/listbox.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Select Box / Listbox
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="textbox.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/textbox.webp" type="image/webp">
  <img src="images/main-menu/textbox.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Textbox
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="combobox.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/combobox.webp" type="image/webp">
  <img src="images/main-menu/combobox.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Autocomplete Combobox
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="slider.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/slider.webp" type="image/webp">
  <img src="images/main-menu/slider.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Slider / Range Input
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="spinner.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/spinner.webp" type="image/webp">
  <img src="images/main-menu/spinner.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Numeric Input Spinner
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="enable-flyout__menu-item">
                                    <!-- Begin section Other Interactive Elements -->
                                    <button aria-expanded="false" aria-controls="other-interactive-elements-section"
                                        class="enable-flyout__open-level-button">
                                        Other Interactive Elements
                                    </button>
                                    <div class="enable-flyout__level-heading">Other Interactive Elements</div>
                                    <div id="other-interactive-elements-section" aria-label="Other Interactive Elements"
                                        role="group" class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                                        <button class="enable-flyout__hamburger-icon-facade">
                                            <span class="sr-only">
                                                close mobile flyout
                                            </span>
                                        </button>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                                <button class="enable-flyout__close-level-button">
                                                    Go Back
                                                </button>
                                            </li>

                                            <!-- Start menu items for section Other Interactive Elements -->

                                            <li class="enable-flyout__menu-item">
                                                <a href="link.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/link.webp" type="image/webp">
  <img src="images/main-menu/link.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Link
                                                </a>
                                            </li>

                                            <li class="enable-flyout__menu-item">
                                                <a href="dropdown.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/dropdown.webp" type="image/webp">
  <img src="images/main-menu/dropdown.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Dropdown / Drawer / Expando
                                                </a>
                                            </li>

                                            <li class="enable-flyout__menu-item">
                                                <a href="tooltip.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/tooltip.webp" type="image/webp">
  <img src="images/main-menu/tooltip.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Tooltip
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="multi-level-hamburger-menu.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/multi-level-hamburger-menu.webp" type="image/webp">
  <img src="images/main-menu/multi-level-hamburger-menu.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Flyout / Hamburger Menu
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="tabs.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/tabs.webp" type="image/webp">
  <img src="images/main-menu/tabs.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Tablist
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="switch.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/switch.webp" type="image/webp">
  <img src="images/main-menu/switch.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Switch
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="carousel.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/carousel.webp" type="image/webp">
  <img src="images/main-menu/carousel.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Carousel
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="skip-link.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/skip-link.webp" type="image/webp">
  <img src="images/main-menu/skip-link.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Skip Links
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <li class="enable-flyout__menu-item">
                        <!-- Begin section Content Elements -->
                        <button aria-expanded="false" aria-controls="content-elements-section"
                            class="enable-flyout__open-level-button">
                            Content Elements
                        </button>
                        <div id="content-elements-section" aria-label="Content Elements" role="group"
                            class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                            <button class="enable-flyout__hamburger-icon-facade">
                                <span class="sr-only">
                                    close mobile flyout
                                </span>
                            </button>
                            <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                    <button class="enable-flyout__close-level-button">
                                        Go Back
                                    </button>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="table.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/table.webp" type="image/webp">
  <img src="images/main-menu/table.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Table
                                    </a>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="description-list.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/description-list.webp" type="image/webp">
  <img src="images/main-menu/description-list.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Description List
                                    </a>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="progress.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/progress.webp" type="image/webp">
  <img src="images/main-menu/progress.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Progress Bar
                                    </a>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="img.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/img.webp" type="image/webp">
  <img src="images/main-menu/img.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Image
                                    </a>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="figure.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/figure.webp" type="image/webp">
  <img src="images/main-menu/figure.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Figure
                                    </a>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="heading.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/heading.webp" type="image/webp">
  <img src="images/main-menu/heading.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Heading
                                    </a>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="math.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/math.webp" type="image/webp">
  <img src="images/main-menu/math.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Math
                                    </a>
                                </li>
                                <!-- Start menu items for section Content Elements -->
                            </ul>
                        </div>
                    </li>
                    <li class="enable-flyout__menu-item">
                        <!-- Begin section Animated Content -->
                        <button aria-expanded="false" aria-controls="animated-content-section"
                            class="enable-flyout__open-level-button">
                            Animated Content
                        </button>
                        <div id="animated-content-section" aria-label="Animated Content" role="group"
                            class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                            <button class="enable-flyout__hamburger-icon-facade">
                                <span class="sr-only">
                                    close mobile flyout
                                </span>
                            </button>
                            <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                    <button class="enable-flyout__close-level-button">
                                        Go Back
                                    </button>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="animated-gif-with-pause-button.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/animated-gif-with-pause-button.webp" type="image/webp">
  <img src="images/main-menu/animated-gif-with-pause-button.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Animated GIF/WEBP
                                    </a>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <a href="play-pause-animations-button.php" class="enable-flyout__link">
                                        <picture>
  <source srcset="images/main-menu/play-pause-animations-button.webp" type="image/webp">
  <img src="images/main-menu/play-pause-animations-button.png" alt="" class="enable-flyout__link-image" />
</picture>                                        Pause All Animations Control
                                    </a>
                                </li>

                                <!-- Start menu items for section Animated Content -->
                            </ul>
                        </div>
                    </li>
                    <li class="enable-flyout__menu-item">
                        <!-- Begin section Code Patterns -->
                        <button aria-expanded="false" aria-controls="code-patterns-section"
                            class="enable-flyout__open-level-button">
                            Code Patterns
                        </button>
                        <div id="code-patterns-section" aria-label="Code Patterns" role="group"
                            class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                            <button class="enable-flyout__hamburger-icon-facade">
                                <span class="sr-only">
                                    close mobile flyout
                                </span>
                            </button>
                            <ul class="enable-flyout__list ">
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                    <button class="enable-flyout__close-level-button">
                                        Go Back
                                    </button>
                                </li>


                                <li class="enable-flyout__menu-item">
                                    <!-- Begin section ARIA Live Regions -->
                                    <button aria-expanded="false" aria-controls="aria-live-section"
                                        class="enable-flyout__open-level-button">
                                        ARIA Live Regions
                                    </button>
                                    <div class="enable-flyout__level-heading">ARIA Live Regions</div>
                                    <div id="aria-live-section" aria-label="ARIA Live Regions" role="group"
                                        class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                                        <button class="enable-flyout__hamburger-icon-facade">
                                            <span class="sr-only">
                                                close mobile flyout
                                            </span>
                                        </button>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                                <button class="enable-flyout__close-level-button">
                                                    Go Back
                                                </button>
                                            </li>

                                            <!-- Start menu items for section ARIA Live Regions -->

                                            <li class="enable-flyout__menu-item">
                                                <a href="alert.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/alert.webp" type="image/webp">
  <img src="images/main-menu/alert.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Alert
                                                </a>
                                            </li>

                                            <li class="enable-flyout__menu-item">
                                                <a href="log.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/log.webp" type="image/webp">
  <img src="images/main-menu/log.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Log
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="timer.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/timer.webp" type="image/webp">
  <img src="images/main-menu/timer.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Timer
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="marquee.php" class="enable-flyout__link">

                                                    <picture>
  <source srcset="images/main-menu/marquee.webp" type="image/webp">
  <img src="images/main-menu/marquee.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Marquee
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="status.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/status.webp" type="image/webp">
  <img src="images/main-menu/status.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Status
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="enable-flyout__menu-item">
                                    <!-- Begin section Focus Management -->
                                    <button aria-expanded="false" aria-controls="focus-management-section"
                                        class="enable-flyout__open-level-button">
                                        Focus Management
                                    </button>
                                    <div class="enable-flyout__level-heading">Focus Management</div>
                                    <div id="focus-management-section" aria-label="Focus Management" role="group"
                                        class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                                        <button class="enable-flyout__hamburger-icon-facade">
                                            <span class="sr-only">
                                                close mobile flyout
                                            </span>
                                        </button>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                                <button class="enable-flyout__close-level-button">
                                                    Go Back
                                                </button>
                                            </li>

                                            <!-- Start menu items for section Focus Management -->

                                            <li class="enable-flyout__menu-item">
                                                <a href="form-error-checking.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/form-error-checking.webp" type="image/webp">
  <img src="images/main-menu/form-error-checking.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Form Error Checking
                                                </a>
                                            </li>


                                            <li class="enable-flyout__menu-item">
                                                <a href="focus-styling.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/focus-styling.webp" type="image/webp">
  <img src="images/main-menu/focus-styling.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Focus Styling Tips
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <!-- Begin section Typography -->
                                    <button aria-expanded="false" aria-controls="typography-section"
                                        class="enable-flyout__open-level-button">
                                        Typography
                                    </button>
                                    <div class="enable-flyout__level-heading">Typography</div>
                                    <div id="typography-section" aria-label="Typography" role="group"
                                        class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                                        <button class="enable-flyout__hamburger-icon-facade">
                                            <span class="sr-only">
                                                close mobile flyout
                                            </span>
                                        </button>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                                <button class="enable-flyout__close-level-button">
                                                    Go Back
                                                </button>
                                            </li>

                                            <!-- Start menu items for section Typography -->

                                            <li class="enable-flyout__menu-item">
                                                <a href="text-resize.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/text-resize.webp" type="image/webp">
  <img src="images/main-menu/text-resize.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Basic Resizable Text
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="text-spacing.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/text-spacing.webp" type="image/webp">
  <img src="images/main-menu/text-spacing.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Accessible Text Spacing
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="hero-image-text-resize.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/hero-image-text-resize.webp" type="image/webp">
  <img src="images/main-menu/hero-image-text-resize.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Resizing Text In Hero Images
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="accessible-text-svg.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/accessible-text-svg.webp" type="image/webp">
  <img src="images/main-menu/accessible-text-svg.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Accessible Text in SVGs
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <span class="enable-flyout__overlay-screen">
        </span>
    </div>

    <div class="enable-mobile-visible-on-focus__container enable-skip-link--end">
        <a href="#beginning-of-nav" id="end-of-nav" class="enable-mobile-visible-on-focus enable-skip-link">Back to Main
            Navigation</a>
    </div>

</div>

    <main>


        <h1>Skip Link</h1>

        <aside class="notes">

            <h2>What is a Skip Link?</h2>

            <p>
                When keyboard users encounter components with a lot of interactive elements in them (e.g. a website's
                main
                navigation), they don't want to tab 100 times through those elements in order to get to the CTAs in the
                main
                content. Skip links fix this issue. Traditionally, a skip link is a keyboard-only link that keyboard
                users
                can use to skip blocks of interactive elements. They are usually visible only when focused into and
                mouse
                users will never see them.
            </p>

            <p>
                This page discusses two types of skip links: the traditional one that works for desktop computers, and
                one that also works for mobile devices (which will only be experienced by mobile screen-reader users)
            </p>
        </aside>


        <h2>Traditional Skip Link</h2>

        <p>This is an variation of a traditional skip link seen on many websites today. Unlike a lot of implementations,
            we have two skip links pointing to each other. This is users who accidentally trigger the skip link can undo
            their mistakes (useful for people who have hand tremors).</p>

        <p><strong>Note that while it works well on desktop, it fails on mobile, due to screen readers not passing
                screenreader focus events to the mobile browser.</strong></p>

        <div id="desktop-example" class="enable-example">
            <div class="enable-visible-on-focus__container enable-skip-link--begin">
                <a href="#end-of-component-1" id="beginning-of-component-1"
                    class="enable-visible-on-focus enable-skip-link">
                    Skip to end of block
                </a>
            </div>
            <div class="fake-component">

                <p>
                    Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing elit</a>. Praesent feugiat neque sed
                    urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor
                    porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit
                    maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis
                    molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur <a href="#">tincidunt pellentesque orci</a> id condimentum. Maecenas vitae egestas metus,
                    eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec
                    vitae facilisis nisl. Quisque vulputate <a href="#">imperdiet sem</a>, a porta nunc iaculis in. Cras
                    elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus.
                    Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla
                    sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi
                    viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio
                    diam, ut porttitor justo mattis in.
                </p>
                <p>
                    Vivamus pretium eu metus ut dignissim. Maecenas venenatis id tortor id commodo. In consectetur
                    tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac <a
                        href="#">auctor auctor</a>, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed
                    consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis
                    nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et
                    porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus
                    congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
                </p>
                <p>
                    Integer urna turpis, imperdiet <a href="#">non pellentesque in</a>, facilisis id ex. Duis at
                    pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque <a href="#">bibendum
                        odio mi</a>, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec
                    fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est
                    neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque
                    sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
                </p>
                <p>
                    Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, lobortis eu
                    purus non, ultricies convallis elit. <a href="#">Cras ex lacus</a>, commodo eu mi rhoncus, lobortis
                    consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet
                    scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper
                    tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante,
                    quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia
                    nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
                </p>

                <p>
                    Lorem ipsum dolor sit amet, <a href="#">consectetur</a> adipiscing elit. Praesent feugiat neque sed
                    urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor
                    porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit
                    maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis
                    molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur tincidunt pellentesque orci id condimentum. Maecenas vitae egestas metus, eu suscipit
                    ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis
                    nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis
                    eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam,
                    luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur,
                    lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo.
                    Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis
                    in.
                </p>
                <p>
                    Vivamus pretium eu metus ut <a href="#">dignissim</a>. Maecenas venenatis id tortor id commodo. In
                    consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis,
                    ante ac auctor auctor, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed
                    consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis
                    nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et
                    porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus
                    congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
                </p>
                <p>
                    Integer urna turpis, imperdiet non pellentesque in, facilisis id ex. Duis at pellentesque augue.
                    Suspendisse eleifend erat ac feugiat congue. Pellentesque bibendum odio mi, quis ullamcorper turpis
                    pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque.
                    Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin
                    pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac
                    tempor risus rhoncus vel.
                </p>
                <p>
                    Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, <a
                        href="#">lobortis eu purus non</a>, ultricies convallis elit. Cras ex lacus, commodo eu mi
                    rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis
                    magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis.
                    Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad
                    litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis
                    ornare.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat neque sed urna vestibulum,
                    ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed.
                    Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut.
                    Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie
                    consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur tincidunt pellentesque orci <a href="#">id condimentum</a>. Maecenas vitae egestas metus,
                    eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec
                    vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus,
                    dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi
                    leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet
                    venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra
                    ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut
                    porttitor justo mattis in.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing elit</a>. Praesent feugiat neque sed
                    urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor
                    porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit
                    maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis
                    molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur <a href="#">tincidunt pellentesque orci</a> id condimentum. Maecenas vitae egestas metus,
                    eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec
                    vitae facilisis nisl. Quisque vulputate <a href="#">imperdiet sem</a>, a porta nunc iaculis in. Cras
                    elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus.
                    Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla
                    sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi
                    viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio
                    diam, ut porttitor justo mattis in.
                </p>
                <p>
                    Vivamus pretium eu metus ut dignissim. Maecenas venenatis id tortor id commodo. In consectetur
                    tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac <a
                        href="#">auctor auctor</a>, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed
                    consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis
                    nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et
                    porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus
                    congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
                </p>
                <p>
                    Integer urna turpis, imperdiet <a href="#">non pellentesque in</a>, facilisis id ex. Duis at
                    pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque <a href="#">bibendum
                        odio mi</a>, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec
                    fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est
                    neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque
                    sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
                </p>
                <p>
                    Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, lobortis eu
                    purus non, ultricies convallis elit. <a href="#">Cras ex lacus</a>, commodo eu mi rhoncus, lobortis
                    consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet
                    scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper
                    tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante,
                    quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia
                    nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
                </p>

                <p>
                    Lorem ipsum dolor sit amet, <a href="#">consectetur</a> adipiscing elit. Praesent feugiat neque sed
                    urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor
                    porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit
                    maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis
                    molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur tincidunt pellentesque orci id condimentum. Maecenas vitae egestas metus, eu suscipit
                    ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis
                    nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis
                    eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam,
                    luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur,
                    lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo.
                    Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis
                    in.
                </p>
                <p>
                    Vivamus pretium eu metus ut <a href="#">dignissim</a>. Maecenas venenatis id tortor id commodo. In
                    consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis,
                    ante ac auctor auctor, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed
                    consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis
                    nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et
                    porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus
                    congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
                </p>
                <p>
                    Integer urna turpis, imperdiet non pellentesque in, facilisis id ex. Duis at pellentesque augue.
                    Suspendisse eleifend erat ac feugiat congue. Pellentesque bibendum odio mi, quis ullamcorper turpis
                    pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque.
                    Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin
                    pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac
                    tempor risus rhoncus vel.
                </p>
                <p>
                    Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, <a
                        href="#">lobortis eu purus non</a>, ultricies convallis elit. Cras ex lacus, commodo eu mi
                    rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis
                    magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis.
                    Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad
                    litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis
                    ornare.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat neque sed urna vestibulum,
                    ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed.
                    Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut.
                    Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie
                    consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur tincidunt pellentesque orci <a href="#">id condimentum</a>. Maecenas vitae egestas metus,
                    eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec
                    vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus,
                    dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi
                    leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet
                    venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra
                    ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut
                    porttitor justo mattis in.
                </p>


            </div>
            <div class="enable-visible-on-focus__container enable-skip-link--end">
                <a href="#beginning-of-component-1" id="end-of-component-1"
                    class="enable-visible-on-focus enable-skip-link">Skip to
                    beginning of block</a>
            </div>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="desktop-example__steps" class="showcode__steps"></div>
                                        <div id="desktop-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="desktop-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="desktop-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="desktop-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="desktop-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="desktop-example"
                        data-showcode-props="desktop-example-props"
                        tabindex="0"
                        aria-describedby="desktop-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="desktop-example-props">
        {
            "replaceHtmlRules": {
                ".fake-component": "<!-- insert HTML with a lot of CTAs here -->"
            },
            "steps": [{
                    "label": "Make the first skip link point to the second one",
                    "highlight": "href=\"#end-of-component-1\" ||| id=\"end-of-component-1\"",
                    "notes": ""
                },
                {
                    "label": "Make the second skip link point to the first",
                    "highlight": "href=\"#beginning-of-component-1\" ||| id=\"beginning-of-component-1\"",
                    "notes": ""
                },

                {
                    "label": "CSS to style the skip link",
                    "highlight": "%CSS%enable-skip-link-style~ .enable-visible-on-focus",
                    "notes": "This hides the skip link by default"
                },
                {
                    "label": "CSS to style the skip link",
                    "highlight": "%CSS%enable-skip-link-style~ .enable-visible-on-focus:focus",
                    "notes": "This ensures that the skip link appears when focus is applied to it."
                }
            ]
        }
        </script>



        <h2>Mobile Friendly Skip Links</h2>

        <p>These skip links work on a different principle than the ones above. They use a little bit of JavaScript to
            work,
            and work really well for mobile screen reader users. <strong>Due to technical limitations, once focused on,
                the skip links remain visible.</strong>
            This seems like a reasonable tradeoff (and can arguably be better for accessibility).
        </p>

        <div id="mobile-example" class="enable-example">
            <div class="enable-mobile-visible-on-focus__container enable-skip-link--begin">
                <a href="#end-of-component-2" id="beginning-of-component-2"
                    class="enable-mobile-visible-on-focus enable-skip-link">
                    Skip to end of block
                </a>
            </div>
            <div class="fake-component">

                <p>
                    Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing elit</a>. Praesent feugiat neque sed
                    urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor
                    porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit
                    maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis
                    molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur <a href="#">tincidunt pellentesque orci</a> id condimentum. Maecenas vitae egestas metus,
                    eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec
                    vitae facilisis nisl. Quisque vulputate <a href="#">imperdiet sem</a>, a porta nunc iaculis in. Cras
                    elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus.
                    Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla
                    sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi
                    viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio
                    diam, ut porttitor justo mattis in.
                </p>
                <p>
                    Vivamus pretium eu metus ut dignissim. Maecenas venenatis id tortor id commodo. In consectetur
                    tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac <a
                        href="#">auctor auctor</a>, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed
                    consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis
                    nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et
                    porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus
                    congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
                </p>
                <p>
                    Integer urna turpis, imperdiet <a href="#">non pellentesque in</a>, facilisis id ex. Duis at
                    pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque <a href="#">bibendum
                        odio mi</a>, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec
                    fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est
                    neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque
                    sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
                </p>
                <p>
                    Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, lobortis eu
                    purus non, ultricies convallis elit. <a href="#">Cras ex lacus</a>, commodo eu mi rhoncus, lobortis
                    consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet
                    scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper
                    tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante,
                    quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia
                    nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
                </p>

                <p>
                    Lorem ipsum dolor sit amet, <a href="#">consectetur</a> adipiscing elit. Praesent feugiat neque sed
                    urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor
                    porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit
                    maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis
                    molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur tincidunt pellentesque orci id condimentum. Maecenas vitae egestas metus, eu suscipit
                    ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis
                    nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis
                    eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam,
                    luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur,
                    lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo.
                    Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis
                    in.
                </p>
                <p>
                    Vivamus pretium eu metus ut <a href="#">dignissim</a>. Maecenas venenatis id tortor id commodo. In
                    consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis,
                    ante ac auctor auctor, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed
                    consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis
                    nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et
                    porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus
                    congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
                </p>
                <p>
                    Integer urna turpis, imperdiet non pellentesque in, facilisis id ex. Duis at pellentesque augue.
                    Suspendisse eleifend erat ac feugiat congue. Pellentesque bibendum odio mi, quis ullamcorper turpis
                    pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque.
                    Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin
                    pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac
                    tempor risus rhoncus vel.
                </p>
                <p>
                    Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, <a
                        href="#">lobortis eu purus non</a>, ultricies convallis elit. Cras ex lacus, commodo eu mi
                    rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis
                    magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis.
                    Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad
                    litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis
                    ornare.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat neque sed urna vestibulum,
                    ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed.
                    Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut.
                    Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie
                    consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur tincidunt pellentesque orci <a href="#">id condimentum</a>. Maecenas vitae egestas metus,
                    eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec
                    vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus,
                    dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi
                    leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet
                    venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra
                    ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut
                    porttitor justo mattis in.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing elit</a>. Praesent feugiat neque sed
                    urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor
                    porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit
                    maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis
                    molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur <a href="#">tincidunt pellentesque orci</a> id condimentum. Maecenas vitae egestas metus,
                    eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec
                    vitae facilisis nisl. Quisque vulputate <a href="#">imperdiet sem</a>, a porta nunc iaculis in. Cras
                    elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus.
                    Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla
                    sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi
                    viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio
                    diam, ut porttitor justo mattis in.
                </p>
                <p>
                    Vivamus pretium eu metus ut dignissim. Maecenas venenatis id tortor id commodo. In consectetur
                    tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac <a
                        href="#">auctor auctor</a>, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed
                    consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis
                    nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et
                    porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus
                    congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
                </p>
                <p>
                    Integer urna turpis, imperdiet <a href="#">non pellentesque in</a>, facilisis id ex. Duis at
                    pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque <a href="#">bibendum
                        odio mi</a>, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec
                    fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est
                    neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque
                    sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
                </p>
                <p>
                    Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, lobortis eu
                    purus non, ultricies convallis elit. <a href="#">Cras ex lacus</a>, commodo eu mi rhoncus, lobortis
                    consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet
                    scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper
                    tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante,
                    quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia
                    nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
                </p>

                <p>
                    Lorem ipsum dolor sit amet, <a href="#">consectetur</a> adipiscing elit. Praesent feugiat neque sed
                    urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor
                    porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit
                    maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis
                    molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur tincidunt pellentesque orci id condimentum. Maecenas vitae egestas metus, eu suscipit
                    ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis
                    nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis
                    eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam,
                    luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur,
                    lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo.
                    Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis
                    in.
                </p>
                <p>
                    Vivamus pretium eu metus ut <a href="#">dignissim</a>. Maecenas venenatis id tortor id commodo. In
                    consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis,
                    ante ac auctor auctor, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed
                    consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis
                    nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et
                    porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus
                    congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
                </p>
                <p>
                    Integer urna turpis, imperdiet non pellentesque in, facilisis id ex. Duis at pellentesque augue.
                    Suspendisse eleifend erat ac feugiat congue. Pellentesque bibendum odio mi, quis ullamcorper turpis
                    pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque.
                    Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin
                    pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac
                    tempor risus rhoncus vel.
                </p>
                <p>
                    Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, <a
                        href="#">lobortis eu purus non</a>, ultricies convallis elit. Cras ex lacus, commodo eu mi
                    rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis
                    magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis.
                    Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad
                    litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis
                    ornare.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat neque sed urna vestibulum,
                    ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed.
                    Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut.
                    Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie
                    consequat. Curabitur dapibus lorem quis elit finibus elementum.
                </p>
                <p>
                    Curabitur tincidunt pellentesque orci <a href="#">id condimentum</a>. Maecenas vitae egestas metus,
                    eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec
                    vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus,
                    dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi
                    leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet
                    venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra
                    ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut
                    porttitor justo mattis in.
                </p>



            </div>
            <div class="enable-mobile-visible-on-focus__container enable-skip-link--end">
                <a href="#beginning-of-component-2" id="end-of-component-2"
                    class="enable-mobile-visible-on-focus enable-skip-link">Skip to
                    beginning of block</a>
            </div>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="mobile-example__steps" class="showcode__steps"></div>
                                        <div id="mobile-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="mobile-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="mobile-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="mobile-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="mobile-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="mobile-example"
                        data-showcode-props="mobile-example-props"
                        tabindex="0"
                        aria-describedby="mobile-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="mobile-example-props">
        {
            "replaceHtmlRules": {
                ".fake-component": "<!-- insert HTML with a lot of CTAs here -->"
            },
            "steps": [{
                    "label": "Make container elements around the skip link",
                    "highlight": "enable-mobile-visible-on-focus__container",
                    "notes": "These containers are very important to the functionality of the skip links and are not optional."
                },
                {
                    "label": "Make the container absolutely positioned",
                    "highlight": "%CSS%enable-skip-link-style~.enable-mobile-visible-on-focus__container ||| position[^;]*;",
                    "notes": ""
                },
                {
                    "label": "Ensure this container is visibly hidden.",
                    "highlight": "%CSS%enable-skip-link-style~.enable-mobile-visible-on-focus__container ||| [^\n]*display[^\\)]*\\);",
                    "notes": "This CSS ensures is it not visible by sighted users on page load.  The <code>pointer-events: none</code> code ensures mouse users can never activate these skip links by accident (i.e. they are only accessible by keyboard users and by mobile screen readers when the user swipes into it."
                },
                {
                    "label": "Add enable-mobile-visible-on-focus classes to the skip link",
                    "highlight": "enable-mobile-visible-on-focus\\s",
                    "notes": ""
                },
                {
                    "label": "Style the enable-mobile-visible-on-focus elements",
                    "highlight": "%CSS%enable-skip-link-style~.enable-mobile-visible-on-focus__container ||| width[^;]*; ||| overflow[^;]*; ||| %CSS%enable-skip-link-style~.enable-mobile-visible-on-focus ||| margin-left[^;]*;",
                    "notes": "Note that the container has a width of 100% with the overflow hidden.  When the page loads, the contents will not be visible.  When the user focuses in on the skip link inside of it, the browser will horizontally scroll that element into view and trigger a scroll event.  This is the heart of how this mobile solution works."
                },
                {
                    "label": "Make the first skip link point to the second one",
                    "highlight": "href=\"#end-of-component-2\" ||| id=\"end-of-component-2\"",
                    "notes": ""
                },
                {
                    "label": "Make the second skip link point to the first",
                    "highlight": "href=\"#beginning-of-component-2\" ||| id=\"beginning-of-component-2\"",
                    "notes": ""
                },
                {
                    "label": "Initialize the Javascript",
                    "highlight": "%JS% enableVisibleOnFocus.init",
                    "notes": "This sets up all the events needed for the links"
                },
                {
                    "label": "Skip Link Click Event",
                    "highlight": "%JS% enableVisibleOnFocus.clickEvent",
                    "notes": "Ensures focus goes to the skip links target in all browsers that don't do this correctly (e.g. Firefox)."
                },
                {
                    "label": "Scroll Event",
                    "highlight": "%JS% enableVisibleOnFocus.scrollEvent",
                    "notes": "This ensures that when a user uses the skip link, its target is not outside the browser's viewport."
                },
                {
                    "label": "Hide All Method",
                    "highlight": "%JS% enableVisibleOnFocus ||| hideAll\\(\\): ||| hide\\(\\):",
                    "notes": "This method is invoked when the page is loaded, since browsers like Firefox will remember the scroll state of the component when the page is reloaded. This method is also invoked onResize and onOrientationChange, since the look of the component can look odd after these events"
                },
                {
                    "label": "CSS to style the skip link",
                    "highlight": "%CSS%enable-skip-link-style~ .enable-skip-link ||| width[^;]*;  ",
                    "notes": ""
                }
            ]
        }
        </script>


    </main>

        <footer aria-label="Copyright Information">
            
        Enable is a labour of love originally by
        <a href="https://useragentman.com">Zoltan Hawryluk</a>, released as open
        source so hopefully others can learn from it.  This content is covered by the the <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International Licence</a>

    </footer> 
        

    <!-- These three script tags are for the code samples -->
    <script src="node_modules/indent.js/lib/indent.min.js"></script>
    <script src="js/libs/prism.js" data-manual></script>
    <script src="js/showcode.js"></script>

    <!-- Hamburger Menu -->
    <script src="js/accessibility.js"></script>
    <script src="js/hamburger.js"></script>

    <script src="js/shared/enable-visible-on-focus.js"></script>
</body>

</html>