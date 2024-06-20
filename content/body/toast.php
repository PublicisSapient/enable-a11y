<!-- <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The style of this page was inspired by the accessible tabs example, but adapted for the toast notification component.</li>
                <li>This component ensures that toasts are accessible and usable for all users, including those using screen readers and keyboards.</li>
                <li>Toasts can be configured with different levels such as normal, error, warning, and success, each with their own color.</li>
                <li>Toasts automatically disappear after a set period, or they can be manually dismissed by the user.</li>
            </ul>
        </aside> -->
        <p>Toast notifications are a great way to provide feedback to users in a non-intrusive way. They are commonly used to show success messages, error alerts, warnings, and other notifications.</p>
<h2>Accessible Toast Notifications Example</h2>
<?php includeStats(["isForNewBuilds" => true]); ?>
<?php includeStats([
    "isForNewBuilds" => false,
]); ?>
<?php includeStats(["isNPM" => true]); ?>
<p>In order to make toast notifications accessible, there are a few considerations:</p>
<ol>
  <li>Toasts should be announced by screen readers when they appear.</li>
  <li>Keyboard users should be able to navigate to and dismiss toasts.</li>
  <li>Toasts should support different levels of severity (normal, error, warning, success), each with a unique color for visual distinction.</li>
</ol>
<p>Our implementation ensures that toasts are fully accessible and follow best practices for ARIA and keyboard interaction. When a toast appears, it is announced to screen readers. Toasts can be configured to stay visible for a set amount of time or until manually dismissed by the user. Additionally, all toasts are stored in a toast rack for future reference.</p>
<div id="example1" class="enable-example">
  <div id="toastControls">
    <label for="positionSelect">Position:</label>
    <select id="positionSelect">
        <option value="bottom-right">Bottom Right</option>
        <option value="top-right">Top Right</option>
        <option value="top-left">Top Left</option>
        <option value="bottom-left">Bottom Left</option>
        <option value="top-center">Top Center</option>
        <option value="bottom-center">Bottom Center</option>
        <option value="middle-center">Middle Center</option>
    </select>
<!-- php
Copy code -->
<label for="messageInput">Toast Message:</label>
<input type="text" id="messageInput">

<label for="levelSelect">Level:</label>
<select id="levelSelect">
    <option value="normal">Normal</option>
    <option value="error">Error</option>
    <option value="warning">Warning</option>
    <option value="success">Success</option>
</select>

<button id="showToastButton">Show Toast</button>
<button id="clearAllButton">Clear All Toasts</button>
<button id="toggleRackButton">Show Toast Rack</button>
  </div>
  <div id="toastRack" class="toast-rack"></div>
  <div id="status" class="status"></div>
</div>
<script src="toast.js" type="text/javascript"></script>
<script src="app.js" type="text/javascript"></script>
<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {
    ".toast__content": "<!-- insert toast content here -->",
    "[role=\"alert\"]": "<!-- insert toast alert role here -->"
  },
  "steps": [{
      "label": "Create basic DOM structure for users without JavaScript",
      "highlight": "html",
      "notes": "This basic structure ensures the component is usable even if JavaScript fails to load."
    },
    {
      "label": "Ensure the HTML elements have the correct classes and ARIA roles",
      "highlight": "%INLINE%#toastControls ||| class=\"toast-container\" ||| role=\"alert\"",
      "notes": "These classes and roles ensure the toast notifications are styled correctly and announced to screen readers."
    },
    {
      "label": "Assign JavaScript event listeners to handle toast interactions",
      "highlight": "%FILE% app.js ||| addEventListener",
      "notes": "These event listeners handle user interactions with the toast notifications, such as showing and dismissing toasts."
    },
    {
      "label": "Ensure toasts are added to the DOM and announced by screen readers",
      "highlight": "%FILE% toast.js ||| appendChild ||| classList.add('toast-visible')",
      "notes": "This step ensures that toasts are added to the DOM and the appropriate class is added to trigger the fade-in animation."
    },
    {
      "label": "Handle toast dismissal and update the visible queue",
      "highlight": "%FILE% toast.js ||| dismissToast ||| updateVisibleToasts",
      "notes": "This step handles the removal of toasts from the DOM and updates the visible queue to maintain the correct number of visible toasts."
    }
  ]
}
</script>
<?= includeNPMInstructions("toasts", [], "", false, [], ".toast-container") ?>
Here's the full documentation page for the toast component, modeled after the tabs component example you provided:

<!-- <aside class="notes">
            <h2>Notes:</h2>

            <ul>
                <li>The style of this page was inspired by the accessible tabs example, but adapted for the toast notification component.</li>
                <li>This component ensures that toasts are accessible and usable for all users, including those using screen readers and keyboards.</li>
                <li>Toasts can be configured with different levels such as normal, error, warning, and success, each with their own color.</li>
                <li>Toasts automatically disappear after a set period, or they can be manually dismissed by the user.</li>
            </ul>
        </aside> -->
