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


        <button class="burger js-menuToggle" aria-label="Open mobile flyout" aria-expanded="false" aria-controls="mobile-menu">
                <i class="fa fa-navicon"></i>
            </button>


        <nav aria-label="mobile flyout">
            <ul id="mobile-menu" class="pushNav js-topPushNav js-pushNavLevel">
                <li>
                    <button aria-label="Close mobile flyout"  class="closeLevel js-closeLevelTop hdg" aria-expanded="true" aria-controls="mobile-menu">
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
                    <button aria-expanded="false" aria-controls="section1" class="openLevel js-openLevel">
                        Section 1
                        <i class="fa fa-chevron-right"></i>
                    </button>
                    <ul aria-label="section 1" id="section1" class="pushNav pushNav_level js-pushNavLevel">
                        <li>
                            <button aria-label="close" class="closeLevel js-closeLevel hdg">
                            <i class="fa fa-chevron-left"></i>
                            Go Back
</button>
                        </li>
                        <li>
                            <button aria-expanded="false" aria-controls="section1-1" class="openLevel js-openLevel">
                                Section 1.1
                                <i class="fa fa-chevron-right"></i>
</button>
                            <ul aria-label="section 1.1" id="section1-1" class="pushNav pushNav_level js-pushNavLevel">
                                <li>
                                    <button aria-label="close" class="closeLevel js-closeLevel hdg">
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
                            <button aria-expanded="false" aria-controls="section1-2" class="openLevel js-openLevel">
                                Secion 1.2
                                <i class="fa fa-chevron-right"></i>
</button>
                            <ul aria-label="section 1.2" id="section1-2" class="pushNav pushNav_level js-pushNavLevel">
                                <li><button aria-label="close" class="closeLevel js-closeLevel hdg">
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
                    <button aria-expanded="false" aria-controls="section2" class="openLevel js-openLevel">
                        Section 2
                        <i class="fa fa-chevron-right"></i>
</button>
                    <ul aria-label="section 2" id="section2" class="pushNav pushNav_level js-pushNavLevel">
                        <li><button aria-label="close" class="closeLevel js-closeLevel hdg">
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
                <hr />
                <li>
                    <a href="#">Link to page one</a>
                </li>
                <li>
                    <a href="#">Link to page two</a>
                </li>
            </ul>
        </nav>

        <div class="wrapper">

            <h1>Multi-Level Hamburger Push Menu</h1>
            <p>This is a simple multi-level hamburger menu. The only thing jQuery is doing here is adding and removing
                CSS classes — all animations/ nav hiding/ sliding etc are pure CSS.</p>
            <p><a href="http://fontawesome.io/">Font Awesome</a> icons are used in the menu. You can easily substitute
                your own icons or omit them altogether.</p>
            <button>
                <a href="https://hayley.cc" target="_blank"><i class="fa fa-user-circle-o"></i> Hayley.cc</a>
            </button>
        </div>

        <span class="screen"></span>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/accessibility-es4.js"></script>
    <script src="js/hamburger.js"></script>
</body>

</html>