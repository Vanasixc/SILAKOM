<script>
    $(document).ready(function () {
        $('#tableAkun').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                // Kode PHP ini sekarang akan diproses dengan benar
                "url": "<?= base_url('account_table/datatable') ?>",
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
    });
</script>