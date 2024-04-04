



/* 
 * How to initialize your carousel to be like a 
 * list of links (i.e. the first example)
 */

// First, run Enable Carousel constructor.  Note that
// `domContainer` is the root DOM node that has the
// `enable-carousel` class assigned to it.
const focusAllPanelsCarousel = new EnableCarousel(domContainer);

// Next, check if it is set correctly, then initialize
focusAllPanelsCarousel && focusAllPanelsCarousel.init();




/* 
 * How to initialize your carousel to be like the second
 * carousel example, where keyboard focus is applied to
 * the newly visible panel when the arrow keys are pressed.
 */

// First, run Enable Carousel constructor.  Note that
// `domContainer` is the root DOM node that has the
// `enable-carousel` class assigned to it.
const focusArrowButtonsCarousel = new EnableCarousel(domContainer, {
    useArrowButtons: true,

    // Note that for browsers that don't support the `inert` propery,
    // you will need to include the <a href="https://github.com/WICG/inert">WICG inert polyfill</a> to support it
    // (As of 2023, this is basically Firefox).  Note this polyfill
    // won't load if it isn't needed, and is relative to the 
    // root page's URL.
    inertURL: 'enable-node-libs/wicg-inert/dist/inert.min.js'
});

// Next, check if it is set correctly, then initialize
focusArrowButtonsCarousel && focusArrowButtonsCarousel.init();  
