<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset(mix('css/web/pages/errors/error_page.css')) . '?v='.$APP_VERSION  }}">
</head>

<body>
    <section id="error">
        <div class="codigo">
            @yield('code')
        </div>
        <div class="mensaje">
            @yield('message')
        </div>
        <div class="duda">Si tiene alguna duda o inconveniente, no dude en contactarnos a través de <a href="mailto:{{Config::get('app.email_web')}}">{{Config::get('app.email_web')}}</a></div>
    </section>
</body>

</html>