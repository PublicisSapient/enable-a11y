<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ARIA combobox role examples</title>
    <?php include("includes/common-head-tags.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/combobox__improved.css" />
  </head>

  <body>
    <?php include("includes/example-header.php"); ?>

    <main>
      <aside class="notes">
        <p>
          Example 1 is based on
          <a
            href="https://webkit.org/blog-files/aria1.0/combobox_with_live_region_status.html"
            >this example page</a
          >, with a few extra instructions given to screen reader users to
          ensure the understand how to use the widget. Note that it works way
          better than the native HTML5 <code>&lt;datalist&gt;</code> version. It
          is a huge exception to the rule that native works better than
          ARIA-based code.
        </p>
      </aside>

      <h1>ARIA combobox role examples</h1>

      <h2>Example 1:</h2>

      <form>
        <label for="aria-fruit"> Enter a fruit or vegetable </label>
        <div class="enable-combobox">
          <!-- 
                    This announces instructions to screen reader users when
                    they focus into the widget
                -->
          <div class="visually-hidden" id="aria-fruit__desc">
            As you type, use the up and down arrow keys (or swipe left and
            right) to choose the autocomplete items.
          </div>

          <!--
                    This live region will announce how many items are visible
                    in the dropdown after the user types in characters into the
                    input. (e.g. 4 items).
                -->
          <div role="status" aria-atomic="true">
            <!-- This is the list status live region: e.g. "4 items." -->
          </div>

          <!--
                    The focusable part of the widget.
                -->
          <input
            type="text"
            tabindex="0"
            id="aria-fruit"
            role="combobox"
            aria-autocomplete="list"
            aria-owns="aria-fruit__list"
            aria-expanded="false"
            autocomplete="off"
            autocorrect="off"
            autocapitalize="off"
            aria-describedby="aria-fruit__desc"
          />

          <!--
                    The dropdown (a.k.a. "listbox")
                -->
          <ul role="listbox" id="aria-fruit__list" hidden>
            <li role="option" value="Apple">Apple</li>
            <li role="option" value="Artichoke">Artichoke</li>
            <li role="option" value="Asparagus">Asparagus</li>
            <li role="option" value="Banana">Banana</li>
            <li role="option" value="Beets">Beets</li>
            <li role="option" value="Bell pepper">Bell pepper</li>
            <li role="option" value="Broccoli">Broccoli</li>
            <li role="option" value="Brussels sprout">Brussels sprout</li>
            <li role="option" value="Cabbage">Cabbage</li>
            <li role="option" value="Carrot">Carrot</li>
            <li role="option" value="Cauliflower">Cauliflower</li>
            <li role="option" value="Celery">Celery</li>
            <li role="option" value="Chard">Chard</li>
            <li role="option" value="Chicory">Chicory</li>
            <li role="option" value="Corn">Corn</li>
            <li role="option" value="Cucumber">Cucumber</li>
            <li role="option" value="Daikon">Daikon</li>
            <li role="option" value="Date">Date</li>
            <li role="option" value="Edamame">Edamame</li>
            <li role="option" value="Eggplant">Eggplant</li>
            <li role="option" value="Elderberry">Elderberry</li>
            <li role="option" value="Fennel">Fennel</li>
            <li role="option" value="Fig">Fig</li>
            <li role="option" value="Garlic">Garlic</li>
            <li role="option" value="Grape">Grape</li>
            <li role="option" value="Honeydew melon">Honeydew melon</li>
            <li role="option" value="Iceberg lettuce">Iceberg lettuce</li>
            <li role="option" value="Jerusalem artichoke">
              Jerusalem artichoke
            </li>
            <li role="option" value="Kale">Kale</li>
            <li role="option" value="Kiwi">Kiwi</li>
            <li role="option" value="Leek">Leek</li>
            <li role="option" value="Lemon">Lemon</li>
            <li role="option" value="Mango">Mango</li>
            <li role="option" value="Mangosteen">Mangosteen</li>
            <li role="option" value="Melon">Melon</li>
            <li role="option" value="Mushroom">Mushroom</li>
            <li role="option" value="Nectarine">Nectarine</li>
            <li role="option" value="Okra">Okra</li>
            <li role="option" value="Olive">Olive</li>
            <li role="option" value="Onion">Onion</li>
            <li role="option" value="Orange">Orange</li>
            <li role="option" value="Parship">Parship</li>
            <li role="option" value="Pea">Pea</li>
            <li role="option" value="Pear">Pear</li>
            <li role="option" value="Pineapple">Pineapple</li>
            <li role="option" value="Potato">Potato</li>
            <li role="option" value="Pumpkin">Pumpkin</li>
            <li role="option" value="Quince">Quince</li>
            <li role="option" value="Radish">Radish</li>
            <li role="option" value="Rhubarb">Rhubarb</li>
            <li role="option" value="Shallot">Shallot</li>
            <li role="option" value="Spinach">Spinach</li>
            <li role="option" value="Squash">Squash</li>
            <li role="option" value="Strawberry">Strawberry</li>
            <li role="option" value="Sweet potato">Sweet potato</li>
            <li role="option" value="Tomato">Tomato</li>
            <li role="option" value="Turnip">Turnip</li>
            <li role="option" value="Ugli fruit">Ugli fruit</li>
            <li role="option" value="Victoria plum">Victoria plum</li>
            <li role="option" value="Watercress">Watercress</li>
            <li role="option" value="Watermelon">Watermelon</li>
            <li role="option" value="Yam">Yam</li>
            <li role="option" value="Zucchi">Zucchi</li>
          </ul>
        </div>
      </form>

      <h2>Example 2: Using HTML5 datalist</h2>

      <p>
        Ironically, this seems to be inaccessible compared to the ARIA version:
      </p>

      <ul>
        <li>
          When a user types in values, the screen reader doesn't report that
          there are items are in the dropdown.
        </li>
        <li>
          If the user uses the up and down arrow keys, Voiceover doesn't read
          these values out.
        </li>
        <li>
          Because of the above reasons, it is one of the cases where ARIA works
          better.
        </li>
      </ul>

      <form>
        <label id="html5-fruit__label" for="html5-fruit" class="combobox-label">
          Enter a Fruit or Vegetable
        </label>
        <input
          id="html5-fruit"
          name="friuit"
          type="text"
          list="languages"
          aria-describedby="html5-fruit__desc"
        />
        <div class="visually-hidden" id="html5-fruit__desc">
          As you type, use the up and down arrow keys to choose the autocomplete
          items.
        </div>
        <div id="html5-fruit__statys" role="status" aria-atomic="true">
          <!-- This is the list status live region: e.g. "4 items." -->
        </div>
        <datalist role="listbox" id="languages">
          <option id="Apple" value="Apple">Apple</option>
          <option id="Artichoke" value="Artichoke">Artichoke</option>
          <option id="Asparagus" value="Asparagus">Asparagus</option>
          <option id="Banana" value="Banana">Banana</option>
          <option id="Beets" value="Beets">Beets</option>
          <option id="Bell pepper" value="Bell pepper">Bell pepper</option>
          <option id="Broccoli" value="Broccoli">Broccoli</option>
          <option id="Brussels sprout" value="Brussels sprout">
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
          <option id="Honeydew melon" value="Honeydew melon">
            Honeydew melon
          </option>
          <option id="Iceberg lettuce" value="Iceberg lettuce">
            Iceberg lettuce
          </option>
          <option id="Jerusalem artichoke" value="Jerusalem artichoke">
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
          <option id="Sweet potato" value="Sweet potato">Sweet potato</option>
          <option id="Tomato" value="Tomato">Tomato</option>
          <option id="Turnip" value="Turnip">Turnip</option>
          <option id="Ugli fruit" value="Ugli fruit">Ugli fruit</option>
          <option id="Victoria plum" value="Victoria plum">
            Victoria plum
          </option>
          <option id="Watercress" value="Watercress">Watercress</option>
          <option id="Watermelon" value="Watermelon">Watermelon</option>
          <option id="Yam" value="Yam">Yam</option>
          <option id="Zucchi" value="Zucchi">Zucchi</option>
        </datalist>
      </form>
    </main>

    <script src="js/combobox__improved.js"></script>
  </body>
</html>
