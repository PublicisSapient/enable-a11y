<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Enable - HTML5 Code Examples Accessible To Everyone
    </title>
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


<link id="site-css" rel="stylesheet" href="css/site.css" />




    <link rel="stylesheet" type="text/css" href="css/all.css" />
    <link rel="stylesheet" type="text/css" href="css/switch.css" />
    <link rel="stylesheet" type="text/css" href="css/tabs.css" />
    <link rel="stylesheet" type="text/css" href="css/home.css" />

    
</head>

<body>
    <div role="banner" tabindex="0">
    <h1>
        <a class="enable-logo__link" href="index.php">
    <img class="enable-logo" src="images/ENABLE.svg" alt="" role="presentation" />
    <span class="enable-logo__text">Enable</span>
    <span class="enable-logo__sub-text">Modern Web Code Examples Accessible To Everyone</span>
</a>    </h1>

    <!-- Here is the main menu -->
    <nav class="site__nav enable-flyout__container" aria-label="main menu">
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
                                                <img class="enable-flyout__link-image" src="images/main-menu/button.png"
                                                    alt="">
                                                Button
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="checkbox.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/checkbox.png" alt="">
                                                Checkboxes
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="radiogroup.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/radiogroup.png" alt="">
                                                Radio Button Group
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="listbox.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/listbox.png" alt="">
                                                Select Box (a.k.a. listboxes)
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="textbox.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/textbox.png" alt="">
                                                Textbox
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="combobox.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/combobox.png" alt="">
                                                Autocomplete input field (a.k.a. combobox)
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="slider.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image" src="images/main-menu/slider.png"
                                                    alt="">
                                                Range Input field (a.k.a Slider)
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="spinner.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/spinner.png" alt="">
                                                Numeric Input (a.k.a. Spinner)
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
                                                <img class="enable-flyout__link-image" src="images/main-menu/link.png"
                                                    alt="">
                                                Link
                                            </a>
                                        </li>

                                        <li class="enable-flyout__menu-item">
                                            <a href="tooltip.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/tooltip.png" alt="">
                                                Tooltip
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="multi-level-hamburger-menu.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/multi-level-hamburger-menu.png" alt="">
                                                Hybrid Desktop and Mobile Hamburger Menu
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="tabs.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image" src="images/main-menu/tabs.png"
                                                    alt="">
                                                Tablist
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="switch.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image" src="images/main-menu/switch.png"
                                                    alt="">
                                                Switch
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="carousel.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/carousel.png" alt="">
                                                Carousel
                                            </a>
                                        </li>
                                        <li class="enable-flyout__menu-item">
                                            <a href="skip-link.php" class="enable-flyout__link">
                                                <img class="enable-flyout__link-image"
                                                    src="images/main-menu/skip-link.png" alt="">
                                                Skip Links (a.k.a. Visible on Focus CTAs)
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
                                    <img class="enable-flyout__link-image" src="images/main-menu/table.png" alt="">
                                    Table
                                </a>
                            </li>
                            <li class="enable-flyout__menu-item">
                                <a href="description-list.php" class="enable-flyout__link">
                                    <img class="enable-flyout__link-image" src="images/main-menu/description-list.png"
                                        alt="">
                                    Description List (formally Definition List)
                                </a>
                            </li>
                            <li class="enable-flyout__menu-item">
                                <a href="progress.php" class="enable-flyout__link">
                                    <img class="enable-flyout__link-image" src="images/main-menu/progress.png" alt="">
                                    Progress Bar (a.k.a. Loaders/Spinners)
                                </a>
                            </li>
                            <li class="enable-flyout__menu-item">
                                <a href="img.php" class="enable-flyout__link">
                                    <img class="enable-flyout__link-image" src="images/main-menu/img.png" alt="">
                                    Image
                                </a>
                            </li>
                            <li class="enable-flyout__menu-item">
                                <a href="figure.php" class="enable-flyout__link">
                                    <img class="enable-flyout__link-image" src="images/main-menu/figure.png" alt="">
                                    Figure
                                </a>
                            </li>
                            <li class="enable-flyout__menu-item">
                                <a href="heading.php" class="enable-flyout__link">
                                    <img class="enable-flyout__link-image" src="images/main-menu/heading.png" alt="">
                                    Heading
                                </a>
                            </li>
                            <li class="enable-flyout__menu-item">
                                <a href="math.php" class="enable-flyout__link">
                                    <img class="enable-flyout__link-image" src="images/main-menu/math.png" alt="">
                                    Math
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
                                    <img class="enable-flyout__link-image"
                                        src="images/main-menu/animated-gif-with-pause-button.png" alt="">
                                    Animated Images (e.g. GIF, WEBP, etc)
                                </a>
                            </li>
                            <li class="enable-flyout__menu-item">
                                <a href="play-pause-animations-button.php" class="enable-flyout__link">
                                    <img class="enable-flyout__link-image"
                                        src="images/main-menu/play-pause-animations-button.png" alt="">
                                    Pause All Animations Control
                                </a>
                            </li>

                            <!-- Start menu items for section Animated Content -->
                        </ul>
                    </div>
                </li>
                <li class="enable-flyout__menu-item">
                    <!-- Begin section ARIA Live Regions -->
                    <button aria-expanded="false" aria-controls="aria-live-regions-section"
                        class="enable-flyout__open-level-button">
                        ARIA Live Regions
                    </button>
                    <div id="aria-live-regions-section" aria-label="ARIA Live Regions" role="group"
                        class="enable-flyout enable-flyout__level enable-flyout__dropdown">
                        <button class="enable-flyout__hamburger-icon-facade">
                            <span class="sr-only">
                                close mobile flyout
                            </span>
                        </button>
                        <ul class="enable-flyout__list">
                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                <button class="enable-flyout__close-level-button">
                                    Go Back
                                </button>
                            </li>

                            <!-- Start menu items for section ARIA Live Regions -->
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
    <span class="enable-flyout__overlay-screen">
    </span>


