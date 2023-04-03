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

(
    window.addEventListener('RegistroExito', event => {
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: event.detail.mensaje,
            showConfirmButton: false,
            timer: 2500
        })
    })
);

Livewire.on('abrirModal', function () {
    $('#mi-modal').modal('show');
    console.log('hola');
});

(
    window.addEventListener('abrirModal', event => {
        console.log('hola');
        var modal = document.getElementById("btn-modal");
        if (modal) {
            modal.click();
        }
    })
);

