@extends('customs.form-page')

@section('title', ($method=='Nuevo' ? 'Nueva' : $method) . ' tienda')

@section('vendor-style')
    {{-- Vendor Css files --}}
{{--    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">--}}
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}">
@endsection

@section('form')
    <form class="{{$nameCrud}}-form pt-0" @if(isset($tienda->id)) data-record="{{$tienda->id}}" @endif>
        @csrf
        @if(@$method === 'Ver') <fieldset disabled> @endif
            <h3><i class="fa fa-info-circle"></i> Información básica</h3>
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="form-group col-12">
                        <label for="nombre">Imagen de la tienda</label>
                        <div class="w-100 text-center">
                            <img id="display_uploaded" class="img-fluid cursor-pointer"
                                 style="width: 10em;"
                                 alt="Imagen agente"
                                 @if($method != 'Nuevo')
                                 src="{{isset($tienda->imagenes) ? $tienda->imagenes : asset('images/assets/upload.svg')}}"
                                 @else
                                 src="{{asset('images/assets/upload.svg')}}"
                                @endif
                            >
                            <br>
                            <small class="w-100"><i class="mr-50" data-feather="info"></i>Tamaño recomendado: 600 x 700</small>
                        </div>
                        <input type="text" id="image_uploaded" name="imagen" style="position: absolute;z-index: -1;"
                               @if($method != 'Nuevo')
                               value="{{isset($tienda->imagenes) ? $tienda->imagenes : ''}}"
                            @endif
                        >
                        <input type="file" hidden id="image_upload">
                    </div>
                </div>
                <div class="col-lg-9 col-12 row align-content-start">

                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="nombre">Nombre público</label>
                            <input id="nombre" name="nombre" type="text" class="form-control"
                                   data-required="El campo nombre es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->nombre}}" @endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="nombre_legal">Nombre legal</label>
                            <input id="nombre_legal" name="nombre_legal" type="text" class="form-control"
                                   data-required="El campo nombre legal es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->nombre_legal}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="cif">CIF</label>
                            <input id="cif" name="cif" type="text" class="form-control"
                                   data-required="El campo cif es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->cif}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input id="telefono" name="telefono" type="text" class="form-control"
                                   data-required="El campo teléfono es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->telefono}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input id="email" name="email" type="text" class="form-control"
                                   data-required="El campo email es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->email}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="url">URL de acceso</label>
                            <input id="url" name="url" type="text" class="form-control"
                                   data-required="El campo url es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->url}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12 mb-1">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion" type="text" class="form-control">{{@$tienda->descripcion}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mt-1"><i class="fa fa-info-circle"></i> Datos necesarios</h3>
            <div class="row">
                <div class="col-lg-12 col-12 row align-content-start">
                    <div class="col-lg-3 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input id="direccion" name="direccion" type="text" class="form-control"
                                   data-required="El campo dirección es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->direccion}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="codigo_postal">Código postal</label>
                            <input id="codigo_postal" name="codigo_postal" type="text" class="form-control"
                                   data-required="El campo código postal es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->codigo_postal}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input id="ciudad" name="ciudad" type="text" class="form-control"
                                   data-required="El campo ciudad es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->ciudad}}"@endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb-1">
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <input id="provincia" name="provincia" type="text" class="form-control"
                                   data-required="El campo provincia es requerido"
                                   data-minlength="3"
                                   @if($method != 'Nuevo') value="{{$tienda->provincia}}"@endif
                            />
                        </div>
                    </div>
                </div>
            </div>
            @if(@$method === 'Ver') </fieldset> @endif

        @include('./customs.form-buttons', ['routeName' =>'admin.pizarraTiendas'])
    </form>
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
{{--    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>--}}
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/custom/custom-form.js')). '?v='.$APP_VERSION }}"></script>
    <script src="{{ asset(mix('js/scripts/custom/custom-form-ajax-response.js')). '?v='.$APP_VERSION }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/tiendas/formulario.js')). '?v='.$APP_VERSION }}"></script>
{{--    <script src="{{ asset(mix('js/scripts/components/components-navs.js')) . '?v='.$APP_VERSION}}"></script>--}}
    {{-- Sweet Alert --}}
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
