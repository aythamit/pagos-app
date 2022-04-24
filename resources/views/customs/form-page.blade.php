@extends('layouts/contentLayoutMaster')

@section('title', $method . ' ' . $nameCrud)

@section('page-style')
    @yield('crud-styles')
@endsection

@section('content')

    <section class="app-user-list">
        <div class="card">
            <div class="card-body">
                @yield('form')
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset("lang/en/backpanel/datatable.js") }}"></script>
    <script src="{{ asset("js/scripts/custom/custom-form-ajax-response.js") }}"></script>
    <script src="{{ asset('lang/en/backpanel/alertas.js') }}"></script>
    @yield('crud-scripts')
@endsection