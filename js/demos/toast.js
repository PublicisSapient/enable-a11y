'use strict';

import toastModule from '../modules/toast.js';

const app = new (function () {
    console.log('toast demo!!!');
    let toastIndex = 0;

    this.init = function () {
        this.toast = new toastModule.Toast({
            position: 'bottom-right',
            style: 'padding: 10px; border-radius: 5px;',
            alertArea: true,
            maxVisible: 2,
            levels: {
                normal: { color: '#007bff' },
                error: { color: '#dc3545' },
                warning: { color: '#ffc107' },
                success: { color: '#28a745' },
            },
            ariaLive: 'polite', // Default aria-live value
        });

        this.attachEventListeners();
    };

    this.attachEventListeners = function () {
        document
            .getElementById('showToastButton')
            .addEventListener('click', this.showToastButtonClickEvent);
        document
            .getElementById('clearAllButton')
            .addEventListener('click', this.clearAllButtonClickEvent);
        document
            .getElementById('toggleRackButton')
            .addEventListener('click', this.toggleRackButtonClickEvent);

        document.querySelectorAll('input[name="position"]').forEach((radio) => {
            radio.addEventListener('change', this.positionChangeEvent);
        });
    };

    this.showToastButtonClickEvent = (e) => {
        const message = document.getElementById('messageInput').value;
        const level = document.querySelector(
            'input[name="level"]:checked',
        ).value;
        const ariaLive = document.querySelector(
            'input[name="ariaLive"]:checked',
        ).value;
        this.toast.ariaLive = ariaLive; // Set aria-live value
        toastIndex++;
        const fullMessage = `Toast ${toastIndex}: ${message}`;
        try {
            this.toast.showToast(fullMessage, level);
        } catch (error) {
            console.error('Error showing toast:', error);
        }
        this.updateStatus();
    };

    this.clearAllButtonClickEvent = (e) => {
        try {
            this.toast.clearAllToasts();
        } catch (error) {
            console.error('Error clearing toasts:', error);
        }
        this.updateStatus();
    };

    this.toggleRackButtonClickEvent = (e) => {
        const rack = document.getElementById('toastRack');
        if (rack.style.display === 'block') {
            rack.style.display = 'none';
        } else {
            rack.style.display = 'block';
        }
        console.log(
            `Toast rack ${rack.style.display === 'block' ? 'shown' : 'hidden'}`,
        );
    };

    this.positionChangeEvent = (e) => {
        try {
            this.toast.container.className = `enable-toast__container enable-toast__container--${e.target.value}`;
        } catch (error) {
            console.error('Error changing toast position:', error);
        }
    };

    this.updateStatus = function () {
        const totalVisible = this.toast.visibleQueue.length;
        const totalNotifications = this.toast.toastQueue.length;
        document.getElementById('status').textContent =
            `Visible: ${totalVisible}, Total: ${totalNotifications}`;
        document.getElementById('rackContentStatus').textContent =
            `Toast rack contains ${totalNotifications} toasts.`;
    };
})();

export default app;
