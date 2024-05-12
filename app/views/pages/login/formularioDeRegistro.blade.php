@extends('templates.mainTemplate')
@section('title', 'R&G - Registrarse')
@section('content')
<section class="container mb-3">
    <section class="row m-0 g-3 justify-content-center">
        <div class="col-12 col-md-10 col-lg-9 col-xl-8 border border-dark shadow p-4">
            <h5 class="text-center">Registrase</h5>
            <hr>
            <p class="text-muted small">* Campo obligatorio</p>
            <form action="{{route('ingresar/verificar-registro')}}" method="POST">
                <div class="mb-3">
                    <label for="input_nombre" class="form-label">Nombre de usuario *</label>
                    <input type="text" class="form-control" id="input_nombre" name="nombre" placeholder="fulanito11" value="{{isset($_SESSION['prevData']) ? $_SESSION['prevData']['nombre'] : ''}}">
                    <div class="invalid-feedback" id="msgNombre"></div>
                </div>
                <div class="mb-3">
                    <label for="input_email" class="form-label">Email *</label>
                    <input type="text" class="form-control" id="input_email" name="email" placeholder="" value="{{isset($_SESSION['prevData']) ? $_SESSION['prevData']['email'] : ''}}">
                    <div class="invalid-feedback" id="msgEmail"></div>
                </div>  
                <div class="mb-3">
                    <label for="input_telefono" class="form-label">Número de telefono o whatsapp</label>
                    <input type="text" class="form-control" id="input_telefono" name="telefono" placeholder="1155554444" value="{{isset($_SESSION['prevData']) ? $_SESSION['prevData']['telefono'] : ''}}">
                    <div class="invalid-feedback" id="msgTelefono"></div>
                </div>  
                <div class="mb-3">
                    <label for="input_password" class="form-label">Contraseña *</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="input_password" name="contrasena" placeholder="">
                        <button class="btn btn-primary" type="button" title="Mostrar contraseña" id="button_show_pass"><i class="bi bi-eye"></i></button>
                        <div class="invalid-feedback" id="msgPass"></div>
                    </div>
                </div> 
                <div class="mb-3">
                    <label for="input_repass" class="form-label">Repetir contraseña *</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="input_repass" name="" placeholder="">
                        <div class="invalid-feedback" id="msgRePass"></div>
                    </div>
                </div> 
                <div class="mb-3">
                    <label for="input_mensaje_solicitud" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="input_mensaje_solicitud" rows="3" name="mensaje" placeholder="">{{isset($_SESSION['prevData']) ? $_SESSION['prevData']['mensaje_solicitud'] : '' }}</textarea>
                    <div class="invalid-feedback" id="msgMesaje"></div>
                    <p class="text-end small mb-0"> <span id="contador_char">0</span>/255</p>
                </div>
                <div class="mb-3">
                    <p class="mb-3 text-center small">Estos datos será para que puedas acceder a la paltaforma. Deberás esperar a que tu cuenta sea verificada para poder ingresar.</p>
                </div>
                <div class="d-flex justify-content-center flex-wrap mb-3">
                    <button class="btn btn-primary px-5" type="submit" id="button_submit" title="Verificar e ingresar">Registrarse</button>
                </div>              
            </form>
        </div>
    </section>
</section>
@isset($_SESSION['prevData'])
    @php
        unset($_SESSION['prevData']);   
    @endphp
@endisset
@endsection
@section('footer-scripts')
    {!! jsFile('validadores/pages/login/formularioRegistro', false) !!}
@endsection