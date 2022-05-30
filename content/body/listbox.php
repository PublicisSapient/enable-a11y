<!-- <aside class="notes">
            <h2>Notes</h2>
            <ul>
                <li>tl;dr: Both versions are accessible, with slight differences in how they are reported to users.</li>

                <li>Screen reader interactions are as follows:

                    <ol>
                        <li>Tabbing into the widget:
                            <ul>
                                <li>
                                    <strong>Voiceover:</strong> The ARIA and native HTML versions state that they are
                                    "popup buttons"
                                    as well as the selected value.
                                </li>
                                <li>
                                    <strong>NVDA:</strong> The ARIA version is a "button" with "submenu", while the HTML
                                    version
                                    is a "combo box, collapsed"
                                </li>
                            </ul>
                        </li>
                    </ol>
                </li>
                <li>
                    Opening the widget:
                    <ul>
                        <li>
                            <strong>Voiceover:</strong> Reads out the selected value. The HTML version also reads how
                            many
                            other
                            options there are (e.g. menu 26 items)
                        </li>
                        <li>
                            <strong>NVDA:</strong> Both versions reads out the amount in the list as well as the
                            selected
                            value.
                            The ARIA version is described as a list and the HTML version is a "combo box, expanded".
                        </li>
                    </ul>
                </li>
                <li>
                    Selecting a value:
                </li><li>
                    <strong>Voiceover:</strong> ARIA version read out value as well as its place in the order in the
                    list
                    (e.g.
                    Californium, text, 2 of 26). Native version just reads the just the value
                    <strong>NVDA: ARIA and HTML versions read of the value and its place in the order in the
                        list.</strong>

                </li>
            </ul>
        </aside> -->





<p>
  Like radio button, a select box (known in ARIA as a listbox) is a great way to choose one from a list. While radio
  buttons are great for a small amount of choices, select boxes are better for a large set of choices.
</p>

<p>
  The TL;DR here is that you can use native <code>&lt;select&gt;</code> tags to create listboxes that are accessible and
  give a UI that is best for the device they are being displayed on (which is the recommended variation). If you want to
  control every aspect of the design, however, you can do this using ARIA <code>listbox</code> controls to do that.
</p>

<p>
  Please read this entire page before deciding. You don't want to make a decision that you regret as much as the one I
  made when I didn't invest in the Google IPO back in 2004.
</p>


<h2>HTML5 native select element example</h2>

<?php includeStats(array('isForNewBuilds' => true)) ?>

<p>
  Although native HTML5 select boxes were difficult to style in the past, <strong>it is possible to style the default
    (i.e. closed) state completely using CSS</strong>. We have used <a href="https://twitter.com/scottjehl">Scott
    Jehl</a>'s <a href="https://github.com/filamentgroup/select-css">cross
    browser CSS demo</a> to style our demo below.</p>

<p>
  <strong>The fact that we still can't style the options within a select box is a feature, not a bug.</strong>
  The gut reaction from a lot of designers is to change their appearance, since they understanably want to control
  ever aspect of the design of the user interface consistantly across browsers and devices. However, mobile browser
  manufacturers have optimized the HTML5 select box UI to use the strengths of the platform they run on.
  Take a look at how the options are displayed when the activates the control:
</p>

<figure>
  <figcaption id="screenshot-table__caption" class="caption">
    Screenshots of the HTML5 select box by platform
  </figcaption>

  <div class="can-horizontally-scroll__parent">
    <div class="sticky-table__container sticky-table__container--horizontal-scroll can-horizontally-scroll">
      <table class="screenshot-table" tabindex="0">
        <thead>
          <tr>
            <th scope="col">Firefox Desktop</th>
            <th scope="col">Chrome Android</th>
            <th scope="col">Safari iOS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><img src="images/pages/listbox/desktop-select-options.png"
                alt="Like all desktop web browsers, Firefox on OSX displays the select box options are in a scrollable list positioned directly below the button that opens it.">
            </td>
            <td><img src="images/pages/listbox/android-select-options.png"
                alt="The options of the select box in Chrome for Android appear in a scrollable modal overlayed on top of the page. The options text takes up most of the width of the viewport.">
            </td>
            <td><img src="images/pages/listbox/ios-select-options.png"
                alt="Safari for iOS displays the select box options in a 3-D scroll wheel on the bottom of the viewport. It also takes up the full width of the screen.">
            </td>

          </tr>
        </tbody>
      </table>
    </div>
  </div>
</figure>

<p>
  Designers can style the closed version of HTML5 select boxes, but not that of the optimized UI. I urge designers to
  embrace this <strong>feature, not a bug</strong> mantra for select boxes. You will make your users happier.
</p>



