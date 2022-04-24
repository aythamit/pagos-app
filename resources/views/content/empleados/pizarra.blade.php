@extends('customs.crud')


@section('columns')
    <th>Image</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>DNI</th>
    <th>Correo electrónico</th>
    <th>Teléfono</th>
    <th>Tipo</th>
    <th>Actions</th>
@endsection

@section('crud-styles')
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/ui-feather.css')) }}">
@endsection

@section('crud-scripts')
    <script src="{{ asset(mix('js/scripts/pages/empleados/pizarra.js')). '?v='.$APP_VERSION }}"></script>
@endsection

@section('form')
{{--    @include('content.expedientes.expedientesForm')--}}
@endsection

@section('modales')
{{--    @include('modal.modalFirma')--}}
@endsection
