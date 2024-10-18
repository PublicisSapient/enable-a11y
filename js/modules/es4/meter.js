'use strict'

/*******************************************************************************
 * meter.js - Helper script for HTML5/ARIA meter components. 
 * Meter state/percentage is calculated and the appropriate attributes are 
 * applied to the element.
 ******************************************************************************/

const meter = new (function() {
  this.init = function() {
    this.meterEls = document.querySelectorAll('.enable-custom-meter');

    for (let i = 0; i < this.meterEls.length; i++) {
      const element = this.meterEls[i];

      const value = Number(element.getAttribute('aria-valuenow')) || Number(element.getAttribute('value'));
      const min = Number(element.getAttribute('aria-valuemin')) || Number(element.getAttribute('min'));
      const max = Number(element.getAttribute('aria-valuemax')) || Number(element.getAttribute('max'));

      // Calculate meter fill percentage and state
      const percentage = (value / (max - min)) * 100;
      const state = this.calculateMeterState(element)

      // Apply values as style vars to be used by component css
      element.setAttribute('style', `--meter-percentage: ${percentage}%`);
      element.setAttribute('meter-state', state);

      // Set the aria-valuetext to ensure consistent screen reader behavior across browsers/platforms
      element.setAttribute('aria-valuetext', `${percentage}%`);
    }
  }

  /**
   * Calculates meter state from element attributes
   * @param {node} element - Element of the meter component
   * @returns meter state value
   */
  this.calculateMeterState = function(element) {
    const value = Number(element.getAttribute('aria-valuenow')) || Number(element.getAttribute('value'));
    const low = Number(element.getAttribute('data-low')) || Number(element.getAttribute('low'));
    const high = Number(element.getAttribute('data-high')) || Number(element.getAttribute('high'));
    const optimum = Number(element.getAttribute('data-optimum')) || Number(element.getAttribute('optimum')) || high;

    let state = 'positive';
    if (low && high) {
      const isHigh = value >= high;
      const isMedium = value > low && value < high;
      const isLow = value <= low;
      const isHighValueOptimal = optimum > high;

      if (isMedium) {
        state = 'neutral';
      } else if ((isLow && isHighValueOptimal) || (isHigh && !isHighValueOptimal))  {
        state = 'negative';
      }
    }

    return state;
  }
})