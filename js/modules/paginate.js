'use strict'

/*******************************************************************************
 * enable-paginate.js - Accessible table pagination module
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released Dec 27, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/table.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

import { interpolate, htmlToDomNode } from './interpolate.js'

const paginationTables = new function() {
  var perPage = 20;
  const baseClass = "pagination";
  const baseSelector = `.${baseClass}`;
  const tableSelector = `.${baseClass}__table`;
  const $tables = document.querySelectorAll(tableSelector);
  const inactiveClass = `${baseClass}__inactive`;
  const pagerItemSelectedClass = `${baseClass}__pager-item--selected`;
  const pagerSelector = `${baseSelector}__pager`
  const $pagers = document.querySelectorAll(pagerSelector);
  const pagerItemClass = `${baseClass}__pager-item`;
  const pagerItemSelector = `.${pagerItemClass}`;
  const alertSelector = `.${baseClass}__alert`;
  const $buttonTemplate = document.getElementById(
    `${baseClass}__template--button`
  );
  const $previousButtonTemplate = document.getElementById(
    `${baseClass}__template--previous-button`
  );
  const $nextButtonTemplate = document.getElementById(
    `${baseClass}__template--next-button`
  );
  const previousButtonTemplate = $previousButtonTemplate.innerHTML;
  const nextButtonTemplate = $nextButtonTemplate.innerHTML;

  const previousButtonClass = 'pagination__pager-item--previous';
  const nextButtonClass = 'pagination__pager-item--next';

  const mobileMq = ($pagers && $pagers[0]) ? window.getComputedStyle($pagers[0]).getPropertyValue('--mobile-mq') : null;
  const mobileMql = window.matchMedia(mobileMq);



  const buttonTemplate = $buttonTemplate.innerHTML;

  this.add = ($table) => {
    if ($pagers.length === 0) {
      throw `Cannot apply pagination: missing pager containers with selector ${pagerSelector}`;
    }

    perPage = parseInt($table.dataset.pagecount);
    renderPaginationButtons($table, 0);
    createTableMeta($table);
    this.renderTable($table);
  }

  this.init = () => {
    $tables.forEach(this.add);

    if (mobileMql.addEventListener) {
      mobileMql.addEventListener('change', onBreakpointChange);
    }
  }

  function onBreakpointChange() {
    $tables.forEach((table) => {
      const { currentpage } = table.dataset;
      renderPaginationButtons(table, parseInt(currentpage));
    });
  }

  // based on current page, only show the elements in that range
  this.renderTable = (table) => {
    var startIndex = 0;
    const $container = table.closest(baseSelector);
    const $alert = $container.querySelector(alertSelector);
    const { paginationAlertTemplate, currentpage, pagecount } = table.dataset;

    if (table.querySelector("th")) startIndex = 1;

    var start =
      parseInt(currentpage) * pagecount +
      startIndex;
    var end = start + parseInt(pagecount);
    var rows = table.rows;

    for (var x = startIndex; x < rows.length; x++) {
      if (x < start || x >= end) rows[x].classList.add(inactiveClass);
      else rows[x].classList.remove(inactiveClass);
    }

    $alert.innerHTML = interpolate(paginationAlertTemplate, {
      n: start,
      m: end - 1,
    });

    renderPaginationButtons(table, parseInt(currentpage));
    table.dispatchEvent(
      new CustomEvent('enable-paginate-render',
      {
        bubble: true,
        detail: {
          page: () => currentpage,
          row: () => start
        }
      }
    ));
  }

  function createTableMeta(table) {
    table.dataset.currentpage = "0";
  }

  const pagerItemClickEvent = (e) => {
    const { target } = e;
    const isPrevious = target.classList.contains(previousButtonClass);
    const isNext = target.classList.contains(nextButtonClass);

    if (target.classList.contains(pagerItemClass)) {
      const $container = target.closest(baseSelector);
      const $pager = target.closest(pagerSelector);

      const $table = $container.querySelector(tableSelector);
      const index = target.dataset.index;
      var parent = target.parentNode;
      var items = parent.querySelectorAll(pagerItemSelector);
      for (var x = 0; x < items.length; x++) {
        items[x].classList.remove(pagerItemSelectedClass);
      }
      //target.classList.add(pagerItemSelectedClass);
      $table.dataset.currentpage = target.dataset.index;
      this.renderTable($table);

      if ($pager) {
        let toFocus;

        if (isPrevious) {
          toFocus = $pager.getElementsByClassName(previousButtonClass)[0];
        } else if (isNext) {
          toFocus = $pager.getElementsByClassName(nextButtonClass)[0]
        } else {
          toFocus = $pager.querySelector(`[data-index="${index}"]`);
        }
        toFocus.focus();
      }
    }
  }

  function renderPaginationButtons(table, selectedIndex) {
    var hasHeader = false;
    const { paginationButtonSpread, paginationMobileButtonSpread } = table.dataset;
    const buttonSpreadNum = (mobileMql.matches) ? parseInt(paginationMobileButtonSpread) : parseInt(paginationButtonSpread);
    let begin, end;

    if (table.querySelector("th")) hasHeader = true;

    var rows = table.rows.length;

    if (hasHeader) rows = rows - 1;

    var numPages = Math.floor(rows / perPage);

    if (paginationButtonSpread === 0) {
      begin = 0;
      end = numPages;
    } else {
      begin = selectedIndex - Math.floor(buttonSpreadNum / 2);
      if (begin < 0) {
        begin = 0;
      }

      end = begin + buttonSpreadNum;
      if (end > numPages) {
        end = numPages + 1;
        begin = Math.max(end - buttonSpreadNum, 0);
      }
    }


    $pagers.forEach(($pager) => {
      $pager.innerHTML = '';
      // add an extra page, if we're
      if (numPages % 1 > 0) numPages = Math.floor(numPages) + 1;


      $pager.appendChild(htmlToDomNode(interpolate(
        previousButtonTemplate, {
          disabledattr: (selectedIndex <= 0) ? 'disabled' : '',
          index: selectedIndex - 1
        }
      )));

      for (var i = begin; i < end; i++) {
        const pageHTML = interpolate(buttonTemplate, {
          index: i,
          label: i + 1,
          isSelectedClass: i === selectedIndex ? pagerItemSelectedClass : "",
          totalPages: numPages,
        });
        const page = htmlToDomNode(pageHTML);
        $pager.appendChild(page);
      }

      $pager.appendChild(htmlToDomNode(interpolate(
        nextButtonTemplate, {
          disabledattr: (selectedIndex >= numPages) ? 'disabled' : '',
          index: selectedIndex + 1
        }
      )));
    });

    document.body.addEventListener("click", pagerItemClickEvent);

  }

};


export default paginationTables;