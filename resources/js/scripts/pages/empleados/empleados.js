const tableClass = 'user-list-table';

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    'use strict';

    const nameCrud = "empleados";

    const columns = [
        // columns according to JSON RESPONSE
        { data: 'id' },//Este sólo aparece en la vista movil
        { data: 'id' },//Este es para el checkbox
        { data: 'imagen',className:'not-export-col'  },
        { data: 'nombre' },
        { data: 'apellidos' },
        { data: 'dni' },
        { data: 'email' },
        { data: 'telefono' },
        { data: 'tipo' },
        { data: 'id',className:'not-export-col'  },//Este es para las acciones
    ];

    const columnDefs = [
        {
            // For Responsive
            className: 'control',
            orderable: false,
            responsivePriority: 2,
            targets: 0
        },
        {
            // For Checkboxes
            targets: 1,
            orderable: false,
            responsivePriority: 3,
            render: function (data, type, full, meta) {
                return (
                    '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                    data +
                    '" /><label class="custom-control-label" for="checkbox' +
                    data +
                    '"></label></div>'
                );
            },
            checkboxes: {
                selectAllRender:
                    '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
            }
        },
        {
            // For Checkboxes
            targets: 2,
            orderable: false,
            responsivePriority: 3,
            render: function (data, type, full, meta) {
                if (data != null) {
                    return `<img height="80px" width="auto" src="${data}" alt="Ziegel Foto Empleado"/>`
                } else {
                    return `Sin imagen`
                }
                ;
            },
        },

        {
            // Actions
            targets: -1,
            title: 'Acciones',
            className: 'not-export-col',
            orderable: false,
            render: function (data, type, full, meta) {
                let verHTML = (full.permiso_leer) ? '<a href="javascript:void(0)" class="dropdown-item read-record" data-record="' + full.id + '">' +
                    feather.icons['eye'].toSvg({ class: 'font-small-4 mr-50' }) +
                    `${datatable.ver}</a>` : '';
                let editarHTML = (full.permiso_editar) ? `<a href="javascript:void(0)" class="dropdown-item edit-record" data-record="' + full.id + '">` +
                    feather.icons['archive'].toSvg({ class: 'font-small-4 mr-50' }) +
                    `${datatable.editar}</a>` : ''
                let borrarHTML = (full.permiso_borrar) ? '<a href="javascript:void(0)" class="dropdown-item delete-record" data-record="' + full.id + '">' +
                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                    `${datatable.borrar}</a>` : '';

                let textBloquear = (full.is_blocked) ? datatable.desbloquear : datatable.bloquear;

                let bloquearHTML = (full.permiso_editar) ? '<a href="javascript:void(0)" onclick="blockUser(' + full.id + ')" class="dropdown-item block-record" data-record="' + full.id + '">' +
                    feather.icons['alert-octagon'].toSvg({ class: 'font-small-4 mr-50' }) +
                    textBloquear + '</a>' : '';

                return (
                    '<div class="btn-group">' +
                    '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                    feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                    '</a>' +
                    '<div class="dropdown-menu dropdown-menu-right">' +
                    verHTML +
                    editarHTML +
                    bloquearHTML +
                    borrarHTML +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );
            }
        }
    ];

    const filtros = [
        {
            title: 'Nombre',
            column: 3,
            className: 'col-2 px-50',
            type: 'text',
        },
        {
            title: 'Apellidos',
            column: 4,
            className: 'col-2 px-50',
            type: 'text',
        },
        {
            title: 'DNI',
            column: 5,
            className: 'col-2 px-50',
            type: 'text',
        },
        {
            title: 'Correo electrónico',
            column: 6,
            className: 'col-2 px-50',
            type: 'text',
        },
        {
            title: 'Teléfono',
            column: 7,
            className: 'col-2 px-50',
            type: 'text',
        },
        {
            title: 'Tipo',
            column: 8,
            className: 'col-2 px-50',
            type: 'select',
            opcionesSelect: [
                {
                    text: 'Selecciona un tipo',
                    valor: '',
                },
                {
                    text: 'Admin',
                    valor: 'admin',
                },
                {
                    text: 'Agente',
                    valor: 'agente',
                }
            ]
        }
    ];
    /**
     * Opciones disponibles:
     * exportOptions => exportButtonPrint, exportButtonCSV, exportButtonExcel, exportButtonPdf, exportButtonCopy
     * domOptions => domRows, domSearch
     * acceptButton
     */
    const userTipo = $('#tipo').val();

    const options = {
        order: [2, 'asc'],
        exportOptions: {
            name: datatable.opciones,
            exportButtonPrint: { active: true, exportOptions: { columns: ":visible:not(.not-export-col)" } },
            exportButtonCSV: { active: true, exportOptions: { columns: ":visible:not(.not-export-col)" } },
            exportButtonExcel: { active: true, exportOptions: { columns: ":visible:not(.not-export-col)" } },
            exportButtonPdf: { active: true, exportOptions: { columns: ":visible:not(.not-export-col)" } },
            exportButtonCopy: { active: true, exportOptions: { columns: ":visible:not(.not-export-col)" } },
            exportButtonBorrar: { active: userTipo=='admin'? true : false, exportOptions: { columns: ":visible:not(.not-export-col)" } },

        },
        addButton: {
            active: true,
        },
        domOptions: {
            domRows: true,
            domSearch: true,
            domFiltros: true,
        },
        titleModal: {
            data: ['nombre', 'apellidos']
        },
        filtros: filtros,
        drawCallback: rowDrawCallback
    }

    // Inicializamos el datatable
    initDatatable(columns, columnDefs, nameCrud, tableClass, options);
    // Inicializamos el formulario
    //initForm(nameCrud, tableClass);

    //initCanvas('canvasFirma');
    //initFlatPicker('flatpickr-basic');
    // initSelectAgentes('users_id');
    // initDropzone('dpz-multiple-files', `/${nameCrud}/upload`);
    //initQuillEditor();
});

function rowDrawCallback(row, data) {
    // let blocked = data.is_blocked;
    // if (blocked) {
    //     $(row).addClass('bg-gris');
    // }
}

function blockUser(id) {
    let url = `/admin/empleados/block/${id}`
    let method = `post`;

    $('#spinner-loading').fadeIn();
    $.ajax({
        url: url,
        method: method,
    }).done(response => {
        console.log(response)
        Swal.fire({
            title: '¡Actualizado/a!',
            text: response.mensaje,
            confirmButtonClass: 'btn btn-primary',
            type: 'success',
            buttonsStyling: !1
        });
        let dataTable = $(`.${tableClass}`);
        dataTable.DataTable().draw();
    }).fail(error => {
        let errores = error.responseJSON.errors;
        let textoErrores = ``;
        $.each(errores, function (key, error) {
            $.each(error, function (key1, errorVal) {
                textoErrores += `${errorVal} <br>`
            })
            // $(`#${key}`).addClass('bg-danger')
        })
        Swal.fire({
            title: '¡Error!',
            html: textoErrores,
            type: 'error'
        })
    }).always(() => {
        $('#spinner-loading').fadeOut();
    })
}
