@extends('web/layouts/webLayoutMaster')

@section('title', '')

{{-- @section('body-class', 'loading') --}}

@section('meta-description', 'Gestiona pedidos de tus clientes o realiza tu pedido a tu tienda favorita de una forma rápida y eficaz.')

@section('meta-keywords', 'Order Manager, Realizar pedido, Online')

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" />
    <link href="{{ asset(mix('css/web/pages/home/home.css')) . '?v=' . $APP_VERSION }}"
          rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">
    {{-- Page Css files --}}
{{--          rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">--}}
{{--    <link href="{{ asset(mix('vendors/css/aos/aos.css')) }}" rel="stylesheet">--}}
{{--    <link href="{{ asset(mix('vendors/css/extensions/swiper.7.0.6.min.css')) }}"--}}
{{--          rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">--}}

{{--    --}}{{-- MAPA --}}
{{--    <link href="{{ asset('vendors/css/leaflet/leaflet.css') }}"--}}
{{--          rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">--}}
@endsection

@section('content')
    @include('web.pages.home.header')

    <a href="/login">Login</a>

{{--   @include('web.pages.home.header')--}}
{{--   @include('web.pages.home.discover')--}}
{{--   @include('web.pages.home.divider', ['title' => 'DISCOVER OUR SERVICES'])--}}
{{--   <div id="append"></div>--}}
{{--   @include('web.pages.home.services')--}}
{{--   @include('web.pages.home.divider', ['title' => 'DISCOVER OUR COVERAGE'])--}}
{{--   @include('web.pages.home.mapa')--}}
{{--   @include('web.pages.home.team')--}}
@endsection

@section('page-script')
    {{-- Page Js files --}}
{{--    <script type="module" async defer src="{{ asset('js/web/core/pixi.min.js') }}"></script>--}}
    <script async defer src="{{ asset('js/web/pages/home.js') }}"></script>

    {{-- FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@800&display=swap" rel="stylesheet">
{{--    <script async defer src="{{ asset(mix('vendors/js/extensions/swiper.7.0.6.min.js')) }}"></script>--}}
{{--    <script async defer src="{{ asset('js/scripts/extensions/all.min.js') }}"></script>--}}
{{--    --}}{{-- MAPA --}}
{{--    <script async defer src="{{ asset('js/scripts/extensions/leaflet.js') }}"></script>--}}
{{--    <script async defer src="{{ asset('js/scripts/custom/custom-map.js') }}"></script>--}}

{{--    <script>const isMobile = <?php echo json_encode($isMobile); ?>;</script>--}}
{{--    <script src="{{ asset(mix('vendors/js/aos/aos.js')) }}"></script>--}}
{{--    <script src="{{ asset(mix('js/web/pages/home.js')) . '?v=' . $APP_VERSION }}"></script>--}}
{{--    <script src="{{ asset(mix('js/web/pages/text-animations.js')) . '?v=' . $APP_VERSION }}"></script>--}}
{{--    <script>--}}

{{--            AOS.init({--}}
{{--                disable: function() {--}}
{{--                    var maxWidth = 800;--}}
{{--                    return window.innerWidth < maxWidth;--}}
{{--                }--}}
{{--            });--}}

{{--    </script>--}}
@endsection
