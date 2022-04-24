const tableClass = 'user-list-table';

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    'use strict';

    const nameCrud = "tiendas";

    const columns = [
        // columns according to JSON RESPONSE
        {data: 'id'},//Este sólo aparece en la vista movil
        {data: 'id'},//Este es para el checkbox
        {data: 'imagen', className: 'not-export-col'},
        {data: 'nombre'},
        {data: 'nombre_legal'},
        {data: 'cif'},
        {data: 'email'},
        {data: 'telefono'},
        {data: 'url'},
        {data: 'created_at'},
        {data: 'id', className: 'not-export-col'},//Este es para las acciones
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
                    '<div class="form-check form-check-primary custom-checkbox"> <input class="form-check-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                    data +
                    '" /><label class="custom-control-label" for="checkbox' +
                    data +
                    '"></label></div>'
                );
            },
            checkboxes: {
                selectAllRender:
                    '<div class="form-check form-check-primary custom-checkbox"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
            }
        },
        {
            // Imagen
            targets: 2,
            orderable: false,
            responsivePriority: 3,
            render: function (data, type, full, meta) {
                if (data != null) {
                    return `<img height="80px" width="auto" src="${data}" alt="Imagen empleado"/>`
                } else {
                    return `Sin imagen`;
                }
            },
        },

        {
            // Actions
            targets: -1,
            className: 'not-export-col',
            orderable: false,
            render: function (data, type, full, meta) {
                let html = ``;

                if (full.permiso_leer) {
                    html += `<a href="javascript:void(0)" class="dropdown-item read-record" data-record="${full.id}">
                ${feather.icons['eye'].toSvg({class: 'font-small-4 me-50'})} ${datatable.ver}</a>`;
                }

                if (full.permiso_editar) {
                    html += `<a href="javascript:void(0)" class="dropdown-item edit-record" data-record="${full.id}">
                ${feather.icons['archive'].toSvg({class: 'font-small-4 me-50'})} ${datatable.editar}</a>`;
                }

                if (full.permiso_borrar) {
                    html += `<a href="javascript:void(0)" class="dropdown-item delete-record" data-record="${full.id}">
                ${feather.icons['trash-2'].toSvg({class: 'font-small-4 me-50'})} ${datatable.borrar}</a>`
                }

                let textBloquear = (full.is_blocked) ? datatable.desbloquear : datatable.bloquear;

                if (full.permiso_editar) {
                    html += `<a href="javascript:void(0)" onclick="blockUser('${full.id}', '${full.is_blocked}')" class="dropdown-item block-record" data-record="${full.id}">
                ${feather.icons['alert-octagon'].toSvg({class: 'font-small-4 me-50'})} ${textBloquear}</a>`;
                }

                if(html === '') return '';
                return (
                    `<div class="btn-group">
                    <a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    ${feather.icons['more-vertical'].toSvg({class: 'font-small-4'})}
                    </a>
                <div class="dropdown-menu dropdown-menu-right">
                ${html}
                </div></div></div>`
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
            title: 'URL',
            column: 8,
            className: 'col-2 px-50',
            type: 'text',
        },
        {
            title: 'Fecha creación',
            column: 9,
            className: 'col-2 px-50',
            type: 'flatpickr',
        },
    ];
    /**
     * Opciones disponibles:
     * exportOptions => exportButtonPrint, exportButtonCSV, exportButtonExcel, exportButtonPdf, exportButtonCopy
     * domOptions => domRows, domSearch
     * acceptButton
     */
    const userTipo = $('#tipo').val();

    const options = {
        order: [3, 'asc'],
        exportOptions: {
            exportButtonPrint: {active: true, exportOptions: {columns: ":visible:not(.not-export-col)"}},
            exportButtonCSV: {active: true, exportOptions: {columns: ":visible:not(.not-export-col)"}},
            exportButtonExcel: {active: true, exportOptions: {columns: ":visible:not(.not-export-col)"}},
            exportButtonPdf: {active: true, exportOptions: {columns: ":visible:not(.not-export-col)"}},
            exportButtonCopy: {active: true, exportOptions: {columns: ":visible:not(.not-export-col)"}},
            exportButtonBorrar: {
                active: true,
                exportOptions: {columns: ":visible:not(.not-export-col)"}
            },

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
        rowCallback: rowDrawCallback
    }

    // Inicializamos el datatable
    initDatatable(columns, columnDefs, nameCrud, tableClass, options);
});

function rowDrawCallback(row, data, index) {
    let blocked = data.is_blocked;
    if (blocked) {
        $(row).addClass('bg-cancelado');
    }
}

function blockUser(id, estadoActual) {
    let url = `/admin/tiendas/block/${id}`

    $('#spinner-loading').fadeIn();
    $.ajax({
        url: url,
        method: 'post',
        data:{
            id: id,
            estado: estadoActual
        }
    }).done(response => {
        standardAjaxResponse('¡Actualizado/a!', response.mensaje, null, 'success')
        let dataTable = $(`.${tableClass}`);
        dataTable.DataTable().ajax.reload();
    }).fail(error => {
        customFormAjaxResponse(error);
    }).always(() => {
        $('#spinner-loading').fadeOut();
    })
}
