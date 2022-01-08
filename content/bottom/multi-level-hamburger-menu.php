<script>
    const breakpointWidth = window.getComputedStyle(document.querySelector('.enable-flyout')).getPropertyValue(
        '--enable-flyout__desktop-min');
    Array.prototype.forEach.call(document.querySelectorAll('.breakpoint-width'), (el, i) => {
        el.innerHTML = breakpointWidth;
    });
    console.log('bw', breakpointWidth);
    </script>