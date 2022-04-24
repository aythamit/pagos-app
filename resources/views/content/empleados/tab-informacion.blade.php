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
                <input type="hidden" id="rol" name="rol" value="empleado">
                <div class="col-lg-3 col-12">
                    <div class="form-group col-12">
                        <label class="form-label">Imagen del empleado</label>
                        <div class="w-100 text-center">
                            <img id="display_uploaded" class="img-fluid cursor-pointer"
                                 style="width: 10em;"
                                 alt="Imagen agente"
                                 @if($method != 'Nuevo')
                                 src="{{!is_null($empleado->imagen) ? $empleado->imagen : asset('images/assets/upload.svg')}}"
                                 @else
                                 src="{{asset('images/assets/upload.svg')}}"
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
                        <input type="file" hidden id="image_upload" accept="image/*">
                    </div>
                </div>
                <div class="col-9 row align-content-start">
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" name="nombre" type="text" class="form-control"
                                   data-required="El campo nombre es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$empleado->nombre}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input id="apellidos" name="apellidos" type="text" class="form-control"
                                   data-required=""
                                   @if($method != 'Nuevo') value="{{$empleado->apellidos}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input id="dni" name="dni" type="text" class="form-control"
                                   data-required=""
                                   @if($method != 'Nuevo') value="{{$empleado->dni}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input id="telefono" name="telefono" type="text" class="form-control"
                                   data-required="El campo teléfono es requerido"
                                   @if($method != 'Nuevo') value="{{$empleado->telefono}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="cargo_empresa">Cargo en la empresa</label>
                            <input id="cargo_empresa" name="cargo_empresa" type="text" class="form-control"
                                   data-required="El campo cargo empresa es requerido"
                                   @if($method != 'Nuevo') value="{{$empleado->cargo_empresa}}"@endif
                            />
                        </div>
                    </div>
                    @if($method !== 'Nuevo')
                        <div class="col-lg-4 col-md-6 col-12 mb-1">
                            <div class="d-flex flex-column">
                                <label class="form-check-label mb-50" for="customSwitch12">Cuenta bloqueada</label>
                                <div class="form-check form-switch form-check-danger">
                                    <input type="checkbox" name="is_blocked" class="form-check-input" id="is_blocked"
                                    @if($method != 'Nuevo' && @$empleado->is_blocked == '1') checked @endif>
                                    <label class="form-check-label" for="is_blocked">
                                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="14" height="14" viewBox="0 0 24 24"
                                                                            fill="none" stroke="currentColor"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="feather feather-check"><polyline
                                                    points="20 6 9 17 4 12"></polyline></svg></span>
                                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="14" height="14" viewBox="0 0 24 24"
                                                                             fill="none" stroke="currentColor"
                                                                             stroke-width="2" stroke-linecap="round"
                                                                             stroke-linejoin="round"
                                                                             class="feather feather-x"><line x1="18"
                                                                                                             y1="6"
                                                                                                             x2="6"
                                                                                                             y2="18"></line><line
                                                    x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif
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
                        <input id="email-confirm" name="email-confirm" type="text" class="form-control"
                               placeholder="john@example.com"
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
                            <input id="password" name="password" type="password" class="form-control"
                                   placeholder="********"
                                   data-required="El campo contraseña es requerido"
                            />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group">
                            <label for="password-confirm">Confirmar contraseña*</label>
                            <input id="password-confirm" name="password-confirm" type="password" class="form-control"
                                   placeholder="********"
                                   data-required="El campo confirmar contraseña es requerido"
                                   data-equalto="password"
                            />
                        </div>
                    </div>
                @endif
            </div>

        @include('content.empleados.tab-permisos')

</form>
