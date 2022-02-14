<h3 id="npm-instructions" tabindex="-1">Installation Instructions</h3>

<p>You can load this JavaScript library into your application in serveral ways:

<ul>
  <li>as an ES6 module using <a href="https://webpack.js.org/concepts/modules/">Webpack</a>.</li>
  <li>as a <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules">native ES6 module within the
      browser</a>.</li>
  <li>as an old-school ES4/JavaScript library.</li>
</ul>

<p>If you haven't done so already, choosing which you should use is obviously a major architectural decision.
  Here are a few articles that will help you decide:
</p>

<ul>
  <li><a href="https://gist.github.com/jkrems">Jan Olaf Krems</a> gives a great overview of the
    <a href="https://gist.github.com/jkrems/b14894e0b8efde10aa10a28c652d3541">JavaScript File Format Differences</a>
  </li>
  <li><a href="https://ecmascript.engineer/">Joe Honton</a> discusses that <a
      href="https://betterprogramming.pub/2020-004-the-rollout-of-modules-is-complete-d25f04870284">With ES Modules and
      HTTP/2 You May Not Need Webpack Anymore</a>
  <li>Stack Overflow has a really good thread about <a
      href="https://stackoverflow.com/questions/57448588/webpack-vs-es6-modules">Webpack vs ES6 modules</a> as well.
  </li>
</ul>



<h4>Using NPM/Webpack to load ES6 Modules:</h4>

<ol>
  <li>
    <a href="info/npm.php">Install the <code>enable-a11y</code> NPM project</a>. Developers who are using webpack should
    know <a href="info/webpack.php">how to configure webpack to import the enable modules correctly</a>.
  </li>
  <li>
    You can use the module like this:

    <code class="showcode--no-js">
import enableListbox from '~enable-a11y/js/modules/<?= $moduleName ?>';
@import '~enable-a11y/css/<?= $moduleName ?>';

...

// How to initialize the enableListbox library
enableListbox.init();

...

        </code>
  </li>
  <li>
    Alternatively, you can include the styles in your project's CSS using:

    <code class="showcode--no-js">
@import '~enable-a11y/css/<?= $moduleName ?>';
        </code>
  </li>
</ol>

<h4>Using ES6 modules natively.</h4>

<p>
  This is the method that this page you are reading now loads the scripts.
</p>

<ol>
  <li>
    Grab the source by either <a href="info/npm.php">using NPM</a>, <a
      href="https://github.com/zoltan-dulac/enable-a11y/archive/refs/heads/master.zip">grabbing a ZIP file</a> or <a
      href="https://github.com/zoltan-dulac/enable-a11y">cloning the enable source code</a> from github.
  </li>
  <li>
    If you want to load the module as a native ES6 module, copy <code>js/modules/<?= $moduleName ?>.js</code>,
    <?php
       foreach ($supportingModuleNames as $name) {
         echo '<code>' . $name . '</code>';
       }
    ?> and <code>css/<?= $moduleName ?>.css</code> from the repo and put
    them
    in the appropriate directories in your project (all JS files must be in the same directory).
  </li>
  <li>
    Load your scripts using:

    <code class="showcode--no-js">
&lt;script type="module"&gt;
    import enableListbox from "path-to/<?= $moduleName ?>.js" 

    enableListbox.init();
&lt;/script&gt;
        </code>
</ol>

<h4>Using ES4</h4>

Just do the same as the ES6 method, except you should get the JavaScript files from the <code>js/modules/es4</code>
directory instead of the <code>js/modules/</code>