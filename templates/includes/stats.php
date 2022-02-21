<div class="enable-stats">
    <?php
        if ( isset($isForNewBuilds) && $isForNewBuilds == true) {
    ?>
        <div class="enable-stats__desc enable-stats__desc--scratch">
            <img class="enable-stats__icon" src="images/icons/recommend.svg" alt="" role="presentation">
            <span class="enable-stats__label"><?= $comment ?></span>
        </div>
    <?php
        } else if ( isset($isForNewBuilds) && !$isForNewBuilds ) {
    ?>
        <div class="enable-stats__desc enable-stats__desc--integrate">
        <img class="enable-stats__icon" src="images/icons/integrate.svg" alt="" role="presentation">
        <span class="enable-stats__label"><?= $comment ?></span>
        </div>
    <?php 
        }

        if ($doNot) {
    ?>
        <div class="enable-stats__desc enable-stats__desc--do-not">
        <img class="enable-stats__icon" src="images/icons/do-not.svg" alt="" role="presentation">
        <span class="enable-stats__label"><?= $comment?></span>
        </div>
    <?php
        }

        if ($isNPM) {
    ?>
        <div class="enable-stats__desc enable-stats__desc--npm">
            <img class="enable-stats__icon" src="images/icons/npm.svg" alt="" role="presentation">
            <span class="enable-stats__label"><?= $comment ?></span>
        </div>
    <?php
        }

        if ($isStyle) {
            ?>
                <div class="enable-stats__desc enable-stats__desc--style">
                    <img class="enable-stats__icon" src="images/icons/style.svg" alt="" role="presentation">
                    <span class="enable-stats__label"><?= $comment ?></span>
                </div>
            <?php
        }

    ?>
        
</div>