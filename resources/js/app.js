import './bootstrap';
import initAntrianListener from './listeners/antrian-listener';

document.addEventListener('DOMContentLoaded', () => {
    // jika Echo sudah ada langsung inisialisasi
    if (window.Echo) {
        initAntrianListener();
    } else {
        // tunggu sedikit (biasanya tidak perlu jika bootstrap di-bundle)
        const check = setInterval(() => {
            if (window.Echo) {
                clearInterval(check);
                initAntrianListener();
            }
        }, 100);
    }
});