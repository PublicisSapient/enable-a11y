        <div class="showcode__container">
            <?php if ($isInteractive): ?>
            <?php echo "<h$headingLevel class=\"showcode__heading\">Example code explanation</h$headingLevel>" ?>

            <p>
                Below is the HTML of the above example. Use the dropdown
                to highlight each of the individual steps that makes the
                example accessible.
            </p>

            <?php echo $extra ?>
            <?php endif ?>
            <div class="showcode">
                <?php if ($isInteractive): ?><form class="showcode__ui"><?php endif ?>
                    <?php if ($isInteractive): ?>
                    <div id="<?php echo $id ?>__steps" class="showcode__steps"></div>
                    <?php endif ?>
                    <div id="<?php echo $id ?>__notes" class="showcode__notes read-more" role="alert" aria-live="assertive"></div>

                    <div class="showcode__example--desc">
                        ☜ Swipe to see full source ☞
                    </div>
                    <?php if ($isInteractive): ?>
                </form><?php endif ?>

                <pre class="showcode__example"><code
                        data-showcode-id="<?php echo $id ?>"
                        data-showcode-props="<?php echo $id ?>-props"
                        tabindex="0"
                    >
                    </code>
                </pre>
            </div>
        </div>