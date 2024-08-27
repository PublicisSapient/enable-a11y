<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        'This page discusses what is needed to make the content of the multimedia accessible.  If you are looking for an accessible video player, you should check out <a href="video-player.php">the Enable Video Player</a> page.',
]); ?>


<p>What makes a video accessible is widely misunderstood. Many web professionals know about closed captions.
    What many don't know is that they absolutely need audio descriptions in order to be WCAG AA compliant.</p>

<div class="has-multi-tables">
    <?php include "includes/wcag-video-table.php"; ?>

    <?php include "includes/wcag-audio-table.php"; ?>
</div>

<h2>Captions:</h2>
<p>A text version of speech and other important audio content in a video, allowing it to be accessible
    to people who
    can't hear all of the audio. <strong><em>They are different from subtitles, which involve translating the video's
            language into an alternate language &mdash;</em></strong> closed captions are in the same language as the
    audio.
    Subtitles don't usually contain any information about other non-spoken audio in a video (e.g. ambient sound, music,
    etc).</p>


<h3>How To Edit and Create Caption Files</h3>

<p>
    On the web, captions are usually saved in <a href="https://developer.mozilla.org/en-US/docs/Web/API/WebVTT_API">the
        WebVTT format</a>. There are a few caption editors that you can use to edit caption files:
</p>

<ul>
    <li><a href="https://www.wgbh.org/foundation/services/ncam/cadet">CADET</a> is a free to download subtitle editor
        from <a href="https://www.wgbh.org/">WGBH</a>, the Boston PBS member TV station who is a pioneer in open and
        closed captioning on TV. While it runs on any operating system that runs <a href="https://nodejs.org">Node</a>,
        it requires some technical knowledge to run.</li>
    <li><a href="https://www.nikse.dk/subtitleedit">Subtitle Edit</a> is a very feature rich subtitle editor that is
        open source and free to download. While it is a Windows application, I have used it under Linux using <a
            href="https://www.mono-project.com/">mono</a>.</li>
</ul>

<p>Note that these are only two examples of captioning software. They are listed here as examples, and may or may not be
    useful for your usecase.</p>

<p>Captioning by hand may take a long time, depending on the length and the complexity of the video. You could hire a
    third party to create them for you if your budget allows, or use AI to create the first pass and then edit the
    caption file afterwards to ensure accuracy.

<h3>Should I Use Auto Generated Captions For My Videos?</h3>

<p>
    <strong>Auto-generated captions should always be checked for accuracy.</strong> If the
    captions aren't accurate, they are technically not a pass for <a
        href="https://www.w3.org/WAI/WCAG21/Understanding/captions-prerecorded.html">WCAG 1.2.2 - Captions
        (Prerecorded)</a>.
</p>

<p>
    While AI has come a long way recently, and can sometimes be very accurate, you still should remediate AI-generated
    captions since it still produces errors. AI programs such as <a
        href="https://github.com/ggerganov/whisper.cpp">Whisper C++</a> can generate well written captions (and can even
    translate from other languages into English) with greater accuracy than older technologies (e.g. <a
        href="https://support.google.com/youtube/answer/6373554?hl=en">YouTube's auto-generated captions</a>). Let's
    discuss the issues with AI caption programs in detail below.
</p>

<h3>Do Background Sounds and Music Need Captions?</h3>

<p>
    Some video services like YouTube will generate captions automatically using AI that converts audio to text. While
    this works reasonably well in when it's just one or two people talking in the video, auto-captioning software can
    fail when there is a lot of background music and noise (this is especially true with YouTube auto-generated
    captions). Programs like Whisper C++ are much better in these situations, but can mess up the timing of the captions
    in certain situations. And while Whisper C++ can do a good job with music lyrics in some situations, it depends on
    the music sometimes. Also Whisper C++ can sometimes hallucinate, which is another reason to double check its work.
</p>


<p>
    Furthermore, non-verbal sound effects in the video can be integral to understanding content or videos for deaf and
    hard of hearing users. Human caption writers will usually describe these sound effects inside parantheses. For
    example: in a horror film, the noises made a horror film by something offscreen can be captioned as "(a squeaky door
    opening can be heard in the distance)". Similar captions could describe a buzzer indicating a wrong answer or end of
    the round
    that isn't announced by the host in a game show. These are overt examples, but it is a huge reason auto captions
    should not be a replacement but rather a starting point for providing accessible captioning (and transcripts).
