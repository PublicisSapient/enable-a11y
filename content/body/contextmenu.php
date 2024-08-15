<p>
  Context menus are used for...
</p>

<h2>Links</h2>

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

<h2>DIV Area</h2>

<div id="opener" class="opener" role="button" tabindex="0" aria-describedby="div-describedby"></div>

<p id="div-describedby" hidden="hidden">In area with a custom context menu. Triple-tap to open the custom context menu.</p>

<div>See if it appends behind this text here</div>
