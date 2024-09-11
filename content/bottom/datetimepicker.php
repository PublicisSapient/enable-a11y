  <!-- classList polyfill for IE9 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/classlist/1.2.20171210/classList.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
  // Dynamically load the javascript file as per the user language preference
  function loadScript(fileUrl, async = true) {
    let scriptElement = document.createElement("script");

    scriptElement.setAttribute("src", fileUrl);
    scriptElement.setAttribute("type", "text/javascript");
    scriptElement.setAttribute("async", async);

    document.body.appendChild(scriptElement);
    // error event
    scriptElement.addEventListener("error", () => {
      console.log(`Error on loading file ${fileUrl}`);
    });
  }
const userLanguage = (navigator.language || navigator.userLanguage).split('-')[0];
if(userLanguage !== 'en') {
  loadScript(`https://npmcdn.com/flatpickr/dist/l10n/${userLanguage}.js`, true);
}
</script>
<script id="datetimepicker-js" type="module">
    import datetimepicker from "./js/modules/datetimepicker.js";
    datetimepicker.initializeFlatpickr();
</script>
