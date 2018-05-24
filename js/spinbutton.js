$(document).ready(function () {
    var spin1 = new spinbutton('sb1', 'sb1_up', 'sb1_down', 10);  
    var spin2 = new spinbutton('sb2', 'sb2_up', 'sb2_down', 50);  
  }); // end ready
  
  //
  // Function spinbutton() is a constructor for an ARIA spinbutton widget. The widget
  // binds to an element with role='spinbutton'.
  //
  // @param (id string) id is the html id of the spinbutton element
  //
  // @param (upID string) upID is the html id of the spinbutton control's increase value button
  //
  // @param (downID string) downID is the html id of the spinbutton control's decrease value button
  //
  // @param (skipVal integer) skipVal is the amount to change the control by for pgUp/pgDown
  // @return N/A
  //
  function spinbutton(id, upID, downID, skipVal) {
  
    // define widget attributes
    this.$id = $('#' + id);
  
    this.upID = upID;
    this.$upButton = $('#' + upID);
    this.downID = downID;
    this.$downButton = $('#' + downID);
    this.skipVal = skipVal;
  
    this.valMin = parseInt(this.$id.attr('aria-valuemin'));
    this.valMax = parseInt(this.$id.attr('aria-valuemax'));
    this.valNow = parseInt(this.$id.attr('aria-valuenow'));

    this.$id.attr('aria-live', 'polite');
  
    this.keys = {
      pageup:   33,
      pagedown: 34,
      end:      35,
      home:     36,
      left:     37,
      up:       38,
      right:    39,
      down:     40
    };
      
    // bind event handlers
    this.bindHandlers();
  }
  
  // Function bindHandlers() is a member function to bind event handlers for the spinbutton control
  //
  // @return N/A
  //
  spinbutton.prototype.bindHandlers = function() {
  
    var thisObj = this;
  
    //////// bind mouse event handlers to the up button //////////////
    this.$upButton.mousedown(function(e) {
      return thisObj.handleMouseDown(e, $(this));
    });
  
    this.$upButton.mouseup(function(e) {
      return thisObj.handleMouseUp(e, $(this));
    });
  
    this.$upButton.mouseenter(function(e) {
      return thisObj.handleMouseEnter(e, $(this));
    });
  
    this.$upButton.mouseout(function(e) {
      return thisObj.handleMouseOut(e, $(this));
    });
  
    this.$upButton.click(function(e) {
      return thisObj.handleClick(e, $(this));
    });
  
    //////// bind mouse event handlers to the down button //////////////
    this.$downButton.mousedown(function(e) {
      return thisObj.handleMouseDown(e, $(this));
    });
  
    this.$downButton.mouseup(function(e) {
      return thisObj.handleMouseUp(e, $(this));
    });
  
    this.$downButton.mouseenter(function(e) {
      return thisObj.handleMouseEnter(e, $(this));
    });
  
    this.$downButton.mouseout(function(e) {
      return thisObj.handleMouseOut(e, $(this));
    });
  
    this.$downButton.focus(function(e) {
      return thisObj.handleFocus(e, $(this));
    });
  
    this.$downButton.click(function(e) {
      return thisObj.handleClick(e, $(this));
    });
  
    //////// bind event handlers to the spinbutton //////////////
    this.$id.keydown(function(e) {
      return thisObj.handleKeyDown(e);
    });
  
    this.$id.keypress(function(e) {
      return thisObj.handleKeyPress(e);
    });
  
    this.$id.focus(function(e) {
      return thisObj.handleFocus(e);
    });
  
    this.$id.blur(function(e) {
      return thisObj.handleBlur(e);
    });
  
    this.$id.parent().focusout(function(e) {
      return thisObj.handleBlur(e);
    });
  
  } // end bindHandlers()
  
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
  spinbutton.prototype.handleClick = function(e, $button) {
  
  
    if ($button.attr('id') == this.upID) {
  
      // if valuemax isn't met, increment valnow
      if (this.valNow < this.valMax) {
        this.valNow++;
  
        this.$id.text(this.valNow);
        this.$id.attr('aria-valuenow', this.valNow);
      }
    }
    else {
  
      // if valuemax isn't met, decrement valnow
      if (this.valNow > this.valMin) {
        this.valNow--;
  
        this.$id.text(this.valNow);
        this.$id.attr('aria-valuenow', this.valNow);
      }
    }
  
    // set focus on the spinbutton
    this.$id.focus();
      
    e.stopPropagation();
    return false;
  
  } // end handleClick()
  
  //
  // Function handleMouseDown() is a member function to handle mousedown events for the control
  // buttons
  //
  // @param (e object) e is the event object
  //
  // @param ($button object) $button is the jQuery object of the button clicked
  //
  // @return (boolean) Returns false
  //
  spinbutton.prototype.handleMouseDown = function(e, $button) {
  
    var $img = $button.find('img');
  
    if ($button.attr('id') == this.upID) {
      $img.attr('src', "http://www.oaa-accessibility.org/media/examples/images/button-arrow-up-pressed-hl.png");
    }
    else {
      $img.attr('src', "http://www.oaa-accessibility.org/media/examples/images/button-arrow-down-pressed-hl.png");
    }
  
    e.stopPropagation();
    return false;
  
  } // end handleMouseDown()
  
  //
  // Function handleMouseUp() is a member function to handle mouseup events for the control
  // buttons
  //
  // @param (e object) e is the event object
  //
  // @param ($button object) $button is the jQuery object of the button clicked
  //
  // @return (boolean) Returns false
  //
  spinbutton.prototype.handleMouseUp = function(e, $button) {
  
    var $img = $button.find('img');
  
    if ($button.attr('id') == this.upID) {
      $img.attr('src', "http://www.oaa-accessibility.org/media/examples/images/button-arrow-up-hl.png");
    }
    else {
      $img.attr('src', "http://www.oaa-accessibility.org/media/examples/images/button-arrow-down-hl.png");
    }
  
    e.stopPropagation();
    return false;
  
  } // end handleMouseUp()
  
  //
  // Function handleMouseEnter() is a member function to handle mouseenter events for the control
  // buttons
  //
  // @param (e object) e is the event object
  //
  // @param ($button object) $button is the jQuery object of the button
  //
  // @return (boolean) Returns false
  //
  spinbutton.prototype.handleMouseEnter = function(e, $button) {
  
    var $img = $button.find('img');
  
    if ($button.attr('id') == this.upID) {
      $img.attr('src', "http://www.oaa-accessibility.org/media/examples/images/button-arrow-up-hl.png");
    }
    else {
      $img.attr('src', "http://www.oaa-accessibility.org/media/examples/images/button-arrow-down-hl.png");
    }
  
    e.stopPropagation();
    return false;
  
  } // end handleMouseOutEnter()
  
  //
  // Function handleMouseOut() is a member function to handle mouseout events for the control
  // buttons
  //
  // @param (e object) e is the event object
  //
  // @param ($button object) $button is the jQuery object of the button
  //
  // @return (boolean) Returns false
  //
  spinbutton.prototype.handleMouseOut = function(e, $button) {
  
    var $img = $button.find('img');
  
    if ($button.attr('id') == this.upID) {
      $img.attr('src', "http://www.oaa-accessibility.org/media/examples/images/button-arrow-up.png");
    }
    else {
      $img.attr('src', "http://www.oaa-accessibility.org/media/examples/images/button-arrow-down.png");
    }
  
    e.stopPropagation();
    return false;
  
  } // end handleMouseOutUp()
  
  //
  // Function handleKeyDown() is a member function to handle keydown events for the control.
  //
  // @param (e object) e is the event object
  //
  // @return (boolean) Returns false if consuming; true if propagating
  //
  spinbutton.prototype.handleKeyDown = function(e) {
  
    if (e.altKey || e.ctrlKey || e.shiftKey) {
      // do nothing
      return true;
    }
  
    switch(e.keyCode) {
      case this.keys.pageup: {
  
        if (this.valNow < this.valMax) {
  
          // if valnow is small enough, increase by the skipVal,
          // otherwise just set to valmax
          if (this.valNow < this.valMax - this.skipVal) {
            this.valNow += this.skipVal;
          }  
          else {
            this.valNow = this.valMax;
          }
  
          // update the control
          this.$id.attr('aria-valuenow', this.valNow);
          this.$id.html(this.valNow);
        }
  
        e.stopPropagation();
        return false;
      }
      case this.keys.pagedown: {
  
        if (this.valNow > this.valMin) {
  
          // if valNow is big enough, decrease by the skipVal,
          // otherwise just set to valmin
          if (this.valNow > this.valMin + this.skipVal) {
            this.valNow -= this.skipVal;
          }  
          else {
            this.valNow = this.valMin;
          }
  
          // update the control
          this.$id.attr('aria-valuenow', this.valNow);
          this.$id.html(this.valNow);
        }
  
        e.stopPropagation();
        return false;
      }
      case this.keys.home: {
  
        if (this.valNow < this.valMax) {
          this.valNow = this.valMax;
          this.$id.attr('aria-valuenow', this.valNow);
          this.$id.html(this.valNow);
        }
  
        e.stopPropagation();
        return false;
      }
      case this.keys.end: {
  
        if (this.valNow > this.valMin) {
          this.valNow = this.valMin;
          this.$id.attr('aria-valuenow', this.valNow);
          this.$id.html(this.valNow);
        }
  
        e.stopPropagation();
        return false;
      }
      case this.keys.right:
      case this.keys.up: {
  
        // if valuemin isn't met, increment valnow
        if (this.valNow < this.valMax) {
          this.valNow++;
  
          this.$id.text(this.valNow);
          this.$id.attr('aria-valuenow', this.valNow);
        }
  
        e.stopPropagation();
        return false;
      }
      case this.keys.left:
      case this.keys.down: {
  
        // if valuemax isn't met, decrement valnow
        if (this.valNow > this.valMin) {
          this.valNow--;
  
          this.$id.text(this.valNow);
          this.$id.attr('aria-valuenow', this.valNow);
        }
  
        e.stopPropagation();
        return false;
      }
    }
    return true;
  
  } // end handleKeyDown()
  
  //
  // Function handleKeyPress() is a member function to handle keypress events for the control.
  // This function is required to prevent browser that manipulate the window on keypress (such as Opera)
  // from performing unwanted scrolling.
  //
  // @param (e object) e is the event object
  //
  // @return (boolean) Returns false if consuming; true if propagating
  //
  spinbutton.prototype.handleKeyPress = function(e) {
  
  
    if (e.altKey || e.ctrlKey || e.shiftKey) {
      // do nothing
      return true;
    }
  
    switch(e.keyCode) {
      case this.keys.pageup:
      case this.keys.pagedown:
      case this.keys.home:
      case this.keys.end:
      case this.keys.left:
      case this.keys.up:
      case this.keys.right:
      case this.keys.down: {
        // consume the event
        e.stopPropagation();
        return false;
      }
    }
    return true;
  
  } // end handleKeyPress()
  
  //
  // Function handleFocus() is a member function to handle focus events for the control.
  //
  // @param (e object) e is the event object
  //
  // @return (boolean) Returns true
  //
  spinbutton.prototype.handleFocus = function(e) {
  
    // add the focus styling class to the control
    this.$id.addClass('focus');
  
    return true;
  
  } // end handleFocus()
  
  //
  // Function handleBlur() is a member function to handle blur events for the control.
  //
  // @param (e object) e is the event object
  //
  // @return (boolean) Returns true
  //
  spinbutton.prototype.handleBlur = function(e) {
  
    // Remove the focus styling class from the control
    this.$id.removeClass('focus');
  
    return true;
  
  } // end handleBlur()