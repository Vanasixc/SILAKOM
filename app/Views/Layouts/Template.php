<!-- Head -->
<?= $this->include('layouts/head');?>

<!-- Sidebar -->
<?php
if ($title != 'Login' && $title != 'Register') {
    echo $this->include('layouts/sidebar');
}
?>

<!-- Isi Content -->
<?= $this->renderSection('content'); ?>

<!-- Footer -->
<?php
if ($title != 'Login' && $title != 'Register') {
    echo $this->include('layouts/footer');
}
?>

<!-- script -->
<?= $this->include('layouts/script') ?>
