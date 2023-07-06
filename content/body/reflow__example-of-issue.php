<?php

function getCgiVar($name) {
  $isVarSet = isset($_GET[$name]);
  if ($isVarSet) {
    $r = $_GET[$name];
  } else {
    $r = '';
  }

  return $r;
}

$copy = getCgiVar('copy');
$hasDropdown = (getCgiVar('hasDropdown') == 'true');
$hasArrows = (getCgiVar('hasArrows') == 'true');

?>


<p>
  This page shows a Reflow issue with the page index below.
</p>


<div class="reflow-examples__index  <?= $_GET['className'] ?>" aria-label="Alphabetical Index">
  
  <?php
    if ($hasDropdown) {
  ?>
      <details
        class="enable-drawer"
      >
        <summary
          class="enable-drawer__button"
        >Display Index Navigation</summary>
        <div class="content">
  <?php 
    }
  ?>
  <button class="reflow-examples__arrow-button reflow-examples__arrow-button--previous" tabindex="-1" aria-hidden="true">◀<span class="sr-only">Display previous links.</span></button>
  <ul class="reflow-examples__list">
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#A">A</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#B">B</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#C">C</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#D">D</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#E">E</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#F">F</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#G">G</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#H">H</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#I">I</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#J">J</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#K">K</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#L">L</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#M">M</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#N">N</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#O">O</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#P">P</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#Q">Q</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#R">R</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#S">S</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#T">T</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#U">U</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#V">V</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#W">W</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#X">X</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#Y">Y</a></li>
    <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#Z">Z</a></li>
  </ul>

  <button class="reflow-examples__arrow-button reflow-examples__arrow-button--next" tabindex="-1" aria-hidden="true">▶<span class="sr-only">Display next links.</span></button>
  <?php
    if ($hasDropdown) {
  ?>
        </div>
      </details>
  <?php 
    }
  ?>
</div>

<div class="reflow-examples__copy">
<?= $copy ?>
</div>


<?php 
  if ($hasArrows) {
?>
  <script src="js/modules/reflow-arrows.js" type="module">
  </script>
<?php
  }
?>