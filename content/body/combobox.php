<p>
  Comboboxes are text input fields with autocomplete. In HTML5, they can be implemented using the
  <code>&lt;datalist&gt;</code> tag. In ARIA, they can be implemented with the <code>combobox</code> role and a bit of
  JavaScript.
</p>

<p>
  This is one of the rare cases where the native HTML5 version is not accessible in the majority of the web browsers out
  there. Because of this, I have spent a lot of time working on Enable's combobox implementation.
</p>

<!-- Example 3 is the first example on the page. This doesn't make sense. -->
<h2>Example 3: Using HTML5 datalist</h2>

<?php includeStats(array('doNot' => true, 'comment' => 'This does not work with assistive technologies in most web browsers.')) ?>

<p>
  Ironically, this seems to be inaccessible compared to the ARIA version:
</p>

<ul>
  <li>
    The autocomplete features are not available to mobile screen reader users.
    I was not able to figure out how to gain access to the datalist values
    using either Talkback/Chrome on Android or VoiceOver/Safari for iOS.
  </li>
  <li>
    When a user types in values, the screen reader doesn't report that
    is a suggestion list visible in some browsers (e.g. Firefox 86 with NVDA).
  </li>
  <li>
    If the user uses the up and down arrow keys, some browsers doesn't read
    these values out (e.g. older versions of Safari with VoiceOver).
  </li>
  <li>
    The autocomplete features do not appear at all in Firefox for Android (at the time of this writing, it was
    version 96).
  </li>
  <li>
    Because of the above reasons, it is one of the cases where ARIA works
    better.
  </li>
</ul>

<div id="dataset-example" class="enable-example">
  <form class="combobox-example">
    <label id="html5-fruit__label" for="html5-fruit" class="combobox-label">
      Enter a Fruit or Vegetable
    </label>
    <input id="html5-fruit" name="fruit" type="text" list="languages" aria-describedby="html5-fruit__desc">
    <div class="sr-only" id="html5-fruit__desc">
      As you type, use the up and down arrow keys to choose the autocomplete
      items.
    </div>
    <div id="html5-fruit__statys" role="alert" aria-atomic="true" aria-live="polite">

    </div>
    <datalist id="languages">
      <option id="Apple" value="Apple">Apple</option>
      <option id="Artichoke" value="Artichoke">Artichoke</option>
      <option id="Asparagus" value="Asparagus">Asparagus</option>
      <option id="Banana" value="Banana">Banana</option>
      <option id="Beets" value="Beets">Beets</option>
      <option id="Bell-pepper" value="Bell pepper">Bell pepper</option>
      <option id="Broccoli" value="Broccoli">Broccoli</option>
      <option id="Brussels-sprout" value="Brussels sprout">
        Brussels sprout
      </option>
      <option id="Cabbage" value="Cabbage">Cabbage</option>
      <option id="Carrot" value="Carrot">Carrot</option>
      <option id="Cauliflower" value="Cauliflower">Cauliflower</option>
      <option id="Celery" value="Celery">Celery</option>
      <option id="Chard" value="Chard">Chard</option>
      <option id="Chicory" value="Chicory">Chicory</option>
      <option id="Corn" value="Corn">Corn</option>
      <option id="Cucumber" value="Cucumber">Cucumber</option>
      <option id="Daikon" value="Daikon">Daikon</option>
      <option id="Date" value="Date">Date</option>
      <option id="Edamame" value="Edamame">Edamame</option>
      <option id="Eggplant" value="Eggplant">Eggplant</option>
      <option id="Elderberry" value="Elderberry">Elderberry</option>
      <option id="Fennel" value="Fennel">Fennel</option>
      <option id="Fig" value="Fig">Fig</option>
      <option id="Garlic" value="Garlic">Garlic</option>
      <option id="Grape" value="Grape">Grape</option>
      <option id="Honeydew-melon" value="Honeydew melon">
        Honeydew melon
      </option>
      <option id="Iceberg-lettuce" value="Iceberg lettuce">
        Iceberg lettuce
      </option>
      <option id="Jerusalem-artichoke" value="Jerusalem artichoke">
        Jerusalem artichoke
      </option>
      <option id="Kale" value="Kale">Kale</option>
      <option id="Kiwi" value="Kiwi">Kiwi</option>
      <option id="Leek" value="Leek">Leek</option>
      <option id="Lemon" value="Lemon">Lemon</option>
      <option id="Mango" value="Mango">Mango</option>
      <option id="Mangosteen" value="Mangosteen">Mangosteen</option>
      <option id="Melon" value="Melon">Melon</option>
      <option id="Mushroom" value="Mushroom">Mushroom</option>
      <option id="Nectarine" value="Nectarine">Nectarine</option>
      <option id="Okra" value="Okra">Okra</option>
      <option id="Olive" value="Olive">Olive</option>
      <option id="Onion" value="Onion">Onion</option>
      <option id="Orange" value="Orange">Orange</option>
      <option id="Parship" value="Parship">Parship</option>
      <option id="Pea" value="Pea">Pea</option>
      <option id="Pear" value="Pear">Pear</option>
      <option id="Pineapple" value="Pineapple">Pineapple</option>
      <option id="Potato" value="Potato">Potato</option>
      <option id="Pumpkin" value="Pumpkin">Pumpkin</option>
      <option id="Quince" value="Quince">Quince</option>
      <option id="Radish" value="Radish">Radish</option>
      <option id="Rhubarb" value="Rhubarb">Rhubarb</option>
      <option id="Shallot" value="Shallot">Shallot</option>
      <option id="Spinach" value="Spinach">Spinach</option>
      <option id="Squash" value="Squash">Squash</option>
      <option id="Strawberry" value="Strawberry">Strawberry</option>
      <option id="Sweet-potato" value="Sweet potato">Sweet potato</option>
      <option id="Tomato" value="Tomato">Tomato</option>
      <option id="Turnip" value="Turnip">Turnip</option>
      <option id="Ugli-fruit" value="Ugli fruit">Ugli fruit</option>
      <option id="Victoria-plum" value="Victoria plum">
        Victoria plum
      </option>
      <option id="Watercress" value="Watercress">Watercress</option>
      <option id="Watermelon" value="Watermelon">Watermelon</option>
      <option id="Yam" value="Yam">Yam</option>
      <option id="Zucchi" value="Zucchi">Zucchi</option>
    </datalist>

    <button type="submit" class="combobox-example__button">Submit</button>
  </form>
