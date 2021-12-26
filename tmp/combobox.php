<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA combobox role examples</title>
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




    <link rel="stylesheet" type="text/css" href="css/combobox__improved.css" />
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
        <aside class="notes">
            <p>
                Example 1 is heavily refactored version of
                <a href="https://webkit.org/blog-files/aria1.0/combobox_with_live_region_status.html">the combobox
                    example
                    at webkit.org</a>. Added was a few extra instructions and UX features for screen reader users so
                they could use the autocomplete features in this widget.
                Note that it works way better than the native HTML5 <code>&lt;datalist&gt;</code> version. It
                is a huge exception to the rule that native works better than
                ARIA-based code.
            </p>
        </aside>

        <h1>ARIA combobox role examples</h1>

        <h2>Example 1:</h2>

        <p>Here is a standard autocomplete example using ARIA.</p>

        <div class="enable-example">
        <form>
            <div id="example1" class="enable-combobox">
                <label id="aria-fruit__label" for="aria-fruit"> Enter a fruit or vegetable </label>
                <div class="enable-combobox__inner-container">
                    <div class="enable-combobox__controls-container">
                        <div role="status" aria-atomic="true"></div>
                        <input type="text" id="aria-fruit" aria-describedby="aria-fruit__desc" role="combobox"
                            aria-autocomplete="list" aria-owns="aria-fruit__list" aria-expanded="false"
                            autocomplete="off" autocorrect="off" autocapitalize="off" required />
                        <button class="enable-combobox__reset-button" aria-controls="aria-fruit" type="reset"
                            aria-describedby="aria-fruit__label">
                            <img class="enable-combobox__reset-button-image" src="images/close-window.svg"
                                alt="Clear" />
                        </button>

                        <!-- The dropdown (a.k.a. "listbox") -->
                        <ul role="listbox" id="aria-fruit__list" tabindex="-1" hidden>
                            <li tabindex="-1" role="option" >Apple</li>
                            <li tabindex="-1" role="option" >Artichoke</li>
                            <li tabindex="-1" role="option" >Asparagus</li>
                            <li tabindex="-1" role="option" >Banana</li>
                            <li tabindex="-1" role="option" >Beets</li>
                            <li tabindex="-1" role="option" >Bell pepper</li>
                            <li tabindex="-1" role="option" >Broccoli</li>
                            <li tabindex="-1" role="option" >Brussels sprout</li>
                            <li tabindex="-1" role="option" >Cabbage</li>
                            <li tabindex="-1" role="option" >Carrot</li>
                            <li tabindex="-1" role="option" >Cauliflower</li>
                            <li tabindex="-1" role="option" >Celery</li>
                            <li tabindex="-1" role="option" >Chard</li>
                            <li tabindex="-1" role="option" >Chicory</li>
                            <li tabindex="-1" role="option" >Corn</li>
                            <li tabindex="-1" role="option" >Cucumber</li>
                            <li tabindex="-1" role="option" >Daikon</li>
                            <li tabindex="-1" role="option" >Date</li>
                            <li tabindex="-1" role="option" >Edamame</li>
                            <li tabindex="-1" role="option" >Eggplant</li>
                            <li tabindex="-1" role="option" >Elderberry</li>
                            <li tabindex="-1" role="option" >Fennel</li>
                            <li tabindex="-1" role="option" >Fig</li>
                            <li tabindex="-1" role="option" >Garlic</li>
                            <li tabindex="-1" role="option" >Grape</li>
                            <li tabindex="-1" role="option" >Honeydew melon</li>
                            <li tabindex="-1" role="option" >Iceberg lettuce</li>
                            <li tabindex="-1" role="option" >
                                Jerusalem artichoke
                            </li>
                            <li tabindex="-1" role="option" >Kale</li>
                            <li tabindex="-1" role="option" >Kiwi</li>
                            <li tabindex="-1" role="option" >Leek</li>
                            <li tabindex="-1" role="option" >Lemon</li>
                            <li tabindex="-1" role="option" >Mango</li>
                            <li tabindex="-1" role="option" >Mangosteen</li>
                            <li tabindex="-1" role="option" >Melon</li>
                            <li tabindex="-1" role="option" >Mushroom</li>
                            <li tabindex="-1" role="option" >Nectarine</li>
                            <li tabindex="-1" role="option" >Okra</li>
                            <li tabindex="-1" role="option" >Olive</li>
                            <li tabindex="-1" role="option" >Onion</li>
                            <li tabindex="-1" role="option" >Orange</li>
                            <li tabindex="-1" role="option" >Parship</li>
                            <li tabindex="-1" role="option" >Pea</li>
                            <li tabindex="-1" role="option" >Pear</li>
                            <li tabindex="-1" role="option" >Pineapple</li>
                            <li tabindex="-1" role="option" >Potato</li>
                            <li tabindex="-1" role="option" >Pumpkin</li>
                            <li tabindex="-1" role="option" >Quince</li>
                            <li tabindex="-1" role="option" >Radish</li>
                            <li tabindex="-1" role="option" >Rhubarb</li>
                            <li tabindex="-1" role="option" >Shallot</li>
                            <li tabindex="-1" role="option" >Spinach</li>
                            <li tabindex="-1" role="option" >Squash</li>
                            <li tabindex="-1" role="option" >Strawberry</li>
                            <li tabindex="-1" role="option" >Sweet potato</li>
                            <li tabindex="-1" role="option" >Tomato</li>
                            <li tabindex="-1" role="option" >Turnip</li>
                            <li tabindex="-1" role="option" >Ugli fruit</li>
                            <li tabindex="-1" role="option" >Victoria plum</li>
                            <li tabindex="-1" role="option" >Watercress</li>
                            <li tabindex="-1" role="option" >Watermelon</li>
                            <li tabindex="-1" role="option" >Yam</li>
                            <li tabindex="-1" role="option" >Zucchi</li>
                        </ul>
                    </div>
                    <div class="sr-only" id="aria-fruit__desc">
                        As you type, press the enter key or use the up and down arrow keys to choose the autocomplete items.
                    </div>
                </div>
            </div>
        </form>
