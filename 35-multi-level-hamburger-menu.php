<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accessible Multilevel Hamburger Menu</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/hamburger-menu.css" />
</head>

<body>
    <?php include("includes/example-header.php"); ?>

    <main>
        <aside class="notes">
            <p>
                This is based on <a href="https://codepen.io/johorduz/pen/pYqPrp">
                    this great CSS only hamburger menu</a>
            </p>
        </aside>

        <h1>Example 1</h1>


        <button class="enable-flyout__open-menu-button " aria-label="Open mobile flyout" aria-expanded="false"
            aria-controls="mobile-menu">
            <i class="fa fa-navicon"></i>
        </button>

        <!-- ESC key -->
        <nav aria-label="mobile flyout">
            <div id="mobile-menu" class="enable-flyout enable-flyout__top-level enable-flyout__level">
                <ul class="enable-flyout__list">
                    <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                        <button aria-label="Close mobile flyout"
                            class="enable-flyout__close-level-button enable-flyout__close-top-level hdg"
                            aria-expanded="true" aria-controls="mobile-menu">
                            <i class="fa fa-close"></i>
                            Close
                        </button>
                    </li>
                    <li class="enable-flyout__menu-item">
                        <a href="#" class="enable-flyout__link">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                    </li>

                    <li class="enable-flyout__menu-item">
                        <!-- Begin section 1 -->
                        <button aria-expanded="false" aria-controls="section1"
                            class="enable-flyout__open-level-button ">
                            Game Consoles

                        </button>
                        <div aria-label="Game Consoles" id="section1" class="enable-flyout enable-flyout__level ">
                            <ul class="enable-flyout__list">
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                    <button class="enable-flyout__close-level-button  hdg">
                                        <i class="fa fa-chevron-left"></i>
                                        Go Back
                                    </button>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <button aria-expanded="false" aria-controls="section1-1"
                                        class="enable-flyout__open-level-button ">
                                        Atari
                                    </button>
                                    <div aria-label=Atari id="section1-1" class="enable-flyout enable-flyout__level ">
                                        <div class="enable-flyout__level-heading">Atari</div>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close">
                                                <button aria-label="close"
                                                    class="enable-flyout__close-level-button  hdg">
                                                    <i class="fa fa-chevron-left"></i>
                                                    Go Back
                                                </button>
                                            </li>
                                            <li class="enable-flyout__menu-item">
                                                <a href="#" class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/space-invaders.png" alt=""
                                                        role="presentation" />
                                                    Space Invaders
                                                </a>
                                            </li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link"><img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/asteroids.png" alt=""
                                                        role="presentation" /> Asteroids</a></li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link"><img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/pac-man.png" alt=""
                                                        role="presentation" /> Pac-Man</a></li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link"><img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/yars-revenge.png" alt=""
                                                        role="presentation" />
                                                    Yars' Revenge</a></li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link"><img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/superman.png" alt=""
                                                        role="presentation" /> Superman</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="enable-flyout__menu-item">
                                    <button aria-expanded="false" aria-controls="section1-2"
                                        class="enable-flyout__open-level-button ">
                                        Intellivision

                                    </button>
                                    <div aria-label="Intellivision" id="section1-2"
                                        class="enable-flyout enable-flyout__level ">
                                        <div class="enable-flyout__level-heading">Intellivision</div>
                                        <ul class="enable-flyout__list enable-flyout__list--photo-layout">
                                            <li class="enable-flyout__menu-item enable-flyout__menu-item--close"><button
                                                    class="enable-flyout__close-level-button  hdg">
                                                    <i class="fa fa-chevron-left"></i>
                                                    Go Back
                                                </button></li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/space-armada.png" alt=""
                                                        role="presentation" />
                                                    Space Armada
                                                </a></li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/astrosmash.png" alt=""
                                                        role="presentation" />
                                                        Astrosmash
                                                </a></li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/lock-n-chase.png" alt=""
                                                        role="presentation" />
                                                    Lock 'n Chase
                                                    </a></li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/dnd.png" alt=""
                                                        role="presentation" />
                                                    Advanced Dungeons and Dragons</a></li>
                                            <li class="enable-flyout__menu-item"><a href="#"
                                                    class="enable-flyout__link">
                                                    <img class="enable-flyout__link-image"
                                                        src="images/hamburger-menu/he-man.png" alt=""
                                                        role="presentation" />
                                                    He-Man</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--orphan"><a href="#" class="enable-flyout__link">
                                    ColecoVision
                                </a></li>
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--orphan"><a href="#" class="enable-flyout__link">
                                    Nintendo Entertainment System
                                </a></li>
                            </ul>
                        </div>
                    </li><!-- End section 1 -->

                    <li class="enable-flyout__menu-item">
                        <button aria-expanded="false" aria-controls="section2"
                            class="enable-flyout__open-level-button ">
                            Section 2

                        </button>
                        <div aria-label="section 2" id="section2" class="enable-flyout enable-flyout__level ">
                            <div class="enable-flyout__level-heading">section 2</div>
                            <ul class="enable-flyout__list">
                                <li class="enable-flyout__menu-item enable-flyout__menu-item--close"><button
                                        class="enable-flyout__close-level-button  hdg">
                                        <i class="fa fa-chevron-left"></i>
                                        Go Back
                                    </button></li>
                                <li class="enable-flyout__menu-item"><a href="#" class="enable-flyout__link">Link to
                                        page
                                        fourteen</a></li>
                                <li class="enable-flyout__menu-item"><a href="#" class="enable-flyout__link">Link to
                                        page
                                        fifteen</a></li>
                                <li class="enable-flyout__menu-item"><a href="#" class="enable-flyout__link">Link to
                                        page
                                        sixteen</a></li>
                                <li class="enable-flyout__menu-item"><a href="#" class="enable-flyout__link">Link to
                                        page
                                        seventeen</a></li>
                                <li class="enable-flyout__menu-item"><a href="#" class="enable-flyout__link">Link to
                                        page
                                        eighteen</a></li>
                                <li class="enable-flyout__menu-item"><a href="#" class="enable-flyout__link">Link to
                                        page
                                        nineteen</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="enable-flyout__menu-item">
                        <a href="#" class="enable-flyout__link">Link to page one</a>
                    </li>
                    <li class="enable-flyout__menu-item">
                        <a href="#" class="enable-flyout__link">Link to page two</a>
                    </li>
                </ul>
            </div>
        </nav>

        <a href="/">Home</a>

        <span class="enable-flyout__overlay-screen"></span>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/accessibility-es4.js"></script>
    <script src="js/hamburger.js"></script>
</body>

</html>