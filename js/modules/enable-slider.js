'use strict';

/*******************************************************************************
 * enable-slider.js - Implementation of the ARIA slider role UI.
 *
 * Based on code by the Open Ajax Alliance
 * Original code available at:
 * https://web.archive.org/web/20170715191225/http://oaa-accessibility.org/example/32/
 *
 * Refactored by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 written May 17, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/slider.php
 *
 * Released under the MIT License.
 ******************************************************************************/

import { interpolate, htmlToDomNode } from '../modules/interpolate.js';

/**
 * keyCodes() is an object to contain key code values for the application
 */
const keyCodes = function () {
    // Define values for keycodes
    this.backspace = 8;
    this.tab = 9;
    this.enter = 13;
    this.esc = 27;

    this.space = 32;
    this.pageup = 33;
    this.pagedown = 34;
    this.end = 35;
    this.home = 36;

    this.left = 37;
    this.up = 38;
    this.right = 39;
    this.down = 40;
}; // end keyCodes

/**
 *
 * slider() is a class to define an ARIA-enabled slider widget. The class
 * will create needed handles and define ARIA attributes for the slider
 *
 * @param {string} container_id - the containing div for the slider
 * @param {boolean} vert - true if the slider is vertical; false if horizontal
 * @param {integer} inc -  the increment value for the slider
 * @param {integer} jump - the large increment value for the slider (pgUp/pgDown keys)
 * @param {boolean} showVals - true if the slider should display the value of the handles
 * @param {boolean} range - true if the slider is a range slider
 * @param {integer} val1 -  val1 specifies the initial value of the slider or of the first
 *         slide handle if this is a range enableSlider. Must be >= min.
 * @param {integer} val2 -  val2 specifies the initial value of the second slide handle.
 *         Ignored if range is false (i.e. not a range slider). Must be <= max.
 */
