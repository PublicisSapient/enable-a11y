<p>
  Carousels are a list of content panels that mouse user can cycle through using arrow controls and panel indicator.
  Usually carousels show only one panel at a time, and they usually have at least one CTA in them. They exist to cram as
  much content in the valuable "<a href="https://elementor.com/resources/glossary/what-is-above-the-fold/">Above The
    Fold</a>" real estate on websites. Although <a href="https://vwo.com/blog/is-above-the-fold-really-dead/">it is
    debatable whether "Above The Fold" is as important as people think it is</a>, it is still a solid requirement for a
  lot of website owners.
</p>


<h2>Carousels with CTAs</h2>

<?php includeStats(array('isForNewBuilds' => true)) ?>
<?php includeStats(array('isForNewBuilds' => false)) ?>
<?php includeStats(array('isNPM' => true)) ?>


<p>
  This carousel example use <a href="https://nickpiscitelli.github.io/Glider.js/">Glider.js</a>, but the
  instructions will contain information to make carousels accessible for all carousel frameworks. The
  implementation presented here is based on <a
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
    <div class="glider">
      <div class="enable-carousel__slide">
        <img class="enable-carousel__background" src="images/carousel-example/00-turkish-spider-man.jpg"
          alt="Bootleg versions of Spider-Man, Captain America and El Santo fighting.">
        <div class="enable-carousel__slide-copy  enable-carousel__slide-copy--variation1">
          <h2 id="slide01-title" class="enable-carousel__slide-heading" lang="tr">3 Dev Adam</h2>
          <p>Also known as <em>Turkish Spider-Man</em>, this 1973 is the story of crime boss
            Spider-Man's battle with law enforcement heros Captain America and El Santo.</p>
          <a class="enable-carousel__slide-cta" href="https://en.wikipedia.org/wiki/3_Dev_Adam"
            aria-describedby="slide01-title">Learn More</a>
        </div>
      </div>
      <div class="enable-carousel__slide">
        <img class="enable-carousel__background" src="images/carousel-example/02-turkish-star-wars.jpg"
          alt="Cüneyt Arkın kicking and fighting two beasts that look like they are in low budget furry costumes, while a woman being held by one of them looks on in awe.">
        <div class="enable-carousel__slide-copy enable-carousel__slide-copy--variation2">
          <h2 id="slide02-title" class="enable-carousel__slide-heading" lang="tr">Dünyayı Kurtaran
            Adam
          </h2>
          <p>Two space fighters crash into a desert planet and fights a mysterious Wizard who is
            enslaving
            the local population.</p>
          <a class="enable-carousel__slide-cta"
            href="https://en.wikipedia.org/wiki/D%C3%BCnyay%C4%B1_Kurtaran_Adam">Learn More <span class="sr-only">about
              <span lang="tr">Dünyayı Kurtaran
                Adam</span></span></a>
        </div>
      </div>
      <div class="enable-carousel__slide">
        <img class="enable-carousel__background" src="images/carousel-example/01-samurai-cop.jpg"
          alt="A man with a mullet and a maniacal face holding a sword in the middle of a field.">
        <div class="enable-carousel__slide-copy">
          <h2 id="slide03-title" class="enable-carousel__slide-heading">Samurai Cop</h2>
          <p>The story of a cop with an epic mullet and a samuari sword who, along with his cool
            parner, take on a gang of cocaine smugglers in early '90's Los Angeles.
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

    <button class="glider-prev" tabindex="-1" aria-hidden="true">«</button>
    <button class="glider-next" tabindex="-1" aria-hidden="true">»</button>
    <div role="tablist" class="dots"></div>
  </div>

  <div class="enable-mobile-visible-on-focus__container  enable-skip-link--end">
    <a href="#beginning-of-component-1" id="end-of-component-1"
      class="enable-mobile-visible-on-focus enable-skip-link">Skip to
      beginning of promotional links</a>
  </div>
</div>

<?php includeShowcode("example1")?>

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
      "notes": "Since mobile screenreaders don't use a keyboard, we must hide the previous and next CTAs using aria-hidden to remove them from the accessibility API."
    },
    {
      "label": "Initialize the carousel via JavaScript",
      "highlight": "%FILE% ./js/modules/enable-carousel.js ~ this.init =",
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

<?= includeNPMInstructions('enable-carousel', array()) ?>
