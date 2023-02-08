



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
 * 
 */

// First, run Enable Carousel constructor.  Note that
// `domContainer` is the root DOM node that has the
// `enable-carousel` class assigned to it.
const focusArrowButtonsCarousel = new EnableCarousel(domContainer), {
    useArrowButtons: true
});

// Next, check if it is set correctly, then initialize
focusArrowButtonsCarousel && focusArrowButtonsCarousel.init();  