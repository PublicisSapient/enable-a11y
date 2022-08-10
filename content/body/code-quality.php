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

<h2>Using Axe-core and pa11y for Accessibility Linting</h2>

<p>
  Enable uses both Deque Labs' <a href="https://github.com/dequelabs/axe-core-npm/tree/develop/packages/cli">@axe-core/cli</a> as well as <a href="https://www.npmjs.com/package/pa11y">Pa11y</a> to do accessibility linting.  Why two?  Both are very good tools, but they don't test for the same things, and as Craig Abbott states in this <a href="https://www.craigabbott.co.uk/blog/axe-core-vs-pa11y">excellent article that compares axe-core and pa11y</a>, it's hard to compare the two.  So why not just use both?
</p>

<p>
  The problem with using axe-core compared to pa11y is that axe-core requires <a href="https://chromedriver.chromium.org/">Chromedriver</a> in order to work (axe-core will run pages in a headless version of Chrome to do ensure the accessibility markup works, including any JavaScript generated markup).  I have personally had problems with Chromedriver updates (<a href="https://github.com/dequelabs/axe-cli/issues/103">here is one of the issues I had in the past</a>).  Pa11y, on the other hand, uses Puppeteer to launch Chrome and do its tests.  You can read
  about <a href="https://www.testim.io/blog/puppeteer-vs-selenium/">how these two technologies differ</a>, but from my experience, it seems
  Chromedriver updates are more likely to break things more often than Puppeteer updates.  You have been warned.
</p>

<p>
  Both tools go through all the Enable pages to check to see if colour contrast is right, alt attributes are set, ARIA is marked up correctly, and so on.  As axe-core explicitly states after execution, automated testing can only catch from 20% to 50% of accessibility issues.  Is there any way to improve upon that?
</p>


<h2>Unit Testing</h2>

<p>
  Unit testing is the final tool in your automated testing toolkit that you should use in your project to ensure any accessibility feature
  you have just implemented stays within the project.  For example, if you create a custom <a href="http://localhost:8888/listbox.php#aria-listbox-example--heading">accessible listbox dropdown</a>, you want to make sure that when keyboard users tab into the component and use the arrow keys that they can change the selected listbox value.
</p>

<p>
  Enable currently is testing out using <a href="https://jestjs.io/">Jest</a> with <a href="https://github.com/puppeteer/puppeteer">Puppeteer</a> to do unit tests.  These tests haven't been released to the public yet because we haven't finished our testing, and we want to ensure the unit test advice we give are a good model for developers to use in their own projects.  In the meantime, <a href="https://www.24a11y.com/2017/writing-automated-tests-accessibility/">Writing Automated Tests for Accessibility</a> by <a href="https://www.deque.com/blog/author/marcy-sutton/">Marcie Sutton</a> and <a href="https://medium.com/walkme-engineering/web-accessibility-testing-d499a7f7a032">Web Accessibility Testing</a> by <a href="https://www.kfirzuberi.com/">Kfir Zuberi</a> are great places to start (it's where we started).
  </p>




