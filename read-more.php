<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Accessible animated hide and show</title>
		<?php include "includes/common-head-tags.php";?>
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
    <?php include "includes/documentation-header.php";?>

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

    <?php include "includes/example-footer.php"?>
  </body>
</html>
