<!DOCTYPE html>
<html lang="en">

<head>
    <title>Button demo</title>
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



    <link id="button-css" rel="stylesheet" type="text/css" href="css/button.css" />
    <link rel="stylesheet" type="text/css" href="css/switch.css" />
</head>

<body>
    <nav tabindex="-1" class="example-nav">
    <ul>
        <li><a href=".">Back to Enable homepage</a></li>
    </ul>
</nav>
    <main>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>It is always better to use a real HTML <code>button</code> tag than a <code>div</code> or
                <code>a</code> tag with a <code>role="button"</code>.  This is especially noticable when using
                a <code>label</code> with the <code>button</code>, which reads differently in some screen readers
                then when using an <code>aria-describedby</code> to give it suplimentary information.</li>
            </ul>

        </aside>



        <h1>Accessible Button Demo</h1>

        <p>This page shows different ways a button can be marked up to see how screen readers will describe them to users.</p>

        <h2>A real HTML button marked up with label tag. Note that the label tag is better than using an aria-describedby.</h2>

        <p>The following is a
            <code>&lt;button&gt;</code> tag with a
            <code>&lt;label&gt;</code> tag describing what it is for.</p>
        <div id="example1" class="button-container">
            <label for="html-button">If you are sure you want to give Facebook your data, push this:</label>
            <button id="html-button">
                Submit
            </button>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="example1__steps" class="showcode__steps"></div>
                                        <div id="example1__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example1"
                        data-showcode-props="example1-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="example1-props">
        {
          "replaceHTMLRules": {
          },
          "steps": [
            {
              "label": "Create markup",
              "highlight": "%OPENCLOSECONTENTTAG%button",
              "notes": "So straightforward.  Why would you want to use an ARIA button?"
            },
            {
              "label": "Use an optional label",
              "highlight": "for",
              "notes": "Labels can be use to give appropriate context. Make sure you connect it to the button using the <strong>for</strong> attribute."
            }
          ]
        }
        </script>


        <h2>A DIV with a role of button</h2>
        <p>This is a
            <code>&lt;div&gt;</code> tag that has its role attribute set to
            <code>button</code>.</p>

        <div id="example2" class="button-container">
            <label id="div-button-label">If you are sure you want to give Facebook your data, push this:</label>
            <div class="aria-button" aria-describedby="div-button-label" role="button" tabindex="0">
                Submit
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
                <form class="showcode__ui">                                        <div id="example2__steps" class="showcode__steps"></div>
                                        <div id="example2__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example2"
                        data-showcode-props="example2-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>
        <script type="application/json" id="example2-props">
        {
          "replaceHTMLRules": {
          },
          "steps": [
            {
              "label": "Put button role on fake buttons",
              "highlight": "role=\"button\"",
              "notes": "This is to ensure screen readers report them as buttons."
            },
            {
              "label": "Apply tabindex=\"0\" on the fake buttons",
              "highlight": "tabindex",
              "notes": "This is to ensure they are keyboard accessible."
            },
            {
                "label": "Create JS that should be triggered when pressed",
                "highlight": "%JS% ariaButtonExample",
                "notes": "You must ensure that you include the keyup event as well as click, since click doesn't fire on keyboard events on DOM elements that aren't natively keyboard accessible by default."
            },
            {
                "label": "Create CSS",
                "highlight": "%CSS% button-css~ .button-container [role=\"button\"]",
                "notes": ""
            },
            {
              "label": "Use an optional label using aria-describedby",
              "highlight": "aria-describedby",
              "notes": "Labels can be use to give appropriate context. Make sure you connect it to the button using the <strong>for</strong> attribute."
            }
          ]
        }
        </script>




        <h2>A link with the role of button</h2>

        <p>This is an
            <code>&lt;a&gt;</code> tag that has its role set to <code>button</code>. Developers should avoid doing this.</p>

        <div id="example3" class="button-container">
            <label id="link-button-label">If you are sure you want to give Facebook your data, push this:</label>
            <a class="aria-button" aria-describedby="link-button-label" href="#" role="button">
                Submit
            </a>
        </div>

                <div class="showcode__container">
                        <h3 class="showcode__heading">Example code explanation</h3>
            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

                                    <div class="showcode">
                <form class="showcode__ui">                                        <div id="example3__steps" class="showcode__steps"></div>
                                        <div id="example3__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                                    </form>
                <pre class="showcode__example"><code
                        data-showcode-id="example3"
                        data-showcode-props="example3-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>        <script type="application/json" id="example3-props">
        {
          "replaceHTMLRules": {
          },
          "steps": [
            {
              "label": "Put button role on links that are really fake buttons",
              "highlight": "role=\"button\"",
              "notes": "This is to ensure screen readers report them as buttons."
            },
            {
              "label": "Make sure you make a dummy href on the link",
              "highlight": "href",
              "notes": "This is to ensure they are keyboard accessible and you don't need Javascript to trigger them."
            },
            {
                "label": "Create JS that should be triggered when pressed",
                "highlight": "%JS% ariaButtonExample",
                "notes": "You must ensure that you include the keyup event as well as click, since click doesn't fire on keyboard events on DOM elements that aren't natively keyboard accessible by default."
            },
            {
                "label": "Create CSS",
                "highlight": "%CSS% button-css~ .button-container [role=\"button\"]",
                "notes": ""
            },
            {
              "label": "Use an optional label using aria-describedby",
              "highlight": "aria-describedby",
              "notes": "Labels can be use to give appropriate context. Make sure you connect it to the button using the <strong>for</strong> attribute."
            }
          ]
        }
        </script>
    </main>

    <script>
        var ariaButtonExample = new function () {

            const activate = (e) => {
                const { target } = e;
                if (
                    target.classList.contains('aria-button') &&
                    (e.type == 'click' || e.key === ' ' || e.key === 'Enter')
                 ) {
                    e.preventDefault();
                    e.stopPropagation();
                    alert('this ARIA button has been triggered');
                }
            }

            document.addEventListener('click', activate);
            document.addEventListener('keyup', activate);
        }

        var htmlButtonExample = new function () {

            const activate = (e) => {
                const { target } = e;
                if (target.tagName === 'BUTTON') {
                    alert('this HTML button has been triggered');
                }
            }

            document.addEventListener('click', activate);
        }
    </script>
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
    <script src="js/hamburger.js"></script></body>

</html>