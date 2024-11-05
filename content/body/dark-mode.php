
<p>
    Many mobile and desktop users experience eye strain when using interfaces that may have very bright, white screens.  
    An accessibility feature like dark mode helps to solve this problem for many and has now become a preference for millions of people who use computers and mobile devices every day.
</p>

<p>
  This page will discuss how to access either light or dark mode on different operating systems and devices.
  It will also serve as a tool for the proper development of dark mode on new and existing websites and platforms. 
</p>

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
  <li>Don't forget the little details — take the time to <em>make sure</em> each component of the page (even ones not visible) is dark mode accessible.
  </li>
  <li>Many users with photosensitivity use dark mode, so try to avoid using very bright colors, even if the contrast ratio appears correct.</li>
  <li>Make sure assistive technologies (such as screen readers) still work with dark mode.</li> 
</ol>

<p>
    One, if not the most important, thing to consider and be aware of when developing any user interface, light or dark, is the contrast ratio of items on the webpage.  
    According to the <a href="https://www.w3.org/TR/UNDERSTANDING-WCAG20/visual-audio-contrast-contrast.html">WCAG guidelines for contrast accessibility</a>, the “visual presentation of text” must have a contrast ratio of at least 4.5:1 (with exceptions).  
    In short, this means that the contrast between background color and text color needs to be above this ratio.
</p>

<p>
    To see an example of a proper vs. improper contrast ratio, please refer below:
</p>

<div class="enable-example">
    <img src="images/dark-mode-example/goodContrast_credits.png" width=800 height=155
    alt="Good Contrast Example">
    <img src="images/dark-mode-example/badContrast_credits.png" width=800 height=155
    alt="Bad Contrast Example">
</div>

<p>
    As seen above, the contrast between the first image is much better than the second.  The first images text has a contrast ratio of 
    <strong>9.9</strong>, much better than the contrast ratio of <strong>1.25</strong> 
    for the second images text.
    
</p>

<p>
    However, sometimes an inaccessible contrast ratio is not so obvious.  This is why it is important to use tools that check the ratio, as there are things that might be overseen.  
    Tools like <a href="https://wave.webaim.org/">WAVE</a> web accessibility evaluation tools, 
    <a href="https://webaim.org/resources/contrastchecker/">WebAIM Contrast Checker</a>,
    and <a href="https://accessible-colors.com/">accessible-colors</a>
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
    alt="MacOS System Settings Dark Mode">
  </li>

  <li><strong>Mobile (iOS):</strong>
    <ol>
        <li>Open <strong>Settings</strong>.</li>
        <li>Select <strong>Display & Brightness</strong>.</li>
        <li>Under <strong><em>Appearance</em></strong>, you will again see the option for Light, Dark, or Automatic.</li>
    </ol>
    <img src="images/dark-mode-example/DarkMode_iOS.png" width=192 height=400
    alt="iPhone/iPad Settings Dark Mode">
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
    alt="Windows Color Settings Dark Mode">
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
    alt="Android Dark Theme Settings">
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