</p>






<h2>Audio Descriptions:</h2>
<p>An extra audio track with spoken commentary what help users with visual disabilities perceive content that is
    presented only visually. A narrator usually describes the visual-only content in the video. Audio descriptions can
    be implemented in several ways:

<ol>
    <li>They can be included in the primary video, available to all users on the video's default audio track.</li>
    <li>They can be provided in a different audio track in the video. On broadcast television in North America, this
        has be implemented using <a href="https://en.wikipedia.org/wiki/Second_audio_program">Secondary Audio
            Programming</a>.</li>
    <li>They can be recited by a computer voice speaking over the video content, as shown in our demo of AblePlayer on
        <a href="video-player.php#video-player-with-text-to-speech-audio-descriptions--heading">the Enable Accessible
            Video Player page</a>.
    </li>
    <li>They can be provided by an alternate cut of the video. You would just need to have a link to that audio
        described version on the video page. An example of this is on <a
            href="https://www.youtube.com/watch?v=euI8FJvfmqc">the Killer B Cinema Trailer for 3 Dev Adam</a> (with the
        audio described version linked in the video description).</li>
</ol>

<p><strong>Please note: If all of the visual information in described in the video's audio track already, then a
        separate audio description track is not necessary.</strong>
</p>

<h2>Transcripts:</h2>
<p>A transcript is used by users who can neither hear audio nor see video, like deaf/blind users. It is like the
    script the actors in the video use to know what is going on in the story that they are about to act in. A transcript
    also should include descriptions of audio information in the video (like laughing) and visual information (such as
    the creak of a door opening).
</p>

<p>
    All of these concepts are explained in greater detail in <a href="https://webaim.org/techniques/captions/">WebAIM's
        excellent article on Captions, Transcripts, and Audio Descriptions</a>.
</p>


<p>
    To find one of the most cost-effective way of implementing all three, I would suggest looking into the <a
        href="video-player.php">Enable Video Player</a> page, which shows how do so using <a
        href="https://ableplayer.github.io/ableplayer/">Able Player</a>.
</p>



<h3>Do YouTube Transcripts Count As WCAG Transcripts?</h3>

<p>
    Note that YouTube does have a "transcript" functionality, but what it basically does is just show all the captions
    with timing information in a section of the page. Here is a screenshot of where it appears in the video component on
    YouTube (next to the save button is a menu button with three dots, with a screen reader label of "More actions",
    that
    has "Show transcript" as a menu item):
</p>
<p>
    Note that most of the time this is not really a transcript, since it doesn't have any of the visual information
    conveyed in the video. Below is a screenshot of <a href="https://www.youtube.com/watch?v=dceIpnMw6CE">a video has a
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
        transcript does not have descriptions of the visual actions that happen in the video. It only has information
        about
        the audio track (including that of the sound effects and music).</figcaption>
</figure>
<p>
    Now compare this with the AblePlayer video in the first example above. The AblePlayer video actually does have a
    proper transcript; it contains descriptions of what is happening visually that is not given by the spoken text in
    the
    video).
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
        Figure 2. A screenshot of the AblePlayer example transcript at the bottom of this page. To sighted users, the
        visual
        action in the video not covered by the closed captions appear in the red blocks inside the transcript.
    </figcaption>
</figure>

<p>
    Note that AblePlayer has interactive transcripts that, when clicked, will jump to the section of the video that the
    transcript applies to. <strong>This interactivity is a nice to have, and not necessary to satisfy WCAG.</strong>.
</p>

<p>The main takeaway here is that YouTube transcripts aren't really transcripts, since they don't give all users
    (particularly deafblind users), what is going on in the video.</p>

<h2>How to Avoid Seizure Inducing Sequences</h2>



<p>
    All animations, including video, must follow <a
        href="https://www.w3.org/TR/UNDERSTANDING-WCAG20/seizure-does-not-violate.html">WCAG requirement 2.3.1 - Three
        Flashes or Below Threshold</a>. This is to prevent animated and video content from causing users from having
    seizures.
