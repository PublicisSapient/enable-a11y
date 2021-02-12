<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accessible Multilevel Hamburger Menu</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
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


        <button class="enable-flyout__open-menu-button " aria-label="Open mobile flyout" aria-expanded="false" aria-controls="mobile-menu">
                <i class="fa fa-navicon"></i>
            </button>


        <nav aria-label="mobile flyout">
            <ul id="mobile-menu" class="enable-flyout enable-flyout__top-level enable-flyout_level">
                <li>
                    <button aria-label="Close mobile flyout"  class="enable-flyout__close-level-button enable-flyout__close-top-level hdg" aria-expanded="true" aria-controls="mobile-menu">
                        <i class="fa fa-close"></i>
                        Close
                    </button>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                </li>

                <li>
                    <!-- Begin section 1 -->
                    <button aria-expanded="false" aria-controls="section1" class="enable-flyout__open-level-button ">
                        Section 1
                        <i class="fa fa-chevron-right"></i>
                    </button>
                    <ul aria-label="section 1" id="section1" class="enable-flyout enable-flyout_level ">
                        <li>
                            <button aria-label="close" class="enable-flyout__close-level-button  hdg">
                            <i class="fa fa-chevron-left"></i>
                            Go Back
</button>
                        </li>
                        <li>
                            <button aria-expanded="false" aria-controls="section1-1" class="enable-flyout__open-level-button ">
                                Section 1.1
                                <i class="fa fa-chevron-right"></i>
</button>
                            <ul aria-label="section 1.1" id="section1-1" class="enable-flyout enable-flyout_level ">
                                <li>
                                    <button aria-label="close" class="enable-flyout__close-level-button  hdg">
                                    <i class="fa fa-chevron-left"></i>
                                    Go Back
</button>
                                </li>
                                <li><a href="#">Link to page five</a></li>
                                <li><a href="#">Link to page six</a></li>
                                <li><a href="#">Link to page seven</a></li>
                                <li><a href="#">Link to page eight</a></li>
                                <li><a href="#">Link to page nine</a></li>
                            </ul>
                        </li>
                        <li>
                            <button aria-expanded="false" aria-controls="section1-2" class="enable-flyout__open-level-button ">
                                Secion 1.2
                                <i class="fa fa-chevron-right"></i>
</button>
                            <ul aria-label="section 1.2" id="section1-2" class="enable-flyout enable-flyout_level ">
                                <li><button aria-label="close" class="enable-flyout__close-level-button  hdg">
                                    <i class="fa fa-chevron-left"></i>
                                    Go Back
</button></li>
                                <li><a href="#">Link to page ten</a></li>
                                <li><a href="#">Link to page eleven</a></li>
                                <li><a href="#">Link to page twelve</a></li>
                                <li><a href="#">Link to page thirteen</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Link to page three</a></li>
                        <li><a href="#">Link to page four</a></li>
                    </ul>
                </li><!-- End section 1 -->

                <li>
                    <button aria-expanded="false" aria-controls="section2" class="enable-flyout__open-level-button ">
                        Section 2
                        <i class="fa fa-chevron-right"></i>
</button>
                    <ul aria-label="section 2" id="section2" class="enable-flyout enable-flyout_level ">
                        <li><button aria-label="close" class="enable-flyout__close-level-button  hdg">
                            <i class="fa fa-chevron-left"></i>
                            Go Back
</button></li>
                        <li><a href="#">Link to page fourteen</a></li>
                        <li><a href="#">Link to page fifteen</a></li>
                        <li><a href="#">Link to page sixteen</a></li>
                        <li><a href="#">Link to page seventeen</a></li>
                        <li><a href="#">Link to page eighteen</a></li>
                        <li><a href="#">Link to page nineteen</a></li>
                    </ul>
                </li>
                <hr class="enable-flyout__separator" />
                <li>
                    <a href="#">Link to page one</a>
                </li>
                <li>
                    <a href="#">Link to page two</a>
                </li>
            </ul>
        </nav>

        <span class="enable-flyout__overlay-screen"></span>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/accessibility-es4.js"></script>
    <script src="js/hamburger.js"></script>
</body>

</html>