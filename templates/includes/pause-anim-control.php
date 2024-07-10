

<div role="navigation" aria-label="Pause Animation" id="enable-pause-control" data-is-sticky="top">
     <!-- Enable Logo (link to homepage) -->
    <?php
/* include "includes/logo-link.php";  */
?>    



    <div class="play-pause-anim__checkbox-container">
        <img src="images/accessible-text-svg/logo-enable-white.svg" class="enable-logo__text"/>
        <!-- <span class="enable-logo__text">Enable</span> -->
            
        <!-- Here is the main menu will be placed by our global.js Javascript -->
        <div id="enable-flyout-menu" data-component="EnableFlyout" data-props-id="flyout-props">
        </div>


    
        <div class="play-pause-anim__sundries">
            <label for="pause-anim-control" class="play-pause-anim__background-pill">
                <img class="pause-button" src="images/icons/pause.svg" />
                Pause animations 
                <input type="checkbox" id="pause-anim-control"
                    class="pause-anim-control__checkbox" />
            </label>
           <!-- <a href="https://github.com/PublicisSapient/enable-a11y" class="play-pause-anim__background-pill">Github</a>  -->
        </div>
    </div>

        <!-- <a href="#enable-logo">Test Back to top</a> -->
    </div>
</div>