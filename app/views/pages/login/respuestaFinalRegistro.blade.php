@extends('templates.mainTemplate')
@section('title', 'R&G - Registro')
@section('content')
<section class="container mb-3">
    <section class="row m-0 g-3 justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            @if($creado)
                <div class="alert alert-success slit-in-horizontal" role="alert">
                    <h2 class="alert-heading text-center"><i class="bi bi-envelope-fill"></i><i class="bi bi-check2-circle"></i> Solicitud enviada!</h2>
                    <p>Muchas gracias! <br>Tu solicitud fue enviada correctamente. A la brevedad se analizará tu mensaje y te contactarán para evaluar y habilitar tu cuenta en la web.</p>
                    <hr>
                    <p class="mb-0">Cuando tu cuenta sea habilitada o no, se te enviará un mensaje a tu email que registraste avisandote si fuiste habilitado o no. Una vez que fue habilitado, podrás acceder a la plataforma y obtener los beneficios de ser usuario.</p>
                </div>
                <article class="my-2 p-2">
                    <h4 class="text-center">Datos que ingresaste:</h4>
                    <hr>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span class="text-muted">Nombre:</span> {{$registro_creado->getNombre()}}</li>
                        <li class="list-group-item"><span class="text-muted">Email:</span> {{$registro_creado->getEmail()}}</li>
                        <li class="list-group-item"><span class="text-muted">Teléfono:</span> {!! $registro_creado->getTelefono() == 0 ? '<span class="text-muted small fst-italic">-Sin especificar-</span>' : $registro_creado->getTelefono() !!}</li>
                        <li class="list-group-item"><span class="text-muted">Mensaje:</span> {{$registro_creado->getMensaje_solicitud()}}</li>
                    </ul>
                    <div class="text-center mt-3">
                        <a href="{{route('')}}" class="btn btn-primary">Ir al inicio</a>
                    </div>
                </article>
            @else
                <div class="alert alert-danger slit-in-horizontal text-center" role="alert">
                    <h2 class="alert-heading"><i class="bi bi-x-circle"></i> Ha ocurrido un problema!</h2>
                    <p>Parece que ha ocurrido un error al intentar enviar tu solicitud. Por favor, verifica que no estes utilizando caracteres especiales, links a páginas externas o palabras que pueden ser identificadas como spam.</p>
                    <hr>
                    <p class="mb-0">Intente nuevamente, si esto persiste, por favor vuelve a intentar más tarde.</p>
                </div>
                <div class="text-center mt-3">
                    <a href="{{route('')}}" class="btn btn-primary">Ir al inicio</a>
                </div>
            @endif
        </div>
    </section>
</section>
@endsection
@section('footer-scripts')
    
@endsection