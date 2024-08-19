<p>
  Context menus are custom, right-click menus that provide users with quick access to additional options
  or actions related to a specific element or area on the page. Context menus are usually opened using a combination
  of keyboard keys—VO-Shift-M using VoiceOver on Mac—or a triple-tap action on mobile devices.
</p>

<h2>Links</h2>

<p>
  Below is a link that has a custom context meu. The reasons for a link to have a custom context menu are many. It
  could be purely for style, it could be wanting to hide default browser options, it could be providing custom
  functionality, and many other reasons.
</p>

<a id="link-context-menu" class="link-context-menu" href="https://google.com" aria-describedby="link-describedby">Google</a>

<p id="link-describedby" hidden="hidden">Link with custom context menu</p>

<div class="enable-example--no-border">
  <ul id="context-menu-list" class="context-menu__example" role="menu" tabindex="0">
    <li class="context-menu__list__item" role="menuitem" tabindex="0">Back</li>
    <li class="context-menu__list__item__disabled" role="menuitem" tabindex="0">Forward</li>
    <li class="context-menu__list__item" role="menuitem" tabindex="0">Reload</li>
    <li class="context-menu__list__item" role="menuitem" tabindex="0">More Tools</li>
    <li class="context-menu__list__item__divider" aria-hidden="true"></li>
    <li class="context-menu__list__item__withIcon" role="menuitem" tabindex="0">
      <img src="images/contextmenu/check_24dp_color.png" alt="checkmark" class="context-menu__list__item__withIcon__icon"/>
      Show Bookmarks
    </li>
    <li class="context-menu__list__item" role="menuitem" tabindex="0">Show Full URLs</li>
  </ul>
</div>

<h2>A Specific Area</h2>

<p>
  It's possible to show a custom context menu for when a user right-clicks inside a specific area. It's best not to
  allow accessibility users to be able to interact with this area though; instead override the context menu for
  elements that have more context such as links and buttons. Moreover, forcing an area to be accessible will require
  assigning a role of "button", "link", or some other attribute that doesn't correctly represent the area, and will
  only confuse accessibility users because the area will be announced as a "button", "link", etc., respectively.
</p>

<div id="specific-area" class="specific-area" role="region"></div>
