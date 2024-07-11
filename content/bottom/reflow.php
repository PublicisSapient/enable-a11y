<script type="module">
    const iframes = document.querySelectorAll('iframe');

    // We just want to make sure onload the navigation in each iframe is visible.
    iframes.forEach((el) => {
        el.scrollTop = 0;
    })
</script>