<!-- <aside class="notes">
            <p>
                This is a heavily modified version of <a href="https://codepen.io/hayleyt/pen/ZyqBYW">
                    this hamburger menu</a>. I removed jQuery as a dependancy,
                made the markup accessible and added focus management rules, as well as turning
                it into a mega menu at the desktop breakpoint. I
                also made the styles follow the BEM design pattern.
            </p>
        </aside> -->
<?php includeStats(array('isForNewBuilds' => true)) ?>
<?php includeStats(array('isForNewBuilds' => false, 'comment' => 'If you are trying to fix an existing menu system, please go through the <a href="#enable-hamburger-menu__heading">the code walkthrough of how this was implemented</a>. ')) ?>
<?php includeStats(array('isNPM' => true)) ?>

<p>
  This is the component that the most development and testing time was spent on. On many sites I have done accessibility
  audits on, there is a main navigation that <strong>appears as a traditional flyout menu on the desktop breakpoint, and a
  mobile hamburger menu on
  the tablet and mobile breakpoints</strong>. More often than not, this component would have several accessibility issues:
</p>

<ol>
  <li>On desktop, when the user opened a menu flyout and tabbed through the flyout to the next flyout button, the flyout
    wouldn't close.</li>
  <li>On mobile, there wouldn't be a focus loop around the hamburger menu when opened.</li>
  <li>On mobile, when opening up a submenu, focus wouldn't go the the back button/close button of the new submenu.</li>
  <li>Links and collapsable buttons were not marked up correctly.</li>
</ol>

<p>
  I created this menu system to address all of the above issues. I have tested with both mobile and desktop devices with
  and without screen readers. The visual layout of the mobiel breakpoint is inspired by <a
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

  <?php pictureWebpPng("images/hamburger-menu-copy/hamburger-menu-icon-screenshot", "Screenshot of the banner on the top of this page in the mobile breakpoint")?>

  <figcaption>Figure 1. The hamburger menu icon appears on the upper right hand side of the page. It is
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

  <?php pictureWebpPng("images/hamburger-menu-copy/hamburger-menu-opened", "Screenshot of the hamburger menu when opened.")?>

  <figcaption>
    Figure 2. When the hamburger menu icon is clicked, the black menu above appears.
    It has a close button (that gains keyboard focus when first opened) and few CTAs
    stacked on top of each other.</figcaption>
</figure>

<p>
  The user can choose any item inside that menu with either
  a mouse or keyboard. Menu subcategories are visually indicated
  by a right pointing chevron, and to assistive technologies as
  collapsabe/expandable buttons. Clicking on these subcategory
  buttons will show the subcatagory menu appearing, with keyboard
  focus being applied to the back button that will take users back
  to the previous menu.
</p>


<p>
  Keyboard users experiencing a focus loop
  that keeps the current menu panel until the menu is closed.
  If the user either uses a mouse
  to click outside the menu or hits the Escape key, the menu will close.
</p>

<h2>Desktop Mega Menu</h2>

<p>
  If you are in the desktop breakpoint (i.e. a viewport width greater
  then or equal to <span class="breakpoint-width"></span>), then a mega menu
  will appear in across to top of the page underneath the Enable logo in the
  global header.
</p>

<figure>

  <?php pictureWebpPng("images/hamburger-menu-copy/mega-menu-onload", "Screenshot of the mega menu when the page is first loaded.")?>

  <figcaption>
    Figure 3. The mega menu is a horizontal bar with the
    top level CTAs appearing inside it next to one another.
  </figcaption>
</figure>

<p>
  Users can either click the CTAs in the menu with either a mouse or keyboard.
  Menu subcategories are visually indicated
  by a downwards pointing chevron, and to assistive technologies as
  collapsabe/expandable buttons. Clicking on these subcategory
  buttons will show the subcatagory menu appearing below the button.
  Keyboard users can then tab immediately into the subcatagory menu with
  a keyboard, while mouse users can click on any of the submenu items inside.
</p>

<figure>

  <?php pictureWebpPng("images/hamburger-menu-copy/mega-menu-open", "Screenshot of the mega menu when one of the submenus opened.")?>

  <figcaption>
    Figure 3. When a submenu category is clicked with either,
    a mouse or keyboard, the submenu will appear. Clicking again
    makes it disappear.
  </figcaption>
</figure>

<p>
  Keyboard users will note that when they apply focus
  to an interactive element outside of the subcatagory menu,
  the menu will close automatically. Mouse users will notice
  this happening if they click anywhere outside the subcatagory
  menu as well. Mobile screenreader users will experience a focus loop
  inside the menu until they close the menu with the CTA that opened it.
</p>


<h2>How can I use this script in my own site</h2>


<ol>
  <li>Follow the instructions below in order to <a href="#npm-instructions">learn how to download the hamburger menu
      library</a>.</li>
  <li>You can either code the HTML for the menu by hand, but since the code can be rather redundant and repetitive, it
    may be easier to use a JSON to structure your menu and have the libary do it for you.</li>
