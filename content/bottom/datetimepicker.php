  <!-- classList polyfill for IE9 -->
   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/classlist/1.2.20171210/classList.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
  <script>
     function initializeFlatpickr(language) {
        var fp = flatpickr(".date", {
          enableTime: true,
          dateFormat: "Y-m-d H:i",
          locale: language === 'fr' ? 'fr' : 'default', // Set locale based on language
          onReady: function(selectedDates, dateStr, instance) {
          // Adding aria-label to the time input fields
          const timeContainer = instance.calendarContainer.querySelector(".flatpickr-time");
          if (timeContainer) {
            const hourInput = timeContainer.querySelector("input.flatpickr-hour");
            const minuteInput = timeContainer.querySelector("input.flatpickr-minute");
            const ampmInput = timeContainer.querySelector("input.flatpickr-am-pm"); // for 12-hour format

            if (hourInput) hourInput.removeAttribute("aria-label");
            if (minuteInput) minuteInput.removeAttribute("aria-label");
            if (ampmInput) ampmInput.removeAttribute("aria-label");
            if (hourInput) hourInput.setAttribute("aria-describedby", "hour-description");
            if (minuteInput) minuteInput.setAttribute("aria-describedby", "minute-description");
            if (ampmInput) ampmInput.setAttribute("aria-label", "AM/PM");
          }
        }
      });
    }
    initializeFlatpickr('en');
    // Listen for changes on the language dropdown
    document.getElementById('language-select').addEventListener('change', function(event) {
      const selectedLanguage = event.target.value;
      // Destroy the current Flatpickr instance
      //document.getElementById('datetime-picker')._flatpickr.destroy();
      // Re-initialize Flatpickr with the new language
      initializeFlatpickr(selectedLanguage);
    });
  </script>