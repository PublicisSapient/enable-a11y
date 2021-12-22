function autoPlayVideoModal() {

    var trigger = $('.trigger');
    var $video = $('#video1');

    const observer = new MutationObserver(videoMutationHandler);
    observer.observe($('.enable-video-player')[0], {subtree: true, childList: true});

    var player = new AblePlayer($video);

    /* Ensure Audio Descriptions pause video when they are spoken */
    var playerCookie = player.getCookie();
    playerCookie.preferences.prefDescPause = 1;
    player.setCookie(playerCookie);


    trigger.on('click', function (e) {

        e.preventDefault();
        var theModal = $(this).data("target");
        var $transcriptButton = $('.able-button-handler-transcript');
        var $transcriptArea = $('.able-transcript-area');

        if (!$transcriptButton.hasClass('has-transcript')) {
            $transcriptArea.css('display', 'none');
        }

        changeVideoPlayerLocation($transcriptButton);
        $transcriptButton.on('click', changeVideoPlayerLocationEvent);
        document.addEventListener('fullscreenchange', fullScreenChangeHandler, true);

        $(theModal).on('hidden.bs.modal', function (e) {
            $transcriptButton.off('click', changeVideoPlayerLocationEvent);
            document.removeEventListener('fullscreenchange', fullScreenChangeHandler, true);
            $transcriptButton.addClass('buttonOff');
            player.pauseMedia();
        });
    });



};