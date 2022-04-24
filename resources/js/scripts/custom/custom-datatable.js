function abrirFiltros(nameCrud) {
  let rowFilter = $(`#${nameCrud}-parent-table .rowFiltros`);
  rowFilter.toggleClass("active");

  if (rowFilter.css('maxHeight') == '0px') {
    rowFilter.css({'maxHeight': `${rowFilter.prop('scrollHeight')}px`})
  } else {
    rowFilter.css({'maxHeight': ''})
  }
}

function initEnterOnFiltrosAvanzados(nameCrud) {
  $(`#${nameCrud}-parent-table .input-filtro-avanzado`).on('keyup', function (e) {
    if (e.keyCode == 13) {
      busquedaAvanzada(nameCrud);
    }
  })
}

function busquedaAvanzada(nameCrud) {
  let dataTable = $(`#${nameCrud}-table`);
  $.each($(`#${nameCrud}-parent-table .input-filtro-avanzado`), function (key, input) {
    let column = $(input).data('column');
    let val = $(input).val();
    if (typeof column != 'undefined') {
      dataTable.DataTable()
          .column(column)
          .search(val)
    }
  });

  dataTable.DataTable().draw();
}

function limpiarFiltrosAvanzados(nameCrud) {
  let dataTable = $(`#${nameCrud}-table`);
  $.each($(`#${nameCrud}-parent-table .input-filtro-avanzado, #${nameCrud}-parent-table .input-filtro-custom`), function (key, input) {
    let column = $(input).data('column');
    let val = ($(input).data('default') !== undefined) ? $(input).data('default') : '';
    $(input).val(val);
    if ($(input).hasClass('custom-flatpickr')) {
      initFlatPicker($(input), {defaultDate: val})
    }
    dataTable.DataTable()
        .column(column)
        .search('')
  });
  dataTable.DataTable().draw();
}


