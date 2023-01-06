<p>
  Not all automated tools like WAVE check for things that are easily found accessibility defects on a web page (e.g.
  Duplicate IDs). This page will be a living document containing the bookmarklets we find the most useful.
</p>

<h2>How To Install Bookmarklets For Your Browser</h2>

<p>The easiest, most straight-forward way to install any of the bookmarklets in your browser is to make your Bookmarks
  Toolbar visible and dragging them in there.</p>

<ol>
  <li>
    <details class="enable-drawer">
      <summary class="enable-drawer__button">

        Read how you can make your browser's Bookmarks Toolbar Visible.

      </summary>
      <div class="content">

        <table>
          <thead>
            <tr>
              <th scope="col">Browser</th>
              <th scope="col">Instructions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Chrome for Windows and Linux</th>
              <td>Press Control+Shift+B on your keyboard.</td>

            </tr>
            <tr>
              <th scope="row">Safari and Chrome for Mac</th>
              <td>
                <p>Press ⌘+Shift+B on your keyboard</p>
              </td>
            </tr>
            <tr>
              <th scope="row">Firefox</th>
              <td>
                <p>Why does Mozilla make this so difficult?!?!</p>
                <ol>
                  <li>In the navigation toolbar, go to the rightmost icon (screen reader users will hear it being
                    refered to
                    as the "Firefox" button. Sighted users will see it as a hamburger menu at the right most edge of the
                    naviation toolbar, as shown in the screenshot below:<br class="break--with-space" />
                    <img src="images/bookmarklets/firefox-menu.png" alt="" />
                  </li>
                  <li>Choose the Bookmarks item, as shown in this screenshot: <br class="break--with-space" />
                    <img src="images/bookmarklets/firefox-menu-1.png" alt="" />
                  </li>
                  <li>In the new menu that appears, choose <strong>Show Bookmarks Toolbar</strong>, as shown in the
                    screenshot below: <br class="break--with-space" />
                    <img src="images/bookmarklets/firefox-menu-2.png" alt="" />
                  </li>
                </ol>
              </td>
            </tr>
          </tbody>
        </table>

      </div>
    </details>



  </li>
  <li>Next, drag any of the bookmarklet links below into the Bookmarks Toolbar in your web browser.</li>
  <li>That's it! Whenever you want to use any of the bookmarklets on your webpage, just click it!</li>
</ol>


<h2>List of Bookmarklets</h2>

<h3>Duplicate IDs</h3>

<p>
  You'd be surprised how many pages have duplicate IDs in their HTML. This is very common with pages that
  have multiple instances of a component on a web page (e.g. A product listing page with several product tiles on it).
  This bookmarklet can help you check in-browser if there are multiple tags with the same ID (you will need to open your
  console to see the results). It was slighly modified from <a
    href="https://matthewbusche.com/2015/04/13/checking-an-html-page-for-duplicate-ids-using-javascript/">the
    bookmarklet written by Matthew Busche</a>.
</p>

<a class="bookmarklet"
  href='javascript:(function(){var c=document.getElementsByTagName("*"),d={},e=!1,f=0;console.log("running");for(var b=0,g=c.length;b<g;++b){var a=c[b].id;a&&(void 0===d[a]?d[a]=1:(e=!0,f++,console.warn("Duplicate ID #"+a,document.querySelectorAll(`#${a}`))))}e?console.log("Number%20of%20dupes:",f):console.log("No%20duplicate%20IDs%20found")})();'>
  Duplicate ID Bookmarklet</a>

<h3>What Has Focus?</h3>

<p>
  I wrote this bookmarklet when I was testing a page that was allowing keyboard focus to be applied to visually hidden
  elements on the page. When you use the bookmarklet, every time you tab into an interactive element, its HTML appears
  in the console. I use it all the time and find it super useful, so I include it here.
</p>

<a class="bookmarklet"
  href='javascript:(function()%7Blet%20lastFocused%20%3D%20null%3BsetInterval(()%20%3D%3E%20%7Bconst%20%7B%20activeElement%20%7D%20%3D%20document%3Bif%20(lastFocused%20!%3D%3D%20activeElement)%20%7Bconsole.log(activeElement)%3BlastFocused%20%3D%20activeElement%3B%7D%7D%2C%201000)%7D)()'>What
  Currently Has Focus</a>

<h2>Other Accessibility Related Bookmarklets</h2>

<p>There are, of course, many other places to get a11y related bookmarklets. Here are a few we know about.</p>

<ul>
  <li><a href="https://pauljadam.com/bookmarklets/">Paul J. Adams' JavaScript Bookmarklets for Accessibility Testing</a>
  </li>
  <li><a href="https://whatsock.github.io/visual-aria/github-bookmarklet/visual-aria.htm">The Visual ARIA
      Bookmarklet</a> allows engineers, testers, educators, and students to physically observe ARIA usage within web
    technologies, including ARIA 1.1 structural, live region, and widget roles, proper nesting and focus management,
    plus requisite and optional supporting attributes to aid in development.</li>
  <li><a href="text-spacing.php">Text Spacing Bookmarklet by Steve Faulkner</a>.</li>
</ul>