<?php
  $checked = '<td><img class="compliance-table__icon" src="images/checkmark.svg" alt="required"></td>';
  $unchecked = '<td>Not required</td>';
  $isVideoContentPage = str_ends_with($_SERVER['REQUEST_URI'], 'video-content.php');

?>


<table class="compliance-table table--equal-width-columns">
  <caption>WCAG video compliance guidelines</caption>
  <thead>
    <tr>
      <th scope="col"><span class="sr-only">Requirement</span></th>
      <th scope="col">A</th>
      <th scope="col">AA</th>
      <th scope="col">AAA</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><a href="https://www.w3.org/WAI/WCAG21/Understanding/captions-prerecorded.html">Closed Captions</a></th>
      <?= $checked ?>
      <?= $checked ?>
      <?= $checked ?>
    </tr>
    <tr>
      <th scope="row"><a href="https://www.w3.org/WAI/WCAG21/Understanding/audio-description-prerecorded.html">Audio Descriptions</a></th>
      <td class="rowspan2__top">
        <span aria-hidden="true">One or the other</span>
        <span class="sr-only">Use either audio descriptions or transcripts to be single A compliant.</span>
      </td>
      <?= $checked ?>
      <?= $checked ?>
    </tr>
    <tr>
      <th scope="row"><a href="https://www.w3.org/WAI/media/av/transcripts/">Transcripts</th>
      <td class="rowspan2__bottom">
        <span class="sr-only">Use either audio descriptions or transcripts to be single A compliant.</span>
      </td>
      <?= $unchecked ?>
      <?= $checked ?>
    </tr>
    <tr>
      <th scope="row"><a href="https://www.w3.org/WAI/WCAG21/Understanding/pause-stop-hide.html">Can Be Paused</a></th>
      <?= $checked ?>
      <?= $checked ?>
      <?= $checked ?>
    </tr>

    <?php if ($isVideoContentPage) { ?>
      <tr>
        <th scope="row"><a href="https://www.w3.org/WAI/WCAG21/Understanding/contrast-minimum.html">Good Contrast For Overlay Text</a></th>
        <?= $unchecked ?>
        <?= $checked ?>
        <?= $checked ?>
      </tr>

      <tr>
        <th scope="row"><a href="https://www.w3.org/TR/UNDERSTANDING-WCAG20/seizure-does-not-violate.html">No Seizure Inducing Sequences</a></th>
        <?= $checked ?>
        <?= $checked ?>
        <?= $checked ?>
      </tr>

      <tr>
        <th scope="row"><a href="https://www.w3.org/WAI/WCAG21/Understanding/sign-language-prerecorded.html">Sign Language</a></th>
        <?= $unchecked ?>
        <?= $checked ?>
        <?= $checked ?>
      </tr>
    <?php } ?>
  </tbody>
</table>
