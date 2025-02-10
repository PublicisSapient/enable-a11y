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

const paginationTables = new (function() {
  let perPage = 20;
  const baseClass = "pagination";
  const baseSelector = `.${baseClass}`;
  const tableSelector = `.${baseClass}__table`;
  const $tables = document.querySelectorAll(tableSelector);
  const inactiveClass = `${baseClass}__inactive`;
  const pagerItemSelectedClass = `${baseClass}__pager-item--selected`;
  const pagerSelector = `${baseSelector}__pager`
  const $allPagers = document.querySelectorAll(pagerSelector);
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

  const mobileMq = ($allPagers && $allPagers.length > 0) ? window.getComputedStyle($allPagers[0]).getPropertyValue('--mobile-mq') : null;
  const mobileMql = window.matchMedia(mobileMq);

  const buttonTemplate = $buttonTemplate.innerHTML;

  this.add = ($table) => {
    const $base = $table.closest(baseSelector);
    const $pagers = $base.querySelectorAll(pagerSelector);

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

  this.showAll = (table) => {
    const rows = table.getElementsByClassName(inactiveClass);

    for (let i=0; i<rows.length; i++) {
      rows[i].classList.remove(inactiveClass);
      rows[i].ariaHidden = false;
    }

    table.dataset.currentpage = 0;
  }

  function onBreakpointChange() {
    $tables.forEach((table) => {
      const { currentpage } = table.dataset;
      renderPaginationButtons(table, parseInt(currentpage));
    });
  }

  // based on current page, only show the elements in that range
  this.renderTable = (table) => {
    let startIndex = 0;
    const $container = table.closest(baseSelector);
    const $alert = $container.querySelector(alertSelector);
    const { paginationAlertTemplate, currentpage, pagecount } = table.dataset;

    if (table.querySelector("th")) startIndex = 1;

    let start =
      parseInt(currentpage) * pagecount +
      startIndex;
    let end = start + parseInt(pagecount);
    let rows = table.rows;


    for (let x = startIndex; x < rows.length; x++) {
      if (x < start || x >= end) {
        rows[x].classList.add(inactiveClass);
        rows[x].ariaHidden = true;
      } else {
        rows[x].classList.remove(inactiveClass);
        rows[x].ariaHidden = false;
      }
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
      let parent = target.parentNode;
      let items = parent.querySelectorAll(pagerItemSelector);
      for (let x = 0; x < items.length; x++) {
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

    const $base = table.closest(baseSelector);
    const $pagers = $base.querySelectorAll(pagerSelector);
    let hasHeader = false;
    const { paginationButtonSpread, paginationMobileButtonSpread } = table.dataset;
    const buttonSpreadNum = (mobileMql.matches) ? parseInt(paginationMobileButtonSpread) : parseInt(paginationButtonSpread);
    let begin, end;

    if (table.querySelector("th")) {
      hasHeader = true;
    }

    let rows = table.rows.length;

    if (hasHeader) rows = rows - 1;

    let numPages = Math.floor(rows / perPage);

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

      for (let i = begin; i < end; i++) {
        const pageHTML = interpolate(buttonTemplate, {
          index: i,
          label: i + 1,
          isSelectedClass: i === selectedIndex ? pagerItemSelectedClass : '',
          ariaCurrent: i === selectedIndex ? 'true' : 'false',
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

});