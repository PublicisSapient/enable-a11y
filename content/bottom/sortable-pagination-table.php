<script type="module">
    import sortableTables from './js/modules/sortable-tables.js';
    import paginationTables from "./js/modules/paginate.js";
    import showcode from "./js/libs/showcode.js";

    function normalizeNumber(numString) {
        let multiplier = 1;
        let r = numString.replace(/[$,]/g, '');
        const rSplit = r.split(/ /);
        if (rSplit.length === 2) {
            const suffix = rSplit[1].trim();
            switch(suffix) {
                case "billion":
                    multiplier = 1000000000;
                    break;
                case "trillion":
                    multiplier = 1000000000000;
                    break;
                case 'Mn':
                case 'million':
                    multiplier = 1000000;
                    break;
            }
        }
        r = parseFloat(r) * multiplier;

        if (isNaN(r)) {
            r = 0;
        }

        return r;
    }


    function exampleCustomCompare(a, b) {
        const normalA = normalizeNumber(a + '');
        const normalB = normalizeNumber(b + '');


        return (normalA - normalB);
    }

    sortableTables.addSortFunction('exampleCustomCompare', exampleCustomCompare);

    sortableTables.init({
        onBeforeSort: paginationTables.showAll,
        onAfterSort: paginationTables.renderTable
    });
    
    paginationTables.init();

    showcode.addJsObj('paginationTables', paginationTables);
    showcode.addJsObj('sortableTables', sortableTables);
</script>