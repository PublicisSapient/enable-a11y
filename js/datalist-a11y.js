const datalistA11y = new function () {
  this.onPageLoad = () => {
    //const lists = document.querySelectorAll('input[list]');

    document.body.addEventListener('input', this.onInputListChange, true);
    //document.body.addEventListener('input', this.onChange, true);
  }

  this.onInputListChange = (e) => {
    const { target } = e;
    const { list, value } = target;

    if (list) {
      const { offsetTop, offsetLeft, offsetHeight } = target;
      
      const { options } = list;
      const filteredOptions = [];

      for (let i = 0; i < options.length; i++) {
        const { innerText } = options[i];
        if (innerText.toLowerCase().indexOf(value) >= 0) {
          filteredOptions.push(innerText)
        }
      }

      var result = deepDiffMapper.map(JSON.stringify(options[0]), JSON.stringify(options[1]));
      console.log('result', options[0]);

      this.announce(list, `${filteredOptions.length} items`);
    }
  }

  this.onChange = (e) => {
    const { target } = e;
    const { list } = target;

    console.log('change');

    if (list) {
      this.announce(list, '');
    }
  }

  this.announce = function (list, string) {
    const liveRegionId = `${list.id}-status`;
    let liveRegionEl = document.getElementById(liveRegionId);

    if (!liveRegionEl) {
      liveRegionEl = document.createElement('div');
      liveRegionEl.role = 'status';
      liveRegionEl.className = 'visually-hidden';
      liveRegionEl.id = liveRegionId;
      list.parentNode.appendChild(liveRegionEl);
    }

    liveRegionEl.innerHTML = string;
  }
}

var deepDiffMapper = function () {
  return {
    VALUE_CREATED: 'created',
    VALUE_UPDATED: 'updated',
    VALUE_DELETED: 'deleted',
    VALUE_UNCHANGED: 'unchanged',
    map: function(obj1, obj2) {
      if (this.isFunction(obj1) || this.isFunction(obj2)) {
        throw 'Invalid argument. Function given, object expected.';
      }
      if (this.isValue(obj1) || this.isValue(obj2)) {
        return {
          type: this.compareValues(obj1, obj2),
          data: obj1 === undefined ? obj2 : obj1
        };
      }

      var diff = {};
      for (var key in obj1) {
        if (this.isFunction(obj1[key])) {
          continue;
        }

        var value2 = undefined;
        if (obj2[key] !== undefined) {
          value2 = obj2[key];
        }

        diff[key] = this.map(obj1[key], value2);
      }
      for (var key in obj2) {
        if (this.isFunction(obj2[key]) || diff[key] !== undefined) {
          continue;
        }

        diff[key] = this.map(undefined, obj2[key]);
      }

      return diff;

    },
    compareValues: function (value1, value2) {
      if (value1 === value2) {
        return this.VALUE_UNCHANGED;
      }
      if (this.isDate(value1) && this.isDate(value2) && value1.getTime() === value2.getTime()) {
        return this.VALUE_UNCHANGED;
      }
      if (value1 === undefined) {
        return this.VALUE_CREATED;
      }
      if (value2 === undefined) {
        return this.VALUE_DELETED;
      }
      return this.VALUE_UPDATED;
    },
    isFunction: function (x) {
      return Object.prototype.toString.call(x) === '[object Function]';
    },
    isArray: function (x) {
      return Object.prototype.toString.call(x) === '[object Array]';
    },
    isDate: function (x) {
      return Object.prototype.toString.call(x) === '[object Date]';
    },
    isObject: function (x) {
      return Object.prototype.toString.call(x) === '[object Object]';
    },
    isValue: function (x) {
      return !this.isObject(x) && !this.isArray(x);
    }
  }
}();

datalistA11y.onPageLoad();

