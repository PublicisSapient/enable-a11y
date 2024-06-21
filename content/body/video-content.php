<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        'This page discusses what is needed to make the content of the video accessible.  If you are looking for an accessible video player, you should check out <a href="video-player.php">the Enable Video Player</a> page.',
]); ?>


<h2>What are Captions, Audio Descriptions, and Transcripts (and Why Should I Care)?</h2>

<p>Let's start by defining them:</p>

<div class="enable-example">
<dl>
  <dt>Captions: </dt>
  <dd>Text that appears during the playing of a video, usually placed at the bottom of the viewing area, that displays what people in the video are saying in realtime. 
    Captions also describe other important audio content in a video, like sound effects in the background. <strong><em>They are different from subtitles, which involve translating the video's
    language into an alternate language &mdash;</em></strong> closed captions are in the same language as the audio.
    Subtitles don't usually contain any information about other non-spoken audio in a video (e.g. ambient sound, music,
    etc).</dd>

  <dt>Audio Descriptions:</dt>
  <dd>An extra audio track with spoken commentary helps blind and partially-sighted users perceive content that is
    presented only visually. A narrator usually describes the visual-only content in the video. Audio descriptions can
    be implemented in several ways:

    <ol>
      <li>they can be included in the primary video</li>
      <li>they can be provided in a different audio track in the video. On broadcast television in North America, this
        has been implemented using <a href="https://en.wikipedia.org/wiki/Second_audio_program">Secondary Audio
          Programming</a>.</li>
      <li>they can be recited by a computer voice speaking over the video content</li>
      <li>they can be implemented as an alternate version of the video that includes audio descriptions.</li>
    </ol>

    <p><strong>Please note: If all of the visual information is described in the video's audio track already, then a separate audio description track is not necessary.</strong></p>
  </dd>

  <dt>Transcripts:</dt>
  <dd>A transcript is used by users who can neither hear audio nor see video, like deaf or blind users. It is like the
      script, the actors in the video used to know what was going on in the story that they were about to act in. A transcript
      also should include descriptions of audio information in the video (like laughing) and visual information (such as
      the creak of a door opening).
  </dd>
</dl>
</div>

<p>
  All of these concepts are explained in greater detail in <a href="https://webaim.org/techniques/captions/">WebAIM's
    excellent article on Captions, Transcripts, and Audio Descriptions</a>.
</p>

<p>What makes a video accessible is widely misunderstood. Many web professionals know about closed captions.
  What many don't know is that they need audio descriptions in order to be WCAG AA compliant.</p>

  <?php include "includes/wcag-video-table.php"; ?>

<p>
  To find one of the most cost-effective ways of implementing all three, I would suggest looking into the <a href="video-player.php">Enable Video Player</a> page, which shows how to do so using <a href="https://ableplayer.github.io/ableplayer/">Able Player</a>.
</p>





<h2>Should I Use Auto-Generated Captions For My Videos?</h2>

<p>
  Some video services like YouTube will generate captions automatically using AI that converts audio to text. While this
  works in a lot of situations, it is not perfect. Auto-generated captions should always be checked for accuracy; if the
  captions aren't accurate, they are technically not a pass for <a
    href="https://www.w3.org/WAI/WCAG21/Understanding/captions-prerecorded.html">WCAG 1.2.2 - Captions
    (Prerecorded)</a>.
</p>

<p>
  Furthermore, auto-captions often do not capture music and sound effects (other than putting something like "[music]"
  in the subtitles) that can be integral to understanding content or videos for deaf and hard-of-hearing users. This
  could lead to missing key context in the video, such as why a monster might be in the room in a horror movie
  (skittering, door creaking open, and other faint soft sounds), a buzzer indicating a wrong answer or the end of the round
  that isn't announced by the host in a game show, etc. These are overt examples, but it is a huge reason auto-captions
  should not be a replacement but rather a starting point for providing accessible captioning (and transcripts).
</p>

<p>The good thing here is that auto-generated captions in many services like YouTube can be downloaded to your 
  computer. I have often used these captions as a starting point. Editing them using a subtitle editor and re-posting
  them to YouTube (or to whatever video provider you are using), will save time in the subtitling of the video.
</p>

