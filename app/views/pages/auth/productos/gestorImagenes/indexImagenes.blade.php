@extends('templates.mainTemplateAuth')
@section('title', 'R&G - Categorías')
@section('title-page', 'CATEGORIAS')
@section('header-scripts')
    {!! paginationCSS() !!}
@endsection
@section('content')
    <section class="row m-0 g-3 p-2">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('auth/adm-productos')}}">Productos</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Imágenes</li>
                </ol>
            </nav>   
        </div>
        <div class="col-12 col-md-6 col-lg-3 text-center">
            <button class="btn btn-primary" type="button"><i class="bi bi-images"></i> Agregar imágenes</button>
        </div>
        <div class="col-12 col-md-6 col-lg-9">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Buscar imagenes">
            </div>              
        </div>
        <div class="col-12">
            <p class="text-center">Imágenes guardadas en el sistema</p>
            <hr>
            <section class="row m-0 g-3" id="content_images">
            </section>
        </div>
        <div class="col-12 my-2" id="paginador"></div>
    </section>
@endsection
@section('footer-scripts')
    {!! paginationJS() !!}
    <script>
        const JSON_IMAGENES = {!! $json_imagenes !!};
    </script>
    {!! jsFile('functions\pages\productos\gestorImagenes\indexGestorDeImagenes', false) !!}
@endsection