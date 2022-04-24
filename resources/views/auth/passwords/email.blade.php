@extends('layouts/fullLayoutMaster')

@section('title', 'Recuperar contraseña')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')). '?v='.$APP_VERSION }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Forgot Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="javascript:void(0);" class="brand-logo">
          <img class="img-fluid" width="60%" style="height:100%;" src="{{asset('images/logo/logo.png')}}" alt="logo Ordery">
        </a>

        <h4 class="card-title mb-1">Forgot your password? 🔒</h4>
        <p class="card-text mb-2">Please enter your username and we will send you an email with instructions on how to reset your password.</p>

        <form class="auth-forgot-password-form mt-2" method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="form-group">
            <label for="forgot-password-email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="forgot-password-email" name="email" value="{{ old('email') }}" placeholder="john@example.com" aria-describedby="forgot-password-email" tabindex="1" autofocus />
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ __($message) }}</strong>
              </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary btn-block" tabindex="2">Recover password</button>
        </form>

        <p class="text-center mt-2">
          @if (Route::has('login'))
          <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Back to </a>
          @endif
        </p>
      </div>
    </div>
    <!-- /Forgot Password v1 -->
  </div>
</div>
@endsection
