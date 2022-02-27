<script type="module">
    import sortableTables from './js/modules/sortable-table.js';
    import paginationTables from "./js/modules/paginate.js";
    import showcode from "./js/libs/showcode.js";
    
    paginationTables.init();
    sortableTables.init();

    showcode.addJsObj('paginationTables', paginationTables);
    showcode.addJsObj('sortableTables', sortableTables);
</script>