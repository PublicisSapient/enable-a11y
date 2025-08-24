'use strict';

const elizaNotifications = new function () {


	var $notificationArea = document.querySelector("#notification-area");
	var currentNotifications = [];


	/*
	 * Creates info notification so one color
	 */
	this.createInfoNotification = (message, seconds) => {
		createNotification(message, "info", seconds);
	}
	/*
	 * Creates error notification so one color
	 */
	function createNegativeNotification(message, seconds) {
		createNotification(message, "negative", seconds);
	}
	/*
	 * Creates positive notification so one color
	 */
	function createPositiveNotification(message, seconds) {
		createNotification(message, "positive", seconds);
	}
	/*
	 * Creates notification. It creates and stores the new
	 * object in the master list of them.
	 * Appends the html to the notification section
	 */
	function createNotification(message, type, seconds) {
		currentNotifications.push({ message: message, cyclesRemaining: seconds, type: type });
		var typeClass = "";
		var typeText = "";
		var html;

		if (type == "positive") {
			typeClass = "positive-notification";
			typeText = "dark-text";
		} else if (type == "negative") {
			typeClass = "negative-notification";
			typeText = "light-text";
		} else {
			typeClass = "info-notification";
			typeText = "dark-text";
		}

		html = '<div class="notification-wrapper ' + typeClass + '"><p class="notification-text ' + typeText + '">' + message + '</p></div>';

		$notificationArea.innerHTML += html;
	}
	/*
	 * Refresh notifications
	 * Subtracts the cycles (1 second a cycle), if 0
	 * hides the notification.
	 */
	function refershNotifications() {
		var html = '';
		for (var i = 0; i < currentNotifications.length; i++) {

			var typeClass = "";
			var typeText = "";

			if (currentNotifications[i].type == "positive") {
				typeClass = "positive-notification";
				typeText = "dark-text";
			} else if (currentNotifications[i].type == "negative") {
				typeClass = "negative-notification";
				typeText = "light-text";
			} else {
				typeClass = "info-notification";
				typeText = "dark-text";
			}

			var currentNotificationHTML = '<div class="notification-wrapper ' + typeClass + '"><p class="notification-text ' + typeText + '">' + currentNotifications[i].message + '</p></div>';





			if (currentNotifications[i].cyclesRemaining > 0) {
				// console.log(currentNotifications[i]);
				currentNotifications[i].cyclesRemaining--;
				html += currentNotificationHTML;
			}
		}

		$notificationArea.innerHTML = html;
	}


	/*
	 * Run on page shows

	setTimeout(() => {
		this.createInfoNotification("Run the demo by sending \"run demo1\"", 9);
	}, 1000);
	setTimeout(() => {
		this.createInfoNotification("Run the demo by sending \"run demo2\"", 9);
	}, 2000);
	setTimeout(() => {
		this.createInfoNotification("If you like this project, please go star it!", 6);
	}, 3000);
	 */
	/*
		* Checks every seconds
		*/
	setInterval(function () {
		for (var i = 0; i < currentNotifications.length; i++) {
			var currentNotification = currentNotifications[i];

			refershNotifications();
		}
	}, 1000);
}

export default elizaNotifications;