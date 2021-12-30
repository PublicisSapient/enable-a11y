        <div class="showcode__container">
            <div class="showcode__copy">
                <?php if ($isInteractive): ?>
                <?php echo "<h$headingLevel class=\"showcode__heading\">Example code explanation</h$headingLevel>" ?>

                <p>
                    Below is the HTML of the above example. Use the dropdown
                    to highlight each of the individual steps that makes the
                    example accessible.
                </p>
            </div>

            <?php echo $extra ?>
            <?php endif ?>
            <div class="showcode">
                <?php if ($isInteractive): ?><form class="showcode__ui"><?php endif ?>
                    <?php if ($isInteractive): ?>
                    <div id="<?php echo $id ?>__steps" class="showcode__steps"></div>
                    <?php endif ?>
                    <div id="<?php echo $id ?>__notes" class="showcode__notes " role="alert" aria-live="assertive"
                    ></div>
                    <button id="<?php echo $id ?>__notes-view-toggle" class="showcode__notes-view-toggle" aria-describedby="<?php echo $id ?>__toggle-desc"><span
                        class="showcode__notes-view-toggle--more">View More</span><span
                        class="showcode__notes-view-toggle--less">View Less</span>
                    </button>
                    <div id="<?php echo $id ?>__toggle-desc" class="sr-only">This control is not needed for screen reader users.</div>

                    <div id="<?php echo $id ?>__example-desc" class="showcode__example--desc">
                        ☜ Scroll to see full source ☞
                    </div>
                    <?php if ($isInteractive): ?>
                </form><?php endif ?>

                <pre class="showcode__example"><code
                        data-showcode-id="<?php echo $id ?>"
                        data-showcode-props="<?php echo $id ?>-props"
                        tabindex="0"
                        aria-describedby="<?php echo $id ?>__example-desc"
                    >
                    </code>
                </pre>
            </div>
        </div>