</p>

<p>
    Since I have already written blog posts on how to detect and fix seizure inducing sequences from video, I will just
    link to that content here:
</p>


<ul>
    <li><a href="https://www.useragentman.com/blog/2017/04/02/using-peat-to-create-seizureless-web-animations/">Using
            PEAT
            To Create Seizureless Web Animations</a></li>
    <li><a href="https://www.useragentman.com/blog/2020/07/19/how-to-fix-seizure-inducing-sequences-in-videos/">How to
            Fix
            Seizure Inducing Sequences In Videos.</a></li>
</ul>

<div role="figure" aria-labelledby="aria-caption1">
    <img src="images/multimedia/pokemon.jpg"
        alt="A young boy wearing a cap, a blue jacket, and gloves is excitedly looking at a small yellow creature with long ears in front of him. They are both facing a large red background." />
    <span id="aria-caption1">
        A still from <a href="https://en.wikipedia.org/wiki/Denn%C5%8D_Senshi_Porygon">Dennō Senshi Porygon</a>, an
        episode of <a href="https://en.wikipedia.org/wiki/Pok%C3%A9mon_(anime)">the Pokémon TV show</a> that caused some
        children to have seizures in 1997, due to a huge area of the screen flashing red and white.
    </span>
</div>






<h2>Good Contrast On Overlay Text</h2>

<p>Just like live HTML text over images, overlayed text in video must have enough contrast to be legible. Unlike
    live HTML text, it is impossible to enlarge this text or change the colour of overlayed text via CSS, since it
    is "burned in" to the pixels of the video. An example is in the image below.</p>

<div role="figure" aria-labelledby="aria-caption--overlay">
    <img src="images/multimedia/overlay-text.jpg"
        alt="Two martial artists are engaged in combat in an outdoor setting with traditional buildings in the background. The text 'PRODUCTION MANAGER: RICHARD CHEUNG' is overlaid in large white letters across the image. Some of this text is hard to read due to the white text blending in with some of the light gray buildings in the background." />
    <span id="aria-caption--overlay">
        A screenshot from the opening credits from <a href="https://en.wikipedia.org/wiki/Dance_of_the_Drunk_Mantis">the
            film "Dance of the Drunk Mantis"</a>.

    </span>
</div>

<p>While you could check foreground and background colours of individual pixels using a tool like the WebAIM
    Contrast Checker, what I usually do is take a screenshot of the video frame with the burned in text and use a
    screenshot-based tool like <a
        href="https://chromewebstore.google.com/detail/color-contrast-analyzer/dagdlcijhfbmgkjokkjicnnfimlebcll?hl=en">Color
        Contrast Analyzer Chrome Plugin</a> offered by <a href="https://accessibility.oit.ncsu.edu/">IT
        Accessibility at NC State</a>.</p>


<div role="figure" aria-labelledby="aria-caption--overlay2">
    <img src="images/multimedia/overlay-text-2.jpg"
        alt="Two men fighting in the background with words overlayed on top that read 'Also Starring: Sun Kwei (as Rubber Legs student'), Charlier Shek (as Moneybags)'.  Like the previous screenshot, some of the text is hard to read since the white text sometimes blends into the light background of the ground." />
    <span id="aria-caption--overlay2">
        Another screenshot from the opening credits from <a
            href="https://en.wikipedia.org/wiki/Dance_of_the_Drunk_Mantis">the film "Dance of the Drunk
            Mantis".</a>.
    </span>
</div>

<div role="figure" aria-labelledby="aria-caption--overlay2a">
    <img src="images/multimedia/overlay-text-2a.jpg"
        alt="A screenshot of the WCAG 2.0 Contrast Checker plugin for Chrome testing the previous screenshot. It outlines a lot of the text, but some of it is not outlined, which indicates the text doesn't have proper contrast." />
    <span id="aria-caption--overlay2a">
        A screenshot of the WCAG 2.0 Contrast Checker plugin for Chrome testing the previous screenshot.
    </span>
</div>

<p>
    Just like any colour contrast issues on web pages, you can fix this by:
</p>

