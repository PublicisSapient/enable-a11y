<!-- <aside class="notes">
            <p>
                This is a heavily modified version of <a href="https://codepen.io/hayleyt/pen/ZyqBYW">
                    this hamburger menu</a>. I removed jQuery as a dependency,
                made the markup accessible and added focus management rules, as well as turning
                it into a mega menu at the desktop breakpoint. I
                also made the styles follow the BEM design pattern.
            </p>
        </aside> -->
<?php includeStats(["isForNewBuilds" => true]); ?>
<?php includeStats([
    "isForNewBuilds" => false,
    "comment" =>
        'If you are trying to fix an existing menu system, please go through the <a href="#so-what-makes-this-accessible--heading">the code walkthrough of how this was implemented</a>. ',
]); ?>
<?php includeStats(["isNPM" => true]); ?>

<p>
  This is the component that the most development and testing time was spent on. On many sites I have done accessibility
  audits on, there is a main navigation that <strong>appears as a traditional flyout menu on the desktop breakpoint and a
  mobile hamburger menu on
  the tablet and mobile breakpoints</strong>. More often than not, this component would have several accessibility issues:
</p>

<ol>
  <li>On the desktop, when the user opened a menu flyout and tabbed through the flyout to the next flyout button, the flyout
    wouldn't close.</li>
  <li>On mobile, there wouldn't be a focus loop around the hamburger menu when opened.</li>
  <li>On mobile, when opening up a submenu, the focus wouldn't go the the back button/close button of the new submenu.</li>
  <li>Links and collapsable buttons were not marked up correctly.</li>
</ol>

<p>
  I created this menu system to address all of the above issues. I have tested with both mobile and desktop devices with
  and without screen readers. The visual layout of the mobile breakpoint is inspired by <a
    href="https://codepen.io/hayleyt/pen/ZyqBYW">
    this hamburger menu</a> by the talented <a href="https://www.instagram.com/hayleytea/">Hayley Tong</a>, the code
  running it is original work.
</p>


<h2>Mobile Hamburger Menu</h2>

<p>
  If you are in the mobile breakpoint (i.e. a viewport width less than
  <span class="breakpoint-width"></span>), then a hamburger menu icon will
  appear in the upper right-hand corner of this page.
</p>

<figure>

  <?php pictureWebpPng(
      "images/hamburger-menu-copy/hamburger-menu-icon-screenshot",
      "Screenshot of the banner on the top of this page in the mobile breakpoint",
  ); ?>

  <figcaption>Figure 1. The hamburger menu icon appears on the upper right-hand side of the page. It is
    denoted by three horizontal lines that has become the standard.</figcaption>
</figure>

<p>
  Clicking on it
  with either a mouse or keyboard will result in a standard hamburger
  menu appearing on the right hand side of the page, and keyboard focus
  will be applied to the first interactive element inside it (the close
  button).
</p>

<figure>

  <?php pictureWebpPng(
      "images/hamburger-menu-copy/hamburger-menu-opened",
      "Screenshot of the hamburger menu when opened.",
  ); ?>

  <figcaption>
    Figure 2. When the hamburger menu icon is clicked, the black menu above appears.
    It has a close button (that gains keyboard focus when first opened) and a few CTAs
    stacked on top of each other.</figcaption>
</figure>

<p>
  The user can choose any item inside that menu with either
  a mouse or keyboard. Menu subcategories are visually indicated
  by a right-pointing chevron, and to assistive technologies as
  collapsible/expandable buttons. Clicking on these subcategory
  buttons will show the subcategory menu appearing, with keyboard
  focus being applied to the back button that will take users back
  to the previous menu.
</p>


<p>
  Keyboard users experience a focus loop
  that keeps the current menu panel open until the menu is closed.
  If the user either uses a mouse
  to click outside the menu or hits the Escape key, the menu will close.
</p>

<h2>Desktop Mega Menu</h2>

