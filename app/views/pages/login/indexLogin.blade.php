@extends('templates.mainTemplate')
@section('title', 'R&G - Ingresar')
@section('content')
<section class="container mb-3">
    <section class="row m-0 g-3 justify-content-center">
        <div class="col-12">
            <p class="text-center">
                Si creas una cuenta, obtendrás más beneficios como un control de pedidos, pedidos por mayor y descuentos.
            </p>
            <div class="text-center">
                <a href="#" class="btn btn-primary">Crear cuenta</a>
            </div>
        </div>
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 border border-dark shadow p-4">
            <h5 class="text-center">Iniciar sesión</h5>
            <hr>
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="input_email" class="form-label">Email o nombre de usuario</label>
                    <input type="text" class="form-control" id="input_email" placeholder="name@example.com">
                    <div class="invalid-feedback" id="msgEmail"></div>
                </div> 
                <div class="mb-3">
                    <label for="input_pass" class="form-label">Contraseña</label>
                    <input type="text" class="form-control" id="input_pass" placeholder="">
                    <div class="invalid-feedback" id="msgPass"></div>
                </div>  
                <div class="d-flex justify-content-center flex-wrap mb-3">
                    <button class="btn btn-primary px-5" type="submit" title="Verificar e ingresar">Ingresar</button>
                </div>
                <div class="mb-3 text-center">
                    <a href="#" class="">Me olvidé mi contraseña</a>
                </div>                  
            </form>
        </div>
    </section>
</section>
@endsection
@section('footer-scripts')

@endsection