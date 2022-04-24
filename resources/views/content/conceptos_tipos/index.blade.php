
@extends('layouts.contentLayoutMaster')

@section('title', 'Dashboard Ecommerce')

@section('vendor-style')
  {{-- vendor css files --}}
{{--  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">--}}
{{--  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">--}}
@endsection
@section('page-style')
  {{-- Page css files --}}

  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/ui-feather.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/content/conceptos_tipos/general.css')) }}">
  {{-- Flatpicker --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
{{--  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">--}}
{{--  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">--}}
{{--  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">--}}
@endsection

@section('content')
    <div class="row match-height">
        <div class="selector-content">
            <div class="col-lg-2 col-md-12 col-12 mb-1">
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
        </div>

        <div class="content-principal row match-height">
            <div class="col-12 col-md-7">
                <div class="row conceptos-pendientes">
                    {!! $viewConceptosPendientesTipo !!}
                </div>
                <div class="row conceptos-pagados">
                    {!! $viewConceptosPagadosTipo !!}
                </div>
            </div>
            <div class="col-12 col-md-5 tipos-stats">
                <div class="row">
                    <div>Aythami : 150 / <span class="text-success"> LE DEBEN 50</span></div>
                    <div>Paulis : 100 / <span class="text-danger">DEBE 50</span></div>
                    <div>Total : 250 <span class="text-danger"></span></div>

                    {!! $viewStatsTipo !!}
                </div>
            </div>
{{--                <div class="tipos-stats">--}}
{{--                    a--}}
{{--                </div>--}}
{{--                <div class="conceptos-pendientes">--}}

{{--                </div>--}}
{{--                <div class="conceptos-pagados">--}}

{{--                </div>--}}
        </div>

        @include('content.dashboard.admin.welcome')
        @include('content.dashboard.admin.resumen')
    </div>
@endsection

@section('vendor-script')
  {{-- vendor files --}}
{{--  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>--}}
{{--  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>--}}
@endsection
@section('page-script')
  {{-- Page js files --}}
@endsection
