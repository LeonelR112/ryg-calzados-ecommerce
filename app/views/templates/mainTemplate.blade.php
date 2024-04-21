<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        {!! cssFile('bootstrap.min') !!}
        {!! cssFile('navbar') !!}
        {!! cssFile('styles') !!}
        {!! cssFile('animations', false) !!}
        {!! cssFile('lightbox') !!}
        {!! jsFile('classes\CarritoProductos') !!}
        {!! jsFile('jquery-3.7.1.min') !!}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        @include('components.jsGlobal')
        @yield('header-scripts')
    </head>
    <body>
        @include('components.navbar')
        <main>
            @yield('content')
        </main>
        @include('components.footer')
        {!! jsFile('popper.min') !!}
        {!! jsFile('bootstrap.min') !!}
        {!! jsFile('lightbox') !!}
        @yield('footer-scripts')
    </body>
</html>