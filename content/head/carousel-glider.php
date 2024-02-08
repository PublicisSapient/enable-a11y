<link href="~glider-js/glider.css" rel="stylesheet" >
<link href="css/enable-visible-on-focus.css" rel="stylesheet" >
<link href="css/enable-carousel.css" rel="stylesheet" >
<style>
.glider-dot.active {
    width: 30px;
}

.glider-dot {
    margin: 0 !important;
}

.glider-dot::after {
    border-left: none;
    border-right: none;
}

.glider-dot:first-child::after {
    border-left: solid 1px black;
}

.glider-dot:last-child::after {
    border-right: solid 1px black;
}

.glider-dot:has(~ .active)::after {
    background: black;
}
</style>