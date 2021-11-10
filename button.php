<!DOCTYPE html>
<html lang="en">

<head>
    <title>Button demo</title>
    <?php include "includes/common-head-tags.php";?>
    <link id="button-css" rel="stylesheet" type="text/css" href="css/button.css" />
    <link rel="stylesheet" type="text/css" href="css/switch.css" />
</head>

<body>
    <?php include "includes/documentation-header.php";?>

    <main>

        <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>It is always better to use a real HTML <code>button</code> tag than a <code>div</code> or
                    <code>a</code> tag with a <code>role="button"</code>. This is especially noticable when using
                    a <code>label</code> with the <code>button</code>, which reads differently in some screen readers
                    then when using an <code>aria-describedby</code> to give it suplimentary information.
                </li>
                <li>
                    Links can look like buttons, and buttons can look like links. Adam Silver
                    has written a great article, <a
                        href="https://medium.com/simple-human/but-sometimes-links-look-like-buttons-and-buttons-look-like-links-9b371c57b3d2">But
                        sometimes links look like buttons (and buttons look like links)</a> about this topic.
                    The main
                    difference, from a UX point of view, is that links go to another web page,
                    while buttons cause an action on a page (or submit a form). Keep this in mind
                    when you are coding your CTAs. We should be marking up these controls correctly
                    so screen-reader users know in advance what will happen when they interact with them.
                </li>

            </ul>

        </aside>



        <h1>Accessible Button Demo</h1>

        <p>This page shows different ways a button can be marked up to see how screen readers will describe them to
            users.</p>

        <h2>An HTML Button.</h2>

        <p>The most bulletproof way to make a button. It "just works" for everyone.</p>

        <div class="enable-example">
            <p>The following is a
                <code>&lt;button&gt;</code> tag with a
                <code>&lt;label&gt;</code> tag describing what it is for.
            </p>
            <div id="example1" class="button-container">
                <label for="html-button">If you are sure you want to give Facebook your data, push this:</label>
                <button id="html-button">
                    Submit
                </button>
            </div>
        </div>

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
                    "label": "Create markup",
                    "highlight": "%OPENCLOSECONTENTTAG%button",
                    "notes": "So straightforward.  Why would you want to use an ARIA button?"
                },
                {
                    "label": "Use an optional label",
                    "highlight": "for",
                    "notes": "Labels can be used to give appropriate context. Make sure you connect it to the button using the <strong>for</strong> attribute."
                }
            ]
        }
        </script>




        <h2>A link with the role of button</h2>

        <p>
            I can't tell you how many times I have seen buttons marked up as links on a project.
            When the project is an older one, and it would take a long time to refactor the existing
            functionality to change the "links that are actually buttons" to <code>&lt;button&gt;</code>
            tags, it makes sense to add the ARIA <code>role="button"</code> to the existing
            <code>&lt;a&gt;</code>. If you decide to do this, you should first review all the steps below
            and see what would be more work: refactoring the code to use real HTML buttons, or to add the extra
            JS to the codebase to make the "faux buttons" accessible.
        </p>

        <div id="example3" class="button-container enable-example">
            <label id="link-button-label">If you are sure you want to give Facebook your data, push this:</label>
            <a class="aria-button" aria-describedby="link-button-label" href="#" role="button">
                Submit
            </a>
        </div>

        <?php includeShowcode("example3")?>
        <script type="application/json" id="example3-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
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
                    "notes": "Labels can be used to give appropriate context. Make sure you connect it to the button using the <strong>for</strong> attribute."
                }
            ]
        }
        </script>

        <h2>A DIV with a role of button</h2>
        <p>
            There have been a few projects (usually, in my experience, in ones done in React and Angular for some
            reason) where I have seen
            developers use <code>&lt;div&gt;</code> tags to make buttons.
        </p>

        <p>
            This hurts my brain. It goes against the ideas of semantic HTML and it makes Tim Berners-Lee cry.
            Please don't be someone who does this.
        </p>

        <p>
            If you have an existing project that has code built this way, read the steps below and
            determine if it would be less work to do this instead of using real HTML <code>&lt;button&gt;</code> tags.
        </p>

        <div id="example2" class="button-container enable-example">
            <label id="div-button-label">If you are sure you want to give Facebook your data, push this:</label>
            <div class="aria-button" aria-describedby="div-button-label" role="button" tabindex="0">
                Submit
            </div>
        </div>

        <?php includeShowcode("example2")?>

        <script type="application/json" id="example2-props">
        {
            "replaceHTMLRules": {},
            "steps": [{
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
                    "highlight": "%JS% ariaButtonExample ||| document.addEventListener[^;]*;",
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
                    "notes": "Labels can be used to give appropriate context. Make sure you connect it to the button using the <strong>for</strong> attribute."
                }
            ]
        }
        </script>


    </main>

    <script>
    var ariaButtonExample = new function() {

        const activate = (e) => {
            const {
                target
            } = e;
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

    var htmlButtonExample = new function() {

        const activate = (e) => {
            const {
                target
            } = e;
            if (target.tagName === 'BUTTON' && target.closest('main')) {
                alert('this HTML button has been triggered');
            }
        }

        document.addEventListener('click', activate);
    }
    </script>
    <?php include "includes/example-footer.php"?>
</body>

</html>