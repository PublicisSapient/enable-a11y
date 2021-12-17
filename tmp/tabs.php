<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">
    <title>Accessible Tabs Examples</title>
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





    <link class="example-stylesheet" rel="stylesheet" type="text/css" href="css/tabs.css" />
    

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

        <h1>Accessible Tabs Examples</h1>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The style of this page was stolen from <a
                        href="http://simplyaccessible.com/article/danger-aria-tabs/">Danger! ARIA tabs</a>, written by
                    <a href="http://simplyaccessible.com/article/author/jeffsmith/">Jeff Smith</a>.  However, that article
                    describes a very different method for a tab interface which is not based on ARIA at all.</li>
                <li>When keyboard users focus to the tablist, they will tab into the active tab. They can then use the arrow keys to cycle through the tabs.</li>
                <li>Only keyboard users will see keyboard instructions when they focus into the tablist. Mouse users will
                    not.</li>
                <li>Screen reader users will hear the instructions when they focus on the tabs as well.</li>
            </ul>
        </aside>




        <h2>ARIA Tab Example</h2>

        <div id="example1" class="enable-example">

            <div id="tabs">

                <!-- Instructions for keyboard users -->
                <div class="sr-only tabs__instructions" id="tabs-keyboard-only-instructions">
                    Use arrow keys to choose tabs. Content for the chosen tab will be revealed below.
                </div>
                <!-- Here are the tabs -->
                <ul 
                    class="enable-tablist"
                    data-keyboard-only-instructions="tabs-keyboard-only-instructions">
                    <li>
                        <a
                            href="#heading__jamaican-ska"
                            class="enable-tab"
                            data-owns="tabpanel__jamaican-ska"
                        >
                            Jamaican Ska
                        </a>
                    </li>
                    <li>
                        <a 
                            href="#heading__two-tone"
                            class="enable-tab"
                            data-owns="tabpanel__two-tone"
                        >
                            2 Tone
                        </a>
                    </li>
                    <li>
                        <a
                            href="#heading__third-wave"
                            class="enable-tab"
                            data-owns="tabpanel__third-wave"
                        >
                            Third Wave
                        </a>
                    </li>
                </ul>
                <div
                    class="enable-tabpanel"
                    id="tabpanel__jamaican-ska"
                >
                    <h2 tabindex="-1" id="heading__jamaican-ska">Jamaican Ska</h2>

                    <div class="tab__content">
                        <p>Ska's origins are from 1960s Jamaica. One theory about the origin of ska is that Prince
                        Buster created it during the inaugural recording session for his new record label Wild Bells.</p>

                        <p>Artists include:</p>
                        <ol>
                            <li>The Skatellites</li>
                            <li>Prince Buster</li>
                            <li>Desmond Dekker</li>
                            <li>Millie Small</li>
                            <li>Byron Lee and the Dragonaires</li>
                            <li>Laurel Aitken</li>
                            <li>The Wailers</li>
                            <li>Jimmy Cliff</li>
                            <li>Eric "Monty" Morris</li>
                        </ol>

                        <a href="https://jamaicansmusic.com/learn/origins/ska">More information about Jamaican Ska</a>
                    </div>
                </div>
                <div
                    class="enable-tabpanel"
                    id="tabpanel__two-tone"
                >
                  <h2 tabindex="-1" id="heading__two-tone">2 Tone Ska</h2>
                    <div class="tab__content">

                        <p>The 2 Tone genre, which began in the late 1970s in the Coventry area of UK, was a fusion of Jamaican ska rhythms and melodies with punk rock's more aggressive guitar chords and lyrics.[24] Compared to 1960s ska, 2 Tone music had faster tempos, fuller instrumentation, and a harder edge. The genre was named after 2 Tone Records, a record label founded by Jerry Dammers of The Specials.</p>

                        <p>Artists include:</p>
                        <ol>
                            <li>The Specials</li>
                            <li>Madness</li>
                            <li>Bad Manners</li>
                            <li>The Selector</li>
                            <li>The Beat (a.k.a. "The English Beat" in the U.S.)</li>
                            <li>The Body Snatchers</li>
                            <li>Akrylykz</li>
                        </ol>

                        <a href="https://www.theguardian.com/music/2021/apr/30/a-blur-of-legs-arms-and-adrenaline-the-astonishing-history-of-two-tone">More information about 2 Tone Ska</a>
                    </div>
                </div>
                <div
                    class="enable-tabpanel"
                    id="tabpanel__third-wave"
                >
                    <h2 tabindex="-1" id="heading__third-wave">Third Wave</h2>
                    <div class="tab__content">

                        <p>Third-wave ska originated in the punk scene in the late 1980s and became commercially successful in the 1990s. Although some third-wave ska has a traditional 1960s sound, most third-wave ska is characterized by dominating guitar riffs and large horn sections.</p>

                        <ol>
                            <li>The Toasters</li>
                            <li>Fishbone</li>
                            <li>No Doubt</li>
                            <li>The Mighty Mighty Bosstones</li>
                            <li>Streetlight Manifesto</li>
                            <li>The Hotknives</li>
                            <li>Hepcat</li>
                            <li>The Slackers</li>
                            <li>Sublime</li>
                            <li>Suicide Machines</li>
                            <li>Voodoo Glow Skulls</li>
                            <li>Reel Big Fish</li>
                            <li>Less Than Jake</li>
                            <li>Bim Skala Bim</li>
                        </ol>

                        <a href="https://en.wikipedia.org/wiki/Ska#Third_wave_ska">More information about Third Wave Ska</a>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            const originalHTMLExample1 = document.getElementById('example1').innerHTML;
        </script>       

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
        </div>
        <script type="application/json" id="example1-props">
        {
            "replaceHtmlRules": {
                ".tab__content": "<!-- insert tab panel content here -->",
                "[role=\"tab\"]": "<!-- insert tab label here -->"
            },
            "steps": [
                {
                    "label": "Create basic DOM for users without JavaScript",
                    "highlight": "%JSHTML%originalHTMLExample1~href",
                    "notes": "This is a basic list of links that answer to the headings of what will be the tabpanels when the Javascript is executed.  Users who don't load the JavaScript (because of a network error or because they elected not to load it) will get this usable HTML.  Note that these links will "
                },
                {
                    "label": "Ensure classes are set up so roles will be assigned for JavaScript users",
                    "highlight": "%JSHTML%originalHTMLExample1~class=\"enable-tablist\" ||| class=\"enable-tab\" ||| class=\"enable-tabpanel\"",
                    "notes": "This is a basic list of links that answer to the headings of what will be the tabpanels when the Javascript is executed.  Users who don't load the JavaScript (because of a network error or because they elected not to load it) will get this usable HTML.  Note that these links will "
                },
                {
                    "label": "Use data-owns to connect tabs with their tabpanel",
                    "highlight": "%JSHTML%originalHTMLExample1~data-owns",
                    "notes": "This will be used by the JavaScript code to connect the tab with the tabpanel using aria-owns"
                },
                {
                    "label": "Your JavaScript should place ARIA roles in document",
                    "highlight": "role=\"tablist\" ||| role=\"presentation\" ||| role=\"tab\" ||| role=\"tabpanel\"",
                    "notes": "JavaScript should assign these roles to non-JavaScript users that user screen readers don't get these roles.  Note that <strong>tabs</strong> should be a direct child of the <strong>tablist</strong>. If this is not possible, then all the nodes in between them should have a role of <strong>presentation</strong>."
                },
                {
                    "label": "Your JavaScript should connect tabs to tabpanels",
                    "highlight": "aria-owns",
                    "notes": "Each <strong>tab</strong> must have an <strong>aria-owns</strong> attribute that corresponds to its <strong>tabpanel</strong>."
                },
                {
                    "label": "Your JavaScript should apply aria-selected values are set correctly",
                    "highlight": "aria-selected",
                    "notes": "When a tab is selected, its <strong>aria-selected</strong> attribute must be set to <strong>true</strong>, while all the other tabs must have it set to <strong>false</strong>"
                },
                {
                    "label": "Your JavaScript should ensure only the selected tab is accessible via tab key",
                    "highlight": "tabindex=\"-1\"",
                    "notes": "In order switch tabs with the arrow keys, all tabs that have <strong>aria-selected=\"false\"</strong> must also have <strong>tabindex=\"-1\"</strong> set as well."
                },
                {
                    "label": "Your JavaScript should use aria-describedby to give keyboard instructions when user focuses on tabs",
                    "highlight": "aria-describedby",
                    "notes": "This gives screen reader users instructions how to use the tabs when they navigate into them via keyboard"
                },
                {
                    "label": "Set up JavaScript that activates the tabs when they have keyboard focus",
                    "highlight": "%JS% tabgroup",
                    "notes": ""
                }
            ]
        }
        </script>



        
    </main>

    <div id="scripts">
        <script src="js/accessibility.js"></script>
        <script src="js/tabs.js"></script>
    </div>

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