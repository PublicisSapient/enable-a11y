<h2>Bar Chart</h2>




<div id="bar-chart-example" class="enable-example chart-example">
  <div class="sr-only tabs__instructions" id="bar-chart__tabs--keyboard-only-instructions">
    Use arrow keys to choose tabs. Content for the chosen tab will be revealed below.
  </div>

  <ul class="enable-tablist" data-keyboard-only-instructions="bar-chart__tabs--keyboard-only-instructions">
    <li>
      <a href="#bar-chart__heading--visual-chart" class="enable-tab" data-owns="bar-chart__tabpanel--visual-chart">
        Visual Chart
      </a>
    </li>
    <li>
      <a href="#bar-chart__heading--raw-data" class="enable-tab" data-owns="bar-chart__tabpanel--raw-data">
        Raw Data
      </a>
    </li>

  </ul>
  <div class="enable-tabpanel" id="bar-chart__tabpanel--visual-chart">
    <h2 tabindex="-1" class="sr-only" id="bar-chart__heading--visual-chart">Visual Chart</h2>

    <a href="#bar-chart__heading--raw-data" class="bar-chart__link-to-data">
      

        <!-- This is the DOM node that will contain the chart. -->
        <div id="bar-chart" aria-label="A chart showing the AID scores for select accounts last year.  An accessible table containing this data is available in the raw data tab on this page."></div>
    </a>

  </div>
  <div class="enable-tabpanel" id="bar-chart__tabpanel--raw-data">
    <h2 tabindex="-1" class="sr-only" id="bar-chart__heading--raw-data">Raw Data</h2>
    <div class="tab__content">

      <!-- This is the sticky table container described in table.php -->
      <div class="sticky-table__container" tabindex="0">
        <figure>

          <figcaption id="bar-chart__fig-caption--table" class="caption">
            Latest Accessibility Indicator Data (AID) scores for select acconts last year.
          </figcaption>
          <div id="raw-data__content">


            <table id="bar-chart__data" aria-labelledby="bar-chart__fig-caption--table">
              <thead>
                <tr>
                  <th scope="col">Client Name</th>
                  <th scope="col">Score</th>
                </tr>
              <tbody>
                <tr>
                  <th scope="row">Scoville Medic</th>
                  <td>41</td>
                </tr>
                <tr>
                  <th scope="row">Mary's Boat Service</th>
                  <td>46</td>
                </tr>
                <tr>
                  <th scope="row">Twenty Three Auto</th>
                  <td>57</td>
                </tr>
                <tr>
                  <th scope="row">Sticks and Sons</th>
                  <td>58</td>
                </tr>
                <tr>
                  <th scope="row">Oscar Games</th>
                  <td>60</td>
                </tr>
                <tr>
                  <th scope="row">Ewe Plumbing</th>
                  <td>61</td>
                </tr>
                <tr>
                  <th scope="row">All Three A's</th>
                  <td>61</td>
                </tr>
                <tr>
                  <th scope="row">Electrical Medicine</th>
                  <td>62</td>
                </tr>
                <tr>
                  <th scope="row">Mary's Yacht Service</th>
                  <td>66.8</td>
                </tr>
                <tr>
                  <th scope="row">Starpunch Leasing</th>
                  <td>70</td>
                </tr>
                <tr>
                  <th scope="row">Fatal Disease School</th>
                  <td>72</td>
                </tr>
                <tr>
                  <th scope="row">West-end Markets</th>
                  <td>79</td>
                </tr>
                <tr>
                  <th scope="row">View X</th>
                  <td>83</td>
                </tr>
                <tr>
                  <th scope="row">Cross Country Productions</th>
                  <td>85</td>
                </tr>
                <tr>
                  <th scope="row">Rebranding International</th>
                  <td>87</td>
                </tr>
                <tr>
                  <th scope="row">Food Not Food</th>
                  <td>92</td>
                </tr>
                <tr>
                  <th scope="row">Drunken Hunters Limited</th>
                  <td>51</td>
                </tr>
                <tr>
                  <th scope="row">Fatal Box Inc.</th>
                  <td>57</td>
                </tr>
                <tr>
                  <th scope="row">Boring Nomenclature Enterprises</th>
                  <td>62</td>
                </tr>
                <tr>
                  <th scope="row">Think Man Clothing</th>
                  <td>67</td>
                </tr>
                <tr>
                  <th scope="row">The Contest Company</th>
                  <td>71</td>
                </tr>
                <tr>
                  <th scope="row">Acronyms Anonymous</th>
                  <td>82</td>
                </tr>
              </tbody>
            </table>
          </div>

        </figure>
      </div>
    </div>
  </div>
</div>


<?php includeShowcode("bar-chart-example")?>
<script type="application/json" id="bar-chart-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Make a tabbed interface",
    "highlight": "enable-tablist",
    "notes": "Please follow the instructions on <a href=\"tabs.php\">Enable tabs page</a> in order to set up the two panelled tab interface correctly."
  }]
}
</script>

<?php

/*
<h2>Line Chart</h2>

<p>Here is a chart example, modified from the <a href="https://bl.ocks.org/d3noob/5d47df5374d210b6f651">original
    demo</a> by <a href="https://gist.github.com/d3noob">d3noob</a>.</p>

<div id="line-chart__example" class="enable-example chart-example">

  <div id="line-chart__tabs">


    <div class="sr-only tabs__instructions" id="line-chart__tabs--keyboard-only-instructions">
      Use arrow keys to choose tabs. Content for the chosen tab will be revealed below.
    </div>

    <ul class="enable-tablist" data-keyboard-only-instructions="line-chart__tabs--keyboard-only-instructions">
      <li>
        <a href="#line-chart__heading--visual-chart" class="enable-tab" data-owns="line-chart__tabpanel--visual-chart">
          Visual Chart
        </a>
      </li>
      <li>
        <a href="#line-chart__heading--raw-data" class="enable-tab" data-owns="line-chart__tabpanel--raw-data">
          Raw Data
        </a>
      </li>

    </ul>
    <div class="enable-tabpanel" id="line-chart__tabpanel--visual-chart">
      <h2 tabindex="-1" class="sr-only" id="line-chart__heading--visual-chart">Visual Chart</h2>

      <div id="visual-chart__content" class="tab__content">
        <!-- This will have the chart inserted here via JavaScript -->
      </div>
    </div>
    <div class="enable-tabpanel" id="line-chart__tabpanel--raw-data">
      <h2 tabindex="-1" class="sr-only" id="line-chart__heading--raw-data">Raw Data</h2>
      <div class="tab__content">

        <!-- This is the sticky table container described in table.php -->
        <div class="sticky-table__container" tabindex="0">
          <figure>

            <figcaption id="bar-chart__fig-caption" class="caption">
              Canadian Ice Cream Mix Production, in kilolitres
            </figcaption>
            <div id="raw-data__content">
              <!-- This will have the table data inserted here via JavaScript -->
            </div>

          </figure>
        </div>
      </div>
    </div>

  </div>
</div>

*/
?>