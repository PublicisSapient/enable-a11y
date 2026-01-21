

<script id="datetimepicker-js" type="module">
    import datetimepicker from "./js/modules/datetimepicker.js";
    import "./enable-node-libs/flatpickr/dist/flatpickr.min.js";
    const userLanguage = (navigator.language || navigator.userLanguage).split('-')[0];
    console.log(`lang: ${userLanguage}`);
    if(userLanguage !== 'en') {
      import(`./enable-node-libs/flatpickr/dist/esm/l10n/${userLanguage}.js`)
      .then((s) => {
        console.log('s', flatpickr.l10ns)
        datetimepicker.initializeFlatpickr();
      })
    } else {
      datetimepicker.initializeFlatpickr();
    }
</script>