</div>

<?php includeShowcode("dataset-example")?>

<script type="application/json" id="dataset-example-props">
{
  "replaceHtmlRules": {
    "datalist": [
      "<option id=\"Apple\" value=\"Apple\">Apple</option>",
      "<option id=\"Artichoke\" value=\"Artichoke\">Artichoke</option>",
      "",
      "...",
      ""
    ]
  },
  "steps": [{
      "label": "Create label for input tag.",
      "highlight": "for",
      "notes": "Just like any other form element, this needs a proper label."
    },
    {
      "label": "Give keyboard instructions using aria-describedby.",
      "highlight": "aria-describedby",
      "notes": "Since accessibility API support is a little sketchy right now, these instructions may help some screen reader users use this component properly."
    },
    {
      "label": "Set up the datalist options",
      "highlight": "%OPENCLOSECONTENTTAG%datalist",
      "notes": "Note that the content of this is similar to the <code>select</code> tag.  It's basically a list of options."
    }
  ]
}
</script>


<h2 id="aria-combobox" tabindex="-1">Enable's ARIA combobox.</h2>

<?php includeStats(array('isForNewBuilds' => true, 'comment' => 'This combobox works better with screen readers than the native HTML5 version')) ?>
<?php includeStats(array('isNPM' => true)) ?>

<p>
  This is a heavily refactored version of
  <a href="https://webkit.org/blog-files/aria1.0/combobox_with_live_region_status.html">the combobox example at
    webkit.org</a>. Added was a few extra instructions and UX features for screen reader users so
  they could use and understand the autocomplete features in this widget. If you start typing into the combobox, screen
  readers will tell users when autocomplete items appear and how many there are.
</p>



