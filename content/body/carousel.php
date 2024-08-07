<p>
  Carousels are a list of content panels that a mouse user can cycle through using arrow controls and panel indicators.
  Usually, carousels show only one panel at a time, and they usually (but not always) have at least one CTA in them.
  They exist to cram as
  much content in the valuable "<a href="https://elementor.com/resources/glossary/what-is-above-the-fold/">Above The
    Fold</a>" real estate on websites. Although <a href="https://vwo.com/blog/is-above-the-fold-really-dead/">it is
    debatable whether "Above The Fold" is as important as people think it is</a>, it is still a solid requirement for a
  lot of website owners.
</p>


<p>
  <strong>In our opinion, carousels are a hack designed to cram a huge amount of content within a small amount of space.</strong>  There are better alternatives to carousels out there, and these articles are a good place to start if you are looking for them:
  </p>

<ul>
  <li><a href="https://www.mightybytes.com/blog/5-alternatives-using-carousel-on-homepage/">5 Alternatives to Using a Carousel on Your Website Homepage</a></li>
  <li><a href="https://www.mightybytes.com/blog/more-alternatives-to-carousels-on-website/">More Alternatives to Using a Carousel on Your Website</a></li>
  <li><a href="https://www.boia.org/blog/effective-and-accessible-alternatives-to-website-carousels">Alternatives to carousels in web design</a>
  </ul>

<p>
  That said, there are times when as a web developer you are asked to implement an accessible one.  On this page are two ways of implementing accessible carousels: <a href="#solution-1-treat-the-carousel-like-a-list-of-controls---heading">one solution is good when you know there will be at least one interactive control in each panel</a>, and <a href="#solution-2-treat-the-carousel-like-a-list-of-content--heading">the other is good when you cannot make that guarantee</a>.
  Note that all the carousels on this page use <a href="https://nickpiscitelli.github.io/Glider.js/">Glider.js</a>, but
  the
  code walkthrough below will contain information developers need to implement accessible carousels regardless of the
  carousel frameworks being used. If the developer is making a carousel from scratch, they can use the NPM module that
  makes Glider.js accessible (see below).
</p>

<h2>Solution 1: Treat The Carousel Like A List of Controls.</h2>

<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        "This solution is the best solution when you can guarantee there will be one interactive/keyboard focusable element in every carousel panel.",
]); ?>
<?php includeStats([
    "isForNewBuilds" => false,
]); ?>
<?php includeStats(["isNPM" => true]); ?>


<p>
  Note that this solution assumes that each carousel panel has at least one CTA (i.e., call to action, or control) in
  it. Keyboard users simply tab into each CTA as they would any other links on the page. When keyboard users tab into a
  panel that is offscreen, our JavaScript library ensures that the panel comes into focus. As a result, keyboard access
  to the previous and next buttons are considered unnecessary, so we have intentionally removed them from the document
  tabbing order. <strong>
    If you are dealing with a carousel that can have no CTA in one or more panels, you should look at <a
      href="#solution-2-treat-the-carousel-like-a-list-of-content--heading">the second carousel example on this page</a>.</strong></p>

<p>The implementation presented here is based on <a
    href="https://lsnrae.medium.com/if-you-must-use-a-carousel-make-it-accessible-977afd0173f4">this
    excellent article by Alison Walden</a>.
</p>

