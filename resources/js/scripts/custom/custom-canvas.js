/**
 *  Funciones del canvas para realizar firmas
 */

function initCanvas(canvasId){
    const canvas = $('#' + canvasId);

    initCanvasEvents(canvasId);

    // Si se abre ModalFirma se ajusta el backdrop para que se superponga a los modales ya abiertos
    /*$('#modalFirma').on('shown.bs.modal', function (e) {
        $('.modal-backdrop:last-child').css("z-index", "1055");
    });*/
}

function initCanvasEvents(canvasId) {
    ctx = document.getElementById(canvasId).getContext("2d");
    const canvas = $('#' + canvasId);

    canvas.mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    canvas.mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    canvas.mouseup(function (e) {
        mousePressed = false;
    });

    canvas.mouseleave(function (e) {
        mousePressed = false;
    });

    function Draw(x, y, isDown) {
        if (isDown) {
            ctx.beginPath();
            ctx.strokeStyle = $('#selColor').val();
            ctx.lineWidth = $('#selWidth').val();
            ctx.lineJoin = "round";
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(x, y);
            ctx.closePath();
            ctx.stroke();
        }
        lastX = x; lastY = y;
    }
}

function clearArea(canvasId) {
    ctx = document.getElementById(canvasId).getContext("2d");
    // Use the identity matrix while clearing the canvas
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}

let serviceId = '';
function saveFirma(canvasId, nameCrud){
    $('#spinner-loading').fadeIn();

    const canvas = $('#' + canvasId)[0];
    const image = canvas.toDataURL("image/png");
    const userTipo = $('#tipo').val() !== undefined ? $('#tipo').val() : 'admin'

    let data = new FormData();
    data.append('id', $('#firmaId').val());
    data.append(nameCrud + 'Id', serviceId);
    data.append('filename', $('#filename').val());
    data.append('img', image);

    $.ajax({
        url: `/${userTipo}/${nameCrud}/firmar`,
        contentType: false,
        processData: false,
        method: 'POST',
        data: data,
    }).done(response => {
        Swal.fire({
            icon: 'success',
            title: 'Archivo firmado',
            text: 'El registro se ha guardado con éxito',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false,
            allowEscapeKey: false
        })


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
            text: 'Ha ocurrido un error al firmar',
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

/**
 * Abre el modal de firmar documento, almacenando los datos que hacen falta y además refresca el datatable si se le pasa
 * */

function firmar(id, filename, crudId, datatableClass = null){
    console.log(id, filename, crudId);
    $('#modalFirma').modal('show');
    $('#firmaId').val(id);
    $('#filename').val(filename);
    serviceId = crudId;

    if(datatableClass !== null){
        $('#modalFirma').on('hidden.bs.modal', function (e) {
            $('.'+datatableClass).DataTable().ajax.reload();
        })
    }
}
