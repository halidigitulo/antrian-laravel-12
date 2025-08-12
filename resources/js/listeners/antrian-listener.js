export default function initAntrianListener() {
    if (!window.Echo) {
        console.error('Echo belum tersedia di antrian-listener');
        return;
    }

    window.Echo.channel('antrian-channel')
        .listen('.antrian-dipanggil', (e) => {
            console.log("Antrian diterima (module):", e);

            // dispatch custom event supaya Blade/DOM bisa tangani update UI
            window.dispatchEvent(new CustomEvent('antrian-dipanggil', { detail: e }));
        });
}
