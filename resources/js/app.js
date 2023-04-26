import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()


document.addEventListener('DOMContentLoaded', function () {
    const closeAlertButton = document.querySelector('.closealertbutton');
    if (closeAlertButton) {
        closeAlertButton.addEventListener('click', function () {
            this.parentElement.remove();
        });
    }
});
