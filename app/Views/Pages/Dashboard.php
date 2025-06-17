<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="welcome-card">
    <div class="welcome-card-icon-area">
        <i class="bi bi-person-check-fill"></i>
    </div>
    <div class="welcome-card-content text-center">
        <h2 class="fw-bold">Welcome, <?= session()->get('name') ?>!</h2>
        <p class="lead" style="font-size: 1.1rem;">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit deserunt suscipit neque tenetur sunt tempora?
        </p>
        <hr class="my-3">
        <div id="waktu-sekarang">
            <div id="tanggal-live"></div>
            <div id="jam-live"></div>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                List barang yang anda pinjam
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tablepinjam">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Deadline</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>