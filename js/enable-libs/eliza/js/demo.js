'use strict';

import elizaNotifications from './notifications.js';
import elizaActions from './actions.js';

const elizaDemo = new function () {

	var $sendTextBox = document.querySelector('.send-textbox');

	this.runDemo1 = () => {
		elizaNotifications.createInfoNotification("Starting demo 1...", 4);


		$sendTextBox.value = ('Hi it\'s nice to see you this afternoon.');
		elizaActions.getUserInput();

		setTimeout(function () {
			$sendTextBox.value = ('I had a really long week. It was a very stressful week at school.');
			elizaActions.getUserInput();
		}, 3000);
		setTimeout(function () {
			$sendTextBox.value = ('Yeah it was a lot of back to back assignments and tests. I had very little sleep because everything took so much time.');
			elizaActions.getUserInput();
		}, 6000);

	}
	this.runDemo2 = () => {
		elizaNotifications.createInfoNotification("Starting demo 2...", 4);


		$sendTextBox.value = ('Hi it\'s nice to see you this afternoon.');
		elizaActions.getUserInput();

		setTimeout(function () {
			$sendTextBox.value = ('I had a dream about my dog.');
			elizaActions.getUserInput();
		}, 3000);
		setTimeout(function () {
			$sendTextBox.value = ('I had a dream about my dog.');
			elizaActions.getUserInput();
		}, 6000);
		setTimeout(function () {
			$sendTextBox.value = ('I had a dream about my dog.');
			elizaActions.getUserInput();
		}, 9000);
		setTimeout(function () {
			$sendTextBox.value = ('I had a dream about my dog.');
			elizaActions.getUserInput();
		}, 12000);
		setTimeout(function () {
			$sendTextBox.value = ('I had a dream about my dog.');
			elizaActions.getUserInput();
		}, 15000);
		setTimeout(function () {
			$sendTextBox.value = ('I had a dream about my dog.');
			elizaActions.getUserInput();
		}, 18000);
		setTimeout(function () {
			$sendTextBox.value = ('I had a dream about my dog.');
			elizaActions.getUserInput();
		}, 21000);
		setTimeout(function () {
			$sendTextBox.value = ('I had a dream about my dog.');
			elizaActions.getUserInput();
		}, 23000);


	}
	function printResponses() {
		for (var word in responses) {
			if (responses.hasOwnProperty(word)) {
				console.log(word);
				for (var i = 0; i < responses[word].length; i++) {
					console.log("    " + responses[word][i]);
				}
			}
		}
	}
}

export default elizaDemo;