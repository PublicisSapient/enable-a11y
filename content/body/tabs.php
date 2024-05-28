<!-- <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The style of this page was stolen from <a                         href="http://simplyaccessible.com/article/danger-aria-tabs/">Danger! ARIA tabs</a>, written by
                    <a href="http://simplyaccessible.com/article/author/jeffsmith/">Jeff Smith</a>.  However, that article
                    describes a very different method for a tab interface which is not based on ARIA at all.</li>
                <li>When keyboard users focus to the tablist, they will tab into the active tab. They can then use the arrow keys to cycle through the tabs.</li>
                <li>Only keyboard users will see keyboard instructions when they focus into the tablist. Mouse users will
                    not.</li>
                <li>Screen reader users will hear the instructions when they focus on the tabs as well.</li>
            </ul>
        </aside> -->





<p>When you have a group of content items that you want to show users one at a time, a tablist is usually desired.
  Tablists is another common component on the web that does not have a native HTML5 implementation (i.e. there is no
  such thing as a <code>&lt;tablist&gt;</code> tag), although there is a <a href="https://daverupert.com/2021/10/native-html-tabs/">group
      of people who are working to eventually get this in the HTML5 specification)</a>.
</p>



<h2>ARIA Tablist Example</h2>

<?php includeStats(["isForNewBuilds" => true]); ?>
<?php includeStats([
    "isForNewBuilds" => false,
]); ?>
<?php includeStats(["isNPM" => true]); ?>

<p>
  In order to make a tablist accessible, there are a few complications:
</p>

<ol>
  <li>Technically, tablists are a list of items, and choosing one from a group should involve the arrow keys (like <a
      href="radiogroup.php">how users navigate a group of radio buttons</a>)</li>
  <li>Keyboard users may not know how this interaction works, and when they try to navigate through the tablist with a
    Tab key, they will be a bit confused when they skip over the whole list with one key press.</li>
  <li>While you can give screen reader user verbal instructions about how to interact with a tablist, keyboard users
    that <strong>don't</strong> use a screen reader won't hear them.</li>
</ol>

<p>
  In order to fix this UX issue, I show the instructions visually to keyboard users only. <strong>These instructions
    don't appear for mouse users.</strong> They also don't appear for mobile screen reader users who don't use a
  keyboard.  Our implementation "borrows" their visual design, while adding our own code to conform to the <a href="https://www.w3.org/TR/wai-aria-practices/examples/tabs/tabs-1/tabs.html">W3C's recommended UX for a tablist</a> (their implementation, unfortunately, doesn't seem to work with a keyboard
    with some screen reader/browser combinations, like VoiceOver for Safari on OSX).
</p>

<p>
  This issue has been handled in differently in <a href="http://simplyaccessible.com/article/danger-aria-tabs/">Danger!
    ARIA tabs</a>, written by
  <a href="http://simplyaccessible.com/article/author/jeffsmith/">Jeff Smith</a> (TL;DR: He decided to not code them
  using ARIA tabs, but as a list of links that anchor to the tabpanels).
</p>


<div id="example1" class="enable-example">

  <div id="tabs">


    <div class="sr-only tabs__instructions" id="tabs-keyboard-only-instructions">
      Use arrow keys to choose tabs. Content for the chosen tab will be revealed below.
    </div>

    <ul class="enable-tablist" data-keyboard-only-instructions="tabs-keyboard-only-instructions">
      <li>
        <a href="#heading__jamaican-ska" class="enable-tab" data-owns="tabpanel__jamaican-ska">
          Jamaican Ska
        </a>
      </li>
      <li>
        <a href="#heading__two-tone" class="enable-tab" data-owns="tabpanel__two-tone"  >
          2 Tone
        </a>
      </li>
      <li>
        <a href="#heading__third-wave" class="enable-tab" data-owns="tabpanel__third-wave" data-tab-selected-on-load="true">
          Third Wave
        </a>
      </li>
    </ul>
    <div class="enable-tabpanel" id="tabpanel__jamaican-ska">
      <h2 tabindex="-1" id="heading__jamaican-ska">Jamaican Ska</h2>

      <div class="tab__content">
        <p>Ska's origins are from 1960s Jamaica. One theory about the origin of ska is that Prince
          Buster created it during the inaugural recording session for his new record label Wild Bells.</p>

        <p>Artists include:</p>
        <ol>
          <li>The Skatellites</li>
          <li>Prince Buster</li>
          <li>Desmond Dekker</li>
          <li>Millie Small</li>
          <li>Byron Lee and the Dragonaires</li>
          <li>Laurel Aitken</li>
          <li>The Wailers</li>
          <li>Jimmy Cliff</li>
          <li>Eric "Monty" Morris</li>
        </ol>

        <a href="https://jamaicansmusic.com/learn/origins/ska">More information about Jamaican Ska</a>
      </div>
    </div>
    <div class="enable-tabpanel" id="tabpanel__two-tone">
      <h2 tabindex="-1" id="heading__two-tone">2 Tone Ska</h2>
      <div class="tab__content">

        <p>The 2 Tone genre, which began in the late 1970s in the Coventry area of UK, was a fusion of Jamaican ska
          rhythms and melodies with punk rock's more aggressive guitar chords and lyrics.[24] Compared to 1960s ska, 2
          Tone music had faster tempos, fuller instrumentation, and a harder edge. The genre was named after 2 Tone
          Records, a record label founded by Jerry Dammers of The Specials.</p>

        <p>Artists include:</p>
        <ol>
          <li>The Specials</li>
          <li>Madness</li>
          <li>Bad Manners</li>
          <li>The Selector</li>
          <li>The Beat (a.k.a. "The English Beat" in the U.S.)</li>
          <li>The Body Snatchers</li>
          <li>Akrylykz</li>
        </ol>

        <a
          href="https://www.theguardian.com/music/2021/apr/30/a-blur-of-legs-arms-and-adrenaline-the-astonishing-history-of-two-tone">More
          information about 2 Tone Ska</a>
      </div>
    </div>
    <div class="enable-tabpanel" id="tabpanel__third-wave">
      <h2 tabindex="-1" id="heading__third-wave">Third Wave</h2>
      <div class="tab__content">

        <p>Third-wave ska originated in the punk scene in the late 1980s and became commercially successful in the
          1990s. Although some third-wave ska has a traditional 1960s sound, most third-wave ska is characterized by
          dominating guitar riffs and large horn sections.</p>

        <ol>
          <li>The Toasters</li>
          <li>Fishbone</li>
          <li>No Doubt</li>
          <li>The Mighty Mighty Bosstones</li>
          <li>Streetlight Manifesto</li>
          <li>The Hotknives</li>
          <li>Hepcat</li>
          <li>The Slackers</li>
          <li>Sublime</li>
          <li>Suicide Machines</li>
          <li>Voodoo Glow Skulls</li>
          <li>Reel Big Fish</li>
          <li>Less Than Jake</li>
          <li>Bim Skala Bim</li>
        </ol>

        <a href="https://en.wikipedia.org/wiki/Ska#Third_wave_ska">More information about Third Wave Ska</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
