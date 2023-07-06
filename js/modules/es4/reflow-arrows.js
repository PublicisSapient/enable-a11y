'use strict'

const reflowArrows = new function() {
  
  this.init = () => {
    document.body.addEventListener('click', onArrowClick, true);
  }

  function onArrowClick(e) {
    const { currentTarget, target } = e;

    if (target.classList.contains('reflow-examples__arrow-button')) {
      const scrollContainer = target.parentNode.querySelector('.reflow-examples__list');
      if (target.classList.contains('reflow-examples__arrow-button--previous')) {
        scroll(scrollContainer, -1);
      } else {
        scroll(scrollContainer, 1);
      }
    }
  }

  function scroll(el, multiplier) {
    const { scrollLeft, offsetWidth } = el;
    console.log(offsetWidth);
    el.scrollLeft += (multiplier * (offsetWidth - 100));
  }
}

reflowArrows.init();
