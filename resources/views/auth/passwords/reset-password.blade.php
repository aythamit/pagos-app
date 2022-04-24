@extends('web.layouts/fullLayoutMaster')

@section('title', 'Password recovery')

@section('mystyle')
    {{-- Page Css files --}}
{{--    <link rel="stylesheet" href="{{ asset(mix('css/pages/authentication.css')) }}">--}}
{{--    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">--}}
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card text-center p-3">
                <div class="">
                    <h1 class="text-secondary">Successful password reset</h1>
                    <h2 class="card-title">Link to reset account generated</h2>
                    <img src="/images/icons/correo.png" alt="">
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p>You will shortly receive an email with instructions on how to reset your password and log in to the platform again.</p>
{{--                        <p>Si tiene alguna duda o inconveniente, no dude en contactarnos a través de info@elajonegroherbolarios.com</p>--}}
                        <a role="button" href="/" class="btn btn-secondary text-dark mt-2">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('vendor-script')
    <!-- vednor files -->
{{--    <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>--}}
@endsection

@section('myscript')
    <!-- Page js files -->
    <!--IMPORTANTE: Para que las validaciones funcionen correctamente,
        la variable "errores" debe estar antes del la importación
        de form-validation.js.-->
    <script>
        let errores = JSON.parse('<?php echo json_encode($errors->messages()) ?>');
    </script>


@endsection