</div>
    <main>
        <h1>Enable your code. Enable your users.</h1>

        <div class="sr-only tabs__instructions" id="tabs-keyboard-only-instructions">
            Use arrow keys to choose tabs. Content will be displayed below.
        </div>
        <div id="home-tabs">
            <ul role="tablist" aria-describedby="tabs-keyboard-only-instructions"
                data-keyboard-only-instructions="tabs-keyboard-only-instructions">
                <li role="presentation">
                    <a href="#what-is-enable" role="tab" aria-owns="what-is-enable__tabpanel"
                        aria-describedby="tabs-keyboard-only-instructions">
                        What is it?
                    </a>
                </li>
                <li role="presentation">
                    <a href="#example-list" role="tab" aria-owns="example-list__tabpanel"
                        aria-describedby="tabs-keyboard-only-instructions">
                        How To Use
                    </a>
                </li>
                <li role="presentation">
                    <a href="#how-to-contribute" role="tab" aria-owns="how-to-contribute__tabpanel"
                        aria-describedby="tabs-keyboard-only-instructions">
                        Contribute
                    </a>
                </li>
            </ul>
            <div role="tabpanel" id="what-is-enable__tabpanel">
                <h2>
                    What is <strong>Enable</strong>?
                </h2>
                <p>
                    Do you want to learn how to make your web projects accessible? Do
                    you need a good example of an accessible web code but don't know
                    where to look? Have you ever included a JavaScript library in your
                    project, but then found out it's not accessible and need to figure
                    out how to fix it?
                </p>

                <p>If so <strong>Enable</strong> is for you.</p>

                <p>
                    <strong>Enable</strong> is not a framework.
                    <strong>Enable</strong> is not a library (although some of the
                    examples do use accessible.js). <strong>Enable</strong> is a series
                    of widgets that allow you to learn to make your web work accessible.
                </p>

                <p>
                    You can either use the widgets as is, or use them as models to make
                    your own projects accessible (and if you do, please share your work
                    with us by sending us a pull request ... we'd love to share your
                    work with the <strong>Enable</strong> community).
                </p>

                <p>
                    <strong>Enable</strong> was originally created by
                    <a href="https://www.useragentman.com/">Zoltan Hawryluk</a> to
                    answer questions his colleagues asked about how to make their web
                    widgets work with things like keyboards and screen readers. It is
                    his hope that he can give this to the web development community and
                    make <strong>Enable</strong> grow by having other
                    accessibility-minded developers share their work as well.
                </p>

                <p>
                    Use the examples in the <strong>Enable</strong> git repository to
                    make your web work accessible to people, with or without
                    disabilities. <strong>Enable</strong> examples work for users who
                    use screen readers, keyboards, and other devices besides a mouse.
                    And we actively encourage web developers who make accessible widgets
                    to contribute to <strong>Enable</strong> and share their
                    accessibility knowledge to others.
                </p>
            </div>
            <div role="tabpanel" id="example-list__tabpanel">
                <h2>Examples List</h2>

                <p>
                    <strong>Enable</strong> has a whole range of example code available,
                    with more examples being added all the time. Currently, they are
                    mostly plain vanilla JavaScript (or CSS only), but we are looking to
                    add examples for popular frameworks like
                    <a href="https://reactjs.org">React</a>.
                </p>
                <p>
                    In general, (the big exception being the
                    <a href="10-combobox.php">Combo box exmaple</a>), we highly
                    recommend that you use native HTML5 links, buttons, select boxes,
                    checkboxes, etc., instead of custom ones. However, there are times
                    when you have to work with custom components (e.g. when you are
                    dealing with an existing site). Here are examples of custom widgets
                    that work properly.
                </p>

                <p>
                    Note that a lot of developers don't realize that they may be coding
                    native HTML5 widgets incorrectly (tables being a very good example).
                    Double check your work with these examples to ensure you are. :-)
                </p>

                <h3>Links and Buttons</h3>

                <ul>
                    <li>
                        <a href="18-link.php">Links</a> : A lot of developers don't know
                        that links should only be used when coding a CTA that goes to a
                        specific URL. There is also special markup to tell assistive
                        technology when a link actually points to the page the user is
                        currently on.
                    </li>

                    <li>
                        <a href="05-button.php">Button</a>: Unlike a link, a button
                        doesn't have a URL associated with it. It causes an action on the
                        page.
                    </li>
                </ul>

                <p>
                    Note: A link can look like a button, and a button can look like a
                    link. However, if a CTA has a URL associated with it, it is a link,
                    no matter what it looks like.
                </p>

                <h3>Form Elements</h3>

                <ul>
                    <li>
                        <a href="12a-form-error-checking.php">Form error checking:</a>
                        You don't even know you are coding them wrong! One of the most
                        common things developers don't realize they are implementing
                        incorrectly.
                    </li>
                    <li><a href="12-form.php">Form with custom elements</a>:</li>

                    <li>
                        <a href="06-checkbox.php">Checkbox</a>: both native
                        <code>&lt;input type="checkbox"&gt;</code> and custom ones
                    </li>

                    <li>
                        <a href="15a-radiogroup.php">Radio Buttons</a>: they are clustered
                        in groups and have special keyboard interactions that need to be
                        coded if you are making custom ones instead of their native HTML5
                        equivalents.
                    </li>
                    <li>
                        <a href="19-listbox.php">Listbox (a.k.a. select boxes)</a>: allow
                        you to select from a list of items. In order to make custom select
                        boxes accessible, you must implement specific keyboard navigation
                        and add specific ARIA markup.
                    </li>
                    <li>
                        <a href="24-textbox.php">Textboxes</a>: It is possible to make
                        custom textboxes, with surprisingly little effort. This code shows
                        how.
                    </li>
                    <li>
                        <a href="10-combobox.php">Combobox</a>: Surprisingly, native
                        HTML5 autocomplete using the <code>datalist</code> tag is
                        currently not very accessible
                    </li>
                    <li>
                        <a href="32-slider.php">Slider</a>: can be implemented with
                        native HTML5 <code>&lt;input type="range"&gt;</code>, or with
                        custom code. The latter can also be used when it's necessary for
                        users to choose a range of values.
                    </li>
                    <li>
                        <a href="30-spinner.php">Numeric Inputs</a>: You may not even
                        realize that <code>&lt;input type="number"&gt;</code> is not
                        supposed to be used for numeric inputs like zipcodes that don't
                        represent quantities.
                    </li>
                </ul>

                <h3>Other native widgets</h3>

                <ul>
                    <li><a href="04-dialog-document__html5.php">Modal Dialog</a>:
                        Works in both desktop and modal (a lot of so-called accessible
                        dialogs don't work in mobile correctly).
                    </li>
                    <li>
                        <a href="07-table.php">Table</a> You'll be surprised that you've
                        probably been coding them wrong all this time! Includes
                        instructions on how screen reader users navigate tables.
                    </li>
                    <li>
                        <a href="08-definition-term.php">Description List:</a> previously
                        known as definition lists, they are a list of name value pairs.
                    </li>
                    <li>
                        <a href="23-progress.php">Progress bars/spinners</a>: should be
                        coded in such a way to ensure their progress is announced to
                        screen readers.
                    </li>
                    <li>
                        <a href="17-img.php">Image</a>: HTML5 and custom image widgets
                        must be coded to ensure the content of the image is announced
                        correctly to screen reader users.
                    </li>
                    <li>
                        <a href="36-animated-gif-with-pause-button.php">Pausable Animated GIF</a>:
                        Yes, it is possible to pause them without Javascript!
                    </li>
                    <li>
                        <a href="28-tooltip.php"> 28-tooltip.html</a>: It is possible to
                        make custom tooltips with CSS only or with JavaScript. This
                        example has both.
                    </li>
                    <li>
                        <a href="11-figure.php">Figure</a>: An image, illustration,
                        diagram, code snippet, etc., that is referenced in the main flow
                        of a document, but that can be moved to another part of the
                        document or to an appendix without affecting the main flow.
                    </li>
                    <li>
                        <a href="16-heading.php">Heading</a>: Screen readers users use
                        them as the table of contents for you page. Make sure you are
                        coding them correctly.
                    </li>

                    <li>
                        <a href="21-math.php">Math</a>: MathML is used to code math
                        equations, and there are strategies to make them work with screen
                        readers.
                    </li>
                    <li>
                        <a href="33-dropdown.php">Dropdowns</a>: Native ones can be coded
                        today using <code>&lt;details&gt;</code> and
                        <code>&lt;summary&gt;</code> tags!
                    </li>
                </ul>

                <h3>Custom Widgets With No HTML5 Equivalent</h3>

                <p>These widgets don't have any native HTML5 equivalent.</p>

                <ul>
                    <li>
                        <a href="35-multi-level-hamburger-menu.php">Flyout Menu (a.k.a. Hamburger Menu)</a>
                    </li>
                    <li>
                        <a href="08a-tabs.php">Tabs:</a> one of the hardest widgets to
                        code right.
                    </li>
                    <li><a href="31-switch.php">Switch:</a> when you want something
                        turned on and off, but you don't want to use a checkbox.</li>
                    <li><a href="36-animated-gif-with-pause-button.php">Animated GIF with pause button</a></li>
                    <li><a href="37-carousel.php">Carousel</a></li>
                    <li><a href="38-visible-on-focus.php">Visible On Focus CTAs/Skip Links</a></li>
                    <li><a href="43-read-more.php">Read More buttons</a></li>
                    <li><a href="42-play-pause-animations-button.php">Pause animation Widget</a></li>

                </ul>

                <h3>ARIA live Regions</h3>

                <p>This markup will inform users about changes on the page.</p>

                <ul>
                    <li><a href="02-alert.php">Alert role</a></li>
                    <li><a href="20-log.php">Log role</a></li>
                    <li><a href="25-timer.php">Timer role</a></li>
                    <li><a href="26-marquee.php">Marquee role</a></li>
                    <li><a href="27-status.php">Status role</a></li>
                </ul>
            </div>
            <div role="tabpanel" id="how-to-contribute__tabpanel">
                <h2>How To Contribute</h2>

                <p>You can contribute a number of ways:</p>

                <ol>
                    <li>
                        Contribute code and an example page of an accessible widget or
                        code example.
                    </li>
                    <li>
                        Contribute a video of how accessible works with assistive
                        technologies such as screen readers, keyboards, voice recognition
                        devices, etc.
                    </li>
                    <li>
                        Contribute links to your own articles and blog posts which talk
                        about how to make web work accessible.
                    </li>
                </ol>
            </div>
        </div>
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
    <script src="js/tabs.js"></script>
</body>

</html>