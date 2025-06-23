<?php if ($title == 'Manage Account'): ?>
    <script>
        //Show modal ketika button di klik
        $('#tableAkun tbody').on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $.ajax({
                url: `<?= base_url('auth/userdata/') ?>${id}`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        $('#id_nameID').val(data.id);
                        $('#nameID').val(data.name);
                        $('#usernameID').val(data.username);
                        $('#editModal form').attr('action', `<?= base_url('/auth/update/') ?>${data.id}`);
                        $('#editModal').modal('show');
                    } else {
                        alert('Data pengguna tidak ditemukan!');
                    }
                }
            });
        });
    </script>
    
<?php elseif ($title == 'List Barang'): ?>
    <script>
        // Event listener untuk tombol pinjam di tabel barang
        $('#tableBarang tbody').on('click', '.btn-pinjam', function () {

            const id_barang = $(this).data('id');
            const kode_barang = $(this).data('kode');
            const nama_barang = $(this).data('nama');
            const kondisi = $(this).data('kondisi');

            $('#pinjamModal #id_barang_pinjam').val(id_barang);
            $('#pinjamModal #kode_barang').val(kode_barang);
            $('#pinjamModal #nama_barang').val(nama_barang);

            let kondisiBadge = (kondisi === 'Baik')
                ? '<span class="badge bg-success fs-6">Baik</span>'
                : '<span class="badge bg-danger fs-6">Rusak</span>';
            $('#pinjamModal #kondisi_display').html(kondisiBadge);
            $('#pinjamModal #formPinjam').attr('action', `<?= base_url('dashboard/simpan') ?>`);
            $('#pinjamModal').modal('show');
        });
    </script>

<?php endif; ?>