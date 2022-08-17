/*
* spinbutton.js - A library to enable the UI for the spinbutton ARIA role.
* Based on code by the AJAX Alliance
* 
* Original Code:
* https://web.archive.org/web/20170424171217/http://oaa-accessibility.org/examplep/spinbutton1/
* 
* Refactored by Zoltan Hawryluk (zoltan.dulac@gmail.com)
* to remove jQuery dependency 
* MIT License.
*/

function spinbutton(el) {

  const id = el.id;

  if (!id) {
    console.error('Element has no ID passed. Bailing');
    return;
  }
  const liveID = id + '__live';
  const upID = id + '__up';
  const downID = id + '__down';
  const skipVal = parseInt(el.dataset.increment || '1');

  this.init = () => {
    // define widget attributes
    this.$el = document.getElementById(id);
    this.$live = document.getElementById(liveID);

    this.upID = upID;
    this.$upButton = document.getElementById(upID);
    this.downID = downID;
    this.$downButton = document.getElementById(downID);
    this.skipVal = skipVal;

    this.valMin = parseInt(this.$el.getAttribute("aria-valuemin"));
    this.valMax = parseInt(this.$el.getAttribute("aria-valuemax"));
    this.valNow = parseInt(this.$el.getAttribute("aria-valuenow"));

    this.$el.getAttribute("aria-live", "polite");
    this.$el.getAttribute("contenteditable", "true");

    this.keys = {
      pageup: 33,
      pagedown: 34,
      end: 35,
      home: 36,
      left: 37,
      up: 38,
      right: 39,
      down: 40,
    };

    // bind event handlers
    this.bindHandlers();
  }

  this.setValue = function (valNow, isKeyEvent) {
    this.valNow = valNow;
    // update the control
    console.log('update');
    this.$el.setAttribute("aria-valuenow", this.valNow);
    this.$el.innerHTML = this.valNow;
    this.$live.innerHTML = this.valNow;
    this.selectText();

    if (isKeyEvent) {
      this.$el.focus();
    }

    // Fire event
    const changeEvent = new CustomEvent('enable-spinbutton-change', {
      bubbles: true,
      detail: {
        value: () => valNow
      }
    });
    this.$el.dispatchEvent(changeEvent);
  };

  this.selectText = function () {
    const node = this.$el;

    if (document.body.createTextRange) {
      const range = document.body.createTextRange();
      range.moveToElementText(node);
      range.select();
    } else if (window.getSelection) {
      const selection = window.getSelection();
      const range = document.createRange();
      range.selectNodeContents(node);
      selection.removeAllRanges();
      selection.addRange(range);
    } else {
      console.warn("Could not select text in node: Unsupported browser.");
    }
  };

  // Function bindHandlers() is a member function to bind event handlers for the spinbutton control
  //
  // @return N/A
  //
  this.bindHandlers = function () {
    const thisObj = this;

    //////// bind mouse event handlers to the up button //////////////
    this.$upButton.addEventListener("click", thisObj.handleClick);

    //////// bind mouse event handlers to the down button //////////////
    this.$downButton.addEventListener("click", thisObj.handleClick);

    //////// bind event handlers to the spinbutton //////////////
    this.$el.addEventListener("keydown", thisObj.handleKeyDown);
    this.$el.addEventListener("keypress", thisObj.handleKeyPress);
    this.$el.addEventListener("blur", thisObj.handleBlur);
    this.$el.parentNode.addEventListener("focusout", thisObj.handleBlur);
  }; // end bindHandlers()

  //
  // Function handleClick() is a member function to handle click events for the control
  // buttons
  //
  // @param (e object) e is the event object
  //
  // @param ($button object) $button is the jQuery object of the button clicked
  //
  // @return (boolean) Returns false
  //
  this.handleClick = (e) => {
    const { currentTarget } = e;
    const id = currentTarget.getAttribute("id")

    if (id == this.upID) {
      // if valuemax isn't met, increment valnow
      if (this.valNow < this.valMax) {
        this.setValue(this.valNow + 1);
      }
    } else {
      // if valuemax isn't met, decrement valnow
      if (this.valNow > this.valMin) {
        this.setValue(this.valNow - 1);
      }
    }


    e.stopPropagation();
    return false;
  }; // end handleClick()

  

  this.stopPropagation = function (e) {
    e.stopPropagation();
    e.preventDefault();
  }

  //
  // Function handleKeyDown() is a member function to handle keydown events for the control.
  //
  // @param (e object) e is the event object
  //
  // @return (boolean) Returns false if consuming; true if propagating
  //
  this.handleKeyDown = (e) => {
    if (e.altKey || e.ctrlKey || e.shiftKey) {
      // do nothing
      return true;
    }

    switch (e.keyCode) {
      case this.keys.pageup: {
        if (this.valNow < this.valMax) {
          // if valnow is small enough, increase by the skipVal,
          // otherwise just set to valmax
          if (this.valNow < this.valMax - this.skipVal) {
            this.setValue(this.valNow + this.skipVal, true);
          } else {
            this.setValue(this.valMax, true);
          }
        }

        this.stopPropagation(e);
        return false;
      }
      case this.keys.pagedown: {
        if (this.valNow > this.valMin) {
          // if valNow is big enough, decrease by the skipVal,
          // otherwise just set to valmin
          if (this.valNow > this.valMin + this.skipVal) {
            this.setValue(this.valNow - this.skipVal, true);
          } else {
            this.setValue(this.valMin, true);
          }
        }

        this.stopPropagation(e);
        return false;
      }
      case this.keys.home: {
        if (this.valNow < this.valMax) {
          this.setValue(this.valMax, true);
        }

        this.stopPropagation(e);
        return false;
      }
      case this.keys.end: {
        if (this.valNow > this.valMin) {
          this.setValue(this.valMin, true);
        }

        this.stopPropagation(e);
        return false;
      }
      case this.keys.right:
      case this.keys.up: {
        // if valuemin isn't met, increment valnow
        if (this.valNow < this.valMax) {
          this.setValue(this.valNow + 1, true);
        }

        this.stopPropagation(e);
        return false;
      }
      case this.keys.left:
      case this.keys.down: {
        // if valuemax isn't met, decrement valnow
        if (this.valNow > this.valMin) {
          this.setValue(this.valNow - 1, true);
        }

        this.stopPropagation(e);
        return false;
      }
    }
    return true;
  }; // end handleKeyDown()

  //
  // Function handleKeyPress() is a member function to handle keypress events for the control.
  // This function is required to prevent browser that manipulate the window on keypress (such as Opera)
  // from performing unwanted scrolling.
  //
  // @param (e object) e is the event object
  //
  // @return (boolean) Returns false if consuming; true if propagating
  //
  this.handleKeyPress = (e) => {
    if (e.altKey || e.ctrlKey || e.shiftKey) {
      // do nothing
      return true;
    }

    switch (e.keyCode) {
      case this.keys.pageup:
      case this.keys.pagedown:
      case this.keys.home:
      case this.keys.end:
      case this.keys.left:
      case this.keys.up:
      case this.keys.right:
      case this.keys.down: {
        // consume the event
        this.stopPropagation(e);
        return false;
      }
    }
    return true;
  }; // end handleKeyPress()


  this.init();
}

const spinbuttons = new function () {
  const buttons = [];

  this.add = ($el) => {
    buttons.push(new spinbutton($el));
  }

  this.init = () => {
    const els = document.getElementsByClassName('spinbutton');

    for (let i = 0; i < els.length; i++) {
      this.add(els[i])
    }
  }
  
}



