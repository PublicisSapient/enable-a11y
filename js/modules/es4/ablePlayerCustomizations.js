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
let hasClicked = false;

function ablePlayerCustomizations($, extraCustomizations) {

  // Replace initDescription and handleTranscriptToggle methods with custom ones 
  // that add extra functionality
  AblePlayer.prototype.oldInitDescription = AblePlayer.prototype.initDescription;
  AblePlayer.prototype.oldInitDefaultCaption = AblePlayer.prototype.initDefaultCaption;
  AblePlayer.prototype.oldHandleTranscriptToggle = AblePlayer.prototype.handleTranscriptToggle;
  AblePlayer.prototype.oldGetRootPath = AblePlayer.prototype.getRootPath;

  // Add event listener for when fullscreen functionality is activated on AblePlayer
  document.addEventListener('fullscreenchange', fullScreenChangeHandler, true);

  // Add event listener to trigger the SpeechSynthsis API when clicking on the play
  // button.  This is to work around an iOS issue which won't allow the SpeechSynthesis API
  // to work unless there is some user interaction that triggers is.
  document.addEventListener('click', clickEvent, true);


  // Ensure cookies that pause the video while audio descriptions are read are
  // set before audio description functionality is initialized.  After
  // initialization, adjust layout of page if transcript is visible.
  AblePlayer.prototype.initDescription = function() {
    setDescriptionCookies();
    this.oldInitDescription();
    adjustTranscriptVisibility(this);
  }

  // Resolves issue where transcript visibility is not set properly when only captions are present.
  AblePlayer.prototype.initDefaultCaption = function() {
    this.oldInitDefaultCaption();
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

  function clickEvent() {
    if (!hasClicked && window.speechSynthesis) {
      AblePlayerInstances[0].announceDescriptionText('description', ' ');
    }
    hasClicked = true;
  }

  if (extraCustomizations && typeof(extraCustomizations) === 'function') {
    extraCustomizations();
  }
}

ablePlayerCustomizations(jQuery);