<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.4.0">

    <title>Accessible Table Examples</title>
		<?php include "includes/common-head-tags.php";?>
    <link rel="stylesheet" type="text/css" href="css/table.css" />
</head>

<body>
    <?php include "includes/example-header.php";?>

    <main>

        <aside class="notes">
            <h2>Notes:</h2>

            <p>Many web developers don't know that they need to put the following in tables in order for them to work correctly with screen readers and other assistive technologies:</p>

            <ul>
                <li><code>th</code> tags must have a scope attribute set to <code>row</code> if it is a heading for a table row, or <code>col</code> if it is a column row</li>
                <li>All tables must have a text summary of what data is in the table.  This can be coded using a <code>summary</code> tag (see the first exmaple), or
                a <code>aria-labelledby</code> on the table element (see the figcaption example)</li>

            </ul>

            <p>Screen-reader users should be able to navigate the table using their screen-reader's built in navigation:</p>

            <ul>
                    <li>In voiceover, go to the rotor, choose the table and navigate around with the CAPS-LOCK + arrow-keys.
                    </li>
                    <li>
                        In NVDA, press the T key to go to the next table (SHIFT+T to go to the previous one), use the arrow keys to get out of the
                        caption and CTRL+ALT+arrow-keys to move around the table. To ensure you understand how the tables are being
                        read, you may want to install the
                        <a href="https://addons.nvda-project.org/addons/focusHighlight.en.html">
                            Focus Highlight NVDA plugin</a>.
                    </li>
                </ul>

        </aside>


        <h1>Accessible Table Examples</h1>


        <h2>A Simple Table</h2>

        <p>Just a simple table.</p>

        <div id="table-example1">
            <table>
                <caption>A Simple HTML Table</caption>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Birthday</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th scope="row">Jackie</th>
                        <td>5</td>
                        <td>January 1</td>
                    </tr>

                    <tr>
                        <th scope="row">Beth</th>
                        <td>8</td>
                        <td>March 1</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Birthday Delta</th>
                        <td colspan="2">59 days.</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <?php includeShowcode("table-example1")?>

        <script type="application/json" id="table-example1-props">
        {
            "replaceHTMLRules": {},
            "steps": [
                {
                    "label": "Give table a label using the <strong>caption</strong> element",
                    "highlight": "&lt;caption&gt;[\\s\\S]*&lt;/caption&gt;",
                    "notes": "All tables must have captions."
                },
                {
                    "label": "The <strong>thead</strong> section",
                    "highlight": "\\s*&lt;thead&gt;[\\s\\S]*&lt;/thead&gt;",
                    "notes": "The <strong>thead</strong> tag must contain the heading of the table, including column headings"
                },
                {
                    "label": "The <strong>tbody</strong> section",
                    "highlight": "\\s*&lt;tbody&gt;[\\s\\S]*&lt;/tbody&gt;",
                    "notes": "The <strong>tbody</strong> tag contains the main data of the table, as well as row headings"
                },
                {
                    "label": "The <strong>tfoot</strong> section",
                    "highlight": "\\s*&lt;tfoot&gt;[\\s\\S]*&lt;/tfoot&gt;",
                    "notes": "The <strong>tfoot</strong> contains summary information of the table"
                },
                {
                    "label": "Column headings",
                    "highlight": "scope=\"col\"",
                    "notes": "All column headings must be tagged with <strong>scope=\"col\"</strong>"
                },
                {
                    "label": "Row headings",
                    "highlight": "scope=\"row\"",
                    "notes": "All row headings must be tagged with <strong>scope=\"row\"</strong>"
                }
            ]
        }
        </script>

        <h2>A Simple Table with the caption not placed at the top of the table node</h2>

        <p>Just a simple table.</p>


        <div id="example2">
            <table>


                <caption>A simple HTML table made with the caption not on the top of the markup.</caption>

                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Birthday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Jackie</th>
                        <td>5</td>
                        <td>April 5</td>
                    </tr>

                    <tr>
                        <th scope="row">Beth</th>
                        <td>8</td>
                        <td>January 14</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>A Simple Table with the caption placed inside a <code>figcaption</code> tag</h2>

        <p>Note that the caption is on the bottom, instead of the top of the table.</p>

        <div id="example3">
            <figure>
                <table aria-labelledby="fig-caption">

                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Birthday</th>
                        </tr>
                    </thead>



                    <tbody>
                        <tr>
                            <th scope="row">Jackie</th>
                            <td>5</td>
                            <td>April 5</td>
                        </tr>

                        <tr>
                            <th scope="row">Beth</th>
                            <td>8</td>
                            <td>January 14</td>
                        </tr>
                    </tbody>
                </table>
                <figcaption id="fig-caption" class="caption">A simple HTML table with a figcaption instead of a caption.</figcaption>
            </figure>
        </div>

        <?php includeShowcode("example3")?>

        <script type="application/json" id="example3-props">
        {
            "replaceHTMLRules": {},
            "steps": [
                {
                    "label": "Give table a label using the <strong>caption</strong> element",
                    "highlight": "\\s*&lt;figcaption[\\s\\S]*&lt;/figcaption&gt ||| aria-labelledby=\"fig-caption\"",
                    "notes": "The <strong>figcaption</strong> tag may be used instead of the <strong>caption</strong> if you use <strong>aria-labelledby</strong> on the <strong>table</strong> to point to it."
                }
            ]
        }
        </script>

        <h2>A Simple Table Made Using Aria Roles</h2>

        <p>This is relatively new to aria and may not be implemented by all assistive technologies.</p>

        <div id="table1" role="table" aria-labelledby="table1-caption">
            <div id="table1-caption" class="caption">A simple table made with ARIA Roles.</div>

            <div class="thead" role="rowgroup">
                <div role="row">

                    <!-- These role="columnheader" items are in to make voiceover report the number of columns in the table.-->
                    <span role="columnheader">Name</span>
                    <span role="columnheader">Age</span>
                    <span role="columnheader">Birthday</span>
                </div>
            </div>

            <div class="tbody" role="rowgroup">
                <div role="row">
                    <span role="rowheader">Jackie</span>
                    <span role="cell">5</span>
                    <span role="cell">April 5</span>
                </div>

                <div role="row">
                    <span role="rowheader">Beth</span>
                    <span role="cell">8</span>
                    <span role="cell">January 14</span>
                </div>
            </div>

        </div>

        <h2>A Simple Table Made Using Aria Roles Without rowgroup nodes</h2>

        <p>This is relatively new to aria and may not be implemented by all assistive technologies.</p>

        <div id="table-aria" role="table" aria-labelledby="table-aria-caption">
            <div id="table-aria-caption" class="caption">ARIA table without rowgroup nodes.</div>

            <div class="thead">
                <div role="row">

                    <!-- These role="columnheader" items are in to make voiceover report the number of columns in the table.-->
                    <span role="columnheader">Name</span>
                    <span role="columnheader">Age</span>
                    <span role="columnheader">Birthday</span>
                </div>
            </div>

            <div class="tbody" >
                <div role="row">
                    <span role="rowheader">Jackie</span>
                    <span role="cell">5</span>
                    <span role="cell">April 5</span>
                </div>

                <div role="row">
                    <span role="rowheader">Beth</span>
                    <span role="cell">8</span>
                    <span role="cell">January 14</span>
                </div>
            </div>

        </div>


        <h2>A Complex Table Made Using Aria Roles</h2>



        <div id="table2" role="table" aria-labelledby="table2-caption" >

            <div class="thead" role="rowgroup">
                <div role="row">

                    <span role="row" ></span>
                    <span role="columnheader">ACME Widgets</span>
                    <span role="columnheader">Our Competitor's Widgets</span>
                </div>
            </div>

            <div id="table2-caption" class="caption">ACME Widgets compared to the competition</div>


            <div class="tbody" role="rowgroup">
                <div role="row">
                    <span role="rowheader">Power Usage (in kilowatt hours)</span>
                    <span role="cell">5 kWh</span>
                    <span role="cell">20 kWh</span>
                </div>

                <div role="row">
                    <span role="rowheader">Costs for fuel per hour</span>
                    <div role="cell">
                        <div>
                            $20
                            <div>(Note: this is an estimate given current market value)</div>
                        </div>
                    </div>
                    <span role="cell">$100</span>
                </div>
            </div>

            <div class="tfoot" role="rowgroup">
                <div role="row">
                    <span role="rowheader">Total Savings in one day</span>
                    <span role="cell" aria-colspan="2">$45600</span>
                </div>
            </div>

        </div>

        <h2>A Complex Table Made Using Aria Roles</h2>



        <div id="complex-table" role="table" aria-labelledby="complex-table-caption" >
                <table class="data complex">
                        <caption id="complex-table-caption">
                          Table with colgroup
                        </caption>
                        <thead>
                          <tr>
                            <td rowspan="2">&nbsp;</td>
                            <th colspan="3" scope="colgroup">Females</th>
                            <th colspan="3" scope="colgroup">Males</th>
                          </tr>
                          <tr>
                            <th scope="col">Mary</th>
                            <th scope="col">Betsy</th>
                            <th scope="col">Joanne</th>
                            <th scope="col">Matt</th>
                            <th scope="col">Todd</th>
                            <th scope="col">Jake</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1 mile</th>
                            <td>8:32</td>
                            <td>7:43</td>
                            <td>9:51</td>
                            <td>7:55</td>
                            <td>7:01</td>
                            <td>7:51</td>
                          </tr>
                          <tr>
                            <th scope="row">5 km</th>
                            <td>28:04</td>
                            <td>26:47</td>
                            <td>38:15</td>
                            <td>27:27</td>
                            <td>24:21</td>
                            <td>24:31</td>
                          </tr>
                          <tr>
                            <th scope="row">10 km</th>
                            <td>1:01:16</td>
                            <td>55:38</td>
                            <td>1:56:01</td>
                            <td>57:04</td>
                            <td>50:35</td>
                            <td>50:45</td>
                          </tr>
                        </tbody>
                      </table>
        </div>

        <h2>A Complex Table without using the scope attribute</h2>



        <div id="no-scope-table" role="table" aria-labelledby="no-scope-table-caption" >
        <table class="complexexample">
            <caption id="no-scope-table-caption">New Employee Orientation Schedule</caption>
            <tbody>
                <tr>
                <th rowspan="2" id="date">Date</th>
                <th colspan="2" id="schedule">Schedule</th>
                <th rowspan="2" id="location">Location</th>
                <th rowspan="2" id="topics1">Topics</th>
                </tr>
                <tr>
                <th id="start">Start</th>
                <th id="end">End</th>
                </tr>
                <tr>
                <th id="monday" rowspan="5">Monday, June 1</th>
                <td headers="schedule start monday">9:00 a.m.</td>
                <td headers="schedule end monday">10:30 a.m.</td>
                <td headers="location monday">RH 001</td>
                <td headers="topics1 monday">
                    Introduction to Company: Vision and Mission</td>
                </tr>
                <tr>
                <td headers="schedule start monday">10:30 a.m.</td>
                <td headers="schedule end monday">12:00 p.m.</td>
                <td headers="location monday">RH 001</td>
                <td headers="topics1 monday">HR Policies Review</td>
                </tr>
                <tr>
                <td headers="schedule monday" colspan="4">
                    <strong><em>
                    Lunch from 12:00 p.m. to 1:00 p.m.
                    </em></strong>
                </td>
                </tr>
                <tr>
                <td headers="schedule start monday">1:00 p.m.</td>
                <td headers="schedule end monday">2:30 p.m.</td>
                <td headers="location monday">RH 001</td>
                <td headers="topics1 monday">Overview of Benefits</td>
                </tr>
                <tr>
                <td headers="schedule start monday">3:00 p.m.</td>
                <td headers="schedule end monday">4:30 p.m.</td>
                <td headers="location monday">RH 005</td>
                <td headers="topics1 monday">
                    Health and Safety Procedures
                </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="js/role-checkbox.js"></script>
    <?php include "includes/example-footer.php"?>

    </main>
</body>

</html>