</ol>

<h3>Coding HTML by Hand</h3>

<p>If you wanted to code this menu's HTML by hand, you can use the following guide.  Just keep in mind that each level is basically a list of buttons and links.  The links will go to new </p>

<?php includeShowcode("flyout__container", "", "", "", true, 0)?>
<script type="application/json" id="flyout__container-props">
{
    "replaceHtmlRules": {
    },
    "steps": [
      {
        "label": "Container Template: Create the room of the hamburger menu component",
        "highlight": "\\${html:content}",
        "notes": "Copy the all the HTML in this section and paste it in where your document should be. The <code>${html:content}</code> will be replaced in the next step."
      },
      {
        "label": "Submenu Template: Create the first submenu item for the menu",
        "highlight": "%INNERHTML%flyout__submenu ||| \\${html:content}",
        "notes": "Copy and paste the HTML in this section and paste it in where the <code>${html:content}</code> was in the previous step.  The <code>${html:content}</code> in this step will be replaced in the next step.  "
      },
      {
        "label": "Link Template: For each link in the submenu in the previous step, use this HTML.",
        "highlight": "%INNERHTML%flyout__link ||| %OPENCLOSECONTENTTAG%picture",
        "notes": "Note that I put a picture here. This is not needed.  It was an aesthetic choice."
      },
      {
        "label": "Submenu Button Template: For each button in the submenu created in Step #2, use this HTML.",
        "highlight": "%INNERHTML%flyout__button ||| \\${[^}]*}",
        "notes": [
          "Note the variables used below:",
          "<ul>",
          "  <li><code>${sectionName}</code> will contain the label for the button.</li>",
          "  <li><code>${id}</code> will be a unique ID for the section.</li>",
          "  <li><code>${html:content}</code> will be replaced by a list of links and buttons for this subsection.  Just go back to steps #3 and #4 to find the markup for these areas.</li>",
          "</ul>"
        ]
      }
    ]
}
</script>

<h3>Using JavaScript (recommended)</h3>

<p>
  If you look at the four steps given above, they are basically HTML tempalates.  You could then take those HTML templates
  and modify them to work with favourite HTML templating system (e.g. Handlebars, Moustache, React, etc).
</p>


<h2>So ... What Makes This Accessible</h2>

<p>
  Let's walk through the front-end code of the Hamburger Flyout Menu on the Enable site to show the code that makes this accessible.  
</p>

<?php includeShowcode("enable-hamburger-menu")?>

