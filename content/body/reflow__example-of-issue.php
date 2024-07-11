<?php

$copy = getCgiVar("copy");
$heading = getCgiVar("heading");
$hasDropdown = getCgiVar("hasDropdown") == "true";
$hasArrows = getCgiVar("hasArrows") == "true";
$className = getCgiVar("className");

if ($heading == "") {
    $heading = "Reflow Violation Example";
}
?>

<h1><?= $heading ?></h1>

<p>(The reflow test is best experienced at the mobile breakpoint)</p>

<div class="reflow-examples__index  <?= $className ?>" aria-label="Alphabetical Index">

  <?php if ($hasDropdown) { ?>
  <details class="enable-drawer  reflow-examples__dropdown">
    <summary class="enable-drawer__button">Display Index Navigation</summary>
    <div class="content reflow-examples__dropdown--content">
      <?php } ?>
      <button class="reflow-examples__arrow-button reflow-examples__arrow-button--previous" tabindex="-1"
        aria-hidden="true">◀<span class="sr-only">Display previous links.</span></button>
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
        <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#Y">Y</a></li>
        <li class="reflow-examples__list-item"><a class="reflow-examples__link" href="#Z">Z</a></li>
      </ul>

      <button class="reflow-examples__arrow-button reflow-examples__arrow-button--next" tabindex="-1"
        aria-hidden="true">▶<span class="sr-only">Display next links.</span></button>
      <?php if ($hasDropdown) { ?>
    </div>
  </details>
  <?php } ?>
</div>

