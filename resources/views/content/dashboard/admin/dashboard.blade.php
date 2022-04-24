
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Ecommerce')

@section('vendor-style')
  {{-- vendor css files --}}
{{--  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">--}}
{{--  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">--}}
@endsection
@section('page-style')
  {{-- Page css files --}}

  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/ui-feather.css')) }}">
  {{-- Flatpicker --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
{{--  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">--}}
{{--  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">--}}
{{--  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">--}}
@endsection

@section('content')
    <div class="row match-height">
        @include('content.dashboard.admin.welcome')
        @include('content.dashboard.admin.resumen')
        <div class="col-6 mb-2 py-2 card">
            @include('content.conceptos.formulario_concepto')
        </div>
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
