<!-- File not linked in the menu -->

<p>
  The following pages have modules that can be imported in your own projects via NPM:
</p>

<ul id="npm-list">
  <!-- This will be filled in via JS -->
</ul>

<h2>Webpack Setup Instructions</h2>

<p>Follow these steps to import these into your project:</p>

<ol>
  <li>
    <p>You will notice that the examples ask you to include the npm modules like this:</p>

  <?php includeShowcodeStaticBegin(); ?>
// import the js module
import enableCarousel from '~enable-a11y/js/modules/enable-carousel';

// import the CSS
import '~enable-a11y/css/enable-carousel';

...

// How to initialize the enableCarousel library
enableCarousel.init();

...

    <?php includeShowcodeStaticEnd(); ?>

    <p>The <code>~</code> is resolved by putting the following in your <code>webpack.config.js</code>:</p>

    <?php includeShowcodeStaticBegin(); ?>
module.exports = {
  
  ...

  resolve: {
    extensions: ['.js', '.jsx', '.scss', '.css', '*.html'],
    modules: [
      path.resolve('./src/js'),
      path.resolve('./node_modules')
    ],
    alias: {
      '~enable-a11y': path.resolve(__dirname, 'node_modules/enable-a11y'),
      '~glider-js': path.resolve(__dirname, 'node_modules/glider-js'),
      '../enable-node-libs/accessibility-js-routines/dist/accessibility.module.js': path.resolve(__dirname, 'node_modules/accessibility-js-routines/dist/accessibility.module'),
      '~glider-js/glider.js': path.resolve(__dirname, 'node_modules/glider-js/glider'),
    '~@splidejs/splide': path.resolve(__dirname, 'node_modules/@splidejs/splide'),
    '~@splidejs/splide/dist/js/splide.min.js': path.resolve(__dirname, 'node_modules/@splidejs/splide/dist/js/splide.min.js'),
      '~jquery/dist/jquery.min.js': path.resolve(__dirname, 'node_modules/jquery/src/jquery'),
      '../enable-node-libs/ableplayer/thirdparty/js.cookie.js': path.resolve(__dirname, 'node_modules/js-cookie/dist/js.cookie')
    },

    ...
  }
}
      <?php includeShowcodeStaticEnd(); ?>

      <p>Note the <code>../enable-node-libs/</code> and <code>~</code> path aliases.  This is due to the production Enable having fixed versions of some third-party JavaScript libraries. In your code, these libraries will point to the production NPM versions inside your code (i.e. <code>glider-js</code>, <code>accessibility-js-routines</code>, <code>js-cookie</code>and <code>jquery</code> (jQuery is needed for AblePlayer only).</p>
      
      
  </li>
</ol>





<template id="npm-list__list-item">
  <li><a href="${url}#npm-instructions">${title}</a></li>
</template>

<template id="npm-list__list">
  <ul>${content}</ul>
</template>