</div>

        

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="example1__steps" class="showcode__steps"></div>
                                        <div id="example1__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="example1__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="example1__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="example1__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="example1__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example1"
                        data-showcode-props="example1-props"
                        tabindex="0"
                        aria-describedby="example1__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="example1-props">
        {
            "replaceHtmlRules": {
                "[role=\"listbox\"]": "<li role=\"option\" value=\"Apple\">Apple</li><li role=\"option\" value=\"Artichoke\">Artichoke</li> ..."
            },
            "steps": [{
                    "label": "Place ARIA roles in document",
                    "highlight": "role=\"combobox\"",
                    "notes": "The input field must have a role of combobox in order for it to be announced correctly by the screen reader."
                },
                {
                    "label": "Code label to be associated with input",
                    "highlight": "for",
                    "notes": "Ensure the label is properly lababelled"
                },
                {
                    "label": "Component instructions for the component using aria-describedby",
                    "highlight": "aria-describedby",
                    "notes": "These instructions are visibly hidden, since they are only for screen reader users."
                },
                {
                    "label": "Associate the dropdown data with the input field",
                    "highlight": "aria-owns",
                    "notes": "This ensures the two elements are linked"
                },
                {
                    "label": "Set aria-autocomplete attribute",
                    "highlight": "aria-autocomplete",
                    "notes": "This tells the screen reader the type of autocompletion that is being done.  Possible values are <code>list</code> and <code>inline</code>."
                },
                {
                    "label": "Expose state of the dropdown",
                    "highlight": "aria-expanded",
                    "notes": "<p>When the menu is expanded, this should be set to <code>\"true\"</code>. Otherwise, it is set to <code>\"false\"</code>.</p><p>Note that when the dropdown is expanded, focus should go to the first element in the dropdown. The user should be able to cycle through the elements in the dropdown using the arrow keys.</p><p>When the user picks an element with the ENTER key, the dropdown should close and the element should be selected."
                },
                {
                    "label": "Turn off autocorrect and autocomplete",
                    "highlight": "autocomplete=\"off\" ||| autocorrect ||| autocapitalize=\"off\"",
                    "notes": "If we want to ensure the user can only pick the items in the dropdown, we have to make sure these items are shut off."
                },
                {
                    "label": "Insert roles for autocomplete list",
                    "highlight": "role=\"listbox\" ||| role=\"option\"",
                    "notes": "Options must be direct children of listbox"
                }
            ]
        }
        </script>




        <h2>Example 2:</h2>

        <p>Another ARIA combobox example. Note the special formatting in the dropdown. This is common
            in a lot of modern searchboxes in the headings of a lot of e-commerce sites.</p>

        <div id="example2" class="enable-example">
        <form>
            <div class="enable-combobox">
                <label for="aria-example-2"> Enter a name of a country or de jure sovereign state</label>
                <div class="enable-combobox__inner-container">
                    <div class="enable-combobox__controls-container">
                        <!--
                        This announces instructions to screen reader users when
                        they focus into the widget
                        -->
                        <div class="sr-only" id="aria-example-2__desc">
                            As you type, use the up and down arrow keys (or swipe left and
                            right) to choose the autocomplete items.
                        </div>

                        <!--
                        This live region will announce how many items are visible
                        in the dropdown after the user types in characters into the
                        input. (e.g. 4 items).
                        -->
                        <div role="status" aria-atomic="true">
                            <!-- This is the list status live region: e.g. "4 items." -->
                        </div>

                        <!--
                        The focusable part of the widget.
                        -->
                        <input type="text" tabindex="0" id="aria-example-2" role="combobox" aria-autocomplete="list"
                            aria-owns="aria-example-2__list" aria-expanded="false" autocomplete="off" autocorrect="off"
                            autocapitalize="off" aria-describedby="aria-example-2__desc" />
                        <button class="enable-combobox__reset-button" aria-controls="aria-fruit" type="reset">
                            <img class="enable-combobox__reset-button-image" src="images/close-window.svg" alt="Clear"
                                aria-describedby="aria-fruit__label" />
                        </button>
                        <!--
                        The dropdown (a.k.a. "listbox")
                    -->
                        <div role="listbox" id="aria-example-2__list" hidden>
                            <div class="enable-combobox__group" role="presentation">
                                <h2 class="enable-combobox__group-header">Communist States</h2>

                                <div role="option" >People's Republic of China</div>
                                <div role="option" >
                                    Democratic
                                    People's Republic of Korea (North Korea)</div>
                                <div role="option" >Socialist Republic of Vietnam
                                </div>
                                <div role="option" >Lao People's
                                    Democratic
                                    Republic (Laos)</div>
                                <div role="option" >Republic of Cuba</div>
                            </div>
                            <div class="enable-combobox__group" role="presentation">
                                <h2 class="enable-combobox__group-header">Other States</h2>
                                <div role="option" >Afghanistan</div>
                                <div role="option" >Albania</div>
                                <div role="option" >Algeria</div>
                                <div role="option" >Andorra</div>
                                <div role="option" >Angola</div>
                                <div role="option" >Antigua and Barbuda</div>
                                <div role="option" >Argentina</div>
                                <div role="option" >Armenia</div>
                                <div role="option" >Australia</div>
                                <div role="option" >Austria</div>
                                <div role="option" >Azerbaijan</div>
                                <div role="option" >Bahamas</div>
                                <div role="option" >Bahrain</div>
                                <div role="option" >Bangladesh</div>
                                <div role="option" >Barbados</div>
                                <div role="option" >Belarus</div>
                                <div role="option" >Belgium</div>
                                <div role="option" >Belize</div>
                                <div role="option" >Benin</div>
                                <div role="option" >Bhutan</div>
                                <div role="option" >Bolivia</div>
                                <div role="option" >Bosnia and Herzegovina</div>
                                <div role="option" >Botswana</div>
                                <div role="option" >Brazil</div>
                                <div role="option" >Brunei </div>
                                <div role="option" >Bulgaria</div>
                                <div role="option" >Burkina Faso</div>
                                <div role="option" >Burundi</div>
                                <div role="option" >Cabo Verde</div>
                                <div role="option" >Cambodia</div>
                                <div role="option" >Cameroon</div>
                                <div role="option" >Canada</div>
                                <div role="option" >Central African Republic</div>
                                <div role="option" >Chad</div>
                                <div role="option" >Chile</div>
                                <div role="option" >Colombia</div>
                                <div role="option" >Comoros</div>
                                <div role="option" >Congo</div>
                                <div role="option" >Costa Rica</div>
                                <div role="option" >Croatia</div>
                                <div role="option" >Cyprus</div>
                                <div role="option" >Czech Republic (Czechia)</div>
                                <div role="option" >Côte d'Ivoire</div>
                                <div role="option" >DR Congo</div>
                                <div role="option" >Denmark</div>
                                <div role="option" >Djibouti</div>
                                <div role="option" >Dominica</div>
                                <div role="option" >Dominican Republic</div>
                                <div role="option" >Ecuador</div>
                                <div role="option" >Egypt</div>
                                <div role="option" >El Salvador</div>
                                <div role="option" >Equatorial Guinea</div>
                                <div role="option" >Eritrea</div>
                                <div role="option" >Estonia</div>
                                <div role="option" >Eswatini</div>
                                <div role="option" >Ethiopia</div>
                                <div role="option" >Fiji</div>
                                <div role="option" >Finland</div>
                                <div role="option" >France</div>
                                <div role="option" >Gabon</div>
                                <div role="option" >Gambia</div>
                                <div role="option" >Georgia</div>
                                <div role="option" >Germany</div>
                                <div role="option" >Ghana</div>
                                <div role="option" >Greece</div>
                                <div role="option" >Grenada</div>
                                <div role="option" >Guatemala</div>
                                <div role="option" >Guinea</div>
                                <div role="option" >Guinea-Bissau</div>
                                <div role="option" >Guyana</div>
                                <div role="option" >Haiti</div>
                                <div role="option" >Holy See</div>
                                <div role="option" >Honduras</div>
                                <div role="option" >Hungary</div>
                                <div role="option" >Iceland</div>
                                <div role="option" >India</div>
                                <div role="option" >Indonesia</div>
                                <div role="option" >Iran</div>
                                <div role="option" >Iraq</div>
                                <div role="option" >Ireland</div>
                                <div role="option" >Israel</div>
                                <div role="option" >Italy</div>
                                <div role="option" >Jamaica</div>
                                <div role="option" >Japan</div>
                                <div role="option" >Jordan</div>
                                <div role="option" >Kazakhstan</div>
                                <div role="option" >Kenya</div>
                                <div role="option" >Kiribati</div>
                                <div role="option" >Kuwait</div>
                                <div role="option" >Kyrgyzstan</div>
                                <div role="option" >Latvia</div>
                                <div role="option" >Lebanon</div>
                                <div role="option" >Lesotho</div>
                                <div role="option" >Liberia</div>
                                <div role="option" >Libya</div>
                                <div role="option" >Liechtenstein</div>
                                <div role="option" >Lithuania</div>
                                <div role="option" >Luxembourg</div>
                                <div role="option" >Madagascar</div>
                                <div role="option" >Malawi</div>
                                <div role="option" >Malaysia</div>
                                <div role="option" >Maldives</div>
                                <div role="option" >Mali</div>
                                <div role="option" >Malta</div>
                                <div role="option" >Marshall Islands</div>
                                <div role="option" >Mauritania</div>
                                <div role="option" >Mauritius</div>
                                <div role="option" >Mexico</div>
                                <div role="option" >Micronesia</div>
                                <div role="option" >Moldova</div>
                                <div role="option" >Monaco</div>
                                <div role="option" >Mongolia</div>
                                <div role="option" >Montenegro</div>
                                <div role="option" >Morocco</div>
                                <div role="option" >Mozambique</div>
                                <div role="option" >Myanmar</div>
                                <div role="option" >Namibia</div>
                                <div role="option" >Nauru</div>
                                <div role="option" >Nepal</div>
                                <div role="option" >Netherlands</div>
                                <div role="option" >New Zealand</div>
                                <div role="option" >Nicaragua</div>
                                <div role="option" >Niger</div>
                                <div role="option" >Nigeria</div>
                                <div role="option" >North Macedonia</div>
                                <div role="option" >Norway</div>
                                <div role="option" >Oman</div>
                                <div role="option" >Pakistan</div>
                                <div role="option" >Palau</div>
                                <div role="option" >Panama</div>
                                <div role="option" >Papua New Guinea</div>
                                <div role="option" >Paraguay</div>
                                <div role="option" >Peru</div>
                                <div role="option" >Philippines</div>
                                <div role="option" >Poland</div>
                                <div role="option" >Portugal</div>
                                <div role="option" >Qatar</div>
                                <div role="option" >Romania</div>
                                <div role="option" >Russia</div>
                                <div role="option" >Rwanda</div>
                                <div role="option" >Saint Kitts &amp; Nevis</div>
                                <div role="option" >Saint Lucia</div>
                                <div role="option" >Samoa</div>
                                <div role="option" >San Marino</div>
                                <div role="option" >Sao Tome &amp; Principe</div>
                                <div role="option" >Saudi Arabia</div>
                                <div role="option" >Senegal</div>
                                <div role="option" >Serbia</div>
                                <div role="option" >Seychelles</div>
                                <div role="option" >Sierra Leone</div>
                                <div role="option" >Singapore</div>
                                <div role="option" >Slovakia</div>
                                <div role="option" >Slovenia</div>
                                <div role="option" >Solomon Islands</div>
                                <div role="option" >Somalia</div>
                                <div role="option" >South Africa</div>
                                <div role="option" >South Korea</div>
                                <div role="option" >South Sudan</div>
                                <div role="option" >Spain</div>
                                <div role="option" >Sri Lanka</div>
                                <div role="option" >St. Vincent &amp; Grenadines
                                </div>
                                <div role="option" >State of Palestine</div>
                                <div role="option" >Sudan</div>
                                <div role="option" >Suriname</div>
                                <div role="option" >Sweden</div>
                                <div role="option" >Switzerland</div>
                                <div role="option" >Syria</div>
                                <div role="option" >Tajikistan</div>
                                <div role="option" >Tanzania</div>
                                <div role="option" >Thailand</div>
                                <div role="option" >Timor-Leste</div>
                                <div role="option" >Togo</div>
                                <div role="option" >Tonga</div>
                                <div role="option" >Trinidad and Tobago</div>
                                <div role="option" >Tunisia</div>
                                <div role="option" >Turkey</div>
                                <div role="option" >Turkmenistan</div>
                                <div role="option" >Tuvalu</div>
                                <div role="option" >Uganda</div>
                                <div role="option" >Ukraine</div>
                                <div role="option" >United Arab Emirates</div>
                                <div role="option" >United Kingdom</div>
                                <div role="option" >United States</div>
                                <div role="option" >Uruguay</div>
                                <div role="option" >Uzbekistan</div>
                                <div role="option" >Vanuatu</div>
                                <div role="option" >Venezuela</div>
                                <div role="option" >Yemen</div>
                                <div role="option" >Zambia</div>
                                <div role="option" >Zimbabwe</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>


                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

            
            <p><strong>Note: since it is very similar, please follow all the steps in the previous example first before
            implementing the following steps.</strong></p>
                                <div class="showcode">
                <form class="showcode__ui">                                        <div id="example2__steps" class="showcode__steps"></div>
                                        <div id="example2__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="example2__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="example2__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="example2__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="example2__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example2"
                        data-showcode-props="example2-props"
                        tabindex="0"
                        aria-describedby="example2__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="example2-props">
        {
            "replaceHtmlRules": {
                "[role=\"listbox\"]":  [
                    "<div class=\"enable-combobox__group\" role=\"presentation\">",
                        "<h2 class=\"enable-combobox__group-header\">Communist States</h2>",
                        "",
                        "<div role=\"option\" >People's Republic of China</div>",
                        "",
                        "...",
                        "",
                    "</div>",
                    "<div class=\"enable-combobox__group\" role=\"presentation\">",
                        "<h2 class=\"enable-combobox__group-header\">Other States</h2>",
                        "<div role=\"option\" >Afghanistan</div>",
                        "",
                        "...",
                    "</div>"
                ]
            },
            "steps": [
                {
                    "label": "Set up group roles",
                    "highlight": "role=\"presentation\"",
                    "notes": "This is because the option elements are not direct children of the listbox."
                },
                {
                    "label": "Set up headings for the groups",
                    "highlight": "%OPENCLOSETAG%~ h2",
                    "notes": "The heading for each group"
                }
            ]
        }
        </script>

        <h2>Example 2a: Autosubmitting when choosing an element</h2>

        <div id="example2-submit-on-select" class="enable-example">
            <form role="search" aria-label="Example 2a combobox example" tabindex="-1">
                <div class="enable-combobox">
                    <label for="aria-example-2a">Country:</label>
                    <div class="enable-combobox__inner-container">
                        <div id="aria-example-2a__close-desc" class="sr-only">
                            Please choose a value or clear the combobox by either pressing the escape key or activating the clear button.
                        </div>

                        <div class="enable-combobox__controls-container">
                            <!--
                            This announces instructions to screen reader users when
                            they focus into the widget
                            -->
                            <div class="sr-only" id="aria-example-2a__desc">
                                As you type, use the up and down arrow keys or press ENTER and swipe to choose the autocomplete items.
                            </div>

                            <!--
                            This live region will announce how many items are visible
                            in the dropdown after the user types in characters into the
                            input. (e.g. 4 items).
                            -->
                            <div role="status" aria-atomic="true">
                                <!-- This is the list status live region: e.g. "4 items." -->
                            </div>

                            <!--
                            The focusable part of the widget.
                            -->
                            <input type="text" tabindex="0" id="aria-example-2a" role="combobox" aria-autocomplete="list"
                                aria-owns="aria-example-2a__list" aria-expanded="false" autocomplete="off" autocorrect="off"
                                autocapitalize="off" aria-describedby="aria-example-2a__desc" />
                            <button class="enable-combobox__reset-button" aria-controls="aria-fruit" type="reset" aria-describedby="aria-example-2a__close-desc">
                                <img class="enable-combobox__reset-button-image" src="images/close-window.svg" alt="Clear"
                                    aria-describedby="aria-fruit__label" />
                            </button>
                            <!--
                            The dropdown (a.k.a. "listbox")
                        -->
                            <div role="listbox" id="aria-example-2a__list" hidden >
                                <div class="enable-combobox__group" role="presentation">
                                    <h2 class="enable-combobox__group-header">Communist States</h2>

                                    <div role="option" >People's Republic of China</div>
                                    <div role="option" >
                                        Democratic
                                        People's Republic of Korea (North Korea)</div>
                                    <div role="option" >Socialist Republic of Vietnam
                                    </div>
                                    <div role="option" >Lao People's
                                        Democratic
                                        Republic (Laos)</div>
                                    <div role="option" >Republic of Cuba</div>
                                </div>
                                <div class="enable-combobox__group" role="presentation">
                                    <h2 class="enable-combobox__group-header">Other States</h2>
                                    <div role="option" >Afghanistan</div>
                                    <div role="option" >Albania</div>
                                    <div role="option" >Algeria</div>
                                    <div role="option" >Andorra</div>
                                    <div role="option" >Angola</div>
                                    <div role="option" >Antigua and Barbuda</div>
                                    <div role="option" >Argentina</div>
                                    <div role="option" >Armenia</div>
                                    <div role="option" >Australia</div>
                                    <div role="option" >Austria</div>
                                    <div role="option" >Azerbaijan</div>
                                    <div role="option" >Bahamas</div>
                                    <div role="option" >Bahrain</div>
                                    <div role="option" >Bangladesh</div>
                                    <div role="option" >Barbados</div>
                                    <div role="option" >Belarus</div>
                                    <div role="option" >Belgium</div>
                                    <div role="option" >Belize</div>
                                    <div role="option" >Benin</div>
                                    <div role="option" >Bhutan</div>
                                    <div role="option" >Bolivia</div>
                                    <div role="option" >Bosnia and Herzegovina</div>
                                    <div role="option" >Botswana</div>
                                    <div role="option" >Brazil</div>
                                    <div role="option" >Brunei </div>
                                    <div role="option" >Bulgaria</div>
                                    <div role="option" >Burkina Faso</div>
                                    <div role="option" >Burundi</div>
                                    <div role="option" >Cabo Verde</div>
                                    <div role="option" >Cambodia</div>
                                    <div role="option" >Cameroon</div>
                                    <div role="option" >Canada</div>
                                    <div role="option" >Central African Republic</div>
                                    <div role="option" >Chad</div>
                                    <div role="option" >Chile</div>
                                    <div role="option" >Colombia</div>
                                    <div role="option" >Comoros</div>
                                    <div role="option" >Congo</div>
                                    <div role="option" >Costa Rica</div>
                                    <div role="option" >Croatia</div>
                                    <div role="option" >Cyprus</div>
                                    <div role="option" >Czech Republic (Czechia)</div>
                                    <div role="option" >Côte d'Ivoire</div>
                                    <div role="option" >DR Congo</div>
                                    <div role="option" >Denmark</div>
                                    <div role="option" >Djibouti</div>
                                    <div role="option" >Dominica</div>
                                    <div role="option" >Dominican Republic</div>
                                    <div role="option" >Ecuador</div>
                                    <div role="option" >Egypt</div>
                                    <div role="option" >El Salvador</div>
                                    <div role="option" >Equatorial Guinea</div>
                                    <div role="option" >Eritrea</div>
                                    <div role="option" >Estonia</div>
                                    <div role="option" >Eswatini</div>
                                    <div role="option" >Ethiopia</div>
                                    <div role="option" >Fiji</div>
                                    <div role="option" >Finland</div>
                                    <div role="option" >France</div>
                                    <div role="option" >Gabon</div>
                                    <div role="option" >Gambia</div>
                                    <div role="option" >Georgia</div>
                                    <div role="option" >Germany</div>
                                    <div role="option" >Ghana</div>
                                    <div role="option" >Greece</div>
                                    <div role="option" >Grenada</div>
                                    <div role="option" >Guatemala</div>
                                    <div role="option" >Guinea</div>
                                    <div role="option" >Guinea-Bissau</div>
                                    <div role="option" >Guyana</div>
                                    <div role="option" >Haiti</div>
                                    <div role="option" >Holy See</div>
                                    <div role="option" >Honduras</div>
                                    <div role="option" >Hungary</div>
                                    <div role="option" >Iceland</div>
                                    <div role="option" >India</div>
                                    <div role="option" >Indonesia</div>
                                    <div role="option" >Iran</div>
                                    <div role="option" >Iraq</div>
                                    <div role="option" >Ireland</div>
                                    <div role="option" >Israel</div>
                                    <div role="option" >Italy</div>
                                    <div role="option" >Jamaica</div>
                                    <div role="option" >Japan</div>
                                    <div role="option" >Jordan</div>
                                    <div role="option" >Kazakhstan</div>
                                    <div role="option" >Kenya</div>
                                    <div role="option" >Kiribati</div>
                                    <div role="option" >Kuwait</div>
                                    <div role="option" >Kyrgyzstan</div>
                                    <div role="option" >Latvia</div>
                                    <div role="option" >Lebanon</div>
                                    <div role="option" >Lesotho</div>
                                    <div role="option" >Liberia</div>
                                    <div role="option" >Libya</div>
                                    <div role="option" >Liechtenstein</div>
                                    <div role="option" >Lithuania</div>
                                    <div role="option" >Luxembourg</div>
                                    <div role="option" >Madagascar</div>
                                    <div role="option" >Malawi</div>
                                    <div role="option" >Malaysia</div>
                                    <div role="option" >Maldives</div>
                                    <div role="option" >Mali</div>
                                    <div role="option" >Malta</div>
                                    <div role="option" >Marshall Islands</div>
                                    <div role="option" >Mauritania</div>
                                    <div role="option" >Mauritius</div>
                                    <div role="option" >Mexico</div>
                                    <div role="option" >Micronesia</div>
                                    <div role="option" >Moldova</div>
                                    <div role="option" >Monaco</div>
                                    <div role="option" >Mongolia</div>
                                    <div role="option" >Montenegro</div>
                                    <div role="option" >Morocco</div>
                                    <div role="option" >Mozambique</div>
                                    <div role="option" >Myanmar</div>
                                    <div role="option" >Namibia</div>
                                    <div role="option" >Nauru</div>
                                    <div role="option" >Nepal</div>
                                    <div role="option" >Netherlands</div>
                                    <div role="option" >New Zealand</div>
                                    <div role="option" >Nicaragua</div>
                                    <div role="option" >Niger</div>
                                    <div role="option" >Nigeria</div>
                                    <div role="option" >North Macedonia</div>
                                    <div role="option" >Norway</div>
                                    <div role="option" >Oman</div>
                                    <div role="option" >Pakistan</div>
                                    <div role="option" >Palau</div>
                                    <div role="option" >Panama</div>
                                    <div role="option" >Papua New Guinea</div>
                                    <div role="option" >Paraguay</div>
                                    <div role="option" >Peru</div>
                                    <div role="option" >Philippines</div>
                                    <div role="option" >Poland</div>
                                    <div role="option" >Portugal</div>
                                    <div role="option" >Qatar</div>
                                    <div role="option" >Romania</div>
                                    <div role="option" >Russia</div>
                                    <div role="option" >Rwanda</div>
                                    <div role="option" >Saint Kitts &amp; Nevis</div>
                                    <div role="option" >Saint Lucia</div>
                                    <div role="option" >Samoa</div>
                                    <div role="option" >San Marino</div>
                                    <div role="option" >Sao Tome &amp; Principe</div>
                                    <div role="option" >Saudi Arabia</div>
                                    <div role="option" >Senegal</div>
                                    <div role="option" >Serbia</div>
                                    <div role="option" >Seychelles</div>
                                    <div role="option" >Sierra Leone</div>
                                    <div role="option" >Singapore</div>
                                    <div role="option" >Slovakia</div>
                                    <div role="option" >Slovenia</div>
                                    <div role="option" >Solomon Islands</div>
                                    <div role="option" >Somalia</div>
                                    <div role="option" >South Africa</div>
                                    <div role="option" >South Korea</div>
                                    <div role="option" >South Sudan</div>
                                    <div role="option" >Spain</div>
                                    <div role="option" >Sri Lanka</div>
                                    <div role="option" >St. Vincent &amp; Grenadines
                                    </div>
                                    <div role="option" >State of Palestine</div>
                                    <div role="option" >Sudan</div>
                                    <div role="option" >Suriname</div>
                                    <div role="option" >Sweden</div>
                                    <div role="option" >Switzerland</div>
                                    <div role="option" >Syria</div>
                                    <div role="option" >Tajikistan</div>
                                    <div role="option" >Tanzania</div>
                                    <div role="option" >Thailand</div>
                                    <div role="option" >Timor-Leste</div>
                                    <div role="option" >Togo</div>
                                    <div role="option" >Tonga</div>
                                    <div role="option" >Trinidad and Tobago</div>
                                    <div role="option" >Tunisia</div>
                                    <div role="option" >Turkey</div>
                                    <div role="option" >Turkmenistan</div>
                                    <div role="option" >Tuvalu</div>
                                    <div role="option" >Uganda</div>
                                    <div role="option" >Ukraine</div>
                                    <div role="option" >United Arab Emirates</div>
                                    <div role="option" >United Kingdom</div>
                                    <div role="option" >United States</div>
                                    <div role="option" >Uruguay</div>
                                    <div role="option" >Uzbekistan</div>
                                    <div role="option" >Vanuatu</div>
                                    <div role="option" >Venezuela</div>
                                    <div role="option" >Yemen</div>
                                    <div role="option" >Zambia</div>
                                    <div role="option" >Zimbabwe</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

            
            <p><strong>Note: since it is very similar, please follow all the steps in the two previous examples first before
            implementing the following steps.</strong></p>
                                <div class="showcode">
                <form class="showcode__ui">                                        <div id="example2-submit-on-select__steps" class="showcode__steps"></div>
                                        <div id="example2-submit-on-select__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="example2-submit-on-select__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="example2-submit-on-select__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="example2-submit-on-select__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="example2-submit-on-select__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example2-submit-on-select"
                        data-showcode-props="example2-submit-on-select-props"
                        tabindex="0"
                        aria-describedby="example2-submit-on-select__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="example2-submit-on-select-props">
        {
            "replaceHtmlRules": {
                "[role=\"listbox\"]":  [
                    "<div class=\"enable-combobox__group\" role=\"presentation\">",
                        "<h2 class=\"enable-combobox__group-header\">Communist States</h2>",
                        "",
                        "<div role=\"option\" >People's Republic of China</div>",
                        "",
                        "...",
                        "",
                    "</div>",
                    "<div class=\"enable-combobox__group\" role=\"presentation\">",
                        "<h2 class=\"enable-combobox__group-header\">Other States</h2>",
                        "<div role=\"option\" >Afghanistan</div>",
                        "",
                        "...",
                    "</div>"
                ]
            },
            "steps": [
                {
                    "label": "Create JS code to submit query when clicking the option elements.",
                    "highlight": "%JS% autocompleteSubmit",
                    "notes": "Note that custom event <code>combobox-change</code> that this event handler uses. This fires when an option is chosen from the list.  It takes the value chosen and puts it inside a Google Search URL, using URLSearchParams and a template string."
                }
            ]
        }
        </script>


        <h2>Example 3: Using HTML5 datalist</h2>

        <p>
            Ironically, this seems to be inaccessible compared to the ARIA version:
        </p>

        <ul>
            <li>
                The autocomplete features are not available to mobile screen reader users.
                I was not able to figure out how to gain access to the datalist values
                using either Talkback/Chrome on Android or VoiceOver/Safari for iOS.
            <li>
                When a user types in values, the screen reader doesn't report that
                is a suggestion list visible in some browsers (e.g. Firefox 86 with NVDA).
            </li>
            <li>
                If the user uses the up and down arrow keys, some browsers doesn't read
                these values out (e.g. older versions of Safari with VoiceOver).
            </li>
            <li>
                The autocomplete features do not appear at all in Firefox for Android (at the time of this writing, it was version 96).
    </li>
            <li>
                Because of the above reasons, it is one of the cases where ARIA works
                better.
            </li>
        </ul>

        <div id="dataset-example" class="enable-example">
            <form>
                <label id="html5-fruit__label" for="html5-fruit" class="combobox-label">
                    Enter a Fruit or Vegetable
                </label>
                <input id="html5-fruit" name="fruit" type="text" list="languages" aria-describedby="html5-fruit__desc" />
                <div class="sr-only" id="html5-fruit__desc">
                    As you type, use the up and down arrow keys to choose the autocomplete
                    items.
                </div>
                <div id="html5-fruit__statys" role="status" aria-atomic="true">
                    <!-- This is the list status live region: e.g. "4 items." -->
                </div>
                <datalist id="languages">
                    <option id="Apple" value="Apple">Apple</option>
                    <option id="Artichoke" value="Artichoke">Artichoke</option>
                    <option id="Asparagus" value="Asparagus">Asparagus</option>
                    <option id="Banana" value="Banana">Banana</option>
                    <option id="Beets" value="Beets">Beets</option>
                    <option id="Bell-pepper" value="Bell pepper">Bell pepper</option>
                    <option id="Broccoli" value="Broccoli">Broccoli</option>
                    <option id="Brussels-sprout" value="Brussels sprout">
                        Brussels sprout
                    </option>
                    <option id="Cabbage" value="Cabbage">Cabbage</option>
                    <option id="Carrot" value="Carrot">Carrot</option>
                    <option id="Cauliflower" value="Cauliflower">Cauliflower</option>
                    <option id="Celery" value="Celery">Celery</option>
                    <option id="Chard" value="Chard">Chard</option>
                    <option id="Chicory" value="Chicory">Chicory</option>
                    <option id="Corn" value="Corn">Corn</option>
                    <option id="Cucumber" value="Cucumber">Cucumber</option>
                    <option id="Daikon" value="Daikon">Daikon</option>
                    <option id="Date" value="Date">Date</option>
                    <option id="Edamame" value="Edamame">Edamame</option>
                    <option id="Eggplant" value="Eggplant">Eggplant</option>
                    <option id="Elderberry" value="Elderberry">Elderberry</option>
                    <option id="Fennel" value="Fennel">Fennel</option>
                    <option id="Fig" value="Fig">Fig</option>
                    <option id="Garlic" value="Garlic">Garlic</option>
                    <option id="Grape" value="Grape">Grape</option>
                    <option id="Honeydew-melon" value="Honeydew melon">
                        Honeydew melon
                    </option>
                    <option id="Iceberg-lettuce" value="Iceberg lettuce">
                        Iceberg lettuce
                    </option>
                    <option id="Jerusalem-artichoke" value="Jerusalem artichoke">
                        Jerusalem artichoke
                    </option>
                    <option id="Kale" value="Kale">Kale</option>
                    <option id="Kiwi" value="Kiwi">Kiwi</option>
                    <option id="Leek" value="Leek">Leek</option>
                    <option id="Lemon" value="Lemon">Lemon</option>
                    <option id="Mango" value="Mango">Mango</option>
                    <option id="Mangosteen" value="Mangosteen">Mangosteen</option>
                    <option id="Melon" value="Melon">Melon</option>
                    <option id="Mushroom" value="Mushroom">Mushroom</option>
                    <option id="Nectarine" value="Nectarine">Nectarine</option>
                    <option id="Okra" value="Okra">Okra</option>
                    <option id="Olive" value="Olive">Olive</option>
                    <option id="Onion" value="Onion">Onion</option>
                    <option id="Orange" value="Orange">Orange</option>
                    <option id="Parship" value="Parship">Parship</option>
                    <option id="Pea" value="Pea">Pea</option>
                    <option id="Pear" value="Pear">Pear</option>
                    <option id="Pineapple" value="Pineapple">Pineapple</option>
                    <option id="Potato" value="Potato">Potato</option>
                    <option id="Pumpkin" value="Pumpkin">Pumpkin</option>
                    <option id="Quince" value="Quince">Quince</option>
                    <option id="Radish" value="Radish">Radish</option>
                    <option id="Rhubarb" value="Rhubarb">Rhubarb</option>
                    <option id="Shallot" value="Shallot">Shallot</option>
                    <option id="Spinach" value="Spinach">Spinach</option>
                    <option id="Squash" value="Squash">Squash</option>
                    <option id="Strawberry" value="Strawberry">Strawberry</option>
                    <option id="Sweet-potato" value="Sweet potato">Sweet potato</option>
                    <option id="Tomato" value="Tomato">Tomato</option>
                    <option id="Turnip" value="Turnip">Turnip</option>
                    <option id="Ugli-fruit" value="Ugli fruit">Ugli fruit</option>
                    <option id="Victoria-plum" value="Victoria plum">
                        Victoria plum
                    </option>
                    <option id="Watercress" value="Watercress">Watercress</option>
                    <option id="Watermelon" value="Watermelon">Watermelon</option>
                    <option id="Yam" value="Yam">Yam</option>
                    <option id="Zucchi" value="Zucchi">Zucchi</option>
                </datalist>
            </form>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="dataset-example__steps" class="showcode__steps"></div>
                                        <div id="dataset-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="dataset-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="dataset-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="dataset-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="dataset-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="dataset-example"
                        data-showcode-props="dataset-example-props"
                        tabindex="0"
                        aria-describedby="dataset-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="dataset-example-props">
        {
            "replaceHtmlRules": {
                "datalist":  [
                    "<option id=\"Apple\" value=\"Apple\">Apple</option>",
                    "<option id=\"Artichoke\" value=\"Artichoke\">Artichoke</option>",
                    "",
                    "...",
                    ""
                ]
            },
            "steps": [
                {
                    "label": "Create label for input tag.",
                    "highlight": "for",
                    "notes": "Just like any other form element, this needs a proper label."
                },
                {
                    "label": "Give keyboard instructions using aria-describedby.",
                    "highlight": "aria-describedby",
                    "notes": "Since accessibility API support is a little sketchy right now, these instructions may help some screen reader users use this component properly."
                },
                {
                    "label": "Set up the datalist options",
                    "highlight": "%OPENCLOSECONTENTTAG%datalist",
                    "notes": "Note that the content of this is similar to the <code>select</code> tag.  It's basically a list of options."
                }
            ]
        }
        </script>


    </main>

    <script src="js/accessibility.js"></script>
    <script src="js/combobox__improved.js"></script>

    <!-- This is the submit handler for example 2a -->
    <script>
        const autocompleteSubmit = new function () {
            this.init = () => {
                document.getElementById('aria-example-2a').addEventListener('combobox-change', (e) => {
                    const { currentTarget } = e;
                    const { value } = currentTarget;
                    const q = `https://www.google.com/search?${new URLSearchParams(`q=${value}`).toString()}`
                    location.href=q;
                });
            }
            this.init();
        }
    </script>
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