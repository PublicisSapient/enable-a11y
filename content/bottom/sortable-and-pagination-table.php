<script type="module">
    import paginationTables from "./js/modules/paginate.js";
    import sortableTables from './js/modules/sortable-tables.js';
    import showcode from "./js/enable-libs/showcode.js";
    paginationTables.init();
    sortableTables.init();

    showcode.addJsObj('paginationTables', paginationTables);
    showcode.addJsObj('sortableTables', sortableTables);
</script>