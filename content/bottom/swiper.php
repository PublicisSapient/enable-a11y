<script type="module">
"use strict";

import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs'

let _swiper = null; // for internal use only


const debugEl = document.getElementById('debug');

if (debugEl) {
    console.log = (x, y, z) => {
        debugEl.innerHTML += `${entify(x)} ${entify(y||'')} ${entify(z||'')}\n`;
    }
}

const debounce = (fn, time) => {
  let timeout;

  return function() {
    const functionCall = () => fn.apply(this, arguments);
    
    clearTimeout(timeout);
    timeout = setTimeout(functionCall, time);
  }
}

const throttle = (func, limit) => {
  let inThrottle
    return function() {
      const args = arguments
      const context = this
      if (!inThrottle) {
        func.apply(context, args)
        inThrottle = true
        setTimeout(() => inThrottle = false, limit)
      }
    }
}


// Needed by entify()
const  amp = /&/g;
const  lt = /</g;
const  gt = />/g;
const  tab = /\t/g;
const  space = / /g;
const  cr = /\n/g;			// UNIX carriage return
const  mscr = /\r\n/g;		// Microsoft carriage return

const  entityRe = /&\w+;/;
const entify = function (s, options) {


    if (!options) {
        options = {}
    }

    var result =  s.replace(amp, "&amp;")
    .replace(lt,"&lt;")
    .replace(gt,"&gt;")
    .replace(tab, '   ');
    
    if (!options.ignoreSpace) {
        result = result.replace(space, '&nbsp;')
    }

    if (!options.ignoreReturns) {
        result = result.replace(mscr, '<br />')
        .replace(cr, '<br />');
    }
    
    
    
    return result;
}


const setSwipeEvent = (e) => {
    if (_swiper) {
        _swiper.el.addEventListener('scroll', onScroll, {
            once: true
        });
    }
}


const onScroll = (e) => {
    if (_swiper) {
        //console.log(`onscroll ${_swiper.el.scrollLeft}`);
        const {
            activeElement
        } = document;

        const containerEl = _swiper.el.closest('.swiper-container-root');
        const rect = containerEl.getBoundingClientRect();
        const activeSlide = _swiper.el.closest('.swiper-slide'); //document.elementFromPoint(rect.x + rect.width - 2, rect.y + 2);

        console.log('active container', activeElement.outerHTML);
        const allSlides = _swiper.slides;
        const activeSlideIndex = [...allSlides].indexOf(activeSlide);


        setTimeout(() => {
            _swiper.el.scrollLeft = 0;
            _swiper.slideTo(activeSlideIndex);
        }, 10);
    }

}

const debounceOnScroll = debounce((e) => {
    onScroll(e)
}, 100);

let swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },

    // accessibility
    a11y: {
        prevSlideMessage: 'Display previous slide',
        nextSlideMessage: 'Display next slide',
    },
    on: {
        afterInit: (e) => {
            document.querySelectorAll('.swiper .swiper-control').forEach((el) => {
                el.setAttribute('tabIndex', '-1');
            })
        },
        sslideChange: throttle((e) => {
            console.log('slideChange');
            setSwipeEvent();
            onScroll();
        }, 1000)
    },

    // This must be set to true in order for mobile and screen reader support  to work correctly.
    cssMode: true
});

_swiper = swiper;


setSwipeEvent();
</script>