(
    window.addEventListener('GuardarCambios', event => {
        let botonModal = document.getElementById(event.detail.id);
        if (botonModal) {
            botonModal.click();
        }
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 2000
        })
    })
);

(
    window.addEventListener('informacion', event => {
        let botonModal = document.getElementById(event.detail.id);
        if (botonModal) {
            botonModal.click();
        }
        Swal.fire({
            position: 'top-center',
            icon: event.detail.tipoMsj,
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 2000
        })
    })
);

