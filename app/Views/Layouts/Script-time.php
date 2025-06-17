<script>
    function updateWaktu() {
        const sekarang = new Date();

        const opsiTanggal = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };

        const opsiWaktu = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };

        const tanggalString = sekarang.toLocaleDateString('id-ID', opsiTanggal);
        let waktuString = sekarang.toLocaleTimeString('id-ID', opsiWaktu);

        waktuString = waktuString.replace(/\./g, ':');

        document.getElementById('tanggal-live').innerText = tanggalString;
        document.getElementById('jam-live').innerText = waktuString;
    }

    setInterval(updateWaktu, 1000);

    updateWaktu();
</script>