<div class="enable-example">
  <div id="example1" class="enable-combobox">
    <form class="combobox-example">
      <label id="aria-fruit__label" for="aria-fruit"> Enter a fruit or vegetable </label>
      <div class="enable-combobox__inner-container">
        <div class="enable-combobox__controls-container">
          <input type="text" id="aria-fruit" aria-describedby="aria-fruit__desc" role="combobox"
            aria-autocomplete="list" aria-owns="aria-fruit__list" aria-expanded="false" autocomplete="off"
            autocorrect="off" autocapitalize="off" required>
          <div role="alert" aria-atomic="true" aria-live="assertive"></div>
          <button class="enable-combobox__reset-button" aria-controls="aria-fruit" type="reset"
            aria-describedby="aria-fruit__label">
            <img class="enable-combobox__reset-button-image" src="images/close-window.svg" alt="Clear">
          </button>


          <ul role="listbox" id="aria-fruit__list" tabindex="-1" hidden>
            <li tabindex="-1" role="option">Apple</li>
            <li tabindex="-1" role="option">Artichoke</li>
            <li tabindex="-1" role="option">Asparagus</li>
            <li tabindex="-1" role="option">Banana</li>
            <li tabindex="-1" role="option">Beets</li>
            <li tabindex="-1" role="option">Bell pepper</li>
            <li tabindex="-1" role="option">Broccoli</li>
            <li tabindex="-1" role="option">Brussels sprout</li>
            <li tabindex="-1" role="option">Cabbage</li>
            <li tabindex="-1" role="option">Carrot</li>
            <li tabindex="-1" role="option">Cauliflower</li>
            <li tabindex="-1" role="option">Celery</li>
            <li tabindex="-1" role="option">Chard</li>
            <li tabindex="-1" role="option">Chicory</li>
            <li tabindex="-1" role="option">Corn</li>
            <li tabindex="-1" role="option">Cucumber</li>
            <li tabindex="-1" role="option">Daikon</li>
            <li tabindex="-1" role="option">Date</li>
            <li tabindex="-1" role="option">Edamame</li>
            <li tabindex="-1" role="option">Eggplant</li>
            <li tabindex="-1" role="option">Elderberry</li>
            <li tabindex="-1" role="option">Fennel</li>
            <li tabindex="-1" role="option">Fig</li>
            <li tabindex="-1" role="option">Garlic</li>
            <li tabindex="-1" role="option">Grape</li>
            <li tabindex="-1" role="option">Honeydew melon</li>
            <li tabindex="-1" role="option">Iceberg lettuce</li>
            <li tabindex="-1" role="option">
              Jerusalem artichoke
            </li>
            <li tabindex="-1" role="option">Kale</li>
            <li tabindex="-1" role="option">Kiwi</li>
            <li tabindex="-1" role="option">Leek</li>
            <li tabindex="-1" role="option">Lemon</li>
            <li tabindex="-1" role="option">Mango</li>
            <li tabindex="-1" role="option">Mangosteen</li>
            <li tabindex="-1" role="option">Melon</li>
            <li tabindex="-1" role="option">Mushroom</li>
            <li tabindex="-1" role="option">Nectarine</li>
            <li tabindex="-1" role="option">Okra</li>
            <li tabindex="-1" role="option">Olive</li>
            <li tabindex="-1" role="option">Onion</li>
            <li tabindex="-1" role="option">Orange</li>
            <li tabindex="-1" role="option">Parship</li>
            <li tabindex="-1" role="option">Pea</li>
            <li tabindex="-1" role="option">Pear</li>
            <li tabindex="-1" role="option">Pineapple</li>
            <li tabindex="-1" role="option">Potato</li>
            <li tabindex="-1" role="option">Pumpkin</li>
            <li tabindex="-1" role="option">Quince</li>
            <li tabindex="-1" role="option">Radish</li>
            <li tabindex="-1" role="option">Rhubarb</li>
            <li tabindex="-1" role="option">Shallot</li>
            <li tabindex="-1" role="option">Spinach</li>
            <li tabindex="-1" role="option">Squash</li>
            <li tabindex="-1" role="option">Strawberry</li>
            <li tabindex="-1" role="option">Sweet potato</li>
            <li tabindex="-1" role="option">Tomato</li>
            <li tabindex="-1" role="option">Turnip</li>
            <li tabindex="-1" role="option">Ugli fruit</li>
            <li tabindex="-1" role="option">Victoria plum</li>
            <li tabindex="-1" role="option">Watercress</li>
            <li tabindex="-1" role="option">Watermelon</li>
            <li tabindex="-1" role="option">Yam</li>
            <li tabindex="-1" role="option">Zucchi</li>
          </ul>

          <div class="sr-only" id="aria-fruit__desc">
            As you type, press the enter key or use the up and down arrow keys to choose the autocomplete items.
          </div>
        </div>
      </div>
      <button type="submit" class="combobox-example__button">Submit</button>
    </form>
  </div>
</div>




