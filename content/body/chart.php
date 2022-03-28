<p>Here is a chart example, modified from the <a href="https://bl.ocks.org/d3noob/5d47df5374d210b6f651">original
    demo</a> by <a href="https://gist.github.com/d3noob">d3noob</a>.</p>

<div id="line-chart-example" class="enable-example chart-example">

  <div id="tabs">


    <div class="sr-only tabs__instructions" id="tabs-keyboard-only-instructions">
      Use arrow keys to choose tabs. Content for the chosen tab will be revealed below.
    </div>

    <ul class="enable-tablist" data-keyboard-only-instructions="tabs-keyboard-only-instructions">
      <li>
        <a href="#heading__visual-chart" class="enable-tab" data-owns="tabpanel__visual-chart">
          Visual Chart
        </a>
      </li>
      <li>
        <a href="#heading__raw-data" class="enable-tab" data-owns="tabpanel__raw-data">
          Raw Data
        </a>
      </li>

    </ul>
    <div class="enable-tabpanel" id="tabpanel__visual-chart">
      <h2 tabindex="-1" class="sr-only" id="heading__visual-chart">Visual Chart</h2>

      <div id="visual-chart__content" class="tab__content">
        <!-- This will have the chart inserted here via JavaScript -->
      </div>
    </div>
    <div class="enable-tabpanel" id="tabpanel__raw-data">
      <h2 tabindex="-1" class="sr-only" id="heading__raw-data">Raw Data</h2>
      <div class="tab__content">

        <!-- This is the sticky table container described in table.php -->
        <div class="sticky-table__container" tabindex="0">
          <figure>

            <figcaption id="line-chart__fig-caption" class="caption">
              Family Birthdays (Table Coded Using Figcaption)
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

<p>Is there a better way to generate this?</p>