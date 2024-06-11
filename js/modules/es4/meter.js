'use strict'

/*******************************************************************************
 * meter.js - Adds full support for meter component without use of HTML5 meter
 ******************************************************************************/

const meter = new function() {
  this.init = function() {
    this.meterEls = document.querySelectorAll('.enable-custom-meter');

    for (let i = 0; i < this.meterEls.length; i++) {
      const element = this.meterEls[i];

      const value = Number(element.getAttribute('aria-valuenow')) || Number(element.getAttribute('value'));
      const min = Number(element.getAttribute('aria-valuemin')) || Number(element.getAttribute('min'));
      const max = Number(element.getAttribute('aria-valuemax')) || Number(element.getAttribute('max'));

      // Calculate meter fill percentage and color
      const percentage = (value / (max - min)) * 100;
      const color = this.calculateColor(element)

      // Apply values as style vars to be used by component css
      element.setAttribute('style', `--meter-percentage: ${percentage}%;--meter-color: ${color};`)
    }
  }

  /**
   * Calculates meter color from element attributes
   * @param {node} element - Element of the meter component
   * @returns color value
   */
  this.calculateColor = function(element) {
    const value = Number(element.getAttribute('aria-valuenow')) || Number(element.getAttribute('value'));
    const low = Number(element.getAttribute('data-low')) || Number(element.getAttribute('low'));
    const high = Number(element.getAttribute('data-high')) || Number(element.getAttribute('high'));
    const optimum = Number(element.getAttribute('data-optimum')) || Number(element.getAttribute('optimum')) || high;

    // Hex codes for meter style var
    const negative = '#C74821';
    const neutral = '#F4BC41';
    const positive = '#387A26';

    let color = positive;
    if (low && high) {
      const isHigh = value >= high;
      const isMedium = value > low && value < high;
      const isLow = value <= low;
      const isHighValueOptimal = optimum > high;

      if (isMedium) {
        color = neutral;
      } else if ((isLow && isHighValueOptimal) || (isHigh && !isHighValueOptimal))  {
        color = negative;
      }
    }

    return color;
  }
}