<p>Toast notifications are a great way to provide feedback to users in a non-intrusive way. They are commonly used to show success messages, error alerts, warnings, and other notifications.</p>
<h2>Accessible Toast Notifications Example</h2>
<?php includeStats(["isForNewBuilds" => true]); ?>
<?php includeStats(["isForNewBuilds" => false]); ?>
<?php includeStats(["isNPM" => true]); ?>
<p>In order to make toast notifications accessible, there are a few considerations:</p>
<ol>
  <li>Toasts should be announced by screen readers when they appear.</li>
  <li>Keyboard users should be able to navigate to and dismiss toasts.</li>
  <li>Toasts should support different levels of severity (normal, error, warning, success), each with a unique color for visual distinction.</li>
</ol>
<p>Our implementation ensures that toasts are fully accessible and follow best practices for ARIA and keyboard interaction. When a toast appears, it is announced to screen readers. Toasts can be configured to stay visible for a set amount of time or until manually dismissed by the user. Additionally, all toasts are stored in a toast rack for future reference.</p>

<div>
<div class="controls">
        <div class="control-group">
            <label>Position X:</label>
            <div>
                <label><input type="radio" name="position" value="bottom-right" checked> Bottom Right</label>
                <label><input type="radio" name="position" value="top-right"> Top Right</label>
                <label><input type="radio" name="position" value="top-left"> Top Left</label>
                <label><input type="radio" name="position" value="bottom-left"> Bottom Left</label>
                <label><input type="radio" name="position" value="top-center"> Top Center</label>
                <label><input type="radio" name="position" value="bottom-center"> Bottom Center</label>
            </div>
        </div>
        <div class="control-group">
            <label for="messageInput">Toast Message:</label>
            <input type="text" id="messageInput" placeholder="Toast Message" value="Default toast message">
        </div>
        <div class="control-group">
            <label>Importance Level:</label>
            <div>
                <label><input type="radio" name="level" value="normal" checked> Normal</label>
                <label><input type="radio" name="level" value="error"> Error</label>
                <label><input type="radio" name="level" value="warning"> Warning</label>
                <label><input type="radio" name="level" value="success"> Success</label>
            </div>
        </div>
        <div class="control-group">
            <label>Aria Live:</label>
            <div>
                <label><input type="radio" name="ariaLive" value="polite" checked> Polite</label>
                <label><input type="radio" name="ariaLive" value="assertive"> Assertive</label>
            </div>
        </div>
        <div class="control-group">
            <label for="maxVisibleInput">Max Visible:</label>
            <input type="number" id="maxVisibleInput" placeholder="Max Visible" value="2">
        </div>
        <div class="button-group">
            <button id="showToastButton">Show Toast</button>
            <button id="toggleRackButton">Show Toast Rack</button>
        </div>
    </div>
    <div id="toastRack" class="toast-rack">
        <button id="clearAllButton">Clear All</button>
        <div id="rackContent"></div>
        <div id="rackContentStatus"></div>
    </div>
    <div id="status" class="status"></div>
    <script src="toast.js"></script>
    <script src="app.js"></script>
</div>

php
Copy code
<label for="messageInput">Toast Message:</label>
<input type="text" id="messageInput">

<label for="levelSelect">Level:</label>
<select id="levelSelect">
    <option value="normal">Normal</option>
    <option value="error">Error</option>
    <option value="warning">Warning</option>
    <option value="success">Success</option>
</select>

<button id="showToastButton">Show Toast</button>
<button id="clearAllButton">Clear All Toasts</button>
<button id="toggleRackButton">Show Toast Rack</button>
  </div>
  <div id="toastRack" class="toast-rack"></div>
  <div id="status" class="status"></div>
</div>
<script src="toast.js" type="text/javascript"></script>
<script src="app.js" type="text/javascript"></script>
<script type="application/json" id="example1-props">
{
  "replaceHtmlRules": {
    ".toast__content": "<!-- insert toast content here -->",
    "[role=\"alert\"]": "<!-- insert toast alert role here -->"
  },
  "steps": [{
      "label": "Create basic DOM structure for users without JavaScript",
      "highlight": "html",
      "notes": "This basic structure ensures the component is usable even if JavaScript fails to load."
    },
    {
      "label": "Ensure the HTML elements have the correct classes and ARIA roles",
      "highlight": "%INLINE%#toastControls ||| class=\"toast-container\" ||| role=\"alert\"",
      "notes": "These classes and roles ensure the toast notifications are styled correctly and announced to screen readers."
    },
    {
      "label": "Assign JavaScript event listeners to handle toast interactions",
      "highlight": "%FILE% app.js ||| addEventListener",
      "notes": "These event listeners handle user interactions with the toast notifications, such as showing and dismissing toasts."
    },
    {
      "label": "Ensure toasts are added to the DOM and announced by screen readers",
      "highlight": "%FILE% toast.js ||| appendChild ||| classList.add('toast-visible')",
      "notes": "This step ensures that toasts are added to the DOM and the appropriate class is added to trigger the fade-in animation."
    },
    {
      "label": "Handle toast dismissal and update the visible queue",
      "highlight": "%FILE% toast.js ||| dismissToast ||| updateVisibleToasts",
      "notes": "This step handles the removal of toasts from the DOM and updates the visible queue to maintain the correct number of visible toasts."
    }
  ]
}
</script>
<?= includeNPMInstructions("toasts", [], "", false, [], ".toast-container") ?>
