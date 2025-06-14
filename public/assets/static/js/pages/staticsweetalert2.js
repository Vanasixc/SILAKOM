document.addEventListener('DOMContentLoaded', function() {
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