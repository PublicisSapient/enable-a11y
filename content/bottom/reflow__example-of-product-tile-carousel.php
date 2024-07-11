<script type="module">
    import EnableCarousel from "./js/modules/enable-carousel.js";

    /* This is the first carousel example, which acts like a list of links */
    const focusAllPanelsCarousel = new EnableCarousel(document.querySelector("#product-tile-carousel"), {}, {
        responsive: [
            {
                // screens greater than >= 775px
                breakpoint: 960,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    itemWidth: 150,
                    duration: 0.25
                }
            }
        ]
    });

    focusAllPanelsCarousel && focusAllPanelsCarousel.init();
</script>