'use strict'

/*******************************************************************************
 * toast.js - UI for Accessible Toast Notifications
 * 
 * Written by Otto Wachter <github.com/vonwao>
 * Part of the Enable accessible component library.
 * Version 1.x released [Release Date]
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/toast.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

const toastModule = new function() {

  this.init = function() {
    this.rackContent = document.getElementById('rackContent');
    this.updateToggleRackButton();
  };

  this.Toast = class {
    constructor(options = {}) {
      this.container = this.createContainer(options.position || 'bottom-right');
      this.maxVisible = options.maxVisible || 1;
      this.toastQueue = [];
      this.visibleQueue = [];
      this.levels = options.levels || {};
      this.ariaLive = options.ariaLive || 'polite'; // Default to polite
      document.body.appendChild(this.container);

      // Initialize the toast rack
      this.rackContent = document.getElementById('rackContent');
      this.toggleRackButton = document.getElementById('toggleRackButton');
    }

    // Create the container for the toasts
    createContainer(position) {
      const container = document.createElement('div');
      container.className = `enable-toast__container enable-toast__container--${position}`;
      return container;
    }

    // Show a new toast notification
    showToast(message, level = 'normal') {
      const toastData = {
        message,
        level,
        id: Date.now() // unique id for each toast
      };
      this.toastQueue.push(toastData);
      this.visibleQueue.push(toastData);
      console.log("Toast added to queue and visibleQueue:", toastData);
      const toastElement = this.createToastElement(toastData);
      this.container.appendChild(toastElement);
      toastElement.offsetHeight; // Force reflow to ensure the element is rendered before adding the visible class

      setTimeout(() => {
        toastElement.classList.add('enable-toast__toast--visible');
      }, 100); // Slight delay to ensure screen readers catch the change

      // Update the toast rack with the new toast
      this.updateToastRack();
      this.updateVisibleToasts();
      this.updateToggleRackButton();
    }

    // Create the individual toast element
    createToastElement(toastData) {
      const { message, level, id } = toastData;
      const toast = document.createElement('div');
      toast.className = 'enable-toast__toast';
      toast.style.backgroundColor = this.levels[level]?.color || '#333';
      toast.setAttribute('tabindex', '-1');
      toast.setAttribute('aria-live', this.ariaLive);
      toast.setAttribute('role', 'alert');
      toast.setAttribute('data-id', id);

      const messageSpan = document.createElement('span');
      messageSpan.textContent = message;
      toast.appendChild(messageSpan);

      const closeButton = document.createElement('button');
      closeButton.className = 'enable-toast__close-button';
      closeButton.setAttribute('aria-label', 'close alert');
      closeButton.textContent = '✖';
      closeButton.addEventListener('click', () => {
        console.log("Close button clicked for toast:", message);
        this.dismissToast(toastData);
      });
      toast.appendChild(closeButton);

      return toast;
    }

    // Dismiss a toast notification
    dismissToast(toastData) {
      const toastElement = this.container.querySelector(`[data-id="${toastData.id}"]`);
      if (toastElement) {
        toastElement.classList.add('enable-toast__toast--exit');
        setTimeout(() => {
          toastElement.remove();
          this.visibleQueue = this.visibleQueue.filter(t => t.id !== toastData.id);
          this.updateVisibleToasts();
          this.updateToastRack();
          this.updateToggleRackButton();
        }, 500); // Match the CSS animation duration
      }
    }

    // Update the visible toasts according to the max visible limit
    updateVisibleToasts() {
      console.log("Updating visible toasts");

      // Remove excess toasts from the visibleQueue
      while (this.visibleQueue.length > this.maxVisible) {
        const toastToRemove = this.visibleQueue.shift();
        this.dismissToast(toastToRemove);
      }

      // Ensure only maxVisible toasts are displayed
      this.visibleQueue.forEach((toast, index) => {
        const toastElement = this.container.querySelector(`[data-id="${toast.id}"]`);
        if (index < this.maxVisible) {
          toastElement.classList.add('enable-toast__toast--visible');
        } else {
          toastElement.classList.remove('enable-toast__toast--visible');
        }
      });

      this.updateStatus();
    }

    // Update the status of the toasts
    updateStatus() {
      const totalVisible = this.visibleQueue.length;
      const totalNotifications = this.toastQueue.length;
      document.getElementById('status').textContent = `Total Visible: ${totalVisible}, Total Notifications: ${totalNotifications}`;
    }

    // Update the toast rack
    updateToastRack() {
      console.log("Updating toast rack");
      this.rackContent.innerHTML = '';
      this.toastQueue.forEach(toastData => {
        const { message, level, id } = toastData;
        const toastElement = document.createElement('div');
        toastElement.className = 'enable-toast__toast enable-toast__toast--visible';
        toastElement.style.backgroundColor = this.levels[level]?.color || '#333';
        toastElement.setAttribute('data-id', id);

        const messageSpan = document.createElement('span');
        messageSpan.textContent = message;
        toastElement.appendChild(messageSpan);

        console.log(`Appending toast to rack: ${message}`);
        this.rackContent.appendChild(toastElement);
      });
      const totalNotifications = this.toastQueue.length;
      console.log(`Toast rack updated with ${totalNotifications} toasts.`);
      this.rackContent.setAttribute('aria-live', 'assertive');
      document.getElementById('rackContentStatus').textContent = `Toast rack contains ${totalNotifications} toasts.`;
    }

    // Update the toggle rack button with the number of toasts
    updateToggleRackButton() {
      const totalNotifications = this.toastQueue.length;
      if (this.toggleRackButton) {
        this.toggleRackButton.textContent = `Toggle Toast Rack (${totalNotifications})`;
      }
    }

    // Clear all toasts
    clearAllToasts() {
      this.visibleQueue.forEach(toast => {
        const toastElement = this.container.querySelector(`[data-id="${toast.id}"]`);
        if (toastElement) {
          toastElement.remove();
        }
      });
      this.toastQueue = [];
      this.visibleQueue = [];
      console.log("All toasts cleared");
      this.updateStatus();
      this.updateToastRack();
      this.updateToggleRackButton();
    }
  }
};

