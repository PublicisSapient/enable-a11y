<h3 id="npm-instructions" tabindex="-1">Installation Instructions</h3>

<p>You can load this JavaScript library into your application in serveral ways:

<ul>
  <li>as an <a href="https://webpack.js.org/api/module-methods/#es6-recommended">ES6 module using Webpack</a>.</li>
  <li>as a <a href="https://webpack.js.org/api/module-methods/#commonjs">CommonJS module using <code>require()</code> and Webpack</a>.</li>
  <li>as a <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules">native ES6 module within the
      browser</a>.</li>
  <?php
    if (!$isPolyfill) {
  ?>
  <li>as an old-school ES4/JavaScript library.</li>
  <?php
    }
  ?>
</ul>

<?php
  if ($isPolyfill) {
?>
<p>
  <strong>Note: Unlike most of the other Enable Javascript modules, you cannot load this one as an old-school ES4
    Javascript library.</strong>
  This is because it tests for browser features (in this case, the <code>&lt;dialog&gt;</code> tag) and if the browser
  doesn't support it, load the polyfill using<a
    href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/import#dynamic_import"> the ES6
    <code>import()</code> function</a>.
</p>
<?php
  } else {
?>

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

<?php
  }
?>

<?php 
  if ($bemPrefix != '') {
?>
<h4>Important Note On The CSS Classes Used In This Module:</h4>

<p><strong>This module requires specific CSS class names to be used in order it to work correctly.</strong>
These CSS classes begin with <code><?= $bemPrefix ?>__</code>.  Please see the documentation above to see where these CSS classes are inserted.

<?php
  } else if ($bemPrefix === true || $bemPrefix === false) {
?>

<div class="jest-error">We forgot to add the $bemPrefix variable on the function call to includeNPMInstructions()</div>

<?php
  }
?>

<h4>Using NPM/Webpack to load ES6 Modules:</h4>

<ol>
  <li>
    <a href="npm.php">Install the <code>enable-a11y</code> NPM project</a>.</li>
    
  <li>
    Edit your webpack.config.json file to resolve the <code>~</code> modifier by adding the following:

    <?php includeShowcodeStaticBegin() ?>
module.exports = {

  ... 

  resolve: {
    extensions: ['.js', '.jsx', '.scss', '.css', '*.html'],
    modules: [
      path.resolve('./src/js'),
      path.resolve('./node_modules')
    ],
    alias: {
      '~enable-a11y': path.resolve(__dirname, 'node_modules/enable-a11y')
<?php if (array_key_exists('needsGlider', $other)) { ?>
      ,'~glider-js': path.resolve(__dirname, 'node_modules/glider-js'),
      '~glider-js/glider.js': path.resolve(__dirname, 'node_modules/glider-js/glider')
<?php } ?> 
<?php if (array_key_exists('needsAccessibilityLib', $other)) { ?>
      ,'../enable-libs/accessibility-js-routines/dist/accessibility.module.js': path.resolve(__dirname, 'node_modules/accessibility-js-routines/dist/accessibility.module')
<?php } ?>
<?php if (array_key_exists('needsAblePlayerLibs', $other)) { ?>
      ,'../../libs/jquery/dist/jquery.min.js': path.resolve(__dirname, 'node_modules/jquery/src/jquery'),
      '../libs/ableplayer/thirdparty/js.cookie.js': path.resolve(__dirname, 'node_modules/js-cookie/dist/js.cookie')
<?php } ?>
    },

    ...
  },

  ...

}
<?php includeShowcodeStaticEnd() ?>
  </li>
  <li>
    You can use the module like this:

    <?php includeShowcodeStaticBegin() ?>
// import the JS module
import <?= $moduleVar ?> from '~enable-a11y/js/modules/<?= $moduleName ?>';
<?= $other["otherImports"] ?? '' ?>
<?php
  if (!($other["noCSS"] ?? false)) {
?>

// import the CSS for the module
import '~enable-a11y/css/<?= $moduleName ?>';
<?php
  }
  if (!$noInit) {
?> 
// How to initialize the <?= $moduleVar ?> library
<?= $moduleVar ?>.init();
<?php
  } else {
?>
// There is no .init() function to call.
<?php
  }
