function customFormAjaxResponse(errores) {
    let error =  (typeof alerta != 'undefined') && alerta.hasOwnProperty('error') ? alerta.error : '¡Error!';

    if (errores.responseJSON != null && errores.responseJSON != undefined) {
        if (errores.responseJSON.errors != null && errores.responseJSON.errors != undefined) {



            if (errores.responseJSON.errors.errores != null && errores.responseJSON.errors.errores != undefined) {
                let textoErrores = ``;

                $.each(errores.responseJSON.errors.errores, function (key, error) {
                    textoErrores += `${error} <br>`
                })

                Swal.fire({
                    title: error,
                    html: textoErrores,
                    icon: 'error',
                })
            } else {
                let textoErrores = ``;

                $.each(errores.responseJSON.errors, function (key, error) {
                    textoErrores += `${error} <br>`
                })

                Swal.fire({
                    title: error,
                    html: textoErrores,
                    icon: 'error',
                })
            }
        } else {
            if (errores.responseJSON[0] != undefined) {
                Swal.fire({
                    title: error,
                    text: errores.responseJSON[0],
                    icon: 'error',
                })
            } else {
                let ha_ocurrido_error =  (typeof alerta != 'undefined') && alerta.hasOwnProperty('ha_ocurrido_error') ? alerta.ha_ocurrido_error : 'Ha ocurrido un error inesperado';
                Swal.fire({
                    title: error,
                    text: ha_ocurrido_error,
                    icon: 'error',
                })
            }
        }
    } else {
        let ha_ocurrido_error =  (typeof alerta != 'undefined') && alerta.hasOwnProperty('ha_ocurrido_error') ? alerta.ha_ocurrido_error : 'Ha ocurrido un error inesperado';

        Swal.fire({
            title: error,
            text: ha_ocurrido_error,
            icon: 'error',
        })
    }
}

function standardAjaxResponse(title, text, url = null) {
    Swal.fire({
        title: title,
        text: text,
        confirmButtonClass: 'btn btn-primary',
        icon: 'success',
        buttonsStyling: !1
    }).then(function (value) {
        if (url != null) {
            window.location = url
        }
    });
}