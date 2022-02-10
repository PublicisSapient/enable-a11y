<ul class="enable-stats">
    <?php
        if ( isset($isForNewBuilds) && $isForNewBuilds == true) {
    ?>
        <li class="enable-stats__desc enable-stats__desc--scratch">
            <img class="enable-stats__icon" src="images/icons/recommend.svg" alt="" role="presentation">
            <span class="enable-stats__label">This is the best solution to use, especially when building from scratch.</span>
        </li>
    <?php
        } else if ( isset($isForNewBuilds) && ! $isForNewBuilds ) {
    ?>
        <li class="enable-stats__desc enable-stats__desc--integrate">
        <img class="enable-stats__icon" src="images/icons/integrate.svg" alt="" role="presentation">
        <span class="enable-stats__label">Recommended to fix existing work.</span>
        </li>
    <?php 
        }

        if ($doNot) {
    ?>
        <li class="enable-stats__desc enable-stats__desc--do-not">
        <img class="enable-stats__icon" src="images/icons/do-not.svg" alt="" role="presentation">
        <span class="enable-stats__label">This works, but <em>For the Love of God and All That is Holy, don't do this.</em></span>
        </li>
    <?php
        }

        if ($isNPM) {
    ?>
        <li class="enable-stats__desc enable-stats__desc--npm">
            <img class="enable-stats__icon" src="images/icons/npm.svg" alt="" role="presentation">
            <span class="enable-stats__label">This solution available as an NPM module.</span>
        </li>
    <?php
        }
    ?>
</ul>