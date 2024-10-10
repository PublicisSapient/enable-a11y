// __tests__/toast.test.js
import { Toast } from '../js/modules/toast';

describe('Toast', () => {
    let toast;
    let mockContainer;

    beforeEach(() => {
        document.body.innerHTML =
            '<div id="rackContent"></div><button id="toggleRackButton"></button>';
        mockContainer = document.createElement('div');
        document.body.appendChild(mockContainer);
        toast = new Toast({ position: 'bottom-right', maxVisible: 2 });
    });

    afterEach(() => {
        document.body.innerHTML = '';
    });

    it('should create a toast container with the correct position', () => {
        const container = toast.createContainer('top-left');
        expect(container.className).toBe(
            'enable-toast__container enable-toast__container--top-left',
        );
    });

    it('should show a toast with the correct message and level', () => {
        toast.showToast('Test message', 'success');
        const toastElement = toast.container.querySelector(
            '.enable-toast__toast',
        );
        expect(toastElement).not.toBeNull();
        expect(toastElement.querySelector('span').textContent).toBe(
            'Test message',
        );
        expect(toastElement.style.backgroundColor).toBe('#28a745'); // success level color
    });

    it('should dismiss a toast when the close button is clicked', () => {
        toast.showToast('Test message', 'normal');
        const toastElement = toast.container.querySelector(
            '.enable-toast__toast',
        );
        toastElement.querySelector('.enable-toast__close-button').click();
        expect(
            toastElement.classList.contains('enable-toast__toast--exit'),
        ).toBe(true);
    });

    it('should update visible toasts correctly', () => {
        toast.showToast('Message 1', 'normal');
        toast.showToast('Message 2', 'normal');
        toast.showToast('Message 3', 'normal');
        expect(toast.visibleQueue.length).toBe(2); // maxVisible is 2
        expect(toast.toastQueue.length).toBe(3);
    });

    it('should toggle toast rack visibility', () => {
        const toggleRackButton = document.getElementById('toggleRackButton');
        const rack = document.getElementById('rackContent');
        rack.style.display = 'none';
        toggleRackButton.click();
        expect(rack.style.display).toBe('block');
        toggleRackButton.click();
        expect(rack.style.display).toBe('none');
    });
});
