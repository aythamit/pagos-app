
    <form class="{{$nameCrud}}-form pt-0" @if(isset($tienda->id)) data-record="{{$tienda->id}}" @endif>
        @csrf
        @if(@$method === 'Ver') <fieldset disabled> @endif
            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 mb-1">
                    <div class="form-group">
                        <label for="tipos_concepto">Tipo</label>
                        <select
                            id="tipos_concepto"
                            name="conceptos_tipos_id"
                            class="form-select"
                            aria-label="Selecciona un tipo"
                        >
                            <option selected>Selecciona un tipo</option>
                            @foreach($tiposConcepto as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12 mb-1">
                    <div class="form-group">
                        <label for="cif">Concepto</label>
                        <input id="cif" name="concepto" type="text" class="form-control"
                               data-required="El campo concepto es requerido"
                               @if($method != 'Nuevo') value="{{$tienda->cif}}"@endif
                        />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12 mb-1">
                    <div class="form-group">
                        <label for="precio_concepto">Precio</label>
                        <input id="precio_concepto" name="euro" type="text" class="form-control"
                               data-required="El campo precio es requerido"
                               @if($method != 'Nuevo') value="{{$tienda->cif}}"@endif
                        />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12 mb-1">
                    <div class="form-group">
                        <label for="fecha_pago_concepto">Fecha pago</label>
                        <input id="fecha_pago_concepto" name="fecha_pago" type="text" class="form-control flatpickr"
                               @if($method == 'Nuevo') value="{{\Illuminate\Support\Carbon::now()->format('Y-m-d')}}"@endif
                               data-required="El campo fecha pago es requerido"
                               @if($method != 'Nuevo') value="{{$tienda->cif}}"@endif
                        />
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12 mb-1">
                    <div class="form-group">
                        <label for="users_concepto">Quien pagó</label>
                        <select
                            id="users_concepto"
                            name="users_id"
                            class="form-select"
                            aria-label="Selecciona quién pagó"
                        >
                            <option>Selecciona quién pagó</option>
                            @foreach($usuarios as $user)

                                <option
                                    @if($method == 'Nuevo' && auth()->user()->id == $user->id) selected @endif
                                    value="{{$user->id}}">{{$user->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @if(@$method === 'Ver') </fieldset> @endif

        @include('./customs.form-buttons', ['routeName' =>'admin.pizarraTiendas'])
    </form>


@section('vendor-script')
    {{-- Vefndor js files --}}
{{--    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>--}}
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/custom/custom-form.js')). '?v='.$APP_VERSION }}"></script>
    <script src="{{ asset(mix('js/scripts/custom/custom-form-ajax-response.js')). '?v='.$APP_VERSION }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/conceptos/formulario.js')). '?v='.$APP_VERSION }}"></script>
{{--    <script src="{{ asset(mix('js/scripts/components/components-navs.js')) . '?v='.$APP_VERSION}}"></script>--}}
    {{-- Sweet Alert --}}
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
