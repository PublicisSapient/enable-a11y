
    

      

        <?php includeStats(array('isForNewBuilds' => true)) ?>
        <?php includeStats(array('isForNewBuilds' => false)) ?>
        <?php includeStats(array('isNPM' => true)) ?>

        <p>Giving users the ability to sort data tables is useful for everyone.  We should ensure they are coded correctly.  In the example below, you will learn about the <code>grid</code> role that you should use for these tables, and how the UI for the sorting routines ensure partially-sighted and blind users know that a sort has been successul.</p>



        <p>
            The script for this table was based on the 
            <a href="https://dequeuniversity.com/library/aria/table-sortable">excellent sortable table example from Deque University</a>.
        </p>    
        <div class="enable-example" id="sortable-table-example">
            <div class="deque-table-sortable-group" id="sortable-table">

                <div id="user-info-table__sort-instructions">
                    Click the table heading buttons to sort the table by the data in its column.
                </div>
                <table                     id="user-info-table"
                    class="deque-table-sortable"
                    role="grid"
                    aria-readonly="true"
                    data-aria-live-update="The table ${caption} is now ${sortedBy}"
                    data-ascending-label="Sorted in ascending order"
                    data-descending-label="Sorted in descending order"
                >
                    <caption>User Information</caption>
                    <thead>
                        <tr>

                            <th scope="col">
                                <button class="sortableColumnLabel" aria-describedby="user-info-table__sort-instructions">
                                    Name
                                </button>
                            </th>
                            <th scope="col">
                                <button class="sortableColumnLabel" aria-describedby="user-info-table__sort-instructions">
                                    Age
                                </button>
                            </th>
                            <th scope="col">
                                <button class="sortableColumnLabel" aria-describedby="user-info-table__sort-instructions">
                                    Favorite Color
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Myk</th>
                            <td role="gridcell">33</td>
                            <td role="gridcell">Purple</td>
                        </tr>
                        <tr>
                            <th scope="row">Hannah</th>
                            <td role="gridcell">28</td>
                            <td role="gridcell">Blue</td>
                        </tr>
                        <tr>
                            <th scope="row">Salim</th>
                            <td role="gridcell">7</td>
                            <td role="gridcell">Green</td>
                        </tr>
                        <tr>
                            <th scope="row">Greg</th>
                            <td role="gridcell">45</td>
                            <td role="gridcell">Orange</td>
                        </tr>
                        <tr>
                            <th scope="row">Caitlin</th>
                            <td role="gridcell">21</td>
                            <td role="gridcell">Red</td>
                        </tr>
                        <tr>
                            <th scope="row">Cyan</th>
                            <td role="gridcell">35</td>
                            <td role="gridcell">Burgundy</td>
                        </tr>
                    </tbody>
                </table>
                <span class="deque-table-sortable__live-region sr-only" aria-live="assertive" data-read-captions="false"></span>
            </div>
        </div>

        <?php includeShowcode("sortable-table-example")?>

        <script type="application/json" id="sortable-table-example-props">
        {
            "replaceHtmlRules": {},
            "steps": [
                {
                    "label": "Ensure the table tag is marked up as a grid",
                    "highlight": "role=\"grid\" ||| role=\"gridcell\"",
                    "notes": "The <code>grid</code> and <code>gridcell</code> roles are necessary for screen readers to know what type of table this is.  <strong>Note that the rest of the table is marked up exactly like the first example on this page.</strong>"
                },
                {
                    "label": "Mark up the table up so it's read only",
                    "highlight": "aria-readonly=\"true\"",
                    "notes": "If this is put in the grid, users may assume that this grid is editable (like a spreadsheet)"
                },
                {
                    "label": "Place a visually hidden aria-live region below the table code",
                    "highlight": "aria-live=\"assertive\"",
                    "notes": "When screen reader users press the buttons that sort the table, we want to make sure that audible feedback is given to them so they know something changes on the screen."
                },
                {
                    "label": "Format the message that will be announced to screen reader users when the table is sorted",
                    "highlight": "data-aria-live-update",
                    "notes": "In this particular implementation of a sortable table, this data attribute contains a template-like string that can be customized by developers the message announced when the sort buttons are pressed.  There is a default message in the script in case developers don't do this, but it may not work as intended if the language of the page is something other that English."
                },
                {
                    "label": "Set the labels for the buttons in the sorted columns",
                    "highlight": "data-ascending-label ||| data-descending-label ||| aria-label=\"Name, Sorted in ascending order\"",
                    "notes": "In this particular implementation of a sortable table, the text in these data attributes will be applied to the column header buttons when they are in a column that is sorted so screen reader users know that column's state.  This is especially useful for screen readers that don't understand <code>aria-sort</code>."
                },
                {
                    "label": "Add sort buttons in column headings",
                    "highlight": "%OPENCLOSECONTENTTAG%button",
                    "notes": ""
                },
                {
                    "label": "Add aria-descibedby to sort buttons",
                    "highlight": "aria-describedby",
                    "notes": "This lets screen reader users know what happens on screen when the press the buttons.  Note that these instructions can be hidden visually so screen reader users only experience it, but I like to keep it in since it's useful to all users."
                },
                {
                    "label": "Add an aria-sort attribute to the table column that is currently sorted",
                    "highlight": "aria-sort",
                    "notes": "This is used by screen reader users to know which column is sorted"
                },
                {
                    "label": "Add CSS",
                    "highlight": "%CSS%deque-table-sortable-css~ .deque-table-sortable-group table thead th .sortableColumnLabel::after; .deque-table-sortable-group table thead th[aria-sort=\"ascending\"] .sortableColumnLabel::after ; .deque-table-sortable-group table thead th[aria-sort=\"descending\"] .sortableColumnLabel::after ||| content:[^;]*; ||| transform: [^;]*;",
                    "notes": "Note that it is okay to insert the visual cues via CSS since the screen reader information is given by the aria-label"
                },
                {
                    "label": "Add JS",
                    "highlight": "%FILE% js/modules/sortable-table.js",
                    "notes": "This is the code that sorts the table.  When the user sorts a table column, it changes the column's header visually and semantically with <code>aria-sort</code> to ensure screen readers know the column is sorted in a specific direction.  It also updates the aria live region with the new sorting information."
                }
            ]
        }
        </script>

        <?= includeNPMInstructions('sortable-tables') ?>