function initDatatable(columns, columnDefs, nameCrud, tableClass, options = null, id = null) {
  // Users List datatable
  let ordenDT = options.hasOwnProperty('order') ? options.order : [1, 'desc'];
  let data = options.hasOwnProperty('dataAjax') ? options.dataAjax : {};
  let prefix = (options.hasOwnProperty('prefix') && options.prefix !== null && options.prefix !== '') ? options.prefix : '/admin';

  let urlJson = ((options.hasOwnProperty('urls') && options.urls.hasOwnProperty('urlJson')) ? options.urls.urlJson : `${prefix}/${nameCrud}/json`),
      urlGet = ((options.hasOwnProperty('urls') && options.urls.hasOwnProperty('urlGet')) ? options.urls.urlGet : `${prefix}/${nameCrud}/get/`),
      urlEdit = ((options.hasOwnProperty('urls') && options.urls.hasOwnProperty('urlEdit')) ? options.urls.urlEdit : `${prefix}/${nameCrud}/edit/`),
      urlShow = ((options.hasOwnProperty('urls') && options.urls.hasOwnProperty('urlShow')) ? options.urls.urlShow : `${prefix}/${nameCrud}/show/`),
      urlDeleteVarios = ((options.hasOwnProperty('urls') && options.urls.hasOwnProperty('urlDeleteVarios')) ? options.urls.urlDeleteVarios : `${prefix}/${nameCrud}/delete-multiple`),
      urlDelete = ((options.hasOwnProperty('urls') && options.urls.hasOwnProperty('urlDelete')) ? options.urls.urlDelete : `${prefix}/${nameCrud}/delete/`);

  let customDataTable = $('#' + nameCrud + '-table'),
      customForm = $('.add-new-' + nameCrud),
      customModal = $(`.new-${nameCrud}-modal`);

  if (customDataTable.length) {
    let sLengthMenu = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sLengthMenu') ? datatable.sLengthMenu : 'Ver _MENU_ filas',
        sSearch = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sSearch') ? datatable.sSearch : 'Buscar',
        sZeroRecords = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sZeroRecords') ? datatable.sZeroRecords : 'No se encontraron resultados',
        sEmptyTable = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sEmptyTable') ? datatable.sEmptyTable : 'Ningún dato disponible en esta tabla',
        sInfo = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sInfo') ? datatable.sInfo : 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
        sInfoEmpty = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sInfoEmpty') ? datatable.sInfoEmpty : 'Mostrando registros del 0 al 0 de un total de 0 registros',
        sInfoFiltered = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sInfoFiltered') ? datatable.sInfoFiltered : '(filtrado de un total de _MAX_ registros)';

    customDataTable.DataTable({
      ajax: {
        "url": urlJson,
        "dataType": "json",
        "data": dataAjax,
        "type": "POST",
        "error": (jqXHR, textStatus, errorThrown) => {
          // datatableClientes.ajax.reload();
        }
      }, // JSON file to add data
      columns: columns,
      columnDefs: columnDefs,
      order: [ordenDT],
      bInfo: options !== null && options.hasOwnProperty('bInfo') ? options.bInfo : true,
      bPaginate: options !== null && options.hasOwnProperty('bPaginate') ? options.bPaginate : true,
      dom: domOption(options.domOptions),
      oLanguage: {
        sLengthMenu: sLengthMenu,
        processing: `<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>`,
        sSearch: sSearch,
        sZeroRecords: sZeroRecords,
        sEmptyTable: sEmptyTable,
        sInfo: sInfo,
        sInfoEmpty: sInfoEmpty,
        sInfoFiltered: sInfoFiltered,
        oPaginate: {
          "sNext": "-",
          "sPrevious": "-"
        },
      },
      // Buttons with Dropdown
      buttons: getButtons(options, null),
      select: {
        style: 'multi',
        selector: 'td.dt-checkboxes-cell'
      },
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              let data = row.data();
              console.log(data);
              const tituloModal = (data, title) => {
                let textoTitulo = '';

                title.forEach((titulo) => {
                  let tituloSeparado = titulo.match(/\./g) ? titulo.split('.') : [titulo];
                  let dato = {};

                  tituloSeparado.forEach((titulo, i) => {
                    if (data.hasOwnProperty(titulo)) {
                      dato = data[titulo];
                    } else if (dato.hasOwnProperty(titulo)) {
                      dato = dato[titulo];
                    }
                    if (typeof dato != 'object') textoTitulo += dato + ' ';
                  });
                });

                return textoTitulo.trim();
              };
              let buscar = ['nombre'];
              let sTitle =  (typeof datatable != 'undefined') && datatable.hasOwnProperty('sTitle') ? datatable.sTitle : 'Detalles de';
              let beforeText = '';
              if (options.hasOwnProperty('titleModal') && options.titleModal.hasOwnProperty('data')) {
                buscar = options.titleModal.data;
              }
              if (options.hasOwnProperty('titleModal') && options.titleModal.hasOwnProperty('beforeText')) {
                beforeText = options.titleModal.beforeText + ' ';
              }
              let titulo = tituloModal(data, buscar);

              return sTitle + ' ' + beforeText + titulo;
            }
          }),
          type: 'column',
          renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            tableClass: 'table',
            columnDefs: [
              {
                targets: 2,
                visible: false
              },
              {
                targets: 3,
                visible: false
              }
            ],
          })
        }
      },
      processing: true,
      serverSide: true,
      deferRender: true,
      initComplete: function () {

        // Si tiene los filtros activos
        if (options !== undefined && options.domOptions.domFiltros) {
          let htmlFiltros = getFiltersHtml(options);

          let buttonBuscarClass = (options.hasOwnProperty('filtrosStyle') && options.filtrosStyle.hasOwnProperty('buttonBuscar')) ? options.filtrosStyle.buttonBuscar : 'col-lg-1 col btn-sm mx-25 btn btn-primary';
          let buttonLimpiarClass = (options.hasOwnProperty('filtrosStyle') && options.filtrosStyle.hasOwnProperty('buttonLimpiar')) ? options.filtrosStyle.buttonLimpiar : 'col-lg-1 col btn-sm ml-25 btn btn-outline-primary';
          let sBusqueda = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sBusqueda') ? datatable.sBusqueda : 'Búsqueda avanzada';
          let sLimpiar = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sLimpiar') ? datatable.sLimpiar : 'Limpiar';

          $(`#${nameCrud}-parent-table .rowFiltros`).attr('style', 'transition: 0.5s all ease;overflow: hidden;')
          $(`#${nameCrud}-parent-table .rowFiltros`).append(`
                        <div class="row align-items-center justify-content-start w-100">
                              <div class="col-12 font-weight-bold px-0"> <h5>${sBusqueda}</h5></div>
                              ${htmlFiltros}
                              <div class="col-12 d-flex justify-content-end mt-1">
                                  <button class="${buttonBuscarClass}" onclick="busquedaAvanzada('${nameCrud}')">${sSearch}</button>
                                  <button class="${buttonLimpiarClass}" onclick="limpiarFiltrosAvanzados('${nameCrud}')">${sLimpiar}</button>
                              </div>
                        </div>
                    `)
          initEnterOnFiltrosAvanzados(`${nameCrud}`);
          initFlatPicker('custom-flatpickr');
          initFlatPicker('custom-flatpickr-range', true);
          $(`#${nameCrud}-parent-table .custom-html-filters`).remove();

          $('.buttons-colvis').addClass('dropdown-toggle');
          $('.buttons-colvis > div').addClass('dropdown-menu');
          $('.dt-button-collection > div').addClass('dropdown-menu');
          $('.dt-button-collection').on('click', (k, v) => {});
        }

      },
      rowCallback: function (row, data, index) {
        if (options !== null && options.rowCallback) {
          options.rowCallback(row, data)
        }
      },
      drawCallback: function (settings) {
        if (options !== null && options.drawCallback) {
          options.drawCallback(settings)
        }
        $('.modal-backdrop').remove();
      }
    });
  }
  //Variables de lang
  let sAlertaBorrarTitle =  (typeof alerta != 'undefined') && alerta.hasOwnProperty('sAlertaBorrarTitle') ? alerta.sAlertaBorrarTitle : '¿Está segur@ de borrar el registro? ',
      sAlertaBorrarText =   (typeof alerta != 'undefined') && alerta.hasOwnProperty('sAlertaBorrarText') ? alerta.sAlertaBorrarText : "Si continua se borrará el registro. Esta acción no se puede revertir",
      sAlertaConfirmar =    (typeof alerta != 'undefined') && alerta.hasOwnProperty('sAlertaConfirmar') ? alerta.sAlertaConfirmar : 'Confirmar',
      sAlertaCancelar =     (typeof alerta != 'undefined') && alerta.hasOwnProperty('sAlertaCancelar') ? alerta.sAlertaCancelar : 'Cancelar',
      sAlertaAceptar =      (typeof alerta != 'undefined') && alerta.hasOwnProperty('sAlertaAceptar') ? alerta.sAlertaAceptar : 'Aceptar',
      sAlertaBorradoTitle = (typeof alerta != 'undefined') && alerta.hasOwnProperty('sAlertaBorradoTitle') ? alerta.sAlertaBorradoTitle : '¡Registro eliminado!',
      sAlertaBorradoText =  (typeof alerta != 'undefined') && alerta.hasOwnProperty('sAlertaBorradoText') ? alerta.sAlertaBorradoText : "El registro se ha eliminado satisfactoriamente.";

  //Inits botones rows
  deleteRecord();
  seeRecord();
  editRecord();
  //Init botones modal
  seeRecord($('.dtr-details'));
  editRecord($('.dtr-details'));
  deleteRecord($('.dtr-details'));

  // TODO: ¡Esto puede petar si usas modales! Buscar una buena solución para poder usar los actions del modal responsive
  customDataTable.on('click', 'td.control', function () {
     seeRecord($('.dtr-details'), urlShow);
    editRecord($('.dtr-details'), urlEdit, newBlogForm, nameCrud, newUserSidebar);
    deleteRecord($('.dtr-details'), urlDelete, dtUserTable);
  });

  //Funciones
  //Delete record
  function deleteRecord(modal = null) {
    if (modal == null) {
      modal = customDataTable
    }
    modal.on('click', '.delete-record', function (e) {
      var id = $(this).data('record');
      Swal.fire({
        title: sAlertaBorrarTitle,
        text: sAlertaBorrarText,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: sAlertaConfirmar,
        cancelButtonText: sAlertaCancelar,
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1'
        },
        buttonsStyling: false
      }).then(function (result) {
        if (result.value) {
          $('#spinner-loading').fadeIn();
          $.ajax({
            url: urlDelete + id,
            method: 'DELETE'
          }).done(response => {

            if ($('dtr-bs-modal').length) {
              $('button.close').click();
            }
            Swal.fire({
              icon: 'success',
              title: sAlertaBorradoTitle,
              text: sAlertaBorradoText,
              confirmButtonText: sAlertaAceptar,
              allowOutsideClick: false,
              allowEscapeKey: false
            });
            customDataTable.DataTable().ajax.reload();
          }).fail(error => {
            let mensajes = 'Ha ocurrido un error al borrar el registro';
            if (error.responseJSON.errores) {
              let errores = error.responseJSON.errores;
              for (const key in errores) {
                for (let i = 0; i < errores[key].length; i++) {
                  mensajes = mensajes + `<p>${errores[key][i]}</p>`
                }
              }
            } else if (error.responseJSON.message) {
              mensajes = `<p>${error.responseJSON.message}</p>`
            }
            Swal.fire({
              title: '¡Error!',
              html: mensajes,
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-primary'
              },
              buttonsStyling: false
            });
          }).always(() => {
            $('#spinner-loading').fadeOut();
          })
        }
      });
    });
  }
  // Edit record
  function editRecord(modal = null) {
    if (modal == null) {
      modal = customDataTable
    }
    modal.on('click', '.edit-record', function (e) {
      var id = $(this).data('record');
      if (!$(this).hasClass('edit-in-modal')) {
        window.open(urlEdit + id);
        return;
      }
      getAjaxModalForm(id, 'edit')
    });
  }

  //see Record
  function seeRecord(modal = null) {
    if (modal == null) {
      modal = customDataTable
    }
    modal.on('click', '.read-record', function () {
      let id = $(this).data('record');
      if (!$(this).hasClass('show-in-modal')) {
        window.open(urlShow + id);
        return;
      }
      getAjaxModalForm(id, 'show')
    });
  }

  function disableAllInputs(state) {
    $(`.add-new-${nameCrud} input`).prop('disabled', state)
    $(`.add-new-${nameCrud} textarea`).prop('disabled', state)
    $(`.add-new-${nameCrud} select`).prop('disabled', state)
    $(`.add-new-${nameCrud} button[type="submit"]`).prop('disabled', state)
  }

  function getAjaxModalForm(id, mode) {
    $('#spinner-loading').fadeIn();
    $.ajax({
      url: urlGet + id,
      method: 'GET'
    }).done(response => {
      customForm.data('record', id);
      disableAllInputs(false)
      for (let key in response) {
        //Datepicker
        // if (key === 'fecha') {
        //   flatpicker.setDate(response[key]);
        // }else if(key === 'created_at'){
        //   flatpicker.setDate(response[key].split('T', 2)[0]);
        // }
        // // Descripción SwowEditor
        // else {
        //   if (key === 'imagen') {
        //     $('#display_uploaded').attr('src',response[key]);
        //     $('#image_uploaded').val(response[key]);
        //   }
        $(`.add-new-${nameCrud} input[name^='${key}']`).val(response[key]);
        $(`.add-new-${nameCrud} textarea[name^='${key}']`).val(response[key]);
        $(`.add-new-${nameCrud} select[name^='${key}']`).val(response[key]);
        $(`.add-new-${nameCrud} input[name^='${key}']`).prop('checked', (response[key] == 1) ? true : false);
        $(`.add-new-${nameCrud} input[id='${key}_image_uploaded_update']`).val(response[key]).trigger('change');

        if (Array.isArray(response[key])) {
          // Hago un for y voy metiendo todos los valores como opciones de un select múltiple
          response[key].forEach(element => {
            if (element.hasOwnProperty('value') && element0.hasOwnProperty('text')) {
              if ($(`.add-new-${nameCrud} select[name^='${key}'] option[value="${element.value}"]`).length == 0) {
                let newOption = new Option(element.text, element.value, false, true);
                $(`.add-new-${nameCrud} select[name^='${key}']`).append(newOption).trigger('change');
              } else {
                $(`.add-new-${nameCrud} select[name^='${key}']`).val(element.value);
              }
            }
          });
        }
        // Si no es un array pero es un objeto
        else if (typeof response[key] == 'object' && response[key].hasOwnProperty('value') && response[key].hasOwnProperty('text')) {
          if ($(`.add-new-${nameCrud} select[name^='${key}'] option[value="${response[key].value}"]`).length == 0) {
            let newOption = new Option(response[key].text, response[key].value, false, true);
            $(`.add-new-${nameCrud} select[name^='${key}']`).append(newOption).trigger('change');
          } else {
            $(`.add-new-${nameCrud} select[name^='${key}']`).val(response[key].value);
          }
        }
        // Contenido HTML personalizado
        if (response[key] !== null && response[key].div_parent !== undefined) {
          $(response[key].div_parent).append(response[key].html_content);
          // Inicializar inputs img file
          $(response[key].div_parent + ' .img-custom-file').each(function () {
            let id = $(this).attr('id').replace('_display_uploaded', '');
            initInputFile(id);
          });
        }

        // }
      }
      if (mode == 'show') {
        disableAllInputs(true);
      }
      if (options.onEditCallback !== undefined && typeof options.onEditCallback != null) {
        options.onEditCallback(response);
      }

      customModal.modal('show');
    }).fail(error => {
      Swal.fire({
        title: '¡Error!',
        text: ' Ha ocurrido un error al consultar el registro',
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
   * Método que devuelve los botones del datatable
   * Los botones del export se obtienen mediante recursividad por el @suboption
   */
  function getButtons(options, suboption = null) {
    let buttons = [];


    // Si existen opciones
    if (options !== null) {
      // Si añadimos el botón de exportar
      if (options.exportOptions !== null && typeof options.exportOptions !== 'undefined') {
        let sExportar = (typeof datatable != 'undefined') && datatable.hasOwnProperty('exportar') ? datatable.exportar : 'Exportar';
        let nombre = options.exportOptions.hasOwnProperty('name') ? options.exportOptions.name : sExportar;
        let buttonExportClass = (options.hasOwnProperty('filtrosStyle') && options.filtrosStyle.hasOwnProperty('buttonExport')) ? options.filtrosStyle.buttonExport : 'dt-button buttons-collection btn btn-outline-dark dropdown-toggle me-50 mt-50';

        buttons.push({
          extend: 'collection',
          className: buttonExportClass,
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + nombre,
          buttons: [getButtons(null, options.exportOptions)],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        });
      }
      //Boton de filtros
      if (options.domOptions.domFiltros) {

        let buttonAvanzadoClass = (options.hasOwnProperty('filtrosStyle') && options.filtrosStyle.hasOwnProperty('buttonBusquedaAvanzada')) ? options.filtrosStyle.buttonBusquedaAvanzada : 'btn btn-outline-primary mt-50 me-50';
        let sBusqueda = (typeof datatable != 'undefined') && datatable.hasOwnProperty('sBusqueda') ? datatable.sBusqueda : 'Búsqueda avanzada';
        buttons.push({
          text: `<i class="me-50" data-feather="search"></i>${sBusqueda}`,
          className: buttonAvanzadoClass,
          init: function (api, node, config) {
            $(node).on('click', function (e) {
              abrirFiltros(`${nameCrud}`);
            });
          }
        });
      }
      //Boton de filtros
      if (!options.hasOwnProperty('addColvis') || (options.hasOwnProperty('addColvis') && options.addColvis.active)) {
        let campos = (typeof datatable != 'undefined') && datatable.hasOwnProperty('campos') ? datatable.campos : 'Campos';
        let buttonFieldsClass = (options.hasOwnProperty('filtrosStyle') && options.filtrosStyle.hasOwnProperty('buttonFields')) ? options.filtrosStyle.buttonFields : 'btn btn-outline-dark dropdown-toggle me-50 mt-50';
        buttons.push({
          text: `<i class="me-50" data-feather="eye"></i>${campos}`,
          extend: 'colvis',
          className: buttonFieldsClass,
        })
      }


      // Botón de Añadir
      if (options.addButton && options.addButton.active) {
        let sAnadir = (typeof datatable != 'undefined') && datatable.hasOwnProperty('anadir') ? datatable.anadir : 'Añadir';
        let attr = {
          'data-bs-toggle': 'modal',
          'data-bs-target': '#modals-slide-' + nameCrud,
          'option' : options.addButton.showModal
        };
        if (options.addButton.showModal !== true) { // Mostramos el modal
          let url = options.addButton.url ? options.addButton.url : `${prefix}/${nameCrud}/new`;
          attr =  {
            'onclick': `window.location.href="${url}"`,
          }
        }
        buttons.push({
          text: `<i class="me-50" data-feather="plus"></i>${sAnadir}`,
          className: 'add-new btn btn-primary mt-50',
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          },
          attr: attr
        });

      }
      return buttons;

    }

    // Si hay botón de exportar, añadimos subopciones
    if (suboption !== null) {
      let sImprimir = (typeof datatable != 'undefined') && datatable.hasOwnProperty('imprimir') ? datatable.imprimir : 'Imprimir';
      if (suboption.exportButtonPrint.active) {
        buttons.push({
          extend: 'print',
          text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + sImprimir,
          className: 'dropdown-item',
          exportOptions: suboption.exportButtonPrint.exportOptions ? suboption.exportButtonPrint.exportOptions : { columns: ":visible:not(.not-export-col)" },
        });
      }

      if (suboption.exportButtonExcel.active) {
        buttons.push({
          extend: 'excel',
          text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
          className: 'dropdown-item',
          exportOptions: { columns: [3, 4] }
        })
      }

      if (suboption.exportButtonCSV.active) {
        buttons.push({
          extend: 'csv',
          text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
          className: 'dropdown-item',
          exportOptions: suboption.exportButtonCSV.exportOptions ? suboption.exportButtonCSV.exportOptions : { columns: ":visible:not(.not-export-col)" },
        })
      }

      if (suboption.exportButtonPdf.active) {
        buttons.push({
          extend: 'pdf',
          text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
          className: 'dropdown-item',
          exportOptions: suboption.exportButtonPdf.exportOptions ? suboption.exportButtonPdf.exportOptions : { columns: ":visible:not(.not-export-col)" },
        })
      }

      if (suboption.exportButtonCopy.active) {
        let sCopia = (typeof datatable != 'undefined') && datatable.hasOwnProperty('copiar') ? datatable.imprimir : 'Copiar';
        buttons.push({
          extend: 'copy',
          text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + sCopia,
          className: 'dropdown-item',
          exportOptions: suboption.exportButtonCopy.exportOptions ? suboption.exportButtonCopy.exportOptions : { columns: ":visible:not(.not-export-col)" },
        })
      }
      if (suboption.hasOwnProperty('exportButtonBorrar') && suboption.exportButtonBorrar.active) {
        buttons.push({
          text: feather.icons['trash'].toSvg({ class: 'font-small-4 me-50' }) + 'Borrar',
          action: function () {
            let idsChecked = [];
            customDataTable.find('input:checked').each(function () {
              console.log(this.id.replace('checkbox', ''))
              if (this.id.replace('checkbox', '') !== '') {
                idsChecked.push(this.id.replace('checkbox', ''));
              }
            });
            console.log(idsChecked)
            if (idsChecked.length > 0) {
              Swal.fire({
                title: '¿Estas segur@?',
                text: "Una vez eliminado no se podrá recuperar!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No, Cancelar',
                confirmButtonText: 'Si, Borralo!'
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url: urlDeleteVarios,
                    method: 'delete',
                    data: { ids: idsChecked }
                  }).done((data) => {
                    $(this).closest('tr').hide();
                    Swal.fire({
                      title: '¡Borrado!',
                      text: 'Los registros se han borrado exitosamente',
                      type: 'success'
                    })
                    customDataTable.DataTable().draw()
                    // customDataTable.DataTable().ajax.reload();
                  }).fail((message) => {
                    Swal.fire({
                      title: '¡Error!',
                      text: 'Ha ocurrido un error al borrar los registros',
                      type: 'warning'
                    })
                  });
                }
              })
            } else {
              Swal.fire({
                title: 'Error!',
                text: 'Debe seleccionar registros para borrar.',
                type: 'warning'
              })
            }
          },
          className: "btn-link-secondary dropdown-item",
          exportOptions: suboption.exportButtonCopy.exportOptions ? suboption.exportButtonCopy.exportOptions : { columns: ":visible:not(.not-export-col)" },

        })
      }



      return buttons;
    }
  }

  function domOption(options) {
    let filtros = ''

    let contentActions = (options !== null && options.hasOwnProperty('contentActionsStyle')) ? options.contentActionsStyle : 'col-md-12 col-lg-8 pl-xl-75 pl-0';

    let domHTML = `
        <"d-flex justify-content-between align-items-center header-actions mx-1 row my-75"`;

    if (options !== undefined && options.domRows) {
      domHTML += `<"col-md-12 col-lg-4" l>`;
    } else {
      domHTML += `<"col-md-12 col-lg-4">`;
    }

    domHTML += `
        <"${contentActions}"
        <"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap me-1"`;

    if (options !== undefined && options.domSearch) {
      domHTML += `<"me-1"f>`;
    } else {
      domHTML += `<"me-1">`
    }

    if (options !== undefined && options.domFiltros) {
      filtros = `<"col-12 rowFiltros">`
    }


    domHTML += `
        B>>${filtros}>t

        <"d-flex justify-content-between mx-2 row mb-1"
        <"col-sm-12 col-md-6"i>
        <"col-sm-12 col-md-6"p>
        >`;
    return domHTML;
  }

  function getFiltersHtml(options) {
    let filtrosHtml = ``;
    if (options !== undefined && options.filtros && Array.isArray(options.filtros)) {
      $.each(options.filtros, function (key, filtro) {
        let clase = (filtro.className.length > 1) ? filtro.className : 'col px-50';
        let titulo = (filtro.title.length > 1) ? filtro.title : 'título';
        let placeholder = (typeof datatable != 'undefined') && datatable.hasOwnProperty('placeholder') ? datatable.placeholder : 'Buscar por';
        let inputFiltro = '';
        let filterClass = '';
        let inputName = '';
        let defaultValue = (filtro.defaultValue !== undefined) ? filtro.defaultValue : '';
        if (filtro.column !== undefined) {
          if (filtro.column === 'custom') {
            filterClass = 'input-filtro-custom';
          } else {
            filterClass = 'input-filtro-avanzado';
          }
        }

        if (filtro.name !== undefined) {
          inputName = `name="${filtro.name}"`;
        }

        switch (filtro.type) {
          case 'flatpickr': {
            inputFiltro = `<input type="text" value="${defaultValue}" data-default="${defaultValue}" ${inputName}
                                            name="${titulo}" data-column="${filtro.column}"
                                            class="${filterClass} form-control form-control-sm custom-flatpickr pickatime-es"
                                            placeholder="${placeholder} ${titulo.toLowerCase()}">`
          } break;
          case 'flatpickr-range': {
            inputFiltro = `<input type="text" value="${defaultValue}" data-default="${defaultValue}"
                                            ${inputName} data-column="${filtro.column}"
                                            class="${filterClass} form-control form-control-sm custom-flatpickr-range"
                                            placeholder="${placeholder} ${titulo.toLowerCase()}">`
          }
            break;
          case 'text': {
            inputFiltro = `<input type="text" value="${defaultValue}" data-default="${defaultValue}"
                                            ${inputName} data-column="${filtro.column}"
                                            class="${filterClass} form-control form-control-sm"
                                            placeholder="${placeholder} ${titulo.toLowerCase()}" />`
          }
            break;
          case 'select': {
            let optionsSelect = ``;
            $.each(filtro.opcionesSelect, function (k, option) {
              optionsSelect += `<option value="${option.valor}">${option.text}</option>`;
            })
            inputFiltro = `
                <select ${inputName} data-column="${filtro.column}" class="${filterClass} form-control form-control-sm" >
                    ${optionsSelect}
                </select>
            `
          }
            break;
          case 'fecha': {
            inputFiltro = `<input type="text" ${inputName} data-column="${filtro.column}"
                                            class="${filterClass} form-control form-control-sm"
                                            placeholder="${placeholder} ${titulo.toLowerCase()}" />`
          }
            break;
          case 'switch': {
            inputFiltro = `<input type="text" ${inputName} data-column="${filtro.column}"
                                            class="${filterClass} form-control form-control-sm"
                                            placeholder="${placeholder} ${titulo.toLowerCase()}" />`
          }
            break;
          case 'html': {
            inputFiltro = filtro.html
          }
            break;
        }

        let filtroText = `
                    <div class="${clase}">
                        <label for="">${titulo}</label>
                        ${inputFiltro}
                    </div>
                  `
        filtrosHtml += filtroText;
      });
    }

    return filtrosHtml;
  }

  function dataAjax(data) {
    if (typeof options.dataAjax == 'object') {
      $.each(options.dataAjax, function name(key, item) {
        data[key] = item;
      })
    } else if (typeof options.dataAjax == 'function') {
      options.dataAjax(data);
    }

    $.each($(`#${nameCrud}-parent-table .input-filtro-custom`), function name(key, item) {
      const inpFilter = $(item);
      data[inpFilter.attr('name')] = inpFilter.val();
    })
  }

  // Limpiar el modal luego de que se cierra
  customModal.on('hidden.bs.modal', function (e) {
    customForm.trigger('reset');
    customForm.data('record', '');
    //Poner aquí el padre del modal
    $('.image-uploaded-update').val('').trigger('change');
  });

}
