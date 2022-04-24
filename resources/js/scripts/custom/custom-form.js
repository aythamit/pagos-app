/**
 *  Funciones del formulario
 */

// Check Validity
function checkValidity(el) {
    if (el.validate().checkForm()) {
        submitBtn.attr('disabled', false);
    } else {
        submitBtn.attr('disabled', true);
    }
}

// To initialize flatpicker
function initFlatPicker(pickrClass, range = false) {
    let basicPickr = $('.' + pickrClass);

    if (basicPickr.length) {
        if (!range) {
            flatpicker = basicPickr.flatpickr({
                locale: 'es',
                altInput: true,
                altFormat: 'd/m/Y',
                dateFormat: 'Y-m-d'
            });
        } else {
            flatpicker = basicPickr.flatpickr({
                locale: 'es',
                mode: 'range',
                altInput: true,
                altFormat: 'd/m/Y',
                dateFormat: 'Y-m-d'

            });
        }
    }
}

// To initialize QuillEditor
function initQuillEditor() {
    // To initialize quill editor
    snowEditor = new Quill('#snow-container .editor', {
        bounds: '#snow-container .editor',
        modules: {
            formula: true,
            syntax: true,
            toolbar: '#snow-container .quill-toolbar'
        },
        theme: 'snow'
    });
}

// Validaciones del formulario
// Para que funcione solo hay que añadir data-required=true y data-message="texto" en el input
function validateForm(nameCrud, debugMode = false) {
    let form = $(`.${nameCrud}-form`);

    if (form.length) {
        const inputs = form.find('input:not([name="_token"]), select');
        let rules = {};
        let messages = {};

        inputs.each(function (i) {
            const input = $(this);
            const id = input.attr('id');
            let validateObject = getValidateObject(input);
            let ruleAux = validateObject.ruleAux;
            let messagesAux = validateObject.messagesAux;



            if (!jQuery.isEmptyObject(ruleAux)) {
                //Introducimos las reglas
                // RULE
                let rule = {
                    [id]: ruleAux,
                };
                Object.assign(rules, rule);

                // MESSAGE
                let message = {
                    [id]: messagesAux
                }
                Object.assign(messages, message)
            }

        });

        if (debugMode) {
            console.log('Rules:')
            console.log(rules);
            console.log('Messages:')
            console.log(messages);
        }

        form.validate({
            errorClass: 'error',
            rules: rules,
            messages: messages,
            errorPlacement: function (error, element) {
                if (element.parent().hasClass('input-group') || element.hasClass('select2') || element.attr('type') === 'checkbox') {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('custom-control-input')) {
                    error.insertAfter(element.parent().siblings(':last'));
                } else {
                    error.insertAfter(element);
                }

                if (element.parent().hasClass('input-group')) {
                    element.parent().addClass('is-invalid');
                }
            },
        });
    }
}

function addRuleValidateForm(input, formClass = null) {
    let validateObject = getValidateObject(input);
    let ruleAux = validateObject.ruleAux;
    let messagesAux = validateObject.messagesAux;

    let ruleObj = {}
    $.each(ruleAux, function (key, rule) {
        let ruleTemp = {
            [key]: rule,
        };
        Object.assign(ruleObj, ruleTemp);

    })
    ruleObj.messages = messagesAux;
    if (formClass != null) {
        $(`.${formClass}`).validate()
    }
    input.rules("add", ruleObj);
}

