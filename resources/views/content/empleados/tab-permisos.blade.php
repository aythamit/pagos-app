 <div class="row">
     <div class="col-12">
         <div class="table-responsive border rounded mt-1">
             <h6 class="py-1 mx-1 mb-0 font-medium-2">
                 <i data-feather="lock" class="font-medium-3 mr-25"></i>
                 <span class="align-middle">Lista de permisos</span>
             </h6>
             <table class="table table-striped table-borderless">
                 <thead class="thead-light">
                     <tr>
                         <th>Módulo</th>
                         <th>Ver</th>
                         <th>Editar</th>
                         <th>Borrar</th>
                         <th>
                             <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input select-all-modulo"
                                     id="permiso-select" />
                                 <label class="custom-control-label" for="permiso-select">Seleccionar todos</label>
                             </div>
                         </th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($permisos as $permiso)
                         {{-- {{dd($permiso->pivot->leer)}} --}}
                         <tr>
                             <td>{{ $permiso['display'] }}</td>
                             @foreach (['leer', 'editar', 'borrar'] as $tipo_permiso)
                                 <td>

                                     @if ($permiso[$tipo_permiso] == 1)
                                         <div class="custom-control custom-checkbox">
                                             <input type="checkbox"
                                                 class="custom-control-input {{ $permiso['modulo'] }}-check permiso-check user-permiso"
                                                 data-modulo="{{ $permiso['modulo'] }}" data-id="{{ $permiso['id'] }}"
                                                 data-tipo="{{ $tipo_permiso }}"
                                                 id="{{ $permiso['modulo'] }}-{{ $tipo_permiso }}"
                                                 @if ($method != 'Nuevo' && isset($permiso['users'][0]['pivot']) && $permiso['users'][0]['pivot'][$tipo_permiso] == 1) checked @endif />
                                             <label class="custom-control-label"
                                                 for="{{ $permiso['modulo'] }}-{{ $tipo_permiso }}"></label>
                                         </div>
                                     @endif
                                 </td>
                             @endforeach
                             <td>
                                 <div class="custom-control custom-checkbox">
                                     <input type="checkbox"
                                         class="custom-control-input select-all-modulo permiso-check "
                                         data-modulo="permiso" id="{{ $permiso['modulo'] }}-select" />
                                     <label class="custom-control-label" for="{{ $permiso['modulo'] }}-select"></label>
                                 </div>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
         <div class="table-responsive border rounded mt-1">
             <h6 class="py-1 mx-1 mb-0 font-medium-2">
                 <i data-feather="lock" class="font-medium-3 mr-25"></i>
                 <span class="align-middle">Otros permisos</span>
             </h6>
             <table class="table table-striped table-borderless">
                 <thead class="thead-light">
                     <tr>
                         <th>
                             <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input select-all-modulo"
                                     data-modulo="especial" id="especial-select" />
                                 <label class="custom-control-label" for="especial-select">Seleccionar todos</label>
                             </div>
                         </th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($permisos_especiales as $permiso)
                         {{-- {{dd($permiso['users'][0])}} --}}
                         <tr>
                             <td>
                                 <div class="custom-control custom-checkbox">
                                     <input type="checkbox" class="custom-control-input especial-check user-permiso"
                                         data-modulo="{{ $permiso['modulo'] }}" data-id="{{ $permiso['id'] }}"
                                         data-tipo="especial" name="{{ $permiso['modulo'] }}-especial"
                                         id="{{ $permiso['modulo'] }}-especial" @if ($method != 'Nuevo' && isset($permiso['users'][0]['pivot']) && $permiso['users'][0]['pivot']['especial'] == 1) checked @endif />
                                     <label class="custom-control-label"
                                         for="{{ $permiso['modulo'] }}-especial">{{ $permiso['display'] }}</label>
                                 </div>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>

     @if ($method == 'Ver')
         </fieldset>
     @endif
     <div class="col-12 d-flex flex-sm-row flex-column mt-2">
         @if ($method != 'Ver')
             <button type="submit" id="btn-guardar-empleado"
                 class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Guardar</button>
         @endif
         <button type="reset" id="btn-cancelar-empleado"
             class="btn btn-outline-secondary">{{ $method === 'Ver' ? 'Volver' : 'Cancelar' }}</button>
     </div>
 </div>

 <!-- users edit permisos form ends -->