<script type="application/json" id="enable-hamburger-menu-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Container Template: Use the nav HTML5 tag",
      "highlight": "%INNERHTML%flyout__container ||| %OPENTAG%nav",
      "notes": "This whole component should be wrapped up in a <code>nav</code> tag, since it is a navigation widget. Screen reader users can use tools like the Rotor (Voiceover) or The Elements List (NVDA) to jump to the main navigation no matter what item has focused on the page.  The ARIA label is useful to distinguish this bit of navigation with other pieces of navigation that may appear on the page."
    },
    {
      "label": "Container Template: Mark up the hamburger menu icon as expandable",
      "highlight": "%INNERHTML%flyout__container ||| \\s*aria-expanded=\"false\"[\\s\\S]*aria-controls=\"mobile-menu\" ||| id=\"mobile-menu\"",
      "notes": "This should be set to false when the hamburger menu is hidden, true when it is visible.  Note the aria-controls is pointing to the element that it is opening."
    },
    {
      "label": "Container Template: Give the hamburger icon a role of image.",
      "highlight": "%INNERHTML%flyout__container ||| role=\"img\"",
      "notes": "Since we used <a href=\"https://codepen.io/designcouch/pen/Atyop\">the third CSS animation example in this codepen</a> to create the hamburger icon, we want to ensure screenreaders interpret this as an image by adding the role of image to it"
    },
    {
      "label": "Container Template: Set aria-label for hamburger menu icon",
      "highlight": "%INNERHTML%flyout__container ||| aria-label=\"main\\smenu\"",
      "notes": "When focus is applied to this button, screen reader users will be told the button's label is \"main menu\"."
    },
    {
      "label": "Container Template: Set screen reader text close button icon",
      "highlight": "%INNERHTML%flyout__container ||| %OPENCLOSECONTENTTAG%span sr-only",
      "notes": "We use screen reader only text instead of an aria-label because buttons should not be empty."
    },
    {
      "label": "Container Template: Markup hamburger main panel",
      "highlight": "%INNERHTML%flyout__container ||| class=\"enable-flyout__list[^\"]*\"",
      "notes": "The first level in the hamburger flyout navigation is contained in this <code>&lt;ul&gt;</code> element.  This is so screen readers can announce how many nav items are in the top level."
    },
    {
      "label": "Submenu Button Template: Mark up the buttons that open up submenus as expandable",
      "highlight": "%INNERHTML%flyout__button ||| aria-expanded=\"false\"",
      "notes": "This should be set to false when the hamburger menu is hidden, true when it is visible.  Note the aria-controls is pointing to the element that it is opening."
    },
    {
      "label": "Submenu Button Template: Mark up the buttons that open up submenus as expandable",
      "highlight": "%INNERHTML%flyout__button ||| aria-controls ||| id",
      "notes": "The button that opens a panel should have an <code>aria-controls</code> set to the ID of that panel."
    },
    {
      "label": "Submenu Button Template: Mark up the panel as a group",
      "highlight": "%INNERHTML%flyout__button ||| role=\"group\" ||| aria-label",
      "notes": "When a screen reader tabs into the panel, it will read the aria-label as the groups label."
    },
    {
      "label": "Mark up the menu subsection panels with aria-labels",
      "highlight": "\\s*aria-label=\"[^\"]*\"[^c]*class=\"enable-flyout\\s[^\"]*\"",
      "notes": ""
    },
    {
      "label": "Having close buttons at the beginning of each menu subsection",
      "highlight": "\\s*&lt;button[^c]*class=\"enable-flyout__hamburger-icon-facade\"[\\s]*",
      "notes": ""
    },
    {
      "label": "Set aria-controls attributes",
      "highlight": "aria-controls",
      "notes": "Any button that opens up a menu subsection should have an aria-controls pointing to the id of that subsection DOM element."
    },
    {
      "label": "Set image alt attributes (or make them decorative if applicable)",
      "highlight": "alt ||| role=\"presentation\"",
      "notes": "The images in the desktop mega menu are decorative, so we set the attributes <code>alt=\"\"</code> and <code>role=\"presentation\"</code>.  If they actually gave extra information to sighted users, we would have to set the attribute to describe the image.  Since they are just screenshots of the video games that are given in the link labels, we have decided to make them decorative."
    },
    {
      "label": "Ensure focus stays within hamburger menu when the user clicks on the hamburger menu icon",
      "highlight": "%JS% EnableFlyoutHamburger.onHamburgerIconClick ; EnableFlyoutHamburger.openFlyout; EnableFlyoutHamburger.openMenuAnimationEnd ||| [ ]*forEach[^}]*\\}\\)\\; ||| this\\.openFlyout(\\(\\)\\;){0,1} ||| [ ]*accessibility\\.setKeepFocusInside\\(\\$container\\, true\\)\\;  ||| requestAnimationFrame\\([^}]*\\}\\)\\;",
      "notes": "Note that when the user click on the hamburger menu, we call <code>accessibility.setKeepFocusInside($container, true);</code>. This ensures keyboard focus (and mobile accessibility focus) stays inside the open menu, and not on the content outside of it.  We also make the button that opened it inaccessible to screen readers and keyboards, since focus will be applied to the close button, as seen in the openMenuAnimationEnd method at the bottom."
    },
    {
      "label": "Ensure focus restrictions are removed when hamburger menu is closed",
      "highlight": "%JS% EnableFlyoutHamburger.closeAllFlyouts ; EnableFlyoutHamburger.openMenuAnimationEnd ||| [ ]*forEach\\.call\\(\\$mainMenuButton[^}]*\\}\\)\\; ||| this\\.openFlyout(\\(\\)\\;){0,1} ||| [ ]*accessibility\\.setKeepFocusInside\\(\\$container\\, false\\)\\; ||| \\$menuEl\\.focus\\(\\)\\;",
      "notes": "When the close button is clicked, all cancel the focus loop by calling <code>accessibility.setKeepFocusInside($container, false);</code>.  We also ensure that keyboard focus can be applied to the hamburger menu icon before we apply focus to it in the openMenuAnimationEnd method at the bottom."
    },
    {
      "label": "Ensure hamburger item is visible in Windows High Contrast Mode.",
      "highlight": "%CSS%hamburger-style~ .enable-flyout__hamburger-icon span |||  border:[^;]*;",
      "notes": "We have a transparent <code>border</code> on the <code>div</code> elements that make up the hamburger menu icon by default. Even though this is normally invisible, <a href=\"https://piccalil.li/quick-tip/use-transparent-borders-and-outlines-to-assist-with-high-contrast-mode\">transparent borders show up in Windows High Contrast Mode</a>. If we didn't have this included, the icon would be invisible."
    },
    {
      "label": "Container Template: Markup hamburger mainmenu panels",
      "highlight": "class=\"enable-flyout__list[^\"]*\"",
      "notes": "If you look at the code, you will notice that all the panels are marked up as unordered lists (using <strong>ul</strong> tags).  This is so screen readers can announce how many items are in the menu panel that is currently shown on-screen."
    }
  ]
}
</script>

<?php
  include('../templates/enable-hamburger.html');
?>

<?= includeNPMInstructions('enable-hamburger') ?>