<!-- Modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="portform" method="post" action="">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_nameID">ID User</label>
                        <input type="text" class="form-control" name="id_user" id="id_nameID" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nameID">Nama</label>
                        <input type="text" class="form-control" name="name" id="nameID" placeholder="type name here">
                    </div>
                    <div class="form-group">
                        <label for="usernameID">Username</label>
                        <input type="text" class="form-control" name="username" id="usernameID"
                            placeholder="type username here">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- end of modal edit -->

<!-- Modal Pinjam -->
<div class="modal fade" id="pinjamModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Peminjaman barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPinjam" method="post" action="">
                <?= csrf_field() ?>
                <input type="hidden" name="id_barang" id="id_barang_pinjam">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah yang ingin dipinjam</label>
                        <input type="number" class="form-control" name="jumlah_pinjam" id="jumlah_barang" required
                            min="1" max="3" placeholder="Maksimal 3">
                    </div>
                    <div class="form-group">
                        <label>Kondisi Barang</label>
                        <div id="kondisi_display"></div>
                    </div>
                    <div class="form-group">
                        <label for="deadline_kembali">Deadline Pengembalian</label>
                        <input type="date" class="form-control" name="deadline_kembali" id="deadline_kembali" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Pinjam Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>