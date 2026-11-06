
  <!-- Look at CSS file for steps 1, 2 and 3 to make this work -->
  <div class="product-card" aria-label="Product tile">
    <!-- Invisible overlay link makes the whole card clickable except raised controls. -->
    <a class="card-link" href="#" aria-labelledby="tile1-name tile1-price" aria-describedby="tile1-badges"></a>

    <div class="media">
      <img src="https://www.useragentman.com/blog/wp-content/uploads/2022/06/good-bad-thumb.jpg" alt="Keurig brewer with red mug" />
      <div class="badges" id="tile1-badges">
        <span class="badge-rating"><span aria-hidden="true"><span class="star">★</span><span>1.9</span></span><span class="sr-only">Rated 1.9 out of 5</span></span>
        <span class="badge-pill">SUPPLIES LIMITED<span class="sr-only">: Special offer</span></span>
      </div>
    </div>

    <div class="content">
      <div class="brand">Parody T-shirt</div>
      <h3 class="name" id="tile1-name">Internet Explorer® T-shirt</h3>

      <!-- Swatches: visually under the name, interactive above overlay link -->
      <fieldset class="swatches" >
        <legend id="tile1-color-legend">T-shirt color</legend>
          <label class="swatch">
            <span class="sr-only">Black</span>
            <input type="radio" name="tile1-color" value="black" checked />
            <span class="dot" style="background:#2f2f2f;"></span>
          </label>
          <label class="swatch">
            <span class="sr-only">Silver</span>
            <input type="radio" name="tile1-color" value="silver" />
            <span class="dot" style="background:#c0c0c0;"></span>
          </label>
          <label class="swatch">
            <span class="sr-only">Red</span>
            <input type="radio" name="tile1-color" value="red" />
            <span class="dot" style="background:#d64545;"></span>
          </label>
          <label class="swatch">
            <span class="sr-only">Teal</span>
            <input type="radio" name="tile1-color" value="teal" />
            <span class="dot" style="background:#27b3b0;"></span>
          </label>
          <label class="swatch">
            <span class="sr-only">Pink</span>
            <input type="radio" name="tile1-color" value="pink" />
            <span class="dot" style="background:#f277a1;"></span>
          </label>
          <label class="swatch">
            <span class="sr-only">Blue</span>
            <input type="radio" name="tile1-color" value="blue" />
            <span class="dot" style="background:#167ad6;"></span>
          </label>
      </fieldset>

      <div class="pricing">
        <div class="price-primary" id="tile1-price">$25.99 </div>
        <div class="helper">Extra 20% Off if you buy 3.</div>
        <div class="price-row">
          <span class="small" >$20.99</span>
          <span class="small">If you run Windows XP without security updates.</span>
        </div>
        <div class="small">$10.99 with code <strong>IE4LIFE</strong></div>
      </div>

      <div class="actions">
        <button type="button" class="btn-buy" aria-describedby="tile1-name">Buy Now</button>
        <label class="compare"><input type="checkbox" /> Compare</label>
      </div>
    </div>
  </div>