<div class="reflow-examples__content">
  <div class="reflow-examples__copy">
    <?= $copy ?>
  </div>


  <div class="no-permalink-headings countries">
    <section>
      <h2 id="A" tabindex="-1">A</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Afghanistan">Afghanistan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Albania">Albania</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Algeria">Algeria</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Andorra">Andorra</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Angola">Angola</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Antigua-and-Barbuda">Antigua
            and Barbuda</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Argentina">Argentina</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Armenia">Armenia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Australia">Australia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Austria">Austria</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Azerbaijan">Azerbaijan</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="B" tabindex="-1">B</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/The-Bahamas">The
            Bahamas</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Bahrain">Bahrain</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Bangladesh">Bangladesh</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Barbados">Barbados</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Belarus">Belarus</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Belgium">Belgium</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Belize">Belize</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Benin">Benin</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Bhutan">Bhutan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Bolivia">Bolivia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Bosnia-and-Herzegovina">Bosnia
            and Herzegovina</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Botswana">Botswana</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Brazil">Brazil</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Brunei">Brunei</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Bulgaria">Bulgaria</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Burkina-Faso">Burkina
            Faso</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Burundi">Burundi</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="C" tabindex="-1">C</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Cabo-Verde">Cabo
            Verde</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Cambodia">Cambodia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Cameroon">Cameroon</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Canada">Canada</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Central-African-Republic">Central
            African Republic</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Chad">Chad</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Chile">Chile</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/China">China</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Colombia">Colombia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Comoros">Comoros</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Democratic-Republic-of-the-Congo">Congo,
            Democratic Republic of the</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Republic-of-the-Congo">Congo,
            Republic of the</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Costa-Rica">Costa
            Rica</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Cote-dIvoire">Côte
            d'Ivoire</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Croatia">Croatia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Cuba">Cuba</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Cyprus">Cyprus</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Czech-Republic">Czech
            Republic</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="D" tabindex="-1">D</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Denmark">Denmark</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Djibouti">Djibouti</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Dominica">Dominica</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Dominican-Republic">Dominican
            Republic</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="E" tabindex="-1">E</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/East-Timor">East
            Timor</a> (Timor-Leste)
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Ecuador">Ecuador</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Egypt">Egypt</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/El-Salvador">El
            Salvador</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Equatorial-Guinea">Equatorial
            Guinea</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Eritrea">Eritrea</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Estonia">Estonia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Eswatini">Eswatini</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Ethiopia">Ethiopia</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="F" tabindex="-1">F</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Fiji-republic-Pacific-Ocean">Fiji</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Finland">Finland</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/France">France</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="G" tabindex="-1">G</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Gabon">Gabon</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/The-Gambia">The
            Gambia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Georgia">Georgia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Germany">Germany</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Ghana">Ghana</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Greece">Greece</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Grenada">Grenada</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Guatemala">Guatemala</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Guinea">Guinea</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Guinea-Bissau">Guinea-Bissau</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Guyana">Guyana</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="H" tabindex="-1">H</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Haiti">Haiti</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Honduras">Honduras</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Hungary">Hungary</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="I" tabindex="-1">I</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Iceland">Iceland</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/India">India</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Indonesia">Indonesia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Iran">Iran</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Iraq">Iraq</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Ireland">Ireland</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Israel">Israel</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Italy">Italy</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="J" tabindex="-1">J</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Jamaica">Jamaica</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Japan">Japan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Jordan">Jordan</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="K" tabindex="-1">K</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Kazakhstan">Kazakhstan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Kenya">Kenya</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Kiribati">Kiribati</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/North-Korea">Korea,
            North</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/South-Korea">Korea,
            South</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Kosovo">Kosovo</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Kuwait">Kuwait</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Kyrgyzstan">Kyrgyzstan</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="L" tabindex="-1">L</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Laos">Laos</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Latvia">Latvia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Lebanon">Lebanon</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Lesotho">Lesotho</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Liberia">Liberia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Libya">Libya</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Liechtenstein">Liechtenstein</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Lithuania">Lithuania</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Luxembourg">Luxembourg</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="M" tabindex="-1">M</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Madagascar">Madagascar</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Malawi">Malawi</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Malaysia">Malaysia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Maldives">Maldives</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Mali">Mali</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Malta">Malta</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Marshall-Islands">Marshall
            Islands</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Mauritania">Mauritania</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Mauritius">Mauritius</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Mexico">Mexico</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Micronesia-republic-Pacific-Ocean">Micronesia,
            Fede of</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Moldova">Moldova</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Monaco">Monaco</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Mongolia">Mongolia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Montenegro">Montenegro</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Morocco">Morocco</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Mozambique">Mozambique</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Myanmar">Myanmar</a> (Burma)
        </li>
      </ul>
    </section>

    <section>
      <h2 id="N" tabindex="-1">N</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Namibia">Namibia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Nauru">Nauru</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Nepal">Nepal</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Netherlands">Netherlands</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/New-Zealand">New
            Zealand</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Nicaragua">Nicaragua</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Niger">Niger</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Nigeria">Nigeria</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/North-Macedonia">North
            Macedonia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Norway">Norway</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="O" tabindex="-1">O</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Oman">Oman</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="P" tabindex="-1">P</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Pakistan">Pakistan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Palau">Palau</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Panama">Panama</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Papua-New-Guinea">Papua New
            Guinea</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Paraguay">Paraguay</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Peru">Peru</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Philippines">Philippines</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Poland">Poland</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Portugal">Portugal</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="Q" tabindex="-1">Q</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Qatar">Qatar</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="R" tabindex="-1">R</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Romania">Romania</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Russia">Russia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Rwanda">Rwanda</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="S" tabindex="-1">S</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Saint-Kitts-and-Nevis">Saint
            Kitts and Nevis</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Saint-Lucia">Saint
            Lucia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Saint-Vincent-and-the-Grenadines">Saint
            Vincent and the Grenadines</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Samoa-island-nation-Pacific-Ocean">Samoa</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/San-Marino-republic-Europe">San
            Marino</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Sao-Tome-and-Principe">Sao
            Tome
            and Principe</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Saudi-Arabia">Saudi
            Arabia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Senegal">Senegal</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Serbia">Serbia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Seychelles">Seychelles</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Sierra-Leone">Sierra
            Leone</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Singapore">Singapore</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Slovakia">Slovakia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Slovenia">Slovenia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Solomon-Islands">Solomon
            Islands</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Somalia">Somalia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/South-Africa">South
            Africa</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Spain">Spain</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Sri-Lanka">Sri
            Lanka</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Sudan">Sudan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/South-Sudan">Sudan,
            South</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Suriname">Suriname</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Sweden">Sweden</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Switzerland">Switzerland</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Syria">Syria</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="T" tabindex="-1">T</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Taiwan">Taiwan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Tajikistan">Tajikistan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Tanzania">Tanzania</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Thailand">Thailand</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Togo">Togo</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Tonga">Tonga</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Trinidad-and-Tobago">Trinidad
            and Tobago</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Tunisia">Tunisia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Turkey">Turkey</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Turkmenistan">Turkmenistan</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Tuvalu">Tuvalu</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="U" tabindex="-1">U</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Uganda">Uganda</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Ukraine">Ukraine</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/United-Arab-Emirates">United
            Arab Emirates</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/United-Kingdom">United
            Kingdom</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/United-States">United
            States</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Uruguay">Uruguay</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Uzbekistan">Uzbekistan</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="V" tabindex="-1">V</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Vanuatu">Vanuatu</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Vatican-City">Vatican
            City</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Venezuela">Venezuela</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Vietnam">Vietnam</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="Y" tabindex="-1">Y</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Yemen">Yemen</a>
        </li>
      </ul>
    </section>

    <section>
      <h2 id="Z" tabindex="-1">Z</h2>
      <ul>
        <li>
          <a href="https://en.wikipedia.org/wiki/Zambia">Zambia</a>
        </li>
        <li>
          <a href="https://en.wikipedia.org/wiki/Zimbabwe">Zimbabwe</a>
        </li>
      </ul>
    </section>
  </div>
  </div>


<?php if ($hasArrows) { ?>
<script src="js/modules/reflow-arrows.js" type="module">
</script>
<?php }
?>
