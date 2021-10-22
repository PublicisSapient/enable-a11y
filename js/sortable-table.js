const sortableTables = new (function () {
 /*
  *  sortableTable script.  This has been mofified from the excellent script from Deque University:
  *  https://dequeuniversity.com/library/aria/table-sortable
  */

  function createSortableTable(tableGroup) {
    var table = tableGroup.querySelector("table");
    var headerGroup = table.querySelector("thead");
    var headerRow = headerGroup.querySelector("tr");
    var headers = headerRow.querySelectorAll("th");
    var rowGroup = table.querySelector("tbody");
    var rows = rowGroup.querySelectorAll("tr");
    var captionElement = table.querySelector("caption");
    var captionDetailsElement = captionElement.querySelector('.deque-table-sortable__caption-details')
    var caption = captionElement.innerText;
    
    var hasRowHeadings = (table.querySelector('tbody th') !== null);
    var ariaLiveUpdateTemplate =
      table.getAttribute("data-aria-live-update") ||
      "Table ${caption} is now ${sortedBy}";
    var ascendingLabel =
      table.getAttribute("data-ascending-label") || "ascending";
    var descendingLabel =
      table.getAttribute("data-descending-label") || "descending";

    var liveRegion = tableGroup.querySelector(
      ".deque-table-sortable__live-region"
    );
    var readCaptions = liveRegion.getAttribute("data-read-captions");
    if (readCaptions === null) {
      readCaptions = false;
    }
    liveRegion.notify = function (text) {
      liveRegion.innerHTML = text;
    };

    var sortOrder = null;
    var sortDirection = 1;

    function getSortHeader() {
      if (sortOrder === null) {
        return null;
      }
      return headerRow.children[sortOrder];
    }

    function getSortLabel() {
      var header = getSortHeader();
      if (!header) {
        return null;
      }
      return header.innerText;
    }

    function getSortDirection() {
      return sortDirection > 0 ? "ascending" : "descending";
    }

    function getSortDirectionLabel() {
      return sortDirection > 0 ? ascendingLabel : descendingLabel;
    }

    function getSortInfo() {
      if (sortOrder === null) {
        return "unsorted";
      }

      return "sorted by " + getSortLabel() + ", " + getSortDirectionLabel();
    }

    function renderSorting() {
      updateCaption();
      updateAriaSort();
      updateLiveRegion();
    }

    function updateAriaSort() {
      for (var i = 0; i < headerRow.children.length; i++) {
        var child = headerRow.children[i];
        var button = child.querySelector('.sortableColumnLabel');

        if (sortOrder !== null && i === Math.abs(sortOrder)) {
          var direction = getSortDirection();
          var directionLabel = getSortDirectionLabel();
          child.setAttribute("aria-sort", direction);
          button.setAttribute("aria-label", `${button.innerText}, ${directionLabel}`);
        } else {
          child.removeAttribute("aria-sort");
          button.removeAttribute("aria-label");
        }
      }
    }

    function updateCaption() {
      if (!captionDetailsElement) {
        return;
      }
      var captionDetailsText = getSortInfo();
      captionDetailsElement.innerText = captionDetailsText;
    }

    function updateLiveRegion() {
      if (readCaptions) {
        var captionText = ariaLiveUpdateTemplate
          .replace("${caption}", caption)
          .replace("${sortedBy}", getSortInfo());
        liveRegion.notify(captionText);
      }
    }

    rows = Array.prototype.slice.call(rows);
    var isValid = rows.every(function (row) {
      return row.children.length === headers.length;
    });

    if (!isValid) {
      throw new Error("Each row must be the same length as the headers row.");
    }

    headers = Array.prototype.slice.call(headers);
    [].slice.call(headers).forEach(function (header, i) {
      createHeaderCell(header, function (e) {
        e.preventDefault();
        rows = sortByIndex(rows, i);
        table.renderData(rows);
      });
    });

    table.renderData = function (rows) {
      rowGroup.innerHTML = toHTML(rows, hasRowHeadings);
      renderSorting();
    };

    table.renderData(rows);

    function sortByIndex(rows, index) {
      rows = tableGroup.querySelectorAll("tbody tr");
      rows = [].slice.call(rows);

      if (sortOrder === index) {
        sortDirection = -sortDirection;
        return rows.reverse();
      } else {
        sortDirection = 1;
        sortOrder = index;
        return rows.sort(function (a, b) {
          a = Array.prototype.slice.call(a.children);
          b = Array.prototype.slice.call(b.children);
          var aVal = null;
          var bVal = null;

          if (a[index]) {
            aVal = a[index].innerText;
          }

          if (b[index]) {
            bVal = b[index].innerText;
          }

          if (!isNaN(parseInt(aVal)) && !isNaN(parseInt(bVal))) {
            if (parseInt(aVal) < parseInt(bVal)) {
              return -1;
            }
            if (parseInt(aVal) > parseInt(bVal)) {
              return 1;
            }
            return 0;
          } else {
            if (aVal < bVal) {
              return -1;
            }
            if (aVal > bVal) {
              return 1;
            }
            return 0;
          }
        });
      }
    }

    var firstOne = table.querySelector(".sortableColumnLabel");
    if (firstOne) {
      firstOne.click();
    } // give the table a default sort...
  }

  function createHeaderCell(header, handler) {
    var button = header.querySelector("button");
    button.setAttribute("tabindex", "0");

    button.addEventListener("click", handler);
  }

  function toHTML(rows , hasRowHeadings) {
    return rows
      .map(function (row) {
        row = Array.prototype.slice.call(row.children);
        return (
          '<tr role="row">\n    ' +
          row
            .map(function (item, index) {
              if (index === 0 && hasRowHeadings) {
                return (
                  '<th scope="row" role="rowheader">' + item.innerText + "</th>"
                );
              }
              return '<td role="gridcell">' + item.innerText + "</td>";
            })
            .join("") +
          "</tr>"
        );
      })
      .join("");
  }

  function activateAllSortableTables() {
    var sortableTables = document.querySelectorAll(
      ".deque-table-sortable-group"
    );
    for (var i = 0; i < sortableTables.length; i++) {
      createSortableTable(sortableTables[i]);
    }
  }

  activateAllSortableTables();
})();
