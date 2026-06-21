<p>
  An Accessible DateTimePicker is a user interface tool that provides clear labels, adjustable settings, and support for
  various assistive technologies. The Accessible DateTimePicker
  ensures that selecting and managing date and time is both intuitive and inclusive for everyone.
</p>
<p>
  In HTML5, they can be implemented by setting the type of input field as <code>datetime-local</code>.
  In ARIA, they can be implemented with the Aria properties and a bit of JavaScript.
</p>
<p>
  This is one of the uncommon instances where the native HTML5 version of datetimepicker is not accessible in most web
  browsers.
  The testing results in different browsers are also explained in this <a
    href="https://www.hassellinclusion.com/blog/input-type-date-ready-for-use/" target="_blank">article.</a>
  Consequently, the custom datetimepicker is the preferred solution.
</p>

<h2 id="aria-combobox" tabindex="-1">Custom date and time control </h2>

<?php includeStats([
    "isForNewBuilds" => true,
    "comment" =>
        "This datetimepicker works better with screen readers than the native HTML5 version",
]); ?>
<?php includeStats([
    "isNPM" => true,
]); ?>

<p>
  This is a slightly refactored version of
  <a href="https://flatpickr.js.org/" target="_blank">the datetime picker example at
    flatpickr.js.org</a>. Added was a few extra aria-describedby so that the screen reader announces the different
  inputs of time field.
</p>
<div class="enable-example">
  <div id="example1">
      <label class="datetimepicker__input-wrapper">
        <span class="datetimepicker__input-label">Enter the travel date and time</span>
        <input class="datetimepicker" aria-describedby="traveldatetime-description">
          <span id="traveldatetime-description" class="sr-only">
            The date and time format is YYYY-MM-DD HH:MM. Use the Up or Down arrow keys to navigate within the datepicker dialog, and then press Enter to select the date and time.
          </span><!--datetimepicker input-->
      </label>
      <span id="hour-description" class="sr-only">Time Field, Please enter hour. </span>
      <span id="minute-description" class="sr-only">Time Field, Please enter minute. </span>
      <span id="time-description" class="sr-only">Time Field, Please select AM or PM.</span>
  </div>
</div>
<?php includeShowcode("example1"); ?>
<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {},
  "steps": [
    {
      "label": "Add an input and provide a class or id to it. The same class or id needs to be passed in the javascript.",
      "highlight": "datetimepicker",
      "notes": "Once you have got the instance of the datepicker, you can easity access it's properties." 
    },
    {
      "label": "Add few span tags having the description of the time field. It gets announced when use selects the hour, minute or AM/PM.",
      "highlight": "hour-description",
      "notes": "The aria-describedby property is set via JavaScript, with the ID assigned to the span element being dynamically applied to the time input." 
    },
    {
      "label": "Initialize the datepicker via JavaScript",
      "highlight": "%FILE% ./js/modules/datetimepicker.js ~ this.initializeFlatpickr",
      "notes": "Set the required configurations while iniatializing the flatpickr. All the available configurations can be found <a href=\"https://flatpickr.js.org/options/\" target=\"_blank\">here.</a>"
    },
    {
      "label": "Set the locale config to user preferred language",
      "highlight": "%FILE% ./js/modules/datetimepicker.js ~ locale",
      "notes": "Details about the locales supported by flatpickr can be found <a href=\"https://flatpickr.js.org/localization/\" target=\"_blank\">here.</a>"
    },
    {
      "label": "Define the aria attributes in the onReady event hook",
      "highlight": "%FILE% ./js/modules/datetimepicker.js ~ onReady",
      "notes": "The aria-describedby attribute has been applied to the time, minute, and AM/PM inputs to provide users with additional context."
    },
    {
      "label": "Define the onOpen event hook",
      "highlight": "%FILE% ./js/modules/datetimepicker.js ~ onOpen",
      "notes": "Insert the code that should execute when the calendar opens."
    },
    {
      "label": "Add keydown event listener to the input element",
      "highlight": "%FILE% ./js/modules/datetimepicker.js ~ handleKeyDown",
      "notes": "Attach the keydown event listener to enable keyboard navigation of the datepicker calendar. In this example, the Up and Down arrow keys are used for navigation. If the calendar is closed and focus remains on the datepicker input, the Enter key can be pressed to reopen it."
    },
    {
      "label": "Assign the role of 'application' to the wrapper div that contains the dates",
      "highlight": "%FILE% ./js/modules/datetimepicker.js ~ role",
      "notes": "Assign the 'application' role to the wrapper div containing the dates to enhance accessibility for assistive technologies that support both browse and focus modes, such as the NVDA screen reader."
    }
  ]
}
</script>

