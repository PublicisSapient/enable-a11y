<figure class="enable-quote">
  <p><strong>Thus spake the Master Programmer:</strong><p>

  <p>Though a program be but three lines long, someday it will have to be maintained.</p>

  <figcaption>
    &mdash; Geoffrey James, <a href="https://www.mit.edu/~xela/tao.html"><cite>The Tao of Programming</cite></a>
  </figcaption>
</figure>


<p>Every project that is more than a few lines long should implement automated testing to ensure code quality. 
  This is especially true when it comes to the accessibility features.  When a developer adds accessibility features
  to code, another developer may want to change that code months later and, in doing so, may accidentally remove those accessibility
  features.</p>

<p>In order to prevent this from happening in Enable, we have implemented the following automated testing frameworks 
  inside of Enable:</p>


<h2>v.Nu</h2>

<p>
  Before testing anything else, it is important that the HTML of the project you are working on is valid. If a developer
  produces invalid HTML, a browser's accessibility API may not have the right information for screen readers and other assistive technology
  to work with the page correctly.
</p>

<p>
  Enable uses <a href="https://validator.github.io/validator/">v.Nu</a> to check the HTML of all the pages within Enable.  It does this by:
</p>

<ol>
  <li>Generating all the HTML of all the PHP pages on the site.</li>
  <li>Separating pages that initialize instantly (let's call this group "A") with ones that need a bit more processing time due to JavaScript use (let's call this group "B").</li>
  <li>Parsing the group A pages with v.Nu, using one call to v.Nu (since each call to the v.Nu command line tool would be a separate call  to Java, which is expensive).</li>
  <li>Parsing the group B pages with v.Nu (each page requires a separate call to v.Nu, and thus Java).</li>
</ol>

<p>
  Note that v.Nu requires <a href="https://java.sun.com">Java</a> in order to run.  If this is a concern on your project, you may want to 
  try using  <a href="https://html-validate.org/usage/">this Node based HTML validator</a> instead (I have not used this yet, so your mileage may vary).
</p>

<h2>Using Axe-core and Pa11y CI for Accessibility Linting</h2>

<p>
  Enable uses both Deque Labs' <a href="https://github.com/dequelabs/axe-core-npm/tree/develop/packages/cli">@axe-core/cli</a> as well as <a href="https://github.com/pa11y/pa11y-ci">Pa11y CI</a> to do accessibility linting.  Why two?  Both are very good tools, but they don't test for the same things, and as Craig Abbott states in this <a href="https://www.craigabbott.co.uk/blog/axe-core-vs-pa11y">excellent article that compares axe-core and pa11y</a>, it's hard to compare the two.  So why not just use both?
</p>

<p>
  The problem with using axe-core compared to Pa11y-CI is that axe-core requires <a href="https://chromedriver.chromium.org/">Chromedriver</a> in order to work (axe-core will run pages in a headless version of Chrome to do ensure the accessibility markup works, including any JavaScript generated markup).  I have personally had problems with Chromedriver updates (<a href="https://github.com/dequelabs/axe-cli/issues/103">here is one of the issues I had in the past</a>).  Pa11y, on the other hand, uses Puppeteer to launch Chrome and do its tests.  You can read
  about <a href="https://www.testim.io/blog/puppeteer-vs-selenium/">how these two technologies differ</a>, but from my experience, it seems
  Chromedriver updates are more likely to break things more often than Puppeteer updates.  You have been warned.
</p>

<p>
  Both tools go through all the Enable pages to check to see if colour contrast is right, alt attributes are set, ARIA is marked up correctly, and so on.  As axe-core explicitly states after execution, automated testing can only catch from 20% to 50% of accessibility issues.  Is there any way to improve upon that?
</p>


<h2>Unit Testing</h2>

<p>
  Unit testing is the final tool in your automated testing toolkit that you should use in your project to ensure any accessibility feature
  you have just implemented stays within the project.  For example, if you create a custom <a href="listbox.php#aria-listbox-example--heading">accessible listbox dropdown</a>, you want to make sure that when keyboard users tab into the component and use the arrow keys that they can change the selected listbox value.
</p>

<p>
  Enable currently uses <a href="https://jestjs.io/">Jest</a> with <a href="https://github.com/puppeteer/puppeteer">Puppeteer</a> to do unit tests.  Usually, each test involves:
