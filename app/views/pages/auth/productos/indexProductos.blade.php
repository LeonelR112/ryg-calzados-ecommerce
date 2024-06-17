@extends('templates.mainTemplateAuth')
@section('title', 'R&G - Productos')
@section('title-page', 'PRODUCTOS')
@section('content')
    <section class="row m-0 justify-content-center p-4">
        <div class="col-12">
            <p class="text-center">Seleccione una opción</p>
        </div>
        <article class="col-12 col-md-6 col-lg-4 col-xxl-3">
            <div class="card card-selector shadow-sm position-relative">
                <div class="card-body h-100 d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-boxes display-5"></i>
                    <p class="text-center fw-bold mb-0">MIS PRODUCTOS</p>
                    <p class="mb-0 small">Ver todos los productos guardados en el sistema</p>
                    <p class="mb-0 text-center small text-muted fst-italic"><i class="bi bi-hand-index"></i> Click para entrar</p>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </article>
        <article class="col-12 col-md-6 col-lg-4 col-xxl-3">
            <div class="card card-selector shadow-sm position-relative">
                <div class="card-body h-100 d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-bookmarks display-5"></i>
                    <p class="text-center fw-bold mb-0">CATEGORÍAS</p>
                    <p class="mb-0 small">Administre las categorías para los productos</p>
                    <p class="mb-0 text-center small text-muted fst-italic"><i class="bi bi-hand-index"></i> Click para entrar</p>
                </div>
                <a href="{{route('auth/productos/categorias')}}" class="stretched-link"></a>
            </div>
        </article>
        <article class="col-12 col-md-6 col-lg-4 col-xxl-3">
            <div class="card card-selector shadow-sm position-relative">
                <div class="card-body h-100 d-flex justify-content-center align-items-center flex-column">
                    <i class="bi bi-images display-5"></i>
                    <p class="text-center fw-bold mb-0">IMÁGENES</p>
                    <p class="mb-0 small">Administrador de fotos para productos y categorías</p>
                    <p class="mb-0 text-center small text-muted fst-italic"><i class="bi bi-hand-index"></i> Click para entrar</p>
                </div>
                <a href="{{route('auth/productos/imagenes')}}" class="stretched-link"></a>
            </div>
        </article>
    </section>
@endsection