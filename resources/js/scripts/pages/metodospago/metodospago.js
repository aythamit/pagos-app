$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Inicializamos los eventos
    initEvents();
});

function initEvents(){
    // Capturamos los switches
    $('.metodo-pago-switch').on('change', function (){

        $('#spinner-loading').fadeIn();
        $.ajax({
            url: '/admin/metodospago/cambiarestado',
            method: 'POST',
            data: {
                metodoId: $(this).data('id'),
                estado: $(this).prop('checked'),
            }
        }).done(response => {
            standardAjaxResponse(response.titulo, response.mensaje);
        }).fail(error => {
            customFormAjaxResponse(error);
        }).always(() => {
            $('#spinner-loading').fadeOut();
        })
    });

    $('#form-paypal').on('submit', function (e){
        e.preventDefault();
        saveConfig('paypal');
    })

    $('#form-tarjeta').on('submit', function (e){
        e.preventDefault();
        saveConfig('tarjeta');
    })
}

function saveConfig(tipo) {
    let formData = $(`#form-${tipo}`).serializeArray();
    console.log(formData);
    $('#spinner-loading').fadeIn();
    $.ajax({
        url:`/admin/metodospago/cambiar-configuracion/${tipo}`,
        method: 'POST',
        data: formData
    }).done(response => {
        standardAjaxResponse('Método actualizado', 'Se ha configurado correctamente el método de pago');
        $(`#modal-${tipo}`).modal('hide');
    }).fail(error => {
        customFormAjaxResponse(error);
    }).always(() => {
        $('#spinner-loading').fadeOut();
    })
}

function editarMetodo(id) {
    $('#spinner-loading').fadeIn();
    $.ajax({
        url:`/admin/metodospago/get-configuracion/${id}`,
        method: 'GET'
    }).done(response => {
        if(response !== null){
            for (const key in response) {
                $(`input[name="${key}"]`).val(response[key]);
            }
        }

    }).fail(error => {
        customFormAjaxResponse(error);
    }).always(() => {
        $('#spinner-loading').fadeOut();
    })
}
