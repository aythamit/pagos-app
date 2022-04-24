@extends('layouts/contentLayoutMaster')

@section('title', 'Gestionar ' . $nameCrud)

@section('vendor-style')
@endsection

@section('page-style')
    @yield('crud-styles')
@endsection

@section('content')
    <section class="app-user-list">
        @yield('content')
    </section>
@endsection

@yield('modales')

@section('vendor-script')
    {{-- Sweet Alert --}}
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/custom/custom-form.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/custom/custom-form-ajax-response.js')). '?v='.$APP_VERSION }}"></script>
    <script src="{{ asset('lang/es/backpanel/alertas.js') }}"></script>
    @yield('crud-scripts')
@endsection