<h3 id="npm-instructions">Installation Instructions</h3>
<p>The instructions for installing a flatpickr module are available <a href="https://flatpickr.js.org/getting-started/"
    target="_blank">here</a></p>

<h3>Keyboard Support</h3>
<h4>Datetime picker: Open and close dialog</h4>
<table class="datetimepicker__table">
  <thead>
    <tr>
      <th>Key</th>
      <th>Function</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Tab and Enter</td>
      <td>
        When the datetime picker field receives the focus, it opens the datetime picker dialog. Use the <code>Up</code>
        or <code>down</code> arrow key to select the date.
        Press <code>Enter</code> key to confirm the date selection.
      </td>
    </tr>
    <tr>
      <td>Esc</td>
      <td>After the datetime picker field receives the focus, press the <code>Esc</code>key to close the dialog and it returns the focus to the datepicker field. Press <code>Enter</code> to reopen the
        Datetime picker dialog.</td>
    </tr>
  </tbody>
</table>
<h4>Date Picker Dialog: Navigate different dates, month & year</h4>
<table class="datetimepicker__table">
  <thead>
    <tr>
      <th>Key</th>
      <th>Function</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Up Arrow</td>
      <td>
        Moves focus to the same day of the previous week.
      </td>
    </tr>
    <tr>
      <td>Down Arrow</td>
      <td>Moves focus to the same day of the next week.
      </td>
    </tr>
    <tr>
      <td>Right Arrow</td>
      <td>
        Moves focus to the next day.
      </td>
    </tr>
    <tr>
      <td>Left Arrow</td>
      <td>
        Moves focus to the previous day.
      </td>
    </tr>
    <tr>
      <td>
        <ul>
          <li>Mac (Control + Command/Option/Shift + Left arrow key)</li>
          <li>Windows (Control + Shift + Left arrow key)</li>
        </ul>
      </td>
      <td>Changes the grid of dates to the previous month.</td>
    </tr>
    <tr>
      <td>
        <ul>
          <li>Mac (Control + Command/Option/Shift + Right arrow key)</li>
          <li>Windows (Control + Shift + Right arrow key)</li>
        </ul>
      </td>
      <td>Changes the grid of dates to the next month.
      </td>
    </tr>
    <tr>
      <td>
        <ul>
          <li>Mac (Control + Command/Option/Shift + Down arrow key)</li>
          <li>Windows (Control + Shift + Down arrow key)</li>
        </ul>
      </td>
      <td>Changes the grid of dates to the previous year.
      </td>
    </tr>
    <tr>
      <td>
        <ul>
          <li>Mac (Control + Command/Option/Shift + Up arrow key)</li>
          <li>Windows (Control + Shift + Up arrow key)</li>
        </ul>
      </td>
      <td>Changes the grid of dates to the next year.
      </td>
    </tr>
  </tbody>
</table>

<h4>Date Picker Dialog: Select time</h4>
<table class="datetimepicker__table">
  <thead>
    <tr>
      <th>Key</th>
      <th>Function</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Enter</td>
      <td>
        Press the Enter key to activate the selected date. It automatically takes focus to Time field. Press <code>Enter</code> again to select the time. Anytime to move focus out of the time field, press the <code>Shift + Tab</code> key.
      </td>
    </tr>
  </tbody>
</table>

<h2>Using HTML5 date and time control </h2>

