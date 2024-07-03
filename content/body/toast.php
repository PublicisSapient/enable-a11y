<p>
    <strong>Toast notifications are non-blocking alerts that provide feedback or information to users. They are hidden by default and become visible when triggered by a user action or system event.</strong> Toast notifications can be styled, positioned, and customized to suit various needs. This demo showcases an accessible implementation of toast notifications.
</p>

<h2>Shopping Site Toast Notifications Example</h2>

<div id="example2" class="enable-example">
    <form id="shoppingForm">
        <div class="control-group">
            <p>Products:</p>
            <button type="button" class="addItemButton" data-item-name="Product 1">Add Product 1 to Cart</button>
            <button type="button" class="addItemButton" data-item-name="Product 2">Add Product 2 to Cart</button>
            <button type="button" class="addItemButton" data-item-name="Product 3">Add Product 3 to Cart</button>
        </div>
        <div class="control-group">
            <label for="discountCode">Discount Code:</label>
            <input type="text" id="discountCode" placeholder="Enter discount code">
        </div>
        <div class="button-group">
            <button type="button" id="applyDiscountButton">Apply Discount</button>
            <button type="button" id="checkoutButton">Checkout</button>
        </div>
    </form>
</div>

<?php includeShowcode("example2"); ?>

<script type="application/json" id="example2-props">
{
    "replaceHtmlRules": {},
    "steps": [
        {
            "label": "Create markup",
            "highlight": "",
            "notes": ""
        },
        {
            "label": "Create JavaScript events for toast script",
            "highlight": "%JS% toastModule.create; toastModule.init",
            "notes": "When the page is loaded, create the toast DOM object and initialize the events that will display the toasts."
        },
        {
            "label": "Create the show and hide methods for the toast",
            "highlight": "%JS% toastModule.show; toastModule.hide",
            "notes": "Ensure the toasts are shown and hidden appropriately with ARIA attributes."
        },
        {
            "label": "Set up the CSS",
            "highlight": "%CSS%toast-css~ .toast; .toast::before; .toast--hidden ||| border[^:]*: 1px solid transparent; ",
            "notes": "The styling for the toast notifications ensures they are visible and accessible."
        }
    ]
}
</script>

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
            <label for="messageInput">Toast Message:</label>
            <input type="text" id="messageInput" placeholder="Toast Message" value="A new toast message!">
        </div>
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
            <label>Level:</label>
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
            <button id="toggleRackButton">Toggle Toast Rack</button>
        </div>
    </div>
    <div id="toastRack" class="toast-rack">
        <button id="clearAllButton">Clear All</button>
        <div id="rackContent"></div>
        <div id="rackContentStatus"></div>
    </div>
    <div id="status" class="status"></div>
</div>

<script src="toast.js"></script>
<script src="app.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addItemButtons = document.querySelectorAll('.addItemButton');
        const applyDiscountButton = document.getElementById('applyDiscountButton');
        const checkoutButton = document.getElementById('checkoutButton');

        addItemButtons.forEach(button => {
            button.addEventListener('click', function () {
                const itemName = this.getAttribute('data-item-name');
                if (itemName) {
                    console.log(`Adding item: ${itemName}`);
                    app.toast.showToast(`You have added ${itemName} to your cart.`, 'normal');
                } else {
                    console.warn('Item name not found');
                    app.toast.showToast('Please select an item.', 'warning');
                }
            });
        });

        applyDiscountButton.addEventListener('click', function () {
            const discountCode = document.getElementById('discountCode').value;
            if (discountCode) {
                console.log(`Applying discount code: ${discountCode}`);
                app.toast.showToast('Discount code applied successfully. You saved 20% on your order.', 'success');
            } else {
                console.warn('Discount code not entered');
                app.toast.showToast('Please enter a discount code.', 'warning');
            }
        });

        checkoutButton.addEventListener('click', function () {
            console.log('Checkout initiated');
            app.toast.showToast('Your order has been placed successfully. Order number: 123456.', 'success');
        });
    });
</script>