<?php includeShowcode("example1")?>
<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {
    "[role=\"listbox\"]": "<li role=\"option\" value=\"Apple\">Apple</li><li role=\"option\" value=\"Artichoke\">Artichoke</li> ..."
  },
  "steps": [{
      "label": "Place ARIA roles in document",
      "highlight": "role=\"combobox\"",
      "notes": "The input field must have a role of combobox in order for it to be announced correctly by the screen reader."
    },
    {
      "label": "Code label to be associated with input",
      "highlight": "for",
      "notes": "Ensure the label is properly lababelled"
    },
    {
      "label": "Component instructions for the component using aria-describedby",
      "highlight": "aria-describedby",
      "notes": "These instructions are visibly hidden, since they are only for screen reader users."
    },
    {
      "label": "Associate the dropdown data with the input field",
      "highlight": "aria-owns",
      "notes": "This ensures the two elements are linked"
    },
    {
      "label": "Set aria-autocomplete attribute",
      "highlight": "aria-autocomplete",
      "notes": "This tells the screen reader the type of autocompletion that is being done.  Possible values are <code>list</code> and <code>inline</code>."
    },
    {
      "label": "Expose state of the dropdown",
      "highlight": "aria-expanded",
      "notes": "<p>When the menu is expanded, this should be set to <code>\"true\"</code>. Otherwise, it is set to <code>\"false\"</code>.</p><p>Note that when the dropdown is expanded, focus should go to the first element in the dropdown. The user should be able to cycle through the elements in the dropdown using the arrow keys.</p><p>When the user picks an element with the ENTER key, the dropdown should close and the element should be selected."
    },
    {
      "label": "Turn off autocorrect and autocomplete",
      "highlight": "autocomplete=\"off\" ||| autocorrect ||| autocapitalize=\"off\"",
      "notes": "If we want to ensure the user can only pick the items in the dropdown, we have to make sure these items are shut off."
    },
    {
      "label": "Insert roles for autocomplete list",
      "highlight": "role=\"listbox\" ||| role=\"option\"",
      "notes": "Options must be direct children of listbox"
    }
  ]
}
</script>


<h2>Autosubmit Using an ARIA Combobox</h2>

<?php includeStats(array('isNPM' => true, 'comment' => 'This is a feature of the NPM module described in the <a href="#aria-combobox">previous section</a>.')) ?>

<p>
    There are many e-commerce sites that have a search form with a combobox that submits when the user chooses one of the options.
    This section shows an accessible proof-of-concept.
</p>

