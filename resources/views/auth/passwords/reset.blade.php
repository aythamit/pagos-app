@extends('layouts/fullLayoutMaster')

@section('title', 'Restablecer contraseña')

@section('page-style')
{{-- Page Css files --}}
{{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}"> --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')). '?v='.$APP_VERSION }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Reset Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="javascript:void(0);" class="brand-logo">
          <img class="img-fluid" width="60%" style="height:100%;max-height: 100px !important;" src="{{asset('images/logo/alomran.png')}}" alt="logo ziegel">
        </a>
        @if(isset($enlace_caducado) && $enlace_caducado)
          <span class="text-danger mb-50" role="alert">
                                  <strong>Este enlace ya ha caducado, por favor crea otro enlace para cambiar la contraseña.</strong>
                              </span>
        @endif
        <h4 class="card-title mb-1">Restablecer contraseña 🔒</h4>
        <p class="card-text mb-2">Por favor introduce tu nueva contraseña</p>

        <form class="auth-reset-password-form mt-2" method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <fieldset @if(isset($enlace_caducado) && $enlace_caducado) disabled @endif class="form-label-group">

          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="text" readonly class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="john@example.com" aria-describedby="email" tabindex="1" autofocus value="{{ $email ?? old('email') }}" />
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="reset-password-new">Nueva contraseña</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
              <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="reset-password-new" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-new" tabindex="2" autofocus />
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="reset-password-confirm">Confirma contraseña</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input type="password" class="form-control form-control-merge" id="reset-password-confirm" name="password_confirmation" autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-confirm" tabindex="3" />
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
          </div>
          </fieldset>
          <button type="submit" @if(isset($enlace_caducado) && $enlace_caducado) disabled @endif class="btn btn-primary btn-block" tabindex="4">Confirmar</button>
        </form>

        <p class="text-center mt-2">
          @if (Route::has('login'))
          <a href="{{ route('login') }}">
            <i data-feather="chevron-left"></i> Volver
          </a>
          @endif
        </p>
      </div>
    </div>
    <!-- /Reset Password v1 -->
  </div>
</div>
@endsection

@section('vendor-script')
{{-- <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script> --}}
@endsection

@section('page-script')
{{-- <script src="{{asset(mix('js/scripts/pages/page-auth-reset-password.js'))}}"></script> --}}
@endsection
