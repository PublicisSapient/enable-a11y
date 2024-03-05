        <?php
          global $walkthroughIndex;
        ?>

        <div class="showcode__container">
          <div class="showcode__copy">
            <?php if ($isInteractive && $headingLevel > 0): ?>
            <h<?= $headingLevel ?> id="developer-walkthrough-<?= $walkthroughIndex ?>" tabindex="-1"
              class="showcode__heading">Code Walkthrough of the Above Example</h<?= $headingLevel ?>>

            <p>
              Below is the HTML of the above example. Use the dropdown
              to highlight each of the individual steps that makes the
              example accessible.
            </p>

            <?= $prologue ?>
            <?php endif ?>
          </div>

          <?php if ($isInteractive): ?>
          <?= $extra ?>
          <?php endif ?>

          <?php if ($isInteractive): ?>
              <div class="showcode__ui">
            <?php endif ?>
            <?php if ($isInteractive): ?>
              <div id="<?= $id ?>__steps" class="showcode__steps"></div>
            <?php endif ?>
              <div id="<?= $id ?>__changes-alert" class="showcode__changes-alert sr-only" role="alert" aria-live="assertive"></div>
              <div class="showcode__notes-container " >
                <div id="<?= $id ?>__notes" class="showcode__notes " ></div>

                <!-- Show/hide button to be used for small breakpoints -->
                <button id="<?= $id ?>__notes-view-toggle" class="showcode__notes-view-toggle"
                ><span class="showcode__notes-view-toggle--more">View
                  More</span><span class="showcode__notes-view-toggle--less">View Less</span>
                  <span class="sr-only">(This control is not needed for screen reader
                users.)</span>
              </button>
              </div>
              
              

              <div id="<?= $id ?>__example-desc" class="showcode__example--desc">
                <label for="<?= $id ?>__wrap-text">Wrap text</label>
                <input type="checkbox" id="<?= $id ?>__wrap-text" class="showcode__wrap-text" />
                <div class="showcode__scroll-message">☜ Scroll to read full source ☞</div>
              </div>
              <?php if ($isInteractive): ?>
              </div><?php endif ?>


          <div class="showcode">
            
            <pre class="showcode__example"><code
                        class="showcode__example--code"
                        data-showcode-id="<?= $id ?>"
                        data-showcode-props="<?= $id ?>-props"
                        tabindex="0"
                        aria-describedby="<?= $id ?>__example-desc"
                    >
                    </code>
                </pre>
          </div>
        </div>

        <?php
        $walkthroughIndex = $walkthroughIndex + 1;
        ?>