<p>
  If you are in the desktop breakpoint (i.e. a viewport width greater
  than or equal to <span class="breakpoint-width"></span>), then a mega menu
  will appear across the top of the page underneath the Enable logo in the
  global header.
</p>

<figure>

  <?php pictureWebpPng(
      "images/hamburger-menu-copy/mega-menu-onload",
      "Screenshot of the mega menu when the page is first loaded.",
  ); ?>

  <figcaption>
    Figure 3. The mega menu is a horizontal bar with the
    top-level CTAs appearing inside it next to one another.
  </figcaption>
</figure>

<p>
  Users can either click the CTAs in the menu with either a mouse or keyboard.
  Menu subcategories are visually indicated
  by a downwards pointing chevron, and to assistive technologies as
  collapsible/expandable buttons. Clicking on these subcategory
  buttons will show the subcategory menu appearing below the button.
  Keyboard users can then tab immediately into the subcategory menu with
  a keyboard, while mouse users can click on any of the submenu items inside.
</p>

<figure>

  <?php pictureWebpPng(
      "images/hamburger-menu-copy/mega-menu-open",
      "Screenshot of the mega menu when one of the submenus opened.",
  ); ?>

  <figcaption>
    Figure 3. When a submenu category is clicked with either,
    a mouse or keyboard, the submenu will appear. Clicking again
    makes it disappear.
  </figcaption>
</figure>

<p>
  Keyboard users will note that when they apply focus
  to an interactive element outside of the subcategory menu,
  the menu will close automatically. Mouse users will notice
  this happening if they click anywhere outside the subcategory
  menu as well. Mobile screen reader users will experience a focus loop
  inside the menu until they close the menu with the CTA that opened it.
</p>


<h2>How can I use this script on my site?</h2>


<ol>
  <li>Follow the instructions below to <a href="#npm-instructions">learn how to download the hamburger menu
      library</a>.</li>
  <li>Use the following code walkthrough below to create your menu navigation.</li>
</ol>

<?php includeShowcode("website-banner", "", "", "", true, 0, "", true); ?>
<script type="application/json" id="website-banner-props">
{
    "replaceHtmlRules": {
      "#non-hamburger-ctas": "<!-- HTML for skip link and logo link -->"
    },
    "steps": [
      {
        "label": "Create a container where the flyout menu will be in the DOM",
        "highlight": "%OPENCLOSECONTENTTAG%div id=\"enable-flyout-menu\"",
        "notes": "It should be empty.  We will fill this container with HTML via JavaScript"
      },
      {
        "label": "Create HTML Templates for all the sections of the flyout menu",
        "highlight": "%OPENCLOSECONTENTTAG%template",
        "notes": "Every component in the flyout menu should be represented by a template with a unique ID. We will use these IDs in a later step"
      },
      {
        "label": "Create the JSON structure of the Flyout Menu",
        "highlight": "%OPENCLOSECONTENTTAG%script id=\"flyout-props\"",
        "notes": [
          "<p>This JSON contains a recursive list of what we will call \"content objects\".  These content objects will take the HTML templates in the previous steps and convert them to HTML. Each content object can have the following properties:<p>",
          "<dl>",
            "<dt>id:</dt>",
            "<dd>The ID of the template of the HTML we want to insert here. <em>(required)</em></dd>",
            "<dt>props:</dt>",
            "<dd>A JS object that contains that values for the variables used in the template.</dd>",
            "<dt>content:</dt>",
            "<dd>A list of content objects that additional HTML.  The script will replace the <code>${html:content}</code> of the template and replace it with the HTML returned by the content objects.</dd>",
          "</dl>"
        ]
      },
      {
        "label": "Use JavaScript to convert the JSON Object above to HTML",
        "highlight": "%JS% buildFlyoutMenuHTML ||| const buildFlyoutMenuHTML",
        "notes": "The <code>Templify</code> library is used to do this part.  Instruction on loading it are in the installation notes at the bottom"
      }
    ]
}
</script>