<?php includeStats([
    "doNot" => true,
    "comment" =>
        "This does not work with assistive technologies in most web browsers.",
]); ?>
<p>
  Ironically, this seems to be inaccessible compared to the ARIA version. Because of the below reasons, it is one of the
  cases where ARIA works better.
</p>
<ol>
  <li>Inconsistent Browser Support and Visual Design:
    <p>
      The appearance of the native date-time picker can vary significantly between browsers and operating systems.
      For instance, the date and time control feature looks quite different in Firefox (version 129), 
      whereas in Safari (version 16.6), the placeholder text is grayed out and the calendar icon is missing. 
      Moreover, in Safari, when users try to adjust the year field, the value can range from 0001 to 275760. 
      Despite the accepted format being YYYY, users can still input up to six digits in the year field, and 
      the focus does not automatically shift to the next field.
      These inconsistencies can create a confusing user experience, particularly for individuals with cognitive disabilities.
    </p>
  </li>
  <li>Validation and Error Handling:
    <p>
      Since users can enter an invalid date via the keyboard, 
      incorporating custom validation and error handling may be crucial to ensure that all users clearly understand what is required.
    </p>
  </li>
  <li>Presentation format:
    <p>
    The date is displayed differently across various operating systems. On a Mac, the format in Chrome (version 127), 
    Safari (version 16.6), and Firefox (version 129) is YYYY-MM-DDThh:mm
    . In contrast, on Windows, the format in Chrome (version 127) and Firefox (version 129) is mm/dd/yyyy hh:mm.
    </p>
  </li>
  <li>Keyboard Navigation:
    <p>
      Users who rely on keyboard navigation for forms might struggle with the date-time picker. 
      Certain implementations lack straightforward keyboard navigation, making it challenging for users to select dates and times without using a mouse. 
      For example, if a user is navigating using only the keyboard on Chrome (version 127) on a Mac, the focus may not shift to the calendar icon that opens the date-time picker dialog, 
      leaving the user with no keyboard-based option to access the dialog and only allowing date entry.
    </p>
  </li>
  <li>Lack of Customization:
    <p>
      The native control does not provide much flexibility in terms of styling or behavior customization.
      This can make it difficult to match the control with the overall design and accessibility requirements of any
      website.
    </p>
  </li>
  <li>Screen Reader Compatibility:
    <p>
    Certain screen readers might not correctly convey the input type or offer an intuitive interaction method with the date-time picker. 
    This can hinder users who rely on screen readers from effectively understanding and using the control. 
    For instance, when using VoiceOver with Chrome on Mac, if the user enters the date and then focuses on the hour field, 
    VoiceOver might announce something like '-9.1 %, Hours Enter the travel (date and time).' 
    This confusing negative percentage can disorient the user.
    </p>
  </li>
</ol>
<div id="datetimepicker-example" class="enable-example datetimepicker__input-wrapper">
    <label for="traveldatetime" class="datetimepicker__input-label">Enter the travel date and time</label>
    <input type="datetime-local" id="traveldatetime" name="traveldatetime" aria-describedby="traveldatetime-desc">
    <div id="traveldatetime-desc" class="sr-only">
      Enter the date and time in the format YYYY-MM-DDTHH:MM. This format is standard, but your browser or operating system might display it differently. 
    </div>
</div>
<?php includeShowcode("datetimepicker-example"); ?>

<script type="application/json" id="datetimepicker-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
      "label": "Create label for input tag.",
      "highlight": "for",
      "notes": "Just like any other form element, this needs a proper label."
    },
    {
      "label": "Give keyboard instructions using aria-describedby.",
      "highlight": "aria-describedby",
      "notes": "Since the format of the date and time may not be localized according to the user's regional settings, these instructions may help some screen reader users use this component properly."
    },
    {
      "label": "Set up the input type as datetime-local",
      "highlight": "datetime-local",
      "notes": "Note that input type datetime-local is required when you need both date and time input together. Otherwise input type as 'date' or 'time' could be used when you only need the user to input a date or time." 
    }
  ]
}
</script>