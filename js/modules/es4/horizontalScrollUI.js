import { throttle } from './performance-utils.js';

const horizontalScrollUI = new function () {
  const scrollEvent = (e) => {
    const { target } = e;

    if (target.classList.contains('can-horizontally-scroll')) {
      const { parentNode } = target;
      const { classList } = parentNode;
      if (target.scrollLeft === 0) {
        classList.remove('fade-both', 'fade-left');
      } else if (target.scrollLeft + target.offsetWidth > target.scrollWidth - 10) {
        classList.add('fade-left');
        classList.remove('fade-both');
      } else {
        classList.add('fade-both');
        classList.remove('fade-left');
      }
    }
  }

  function setEvents() {
    document.body.addEventListener('scroll', throttle(scrollEvent, 100), true)
  }

  setEvents();
}

export default horizontalScrollUI;