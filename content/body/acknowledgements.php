<p>
  Originally, Enable started out as a small personal website to help me show other developers how accessible code is
  structured.
  Some of the solutions are my own, and some I have borrowed from others (because why reinvent the wheel, especially when
  you have already learned from the best?)
</p>

<p>
  What follows are not just acknowledgements to existing accessible code examples used in Enable, but also to other code I have
  built on that I have accessibility features to.
</p>

<h2>Direct Contributers</h2>

<p>
  The following people have contributed directly to the Enable project by adding code/content via pull requests.
</p>

<ul>
  <li><a href="https://github.com/saumyajitc">Saumyajit Chowdhury</a> for implementing husky pre-commit hooks to run lint-staged before pushing code to the repository</li>
  <li><a href="https://github.com/majid-paktinat">Majid Paktinat</a> and <a href="https://github.com/akshaypanchal">Akshaykumar Panchal</a> for implementing dynamic Structured Data Markup for improving the SEO of the Enable Project.</li>
  <li><a href="https://github.com/alisonhall">Alison Hall</a> for cleaning up and streamlining the unit testing and automated testing NPM tasks (and also doing the difficult task of updating the NPM packages within the project in 2024).
  </li>
  <li>Sahil Singh for unit tests for the <a href="input-mask.php">input mask component</a>.</li>
  <li><a href="https://www.useragentman.com/">Zoltan Hawryluk</a> for starting the Enable project to begin with.</li>
</ul>

<h2>Code Used By Enable</h2>

<p>
  We have either been inspired by, or have integrated work, by the following people.
</p> 

