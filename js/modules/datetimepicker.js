'use strict'

/*******************************************************************************
 * datetimepicker.js - Helper script for custom datetimepicker component(flatpickr). 
 * Flatpickr properties are initialized and the appropriate attributes are 
 * applied to the elements.
 ******************************************************************************/

const datetimepicker = new function() {
    this.initializeFlatpickr = function() {
    var fp = flatpickr(".datetimepicker", {
      enableTime: true,
      allowInput:true, // allows the user to enter date using keyboard
      dateFormat: "Y-m-d H:i",
      locale: (navigator.language || navigator.userLanguage).split('-')[0], // Set locale based on user language
      onReady: function(selectedDates, dateStr, instance) {
      // Adding aria-describedby to the time input fields
        const timeContainer = instance.calendarContainer.querySelector(".flatpickr-time");
        if (timeContainer) {
            const hourInput = timeContainer.querySelector("input.flatpickr-hour");
            const minuteInput = timeContainer.querySelector("input.flatpickr-minute");
            const ampmInput = timeContainer.querySelector("input.flatpickr-am-pm"); // for 12-hour format
            if (hourInput) hourInput.setAttribute("aria-describedby", "hour-description");
            if (minuteInput) minuteInput.setAttribute("aria-describedby", "minute-description");
            if (ampmInput) ampmInput.setAttribute("aria-label", "AM/PM");
        }
     },
    onOpen: (selectedDates, dateStr, instance) => {
      // Add keydown event listener to the input element
      instance.input.addEventListener('keydown', handleKeyDown);
      // Add role as application to make it accessible for direct interaction in ATs that use both browse and focus modes for interacting with web content. 
      // For Example with NVDA screen reader
      document.querySelector('.dayContainer').setAttribute("role", "application");
    }
   });
   function handleKeyDown(event) {
    const calendarContainer = fp.calendarContainer;
            if (['ArrowUp', 'ArrowDown'].includes(event.key)) {
                // Prevent the default behavior
                event.preventDefault();
                // Focus the current date in the calendar
                const currentDate = calendarContainer.querySelector('.flatpickr-day.today');
                if (currentDate) {
                  currentDate.focus();
                }
            }
            if (event.key === 'Enter') {
            // Prevent default action for Enter key
            event.preventDefault();
        // Find the currently active date element (usually has class 'selected')
        const activeDateElement = calendarContainer.querySelector('.flatpickr-day.selected');
            // Check if Flatpickr is not open, then open it
            if (!fp.isOpen) {
                fp.open();
                !!activeDateElement 
                ? activeDateElement.focus()
                :  calendarContainer.querySelector('.flatpickr-day.today')?.focus();
            }
        }
    }

  }
}
  export default datetimepicker;