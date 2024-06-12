'use strict';

import tabs from '../modules/tabs.js';

const lineChartDemo = function (chartSel, tableSel) {
    const $chart = document.querySelector(chartSel);
    const $table = document.querySelector(tableSel);

    const $rawDataTab = document.querySelector(
        '.enable-tab[href="#bar-chart__heading--raw-data"]',
    );
    const $linkToData = document.querySelector('.bar-chart__link-to-data');

    this.getLabelsAndData = () => {
        const labels = [];
        const series = [];
        const $bodyRows = $table.querySelectorAll('tbody tr');
        const $firstRowData = $bodyRows[0].querySelectorAll('td');

        for (let i = 0; i < $firstRowData.length; i++) {
            series.push([]);
        }

        $bodyRows.forEach(($el, i) => {
            const $rowData = $el.querySelectorAll('td');

            labels.push($el.querySelector('th').innerText);

            for (let i = 0; i < series.length; i++) {
                const index = series[i];
                const rowData = $rowData[i];
                index.push(parseFloat(rowData.innerText));
            }
        });

        return {
            labels: labels,
            series: series,
        };
    };

    const { labels, series } = this.getLabelsAndData();
    const data = {
        labels: labels,
        series: series,
    };

    const options = {
        seriesBarDistance: 15,
    };

    this.addTitle = ($svg, s) => {
        var $title = document.createElementNS(
            'http://www.w3.org/2000/svg',
            'title',
        );
        $title.textContent = s;
        $svg.prepend($title);
    };

    const responsiveOptions = [
        [
            'screen and (min-width: 641px) and (max-width: 1024px)',
            {
                seriesBarDistance: 10,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value;
                    },
                },
            },
        ],
        [
            'screen and (max-width: 640px)',
            {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    },
                },
            },
        ],
    ];

    const linkToDataClickEvent = (e) => {
        e.preventDefault();
        $rawDataTab.click();
    };

    const myBarChart = new Chartist.Bar(
        chartSel,
        data,
        options,
        responsiveOptions,
    );

    $linkToData.addEventListener('click', linkToDataClickEvent);

    myBarChart.on('created', () => {
        const $svg = $chart.querySelector('svg');
        $svg.setAttribute('aria-hidden', 'true');
    });

    $chart.classList.add('bar-chart--initialized');
};

const demo = new lineChartDemo('#bar-chart', '#bar-chart__data');
tabs.init();
