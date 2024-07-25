import * as d3 from 'https://cdn.skypack.dev/d3@7';
import tabs from '../modules/tabs.js';

// Set the dimensions of the canvas / graph
const margin = { top: 30, right: 20, bottom: 30, left: 50 },
    width = 600 - margin.left - margin.right,
    height = 270 - margin.top - margin.bottom;

// Parse the date / time
// Enable changed d3.time.format to d3.timeFormat due to API changes
// details: https://stackoverflow.com/questions/39369789/how-to-solve-typeerror-d3-time-is-undefined
const parseDate = d3.timeParse('%d-%b-%y');

// Set the ranges
// Enable changed d3.time.scale changed to d3.scaleTime and d3.scale.linear changed to d3.scaleLinear
// details: https://stackoverflow.com/questions/39369789/how-to-solve-typeerror-d3-time-is-undefined
const x = d3.scaleTime().range([0, width]);
const y = d3.scaleLinear().range([height, 0]);

// Define the axes
// Enable changed d3.svg.axis().scale(x).orient("bottom")
// to d3.axisBottom(x) and
// d3.svg.axis().scale(y).orient("left") to d3.axisLeft(y) as per
// https://stackoverflow.com/questions/40465283/what-is-d3-svg-axis-in-d3-version-4
const xAxis = d3.axisBottom(x).ticks(5);

const yAxis = d3.axisLeft(y).ticks(5);

// Define the line
// https://github.com/d3/d3/blob/main/CHANGES.md
const valueline = d3
    .line()
    .x(function (d) {
        return x(d.date1);
    })
    .y(function (d) {
        return y(d.close);
    });

// Adds the svg canvas
const svg = d3
    .select('#visual-chart__content')
    .append('svg')
    .attr('width', width + margin.left + margin.right)
    .attr('height', height + margin.top + margin.bottom)
    .append('g')
    .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

// Get the data
d3.csv('../../data/line-chart.csv').then(function (data) {
    data.forEach(function (d) {
        d.date1 = parseDate(d.date); //  <= Change to date1
        d.close = +d.close;
        d.open = +d.open; //  <= added this for tidy house keeping
        d.diff = Math.round((d.close - d.open) * 100) / 100;
    });

    // Scale the range of the data
    x.domain(
        d3.extent(data, function (d) {
            return d.date1;
        }),
    ); //<=date1
    y.domain([
        0,
        d3.max(data, function (d) {
            return d.close;
        }),
    ]);

    // Add the valueline path.
    svg.append('path').attr('class', 'line').attr('d', valueline(data));

    // Add the X Axis
    svg.append('g')
        .attr('class', 'x axis')
        .attr('transform', 'translate(0,' + height + ')')
        .call(xAxis);

    // Add the Y Axis
    svg.append('g').attr('class', 'y axis').call(yAxis);

    // The table generation function
    function tabulate(data, columns) {
        const tableContentID = 'raw-data__content';
        const $figure = document
            .getElementById(tableContentID)
            .closest('figure');
        const $figcaption = $figure.querySelector('figcaption');
        const figcaptionID = $figcaption.getAttribute('id');

        const table = d3
                .select(`#${tableContentID}`)
                .append('table')
                .attr('aria-labelledby', figcaptionID),
            thead = table.append('thead'),
            tbody = table.append('tbody');

        // append the header row
        thead
            .append('tr')
            .selectAll('th')
            .data(columns)
            .enter()
            .append('th')
            .attr('scope', 'col')
            .text(function (column) {
                return column;
            });

        // create a row for each object in the data
        const rows = tbody.selectAll('tr').data(data).enter().append('tr');

        // create a cell in each row for each column
        const cells = rows
            .selectAll('td')
            .data(function (row) {
                return columns.map(function (column) {
                    return { column: column, value: row[column] };
                });
            })
            .enter()
            .append('td')
            .html(function (d) {
                return d.value;
            });

        return table;
    }

    // render the table
    const peopleTable = tabulate(data, ['date', 'close', 'open', 'diff']);

    peopleTable.selectAll('tbody tr').sort(function (a, b) {
        return d3.descending(a.close, b.close);
    });

    peopleTable.selectAll('thead th').text(function (column) {
        return column.charAt(0).toUpperCase() + column.substr(1);
    });
});

tabs.init();