<div id="example1" class="enable-example enable-carousel__example">
  <div class="enable-mobile-visible-on-focus__container enable-skip-link--begin">
    <a href="#end-of-component-1" id="beginning-of-component-1" class="enable-mobile-visible-on-focus enable-skip-link">
      Skip to end of promotional links
    </a>
  </div>

  <div class="glider-contain">

    <!-- 
      The ID of the carousel is used as a prefix
      for the dot indicators at the bottom
      of the carousel (mockbuster-carousel__indicators)
    -->
    <div id="mockbuster-carousel" class="glider enable-carousel enable-carousel--focus-all-panels">
      <div class="enable-carousel__slide">
        <img class="enable-carousel__background" src="images/carousel-example/00-turkish-spider-man.jpg"
          alt="Bootleg versions of Spider-Man, Captain America and El Santo fighting.">
        <div class="enable-carousel__slide-copy  enable-carousel__slide-copy--variation1">
          <h2 id="slide01-title" class="enable-carousel__slide-heading" lang="tr">3 Dev Adam</h2>
          <p>Also known as <em>Turkish Spider-Man</em>, this 1973 film is the story of crime boss
            Spider-Man's battle with law enforcement heros Captain America and El Santo.</p>
          <a class="enable-carousel__slide-cta" href="https://en.wikipedia.org/wiki/3_Dev_Adam"
            aria-describedby="slide01-title">Learn More</a>
        </div>
      </div>
      <div class="enable-carousel__slide">
        <img class="enable-carousel__background" src="images/carousel-example/02-turkish-star-wars.jpg"
          alt="Cüneyt Arkın kicking and fighting two beasts that look like they are in low budget furry costumes, while a woman being held by one of them looks on in awe.">
        <div class="enable-carousel__slide-copy enable-carousel__slide-copy--variation2">
          <h2 id="slide02-title" class="enable-carousel__slide-heading">Turkish Star Wars
          </h2>
          <p>Originally called <em lang="tr">Dünyayı Kurtaran
              Adam</em>, two space fighters crash into a desert planet and fights a mysterious Wizard who is
            enslaving
            the local population.</p>
          <a class="enable-carousel__slide-cta" href="https://en.wikipedia.org/wiki/D%C3%BCnyay%C4%B1_Kurtaran_Adam"
            aria-describedby="slide02-title">Learn More</a>
        </div>
      </div>
      <div class="enable-carousel__slide">
        <img class="enable-carousel__background" src="images/carousel-example/01-samurai-cop.jpg"
          alt="A man with a mullet and a maniacal face holding a sword in the middle of a field.">
        <div class="enable-carousel__slide-copy">
          <h2 id="slide03-title" class="enable-carousel__slide-heading">Samurai Cop</h2>
          <p>The story of a cop with an epic mullet and a samurai sword who, along with his cool
            partner, take on a gang of cocaine smugglers in early '90's Los Angeles.
          </p>
          <a class="enable-carousel__slide-cta" href="https://en.wikipedia.org/wiki/Samurai_Cop"
            aria-describedby="slide03-title">Learn More</a>
        </div>
      </div>
      <div class="enable-carousel__slide">
        <img class="enable-carousel__background" src="images/carousel-example/03-lady-terminator.jpg"
          alt="An angry woman looking straight at the viewer with a gun blasting rounds in the same direction.">
        <div class="enable-carousel__slide-copy">
          <h2 id="slide04-title" class="enable-carousel__slide-heading">Lady Terminator</h2>
          <p>
            A woman is possessed by the legendary South Sea Queen to have revenge on the daughter of
            a man who stole her snake a hundred years before.
          </p>
          <a class="enable-carousel__slide-cta" href="https://en.wikipedia.org/wiki/Lady_Terminator"
            aria-describedby="slide04-title">Learn More</a>
        </div>
      </div>
    </div>

    <button class="glider-prev" tabindex="-1" aria-label="Display Previous Slide" aria-hidden="true">«</button>
    <button class="glider-next" tabindex="-1" aria-label="Display Next Slide" aria-hidden="true">»</button>
    <div id="mockbuster-carousel__indicators" class="dots"></div>
  </div>

  <div class="enable-mobile-visible-on-focus__container  enable-skip-link--end">
    <a href="#beginning-of-component-1" id="end-of-component-1"
      class="enable-mobile-visible-on-focus enable-skip-link">Skip to
      beginning of promotional links</a>
  </div>
</div>

<?php includeShowcode("example1"); ?>

