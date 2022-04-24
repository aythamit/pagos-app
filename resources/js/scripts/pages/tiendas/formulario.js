$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Inicializamos el formulario
    const nameCrud = "tiendas";
    const userTipo = window.location.pathname.split('/')[1];

    const options = {
        prefix: `/${userTipo}`,
        goToEdit: false,
    };

    validateForm(`${nameCrud}-form`);
    initImageUpload('display_uploaded','image_uploaded','image_upload');
    initForm(nameCrud, options);
});
