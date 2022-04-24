/**
 *  Funciones del Dropzone
 */

let dropzoneFiles = [];

function initDropzone(formId, url){
    var multipleFiles = $('#'+ formId);

    Dropzone.options.dpzMultipleFiles = {
        autoProcessQueue: false,
        init: function() {
            this.on("addedfile", function(file) {
                console.log(this.files);
                dropzoneFiles = [];
                this.files.forEach(function (e) {
                    dropzoneFiles.push(e);
                });

                $(".dz-progress").remove();
                //$('#files').val(this.files)
            });
        }
    };

    // Multiple Files
    multipleFiles.dropzone({
        paramName: 'file', // The name that will be used to transfer the file
        maxFilesize: 3, // MB
        clickable: true,
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar',
        url: url,
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
    });
}

function getBase64(file, onLoadCallback) {
    return new Promise(function(resolve, reject) {
        var reader = new FileReader();
        reader.onload = function() { resolve(reader.result); };
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}

function uploadFiles(nameCrud, id, datatableClass = ''){
    $('#spinner-loading').fadeIn();

    let data = new FormData();
    // Files data
    $.each(dropzoneFiles, function (key, file) {
        data.append("file"+key, dropzoneFiles[key]);
    });

    data.append('id', id);

    $.ajax({
        url: `/admin/${nameCrud}/upload`,
        method: 'POST',
        contentType: false,
        processData: false,
        data: data,
    }).done(response => {
        Swal.fire({
            icon: 'success',
            title: 'Documento almacenado',
            text: 'El documento se ha subido con éxito',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                $('.'+datatableClass).DataTable().ajax.reload();
                Dropzone.forElement('.dropzone').removeAllFiles(true);
            }
        });



    }).fail(error => {
        let mensajes = '';
        if (error.responseJSON.errores) {
            let errores = error.responseJSON.errores;
            for (const key in errores) {
                for (let i = 0; i < errores[key].length; i++) {
                    mensajes = mensajes + `<p>${errores[key][i]}</p>`
                }
            }
        }
        Swal.fire({
            title: '¡Error!',
            text: ' Ha ocurrido un error al subir los documentos',
            icon: 'error',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
        console.error(error)
    }).always(() => {
        $('#spinner-loading').fadeOut();
    })
}