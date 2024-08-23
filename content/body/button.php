
    <!-- <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>It is always better to use a real HTML <code>button</code> tag than a <code>div</code> or
                    <code>a</code> tag with a <code>role="button"</code>. This is especially noticeable when using
                    a <code>label</code> with the <code>button</code>, which reads differently in some screen readers
                    then when using an <code>aria-describedby</code> to give it supplementary information.
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
                    so screen reader users know in advance what will happen when they interact with them.
                </li>

            </ul>

        </aside> -->

        <p>
            <strong>A button is an interactive element that triggers an action on a webpage or submits a form.</strong>
            The <code>&lt;button&gt;</code> tag has been available for a long time and developers should utilize it for this specific purpose.
        </p>


        <p>
            This may seem obvious to many developers.
            Unfortunately, there is a lot of code out there that uses <code>&lt;a&gt;</code> tags
            to do the work of a <code>&lt;button&gt;</code>.
            This is problematic from an accessibility standpoint because those relying on screen readers may mistakenly assume that clicking it 
            will redirect them to another page.  When I review code like this, it makes me sad.  If you do this in a new project,
            think about how sad I will be, and change your ways.
        </p>

        <p>
            This page covers how to make buttons in three ways.  Review all scenarios and choose the one that fits your requirements the best, but make sure to take into account the warnings provided before making your final decision.
        </p>


        <h2>An HTML Button.</h2>
        <?php includeStats(["isForNewBuilds" => true]); ?>


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

        <?php includeShowcode("example1"); ?>

        <script type="application/json" id="example1-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Create markup",
                    "highlight": "%OPENCLOSECONTENTTAG%button",
                    "notes": "So straightforward.  Why would you want to use an ARIA button?"
                },
                {
                    "label": "Use an optional label",
                    "highlight": "for",
                    "notes": "Labels can be used to give appropriate context. Make sure you connect it to the button by using the <strong>for</strong> attribute."
                }
            ]
        }
        </script>





        <h2>A link with the role of button</h2>
        <?php includeStats([
            "isForNewBuilds" => false,
        ]); ?>
        <p>
            I can't tell you how many times I have seen buttons incorrectly marked up as links on a project.
            When dealing with older projects where it would be time-consuming to refactor the existing functionality and convert these "pseudo-buttons" into proper <code>&lt;button&gt;</code> tags, it might be more practical to add the ARIA <code>role="button"</code> to the existing <code>&lt;a&gt;</code> tags. If you decide to do this, you should first review all the steps below
            and see what would entail more work: refactoring the code to use actual HTML buttons or adding the extra
            JavaScript to the codebase to ensure the "imitation buttons" are accessible.
        </p>

        <div id="example3" class="button-container enable-example">
            <label id="link-button-label">If you are sure you want to give Facebook your data, push this:</label>
            <a class="aria-button" aria-describedby="link-button-label" href="#" role="button">
                Submit
            </a>
        </div>

        <?php includeShowcode("example3"); ?>
        <script type="application/json" id="example3-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Put 'button' role on links that are really fake buttons",
                    "highlight": "role=\"button\"",
                    "notes": "This is to ensure screen readers report them as buttons."
                },
                {
                    "label": "Make sure you make a dummy href on the link",
                    "highlight": "href",
                    "notes": "This is to ensure they are keyboard accessible and you don't need JavaScript to trigger them."
                },
                {
                    "label": "Create JavaScript that should be triggered when pressed",
                    "highlight": "%FILE% js/demos/aria-button-example.js ~  (ariaButtonExample|document.addEventListener\\('click[^;]*;)",
                    "notes": "When you change an <code>a</code> tag to a <code>button</code>, you don't need the <code>keyup</code> event.  This is because the <code>click</code> event will fire when the Enter key is pressed.  You only need to use the <code>keyup</code> event in the scenario given in the next example on this page."
                },
                {
                    "label": "Create CSS to style the link like a button",
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
        <?php includeStats([
            "doNot" => true,
        ]); ?>
        <p>
            There have been a few projects, particularly ones developed using React and Angular for some reason, where I have observed developers creating buttons using <code>&lt;div&gt;</code> tags.    
        </p>

        <p>
            This hurts my brain. It goes against the ideas of semantic HTML and it makes Tim Berners-Lee cry.
            Do you want to make the Father of the Web cry?  What kind of monster are you?
        </p>

        <p>
            If you have an existing project that has code built this way, read the steps below and
            determine if it would be less work to do the following instead of using real HTML <code>&lt;button&gt;</code> tags.
        </p>

        <div id="example2" class="button-container enable-example">
            <label id="div-button-label">If you are sure you want to give Facebook your data, push this:</label>
            <div class="aria-button" aria-describedby="div-button-label" role="button" tabindex="0">
                Submit
            </div>
        </div>

        <?php includeShowcode("example2"); ?>

        <script type="application/json" id="example2-props">
        {
            "replaceHtmlRules": {},
            "steps": [{
                    "label": "Put the 'button' role on fake buttons",
                    "highlight": "role=\"button\"",
                    "notes": "This is to ensure screen readers report them as buttons."
                },
                {
                    "label": "Apply tabindex=\"0\" on the fake buttons",
                    "highlight": "tabindex",
                    "notes": "This is to ensure they are keyboard accessible."
                },
                {
                    "label": "Create JavaScript that should be triggered when pressed",
                    "highlight": "%FILE% js/demos/aria-button-example.js ~ document.addEventListener[^;]*;",
                    "notes": "You must ensure that you include the 'keyup' event as well as the 'click' event. This is due to the fact that the 'click' event isn't triggered by keyboard actions for those DOM elements that aren't inherently accessible via keyboard as a standard feature."
                },
                {
                    "label": "Create CSS to style the div like a button",
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




        <h2>Disabled HTML Button.</h2>

        <p>There are two ways of making a button disabled.</p>

        <ol>
            <li>Use the <code>disabled</code> attribute. This prevents click events
                from being fired. It also removes the button
                from the keyboard tabbing order, which makes it harder for screen reader users to know that the disabled button even exists. 
            </li>
            <li>
                Use the <code>aria-disabled="true"</code> attribute. This doesn't remove the button
                from the keyboard tabbing order. It also doesn't prevent click events
                from being fired <em>except for Chrome on Google Android with Talkback on</em>. (Thanks to Noel
                Tibbles for pointing this out).
            </li>
        </ol>

        <p>The ideal solution would be to use the <code>aria-disabled="true"</code> attribute while using JavaScript to prevent the click event from performing an action. This allows the button to be accessible by screen reader users, while still notifying them that it is disabled.</p>

        <div class="enable-example">
            <p>The following button is disabled with the <code>disabled</code> attribute
            </p>
            <div id="html-disabled" class="button-container">
                <label for="html-disabled-button">If you are sure you want to give Facebook your data, push
                    this:</label>
                <button disabled id="html-disabled-button">
                    Submit
                </button>
            </div>

            <p>
                The following button is disabled with aria-disabled="true"</p>

            <div id="aria-disabled" class="button-container">
                <label for="aria-disabled-button">If you are sure you want to give Facebook your data, push
                    this:</label>
                <button aria-disabled="true" id="aria-disabled-button">
                    Submit
                </button>
            </div>

            <p>
                The following button is disabled with aria-disabled="true" and JavaScript</p>

            <div id="aria-js-disabled" class="button-container">
                <label for="aria-js-disabled-button">If you are sure you want to give Facebook your data, push
                    this:</label>
                <button aria-disabled="true" id="aria-js-disabled-button">
                    Submit
                </button>
            </div>

        </div>