function getValidateObject(input) {
    let ruleAux = {}
    let messagesAux = {}
    const id = input.attr('id');
    if (typeof input.data('required') != 'undefined') {

        const msg = (input.data('required') == 0) ? `El campo ${id} es requerido.` : input.data('required');
        ruleAux['required'] = true;
        messagesAux['required'] = msg;

    }
    if (typeof input.data('email') != 'undefined') {

        const msg = (input.data('email') == 0) ? `El campo ${id} debe ser un email válido.` : input.data('email');
        ruleAux['email'] = true;
        messagesAux['email'] = msg;

    }
    if (typeof input.data('minlength') != 'undefined') {
        const minLength = input.data('minlength');
        const msg = (typeof input.data('minlength-message') == 'undefined' || input.data('minlength-message') == 0) ? `El campo ${id} debe tener mínimo ${minLength} caracteres.` : input.data('minlength-message');

        ruleAux['minlength'] = minLength;
        messagesAux['minlength'] = msg;
    }
    if (typeof input.data('min') != 'undefined') {
        const minLength = input.data('min');
        const msg = (typeof input.data('min-message') == 'undefined' || input.data('min-message') == 0) ? `El campo ${id} debe valer mínimo ${minLength}.` : input.data('min-message');

        ruleAux['min'] = minLength;
        messagesAux['min'] = msg;
    }

    if (typeof input.data('maxlength') != 'undefined') {
        const minLength = input.data('maxlength');
        const msg = (typeof input.data('maxlength-message') == 'undefined' || input.data('maxlength-message') == 0) ? `El campo ${id} debe tener máximo ${minLength} caracteres.` : input.data('maxlength-message');

        ruleAux['maxlength'] = minLength;
        messagesAux['maxlength'] = msg;
    }
    if (typeof input.data('max') != 'undefined') {
        const minLength = input.data('max');
        const msg = (typeof input.data('max-message') == 'undefined' || input.data('max-message') == 0) ? `El campo ${id} debe valer máximo ${minLength}.` : input.data('max-message');

        ruleAux['min'] = minLength;
        messagesAux['min'] = msg;
    }

    if (typeof input.data('equalto') != 'undefined') {
        const equalTo = input.data('equalto');
        const msg = (typeof input.data('equalto-message') == 'undefined' || input.data('equalto-message') == 0) ? `El campo ${id} debe coincidir con el campo ${equalTo}.` : input.data('equalto-message');
        ruleAux['equalTo'] = `#${equalTo}`;
        messagesAux['equalTo'] = msg;
    }

    return {
        ruleAux: ruleAux,
        messagesAux: messagesAux
    };
}

