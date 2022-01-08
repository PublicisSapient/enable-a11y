<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accessible Fixed Bottom Navigation</title>
    <?php include "includes/common-head-tags.php";?>


    <link id="enable-skip-link-style" href="css/enable-visible-on-focus.css" rel="stylesheet" />
    <link id="bottom-fixed-navigation" href="css/bottom-fixed-nav.css" rel="stylesheet" />

</head>

<body class="bottom-fixed-nav__body">
    <div
      class="enable-mobile-visible-on-focus__container enable-skip-link--begin"
    >
      <a
        id="top-of-page"
        href="#main-nav-link"
        class="enable-mobile-visible-on-focus enable-skip-link"
      >
        Skip to bottom navigation
      </a>
    </div>
    

    <div id="example1">
        <div class="enable-visible-on-focus__container enable-skip-link--begin">
            <a href="#main-nav-link" id="top-of-page" class="enable-visible-on-focus enable-skip-link">
                Skip to main navigation at the bottom of page
            </a>
        </div>

        <main>
    <?php include "includes/pause-anim-control.php" ?>

            <aside class="notes">
                <p>
                    Instagram's main navigation menu is at the bottom of the screen.  It is 
                    extremely hard for screen reader users to discover it when just swiping through
                    interactive elements. To solve this, I have used my
                    <a href="38-visible-on-focus">mobile friendly skip links</a> to address this
                    issue by making it discoverable at the very beginning of the page.
                </p>
            </aside>

            <h1>Accessible Fixed Bottom Navigation</h1>


            <?php includeShowcode("example1")?>

            <script type="application/json" id="example1-props">
            {
                "replaceHtmlRules": {
                    "main": "<!-- main content here -->",
                    ".bottom-fixed-nav__list": "<!-- navigation list HTML here -->"
                },
                "steps": [{
                    "label": "Make the two skip links point to each other",
                    "highlight": "%OPENCLOSECONTENTTAG%div",
                    "notes": "These two skip links point to each other.  In order to understand how the CSS and JS works, please take a look at our <a href=\"38-visible-on-focus.php\">Visible of Focus skip link example</a>"
                }]
            }
            </script>



        </main>


        <nav class="bottom-fixed-nav" aria-label="main">
            <div
              class="enable-mobile-visible-on-focus__container enable-skip-link--begin"
            >
              <a
                id="main-nav-link"
                href="#top-of-page"
                class="enable-mobile-visible-on-focus enable-skip-link"
              >
                Back to top of the page
              </a>
            </div>
            <ul class="bottom-fixed-nav__list">
                <li class="bottom-fixed-nav__list-item">
                    <a class="bottom-fixed-nav__link"  href="/">
                        <svg aria-label="Home" class="_8-yf5 " fill="#262626" height="24"
                            viewBox="0 0 48 48" width="24">
                            <path
                                d="M45.3 48H30c-.8 0-1.5-.7-1.5-1.5V34.2c0-2.6-2-4.6-4.6-4.6s-4.6 2-4.6 4.6v12.3c0 .8-.7 1.5-1.5 1.5H2.5c-.8 0-1.5-.7-1.5-1.5V23c0-.4.2-.8.4-1.1L22.9.4c.6-.6 1.5-.6 2.1 0l21.5 21.5c.4.4.6 1.1.3 1.6 0 .1-.1.1-.1.2v22.8c.1.8-.6 1.5-1.4 1.5zm-13.8-3h12.3V23.4L24 3.6l-20 20V45h12.3V34.2c0-4.3 3.3-7.6 7.6-7.6s7.6 3.3 7.6 7.6V45z">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="bottom-fixed-nav__list-item">
                    <a class="bottom-fixed-nav__link" href="/explore/">
                        <svg
                                aria-label="Search &amp; Explore" class="_8-yf5 " fill="#262626" height="24"
                                viewBox="0 0 48 48" width="24">
                                <path
                                    d="M20 40C9 40 0 31 0 20S9 0 20 0s20 9 20 20-9 20-20 20zm0-37C10.6 3 3 10.6 3 20s7.6 17 17 17 17-7.6 17-17S29.4 3 20 3z">
                                </path>
                                <path
                                    d="M46.6 48.1c-.4 0-.8-.1-1.1-.4L32 34.2c-.6-.6-.6-1.5 0-2.1s1.5-.6 2.1 0l13.5 13.5c.6.6.6 1.5 0 2.1-.2.3-.6.4-1 .4z">
                                </path>
                            </svg>
                    </a>
                </li>
                <li class="bottom-fixed-nav__list-item">
                    <a class="bottom-fixed-nav__link" href="#">
                        <svg
                            aria-label="New Post" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48"
                            width="24">
                            <path
                                d="M31.8 48H16.2c-6.6 0-9.6-1.6-12.1-4C1.6 41.4 0 38.4 0 31.8V16.2C0 9.6 1.6 6.6 4 4.1 6.6 1.6 9.6 0 16.2 0h15.6c6.6 0 9.6 1.6 12.1 4C46.4 6.6 48 9.6 48 16.2v15.6c0 6.6-1.6 9.6-4 12.1-2.6 2.5-5.6 4.1-12.2 4.1zM16.2 3C10 3 7.8 4.6 6.1 6.2 4.6 7.8 3 10 3 16.2v15.6c0 6.2 1.6 8.4 3.2 10.1 1.6 1.6 3.8 3.1 10 3.1h15.6c6.2 0 8.4-1.6 10.1-3.2 1.6-1.6 3.1-3.8 3.1-10V16.2c0-6.2-1.6-8.4-3.2-10.1C40.2 4.6 38 3 31.8 3H16.2z">
                            </path>
                            <path
                                d="M36.3 25.5H11.7c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5h24.6c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5z">
                            </path>
                            <path
                                d="M24 37.8c-.8 0-1.5-.7-1.5-1.5V11.7c0-.8.7-1.5 1.5-1.5s1.5.7 1.5 1.5v24.6c0 .8-.7 1.5-1.5 1.5z">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="bottom-fixed-nav__list-item">
                    <a class="bottom-fixed-nav__link" href="/accounts/activity/">
                            <svg aria-label="Activity" class="_8-yf5 " fill="#262626"
                                height="24" viewBox="0 0 48 48" width="24">
                                <path
                                    d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                                </path>
                            </svg>
                    </a>
                </li>
                <li class="bottom-fixed-nav__list-item">
                    <a class="bottom-fixed-nav__link" href="/zoltandulac/">
                        <img
                            class="bottom-fixed-nav__avatar"
                                    alt="zoltandulac's profile picture" class="_6q-tv" crossorigin="anonymous"
                                    data-testid="user-avatar" draggable="false"
                                    src="images/zoltan-avitar.jpg">
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <?php include "includes/example-footer.php"?>
    <script src="js/demos/bottom-fixed-nav.js"></script>
</body>

</html>