<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {
    ".glider .enable-carousel__slide:not(:first-child)": "<!-- Has similar structure as first slide -->",
    ".glider .enable-carousel__slide p": "<!-- Copy here -->"
  },
  "steps": [{
      "label": "Put skip links around the carousel",
      "highlight": "class=\"enable-mobile-visible-on-focus\\s[^\"]*\"",
      "notes": "In order for these to work on mobile screen readers, we have created our own. See <a href='38-skip-link.php'>our skip link page</a> for more information."
    },
    {
      "label": "Ensure all images have alt attributes",
      "highlight": "alt",
      "notes": "The content of all the carousel panels must follow accessibility guidelines as well as the carousel itself"
    },
    {
      "label": "Ensure CTAs are marked up correctly",
      "highlight": "%OPENCLOSECONTENTTAG%a",
      "notes": "More often than not, the CTAs inside a carousel will redirect users to another web page, which would make the CTA a link, <strong>even if the CTA looks like a button.</strong>  This is a very common mistake."
    },
    {
      "label": "Link the CTA with the general description of the slide",
      "highlight": "aria-describedby",
      "notes": "When the user tabs into the <strong>Learn more</strong> CTA, we want to give the user more context about what they will be <strong>learning more about</strong> if they follow the link.  The aria-describedby will give screen reader users that context"
    },
    {
      "label": "Ensure the previous and next buttons are not keyboard accessible",
      "highlight": "tabindex",
      "notes": "Since keyboard users will be able to cycle through the slides without using these buttons, let's remove them from the tabbing order.  Keyboard users won't need them, and screen reader users will probably not know what they are meant for."
    },
    {
      "label": "Ensure the previous and next buttons are hidden to mobile screen readers",
      "highlight": "aria-hidden",
      "notes": "Since mobile screen readers don't use a keyboard, we must hide the previous and next CTAs using aria-hidden to remove them from the accessibility API."
    },
    {
      "label": "Initialize the carousel via JavaScript",
      "highlight": "%FILE% ./js/modules/enable-carousel.js ~ this.setTabthroughEvents = ([\\s\\S]*\\s\\s\\})?",
      "notes": "After we create the carousel, we add three events: a focus event to capture when a CTA in a slide gains focus, a mouse event to detect when the mouse is used, and a key event to detect when the TAB key is pressed."
    },
    {
      "label": "Carousel slide focus event",
      "highlight": "%FILE% ./js/modules/enable-carousel.js ~ this.slideToTarget =",
      "notes": "When a CTA in a slide gains focus, we tell the carousel to display the slide that contains that CTA"
    },
    {
      "label": "Carousel mouse event",
      "highlight": "%FILE% ./js/modules/enable-carousel.js ~ this.clickHandler =",
      "notes": "When the user clicks the CTA, we assume they are a mouse user so we allow the carousel to animate between slides."
    },
    {
      "label": "Carousel key up event",
      "highlight": "%FILE% ./js/modules/enable-carousel.js ~ this.keyUpHandler =",
      "notes": "When the user hits the TAB key, we assume they are a keyboard user and tell the carousel to turn animations off."
    }
  ]
}
</script>


<h2>Solution 2: Treat The Carousel Like A List of Content</h2>

<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        'This solution is best to use when you don\'t if each panel will have an interactive/keyboard focusable control in every panel.',
]); ?>
<?php includeStats(["isForNewBuilds" => false]); ?>
<?php includeStats(["isNPM" => true]); ?>


<p>
  Like the first example, this carousel example also uses <a
    href="https://nickpiscitelli.github.io/Glider.js/">Glider.js</a>, but
  the previous and next buttons are keyboard accessible; clicking on them applies focus to the carousel panel that slides into view <em>or</em> the first interactive element within the slide if one is available.
  This is great if you have carousel panels that don't have any interactive elements.
</p>

