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
{{--    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">--}}
{{--    <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">--}}
{{--    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">--}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/ui-feather.css')) }}">
@endsection

@section('crud-scripts')
{{--    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>--}}
{{--    <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>--}}
    <script src="{{ asset(mix('js/scripts/pages/empleados/empleados.js')). '?v='.$APP_VERSION }}"></script>
{{--    <script src="{{ asset(mix('js/scripts/custom/custom-canvas.js')). '?v='.$APP_VERSION }}"></script>--}}
{{--    <script src="{{asset(mix('js/scripts/ui/ui-feather.js'))}}"></script>--}}

@endsection

@section('form')
{{--    @include('content.expedientes.expedientesForm')--}}
@endsection

@section('modales')
{{--    @include('modal.modalFirma')--}}
@endsection
