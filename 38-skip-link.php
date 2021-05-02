<!DOCTYPE html>
<html lang="en">

<head>
    <title>Improved Skip Links</title>
    <?php include "includes/common-head-tags.php";?>


    <link id="enable-skip-link-style" href="css/enable-skip-link.css" rel="stylesheet" />

</head>

<body>

    <?php include "includes/example-header.php";?>

    <main>

        <aside class="notes">
            <p>
                This skip link hopefully will work for mobile browsers with screen readers as well.
            </p>
        </aside>

        <h1>Skip Link</h1>


        <h2>Mobile Friendly Skip Links</h2>

        <div id="example1">
            <div class="enable-skip-link__container enable-skip-link--begin">
                <a href="#end-of-component-1" id="beginning-of-component-1" class="enable-skip-link">
                    Skip to end of block
                </a>
            </div>
            <div class="fake-component">





            </div>
            <div class="enable-skip-link__container  enable-skip-link--end">
                <a href="#beginning-of-component-1" id="end-of-component-1" class="enable-skip-link">Skip to
                    beginning of block</a>
            </div>
        </div>

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {

            },
            "steps": [
                {
                    "label": "Make the first skip link point to the second one",
                    "highlight": "href=\"#end-of-component-1\", id=\"end-of-component-1\"",
                    "notes": ""
                },
                {
                    "label": "Make the second skip link point to the first",
                    "highlight": "href=\"#beginning-of-component-1\", id=\"beginning-of-component-1\"",
                    "notes": ""
                },
                {
                    "label": "Initialize the Javascript",
                    "highlight": "%JS% enableSkipLink.init",
                    "notes": "This sets up all the events needed for the links"
                },
                {
                    "label": "Skip Link Click Event",
                    "highlight": "%JS% enableSkipLink.clickEvent",
                    "notes": "Ensures focus goes to the skip links target in all browsers that don't do this correctly (e.g. Firefox)."
                },
                {
                    "label": "Scroll Event",
                    "highlight": "%JS% enableSkipLink.scrollEvent",
                    "notes": "This ensures that when a user uses the skip link, its target is not outside the browser's viewport."
                },
                {
                    "label": "Hide All Method",
                    "highlight": "%JS% enableSkipLink.hideAll",
                    "notes": "This method is invoked when the page is loaded, since browsers like Firefox will remember the scroll state of the component when the page is reloaded. This method is also invoked onResize and onOrientationChange, since the look of the component can look odd after these events"
                },
                {
                    "label": "CSS to style the skip link",
                    "highlight": "%CSS%enable-skip-link-style~ .enable-skip-link|width|margin-left ",
                    "notes": "This sets the CSS variable <strong>--prefers-reduced-motion</strong> to 1 if the user has asked the OS to reduce animations, and 0 otherwise."
                }
            ]
        }
        </script>

        <?php include "includes/example-footer.php"?>

        <script src="js/shared/enable-skip-link.js"></script>

    </main>
</body>

</html>