const enableSlider = function (
    container_id,
    vert,
    min,
    max,
    inc,
    jump,
    showVals,
    range,
    val1,
    val2,
) {
    this.init = function () {
        // define slider object properties
        this.keys = new keyCodes();

        this.id = container_id;
        this.$template = document.getElementById(
            'enable-slider__handle--template',
        );
        this.template = this.$template.innerHTML;
        this.className = 'enable-slider';
        this.$container = document.getElementById(container_id);
        this.vert = vert;
        this.range = range;
        this.showVals = showVals;

        // Store the size of the slider
        this.width = this.$container.offsetWidth;
        this.height = this.$container.offsetHeight;

        // Store the page position of the slider
        this.offset = this.$container.getBoundingClientRect();
        this.left = Math.round(this.offset.left);
        this.top = Math.round(this.offset.top);

        // Store the minimum and maximum and initial values
        this.min = min;
        this.max = max;
        this.inc = inc;
        this.jump = jump;
        this.val1 = val1;
        this.domParser = new DOMParser();

        // If range is true, store the second value
        if (range) {
            this.val2 = val2;
        }

        /////////////// Create handles /////////////////

        this.$handle1 = undefined;
        this.$handle2 = undefined;

        if (!range) {
            // Create the handle
            this.$handle1 = this.createHandle(val1);
        } else {
            // create the range highlight div
            this.createRangeDiv();

            // Create the first handle
            this.$handle1 = this.createHandle(val1, 1);

            // create the second handle
            this.$handle2 = this.createHandle(val2, 2);
        }
    };

    /**
     * createHandle() creates a handle for the enableSlider. It defines ARIA attributes for
     * the handle and positions it at the specified value in the slider range. if showVals is true,
     * create and position divs to display the handle value.
     *
     * @param {integer} val - the initial value of the handle
     * @param {integer} num - the handle number. (optional)
     * @returns { object } - the object pointer of the newly created handle
     */
    this.createHandle = function (val, num) {
        const index = num === undefined ? '' : num;
        const id = this.id + '_handle' + index;
        const ariaLabel = this.id + '_label' + index;
        const ariaDesc = this.id + '_desc' + index;

        // slider HTML. If it doesn't exist in the DOM, we create it for you.
        const handle = interpolate(this.template, {
            id: id,
            classNameRoot: this.className,
            arialabelledby: ariaLabel,
            ariadescribedby: ariaDesc,
            valuemin: this.min,
            valuemax: this.max,
            valuenow: val === undefined ? this.min : val,
        });

        this.$container.appendChild(htmlToDomNode(handle));
        const $handle = document.getElementById(id);
        const $handleButton = $handle.querySelector(
            '.enable-slider__handle-button',
        );

        const $incrementor = $handle.querySelector(
            '.enable-slider__increase .enable-slider__button-label',
        );
        const $decrementor = $handle.querySelector(
            '.enable-slider__decrease .enable-slider__button-label',
        );

        // position handle
        this.positionHandle($handle, $handleButton, val);

        // bind handlers
        this.bindHandlers($handle, $decrementor, $incrementor);

        return $handle;
    }; // end createHandle()

    /**
     * createRangeDiv() creates a div for the highlight of a range enableSlider.
     * It sets the initial top or left position to match that of the slider container.
     */
    this.createRangeDiv = function () {
        const id = this.id + '_range';

        const range =
            '<div id="' +
            id +
            '" class="' +
            this.className +
            '__slider-range"></div>';

        // Store the div object
        this.$rangeDiv = htmlToDomNode(range);

        // Create the range div
        this.$container.appendChild(this.$rangeDiv);

        const rangeStyle = this.$rangeDiv.style;

        const containerStyle = getComputedStyle(this.$container, null);

        if (!this.vert) {
            // horizontal slider
            rangeStyle.top = 0;
            rangeStyle.height = containerStyle.height;
        } else {
            // vertical slider
            rangeStyle.left = 0;
            rangeStyle.width = containerStyle.width;
        }
    }; // end createRangeDiv()

    /**
     * positionHandle() is a member function to position a handle
     * at the specified value for the enableSlider. If showVal is true,
     * it also positions and updates the displayed value container.
     *
     * @param { HTMLElement } $handle - DOM node of the handle container to be manipulated
     * @param { HTMLElement } $handleButton - DOM node of the handle button.
     * @param {integer} val - the new value of the slider
     */
    this.positionHandle = ($handle, $handleButton, val) => {
        const handleHeight = $handle.offsetHeight; // the total height of the handle
        const handleWidth = $handle.offsetWidth; // the total width of the handle
        let xPos; // calculated horizontal position of the handle;
        let yPos; // calculated vertical position of the handle;
        let valPos; //calculated new pixel position for the value;
        const { offsetWidth, offsetHeight } = this.$container;
        let didChange;

        if (!this.vert) {
            // horizontal slider

            // calculate the horizontal pixel position of the specified value
            valPos = ((val - this.min) / (this.max - this.min)) * offsetWidth;

            xPos = Math.round(valPos - handleWidth / 2);
            yPos = Math.round(offsetHeight / 2 - handleHeight / 2);
        } else {
            // vertical slider

            // calculate the vertical pixel position of the specified value
            valPos = ((val - this.min) / (this.max - this.min)) * offsetHeight;

            xPos = Math.round(offsetWidth / 2 - handleWidth / 2);
            yPos = Math.round(valPos - handleHeight / 2);
        }

        // Set the position of the handle
        $handle.style.top = yPos + 'px';
        $handle.style.left = xPos + 'px';

        // Set the aria-valuenow position of the handle
        $handleButton.setAttribute('aria-valuenow', val);

        // Update the stored handle values
        if (/1$/.test($handle.getAttribute('id'))) {
            // first handle
            didChange = this.val1 !== val;

            if (didChange) {
                this.val1 = val;
            }
        } else {
            // second handle
            didChange = this.val2 !== val;

            if (didChange) {
                this.val2 = val;
            }
        }

        // if range is true, set the position of the range div
        if (this.range) {
            this.positionRangeDiv();
        }

        // if showVal is true, update the value container
        if (this.showVals) {
            this.updateValBox($handle, $handleButton, Math.round(valPos));
        }

        if (didChange) {
            $handle.dispatchEvent(
                new CustomEvent('enable-slider-change', {
                    bubbles: true,
                    detail: {
                        value: () =>
                            $handleButton.getAttribute('aria-valuenow'),
                    },
                }),
            );
        }
    }; // end positionHandle()

    /**
     * positionRangeDiv() is a member function to reposition the range div
     * when a handle is moved/
     */
    this.positionRangeDiv = () => {
        let pos; //calculated new range start position;
        let size; //calculated new range size;
        const { offsetWidth, offsetHeight } = this.$container;

        if (!this.vert) {
            // Horizontal slider

            // calculate the range start position
            pos = Math.round(
                ((this.val1 - this.min) / (this.max - this.min)) * offsetWidth,
            );

            // calculate the new range width
            size =
                Math.round(
                    ((this.val2 - this.min) / (this.max - this.min)) *
                        offsetWidth,
                ) - pos;

            // set the new range position
            this.$rangeDiv.style.left = pos + 'px';

            // set the new range width
            this.$rangeDiv.style.width = size + 'px';
        } else {
            // calculate the range start position
            pos = Math.round(
                ((this.val1 - this.min) / (this.max - this.min)) * offsetHeight,
            );

            // calculate the new range width
            size =
                Math.round(
                    ((this.val2 - this.min) / (this.max - this.min)) *
                        offsetHeight,
                ) - pos;

            // set the new range position
            this.$rangeDiv.style.top = pos + 'px';

            // set the new range width
            this.$rangeDiv.style.height = size + 'px';
        }
    }; // end positionRangeDiv()

    /**
     * updateValBox() is a member function to reposition a handle value box
     * and update its contents
     *
     * @param { HTMLElement } $handle - DOM node of the handle container to be manipulated
     * @param { HTMLElement } $handleButton - DOM node of the handle button.
     * @param {integer} valPos - the pixel position of the slider value
     */
    this.updateValBox = function ($handle, $handleButton, valPos) {
        const $valBox = document.getElementById(
            $handle.getAttribute('id') + '_val',
        );

        let xPos; // horizontal pixel position of the box
        let yPos; // vertical pixel position of the box

        // Set the position of the handle
        if (!this.vert) {
            const boxWidth = $valBox.offsetWidth;

            yPos = $handle.style.top;

            // Adjust the horizontal position to center the value box on the value position
            xPos = Math.round(valPos - boxWidth / 2) + 'px';
        } else {
            const boxHeight = $valBox.offsetHeight;

            xPos = $handle.style.left;

            // Adjust the vertical position to center the value box on the value position
            yPos = Math.round(valPos - boxHeight / 2) + 'px';
        }

        // Set the position of the value box
        $valBox.style.top = yPos;
        $valBox.style.left = xPos;

        // Set the text in the box to the handle value
        $valBox.innerHTML = $handleButton.getAttribute('aria-valuenow');
    }; // end updateValBox()

    /**
     * bindHandlers() is a member function to bind event handlers to a slider handle
     *
     * @param {object} $handle - the object pointer of the handle to bind handlers to
     */
    this.bindHandlers = ($handle, $decrementor, $incrementor) => {
        $decrementor.addEventListener('click', (e) => {
            return this.handleDecrementorClick($handle, e);
        });

        $incrementor.addEventListener('click', (e) => {
            return this.handleIncrementorClick($handle, e);
        });

        $handle.addEventListener('keydown', (e) => {
            return this.handleKeyDown($handle, e);
        });

        $handle.addEventListener('keypress', (e) => {
            return this.handleKeyPress($handle, e);
        });

        $handle.addEventListener('focus', (e) => {
            return this.handleFocus($handle, e);
        });

        $handle.addEventListener('blur', (e) => {
            return this.handleBlur($handle, e);
        });

        $handle.addEventListener('pointerdown', (e) => {
            return this.handlePointerDown(
                $handle,
                $incrementor,
                $decrementor,
                e,
            );
        });

        // Use passive: true for touchstart event listeners
        $handle.addEventListener(
            'touchstart',
            (e) => {
                return this.handlePointerDown(
                    $handle,
                    $incrementor,
                    $decrementor,
                    e,
                );
            },
            { passive: true },
        );

        window.addEventListener('resize', this.handleResize);

        window.addEventListener('orientationchange', this.handleResize);
    }; // end bindHandlers()

    /**
     * handleKeyDown() is a member function to process keydown events for a slider handle
     *
     * @param { HTMLElement } $handle - DOM node of the handle container to be manipulated
     * @param {object} evt - the event object associated witthe the event
     *
     * @returns { boolean } true if propagating; false if consuming event
     */
    this.handleKeyDown = function ($handle, evt) {
        const $handleButton = $handle.querySelector(
            '.enable-slider__handle-button',
        );
        if (evt.ctrlKey || evt.shiftKey || evt.altKey) {
            // Do nothing
            return true;
        }

        switch (evt.keyCode) {
            case this.keys.home: {
                // move the handle to the slider minimum
                if (!this.range) {
                    this.positionHandle($handle, $handleButton, this.min);
                } else {
                    if (/1$/.test($handle.getAttribute('id'))) {
                        // handle 1 - move to the min value
                        this.positionHandle($handle, $handleButton, this.min);
                    } else {
                        // handle 2 - move to the position of handle 1
                        this.positionHandle($handle, $handleButton, this.val1);
                    }
                }
                evt.stopPropagation;
                evt.preventDefault();
                return false;
            }
            case this.keys.end: {
                if (!this.range) {
                    // move the handle to the slider maximum
                    this.positionHandle($handle, $handleButton, this.max);
                } else {
                    if (/1$/.test($handle.getAttribute('id'))) {
                        // handle 1 - move to the position of handle 2
                        this.positionHandle($handle, $handleButton, this.val2);
                    } else {
                        // handle 2 - move to the max value
                        this.positionHandle($handle, $handleButton, this.max);
                    }
                }
                evt.stopPropagation;
                evt.preventDefault();
                return false;
            }
            case this.keys.pageup: {
                // Decrease by jump value

                const newVal =
                    $handleButton.getAttribute('aria-valuenow') - this.jump;
                let stopVal = this.min; // where to stop moving

                if (this.range) {
                    // if this is handle 2, stop when we reach the value
                    // for handle 1
                    if (/2$/.test($handle.getAttribute('id'))) {
                        stopVal = this.val1;
                    }
                }

                // move the handle one jump increment toward the slider minimum
                // If value is less than stopVal, set at stopVal instead
                this.positionHandle(
                    $handle,
                    $handleButton,
                    newVal > stopVal ? newVal : stopVal,
                );

                evt.stopPropagation;
                evt.preventDefault();
                return false;
            }
            case this.keys.pagedown: {
                // Increase by jump value

                const newVal =
                    parseInt($handleButton.getAttribute('aria-valuenow')) +
                    this.jump;
                let stopVal = this.max; // where to stop moving

                if (this.range) {
                    // if this is handle 1, stop when we reach the value
                    // for handle 2
                    if (/1$/.test($handle.getAttribute('id'))) {
                        stopVal = this.val2;
                    }
                }

                // move the handle one jump increment toward the slider maximum
                // If value is greater than maximum, set at maximum instead
                this.positionHandle(
                    $handle,
                    $handleButton,
                    newVal < stopVal ? newVal : stopVal,
                );

                evt.stopPropagation;
                evt.preventDefault();
                return false;
            }
            case this.keys.left:
            case this.keys.up: {
                // decrement

                this.handleDecrementorClick($handle, evt);
                return false;
            }
            case this.keys.right:
            case this.keys.down: {
                // increment

                this.handleIncrementorClick($handle, evt);
                return false;
            }
        } // end switch

        return true;
    }; // end handleKeyDown

    /**
     * handleKeyPress() is a member function to process keypress events for a slider handle. Needed for
     * browsers that perform window scrolling on keypress rather than keydown events.
     *
     * @param {object} $handle - the object associated with the event
     * @param {object} evt - the event object associated witthe the event
     * @returns { boolean } true if propagating; false if consuming event
     */
    this.handleKeyPress = function ($handle, evt) {
        if (evt.ctrlKey || evt.shiftKey || evt.altKey) {
            // Do nothing
            return true;
        }

        switch (evt.keyCode) {
            case this.keys.home:
            case this.keys.pageup:
            case this.keys.end:
            case this.keys.pagedown:
            case this.keys.left:
            case this.keys.up:
            case this.keys.right:
            case this.keys.down: {
                // Consume the event
                evt.stopPropagation;
                return false;
            }
        } // end switch

        return true;
    }; // end handleKeyDown

    /**
     * handleFocus() is a member function to process focus events for a slider handle
     *
     * @param {object} $handle - the object associated with the event
     * @param {object} evt - the event object associated with the the event
     * @returns { boolean } true if propagating; false if consuming event
     */
    this.handleFocus = function ($handle) {
        $handle.setAttribute(
            'src',
            'js/modules/images/slider_' +
                (this.vert ? 'v' : 'h') +
                '-focus.png',
        );
        $handle.classList.add('focus');
        $handle.style.zIndex = '20';

        return true;
    }; // end handleFocus()

    /**
     * handleBlur() is a member function to process blur events for a slider handle
     *
     * @param {object} $handle - the object associated with the event
     * @param {object} evt - the event object associated witthe the event
     * @returns { boolean } true if propagating; false if consuming event
     */
    this.handleBlur = function ($handle) {
        $handle.setAttribute(
            'src',
            'js/modules/images/slider_' + (this.vert ? 'v' : 'h') + '.png',
        );
        $handle.classList.remove('focus');
        $handle.style.zIndex = '10';

        return true;
    }; // end handleBlur()

    /**
     * handlePointerDown() is a member function to process pointerdown events
     * for a slider handle. The function binds a pointermove handler
     *
     * @param {object} $handle - the object associated with the event
     * @param {object} evt - the event object associated witthe the event
     * @returns { boolean } true if propagating; false if consuming event
     */
    this.handlePointerDown = function (
        $handle,
        $incrementor,
        $decrementor,
        evt,
    ) {
        if (
            evt.target &&
            (evt.target === $decrementor || evt.target === $incrementor)
        ) {
            return;
        }
        document.body.classList.add(`${this.className}--cannot-select-text`);
        this.$container.classList.add(`${this.className}--is-moving`);

        // remove focus highlight from all other slider handles on the page
        const $hsliderHandleAll = document.querySelectorAll(
            `${this.className}--horizontal ${this.className}__handle`,
        );

        $hsliderHandleAll.forEach(
            ($hsliderHandle) => ($hsliderHandle.style.zIndex = '0'),
        );

        const $vsliderHandleAll = document.querySelectorAll(
            `${this.className}--vertical ${this.className}__handle`,
        );

        $vsliderHandleAll.forEach(
            ($vsliderHandle) => ($vsliderHandle.style.zIndex = '10'),
        );

        // Set focus to the clicked handle
        $handle.focus();

        const pointerMoveEvent = (e) => {
            this.handlePointerMove($handle, e);
        };

        const pointerUpEvent = (e) => {
            document.body.classList.remove(
                `${this.className}--cannot-select-text`,
            );
            this.$container.classList.remove(`${this.className}--is-moving`);
            // unbind the event listeners to release the pointer
            document.body.removeEventListener('pointermove', pointerMoveEvent);
            document.body.removeEventListener('pointerup', pointerUpEvent);
            document.body.removeEventListener('touchmove', pointerMoveEvent);
            document.body.removeEventListener('touchend', pointerUpEvent);

            e.stopPropagation;
            return false;
        };

        // bind a pointermove event handler to the document to capture the pointer
        document.body.addEventListener('pointermove', pointerMoveEvent);
        document.body.addEventListener('touchmove', pointerMoveEvent);

        //bind a pointerup event handler to the document to capture the pointer
        document.body.addEventListener('pointerup', pointerUpEvent);
        document.body.addEventListener('touchend', pointerUpEvent);

        evt.stopPropagation();
        evt.preventDefault();
        return false;
    }; // end handlePointerDown()

    /**
     * handleDecrementorClick() - Event handler fired when clicking on the decrementor
     * button. This button should only be visible to mobile screen reader users.
     *
     * @param { HTMLElement } $handle - DOM node of the handle container to be manipulated
     * @param { HTMLElement } $handleButton - DOM node of the handle button.
     * @param { Event } evt - the click event object
     */
    this.handleDecrementorClick = function ($handle, evt) {
        const $handleButton = $handle.querySelector(
            '.enable-slider__handle-button',
        );

        const newVal = $handleButton.getAttribute('aria-valuenow') - this.inc;
        let stopVal = this.min; // where to stop moving

        if (this.range) {
            // if this is handle 2, stop when we reach the value
            // for handle 1
            if (/2$/.test($handle.getAttribute('id'))) {
                stopVal = this.val1;
            }
        }

        // move the handle one jump increment toward the stopVal
        // If value is less than stopVal, set at stopVal instead
        this.positionHandle(
            $handle,
            $handleButton,
            newVal > stopVal ? newVal : stopVal,
        );

        evt.stopPropagation;
        evt.preventDefault();
    };

    /**
     * handleIncrementorClick() - Event handler fired when clicking on the incrementor
     * button. This button should only be visible to mobile screen reader users.
     *
     * @param { HTMLElement } $handle - DOM node of the handle container to be manipulated
     * @param { Event } evt - the click event object
     */
    this.handleIncrementorClick = function ($handle, evt) {
        const $handleButton = $handle.querySelector(
            '.enable-slider__handle-button',
        );
        const newVal =
            parseInt($handleButton.getAttribute('aria-valuenow')) + this.inc;
        let stopVal = this.max; // where to stop moving

        if (this.range) {
            // if this is handle 1, stop when we reach the value
            // for handle 2
            if (/1$/.test($handle.getAttribute('id'))) {
                stopVal = this.val2;
            }
        }

        // move the handle one increment toward the slider maximum
        // If value is greater than maximum, set at maximum instead
        this.positionHandle(
            $handle,
            $handleButton,
            newVal < stopVal ? newVal : stopVal,
        );

        evt.stopPropagation;
        evt.preventDefault();
    };

    /**
     * handleResize(): the event that fires when the page is resized or onorientationchange.
     * This redraws the slider, which is necessary if the sliders dimensions are given
     * in relative units, such as % or vw.
     *
     * @param { Event } evt - the resize event object
     */
    this.handleResize = () => {
        const { positionHandle, positionRangeDiv, $handle1, $handle2 } = this;
        const $handleButton1 = $handle1.getElementsByClassName(
            'enable-slider__handle-button',
        )[0];
        const $handleButton2 = $handle2
            ? $handle2.getElementsByClassName('enable-slider__handle-button')[0]
            : null;

        positionHandle(
            $handle1,
            $handleButton1,
            parseInt($handleButton1.getAttribute('aria-valuenow')),
        );

        if ($handle2) {
            positionHandle(
                $handle2,
                $handleButton2,
                parseInt($handleButton2.getAttribute('aria-valuenow')),
            );
        }

        if (this.range) {
            positionRangeDiv();
        }
    };

    /**
     * handlePointerMove() is a member function to process pointermove
     * events for a slider handle.
     *
     * @param { HTMLElement } $handle - DOM node of the handle container to be manipulated
     * @param { Event } evt - the event object associated witthe the event
     * @returns { boolean } true if propagating; false if consuming event
     */
    this.handlePointerMove = function ($handle, evt) {
        const $handleButton = $handle.querySelector(
            '.enable-slider__handle-button',
        );
        const {
            left: containerLeft,
            top: containerTop,
            width: containerWidth,
            height: containerHeight,
        } = this.$container.getBoundingClientRect();
        let newVal;
        let startVal = this.min;
        let stopVal = this.max;

        if (this.range) {
            // if this is handle 1, set stopVal to be the value
            // for handle 2
            if (/1$/.test($handle.getAttribute('id'))) {
                stopVal = this.val2;
            } else {
                // This is handle 2: Set startVal to be the value
                // for handle 1
                startVal = this.val1;
            }
        }

        if (!this.vert) {
            // horizontal slider

            // Calculate the new slider value based on the horizontal pixel position of the pointer using the container width
            const relativeX = evt.clientX - containerLeft;
            newVal = Math.round(
                (relativeX / containerWidth) * (this.max - this.min) + this.min,
            );
        } else {
            // vertical slider

            // Calculate the new slider value based on the vertical pixel position of the pointer
            const relativeY = evt.clientY - containerTop;
            newVal = Math.round(
                (relativeY / containerHeight) * (this.max - this.min) +
                    this.min,
            );
        }

        // Snap the value to the nearest increment
        newVal = Math.round(newVal / this.inc) * this.inc;

        // Clamp the value within the allowed range
        newVal = Math.max(startVal, Math.min(newVal, stopVal));

        this.positionHandle($handle, $handleButton, newVal);

        evt.stopPropagation();
        evt.preventDefault();
        return false;
    }; // end handlePointerMove

    this.init();
};

const enableSliders = new (function () {
    this.list = [];

    this.add = ($root) => {
        const { min, max, inc, jump, showVals, range, val1, val2 } =
            $root.dataset;

        if (!$root.id) {
            $root.id = 'enable-slider__' + i;
        }

        this.list.push(
            new enableSlider(
                $root.id,
                $root.classList.contains('enable-slider--vertical'),
                parseFloat(min),
                parseFloat(max),
                parseFloat(inc),
                parseFloat(jump),
                showVals === 'true',
                range === 'true',
                parseFloat(val1),
                parseFloat(val2),
            ),
        );
    };

    this.init = () => {
        const $roots = document.querySelectorAll('.enable-slider');

        for (let i = 0; i < $roots.length; i++) {
            const $root = $roots[i];
            this.add($root);
        }
    };
})();

export default enableSliders;