<div id="submit-on-select-example" class="enable-example">
  <form role="search" aria-label="1980s video game search" tabindex="-1" class="combobox-example">
    <div class="enable-combobox">
      <label id="video-games__label" for="video-games">Search for your favourite 1980s Video Game:</label>
      <div class="enable-combobox__inner-container">
        <div id="video-games__close-desc" class="sr-only">
          Please choose a value using the arrow keys or clear the combobox by either pressing the escape key or activating the
          clear button.  Pressing enter will search for the item on Google.
        </div>

        <div class="enable-combobox__controls-container">

          <div class="sr-only" id="video-games__desc">
            As you type, use the up and down arrow keys or press ENTER and swipe to choose the autocomplete
            items.
          </div>


          <div role="alert" aria-atomic="true" aria-live="polite">

          </div>


          <input type="text" tabindex="0" id="video-games" role="combobox" aria-autocomplete="list"
            aria-owns="video-games__list" aria-expanded="false" autocomplete="off" autocorrect="off" autocapitalize="off"
            aria-describedby="video-games__desc">

          <button class="enable-combobox__reset-button" aria-controls="video-games__list" type="reset"
            aria-describedby="video-games__label">
            <img class="enable-combobox__reset-button-image" src="images/close-window.svg" alt="Clear"
              aria-describedby="video-games__label">
          </button>

          <ul role="listbox" id="video-games__list" tabindex="-1" hidden>
            <li tabindex="-1" role="option">1942</li>
            <li tabindex="-1" role="option">Asteroids</li>
            <li tabindex="-1" role="option">Battlezone</li>
            <li tabindex="-1" role="option">Berzerk</li>
            <li tabindex="-1" role="option">BurgerTime</li>
            <li tabindex="-1" role="option">Centipede</li>
            <li tabindex="-1" role="option">Champion Baseball</li>
            <li tabindex="-1" role="option">Crystal Castles</li>
            <li tabindex="-1" role="option">Defender</li>
            <li tabindex="-1" role="option">Dig Dug</li>
            <li tabindex="-1" role="option">Donkey Kong</li>
            <li tabindex="-1" role="option">Donkey Kong Jr.</li>
            <li tabindex="-1" role="option">Dragon's Lair</li>
            <li tabindex="-1" role="option">Elevator Action</li>
            <li tabindex="-1" role="option">Frogger</li>
            <li tabindex="-1" role="option">Front Line</li>
            <li tabindex="-1" role="option">Galaga</li>
            <li tabindex="-1" role="option">Galaxian</li>
            <li tabindex="-1" role="option">Gorf</li>
            <li tabindex="-1" role="option">Gravitar</li>
            <li tabindex="-1" role="option">Gyruss</li>
            <li tabindex="-1" role="option">Joust</li>
            <li tabindex="-1" role="option">Jungle King</li>
            <li tabindex="-1" role="option">Kangaroo</li>
            <li tabindex="-1" role="option">Karate Champ</li>
            <li tabindex="-1" role="option">Kung-Fu Master</li>
            <li tabindex="-1" role="option">Lunar Lander</li>
            <li tabindex="-1" role="option">Mappy</li>
            <li tabindex="-1" role="option">Mario Bros.</li>
            <li tabindex="-1" role="option">Missile Command</li>
            <li tabindex="-1" role="option">Moon Patrol</li>
            <li tabindex="-1" role="option">Ms. Pac-Man</li>
            <li tabindex="-1" role="option">Pac-Man</li>
            <li tabindex="-1" role="option">Paperboy</li>
            <li tabindex="-1" role="option">Pengo</li>
            <li tabindex="-1" role="option">Phoenix</li>
            <li tabindex="-1" role="option">Pole Position</li>
            <li tabindex="-1" role="option">Popeye</li>
            <li tabindex="-1" role="option">Punch-Out!!</li>
            <li tabindex="-1" role="option">Q*bert</li>
            <li tabindex="-1" role="option">Qix</li>
            <li tabindex="-1" role="option">Rally-X</li>
            <li tabindex="-1" role="option">Robotron 2084</li>
            <li tabindex="-1" role="option">Scramble</li>
            <li tabindex="-1" role="option">Sinistar</li>
            <li tabindex="-1" role="option">Space Invaders</li>
            <li tabindex="-1" role="option">Spy Hunter</li>
            <li tabindex="-1" role="option">Star Castle</li>
            <li tabindex="-1" role="option">Star Trek: Strategic Operations Simulator</li>
            <li tabindex="-1" role="option">Star Wars</li>
            <li tabindex="-1" role="option">Tapper</li>
            <li tabindex="-1" role="option">Tempest</li>
            <li tabindex="-1" role="option">Time Pilot</li>
            <li tabindex="-1" role="option">Track & Field</li>
            <li tabindex="-1" role="option">Tron</li>
            <li tabindex="-1" role="option">Vanguard</li>
            <li tabindex="-1" role="option">Wizard of Wor</li>
            <li tabindex="-1" role="option">Xevious</li>
            <li tabindex="-1" role="option">Zaxxon</li>
          </ul>


        </div>
      </div>

      <button type="submit" class="combobox-example__button">Submit</button>
    </div>
  </form>
</div>

