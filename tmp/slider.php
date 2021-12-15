<!DOCTYPE html>
<html lang="en">

<head>
    <title>ARIA Slider Examples</title>
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




    <link id="enable-slider-style" rel="stylesheet" type="text/css" href="css/slider.css" />

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
        <h1>ARIA Slider Examples</h1>


        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The ARIA example is based off of code from Open Ajax Alliance's <a
                        href="https://web.archive.org/web/20170715191225/http://oaa-accessibility.org/example/32/">Slider
                        Example</a> (link goes to a Way Back Machine link, since the original site is long gone). It was
                    heavily modified
                    by the Enable project to be accessible, for both desktop and mobile users.</li>
                <li>Since both of the method changing the native <code>&lt;input type="range"&gt;</code> slider values
                    cannot be implemented via JS for both Voiceover and Talkback, an alternative UI was made using
                    <a href="38-visible-on-focus.php">visible on focus</a> components. <strong>This alternative UI is
                        only visible when using a mobile screen reader.</strong>
                </li>
            </ul>
        </aside>

        <h2>A Simple HTML5 Slider (i.e. an <code>input</code> with <code>type="range"</code>)</h2>

        <p>
            <strong>This is by the preferred method of implementing a slider.</strong>
            It "just works" with a keyboard and/or screen reader on all devices (The
            First Rule of ARIA applies). Note that the UI for mobile screen reader users is very different
            between the two major operating systems:
        </p>

        <ul>
            <li>Under iOS/Voiceover: when the slider is focused, users must do a small swipe up and down to
                increase and decrease the slider values.</li>
            <li>Under Android/Talkback: when the slider is focused, users must use the device's
                <strong>volume keys</strong> to manipulate the slider.
            </li>
        </ul>

        <p>
            In the notes below, we do basic information cover how to style HTML5 Sliders, but note that
            we do gloss over some minor cross-browser styling issues. More information on making them
            look super pretty can be found here:
        </p>

        <ul>
            <li><a href="https://www.cssportal.com/style-input-range/">Style Input Range</a> on-line generator tool can
                get you up and running quickly.</li>
            <li><a href="https://css-tricks.com/sliding-nightmare-understanding-range-input/">A Sliding Nightmare:
                    Understanding the Range Input</a>
                by <a href="https://twitter.com/anatudor?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">Ana
                    Tudor</a> is probably the most
                complete deep-dive I have seen on how to style HTML5 sliders (the old Microsoft Edge code is something
                we didn't implement here, since
                Microsoft Edge now relies on the same rendering engine Google Chrome uses). Recommended if you are
                trying to work out the cross-browser quirks between the two implementations.</li>
        </ul>


        <div id="html-example" class="enable-example">
            <form oninput="this.elements.myOutput.innerHTML = parseFloat(this.elements.donationAmount.value);">
                <label for="horizontal-slider" class="html-slider__label enable-slider__label">Amount you want
                    to donate to the Zoltan Hawryluk Developer Fund: </label>
                <div>
                    <div class="html-slider__container">
                        <input type="range" id="horizontal-slider" name="donationAmount" value="500" min="0" max="1000"
                            step="50" />
                    </div>
                    <output class="html-slider__output" name="myOutput" role="presentation">500</output>
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
                <form class="showcode__ui">                                        <div id="html-example__steps" class="showcode__steps"></div>
                                        <div id="html-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="html-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="html-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="html-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="html-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html-example"
                        data-showcode-props="html-example-props"
                        tabindex="0"
                        aria-describedby="html-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="html-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Use an input of type range",
                    "highlight": "type=\"range\"",
                    "notes": "This can receive keyboard focus for free, since its a form element.  No JS required."
                },
                {
                    "label": "Add the min, max, step, and default value of the slider",
                    "highlight": "min ||| max ||| value=\"500\" ||| step",
                    "notes": "The min, max and current values are represented by the <strong>min</strong>, <strong>max</strong> and <strong>now</strong> attributes, respectively"
                },
                {
                    "label": "Set the slider's label",
                    "highlight": "for",
                    "notes": "Just like any inteactive component, it needs a label"
                },
                {
                    "label": "Set an oninput event to display current value.",
                    "highlight": "oninput=\"[^\"]*\" ||| id=\"myOutput\"",
                    "notes": "This is so sighted users can see the value of the slider."
                },
                {
                    "label": "Set the output tag's role to presentation",
                    "highlight": "role=\"presentation\"",
                    "notes": "Since this is the value of the range element and it is already announced when screen reader users inteact with it, setting the <strong>output</strong> tag's role of <strong>presentation</strong> will prevent this value from being announced twice.  (the <strong>output</strong> tag is, my default, an ARIA live region).  "
                },
                {
                    "label": "Style the slider's track",
                    "highlight": "%CSS% enable-slider-style~ input[type=\"range\"]::-webkit-slider-runnable-track ||| %CSS% enable-slider-style~ input[type=\"range\"]::-moz-range-track ",
                    "notes": "Note that there are two selectors that have the same CSS properties (you may see certain syntax differences in WebKit and Blink based browsers due to the way it parses CSS for the <code>-webkit-*</code> based code).  The first is for WebKit and Blink based browsers (i.e. Chrome, Safari, Opera, Edge), while the second is for Firefox.  <a href=\"https://stackoverflow.com/questions/16982449/why-isnt-it-possible-to-combine-vendor-specific-pseudo-elements-classes-into-on\">We cannot merge these two CSS rules into one, due to the way CSS works."
                },
                {
                    "label": "Style the slider's control",
                    "highlight": "%CSS% enable-slider-style~ input[type=\"range\"]::-webkit-slider-thumb ||| %CSS% enable-slider-style~ input[type=\"range\"]::-moz-range-thumb",
                    "notes": "Again, different selectors for WebKit and Blink based browsers vs. Firefox"
                },
                {
                    "label": "Style specfic browser implementations",
                    "highlight": "%CSS% enable-slider-style~ @supports selector(input[type=\"range\"]::-moz-range-thumb)",
                    "notes": "There are certain layout differences between Firefox and Blink/WebKit based browsers.  To work around this, I have used a <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/@supports#selector\">@supports selector()</a> to give specific styles to the Firefox implementation.  This is supported by all browsers except Safari right now, so it is best to target Firefox when adding differing styles."

                }
            ]
        }
        </script>

        <h2>An HTML5 Slider With Min and Max Values</h2>

        <div id="html-multi-example" class="enable-example">
            <form class="html-slider__multi--form" oninput="" autocomplete="off">
                <fieldset>
                    <legend class="enable-slider__label">
                        Amount you are willing to bid on an Atari 2600
                    </legend>
                    <div>
                        <div role="group" class="html-slider__container html-slider__multi--container"
                            style="--a: 200; --b: 800; --min: 0; --max: 1000">

                            <label class="sr-only" for="a">
                                Amount A
                            </label>
                            <input id="a" type="range" name="multiSlider1" value="200" min="0" max="1000" step="50" />
                            <output class="html-slider__multi--output" id="output_a" for="a" role="presentation"
                                style="--val: var(--a)">
                                $200
                            </output>

                            <label class="sr-only" for="b">
                                Amount B
                            </label>
                            <input id="b" type="range" name="multiSlider2" value="800" min="0" max="1000" step="50" />
                            <output class="html-slider__multi--output" id="output_b" for="b" role="presentation"
                                style="--val: var(--b)">
                                $800
                            </output>
                        </div>
                    </div>
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
                <form class="showcode__ui">                                        <div id="html-multi-example__steps" class="showcode__steps"></div>
                                        <div id="html-multi-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="html-multi-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="html-multi-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="html-multi-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="html-multi-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="html-multi-example"
                        data-showcode-props="html-multi-example-props"
                        tabindex="0"
                        aria-describedby="html-multi-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="html-multi-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Use two range inputs",
                    "highlight": "%OPENTAG%input",
                    "notes": "These will be stacked on top of each other via CSS."
                },
                {
                    "label": "Add the min, max, step, and default value of the slider",
                    "highlight": "min=\"0\" ||| max=\"1000\" ||| value ||| step",
                    "notes": "The min, max and current values are represented by the <strong>min</strong>, <strong>max</strong> and <strong>now</strong> attributes, respectively"
                },
                {
                    "label": "Set CSS variables up that match the min, max of the sliders",
                    "highlight": "min=\"0\" ||| max=\"1000\" |||  --min: 0 ||| --max: 1000 ",
                    "notes": ""
                },
                {
                    "label": "Set CSS variables that match the slider values",
                    "highlight": "value=\"200\" ||| value=\"800\" ||| --a: 200 ||| --b: 800 ",
                    "notes": ""
                },
                {
                    "label": "Wrap the sliders inside a fieldset with a legend",
                    "highlight": "%OPENCLOSETAG%fieldset ||| %OPENCLOSECONTENTTAG%legend",
                    "notes": "This acts as a label to all the sliders in the group.  Screen reader users will be told what the purpose of all the sliders in this section are for \"choosing the amount they are willing to bid on an Atari 2600\""
                },

                {
                    "label": "Link each slider with its label and output tag using the for attribute",
                    "highlight": "for",
                    "notes": "Labels for each individual slider. Note that Amount A can be smaller or larger than B, so we can't call any of the slider elements \"the minimum\" or \"the maximum\" value here."
                },
                {
                    "label": "Set the form's autocomplete attribute to off",
                    "highlight": "autocomplete=\"off\"",
                    "notes": "We do this to ensure onload, the values are reset to the default values we set in the two previous steps.  If we didn't do this, <a href=\"https://stackoverflow.com/questions/2486474/preventing-firefox-from-remembering-the-input-value-on-refresh-with-a-meta-tag\">Firefox will remember the values of the sliders when refreshing the page</a>, no matter what the <code>value</code> attributes from the previous step are set to.  "
                },
                {
                    "label": "Set the output tag's role to presentation",
                    "highlight": "role=\"presentation\"",
                    "notes": "Since this is the value of the range element and it is already announced when screen reader users inteact with it, setting the <strong>output</strong> tag's role of <strong>presentation</strong> will prevent this value from being announced twice.  (the <strong>output</strong> tag is, my default, an ARIA live region).  "
                },
                {
                    "label": "Style the slider's control",
                    "highlight": "%CSS% enable-slider-style~ input[type=\"range\"]::-webkit-slider-thumb ||| %CSS% enable-slider-style~ input[type=\"range\"]::-moz-range-thumb",
                    "notes": "This is the same as in the previous example."
                },
                {
                    "label": "Hide the tracks of both sliders",
                    "highlight": "%CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"]::-webkit-slider-runnable-track ||| visibility: hidden ||| %CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"]::-moz-range-track ||| visibility: hidden",
                    "notes": ""
                },
                {
                    "label": "Set pointer-events CSS properties on the slider and the slider thumb",
                    "highlight": "%CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"] ||| pointer-events: none; ||| %CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"]::-webkit-slider-thumb ||| pointer-events: auto; ||| %CSS% enable-slider-style~ .html-slider__multi--container input[type=\"range\"]::-moz-range-thumb ||| pointer-events: auto; ",
                    "notes": "The <code>pointer-events: none</code> on each of the slider tracks will ensure mouse clicks go through the hidden track.  The <code>pointer-events: auto</code> ensures that pointer events can be captured by the slider control."
                },
                {
                    "label": "Replace the tracks of both of the sliders with the container's ::before pseudo-element.",
                    "highlight": "%CSS% enable-slider-style~ .html-slider__multi--container::before",
                    "notes": "We use a lot of the same styles that we used to style the real track in the first example."
                },
                {
                    "label": "Ensure each of the output elements display their respective slider values.",
                    "highlight": "%JS% rangeInputEvent.init ||| [\\S]*\\.innerHTML[^;]*;",
                    "notes": "These values will be used the CSS code shown in the next step."
                },
                {
                    "label": "Ensure CSS variables containing the slider values are set when the sliders are used.",
                    "highlight": "%JS% rangeInputEvent.init ||| [\\S]*.setProperty[^;]*;",
                    "notes": "These values will be used the CSS code shown in the next step."
                },
                {
                    "label": "Style area on track between the two slider controls using the container's ::after pseudo-element",
                    "highlight": "%CSS% enable-slider-style~ .html-slider__multi--container { ||| --minValue ||| --maxValue ||| --dif ||| %CSS% enable-slider-style~ .html-slider__multi--container::after { ||| --minValue ||| --maxValue ||| --dif ||| --a ||| --b",
                    "notes": "This CSS ensures that the container's <code>::after</code> pseudo-element acts as the area of the track that is in between the two slider controls.  For a detailed explanation as to why, see <a href=\"https://css-tricks.com/multi-thumb-sliders-particular-two-thumb-case/#the-tricky-part\">The Tricky Part</a> of Ana Tudor's article <a href=\"https://css-tricks.com/multi-thumb-sliders-particular-two-thumb-case/\">Multi-Thumb Sliders: Particular Two-Thumb Case</a>."
                },
                {
                    "label": "Style specfic browser implementations",
                    "highlight": "%CSS% enable-slider-style~ @supports selector(input[type=\"range\"]::-moz-range-thumb)",
                    "notes": "There are small layout differences between Firefox and Blink/WebKit based browsers.  To work around this, I have used a <a href=\"https://developer.mozilla.org/en-US/docs/Web/CSS/@supports#selector\">@supports selector()</a> to give specific styles to the Firefox implementation.  This is supported by all browsers except Safari right now, so it is best to target Firefox when adding differing styles."

                }
            ]
        }
        </script>

        <h2>ARIA Sliders</h2>


        <h3>A note on all ARIA sliders on this page:</h3>

        <p>
            Note that all the ARIA sliders use the <code>&lt;template&gt;</code> tag that the
            JavaScript library will use to create the DOM elements:
        </p>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="template-code__steps" class="showcode__steps"></div>
                                        <div id="template-code__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="template-code__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="template-code__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="template-code__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="template-code__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="template-code"
                        data-showcode-props="template-code-props"
                        tabindex="0"
                        aria-describedby="template-code__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="template-code-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Insert dynamic values placeholders in the template",
                    "highlight": "\\$\\{[^}]+\\}",
                    "notes": "These are the dymamic parts of the template. These values will be populated by the JavaScript.  Note the format is similar to that of <a href=\"https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals\">JavaScript template strings</a>"
                },
                {
                    "label": "Create an interpolation function",
                    "highlight": "%JS% interpolate",
                    "notes": "This code will make a regular Javascript string act like a template string.  It is used in the next step."
                },
                {
                    "label": "Insert dymanic values into the template using the interpolation function.",
                    "highlight": "%JS% enableSliders.list[0].createHandle ||| const handle =[^;]*;",
                    "notes": "This takes the <code>innerHTML</code> of the template element and runs it through the interpolation function of the last step.   The result is then injected into the DOM of page."
                }
            ]
        }
        </script>

        <h3>A Simple ARIA Slider</h3>

        <div id="aria-example1" class="enable-example">
            <div id="sr1_label" class="enable-slider__label">JPEG compression factor:</div>

            <div class="enable-slider enable-slider--horizontal" id="sr1" data-min="0" data-max="100" data-inc="5"
                data-jump="10" data-show-vals="true" data-range="false" data-val1="30">
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
                <form class="showcode__ui">                                        <div id="aria-example1__steps" class="showcode__steps"></div>
                                        <div id="aria-example1__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="aria-example1__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="aria-example1__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="aria-example1__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="aria-example1__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-example1"
                        data-showcode-props="aria-example1-props"
                        tabindex="0"
                        aria-describedby="aria-example1__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="aria-example1-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Place ARIA slider roles in document",
                    "highlight": "role=\"slider\"",
                    "notes": "We used a <strong>button</strong> tag to ensure it gets keyboard focus for free.  If you use a <strong>div</strong>, you would need to add a <strong>tabindex=\"0\"</strong> and some JS routines to ensure it worked correctly.  It's definitely worth using a <strong>button</strong> instead."
                },
                {
                    "label": "Add the min, max and current values that the slider can be set to, as well as the current value",
                    "highlight": "aria-valuemin ||| aria-valuemax ||| aria-valuenow",
                    "notes": "The min, max and current values are represented by the <strong>aria-valuemin</strong>, <strong>aria-valuemax</strong> and <strong>aria-valuenow</strong> attributes, respectively"
                },
                {
                    "label": "Set the slider's label",
                    "highlight": "aria-labelledby=\"sr1_label sr1_handle_val\" ||| id=\"sr1_label\" ||| id=\"sr1_handle_val\"",
                    "notes": "The label is the visual label of slider along with its visual value.  The value is needed since some screen readers report the value as a percentage, as opposed to the actual numeric value visible on the component."
                },
                {
                    "label": "Set the slider instructions",
                    "highlight": "aria-describedby=\"sr1_desc\" ||| id=\"sr1_desc\"",
                    "notes": "Note that the instructions are not just for keyboard users, but also for those who use mobile screen readers."
                },
                {
                    "label": "Surround the visual numeric value of the slider with an aria-live region",
                    "highlight": "role=\"alert\" ||| aria-live=\"assertive\"",
                    "notes": ""
                },
                {
                    "label": "Create alternative UI for mobile screen readers",
                    "highlight": "%OPENCLOSECONTENTTAG%span",
                    "notes": "Since the slider elements can be only change values when swiping them, mobile screen reader users will not be able to manipulate them, since swiping is (roughly) equivalent to tabbing through the elements on the page (the difference being it an theoretically go all the elements on the page, not just the interactive ones).  To work around this limitation, we create an alternative UI with elements that are only visible when the button inside gains focus.  Because the button has <strong>tabindex=\"-1\"</strong>, mobile screen readers are the only devices that can make them visible."
                },
                {
                    "label": "Ensure the mobile screen reader UI buttons only appear for mobile screen reader users.",
                    "highlight": "tabindex=\"-1\"",
                    "notes": "See previous step for details."
                },
                {
                    "label": "Create labels for mobile screen reader UI buttons",
                    "highlight": "aria-labelledby=\"sr1_label sr1_handle_val sr1_handle__decrease-label\" ||| id=\"sr1_label\" ||| id=\"sr1_handle_val\" ||| id=\"sr1_handle__decrease-label\" ||| aria-labelledby=\"sr1_label sr1_handle_val sr1_handle__increase-label\" ||| id=\"sr1_handle__increase-label\"",
                    "notes": "The \"decrementor\" will have a label of \"JPEG compression factor: 30, decrease value\". The \"incrementor\" will have a similar label, except for the \"increase value\" at the end."
                }
            ]
        }
        </script>




        <h2>An ARIA Slider With Min and Max Values</h2>


        <div id="aria-example2" class="enable-example">
            <div id="sr2_global_label" class="enable-slider__label">Approximately how much money would you be willing to
                invest in your RRSPs in the next
                years</div>

            <div id="sr2_label1" class="enable-slider__hidden-label">Minimum investment amount</div>
            <div id="sr2_label2" class="enable-slider__hidden-label">Maximum investment amount</div>
            <div class="enable-slider enable-slider--horizontal" id="sr2" data-min="1900" data-max="2008" data-inc="1"
                data-jump="10" data-show-vals="true" data-range="true" data-val1="1950" data-val2="2000">
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
                <form class="showcode__ui">                                        <div id="aria-example2__steps" class="showcode__steps"></div>
                                        <div id="aria-example2__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="aria-example2__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="aria-example2__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="aria-example2__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="aria-example2__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="aria-example2"
                        data-showcode-props="aria-example2-props"
                        tabindex="0"
                        aria-describedby="aria-example2__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="aria-example2-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Place ARIA slider roles in document",
                    "highlight": "role=\"slider\"",
                    "notes": "Note, unlike the previous example, there are two of these now."
                },
                {
                    "label": "Add the min, max and current values that the slider can be set to, as well as the current value",
                    "highlight": "aria-valuemin ||| aria-valuemax ||| aria-valuenow",
                    "notes": "The min, max and current values are represented by the <strong>aria-valuemin</strong>, <strong>aria-valuemax</strong> and <strong>aria-valuenow</strong> attributes, respectively"
                },
                {
                    "label": "Set the labels for both slider handles",
                    "highlight": "aria-labelledby=\"sr[0-9]_label[0-9] sr[0-9]_handle[0-9]_val\" ||| id=\"sr[0-9]_label[0-9]\" ||| id=\"sr[0-9]_handle[0-9]_val\"",
                    "notes": "The label is the visual label of slider along with its visual value.  The value is needed since some screen readers report the value as a percentage, as opposed to the actual numeric value visible on the component."
                },
                {
                    "label": "Set the instructions for both sliders",
                    "highlight": "aria-describedby=\"sr[0-9]_desc[0-9]\" ||| id=\"sr[0-9]_desc[0-9]\"",
                    "notes": "Note that the instructions are not just for keyboard users, but also for those who use mobile screen readers."
                },
                {
                    "label": "Surround the visual numeric value of the slider with an aria-live region",
                    "highlight": "role=\"alert\" ||| aria-live=\"assertive\"",
                    "notes": ""
                },
                {
                    "label": "Create alternative UI for mobile screen readers",
                    "highlight": "%OPENCLOSECONTENTTAG%span",
                    "notes": "Since the slider elements can be only change values when swiping them, mobile screen reader users will not be able to manipulate them, since swiping is (roughly) equivalent to tabbing through the elements on the page (the difference being it an theoretically go all the elements on the page, not just the interactive ones).  To work around this limitation, we create an alternative UI with elements that are only visible when the button inside gains focus.  Because the button has <strong>tabindex=\"-1\"</strong>, mobile screen readers are the only devices that can make them visible."
                },
                {
                    "label": "Ensure the mobile screen reader UI buttons only appear for mobile screen reader users.",
                    "highlight": "tabindex=\"-1\"",
                    "notes": "See previous step for details."
                },
                {
                    "label": "Create labels for mobile screen reader UI buttons",
                    "highlight": "aria-labelledby=\"sr[0-9]_label[0-9] sr[0-9]_handle[0-9]_val sr[0-9]_handle[0-9]__decrease-label\" ||| id=\"sr[0-9]_label[0-9]\" ||| id=\"sr[0-9]_handle[0-9]_val\" ||| id=\"sr[0-9]_handle[0-9]__decrease-label\" ||| aria-labelledby=\"sr[0-9]_label sr[0-9]_handle[0-9]_val sr[0-9]_handle[0-9]__increase-label\" ||| id=\"sr[0-9]_handle[0-9]__increase-label\"",
                    "notes": "The \"decrementor\" will have a label of \"JPEG compression factor: 30, decrease value\". The \"incrementor\" will have a similar label, except for the \"increase value\" at the end."
                }
            ]
        }
        </script>


        <h2>A Vertical ARIA Slider</h2>

        <div id="vertical-example" class="enable-example">
            <div id="sr3_global_label" class="enable-slider__label">Approximately how much money would you be willing to
                invest in your RRSPs in the next
                years</div>

            <div id="sr3_label1" class="enable-slider__hidden-label">Minimum investment amount</div>
            <div id="sr3_label2" class="enable-slider__hidden-label">Maximum investment amount </div>
            <div class="enable-slider enable-slider--vertical" id="sr3" data-min="1900" data-max="2008" data-inc="1"
                data-jump="10" data-show-vals="true" data-range="true" data-val1="1950" data-val2="2008">
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
                <form class="showcode__ui">                                        <div id="vertical-example__steps" class="showcode__steps"></div>
                                        <div id="vertical-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="vertical-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="vertical-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="vertical-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="vertical-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="vertical-example"
                        data-showcode-props="vertical-example-props"
                        tabindex="0"
                        aria-describedby="vertical-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="vertical-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [
                {
                    "label": "Insert class in root element to make this slider vertical",
                    "highlight": "enable-slider--vertical",
                    "notes": "All the other steps are the same as the previous example."
                }
            ]
        }
        </script>


    </main>

    <div id="template-code">
        <template id="enable-slider__handle--template">
            <div>
                <div id="${id}" class="${classNameRoot}__handle">
                    <div role="slider" tabindex="0" class="${classNameRoot}__handle-button" aria-valuemin="${valuemin}"
                        aria-valuemax="${valuemax}" aria-valuenow="${valuenow}"
                        aria-labelledby="${arialabelledby} ${id}_val" aria-describedby="${ariadescribedby}"></div>

                    <div id="${ariadescribedby}" class="${classNameRoot}__hidden-label">
                        Use arrow keys to adjust the slider value. Touch devices will need to swipe right to access controls to adjust
                        the slider value.
                    </div>
                    <span
                        class="enable-mobile-visible-on-focus__container ${classNameRoot}__button-container ${classNameRoot}__button-container--decrease">
                        <div id="${id}__decrease-label" class="${classNameRoot}__hidden-label">Decrease Value</div>
                        <button aria-labelledby="${arialabelledby} ${id}_val ${id}__decrease-label"
                            class="enable-mobile-visible-on-focus ${classNameRoot}__decrease ${classNameRoot}__button"
                            tabindex="-1">
                            ‹
                        </button>
                    </span>
                    <span
                        class="enable-mobile-visible-on-focus__container ${classNameRoot}__button-container ${classNameRoot}__button-container--increase">
                        <div id="${id}__increase-label" class="${classNameRoot}__hidden-label">Increase Value</div>
                        <button aria-labelledby="${arialabelledby} ${id}_val ${id}__increase-label"
                            class="enable-mobile-visible-on-focus ${classNameRoot}__increase ${classNameRoot}__button"
                            tabindex="-1">
                            ›
                        </button>
                    </span>
                </div>
                <div id="${id}_val" class="${classNameRoot}__value" role="alert" aria-live="assertive">
                    ${valuenow}
                </div>
            </div>
        </template>
    </div>


    <script>
    var rangeInputEvent = new function() {
        this.init = () => {
            document.addEventListener('input', e => {
                const {
                    target
                } = e;
                const {
                    form,
                    parentNode
                } = target
                const {
                    type,
                    nodeName
                } = target;
                const isMultiContainer = parentNode.classList.contains('html-slider__multi--container');

                if (isMultiContainer && nodeName === 'INPUT' && type === 'range') {
                    const {
                        elements
                    } = form;

                    // This sets the variables for --a amd --b to their
                    // respective slider's value
                    parentNode.style.setProperty('--a', elements.a.value);
                    parentNode.style.setProperty('--b', elements.b.value);

                    // This sets each of the output elements innerHTML to display
                    // the slider value (prefixed with a dollar sign).
                    elements.output_a.innerHTML = `$${elements.a.value}`;
                    elements.output_b.innerHTML = `$${elements.b.value}`;
                }
            }, false);
        }
    }

    rangeInputEvent.init();
    </script>

    <script src="js/shared/interpolate.js"></script>
    <script src="js/accessibility.js"></script>
    <script src="js/enable-slider.js"></script>
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

    <script src="js/shared/enable-visible-on-focus.js"></script></body>

</html>