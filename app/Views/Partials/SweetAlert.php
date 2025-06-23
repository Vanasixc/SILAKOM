<script>
    document.addEventListener('DOMContentLoaded', function () {
        const body = document.body;
        const successMessage = body.dataset.success;
        const errMassage = body.dataset.error;
        const warningMassage = body.dataset.warning;
        const infoMassage = body.dataset.info;
        const questionMassage = body.dataset.question;

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: successMessage,
                showConfirmButton: false,
                timer: 2500
            });
        }

        if (errMassage) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: errMassage
            });
        }

        if (warningMassage) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: warningMassage
            });
        }

        if (infoMassage) {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: infoMassage
            });
        }

        if (questionMassage) {
            Swal.fire({
                icon: 'question',
                title: 'Oops...',
                text: questionMassage
            });
        }
    });

    $('#tableAkun tbody').on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');

        Swal.fire({
            title: 'Delete Account',
            text: `Anda yakin menghapus akun milik "${name}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = $('<form>', {
                    'method': 'POST',
                    'action': `<?= base_url('dashboard/deleteaccount/') ?>${id}`
                }).append(
                    $('<input>', {
                        'type': 'hidden',
                        'name': '<?= csrf_token() ?>',
                        'value': '<?= csrf_hash() ?>'
                    })
                );
                $('body').append(form);
                form.submit();
            }
        })
    });
</script>