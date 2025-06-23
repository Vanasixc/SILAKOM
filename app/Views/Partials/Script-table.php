<script>
    // table manajemen akun
    $(document).ready(function () {
        if ($('#tableAkun').length) {
            $('#tableAkun').DataTable({
                "processing": true,
                "serverSide": true,
                responsive: true,
                "ajax": {
                    "url": "<?= base_url('dashboard/tableaccount') ?>",
                    "type": "POST",
                    "data": function (d) {
                        d['<?= csrf_token() ?>'] = "<?= csrf_hash() ?>";
                    }
                },
                "columns": [
                    { "data": "no", "className": "text-center", "orderable": false, "searchable": false },
                    { "data": "name", "className": "text-center" },
                    { "data": "username", "className": "text-center" },
                    { "data": "role", "className": "text-center " },
                    { "data": "status", "className": "text-center" },
                    { "data": "last_login", "className": "text-center" },
                    { "data": "action", "className": "text-center", "orderable": false, "searchable": false }
                ],
                "order": [[1, 'asc']]
            });
        }

        // Table list barang
        if ($('#tableBarang').length) {
            $('#tableBarang').DataTable({
                "processing": true,
                "serverSide": true,
                responsive: true,
                "ajax": {
                    "url": "<?= base_url('dashboard/tablelistbarang') ?>", // Mengarah ke Rute yang dibuat
                    "type": "POST",
                    "data": function (d) {
                        d['<?= csrf_token() ?>'] = "<?= csrf_hash() ?>";
                    }
                },
                "columns": [
                    // Kolom harus sesuai dengan data yang dikirim dari controller
                    { "data": "no", "orderable": false, "searchable": false, "className": "text-center" }, // dari addNumbering()
                    { "data": "foto_barang", "orderable": false, "searchable": false, "className": "text-center" }, // dari kolom foto_barang
                    { "data": "kode_barang", "className": "text-center" }, // dari kolom kode_barang
                    { "data": "nama_barang", "className": "text-center" }, // dari kolom nama_barang
                    { "data": "nama_kategori", "className": "text-center" }, // dari JOIN dengan tabel kategori
                    { "data": "stok", "orderable": false, "searchable": false, "className": "text-center" }, // dari ->add('stok',...)
                    { "data": "kondisi", "className": "text-center" }, // dari kolom kondisi
                    { "data": "action", "orderable": false, "searchable": false, "className": "text-center" } // dari ->add('action',...)
                ],
                "order": [[3, 'asc']] // Default sorting berdasarkan nama barang (indeks kolom ke-3)
            });
        }

        // Table dashboard user
        if ($('#tablePinjam').length) {
            $('#tablePinjam').DataTable({
                "processing": true,
                "serverSide": true,
                responsive: true,
                "language": {
                    "emptyTable": "Tidak ada barang yang sedang Anda pinjam.",
                },
                "ajax": {
                    "url": "<?= base_url('dashboard/tablepinjam') ?>", // Mengarah ke Rute baru
                    "type": "POST",
                    "data": function (d) {
                        d['<?= csrf_token() ?>'] = "<?= csrf_hash() ?>";
                    }
                },
                "columns": [
                    { "data": "no", "orderable": false },
                    { "data": "foto_barang", "orderable": false },
                    { "data": "nama_barang" },
                    { "data": "jumlah_pinjam" },
                    { "data": "tanggal_pinjam" },
                    { "data": "deadline_kembali" },
                    { "data": "tanggal_dikembalikan" },
                    { "data": "status_final", "orderable": false }
                ],
                "order": [[4, 'desc']] 
            });
        }
    });
</script>