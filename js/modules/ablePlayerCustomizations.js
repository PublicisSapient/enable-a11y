'use strict'

/*******************************************************************************
 * ablePlayerCustomizations.js - Customization of AblePlayer, loaded as a module
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 28, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/video-player.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

/* global AblePlayer, jQuery */
import '../../enable-node-libs/jquery/dist/jquery.min.js';
import '../enable-libs/ableplayer/thirdparty/js.cookie.js';
import { AblePlayerInstances } from '../enable-libs/ableplayer/build/ableplayer.js';


function ablePlayerCustomizations($, extraCustomizations) {

  // Replace initDescription and handleTranscriptToggle methods with custom ones 
  // that add extra functionality
  AblePlayer.prototype.oldInitDescription = AblePlayer.prototype.initDescription;
  AblePlayer.prototype.oldHandleTranscriptToggle = AblePlayer.prototype.handleTranscriptToggle;
  AblePlayer.prototype.oldGetRootPath = AblePlayer.prototype.getRootPath;

  // Add event listener for when fullscreen functionality is activated on AblePlayer
  document.addEventListener('fullscreenchange', fullScreenChangeHandler, true);


  // Ensure cookies that pause the video while audio descriptions are read are
  // set before audio description functionality is initialized.  After
  // initialization, adjust layout of page if transcript is visible.
  AblePlayer.prototype.initDescription = function() {
    setDescriptionCookies();
    this.oldInitDescription();
    adjustTranscriptVisibility(this);
  }

  // When transcript button is clicked, adjust layout of page.
  AblePlayer.prototype.handleTranscriptToggle = function() {
    this.oldHandleTranscriptToggle();
    adjustTranscriptVisibility(this);
  }

  // When transcript is visible, ensure proper CSS classes are 
  // set the DOM so that the video takes up half the screen
  // and that the transcript placed next to the video.
  function adjustTranscriptVisibility(player) {
    if (player.$transcriptDiv.is(':visible')) {
      player.$ableDiv.addClass('able-transcript-visible');
    } else {
      player.$ableDiv.removeClass('able-transcript-visible');
    }
  }

  // This ensures that the video is paused when audio descriptions are
  // being read out. 
  function setDescriptionCookies() {
    AblePlayerInstances.forEach((el) => {
      /* Ensure Audio Descriptions pause video when they are spoken */
      var playerCookie = el.getCookie();
      playerCookie.preferences.prefDescPause = 1;
      el.setCookie(playerCookie);
      el.prefDescPause = 1;
    });
  }


  // Adjust layout when video full screen functionality is activated.
  function fullScreenChangeHandler() {
    if (document.fullscreenElement) {
      document.fullscreenElement.classList.add('is-fullscreen');
    } else {
      document.querySelector('.is-fullscreen').classList.remove('is-fullscreen');
    }
  }

  if (extraCustomizations && typeof(extraCustomizations) === 'function') {
    extraCustomizations();
  }
}

ablePlayerCustomizations(jQuery);

export { ablePlayerCustomizations, AblePlayerInstances };