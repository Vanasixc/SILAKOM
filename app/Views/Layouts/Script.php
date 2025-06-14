<script src="<?= base_url('assets/static/js/initTheme.js') ?>"></script>
<script src="<?= base_url('assets/static/js/components/dark.js') ?>"></script>
<script src="<?= base_url('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>


<script src="<?= base_url('assets/compiled/js/app.js') ?>"></script>

<script src="<?= base_url('assets/extensions/sweetalert2/sweetalert2.min.js') ?>"></script>>
<script src="<?= base_url('assets/static/js/pages/staticsweetalert2.js') ?>"></script>>


<?php
if ($title == 'Dashboard'): ?>
    <!-- Need: Apexcharts -->
    <script src="<?= base_url('assets/extensions/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/static/js/pages/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/static/js/components/tooltip.js') ?>"></script>

<?php elseif ($title == 'Barang' || $title == 'Manage Account'): ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <?= $this->include('layouts/script-table') ?>

<?php endif; ?>


</body>

</html>