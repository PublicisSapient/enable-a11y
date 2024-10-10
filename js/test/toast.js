// __tests__/toast.test.js
import { Toast } from '../js/modules/toast';

describe('Toast Module', () => {
    let toast;
    let container;

    beforeEach(() => {
        document.body.innerHTML =
            '<div id="rackContent"></div><button id="toggleRackButton"></button>';
        container = document.createElement('div');
        container.id = 'toastContainer';
        document.body.appendChild(container);

        toast = new Toast({
            position: 'bottom-right',
            maxVisible: 3,
            levels: {
                normal: { color: '#007bff' },
                error: { color: '#dc3545' },
                warning: { color: '#ffc107' },
                success: { color: '#28a745' },
            },
        });
    });

    afterEach(() => {
        document.body.innerHTML = '';
    });

    it('should create a container with correct position', () => {
        expect(
            toast.container.classList.contains(
                'enable-toast__container--bottom-right',
            ),
        ).toBe(true);
    });

    it('should display a toast message with correct level', () => {
        toast.showToast('This is a normal toast', 'normal');
        const toastElement = toast.container.querySelector(
            '.enable-toast__toast',
        );
        expect(toastElement).not.toBeNull();
        expect(toastElement.style.backgroundColor).toBe('#007bff');
        expect(
            toastElement.textContent.includes('This is a normal toast'),
        ).toBe(true);
    });

    it('should display multiple toasts up to maxVisible limit', () => {
        toast.showToast('Toast 1', 'normal');
        toast.showToast('Toast 2', 'success');
        toast.showToast('Toast 3', 'warning');
        toast.showToast('Toast 4', 'error');

        const visibleToasts = toast.container.querySelectorAll(
            '.enable-toast__toast--visible',
        );
        expect(visibleToasts.length).toBe(3);
        expect(visibleToasts[0].textContent.includes('Toast 2')).toBe(true);
        expect(visibleToasts[1].textContent.includes('Toast 3')).toBe(true);
        expect(visibleToasts[2].textContent.includes('Toast 4')).toBe(true);
    });

    it('should remove toast from DOM when dismissed', () => {
        toast.showToast('Dismiss me', 'normal');
        const toastElement = toast.container.querySelector(
            '.enable-toast__toast',
        );
        const closeButton = toastElement.querySelector(
            '.enable-toast__close-button',
        );

        closeButton.click();

        setTimeout(() => {
            expect(toastElement.parentNode).toBeNull();
        }, 500);
    });

    it('should update aria-live attribute when specified', () => {
        toast.ariaLive = 'assertive';
        toast.showToast('Assertive toast', 'normal');
        const toastElement = toast.container.querySelector(
            '.enable-toast__toast',
        );
        expect(toastElement.getAttribute('aria-live')).toBe('assertive');
    });

    it('should add and remove toasts from rack correctly', () => {
        toast.showToast('Toast in rack', 'normal');
        const rackContent = document.getElementById('rackContent');
        const rackToasts = rackContent.querySelectorAll('.enable-toast__toast');
        expect(rackToasts.length).toBe(1);

        toast.dismissToast(toast.toastQueue[0]);
        setTimeout(() => {
            expect(
                rackContent.querySelectorAll('.enable-toast__toast').length,
            ).toBe(0);
        }, 500);
    });

    it('should toggle the toast rack visibility', () => {
        const toggleRackButton = document.getElementById('toggleRackButton');
        const rack = document.getElementById('toastRack');

        toggleRackButton.click();
        expect(rack.style.display).toBe('block');

        toggleRackButton.click();
        expect(rack.style.display).toBe('none');
    });

    it('should handle keyboard navigation for dismissing toasts', () => {
        toast.showToast('Keyboard dismiss', 'normal');
        const toastElement = toast.container.querySelector(
            '.enable-toast__toast',
        );
        toastElement.focus();
        const event = new KeyboardEvent('keydown', { key: 'Escape' });
        toastElement.dispatchEvent(event);

        setTimeout(() => {
            expect(
                toastElement.classList.contains('enable-toast__toast--exit'),
            ).toBe(true);
        }, 500);
    });
});