<ul>
    <li>Changing the text color</li>
    <li>Adding text outlines</li>
    <li>Adding text shadows</li>
    <li>Adding a semi-transparent background block to the text</li>
    <li>Darkening the background around the text with a gradient</li>
</ul>

<div role="figure" aria-labelledby="aria-caption--killer-b-1">
    <img src="images/multimedia/killerb-1.jpg"
        alt="A screenshot from the trailer of a film.  There is easy-to-read text overlayed on top of the action in the background that reads 'Killer B Cinema proudly presents'." />
    <span id="aria-caption--killer-b-1">
        A screenshot from <a href="https://youtu.be/V9ofOPLoMHg">the trailer for the 1973 Turkish film Karate
            Girl</a>. Note that the text is easy to read due to the addition of dark text shadowing around the text
        onscreen.
    </span>
</div>

<h2>Fixing Low Background Noise</h2>

<p>A lot of background noise can be an issue for hard-of-hearding users who are listening to multimedia content. <a
        href="https://www.w3.org/WAI/WCAG21/Understanding/low-or-no-background-audio.html">WCAG 1.4.7: Low or No
        Background Audio</a> (a AAA requirement) states that recommends that for all multimedia content, one of the
    following should be true:

<ul>
    <li>There is no background audio.</li>
    <li>The background audio can be turned off.</li>
    <li>The background sounds are at least 20 decibels lower (i.e. four times as quieter) than the foreground speech
        content, with the exception of occasional sounds that last for only one or two seconds.</li>
</ul>

<p>
    While this is an AAA requirement, it would be nice to fix these types of issues when they arise. If you have a
    piece of multimedia that has a lot of background noise, we recommend fixing that by re-mixing the audio. If you
    don't have the original multi-channel master of the audio, this problem still can be fixed by separating the
    speech with the rest of the audio using AI using a tool like <a href="https://vocalremover.org/">Vocal
        Remover</a>. You can then take these two tracks and remixing them with the vocals boosted in volume using a
    tool like <a href="https://www.audacityteam.org/">Audacity</a>. If the vocals aren't clear enough, you could use
    a tool like <a href="https://podcast.adobe.com/enhance?checkout=true#">Adobe Podcast's Enhance Speech tool</a>.
</p>

<p>If the background noise is a persistent hiss or hum, you can <a
        href="https://www.zdnet.com/article/how-to-remove-background-noise-in-audacity-for-better-sounding-podcasts/">Audacity's
        Noise Reduction tool</a> to remove that from the audio track.</p>

<p>Below are two videos from a VHS copy of the American dub of the Japanese cartoon "8-man" (called "eighth Man" in the
    U.S.). The first video has the original audio with a lot of bad audio noise from the original over-the-air
    recording. The second video has removed that noise by extracting the voice data using <a
        href="https://vocalremover.org/">Vocal Remover</a>, improving its fidelity using <a
        href="https://podcast.adobe.com/enhance?checkout=true#">Adobe Podcast's Enhance Speech tool</a> and remixing
    it with the similar music from a different source. The results can be quite impressive.</p>

<div role="figure" class="video-figure" aria-labelledby="eighth-man-video-before">
    <div class="enable-media-player">
        <video data-able-player id="eighth-man-video-before__video" data-youtube-id="cJR0tBNj3uA" preload="auto"
            data-skin="2020" data-root-path="./js/enable-libs/ableplayer/" data-heading-level="3">
            <track kind="descriptions" src="vtt/clip-8th-man.vtt" srclang="en" label="English Audio Descriptions">
        </video>
    </div>
    <span id="eighth-man-video-before" class="video-figure__caption">
        An English language clip from an over-the-air recording of the 8th-man cartoon "Virus". Note that really bad
        audio hum in the background that makes the clip's audio almost unlistenable.
    </span>
</div>

<div role="figure" class="video-figure" aria-labelledby="eighth-man-video-after">
    <div class="enable-media-player">
        <video data-able-player id="eighth-man-video-after__video" data-youtube-id="K-B7-GS6ipM" preload="auto"
            data-skin="2020" data-root-path="./js/enable-libs/ableplayer/" data-heading-level="3">
            <track kind="descriptions" src="vtt/clip-8th-man.vtt" srclang="en" label="English Audio Descriptions">
        </video>
    </div>
    <span id="eighth-man-video-after" class="video-figure__caption">
        The same clip after AI was used to clean up the audio as described above. The differences are night and day.
    </span>
