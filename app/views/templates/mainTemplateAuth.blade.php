<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        {!! cssFile('bootstrap.min') !!}
        {!! cssFile('navbar') !!}
        {!! cssFile('styles', false) !!}
        {!! cssFile('animations', false) !!}
        {!! cssFile('lightbox') !!}
        {!! cssFile('sidemenu', false) !!}
        {!! jsFile('classes\CarritoProductos') !!}
        {!! jsFile('jquery-3.7.1.min') !!}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @include('components.jsGlobal')
        @yield('header-scripts')
    </head>
    <body>
        @include('components.navbar')
        <main>
            <section class="row m-0 fade-in">
                <div class="col-0 col-lg-2 bg-grey-2 p-0" style="min-height: 90vh;">
                    @include('components.sidemenuAdmin')
                </div>
                <div class="col-12 col-lg-10 p-0">
                    <header class="header-section-auth">@yield('title-page')</header>
                    @yield('content')
                </div>
            </section>
        </main>
        @include('components.footer')
        {!! jsFile('popper.min') !!}
        {!! jsFile('bootstrap.min') !!}
        {!! jsFile('lightbox') !!}
        @include('components.notificacionSwal')
        @include('components.NotificacionToast')
        @yield('footer-scripts')
    </body>
</html>