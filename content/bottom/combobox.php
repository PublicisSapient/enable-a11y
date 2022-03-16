<script type="module">
import comboboxes from "./js/modules/combobox.js";

comboboxes.init();
</script>
<script id="autocomplete-submit">
const autocompleteSubmit = new function() {
  this.init = () => {
    document.getElementById('video-games').addEventListener('enable-combobox-change', (e) => {
      const {
        currentTarget
      } = e;
      const {
        value
      } = currentTarget;
      const q = `https://www.google.com/search?${new URLSearchParams(`q=${value}`).toString()}`
      location.href = q;
    });
  }
  this.init();
}
</script>