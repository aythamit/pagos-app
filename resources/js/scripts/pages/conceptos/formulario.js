let inputFechaConcepto = $(`#fecha_pago_concepto`);
let formularioConcepto = $(`#conceptos-form`);


$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Inicializamos el formulario
    const nameCrud = "conceptos";
    const userTipo = window.location.pathname.split('/')[1];

    const options = {
        prefix: `/${userTipo}`,
        goToEdit: false,
    };

    initFlatPicker(inputFechaConcepto);
    validateForm(`${nameCrud}-form`);
    initForm(nameCrud, options);
});


