<figure class="enable-quote">
  <p><strong>Thus spake the Master Programmer:</strong>
  <p>

  <p>Though a program be but three lines long, someday it will have to be maintained.</p>

  <figcaption>
    &mdash; Geoffrey James, <a href="https://www.mit.edu/~xela/tao.html"><cite>The Tao of Programming</cite></a>
  </figcaption>
</figure>


<p>Every project that is more than a few lines long should implement automated testing to ensure code quality.
  This is especially true when it comes to the accessibility features. When a developer adds accessibility features
  to code, another developer may want to change that code months later and, in doing so, may accidentally remove those
  accessibility
  features.</p>

<p>In order to prevent this from happening in Enable, we have implemented the following automated testing frameworks
  inside of Enable:</p>


<h2>v.Nu</h2>

<p>
  Before testing anything else, it is important that the HTML of the project you are working on is valid. If a developer
  produces invalid HTML, a browser's accessibility API may not have the right information for screen readers and other
  assistive technology
  to work with the page correctly.
</p>

<p>
  Enable uses <a href="https://validator.github.io/validator/">v.Nu</a> to check the HTML of all the pages within
  Enable. It does this by:
</p>

<ol>
  <li>Generating all the HTML of all the PHP pages on the site.</li>
  <li>Separating pages that initialize instantly (let's call this group "A") with ones that need a bit more processing
    time due to JavaScript use (let's call this group "B").</li>
  <li>Parsing the group A pages with v.Nu, using one call to v.Nu (since each call to the v.Nu command line tool would
    be a separate call to Java, which is expensive).</li>
  <li>Parsing the group B pages with v.Nu (each page requires a separate call to v.Nu, and thus Java).</li>
</ol>

<p>
  Note that v.Nu requires <a href="https://java.sun.com">Java</a> in order to run. If this is a concern on your project,
  you may want to
  try using <a href="https://html-validate.org/usage/">this Node based HTML validator</a> instead (I have not used this
  yet, so your mileage may vary).
</p>

<h2>Using Axe-core and Pa11y CI for Accessibility Linting</h2>

<p>
  Enable uses both Deque Labs' <a
    href="https://github.com/dequelabs/axe-core-npm/tree/develop/packages/cli">@axe-core/cli</a> as well as <a
    href="https://github.com/pa11y/pa11y-ci">Pa11y CI</a> to do accessibility linting. Why two? Both are very good
  tools, but they don't test for the same things, and as Craig Abbott states in this <a
    href="https://www.craigabbott.co.uk/blog/axe-core-vs-pa11y">excellent article that compares axe-core and pa11y</a>,
  it's hard to compare the two. So why not just use both?
</p>

<p>
  The problem with using axe-core compared to Pa11y-CI is that axe-core requires <a
    href="https://chromedriver.chromium.org/">Chromedriver</a> in order to work (axe-core will run pages in a headless
  version of Chrome to do ensure the accessibility markup works, including any JavaScript generated markup). I have
  personally had problems with Chromedriver updates (<a href="https://github.com/dequelabs/axe-cli/issues/103">here is
    one of the issues I had in the past</a>). Pa11y, on the other hand, uses Puppeteer to launch Chrome and do its
  tests. You can read
  about <a href="https://www.testim.io/blog/puppeteer-vs-selenium/">how these two technologies differ</a>, but from my
  experience, it seems
  Chromedriver updates are more likely to break things more often than Puppeteer updates. You have been warned.
</p>

<p>
  Both tools go through all the Enable pages to check to see if colour contrast is right, alt attributes are set, ARIA
  is marked up correctly, and so on. As axe-core explicitly states after execution, automated testing can only catch
  from 20% to 50% of accessibility issues. Is there any way to improve upon that?
</p>


<h2>Unit Testing</h2>

<p>
  Unit testing is the final tool in your automated testing toolkit that you should use in your project to ensure any
  accessibility feature
  you have just implemented stays within the project. For example, if you create a custom <a
    href="listbox.php#aria-listbox-example--heading">accessible listbox dropdown</a>, you want to make sure that when
  keyboard users tab into the component and use the arrow keys that they can change the selected listbox value.
</p>

<p>
  Enable currently uses <a href="https://jestjs.io/">Jest</a> with <a
    href="https://github.com/puppeteer/puppeteer">Puppeteer</a> to do unit tests. Usually, each test involves:
</p>

<ol>
  <li>Loading a page that contains component examples</li>
  <li>Querying the DOM on the page to make sure the components in question are coded correctly.</li>
  <li>Querying the current CSS style in the components to make sure it captures the visual requirements
    (and/or screen reader contents, when using visually-hidden CSS generated content)</li>
  <li>If needed, simulate a keyboard user manipulating the components to ensure the user-experience works correctly.
  </li>
  <li>After the component is manipulated, go through steps 2-5 again, if necessary.</li>
</ol>

<h3>Before we start</h3>

<p>
  Our unit testing examples use ES6 modules. In order to support ES6 Modules in Jest, you need to do the following
  commands inside your project:
</p>

<figure class="wide">
  <?php includeShowcode("npm-info", "", "", "", false)?>

  <figcaption>Figure 1. NPM commands to install in order to use ES6 Modules in Jest.</figcaption>
</figure>


<template id="npm-info">
  npm install @babel/preset-env
  npm install --save-dev @babel/plugin-transform-modules-commonjs
</template>

<p>
  You should also put the following lines in your <code>.babelrc</code>:
</p>

<figure class="wide">
  <?php includeShowcode("babelrc-info", "", "", "", false)?>

  <figcaption>Figure 2. What to put in .babelrc in order for Jest to transform the ES6 modules with babel.</figcaption>
</figure>

<template id="babelrc-info" data-showcode-is-js="true">{
  "env": {
    "test": {
      "plugins": ["@babel/plugin-transform-modules-commonjs"]
    }
  }
}
</template>

<h3>A Simple Example: Having Screenreaders Read Strikethrough Text</h3>

<p>Let's look at a simple example that just involves just steps 1 through 3. If you look at the page for <a
    href="exposing-style-info-to-screen-readers.php">Exposing Style Information To Screen Readers</a>, we use
  visually-hidden content inside of <code>mark</code> tags. We want to
  ensure that a new developer that contributes code to Enable never removes this <a href="screen-reader-only-text.php">screen reader only text</a> by accident, so we create a jest
  test file, <code>exposing-style-info-to-screen-readers.test.js</code>, to ensure we can test that this CSS is in these
  example. Let's walk through this file to show how it works.

  <template id="test-code-walkthrough" data-showcode-is-js="true">
    <!--
<?php include("../js/test/exposing-style-info-to-screen-readers.test.js"); ?>
-->
  </template>

  <?php includeShowcode("test-code-walkthrough", "", "", "", true, 4)?>
  <script type="application/json" id="test-code-walkthrough-props">
  {
    "replaceHtmlRules": {},
    "steps": [{
        "label": "Import Test Config",
        "highlight": "import\\sconfig[^;]*;",
        "notes": "This imports the configuration settings all the tests use.  Note that in order for jest to support ES Modules to import JavaScript libraries, you "
      },
      {
        "label": "Create a describe for the set of tests you are creating.",
        "highlight": "describe[\\s\\S]*\\}\\);",
        "notes": ""
      },
      {
        "label": "Create a test for each tag to be tested (ins, del and mark)",
        "highlight": "\\s+it\\([\\s\\S]*?>\\s\\s\\}\\);",
        "notes": "Note the second parameter of the <code>it()</code> function is an <strong>asynchronous</code> function"
      },
      {
        "label": "Each test must load the page",
        "highlight": "\\s*await\\spage.goto[^;]*;",
        "notes": "Note that the <code>BASE_URL</code> is grabbed from the <code>config</code> from step 1"
      },
      {
        "label": "Each test should wait until the part of the page you need is available to test",
        "highlight": "\\s*await\\spage.waitForSelector[^;]*;",
        "notes": "Note that the selector used should be unique enough so your know you are hitting the right area of the page."
      },
      {
        "label": "Query the DOM using puppeteer's page.evaluate method.",
        "highlight": "\\s*domInfo\\s=[\\s\\S]*?>\\s\\s\\s\\s\\}\\);",
        "notes": "<div>Although <a href=\"https://jestjs.io/docs/tutorial-jquery\">Jest can do basic DOM manipulation and testing</a>, it doesn't have good enough support for ARIA, <a href=\"https://developer.mozilla.org/en-US/docs/Web/API/Window/getComputedStyle\">window.getCurrentStyle()</a> and other web technologies that will allow us to find out if a web component is exposing the right information to browsers and screen readers to ensure our work is accessible.  Using <a href=\"https://pptr.dev/api/puppeteer.page.evaluate/\">Puppeteer's <code>page.evaluate()</code> method</a> ensures that to use these APIs and more to fully test our work in a real (headless) web browser. The information we need to test on is returned as an object, which is passed to the variable <code>domInfo</code>.</div>"
      },
      {
        "label": "Use jest's expect method to find if the code is doing things right.",
        "highlight": "expect\\([^;]*;",
        "notes": "We take the information given to <code>domInfo</code> in the previous step and run tests on it using jest's <code>expect()</code> method."
      }
    ]
  }
  </script>

  <h3>A Simple Interactive Example: Switches</h3>

  <p>This example is used to test <a href="switch.php">Enable's switch component</a> to ensure that it is keyboard accessible and that the HTML structure includes all the necessary accessibility features (e.g. the <code>role="switch"</code>, a valid <code>aria-checked</code> attribute set, a proper label, etc.).  Please go through the code walkthrough below for more details.

<template id="switch-test-code-walkthrough" data-showcode-is-js="true">
    <!--
<?php include("../js/test/switch.test.js"); ?>
-->
  </template>

  <?php includeShowcode("switch-test-code-walkthrough", "", "", "", true, 4)?>
  <script type="application/json" id="switch-test-code-walkthrough-props">
  {
    "replaceHtmlRules": {},
    "steps": [{
        "label": "Import Test Config",
        "highlight": "import\\sconfig[^;]*;",
        "notes": "This imports the configuration settings all the tests use.  Note that in order for jest to support ES Modules to import JavaScript libraries, you "
      },
      {
        "label": "Create a describe for the set of tests you are creating.",
        "highlight": "describe[\\s\\S]*\\}\\);",
        "notes": ""
      },
      {
        "label": "Create a test use the it() function",
        "highlight": "\\s+it\\([\\s\\S]*?>\\s\\s\\}\\);",
        "notes": "Note the second paramater of the <code>it()</code> function is an <strong>asyncronous</code> function"
      },
      {
        "label": "Each test must load the page",
        "highlight": "\\s*await\\spage.goto[^;]*;",
        "notes": "Note that the <code>BASE_URL</code> is grabbed from the <code>config</code> from step 1"
      },
      {
        "label": "Each test should wait until the part of the page you need is available to test",
        "highlight": "\\s*await\\spage.waitForSelector[^;]*;",
        "notes": "Note that the selector used should be unique enough so your know you are hitting the right area of the page."
      },
      {
        "label": "Query the DOM using puppeteer's page.evaluate method.",
        "highlight": "\\s*domInfo\\s=[\\s\\S]*\\},\\si\\);",
        "notes": "<div>Although <a href=\"https://jestjs.io/docs/tutorial-jquery\">Jest can do basic DOM manipulation and testing</a>, it doesn't have good enough support for ARIA, <a href=\"https://developer.mozilla.org/en-US/docs/Web/API/Window/getComputedStyle\">window.getCurrentStyle()</a> and other web technologies that will allow us to find out if a web component is exposing the right information to browsers and screen readers to ensure our work is accessible.  Using <a href=\"https://pptr.dev/api/puppeteer.page.evaluate/\">Puppeteer's <code>page.evaluate()</code> method</a> ensures that to use these APIs and more to fully test our work in a real (headless) web browser. The information we need to test on is returned as an object, which is passed to the variable <code>domInfo</code>.</div>"
      },
      {
        "label": "Use jest's expect method to find if the code is doing things right.",
        "highlight": "expect\\([^;]*;",
        "notes": "We take the information given to <code>domInfo</code> in the previous step and run tests on it using jest's <code>expect()</code> method."
      },
      {
        "label": "Note the helper function to get the checked value of a switch",
        "highlight": "\\s*async\\sfunction\\sgetSwitchValue[\\s\\S]*end\\sgetSwitchValue\\(\\)"
      }
    ]
  }
  </script>

  <h3>A More Complex Example: Testing Focus States on Multiple Pages</h3>

  <p>This is an example of a test that ensures all interactive elements on all the pages within Enable have a focus state (in our case, using a CSS `outline`).
Note that we ignore <code>iframe</code>, <code>video</code> and <code>body</code> tags in this test because of the tests giving false negatives (which are actively looking into to fix)</p>

  <template id="test-code-walkthrough2" data-showcode-is-js="true">
    <!--
<?php include("../js/test/visibleFocusStates.test.js"); ?>
-->
  </template>

  <?php includeShowcode("test-code-walkthrough2", "", "", "", true, 4)?>
  <script type="application/json" id="test-code-walkthrough2-props">
  {
    "replaceHtmlRules": {},
    "steps": [{
        "label": "Import Test Config",
        "highlight": "import\\sconfig[^;]*;",
        "notes": "This imports the configuration settings all the tests use.  Note that in order for jest to support ES Modules to import JavaScript libraries, you "
      },
      {
        "label": "Create a describe for the set of tests you are creating.",
        "highlight": "describe[\\s\\S]*\\}\\);",
        "notes": ""
      },
      {
        "label": "Open up two browser instances when starting this test suite.",
        "highlight": "\\s\\sbeforeAll[^\\}]*\\}\\);",
        "notes": ""
      },
      {
        "label": "Close the two browsers when finishing this test suite.",
        "highlight": "\\s\\safterAll[^\\}]*\\}\\);",
        "notes": ""
      },
      {
        "label": "Define testPage() function.",
        "highlight": "\\s\\sasync\\sfunction\\stestPage[\\s\\S]*end\\stestPage\\(\\)",
        "notes": ""
      },
      {
        "label": "Have the appropriate browser window open the page to test",
        "highlight": "\\s\\s\\s\\sif\\s\\(isDesktop\\)([^\\}]*\\}){2}",
        "notes": ""
      },
      {
        "label": "Each test must load the page",
        "highlight": "\\s{4}await\\spage.goto[^;]*;",
        "notes": "Note that we want this test to run as soon as the browser is ready, so we tell page.goto to <code>waitUntil</code> the <code>domcontentloaded</code> event occurs on the page (i.e. when the browsers loads the HTML in the DOM)"
      },
      {
        "label": "Query the DOM using puppeteer's page.evaluate method.",
        "highlight": "\\s*domInfo\\s=[\\s\\S]*?>\\s\\s\\s\\s\\}\\);",
        "notes": "This <code>page.evaluate()</code> call test to see if the currently focused element has a focus ring. It also detects if it is a video or an iframe"
      },
      {
        "label": "Find the focused element",
        "highlight": "const\\s\\{\\sactiveElement\\s\\}\\s=\\sdocument;",
        "notes": ""
      },
      {
        "label": "Find the style of the focused element",
        "highlight": "\\s*const\\sstyle[\\s\\S]*=\\sstyle;",
        "notes": ""
      },
      {
        "label": "We have a special case for the input range element",
        "highlight": "\\s*\\/\\/\\sSpecial\\stests\\sfor\\srange\\selement[\\s\\S]*\\/\\/\\send\\sof\\sspecial\\stests.",
        "notes": ""
      },
      {
        "label": "We test to see if the focused element has a focus ring.",
        "highlight": "\\s*\\/\\/\\sIf\\sthis\\sis\\snot\\sa\\sskip\\slink[\\s\\S]*\\s{6}\\}",
        "notes": "Note we only log an issue if it is not a <code>body</code>, <code>iframe</code> or <code>video</code> tag, since these report false negatives."
      },
      {
        "label": "Run testPage() on all the pages on the site.",
        "highlight": "\\s\\s\\/\\/\\sThis\\sgoes\\sthrough[\\s\\S]*\\s\\s\\}",
        "notes": "Note that it is running testPage() twice &mdash; once for desktop and once for mobile."
      }
    ]
  }
  </script>

<p>
  If you want to do some further reading, we recommend <a
    href="https://www.24a11y.com/2017/writing-automated-tests-accessibility/">Writing Automated Tests for
    Accessibility</a> by <a href="https://www.deque.com/blog/author/marcy-sutton/">Marcie Sutton</a> and <a
    href="https://medium.com/walkme-engineering/web-accessibility-testing-d499a7f7a032">Web Accessibility Testing</a> by
  <a href="https://www.kfirzuberi.com/">Kfir Zuberi</a> are great places to start (it's where we started).
</p>