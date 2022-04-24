<form class="form-usuario form-usuario-form">
  @if($method == 'Ver')
    <fieldset disabled>
    @endif
  <div class="row mt-1">
    <div class="col-12">
      <h4 class="mb-1">
        <i data-feather="user" class="font-medium-4 mr-25"></i>
        <span class="align-middle">Información del usuario</span>
      </h4>
    </div>
    @if($method != 'Nuevo') <input type="hidden" id="userId" value="{{$empleado->id}}"> @endif
    <input type="hidden" id="tipo" name="tipo" value="admin">
    <div class="col-lg-3 col-12">
      <div class="form-group col-12">
        <label class="form-label">Imagen del agente</label>
        <div class="w-100 text-center">
          <img id="display_uploaded" class="img-fluid cursor-pointer"
               alt="Imagen agente"
               @if($method != 'Nuevo')
               src="{{!is_null($empleado->imagen) ? $empleado->imagen : asset('images/pages/upload.png')}}"
               @else
               src="{{asset('images/pages/upload.png')}}"
                  @endif
          >
          <br>
          <small class="w-100"><i class="mr-50" data-feather="info"></i>Tamaño recomendado: 600 x 700</small>
        </div>
        <input type="text" id="image_uploaded" name="imagen" style="position: absolute;z-index: -1;"
               @if($method != 'Nuevo')
               value="{{!is_null($empleado->imagen) ? $empleado->imagen : ''}}"
                @endif
        >
        <input type="file" hidden id="image_upload">
      </div>
    </div>
    <div class="col-9 d-flex flex-wrap align-content-start">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" type="text" class="form-control"
           data-required="El campo nombre es requerido"
           data-minlength="3"
           @if($method != 'Nuevo') value="{{$empleado->nombre}}"@endif
          />
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="apellidos">Apellidos</label>
          <input id="apellidos" name="apellidos" type="text" class="form-control"
           data-required=""
           @if($method != 'Nuevo') value="{{$empleado->apellidos}}"@endif
          />
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="dni">DNI</label>
          <input id="dni" name="dni" type="text" class="form-control"
           data-required=""
           @if($method != 'Nuevo') value="{{$empleado->dni}}"@endif
          />
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input id="telefono" name="telefono" type="text" class="form-control"
           data-required="El campo teléfono es requerido"
           @if($method != 'Nuevo') value="{{$empleado->telefono}}"@endif
          />
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12 pt-2">
        <div class="form-group">
          <div class="custom-control custom-control-primary custom-switch">
            <input type="checkbox" class="custom-control-input" id="activoPortada" name="is_portada"
             @if($method != 'Nuevo') {{($empleado->is_portada) ? 'checked' : ''}} @endif
            />
            <label class="custom-control-label" for="activoPortada">Activo en portada</label>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="form-group">
          <label for="cargo_empresa">Cargo en la empresa</label>
          <input id="cargo_empresa" name="cargo_empresa" type="text" class="form-control"
                 data-required="El campo cargo empresa es requerido"
                 @if($method != 'Nuevo') value="{{$empleado->cargo_empresa}}"@endif
          />
        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-12">
      <h4 class="mb-1 mt-2">
        <i data-feather="lock" class="font-medium-4 mr-25"></i>
        <span class="align-middle">Cuenta</span>
      </h4>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <div class="form-group">
        <label for="email">Correo electrónico*</label>
        <input id="email" name="email" type="text" class="form-control" placeholder="john@example.com"
           data-required="El campo correo electrónico es requerido"
           data-email="El campo correo electrónico debe ser un email válido"
           @if($method != 'Nuevo') value="{{$empleado->email}}"@endif
        />
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <div class="form-group">
        <label for="email-confirm">Confirmar correo electrónico*</label>
        <input id="email-confirm" name="email-confirm" type="text" class="form-control" placeholder="john@example.com"
          data-required="El campo confirmar correo electrónico es requerido"
          data-equalto="email"
          data-equalto-message="El campo confirmar correo electrónico debe coincidir con el campo correo electrónico"
          data-email="El campo confirmar correo electrónico debe ser un email válido"
           @if($method != 'Nuevo') value="{{$empleado->email}}"@endif
        />
      </div>
    </div>
    @if($method == 'Nuevo')
    <div class="col-lg-3 col-md-6 col-12">
      <div class="form-group">
        <label for="password">Contraseña*</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="********"
         data-required="El campo contraseña es requerido"
        />
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <div class="form-group">
        <label for="password-confirm">Confirmar contraseña*</label>
        <input id="password-confirm" name="password-confirm" type="password" class="form-control" placeholder="********"
        data-required="El campo confirmar contraseña es requerido"
        data-equalto="password"
        />
      </div>
    </div>
    @endif
  </div>

  @include('content.empleados.tab-permisos')

</form>