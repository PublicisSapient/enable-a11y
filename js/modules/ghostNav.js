
const states = new WeakMap();

function init(options = {}) {
  const {
    // Accept an element or a selector string
    header = '.ghost-nav',
    isHiddenSel = `ghost-nav--is-hidden`,
    threshold = 8,            // px delta before reacting
    minShowY = 0,             // always show at/near top
    respectReducedMotion = true,
    usePauseAnimControl = false,
    revealOnStop = 120,       // ms after scrolling stops to auto-show; set null to disable
    enableTopEdgeReveal = true,
    revealZoneFactor = 0.2,   // top % of header height that reveals on mouseover
    revealZoneMin = 10        // or at least N px
  } = options;

  const el = typeof header === 'string' ? document.querySelector(header) : header;
  if (!el) {
    console.warn('[smart-nav] Header element not found:', header);
    return { show(){}, hide(){}, destroy(){} };
  }

  // Don’t duplicate
  if (states.has(el)) return states.get(el).api;

  function prefersReduced() {
    if (respectReducedMotion) {
      if (options.usePauseAnimControl) {
        return document.body.classList.contains('pause-anim-control__prefers-reduced-motion');
      } else {
        return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      }
    }
    return false;
  }
   
  let lastY = window.scrollY;
  let ticking = false;
  let stopTimer = null;
  let revealZone = null;

  const show = () => el.classList.remove(isHiddenSel);
  const hide = () => el.classList.add(isHiddenSel);

  const onScroll = () => {
    if (prefersReduced()) return; // respect reduced motion: keep header visible

    const currentY = window.scrollY;
    if (revealOnStop != null) {
      clearTimeout(stopTimer);
      stopTimer = setTimeout(show, revealOnStop);
    }

    if (!ticking) {
      ticking = true;
      requestAnimationFrame(() => {
        const delta = currentY - lastY;

        if (currentY <= minShowY) {
          show();
        } else if (Math.abs(delta) > threshold) {
          if (delta > 0) hide(); else show();
          lastY = currentY;
        }

        ticking = false;
      });
    }
  };

  const onMouseMove = (e) => {
    if (!enableTopEdgeReveal) return;
    if (revealZone == null) {
      const rect = el.getBoundingClientRect();
      revealZone = Math.max(revealZoneMin, rect.height * revealZoneFactor);
    }
    if (e.clientY <= revealZone) show();
  };

  const onFocusIn = () => show();

  // Attach listeners
  window.addEventListener('scroll', onScroll, { passive: true });
  if (enableTopEdgeReveal) window.addEventListener('mousemove', onMouseMove, { passive: true });
  el.addEventListener('focusin', onFocusIn);

  // Initial state
  show();

  const destroy = () => {
    window.removeEventListener('scroll', onScroll);
    if (enableTopEdgeReveal) window.removeEventListener('mousemove', onMouseMove);
    el.removeEventListener('focusin', onFocusIn);
    clearTimeout(stopTimer);
    states.delete(el);
  };

  const api = { show, hide, destroy };
  states.set(el, { api });
  return api;
}

const ghostNav = {
    init: init
};

export default ghostNav;
