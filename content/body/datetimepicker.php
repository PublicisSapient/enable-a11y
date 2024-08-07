

<p>
An Accessible DateTimePicker is a user interface tool that allows users to select dates and times with ease, designed specifically to accommodate individuals with disabilities. It includes features such as keyboard navigation, screen reader compatibility, and visual and auditory cues to ensure all users can interact with the component effectively. By providing clear labels, adjustable settings, and support for various assistive technologies, the Accessible DateTimePicker ensures that selecting and managing dates and times is both intuitive and inclusive for everyone.
</p>
<h3>Key Board Shortcuts (for Mac)</h3>

<ul>
  <li>When the calendar is opened, focus is set on the current date.</li>
  <li>Press the Left and Right arrow keys to navigate the row by weekday.</li>
  <li>Press the Up and Down arrow keys to navigate between weeks on the same week day.</li>
  <li>Press the Control + command/Option + Arrow Key+ Up and Down arrow key to change year</li>
  <li>Press the Control + command/Option + Arrow Key+ Left and Right arrow key to change month</li>
  <li>Press the Enter key to activate the selected date. It automatically takes focus to Time field. To Enter the Time anytime without hitting Enter, press tab.</li>
  <li>Press Escape to close the calendar without making a selection.
  </li>
</ul>


  <!-- Dropdown to select language -->
   <div style = "display: flex; justify-content:space-around;">
    <div style = "display: flex; justify-content:space-between;">
      <label for="language-select">Choose language:</label>
      <select id="language-select">
        <option value="en">English</option>
        <option value="fr">French</option>
      </select>
    </div>
    <div>
      <div>
        <label>
          <div>Date 1</div>
          <input placeholder="Select Date..." class=date />
        </label>
      </div> <!--form controls-->
    </div>
  </div>
  <span id="hour-description" style="display:none">Time Field, Please enter hour </span>
  <span id="minute-description" style="display:none">Time Field, Please enter minute </span>
  <span id="time-description" style="display:none">Time Field, Please select AM or PM </span>