<p>What follows is an excellent customly styled native HTML5 select box. It uses code from <a
    href="https://twitter.com/scottjehl">Scott Jehl</a>'s <a href="https://github.com/filamentgroup/select-css">cross
    browser CSS demo</a> that you can download via
  NPM.
  Instead of putting my usual notes as an explantion, visit their blog post <a
    href="https://www.filamentgroup.com/lab/select-css.html">Styling a Select Like It’s 2019</a>.

</p>

<div id="html5-example" class="enable-example">
  <label class="select-css__label" for="fave-fruit">
    Favourite fruit:
  </label>
  <select id="fave-fruit" class="select-css">
    <option value="">Choose one…</option>

    <option value="Np">
      Neptunium
    </option>
    <option value="Pu">
      Plutonium
    </option>
    <option value="Am">
      Americium
    </option>
    <option value="Cm">
      Curium
    </option>
    <option value="Bk">
      Berkelium
    </option>
    <option value="Cf">
      Californium
    </option>
    <option value="Es">
      Einsteinium
    </option>
    <option value="Fm">
      Fermium
    </option>
    <option value="Md">
      Mendelevium
    </option>
    <option value="No">
      Nobelium
    </option>
    <option value="Lr">
      Lawrencium
    </option>
    <option value="Rf">
      Rutherfordium
    </option>
    <option value="Db">
      Dubnium
    </option>
    <option value="Sg">
      Seaborgium
    </option>
    <option value="Bh">
      Bohrium
    </option>
    <option value="Hs">
      Hassium
    </option>
    <option value="Mt">
      Meitnerium
    </option>
    <option value="Ds">
      Darmstadtium
    </option>
    <option value="Rg">
      Roentgenium
    </option>
    <option value="Cn">
      Copernicium
    </option>
    <option value="Nh">
      Nihonium
    </option>
    <option value="Fl">
      Flerovium
    </option>
    <option value="Mc">
      Moscovium
    </option>
    <option value="Lv">
      Livermorium
    </option>
    <option value="Ts">
      Tennessine
    </option>
    <option value="Og">
      Oganesson
    </option>

  </select>
</div>

<?php includeShowcode("html5-example")?>

<script type="application/json" id="html5-example-props">
{
  "replaceHtmlRules": {
    "select": "<option value=\"\">Choose an element ...</option><option value=\"Np\">  Neptunium</option> ..."
  },
  "steps": [{
      "label": "Mark up the component with a select tag",
      "highlight": "%OPENCLOSETAG%select",
      "notes": ""
    }, {
      "label": "Mark up all the options with the option tag",
      "highlight": "%OPENCLOSECONTENTTAG%option",
      "notes": ""
    },
    {
      "label": "Ensure the label is associated with the select tag",
      "highlight": "for",
      "notes": ""
    }
  ]
}
</script>


<h2>ARIA listbox example</h2>

<?php includeStats(array('isForNewBuilds' => false)) ?>
<?php includeStats(array('isNPM' => true)) ?>

<p>
  This listbox I made is accessible, and I have used in a few projects in the past. It works well, a developer can
  ensure it looks the same in all browsers, and I am happy with the accessibilty features in it. However, I strongly
  recommend you use the <code>&lt;select&gt;</code> box example instead. Using this library means that:
</p>

<ol>
  <li>You are adding more JavaScript to your application.</li>
  <li>You are not taking advantage of the optimized <code>&lt;select&gt;</code> box styling for the device using the
    control.</li>
  <li>You are going to spend more development time to get this to work.</li>
</ol>

<p>
  If after reading the warning on the label, you decide that still want to use this product, read the code walkthrough
  and the installation instructions after the demo.
</p>

