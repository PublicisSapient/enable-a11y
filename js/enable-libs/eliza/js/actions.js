'use strict';

import eliza from './eliza.js';
import elizaDemo from './demo.js';
import { interpolate } from '/js/modules/interpolate.js';

const elizaActions = new function () {
	const $sendTextBox = document.querySelector('.send-textbox');
	const $chatArea = document.querySelector('#chat-area');
	const $srAnnounce = document.querySelector('#sr-announce');
	const userMessageTemplate = document.getElementById('user-message-template').innerHTML;
	const elizaMessageTemplate = document.getElementById('eliza-message-template').innerHTML;
	const screenReaderMessageTemplate = document.getElementById('screen-reader-message-template').innerHTML;
	let $activeMessage = null;
	let activeMessageIndex = -1;

	/*
	 * Watches for enter key to be pressed
	 */
	$sendTextBox.addEventListener('keyup', (e) => {
		switch (e.key) {
			case "Enter":
				this.getUserInput();
				break;
			case "ArrowUp":
				focusPrevMessage();
				break;
			case "ArrowDown":
				focusNextMessage();
				break;
			default:
				unfocusMessages();
				break;
		}
	});
	
	$sendTextBox.addEventListener('blur', (e) => {
		unfocusMessages();
	});

	function focusPrevMessage() {
		console.log('prev');
		const $messageWrappers = document.querySelectorAll('#chat-area .chat-message-outter-wrapper');
		if ($activeMessage === null || activeMessageIndex === 0) {
			activeMessageIndex = $messageWrappers.length - 1;
		} else {
			activeMessageIndex = activeMessageIndex - 1;
		}
		$activeMessage = $messageWrappers[activeMessageIndex];
		highlightActive($messageWrappers);
	}

	function focusNextMessage() {
		console.log('next');

		const $messageWrappers = document.querySelectorAll('#chat-area .chat-message-outter-wrapper');
		if ($activeMessage === null || activeMessageIndex === $messageWrappers.length - 1) {
			activeMessageIndex = 0;
		} else {
			activeMessageIndex = activeMessageIndex + 1;
		}
		$activeMessage = $messageWrappers[activeMessageIndex];
		highlightActive($messageWrappers);
	}

	function unfocusMessages() {
		const $messageWrappers = document.querySelectorAll('#chat-area .chat-message-outter-wrapper');
		activeMessageIndex = -1;
		$activeMessage = null;
		highlightActive($messageWrappers);
	}

	function highlightActive($messageWrappers) {
		const highlightClass = 'chat-message__highlight';
		$messageWrappers.forEach((el, i) => {
			if (i === activeMessageIndex) {
				el.classList.add(highlightClass);
				$srAnnounce.innerHTML = el.innerHTML;
			} else {
				el.classList.remove(highlightClass)
			}
		});

	}


	/*
	 * Takes the content out of the textbox,
	 * error checks, and checks for demos.
	 */
	this.getUserInput = () => {
		console.log('input');
		var inputFromUser = $sendTextBox.value;

		if (inputFromUser == null || inputFromUser != null && inputFromUser.length == 0) {
			error("Error: Input cannot be blank");
		} else if (inputFromUser == "run demo1") {
			elizaDemo.runDemo1();
			this.clearSendTextbox();
		} else if (inputFromUser == "run demo2") {
			elizaDemo.runDemo2();
			this.clearSendTextbox();
		} else {
			eliza.sendElizaNewMessage(inputFromUser);
		}
	}
	/*
	 * Shows error using notifications
	 */
	function error(message) {
		//console.log(message);
		createNegativeNotification(message, 9);
	}
	/*
	 * Refreshes the HTML based on the 
	 * chat history array which is a list
	 * of chat messages sent from the user
	 * and eliza.
	 */
	this.displayChat = (eliza) => {
		const { chatHistory, startChat } = eliza;
		console.log('eliza', eliza);
		let html, srAnnouncement;
		if (chatHistory.length == 0) {
			startChat();
		} else {
			for (var i = 0; i < chatHistory.length; i++) {

				var currentMessage = chatHistory[i];
				console.log("ping", currentMessage);

				if (currentMessage.isEliza) {
					const {content, buttons} = currentMessage;
					let buttonHTML = '';

					if (buttons && buttons.length && buttons.length > 0) {
						buttonHTML = getButtonHTML(buttons);
					}
					console.log('content', currentMessage.content)
					html = getElizaMessageHTML(currentMessage.content) + buttonHTML;
					srAnnouncement = getMessageAlert('Eliza', currentMessage.content);
				} else {
					html = getUserMessageHTML(currentMessage.content);
					srAnnouncement = getMessageAlert('You', currentMessage.content);
				}
			}

			$chatArea.innerHTML += html;
			$chatArea.scrollTop += $chatArea.scrollHeight;

			$srAnnounce.innerHTML = srAnnouncement;
		}
		document.body.scrollTop = document.body.scrollHeight;
		//console.log($('#body')[0].scrollHeight);
	}
	/*
	 * HTML for Eliza's message
	 */
	function getElizaMessageHTML(message) {
		const d = new Date();
		const t = d.toLocaleTimeString();
		return interpolate(
			elizaMessageTemplate,
			{
				time: t,
				message
			}
		);
	}
	/*
	 * HTML for User's message
	 */
	function getUserMessageHTML(message) {
		const d = new Date();
		const t = d.toLocaleTimeString();
		return interpolate(
			userMessageTemplate,
			{
				time: t,
				message
			}
		);
	}

	function getButtonHTML(buttons) {
		const r = [];
		const length = {buttons};

		

		for (let i=0; i<length; i++) {
			r.push(
				interpolate(
					buttonTemplate,
					{
						label: buttons[i]
					}
				)
			);
		}
		if (length > 0) {
			return `<div class="eliza__button-list">${r.join('')}</div>`;
		} else {
			return '';
		}
	}

	function getMessageAlert(user, message) {
		return interpolate(
			screenReaderMessageTemplate,
			{
				user,
				message
			}
		)
	}

	/*
	 * Empty user send textbox
	 */
	this.clearSendTextbox = () => {
		$sendTextBox.value = '';
	}

	/*
	 * Starts by displaying the chat
	 */

	this.init = (eliza) => {
		this.displayChat(eliza);
	}
}

export default elizaActions;