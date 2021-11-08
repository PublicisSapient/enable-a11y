<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Accessible animated hide and show</title>
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



    <link id="link-css" rel="stylesheet" type="text/css" href="css/read-more.css" />

    <style>
      /* Styles specific to this example */


      .read-more__example li {
        font-size: 20px;
        height: 20px;
        list-style: none;
        margin: 0;
        padding: 0;
      }

      .read-more__example a {
        text-decoration: none;
      }
    </style>
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

        <p>This page has been inspired by <a href="https://sarbbottam.github.io/blog/2016/06/26/show-more-show-less-actionable-list-items">Show more/less actionable list items</a> by <a href="https://sarbbottam.github.io/about/">Sarbbottam Bandyopadhyay</a>

      </aside>

      <h1>Read More</h1>


      <h2>Example 1: Read More CTAs</h2>
      <div id="read-more__with-ctas" class="read-more__example">
        <div class="read-more__wrapper">
          <div class="read-more__container">
            <ul>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
            </ul>
            <ul class="read-more__overflow-content read-more__focus-point" tabindex="-1">
              <li><a href="#">6</a></li>
              <li><a href="#">7</a></li>
              <li><a href="#">8</a></li>
              <li><a href="#">9</a></li>
              <li><a href="#">10</a></li>
            </ul>
          </div>

          <button class="read-more__button" aria-expanded="false" data-read-less="Read less">Read more</button>
        </div>
        <div class="sr-only read-more__alert"></div>
      </div>

      <h2>Example 2: Read More Content</h2>
      <div id="read-more__with-content" class="read-more__example">
        <div class="read-more__wrapper">
          <div class="read-more__container">
            <p>Enable is a list of code examples that is meant to teach people accessible coding practices.</p>
            <div class="read-more__overflow-content read-more__focus-point" tabindex="-1">
              <p>
                  <strong>Enable</strong> is not a framework.
                  <strong>Enable</strong> is not a library (although some of the
                  examples do use accessible.js). <strong>Enable</strong> is a series
                  of widgets that allow you to learn to make your web work accessible.
              </p>

              <p>
                  You can either use the widgets as is, or use them as models to make
                  your own projects accessible (and if you do, please share your work
                  with us by sending us a pull request ... we'd love to share your
                  work with the <strong>Enable</strong> community).
              </p>

              <p>
                  <strong>Enable</strong> was originally created by
                  <a href="https://www.useragentman.com/">Zoltan Hawryluk</a> to
                  answer questions his colleagues asked about how to make their web
                  widgets work with things like keyboards and screen readers. It is
                  his hope that he can give this to the web development community and
                  make <strong>Enable</strong> grow by having other
                  accessibility-minded developers share their work as well.
              </p>

              <p>
                  Use the examples in the <strong>Enable</strong> git repository to
                  make your web work accessible to people, with or without
                  disabilities. <strong>Enable</strong> examples work for users who
                  use screen readers, keyboards, and other devices besides a mouse.
                  And we actively encourage web developers who make accessible widgets
                  to contribute to <strong>Enable</strong> and share their
                  accessibility knowledge to others.
              </p>
            </div>

          </div>

          <button class="read-more__button" aria-expanded="false" data-read-less="Read less">Read more</button>
        </div>
        <div class="sr-only read-more__alert"></div>
      </div>

    </main>

    <script src="js/read-more.js"></script>

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
    <script src="js/hamburger.js"></script>  </body>
</html>
