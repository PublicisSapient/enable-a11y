<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA listbox role example</title>
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




    <link rel="stylesheet" type="text/css" href="css/enable-listbox.css" />

    <link rel="stylesheet" type="text/css" href="css/select-css.css" />

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
                                                <a href="zoomable-viewport-units.php" class="enable-flyout__link">
                                                    <picture>
  <source srcset="images/main-menu/zoomable-viewport-units.webp" type="image/webp">
  <img src="images/main-menu/zoomable-viewport-units.png" alt="" class="enable-flyout__link-image" />
</picture>                                                    Zoomable Viewport Units
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
                                            <li class="enable-flyout__menu-item">
                                              <a href="text-contrast.php"
                                                class="enable-flyout__link">
                                                <picture>
  <source srcset="images/main-menu/text-contrast.webp" type="image/webp">
  <img src="images/main-menu/text-contrast.png" alt="" class="enable-flyout__link-image" />
</picture>                                                Text Contrast Strategies
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
            <h2>Notes</h2>
            <ul>
                <li>tl;dr: Both versions are accessible, with slight differences in how they are reported to users.</li>

                <li>Screen reader interactions are as follows:

                    <ol>
                        <li>Tabbing into the widget:
                            <ul>
                                <li>
                                    <strong>Voiceover:</strong> The ARIA and native HTML versions state that they are
                                    "popup buttons"
                                    as well as the selected value.
                                </li>
                                <li>
                                    <strong>NVDA:</strong> The ARIA version is a "button" with "submenu", while the HTML
                                    version
                                    is a "combo box, collapsed"
                                </li>
                            </ul>
                        </li>
                    </ol>
                </li>
                <li>
                    Opening the widget:
                    <ul>
                        <li>
                            <strong>Voiceover:</strong> Reads out the selected value. The HTML version also reads how many
                            other
                            options there are (e.g. menu 26 items)
                        </li>
                        <li>
                            <strong>NVDA:</strong> Both versions reads out the amount in the list as well as the selected
                            value.
                            The ARIA version is described as a list and the HTML version is a "combo box, expanded".
                        </li>
                    </ul>
                </li>
                <li>
                    Selecting a value:
                <li>
                    <strong>Voiceover:</strong> ARIA version read out value as well as its place in the order in the list
                    (e.g.
                    Californium, text, 2 of 26). Native version just reads the just the value
                    <strong>NVDA: ARIA and HTML versions read of the value and its place in the order in the list.</strong>

                </li>
            </ul>
        </aside>

        <h1>Select Box/Listbox</h1>



        <h2>HTML5 native select element example</h2>


        <div id="html5-example" class="enable-example">
            <form>
                <fieldset>
                    <legend>Choose your favorite transuranic element (actinide or transactinide).</legend>

                    <label for="form1-element">
                        Choose an element:
                    </label>

                    <select id="form1-element" name="element">
                        <option value="Np">
                            Neptunium
                        </option>
                        <option value="Pu">
                            Plutonium
                        </option>
                        <option value="Am">
                            Americium
                        </option>
                        <option value="Cm">
                            Curium
                        </option>
                        <option value="Bk">
                            Berkelium
                        </option>
                        <option value="Cf">
                            Californium
                        </option>
                        <option value="Es">
                            Einsteinium
                        </option>
                        <option value="Fm">
                            Fermium
                        </option>
                        <option value="Md">
                            Mendelevium
                        </option>
                        <option value="No">
                            Nobelium
                        </option>
                        <option value="Lr">
                            Lawrencium
                        </option>
                        <option value="Rf">
                            Rutherfordium
                        </option>
                        <option value="Db">
                            Dubnium
                        </option>
                        <option value="Sg">
                            Seaborgium
                        </option>
                        <option value="Bh">
                            Bohrium
                        </option>
                        <option value="Hs">
                            Hassium
                        </option>
                        <option value="Mt">
                            Meitnerium
                        </option>
                        <option value="Ds">
                            Darmstadtium
                        </option>
                        <option value="Rg">
                            Roentgenium
                        </option>
                        <option value="Cn">
                            Copernicium
                        </option>
                        <option value="Nh">
                            Nihonium
                        </option>
                        <option value="Fl">
                            Flerovium
                        </option>
                        <option value="Mc">
                            Moscovium
                        </option>
                        <option value="Lv">
                            Livermorium
                        </option>
                        <option value="Ts">
                            Tennessine
                        </option>
                        <option value="Og">
                            Oganesson
                        </option>
                    </select>
                </fieldset>
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
                <form class="showcode__ui">                                        <div id="html5-example__steps" class="showcode__steps"></div>
                                        <div id="html5-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="html5-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="html5-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="html5-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="html5-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html5-example"
                        data-showcode-props="html5-example-props"
                        tabindex="0"
                        aria-describedby="html5-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="html5-example-props">
        {
            "replaceHtmlRules": {

            },
            "steps": [{
                    "label": "Mark up the component with a select tag",
                    "highlight": "%OPENCLOSETAG%select",
                    "notes": ""
                }, {
                    "label": "Mark up all the options with the option tag",
                    "highlight": "%OPENCLOSECONTENTTAG%option",
                    "notes": ""
                },
                {
                    "label": "Ensure the label is associated with the select tag",
                    "highlight": "for",
                    "notes": ""
                }
            ]
        }
        </script>

        <h2>Custom select CSS</h2>

        <p>What follows is an excellent customly styled native HTML5 select box.  It uses code from <a href="https://twitter.com/scottjehl">Scott Jehl</a>'s <a href="https://github.com/filamentgroup/select-css">cross browser CSS demo</a> that you can download via NPM.
        Instead of putting my usual notes as an explantion, visit their blog post <a href="https://www.filamentgroup.com/lab/select-css.html">Styling a Select Like It’s 2019</a>.

        <div class="enable-example">
            <label class="select-css__label" for="fave-fruit">
                Favourite fruit:
            </label>
            <select id="fave-fruit" class="select-css">
                <option value="">Choose one ...</option>
                <option>Apples</option>
                <option>Bananas</option>
                <option>Grapes</option>
                <option>Oranges</option>
            </select>
    </div>



        <h2>ARIA listbox example</h2>

        <p>
            Choose your favorite transuranic element (actinide or transactinide).
        </p>
        <div id="aria-example">
            <div class="enable-listbox listbox-area">
                <div class="left-area">
                    <span id="exp_elem" class="enable-listbox__exp_elem">
                        Choose an element:
                    </span>
                    <div id="exp_wrapper" class="enable-listbox__wrapper">
                        <button aria-haspopup="listbox" aria-expanded="false" aria-labelledby="exp_elem exp_button"
                            id="exp_button" class="enable-listbox__button">
                            Neptunium
                        </button>
                        <ul id="exp_elem_list" class="hidden" tabindex="-1" role="listbox" aria-labelledby="exp_elem">
                            <li id="exp_elem_Np" role="option">
                                Neptunium
                            </li>
                            <li id="exp_elem_Pu" role="option">
                                Plutonium
                            </li>
                            <li id="exp_elem_Am" role="option">
                                Americium
                            </li>
                            <li id="exp_elem_Cm" role="option">
                                Curium
                            </li>
                            <li id="exp_elem_Bk" role="option">
                                Berkelium
                            </li>
                            <li id="exp_elem_Cf" role="option">
                                Californium
                            </li>
                            <li id="exp_elem_Es" role="option">
                                Einsteinium
                            </li>
                            <li id="exp_elem_Fm" role="option">
                                Fermium
                            </li>
                            <li id="exp_elem_Md" role="option">
                                Mendelevium
                            </li>
                            <li id="exp_elem_No" role="option">
                                Nobelium
                            </li>
                            <li id="exp_elem_Lr" role="option">
                                Lawrencium
                            </li>
                            <li id="exp_elem_Rf" role="option">
                                Rutherfordium
                            </li>
                            <li id="exp_elem_Db" role="option">
                                Dubnium
                            </li>
                            <li id="exp_elem_Sg" role="option">
                                Seaborgium
                            </li>
                            <li id="exp_elem_Bh" role="option">
                                Bohrium
                            </li>
                            <li id="exp_elem_Hs" role="option">
                                Hassium
                            </li>
                            <li id="exp_elem_Mt" role="option">
                                Meitnerium
                            </li>
                            <li id="exp_elem_Ds" role="option">
                                Darmstadtium
                            </li>
                            <li id="exp_elem_Rg" role="option">
                                Roentgenium
                            </li>
                            <li id="exp_elem_Cn" role="option">
                                Copernicium
                            </li>
                            <li id="exp_elem_Nh" role="option">
                                Nihonium
                            </li>
                            <li id="exp_elem_Fl" role="option">
                                Flerovium
                            </li>
                            <li id="exp_elem_Mc" role="option">
                                Moscovium
                            </li>
                            <li id="exp_elem_Lv" role="option">
                                Livermorium
                            </li>
                            <li id="exp_elem_Ts" role="option">
                                Tennessine
                            </li>
                            <li id="exp_elem_Og" role="option">
                                Oganesson
                            </li>
                        </ul>
                    </div>
                </div>
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
                <form class="showcode__ui">                                        <div id="aria-example__steps" class="showcode__steps"></div>
                                        <div id="aria-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="aria-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="aria-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="aria-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="aria-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-example"
                        data-showcode-props="aria-example-props"
                        tabindex="0"
                        aria-describedby="aria-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="aria-example-props">
        {
            "replaceHtmlRules": {
                "[role=\"listbox\"]": "<!-- This is a the selected item in the dropdown --><li id=\"exp_elem_Np\" role=\"option\" aria-selected=\"true\">Neptunium</li><!-- This is an unselected item --><li id=\"exp_elem_Pu\" role=\"option\" aria-selected=\"false\">Plutonium</li>..."
            },
            "steps": [{
                    "label": "Place ARIA roles in document",
                    "highlight": "role",
                    "notes": "The <strong>option</strong> elements must be direct children of the <strong>listbox</strong> elements"
                },
                {
                    "label": "Place <strong>aria-haspopup</strong> attribute on button that activates dropdown functionality.",
                    "highlight": "aria-haspopup",
                    "notes": ""
                },
                {
                    "label": "Markup labels of listbox using aria-labelledby",
                    "highlight": "aria-labelledby ||| id=\"exp_button\"",
                    "notes": "Please ensure these ids are unique in your document.  If you have multiple dropdowns, the id from them must be unique."
                },
                {
                    "label": "When listbox is closed, hide listbox list with CSS <code>display: none</strong>.",
                    "highlight": "class=\"hidden\"",
                    "notes": "This prevents the screenreader from reading the contents of the hidden information in reading mode."
                },
                {
                    "label": "Place aria-selected attributes on options",
                    "highlight": "aria-selected",
                    "notes": "<strong>aria-selected=\"true\"</strong> for the selected option, <strong>aria-selected=\"false\"</strong> otherwise."
                },
                {
                    "label": "Place aria-expanded attribute on button element",
                    "highlight": "aria-expanded",
                    "notes": [
                        "<ul>",
                        "  <li>This is set to <strong>false</strong> when the options are hidden, <strong>true</strong> when the are visible.</li>",
                        "  <li>When expanded, focus goes to the selected element of the list. The user can change the value with the arrow keys",
                        "  <li>",
                        "    When expanded, mobile users should not be able to access elements outside of the list.  This is done by setting <strong>aria-hidden=\"true\"</strong> to all siblings, as well as the siblings of the list's parents.",
                        "    This can be done efficiently using the <strong>setMobileFocusLoop()</strong> of Enable's accessibility library.</li>",
                        "  </li>",
                        "  <li>",
                        "    When not closed, focus should go back to the button that opened it.",
                        "    Mobile users should be able to access elements outside of the list again.",
                        "    This can be done using <strong>accessibility.removeFocusLoop()</strong>",
                        "  </li>",
                        "  <li>When the keyboard focus is removed from the list, the listbox closes and <strong>aria-expanded</strong> is set to <strong>false</strong>.</li>",
                        "</ul>"
                    ]
                }

            ]
        }
        </script>


    </main>


    <script src="js/shared/enable-listbox.js"></script>
    <script src="js/accessibility.js"></script>

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