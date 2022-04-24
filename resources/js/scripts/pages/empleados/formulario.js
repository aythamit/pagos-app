$(function () {
  'use strict';
  validateForm('form-usuario');
  initImageUpload('display_uploaded','image_uploaded','image_upload');
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

    const user_tipo = $('#tipo_user').val();
    var changePicture = $('#change-picture'),
    userAvatar = $('.user-avatar'),
    form = $('.form-usuario');

  // Change user profile picture
  if (changePicture.length) {
    $(changePicture).on('change', function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (userAvatar.length) {
          userAvatar.attr('src', reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
    });
  }

  /* TAB DE PERMISOS */
  /* */
  // Funciones para los clicks de los checkbox
  $('.select-all-modulo').on('change', function(e) {
    const modulo = e.currentTarget.id.replace('-select', '');
    // Si todos están "checked" se quitan todos los checks
    // console.log($(`.${modulo}-check`).length)
    // console.log(`${modulo}-check`);
    // console.log($(`.${modulo}-check:checked`).length)
    if ($(`.${modulo}-check`).length == $(`.${modulo}-check:checked`).length) {
      $(`.${modulo}-check`).prop('checked', false);
    } else {
      $(`.${modulo}-check`).prop('checked', true);
    }
  });
  $('.permiso-check').on('change', function (e) {
    const modulo = $(this).data('modulo');
    if ($(`.${modulo}-check`).length == $(`.${modulo}-check:checked`).length) {
      $(`#${modulo}-select`).prop('checked', true);
    } else {
      $(`#${modulo}-select`).prop('checked', false);
    }
  });
  $('.especial-check').on('change', function (e) {
    const modulo = 'especial';
    if ($(`.${modulo}-check`).length == $(`.${modulo}-check:checked`).length) {
      $(`#${modulo}-select`).prop('checked', true);
    } else {
      $(`#${modulo}-select`).prop('checked', false);
    }
  });
  // Extraer los permisos para enviar los permisos del usuario al back
  $('.form-usuario').on('submit', function (e) {
    // $('.form-usuario').submit()
    var isValid = $('.form-usuario').valid();
    const idUser = 1;//ESTE DEBE SER EL ID DEL USUARIO AL QUE SE LE ASIGNAN LOS PERMISOS
    e.preventDefault();
    if(isValid){
      let permisos = {};
      $('.user-permiso').each(function () {
        let checkboxPermiso = $(this);
        // let valor = $(permiso).attr('checked');
        let modulo = checkboxPermiso.data('id');
        let tipo = checkboxPermiso.data('tipo');
        let valor = checkboxPermiso.prop('checked') ? 1 : 0;
        if (permisos[modulo] === undefined) {
          permisos[modulo] = {};
        }
        permisos[modulo][tipo] = valor;
      });
      let dataForm = $('.form-usuario').serializeArray();

      dataForm.push({ name: 'permisos',
                      value: JSON.stringify(permisos)});

      let url =  `/${user_tipo}/empleados/store`
      let method =  `post`
      let editando = typeof $(`#userId`).val() != 'undefined';
      if(editando){
        url =  `${url}/${$(`#userId`).val()}`
        method =  `put`
      }

      $('#spinner-loading').fadeIn();
      $.ajax({
        url: url,
        method: method,
        data: dataForm
      }).done(response => {

        if(editando){
          resultEditando(response);
        }else{
          resultCreando(response);
        }

      }).fail(error => {
          customFormAjaxResponse(error)
      }).always(() => {
        $('#spinner-loading').fadeOut();
      })
    }
  });

    function resultEditando(response){
        standardAjaxResponse('¡Actualizado/a!', 'El empleado se ha actualizado correctamente', `/${user_tipo}/empleados/pizarra`);
    }
    function resultCreando(response){
        standardAjaxResponse('¡Listo/a!', 'El empleado se ha creado correctamente', `/${user_tipo}/empleados/pizarra`);
    }
});