const originalHTMLExample1 = document.getElementById('example1').innerHTML;
</script>

<?php includeShowcode("example1"); ?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {
    ".tab__content": "<!-- insert tab panel content here -->",
    "[role=\"tab\"]": "<!-- insert tab label here -->"
  },
  "steps": [{
      "label": "Create basic DOM for users without JavaScript",
      "highlight": "href ",
      "notes": "This is a basic list of links that answer to the headings of what will be the tabpanels when the JavaScript is executed.  Users who don't load the JavaScript (because of a network error or because they elected not to load it) will get this usable HTML.  Note that these links will "
    },
    {
      "label": "Ensure classes are set up so roles will be assigned for JavaScript users",
      "highlight": "%INLINE%originalHTMLExample1 ||| class=\"enable-tablist\" ||| class=\"enable-tab\" ||| class=\"enable-tabpanel\"",
      "notes": "This is a basic list of links that answer to the headings of what will be the tabpanels when the JavaScript is executed.  Users who don't load the JavaScript (because of a network error or because they elected not to load it) will get this usable HTML.  Note that these links will "
    },{
      "label": "If needed, ensure the JavaScript can assign the tab that should be selected on load",
      "highlight": "%INLINE%originalHTMLExample1 ||| data-tab-selected-on-load",
      "notes": "In our implementation, we use the <code>data-tab-selected-on-load</code> attribute to determine which tab is selected on load.  If not included, the first tab is selected"
    },
    {
      "label": "Use data-owns to connect tabs with their tabpanel",
      "highlight": "%INLINE%originalHTMLExample1 ||| data-owns",
      "notes": "This will be used by the JavaScript code to connect the tab with the tabpanel using aria-controls"
    },
    {
      "label": "Your JavaScript should place ARIA roles in document",
      "highlight": "%INLINE%example1 ||| role",
      "notes": "JavaScript should assign these roles to non-JavaScript users that user screen readers don't get these roles.  Note that <strong>tabs</strong> should be a direct child of the <strong>tablist</strong>. If this is not possible, then all the nodes in between them should have a role of <strong>presentation</strong>."
    },
    {
      "label": "Your JavaScript should connect tabs to tabpanels",
      "highlight": "%INLINE%example1 ||| aria-controls",
      "notes": "Each <strong>tab</strong> must have an <strong>aria-controls</strong> attribute that corresponds to its <strong>tabpanel</strong>."
    },
    {
      "label": "Your JavaScript should apply aria-selected values are set correctly",
      "highlight": "%INLINE%example1 ||| aria-selected",
      "notes": "When a tab is selected, its <strong>aria-selected</strong> attribute must be set to <strong>true</strong>, while all the other tabs must have it set to <strong>false</strong>"
    },
    {
      "label": "Your JavaScript should ensure only the selected tab is accessible via tab key",
      "highlight": "%INLINE%example1 ||| tabindex=\"-1\" ||| aria-selected",
      "notes": "In order switch tabs with the arrow keys, all tabs that have <strong>aria-selected=\"false\"</strong> must also have <strong>tabindex=\"-1\"</strong> set as well."
    },
    {
      "label": "Your JavaScript should use aria-describedby to give keyboard instructions when user focuses on tabs",
      "highlight": "%INLINE%example1 ||| aria-describedby",
      "notes": "This gives screen reader users instructions how to use the tabs when they navigate into them via keyboard"
    },
    {
      "label": "Set up JavaScript that activates the tabs when they have keyboard focus",
      "highlight": "%FILE% js/modules/tabs.js",
      "notes": ""
    }
  ]
}
</script>

<?= includeNPMInstructions("tabs", [], "", false, [], ".enable-tablist") ?>
