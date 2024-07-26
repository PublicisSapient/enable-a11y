<div class="enable-stats">
    <?php
    if (isset($isForNewBuilds) && $isForNewBuilds == true) { ?>
        <div class="enable-stats__desc enable-stats__desc--scratch">
            <div class="enable-stats__center">
                <img class="enable-stats__icon" src="images/icons/recommend.svg" alt="recommended solution" role="presentation">
                <span class="enable-stats__label"><?= $comment ?></span>
            </div>
        </div>
    <?php } elseif (isset($isForNewBuilds) && !$isForNewBuilds) { ?>
        <div class="enable-stats__desc enable-stats__desc--integrate">
            <div class="enable-stats__center">
                <img class="enable-stats__icon" src="images/icons/integrate.svg" alt="" role="presentation">
                <span class="enable-stats__label"><?= $comment ?></span>
            </div>
        </div>
    <?php }

    if ($doNot) { ?>
        <div class="enable-stats__desc enable-stats__desc--do-not">
            <div class="enable-stats__center">
                <img class="enable-stats__icon" src="images/icons/do-not.svg" alt="" role="presentation">
                <span class="enable-stats__label"><?= $comment ?></span>
            </div>
        </div>
    <?php }

    if ($isNPM) { ?>
        <div class="enable-stats__desc enable-stats__desc--npm">
            <div class="enable-stats__center">
                <img class="enable-stats__icon" src="images/icons/npm-n.svg" alt="" role="presentation">
                <span class="enable-stats__label"><?= $comment ?></span>
            </div>
        </div>
    <?php }

    if ($isStyle) { ?>
                <div class="enable-stats__desc enable-stats__desc--style">
                    <div class="enable-stats__center">
                        <img class="enable-stats__icon" src="images/icons/style.svg" alt="" role="presentation">
                        <span class="enable-stats__label"><?= $comment ?></span>
            </div>
                </div>
            <?php }
    ?>
        
</div>