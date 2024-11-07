
<p>
    Many mobile and desktop users experience eye strain when using interfaces that may have very bright, white screens.  
    An accessibility feature like dark mode helps to solve this problem for many and has now become a preference for many people who use computers and mobile devices every day.  When a device has dark mode activated, the display and UI elements on the device <strong><em>should</em></strong> appear darker than they are set by default (usually a dark background with lighter text).  We say <strong><em>should</em></strong> here, because web pages must be coded with dark mode support on.
</p>

<p>
  This page will discuss how users can configure their computers tp light or dark mode on different operating systems and devices.  We will also discuss how developers can style their pages for dark mode using very simple CSS, and tips for designers on how to design for dark mode in mind.
</p>

<figure>
  <figcaption id="screenshot-table__caption" class="caption">
    Screenshots of the Enable website in light and dark mode
  </figcaption>

  <div class="can-horizontally-scroll__parent">
    <div class="sticky-table__container sticky-table__container--horizontal-scroll can-horizontally-scroll">
      <table class="screenshot-table" tabindex="0">
        <thead>
          <tr>
            <th scope="col">Light Mode</th>
            <th scope="col">Dark Mode</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <img src="images/pages/dark-mode/lightmode.png" alt="">
              <p>
                A screenshot of the light mode version of the Enable website, circa November 2024. Note the main content has black text with a white background.  The red Enable logo in the main content area has ample contrast with the white background, as does the Publicis Sapient logo below it (which has the word "Publicis" in black and the word "Sapient" in red).  The three content blocks at the bottom of the page are coloured a light grey to ensure the black text inside also has adequate color contrast to be read by partially sighted users.
              </p>
            </td>
            <td>
              <img src="images/pages/dark-mode/darkmode.png" alt="">
              <p>A screenshot of the dark mode version of the same page.  Note that the content has light white text on a dark gray background.  The Enable logo is now a lighter red in this version, and the Publicis Sapient logo is now white.  These changes were both done to ensure proper colour contrast to the dark background.  The three content blocks now have a darker grey background than the main content.  This is to ensure they are still dark but still have a logical separation from the main background color.</p> 
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</figure>

<h2>How Can Developers Check If Dark Mode Is Activated And Apply Styles Accordingly?</h2>

<?php includeCodeSnippet('dark-mode-code', "Dark Mode Code", <<<CODE
@media (prefers-color-scheme: dark) {

}
</template>
CODE); ?>


<h2>The "Rules" for Developing</h2>

<p>
  While there may not be any explicitly set rules for what is considered dark mode, when developing not just a visually pleasing but also accessible dark mode display, 
  it is important to ensure that what is being displayed is accessible to all.
</p>

<p>
    Make sure to remember:
</p>

<ol>
  <li>Contrast is key!! Pay attention to the ratio (see below).</li>
  <li>Don't forget the little details — take the time to <em>make sure</em> each component of the page (even ones not visible initially when the page is loaded) has proper colour contrast in dark mode. 
  </li>
  <li>Many users with photosensitivity use dark mode, so try to avoid using very bright colors, even if the contrast ratio appears correct.  <strong>Avoid using pure blacks and pure whites.</strong> </li>
</ol>

<p>
    One, if not the most important, thing to consider and be aware of when developing any user interface, light or dark, is the contrast ratio of items on the webpage.  
    According to the <a href="https://www.w3.org/TR/UNDERSTANDING-WCAG20/visual-audio-contrast-contrast.html">WCAG guidelines for contrast accessibility</a>, the “visual presentation of text” must have a contrast ratio of at least 4.5:1 (with exceptions).  
    In short, this means that the contrast between background color and text color needs to be above this ratio.
</p>

<p>
  For more information on dark mode best practices, you may want to read <a href="https://www.designstudiouiux.com/blog/dark-mode-ui-design-best-practices/">10 Dark Mode UI Best Practices & Principles</a> on the <a href="https://www.designstudiouiux.com/">Design Studio</a> website.
</p>

<p>
    To see an example of a proper vs. improper contrast ratio, please refer below:
</p>


