<!DOCTYPE html>
<html lang="en">

<head>
    <title>Play and Pause CSS, Canvas SVG SMIL and GIF animations with Javascript</title>
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




    <link id="pause-anim-css" rel="stylesheet" type="text/css" href="css/pause-animations-demo.css" />

    <!-- for the elastic collision demo -->
    <style>
    #elastic-collision-demo__canvas {
        width: 100%;
        height: 400px;
        background: #000;
    }
    </style>
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
    <div class="play-pause-anim__checkbox-container" id="checkbox-container">
        <label for="play-pause-animation-button">
            Pause animations
            <input type="checkbox" id="play-pause-animation-button"
                class="play-pause-animation-button__checkbox" />
        </label>

    </div>
   
    <main class="with-full-bleed-hero">
        <div id="css-anim-example">
            <div class="play-pause-anim__full-bleed-image-demo">
                
                <picture>
                    <source
                        srcset="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320.jxr 320w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-600.jxr 600w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-640.jxr 640w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1024.jxr 1024w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1200.jxr 1200w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-2016.jxr 2016w"
                        type="image/vnd.ms-photo">
                    <source
                        srcset="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320.jp2 320w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-600.jp2 600w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-640.jp2 640w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1024.jp2 1024w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1200.jp2 1200w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-2016.jp2 2016w"
                        type="image/jp2">
                    <source
                        srcset="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320.webp 320w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-600.webp 600w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-640.webp 640w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1024.webp 1024w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1200.webp 1200w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-2016.webp 2016w"
                        type="image/webp">
                    <img class="play-pause-anim__full-bleed-image-demo--image"
                        alt="The planet saturn in front of an animated starfield"
                        src="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320-quant.png"
                        srcset="https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-320-quant.png 320w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-600-quant.png 600w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-640-quant.png 640w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1024-quant.png 1024w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-1200-quant.png 1200w, https://www.useragentman.com/tests/html5ImageConverter/examples/saturn-alpha/saturn-2016-quant.png 2016w" />
                </picture>
            </div> 
        </div>
        <div class="with-full-bleed-hero__content">
            <h1>Pausing animations</h1>
            <p>
                Pause all the CSS, Canvas, SVG SMIL and GIF
                animations on this page with the checkbox at the top of this page.
                The CSS, Canvas and SVG SMIL animations don't know
                anything about the checkbox. The GIF animations only require
                a small amount of set up to work.
            </p>

            <p>
                (Note: if you have set your operating system to Reduce Motion,
                it will be checked by default)
            </p>

            <h2>Quick Start guide</h2>

            <p>
                Just <a href="js/play-pause-animations-button.js">download the script</a> and include it at the end of the
                <code>body</code>:
            </p>

                    <div class="showcode__container">
                        <div class="showcode">
                                                        <div id="document__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="document__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="document__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="document__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="document__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                    
                <pre class="showcode__example"><code
                        data-showcode-id="document"
                        data-showcode-props="document-props"
                        tabindex="0"
                        aria-describedby="document__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>            <script type="application/json" id="document-props">
            {
                "replaceHtmlRules": {
                    "head": "<!-- head content -->",
                    "body": "...<script src=\"js/play-pause-animations-button.js\"><\/script>"
                },
                "steps": [{
                    "label": "",
                    "highlight": "src=\"js/play-pause-animations-button.js\"",
                    "notes": ""
                }]
            }
            </script>


            <p>After that, just include it in the bottom of your page.
                The control to pause the animations must be structured the following way:
            </p>

                    <div class="showcode__container">
                        <div class="showcode">
                                                        <div id="checkbox-container__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="checkbox-container__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="checkbox-container__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="checkbox-container__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="checkbox-container__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                    
                <pre class="showcode__example"><code
                        data-showcode-id="checkbox-container"
                        data-showcode-props="checkbox-container-props"
                        tabindex="0"
                        aria-describedby="checkbox-container__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>            <script type="application/json" id="checkbox-container-props">
            {
                "replaceHtmlRules": {},
                "steps": [{
                    "label": "",
                    "highlight": "for",
                    "notes": ""
                }]
            }
            </script>

            <p>For animated GIFs or WEBP, you will have to structure your HTML a certain way
                (see the <a href="#animated-gif">animated GIF example below</a> for details).</p>

            <h2>How Does It Work</h2>

            <p>The TL;DR:</p>

            <ul>
                <li>When the page loads, the script checks to see what the OS setting for animations (via the <a
                        href="">prefers-reduced-motion media query</a>).
                <li>If <code>prefers-reduced-motion</code> media-query is set to "reduce", the script turns off the
                    animations and checks the checkbox by default.
                <li>If the checkmark is checked, the class <code>play-pause-animation-button__prefers-reduced-motion</code>
                    is set on the <code>body</code> tag. Otherwise, the <code>body</code> tag has the
                    <code>play-pause-animation-button__prefers-motion</code> class set. These classes are used to pause and
                    play CSS and GIF/WEBP animations.
                </li>
                <li>The script does some extra magic to turn off the other animations (see below).</li>
            </ul>

            <h2>Code walkthroughs</h2>

            <p>This section will show how the script stops the different type of animations.</p>

            <h3>CSS Animations</h3>

            <p>
                The animation of Saturn from <a
                    href="https://www.useragentman.com/blog/2015/01/14/using-webp-jpeg2000-jpegxr-apng-now-with-picturefill-and-modernizr/">one
                    of my previous blog posts</a> that appears above is animated via CSS.
            </p>




                    <div class="showcode__container">
                        <h4 class="showcode__heading">Example code explanation</h4>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="css-anim-example__steps" class="showcode__steps"></div>
                                        <div id="css-anim-example__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="css-anim-example__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="css-anim-example__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="css-anim-example__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="css-anim-example__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="css-anim-example"
                        data-showcode-props="css-anim-example-props"
                        tabindex="0"
                        aria-describedby="css-anim-example__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>            <script type="application/json" id="css-anim-example-props">
            {
                "replaceHtmlRules": {
                    "picture": "<!-- code for image of saturn -->"
                },
                "steps": [{
                        "label": "Set up CSS animation",
                        "highlight": "%CSS% pause-anim-css ~ .play-pause-anim__full-bleed-image-demo--image ||| animation[^;]*; ||| background-position[^;]*; ||| %CSS% pause-anim-css ~ @keyframes animatedBackground ||| animatedBackground ||| background-position[^;]*;",
                        "notes": "Standard CSS code to start the CSS animation of the stars in the background of the hero image."
                    },
                    {
                        "label": "Add CSS that will stop all CSS animations",
                        "highlight": "%CSS% pause-anim-css ~ @media (prefers-reduced-motion: reduce) ||| [ ]*animation-delay[^}]*transition-delay[^;]*; ||| %CSS% pause-anim-css ~ body.play-pause-animation-button__prefers-reduced-motion ||| [ ]*animation-delay[^}]*transition-delay[^;]*;",
                        "notes": [
                            "The highlighted code will activate if:",
                            "<ul>",
                            "  <li>The user has configured the operating system to reduce motion animations, <strong>or</strong></li>",
                            "  <li>The <code>.play-pause-animation-button__prefers-reduced-motion</code> is set to the <code>body</code> tag.",
                            "</ul>",
                            "<p>This code was provided in Bruce's Lawson's awesome blog post <a href=\"https://brucelawson.co.uk/2021/prefers-reduced-motion-and-browser-defaults/\">prefers-reduced-motion and browser defaults</a>."
                        ]
                    },
                    {
                        "label": "Mark up checkbox",
                        "highlight": "for",
                        "notes": "Standard checkbox markup.  Just make sure the id is set as shown."
                    },
                    {
                        "label": "Set up the checkbox click event",
                        "highlight": "%JS%playPauseAnimationButton ||| document.addEventListener\\('change'[^\\)]*\\); ||| this.clickEvent =",
                        "notes": ""
                    },
                    {
                        "label": "Call the appropriate method when the checkbox is clicked and unclicked",
                        "highlight": "%JS%playPauseAnimationButton ||| this.play\\(\\); ||| this.pause\\(\\);",
                        "notes": "You will also notice that the pause and play methods are fired when in and out of the <code>prefers-reduced-motion</code> breakpoint."
                    },
                    {
                        "label": "In the pause and play methods, add the appropriate classes to the body",
                        "highlight": "%JS%playPauseAnimationButton ||| body.classList[^\\)]*\\);",
                        "notes": "This adds the <code>play-pause-animation-button__prefers-reduced-motion</code> to the body (this was the class that stops the CSS animation in one of the previous steps)."
                    }
                ]
            }
            </script>

            <h3>Pausing requestAnimationFrame Animations</h3>

            <p>Most Canvas Animations (like <a href="https://codepen.io/thebabydino/pen/gbJwMQ">this great elastic collision demo</a> from
                <a href="https://codepen.io/thebabydino">Ana Tudor</a>) rely on code using
                <code>requestAnimationFrame()</code> to produces a frame of
                animation.
                When the checkbox is checked, we just set window.requestAnimationFrame to a dummy function, and set it back
                when the checkbox
                is unchecked. <strong>The animation below wasn't made with pausing in mind ... my pause script "just made it
                    work".</strong>
            </p>

            <div id="elastic-collision-demo" class="enable-example">
                <canvas id="elastic-collision-demo__canvas"></canvas>
            </div>

                    <div class="showcode__container">
                        <h4 class="showcode__heading">Example code explanation</h4>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="elastic-collision-demo__steps" class="showcode__steps"></div>
                                        <div id="elastic-collision-demo__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="elastic-collision-demo__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="elastic-collision-demo__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="elastic-collision-demo__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="elastic-collision-demo__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="elastic-collision-demo"
                        data-showcode-props="elastic-collision-demo-props"
                        tabindex="0"
                        aria-describedby="elastic-collision-demo__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>            <script type="application/json" id="elastic-collision-demo-props">
            {
                "replaceHtmlRules": {},
                "steps": [{
                        "label": "Cache the browser requestAnimationFrame method",
                        "highlight": "%JS%  playPauseAnimationButton ||| let cachedRAF[^;]*;",
                        "notes": ""
                    },
                    {
                        "label": "Create a dummy function that calls itself one every 100 ms",
                        "highlight": "%JS% playPauseAnimationButton ||| this.dummyRAF =",
                        "notes": ""
                    },
                    {
                        "label": "When pause method is executed, set requestAnimationFrame to dummy function",
                        "highlight": "%JS% playPauseAnimationButton ||| window.requestAnimationFrame = this.dummyRAF;",
                        "notes": "Since most canvas animation rely on requestAnimationFrame to produce and animation frame, this should stop any animations from executing."
                    },
                    {
                        "label": "When play method is executed, set requestAnimationFrame back to the browser default",
                        "highlight": "%JS% playPauseAnimationButton ||| window.requestAnimationFrame = cachedRAF;",
                        "notes": ""
                    }
                ]
            }
            </script>

            <h3>SMIL Animation Demo</h3>
            <p>
                The animation below (made by the talented <a href="https://codepen.io/madetoday">Lenka</a> from
                <a href="https://codepen.io/madetoday/pen/MYxYeo">their CodePen of this demo</a>)
                uses <a href="https://developer.mozilla.org/en-US/docs/Web/SVG/SVG_animation_with_SMIL">SMIL</a>
                to animate the SVG. Note that although there was a lot of noise about
                SMIL being deprecated in Chrome, this
                <a href="https://groups.google.com/a/chromium.org/g/blink-dev/c/5o0yiO440LM/m/YGEJBsjUAwAJ?pli=1">deprecation
                    was suspended</a>
                (i.e. it is still a web standard and will continue to be in the forseeable future, due to pushback from the
                web development community).
            </p>
            <!-- SMIL demo from  by Lenka (codepen @madetoday) -->

            <div id="svg-smil-demo" class="enable-example">
                <svg id="wrap" width="300" height="300">

                    <!-- background -->
                    <svg>
                        <circle cx="150" cy="150" r="130" style="stroke: lightblue; stroke-width:18; fill:transparent" />
                        <circle cx="150" cy="150" r="115" style="fill:#2c3e50" />
                        <path
                            style="stroke: #2c3e50; stroke-dasharray:820; stroke-dashoffset:820; stroke-width:18; fill:transparent"
                            d="M150,150 m0,-130 a 130,130 0 0,1 0,260 a 130,130 0 0,1 0,-260">
                            <animate attributeName="stroke-dashoffset" dur="6s" to="-820" repeatCount="indefinite" />
                        </path>
                    </svg>

                    <!-- image -->
                    <svg>
                        <path id="hourglass" d="M150,150 C60,85 240,85 150,150 C60,215 240,215 150,150 Z"
                            style="stroke: white; stroke-width:5; fill:white;" />

                        <path id="frame"
                            d="M100,97 L200, 97 M100,203 L200,203 M110,97 L110,142 M110,158 L110,200 M190,97 L190,142 M190,158 L190,200 M110,150 L110,150 M190,150 L190,150"
                            style="stroke:lightblue; stroke-width:6; stroke-linecap:round" />

                        <animateTransform xlink:href="#frame" attributeName="transform" type="rotate" begin="0s" dur="3s"
                            values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1" repeatCount="indefinite" />
                        <animateTransform xlink:href="#hourglass" attributeName="transform" type="rotate" begin="0s"
                            dur="3s" values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1"
                            repeatCount="indefinite" />
                    </svg>

                    <!-- sand -->
                    <svg>
                        <!-- upper part -->
                        <polygon id="upper" points="120,125 180,125 150,147" style="fill:#2c3e50;">
                            <animate attributeName="points" dur="3s" keyTimes="0; 0.8; 1"
                                values="120,125 180,125 150,147; 150,150 150,150 150,150; 150,150 150,150 150,150"
                                repeatCount="indefinite" />
                        </polygon>

                        <!-- falling sand -->
                        <path id="line" stroke-linecap="round" stroke-dasharray="1,4" stroke-dashoffset="200.00"
                            stroke="#2c3e50" stroke-width="2" d="M150,150 L150,198">
                            <!-- running sand -->
                            <animate attributeName="stroke-dashoffset" dur="3s" to="1.00" repeatCount="indefinite" />
                            <!-- emptied upper -->
                            <animate attributeName="d" dur="3s" to="M150,195 L150,195"
                                values="M150,150 L150,198; M150,150 L150,198; M150,198 L150,198; M150,195 L150,195"
                                keyTimes="0; 0.65; 0.9; 1" repeatCount="indefinite" />
                            <!-- last drop -->
                            <animate attributeName="stroke" dur="3s" keyTimes="0; 0.65; 0.8; 1"
                                values="#2c3e50;#2c3e50;transparent;transparent" to="transparent"
                                repeatCount="indefinite" />
                        </path>

                        <!-- lower part -->
                        <g id="lower">
                            <path d="M150,180 L180,190 A28,10 0 1,1 120,190 L150,180 Z"
                                style="stroke: transparent; stroke-width:5; fill:#2c3e50;">
                                <animateTransform attributeName="transform" type="translate" keyTimes="0; 0.65; 1"
                                    values="0 15; 0 0; 0 0" dur="3s" repeatCount="indefinite" />
                            </path>
                            <animateTransform xlink:href="#lower" attributeName="transform" type="rotate" begin="0s"
                                dur="3s" values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1"
                                repeatCount="indefinite" />
                        </g>

                        <!-- lower overlay - hourglass -->
                        <path d="M150,150 C60,85 240,85 150,150 C60,215 240,215 150,150 Z"
                            style="stroke: white; stroke-width:5; fill:transparent;">
                            <animateTransform attributeName="transform" type="rotate" begin="0s" dur="3s"
                                values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1" repeatCount="indefinite" />
                        </path>

                        <!-- lower overlay - frame2 -->
                        <path id="frame2" d="M100,97 L200, 97 M100,203 L200,203"
                            style="stroke:lightblue; stroke-width:6; stroke-linecap:round">
                            <animateTransform attributeName="transform" type="rotate" begin="0s" dur="3s"
                                values="0 150 150; 0 150 150; 180 150 150" keyTimes="0; 0.8; 1" repeatCount="indefinite" />
                        </path>
                    </svg>

                </svg>
            </div>

                    <div class="showcode__container">
                        <h4 class="showcode__heading">Example code explanation</h4>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="svg-smil-demo__steps" class="showcode__steps"></div>
                                        <div id="svg-smil-demo__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="svg-smil-demo__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="svg-smil-demo__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="svg-smil-demo__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="svg-smil-demo__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="svg-smil-demo"
                        data-showcode-props="svg-smil-demo-props"
                        tabindex="0"
                        aria-describedby="svg-smil-demo__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>            <script type="application/json" id="svg-smil-demo-props">
            {
                "replaceHtmlRules": {},
                "steps": [{
                        "label": "Add SMIL animation tags in the original SVG",
                        "highlight": "%OPENCLOSECONTENTTAG%animateTransform ||| %OPENCLOSECONTENTTAG%animate ||| %OPENCLOSECONTENTTAG%animateMotion",
                        "notes": "The <code>animate</code>, <code>animateTransform</code> and <code>animationTransform</code> tags are responsible for the animation in the SVG. More infomation is available at <a href=\"https://developer.mozilla.org/en-US/docs/Web/SVG/SVG_animation_with_SMIL\">the MDN SVG Animation With SMIL reference page</a>."
                    },
                    {
                        "label": "Use the SVG <code>pauseAnimations</code> and <code>playAnimations</code> methods",
                        "highlight": "%JS% playPauseAnimationButton ||| document.querySelectorAll\\('svg'\\) ||| el.pauseAnimations\\(\\);  ||| el.unpauseAnimations\\(\\);",
                        "notes": "Every SVG object has these methods."
                    }
                ]
            }
            </script>


            <h3 id="animated-gif" tabindex="-1">Animated GIF/WEBP Example</h3>

            <p>Unlike SVG SMIL animations, there is no browser API to pause GIF/WEBP animations.
                This script works around this by allowing the developer to include two different
                renditions of the image: one animated, the other not. CSS is then used to hide
                and show each rendition according the user's preference.</p>

            <p>(If you are looking for a way to add pause buttons on GIF animations, please
                take a look at <a href="http://localhost:8888/aria-role-demos/36-animated-gif-with-pause-button.php">
                    the animated gif pause button</a> examples).
            </p>

            <div id="anim-gif-demo" class="enable-example">
                <div class="play-pause-animation-button__gif">
                    <img class="play-pause-animation-button__gif--animated" src="images/running-man-anim.gif"
                        alt="Animated drawing of a man running" />
                    <img class="play-pause-animation-button__gif--still" src="images/running-man-anim__still.jpg"
                        alt="A drawing of a man running" />
                </div>
            </div>

                    <div class="showcode__container">
                        <h4 class="showcode__heading">Example code explanation</h4>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="anim-gif-demo__steps" class="showcode__steps"></div>
                                        <div id="anim-gif-demo__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="anim-gif-demo__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="anim-gif-demo__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="anim-gif-demo__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="anim-gif-demo__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="anim-gif-demo"
                        data-showcode-props="anim-gif-demo-props"
                        tabindex="0"
                        aria-describedby="anim-gif-demo__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>            <script type="application/json" id="anim-gif-demo-props">
            {
                "replaceHtmlRules": {},
                "steps": [{
                        "label": "Put the animated and unanimated images inside the DOM",
                        "highlight": "class",
                        "notes": "Note the classes being used.  These will be referred to in the next few steps."
                    },
                    {
                        "label": "Make the animated GIF visible and the still variation hidden by default",
                        "highlight": "%CSS% pause-anim-css ~ .play-pause-animation-button__gif--animated ||| %CSS% pause-anim-css ~ .play-pause-animation-button__gif--still",
                        "notes": ""
                    },
                    {
                        "label": "When the user wants the animation to be hidden, show only the still variation.",
                        "highlight": "%CSS% pause-anim-css ~ @media (prefers-reduced-motion: reduce) ||| [^\\n]*body:not\\(.play-pause-animation-button__prefers-motion\\)\\s.play-pause-animation-button__gif-[^}]*} ||| %CSS% pause-anim-css ~ body.play-pause-animation-button__prefers-reduced-motion ||| body.play-pause-animation-button__prefers-reduced-motion\\s.play-pause-animation-button__gif-[^}]*}",
                        "notes": ""
                    }
                ]
            }
            </script>
        </div>




    </main>

    <script src="js/play-pause-animations-button.js"></script>
    <script src="js/demos/ana-tudor/elastic-collision.js"></script>
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