<div id="aria-example">
  <div class="enable-listbox listbox-area">
    <div class="left-area">
      <span id="exp_elem" class="enable-listbox__exp_elem">
        Choose an element:
      </span>
      
      <div id="exp_wrapper" class="enable-listbox__wrapper">
        <button aria-haspopup="listbox" aria-expanded="false" aria-labelledby="exp_elem exp_button" id="exp_button"
          class="enable-listbox__button">&nbsp;</button>
        <ul id="exp_elem_list" class="hidden" tabindex="-1" role="listbox" aria-labelledby="exp_elem">
          <li id="exp_elem_Np" role="option">
            Neptunium
          </li>
          <li id="exp_elem_Pu" role="option">
            Plutonium
          </li>
          <li id="exp_elem_Am" role="option">
            Americium
          </li>
          <li id="exp_elem_Cm" role="option">
            Curium
          </li>
          <li id="exp_elem_Bk" role="option">
            Berkelium
          </li>
          <li id="exp_elem_Cf" role="option">
            Californium
          </li>
          <li id="exp_elem_Es" role="option">
            Einsteinium
          </li>
          <li id="exp_elem_Fm" role="option">
            Fermium
          </li>
          <li id="exp_elem_Md" role="option">
            Mendelevium
          </li>
          <li id="exp_elem_No" role="option">
            Nobelium
          </li>
          <li id="exp_elem_Lr" role="option">
            Lawrencium
          </li>
          <li id="exp_elem_Rf" role="option">
            Rutherfordium
          </li>
          <li id="exp_elem_Db" role="option">
            Dubnium
          </li>
          <li id="exp_elem_Sg" role="option">
            Seaborgium
          </li>
          <li id="exp_elem_Bh" role="option">
            Bohrium
          </li>
          <li id="exp_elem_Hs" role="option">
            Hassium
          </li>
          <li id="exp_elem_Mt" role="option">
            Meitnerium
          </li>
          <li id="exp_elem_Ds" role="option">
            Darmstadtium
          </li>
          <li id="exp_elem_Rg" role="option">
            Roentgenium
          </li>
          <li id="exp_elem_Cn" role="option">
            Copernicium
          </li>
          <li id="exp_elem_Nh" role="option">
            Nihonium
          </li>
          <li id="exp_elem_Fl" role="option">
            Flerovium
          </li>
          <li id="exp_elem_Mc" role="option">
            Moscovium
          </li>
          <li id="exp_elem_Lv" role="option">
            Livermorium
          </li>
          <li id="exp_elem_Ts" role="option">
            Tennessine
          </li>
          <li id="exp_elem_Og" role="option">
            Oganesson
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<p>
  (<em><strong>Note:</strong> The styling of this component is taken from <a
      href="https://www.w3.org/TR/wai-aria-practices/examples/listbox/listbox-collapsible.html">The W3C's
      Collapsible Dropdown Listbox Example</a> &mdash; the script, however, has been replaced with custom
    code.</em>)
</p>


<?php includeShowcode("aria-example")?>

<script type="application/json" id="aria-example-props">
{
  "replaceHtmlRules": {
    "[role=\"listbox\"]": "<!-- This is a the selected item in the dropdown --><li id=\"exp_elem_Np\" role=\"option\" aria-selected=\"true\">Neptunium</li><!-- This is an unselected item --><li id=\"exp_elem_Pu\" role=\"option\" aria-selected=\"false\">Plutonium</li>..."
  },
  "steps": [{
      "label": "Place ARIA roles in document",
      "highlight": "role",
      "notes": "The <strong>option</strong> elements must be direct children of the <strong>listbox</strong> elements. If not, you must use the <code>presentation</code> role for the nodes in between the <code>listbox</code> and the <code>option</code>, in a similar way described in <a href=\"table.php#table-aria\">we describe using presentation roles in our ARIA tables demo</a>."
    },
    {
      "label": "Place <strong>aria-haspopup</strong> attribute on button that activates dropdown functionality.",
      "highlight": "aria-haspopup",
      "notes": ""
    },
    {
      "label": "Markup labels of listbox using aria-labelledby",
      "highlight": "aria-labelledby ||| id=\"exp_button\"",
      "notes": "Please ensure these ids are unique in your document.  If you have multiple dropdowns, the id from them must be unique."
    },
    {
      "label": "When listbox is closed, hide listbox list with CSS <code>display: none</strong>.",
      "highlight": "class=\"hidden\"",
      "notes": "This prevents the screenreader from reading the contents of the hidden information in reading mode."
    },
    {
      "label": "Place aria-selected attributes on options",
      "highlight": "aria-selected",
      "notes": "<strong>aria-selected=\"true\"</strong> for the selected option, <strong>aria-selected=\"false\"</strong> otherwise."
    },
    {
      "label": "Place aria-expanded attribute on button element",
      "highlight": "aria-expanded",
      "notes": [
        "<ul>",
        "  <li>This is set to <strong>false</strong> when the options are hidden, <strong>true</strong> when the are visible.</li>",
        "  <li>When expanded, focus goes to the selected element of the list. The user can change the value with the arrow keys",
        "  <li>",
        "    When expanded, mobile users should not be able to access elements outside of the list.  This is done by setting <strong>aria-hidden=\"true\"</strong> to all siblings, as well as the siblings of the list's parents.",
        "    This can be done efficiently using the <strong>setMobileFocusLoop()</strong> of Enable's accessibility library.</li>",
        "  </li>",
        "  <li>",
        "    When not closed, focus should go back to the button that opened it.",
        "    Mobile users should be able to access elements outside of the list again.",
        "    This can be done using <strong>accessibility.removeFocusLoop()</strong>",
        "  </li>",
        "  <li>When the keyboard focus is removed from the list, the listbox closes and <strong>aria-expanded</strong> is set to <strong>false</strong>.</li>",
        "</ul>"
      ]
    }

  ]
}
</script>

<?= includeNPMInstructions(
  'enable-listbox',
  array(),
  false,
  array(),
  null,
  true
) ?>