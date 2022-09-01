<script type="module">
    import EnableCarousel from "./js/modules/enable-carousel.js";
    const focusAllPanelsCarousel = new EnableCarousel(document.querySelector(".enable-carousel--focus-all-panels"));
    const focusArrowButtonsCarousel = new EnableCarousel(document.querySelector(".enable-carousel--focus-arrow-buttons"), {
        useArrowButtons: true
    });
    focusAllPanelsCarousel.init();
</script>