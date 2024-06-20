<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessible Toast Notifications</title>
    <link rel="stylesheet" href="toast.css">
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <p>
        <strong>Toast notifications are non-blocking alerts that provide feedback or information to users. They are hidden by default and become visible when triggered by a user action or system event.</strong> Toast notifications can be styled, positioned, and customized to suit various needs. This demo showcases an accessible implementation of toast notifications.
    </p>

    <h2>Accessible Toast Notifications Example</h2>

    <?php includeStats([
        "isForNewBuilds" => true,
        "comment" => "Recommended for new and existing work.",
    ]); ?>
    <?php includeStats(["isNPM" => true]); ?>

    <p>
        In order to make toast notifications accessible, there are a few considerations:
    </p>
    <ol>
        <li>Toasts should be announced by screen readers when they appear.</li>
        <li>Keyboard users should be able to navigate to and dismiss toasts.</li>
        <li>Toasts should support different levels of severity (normal, error, warning, success), each with a unique color for visual distinction.</li>
    </ol>
    <p>
        Our implementation ensures that toasts are fully accessible and follow best practices for ARIA and keyboard interaction. When a toast appears, it is announced to screen readers. Toasts can be configured to stay visible for a set amount of time or until manually dismissed by the user. Additionally, all toasts are stored in a toast rack for future reference.
    </p>

    <div id="example1" class="enable-example">
        <div class="controls">
            <div class="control-group">
                <label>Position:</label>
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
    </div>

    <?php includeShowcode("example1"); ?>

    <script type="application/json" id="example1-props">
    {
        "replaceHtmlRules": {},
        "steps": [
            {
                "label": "Create markup",
                "highlight": "data-tooltip",
                "notes": "Our script uses the <code>data-tooltip</code> attribute instead of the <code>title</code> attribute, since <strong>title</strong> is rendered by user agents by default and cannot be styled."
            },
            {
                "label": "Create JavaScript events for toast script",
                "highlight": "%JS% toastModule.create; toastModule.init",
                "notes": "When the page is loaded, create the toast DOM object and initialize the events that will display the toasts. <strong>Note the role of toast being added to the toast DOM object</strong>."
            },
            {
                "label": "Create the show and hide methods for the toast",
                "highlight": "%JS% toastModule.show; toastModule.hide",
                "notes": "We make sure the element that triggered the toast's <code>show</code> method will be connected to it with the aria-live attribute, which ensures screen readers announce the toast on focus."
            },
            {
                "label": "Ensure toast disappears when the close button is clicked",
                "highlight": "%JS% toastModule.onClick",
                "notes": "This is to ensure users can make the toast disappear without any additional actions."
            },
            {
                "label": "Set up the CSS",
                "highlight": "%CSS%toast-css~ .toast; .toast::before; .toast--hidden ||| border[^:]*: 1px solid transparent; ",
                "notes": "The styling for the toast notifications ensures they are visible and accessible. <strong>Note the highlighted properties</strong>. This ensures the toasts appear correctly in various display modes."
            }
        ]
    }
    </script>

    <script src="toast.js"></script>
    <script src="app.js"></script>
</body>
</html>
