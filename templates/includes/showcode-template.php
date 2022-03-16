        <?php
          global $walkthroughIndex;
        ?>
        
        <div class="showcode__container">
          <div class="showcode__copy">
            <?php if ($isInteractive && $headingLevel > 0): ?>
            <h<?= $headingLevel ?> id="developer-walkthrough-<?= $walkthroughIndex ?>" tabindex="-1"
              class="showcode__heading">Example code
              explanation</h<?= $headingLevel ?>>

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
          <div class="showcode">
            <?php if ($isInteractive): ?><form class="showcode__ui"><?php endif ?>
              <?php if ($isInteractive): ?>
              <div id="<?= $id ?>__steps" class="showcode__steps"></div>
              <?php endif ?>
              <div id="<?= $id ?>__notes" class="showcode__notes " role="alert" aria-live="assertive"></div>
              <button id="<?= $id ?>__notes-view-toggle" class="showcode__notes-view-toggle"
                aria-describedby="<?= $id ?>__toggle-desc"><span class="showcode__notes-view-toggle--more">View
                  More</span><span class="showcode__notes-view-toggle--less">View Less</span>
              </button>
              <div id="<?= $id ?>__toggle-desc" class="sr-only">This control is not needed for screen reader
                users.</div>

              <div id="<?= $id ?>__example-desc" class="showcode__example--desc">
                <label for="<?= $id ?>__wrap-text">Wrap text</label>
                <input type="checkbox" id="<?= $id ?>__wrap-text" class="showcode__wrap-text" />
                <div class="showcode__scroll-message">☜ Scroll to read full source ☞</div>
              </div>
              <?php if ($isInteractive): ?>
            </form><?php endif ?>

            <pre class="showcode__example"><code
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