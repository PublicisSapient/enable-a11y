<?php

$copy = getCgiVar('copy');
$heading = getCgiVar('heading');
$hasDropdown = (getCgiVar('hasDropdown') == 'true');
$hasArrows = (getCgiVar('hasArrows') == 'true');
$className = getCgiVar('className');

if ($heading == '') {
  $heading = 'Reflow Violation Example';
}

?>

<h1><?= $heading ?></h1>

<div class="product-tile-carousel__example">
  <div class="enable-mobile-visible-on-focus__container enable-skip-link--begin">
    <a href="#end-of-component-1" id="beginning-of-component-1" class="enable-mobile-visible-on-focus enable-skip-link">
      Skip to end of promotional links
    </a>
  </div>
  <div class="glider-contain product-tile-carousel__container">

    <!--

      The ID of the carousel is used as a prefix
      for the dot indicators at the bottom
      of the carousel (product-tile-carousel__indicators)
  -->
    <div id="product-tile-carousel" class="glider enable-carousel enable-carousel--focus-all-panels">
      <div class="enable-carousel__slide product-tile-carousel__slide">
        <img class="product-tile-carousel__background"
          src="images/product-tile-example/the-man-who-saves-the-world.webp" alt="">
        <a href="https://en.wikipedia.org/wiki/D%C3%BCnyay%C4%B1_Kurtaran_Adam" class="product-tile-carousel__copy">
          <div class="product-tile-carousel__title">The Man Who Saves The World</div>
          <div class="product-tile-carousel__features">
            Blu-ray · Turkey · $19.99
          </div>
        </a>
      </div>
      <div class="enable-carousel__slide product-tile-carousel__slide">

        <img class="product-tile-carousel__background" src="images/product-tile-example/3-dev-adam.webp" alt="">
        <a href="https://en.wikipedia.org/wiki/3_Dev_Adam" class="product-tile-carousel__copy">
          <div class="product-tile-carousel__title">3 Dev Adam</div>
          <div class="product-tile-carousel__features">
            DVD · Turkey · $12.99
          </div>
        </a>

      </div>
      <div class="enable-carousel__slide product-tile-carousel__slide">

        <img class="product-tile-carousel__background" src="images/product-tile-example/lady-battlecop.webp" alt="">
        <a href="https://tokusatsu.fandom.com/wiki/Lady_Battle_Cop" class="product-tile-carousel__copy">
          <div class="product-tile-carousel__title">Lady Battlecop</div>
          <div class="product-tile-carousel__features">
            VHS · Japan · $9.99
          </div>
        </a>

      </div>
      <div class="enable-carousel__slide product-tile-carousel__slide">

        <img class="product-tile-carousel__background" src="images/product-tile-example/mahakaal.webp" alt="">
        <a href="https://en.wikipedia.org/wiki/Mahakaal" class="product-tile-carousel__copy">
          <div class="product-tile-carousel__title">Mahakaal</div>
          <div class="product-tile-carousel__features">
            DVD · India · $9.99
          </div>
        </a>

      </div>
    </div>

    <div id="product-tile-carousel__indicators" class="dots">
    </div>
  </div>
  <div class="enable-mobile-visible-on-focus__container  enable-skip-link--end">
    <a href="#beginning-of-component-1" id="end-of-component-1" class="enable-mobile-visible-on-focus enable-skip-link">
      Skip to
      beginning of promotional links
    </a>
  </div>

</div>

<p class="center">
  Resize the browser window to see how we ensure that we ensure the carousel only appears on smaller width breakpoints.
</p>