<script type="module">
    import EnableCarousel from "./js/modules/enable-carousel.js";

    /* This is the first carousel example, which acts like a list of links */
    const focusAllPanelsCarousel = new EnableCarousel(document.querySelector(".enable-carousel--focus-all-panels"));


    /* 
     * This is the second carousel example, while focuses on the first newly visible
     * panel when the arrow keys are pressed.
     */
    const focusArrowButtonsCarousel = new EnableCarousel(document.querySelector(".enable-carousel--has-focusable-arrow-buttons"), {
        useArrowButtons: true
    });

    focusAllPanelsCarousel && focusAllPanelsCarousel.init();
    focusArrowButtonsCarousel && focusArrowButtonsCarousel.init();  
</script>