<ul>
<li><a href="https://github.com/saumyajitc">Saumyajit Chowdhury</a> for implementing deployment procedures in <a href="https://enable-a11y-react-iqpmwl8kb-publicis-sapient-sandbox.vercel.app/" target="new">Vercel</a> for <a href="https://github.com/PublicisSapient/enable-a11y-react" target="new">Enable(react version)</a> and create npm package for external use of the accessible components.</li>
  <li><a href="https://twitter.com/lsnrae">Alison Walden</a> for her UX guidelines for both <a
      href="https://lsnrae.medium.com/if-you-must-use-a-carousel-make-it-accessible-977afd0173f4">accessible
      carousels</a> and <a href="https://lsnrae.medium.com/accessible-form-validation-9fa637ddb0fc">form validation</a>
  </li>
  <li><a href="https://github.com/alisonhall">Alison Hall</a> for cleaning up and streamlining the unit testing and automated testing NPM tasks (and also doing the difficult task of updating the NPM packages within the project in 2024).
  </li>
  <li><a href="https://github.com/akr3081">Adam Rock</a> for the accessible <a href="/meter.php">meter</a> and <a href="/audio-player.php">audio player</a> components
  </li>

  <li><a href="https://code.iamkate.com">Kate Morley</a> for her <a
      href="https://code.iamkate.com/html-and-css/styling-checkboxes-and-radio-buttons/">ARIA radio buttons</a>
    <!-- CC0 1.0 Universal (CC0 1.0) -->
  </li>
  <li><a href="https://www.webcreatormana.com/">Mana</a> for her excellent <a
      href="https://codepen.io/manabox/pen/raQmpL">HTML5 radio buttons</a> <!-- https://twitter.com/chibimana -->
  </li>
  <li><a href="https://twitter.com/scottjehl">Scott Jehl</a> for the <a
      href="https://github.com/filamentgroup/select-css"> custom select CSS demo</a></li>
  <li>The <a href="https://www.w3.org">W3C</a> for the design of their <a
      href="https://www.w3.org/TR/wai-aria-practices/examples/listbox/listbox-collapsible.html">ARIA listbox example</a>
    (although the Enable code is different, I did use this as a base).
    <!-- https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document -->
  </li>
  <li><a href="https://twitter.com/cookiecrook">James Craig</a> for the <a
      href="https://webkit.org/blog/3302/aria-and-accessibility-inspector/">ARIA combobox example</a> posted on the <a
      href="https://webkit.org/blog/">WebKit Blog</a></li>
  <li><a href="https://twitter.com/anatudor">Ana Tudor</a> for her <a
      href="https://css-tricks.com/sliding-nightmare-understanding-range-input/">excellent breakdown on how to style
      HTML5 range elements using CSS</a></li>
  <li><a href="https://twitter.com/jeffsmith">Jeff Smith</a> for the <a
      href="http://simplyaccessible.com/article/author/jeffsmith/">article on accessible tabs</a> (although he doesn't
    use ARIA like in my demo, his non-ARIA way proposal is definitely a great solution as well)
  </li>
  <li><a href="https://developer.mozilla.org">MDN</a> for their <a
      href="https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Roles/Switch_role">code for accessible
      switch</a>.</li>

  <li><a href="https://dequeuniversity.com/">Deque University</a> for their <a
      href="https://dequeuniversity.com/library/aria/table-sortable">Sortable Table example</a></li>
  <li><a href="https://pauljadam.com/">Paul J Adams</a> for the <a href="http://pauljadam.com/demos/img.html">ARIA img
      role example</a></li>
  <li><a href="https://twitter.com/stevefaulkner">Steve Faulkner</a> for the <a
      href="https://www.tpgi.com/html5-accessibility-chops-the-figure-and-figcaption-elements/">Figure/Figcaption</a>
    and <a href="https://codepen.io/stevef/pen/ExPdNMM">Pausable Animated GIF</a> demos, as well as the excellent <a
      href="http://www.html5accessibility.com/tests/tsbookmarklet.html">Text Spacing Bookmarklet</a>
    <!-- https://www.linkedin.com/in/steven-faulkner-3781ab1/?originalSubdomain=uk -->
  </li>
  <li><a href="https://twitter.com/chriscoyier">Chris Coyier</a> for <a
      href="https://css-tricks.com/pause-gif-details-summary/">improving on Steve Faulkner's animation GIF demo making
      it pausable by default</a></li>

  <li><a href="https://twitter.com/KittyGiraudel">Kitty Giraudel</a> for the <a
      href="https://tympanus.net/codrops/2012/11/02/heading-set-styling-with-css/">Headings CSS demo</a></li>
  <li><a href="https://www.mathjax.org/">MathJax</a> for their MathML polyfill used in the Enable math role demo.
  </li>
  <li><a href="https://janogarcia.com/">Jano Garcia</a> for the amazingly simple <a
      href="https://codepen.io/janogarcia/pen/bNrKEP">LESS px to rem mixin</a> used throughout the Enable website.
    <!-- hello@janogarcia.com , https://twitter.com/janogarcia -->
  </li>
  <li><a href="https://twitter.com/brucel">Bruce Lawson</a> for the <a
      href="https://brucelawson.co.uk/2021/prefers-reduced-motion-and-browser-defaults/">prefers-reduced-motion and
      browser defaults</a> reset code used in our Pause Animations Control demo.</li>
  <li><a href="https://twitter.com/samthor">Sam Thorogood</a> for the <a
      href="https://gist.github.com/samthor/babe9fad4a65625b301ba482dad284d1">excellent accessibility fixes to the HTML5
      dialog polyfill</a> (which also work well with native dialogs as well). (You can take a look at his <a
      href="https://gist.github.com/samthor">other excellent gists here</a>.</li>
  <li><a href="https://twitter.com/designcouch">Jesse Couch</a> for the wonderful <a
      href="https://codepen.io/designcouch/pen/Atyop">animated hamburger menu icon</a> that was used in the Enable
    website.</li>
  <li><a href="https://twitter.com/5t3ph/">Stephanie Eckles</a> for the <a
      href="https://moderncss.dev/pure-css-custom-checkbox-style/">Custom CSS checkbox style tips</a> that were used in
    our checkbox demo.</li>
  <li>The now (seemingly) defunct <a href="http://www.openajax.org/">Open Ajax Alliance</a> for their <a
      href="https://web.archive.org/web/20170715191225/http://oaa-accessibility.org/example/32/">ARIA slider</a>
    <!-- jferrai@us.ibm.com -->
  </li>
  <li><a href="https://www.instagram.com/hayleytea/">Haley Tong</a> for her <a
      href="https://codepen.io/hayleyt/pen/ZyqBYW">Multi-level burger menu demo</a> on which Enable based its hamburger
    menu visual design on.
    <!-- https://web.archive.org/web/20190525003059/https://hayley.cc/ -->
  </li>
  <li><a href="https://medium.com/@m.rybczonek">Mateusz Rybczonek</a> for the <a
      href="https://css-tricks.com/how-to-create-an-animated-countdown-timer-with-html-css-and-javascript/">Timer
      demo</a> on which Enable added accessibility features to.
    <!-- https://css-tricks.com/author/mateuszrybczonek/ -->
  </li>
  <li><a href="http://jakoblog.de/">Jakob Voß</a> for the code on the <a
      href="https://gist.github.com/nichtich/674522">Wiktionary Lookup Gist</a> on which we added accessibility features
    in order to create our ARIA status role demo.
    <!-- jakob.voss@nichtich.de -->
  </li>
  <li><a href="https://usability.yale.edu">Yale University</a> for their information on <a
      href="https://usability.yale.edu/web-accessibility/articles/zoom-resizing-text">how users can use text zoom in the
      major desktop browsers</a> <!-- accessibility@yale.edu, -->
  </li>
  <li><a href="https://codepen.io/madetoday">Lenka</a> for
    <a href="https://codepen.io/madetoday/pen/MYxYeo">their SVG animation demo</a> that was used in our Pause Animations
    Controls Demo.
  </li>
  <li><a href="https://twitter.com/hedgerwang">Hedger Wang</a> for <a
      href="https://web.archive.org/web/20061031093917/http://www.hedgerwow.com/360/dhtml/js-onfontresize.html">the
      script that text-zoom-resize.js is based on</a>.</li>
  <li><a href="https://zellwk.com/">Zell Liew</a> for
    the routine for <a href="https://github.com/zellwk/javascript/blob/master/src/browser/accessibility/focusable/focusable.js">
      getting all the focusable elements inside a DOM element</a> that <code>accessibility.getAlTabbableEls()</code> is based on.</li>
</ul>

<h2>Icons</h2>

<p>Since we are not designers, we have used the following icons within the Enable website.</p>

<ul>
  <li><a href="https://www.behance.net/coquet_adrien">Adrien Coquet</a> for the Integration Icon.</li>
  <li><a href="https://thenounproject.com/icondownloads/">Icongrapher</a> for the Build Icon.</li>
  <li><a href="https://thenounproject.com/gendis.studio/">Gendis Studio</a> for the "Do Not Use" Icon.</li>
  <li><a href="https://thenounproject.com/LAFS/">LAFS</a> for the Style Icon.</li>
  <li><a href="https://iconscout.com/contributors/daniel-bruce">Daniel Bruce</a> Code Icon</li>
  <li><a href="https://iconscout.com/contributors/ibm-design">IBM Design</a> Add Icon</li>
  <li><a href="https://dribbble.com/Luizcarvalhoid">Luiz Carvalho</a> for the <a href="https://thenounproject.com/icon/bug-2277444/">Bug Icon</a>
  <li><a href="https://iconscout.com/contributors/vaadin-icons">Vaadin Icons</a> for the  <a href="https://iconscout.com/icon/eye-498">Eye Icon</a> used in the <a href="/images/posters/screen-reader-only-text.jpg">poster image</a> for <a href="screen-reader-only-text.php">our screen reader only text page</a></li>
  <li><a href="https://thenounproject.com/ASJ/">Andy Santos-Johnson</a> and IYIKON from <a href="https://pngtree.com">Pngtree.com</a> for the elements used in the <a href="/images/posters/exposing-style-info-to-screen-readers.jpg">poster image</a> of <a href="exposing-style-info-to-screen-readers.php">our page on exposing style information to screen readers</a>.</li>
</ul>

<h2>Typography</h2>

<p>The following font-faces are used within the Enable website.</p>

<ul>
  <li><a href="https://edricstudio.com">Edric Studio</a> for the <a
      href="https://edricstudio.com/monice-sans-serif-font/">Monice font</a> used in the Enable Logo.</li>
  <li><a href="https://mattesontypographics.com/">Steve Mattesons</a> for <a
      href="https://fonts.google.com/specimen/Open+Sans">Open Sans</a> which is used in the body copy of the Enable
    website.</li>
  <li><a href="https://www.fontspace.com/andrew-bulhak">Andrew Bulhak</a> for <a
      href="https://www.fontspace.com/modeseven-font-f2369">ModeSeven</a> we use for the code walkthroughs throughout
    Enable.</li>
</ul>
