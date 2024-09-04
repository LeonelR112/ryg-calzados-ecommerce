@extends('templates.mainTemplate')
@section('title', 'R&G - Ingresar')
@section('content')
<section class="container mb-3">
    <section class="row m-0 g-3 justify-content-center">
        <div class="col-12 mb-4">
            <!--
            <p class="text-center">
                Si no estás registrado, podrás crearte una haciendo click en "crear cuenta" en el botón debajo.<br>
                Al crearte una cuenta, obtendrás más beneficios como un control de pedidos, pedidos por mayor y descuentos exclusivos.
            </p>
            <div class="text-center">
                <a href="{{route('')}}" class="btn btn-primary">Crear cuenta</a>
            </div>
            -->
        </div>
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 border border-dark shadow p-4">
            <h5 class="text-center">Iniciar sesión</h5>
            <hr>
            <form action="{{route('ingresar/verificar')}}" method="POST">
                <div class="mb-3">
                    <label for="input_email" class="form-label">Email o nombre de usuario</label>
                    <input type="text" class="form-control" id="input_email" name="email" placeholder="name@example.com" value="{{isset($_SESSION['prevData']['prevemail']) ? $_SESSION['prevData']['prevemail'] : ""}}">
                    <div class="invalid-feedback" id="msgEmail"></div>
                </div> 
                <div class="mb-3">
                    <label for="input_pass" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="input_pass" name="contrasena" placeholder="">
                        <button class="btn btn-primary" type="button" title="Mostrar contraseña" id="button_show_pass"><i class="bi bi-eye"></i></button>
                        <div class="invalid-feedback" id="msgPass"></div>
                    </div>
                </div>  
                <div class="d-flex justify-content-center flex-wrap mb-3">
                    <button class="btn btn-primary px-5" type="submit" id="button_submit" title="Verificar e ingresar">Ingresar</button>
                </div>
                <div class="mb-3 text-center">
                    <a href="#" class="">Me olvidé mi contraseña</a>
                </div>                  
            </form>
        </div>
    </section>
</section>
@endsection
@isset($_SESSION['prevData'])
    @php
        unset($_SESSION['prevData']);
    @endphp
@endisset
@section('footer-scripts')
    {!! jsFile('validadores\pages\login\indexLogin', false) !!}
@endsection