<div class="can-horizontally-scroll__parent">
    <div class="sticky-table__container sticky-table__container--horizontal-scroll can-horizontally-scroll">
      <table class="screenshot-table" tabindex="0">
        <thead>
          <tr>
            <th scope="col">Light Mode</th>
            <th scope="col">Dark Mode</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <img src="images/dark-mode-example/goodContrast_credits.png" 
            alt="">
            <p>A screenshot of the Enable Shoutout page with dark mode applied.  The text is a light grey on top of dark grey with a colour contrast ratio of <strong>9.9</strong>, ensuring it conforms to <a href="https://www.w3.org/TR/UNDERSTANDING-WCAG20/visual-audio-contrast-contrast.html">WCAG guidelines for contrast accessibility</a>
            </td>
            <td>
            <img src="images/dark-mode-example/badContrast_credits.png" 
            alt="">
              <p>A sceenshot of the same page with the text now using a darker grey than before.  It is harder to read, due to the text having a contrast ratio of <strong>1.25</strong>.</p> 
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</figure>



<p>
    Sometimes, inaccessible contrast ratio is not so obvious.  This is why it is important to use tools that check the ratio, as there are things that might be overseen.  
    Tools like <a href="https://wave.webaim.org/">WAVE</a> amd sites like  
    <a href="https://webaim.org/resources/contrastchecker/">WebAIM Contrast Checker</a>
    allow for developers to test their page contrasts to ensure that they are creating the most accessible user interface possible.
</p>


<h2>Using Dark Mode in Different Operating Systems</h2>

<?php includeStats([
    "isStyle" => true,
    "comment" =>
        "These changes can also be done at the browser level rather than the whole system if that is your preference.",
]); ?>

<p>
    Every OS, whether mobile or desktop, accesses dark mode uniquely.  Use this as a reference to figure out how to enable dark mode 
    on your device!
</p>

<h3>Apple:</h3>
<ul>
  <li><strong>Mac (OSX):</strong>
    <ol>
        <li>Open <strong>System Settings</strong>.</li>
        <li>Select <strong>Appearance</strong>.</li>
        <li>In <strong><em>Appearance</em></strong>, you will have the option to choose Light, Dark, or Auto.</li>
    </ol>
    <img src="images/dark-mode-example/DarkMode_MacOS.png" width=400 height=349
    alt="A Screenshot of the MacOS System Settings App.  The Dark Mode setting appears at the top of the 'Appearance' section as a list of buttons, with the chosen one announced as selected by screen readers.">
  </li>

  <li><strong>Mobile (iOS):</strong>
    <ol>
        <li>Open <strong>Settings</strong>.</li>
        <li>Select <strong>Display & Brightness</strong>.</li>
        <li>Under <strong><em>Appearance</em></strong>, you will again see the option for Light, Dark, or Automatic.</li>
    </ol>
    <img src="images/dark-mode-example/DarkMode_iOS.png" width=192 height=400
    alt="A screenshot of the iPhone/iPad System Settings App.  The Dark Mode setting appears at the top of the 'Display & Brightness' section as a list of radio buttons.">
  </li>
</ul>

<h3>Windows:</h3>
<ul>
  <li><strong>Desktop:</strong>
    <ol>
        <li>Select <strong>Start</strong> and open <strong>Settings</strong>.</li>
        <li>Select <strong>Personalization</strong> and navigate to <strong>Colors</strong>.</li>
        <li>In <strong><em>Colors</em></strong> under <strong><em>Choose your mode</em></strong>, you will have the option to choose Light, Dark, or Custom, as well as change your accent color to your preference.</li>
    </ol>
    <img src="images/dark-mode-example/DarkMode_Windows.png" width=400 height=315
    alt="A screenshot of the Control Panels App.  The Dark Mode setting appears at the top of the 'Display & Brightness' section as a select box.">
  </li>
</ul>

<h3>Android:</h3>
<ul>
  <li><strong>Mobile:</strong>
    <ol>
        <li>Open <strong>Settings</strong>.</li>
        <li>Select <strong>Display & brightness</strong>.</li>
        <li>In <strong><em>Display</em></strong>, toggle Dark mode based on your preference.</li>
    </ol>
    <img src="images/dark-mode-example/DarkMode_Android.png" width=193 height=400
    alt="A screenshot of the iPhone/iPad System Settings App.  The Dark Mode settings appears at the top of the 'Display & Brightness' section as a set of radio buttons.">
  </li>
</ul>

<h3>Ubuntu:</h3>
<ul>
  <li><strong>Desktop:</strong>
    <ol>
        <li>Open <strong>Settings</strong>.</li>
        <li>Select <strong>Appearance</strong>.</li>
        <li>In <strong><em>Appearance</em></strong>, under <strong><em>Style</em></strong>, you will see the option to choose Light or Dark mode.</li>
    </ol>
    <img src="images/dark-mode-example/DarkMode_Ubuntu.png" width=400 height=333
    alt="Ubuntu Dark Mode Settings">
  </li>
</ul>