<h2>So ... What Makes This Accessible</h2>

<p>
  Let's walk through the front-end code of the Hamburger Flyout Menu on the Enable site to show the code that makes this accessible.  
</p>



<?php includeShowcode("enable-flyout-menu", "", "", "", true, 0, "", true); ?>

<script type="application/json" id="enable-flyout-menu-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Container Template: Use the nav HTML5 tag",
      "highlight": "%OUTERHTML%flyout__container ||| %OPENTAG%nav",
      "notes": "This whole component should be wrapped up in a <code>nav</code> tag, since it is a navigation widget. Screen reader users can use tools like the Rotor (Voiceover) or The Elements List (NVDA) to jump to the main navigation no matter what item has focused on the page.  The ARIA label is useful to distinguish this bit of navigation with other pieces of navigation that may appear on the page."
    },
    {
      "label": "Container Template: Mark up the hamburger menu icon as expandable",
      "highlight": "%OUTERHTML%flyout__container ||| aria-expanded ||| aria-controls ",
      "notes": "This should be set to false when the hamburger menu is hidden, true when it is visible.  Note the aria-controls is pointing to the element that it is opening."
    },
    {
      "label": "Container Template: Set aria-label for hamburger menu icon",
      "highlight": "%OUTERHTML%flyout__container ||| aria-label=\"main[^m]*menu\"",
      "notes": "When focus is applied to this button, screen reader users will be told the button's label is \"main menu\"."
    },
    {
      "label": "Container Template: Set screen reader text close button icon",
      "highlight": "%OUTERHTML%flyout__container ||| %OPENCLOSECONTENTTAG%span sr-only",
      "notes": "We use screen reader only text instead of an aria-label because buttons should not be empty."
    },
    {
      "label": "Container Template: Markup hamburger main panel",
      "highlight": "%OUTERHTML%flyout__root ||| class=\"enable-flyout__list[^\"]*\"",
      "notes": "The first level in the hamburger flyout navigation is contained in this <code>&lt;ul&gt;</code> element.  This is so screen readers can announce how many nav items are in the top level."
    },
    {
      "label": "Submenu Button Template: Mark up the buttons that open up submenus as expandable",
      "highlight": "%OUTERHTML%flyout__button ||| aria-expanded=\"false\"",
      "notes": "This should be set to false when the hamburger menu is hidden, true when it is visible.  Note the aria-controls is pointing to the element that it is opening."
    },
    {
      "label": "Submenu Button Template: Mark up the buttons that open up submenus as expandable",
      "highlight": "%OUTERHTML%flyout__button ||| aria-controls ||| id=\"[^\"]*\"",
      "notes": "The button that opens a panel should have an <code>aria-controls</code> set to the ID of that panel."
    },
    {
      "label": "Submenu Button Template: Mark up the panel as a group",
      "highlight": "%OUTERHTML%flyout__button ||| role=\"group\" ||| aria-label",
      "notes": "When a screen reader tabs into the panel, it will read the aria-label as the groups label."
    },
    {
      "label": "Submenu Button Template: Mark up the menu subsection panels with aria-labels",
      "highlight": "%OUTERHTML%flyout__button ||| aria-label",
      "notes": ""
    },
    {
      "label": "Submenu Button Template: Having close buttons at the beginning of each menu subsection",
      "highlight": "%OUTERHTML%flyout__button ||| \\s*&lt;button[^c]*class=\"enable-flyout__hamburger-icon-facade\"[\\s\\S]*?&lt;\/button&gt;",
      "notes": ""
    },
    {
      "label": "Submenu Button Template: Set aria-controls attributes",
      "highlight":  "%OUTERHTML%flyout__button ||| aria-controls ||| id=\"[^\"]*\"",
      "notes": "Any button that opens up a menu subsection should have an aria-controls pointing to the id of that subsection DOM element."
    },
    {
      "label": "Submenu Button Template: Ensure focus stays within hamburger menu when the user clicks on the hamburger menu icon",
      "highlight": "%JS% EnableFlyout.onHamburgerIconClick ; EnableFlyout.openFlyout; EnableFlyout.openMenuAnimationEnd ||| [ ]*forEach[^}]*\\}\\)\\; ||| this\\.openFlyout(\\(\\)\\;){0,1} ||| [ ]*accessibility\\.setKeepFocusInside\\(\\$container\\, true\\)\\;  ||| requestAnimationFrame\\([^}]*\\}\\)\\;",
      "notes": "Note that when the user click on the hamburger menu, we call <code>accessibility.setKeepFocusInside($container, true);</code>. This ensures keyboard focus (and mobile accessibility focus) stays inside the open menu, and not on the content outside of it.  We also make the button that opened it inaccessible to screen readers and keyboards, since focus will be applied to the close button, as seen in the openMenuAnimationEnd method at the bottom."
    },
    {
      "label": "JavaScript: Ensure focus restrictions are removed when hamburger menu is closed",
      "highlight": "%JS% EnableFlyout.closeAllFlyouts ; EnableFlyout.openMenuAnimationEnd ||| [ ]*forEach\\.call\\(\\$mainMenuButton[^}]*\\}\\)\\; ||| this\\.openFlyout(\\(\\)\\;){0,1} ||| [ ]*accessibility\\.setKeepFocusInside\\(\\$container\\, false\\)\\; ||| \\$menuEl\\.focus\\(\\)\\;",
      "notes": "When the close button is clicked, all cancel the focus loop by calling <code>accessibility.setKeepFocusInside($container, false);</code>.  We also ensure that keyboard focus can be applied to the hamburger menu icon before we apply focus to it in the openMenuAnimationEnd method at the bottom."
    },
    {
      "label": "CSS: Ensure hamburger item is visible in Windows High Contrast Mode.",
      "highlight": "%CSS%hamburger-style~ .enable-flyout__hamburger-icon span |||  border:[^;]*;",
      "notes": "We have a transparent <code>border</code> on the <code>div</code> elements that make up the hamburger menu icon by default. Even though this is normally invisible, <a href=\"https://piccalil.li/quick-tip/use-transparent-borders-and-outlines-to-assist-with-high-contrast-mode\">transparent borders show up in Windows High Contrast Mode</a>. If we didn't have this included, the icon would be invisible."
    },
    {
      "label": "Container Template: Markup hamburger main menu panels",
      "highlight": "%OUTERHTML%flyout__root ||| class=\"enable-flyout__list[^\"]*\"",
      "notes": "If you look at the code, you will notice that all the panels are marked up as unordered lists (using <strong>ul</strong> tags).  This is so screen readers can announce how many items are in the menu panel that is currently shown on-screen."
    }
  ]
}
</script>


<?= includeNPMInstructions(
    "enable-flyout",
    ["js/modules/templify.js"],
    "enable-flyout",
    false,
    [
        "otherImports" =>
            '<br />// import the library that converts JSON to HTML<br />import Templify from "~enable-a11y/js/modules/templify.js"<br />',
        "otherSampleCode" =>
            "<br />// This is the DOM element where the hamburger menu will be inserted into.<br />" .
            "const hamburgerMenuEl = document.getElementById('enable-flyout-menu');<br />" .
            "<br />" .
            "// This is where the structure of the hamburger menu is stored (in JSON format).<br />" .
            "const hamburgerMenuJSONEl = document.getElementById('flyout-props');<br />" .
            "const hamburgerMenuJSON = JSON.parse(hamburgerMenuJSONEl.innerHTML);<br />" .
            "<br />" .
            "// Now, let's use Templify to convert the JSON into HTML.<br />" .
            "const hamburgerMenu = new Templify(hamburgerMenuEl, hamburgerMenuJSON);<br />" .
            "<br />" .
            "// Initialize the hamburger menu.<br />" .
            "EnableFlyout.init();'",
    ],
) ?>