</p>  

<ol>
  <li>Loading a page that contains component examples</li>
  <li>Querying the DOM on the page to make sure the components in question are coded correctly.</li>
  <li>Querying the current CSS style in the components to make sure it captures the visual requirements
    (and/or screen reader contents, when using visually-hidden CSS generated content)</li>
  <li>If needed, simulate a keyboard user manipulating the components to ensure the user-experience works correctly.</li>
  <li>After the component is manipulated, go through steps 2-5 again, if necessary.</li>
</ol>

<h3>A Simple Example</h3>

<p>Let's look at a simple example that just involves just steps 1 through 3. If you look at the page for <a href="exposing-style-info-to-screen-readers.php">Exposing Style Information To Screen Readers</a>, we use visually-hidden CSS generated content on the <code>ins</code>, <code>del</code> and <code>mark</code> tags. We want to ensure that a new developer that contributes code to Enable never removes this CSS by accident, so we create a jest test file, <code>exposing-style-info-to-screen-readers.test.js</code>, to ensure we can test that this CSS is in these example.  Let's walk through this file to show how it works.

<template id="test-code-walkthrough" data-showcode-is-js="true">
<!--
<?php include("../js/test/exposing-style-info-to-screen-readers.test.js"); ?>
-->
</template>

<?php includeShowcode("test-code-walkthrough", "", "", "", true, 4)?>
<script type="application/json" id="test-code-walkthrough-props">
{
  "replaceHtmlRules": {
  },
  "steps": [
  {
    "label": "Import Test Config",
    "highlight": "import\\sconfig[^;]*;",
    "notes": "This imports the configuration settings all the tests use."
  },
  {
    "label": "Create a describe for the set of tests you are creating.",
    "highlight": "describe[\\s\\S]*\\}\\);",
    "notes": ""
  },
  {
    "label": "Create a test for each tag to be tested (ins, del and mark)",
    "highlight": "\\s+it\\([\\s\\S]*?>\\s\\s\\}\\);",
    "notes": "Note the second paramater of the <code>it()</code> function is an <strong>asyncronous</code> function"
  },
  {
    "label": "Each test must load the page",
    "highlight": "await\\spage.goto[^;]*;",
    "notes": "Note that the <code>BASE_URL</code> is grabbed from the <code>config</code> from step 1"
  },
  {
    "label": "Each test should wait until a partical part of the page is available to test",
    "highlight": "await\\spage.waitForSelector[^;]*;",
    "notes": "Note that the selector used should be unique enough so your know you are hitting the right area of the page."
  },
  {
    "label": "Query the DOM using puppeteer's page.evaluate method.",
    "highlight": "\\s*domInfo\\s=[\\s\\S]*?>\\s\\s\\s\\s\\}\\);",
    "notes": "Although <a href=\"https://jestjs.io/docs/tutorial-jquery\">Jest can do basic DOM manipulation and testing</a>, it doesn't have good enough support for ARIA, <a href=\"https://developer.mozilla.org/en-US/docs/Web/API/Window/getComputedStyle\">window.getCurrentStyle()</a> and other web technologies that will allow us to find out if a web component is exposing the right information to browsers and screen readers to ensure our work is accessible.  Using <a href=\"https://pptr.dev/api/puppeteer.page.evaluate/\">Puppeteer's <code>page.evaluate()</code> method</a> ensures that to use these APIs and more to fully test our work in a real (headless) web browser. The information we need to test on is returned as an object, which is passed to the variable <code>domInfo</code>."
  },
  {
    "label": "Use jest's expect method to find if the code is doing things right.",
    "highlight": "expect\\([^;]*;",
    "notes": "We take the information given to <code>domInfo</code> in the previous step and run tests on it using jest's <code>expect()</code> method."
  }
]}
</script>

  
<p>
  If you want to do some further reading, we recommend <a href="https://www.24a11y.com/2017/writing-automated-tests-accessibility/">Writing Automated Tests for Accessibility</a> by <a href="https://www.deque.com/blog/author/marcy-sutton/">Marcie Sutton</a> and <a href="https://medium.com/walkme-engineering/web-accessibility-testing-d499a7f7a032">Web Accessibility Testing</a> by <a href="https://www.kfirzuberi.com/">Kfir Zuberi</a> are great places to start (it's where we started).
  </p>