function initForm(nameCrud, options) {
    let form = $(`.${nameCrud}-form`),
        newBlogForm = $(`.add-new-${nameCrud}`),
        newUserSidebar = $(`.new-${nameCrud}-modal`);

    newBlogForm.on('hidden.bs.modal', () => {
        clearForm();
    });

    newUserSidebar.on('hidden.bs.modal', () => {
        clearForm();
    });

    // Delete

    form.on('submit', function (e) {
        e.preventDefault();

        let isValid = form.valid();

        if (isValid) {

            if (options.customValidation != undefined) {
                isValid = options.customValidation();
            }

            $('input:file').each(function (index) {
                const image_name = $(this).data('name');

                if ($(`#${image_name}_image_uploaded`).hasClass('image-upload-required') && ($(`#${image_name}_image_uploaded`).val() == null || $(`#${image_name}_image_uploaded`).val() == "")) {
                    const error = $(`#${image_name}_image_uploaded`).data('required-message');

                    Swal.fire({
                        title: '¡Error!',
                        text: error == "" ? 'Debe escoger una imagen para el campo ' + image_name : error,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });

                    isValid = false;
                }
            })

            if (typeof snowEditor !== 'undefined' && snowEditor.root.innerHTML == '<p><br></p>') {
                Swal.fire({
                    title: '¡Error!',
                    text: ' No ha ingresado contenido en el editor de texto',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });

                isValid = false;
            }

            if (isValid) {
                const id = form.data('record');

                if (id === undefined || id === null || id === '') {
                    sendForm();
                } else {
                    sendForm('/' + id);
                }
            }
        }
    });

    function sendForm(id = '') {
        $('#spinner-loading').fadeIn();
        let prefix = options.hasOwnProperty('prefix') ? options.prefix : '/admin',
        urlStore = `${prefix}/${nameCrud}/store`,
        data = new FormData(),
        form_data = form.serializeArray(),
        titulo = (typeof alerta != 'undefined') && alerta.hasOwnProperty('registro_guardado') ? alerta.registro_guardado : 'Registro guardado',
        text = (typeof alerta != 'undefined') && alerta.hasOwnProperty('registro_guardado_text') ? alerta.registro_guardado_text : 'El registro se ha guardado con éxito',
        confirm = (typeof alerta != 'undefined') && alerta.hasOwnProperty('aceptar') ? alerta.aceptar : 'Aceptar';

            $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        $.ajax({
            url: urlStore + id,
            method: id === '' ? 'POST' : 'PUT',
            data: form_data,
        }).done(response => {

            // Al crear un expediente, el ajax devuelve su id y redirigimos a su vista de editar /admin/expedientes/edit/id
            Swal.fire({
                icon: 'success',
                title: titulo,
                text: text,
                confirmButtonText: confirm,
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                // Si no existe la función de "No ir a editar" nos lleva a la pizarra del módulo
                if (!options.dontGoToEdit) {
                    // Si existe la opción de cerrar modal, simplemente cerramos el modal en vez de ir a otra página y recargamos la tabla
                    if (options.closeModal) {
                        $('#modals-slide-' + nameCrud).modal('hide');
                        $('#' + nameCrud + '-table').DataTable().ajax.reload();
                    } else {
                        if (result.isConfirmed && id === '') {
                            window.location.href = `${options.prefix}/${nameCrud}/edit/` + response[1];
                        } else if (result.isConfirmed && id !== '') {
                            window.location.href = `${options.prefix}/${nameCrud}/pizarra`;
                        }
                    }
                } else {
                    window.location.href = `${options.prefix}/${nameCrud}/pizarra`;
                }
            });
        }).fail(error => {
            customFormAjaxResponse(error);
        }).always(() => {
            $('#spinner-loading').fadeOut();
        })
    }

    validateForm(nameCrud);

    function clearForm() {
        form.find('input').each(function () {
            $(this).val('').attr('disabled', false).attr('readonly', false);
        })

        form.find("select").each(function () {
            $(this).val('').attr('disabled', false).attr('readonly', false);
        })

        form.find("textarea").each(function () {
            $(this).val('').attr('disabled', false).attr('readonly', false);
        })

        newBlogForm.data('record', null);
        newUserSidebar.data('record', null);
        form.data('record', null);

        if (typeof snowEditor !== 'undefined') {
            var delta = snowEditor.clipboard.convert('<p><br></p>');
            snowEditor.setContents(delta, 'silent');
        }

        $('input:file').each(function (index) {
            const image_name = $(this).data('name');

            $(`#${image_name}_display_uploaded`).attr('src', '/images/pages/upload.png');
            $(`#${image_name}_image_uploaded`).val();
        })
    }
}

function deleteFile(id, nameCrud) {
    $('#spinner-loading').fadeIn();

    $.ajax({
        url: '/admin/' + nameCrud + '/delete/' + id,
        method: 'DELETE',
    }).done(response => {
        Swal.fire({
            icon: 'success',
            title: 'Documento borrado',
            text: 'El registro se ha borrado con éxito',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false,
            allowEscapeKey: false
        });

    }).fail(error => {
        Swal.fire({
            title: '¡Error!',
            text: ' Ha ocurrido un error al borrar el documento',
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

function initImageUpload(idImg, idInputHidden, idFileUploaded, maxSize = 1) {
    // CARGA DE IMÁGENES
    $(`#${idImg}`).click(function () {
        $('#image_upload').click();
    });

    $(`#${idFileUploaded}`).on('change', function () {
        var reader = new FileReader();
        let size_kb = this.files[0].size / 1024;
        //let size_kb = 400;
        if (size_kb / 1000 <= maxSize) {
            reader.onload = function (e) {
                var old_base64 = e.target.result
                $(`#${idImg}`).attr('src', old_base64);
                $(`#${idInputHidden}`).val(old_base64);
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            Swal.fire({
                title: 'Error!',
                text: `The image may not weigh more than ${maxSize} MB. Weight of the current uploaded image: ` + (size_kb / 1000).toFixed(2) + ' MB approximately.',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        }
    });
}