YouTube auto-captions (and others) do not often capture sound (other than just "[music]") that can be integral to
understanding content or videos for deaf and hard-of-hearing users.
It could lead to missing key context such as why a monster might be in the room in a horror movie (e.g.: a door creaking
open, eerie music being played), a buzzer indicating a wrong answer, or the end of the round that isn't announced by the host
in a game show, etc. These are overt examples, but it is a huge reason auto-captions should not be a replacement but
rather a starting point for providing accessible captioning (and transcripts).

<h2>Do YouTube Transcripts Count As WCAG Transcripts?</h2>

<p>
  Note that YouTube does have a "transcript" functionality, but what it does is just show all the captions
  with timing information in a section of the page. Here is a screenshot of where it appears in the video component on
  YouTube (next to the save button is a menu button with three dots, with a screen reader label of "More actions", that
  has "Show transcript" as a menu item):
</p>
<p>
  Note that most of the time this is not a transcript, since it doesn't have any of the visual information
  conveyed in the video. Below is a screenshot of <a href="https://www.youtube.com/watch?v=dceIpnMw6CE">a video that has a
    YouTube transcript generated from a captions file</a>:
</p>

<figure>

  <?php pictureWebpPng(
      "images/pages/video-player/youtube-captions-example",
      "A screenshot of the YouTube transcript component for the video linked above.  The text reads:



0:02
(Eerie, unsettling music plays in the background)
0:14
Somewhere between science and superstition,
0:21
there is another world
0:23
A world of darkness.
0:34
Nobody expected it.
0:39
Nobody believed it.
0:42
Nothing could stop it.
0:47
[Screaming]
0:59
The one hope.
1:01
The only hope.
1:04
The Turkish Exorcist.
1:09
(A very rough version of Tubular Bells from the movie's soundtrack plays in the background)",
  ); ?>

  <figcaption>Figure 1. A screenshot of the YouTube transcript of <a
      href="https://www.youtube.com/watch?v=dceIpnMw6CE">the trailer for The Turkish Exorcist</a>. Note that the
    transcript does not have descriptions of the visual actions that happen in the video. It only has information about
    the audio track (including the sound effects and music).</figcaption>
</figure>
<p>
  Now compare this with the AblePlayer video in the first example above. The AblePlayer video does have a
  proper transcript; it contains descriptions of what is happening visually that are not given by the spoken text in the
  video.
</p>

<figure>
  <?php pictureWebpPng(
      "images/pages/video-player/ableplayer-captions-example",
      "A screenshot of the AblePlayer transcript component for the Accessible Video Player example above.  The transcript reads:
    
    (Scene is a title screen, which reads 'Creating Accessible HTML5 Modal Dialogs For Desktop and Mobile. Zoltan Hawryluk - useragentman.com')
In this video, I will be demonstrating how to create an accessible modal dialog using the HTML5 dialog tag. It uses a polyfill for browsers that don't support it yet natively. For details on the polyfill and more information on how this demo was built, please checkout the video's accompanying blog post on useragentman.com. 
    ",
  ); ?>
  <figcaption>
    Figure 2. A screenshot of the AblePlayer example transcript at the bottom of this page. To sighted users, the visual
    action in the video not covered by the closed captions appears in the red blocks inside the transcript.
  </figcaption>
</figure>

<p>
  Note that AblePlayer has interactive transcripts that, when clicked, will jump to the section of the video that the
  transcript applies to. <strong>This interactivity is nice to have, and not necessary to satisfy WCAG.</strong>
</p>

<p>The main takeaway here is that YouTube transcripts aren't transcripts, since they don't give all users
  (particularly deafblind users), what is going on in the video.</p>

<h2>How to Avoid Seizure-Inducing Sequences</h2>

<p>
  All animations, including video, must follow <a
    href="https://www.w3.org/TR/UNDERSTANDING-WCAG20/seizure-does-not-violate.html">WCAG requirement 2.3.1 - Three
    Flashes or Below Threshold</a>. This is to prevent animated and video content from causing users to have
  seizures.
</p>

<p>
  Since I have already written blog posts on how to detect and fix seizure-inducing sequences from videos, I will just
  link to that content here:
</p>

<ul>
  <li><a href="https://www.useragentman.com/blog/2017/04/02/using-peat-to-create-seizureless-web-animations/">Using PEAT
      To Create Seizureless Web Animations</a></li>
  <li><a href="https://www.useragentman.com/blog/2020/07/19/how-to-fix-seizure-inducing-sequences-in-videos/">How to Fix
      Seizure Inducing Sequences In Videos.</a></li>
</ul>

