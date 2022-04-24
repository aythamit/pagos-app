@extends('customs.crud')

@section('columns')
    <th>Documento</th>
    <th>Cliente</th>
    <th>Pedido</th>
    <th>Observaciones</th>
    <th>Fecha entrega</th>
    <th>Fecha creación</th>
    <th>Estado</th>
    <th>Acciones</th>
@endsection

@section('crud-styles')
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/ui-feather.css')) }}">
    {{-- Flatpicker --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('crud-scripts')
    <script src="{{ asset(mix('js/scripts/pages/pedidos/pizarra.js')). '?v='.$APP_VERSION }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('form')
@endsection

@section('modales')
    @include('modales.pedidos.offcanvas-pedidos')
@endsection