?>

<?php
  if (isset($doesHaveAddMethod)) {
?>
// If you are adding a new instance of this component after page load, 
// then do the following (where el is the DOM node of the newly created 
// element, which contains the CSS class <?= $doesHaveAddMethod ?>):
el.add();
<?php
  }
?>

<?php 
  if ($willWorkAfterPageLoad) {
?>
// Note that this component will work with DOM elements coded like
// the examples above added after page load.  There is no need to call
// an .add() method, like we do with the Enable combobox component.
<?php
  }
?>

<?= $other["otherSampleCode"] ?? '' ?>
    <?php includeShowcodeStaticEnd() ?>
    <?= $other["es6Notes"] ?? '' ?>
  </li>

<?php
  if (!($other["noCSS"] ?? false)) {
?>
  <li>
    Alternatively, if you are using LESS you can include the styles in your project's CSS using:

    <?php includeShowcodeStaticBegin() ?>
@import '~enable-a11y/css/<?= $moduleName ?>';
    <?php includeShowcodeStaticEnd() ?>

    (If you are using it in your CSS, you will have to add the <code>.css</code> suffix)
  </li>
<?php
  }
?>
</ol>

<h4>Using NPM/Webpack to Load Modules Using CommonJS Syntax</h4>

<ol>
<li>
    <a href="npm.php">Install the <code>enable-a11y</code> NPM project</a>.
  </li>
  <li>
    You can import the module using require like this:

<?php includeShowcodeStaticBegin() ?>
var <?= $moduleVar ?> = require('enable-a11y/<?= $moduleName ?>').default; 

...

<?= $moduleVar ?>.init();
<?php includeShowcodeStaticEnd() ?>
    </li>
    <li>You will have to include the CSS as well in your project's CSS using:

<?php includeShowcodeStaticBegin() ?>
@import '~enable-a11y/css/<?= $moduleName ?>';
<?php includeShowcodeStaticEnd() ?>
    </li>
    </ol>

<h4>Using ES6 modules natively.</h4>

<p>
  This is the method that this page you are reading now loads the scripts.
</p>

<ol>
  <li>
    Grab the source by either <a href="npm.php">using NPM</a>, <a
      href="https://github.com/PublicisSapient/enable-a11y/archive/refs/heads/master.zip">grabbing a ZIP file</a> or <a
      href="https://github.com/PublicisSapient/enable-a11y">cloning the enable source code</a> from github.
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
    Load the CSS in the head of you document:

    <?php includeShowcodeStaticBegin() ?>
&lt;html&gt;
  &lt;head&gt;

    ...

    &lt;link rel="stylesheet" href="path-to/css/<?= $moduleName ?>.css" &gt;

    ...
    
  &lt;/head&gt;
  &lt;body&gt;
    ...
  &lt;/body&gt;
&lt;/html&gt;

  <?php includeShowcodeStaticEnd() ?>
  <li>
    Load your scripts using:

    <?php includeShowcodeStaticBegin() ?>
&lt;script type="module"&gt;
    import <?= $moduleVar ?> from "path-to/<?= $moduleName ?>.js" 

    <?= $moduleVar ?>.init();
&lt;/script&gt;
    <?php includeShowcodeStaticEnd() ?>
</ol>

<?php
  if (!$isPolyfill) {
?>
<h4>Using ES4</h4>

Just do the same as the ES6 method, except you should get the JavaScript files from the <code>js/modules/es4</code>
directory instead of the <code>js/modules/</code>:

<?php includeShowcodeStaticBegin() ?>
&lt;script src="path-to/es4/<?= $moduleName ?>.js"&gt;&lt;/script&gt;
<?php includeShowcodeStaticEnd() ?>

<?php
  }
?>



<p>Hello: <?= $other["needsGlider"] ?></p>