<!DOCTYPE html>
<html lang="@if(session()->has('locale')){{session()->get('locale')}}@else es @endif">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') {{env('APP_NAME')}}</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo/favicon.ico')}}">
  <meta name="description" content="@yield('meta-description')">
  {{-- INDEXAR (si se desea) LAS PÁGINAS SOLO SI ESTOY EN PRODUCCIÓN --}}
  @if (config('app.env') == 'production')
    @yield('meta-robots')
  @else
    <meta name="robots" content="noindex">
  @endif
  <meta name="keywords" content="@yield('meta-keywords')">
  {{-- Include Styles --}}
  <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css')}}" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/web/core/bootstrap.min.css')}}" crossorigin="anonymous">
  {{-- <link rel="stylesheet" href="{{ asset('css/web/core/aos.css')}}" /> --}}
  <link rel="stylesheet" href="{{ asset(mix('css/web/layout/global.css')) . '?v='.$APP_VERSION }}" />
  <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" />
  @yield('page-style')
  @stack('extra-css')
</head>

<body class="">
  {{-- include navbar --}}
{{--  @include('web/panels/navbar')--}}
  {{-- include content --}}
  <div class="app-content content ml-0">
    <div class="content-wrapper">
      <div class="content-body">

        {{-- Include Startkit Content --}}
        @yield('content')

      </div>
    </div>
  </div>
  {{-- include footer --}}
{{--  @include('web/panels/footer')--}}
  <!-- JavaScript Bundle with Popper -->
  <script src="{{ asset('js/web/core/jquery2.min.js') }}" ></script>
  <script src="{{ asset('js/web/core/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
  {{-- <script src="{{ asset('js/web/core/aos.js') }}"></script> --}}
  {{-- <script>
    AOS.init();
  </script> --}}
  <script src="{{ asset(mix('js/web/layout/global.js')) . '?v='.$APP_VERSION }}"></script>
  @yield('page-script')
  @stack('extra-js')




</body>

</html>
