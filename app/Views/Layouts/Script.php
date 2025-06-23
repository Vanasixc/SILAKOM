<script src="<?= base_url('assets/static/js/initTheme.js') ?>"></script>
<script src="<?= base_url('assets/static/js/components/dark.js') ?>"></script>
<script src="<?= base_url('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>


<script src="<?= base_url('assets/compiled/js/app.js') ?>"></script>

<script src="<?= base_url('assets/extensions/sweetalert2/sweetalert2.min.js') ?>"></script>


<?php if ($title == 'Dashboard Admin'): ?>

    <script src="<?= base_url('assets/extensions/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/static/js/pages/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/static/js/components/tooltip.js') ?>"></script>


<?php elseif ($title == 'List Barang' || $title == 'Manage Account' || $title == 'Dashboard'): ?>
    <?php if ($title == 'Dashboard'): ?>
        <?= $this->include('partials/script-time') ?>
        <script src="<?= base_url('assets/static/js/pages/dashboard.js') ?>"></script>
        <script src="<?= base_url('assets/static/js/components/tooltip.js') ?>"></script>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

    <?= $this->include('partials/script-table') ?>
    <?= $this->include('partials/event-listener') ?>

<?php endif; ?>

<?= $this->include('partials/sweetAlert') ?>

</body>

</html>