<section class="enable-thumbnail-carousel" aria-labelledby="thumbnail-carousel-heading">
  <h2 id="thumbnail-carousel-heading">Image Thumbnails Navigation Carousel Working Example</h2>
  <div class="enable-thumbnail-carousel__wrapper">
    <!-- Primary Slider Start-->
    <div
      id="main-carousel"
      class="splide enable-thumbnail-carousel__main"
      aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide">
            <img src="images/carousel-example/00-turkish-spider-man.jpg"
              alt="Bootleg versions of Spider-Man, Captain America and El Santo fighting." />
          </li>
          <li class="splide__slide">
            <img src="images/carousel-example/02-turkish-star-wars.jpg"
              alt="Cüneyt Arkın kicking and fighting two beasts that look like they are in low budget furry costumes, while a woman being held by one of them looks on in awe." />
          </li>
          <li class="splide__slide">
            <img src="images/carousel-example/01-samurai-cop.jpg"
              alt="A man with a mullet and a maniacal face holding a sword in the middle of a field." />
          </li>
          <li class="splide__slide">
            <img src="images/carousel-example/03-lady-terminator.jpg"
              alt="An angry woman looking straight at the viewer with a gun blasting rounds in the same direction." />
          </li>
        </ul>
      </div>
    </div>
    <!-- Primary Slider End-->
    <!-- Thumbnal Slider Start-->
    <div
      id="thumbnail-carousel"
      class="splide  enable-thumbnail-carousel__slider">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide">
            <img src="images/carousel-example/00-turkish-spider-man.jpg"
              alt="Bootleg versions of Spider-Man, Captain America and El Santo fighting." />
          </li>
          <li class="splide__slide">
            <img src="images/carousel-example/02-turkish-star-wars.jpg"
              alt="Cüneyt Arkın kicking and fighting two beasts that look like they are in low budget furry costumes, while a woman being held by one of them looks on in awe." />
          </li>
          <li class="splide__slide">
            <img src="images/carousel-example/01-samurai-cop.jpg"
              alt="A man with a mullet and a maniacal face holding a sword in the middle of a field." />
          </li>
          <li class="splide__slide">
            <img src="images/carousel-example/03-lady-terminator.jpg"
              alt="An angry woman looking straight at the viewer with a gun blasting rounds in the same direction." />
          </li>
        </ul>
      </div>
    </div>
    <!-- Thumbnal Slider End-->
  </div>
</section>

<?= includeNPMInstructions(
    "enable-thumbnail-carousel",
    [],
    "enable-thumbnail-carousel",
    false,
    [
        "needsSplide" => true,
    ],
) ?>

<script type="module">
  import EnableThumbnailCarousel from "./js/modules/enable-thumbnail-carousel.js";
  EnableThumbnailCarousel();
</script>