<div id="example2" class="enable-example enable-carousel__example">

  <p id="carousel-instructions" class="sr-only">Tab into the previous and next buttons below to cycle the slides in the carousel.</p>

  <div class="glider-contain" role="region" aria-label="Store Announcements Carousel" id="announcements-carousel__container">

    <button class="glider-prev" aria-describedby="carousel-instructions" aria-label="Display Previous Slide">«</button>
    <div id="announcements-carousel" tabindex="-1" class="glider enable-carousel enable-carousel--has-focusable-arrow-buttons" aria-labelledby="announcements-carousel__container" aria-describedby="carousel-instructions">
      <div class="enable-carousel__slide" aria-labelledby="example2__slide01-title example2__slide-01-desc" >
        <div class="enable-carousel__slide-copy  enable-carousel__slide-copy--variation1">
          <h2 id="example2__slide01-title" class="enable-carousel__slide-heading" >Hours of Operation Change</h2>
          <p id="example2__slide-01-desc">Please note that our office hours have changed. We are now open from Monday to Friday from 8:30AM to 8:45AM. We do not apologize for any inconvenience this may cause.</p>
          
        </div>
      </div>
      <div class="enable-carousel__slide" aria-labelledby="example2__slide02-title example2__slide-02-desc">
       
        <div class="enable-carousel__slide-copy enable-carousel__slide-copy--variation2">
          <h2 id="example2__slide02-title" class="enable-carousel__slide-heading">
            Up to 50% off all items.
          </h2>
          <p id="example2__slide-02-desc">
            Starting Tuesday, all of our summer items will be sold for 50% off the sticker price.
            (Note: offer not available in Newfoundland). 
          </p>
          
        </div>
      </div>
      <div class="enable-carousel__slide" aria-labelledby="example2__slide03-title example2__slide-03-desc">
        
        <div class="enable-carousel__slide-copy">
          <h2 id="example2__slide03-title" class="enable-carousel__slide-heading">Recall Notice:</h2>
          <p id="example2__slide-03-desc">Please note that if you bought our <em>Pika-homer&trade;</em> brand towels, you should return them to your nearest store for a full refund due to toxicity concerns with the dye used in their manufacture.
          </p>

          <a class="enable-carousel__slide-cta" href="https://www.reddit.com/r/crappyoffbrands/comments/8v114v/pikadoh/"
            aria-describedby="example2__slide03-title">Learn More</a>
          
        </div>
      </div>
      <div class="enable-carousel__slide" aria-labelledby="example2__slide04-title example2__slide-04-desc">
       
        <div class="enable-carousel__slide-copy">
          <h2 id="example2__slide04-title" class="enable-carousel__slide-heading">Black Friday Event</h2>
          <p id="example2__slide-04-desc">
            Note that we will not be having a Black Friday Event this year due to the huge riot that happened last December.    
          </p>
          
        </div>
      </div>
    </div>

    <button class="glider-next" aria-describedby="carousel-instructions" aria-label="Display Next Slide">»</button>
    <output class="sr-only enable-carousel__alert"></output>
  </div>

  <div id="announcements-carousel__indicators"></div>

</div>

<?php includeShowcode("example2"); ?>

<script type="application/json" id="example2-props">
{
  "replaceHtmlRules": {
    ".glider .enable-carousel__slide:not(:first-child)": "<!-- Has similar structure as first slide -->",
    ".glider .enable-carousel__slide p": "<!-- Copy here -->"
  },
  "steps": [
    
    {
      "label": "Ensure you set configure the carousel correctly",
      "highlight": "enable-carousel--has-focusable-arrow-buttons",
      "notes": "For this specific implementation, setting this class on the DOM element that contains the carousel panels will ensure that when the previous and next buttons are pressed, focus goes to the newly visible slide"
    },
    {
      "label": "Initialize the carousel via JavaScript",
      "highlight": "%FILE% ./js/modules/enable-carousel.js ~ \\s*// If useArrowButtons is set as an option.+?(?=\\s*// If userArrowButtons)",
      "notes": "After we create the carousel, we add three events: a focus event to capture when a CTA in a slide gains focus, a mouse event to detect when the mouse is used, and a key event to detect when the TAB key is pressed."
    },
    {
      "label": "Set up events the manage focus when a new slide comes into view.",
      "highlight": "%FILE% ./js/modules/enable-carousel.js ~ \\s*// Sets events for the \"List of Content\" ([\\s\\S]*?\\};)",
      "notes": "<p>When a slide comes into view, focus is applied to it (or to the first keyboard accessible control inside of it).  When a slide is hidden, it is marked as <code>inert</code> so keyboard focus is never applied to it or its children.  We load the <a href=\"https://github.com/WICG/inert\">WICG Inert polyfill</a> only if the browser doesn't support it natively.</p><p>Note as well that we ensure that when the previous and next buttons are pressed with the Enter key, it prevents page scrolling.  Just preventing a small annoyance that some keyboard users have had in the past.</p>"
    }
    
  ]
}
</script>


<?= includeNPMInstructions("enable-carousel", [], "enable-carousel", false, [
    "es6Notes" =>
        "<p><em><strong>Note:</strong> If you want to have the skip links like in the example above, please ensure you also include the <a href=\"skip-link.php#npm-instructions\">NPM module for skip links as well</a>.</em></p>",
    "otherSampleCode" =>
        "// Note that this component doesn't currently work when<br />// new components are added after page load.",
    "needsGlider" => true,
    "customInit" => "../content/code-fragments/carousel-init.js",
]) ?>
