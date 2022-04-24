@extends('layouts/contentLayoutMaster')

@section('title', 'Gestionar ' . $nameCrud)

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
{{--    --}}{{-- Flatpicker --}}
{{--    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">--}}
{{--    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">--}}
@endsection

@section('page-style')
{{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/custom-datatable.css')) }}">
{{--    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">--}}
{{--    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">--}}
{{--    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">--}}
    @yield('crud-styles')
@endsection

@section('content')
    <!-- users list start -->
    <section class="app-user-list">
        <!-- list section start -->
        <div class="card">
            @yield('content-top')
            <div id="{{$nameCrud}}-parent-table" class="card-datatable table-responsive pt-0" style="overflow: inherit;">
                <table id="{{$nameCrud}}-table" class="user-list-table table">
                    <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th></th>
                        @yield('columns')
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- Modal to add new user starts-->
            <div class="modal modal-slide-in modal-slide-in-xl new-{{$nameCrud}}-modal fade" id="modals-slide-{{$nameCrud}}">
                <div class="modal-dialog">
                    <div class="modal-header mb-1">
                        <h5 class="modal-title text-capitalize" id="exampleModalLabel">{{$nameCrud}}</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="row">
                            {{-- Campos del formulario --}}
                            @yield('form')
                        </div>
                    </div>

                </div>
            </div>
            <!-- Modal to add new user Ends-->
        </div>
        <!-- list section end -->
    </section>
    <!-- users list ends -->
    @yield('modales')
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.colVis.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
{{--    --}}{{-- Quill Editor js files --}}
{{--    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>--}}
{{--    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>--}}
{{--    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>--}}
{{--     Sweet Alert --}}
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
{{--    --}}{{-- Flatpicker --}}
{{--    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>--}}
{{--    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>--}}
{{--    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>--}}
{{--    <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>--}}
{{--    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>--}}
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/custom/custom-datatable.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/custom/custom-form.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/custom/custom-form-ajax-response.js')). '?v='.$APP_VERSION }}"></script>
    <script src="{{ asset('lang/es/backpanel/alertas.js') }}"></script>
    <script src="{{ asset(('lang/es/backpanel/datatable.js')) }}"></script>
    @yield('crud-scripts')
@endsection