<?php includeShowcode("submit-on-select-example", "", "", "
            <p><strong>Note: since it is very similar, please follow all the steps in the two previous examples first before
            implementing the following steps.</strong></p>
        ")?>

<script type="application/json" id="submit-on-select-example-props">
{
  "replaceHtmlRules": {
    "[role=\"listbox\"]": [
      "<div class=\"enable-combobox__group\" role=\"presentation\">",
      "<h2 class=\"enable-combobox__group-header\">Communist States</h2>",
      "",
      "<div role=\"option\" >People's Republic of China</div>",
      "",
      "...",
      "",
      "</div>",
      "<div class=\"enable-combobox__group\" role=\"presentation\">",
      "<h2 class=\"enable-combobox__group-header\">Other States</h2>",
      "<div role=\"option\" >Afghanistan</div>",
      "",
      "...",
      "</div>"
    ]
  },
  "steps": [{
    "label": "Create JS code to submit query when clicking the option elements.",
    "highlight": "%INLINE% autocomplete-submit",
    "notes": "Note that custom event <code>combobox-change</code> that this event handler uses. This fires when an option is chosen from the list.  It takes the value chosen and puts it inside a Google Search URL, using URLSearchParams and a template string."
  }]
}
</script>


<h2>ARIA Combobox With Categories</h2>

<?php includeStats(array('isNPM' => true, 'comment' => 'This is an experimental feature of the NPM library described in the <a href="#aria-combobox">previous section</a>')) ?>

<p>Another ARIA combobox example, this time with the options grouped into categories.
  Note the special formatting in the dropdown. This is common
  in a lot of modern searchboxes in the headings of a lot of e-commerce sites.</p>

<div id="example2" class="enable-example">
  <form class="combobox-example">
    <div class="enable-combobox">
      <label id="aria-example-2__label" for="aria-example-2"> Enter a name of a country or de jure sovereign state</label>
      <div class="enable-combobox__inner-container">
        <div class="enable-combobox__controls-container">

          <div class="sr-only" id="aria-example-2__desc">
            As you type, use the up and down arrow keys (or swipe left and
            right) to choose the autocomplete items.
          </div>

          <output role="alert" aria-atomic="true" aria-live="polite">
          </output>

          <output role="alert" class="enable-combobox__category-alert sr-only" aria-atomic="true" aria-live="assertive">
          </output>

          <input type="text" tabindex="0" id="aria-example-2" role="combobox" aria-autocomplete="list"
            aria-owns="aria-example-2__list" aria-expanded="false" autocomplete="off" autocorrect="off"
            autocapitalize="off" aria-describedby="aria-example-2__desc">
          <button class="enable-combobox__reset-button" aria-controls="aria-fruit" type="reset">
            <img class="enable-combobox__reset-button-image" src="images/close-window.svg" alt="Clear"
              aria-describedby="aria-example-2__label">
          </button>

          <div role="listbox" id="aria-example-2__list" hidden>
            <div class="enable-combobox__group" role="group" aria-describedby="cat-1">
            <!-- The "Communist States" heading has a permalink and is included in the TOC when it shouldn't be -->
              <h2 class="enable-combobox__group-header" role="presentation" id="cat-1">Communist States</h2>

              <div role="option">People's Republic of China</div>
              <div role="option">
                Democratic
                People's Republic of Korea (North Korea)</div>
              <div role="option">Socialist Republic of Vietnam
              </div>
              <div role="option">Lao People's
                Democratic
                Republic (Laos)</div>
              <div role="option">Republic of Cuba</div>
            </div>

            <div class="enable-combobox__group" role="group" aria-describedby="cat-2">
            <!-- The "Other States" heading has a permalink and is included in the TOC when it shouldn't be -->
              <h2 class="enable-combobox__group-header" role="presentation" id="cat-2">Other States</h2>
              <div role="option">Afghanistan</div>
              <div role="option">Albania</div>
              <div role="option">Algeria</div>
              <div role="option">Andorra</div>
              <div role="option">Angola</div>
              <div role="option">Antigua and Barbuda</div>
              <div role="option">Argentina</div>
              <div role="option">Armenia</div>
              <div role="option">Australia</div>
              <div role="option">Austria</div>
              <div role="option">Azerbaijan</div>
              <div role="option">Bahamas</div>
              <div role="option">Bahrain</div>
              <div role="option">Bangladesh</div>
              <div role="option">Barbados</div>
              <div role="option">Belarus</div>
              <div role="option">Belgium</div>
              <div role="option">Belize</div>
              <div role="option">Benin</div>
              <div role="option">Bhutan</div>
              <div role="option">Bolivia</div>
              <div role="option">Bosnia and Herzegovina</div>
              <div role="option">Botswana</div>
              <div role="option">Brazil</div>
              <div role="option">Brunei </div>
              <div role="option">Bulgaria</div>
              <div role="option">Burkina Faso</div>
              <div role="option">Burundi</div>
              <div role="option">Cabo Verde</div>
              <div role="option">Cambodia</div>
              <div role="option">Cameroon</div>
              <div role="option">Canada</div>
              <div role="option">Central African Republic</div>
              <div role="option">Chad</div>
              <div role="option">Chile</div>
              <div role="option">Colombia</div>
              <div role="option">Comoros</div>
              <div role="option">Congo</div>
              <div role="option">Costa Rica</div>
              <div role="option">Croatia</div>
              <div role="option">Cyprus</div>
              <div role="option">Czech Republic (Czechia)</div>
              <div role="option">Côte d'Ivoire</div>
              <div role="option">DR Congo</div>
              <div role="option">Denmark</div>
              <div role="option">Djibouti</div>
              <div role="option">Dominica</div>
              <div role="option">Dominican Republic</div>
              <div role="option">Ecuador</div>
              <div role="option">Egypt</div>
              <div role="option">El Salvador</div>
              <div role="option">Equatorial Guinea</div>
              <div role="option">Eritrea</div>
              <div role="option">Estonia</div>
              <div role="option">Eswatini</div>
              <div role="option">Ethiopia</div>
              <div role="option">Fiji</div>
              <div role="option">Finland</div>
              <div role="option">France</div>
              <div role="option">Gabon</div>
              <div role="option">Gambia</div>
              <div role="option">Georgia</div>
              <div role="option">Germany</div>
              <div role="option">Ghana</div>
              <div role="option">Greece</div>
              <div role="option">Grenada</div>
              <div role="option">Guatemala</div>
              <div role="option">Guinea</div>
              <div role="option">Guinea-Bissau</div>
              <div role="option">Guyana</div>
              <div role="option">Haiti</div>
              <div role="option">Holy See</div>
              <div role="option">Honduras</div>
              <div role="option">Hungary</div>
              <div role="option">Iceland</div>
              <div role="option">India</div>
              <div role="option">Indonesia</div>
              <div role="option">Iran</div>
              <div role="option">Iraq</div>
              <div role="option">Ireland</div>
              <div role="option">Israel</div>
              <div role="option">Italy</div>
              <div role="option">Jamaica</div>
              <div role="option">Japan</div>
              <div role="option">Jordan</div>
              <div role="option">Kazakhstan</div>
              <div role="option">Kenya</div>
              <div role="option">Kiribati</div>
              <div role="option">Kuwait</div>
              <div role="option">Kyrgyzstan</div>
              <div role="option">Latvia</div>
              <div role="option">Lebanon</div>
              <div role="option">Lesotho</div>
              <div role="option">Liberia</div>
              <div role="option">Libya</div>
              <div role="option">Liechtenstein</div>
              <div role="option">Lithuania</div>
              <div role="option">Luxembourg</div>
              <div role="option">Madagascar</div>
              <div role="option">Malawi</div>
              <div role="option">Malaysia</div>
              <div role="option">Maldives</div>
              <div role="option">Mali</div>
              <div role="option">Malta</div>
              <div role="option">Marshall Islands</div>
              <div role="option">Mauritania</div>
              <div role="option">Mauritius</div>
              <div role="option">Mexico</div>
              <div role="option">Micronesia</div>
              <div role="option">Moldova</div>
              <div role="option">Monaco</div>
              <div role="option">Mongolia</div>
              <div role="option">Montenegro</div>
              <div role="option">Morocco</div>
              <div role="option">Mozambique</div>
              <div role="option">Myanmar</div>
              <div role="option">Namibia</div>
              <div role="option">Nauru</div>
              <div role="option">Nepal</div>
              <div role="option">Netherlands</div>
              <div role="option">New Zealand</div>
              <div role="option">Nicaragua</div>
              <div role="option">Niger</div>
              <div role="option">Nigeria</div>
              <div role="option">North Macedonia</div>
              <div role="option">Norway</div>
              <div role="option">Oman</div>
              <div role="option">Pakistan</div>
              <div role="option">Palau</div>
              <div role="option">Panama</div>
              <div role="option">Papua New Guinea</div>
              <div role="option">Paraguay</div>
              <div role="option">Peru</div>
              <div role="option">Philippines</div>
              <div role="option">Poland</div>
              <div role="option">Portugal</div>
              <div role="option">Qatar</div>
              <div role="option">Romania</div>
              <div role="option">Russia</div>
              <div role="option">Rwanda</div>
              <div role="option">Saint Kitts &amp; Nevis</div>
              <div role="option">Saint Lucia</div>
              <div role="option">Samoa</div>
              <div role="option">San Marino</div>
              <div role="option">Sao Tome &amp; Principe</div>
              <div role="option">Saudi Arabia</div>
              <div role="option">Senegal</div>
              <div role="option">Serbia</div>
              <div role="option">Seychelles</div>
              <div role="option">Sierra Leone</div>
              <div role="option">Singapore</div>
              <div role="option">Slovakia</div>
              <div role="option">Slovenia</div>
              <div role="option">Solomon Islands</div>
              <div role="option">Somalia</div>
              <div role="option">South Africa</div>
              <div role="option">South Korea</div>
              <div role="option">South Sudan</div>
              <div role="option">Spain</div>
              <div role="option">Sri Lanka</div>
              <div role="option">St. Vincent &amp; Grenadines
              </div>
              <div role="option">State of Palestine</div>
              <div role="option">Sudan</div>
              <div role="option">Suriname</div>
              <div role="option">Sweden</div>
              <div role="option">Switzerland</div>
              <div role="option">Syria</div>
              <div role="option">Tajikistan</div>
              <div role="option">Tanzania</div>
              <div role="option">Thailand</div>
              <div role="option">Timor-Leste</div>
              <div role="option">Togo</div>
              <div role="option">Tonga</div>
              <div role="option">Trinidad and Tobago</div>
              <div role="option">Tunisia</div>
              <div role="option">Turkey</div>
              <div role="option">Turkmenistan</div>
              <div role="option">Tuvalu</div>
              <div role="option">Uganda</div>
              <div role="option">Ukraine</div>
              <div role="option">United Arab Emirates</div>
              <div role="option">United Kingdom</div>
              <div role="option">United States</div>
              <div role="option">Uruguay</div>
              <div role="option">Uzbekistan</div>
              <div role="option">Vanuatu</div>
              <div role="option">Venezuela</div>
              <div role="option">Yemen</div>
              <div role="option">Zambia</div>
              <div role="option">Zimbabwe</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="combobox-example__button">Submit</button> 
  </form>

  <template id="enable_combobox__group-select-alert-template">
    ${value}, ${desc} group, ${label}, selected, item ${index} of ${length};
  </template>
</div>


<?php includeShowcode("example2", "", "", "
            <p><strong>Note: since it is very similar, please follow all the steps in the previous example first before
            implementing the following steps.</strong></p>
        ")?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {
    "[role=\"listbox\"]": [
      "<div class=\"enable-combobox__group\" role=\"group\" aria-describedby=\"cat-1\">",
      "<h2 class=\"enable-combobox__group-header\" role=\"presentation\" id=\"cat-1\">Communist States</h2>",
      "",
      "<div role=\"option\" >People's Republic of China</div>",
      "",
      "...",
      "",
      "</div>",
      "<div class=\"enable-combobox__group\" role=\"group\" aria-describedby=\"cat-2\">",
      "<h2 class=\"enable-combobox__group-header\" role=\"presentation\" id=\"cat-2\">Other States</h2>",
      "<div role=\"option\" >Afghanistan</div>",
      "",
      "...",
      "</div>"
    ]
  },
  "steps": [{
      "label": "Set up group roles",
      "highlight": "role=\"group\"",
      "notes": "Options that need to be grouped into categories with this markup"
    },
    {
      "label": "Set up presentation roles on the category headings",
      "highlight": "role=\"presentation\"",
      "notes": "The presentation role <em>should</em> prevent the category label from being included in the final count of options given to the user (we will be using a workaround for combinations like Voiceover/Safari that don't support this)."
    },
    {
      "label": "Mark up the category headings ",
      "highlight": "aria-describedby=\"cat-1\" ||| id=\"cat-1\" ||| aria-describedby=\"cat-2\" ||| id=\"cat-2\"",
      "notes": "This is to ensure compliant screen readers know what the label is for each of the option groups.  (We will be using a workaround for combinations like Voiceover/Safari that don't support this)."
    },
    {
      "label": "Set up ARIA live regions",
      "highlight": "%OPENCLOSECONTENTTAG%output",
      "notes": "<ul><li>The first aria region will contain the number of items in the filtered list as the user types characters into the <code>&lt;input&gt;</code> field.</li><li>(Optional, for cross-browser/cross-screen reader support) The second one is used when screen reader users use the arrow keys to select an item in the combobox's list.  Note that what is announced will be in English by default, or in the format given in the template in the next step.<br /><br />If this last ARIA-live region isn't defined, screen readers may not read the proper group label and item index of the value the user selects.</li></ul>"
    },
    {
      "label": "(Optional) Template for grouped output for non-compliant screen readers",
      "highlight": "%OPENCLOSECONTENTTAG%template",
      "notes": "This is used to override the screen reader output that is given when the user uses the arrow keys to select an item in the list.  We do this to override output in some combinations, like Voiceover/Safari, that don't give out the category information correctly.  If this isn't given, the library will use a default format in English."
    }
  ]
}
</script>


<?= includeNPMInstructions('combobox', array(), 'enable-combobox', false, array(), '.enable-combobox') ?>