</div>

<h2>Sign Language</h2>

<p>Watching a video with captions can be more inclusive, but does add to the cognitive load and eye fatigue of the
    person watching the film. For people who understand sign language, it may be more desireable to have sign
    language interpretation as part of the mulimedia content.</p>

<p>Not everyone with hearing loss understands sign language. It should be noted that there are many sign languages
    used throughout the world. <a href="https://en.wikipedia.org/wiki/American_Sign_Language">American Sign
        Language</a>, <a href="https://en.wikipedia.org/wiki/British_Sign_Language">British Sign Lanaguage</a> and
    <a href="https://en.wikipedia.org/wiki/Plains_Indian_Sign_Language">Plains Sign Language</a> are just a few
    examples. For these reasons, <a
        href="https://www.w3.org/WAI/WCAG21/Understanding/sign-language-prerecorded.html">Sign Language support in
        pre-recorded multimedia</a> is a WCAG AAA guideline.
</p>

<p>That said, Deaf users may want to have sign language and captions at the same time, especially if the may have
    trouble reading the captions due to cogntive of vision related disabilities. For that reason, sign language
    support in multimedia is mandated in a lot of government communications in countries around the world.</p>

<p>If you do wish to have sign language in your media, you will want to keep the following in mind:</p>

<ol>
    <li>Ensure there is good lighting for the sign language video.</li>
    <li>Include a high contrast border around the signer that captures a lot of the signing space (transparent
        background is experimental).</li>
    <li>Ensuring high contrast between hands and background/clothes is ideal.</li>
    <li>The sign language interpreters face must be large enough for the viewer to see their facial expressions.
    </li>
    <li>The standard placement for a sign language interpreter is in the bottom right of video, but this can be
        adjusted in order to not obscure important content in a video.</li>
    <li>If you are in a multilanguage environment (like Canada), you may need two interpreters (e.g. American Sign
        Language for English-speaking Canada and <a href="https://en.wikipedia.org/wiki/Quebec_Sign_Language">Quebec
            Sign Language</a>) for French-speaking Canada.</li>
    <li>Remember just because two countries (like the United States and the United Kingdom) have the same spoken
        language, they still may have two different forms of sign language (in this case, ASL and BSL).</li>
    <li>Some video editors may want to freeze the sign language interpreter to emphasize what is being said.</li>
</ol>

<h2>Considerations when Broadcasting Events Live</h2>

<p>Live online events need to be accessible as well! The following should be kept in mind if you want to ensure an
    accessible experience for all viewers.</p>

<ol>
    <li>Captions should be used throughout your entire broadcast. Human made ones are better than AI ones (or you
        could also have a human edit the AI ones on the fly).</li>
    <li>When posting the video afterwards, your captions should be edited for clarity and accuracy.</li>
    <li>Consider using sign language interpreters for your presentation. If you do so, please keep in mind that one
        interpreter is not enough, since any kind of on-the-fly translation is a cognitively tiring experience for
        the translator.</li>
</ol>

<div role="figure" class="video-figure" aria-labelledby="canada-covid-update-example">
    <div class="enable-media-player">
        <video data-able-player id="canada-covid-update-example__video" data-youtube-id="00TbnrkLY5k" preload="auto"
            data-skin="2020" data-root-path="./js/enable-libs/ableplayer/" data-heading-level="3">
            <track kind="captions" src="vtt/covid-update.vtt" srclang="en"
                label="English Captions generated by YouTube A.I.">
        </video>
    </div>
    <span id="canada-covid-update-example" class="video-figure__caption">
        A COVID-19 update given by the Government of Canada, which was broadcast live on May 20, 2020. Note the two sign
        language interpreters for the two different forms of sign language used in Canada. These translators are swapped
        out just after the 31 minute mark to ensure the translators are not fatigued, which can easily lead to mistakes
        in the translation. Unfortunately, the captions are auto-generated by an A.I., which results in a less than
        optimal experience for users that need them.
    </span>
</div>