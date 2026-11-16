
  <!-- Look at CSS file for steps 1, 2 and 3 to make this work -->
  <div class="large-target-product-tile no-permalink-headings" aria-label="Product tile">
    <!-- Invisible overlay link makes the whole card clickable except raised controls. -->
    <a class="large-target-product-tile__overlay-link" href="#" aria-labelledby="tile1-name tile1-price" aria-describedby="tile1-badges"></a>

    <div class="large-target-product-tile__media">
      <img class="large-target-product-tile__media-img" src="https://www.useragentman.com/blog/wp-content/uploads/2022/06/good-bad-thumb.jpg" alt="Keurig brewer with red mug" />
      <div class="large-target-product-tile__badges" id="tile1-badges">
        <span class="large-target-product-tile__badge-rating"><span aria-hidden="true"><span class="large-target-product-tile__badge-star">★</span><span>1.9</span></span><span class="sr-only">Rated 1.9 out of 5</span></span>
        <span class="large-target-product-tile__badge-pill">SUPPLIES LIMITED<span class="sr-only">: Special offer</span></span>
      </div>
    </div>

    <form class="large-target-product-tile__content" oninput="colorOutput.value = tile1Color.value">
      <div class="large-target-product-tile__brand">Parody T-shirt</div>
      <h3 class="large-target-product-tile__name" id="tile1-name">Internet Explorer® T-shirt</h3>

      <!-- Swatches: visually under the name, interactive above overlay link -->
      <fieldset class="large-target-product-tile__swatches" >
        <legend id="tile1Color-legend">T-shirt color</legend>
          <label class="large-target-product-tile__swatch">
            <span class="sr-only">Black</span>
            <input type="radio" name="tile1Color" value="black" checked />
            <span class="large-target-product-tile__swatch-dot" style="background:#2f2f2f;"></span>
          </label>
          <label class="large-target-product-tile__swatch">
            <span class="sr-only">Silver</span>
            <input type="radio" name="tile1Color" value="silver" />
            <span class="large-target-product-tile__swatch-dot" style="background:#c0c0c0;"></span>
          </label>
          <label class="large-target-product-tile__swatch">
            <span class="sr-only">Red</span>
            <input type="radio" name="tile1Color" value="red" />
            <span class="large-target-product-tile__swatch-dot" style="background:#d64545;"></span>
          </label>
          <label class="large-target-product-tile__swatch">
            <span class="sr-only">Teal</span>
            <input type="radio" name="tile1Color" value="teal" />
            <span class="large-target-product-tile__swatch-dot" style="background:#27b3b0;"></span>
          </label>
          <label class="large-target-product-tile__swatch">
            <span class="sr-only">Pink</span>
            <input type="radio" name="tile1Color" value="pink" />
            <span class="large-target-product-tile__swatch-dot" style="background:#f277a1;"></span>
          </label>
          <label class="large-target-product-tile__swatch">
            <span class="sr-only">Blue</span>
            <input type="radio" name="tile1Color" value="blue" />
            <span class="large-target-product-tile__swatch-dot" style="background:#167ad6;"></span>
          </label>

          <div>Color selected: <output name="colorOutput">black</output></div>
      </fieldset>

      <div class="large-target-product-tile__pricing">
        <div class="large-target-product-tile__price-primary" id="tile1-price">$25.99 </div>
        <div class="large-target-product-tile__helper">Extra 20% Off if you buy 3.</div>
        <div class="large-target-product-tile__price-row">
          <span class="large-target-product-tile__small" >$20.99</span>
          <span class="large-target-product-tile__small">If you run Windows XP without security updates.</span>
        </div>
        <div class="large-target-product-tile__small">$10.99 with code <strong>IE4LIFE</strong></div>
      </div>

      <div class="large-target-product-tile__actions">
        <button type="button" class="large-target-product-tile__btn-buy" aria-describedby="tile1-name" onclick="alert('Item added to cart.'); return false;">Buy Now</button>
        <label class="large-target-product-tile__compare"><input type="checkbox" /> Compare</label>
      </div>
</form>
  </div>
